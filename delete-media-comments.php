<?php
	$response=array();
	include_once 'connection.php';
	$id=$_POST['id'];
	$query="DELETE FROM media_comments WHERE id='$id' AND user_id='".$_COOKIE['uid']."'";
	if(mysqli_query($conn,$query))
	{
		$response['status']="success";
		$response['id']=$id;
	}
	else{
		$response['status']="error";
	}
	echo json_encode($response);
?>