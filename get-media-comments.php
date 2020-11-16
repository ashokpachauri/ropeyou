<?php
	$response=array();
	include_once 'connection.php';
	$id=$_POST['id'];
	$media_query="SELECT * FROM gallery WHERE id='$id'";
	$media_result=mysqli_query($conn,$media_query);
	$media_row=mysqli_fetch_array($media_result);
	#=====================================
		$response['text_content']=$media_row['text_content'];
		$response['date']=date("d M Y",strtotime($media_row['date']));
		$response['id']=$id;
		$response['user_id']=$media_row['user_id'];
		$response['count']=0;
		#================================================
			$users_query="SELECT * FROM users WHERE id='".$media_row['user_id']."'";
			$users_result=mysqli_query($conn,$users_query);
			$users_row=mysqli_fetch_array($users_result);
			$response['user']['id']=$users_row['id'];
			$response['user']['name']=ucwords(strtolower($users_row['first_name'].' '.$users_row['last_name']));
			$response['user']['profile_image']=getUserProfileImage($users_row['id']);
			$response['user']['profile_url']=base_url.'u/'.$users_row['username'];
		#================================================
	#=====================================
	$query="SELECT * FROM media_comments WHERE media_id='$id'";
	$result=mysqli_query($conn,$query);
	if(mysqli_num_rows($result)>0)
	{
		$comments_res=array();
		$response['count']=mysqli_num_rows($result);
		while($row=mysqli_fetch_array($result))
		{
			$comments=array();
			$comments['id']=$row['id'];
			$comments['text_content']=$row['text_content'];
			$comments['media_id']=$media_row['id'];
			$comments['user_id']=$row['user_id'];
			$comments['date']=date("d M Y h:m a",strtotime($row['date']));
			#================================================
				$users_query="SELECT * FROM users WHERE id='".$row['user_id']."'";
				$users_result=mysqli_query($conn,$users_query);
				$users_row=mysqli_fetch_array($users_result);
				$comments['user']['id']=$users_row['id'];
				$comments['user']['name']=ucwords(strtolower($users_row['first_name'].' '.$users_row['last_name']));
				$comments['user']['profile_image']=getUserProfileImage($users_row['id']);
				$comments['user']['profile_url']=base_url.'u/'.$users_row['username'];
			#================================================
			$comments_res[]=$comments;
		}
		$response['comments']=$comments_res;
	}
	#=======================================
	$l_query="SELECT * FROM media_likes WHERE media_id='".$id."'";
	$l_result=mysqli_query($conn,$l_query);
	$likes_num_rows=mysqli_num_rows($l_result);
	$response['likes_count']=$likes_num_rows;
	#=======================================
	echo json_encode($response);
?>