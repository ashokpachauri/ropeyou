<?php
	include_once 'connection.php';
	$response=array();
	if(isset($_COOKIE['uid']) && $_COOKIE['uid']!="")
	{
		$user_id=$_COOKIE['uid'];
		if(isset($_FILES['profile_video_cv']['tmp_name']) && $_FILES['profile_video_cv']['tmp_name']!="" && $_FILES['profile_video_cv']['tmp_name']!=null)
		{
			$user_data=getUsersData($user_id);
			$target_dir="uploads/";
			$image_file_name=$user_data['username'].'-'.mt_rand(0,99999).'-'.str_replace(" ","-",trim(basename($_FILES["profile_video_cv"]["name"])));
			$target_file = $target_dir . $image_file_name;
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			$size=$_FILES["profile_video_cv"]["size"];
			if ($size > 50000000) {
				$error_message="File size should not exceeds 50 mb.<br/>";
				$uploadOk = 0;
			}
			$check_array=array("mp4");
			if(!in_array($imageFileType,$check_array))
			{
				$error_message=$error_message."Only mp4 extensions allowed.<br/>";
				$uploadOk = 0;
			}
			if($uploadOk==1)
			{
				if(move_uploaded_file($_FILES["profile_video_cv"]["tmp_name"], $target_file))
				{
					$img_type=$imageFileType;
					$type="video/".$img_type;
					
					$profile_title=filter_var(addslashes($_POST['profile_title']),FILTER_SANITIZE_STRING);
					$resume_headline=filter_var(addslashes($_POST['resume_headline']),FILTER_SANITIZE_STRING);
					$video_tags=filter_var(addslashes($_POST['video_tags']),FILTER_SANITIZE_STRING);
					$profile_type=filter_var(addslashes($_POST['profile_type']),FILTER_SANITIZE_STRING);
					
					$query="INSERT INTO users_resume SET is_default=1,resume_headline='$resume_headline',profile_title='$profile_title',profile_type='$profile_type',file_title='$image_file_name',file='$target_file',size='$size',type='$type',user_id='$user_id',added=NOW(),video_tags='$video_tags'";
					$result=mysqli_query($conn,$query);
					if($result)
					{
						$media_id=mysqli_insert_id($conn);
						mysqli_query($conn,"UPDATE users_resume SET is_default=0 WHERE profile_type!=1 AND user_id='$user_id' AND id!='$media_id'");
					
						$data=base_url."uploads/".$image_file_name;
						$response['status']="success";
						$response['id']=$media_id;
						$response['profile_title']=$profile_title;
						$response['video_tags']=$video_tags;
						$response['data']=$data;
						echo json_encode($response);die();
					}
					else
					{
						$response['status']="error";
						$response['message']="Server error please contact developer.";
						echo json_encode($response);die();
					}
				}	
				else
				{
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
			if(isset($_POST['token']) && $_POST['token']!='')
			{
				$id=$_POST['token'];
				$profile_title=filter_var(addslashes($_POST['profile_title']),FILTER_SANITIZE_STRING);
				$resume_headline=filter_var(addslashes($_POST['resume_headline']),FILTER_SANITIZE_STRING);
				$video_tags=filter_var(addslashes($_POST['video_tags']),FILTER_SANITIZE_STRING);
				$profile_type=filter_var(addslashes($_POST['profile_type']),FILTER_SANITIZE_STRING);
				
				$query="UPDATE users_resume SET is_default=1,resume_headline='$resume_headline',profile_title='$profile_title',profile_type='$profile_type',user_id='$user_id',added=NOW(),video_tags='$video_tags' WHERE id='$id'";
				
				$result=mysqli_query($conn,$query);
				if($result)
				{
					mysqli_query($conn,"UPDATE users_resume SET is_default=0 WHERE profile_type!=1 AND user_id='$user_id' AND id!='$id'");
					$query="SELECT * FROM users_resume WHERE id='$id'";
					$result=mysqli_query($conn,$query);
					$row=mysqli_fetch_array($result);
					$image_file_name=$row['file'];
					$data=base_url.$image_file_name;
					$response['status']="success";
					$response['id']=$id;
					$response['data']=$data;
					$response['profile_title']=$profile_title;
					$response['video_tags']=$video_tags;
					echo json_encode($response);die();
				}
				else
				{
					$response['status']="error";
					$response['message']=$query;//"Server error please contact developer.";
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
	}
	else
	{
		$response['status']="error";
		$response['message']="Session out please login";
		echo json_encode($response);die();
	}
?>