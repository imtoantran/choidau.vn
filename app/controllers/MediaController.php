<?php
use Andrew13\Helpers\String;
class MediaController extends BaseController {

    /**
     * Post Model
     * @var Post
     */
    protected $post;

    /**
     * User Model
     * @var User
     */
    protected $user;

    /**
     * Inject the models.
     * @param Post $post
     * @param User $user
     */
    public function __construct(Image $post, User $user)
    {
        parent::__construct();

        $this->post = $post;
        $this->user = $user;
    }

    /**
     * Returns all the blog posts.
     *
     * @return View
     */
    public function getIndex()
    {
        // Get all the blog posts
        //$posts = $this->post->orderBy('created_at', 'DESC')->paginate(10);

        /*chọn layout*/
        $layout='layout_demo';

        /*thêm file style css--start*/
      // $style_global=$this->Style(array('assets/global/plugins/jquery-1.8.3.min.js'
     //      ));
      $style_global='';

        $style_plugin=$this->Style(array(
            'assets/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css',
            'assets/global/plugins/jquery-file-upload/css/jquery.fileupload.css',
            'assets/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css',
            'assets/global/plugins/jquery-file-upload/css/image-manager.min.css'

                                         ));
        $style_page=$this->Style(array('assets/global/css/plugins.css','assets/global/plugins/image-manager/css/image-manager.min.css'));



        /*--------end*/

        /*thêm css---start */
        $style_script=' .a{color:red;font-size:30px} b.{background:green;} ';
        /*-----------end*/

        /*thêm javascript*/
        $js_global='';
        // $js_global.=$this->JScript(array('abc.js','nbkk.js'));
        $js_plugin=$this->JScript(array(
            'assets/global/plugins/image-manager/js/image-manager1.js',
            'assets/global/plugins/image-manager/spaCMS_settings1.js',
            'assets/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js',
            'assets/global/plugins/jquery-file-upload/js/vendor/tmpl.min.js',
            'assets/global/plugins/jquery-file-upload/js/vendor/load-image.min.js',
            'assets/global/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js',
            'assets/global/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js',
            'assets/global/plugins/jquery-file-upload/js/jquery.iframe-transport.js',
            'assets/global/plugins/jquery-file-upload/js/jquery.fileupload.js',
            'assets/global/plugins/jquery-file-upload/js/jquery.fileupload-process.js',
            'assets/global/plugins/jquery-file-upload/js/jquery.fileupload-image.js',
            'assets/global/plugins/jquery-file-upload/js/jquery.fileupload-audio.js',
            'assets/global/plugins/jquery-file-upload/js/jquery.fileupload-video.js',
            'assets/global/plugins/jquery-file-upload/js/jquery.fileupload-validate.js',
            'assets/global/plugins/jquery-file-upload/js/jquery.fileupload-ui.js'
            ));
        $js_page=$this->JScript(array('assets/admin/pages/scripts/form-fileupload.js'));
        $js_script='

        ';



        $js_validate='var URL_IMAGE_MANAGER="assets/global/plugins/image-manager/upload"';
        $default_page_title='chào mừng bạn đến với trang đăng nhập';
        $default_keyword='choidau,chơi đâu';
        $default_description='choidau,chơi đâu';



        return View::make('media/index',compact('layout',
            'default_page_title',
            'default_keyword',
            'default_description',
            'style_plugin','style_page',
            'js_plugin','js_script','js_page','js_validate'));

    }


   // public  function  uploadFile(){
  //   echo'abc---';
     //   $upload_handler=  UploadHandler();

 //   }

    public  function getMediaAll(){
        UploadMediaHandler::get_all_images_forXML();
    }
    public  function  fetchData(){
     $uploadfile=new UploadMediaHandler();

   }

    public  function  deleteData(){

    }
   public  function  postDataz(){
      echo 'chào    ấ';

    }
    /**
     * View a blog post.
     *
     * @param  string  $slug
     * @return View
     * @throws NotFoundHttpException
     */
    public function getView($slug)
    {
        // Get this blog post data
        $post = $this->post->where('slug', '=', $slug)->first();

        // Check if the blog post exists
        if (is_null($post))
        {
            // If we ended up in here, it means that
            // a page or a blog post didn't exist.
            // So, this means that it is time for
            // 404 error page.
            return App::abort(404);
        }

        // Get this post comments
        $comments = $post->comments()->orderBy('created_at', 'ASC')->get();

        // Get current user and check permission
        $user = $this->user->currentUser();
        $canComment = false;
        if(!empty($user)) {
            $canComment = $user->can('post_comment');
        }

        // Show the page
        return View::make('site/blog/view_post', compact('post', 'comments', 'canComment'));
    }

