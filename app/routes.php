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
Route::model('location', 'Location');

/** ------------------------------------------
 *  Route constraint patterns
 *  ------------------------------------------
 */
Route::pattern('comment', '[0-9]+');
Route::pattern('post', '[0-9]+');
Route::pattern('user', '[0-9]+');
Route::pattern('role', '[0-9]+');
Route::pattern('token', '[0-9a-z]+');

/* imtoantran set province */
Route::post("changePorvince", function () {
    $province = Province::find(Input::get("id"));
    if (is_null($province)) {
        return json_encode(["success" => false]);
    } else {
        Session::put("province", Province::find(Input::get("id")));
        return json_encode(["success" => true, "url" => URL::to($province->slug)]);
    }
})->where("id", "[0-9]");
/* imtoantran set province */
/** ------------------------------------------
 *  Admin Routes
 *  ------------------------------------------
 */
Route::group(array('prefix' => 'qtri-choidau', 'before' => 'auth|permission'), function () {

    // luuhoabk - qtri location
    Route::group(array('prefix' => 'location', 'before' => 'hasRoleLocation'), function () {
        Route::get("loadreview","AdminLocationsController@loadReview");
        Route::get("review-item-{post_id}","AdminLocationsController@loadDetailReview");
        Route::post("actionreview","AdminLocationsController@actionReview");
        Route::controller("/","AdminLocationsController");
    });

    // luuhoabk - qtri post
    Route::group(array('prefix' => 'blog', 'before' => 'hasRolePost'), function () {
        /* imtoantran start */
        # Blog Management
        Route::get('create/{catId}', 'AdminBlogsController@getCreate');
        Route::post('create', 'AdminBlogsController@postCreate');
//
//        Route::get('{post}/show', 'AdminBlogsController@getShow');
        Route::get('{post}/edit', 'AdminBlogsController@getEdit');
        Route::post('{post}/edit', 'AdminBlogsController@postEdit');
        Route::get('{post}/delete', 'AdminBlogsController@getDelete');
        Route::post('{post}/delete', 'AdminBlogsController@postDelete');
        Route::get('danh-muc-{slug?}/', 'AdminBlogsController@blogCategory');
        Route::controller('/', 'AdminBlogsController');
        /* imtoantran end */
    });

    // luuhoabk - qtri media
    Route::group(array('prefix' => 'media', 'before' => 'hasRoleMedia'), function () {
        // luuhoabk - qtri video
        Route::post("video/comment-delete","AdminVideoController@deleteComment");
        Route::post("video/delete","AdminVideoController@deleteVideo");
        Route::post("video/update","AdminVideoController@updateVideo");
        Route::get("video/load","AdminVideoController@getVideos");
        Route::get("video/detail-video-{post_id}","AdminVideoController@loadDetail");
        Route::controller("video","AdminVideoController");

        Route::post("image/edit","AdminImageController@EditImage");
        Route::post("image/delete","AdminImageController@DeleteImage");
        Route::get("image-{image_type}-{image_id}-{parent_id}/edit","AdminImageController@LoadEditImage");
        Route::get("image/user-location-{location_id}","AdminImageController@filterImageUserLocation");
        Route::get("image/user-review","AdminImageController@getImageUserReview");

        Route::get("image/admin-location-{location_id}","AdminImageController@filterImageAdminLocation");
        Route::get("image/admin-review","AdminImageController@GetImageReviewAdmin");
        Route::get("image/admin-location","AdminImageController@GetImageLocationAdmin");

        Route::controller("image/user-location","AdminImageController");
        Route::controller("image","AdminImageController");
        // END luuhoabk - qtri video
    });

    // luuhoabk - qtri FAQ
    Route::group(array('prefix' => 'hoi-dap', 'before' => 'hasRoleFAQ'), function () {
        //// luuhoabk - qtri hoi dap
        Route::get("get-table","AdminFaqController@getData");
        Route::get("cau-hoi-{post_id}","AdminFaqController@getDetailFaq");
        Route::controller("/","AdminFaqController");
        // END luuhoabk - qtri hoi dap
    });

    // luuhoabk - qtri User
    Route::group(array('prefix' => 'users', 'before' => 'hasRoleUser'), function () {
        # User Management
        Route::get('{user}/show', 'AdminUsersController@getShow');
        Route::get('{user}/edit', 'AdminUsersController@getEdit');
        Route::post('{user}/edit', 'AdminUsersController@postEdit');
        Route::get('{user}/delete', 'AdminUsersController@getDelete');
        Route::post('{user}/delete', 'AdminUsersController@postDelete');
        Route::controller('/', 'AdminUsersController');
    });

    // luuhoabk - qtri Role
    Route::group(array('prefix' => 'roles', 'before' => 'hasRoleUserGroup'), function () {
        Route::get('{role}/show', 'AdminRolesController@getShow');
        Route::get('{role}/edit', 'AdminRolesController@getEdit');
        Route::post('{role}/edit', 'AdminRolesController@postEdit');
        Route::get('{role}/delete', 'AdminRolesController@getDelete');
        Route::post('{role}/delete', 'AdminRolesController@postDelete');
        Route::controller('/', 'AdminRolesController');
    });

    // luuhoabk - qtri Setting
    Route::group(array('prefix' => 'ads', 'before' => 'hasRoleADS'), function () {
        Route::post('update', 'AdminAdsController@adsUpdate');
        Route::controller('/', 'AdminAdsController');
    });

    // luuhoabk - qtri Setting
    Route::group(array('prefix' => 'setting', 'before' => 'hasRoleSetting'), function () {

        //user level
        Route::get('user-level', 'AdminSettingController@getUserLevel');
        Route::post('user-level/update', 'AdminSettingController@userLevelUpdate');
        Route::post('user-level/delete', 'AdminSettingController@userLevelDelete');
        Route::post('user-level/create', 'AdminSettingController@userLevelCreate');


        //contact
        Route::post('contact/web-info/update', 'AdminSettingController@contactWebinfoUpdate');
        Route::get('contact/web-info', 'AdminSettingController@contactWebinfo');
        Route::post('contact/map/update', 'AdminSettingController@contactMapUpdate');
        Route::get('contact/map', 'AdminSettingController@contactMap');
        Route::get('contact', 'AdminSettingController@getContact');
        Route::get('contact/list', 'AdminSettingController@getContactList');
        Route::post('contact/delete', 'AdminSettingController@contactDelete');
        Route::get('contact/{contact_id}', 'AdminSettingController@contactDetail');


        //Page
        Route::post('page/delete', 'AdminSettingController@pageDelete');
        Route::get('page/create', 'AdminSettingController@getCreate');
        Route::post('page/save', 'AdminSettingController@pageSave');
        Route::get('page-{page_id}/edit', 'AdminSettingController@getPageEdit');
        Route::get('page', 'AdminSettingController@getPage');
        Route::get('page/list', 'AdminSettingController@getPageList');
        Route::post('page/update', 'AdminSettingController@socialUpdate');

        //social
        Route::get('social', 'AdminSettingController@getSocial');
        Route::post('social/update', 'AdminSettingController@socialUpdate');

        //script
        Route::get('script', 'AdminSettingController@getScript');
        Route::post('script/delete', 'AdminSettingController@scriptDelete');
        Route::post('script/update', 'AdminSettingController@scriptUpdate');
        Route::post('script/insert', 'AdminSettingController@scriptInsert');


        Route::controller('/', 'AdminSettingController');
    });



    # Comment Management
    Route::get('comments/{comment}/edit', 'AdminCommentsController@getEdit');
    Route::post('comments/{comment}/edit', 'AdminCommentsController@postEdit');
    Route::get('comments/{comment}/delete', 'AdminCommentsController@getDelete');
    Route::post('comments/{comment}/delete', 'AdminCommentsController@postDelete');
    Route::controller('comments', 'AdminCommentsController');

    Route::controller('/', 'AdminHomeController');
});

