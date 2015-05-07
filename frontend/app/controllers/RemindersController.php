<?php

class RemindersController extends Controller {

	/**
	 * Display the password reminder view.
	 *
	 * @return Response
	 */
	public function getRemind()
	{
		return View::make('pages.password.remind', array('title' => 'forgotpassword'));
	}

	/**
	 * Handle a POST request to remind a user of their password.
	 *
	 * @return Response
	 */
	public function postRemind()
	{
		$rules = array(
			    'email'    => 'required|email', // make sure the email is an actual email
			);

			// run the validation rules on the inputs from the form
			$validator = Validator::make(Input::all(), $rules);

			// if the validator fails, redirect back to the form
			if ($validator->fails()) {
			    return Redirect::to('password/remind')
			        ->withErrors($validator); // send back all errors to the login form
			} else {
				switch ($response = Password::remind(Input::only('email')))
				{
					case Password::INVALID_USER:
						return Redirect::back()
								->withErrors(['error'=> Lang::get($response) ])
								->withInput();

					case Password::REMINDER_SENT:
						return Redirect::back()
						->with('success', 'An email with the password reset has been sent to ' . Input::get('email') )//Lang::get($response))
						;
				}
			}
	}

	/**
	 * Display the password reset view for the given token.
	 *
	 * @param  string  $token
	 * @return Response
	 */
	public function getReset($token = '')
	{
		
		return View::make('pages.password.reset', 
							array('title' => 'forgotpassword') 
						)->with('token', $token);
	}

	/**
	 * Handle a POST request to reset a user's password.
	 *
	 * @return Response
	 */
	public function postReset()
	{
		$token = Input::get('token');
		Input::flashExcept('password');
		
		$rules = array(
			    'email'    => 'required|email', // make sure the email is an actual email
			    'password'    => 'required|confirmed', // 
			    'password_confirmation'    => 'required', // 
			    'token'    => 'required', // 
			);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
		    return Redirect::to('password/reset')
		        ->withErrors($validator) // send back all errors to the login form
		        ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
		} else {

			$credentials = Input::only(
				'email', 'password', 'password_confirmation', 'token'
			);

			$response = Password::reset($credentials, function($user, $password)
			{
				$user->password = Hash::make($password);

				$user->save();
			});

			switch ($response)
			{
				case Password::INVALID_PASSWORD:
				case Password::INVALID_TOKEN:
				case Password::INVALID_USER:
					return Redirect::back()->withErrors(['error'=> Lang::get($response) ]);

				case Password::PASSWORD_RESET:
					return Redirect::back()->withErrors(['error'=> "Password is successfully reset" ]);
					
			}
		}
	}

}