    /**
     * View a blog post.
     *
     * @param  string  $slug
     * @return Redirect
     */
    public function postView($slug)
    {

        $user = $this->user->currentUser();
        $canComment = $user->can('post_comment');
        if ( ! $canComment)
        {
            return Redirect::to($slug . '#comments')->with('error', 'You need to be logged in to post comments!');
        }

        // Get this blog post data
        $post = $this->post->where('slug', '=', $slug)->first();

        // Declare the rules for the form validation
        $rules = array(
            'comment' => 'required|min:3'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Save the comment
            $comment = new Comment;
            $comment->user_id = Auth::user()->id;
            $comment->content = Input::get('comment');

            // Was the comment saved with success?
            if($post->comments()->save($comment))
            {
                // Redirect to this blog post page
                return Redirect::to($slug . '#comments')->with('success', 'Your comment was added with success.');
            }

            // Redirect to this blog post page
            return Redirect::to($slug . '#comments')->with('error', 'There was a problem adding your comment, please try again.');
        }

        // Redirect to this blog post page
        return Redirect::to($slug)->withInput()->withErrors($validator);
    }


    public function upLoadFile(){

        $upload=new UploadMediaHandler();
        $initialize = true;
        if ($initialize) {
            switch ($upload->get_server_var('REQUEST_METHOD')) {
                case 'OPTIONS':
                case 'HEAD':
                    $upload->head();
                    break;
                case 'GET':
                    $upload->get();
                    break;
                case 'PATCH':
                case 'PUT':
                case 'POST':
                 {
                        $upload->post();

                    /*Gui bài lên database*/
                     $post=new Image();
                     $post->post->title            ='ádasd';//$data['title'];
                     $post->post->slug             ='ádsda';//Str::slug( $data['title']);
                     $post->post->content          ='ádad';//  $data['content'];
                     $post->post->user_id          ='3';//  $user->id;
                     // Was the blog post created?
                     if($post->post->save())
                     {
                         // Redirect to the new blog post page
                         //return Redirect::to('admin/blogs/' . $this->post->id . '/edit')->with('success', Lang::get('admin/blogs/messages.create.success'));
                     }

                     // Redirect to the blog post create page
                     //return Redirect::to('admin/blogs/create')->with('error', Lang::get('admin/blogs/messages.create.error'));


                     $postMeta=new PostMeta();
                     $postMeta->meta_key='url';
                     $postMeta->meta_value='ádasdad';//$data['url'];
                     $post->post->meta()->save($postMeta);


                    break;}
                case 'DELETE':
                    $upload->delete();
                    break;
                default:
                    $upload->header('HTTP/1.1 405 Method Not Allowed');
            }
        }

    }

    /* imtoantran */
    public function getUpload(){
//        $type = pathinfo($path, PATHINFO_EXTENSION);
//        $data = file_get_contents($path);
//        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        if(Auth::check()){
            $user = Auth::user();
            $images = $user->Images()->get();
            $img = [];
            foreach($images as $key=>$image){
                $img[] = ["id"=>$image->id,"name"=>$image->title,"src"=>$image->guid,"thumbnail"=>"/upload/".$image->thumbnail,"link"=>URL::to("upload/$image->guid")];
            }
        }
        return json_encode($img);
    }

    public function postUpload(){
        if(Auth::check()) {
            $id="";
            $images = [];
            foreach (Input::file("file") as $file) {
                $file->move("upload", $file->getClientOriginalName());
                $image = new Image();
                $image->title = $file->getClientOriginalName();
                $image->thumbnail = $file->getClientOriginalName();
                $image->guid = "/upload/".$file->getClientOriginalName();
                if($image->save()){
                    $id=["id"=>$image->id];
                    $images[] = $image;
                }
            }
            Auth::user()->Images()->saveMany($images);
            echo json_encode($id);
        }
    }
    public function deleteUpload(){
        $images = Input::get("images");
        $path = [];
        if(Image::destroy($images)){
            foreach($images as $image){
                $path[] = Image::find($image->id)->guid;
            }
            //File::delete($path);
        }
        return json_encode($path);
    }
    /* imtoantran */









}
