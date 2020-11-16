<?php
	include_once 'connection.php';
	$post_id=$_REQUEST['post_id'];
	$response=array();
	if($post_id!="")
	{
		
	}
	else
	{
		$response['status']="error";
	}
	echo json_encode($response);
?>