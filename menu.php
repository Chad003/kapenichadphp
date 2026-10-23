<?php
require_once __DIR__ . '/utils/load-env.php';

$categories = [
    'Coffee' => [],
    'Frappe' => [],
    'Milk Tea' => [],
    'Snacks' => [],
];

$errorMessage = '';

try {
    $dsn = 'mysql:host=' . $_ENV['DB_HOST']
        . ';dbname=' . $_ENV['DB_NAME']
        . ';charset=utf8mb4';

    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    $pdo = new PDO(
        $dsn,
        $_ENV['DB_USER'],
        $_ENV['DB_PASS'],
        $options
    );

    $sql = "
        SELECT
            PRODUCT_ID,
            CATEGORY,
            BRAND,
            MEDIUM,
            NAME,
            DESCRIPTION,
            IMG_PATH,
            QUANTITY,
            UOM,
            SRP,
            SELLING_PRICE,
            IS_BEST_SELLER,
            IS_AVAILABLE
        FROM t_products
        ORDER BY SELLING_PRICE DESC
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    while ($product = $stmt->fetch()) {
        $category = trim($product['CATEGORY']);

        if (!isset($categories[$category])) {
            $categories[$category] = [];
        }

        $categories[$category][] = [
            'id'          => $product['PRODUCT_ID'],
            'name'        => $product['NAME'],
            'description' => $product['DESCRIPTION'],
            'price'       => (float) $product['SELLING_PRICE'],
            'srp'         => (float) $product['SRP'],
            'image'       => $product['IMG_PATH'],
            'available'   => (bool) $product['IS_AVAILABLE'],
            'bestSeller'  => (bool) $product['IS_BEST_SELLER'],
            'brand'       => $product['BRAND'],
            'medium'      => $product['MEDIUM'],
            'quantity'    => (float) $product['QUANTITY'],
            'uom'         => $product['UOM'],
        ];
    }
} catch (PDOException $e) {
    error_log('Menu database error: ' . $e->getMessage());
    $errorMessage = 'Unable to load products. Please try again later.';
}

$activeCategory = 'Coffee';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu | SipUp Coffee By Chad</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            overflow: hidden;
        }

        .menu-scroll {
            height: 100%;
            overflow-y: auto;
            scrollbar-width: thin;
        }

        .category-btn {
            transition: background .15s, color .15s;
        }

        .category-btn.active {
            /* background: rgb(253 224 71); */
            color: #5f3915;
        }

        .product-card img {
            transition: transform .2s;
        }

        .product-card:active img {
            transform: scale(1.03);
        }
    </style>
</head>

<body class="bg-neutral-100 text-neutral-900">

    <div class="flex h-[100dvh] flex-col">

        <header class="z-10 shrink-0 bg-neutral-900 px-4 py-4 text-white shadow">
            <p class="text-[10px] font-bold uppercase tracking-[0.22em] text-yellow-300">
                SipUp Coffee By Chad
            </p>
            <h1 class="mt-1 text-2xl font-black">Our Menu</h1>
            <p class="mt-1 text-xs text-neutral-400">Find your next favorite drink or snack.</p>
        </header>

        <main id="menuContent" class="menu-scroll flex-1 px-3 py-4 sm:px-5">
            <?php foreach ($categories as $category => $items): ?>
                <section class="category-section <?= $category === $activeCategory ? '' : 'hidden' ?>"
                    data-category="<?= htmlspecialchars($category) ?>">

                    <div class="mb-4 flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-black"><?= htmlspecialchars($category) ?></h2>
                            <p class="mt-1 text-xs text-neutral-500">Made to brighten your day.</p>
                        </div>
                        <span class="rounded-full bg-white px-3 py-1 text-xs font-bold text-neutral-600">
                            <?= count(array_filter($items, fn($item) => $item['available'])) ?> available
                        </span>
                    </div>

                    <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-4">
                        <?php foreach ($items as $item): ?>
                            <article class="product-card overflow-hidden rounded-2xl border border-neutral-200 bg-white shadow-sm">
                                <div class="relative aspect-square bg-neutral-200">
                                    <img
                                        src="<?= htmlspecialchars($item['image'], ENT_QUOTES, 'UTF-8') ?>"
                                        alt="<?= htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8') ?>"
                                        onerror="setDefaultProductImage(event)"
                                        loading="lazy"
                                        class="h-full w-full object-contain">
                                    <span class="absolute left-2 top-2 rounded-full px-2 py-1 text-[9px] font-black <?= $item['available'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                        <?= $item['available'] ? 'AVAILABLE' : 'NOT AVAILABLE' ?>
                                    </span>
                                </div>

                                <div class="p-3">
                                    <h3 class="text-sm font-extrabold leading-tight">
                                        <?= htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8') ?>
                                    </h3>
                                    <p class="mt-1 min-h-8 text-[11px] leading-relaxed text-neutral-500">
                                        <?= htmlspecialchars($item['description'], ENT_QUOTES, 'UTF-8') ?>
                                    </p>
                                    <div class="mt-3 text-lg font-black">
                                        ₱<?= number_format($item['price'], 2) ?>
                                    </div>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endforeach; ?>
        </main>

        <nav class="z-20 shrink-0 border-t border-neutral-200 bg-white px-2 pb-[max(8px,env(safe-area-inset-bottom))] pt-2 shadow-[0_-5px_20px_rgba(0,0,0,0.06)]">
            <div class="mx-auto grid max-w-lg grid-cols-6 gap-1">
                <?php
                $icons = [
                    'Coffee' => '/assets/icons/coffee1.svg',
                    'Frappe' => '/assets/icons/frappe.svg',
                    'Milk Tea' => '/assets/icons/milktea.svg',
                    'Ice Cream' => '/assets/icons/ice-cream.svg',
                    'Snacks' => '/assets/icons/fries.svg',
                    'Non Coffee' => '/assets/icons/non-coffee.svg',
                ];
                foreach ($categories as $category => $items):
                ?>
                    <button
                        type="button"
                        class="category-btn <?= $category === $activeCategory ? 'active' : '' ?> flex flex-col items-center justify-center gap-1 rounded-xl px-1 py-2 text-neutral-600"
                        data-target="<?= htmlspecialchars($category) ?>"
                        aria-pressed="<?= $category === $activeCategory ? 'true' : 'false' ?>">
                        <span class="text-xl leading-none"><img src="<?= $icons[$category] ?>" class="object-contain"></span>
                        <span class="text-[10px] font-bold sm:text-xs"><?= htmlspecialchars($category) ?></span>
                    </button>
                <?php endforeach; ?>
            </div>
        </nav>

    </div>

    <script>
        const categoryButtons = document.querySelectorAll('.category-btn');
        const categorySections = document.querySelectorAll('.category-section');
        const menuContent = document.getElementById('menuContent');

        categoryButtons.forEach(button => {
            button.addEventListener('click', () => {
                const target = button.dataset.target;

                categorySections.forEach(section => {
                    section.classList.toggle('hidden', section.dataset.category !== target);
                });

                categoryButtons.forEach(item => {
                    const active = item === button;
                    item.classList.toggle('active', active);
                    item.setAttribute('aria-pressed', active ? 'true' : 'false');
                });

                menuContent.scrollTop = 0;
            });
        });

        function setDefaultProductImage(e) {
            const image = e.target;
            image.src = "/assets/img/logo.png"
        }
    </script>

</body>

</html>