<?php
	include_once 'blogger-connect.php';
	$response=array();
	$blog_url=filter_var($_POST['blog_url'],FILTER_SANITIZE_URL);
	$blog_query="SELECT id FROM users_blogs WHERE blog_url='$blog_url'";
	$blog_result=mysqli_query($conn,$blog_query);
	if(mysqli_num_rows($blog_result)>0)
	{
		$response['status']="0";
	}
	else
	{
		$response['status']="1";
	}
	echo json_encode($response);
?>