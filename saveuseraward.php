<?php
	include_once 'connection.php';
	$response=array();
	$origin=false;
	if(isset($_COOKIE['uid']) && $_COOKIE['uid']!="")
	{
		if(isset($_POST['origin']) && $_POST['origin']!="")
		{
			$origin=$_POST['origin'];
		}
		$additional_check_query="";
		$insert_query="";
		$insert_query_end="";
		$item_token=filter_var($_POST['item_token'],FILTER_SANITIZE_STRING);
		$user_id=$_COOKIE['uid'];
		$user_data=getUsersData($user_id);
		if($item_token!="")
		{
			$additional_check_query="SELECT * FROM users_awards WHERE id='$item_token' AND user_id='$user_id'";
			$additional_check_result=mysqli_query($conn,$additional_check_query);
			if(mysqli_num_rows($additional_check_result)==0)
			{
				$response['status']="error";
				$response['message']="Invalid request please try reloading the page.";
				echo json_encode($response);die();
			}
			$additional_check_query=" AND id!='$item_token'";
			$insert_query="UPDATE ";
			$insert_query_end=" WHERE id='$item_token'";
		}
		else
		{
			$additional_check_query="";
			$insert_query="INSERT INTO ";
			$insert_query_end="";
		}
		$award_description=filter_var(strip_tags($_POST['award_description']),FILTER_SANITIZE_STRING);
		$award_title=filter_var(strip_tags($_POST['award_title']),FILTER_SANITIZE_STRING);
		$old_award_image=$_POST['old_award_image'];
		if(isset($_FILES['award_file']['tmp_name']) && $_FILES['award_file']['tmp_name']!="" && $_FILES['award_file']['tmp_name']!=null)
		{
			$target_dir="uploads/";
			$image_file_name=$user_data['username'].'-'.mt_rand(0,99999).'-'.str_replace(" ","",trim(basename($_FILES["award_file"]["name"])));
			$target_file = $target_dir . $image_file_name;
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			$size=$_FILES["award_file"]["size"];
			if ($size > 50000000) {
				$error_message="File size should not exceeds 50 mb.<br/>";
				$uploadOk = 0;
			}
			$check_array=array("jpg","jpeg","png");
			if(!in_array($imageFileType,$check_array))
			{
				$error_message=$error_message."Only .jpg,.png extensions allowed.<br/>";
				$uploadOk = 0;
			}
			if($uploadOk==1)
			{
				if(move_uploaded_file($_FILES["award_file"]["tmp_name"], $target_file))
				{
					$old_award_image=$target_file;
				}	
				else{
					$error_message=$error_message."Error Uploading Image";
				}
			}
			else
			{
				$response['status']="error";
				$response['message']=$error_message;
				echo json_encode($response);die();
			}
		}
		if($award_description!="" && $award_title!="")
		{
			$check_query="SELECT * FROM users_awards WHERE title='$award_title' AND description='$award_description' AND user_id='$user_id'".$additional_check_query;
			$check_result=mysqli_query($conn,$check_query);
			if(mysqli_num_rows($check_result)==0)
			{
				$insert_query=$insert_query."users_awards SET image='$old_award_image',status=1,added=NOW(),user_id='$user_id',title='$award_title',description='$award_description' ".$insert_query_end;
				$insert_result=mysqli_query($conn,$insert_query);
				if($insert_result)
				{
					
					$response['status']="success";
					$response['message']="Achievement saved successfully.";
					if($item_token=="")
					{
						$item_token=mysqli_insert_id($conn);
					}
					$response['id']=$item_token;
					
					$data="";
					if($origin==false)
					{					
						$data='<div class="d-flex border-bottom" style="width:100%;" id="award_'.$item_token.'">';
						if($old_award_image!="" && $old_award_image!=null)
						{
							$image=base_url.$old_award_image;
							$data=$data.'<div class="col-3 border-right border-top p-1">
								<img class="img-fluid" style="border:1px solid gray;width:100% !important;" src="'.$image.'" alt="'.$award_title.'">
							</div>';
						}
						$data=$data.'<div class="col-';
						if($awards_row['image']!="" && $awards_row['image']!=null){ $data=$data.'9'; } else { $data=$data.'12'; }
						$data=$data.'border-top p-1">
								<h6 class="m-0" style="text-align:center;font-size:14px;">'.$award_title.'<span style="float: right !important;">&nbsp;&nbsp;<a style="cursor:pointer;" title="Edit" onclick="getAward('.$item_token.');" href="javascript:void(0);"><i class="feather-edit"></i></a>&nbsp;&nbsp;<a style="cursor:pointer;color:red;" title="Delete" onclick="deleteAward('.$item_token.');" href="javascript:void(0);"><i class="feather-trash-2"></i></a></span></h6>
								<p class="mt-1 p-1">'.$award_description.'</p>
							</div>
						</div>';
					}
					else
					{
						$data='<div class="d-flex border-bottom" style="width:100%;" id="award_'.$item_token.'">';
						if($old_award_image!="" && $old_award_image!=null)
						{
							$image=base_url.$old_award_image;
							$data=$data.'<div class="col-3 border-right border-top p-1">
								<img class="img-fluid" style="border:1px solid gray;width:100% !important;" src="'.$image.'" alt="'.$award_title.'">
							</div>';
						}
						$data=$data.'<div class="col-';
						if($awards_row['image']!="" && $awards_row['image']!=null){ $data=$data.'9'; } else { $data=$data.'12'; }
						$data=$data.'border-top p-1">
								<h6 class="m-0" style="text-align:center;font-size:14px;">'.$award_title.'<span style="float: right !important;">&nbsp;&nbsp;<a style="cursor:pointer;" title="Edit" onclick="getAward('.$item_token.');" href="javascript:void(0);"><i class="feather-edit"></i></a>&nbsp;&nbsp;<a style="cursor:pointer;color:red;" title="Delete" onclick="deleteAward('.$item_token.');" href="javascript:void(0);"><i class="feather-trash-2"></i></a></span></h6>
								<p class="mt-1 p-1">'.$award_description.'</p>
							</div>
						</div>';
					}
					$response['data']=$data;
					echo json_encode($response);die();
				}
				else
				{
					$response['status']="error";
					$response['message']="Database error please contact developer";
					echo json_encode($response);die();
				}
			}
			else{
				$response['status']="error";
				$response['message']="Duplicate Entry Please Check Again";
				echo json_encode($response);die();
			}
		}
		else
		{
			$response['status']="error";
			$response['message']="Please fill all required fields.";
			echo json_encode($response);die();
		}
	}
	else
	{
		$response['status']="error";
		$response['message']="Session Out Please Login Again";
		echo json_encode($response);die();
	}
?>