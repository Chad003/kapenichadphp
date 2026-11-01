<!DOCTYPE html>
<html lang="en">

<head>
    <title>SipUp Coffee By Chad | Admin</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="icon" href="/assets/img/logo.png">
</head>

<body class="bg-slate-50 text-slate-800 antialiased">
    <div class="min-h-screen flex">

        <?php include(__DIR__  . "/sidebar.php") ?>

        <main class="lg:ml-72 flex-1 min-w-0 w-full">
            <div class="p-4 sm:p-6 lg:p-8">

                <section id="dashboard" class="page-section">
                    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-7">
                        <div>
                            <p class="text-sm text-slate-500">Good day.</p>
                            <h2 class="text-xl sm:text-2xl font-semibold tracking-tight mt-1">
                                People overview
                            </h2>
                        </div>
                        <!-- <button
        onclick="openModal()"
        class="px-4 py-2.5 bg-slate-900 text-white rounded-xl text-sm font-medium hover:bg-slate-800 transition"
      >
        + Add Employee
      </button> -->
                    </div>
                </section>
            </div>
        </main>
    </div>
</body>

</html>