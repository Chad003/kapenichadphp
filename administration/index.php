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

<body>
    <div class="min-h-screen bg-gray-100 flex items-center justify-center px-4">
        <div class="w-full max-w-md">
            <div class="bg-white rounded-2xl shadow-lg p-4">

                <div class="text-center mb-8">
                    <h1 class="text-2xl font-bold text-gray-800">Login</h1>
                </div>

                <form onsubmit="login(event)" class="space-y-5">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email Address
                        </label>

                        <input
                            id="email"
                            v-model="email"
                            type="email"
                            placeholder="admin@example.com"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" />
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Password
                        </label>

                        <input
                            id="password"
                            v-model="password"
                            type="password"
                            placeholder="••••••••"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" />
                    </div>

                    <!-- Login Button -->
                    <button
                        type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition duration-200">
                        Login
                    </button>
                </form>
            </div>

            <!-- Footer -->
            <p class="text-center text-xs text-gray-400 mt-6">© 2026 SipUp Coffee By Chad</p>
        </div>
    </div>
    <script>
        function login(e){
            e.preventDefault();
            window.location.replace("/administration/dashboard.php");
        }
    </script>
</body>

</html>