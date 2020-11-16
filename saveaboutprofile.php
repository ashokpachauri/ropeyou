<?php
	include_once 'connection.php';
	$response=array();
	if(isset($_COOKIE['uid']) && $_COOKIE['uid']!="")
	{
		$additional_check_query="";
		$insert_query="";
		$insert_query_end="";
		$user_id=$_COOKIE['uid'];
		
		$relocate_abroad=filter_var($_POST['relocate_abroad'],FILTER_SANITIZE_STRING);
		$passport=filter_var($_POST['passport'],FILTER_SANITIZE_STRING);
		$about=addslashes(filter_var($_POST['about'],FILTER_SANITIZE_STRING));
		
		$country=filter_var($_POST['country'],FILTER_SANITIZE_STRING);
		$city=filter_var($_POST['city'],FILTER_SANITIZE_STRING);
		
		$address=filter_var($_POST['address'],FILTER_SANITIZE_STRING);
		$pincode=filter_var($_POST['pincode'],FILTER_SANITIZE_STRING);
		
		
		$query="INSERT INTO users_personal SET relocate_abroad='$relocate_abroad',passport='$passport',about='$about',country='$country',home_town='$city',address='$address',user_id='$user_id',pincode='$pincode'";
		$additional_check_query="SELECT * FROM users_personal WHERE user_id='$user_id'";
		$additional_check_result=mysqli_query($conn,$additional_check_query);
		if(mysqli_num_rows($additional_check_result)>=0)
		{
			$query="UPDATE users_personal SET relocate_abroad='$relocate_abroad',passport='$passport',about='$about',country='$country',home_town='$city',address='$address',pincode='$pincode' WHERE user_id='$user_id'";
		}
		
		$result=mysqli_query($conn,$query);
		if($result)
		{
			$response['status']="success";
			$response['message']="Data Saved Successfully";
			echo json_encode($response);die();
		}
		else
		{
			$response['status']="error";
			$response['message']="Database error please contact developer";
			echo json_encode($response);die();
		}
	}
	else
	{
		$response['status']="error";
		$response['message']="Session Out Please Login Again";
		echo json_encode($response);die();
	}
?>