<?php
	
	$data_path = 'uploaded.xml';
    $covers = new SimpleXMLElement($data_path, null, true);

	$filenameArray = [];

	// Check user
	$user_id = $_GET['user_id'];
	foreach ($covers as $user) {
		if($user['uid'] == $user_id){
			foreach ($user as $key => $cover) {
				array_push($filenameArray, array(
					'pid'				=> $cover['pid'], 
					'title'				=> $cover->title, 
					'image_name'		=> $cover->image_name,
					'image_size'		=> $cover->image_size,
					'image_source'		=> $cover->image_source,
					'thumbnail_name'	=> $cover->thumbnail_name,
					'thumbnail_source'	=> $cover->thumbnail_source
					)
				);
			}
			break;
		}
	}

	echo json_encode($filenameArray);