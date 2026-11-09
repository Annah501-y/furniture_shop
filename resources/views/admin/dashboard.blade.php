
<x-app-layout>

    <div class="flex min-h-screen bg-gray-100">

        <!-- Admin Sidebar -->
        <aside class="w-64 shrink-0 bg-gray-900 text-white">

            <div class="border-b border-gray-700 px-6 py-6">
                <h2 class="text-xl font-bold">
                    Home Furniture Shop
                </h2>

                <p class="mt-1 text-sm text-gray-400">
                    Admin Panel
                </p>
            </div>

            <nav class="space-y-2 px-4 py-6">

                <a href="{{ route('admin.dashboard') }}"
                   class="block rounded-lg bg-gray-800 px-4 py-3 text-sm font-medium text-white">
                    Dashboard
                </a>

                <a href="#"
                   class="block rounded-lg px-4 py-3 text-sm text-gray-300 transition hover:bg-gray-800 hover:text-white">
                    Categories
                </a>

                <a href="#"
                   class="block rounded-lg px-4 py-3 text-sm text-gray-300 transition hover:bg-gray-800 hover:text-white">
                    Products
                </a>

                <a href="#"
                   class="block rounded-lg px-4 py-3 text-sm text-gray-300 transition hover:bg-gray-800 hover:text-white">
                    Orders
                </a>

                <a href="#"
                   class="block rounded-lg px-4 py-3 text-sm text-gray-300 transition hover:bg-gray-800 hover:text-white">
                    Delivery Areas
                </a>

                <a href="#"
                   class="block rounded-lg px-4 py-3 text-sm text-gray-300 transition hover:bg-gray-800 hover:text-white">
                    Settings
                </a>

            </nav>

        </aside>

        <!-- Main Dashboard Content -->
        <main class="min-w-0 flex-1 p-6">

            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800">
                    Admin Dashboard
                </h1>

                <p class="mt-2 text-gray-600">
                    Welcome to the Home Furniture Shop Management System.
                </p>
            </div>

            <!-- Dashboard Statistics -->
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-4">

                <div class="rounded-lg bg-white p-6 shadow">
                    <h2 class="text-sm font-medium text-gray-500">
                        New Orders
                    </h2>

                    <p class="mt-3 text-3xl font-bold text-gray-800">
                        0
                    </p>
                </div>

                <div class="rounded-lg bg-white p-6 shadow">
                    <h2 class="text-sm font-medium text-gray-500">
                        Pending Orders
                    </h2>

                    <p class="mt-3 text-3xl font-bold text-gray-800">
                        0
                    </p>
                </div>

                <div class="rounded-lg bg-white p-6 shadow">
                    <h2 class="text-sm font-medium text-gray-500">
                        Today's Orders
                    </h2>

                    <p class="mt-3 text-3xl font-bold text-gray-800">
                        0
                    </p>
                </div>

                <div class="rounded-lg bg-white p-6 shadow">
                    <h2 class="text-sm font-medium text-gray-500">
                        Delivered Sales
                    </h2>

                    <p class="mt-3 text-3xl font-bold text-gray-800">
                        TZS 0
                    </p>
                </div>

            </div>

        </main>

    </div>

</x-app-layout>
