<?php
	include_once 'connection.php';
	$response=array();
	if(isset($_COOKIE['uid']) && $_COOKIE['uid']!="")
	{
		$user_id=$_COOKIE['uid'];
		$communication_email=filter_var(addslashes($_POST['communication_email']),FILTER_SANITIZE_STRING);
		$communication_mobile=filter_var(addslashes($_POST['communication_mobile']),FILTER_SANITIZE_STRING);
		$website=filter_var(addslashes($_POST['website']),FILTER_SANITIZE_STRING);
		$fb_p=filter_var(addslashes($_POST['fb_p']),FILTER_SANITIZE_STRING);
		$ig_p=filter_var(addslashes($_POST['ig_p']),FILTER_SANITIZE_STRING);
		$in_p=filter_var(addslashes($_POST['in_p']),FILTER_SANITIZE_STRING);
		$tw_p=filter_var(addslashes($_POST['tw_p']),FILTER_SANITIZE_STRING);
		
		$query="SELECT * FROM users_personal WHERE user_id!='$user_id' AND (communication_email='$communication_email' OR communication_mobile='$communication_mobile')";
		$result=mysqli_query($conn,$query);
		if(mysqli_num_rows($result)>0)
		{
			$response['status']="error";
			$response['message']="Email or mobile is being used with another account.";
		}
		else
		{
			$query="SELECT * FROM users_personal WHERE user_id='$user_id'";
			$result=mysqli_query($conn,$query);
			if(mysqli_num_rows($result)>0)
			{
				mysqli_query($conn,"UPDATE users_personal SET communication_email='$communication_email',communication_mobile='$communication_mobile',fb_p='$fb_p',ig_p='$ig_p',in_p='$in_p',tw_p='$tw_p',website='$website' WHERE user_id='$user_id'");
			}
			else
			{
				mysqli_query($conn,"INSERT INTO users_personal SET communication_email='$communication_email',communication_mobile='$communication_mobile',fb_p='$fb_p',ig_p='$ig_p',in_p='$in_p',tw_p='$tw_p',website='$website',user_id='$user_id'");
			}
			$response['status']="success";
			$response['email']=$communication_email;
			$response['mobile']=$communication_mobile;
			$response['website']=$website;
			$response['fb_p']=$fb_p;
			$response['ig_p']=$ig_p;
			$response['in_p']=$in_p;
			$response['tw_p']=$tw_p;
		}
	}
	else
	{
		$response['status']="error";
		$response['message']="Session out please contact developer.";
	}
	echo json_encode($response);
?>