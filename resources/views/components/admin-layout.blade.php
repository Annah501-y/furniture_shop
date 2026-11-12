@props([
    'title' => 'Overview',
    'active' => 'overview',
])

@php
    $isAdmin = auth()->user()->role === 'admin';
    $homeRoute = $isAdmin ? 'admin.dashboard' : 'staff.dashboard';
    $roleLabel = $isAdmin ? 'Administrator' : 'Staff member';
    $baseNav = 'group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition';
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }} · {{ config('app.name', 'Furniture Shop') }} Control Panel</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 font-sans text-slate-800 antialiased">
<div x-data="{ sidebarOpen: false, profileOpen: false }" class="min-h-screen">
    <div x-cloak x-show="sidebarOpen" x-transition.opacity
         class="fixed inset-0 z-40 bg-slate-950/40 lg:hidden"
         @click="sidebarOpen = false" aria-hidden="true"></div>

    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
           class="fixed inset-y-0 left-0 z-50 flex w-72 flex-col border-r border-slate-200 bg-white transition-transform duration-200 lg:translate-x-0">
        <a href="{{ route($homeRoute) }}" class="flex h-[76px] items-center gap-3 border-b border-slate-100 px-6">
            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-600 text-white shadow-sm shadow-indigo-200">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 10.5 12 5l8 5.5v8a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 4 18.5v-8Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 20v-6h6v6M8 10h.01M16 10h.01" />
                </svg>
            </span>
            <span class="min-w-0">
                <span class="block truncate text-sm font-bold tracking-tight text-slate-900">Furniture Shop</span>
                <span class="mt-0.5 block text-xs text-slate-500">Management portal</span>
            </span>
        </a>

        <nav class="flex-1 space-y-7 overflow-y-auto px-4 py-6" aria-label="Main navigation">
            <div>
                <p class="mb-2 px-3 text-[11px] font-semibold uppercase tracking-[0.12em] text-slate-400">Workspace</p>
                <a href="{{ route($homeRoute) }}"
                   @class([$baseNav, 'bg-indigo-50 text-indigo-700' => $active === 'overview', 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' => $active !== 'overview'])>
                    <svg class="h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                        <rect x="3.5" y="3.5" width="7" height="7" rx="1.5"/><rect x="13.5" y="3.5" width="7" height="7" rx="1.5"/><rect x="3.5" y="13.5" width="7" height="7" rx="1.5"/><rect x="13.5" y="13.5" width="7" height="7" rx="1.5"/>
                    </svg>
                    Overview
                </a>
            </div>

            <div>
                <p class="mb-2 px-3 text-[11px] font-semibold uppercase tracking-[0.12em] text-slate-400">Store management</p>
                <div class="space-y-1">
                    @foreach (['Products', 'Categories', 'Orders', 'Delivery areas'] as $module)
                        <div class="flex cursor-not-allowed items-center gap-3 rounded-xl px-3 py-2.5 text-sm text-slate-400" aria-disabled="true" title="This section is not available yet">
                            <span class="flex h-5 w-5 items-center justify-center" aria-hidden="true">
                                @if ($module === 'Products')
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><path stroke-linecap="round" stroke-linejoin="round" d="m12 3 8.5 4.5v9L12 21l-8.5-4.5v-9L12 3Z"/><path stroke-linecap="round" stroke-linejoin="round" d="m3.8 7.7 8.2 4.5 8.2-4.5M12 12.2V21"/></svg>
                                @elseif ($module === 'Categories')
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4h6v6H4zM14 4h6v6h-6zM4 14h6v6H4zM14 14h6v6h-6z"/></svg>
                                @elseif ($module === 'Orders')
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><path stroke-linecap="round" stroke-linejoin="round" d="M5 4h14v16H5zM8 8h8M8 12h8M8 16h5"/></svg>
                                @else
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7h11v10H3zM14 10h4l3 3v4h-7zM7 20a2 2 0 1 0 0-4 2 2 0 0 0 0 4ZM18 20a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/></svg>
                                @endif
                            </span>
                            <span class="flex-1">{{ $module }}</span>
                            <span class="rounded-md bg-slate-100 px-1.5 py-0.5 text-[10px] font-medium text-slate-400">Soon</span>
                        </div>
                    @endforeach
                </div>
            </div>

            @if ($isAdmin)
                <div>
                    <p class="mb-2 px-3 text-[11px] font-semibold uppercase tracking-[0.12em] text-slate-400">Administration</p>
                    <a href="{{ route('admin.staff.create') }}"
                       @class([$baseNav, 'bg-indigo-50 text-indigo-700' => $active === 'staff', 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' => $active !== 'staff'])>
                        <svg class="h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 20v-1.5a4.5 4.5 0 0 0-4.5-4.5h-3A4.5 4.5 0 0 0 4 18.5V20M10 10a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7ZM19 8v6M16 11h6" />
                        </svg>
                        Staff accounts
                    </a>
                    <div class="mt-1 flex cursor-not-allowed items-center gap-3 rounded-xl px-3 py-2.5 text-sm text-slate-400" aria-disabled="true">
                        <svg class="h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><circle cx="12" cy="12" r="3"/><path stroke-linecap="round" stroke-linejoin="round" d="m19.4 15 .1.1 1.4 1.1-1.5 2.6-1.7-.7a7.7 7.7 0 0 1-1.6.9l-.3 1.8h-3l-.3-1.8a7.7 7.7 0 0 1-1.6-.9l-1.7.7-1.5-2.6 1.4-1.1a7.2 7.2 0 0 1 0-1.9l-1.4-1.1 1.5-2.6 1.7.7a7.7 7.7 0 0 1 1.6-.9l.3-1.8h3l.3 1.8a7.7 7.7 0 0 1 1.6.9l1.7-.7 1.5 2.6-1.4 1.1a7.2 7.2 0 0 1 0 1.8Z"/></svg>
                        <span class="flex-1">System settings</span>
                        <span class="rounded-md bg-slate-100 px-1.5 py-0.5 text-[10px] font-medium text-slate-400">Soon</span>
                    </div>
                </div>
            @endif
        </nav>

        <div class="border-t border-slate-100 p-4">
            <div class="flex items-center gap-3 rounded-xl bg-slate-50 p-3">
                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-indigo-100 text-xs font-bold text-indigo-700">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                <span class="min-w-0 flex-1">
                    <span class="block truncate text-xs font-semibold text-slate-800">{{ auth()->user()->name }}</span>
                    <span class="mt-0.5 block text-[11px] text-slate-500">{{ $roleLabel }}</span>
                </span>
                <span class="h-2 w-2 rounded-full bg-emerald-500" title="Signed in"></span>
            </div>
        </div>
    </aside>

    <div class="min-h-screen lg:pl-72">
        <header class="sticky top-0 z-30 flex h-[76px] items-center justify-between border-b border-slate-200 bg-white/95 px-4 backdrop-blur sm:px-6 lg:px-8">
            <div class="flex min-w-0 items-center gap-3">
                <button type="button" @click="sidebarOpen = true" aria-label="Open navigation" :aria-expanded="sidebarOpen.toString()"
                        class="inline-flex h-10 w-10 items-center justify-center rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-50 lg:hidden">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <div class="min-w-0">
                    <p class="hidden text-xs text-slate-400 sm:block">{{ $isAdmin ? 'Administration' : 'Store operations' }} <span class="mx-1">/</span> <span class="text-slate-600">{{ $title }}</span></p>
                    <h1 class="truncate text-base font-semibold text-slate-900 sm:mt-1">{{ $title }}</h1>
                </div>
            </div>

            <div class="relative ml-3" @click.outside="profileOpen = false">
                <button type="button" @click="profileOpen = !profileOpen" :aria-expanded="profileOpen.toString()"
                        class="flex items-center gap-2 rounded-xl p-1.5 text-left hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    <span class="flex h-9 w-9 items-center justify-center rounded-full bg-indigo-600 text-sm font-semibold text-white">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                    <span class="hidden max-w-40 sm:block">
                        <span class="block truncate text-sm font-medium text-slate-800">{{ auth()->user()->name }}</span>
                        <span class="block text-xs text-slate-500">{{ $roleLabel }}</span>
                    </span>
                    <svg class="hidden h-4 w-4 text-slate-400 sm:block" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 11.17l3.71-3.94a.75.75 0 1 1 1.09 1.03l-4.25 4.5a.75.75 0 0 1-1.1 0l-4.25-4.5a.75.75 0 0 1 .03-1.05Z" clip-rule="evenodd"/></svg>
                </button>
                <div x-cloak x-show="profileOpen" x-transition
                     class="absolute right-0 mt-2 w-52 overflow-hidden rounded-xl border border-slate-200 bg-white py-1 shadow-lg shadow-slate-200/70">
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50">Account profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full px-4 py-2.5 text-left text-sm text-rose-600 hover:bg-rose-50">Sign out</button>
                    </form>
                </div>
            </div>
        </header>

        <main class="mx-auto w-full max-w-[1600px] p-4 sm:p-6 lg:p-8">
            {{ $slot }}
        </main>
        <footer class="border-t border-slate-200 px-4 py-4 text-center text-xs text-slate-400 sm:px-6 lg:px-8">
            Furniture Shop <span class="mx-1">·</span> Internal management workspace
        </footer>
    </div>
</div>
</body>
</html>
