<?php

class VMController extends BaseController {

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

	private $vmTypes = array(
						'nodejs' => 'NodeJS', 
						'postgresql' => 'PostgreSQL',
						'lamp' => 'LAMP Stack',
						'rails' => 'Ruby on Rails'
						);

	private $ssh_Log = '';
	public function showAllVM() 
	{
		
		SSH::into('debian')->run(array(
			'cd ~/cluster/python-scripts',
			//'ls -all',
			'python get_all_vms.py ' . Auth::user()->username,
			//'git config --global credential.helper cache',
			//'git pull origin master'
		), function($line){
		 
			//'deploying @ ' . date('Y-m-d: H:i:s') ."<br/>";; 
			 $this->ssh_Log .= $line.PHP_EOL; // outputs server feedback
		});

		$vms = json_decode( $this->ssh_Log);
		foreach ($vms as $vm) {
			$vm->description = $this->make_a_link($vm->description, true);
		}

		return View::make('pages.vm.vmall', 
						array('title' => 'VM')
						)->with('vms', $vms)
		 				->with('time', date("Y-m-d H:i:s") );
	}

	public function showVMbyId($vmid = null)
	{
		// return View::make('hello');
		if ( is_null($vmid) ){
			return $this->showAllVM(); // View::make('pages.vm.vmall', array('title' => 'VM'));
		}else{
			return View::make('pages.vm.vmprofile', 
							array('title' => 'VM')
						)->with('vmid', $vmid);
		}
		
	}

	public function addVMShowForm()
	{
	
		return View::make('pages.vm.vmadd', 
							array('title' => 'VM')
						)->with('vmTypes', $this->vmTypes);
   		
	}

	public function startVM($vm_name)
	{
		if(isset($vm_name) && trim($vm_name) !== ''){
			SSH::into('debian')->run(array(
			'VBoxManage startvm ' . $vm_name . ' --type headless'
			//'git config --global credential.helper cache',
			//'git pull origin master'
		), function($line){
		 
			//'deploying @ ' . date('Y-m-d: H:i:s') ."<br/>";; 
			 $this->ssh_Log .= $line.PHP_EOL; // outputs server feedback
		});
		}
		return Redirect::to('/vm/show');
   		
	}

	public function stopVM($vm_name)
	{
		if(isset($vm_name) && trim($vm_name) !== ''){
			SSH::into('debian')->run(array(
			'VBoxManage controlvm ' . $vm_name . ' poweroff'
			//'git config --global credential.helper cache',
			//'git pull origin master'
		), function($line){
		 
			//'deploying @ ' . date('Y-m-d: H:i:s') ."<br/>";; 
			 $this->ssh_Log .= $line.PHP_EOL; // outputs server feedback
		});
		}
		return Redirect::back();
   		
	}

	public function deleteVM($vm_name)
	{
		if(isset($vm_name) && trim($vm_name) !== ''){
			SSH::into('debian')->run(array(
			'VBoxManage unregistervm ' . $vm_name . ' --delete'
			//'git config --global credential.helper cache',
			//'git pull origin master'
		), function($line){
		 
			//'deploying @ ' . date('Y-m-d: H:i:s') ."<br/>";; 
			 $this->ssh_Log .= $line.PHP_EOL; // outputs server feedback
		});
		}
		return Redirect::back();
   		
	}


	public function pauseVM($vm_name)
	{
		if(isset($vm_name) && trim($vm_name) !== ''){
			SSH::into('debian')->run(array(
			'VBoxManage controlvm ' . $vm_name . ' pause'
			//'git config --global credential.helper cache',
			//'git pull origin master'
		), function($line){
		 
			//'deploying @ ' . date('Y-m-d: H:i:s') ."<br/>";; 
			 $this->ssh_Log .= $line.PHP_EOL; // outputs server feedback
		});
		}
		return Redirect::back();
   		
	}

	public function resumeVM($vm_name)
	{
		if(isset($vm_name) && trim($vm_name) !== ''){
			SSH::into('debian')->run(array(
			'VBoxManage controlvm ' . $vm_name . ' resume'
			//'git config --global credential.helper cache',
			//'git pull origin master'
		), function($line){
		 
			//'deploying @ ' . date('Y-m-d: H:i:s') ."<br/>";; 
			 $this->ssh_Log .= $line.PHP_EOL; // outputs server feedback
		});
		}
		return Redirect::back();
   		
	}

	private $createvm = '';
	
	public function addVMProcess()
	{		
		$rules = array(
			'vmName' => 'required|alpha_dash|min:6'
			);
		$validator = Validator::make(Input::all(), $rules);
 		//return 'python get_all_vms.py ' . Input::get('vmType') . ' ' .  Input::get('vmName');
   		if ($validator->passes()) {
			$res = Input::all();
			//$vm = new Vm();
			//$vm->name = Auth::user()->username . '-' . Input::get('vmName');
			try {
		    	//$vm->save();
		    	// try{
		    		SSH::into('debian')->run(array(
		    				'cd ~/cluster/python-scripts',
								//'ls -all',
								'python add_vm.py ' . Input::get('vmType') . ' ' . Auth::user()->username . '-' . Input::get('vmName'),
								//'VBoxManage --nologo import ./' . $vms[Input::get('vmType')]['file'] . ' --vsys 0 --vmname ' . $vm->name . ' --wait-exit --wait-stdout',
							
						), function($line){
						 
							//'deploying @ ' . date('Y-m-d: H:i:s') ."<br/>";; 
							$this->createvm .= $line.PHP_EOL . '</br>'; // outputs server feedback
						});
		    		if ($this->createvm === 1){

		    		}
		    		return Redirect::route('vm.add.showForm')
			    		->withErrors(['custom'=> 'The new VM has been created. ' . $this->createvm ]);
		    	// }
		    	
			} catch (Exception $e) {
			    	
			    return Redirect::route('vm.add.showForm')
			    		->withInput( )
			    		->withErrors(['custom'=> $e->getMessage() ]);//'Vm with this name is already created.' ]);
			    
			    }

				return addVMShowForm();
   		}else{
   			return Redirect::route('vm.add.showForm')
		      ->withInput()
		      ->withErrors($validator);
   		}
		
				
	}
            
 
}
