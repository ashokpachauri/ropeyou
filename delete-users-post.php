<?php
	include_once 'connection.php';
	$id=$_POST['id'];
	$user_id=$_COOKIE['uid'];
	$response=array();
	if($id!="" && $user_id!="")
	{
		$query="SELECT * FROM users_posts WHERE id='$id' AND user_id='$user_id'";
		$result=mysqli_query($conn,$query);
		if(mysqli_num_rows($result)>0)
		{
			mysqli_query($conn,"DELETE FROM users_posts WHERE id='$id'");
			mysqli_query($conn,"DELETE FROM users_posts_comments WHERE post_id='$id'");
			mysqli_query($conn,"DELETE FROM users_posts_activities WHERE post_id='$id'");
			mysqli_query($conn,"DELETE FROM users_posts_media WHERE post_id='$id'");
			mysqli_query($conn,"DELETE FROM users_posts_tags WHERE post_id='$id'");
			mysqli_query($conn,"DELETE FROM users_posts_links WHERE post_id='$id'");
			mysqli_query($conn,"DELETE FROM users_posts_comments_media WHERE post_id='$id'");
			$response['status']="success";
		}
	}
	else
	{
		$response['status']="error";
		$response['mesg']="Invalid request missing parameters";
	}
	echo json_encode($response);
?>