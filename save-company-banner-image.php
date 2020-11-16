<?php
	include_once 'connection.php';
	$response=array();
	if(isset($_COOKIE['uid']) && $_COOKIE['uid']!="")
	{
		$user_id=$_COOKIE['uid'];
		$company_id=$_POST['company_id'];
		$banner_image=$_POST['banner_image'];
		$query="SELECT * FROM companies WHERE user_id='$user_id' AND id='".$company_id."'";
		$result=mysqli_query($conn,$query);
		if(mysqli_num_rows($result)>0)
		{
			$query="UPDATE companies SET banner_image='$banner_image' WHERE id='$company_id'";
			$result=mysqli_query($conn,$query);
			if($result)
			{
				$response['status']="success";
				$response['message']="Banner updated successfully.";
			}
			else
			{
				$response['status']="error";
				$response['message']="Some technical error has been occured.Please contact developer.";
			}
		}
		else{
			$response['status']="error";
			$response['message']="you are not authorised to make these changes.";
		}
	}
	else
	{
		$response['status']="error";
		$response['message']="Session Out Please Login.";
	}
	echo json_encode($response);
?>