<?php
	include_once '../connection.php';
	$query="SELECT * FROM gallery WHERE user_id='".$_COOKIE['uid']."'";
	$result=mysqli_query($conn,$query);
	while($row=mysqli_fetch_array($result))
	{
		print_r($row);echo "<br/><hr/>";
	}
?>