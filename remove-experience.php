<?php
	include_once 'connection.php';
	$response=array();
	if(isset($_COOKIE['uid']) && $_COOKIE['uid']!="")
	{
		$item_token=$_POST['item_token'];
		$user_id=$_COOKIE['uid'];
		if($item_token!="")
		{
			$query="DELETE FROM users_work_experience WHERE id='$item_token' AND user_id='$user_id'";
			if(mysqli_query($conn,$query))
			{
				$response['status']="success";
				$response['message']="Removed successfully";
			}
			else{
				$response['status']="error";
				$response['message']="Server error please contact developer.";
			}
		}
	}
	else
	{
		$response['status']="error";
		$response['message']="Session logged out try login.";
	}
	echo json_encode($response);
?>