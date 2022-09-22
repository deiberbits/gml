<?php

namespace App\Http\Controllers\Auth;

use App\Category;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
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

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        //Get list of categories
        $categories = Category::all();
        //Get list of countries
        $countries = getCountries();

        return view('auth.register', compact('categories', 'countries'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:100', 'min:5', 'regex:/^[a-zA-Z ]+$/'],
            'last_name' => ['required', 'string', 'max:100', 'regex:/^[a-zA-Z ]+$/'],
            'email' => ['required', 'string', 'email', 'max:150', 'unique:users'],
            'identification' => ['required', 'string', 'max:20', 'unique:users', 'regex:/^[0-9]+$/'],
            'address' => ['required', 'string', 'max:180'],
            'phone' => ['required', 'string', 'size:10', 'regex:/^[0-9]+$/'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'country' => ['required'],
            'category' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'last_name' => $data['last_name'],
            'identification' => $data['identification'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'category_id' => $data['category'],
            'country' => $data['country']
        ]);
    }
}
