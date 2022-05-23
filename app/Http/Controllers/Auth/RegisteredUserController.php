<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use PhpParser\Node\Stmt\Else_;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'login' => ['required', 'string', 'max:255','unique:users,email','unique:users,phone'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $email = $request->login;
        $phone = null;
        $email_verified_at = null;

        if(!strpos($request->login,"@"))
        {
            $email_verified_at = Carbon::now();
            $email = null;
            $phone = $request->login;
        }else{
            $request->validate(['login' => ['email']]);
        }

        $user = User::create([
            'name' => $request->name,
            'phone' => $phone,
            'email'=> $email,
            'role' => 'user',
            'avatar' => 'user',
            'email_verified_at' => $email_verified_at,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        //
        return redirect(RouteServiceProvider::DASHBOARD);
    }
}