/* imtoantran post start */
Route::group(array('prefix' => 'post'), function () {
    /* imtoantran social action route start */
    Route::post("social/{post}","PostController@social");
    /* imtoantran social action route stop */
    /* imtoantran comment start */
    Route::post("comments/{post}","PostController@postComments");
    Route::get("comments/{post}","PostController@getComments");
    /* imtoantran comment stop */

    /* action */
    Route::post('action-click-post', 'PostController@userActionClickPost');

    /* images */
    Route::get('image/{slug}/edit', 'ImageController@getEdit');
    Route::post('image/{slug}/edit', 'ImageController@postEdit');
    Route::controller('image', 'ImageController');
    Route::controller('/', 'PostController');

});

//page
Route::controller("page/{page_id}-{page_alias}",'PageController');

//contact
Route::post("lien-he/tao-moi.html",'ContactController@saveContact');
Route::controller("lien-he.html",'ContactController');

Route::post("blog/comments/{post}","BlogController@postComments");

#location start
/* imtoantran save food start */
Route::post("location/getList",'LocationController@getLocation');
Route::post("location/{location}/food/remove",'LocationController@removeFood');
Route::post("location/{location}/food/add",'LocationController@addFood');
Route::post("location/{location}/food/edit",'LocationController@editFood');
/* imtoantran save food stop */
Route::post("location/like/", 'LocationController@like');
Route::post("location/checkin/", 'LocationController@checkin');
Route::get("location/review/{id}", 'LocationController@getReview');
Route::post("location/{location}/review", 'LocationController@postReview');
Route::post("location/{location}/verify", 'AdminLocationsController@postVerify');
Route::post("location/{location}/delete", 'AdminLocationsController@postDelete');
Route::post("location/load-member", 'LocationController@loadMember');
Route::post("location/load-event", 'LocationController@loadEvent');
Route::post("location/event/{location}", 'LocationController@postEvent');
Route::post("location/food", 'LocationController@postFood');
Route::post("location/load-photo", 'LocationController@loadPhoto');
# location end
Route::get('images/{post}/edit', 'ImageController@getEdit');
Route::get('images/{slug}', 'ImageController@getView');
Route::controller('images', 'ImageController');


