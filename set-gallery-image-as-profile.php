<?php
	include_once 'connection.php';
	if (isset($_POST['id'])) {
		$id = $conn->real_escape_string($_POST['id']);
		$query="SELECT * FROM gallery WHERE id = '$id' AND user_id='".$_COOKIE['uid']."'";
		$result=mysqli_query($conn,$query);
		if(mysqli_num_rows($result)>0)
		{
			$query = $conn->query("UPDATE gallery SET is_main = 1 WHERE id = '$id' AND user_id=".$_COOKIE['uid']."");
			$query=$conn->query("SELECT * FROM gallery WHERE id = '$id' AND user_id='".$_COOKIE['uid']."'");
			if ($query && $query->num_rows == 1) {
				$row = $query->fetch_assoc();
				$query1=$conn->query("SELECT * FROM users_profile_pics WHERE user_id='".$_COOKIE['uid']."'");
				if ($query1 && $query1->num_rows == 1) {
					$caption_arr=explode("uploads/",$row['file']);
					$query1=$conn->query("UPDATE users_profile_pics SET media_id='$id',type='".$row['type']."',caption='".$caption_arr[1]."',added=NOW() WHERE user_id='".$_COOKIE['uid']."'");
				}
				else{
					$caption_arr=explode("uploads/",$row['file']);
					$query1=$conn->query("INSERT INTO users_profile_pics SET media_id='$id',type='".$row['type']."',caption='".$caption_arr[1]."',added=NOW(),user_id='".$_COOKIE['uid']."'");
				}
				echo json_encode(array("status"=>"success"));
			}
			else
			{
				echo json_encode(array("status"=>"error"));
			}
		}
		else
		{
			$query=$conn->query("SELECT * FROM gallery WHERE id = '$id'");
			if ($query->num_rows == 1) {
				$row = $query->fetch_assoc();
				#================================
					$old_file=$row['file'];
					$old_title=$row['title'];
					$new_title="new_profile_".time().'_'.$old_title;
					$new_file="uploads/".$new_title;
					@copy($old_file, $new_file);
				#================================
				$query_m="INSERT INTO gallery SET user_id='".$_COOKIE['uid']."',title='".$new_title."',file='".$new_file."',type='".$row['type']."',size='".$row['size']."',date=NOW(),is_main=1,is_draft=0";
				$result_m=mysqli_query($conn,$query_m);
				
				if($result_m)
				{
					$query1=$conn->query("SELECT * FROM users_profile_pics WHERE user_id='".$_COOKIE['uid']."'");
					if ($query1 && $query1->num_rows == 1) {
						$caption_arr=explode("uploads/",$row['file']);
						$query1=$conn->query("UPDATE users_profile_pics SET media_id='$id',type='".$row['type']."',caption='".$new_title."',added=NOW() WHERE user_id='".$_COOKIE['uid']."'");
					}
					else
					{
						$caption_arr=explode("uploads/",$row['file']);
						$query1=$conn->query("INSERT INTO users_profile_pics SET media_id='$id',type='".$row['type']."',caption='".$new_title."',added=NOW(),user_id='".$_COOKIE['uid']."'");
					}
					echo json_encode(array("status"=>"success"));
				}
				else
				{
					echo json_encode(array("status"=>"error"));
				}
			}
			else
			{
				echo json_encode(array("status"=>"error"));
			}
		}
	}
	else
	{
		echo json_encode(array("status"=>"error"));
	}
?>