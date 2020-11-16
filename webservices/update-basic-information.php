<?php
	include_once '../connection.php';
	$first_name=$_POST['first_name'];
	$last_name=$_POST['last_name'];
	$day_birth=$_POST['day_birth'];
	$month_birth=$_POST['month_birth'];
	$year_birth=$_POST['year_birth'];
	$address=$_POST['address'];
	$communication_email=$_POST['communication_email'];
	$communication_mobile=$_POST['communication_mobile'];
	$passport=$_POST['passport'];
	$relocate_abroad=$_POST['relocate_abroad'];
	
	$home_town=$_POST['home_town'];
	$country=$_POST['country'];
	
	$query="SELECT * FROM users_personal WHERE user_id='".$_COOKIE['uid']."'";
	$result=mysqli_query($conn,$query);
	$query_personal="INSERT INTO users_personal SET day_birth='$day_birth',month_birth='$month_birth',year_birth='$year_birth',home_town='$home_town',country='$country',user_id='".$_COOKIE['uid']."',relocate_abroad='$relocate_abroad',passport='$passport',communication_mobile='$communication_mobile',communication_email='$communication_email',address='$address'";
	if(mysqli_num_rows($result)>0)
	{
		$query_personal="UPDATE users_personal SET day_birth='$day_birth',month_birth='$month_birth',year_birth='$year_birth',home_town='$home_town',country='$country',relocate_abroad='$relocate_abroad',passport='$passport',communication_mobile='$communication_mobile',communication_email='$communication_email',address='$address' WHERE user_id='".$_COOKIE['uid']."'";
	}
	$query="UPDATE users SET first_name='$first_name',last_name='$last_name' WHERE id='".$_COOKIE['uid']."'";
	$result=mysqli_query($conn,$query);
	
	$result=mysqli_query($conn,$query_personal);
	if($result)
	{
		mysqli_query($conn,"INSERT INTO threats_to_user SET user_id='".$_COOKIE['uid']."',added=NOW(),message='Basic profile updated.Review your activities if you did not updated it.',heading='Basic profile updated.'");
		echo "success";
	}
	else
	{
		echo "error";
	}