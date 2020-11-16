<?php
	include_once 'connection.php';
	$endpoint="";
	$response_arr=array();
	if(isset($_POST['endpoint']) && $_POST['endpoint']!="")
	{
		$endpoint=filter_var(trim($_POST['endpoint']),FILTER_SANITIZE_STRING);
	}
	$user_id=$_COOKIE['uid'];
	$me=$user_id;
	if($endpoint=="")
	{
		$endpoint="all_unread_messages";
	}
	$sound_to_play=0;
	$data_count=0;
	if($endpoint=="all_unread_messages")
	{
		$chat_query="SELECT DISTINCT(user_id),added FROM users_chat WHERE r_user_id='$user_id' AND status=1 AND flag!=2 AND s_status!=0 ORDER BY added DESC";
		$chat_result=mysqli_query($conn,$chat_query);
		$chat_num_rows=mysqli_num_rows($chat_result);
		$data=array();
		if($chat_num_rows>0)
		{
			$friends=array();
			while($chat_row=mysqli_fetch_array($chat_result))
			{
				$friend=$chat_row['user_id'];
				if(!(in_array($friend,$friends)))
				{
					$friends[]=$friend;
					$data_count=$data_count+1;
				}
			}
			for($loopVar=0;$loopVar<count($friends);$loopVar++)
			{
				$arr=array();
				$s_user_id=$friends[$loopVar];
				$users_query="SELECT * FROM users WHERE id='$s_user_id'";
				$users_result=mysqli_query($conn,$users_query);
				$users_row=mysqli_fetch_array($users_result);
				
				$s_user_profile_title=$users_row['profile_title'];
				$username=$users_row['username'];
				$s_name=$users_row['first_name']." ".$users_row['last_name'];
				$s_user_image=getUserProfileImage($s_user_id);
				
				$users_chat_query="SELECT * FROM users_chat WHERE r_user_id='$user_id' AND user_id='$s_user_id' AND status=1 AND flag!=2 AND s_status!=0 ORDER BY added DESC";
				$users_chat_result=mysqli_query($conn,$users_chat_query);
				$users_chat_row=mysqli_fetch_array($users_chat_result);
				$img_mesg=$users_chat_row['img_mesg'];
				$text_message=$users_chat_row['text_message'];
				if($text_message=="**RUCONNECTED**")
				{
					$text_message="Bridge Constructed.Start Knowing Eachother.";
				}
				else if($img_mesg==1 && $text_message!="")
				{
					$text_message='<img src="'.$text_message.'" width="20" height="20"> &nbsp;Photo';
				}
				if($users_chat_row['flag']=="0")
				{
					$sound_to_play=1;
				}
				$arr['s_user_id']=$s_user_id;
				$arr['username']=$username;
				$arr['s_name']=$s_name;
				if(userLoggedIn($s_user_id))
				{
					$arr['is_online']=1;
				}
				else{
					$arr['is_online']=0;
				}
				$arr['s_user_profile_title']=$s_user_profile_title;
				$arr['s_user_image']=$s_user_image;
				$arr['text_message']=$text_message;
				$arr['datetime']=date("D M Y H:i",strtotime($users_chat_row['added']));//$text_message;
				mysqli_query($conn,"UPDATE users_chat SET flag=1 WHERE r_user_id='$user_id' AND user_id='$s_user_id' AND flag=0");
				$data[]=$arr;
			}
		}
		$response_arr['status']="success";
		$response_arr['sound_to_play']=$sound_to_play;
		$response_arr['count']=$data_count;
		$response_arr['data']=$data;
	}
	else if($endpoint=="get_messages_as_per_user")
	{
		$message_transaction_data="";
		$selected_user=$_POST['r_user_id'];
		$me_query="SELECT first_name,last_name FROM users WHERE id='$me'";
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
		//$data=$data.'<div class="osahan-chat-box p-3 border-top border-bottom bg-light">';
		$current_date="";
		$message_query="SELECT * FROM users_chat WHERE (r_user_id='$me' AND user_id='$selected_user') AND status=1 AND fetched=0 ORDER BY added ASC";
		$message_result=mysqli_query($conn,$message_query); 
		if(mysqli_num_rows($message_result)>0)
		{
			mysqli_query($conn,"UPDATE users_chat SET flag=2,fetched=1 WHERE user_id='$selected_user' AND r_user_id='$me' AND fetched=0");
			while($message_row=mysqli_fetch_array($message_result))
			{
				if($me==$message_row['r_user_id'])
				{
					$message_transaction_data='<i class="feather-corner-down-right text-primary"></i>';
				}
				else if($message_row['flag']==0)
				{
					$message_transaction_data='<i class="feather-check text-primary"></i>';
				}
				else if($message_row['flag']==1)
				{
					$message_transaction_data='<i class="feather-check text-primary" style="font-size:bold"></i>';
				}
				else if($message_row['flag']==2)
				{
					$message_transaction_data='<i class="feather-check text-primary" style="color:#fff !important;background: url('.base_url.'images/superlike.png) !important;background-size: contain !important;"></i>';
				}
				/*if(date("M d,Y",strtotime($message_row['added']))!=$current_date)
				{
					$current_date=date("M d,Y",strtotime($message_row['added']));
					$data=$data.'<div class="text-center my-3">
						<span class="px-3 py-2 small bg-white shadow-sm  rounded">'.$current_date.'</span>
					</div>';
				}*/
				if($message_row['text_message']=="**RUCONNECTED**")
				{
					$data=$data.'<div class="d-flex align-items-center osahan-post-header" style="margin-top:10px;margin-bottom:10px;">
						<div class="mr-auto ml-auto">
							<p style="text-align:center;" data-toggle="tooltip" data-placement="top" data-original-title="'.date("h:i a",strtotime($message_row['added'])).'">Bridge Constructed.Start Knowing Eachother.</p>
						</div>
					</div>';
					$message_transaction_data=$message_transaction_data." Bridge Constructed.Start Knowing Eachother.";
				}
				else if($me==$message_row['user_id'])
				{
					$img_mesg=$message_row['img_mesg'];
					$data=$data.'<div class="d-flex align-items-center osahan-post-header" style="margin-top:10px;margin-bottom:10px;">
						<span class="mr-auto mb-auto">
						</span>
						<div class="mr-2 ml-1" style="max-width:60% !important;">';
						if($img_mesg==1 && $message_row['text_message']!="")
						{
							$message_transaction_data=$message_transaction_data.'<img src="'.$message_row['text_message'].'" width="20" height="20"> &nbsp;Photo';
							$data=$data.'<img src="'.$message_row['text_message'].'" width="320" height="240" style="width:100%;border-radius:10px;" data-toggle="tooltip" data-placement="top" data-original-title="'.date("h:i a",strtotime($message_row['added'])).'">';
						}
						else{
							$message_transaction_data=$message_transaction_data.$message_row['text_message'];
							$data=$data.'<p data-toggle="tooltip" data-placement="top" data-original-title="'.date("h:i a",strtotime($message_row['added'])).'">'.filter_var($message_row['text_message'],FILTER_SANITIZE_STRING).'</p>';
						}
							
						$data=$data.'</div>
						<div class="dropdown-list-image ml-3 mb-auto">
							<img class="rounded-circle" style="border:1px solid #eaebec !important;padding:5px;cursor:pointer;height:2rem;width:2rem;" src="'.$me_image.'"  data-toggle="tooltip" data-placement="top" data-original-title="'.$me_name.'" alt="'.$me_name.'">
							<p style="margin-top:5px;font-size:9px;">';
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
						</div>
					</div>';
				}
				else if($me==$message_row['r_user_id'])
				{					
					$img_mesg=$message_row['img_mesg'];
					$data=$data.'<div class="d-flex align-items-center osahan-post-header" style="margin-top:10px;margin-bottom:10px;">
						<div class="dropdown-list-image mr-1 mb-auto">
							<img class="rounded-circle" style="cursor:pointer;border:1px solid #eaebec !important;padding:5px;height:2rem;width:2rem;" data-toggle="tooltip" data-placement="top" data-original-title="'.$selected_user_name.'" src="'.$selected_user_profile_image.'" alt="'.$selected_user_name.'">
						</div>
						<div class="mr-1" style="max-width:60% !important;">';
						if($img_mesg==1 && $message_row['text_message']!="")
						{
							$message_transaction_data=$message_transaction_data.'<img src="'.$message_row['text_message'].'" width="20" height="20"> &nbsp;Photo';
							$data=$data.'<img src="'.$message_row['text_message'].'" width="320" height="240" style="width:100%;border-radius:10px;" data-toggle="tooltip" data-placement="top" data-original-title="'.date("h:i a",strtotime($message_row['added'])).'">';
						}
						else{
							$message_transaction_data=$message_transaction_data.$message_row['text_message'];
							$data=$data.'<p data-toggle="tooltip" data-placement="top" data-original-title="'.date("h:i a",strtotime($message_row['added'])).'">'.filter_var($message_row['text_message'],FILTER_SANITIZE_STRING).'</p>';
						}
							
						$data=$data.'</div>
					</div>';
				}
			}
		}
		$response_arr['status']="success";
		$response_arr['message']="Message Fetched successfully";
		$response_arr['data']=$data;
	}
	else
	{
		$response_arr['status']="error";
		$response_arr['message']="Endpoint Not Defined";
	}
	echo json_encode($response_arr);
?>