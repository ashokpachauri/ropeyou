<?php
	include_once 'connection.php';
	$response=array();
	if(isset($_POST['r_user_id']) && $_POST['r_user_id']!="")
	{
		$img_mesg=0;
		if(isset($_POST['img_mesg']) && $_POST['img_mesg']!="")
		{
			$img_mesg=$_POST['img_mesg'];
		}
		$selected_user=$_POST['r_user_id'];
		$me=$_COOKIE['uid'];
		$text_message=addslashes(trim(filter_var($_POST['text_message']),FILTER_SANITIZE_STRING));
		$page_refer=$_POST['page_refer'];
		$query="INSERT INTO users_chat SET img_mesg='$img_mesg',added=NOW(),status=1,text_message='$text_message',user_id='$me',r_user_id='$selected_user',flag=0,s_status=1,r_status=1";
		if(mysqli_query($conn,$query))
		{
			/*$me_query="SELECT first_name,last_name FROM users WHERE id='$me'";
			$me_result=mysqli_query($conn,$me_query);
			$me_row=mysqli_fetch_array($me_result);
			$me_name=$me_row['first_name']." ".$me_row['last_name'];
			$me_image=getUserProfileImage($me);
			
			$mu_query="SELECT * FROM users WHERE id='$selected_user'";
			$mu_result=mysqli_query($conn,$mu_query);
			$mu_row=mysqli_fetch_array($mu_result);
			$selected_user_profile_image=getUserProfileImage($selected_user);
			$selected_user_name=$mu_row['first_name']." ".$mu_row['last_name'];
			$data="";
			$data=$data.'<div class="osahan-chat-box p-3 border-top border-bottom bg-light">';
			$current_date="";
			$message_query="SELECT * FROM users_chat WHERE ((user_id='$me' AND r_user_id='$selected_user') OR (r_user_id='$me' AND user_id='$selected_user')) AND status=1 ORDER BY added ASC";
			$message_result=mysqli_query($conn,$message_query);
			if(mysqli_num_rows($message_result)>0)
			{
				mysqli_query($conn,"UPDATE users_chat SET flag=2 WHERE user_id='$selected_user' AND r_user_id='$me' AND (flag=0 OR flag=1)");
				while($message_row=mysqli_fetch_array($message_result))
				{
					$img_mesg=$message_row['img_mesg'];
					if(date("M d,Y",strtotime($message_row['added']))!=$current_date)
					{
						$current_date=date("M d,Y",strtotime($message_row['added']));
						$data=$data.'<div class="text-center my-3">
							<span class="px-3 py-2 small bg-white shadow-sm  rounded">'.$current_date.'</span>
						</div>';
					}
					if($message_row['text_message']=="**RUCONNECTED**")
					{
						$data=$data.'<div class="d-flex align-items-center osahan-post-header">
							<div class="mr-auto ml-auto">
								<p style="text-align:center;">Bridge Constructed.Start Knowing Eachother.</p>
							</div>
						</div>';
					}
					else if($img_mesg==1)
					{
						$data=$data.'<div class="d-flex align-items-center osahan-post-header">
							<div class="mr-auto ml-auto">
								<p style="text-align:center;"><img src="'.base_url.'image.png" width="20" height="20"> &nbsp;Photo</p>
							</div>
						</div>';
					}
					else if($me==$message_row['user_id'])
					{
						$data=$data.'<div class="d-flex align-items-center osahan-post-header">
							<span class="mr-auto mb-auto">
								<div class="text-left text-muted pt-1 small">'.date("h:i a",strtotime($message_row['added'])).'</div>
								<p id="message_status_'.$me.'_'.$message_row['id'].'" class="message_status">';
									if($message_row['flag']=="0")
										{
											$data=$data."sent";
										}
										else if($message_row['flag']=="1")
										{
											$data=$data."delivered";
										}
										else if($message_row['flag']=="2")
										{
											$data=$data."seen";
										}
								$data=$data.'</p>
							</span>
							<div class="mr-1 ml-1" style="max-width:60% !important;">
								<p>'.filter_var($message_row['text_message'],FILTER_SANITIZE_STRING).'</p>
							</div>
							<div class="dropdown-list-image ml-3 mb-auto"><img class="rounded-circle" style="border:1px solid #eaebec !important;padding:5px;cursor:pointer;height:2rem;width:2rem;" src="'.$me_image.'" title="'.$me_name.'" alt="'.$me_name.'"></div>
						</div>';
					}
					else if($me==$message_row['r_user_id'])
					{
						
						$data=$data.'<div class="d-flex align-items-center osahan-post-header">
							<div class="dropdown-list-image mr-3 mb-auto">
								<img class="rounded-circle" style="cursor:pointer;border:1px solid #eaebec !important;padding:5px;height:2rem;width:2rem;" title="'.$selected_user_name.'" src="'.$selected_user_profile_image.'" alt="'.$selected_user_name.'">
							</div>
							<div class="mr-1" style="max-width:60% !important;">
								<p>'.filter_var($message_row['text_message'],FILTER_SANITIZE_STRING).'</p>
							</div>
							<span class="ml-auto mb-auto">
								<div class="text-right text-muted pt-1 small">'.date("h:i a",strtotime($message_row['added'])).'</div>
							</span>
						</div>';
					}
				}
			}
			$data=$data.'</div>';
			$response['data']=$data;*/
			$response['status']="success";
			$response['message']="Message sent successfully";
		}
		else
		{
			$response['status']="error";
			$response['message']="Some technical error.We are looking at this.Please try after a moment.";
		}
	}
	else
	{
		$response['status']="error";
		$response['message']="Invalid message";
	}
	echo json_encode($response);
?>	