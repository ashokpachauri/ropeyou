<?php
	include_once 'connection.php';
	$response=array();
	$title=time()."-".strtolower(basename(str_replace(" ","-",$_FILES["file"]["name"])));
	$target_file="uploads/".$title;
	$file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	$file_type_img_arr=array("jpg","jpeg","png","gif");
	$file_type_vid_arr=array("mp4","mov","wmb","flv","avi");
	$type="image/".$file_type;
	if(in_array($file_type,$file_type_vid_arr))
	{
		$type="video/".$file_type;
	}
	$size=$_FILES["file"]["size"];
	if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
		$query="INSERT INTO gallery SET user_id='".$_COOKIE['uid']."',title='$title',file='$target_file',type='$type',size='$size',date=NOW(),is_banner=0,is_main=0,is_draft=1,is_private=1,is_professional=0";
		if(mysqli_query($conn,$query))
		{
			$response['id']=mysqli_insert_id($conn);
			$response['status']="success";
		}
	} 
	else 
	{
		$response['id']="";
		$response['status']="error";;
	}
	echo json_encode($response);
?>