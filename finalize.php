<?php
	include_once 'connection.php';
	if(isset($_POST["video_type"]) && $_POST["video_type"]!="")
	{
		$error_message="";
		$target_dir="uploads/";
		$video_type=filter_var($_POST['video_type'],FILTER_SANITIZE_STRING);
		$profile_title=trim(filter_var($_POST['profile_title'],FILTER_SANITIZE_STRING));
		$resume_headline=trim(filter_var($_POST['resume_headline'],FILTER_SANITIZE_STRING));
		$video_file_name=str_replace(" ","",trim(basename($_FILES["profile_cv"]["name"])));
		$target_file = $target_dir . $video_file_name;
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		//echo $imageFileType;
		$size=$_FILES["profile_cv"]["size"];
		if ($size > 100000000) {
			$error_message="File size should not exceeds 100 mb.<br/>";
			$uploadOk = 0;
		}
		$check_array=array("doc","docx","pdf");
		if($video_type=="1" && (!in_array($imageFileType,$check_array)))
		{
			$error_message=$error_message."Only .pdf,.doc & .docx extensions allowed.<br/>";
			$uploadOk = 0;
		}
		else if(($video_type=="2" || $video_type=="3") && ($imageFileType != "mp4"))
		{
			$error_message=$error_message."Only .mp4 extension allowed.<br/>";
			$uploadOk = 0;
		}	
		if ($uploadOk == 0) {
			//echo $error_message;
			mysqli_query($conn,"UPDATE users SET profile_title='$profile_title' WHERE id='".$_COOKIE['uid']."'");
			?>
				<script>
					window.location.href="<?php echo base_url; ?>dashboard";
				</script>
			<?php
		} 
		else 
		{
			if(move_uploaded_file($_FILES["profile_cv"]["tmp_name"], $target_file)) 
			{
				$type=null;
				if($video_type=="2" || $video_type=="3")
				{
					$type="video/mp4";
				}
				else if($type=="1")
				{
					if($imageFileType=="doc" || $imageFileType=="docx")
					{
						$type="application/vnd.openxmlformats-officedocument.wordprocessingml.document";
					}
					else if($imageFileType=="pdf")
					{
						$type="application/pdf";
					}
					else 
					{
						$type=null;
					}
				}
				else 
				{
					$type=null;
				}
				//mysqli_query($conn,"");
				$query="INSERT INTO users_resume SET resume_headline='$resume_headline',profile_title='$profile_title',file_title='$video_file_name',file='$target_file',profile_type='$video_type',type='$type',size='$size',added=NOW(),status=1,user_id='".$_COOKIE['uid']."',is_default=1";
				mysqli_query($conn,"UPDATE users SET profile_title='$profile_title' WHERE id='".$_COOKIE['uid']."'");
				//echo $query;
				$result=mysqli_query($conn,$query);
				if($result)
				{
					$media_id=mysqli_insert_id($conn);
					mysqli_query($conn,"UPDATE users_resume SET is_default=0 WHERE profile_type='$video_type' AND user_id='".$_COOKIE['uid']."' AND id!='$media_id'");
					?>
					<script>
						window.location.href="<?php echo base_url; ?>dashboard";
					</script>
					<?php
				}
				else
				{
					//echo "Error uploading file";
					mysqli_query($conn,"UPDATE users SET profile_title='$profile_title' WHERE id='".$_COOKIE['uid']."'");
					?>
					<script>
						window.location.href="<?php echo base_url; ?>dashboard";
					</script>
					<?php
				}
			} 
			else
			{
				mysqli_query($conn,"UPDATE users SET profile_title='$profile_title' WHERE id='".$_COOKIE['uid']."'");
				//echo "Sorry, there was an error uploading your file.";die();
				?>
				<script>
					window.location.href="<?php echo base_url; ?>dashboard";
				</script>
				<?php
			}
		}
	}
?>