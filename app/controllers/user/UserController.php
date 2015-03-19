<?php

//use ChoiDau\Extensions\View\Factory;
class UserController extends BaseController
{

    /**
     * User Model
     * @var User
     */
    protected $user;

    /**
     * @var UserRepository
     */
    protected $userRepo;

    /**
     * Inject the models.
     * @param User $user
     * @param UserRepository $userRepo
     */
    public function __construct(User $user, UserRepository $userRepo)
    {
        parent::__construct();
        $this->user = $user;
        $this->userRepo = $userRepo;
    }

    /**
     * Users settings page
     *
     * @return View
     */
    public function getIndex()
    {
        list($user, $redirect) = $this->user->checkAuthAndRedirect('user');
        if ($redirect) {
            return $redirect;
        }

        // Show the page
        return View::make('site/user/index', compact('user'));
    }

    /**
     * Stores new user
     *
     */
    public function postIndex()
    {
        $user = $this->userRepo->signup(Input::all());

        if ($user->id && false) {//imtoantran
            if (Config::get('confide::signup_email')) {
                Mail::queueOn(
                    Config::get('confide::email_queue'),
                    Config::get('confide::email_account_confirmation'),
                    compact('user'),
                    function ($message) use ($user) {
                        $message
                            ->to($user->email, $user->username)
                            ->subject(Lang::get('confide::confide.email.account_confirmation.subject'));
                    }
                );
            }

            return Redirect::to('user/login')
                ->with('success', Lang::get('user/user.user_account_created'));
        } else {
            $error = $user->errors()->all(':message');

            return Redirect::to('user/create')
                ->withInput(Input::except('password'))
                ->with('error', $error);
        }

    }

    /**
     * Edits a user
     * @var User
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit(User $user)
    {
        $oldUser = clone $user;

        $user->username = Input::get('username');
        $user->email = Input::get('email');

        $password = Input::get('password');
        $passwordConfirmation = Input::get('password_confirmation');

        if (!empty($password)) {
            if ($password != $passwordConfirmation) {
                // Redirect to the new user page
                $error = Lang::get('admin/users/messages.password_does_not_match');
                return Redirect::to('thanh-vien')
                    ->with('error', $error);
            } else {
                $user->password = $password;
                $user->password_confirmation = $passwordConfirmation;
            }
        }

        if ($this->userRepo->save($user)) {
            return Redirect::to('thanh-vien')
                ->with('success', Lang::get('user/user.user_account_updated'));
        } else {
            $error = $user->errors()->all(':message');
            return Redirect::to('thanh-vien')
                ->withInput(Input::except('password', 'password_confirmation'))
                ->with('error', $error);
        }

    }

    /**
     * Displays the form for user creation
     *
     */
    public function getCreate()
    {
        $page_title = 'Đăng ký thành viên choidau.net';
        $seoarray = array('metakey' => 'aasd,asd,asd,', 'metades' => 'asd ada asd a sdads');
        $js_script = '
        Layout.btnSelection();
        ';


        $listTTHN = Option::orderBy('name', 'ASC')->where('name', '=', 'user_status_marriage')->get();
        $listProvince = Province::orderBy('name', 'ASC')->get();
        $listStatusPost = Option::orderBy('name', 'ASC')->where('name', '=', 'post_privacy')->get();

        //     $listTinh='abc';
        return View::make('site/user/create', compact('page_title', 'js_script', 'seoarray', 'listProvince', 'listTTHN', 'listStatusPost'));

    }

    public function postCreate()
    {
        $user = Auth::user();
        if (!empty($user->id)) {
            return Redirect::to('/');
        }
        $data = Input::all();

        $user_singup = $this->userRepo->signup($data);
        if (!$user_singup) {
            $listProvince = Province::orderBy('name', 'ASC')->get();
            $listTTHN = Option::orderBy('name', 'ASC')->where('name', '=', 'user_status_marriage')->get();

            $listStatusPost = Option::orderBy('name', 'ASC')->where('name', '=', 'post_privacy')->get();

            return View::make('site/user/create', compact('page_title', 'seoarray', 'listProvince', 'listTTHN', 'listStatusPost'));

        } else {
            return View::make('site/user/login', compact('page_title'));

        }

    }


    /**
     * Displays the login form
     *
     */
    public function getLogin()
    {
        $page_title = '';
        $user = Auth::user();
        if (!empty($user->id)) {
            return Redirect::to('/');
        }

        return View::make('site/user/login', compact('page_title'));
    }

