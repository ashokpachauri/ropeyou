<?php
	include_once 'connection.php';
	$user_id=$_COOKIE['uid'];
	$post_id=$_POST['post_id'];
	mysqli_query($conn,"DELETE FROM users_posts_activity WHERE post_id='$post_id' AND user_id='$user_id' AND activity_id='Reacted'");
	echo "success";
?>