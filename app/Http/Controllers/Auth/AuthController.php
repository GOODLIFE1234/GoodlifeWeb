<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Validator;

class AuthController extends Controller
{
/*
|--------------------------------------------------------------------------
| Registration & Login Controller
|--------------------------------------------------------------------------
|
| This controller handles the registration of new users, as well as the
| authentication of existing users. By default, this controller uses
| a simple trait to add these behaviors. Why don't you explore it?
|
 */
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    protected $username = 'username';
/**
 * Where to redirect users after login / registration.
 *
 * @var string
 */
    protected $redirectTo          = '/';
    protected $redirectAfterLogout = '/login';
/**
 * Create a new authentication controller instance.
 *
 * @return void
 */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }
/**
 * Get a validator for an incoming registration request.
 *
 * @param  array  $data
 * @return \Illuminate\Contracts\Validation\Validator
 */
    protected function validator(array $data)
    {
        $messages = [
            'username.required'              => 'Username are missing',
            'username.unique'                => 'Username are duplicate',
            'email.required'                 => 'Email are missing',
            'password.required'              => 'Password are missing',
            'password.confirmed'             => 'Confirm password are incorrect',
            'password_confirmation.required' => 'Confirm password are missing ',
        ];
        return Validator::make($data, [
            'username'              => 'required|max:255|unique:users,username',
            'email'                 => 'required|email|max:255|unique:users',
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
        ], $messages);
    }
/**
 * Create a new user instance after a valid registration.
 *
 * @param  array  $data
 * @return User
 */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->loginUsername() => 'required', 'password' => 'required',
        ], [
            'username.required' => 'Username are missing',
            'password.required' => 'Password are missing',
        ]);
    }
}