    /**
     * Attempt to do login
     *
     */
    public function postLogin()
    {
        $repo = App::make('UserRepository');
        $input = Input::all();
        $arr = array();

        if ($this->userRepo->login($input)) {
            $arr['url'] = Session::get('url_link_current');

        } else {
            $arr['url'] = "";
            if ($this->userRepo->isThrottled($input)) {
                $err_msg = 0;
            } elseif ($this->userRepo->existsButNotConfirmed($input)) {
                $err_msg = 1;
            } else {
                $err_msg = 2;
            }
            $arr['err_msg'] = $err_msg;

        }
        echo json_encode($arr);

    }

    /**
     * Attempt to confirm account with code
     *
     * @param  string $code
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getConfirm($code)
    {
        if (Confide::confirm($code)) {
            return Redirect::to('user/login')
                ->with('notice', Lang::get('confide::confide.alerts.confirmation'));
        } else {
            return Redirect::to('user/login')
                ->with('error', Lang::get('confide::confide.alerts.wrong_confirmation'));
        }
    }

    /**
     * Displays the forgot password form
     *
     */
    public function getForgot()
    {
        return View::make('site/user/forgot');
    }

    /**
     * Attempt to reset password with given email
     *
     */
    public function postForgotPassword()
    {
        if (Confide::forgotPassword(Input::get('email'))) {
            $notice_msg = Lang::get('confide::confide.alerts.password_forgot');
            return Redirect::to('user/forgot')
                ->with('notice', $notice_msg);
        } else {
            $error_msg = Lang::get('confide::confide.alerts.wrong_password_forgot');
            return Redirect::to('user/login')
                ->withInput()
                ->with('error', $error_msg);
        }
    }

    /**
     * Shows the change password form with the given token
     *
     */
    public function getReset($token)
    {

        return View::make('site/user/reset')
            ->with('token', $token);
    }


    /**
     * Attempt change password of the user
     *
     */
    public function postReset()
    {

        $input = array(
            'token' => Input::get('token'),
            'password' => Input::get('password'),
            'password_confirmation' => Input::get('password_confirmation'),
        );

        // By passing an array with the token, password and confirmation
        if ($this->userRepo->resetPassword($input)) {
            $notice_msg = Lang::get('confide::confide.alerts.password_reset');
            return Redirect::to('user/login')
                ->with('notice', $notice_msg);
        } else {
            $error_msg = Lang::get('confide::confide.alerts.wrong_password_reset');
            return Redirect::to('user/reset', array('token' => $input['token']))
                ->withInput()
                ->with('error', $error_msg);
        }

    }

    /**
     * Log the user out of the application.
     *
     */
    public function getLogout()
    {
        Confide::logout();

        return Redirect::to('/');
    }

    /**
     * Get user's profile
     * @param $username
     * @return mixed
     */
    public function getProfile($username)
    {
        $userModel = new User;
        $user = $userModel->getUserByUsername($username);

        // Check if the user exists
        if (is_null($user)) {
            return App::abort(404);
        }

        return View::make('site/user/profile', compact('user'));
    }

    public function getSettings()
    {
        list($user, $redirect) = User::checkAuthAndRedirect('user/settings');
        if ($redirect) {
            return $redirect;
        }

        return View::make('site/user/profile', compact('user'));
    }

    /**
     * Process a dumb redirect.
     * @param $url1
     * @param $url2
     * @param $url3
     * @return string
     */
    public function processRedirect($url1, $url2, $url3)
    {
        $redirect = '';
        if (!empty($url1)) {
            $redirect = $url1;
            $redirect .= (empty($url2) ? '' : '/' . $url2);
            $redirect .= (empty($url3) ? '' : '/' . $url3);
        }
        return $redirect;
    }

    public function checkLogin()
    {
        $data = Input::get('url');
        Session::put('url_link_current', $data);
        echo Auth::check();
    }


    public function getTotalLikeLocation()
    {
        return User::getTotalLikeLocation();
    }


//    luuhoabk


    public function loginWithFacebook()
    {
        // get data from input
        $code = Input::get('code');

        // get fb service
        $fb = OAuth::consumer('Facebook');

        // check if code is valid

        // if code is provided get user data and sign in
        if (!empty($code)) {
            $current_url = Session::get('url_link_current');
            // This was a callback request from facebook, get the token
            $token = $fb->requestAccessToken($code);

            // Send a request with it
            $result = json_decode($fb->request('/me'), true);

            $fb_id = '[FB]' . $result['id'];
            $fb_name = $result['name'];
            $fb_email = $result['email'];
            $fb_gender = $result['gender'];
            //luuhoabk - neu ton tai email thi lay thong tin va login/ chua thi them vao databaseva login
            if (User::whereEmail($fb_email)->count()) {
                // ton tai
                $user = User::whereEmail($fb_email)->first();
                Auth::login($user);
                return Redirect::to($current_url);
            } else {
                $kq = DB::table('users')->insert(
                    array(
                        'username' => $fb_id,
                        'email' => $fb_email,
                        'password' => md5(bin2hex(openssl_random_pseudo_bytes(3))),
                        'gender' => ($fb_gender == 'male') ? 1 : 0,
                        'confirmation_code' => md5(uniqid(mt_rand(), true)),
                        'confirmed' => 1,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'fullname' => $fb_name,
                        'level_id' => 3,
                        'status_marriage_id' => 0
                    )
                );

                if ($kq) {
                    $user = User::whereEmail($fb_email)->first();
                    Auth::login($user);
                }
                return Redirect::to($current_url);
            }
        } // if not ask for permission first
        else {
            // get fb authorization
            $current_url = Input::get('current_url');
            Session::put('url_link_current', $current_url);
            $url = $fb->getAuthorizationUri();
            echo $url;
        }

    }

