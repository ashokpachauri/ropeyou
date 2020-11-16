<?php
	include_once '../connection.php';
	$about=addslashes($_POST['about']);	
	$query="SELECT * FROM users_personal WHERE user_id='".$_COOKIE['uid']."'";
	$result=mysqli_query($conn,$query);
	$query_personal="INSERT INTO users_personal SET about='$about',user_id='".$_COOKIE['uid']."'";
	if(mysqli_num_rows($result)>0)
	{
		$query_personal="UPDATE users_personal SET about='$about' WHERE user_id='".$_COOKIE['uid']."'";
	}
	$result=mysqli_query($conn,$query_personal);
	if($result)
	{
		mysqli_query($conn,"INSERT INTO threats_to_user SET user_id='".$_COOKIE['uid']."',added=NOW(),message='Basic profile updated.Review your activities if you did not updated it.',heading='Basic profile updated.'");
		echo "success";
	}
	else
	{
		echo "error";
	}