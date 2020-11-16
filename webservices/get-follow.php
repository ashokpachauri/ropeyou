<?php
	include_once '../connection.php';
	$user_id=$_POST['user_id'];
	$uid=$_SESSION['uid'];
	$query="SELECT * FROM users_followers WHERE user_id='$user_id' AND follower_id='$uid'";
	$result=mysqli_query($conn,$query);
	if(mysqli_num_rows($result)>0)
	{
		$row=mysqli_fetch_array($result);
		$status=0;
		if($row['status']=="0")
		{
			$status=1;
		}
		mysqli_query($conn,"UPDATE users_followers SET status='$status' WHERE user_id='$user_id' AND follower_id='$uid'");
	}
	else
	{
		mysqli_query($conn,"INSERT INTO users_followers SET user_id='$user_id',follower_id='$uid',status=1,added=NOW()");
	}
?>