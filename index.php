<?php
$carousells = [
    [
        "product_name" => "Matcha Latte",
        "product_description" => "A green tea beverage made by combining finely ground matcha powder with hot water and steamed milk",
        "product_price" => "PHP 148.00",
        "product_image" => "/assets/img/carousell/matcha_latte.webp",
        "product_title" => "New Series",

    ],
    [
        "product_name" => "Caramel Machiatto",
        "product_description" => "A smooth blend of rich coffee, creamy milk, and sweet caramel goodness. A perfect balance of bold and sweet in every sip!",
        "product_price" => "PHP 108.00",
        "product_image" => "/assets/img/carousell/caramel_machiatto.webp",
        "product_title" => "Best Seller",

    ],
    [
        "product_name" => "French Vanilla",
        "product_description" => "Where coffee meets chocolate! Enjoy the rich taste of espresso blended with creamy milk and chocolate for a deliciously satisfying treat.",
        "product_price" => "PHP 108.00",
        "product_image" => "/assets/img/carousell/french_vanilla.webp",
        "product_title" => "Best Seller",

    ],
    [
        "product_name" => "Cafe Mocha",
        "product_description" => "Smooth, creamy, and irresistibly sweet! A delightful coffee blend with classic vanilla flavor that makes every sip feel extra special.",
        "product_price" => "PHP 108.00",
        "product_image" => "/assets/img/carousell/cafe_mocha.webp",
        "product_title" => "Best Seller",

    ],
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>SipUp Coffee By Chad</title>
    <?php include(__DIR__  . "/components/links.php") ?>

    <!-- Swiper CSS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Minimalist pagination dots inside dedicated controller */
        .custom-swiper-pagination .swiper-pagination-bullet {
            background: #ffffff;
            opacity: 0.4;
            transition: all 0.3s ease;
            width: 5px;
            height: 5px;
            margin: 0 2px !important;
        }

        .custom-swiper-pagination .swiper-pagination-bullet-active {
            opacity: 1;
            width: 12px;
            border-radius: 9999px;
            background: #ffffff;
        }
    </style>
</head>

<body class="bg-[#faf8f5] text-[#2d211b]">

    <?php include(__DIR__  . "/components/header.php") ?>

    <main>
        <section class="relative w-full overflow-hidden">
            <div class="swiper productSwiper">
                <div class="swiper-wrapper">
                    <?php foreach ($carousells as $carousell): ?>
                        <div class="swiper-slide relative h-[22vh] min-h-[160px] max-h-[220px] w-full xl:h-[35vh] xl:min-h-[300px]">
                            <img src="<?= $carousell["product_image"] ?>"
                                alt="Caramel Macchiato"
                                class="h-full w-full object-cover" />
                            <div class="absolute inset-0 bg-gradient-to-r from-black/85 via-black/40 to-transparent"></div>

                            <div class="absolute inset-0 flex items-center px-6 md:px-12 pr-28">
                                <div class="max-w-lg text-white">
                                    <span class="inline-block rounded-full bg-[#a16d43] px-2 py-0.5 text-[9px] font-semibold uppercase tracking-wider text-white mb-1">
                                        <?= $carousell["product_title"] ?>
                                    </span>
                                    <h2 class="text-lg font-bold sm:text-xl md:text-2xl tracking-tight leading-snug">
                                        <?= $carousell["product_name"] ?>
                                    </h2>
                                    <p class="hidden sm:block mt-0.5 text-[11px] text-gray-300 line-clamp-1">
                                         <?= $carousell["product_description"] ?>
                                    </p>
                                    <div class="mt-2 flex items-center gap-2.5">
                                        <span class="text-xs font-bold text-white md:text-sm"><?= $carousell["product_price"] ?></span>
                                        <a href="/menu.php" class="rounded-full bg-white px-3 py-1 text-[11px] font-bold text-[#2d211b] transition hover:bg-[#a16d43] hover:text-white">
                                            Order Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="absolute bottom-3 right-4 z-10 flex items-center gap-2 rounded-full bg-black/40 px-3 py-1.5 backdrop-blur-md border border-white/10 md:right-8">
                    <button class="swiper-button-prev-custom text-white/70 transition hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m15 18-6-6 6-6" />
                        </svg>
                    </button>

                    <div class="custom-swiper-pagination flex items-center"></div>

                    <button class="swiper-button-next-custom text-white/70 transition hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m9 18 6-6-6-6" />
                        </svg>
                    </button>
                </div>
            </div>
        </section>

        <section class="mx-auto grid max-w-6xl items-center gap-10 px-5 py-10 md:grid-cols-2 md:py-16">
            <div>
                <h2 class="text-4xl font-bold leading-tight tracking-tight sm:text-5xl">
                    Coffee On The Move, <span class="text-[#a16d43]">Coffee That Moves You.</span>
                </h2>

                <a href="/menu.php"
                    class="mt-7 inline-flex items-center gap-2 rounded-lg bg-[#fff] px-6 py-3.5 text-sm font-semibold border-2 border-[#3b261b] transition hover:bg-[#3b261b] hover:text-white">
                    Order Now
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-cart-plus preview-icon">
                        <path d="M16 5h6" />
                        <path d="M19 2v6" />
                        <path d="m2.05 2.05 1.099-.028a1 1 0 011.008.815l2.69 14.347A1 1 0 007.83 18H18" />
                        <path d="M4.564 5H12" />
                        <path d="M6.25 14h12.712a2 2 0 001.991-1.57l.172-1.041" />
                        <circle cx="18" cy="20" r="2" />
                        <circle cx="8" cy="20" r="2" />
                    </svg>
                </a>
            </div>
        </section>
    </main>

    <?php include(__DIR__  . "/components/footer.php") ?>

    <!-- Swiper JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        lucide.createIcons();
        document.getElementById('year').textContent = new Date().getFullYear();

        const swiper = new Swiper('.productSwiper', {
            slidesPerView: 1,
            spaceBetween: 0,
            loop: true,
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: '.swiper-button-next-custom',
                prevEl: '.swiper-button-prev-custom',
            },
            pagination: {
                el: '.custom-swiper-pagination',
                clickable: true,
            },
        });
    </script>
</body>

</html>