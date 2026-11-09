
<x-app-layout>
    <div class="flex min-h-screen bg-gray-100">

        <!-- Admin Sidebar -->
        <aside class="w-64 bg-gray-900 text-white">

            <div class="border-b border-gray-700 p-6">
                <h2 class="text-xl font-bold">
                    Home furniture Shop
                </h2>

                <p class="mt-1 text-sm text-gray-400">
                    Admin Panel
                </p>
            </div>

            <nav class="mt-6 space-y-2 px-4">

                <a href="{{ route('admin.dashboard') }}"
                   class="block rounded-lg bg-gray-800 px-4 py-3 text-sm font-medium text-white">
                    Dashboard
                </a>

                <a href="#"
                   class="block rounded-lg px-4 py-3 text-sm text-gray-300 hover:bg-gray-800 hover:text-white">
                    Categories
                </a>

                <a href="#"
                   class="block rounded-lg px-4 py-3 text-sm text-gray-300 hover:bg-gray-800 hover:text-white">
                    Products
                </a>

                <a href="#"
                   class="block rounded-lg px-4 py-3 text-sm text-gray-300 hover:bg-gray-800 hover:text-white">
                    Orders
                </a>

                <a href="#"
                   class="block rounded-lg px-4 py-3 text-sm text-gray-300 hover:bg-gray-800 hover:text-white">
                    Delivery Areas
                </a>

                <a href="#"
                   class="block rounded-lg px-4 py-3 text-sm text-gray-300 hover:bg-gray-800 hover:text-white">
                    Settings
                </a>

            </nav>

        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            @yield('admin-content')
        </main>

    </div>
</x-app-layout>
