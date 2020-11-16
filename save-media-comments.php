<?php
	$response=array();
	include_once 'connection.php';
	$media_id=$_POST['media_id'];
	$user_id=$_POST['user_id'];
	$text_content=$_POST['text_content'];
	$comment_id=$_POST['comment_id'];
	if($comment_id!="" && $comment_id!=null)
	{
		$query="UPDATE media_comments SET media_id='$media_id',date=NOW(),user_id='$user_id',text_content='$text_content' WHERE id='$comment_id'";
		if(mysqli_query($conn,$query))
		{
			$response['status']="success";
			$response['id']=$comment_id;
			$response['user_id']=$user_id;
			$response['media_id']=$media_id;
		}
		else{
			$response['status']="error";
		}
	}
	else
	{
		$query="INSERT INTO media_comments SET media_id='$media_id',date=NOW(),user_id='$user_id',text_content='$text_content'";
		if(mysqli_query($conn,$query))
		{
			$response['status']="success";
			$response['id']=mysqli_insert_id($conn);
			$response['user_id']=$user_id;
			$response['media_id']=$media_id;
		}
		else{
			$response['status']="error";
		}
	}
	echo json_encode($response);
?>