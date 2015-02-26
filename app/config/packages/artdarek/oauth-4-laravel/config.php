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
            'client_id'     => '813879558683621',
            'client_secret' => 'e97534d43f5e5aa478f5da65a5717cf7',
            'scope'         => array('email','read_friendlists','user_online_presence'),
        ),
		'Google' => array(
			'client_id'     => '906393778812-olufbb3rmsvh4jpkhop1v3koa2lm4n4d.apps.googleusercontent.com',
			'client_secret' => 'qIl1it1eM9MwQVjoejbG9nL_',
			'scope'         => array('userinfo_email', 'userinfo_profile'),
		),

	)

);