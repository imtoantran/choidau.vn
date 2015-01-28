<?php

if(isset($_POST['user_id'])){

  //define a maxim size for the uploaded images
  define("MAX_SIZE", "100");
  // define the width and height for the thumbnail
  // note that theese dimmensions are considered the maximum dimmension and are not fixed,
  // because we have to keep the image ratio intact or it will be deformed
  define("WIDTH", "165");
  define("HEIGHT", "95");

  // this is the function that will create the thumbnail image from the uploaded image
  // the resize will be done considering the width and height defined, but without deforming the image
  function make_thumb($img_name, $filename, $new_w, $new_h) {
    //get image extension.
    $ext = getExtension($img_name);
    //creates the new image using the appropriate function from gd library
    if (!strcmp("jpg", $ext) || !strcmp("jpeg", $ext))
      $src_img = imagecreatefromjpeg($img_name);

    if (!strcmp("png", $ext))
      $src_img = imagecreatefrompng($img_name);

    //gets the dimmensions of the image
    $old_x = imageSX($src_img);
    $old_y = imageSY($src_img);

    // next we will calculate the new dimmensions for the thumbnail image
    // the next steps will be taken:
    //    1. calculate the ratio by dividing the old dimmensions with the new ones
    //    2. if the ratio for the width is higher, the width will remain the one define in WIDTH variable
    //        and the height will be calculated so the image ratio will not change
    //    3. otherwise we will use the height ratio for the image
    // as a result, only one of the dimmensions will be from the fixed ones
    $ratio1 = $old_x / $new_w;
    $ratio2 = $old_y / $new_h;
    if ($ratio1 > $ratio2) {
      $thumb_w = $new_w;
      $thumb_h = $old_y / $ratio1;
    } else {
      $thumb_h = $new_h;
      $thumb_w = $old_x / $ratio2;
    }

    // we create a new image with the new dimmensions
    $dst_img = ImageCreateTrueColor($thumb_w, $thumb_h);

    // resize the big image to the new created one
    imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $thumb_w, $thumb_h, $old_x, $old_y);

    // output the created image to the file. Now we will have the thumbnail into the file named by $filename
    if (!strcmp("png", $ext))
      imagepng($dst_img, $filename);
    else
      imagejpeg($dst_img, $filename);

    //destroys source and destination images.
    imagedestroy($dst_img);
    imagedestroy($src_img);
  }

  // This function reads the extension of the file.
  // It is used to determine if the file is an image by checking the extension.
  function getExtension($str) {
    $i = strrpos($str, ".");
    if (!$i) {
      return "";
    }
    $l = strlen($str) - $i;
    $ext = substr($str, $i + 1, $l);
    return $ext;
  }

  // This function reads the name of the file
  function getName($str) {
    $extension = getExtension($str);
    return rtrim($str, '.' . $extension);
  }

  /// Error Messages 
  if ($_FILES["file"]["error"] > 0) {
    switch ($_FILES['file']['error'])
    {     
      case 1:
              $msg = "The file is bigger than this PHP installation allows";
              break;
      case 2:
              $msg = "The file is bigger than this form allows";
              break;
       case 3:
              $msg = "Only part of the file was uploaded";
              break;
       case 4:
             $msg = "No file was uploaded";
              break;
       case 6:
             $msg = "Missing a temporary folder";
              break;
       case 7:
             $msg = "Failed to write file to disk";
             break;
       case 8:
             $msg = "File upload stopped by extension";
             break;
       default:
            $msg = "unknown error ".$_FILES['Filedata']['error'];
            break;
    }
    // Error alert!
    $alert = "Error: ".$_FILES['file']['error']."\nError Info: ".$msg;

  }
  else {
    // Phân quyền user quản lý ảnh
    $has_user = false;
    $user_id = $_POST['user_id'];

    // file_name = name + extension
    $file_name = str_replace(" ", "", $_FILES["file"]["name"]);
    $name      = getName($file_name); // name
    $extension = getExtension($file_name); // extension

    // create thumbnail name, example: abc_165x95.jpg
    $thumbnail_name = $name . "_" . WIDTH . "x" . HEIGHT . "." . $extension;

    $title      = $_POST['cover_title'];  // Title of Image
    $image_size = round( ($_FILES["file"]["size"] / (1024*1024)), 2) . " MB"; // size of image

    $path = Request::server('HTTP_HOST')."/upload/";
    $upload_path_image      = $path . $user_id . "/";
    $upload_path_thumbnail  = $upload_path_image . "thumbnails/" . $user_id . "/";

    if(!is_dir($upload_path_image)) {
      mkdir($upload_path_image, 0775, true);
    }
    if(!is_dir($upload_path_thumbnail)) {
      mkdir($upload_path_thumbnail , 0775, true);
    }

    $url        = $upload_path_image . $file_name; // image location in store
    $url_thumb  = $upload_path_thumbnail . $thumbnail_name; // thumbnail location in store
    
    // Save file
    move_uploaded_file($_FILES["file"]["tmp_name"], $url);

    // Create thumbnail image
    make_thumb($url, $url_thumb, WIDTH, HEIGHT);

    // Save image info
    $sXML = new SimpleXMLElement('uploaded.xml', null, true); // Load the entire xml
    
    // Check user has exists in XML
    foreach ($sXML as $user) {
      if($user['uid'] == $user_id) {
        $image_id = $user->count() + 1;
        $newchild = $user->addChild("cover");
          $newchild->addAttribute("pid", $user_id . $image_id); // string Id image = user_id + image_id in user
          $newchild->addChild("title", $title);
          $newchild->addChild("image_name", $file_name);
          $newchild->addChild("image_size", $image_size);
          $newchild->addChild("image_source", $url);
          $newchild->addChild("thumbnail_name", $thumbnail_name);
          $newchild->addChild("thumbnail_size", ' ');
          $newchild->addChild("thumbnail_source", $url_thumb);
        $sXML->asXML('uploaded.xml');
        $has_user = true;
        break;
      }
    }
    // Add new user if current user not exits in XML
    if(!$has_user) {
      $newchild_user = $sXML->addChild("user");
        $newchild_user->addAttribute("uid", $user_id);  
        $newchild_cover = $newchild_user->addChild("cover");
        $newchild_cover->addAttribute("pid", $user_id . '1'); //Notice am now using the $newchild object not the $sXML object
        $newchild_cover->addChild("title", $title);
        $newchild_cover->addChild("image_name", $file_name);
        $newchild_cover->addChild("image_size", $image_size);
        $newchild_cover->addChild("image_source", $url);
        $newchild_cover->addChild("thumbnail_name", $thumbnail_name);
        $newchild_cover->addChild("thumbnail_size", ' ');
        $newchild_cover->addChild("thumbnail_source", $url_thumb);
      $sXML->asXML('uploaded.xml');
    }
    // Success Alert!
    $alert = "Upload Success! \nCover title: $title \nSize: $image_size";
  }
  echo $alert;

} else {
  echo 'Warning [903]: Not permission!';
}