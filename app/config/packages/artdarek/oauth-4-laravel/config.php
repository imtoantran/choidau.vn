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
			'client_id'     => '103587534494-o2pp1aksvqh1ka50kbbg72a664adee0o.apps.googleusercontent.com',
			'client_secret' => 'VgOXvghBc14qNhAwfMeCrBxq',
			'scope'         => array('userinfo_email', 'userinfo_profile'),
		),

	)

);