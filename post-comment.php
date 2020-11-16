<?php
	include_once 'connection.php';
	$user_id=$_COOKIE['uid'];
	$post_id=$_POST['post_id'];
	$arr=array();
	$comment_text=filter_var(addslashes($_POST['comment_text']),FILTER_SANITIZE_STRING);
	if($comment_text=="")
	{
		$arr['status']="error";
		$arr['message']="Blank comment can not be posted.";
	}
	else
	{
		$query="INSERT INTO users_posts_comments SET user_id='$user_id',post_id='$post_id',comment_text='$comment_text'";
		if(mysqli_query($conn,$query))
		{
			$arr['status']="success";
			$arr['id']=mysqli_insert_id($conn);
			$arr['comment_text']=$comment_text;
		}
		else{
			$arr['status']="error";
			$arr['message']="We are fixing it.please try after a moment.";
			$arr['debug']=$query;
		}
	}
	echo json_encode($arr);
?>