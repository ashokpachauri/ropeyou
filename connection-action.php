<?php
	include_once 'connection.php';
	$method=$_POST['method'];
	$user_id=$_COOKIE['uid'];
	$r_user_id=$_POST['connection_user_id'];
	$response=array();
	if($method=="connect")
	{
		$query="SELECT * FROM user_joins_user WHERE (user_id='$user_id' AND r_user_id='$r_user_id') OR (r_user_id='$user_id' AND user_id='$r_user_id')";
		$result=mysqli_query($conn,$query);
		if(mysqli_num_rows($result)>0)
		{
			$row=mysqli_fetch_array($result);
			if($row['blocked']=="0")
			{
				if($row['r_user_id']==$user_id && $row['status']!="1")
				{
					$update_query="UPDATE user_joins_user SET status=4 WHERE id='".$row['id']."'";
					if(mysqli_query($conn,$update_query))
					{
						$response['status']="success";
						$response['message']="Connect request has been sent.";
					}
					else
					{
						$response['status']="error";
						$response['message']="Connect request can not be sent.";
					}
				}
				else if($row['user_id']==$user_id && $row['status']!="1")
				{
					$update_query="UPDATE user_joins_user SET status=1 WHERE id='".$row['id']."'";
					if(mysqli_query($conn,$update_query))
					{
						$response['status']="success";
						$response['message']="you are now connected.";
					}
					else
					{
						$response['status']="error";
						$response['message']="Connect request can not be proceed.";
					}
				}
				else
				{
					$response['status']="success";
					$response['message']="you are already connected.";
				}
			}
			else
			{
				$response['status']="error";
				$response['message']="user is not accepting requests right now.";
			}
		}
		else
		{
			$insert_query="INSERT INTO user_joins_user SET r_user_id='$user_id',user_id='$r_user_id',status=4,added=NOW()";
			if(mysqli_query($conn,$insert_query))
			{
				$response['status']="success";
				$response['message']="Connect request has been sent.";
			}
			else
			{
				$response['status']="error";
				$response['message']="Connect request can not be sent.";
			}
		}
	}
	else if($method=="disconnect")
	{
		$query="SELECT * FROM user_joins_user WHERE (user_id='$user_id' AND r_user_id='$r_user_id') OR (r_user_id='$user_id' AND user_id='$r_user_id')";
		$result=mysqli_query($conn,$query);
		if(mysqli_num_rows($result)>0)
		{
			$row=mysqli_fetch_array($result);
			$delete_query="DELETE FROM user_joins_user WHERE id='".$row['id']."'";
			if(mysqli_query($conn,$delete_query))
			{
				$response['status']="success";
				$response['message']="you are no longer connected.";
			}
			else
			{
				$response['status']="error";
				$response['message']="there is a problem in disconnecting with.";
			}
		}
		else
		{
			$response['status']="success";
			$response['message']="you are already disconnected.";
		}
	}
	else if($method=="accept")
	{
		$query="SELECT * FROM user_joins_user WHERE (user_id='$user_id' AND r_user_id='$r_user_id')";
		$result=mysqli_query($conn,$query);
		if(mysqli_num_rows($result)>0)
		{
			$row=mysqli_fetch_array($result);
			$update_query="UPDATE user_joins_user SET status=1 WHERE id='".$row['id']."'";
			if(mysqli_query($conn,$update_query))
			{
				$response['status']="success";
				$response['message']="you are connected now.";
			}
			else
			{
				$response['status']="error";
				$response['message']="there is a problem in connecting with.";
			}
		}
		else
		{
			$response['status']="error";
			$response['message']="you are not allowed to perform this action.";
		}
	}
	else if($method=="reject")
	{
		$query="SELECT * FROM user_joins_user WHERE (r_user_id='$user_id' AND user_id='$r_user_id')";
		$result=mysqli_query($conn,$query);
		if(mysqli_num_rows($result)>0)
		{
			$row=mysqli_fetch_array($result);
			$update_query="UPDATE user_joins_user SET status=3 WHERE id='".$row['id']."'";
			if(mysqli_query($conn,$update_query))
			{
				$response['status']="success";
				$response['message']="request has been rejected.";
			}
			else
			{
				$response['status']="error";
				$response['message']="there is a problem in rejecting with.";
			}
		}
		else
		{
			$response['status']="error";
			$response['message']="you are not allowed to perform this action.";
		}
	}
	else if($method=="cancel")
	{
		$query="SELECT * FROM user_joins_user WHERE (r_user_id='$user_id' AND user_id='$r_user_id')";
		$result=mysqli_query($conn,$query);
		if(mysqli_num_rows($result)>0)
		{
			$row=mysqli_fetch_array($result);
			$update_query="DELETE FROM user_joins_user WHERE id='".$row['id']."'";
			if(mysqli_query($conn,$update_query))
			{
				$response['status']="success";
				$response['message']="request has been cancelled.";
			}
			else
			{
				$response['status']="error";
				$response['message']="there is a problem in cancelling with.";
			}
		}
		else
		{
			$response['status']="error";
			$response['message']="you are not allowed to perform this action.";
		}
	}
	echo json_encode($response);
?>