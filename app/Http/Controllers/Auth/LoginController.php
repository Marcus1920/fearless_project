<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
	
	
	public function doLogin()
{
	
	$rules = array(
    'cellphone'    => 'required', // make sure the email is an actual email
    'password' => 'required' // password can only be alphanumeric and has to be greater than 3 characters
);

      $validator = Validator::make(Input::all(), $rules);
	  
	  
	  if ($validator->fails()) {
    return Redirect::to('login')
        ->withErrors($validator) // send back all errors to the login form
        ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
} else {

    // create our user data for the authentication
    $userdata = array(
        'cellphone'     => Input::get('cellphone'),
        'password'  => Input::get('password')
    );
}

			if (Auth::attempt($userdata)) {

        // validation successful!
        // redirect them to the secure section or whatever
         return Redirect::to('home');
        // for now we'll just echo success (even though echoing in a controller is bad)
        echo 'SUCCESS!';

    } else {        

        // validation not successful, send back to form 
        return Redirect::to('login');

    }

}
}