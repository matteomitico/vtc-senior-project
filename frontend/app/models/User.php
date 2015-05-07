<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	private static $base_settings = array(
			'address1'   => array('value' => '', 'required' => 'required|min:3') ,
			'address2'   => array('value' => '', 'required' => ''),
			'city'       => array('value' => '', 'required' => 'required|alpha_num|min:2'),
			'zip'        => array('value' => '', 'required' => 'required|alpha_num|min:2'),
			'country'    => array('value' => '', 'required' => 'required|min:2'),
			'phone'      => array('value' => '', 'required' => 'required|alpha_num|min:2')
		); 
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	protected $fillable = array('first_name', 'last_name', 'email', 'password', 'username');

	//protected $guarded = array('id', 'token');
        
    public function getIsAdminAttribute(){

	    return $this->attributes['admin'] == 1;
	}

   	//settings requirments
    public static function getSettingsRequirments(){
    	
    	$base = self::$base_settings;
    	$result = array();

    	foreach ($base as $key => $value) {
    		$result[$key] = $base[$key]['required'];
    	}
 		return $result;
    }

    //settings accessor; 
    //settings are stored as json string on the database. This function turn the json to array
    public function getSettingsAttribute( $settings_json ){

    	$settings = json_decode($settings_json);       // settings come from database
    	
    	$base = self::$base_settings;
    	$result = array();

    	foreach ($base as $key => $value) {
    		$result[$key] = $base[$key]['value'];   // result['address1'] = base['address1']['value']
    		
            if ( isset($settings->$key) && is_string($settings->$key) ){            // override the values with what came from the databse. drops the values that are not necessary anymore
    			$result[$key] = $settings->$key;
    		}
    	}

 		return $result;
    }

    //settings mutator 
    // This function turn the setting array into json string before save it in the database
    public function setSettingsAttribute( $settings ){

    	$base = self::$base_settings;
        $result = array();

    	foreach ($base as $key => $value) {  //for each key in the base
            $result[$key] = $settings; //$base[$key]['value'];
    		if ( isset($settings[$key]) ){
    			$result[$key] = $settings[$key];
    		}
    	}

 		$this->attributes['settings'] = json_encode($result);
    }

    // public function getDefaultSettings(){

    // 	return $default_settings;
    // }
    // public function save(array $options = array()){
    // 	$this->settings = serialize($this->settings);
    // 	parent::save();

    // }

}
