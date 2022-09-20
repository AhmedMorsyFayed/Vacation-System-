<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

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
    public function redirectTo(){
        return './register';

    }
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        // $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */


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
            'employeenumber'=> ['required', 'string', 'max:255','unique:users'],
            'name' => ['required', 'string', 'max:255','unique:users'],
            'username' => ['string','max:255', 'unique:users'],
            'email' => [  'max:255',null],
            'company'=> ['required', 'string', 'max:255'],
            'Department' => ['required', 'string', 'max:255'],
            'Manager' => [ 'string', 'max:255'],
            'Manageremail' => ['required', 'string', 'email', 'max:255'],
            'level' => ['required', 'string', 'max:255'],
           'vacationsbalance' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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
        return User::create([
            'employeenumber'=> $data['employeenumber'],
            'name' => $data['name'],
            'username'=>$data['username'],
            'email'=>$data['email'],
            'company'=>$data['company'],
            'Department' => $data['Department'],
            'Manager' => $data['Manager'],
            'Manageremail'=>$data['Manageremail'],
            'level' => $data['level'],
            'vacationsbalance' => $data['vacationsbalance'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
