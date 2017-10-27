<?php

namespace App\Http\Controllers\Auth;

use App\Lawyer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LawyerRegistered;

class LawyerRegistrationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    public function showRegistrationForm()
    {
        return view('auth.lawyer-registration');
    }
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new LawyerRegistered($lawyer = $this->create($request->all())));

        $this->guard()->login($lawyer);

        return $this->registered($request, $lawyer)
                        ?: redirect($this->redirectPath());
    }
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/lawyer/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'gender' => 'required|bool',
            'phone' => 'required|string|max:255'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if ($data['gender']) {
            $image = 'public/defaults/avatars/male.png';
        } else {
            $image = 'public/defaults/avatars/female.png';
        }
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'location' => $data['location'],
            'image' => $image,
            'phone' => $data['phone'],
            'gender' => $data['gender'],
            'slug' => str_slug($data['name']),
            'password' => bcrypt($data['password']),
            'firm_name' => $data['firm_name'],
            'title' => $data['title'],
        ]);
    }
    protected function registered(Request $request, $lawyer)
    {
        //
    }
}
