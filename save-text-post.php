<?php
	include_once 'connection.php';
	$response=array();
	$user_id=$_COOKIE['uid'];
	$r_user_id=$user_id;
	$post_text=filter_var($_POST['text_content'],FILTER_SANITIZE_STRING);
	$url = '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/';   
	$post_text= preg_replace($url, "<a href='$0' target='_blank' title='$0'>$0</a>", $post_text);
	$post_text=addslashes($post_text);
	//$url_preview=filter_var($_POST['url_preview'],FILTER_SANITIZE_STRING);
	//$url_preview=addslashes($url_preview);
	//echo $url_preview."<br/><br/>";
	//$url_preview=addslashes($url_preview);
	
	//echo $url_preview."<br/>";die();
	
	$mode=$_POST['mode'];
	$post_matrix=explode(",",$mode);
	$query="SELECT * FROM users_posts WHERE user_id='$user_id' AND post_text='$post_text' AND DATE(added)=DATE(NOW())";
	$result=mysqli_query($conn,$query);
	if(mysqli_num_rows($result)>0)
	{
		$response['status']="duplicate";
	}
	else
	{
		$users_allowed="";
		$users_blocked="";
		$is_public=$post_matrix[0];
		$is_private=$post_matrix[1];
		$is_protected=$post_matrix[2];
		$is_friendly_protected=$post_matrix[3];
		$is_magic=$post_matrix[4];
		if($is_magic=="1")
		{
			$users_blocked="";
			$users_allowed=$_POST['friends_include_exclude'];
		}
		else if($is_magic=="1")
		{
			$users_blocked=$_POST['friends_include_exclude'];
			$users_allowed="";
		}
		$url_preview="";
		$files_uploaded=$_POST['files_uploaded'];
		$tagged=$_POST['tagged'];
		$query="INSERT INTO users_posts SET users_allowed='$users_allowed',users_blocked='$users_blocked',user_id='$user_id',r_user_id='$r_user_id',post_text='$post_text',url_preview='$url_preview',is_public='$is_public',is_private='$is_private',is_protected='$is_protected',is_friendly_protected='$is_friendly_protected',is_magic='$is_magic',added=NOW(),status=1";
		if(mysqli_query($conn,$query))
		{
			$response['tagged']=$tagged;
			$response['files_uploaded']=$files_uploaded;
			$post_id=mysqli_insert_id($conn);
			$user_id=$_COOKIE['uid'];
			$status=1;
			$tagged=str_replace(" ","",$tagged);
			if($tagged!="")
			{
				$tagged_arr=explode(",",$tagged);
				for($loop=0;$loop<count($tagged_arr);$loop++)
				{
					$r_user_id=$tagged_arr[$loop];
					if($r_user_id!='')
					{
						mysqli_query($conn,"INSERT INTO users_posts_tags SET post_id='$post_id',user_id='$user_id',r_user_id='$r_user_id',status=1,added=NOW()");
					}
				}
			}
			if($files_uploaded!="")
			{
				$files_uploaded=str_replace(" ","",$files_uploaded);
				$files_uploaded_arr=explode(",",$files_uploaded);
				for($loop=0;$loop<count($files_uploaded_arr);$loop++)
				{
					$media_id=$files_uploaded_arr[$loop];
					if($media_id!="")
					{
						$query="SELECT title FROM gallery WHERE id='$media_id' AND user_id='$user_id'";
						$result=mysqli_query($conn,$query);
						if(mysqli_num_rows($result)>0)
						{
							$row=mysqli_fetch_array($result);
							$caption=$row['title'];
							$query="UPDATE gallery SET post_id='$post_id',is_draft=0,is_private='$is_private' WHERE id='$media_id'";
							mysqli_query($conn,$query);
							$query="INSERT INTO users_posts_media SET post_id='$post_id',user_id='$user_id',caption='$caption',media_id='$media_id',status=1,added=NOW()";
							mysqli_query($conn,$query);
						}
					}
				}
			}
			$response['status']="success";
		}
		else
		{
			//echo $query;
			$response['status']="error";
		}
	}
	echo json_encode($response);
?>