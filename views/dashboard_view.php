<?php
// Session is already active from the require_once in dashboard.php

// Ensure session values exist
$name = $_SESSION['name'] ?? 'User';
$role = $_SESSION['role'] ?? 'student';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Brightspace Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50">
<div class="flex h-screen bg-slate-50">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-slate-900 text-white p-6 sticky top-0 max-h-screen overflow-y-auto border-r border-slate-800">
        <!-- LOGO -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent">
                MiniBrightspace
            </h1>
            <p class="text-xs text-slate-400 mt-1">Learning Management</p>
        </div>

        <!-- NAVIGATION -->
        <nav class="space-y-1 flex-1">

            <!-- Dashboard -->
            <a href="dashboard.php" class="nav-link active">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 11l4-2m-9-10L9 5m0 0L5 9m4-4l7-4"/>
                </svg>
                <span>Dashboard</span>
            </a>

            <!-- Student -->
            <?php if ($role === 'student'): ?>
                <a href="courses/my_courses.php" class="nav-link">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C6.228 6.228 2 10.432 2 15.5S6.228 24.772 12 24.772s10-4.228 10-9.272S17.772 6.228 12 6.253z"/>
                    </svg>
                    <span>My Courses</span>
                </a>
                <a href="assignments/view_assignments.php" class="nav-link">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    <span>Assignments</span>
                </a>
                <a href="assignments/view_submissions.php" class="nav-link">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Submissions</span>
                </a>
            <?php endif; ?>

            <!-- Teacher -->
            <?php if ($role === 'teacher'): ?>
                <a href="assignments/create_assignment.php" class="nav-link">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Create Assignment</span>
                </a>
                <a href="assignments/view_submissions.php" class="nav-link">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m7 7v4m0 0H8m4 0h4"/>
                    </svg>
                    <span>Grade Submissions</span>
                </a>
            <?php endif; ?>

            <!-- Admin -->
            <?php if ($role === 'admin'): ?>
                <a href="admin/manage_users.php" class="nav-link">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 8.646 4 4 0 010-8.646z"/>
                    </svg>
                    <span>Manage Users</span>
                </a>
                <a href="admin/manage_courses.php" class="nav-link">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4"/>
                    </svg>
                    <span>Manage Courses</span>
                </a>
                <a href="admin/view_reports.php" class="nav-link">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    <span>Reports</span>
                </a>
            <?php endif; ?>

        </nav>

        <!-- FOOTER NAV -->
        <div class="border-t border-slate-700 pt-4 mt-auto">
            <a href="auth/logout.php" class="nav-link text-red-400 hover:text-red-300 hover:bg-red-900/20">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                <span>Logout</span>
            </a>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 flex flex-col overflow-hidden">

        <!-- HEADER -->
        <header class="bg-white border-b border-slate-200 px-8 py-6 flex justify-between items-center sticky top-0 z-10">
            <div>
                <h2 class="text-3xl font-bold text-slate-900">Welcome, <?= htmlspecialchars($name) ?></h2>
                <p class="text-sm text-slate-500 mt-1">Here's what's happening with your account today</p>
            </div>

            <div class="flex items-center gap-6">
                <span class="px-4 py-2 bg-blue-100 text-blue-700 rounded-lg text-sm font-medium">
                    <?= ucfirst($role) ?>
                </span>

                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-400 to-cyan-400 flex items-center justify-center font-bold text-white text-lg shadow-md">
                    <?= strtoupper($name[0]) ?>
                </div>
            </div>
        </header>

        <!-- CONTENT AREA -->
        <div class="flex-1 overflow-y-auto bg-slate-50">
            <div class="w-full h-full">

                <!-- QUICK ACTIONS GRID -->
                <section class="w-full pt-8 pb-8 px-6">
                    <h3 class="text-lg font-semibold text-slate-900 mb-4 px-2">Quick Access</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 w-full px-2">

                        <!-- View All Courses -->
                        <a href="courses/view_courses.php" class="card">
                            <div class="flex items-start justify-between mb-3">
                                <div class="p-2 bg-blue-100 rounded-lg">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C6.228 6.228 2 10.432 2 15.5S6.228 24.772 12 24.772s10-4.228 10-9.272S17.772 6.228 12 6.253z"/>
                                    </svg>
                                </div>
                            </div>
                            <h4 class="font-semibold text-slate-900">View Courses</h4>
                            <p class="text-sm text-slate-600 mt-1">Browse available courses</p>
                        </a>

                        <!-- My Assignments -->
                        <a href="assignments/view_assignments.php" class="card">
                            <div class="flex items-start justify-between mb-3">
                                <div class="p-2 bg-purple-100 rounded-lg">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                </div>
                            </div>
                            <h4 class="font-semibold text-slate-900">Assignments</h4>
                            <p class="text-sm text-slate-600 mt-1">View your tasks</p>
                        </a>

                        <!-- My Submissions -->
                        <a href="assignments/view_submissions.php" class="card">
                            <div class="flex items-start justify-between mb-3">
                                <div class="p-2 bg-green-100 rounded-lg">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <h4 class="font-semibold text-slate-900">Submissions</h4>
                            <p class="text-sm text-slate-600 mt-1">Check your uploads</p>
                        </a>

                        <!-- Teacher Only -->
                        <?php if ($role === 'teacher'): ?>
                            <a href="assignments/create_assignment.php" class="card">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="p-2 bg-orange-100 rounded-lg">
                                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                    </div>
                                </div>
                                <h4 class="font-semibold text-slate-900">Create Assignment</h4>
                                <p class="text-sm text-slate-600 mt-1">Make tasks for students</p>
                            </a>
                        <?php endif; ?>

                        <!-- Admin Only -->
                        <?php if ($role === 'admin'): ?>
                            <a href="admin/manage_users.php" class="card">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="p-2 bg-indigo-100 rounded-lg">
                                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 8.646 4 4 0 010-8.646z"/>
                                        </svg>
                                    </div>
                                </div>
                                <h4 class="font-semibold text-slate-900">Manage Users</h4>
                                <p class="text-sm text-slate-600 mt-1">Control system users</p>
                            </a>
                        <?php endif; ?>

                    </div>
                </section>

                <!-- ADDITIONAL ACTIONS FOR ADMIN -->
                <?php if ($role === 'admin'): ?>
                    <section class="w-full pb-8 px-6">
                        <h3 class="text-lg font-semibold text-slate-900 mb-4 px-2">Administration</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 w-full px-2">

                            <a href="admin/manage_courses.php" class="card">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="p-2 bg-cyan-100 rounded-lg">
                                        <svg class="w-6 h-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4"/>
                                        </svg>
                                    </div>
                                </div>
                                <h4 class="font-semibold text-slate-900">Manage Courses</h4>
                                <p class="text-sm text-slate-600 mt-1">Configure all courses</p>
                            </a>

                            <a href="admin/view_reports.php" class="card">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="p-2 bg-rose-100 rounded-lg">
                                        <svg class="w-6 h-6 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                        </svg>
                                    </div>
                                </div>
                                <h4 class="font-semibold text-slate-900">Reports</h4>
                                <p class="text-sm text-slate-600 mt-1">View system analytics</p>
                            </a>

                        </div>
                    </section>
                <?php endif; ?>

            </div>
        </div>

    </main>
</div>

<style>
    .nav-link {
        @apply flex items-center gap-3 px-4 py-3 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition-all;
    }

    .nav-link.active {
        @apply bg-slate-800 text-white border-l-4 border-blue-500 pl-3;
    }

    .card {
        @apply bg-white p-6 rounded-xl shadow-sm hover:shadow-lg transition-all border border-slate-200 hover:border-blue-300 cursor-pointer block;
    }

    body {
        @apply font-sans;
    }
</style>

</body>
</html>
