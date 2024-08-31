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
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'username' => ['required', 'string', 'max:255'],
            'occupation' => ['required', 'string', 'max:255'],
            'gender' => ['required'],
            'profile_img' => ['image', 'mimes:png,jpg,svg,webp'],
        ]);



        if ($request->hasFile('profile_img')) {
            $img = $request->file('profile_img')->store('profiles', 'public');
        } else {
            $img = 'profiles/user.png';
        }


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'username' => $request->username,
            'occupation' => $request->occupation,
            'gender' => $request->gender,
            'profile_img' => $img,
        ]);

        event(new Registered($user));

        $user->assignRole('participant');

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
