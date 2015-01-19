<?php 


return array(

    /*
    |--------------------------------------------------------------------------
    | User Language Lines
    |--------------------------------------------------------------------------
    |
    |
    */
    'register'              => 'Register',
    'login'                 => 'Login',
    'login_first'           => 'Login first',
    'account'               => 'Account',
    'forgot_password'       => 'Forgot Password',
    'settings'              => 'Settings',
    'profile'               => 'Profile',
    'user_account_is_not_confirmed'          => 'User Account is not confirmed.',
    'user_account_updated'          => 'User Account updated.',
    'user_account_created'          => 'User Account created.',
    'username' => 'Username',
    'password' => 'Password',
    'password_confirmation' => 'Password Confirmation',
    'e_mail' => 'Email',
    'username_e_mail' => 'Username/ Email',

    'signup' => array(
        'title' => 'Signup',
        'desc' => 'Create new Acount',
        'confirmation_required' => 'Confirmation required',
        'submit' => 'Register',
    ),

    'login' => array(
        'title' => 'Login',
        'desc' => 'Enter your credentials',
        'forgot_password' => '(forgot password)',
        'remember' => 'Remember me',
        'submit' => 'Login',
    ),

    'forgot' => array(
        'title' => 'Forgot password',
        'submit' => 'Continue',
    ),

    'alerts' => array(
        'account_created' => 'Your account has been successfully created.',
        'instructions_sent'       => 'Please check your email for the instructions on how to confirm your account.',
        'too_many_attempts' => 'Too many attempts. Try again in few minutes.',
        'wrong_credentials' => 'Incorrect username, email or password.',
        'not_confirmed' => 'Your account may not be confirmed. Check your email for the confirmation link',
        'confirmation' => 'Your account has been confirmed! You may now login.',
        'password_confirmation' => 'The passwords did not match.',
        'wrong_confirmation' => 'Wrong confirmation code.',
        'password_forgot' => 'The information regarding password reset was sent to your email.',
        'wrong_password_forgot' => 'User not found.',
        'password_reset' => 'Your password has been changed successfully.',
        'wrong_password_reset' => 'Invalid password. Try again',
        'wrong_token' => 'The password reset token is not valid.',
        'duplicated_credentials' => 'The credentials provided have already been used. Try with different credentials.',
    ),

    'email' => array(
        'account_confirmation' => array(
            'subject' => 'Account Confirmation',
            'greetings' => 'Hello :name',
            'body' => 'Please access the link below to confirm your account.',
            'farewell' => 'Regards',
        ),

        'password_reset' => array(
            'subject' => 'Password Reset',
            'greetings' => 'Hello :name',
            'body' => 'Access the following link to change your password',
            'farewell' => 'Regards',
        ),
    ),
);