<?php

class ProfileController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showProfile($edit = false)
	{
		// $settings = new UserSettings();
		// print_r ($settings->get_fields());

		$disabled = ($edit) ? '' : 'disabled';
		return View::make('pages.profile', array('title' => 'profile'))
		->with('edit', $edit)
		->with('disabled', $disabled)
		->with('user', Auth::user() );

	}

	public function showEditProfile()
	{
		return $this->showProfile(true);
	}

	public function editProfile()
	{

		$rules = array(
		'firstname'=>'required|alpha|min:2',
		'lastname'=>'required|alpha|min:2',
		//'password'=>'required|alpha_num|between:6,12|confirmed',
		//'password_confirmation'=>'required|alpha_num|between:6,12'
		);
		$settings_requirments = User::getSettingsRequirments();
		foreach ($settings_requirments as $key => $value) {
			$rules[$key] = $value;	
		}
		//return print_r($rules, true);
			$validator = Validator::make(Input::all(), $rules);

		if ($validator->passes()) {
		    // validation has passed, save user in DB
		    $user = Auth::user();
		    $user->first_name = Input::get('firstname');
		    $user->last_name = Input::get('lastname');
		    $settings = array();
		    $res = print_r($settings_requirments, true). '    ';
		    foreach (Input::all() as $key => $value) {
		    	if (array_key_exists($key, $settings_requirments)){
		    		$res .= "  $key bbb $value";
		    		$settings[$key] = Input::get($key);
		    	}
		    }
		    $user->settings = $settings;
		  try {
		    	$user->save();
		    	return Redirect::route('profile')
		    		->withErrors(['custom'=> 'Profile has updated' ]);
		    } catch (Exception $e) {
		    	
		    	return Redirect::route('profile.edit')
		    		->withInput( Input::except('password') )
		    		->withErrors(['custom'=> $e->getMessage() ]);
		    
		    }


		} else {
		    // validation has failed, display error messages    
		    return Redirect::route('profile.edit')
		      ->withInput( Input::except('password') )
		      ->with( 'rules' , $rules )
		      ->withErrors($validator);
		}

	}
		        

}
