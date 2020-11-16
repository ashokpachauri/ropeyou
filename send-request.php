<?php
	include_once 'connection.php';
	$r_user_id=$_REQUEST['user_id'];
	$user_id=$_COOKIE['uid'];
	$query="SELECT * FROM user_joins_user WHERE (user_id='$user_id' OR user_id='$r_user_id') AND (r_user_id='$r_user_id' OR r_user_id='$user_id')";
	$result=mysqli_query($conn,$query);
	if(mysqli_num_rows($result)>0)
	{
		$row=mysqli_fetch_array($result);
		if($row['user_id']==$user_id && $row['status']==0 && $row['blocked']==0)
		{
			mysqli_query($conn,"UPDATE user_joins_user SET status=2 WHERE user_id='$user_id' AND r_user_id='$r_user_id'");
			echo "CANCELLED";
		}
		else if($row['user_id']==$user_id && $row['status']==1 && $row['blocked']==0)
		{
			mysqli_query($conn,"DELETE FROM user_joins_user WHERE user_id='$user_id' AND r_user_id='$r_user_id'");
			mysqli_query($conn,"INSERT INTO users_chat SET status=1,added=NOW(),user_id='$user_id',r_user_id='$r_user_id',flag=1,text_message='**RUDISCONNECTED**'");
			echo "UNFRIENDED";
		}
		else if($row['user_id']==$user_id && $row['status']==2 && $row['blocked']==0)
		{
			mysqli_query($conn,"UPDATE user_joins_user SET status=0 WHERE user_id='$user_id' AND r_user_id='$r_user_id'");
			echo "SENT";
		}
		else if($row['user_id']==$user_id && $row['status']==3 && $row['blocked']==0)
		{
			mysqli_query($conn,"UPDATE user_joins_user SET status=0 WHERE user_id='$user_id' AND r_user_id='$r_user_id'");
			echo "RESENT";
		}
		else if($row['user_id']==$r_user_id && $row['status']==0 && $row['blocked']==0)
		{
			mysqli_query($conn,"UPDATE user_joins_user SET status=1 WHERE user_id='$r_user_id' AND r_user_id='$user_id'");
			mysqli_query($conn,"INSERT INTO users_chat SET status=1,added=NOW(),user_id='$r_user_id',r_user_id='$user_id',flag=1,text_message='**RUCONNECTED**'");
			echo "ACCEPTED";
		}
		else if($row['user_id']==$r_user_id && $row['status']==1 && $row['blocked']==0)
		{
			mysqli_query($conn,"DELETE user_joins_user WHERE user_id='$r_user_id' AND r_user_id='$user_id'");
			mysqli_query($conn,"INSERT INTO users_chat SET status=1,added=NOW(),user_id='$r_user_id',r_user_id='$user_id',flag=1,text_message='**RUDISCONNECTED**'");
			echo "UNFRIENDED";
		}
		else if($row['user_id']==$r_user_id && $row['status']==2 && $row['blocked']==0)
		{
			mysqli_query($conn,"UPDATE user_joins_user SET status=0,user_id='$user_id',r_user_id='$r_user_id' WHERE user_id='$r_user_id' AND r_user_id='$user_id'");
			
			echo "RESENT";
		}
		else if($row['user_id']==$r_user_id && $row['status']==3 && $row['blocked']==0)
		{
			mysqli_query($conn,"UPDATE user_joins_user SET status=0,user_id='$user_id',r_user_id='$r_user_id' WHERE user_id='$r_user_id' AND r_user_id='$user_id'");
			echo "SENT";
		}
		else if ($row['blocked']==0){
			echo "BLOCKED";
		}
	}
	else
	{
		mysqli_query($conn,"INSERT INTO user_joins_user SET user_id='$user_id',r_user_id='$r_user_id',added=NOW()");
		echo "SENT";
	}
?>