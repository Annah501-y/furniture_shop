<x-admin-layout title="Operations overview" active="overview">
    <div class="mb-7">
        <p class="text-xs font-semibold uppercase tracking-[0.14em] text-indigo-600">Staff workspace</p>
        <h2 class="mt-2 text-2xl font-bold tracking-tight text-slate-900">Welcome, {{ \Illuminate\Support\Str::before(auth()->user()->name, ' ') }}</h2>
        <p class="mt-1 text-sm text-slate-500">Your store operations will be managed here.</p>
    </div>

    <section aria-label="Store summary" class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
        @foreach ([
            ['label' => 'Open orders', 'value' => $openOrderCount, 'caption' => 'Orders needing attention'],
            ['label' => 'Active products', 'value' => $activeProductCount, 'caption' => 'Products visible in the catalog'],
            ['label' => 'Active categories', 'value' => $activeCategoryCount, 'caption' => 'Current product categories'],
        ] as $card)
            <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm shadow-slate-200/40">
                <p class="text-sm font-medium text-slate-500">{{ $card['label'] }}</p>
                <p class="mt-3 text-3xl font-bold tracking-tight text-slate-900">{{ number_format($card['value']) }}</p>
                <p class="mt-3 text-xs text-slate-500">{{ $card['caption'] }}</p>
            </article>
        @endforeach
    </section>

    <section class="mt-6 rounded-2xl border border-indigo-100 bg-indigo-50/70 p-5 sm:p-7">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-start">
            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-white text-indigo-600 shadow-sm">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v3m0 12v3m9-9h-3M6 12H3m15.4-6.4-2.1 2.1M7.7 16.3l-2.1 2.1m12.8 0-2.1-2.1M7.7 7.7 5.6 5.6"/><circle cx="12" cy="12" r="5"/></svg>
            </span>
            <div>
                <h3 class="text-base font-semibold text-slate-900">Your workspace is ready</h3>
                <p class="mt-1 max-w-3xl text-sm leading-6 text-slate-600">Product and order tools are being added next. Once available, use this dashboard to update the catalog, confirm orders, and coordinate deliveries.</p>
                <div class="mt-4 flex flex-wrap gap-2">
                    @foreach (['Products', 'Orders', 'Categories', 'Delivery areas'] as $item)
                        <span class="rounded-lg border border-indigo-100 bg-white px-3 py-1.5 text-xs font-medium text-slate-600">{{ $item }} · coming soon</span>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</x-admin-layout>
