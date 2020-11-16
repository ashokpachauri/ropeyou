<?php
	include_once 'connection.php';
	$response=array();
	$id=$_POST['id'];
	if(isset($_COOKIE['uid']) && $_COOKIE['uid']!="")
	{
		$user_id=$_COOKIE['uid'];
		$query="SELECT * FROM recommendations WHERE user_id='$user_id' AND id='$id'";
		$result=mysqli_query($conn,$query);
		if(mysqli_num_rows($result)>0)
		{
			mysqli_query($conn,"UPDATE recommendations SET status=2 WHERE id='$id'");
			$response['status']="success";
			$response['message']="Deleted successfully.";
		}
		else
		{
			$response['status']="error";
			$response['message']="Invalid action.";
		}
	}
	else
	{
		$response['status']="error";
		$response['message']="Session out please login.";
	}
	echo json_encode($response);
?>