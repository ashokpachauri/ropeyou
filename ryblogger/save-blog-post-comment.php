<?php
	include_once 'blogger-connect.php';
	$user_id=$_COOKIE['blogger_id'];
	$blog_id=$_REQUEST['blog_id'];
	$post_id=$_REQUEST['post_id'];
	$comment_text=addslashes(filter_var($_REQUEST['comment_text'],FILTER_SANITIZE_STRING));
	$query="INSERT INTO tbl_blog_post_comments SET user_id='$user_id',blog_id='$blog_id',post_id='$post_id',comment_text='$comment_text',added=NOW()";
	if(mysqli_query($conn,$query))
	{
		echo json_encode(array("status"=>"success"));
	}
	else{
		echo json_encode(array("status"=>"error"));
	}
?>