<!DOCTYPE html>
<html lang="en">

<head>
    <title>SipUp Coffee By Chad</title>
    <?php include(__DIR__  . "/components/links.php") ?>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-[#faf8f5] text-[#2d211b]">

    <?php include(__DIR__  . "/components/header.php") ?>

    <main>
        <section class="mx-auto grid max-w-6xl items-center gap-10 px-5 py-2 md:grid-cols-2 md:py-20">
            <div>
                <h2 class="mt-6 text-4xl font-bold leading-tight tracking-tight sm:text-5xl">
                    Start Your Own <span class="text-[#a16d43]">Coffee Business.</span>
                </h2>

                <p class="mt-5 max-w-lg text-sm leading-7 text-[#71645a] sm:text-base">
                    Interested in the SipUp Coffee franchise? Send your inquiry to learn more about the franchise
                    package, requirements, and how to get started.
                </p>

                <a href="/menu.php"
                    class="mt-7 inline-flex items-center gap-2 rounded-lg bg-[#fff] px-6 py-3.5 text-sm font-semibold border-2 border-[#3b261b] transition">
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

                <a href="#inquiry"
                    class="mt-7 inline-flex items-center gap-2 rounded-lg bg-[#3b261b] px-6 py-3.5 text-sm font-semibold text-white transition hover:bg-[#60432f]">
                    Franchise Now
                    <i data-lucide="arrow-right" class="h-4 w-4"></i>
                </a>

                <div class="mt-8 flex items-center gap-3 text-sm text-[#71645a]">
                    <i data-lucide="check-circle" class="h-5 w-5 text-[#a16d43]"></i>
                    <span>Take the first step toward business ownership.</span>
                </div>
            </div>

            <div class="overflow-hidden rounded-2xl bg-[#3b261b] p-6 sm:p-9">
                <div
                    class="flex min-h-[300px] flex-col items-center justify-center rounded-xl border border-white/15 bg-[#4a3022] px-5 py-10 text-center">
                    <div
                        class="flex h-24 w-24 items-center justify-center rounded-full border border-[#d8b18a] bg-[#3b261b]">
                        <i data-lucide="coffee" class="h-12 w-12 text-[#e5bf96]"></i>
                    </div>
                    <p class="mt-6 text-xs font-semibold uppercase tracking-[4px] text-[#e5bf96]">SipUp Coffee</p>
                    <h3 class="mt-3 text-2xl font-bold text-white sm:text-3xl">Savor Each Sip.</h3>
                    <p class="mt-3 text-sm leading-6 text-white/65">Elevate every Moment.</p>
                </div>
            </div>
        </section>

        <section id="inquiry" class="border-t border-[#e9e0d7] bg-white px-4 py-12 sm:px-6">
            <div class="mx-auto max-w-3xl">
                <div class="mb-6 text-center">
                    <h2 class="text-2xl font-bold">Franchise Inquiry</h2>
                    <p class="mt-2 text-sm text-[#71645a]">Complete the form below to get started.</p>
                </div>

                <div class="overflow-hidden rounded-xl border border-[#e9e0d7]">
                    <iframe
                        src="https://docs.google.com/forms/d/e/1FAIpQLScYaHIvjwVtvxekRt0wxdK2QU4V_dgEJajt5yRb98EnogtHHg/viewform?embedded=true"
                        title="SipUp Coffee Franchise Inquiry Form" width="100%" height="1298" frameborder="0"
                        marginheight="0" marginwidth="0" loading="lazy" class="block w-full">Loading…</iframe>
                </div>

                <p class="mt-4 text-center text-xs text-[#8b7c70]">
                    Form not loading?
                    <a href="https://docs.google.com/forms/d/e/1FAIpQLScYaHIvjwVtvxekRt0wxdK2QU4V_dgEJajt5yRb98EnogtHHg/viewform"
                        target="_blank" rel="noopener noreferrer" class="font-semibold text-[#8a5b37] underline">Open it
                        here.</a>
                </p>
            </div>
        </section>
    </main>

    <footer class="bg-[#241810] px-5 py-5 text-center text-xs text-white/60">
        © <span id="year"></span> SipUp Coffee. All rights reserved.
    </footer>

    <script>
        lucide.createIcons();
        document.getElementById('year').textContent = new Date().getFullYear();
    </script>
</body>

</html>