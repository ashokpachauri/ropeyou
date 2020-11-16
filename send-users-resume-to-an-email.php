<?php
	include_once 'connection.php';
	$user_id=$_COOKIE['uid'];
	$query="SELECT * FROM resume_creator WHERE user_id='$user_id'";
	$result=mysqli_query($conn,$result);
	if(mysqli_num_rows($result)>0)
	{
		$email=$_POST['email'];
		$subject=$_POST['subject'];
		$text_message=$_POST['text_message'];
		$email_content=share_resume_email_html;
		$email_content=str_replace("RY-EMAIL",$email,$email_content);
		$email_content=str_replace("RY-SUBJECT",$subject,$email_content);
		$email_content=str_replace("RY-MESSAGE",$text_message,$email_content);
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: <no-reply@ropeyou.com>' . "\r\n";
		
		mail($email,$subject,$email_content,$headers);
		echo "success";
	}
	else
	{
		echo "error";
	}
?>