<?php

class AuthController extends BaseController {
	public function showLogin(){
		if ( Auth::check() ){
			return Redirect::to('/account');
		}else{
		    // show the form
		    return View::make('pages.auth.auth', array('title' => 'login'));
		}
	}

	public function doLogout(){
		Auth::logout();
		// validation not successful, send back to form 
        return Redirect::to('auth/login');
        	//->withErrors('Email and ') // send back all errors to the login form
        	//->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
			
	}

	public function doLogin(){
		// validate the info, create rules for the inputs
		if ( Auth::check() ){
			return Redirect::to('/account');
		}else{
			$rules = array(
			    'email'    => 'required|email', // make sure the email is an actual email
			    'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
			);

			// run the validation rules on the inputs from the form
			$validator = Validator::make(Input::all(), $rules);

			// if the validator fails, redirect back to the form
			if ($validator->fails()) {
			    return Redirect::to('auth/login')
			        ->withErrors($validator) // send back all errors to the login form
			        ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
			} else {

			    // create our user data for the authentication
			    $userdata = array(
			        'email'     => Input::get('email'),
			        'password'  => Input::get('password')
			    );

			    // attempt to do the login
			    if (Auth::attempt($userdata)) {

			        // validation successful!
			        // redirect them to the secure section or whatever
			        // return Redirect::to('secure');
			        // for now we'll just echo success (even though echoing in a controller is bad)
			        return Redirect::to('/account');

			    } else {        

			        // validation not successful, send back to form 
			        return Redirect::to('auth/login')
			        	->withErrors(['custom'=> 'Email and Password don\'t match' ]) // send back all errors to the login form
			        	->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
			

			    }
			}
		}
	}

} // END OF THE CLASS
?>