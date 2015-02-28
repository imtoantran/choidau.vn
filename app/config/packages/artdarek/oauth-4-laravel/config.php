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
			'client_id'     => '727541704163-kmbu7j23pah3sabt17a0fd1586vdc393.apps.googleusercontent.com',
			'client_secret' => 'eXppj6Nat2Hwhu7k3NVRoV-s',
			'scope'         => array('userinfo_email', 'userinfo_profile'),
		),

	)

);