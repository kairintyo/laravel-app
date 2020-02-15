<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;// 追加！
use Illuminate\Http\Request;// 追加！
use Illuminate\Support\Facades\DB;

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
    public function redirectToProvider()// 追加！
    {
        return Socialite::driver('github')->scopes(['read:user', 'public_repo'])->redirect(); 
    }

    /**
     * GitHubからユーザー情報を取得
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(Request $request)
    {
        $github_user = Socialite::driver('github')->user();

        $now = date("Y/m/d H:i:s");
        $app_user = User::select()
                        ->where("github_id", $github_user->user['login'])
                        ->first();
        if (empty($app_user)) {
            User::insert([
                "github_id" => $github_user->user['login'],
                "created_at" => $now,
                "updated_at" => $now
            ]);

            $app_user = User::select()
                            ->where("github_id", $github_user->user['login'])
                            ->first();
        }



        $request->session()->put('github_token', $github_user->token);

        Auth::login($app_user, true);

        return redirect('home');
    }

    public function logout(Request $request)
    {
        // Logout using laravel
        Auth::logout();

        // $info = $request->session();
        // $info = $request->user();
        // // $info = Auth::user();
        // // $info = Auth::check();

        return redirect('/');
        // return view('main/login', ['info' => var_dump($info)]);
    }
}
