<?php
	include_once 'connection.php';
	$response=array();
	if(isset($_COOKIE['uid']) && $_COOKIE['uid']!="")
	{
		
	}
	else
	{
		
	}
	echo json_encode($response);
?>