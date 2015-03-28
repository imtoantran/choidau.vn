<?php 

return array( 
	
	/*
	|--------------------------------------------------------------------------
	| oAuth Config
	|--------------------------------------------------------------------------
	*/

	/**
	 * Storage
	 */
	'storage' => 'Session', 

	/**
	 * Consumers
	 */
	'consumers' => array(

		/**
		 * Facebook
		 */
        'Facebook' => array(
            'client_id'     => '665277883595055',
            'client_secret' => 'b8adfd7bb048f875a4b8dec6da8f3d3d',
            'scope'         => array('email','read_friendlists','user_online_presence'),
        ),
		'Google' => array(
			'client_id'     => '906393778812-olufbb3rmsvh4jpkhop1v3koa2lm4n4d.apps.googleusercontent.com',
			'client_secret' => 'qIl1it1eM9MwQVjoejbG9nL_',
			'scope'         => array('userinfo_email', 'userinfo_profile'),
		),

	)

);