<?php

/*
|--------------------------------------------------------------------------
| Register The Laravel Class Loader
|--------------------------------------------------------------------------
|
| In addition to using Composer, you may use the Laravel class loader to
| load your controllers and models. This is useful for keeping all of
| your classes in the "global" namespace without Composer updating.
|
*/

ClassLoader::addDirectories(array(

	app_path().'/commands',
	app_path().'/controllers',
	app_path().'/models',
	app_path().'/database/seeds',

));

/*
|--------------------------------------------------------------------------
| Application Error Logger
|--------------------------------------------------------------------------
|
| Here we will configure the error logger setup for the application which
| is built on top of the wonderful Monolog library. By default we will
| build a rotating log file setup which creates a new file each day.
|
*/

$logFile = 'log-'.php_sapi_name().'.txt';

Log::useDailyFiles(storage_path().'/logs/'.$logFile);

/*
|--------------------------------------------------------------------------
| Application Error Handler
|--------------------------------------------------------------------------
|
| Here you may handle any errors that occur in your application, including
| logging them or displaying custom views for specific errors. You may
| even register several error handlers to handle different types of
| exceptions. If nothing is returned, the default error view is
| shown, which includes a detailed stack trace during debug.
|
*/

App::error(function(Exception $exception, $code)
{
    $pathInfo = Request::getPathInfo();
    $message = $exception->getMessage() ?: 'Exception';
    Log::error("$code - $message @ $pathInfo\r\n$exception");
    
    if (Config::get('app.debug')) {
    	return;
    }

    switch ($code)
    {
        case 403:
            return Response::view('error/403', array(), 403);

        case 500:
            return Response::view('error/500', array(), 500);

        default:
            return Response::view('error/404', array(), $code);
    }
});

/*
|--------------------------------------------------------------------------
| Maintenance Mode Handler
|--------------------------------------------------------------------------
|
| The "down" Artisan command gives you the ability to put an application
| into maintenance mode. Here, you will define what is displayed back
| to the user if maintenace mode is in effect for this application.
|
*/

App::down(function()
{
	return Response::make("Be right back!", 503);
});
App::setLocale(Session::get('lang', 'vi'));

/**
* imtoantran 
*/ 
Review::creating(function($review){
    if(Auth::guest()) return Response::json(['success'=>false]);
    $location = $review->location;
    $owner = $location->owner;    
    if(Auth::id() == $owner->id) return Response::json(['success'=>false]);    
    $user = Auth::user();
    Firebase::push("/notifications/new/$owner->id/general-notifications",['l'=>'','t'=>'review','text'=>"<b>".$user->display_name().'</b> đã đánh giá địa điểm của bạn.','author'=>Auth::user(),'timestamp'=>date("Y-m-d h:i:s")]);
});
function _type($type)
{
            switch ($type) {
                case 'comment':
                    return "bình luận";
                    break;
                case 'review':
                    return "đánh giá";
                    break;
                case 'status':
                    return 'trạng thái';
                default:
                    # code...
                    break;
            }    
return 'hoạt động';
}
$_ = function($object){
    if(Auth::guest()) return;
    $user = Auth::user();
    $type = "hoạt động";
    $action = "yêu thích";    
    $owner;
    $url='';
    switch (get_class($object)) {
        case 'Like':
            $location = $object->location;
            $owner = $location->owner;
            if($user->id == $owner->id) return;
            $url = $location->url();
            $type = "địa điểm";
            break;
        case 'Checkin':
            $location = $object->location;
            $owner = $location->owner;
            if($user->id == $owner->id) return;
            $url = $location->url();
            $action = "checkin";
            $type = "địa điểm";
            break;
        case 'PostMeta':
            $post = $object->post;
            $owner = $post->author;
            if($user->id == $owner->id) return;
            $type = _type($post->post_type);
            break;
        case "Comment":
            $post = $object->post;
            $owner = $post->author;
            if($user->id == $owner->id) return;
            $action = "bình luận";
            $type = _type($post->post_type);
            break;
        default:
            return;
            break;
    }    
    $text = "<b>".$user->display_name()."</b> $action $type của bạn";
    Firebase::push("/notifications/new/$owner->id/general-notifications",['url'=>$url,'object'=>$object,'type'=>get_class($object),'text'=>$text,'author'=>$user,'timestamp'=>date("Y-m-d h:i:s")]);    
};
Like::saved($_);
Checkin::saved($_);
Comment::saved($_);
Event::listen('like',$_);
/*
|--------------------------------------------------------------------------
| Require The Filters File
|--------------------------------------------------------------------------
|
| Next we will load the filters file for the application. This gives us
| a nice separate location to store our route and application filter
| definitions instead of putting them all in the main routes file.
|
*/

require __DIR__.'/../filters.php';

/*
|--------------------------------------------------------------------------
| Require The Composers
|--------------------------------------------------------------------------
|
*/

require __DIR__.'/../composers.php';
