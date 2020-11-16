<?php
	include_once 'connection.php';
	$query="INSERT INTO users_profile_pics SET media_id='40',user_id='1001',status=1,added=NOW(),type='image/jpeg',caption='LnoclxmuUyQO.jpg'";
	$result=mysqli_query($conn,$query);
	if($result)
	{
		echo "Hi<br/><hr/>";
	}
	else{
		echo $query;
	}
?>