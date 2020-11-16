<?php
	include_once 'connection.php';
	$response=array();
	if(isset($_COOKIE['uid']) && $_COOKIE['uid']!="")
	{
		$user_id=$_COOKIE['uid'];
		$user_data=getUsersData($user_id);
		$is_utube_video=0;
		$uploadOk=1;
		if((isset($_POST['is_utube_video']) && $_POST['is_utube_video']=="1"))
		{
			$is_utube_video=$_POST['is_utube_video'];
			$size="";
			$imageFileType="mp4";
			$uploadOk=1;
			$utube_url=filter_var($_POST['utube_url'],FILTER_SANITIZE_STRING);
			if($utube_url=="")
			{
				$uploadOk=0;
			}
			$arr=explode("watch?v=",$utube_url);
			if(count($arr)>1)
			{
				$target_file=$arr[1];
			}
			else{
				$uploadOk="0";
			}
		}
		else if(isset($_FILES['profile_video_cv']['tmp_name']) && $_FILES['profile_video_cv']['tmp_name']!="" && $_FILES['profile_video_cv']['tmp_name']!=null)
		{
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
			if($uploadOk=="1")
			{
				if(move_uploaded_file($_FILES["profile_video_cv"]["tmp_name"], $target_file))
				{
					$uploadOk=1;
					
				}
				else
				{
					$uploadOk=0;
				}
			}
		}
		else
		{
			//$img_type=$imageFileType;
			//$type="video/".$img_type;
			$uploadOk=2;
			$video_title=filter_var(addslashes($_POST['video_title']),FILTER_SANITIZE_STRING);
			$video_description=filter_var(addslashes($_POST['video_description']),FILTER_SANITIZE_STRING);
			$video_tags=filter_var(addslashes($_POST['video_tags']),FILTER_SANITIZE_STRING);
			$video_type=filter_var(addslashes($_POST['video_type']),FILTER_SANITIZE_STRING);
			$id=$_POST['token'];
			$company_id=$_POST['company_id'];
			$query="UPDATE company_videos SET video_description='$video_description',video_title='$video_title',video_type='$video_type',added=NOW(),video_tags='$video_tags' WHERE id='$id'";
			$result=mysqli_query($conn,$query);
			if($result)
			{
				$media_id=$id;
				$query="UPDATE company_videos SET status=0 WHERE company_id='$company_id' AND id!='$media_id'";
				mysqli_query($conn,$query);
				$query="SELECT * FROM company_videos WHERE id='$id'";
				$result=mysqli_query($conn,$query);
				$row=mysqli_fetch_array($result);
				$is_utube_video=$row['is_utube_video'];
				$data=base_url.$row['video_file'];
				if($is_utube_video=="1")
				{
					$data="https://www.youtube.com/embed/".$row['file_name']."?rel=0&autoplay=0&mute=1";
				}
				$response['status']="success";
				$response['id']=$media_id;
				$response['video_title']=$row['video_title'];
				$response['video_tags']=$row['video_tags'];
				$response['data']=showVideo($data);
				echo json_encode($response);die();
			}
			else
			{
				$response['status']="error";
				$response['message']="Server error please contact developer.";
				echo json_encode($response);die();
			}
		}
		if($uploadOk==1)
		{
			$img_type=$imageFileType;
			$type="video/".$img_type;
			
			$video_title=filter_var(addslashes($_POST['video_title']),FILTER_SANITIZE_STRING);
			$video_description=filter_var(addslashes($_POST['video_description']),FILTER_SANITIZE_STRING);
			$video_tags=filter_var(addslashes($_POST['video_tags']),FILTER_SANITIZE_STRING);
			$video_type=filter_var(addslashes($_POST['video_type']),FILTER_SANITIZE_STRING);
			$company_id=$_POST['company_id'];
			$query="INSERT INTO company_videos SET video_description='$video_description',video_title='$video_title',video_type='$video_type',video_file='$target_file',size='$size',type='$type',company_id='$company_id',added=NOW(),video_tags='$video_tags',is_utube_video='$is_utube_video'";
			$result=mysqli_query($conn,$query);
			if($result)
			{
				$media_id=mysqli_insert_id($conn);
				$query="UPDATE company_videos SET status=0 WHERE company_id='$company_id' AND id!='$media_id'";
				mysqli_query($conn,$query);
				$data=base_url."uploads/".$image_file_name;
				if($is_utube_video=="1")
				{
					$data="https://www.youtube.com/embed/".$target_file."?rel=0&autoplay=0&mute=1&muted";
				}
				$response['status']="success";
				$response['id']=$media_id;
				$response['video_title']=$video_title;
				$response['video_tags']=$video_tags;
				$response['data']=showVideo($data);
				echo json_encode($response);die();
			}
			else
			{
				$response['status']="error";
				$response['message']="Server error please contact developer.";
				echo json_encode($response);die();
			}
		}
		else if($uploadOk=="0")
		{
			$response['status']="error";
			$response['message']="Server error please contact developer as video upload is having some issue.";
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