    public function loginWithGoogle()
    {
        // get data from input
        $code = Input::get('code');

        // get fb service
        $google = OAuth::consumer('Google');

        // check if code is valid

        // if code is provided get user data and sign in
        if (!empty($code)) {
            $current_url = Session::get('url_link_current');
            // This was a callback request from google, get the token
            $token = $google->requestAccessToken($code);

            // Send a request with it
            $result = json_decode($google->request('https://www.googleapis.com/oauth2/v1/userinfo'), true);

            $google_id = '[GG]' . $result['id'];
            $google_name = $result['name'];
            $google_email = $result['email'];
            $google_gender = $result['gender'];
            //luuhoabk - neu ton tai email thi lay thong tin va login/ chua thi them vao databaseva login
            if (User::whereEmail($google_email)->count()) {
                // ton tai
                $user = User::whereEmail($google_email)->first();
                Auth::login($user);
                return Redirect::to($current_url);
            } else {
                $kq = DB::table('users')->insert(
                    array(
                        'username' => $google_id,
                        'email' => $google_email,
                        'password' => md5(bin2hex(openssl_random_pseudo_bytes(3))),
                        'gender' => ($google_gender == 'male') ? 1 : 0,
                        'confirmation_code' => md5(uniqid(mt_rand(), true)),
                        'confirmed' => 1,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'fullname' => $google_name,
                        'level_id' => 28,
                        'status_marriage_id' => 0
                    )
                );

                if ($kq) {
                    $user = User::whereEmail($google_email)->first();
                    Auth::login($user);
                }
                return Redirect::to($current_url);
            }
        } // if not ask for permission first
        else {
            // get fb authorization
            $current_url = Input::get('current_url');
            Session::put('url_link_current', $current_url);
            $url = $google->getAuthorizationUri();
            echo $url;
        }

    }

    public function getFriendConfirm()
    {
        $user = Auth::user();
        echo json_encode($user->referFriendConfirm()->withPivot('status_id')->wherePivot('status_id', '=', 35)->get());
    }

    public function getLocation()
    {
        $user = Auth::user();
        echo json_encode($user->referLocation()->get());
    }
// end luuhoabk

//luuhoabk - like post
    public function postLike()
    {
        $user = Auth::user();
        $data = Input::all();
        $isPost = $user->isAction('like', $data['post_id']);
        switch ($data['data_action']) {
            case 'like':
                if ($isPost->count()) {
                    echo -1;
                    break;
                } // neu ton tai like roi thi bao loi : -1
                $now = date_create("now");
//
                $meta = new PostMeta();
                $meta->post_id = $data['post_id'];
                $meta->meta_value = $data['user_id'];
                $meta->meta_key = 'like';
                $meta->created_at = date_format($now, "Y-m-d H:i:s");

                if (!$meta->save()) {
                    echo -1;
                    break;
                } // neu luu khong thanh cong
                    echo Post::find($data['post_id'])->totalLikes();
                break;

            case 'unlike':
                if (!$isPost->count()) {
                    echo -1;
                    break;
                } // neu ko ton tai
                if (!$isPost->delete()) {
                    echo -1;
                    break;
                } // neu ton tai ma xoa ko thanh cong
                    echo Post::find($data['post_id'])->totalLikes();
                break;
            default;
                break;
        }
    }

// luuhoabk - comment post
    public function postComment(){
        $user = Auth::user();
        $data = Input::all();
        $now = date_create("now");
        $post =new Post();
        $post->title        = "comment";
        $post->parent_id    =  $data['post_id'];
        $post->content      = $data['comment_content'];
        $post->privacy      = 18;
        $post->post_type    = 'comment';
        $post->user_id      = $user->id;
        $post->created_at   = date_format($now,"Y-m-d H:i:s");
        $post->updated_at   = date_format($now,"Y-m-d H:i:s");
        if($post->save()){
            $post['success'] = 1;
            $post['post_id'] = $post->id;
            $post['updated_date'] = date_format($now,'H:i d/m/Y');
        }else{
            $post['success'] = 0;
        }
        echo json_encode($post);
    }

}


