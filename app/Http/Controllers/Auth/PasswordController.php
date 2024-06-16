<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        // Update the user's password
        $user = $request->user();
        $passwordUpdated = $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        // If it's the first login, mark it as false
        if ($user->first_login) {
            $user->update([
                'first_login' => false,
            ]);
        }

        if ($passwordUpdated) {
            return back()->with('status', 'password-updated');
        } else {
            return back()->with(['current_password', 'password-not-updated']);
        }
    }
}
