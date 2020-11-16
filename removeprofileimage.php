<?php
	include_once 'connection.php';
	$response=array();
	if(isset($_COOKIE['uid']) && $_COOKIE['uid']!="")
	{
		$user_id=$_COOKIE['uid'];
		if(isset($_POST['id']) && $_POST['id']!='')
		{
			$token=$_POST['id'];
			$query="SELECT * FROM users_profile_pics WHERE id='$token' AND user_id='$user_id'";
			$result=mysqli_query($conn,$query);
			if(mysqli_num_rows($result)>0)
			{
				$result=mysqli_query($conn,"UPDATE users_profile_pics SET caption='',type='',added=NOW() WHERE id='$token'");
				if($result)
				{
					$response['status']="success";
					$response['id']=$token;
					$response['data']=getUserProfileImage($user_id);
					echo json_encode($response);die();
				}
				else
				{
					$response['status']="error";
					$response['message']="Server error please contact developer";
					echo json_encode($response);die();
				}
			}
			else
			{
				$response['status']="error";
				$response['message']="you are not authorised to change image";
				echo json_encode($response);die();
			}
		}
		else
		{
			$response['status']="error";
			$response['message']="Invalid action";
			echo json_encode($response);die();
		}
	}
	else
	{
		$response['status']="error";
		$response['message']="Session out please login";
		echo json_encode($response);die();
	}
?>