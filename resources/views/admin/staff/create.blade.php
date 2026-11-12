<x-admin-layout title="Create staff account" active="staff">
    <div class="mb-7">
        <p class="text-xs font-semibold uppercase tracking-[0.14em] text-indigo-600">Team access</p>
        <h2 class="mt-2 text-2xl font-bold tracking-tight text-slate-900">Invite a staff member</h2>
        <p class="mt-1 text-sm text-slate-500">Create an operations account. The staff member sets their own password from an email link.</p>
    </div>

    @if (session('status'))
        <div role="status" class="mb-5 flex gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3.5 text-sm text-emerald-800">
            <svg class="mt-0.5 h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m5 12 4 4L19 6"/></svg>
            <p>{{ session('status') }}</p>
        </div>
    @endif

    @if (session('warning'))
        <div role="alert" class="mb-5 flex gap-3 rounded-xl border border-amber-200 bg-amber-50 px-4 py-3.5 text-sm text-amber-900">
            <svg class="mt-0.5 h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3 2.8 19h18.4L12 3Z"/><path stroke-linecap="round" d="M12 9v4m0 3h.01"/></svg>
            <p>{{ session('warning') }}</p>
        </div>
    @endif

    @if ($errors->any())
        <div role="alert" class="mb-5 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800">
            <p class="font-semibold">Please review the information below.</p>
            <ul class="mt-1 list-inside list-disc">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid gap-6 xl:grid-cols-[minmax(0,1.4fr)_minmax(280px,0.75fr)]">
        <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm shadow-slate-200/40 sm:p-7">
            <div class="mb-6 border-b border-slate-100 pb-5">
                <h3 class="text-base font-semibold text-slate-900">Staff details</h3>
                <p class="mt-1 text-sm text-slate-500">The email address will be used for sign-in and password setup.</p>
            </div>

            <form method="POST" action="{{ route('admin.staff.store') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700">Full name</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus autocomplete="name"
                           placeholder="e.g. Amina Hassan"
                           class="mt-1.5 block w-full rounded-xl border-slate-300 px-3.5 py-2.5 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-500 focus:ring-indigo-500">
                    @error('name') <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700">Work email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email"
                           placeholder="name@example.com"
                           class="mt-1.5 block w-full rounded-xl border-slate-300 px-3.5 py-2.5 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-500 focus:ring-indigo-500">
                    @error('email') <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p> @enderror
                    <p class="mt-1.5 text-xs text-slate-500">Use an address the staff member can access.</p>
                </div>

                <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:items-center sm:justify-between">
                    <a href="{{ route('admin.dashboard') }}" class="inline-flex justify-center rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">Cancel</a>
                    <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm shadow-indigo-200 transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M16 20v-1.5a4.5 4.5 0 0 0-4.5-4.5h-3A4.5 4.5 0 0 0 4 18.5V20M10 10a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7ZM19 8v6M16 11h6"/></svg>
                        Create staff account
                    </button>
                </div>
            </form>
        </section>

        <aside class="space-y-4">
            <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm shadow-slate-200/40">
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><rect x="4" y="3" width="16" height="18" rx="2"/><path stroke-linecap="round" stroke-linejoin="round" d="M8 8h8M8 12h8M8 16h4"/></svg>
                </span>
                <h3 class="mt-4 text-sm font-semibold text-slate-900">What happens next</h3>
                <ol class="mt-3 space-y-3 text-sm text-slate-600">
                    <li class="flex gap-3"><span class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-slate-100 text-xs font-semibold text-slate-600">1</span><span>The account is created with staff permissions.</span></li>
                    <li class="flex gap-3"><span class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-slate-100 text-xs font-semibold text-slate-600">2</span><span>A time-limited password setup link is sent to their email.</span></li>
                    <li class="flex gap-3"><span class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-slate-100 text-xs font-semibold text-slate-600">3</span><span>They set a password and sign in to the staff workspace.</span></li>
                </ol>
            </section>

            <section class="rounded-2xl border border-blue-100 bg-blue-50/70 p-5">
                <h3 class="text-sm font-semibold text-blue-950">Access and security</h3>
                <p class="mt-1.5 text-sm leading-6 text-blue-900/75">Staff accounts can use the operations workspace. Only administrators can create staff accounts and manage system access.</p>
                <p class="mt-3 border-t border-blue-100 pt-3 text-xs leading-5 text-blue-900/70">Before launch, configure production email delivery so setup links reach staff inboxes.</p>
            </section>
        </aside>
    </div>
</x-admin-layout>
