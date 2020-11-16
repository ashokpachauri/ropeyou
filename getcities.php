<?php
	include_once 'connection.php';
	$country=$_POST['country'];
	$response=array();
	if($country=="")
	{
		$response['status']="error";
		$response['htmlData']="<option value=''>Select Country First</option>";
	}
	else
	{
		/*$user_id=$_COOKIE['uid'];
		$home_town="";
		$up_query="SELECT home_town FROM users_personal WHERE user_id='$user_id'";
		$up_result=mysqli_query($conn,$up_query);
		if(mysqli_num_rows($up_result)>0)
		{
			$up_row=mysqli_fetch_array($up_result);
			$home_town=$up_row['home_town'];
		}*/
		$query="SELECT * FROM city WHERE country='$country' AND status=1 ORDER BY title";
		$result=mysqli_query($conn,$query);
		if(mysqli_num_rows($result)>0)
		{
			$response['status']="success";
			$htmlData="";
			while($row=mysqli_fetch_array($result))
			{
				$htmlData=$htmlData."<option value='".$row['id']."'";
				//if($home_town==$row['id']){ $htmlData=$htmlData." selected "; }
				$htmlData=$htmlData.">".$row['title']."</option>";
			}
			$response['htmlData']=$htmlData;
		}
		else
		{
			$response['status']="error";
			$response['htmlData']="<option value=''>Select Country First</option>";
		}
	}
	echo json_encode($response);
?>