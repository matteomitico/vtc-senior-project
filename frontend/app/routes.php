<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('pages.home', array('title' => 'home'));
});

Route::get('home', function()
{
    return View::make('pages.home', array('title' => 'home'));
});

// Route::get('about', function()
// {
//     return View::make('pages.about', array('title' => 'about'));
// });
Route::get('about', 'AboutController@showAbout');

Route::get('products', function()
{
    return View::make('pages.products', array('title' => 'products'));
});

Route::get('support', function()
{
    return View::make('pages.support', array('title' => 'support'));
});

Route::get('contact', 
  ['as' => 'contact', 'uses' => 'AboutController@create']);
Route::post('contact', 
  ['as' => 'contact_store', 'uses' => 'AboutController@store']);



// ===================  PROTECTED ROUTES 
Route::get('account', array('before' => 'auth', 'uses' => 'AccountController@showAccount'));

Route::get('profile', array('before' => 'auth', 'uses' => 'ProfileController@showProfile', 'as' => 'profile'));
Route::get('profile/edit', array('before' => 'auth', 'uses' => 'ProfileController@showEditProfile', 'as' => 'profile.edit'));
Route::post('profile/edit', array('before' => 'auth', 'uses' => 'ProfileController@editProfile'));

//Route::get('vm', array('before' => 'auth', 'uses' => 'VMController@showAllVM'));

Route::get('vm/show/{vm_id?}', array('before' => 'auth', 'uses' => 'VMController@showVMbyId'));
Route::get('vm/add', array('before' => 'auth', 'uses' => 'VMController@addVMShowForm', 'as' => 'vm.add.showForm'));
Route::post('vm/add', array('before' => 'auth', 'uses' => 'VMController@addVMProcess', 'as' => 'vm.add.process'));
Route::get('vm/start/{vm_name}', array('before' => 'auth', 'uses' => 'VMController@startVM', 'as' => 'vm.start'));
Route::get('vm/stop/{vm_name}', array('before' => 'auth', 'uses' => 'VMController@stopVM', 'as' => 'vm.stop'));
Route::get('vm/delete/{vm_name}', array('before' => 'auth', 'uses' => 'VMController@deleteVM', 'as' => 'vm.delete'));
Route::get('vm/pause/{vm_name}', array('before' => 'auth', 'uses' => 'VMController@pauseVM', 'as' => 'vm.pause'));
Route::get('vm/resume/{vm_name}', array('before' => 'auth', 'uses' => 'VMController@resumeVM', 'as' => 'vm.resume'));




Route::get('auth/register', array(
  'uses' => 'RegisterController@index', 'as' => 'auth.register.index' ));

Route::post('auth/register', array( 'uses' => 'RegisterController@store', 'as' => 'auth.register.store' ));

// route to show the login form
Route::get('auth/login', array('uses' => 'AuthController@showLogin','as' => 'auth.login'));

// route to process the form
Route::post('auth/login', array('uses' => 'AuthController@doLogin'));

// route to process the form
Route::get('auth/logout', array('uses' => 'AuthController@doLogout'));
// route to forgot password form 
Route::get('password/remind', array(
								'uses' => 'RemindersController@getRemind'
							));
Route::post('password/remind', array(
								'uses' => 'RemindersController@postRemind'
							));
Route::get('password/reset/{token?}', array(
								  'uses' => 'RemindersController@getReset'
								));
Route::post('password/reset', array(
								'uses' => 'RemindersController@postReset'
							));




if (file_exists(__DIR__.'/controllers/Server.php')) { // This is available only in development
	Route::get('/server/{action}', 'Server@action');
}
//


/*Blade::extend(function($view, $compiler)
	{
	    $pattern = $compiler->createMatcher('datetime:');

	    return preg_replace($pattern, '$1<?php echo $2->format(\'m/d/Y H:i\'); ?>', $view);
	});

*/