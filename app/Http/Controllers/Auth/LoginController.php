<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function createRegister(){
        return view('auth.register');
    }

    public function register(Request $request){
        $validate = $request->validate(
            [
            'name' => [
                'required', 
                'string', 
                'max:255'
                ],

            'email' => [
                'required', 
                'string',
                'max:255',
                'email', 
                'unique:users,email'
                ],

            'password' => [
                'required',
                'string', 
                'min:8',
                'confirmed',
            ]
            ]
        );

        User::create([
            'name' => $validate['name'],
            'email' => $validate['email'],
            'password' => Hash::make($validate['password']),
        ]);

        return redirect()
        ->route('login')
        ->with(
            'success', 
            'Registro exitoso. Por favor, inicia sesión.'
        );
    }

    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()
            ->withErrors([
            'email' => 'Las credenciales proporcionadas no son válidas.',
        ])
        ->onlyInput('email');
    }
    $request->session()->regenerate();

    return redirect()->intended(route('dashboard'));
    }
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}