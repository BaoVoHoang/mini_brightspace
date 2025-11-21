<?php
session_start();
$error = $_GET['error'] ?? "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mini Brightspace – Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="w-full min-h-screen bg-slate-100 flex items-center justify-center">

    <!-- FULLSCREEN FLEX WRAPPER -->
    <div class="flex w-full min-h-screen items-center justify-center px-6">

        <!-- BIGGER RESPONSIVE LOGIN CARD -->
        <div class="
            w-full 
            sm:w-4/5 
            md:w-3/4 
            lg:w-2/3 
            xl:w-1/2 
            2xl:w-2/5 
            bg-white rounded-2xl shadow-xl border border-slate-200 p-12
            transition-all
        ">

            <!-- LOGO AREA -->
            <div class="text-center mb-10">
                <h1 class="text-4xl font-extrabold bg-gradient-to-r from-blue-500 to-cyan-400 bg-clip-text text-transparent">
                    MiniBrightspace
                </h1>
                <p class="text-slate-500 text-base mt-2">Welcome back! Please sign in.</p>
            </div>

            <!-- ERROR MESSAGE -->
            <?php if (!empty($error)): ?>
                <div class="bg-red-100 text-red-700 px-4 py-3 rounded-lg mb-6 text-center border border-red-300">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <!-- LOGIN FORM -->
            <form action="login_process.php" method="POST" class="space-y-7">

                <div>
                    <label class="block text-base font-medium text-slate-700 mb-2">Email</label>
                    <input type="email" 
                        name="email"
                        required
                        class="w-full px-5 py-3 text-base border border-slate-300 rounded-lg 
                               focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <div>
                    <label class="block text-base font-medium text-slate-700 mb-2">Password</label>
                    <input type="password"
                        name="password"
                        required
                        class="w-full px-5 py-3 text-base border border-slate-300 rounded-lg 
                               focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3.5 rounded-lg
                           text-base font-semibold transition shadow-md hover:shadow-lg">
                    Sign In
                </button>

            </form>

            <div class="text-center text-base mt-8">
                <p class="text-slate-600">
                    Don't have an account?
                    <a href="../register.php" class="text-blue-600 hover:underline font-medium">Create an Account</a>
                </p>
            </div>
        </div>

    </div>

</body>
</html>
