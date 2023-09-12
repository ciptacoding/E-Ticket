<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:15|min:8|unique:users,name',
            'nik' => 'required|string|max:16|min:16|unique:users,nik',
            'email' => 'required|string|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $nik = $request->nik; 
        $result = \NikReader::read($nik);
        
        // dd($result);
        if (true === $result->valid) {
            $user = User::create([
                'name' => $request->name,
                'nik' => $request->nik,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        } else {
            return back()->with('message', 'Nik not valid');
        }

        
        event(new Registered($user));

        // Auth::login($user);
        // return redirect(RouteServiceProvider::HOME);

        return redirect('/login')->with('message', 'Please verify your email address to complete the registration process. Click the link below to confirm your email and gain full access to our platform.');
    }
}
