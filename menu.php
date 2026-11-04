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
        ORDER BY CATEGORY, IS_AVAILABLE DESC;
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

if (isset($_GET['category'])) {
    $activeCategory = $_GET['category'];
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Menu | SipUp Coffee By Chad</title>
    <?php include(__DIR__  . "/components/links.php") ?>
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

        <?php include(__DIR__  . "/components/header.php") ?>

        <main id="menuContent" class="menu-scroll flex-1 px-3 py-1 sm:px-5">
            <?php foreach ($categories as $category => $items): ?>
                <section class="category-section <?= $category === $activeCategory ? '' : 'hidden' ?>"
                    data-category="<?= htmlspecialchars($category) ?>">

                    <div class="mb-4 flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-black"><?= htmlspecialchars($category) ?></h2>
                        </div>
                        <span class="rounded-full bg-white px-3 py-1 text-xs font-bold text-neutral-600">
                            <?= count(array_filter($items, fn($item) => $item['available'])) ?> available
                        </span>
                    </div>

                    <div class="grid grid-cols-3 gap-3 sm:grid-cols-4 lg:grid-cols-8">
                        <?php foreach ($items as $item): ?>
                            <article class="product-card flex flex-col justify-between overflow-hidden rounded-2xl border border-neutral-200 bg-white shadow-sm">

                                <div>
                                    <div class="relative aspect-square bg-neutral-200">
                                        <img
                                            src="<?= htmlspecialchars($item['image'], ENT_QUOTES, 'UTF-8') ?>"
                                            alt="<?= htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8') ?>"
                                            onerror="setDefaultProductImage(event)"
                                            loading="lazy"
                                            class="h-full w-full object-contain <?= !$item['available'] ? 'grayscale' : '' ?>">

                                        <?php if (!$item['available']): ?>
                                            <div class="absolute inset-0 bg-black/30 pointer-events-none"></div>
                                            <span class="absolute left-2 top-2 rounded-full px-2 py-1 text-[9px] font-black bg-red-100 text-red-800">
                                                NOT AVAILABLE
                                            </span>
                                        <?php endif; ?>

                                    </div>

                                    <div class="p-[0.35rem]">
                                        <h3 class="text-sm leading-tight text-pretty">
                                            <?= htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8') ?>
                                        </h3>

                                        <div class="mt-2 text-lg font-black">
                                            ₱<?= number_format($item['price'], 2) ?>
                                        </div>
                                    </div>
                                </div>

                            </article>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endforeach; ?>
        </main>

        <div class="fixed bottom-[9rem] right-4 z-50 sm:right-6">
            <button
                type="button"
                onclick="toggleCartModal()"
                aria-label="Shopping Cart"
                class="group relative flex items-center justify-center rounded-full bg-neutral-900 p-[.5rem] text-white shadow-lg transition-all duration-300 hover:bg-neutral-800 hover:scale-105 active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H19m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <span id="cartBadge" class="absolute -top-1 -right-1 flex h-5 w-5 items-center justify-center rounded-full bg-red-600 text-[10px] font-black text-white shadow">
                    0
                </span>
            </button>
        </div>

        <nav class="z-20 shrink-0 border-t border-neutral-200 bg-white px-3 pb-[max(6px,env(safe-area-inset-bottom))] pt-2 sm:px-4 shadow-[0_-5px_20px_rgba(0,0,0,0.04)]">
            <div class="mx-auto grid max-w-md grid-cols-4 gap-1.5 sm:gap-2">

                <!-- Coffee -->
                <button type="button"
                    class="category-btn <?= 'Coffee' === $activeCategory ? 'active' : '' ?> flex flex-col items-center justify-center gap-0.5 sm:gap-1 rounded-xl px-1.5 py-1.5 sm:py-2 text-neutral-600 transition-colors hover:bg-neutral-50"
                    data-target="Coffee"
                    aria-pressed="<?= 'Coffee' === $activeCategory ? 'true' : 'false' ?>">
                    <span class="flex h-10 w-10 items-center justify-center sm:h-6 sm:w-6">
                        <img src="/assets/icons/coffee.png" class="h-full w-full object-contain">
                    </span>
                    <span class="text-[10px] font-semibold sm:text-xs">Coffee</span>
                </button>

                <!-- Frappe -->
                <button type="button"
                    class="category-btn <?= 'Frappe' === $activeCategory ? 'active' : '' ?> flex flex-col items-center justify-center gap-0.5 sm:gap-1 rounded-xl px-1.5 py-1.5 sm:py-2 text-neutral-600 transition-colors hover:bg-neutral-50"
                    data-target="Frappe"
                    aria-pressed="<?= 'Frappe' === $activeCategory ? 'true' : 'false' ?>">
                    <span class="flex h-10 w-10 items-center justify-center sm:h-6 sm:w-6">
                        <img src="/assets/icons/frappe.svg" class="h-full w-full object-contain">
                    </span>
                    <span class="text-[10px] font-semibold sm:text-xs">Frappe</span>
                </button>

                <!-- Milk Tea -->
                <button type="button"
                    class="category-btn <?= 'Milk Tea' === $activeCategory ? 'active' : '' ?> flex flex-col items-center justify-center gap-0.5 sm:gap-1 rounded-xl px-1.5 py-1.5 sm:py-2 text-neutral-600 transition-colors hover:bg-neutral-50"
                    data-target="Milk Tea"
                    aria-pressed="<?= 'Milk Tea' === $activeCategory ? 'true' : 'false' ?>">
                    <span class="flex h-10 w-10 items-center justify-center sm:h-6 sm:w-6">
                        <img src="/assets/icons/milktea.png" class="h-full w-full object-contain">
                    </span>
                    <span class="text-[10px] font-semibold sm:text-xs">Milk Tea</span>
                </button>

                <!-- Non Coffee -->
                <button type="button"
                    class="category-btn <?= 'Non Coffee' === $activeCategory ? 'active' : '' ?> flex flex-col items-center justify-center gap-0.5 sm:gap-1 rounded-xl px-1.5 py-1.5 sm:py-2 text-neutral-600 transition-colors hover:bg-neutral-50"
                    data-target="Non Coffee"
                    aria-pressed="<?= 'Non Coffee' === $activeCategory ? 'true' : 'false' ?>">
                    <span class="flex h-10 w-10 items-center justify-center sm:h-6 sm:w-6">
                        <img src="/assets/icons/non-coffee.svg" class="h-full w-full object-contain">
                    </span>
                    <span class="text-[10px] font-semibold sm:text-xs">Non Coffee</span>
                </button>
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
            console.error(`Cannot find image ${image}`)
            // image.src = "/assets/img/logo.png"
        }

        /**
         * Sends a request to add an item to the cart based on the table schema.
         * 
         * @param {Object} cartData - The cart details matching the table columns.
         * @param {string} cartData.device_fingerprint - Unique device identifier (Required)
         * @param {string} [cartData.customer_name] - Customer name (Optional)
         * @param {string} [cartData.phone_number] - Customer phone number (Optional)
         * @param {number} cartData.product_id - Product ID (Required, bigint)
         * @param {number} cartData.quantity - Quantity to add (Required, int)
         * @param {number} cartData.price - Unit price (Required, decimal)
         * @param {number} [cartData.promo_id] - Promotional ID (Optional, bigint)
         */
        async function addToCart(cartData) {
            const url = '/api/order/add-to-cart.php';

            // Construct payload matching the database column requirements
            const payload = {
                DEVICE_FINGERPRINT: cartData.device_fingerprint,
                CUSTOMER_NAME: cartData.customer_name || null,
                PHONE_NUMBER: cartData.phone_number || null,
                PRODUCT_ID: cartData.product_id,
                QUANTITY: cartData.quantity,
                PRICE: cartData.price,
                PROMO_ID: cartData.promo_id || 0
            };

            try {
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });

                // Parse response safely
                const contentType = response.headers.get('content-type');
                const data = contentType && contentType.includes('application/json') ?
                    await response.json() :
                    await response.text();

                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`, {
                        cause: data
                    });
                }

                console.log('Successfully added to cart:', data);
                return {
                    success: true,
                    data
                };

            } catch (error) {
                console.error('Failed to add to cart:', error);
                return {
                    success: false,
                    error: error.message
                };
            }
        }

        // --- Example Usage ---
        /*
        addToCart({
            device_fingerprint: "fp_abc123xyz789",
            customer_name: "Juan Dela Cruz",
            phone_number: "+639123456789",
            product_id: 1042,
            quantity: 2,
            price: 350.00,
            promo_id: 5
        });
        */
    </script>

</body>

</html>