<?php
	include_once 'connection.php';
	$response=array();
	if(isset($_COOKIE['uid']) && $_COOKIE['uid']!="")
	{
		$additional_check_query="";
		$insert_query="";
		$insert_query_end="";
		$user_id=$_COOKIE['uid'];
		
		$additional_check_query="SELECT * FROM users_personal WHERE user_id='$user_id'";
		$additional_check_result=mysqli_query($conn,$additional_check_query);
		if(mysqli_num_rows($additional_check_result)==0)
		{
			$additional_check_query="";
			$insert_query="INSERT INTO ";
			$insert_query_end="";
		}
		else
		{
			$additional_check_query=" AND user_id!='$user_id'";
			$insert_query="UPDATE ";
			$insert_query_end=" WHERE user_id='$user_id'";
		}
		
		$mobile_visibility=filter_var($_POST['mobile_visibility'],FILTER_SANITIZE_STRING);
		$first_name=filter_var($_POST['first_name'],FILTER_SANITIZE_STRING);
		$last_name=filter_var($_POST['last_name'],FILTER_SANITIZE_STRING);
		$phonecode=filter_var($_POST['phonecode'],FILTER_SANITIZE_STRING);
		
		$username=filter_var($_POST['username'],FILTER_SANITIZE_STRING);
		$day_birth=filter_var($_POST['day_birth'],FILTER_SANITIZE_STRING);
		
		$month_birth=filter_var($_POST['month_birth'],FILTER_SANITIZE_STRING);
		
		$year_birth=filter_var($_POST['year_birth'],FILTER_SANITIZE_STRING);
		
		$communication_email=filter_var($_POST['communication_email'],FILTER_SANITIZE_STRING);
		$communication_mobile=filter_var($_POST['communication_mobile'],FILTER_SANITIZE_STRING);
		
		$gender=filter_var($_POST['gender'],FILTER_SANITIZE_STRING);
		
		$check_query="SELECT * FROM users WHERE id!='$user_id' AND username='$username'";
		$check_result=mysqli_query($conn,$check_query);
		$check_num_rows=mysqli_num_rows($check_result);
		if($check_num_rows>0)
		{
			$response['status']="error";
			$response['message']="Username already taken";
			$user_query="SELECT username FROM users WHERE id='$user_id'";
			$user_result=mysqli_query($conn,$user_query);
			$user_row=mysqli_fetch_array($user_result);
			$username=$user_row['username'];
			//echo json_encode($response);die();
		}
		$null=null;
		$query2="SELECT * FROM users WHERE id='$user_id' AND email IS NULL";
		$result2=mysqli_query($conn,$query2);
		if(mysqli_num_rows($result2)>0)
		{
			$query="SELECT * FROM users WHERE email='$communication_email' AND id!='$user_id'";
			$result=mysqli_query($conn,$result);
			if(mysqli_num_rows($result)<=0)
			{
				mysqli_query($conn,"UPDATE users SET email='$communication_email' WHERE id='$user_id'");
			}
		}
		$query3="SELECT * FROM users WHERE id='$user_id' AND mobile IS NULL";
		$result3=mysqli_query($conn,$query3);
		if(mysqli_num_rows($result3)>0)
		{
			$query="SELECT * FROM users WHERE mobile='$communication_mobile' AND id!='$user_id'";
			$result=mysqli_query($conn,$result);
			if(mysqli_num_rows($result)<=0)
			{
				mysqli_query($conn,"UPDATE users SET mobile='$communication_mobile' WHERE id='$user_id'");
			}
		}
		
		$check_query="SELECT * FROM users WHERE user_id!='$user_id' AND (communication_email='$communication_email' OR (communication_mobile='$communication_mobile' AND phonecode='$phonecode'))";
		$check_result=mysqli_query($conn,$check_query);
		$check_num_rows=mysqli_num_rows($check_result);
		if($check_num_rows>0)
		{
			//$response['status']="error";
			$response['status']="error";
			if($response['message']=="")
			{
				$response['message']="Communication email or(and) mobile is being used with some other account.Please enter different email or(and) mobile.";
			}
			$query="SELECT communication_email,communication_mobile FROM users_personal WHERE user_id='$user_id'";
			$result=mysqli_query($conn,$query);
			$row=mysqli_fetch_array($result);
			$communication_email=$row['communication_email'];
			$communication_mobile=$row['communication_mobile'];
			//echo json_encode($response);die();
		}
		$query="SELECT * FROM users_personal WHERE user_id='$user_id'";
		$result=mysqli_query($conn,$query);
		$query="INSERT INTO users_personal SET mobile_visibility='$mobile_visibility',communication_email='$communication_email',phonecode='$phonecode',communication_mobile='$communication_mobile',day_birth='$day_birth',month_birth='$month_birth',year_birth='$year_birth',gender='$gender',user_id='$user_id'";
		if(mysqli_num_rows($result)>0)
		{
			$query="UPDATE users_personal SET mobile_visibility='$mobile_visibility',communication_email='$communication_email',phonecode='$phonecode',communication_mobile='$communication_mobile',day_birth='$day_birth',month_birth='$month_birth',year_birth='$year_birth',gender='$gender' WHERE user_id='$user_id'";
		}
		$query1="UPDATE users SET first_name='$first_name',last_name='$last_name',username='$username' WHERE id='$user_id'";
		$result1=mysqli_query($conn,$query1);
		$result=mysqli_query($conn,$query);
		if($result && $result1)
		{
			if($response['status']=="")
			{
				$response['status']="success";
			}
			if($response['message']=="")
			{
				$response['message']="Data Saved Successfully.";
			}
			echo json_encode($response);die();
		}
		else
		{
			$response['status']="error";
			if($response['message']=="")
			{
				$response['message']="Database error please contact developer";
			}
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