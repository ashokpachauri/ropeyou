<?php
	include_once '../connection.php';
	$email=$_REQUEST['email'];
	$name=$_REQUEST['name'];
	$full_name=$_REQUEST['full_name'];
	$image=$_REQUEST['image'];
	$id=$_REQUEST['id'];
	$query="SELECT * FROM users WHERE fb_id='$id'";
	$result=mysqli_query($conn,$query);
	$role="RY_USER";
	if(mysqli_num_rows($result)>0)
	{
		$row=mysqli_fetch_array($result);
		mysqli_query($conn,"UPDATE users SET fb_id='$id',email='$email' WHERE id='".$row['id']."'");
		$_SESSION['uid']=$row['id'];
		setcookie("uid",$row['id'],time()+(30*24*60*60),"/");
		setcookie("username",$row['username'],time()+(30*24*60*60),"/");
		$_SESSION['u_name']=$row['first_name'];
		$_SESSION['mesg_type']="success";
		$_SESSION['mesg']="ignore_otp";
		echo "SUCCESS";
	}
	else
	{
		if($email!=""){
			$mb_expld=explode("@",$email);
			$username=$mb_expld[0];
			$server=$mb_expld[1];
			$query1="SELECT * FROM email_servers WHERE server='$server'";
			$result1=mysqli_query($conn,$query1);
			if(mysqli_num_rows($result1)>0)
			{
				mysqli_query($conn,"INSERT INTO email_servers SET server='$server'");
			}
		}
		$query="INSERT INTO users SET first_name='$name',username='$username',email='$email',fb_id='$id',role='$role',status=1,added=NOW(),validated=1";
		if($result=mysqli_query($conn,$query))
		{
			$uid=mysqli_insert_id($conn);
			$_SESSION['uid']=$uid;
			$username="r_".$uid."_y";
			mysqli_query($conn,"UPDATE users SET username='$username' WHERE id='$uid'");
			setcookie("uid",$uid,time()+(30*24*60*60),"/");
			setcookie("username",$username,time()+(30*24*60*60),"/");
			$_SESSION['u_name']=$name;
			$_SESSION['mesg_type']="success";
			$_SESSION['mesg']="ignore_otp";
			$contact_type="email";
			if($image!="")
			{
				$file=@file_get_contents($image);
				$file_1=rand()."_user_image_".rand().".png";
				@file_put_contents("uploads/".$file_1,$file);
				
				$ch = curl_init(base_url."uploads/".$file_1);

				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
				curl_setopt($ch, CURLOPT_HEADER, TRUE);
				curl_setopt($ch, CURLOPT_NOBODY, TRUE);

				$data = curl_exec($ch);
				$size = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);

				curl_close($ch);
				
				mysqli_query($conn,"INSERT INTO gallery SET user_id='".$uid."',title='$file_1',file='uploads/".$file_1."',type='image/png',index=(1 + (SELECT IFNULL((SELECT MAX(`index`) FROM gallery g WHERE user_id='".$uid."'), -1))),date=NOW(),is_main=1,size='$size'");
				
				$image_id=mysqli_insert_id($conn);
				mysqli_query($conn,"UPDATE users_profile_pics SET media_id='$image_id',user_id='".$uid."',type='image',status=1,added=NOW(),caption='Profile Picture'");
				mysqli_query($conn,"UPDATE gallery SET is_main=0 WHERE user_id='".$uid."' AND id!='$image_id'");
			}
			if($email!="")
			{
				mysqli_query($conn,"INSERT INTO users_contact SET user_id='".$uid."',contact_name='Self',contact_type='$contact_type',contact='$email'");
			}
			//mysqli_query($conn,"INSERT INTO users_personal SET user_id='".$_SESSION['uid']."'");
			echo "SUCCESS";
		}
		else
		{
			echo "ERROR";
		}
	}
?>