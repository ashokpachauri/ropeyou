<?php
	include_once 'connection.php';
	$users_query="SELECT id,lattitude,longitude FROM users";
	$users_result=mysqli_query($conn,$users_query);
	if(mysqli_num_rows($users_result)>0)
	{
		while($users_row=mysqli_fetch_array($users_result))
		{
			$user_id=$users_row['id'];
			$distance_query="SELECT id,lattitude,longitude FROM users WHERE id!='$user_id'";
			$distance_result=mysqli_query($conn,$distance_query);
			if(mysqli_num_rows($distance_result)>0)
			{
				while($distance_row=mysqli_fetch_array($distance_result))
				{ 
					$distance=distance_between_points_on_earth($users_row['lattitude'],$users_row['longitude'],$distance_row['lattitude'],$distance_row['longitude']);
					$distance_in_meter=(int)($distance);
					//echo $distance;
					$r_user_id=$distance_row['id'];
					$check=mysqli_query($conn,"SELECT id FROM distance_matrix WHERE user_id='$user_id' AND r_user_id='$r_user_id'");
					if(mysqli_num_rows($check)>0)
					{
						$check_row=mysqli_fetch_array($check);
						$id=$check_row['id'];
						mysqli_query($conn,"UPDATE distance_matrix SET distance='$distance_in_meter' WHERE id='$id'");
					}
					else
					{
						//echo "Hi";
						mysqli_query($conn,"INSERT INTO distance_matrix SET distance='$distance_in_meter',user_id='$user_id',r_user_id='$r_user_id'");
					}
				}
			}
		}
	}
?>