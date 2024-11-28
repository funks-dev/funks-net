<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi input, termasuk first_name dan last_name
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Gabungkan first_name dan last_name menjadi full name
        $fullName = $request->first_name . ' ' . $request->last_name;

        // Simpan data user ke database
        $user = User::create([
            'name' => $fullName,  // Simpan hasil penggabungan ke 'name'
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Trigger event Registered setelah berhasil register
        event(new Registered($user));

        // Login user dan redirect ke login
        Auth::login($user);

        return redirect(route('login', absolute: false));
    }
}
