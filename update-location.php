<?php
	include_once 'connection.php';
	$lattitude=$_POST['lattitude'];
	$longitude=$_POST['longitude'];
	$user_id=$_POST['user_id'];
	mysqli_query($conn,"UPDATE users SET lattitude='$lattitude',longitude='$longitude' WHERE id='$user_id'");
	echo "SUCCESS";
?>