Route::any('media/loadMedia', 'MediaController@loadMedia');
Route::controller('media', 'MediaController');
Route::any('media-data', 'ImageController@upLoadFile');
//Route::any('media-data','MediaController@fetchData');
Route::get('media-getall', 'MediaController@getMediaAll');


Route::get('blog/su-kien.html', 'BlogController@getEvent');
Route::get('blog/kinh-nghiem.html', 'BlogController@getExperience');
Route::get('blog/{slug}.html', 'BlogController@getView');
Route::controller('blog.html', 'BlogController');
Route::get('blog/create/{catId}', 'BlogController@getCreate');
//Route::controller('blog', 'BlogController');
/* imtoantran end */

/** ------------------------------------------
 *  Frontend Routes
 *  ------------------------------------------
 */

/** -------------------Site VIDEO: luuhoabk-------------**/
Route::controller('video.html', 'VideoController');
Route::get('video/chi-tiet-video-{video_id}.html', 'VideoController@loadDetail');

Route::group(array('prefix' => 'video', 'before' => 'auth'), function () {
    Route::get('tao-moi.html', 'VideoController@createVideo');
});
/** -------------------END Site VIDEO: luuhoabk-------------**/

/** -------------------Site FAQ: luuhoabk-------------**/
Route::controller('faq.html', 'FaqController');
Route::group(array('prefix' => 'faq'), function () {
    Route::get('cau-hoi.html', 'FaqController@loadQuestion');
    Route::post('tao-chu-de.html', 'FaqController@addSubject');
    Route::get('cau-hoi-{postId}.html', 'FaqController@loadQuestionDetail');
    Route::post('xoa-cau-hoi', 'FaqController@faqDelete');
});
/** -------------------END Site FAQ: luuhoabk-------------**/

/** -------------------Site location: luuhoabk-------------**/
Route::group(array('prefix' => 'dia-diem', 'before' => 'auth'), function () {
    Route::get('loadInitParam', 'LocationController@loadInitParam');
    Route::get('loadProvince', 'AddressController@loadProvince');
    Route::post('loadDistrict', 'AddressController@loadDistrict');
    Route::get('tao-dia-diem', 'LocationController@getCreate');
    Route::post('luu-dia-diem', 'LocationController@saveLocation');
    Route::post('load-album', 'LocationController@loadAlbum');
    Route::post('save-image-album', 'LocationController@saveImageAlbum');
    Route::post('xoa-image-album', 'LocationController@deleteImageAlbum');
    Route::post('loc-dia-diem', 'LocationController@filterLocation');
    Route::get('loc-dia-diem', 'LocationController@filterLocation');
    Route::post('loc-hinh-anh', 'LocationController@filterAlbums');
    Route::get('loc-hinh-anh', 'LocationController@filterAlbums');
    Route::get('action', 'LocationController@action');
    Route::post('action', 'LocationController@action');
    Route::post('tao-video', 'LocationController@createVideo');

//    Route::controller('/', 'LocationController'); // run contruct function
});
/** -------------------End Site location-------------------**/


