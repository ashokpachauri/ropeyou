<?php
	include_once 'connection.php';
	$user_id=$_COOKIE['uid'];
	$result=array();
	$profile_type=$_POST['profile_type'];
	$file_name="video_cv_".$user_id.".mp4";
	$to_upload_file_name="uploads/".$file_name;
	$file_size=$_FILES["video"]["size"];
	if(move_uploaded_file($_FILES['video']['tmp_name'],$to_upload_file_name))
	{
		mysqli_query($conn,"UPDATE users_resume SET is_default=0 WHERE user_id='$user_id' AND profile_type!=1");
		$query="INSERT INTO users_resume SET profile_type='$profile_type',user_id='$user_id',is_default=1,resume_headline='Recent Video Profile',file='".$to_upload_file_name."',added=NOW(),status=1,profile_title='',file_title='$file_name',type='video/mp4',size='$file_size'";
		if(mysqli_query($conn,$query))
		{
			$result['status']="success";
		}
		else
		{
			$result['status']="error";
		}
	}
	else
	{
		$result['status']="error";
	}
	echo json_encode($result);
?>