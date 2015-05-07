<?php
 
//use Cribbb\Storage\User\UserRepository as User;
 
class RegisterController extends BaseController {
 
  

  public function index()
  {
    return View::make('pages.auth.register', array('title' => 'Register'));
  }
 


  public function store()
  {

  	$rules = array(
    'firstname'=>'required|alpha|min:2',
    'lastname'=>'required|alpha|min:2',
    'username'=>'required|min:2',
    'email'=>'required|email|unique:user',
    'password'=>'required|alpha_num|between:6,12|confirmed',
    'password_confirmation'=>'required|alpha_num|between:6,12'
    );

  	$validator = Validator::make(Input::all(), $rules);
 
    if ($validator->passes()) {
        // validation has passed, save user in DB
      $user = new User;
	    $user->first_name = Input::get('firstname');
	    $user->last_name = Input::get('lastname');
	    $user->username = Input::get('username');
      $user->email = Input::get('email');
      $user->password = Hash::make(Input::get('password'));
	    $user->settings = array();
      try {
	    	$user->save();
	    	return Redirect::route('auth.register.index')
	    		->withErrors(['custom'=> 'The new user has been created. You may login now.' ]);
	    } catch (Exception $e) {
	    	
	    return Redirect::route('auth.register.index')
	    		->withInput( Input::except('password') )
	    		->withErrors(['custom'=> 'username is already taken.' ]);
	    
	    }


    } else {
        // validation has failed, display error messages    
	    return Redirect::route('auth.register.index')
	      ->withInput( Input::except('password') )
	      ->withErrors($validator);
    }
 
  }
 
}