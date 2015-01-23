<?php

	if(isset($_GET['cover_id']) && isset($_GET['user_id'])) {
		$user_id = $_GET['user_id'];
		$cover_id = $_GET['cover_id'];
		$sXML = new SimpleXMLElement('uploaded.xml', null, true);
		$node = $sXML->xpath("user[@uid={$user_id}]/cover[@pid={$cover_id}]");
		
		// is String, Not control
		$image_source = ''.$node[0]->image_source;
		$thumbnail_source = ''.$node[0]->thumbnail_source;

		// remove node 
		unset($node[0]->{0});
		
		// check that image has exists another node?
		$exists_image = false;
		foreach ($sXML as $cover) {
			if($cover->image_source == $image_source){
				$exists_image = true;
			}
		}

		// lưu thay đổi
		$sXML->asXml('uploaded.xml'); 
		
		// Delete image file 
		if(!$exists_image){
			$image_source = explode('/', $image_source);
			$image_source = end($image_source);
			$thumbnail_source = explode('/', $thumbnail_source);
			$thumbnail_source = end($thumbnail_source);

			// Xóa hình khỏi ổ đĩa
			$images_dir = dirname(realpath(__FILE__)).'\\upload';
			$thumbnail_dir = $images_dir .'\\thumbnails';

			$image_files = scandir($images_dir);
			$thumbnail_files = scandir($thumbnail_dir);

			// Xóa image
			foreach ($image_files as $file) {
				if($file == $image_source){
		            unlink("$images_dir\\$file");
		        }
			}
			// Xóa thumbnail
			foreach ($thumbnail_files as $file) {
				if($file == $thumbnail_source){
					unlink("$thumbnail_dir\\$file");
				}
			}
			// echo "$images_dir\\$file";
		}
		// Delete success
	} else {
		echo 'Warning [903]: Not permission!';
	}
	
	