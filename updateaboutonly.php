<?php
	include_once 'connection.php';
	$response=array();
	if(isset($_COOKIE['uid']) && $_COOKIE['uid']!="")
	{
		$user_id=$_COOKIE['uid'];
		$about=strip_tags(filter_var($_REQUEST['about'],FILTER_SANITIZE_STRING));
		$query="SELECT id FROM users_personal WHERE user_id='$user_id'";
		$result=mysqli_query($conn,$query);
		if(mysqli_num_rows($result)>0)
		{
			mysqli_query($conn,"UPDATE users_personal SET about='$about' WHERE user_id='$user_id'");
		}
		else
		{
			mysqli_query($conn,"INSERT INTO users_personal SET about='$about',user_id='$user_id'");
		}
		$response['status']="success";
		$response['data']=$about;
	}
	else
	{
		$response['status']="error";
		$response['message']="Session logged out please login first.";
	}
	echo json_encode($response);
?>