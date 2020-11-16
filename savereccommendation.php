<?php
	include_once 'connection.php';
	$response=array();
	if(isset($_COOKIE['uid']) && $_COOKIE['uid']!="")
	{
		$user_id=$_COOKIE['uid'];
		$r_user_id=$_POST['r_user_id'];
		$custom_message=filter_var(strip_tags($_POST['custom_message']),FILTER_SANITIZE_STRING);
		$designation=filter_var(strip_tags($_POST['designation']),FILTER_SANITIZE_STRING);
		$query="SELECT * FROM recommendations WHERE r_user_id='$r_user_id' AND user_id='$user_id'";
		$result=mysqli_query($conn,$query);
		if(mysqli_num_rows($result)>0)
		{
			$response['status']="error";
			$response['messege']="You have already asked for recommendations to this user.";
		}
		else
		{
			$query="INSERT INTO recommendations SET user_id='$user_id',r_user_id='$r_user_id',custom_message='$custom_message',designation='$designation',status=0,added=NOW()";
			$result=mysqli_query($conn,$query);
			if($result)
			{
				$id=mysqli_insert_id($conn);
				$response['status']="success";
				$user_data=getUsersData($r_user_id);
				$data='<div class="d-flex border-bottom" style="width:100%;" id="rec_'.$id.'">
							<div class="col-3 border-right border-top p-1">
								<img class="img-fluid" style="border:1px solid gray;width:100% !important;border-radius: 50%;" src="'.getUserProfileImage($r_user_id).'">
							</div>
							<div class="col-9 border-top p-1">
								<h6 class="m-0" style="text-align:center;font-size:14px;">'.$user_data['first_name'].' '.$user_data['last_name'].' - <span style="color:red;">Pending</span><span style="float: right !important;">&nbsp;&nbsp;<a style="cursor:pointer;color:red;" title="Delete" onclick="deleteRec('.$id.');" href="javascript:void(0);"><i class="feather-trash-2"></i></a></span></h6>
								<p class="mt-1 p-1">'.$custom_message.'</p>
							</div>
						</div>';
				$response['data']=$data;
				$response['id']=$id;
			}
			else
			{
				$response['status']="error";
				$response['messege']="Server error.Please contact developer.";
			}
		}
	}
	else
	{
		$response['status']="error";
		$response['messege']="Session out please try login.";
	}
	echo json_encode($response);
?>