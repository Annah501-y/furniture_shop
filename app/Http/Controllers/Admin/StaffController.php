<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password as PasswordBroker;
use Illuminate\Support\Str;
use Throwable;
use Illuminate\View\View;

class StaffController extends Controller
{
    public function create(): View
    {
        return view('admin.staff.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $email = $request->input('email');
        $request->merge([
            'email' => is_string($email) ? strtolower(trim($email)) : $email,
        ]);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
        ]);

        $staff = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Str::random(64),
            'role' => 'staff',
        ]);

        try {
            $status = PasswordBroker::sendResetLink(['email' => $staff->email]);

            if ($status === PasswordBroker::RESET_LINK_SENT) {
                return redirect()
                    ->route('admin.staff.create')
                    ->with('status', 'Staff account created. A secure password setup link was emailed to the staff member.');
            }

            Log::warning('Staff password setup link was not sent.', [
                'user_id' => $staff->id,
                'status' => $status,
            ]);
        } catch (Throwable $exception) {
            Log::error('Staff password setup email failed.', [
                'user_id' => $staff->id,
                'exception' => $exception->getMessage(),
            ]);
        }

        return redirect()
            ->route('admin.staff.create')
            ->with('warning', 'The staff account was created, but its setup email could not be sent. Check the mail configuration, then have the staff member use “Forgot your password?” on the login page.');
    }
}
