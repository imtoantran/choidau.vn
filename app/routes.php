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

/** ------------------------------------------
 *  Route model binding
 *  ------------------------------------------
 */
Route::model('user', 'User');
Route::model('comment', 'Comment');
Route::model('post', 'Post');
Route::model('role', 'Role');
Route::model('media', 'Media');

/** ------------------------------------------
 *  Route constraint patterns
 *  ------------------------------------------
 */
Route::pattern('comment', '[0-9]+');
Route::pattern('post', '[0-9]+');
Route::pattern('user', '[0-9]+');
Route::pattern('role', '[0-9]+');
Route::pattern('token', '[0-9a-z]+');


/** ------------------------------------------
 *  Admin Routes
 *  ------------------------------------------
 */
Route::group(array('prefix' => 'qtri-choidau'), function()
{

   /* Route::get('/', function()
    {
        return View::make('admin/home');
    });*/
    # Comment Management
    Route::get('comments/{comment}/edit', 'AdminCommentsController@getEdit');
    Route::post('comments/{comment}/edit', 'AdminCommentsController@postEdit');
    Route::get('comments/{comment}/delete', 'AdminCommentsController@getDelete');
    Route::post('comments/{comment}/delete', 'AdminCommentsController@postDelete');
    Route::controller('comments', 'AdminCommentsController');

    # Blog Management
    Route::get('blogs/{post}/show', 'AdminBlogsController@getShow');
    Route::get('blogs/{post}/edit', 'AdminBlogsController@getEdit');
    Route::post('blogs/{post}/edit', 'AdminBlogsController@postEdit');
    Route::get('blogs/{post}/delete', 'AdminBlogsController@getDelete');
    Route::post('blogs/{post}/delete', 'AdminBlogsController@postDelete');
    Route::controller('blogs', 'AdminBlogsController');
    /* imtoantran start */
    Route::controller('blog', 'AdminBlogsController');
    /* imtoantran end */

    # User Management
    Route::get('users/{user}/show', 'AdminUsersController@getShow');
    Route::get('users/{user}/edit', 'AdminUsersController@getEdit');
    Route::post('users/{user}/edit', 'AdminUsersController@postEdit');
    Route::get('users/{user}/delete', 'AdminUsersController@getDelete');
    Route::post('users/{user}/delete', 'AdminUsersController@postDelete');
    Route::controller('users', 'AdminUsersController');

    # User Role Management
    Route::get('roles/{role}/show', 'AdminRolesController@getShow');
    Route::get('roles/{role}/edit', 'AdminRolesController@getEdit');
    Route::post('roles/{role}/edit', 'AdminRolesController@postEdit');
    Route::get('roles/{role}/delete', 'AdminRolesController@getDelete');
    Route::post('roles/{role}/delete', 'AdminRolesController@postDelete');
    Route::controller('roles', 'AdminRolesController');

    # Admin Dashboard
    Route::controller('/das', 'AdminDashboardController');
  //  Route::get('/', 'AdminDashboardController');
     Route::controller('/', 'AdminHomeController');

});

/* imtoantran start */
Route::group(array('prefix' => 'post'), function() {
 /* video */
 Route::get('video/{slug}/edit', 'VideoController@getEdit');
 Route::post('video/{slug}/edit', 'VideoController@postEdit');
 Route::controller('video', 'VideoController');
 /* images */
 Route::get('image/{slug}/edit', 'ImageController@getEdit');
 Route::post('image/{slug}/edit', 'ImageController@postEdit');
 Route::controller('image', 'ImageController');
 Route::controller('/', 'PostController');
});


Route::get('images/{post}/edit','ImageController@getEdit');
Route::get('images/{slug}','ImageController@getView');
Route::controller('images','ImageController');
Route::controller('media','MediaController');

Route::any('media-data','MediaController@fetchData');
Route::get('media-getall','MediaController@getMediaAll');

Route::get('blog/su-kien.html','BlogController@getEvent');
Route::get('blog/kinh-nghiem.html','BlogController@getExperience');
Route::get('blog/{slug}.html','BlogController@getView');
Route::controller('blog.html','BlogController');
/* imtoantran end */

/** ------------------------------------------
 *  Frontend Routes
 *  ------------------------------------------
 */

<<<<<<< HEAD

Route::get('dang-ky-thanh-vien.html','UserController@getCreate');
=======
/** -------------------Site location: luuhoabk-------------**/
Route::group(array('prefix' => 'location'), function()
{

 Route::get('create', 'LocationController@getCreate');
 Route::get('loadProvince','AddressController@loadProvince');
 Route::post('loadDistrict','AddressController@loadDistrict');

//  Route::controller('/', 'LocationController'); // run contruct function
});
/** -------------------End Site location-------------------**/
>>>>>>> luuhoabk

// User reset routes
Route::get('user/reset/{token}', 'UserController@getReset');
// User password reset
Route::post('user/reset/{token}', 'UserController@postReset');
//:: User Account Routes ::
Route::post('user/{user}/edit', 'UserController@postEdit');

//:: User Account Routes ::
Route::post('user/login', 'UserController@postLogin');

# User RESTful Routes (Login, Logout, Register, etc)
Route::controller('user', 'UserController');

//:: Application Routes ::

# Filter for detect language
Route::when('contact-us','detectLang');

# Contact Us Static Page
Route::get('contact-us', function()
{
    // Return about us page
    return View::make('site/contact-us');
});

# Posts - Second to last set, match slug
Route::get('{postSlug}', 'BlogController@getView');
Route::post('{postSlug}', 'BlogController@postView');

# Index Page - Last route, no matches
// Route::get('/', array('before' => 'detectLang','uses' => 'BlogController@getIndex'));
Route::get('/', 'HomeController@getIndex');

Route::get('language/{lang}',
    array(
        'as' => 'language.select',
        'uses' => 'LanguageController@select'
    )
);