/** -------------------Site User: Vinhle-------------**/
Route::group(array('prefix' => 'thanh-vien'), function () {
    Route::post('user-exist', 'UserController@userExist');

    Route::post('quen-mat-khau.html', 'UserController@postForgotPassword');
    Route::get('quen-mat-khau.html', 'UserController@getForgot');
    Route::get('dang-ky.html', 'UserController@getCreate');
    Route::post('dang-ky.html', 'UserController@postCreate');
    Route::get('dang-nhap.html', 'UserController@getLogin');
    Route::post('dang-nhap.html', 'UserController@postLogin');
    Route::get('dang-xuat.html', 'UserController@getLogout');
    Route::post('check-login', 'UserController@checkLogin');
    Route::get('login-facebook', 'UserController@loginWithFacebook');
    Route::post('login-facebook', 'UserController@loginWithFacebook');
    Route::get('login-google', 'UserController@loginWithGoogle');
    Route::post('login-google', 'UserController@loginWithGoogle');
    Route::post('xac-thuc', 'UserController@getFriendConfirm');
    Route::get('xac-thuc', 'UserController@getFriendConfirm');
    Route::get('like-post', 'UserController@postLike');
    Route::post('like-post', 'UserController@postLike');
    Route::post('cap-nhat-thong-tin', 'UserController@updatthanh-vieneInfo');
    Route::post('comment-post', 'UserController@postComment');
    Route::post('update-info', 'UserController@updateInfo');
    Route::post('close-question', 'UserController@closeQuestion');
    Route::get('/', 'UserController@getIndex');
});
/** -------------------End Site User-------------------**/
/** -------------------Site blog: -------------**/
Route::group(array('prefix' => 'trang-ca-nhan', 'before' => 'auth'), function () {

    Route::get('/chinh-sua-thong-tin.html', 'BlogUserController@getEditBlogUser');
    Route::post('/chinh-sua-thong-tin.html', 'BlogUserController@postEditBlogUser');
    Route::post('/trang-thai.html', 'BlogUserController@postStatusBlog');
    Route::get('/trang-thai.html', 'BlogUserController@postStatusBlog');
    Route::any('/load-item-comment-{id_comment_post_slug}', 'BlogUserController@loadComment');
    Route::any('/load-item-statusz-{id_status_slug}', 'BlogUserController@ala');
    Route::post('/list-ban-be.html', 'BlogUserController@getListFriend');
    Route::post('/list-hinh-anh.html', 'BlogUserController@getListPhoto');
    Route::post('/list-location-like.html', 'BlogUserController@getListLocationLike');
    Route::post('/ban-be.html', 'BlogUserController@postFriend');
    Route::get('/{user_slug}.html', 'BlogUserController@getIndex');
    Route::get('/profile/{user_slug}.html', 'BlogUserController@getIndex');
    Route::get('/{user_slug}/post/{post}/', 'BlogUserController@userNotifications');
});

/** -------------------End Site Blog-------------------**/
// User reset routes
Route::get('user/reset/{token}', 'UserController@getReset');
// User password reset
Route::post('user/reset/{token}', 'UserController@postReset');
//:: User Account Routes ::
Route::post('user/{user}/edit', 'UserController@postEdit');

//:: User Account Routes ::
Route::get('nguoi-dung/dang-nhap', 'UserController@getLogin');
Route::post('nguoi-dung/dang-nhap', 'UserController@postLogin');

# User RESTful Routes (Login, Logout, Register, etc)
Route::controller('user', 'UserController');

//:: Application Routes ::

# Filter for detect language
Route::when('contact-us', 'detectLang');

# Contact Us Static Page
Route::get('contact-us', function () {
    // Return about us page
    return View::make('site/contact-us');
});

# Posts - Second to last set, match slug
Route::get('{postSlug}.html', 'BlogController@getView');
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
/* imtoantran image thumnnail start */
Route::get("upload/thumbnail/{w}x{h}-{file}", "MediaController@thumbnailx")->where(["w"=>"[0-9]+","h"=>"[0-9]+"]);
Route::get("upload/thumbnail/{file}", "MediaController@thumbnail");
/* imtoantran image thumnnail stop */
Route::get("location/{location}/reviews", "LocationController@getReviews");
/* imtoantran start */
Route::delete("location/{location}/images", "LocationController@deleteImages");
Route::get("location/{location}/images", "LocationController@getImages");
Route::post("location/{location}/images", "LocationController@postImages");
Route::group(array('prefix' => "{provinceSlug}"), function () {
    Route::get("/", "LocationController@getView");
    Route::get("{slug}", "LocationController@getView");
});
/* imtoantran end */

