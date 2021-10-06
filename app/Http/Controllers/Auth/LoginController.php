<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite; //tambahkan library socialite

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email:dns',
            'password' => 'required|string|min:8',
        ], [
            // Custom error messages here...
        ]);

        if (auth()
            ->attempt(array(
                'email' => $input['email'],
                'password' => $input['password']
            ))
        ) {
            // kalo admin
            if (auth()->user()->is_admin == 1) {
                return redirect()
                    ->route('admin.home')
                    ->with('success', 'Login Success!');
            }
            // kalo user
            else {
                return redirect()
                    ->route('home')
                    ->with('success', 'Login Success!');
            }
        } else {
            return redirect()
                ->route('login')
                ->with('error', 'Email or Password is wrong!');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback(Request $request)
    {
        try {
            // $user_google menyimpan data google account seperti email, foto, dsb
            $user_google    = Socialite::driver('google')->user();
            $user           = User::where('email', $user_google->getEmail())->first();

            if ($user != null) {
                // jika user ada maka langsung di redirect ke halaman home
                \auth()->login($user, true);
                return redirect()->route('home');
            } else {
                // jika user tidak ada maka simpan ke database
                $create = User::Create([
                    'email'             => $user_google->getEmail(),
                    'name'              => $user_google->getName(),
                    'username'          => substr($user_google->getEmail(), 0, -10),
                    'password'          => bcrypt(0),
                    'email_verified_at' => now()
                ]);

                User::where('email', $user_google->getEmail())->update([
                    'is_google'         => 1
                ]);

                \auth()->login($create, true);
                return redirect()
                    ->route('home')
                    ->with('success', 'Login Success!');
            }
        } catch (\Exception $e) {
            return redirect()
                ->route('login')
                ->with('error', 'Login Error!');
        }
    }
}
