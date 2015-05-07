<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Default Remote Connection Name
	|--------------------------------------------------------------------------
	|
	| Here you may specify the default connection that will be used for SSH
	| operations. This name should correspond to a connection name below
	| in the server list. Each connection will be manually accessible.
	|
	*/

	'default' => 'production',

	/*
	|--------------------------------------------------------------------------
	| Remote Server Connections
	|--------------------------------------------------------------------------
	|
	| These are the servers that will be accessible via the SSH task runner
	| facilities of Laravel. This feature radically simplifies executing
	| tasks on your servers, such as deploying out these applications.
	|
	*/

	'connections' => array(

		'production' => array(
			'host'      => 's469569242.onlinehome.us',
			'username'  => 'u73311144',
			'password'  => 'Mortify3',
			'key'       => '',
			'keyphrase' => '',
			'root'      => '/var/www',
		),

		'debian' => array(
			'host'      =>  '155.42.97.220', //72.71.226.48', '155.42.13.162' ,
			//'155.42.84.31', //
			'username'  => 'cluster',
			'password'  => 'cluster',
			'key'       => '',
			'keyphrase' => '',
			'root'      => '/var/www',
		),


	),

	/*
	|--------------------------------------------------------------------------
	| Remote Server Groups
	|--------------------------------------------------------------------------
	|
	| Here you may list connections under a single group name, which allows
	| you to easily access all of the servers at once using a short name
	| that is extremely easy to remember, such as "web" or "database".
	|
	*/

	'groups' => array(

		'web' => array('production')

	),

);
