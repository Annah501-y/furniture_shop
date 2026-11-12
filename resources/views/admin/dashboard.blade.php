<x-admin-layout title="System overview" active="overview">
    <div class="mb-7 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.14em] text-indigo-600">Admin workspace</p>
            <h2 class="mt-2 text-2xl font-bold tracking-tight text-slate-900">Good to see you, {{ \Illuminate\Support\Str::before(auth()->user()->name, ' ') }}</h2>
            <p class="mt-1 text-sm text-slate-500">A clear view of your team and store setup.</p>
        </div>
        <a href="{{ route('admin.staff.create') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm shadow-indigo-200 transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" d="M12 5v14M5 12h14"/></svg>
            Add staff member
        </a>
    </div>

    <section aria-label="Store summary" class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @php
            $summaryCards = [
                ['label' => 'Staff accounts', 'value' => $staffCount, 'note' => 'People with store access', 'icon' => 'team', 'tone' => 'indigo'],
                ['label' => 'Active products', 'value' => $activeProductCount, 'note' => 'Visible in the catalog', 'icon' => 'products', 'tone' => 'blue'],
                ['label' => 'Active categories', 'value' => $activeCategoryCount, 'note' => 'Available for organization', 'icon' => 'categories', 'tone' => 'amber'],
                ['label' => 'Open orders', 'value' => $openOrderCount, 'note' => 'Need attention or delivery', 'icon' => 'orders', 'tone' => 'emerald'],
            ];
        @endphp
        @foreach ($summaryCards as $card)
            <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm shadow-slate-200/40">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <p class="text-sm font-medium text-slate-500">{{ $card['label'] }}</p>
                        <p class="mt-3 text-3xl font-bold tracking-tight text-slate-900">{{ number_format($card['value']) }}</p>
                    </div>
                    <span @class([
                        'flex h-10 w-10 items-center justify-center rounded-xl',
                        'bg-indigo-50 text-indigo-600' => $card['tone'] === 'indigo',
                        'bg-blue-50 text-blue-600' => $card['tone'] === 'blue',
                        'bg-amber-50 text-amber-600' => $card['tone'] === 'amber',
                        'bg-emerald-50 text-emerald-600' => $card['tone'] === 'emerald',
                    ])>
                        @if ($card['icon'] === 'team')
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="9" cy="8" r="3.5"/><path stroke-linecap="round" stroke-linejoin="round" d="M3 20v-1.3a4.7 4.7 0 0 1 4.7-4.7h2.6a4.7 4.7 0 0 1 4.7 4.7V20M16 4.8a3.5 3.5 0 0 1 0 6.4M17 14h.4a3.6 3.6 0 0 1 3.6 3.6V20"/></svg>
                        @elseif ($card['icon'] === 'products')
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m12 3 8.5 4.5v9L12 21l-8.5-4.5v-9L12 3Z"/><path stroke-linecap="round" stroke-linejoin="round" d="m3.8 7.7 8.2 4.5 8.2-4.5M12 12.2V21"/></svg>
                        @elseif ($card['icon'] === 'categories')
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4h6v6H4zM14 4h6v6h-6zM4 14h6v6H4zM14 14h6v6h-6z"/></svg>
                        @else
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 4h14v16H5zM8 8h8M8 12h8M8 16h5"/></svg>
                        @endif
                    </span>
                </div>
                <p class="mt-3 text-xs text-slate-500">{{ $card['note'] }}</p>
            </article>
        @endforeach
    </section>

    <div class="mt-6 grid gap-6 xl:grid-cols-[minmax(0,1.55fr)_minmax(300px,0.85fr)]">
        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm shadow-slate-200/40">
            <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4 sm:px-6">
                <div>
                    <h3 class="text-base font-semibold text-slate-900">Staff accounts</h3>
                    <p class="mt-0.5 text-sm text-slate-500">People invited to manage daily store operations.</p>
                </div>
                <a href="{{ route('admin.staff.create') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-700">Add member</a>
            </div>

            @if ($recentStaff->isNotEmpty())
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-100 text-left">
                        <thead class="bg-slate-50/70">
                            <tr>
                                <th scope="col" class="px-5 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500 sm:px-6">Team member</th>
                                <th scope="col" class="px-5 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">Access</th>
                                <th scope="col" class="px-5 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">Created</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach ($recentStaff as $member)
                                <tr>
                                    <td class="whitespace-nowrap px-5 py-3.5 sm:px-6">
                                        <div class="flex items-center gap-3">
                                            <span class="flex h-9 w-9 items-center justify-center rounded-full bg-slate-100 text-xs font-semibold text-slate-600">{{ strtoupper(substr($member->name, 0, 1)) }}</span>
                                            <span>
                                                <span class="block text-sm font-medium text-slate-800">{{ $member->name }}</span>
                                                <span class="mt-0.5 block text-xs text-slate-500">{{ $member->email }}</span>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-5 py-3.5 text-sm text-slate-600">Staff</td>
                                    <td class="whitespace-nowrap px-5 py-3.5 text-sm text-slate-500">{{ $member->created_at?->format('M j, Y') ?? '—' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="px-6 py-10 text-center">
                    <span class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M16 20v-1.5a4.5 4.5 0 0 0-4.5-4.5h-3A4.5 4.5 0 0 0 4 18.5V20M10 10a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7ZM19 8v6M16 11h6"/></svg>
                    </span>
                    <h4 class="mt-3 text-sm font-semibold text-slate-900">No staff accounts yet</h4>
                    <p class="mx-auto mt-1 max-w-sm text-sm text-slate-500">Invite a trusted team member to help manage products and orders.</p>
                    <a href="{{ route('admin.staff.create') }}" class="mt-4 inline-flex items-center gap-1.5 text-sm font-semibold text-indigo-600 hover:text-indigo-700">
                        Create the first staff account <span aria-hidden="true">→</span>
                    </a>
                </div>
            @endif
        </section>

        <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm shadow-slate-200/40 sm:p-6">
            <div class="flex items-start gap-3">
                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3 2.8 19h18.4L12 3Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 3h.01"/></svg>
                </span>
                <div>
                    <h3 class="text-base font-semibold text-slate-900">Store setup in progress</h3>
                    <p class="mt-1 text-sm leading-6 text-slate-500">The account and access foundation is in place. Product, order, and delivery workflows are the next build stage.</p>
                </div>
            </div>
            <div class="mt-5 space-y-3 border-t border-slate-100 pt-4">
                @foreach (['Product catalog', 'Order processing', 'Delivery settings'] as $item)
                    <div class="flex items-center gap-3 text-sm">
                        <span class="flex h-5 w-5 items-center justify-center rounded-full border border-slate-300 text-[10px] text-slate-400">•</span>
                        <span class="flex-1 text-slate-700">{{ $item }}</span>
                        <span class="text-xs text-slate-400">Planned</span>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
</x-admin-layout>
