<?php
	include_once 'connection.php';
	$response=array();
	if(isset($_COOKIE['uid']) && $_COOKIE['uid']!="")
	{
		$user_id=$_COOKIE['uid'];
		if(isset($_FILES['user_profile_picture_field']['tmp_name']) && $_FILES['user_profile_picture_field']['tmp_name']!="" && $_FILES['user_profile_picture_field']['tmp_name']!=null)
		{
			$user_data=getUsersData($user_id);
			$target_dir="uploads/";
			$image_file_name=$user_data['username'].'-'.mt_rand(0,99999).'-'.str_replace(" ","-",trim(basename($_FILES["user_profile_picture_field"]["name"])));
			$target_file = $target_dir . $image_file_name;
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			$size=$_FILES["user_profile_picture_field"]["size"];
			if ($size > 50000000) {
				$error_message="File size should not exceeds 50 mb.<br/>";
				$uploadOk = 0;
			}
			$check_array=array("jpg","jpeg","png");
			if(!in_array($imageFileType,$check_array))
			{
				$error_message=$error_message."Only .jpg,.png extensions allowed.<br/>";
				$uploadOk = 0;
			}
			if($uploadOk==1)
			{
				if(move_uploaded_file($_FILES["user_profile_picture_field"]["tmp_name"], $target_file))
				{
					$img_type=$imageFileType;
					if($imageFileType=="jpg")
					{
						$img_type="jpeg";
					}
					$type="image/".$img_type;
					
					$query="INSERT INTO gallery SET title='$image_file_name',file='$target_file',size='$size',type='$type',is_main=1,user_id='$user_id',date=NOW()";
					$result=mysqli_query($conn,$query);
					if($result)
					{
						$media_id=mysqli_insert_id($conn);
						$query="SELECT id FROM users_profile_pics WHERE user_id='$user_id'";
						$result=mysqli_query($conn,$query);
						if(mysqli_num_rows($result)>0)
						{
							$row=mysqli_fetch_array($result);
							$m_id=$row['id'];
							$query="UPDATE users_profile_pics SET media_id='$media_id',user_id='$user_id',status=1,added=NOW(),type='$type',caption='$image_file_name' WHERE id='$m_id'";
							$result=mysqli_query($conn,$query);
							if($result)
							{
								$data=base_url."uploads/".$image_file_name;
								$response['status']="success";
								$response['id']=$m_id;
								$response['data']=$data;
								echo json_encode($response);die();
							}
							else{
								$response['status']="error";
								$response['message']="Server error please contact developer.";
								echo json_encode($response);die();
							}
						}
						else
						{
							$query="INSERT INTO users_profile_pics SET media_id='$media_id',user_id='$user_id',status=1,added=NOW(),type='$type',caption='$image_file_name'";
							$result=mysqli_query($conn,$query);
							if($result)
							{
								$data=base_url."uploads/".$image_file_name;
								$response['status']="success";
								$response['id']=mysqli_insert_id($conn);
								$response['data']=$data;
								echo json_encode($response);die();
							}
							else{
								$response['status']="error";
								$response['message']="Server error please contact developer.";
								echo json_encode($response);die();
							}
						}
					}
					else
					{
						$response['status']="error";
						$response['message']="Server error please contact developer.";
						echo json_encode($response);die();
					}
				}	
				else{
					$error_message=$error_message."Error Uploading Image";
				}
			}
			else
			{
				$response['status']="error";
				$response['message']=$error_message;
				echo json_encode($response);die();
			}
		}
		else
		{
			$response['status']="error";
			$response['message']="Empty or invalid file.";
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