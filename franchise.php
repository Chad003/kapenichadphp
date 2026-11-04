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

    <?php include(__DIR__  . "/components/footer.php") ?>

    <script>
        lucide.createIcons();
        document.getElementById('year').textContent = new Date().getFullYear();
    </script>
</body>

</html>