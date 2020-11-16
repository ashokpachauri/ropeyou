<?php
	include_once 'connection.php';
	$user_id=$_COOKIE['uid'];
	$post_id=$_POST['post_id'];
	$data_feeling=$_POST['data_feeling'];
	mysqli_query($conn,"DELETE FROM users_posts_activity WHERE post_id='$post_id' AND user_id='$user_id' AND activity_id='Reacted'");
	mysqli_query($conn,"INSERT INTO users_posts_activity SET post_id='$post_id',user_id='$user_id',added=NOW(),activity_id='Reacted',data_feeling='$data_feeling'");
	echo "success";
?>