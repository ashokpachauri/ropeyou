<div class="osahan-chat-left people-list" id="people-list">
	<div class="position-relative icon-form-control p-3 border-bottom search">
		<i class="feather-search position-absolute"></i>
		<input placeholder="Search messages" type="text" class="form-control">
	</div>
	<div class="osahan-chat-list list" id="oshan_chat_list">
	<?php
		include_once 'connection.php';
		$selected_user=$_REQUEST['user_id'];
		$me=$_COOKIE['uid'];
		$me=$_COOKIE['uid'];
		$friends=array();
		$user_id=$_COOKIE['uid'];
		$chat_list_query="SELECT * FROM user_joins_user WHERE user_id='".$_COOKIE['uid']."' OR r_user_id='".$_COOKIE['uid']."' AND status=1 ORDER BY id DESC";
		$chat_list_result=mysqli_query($conn,$chat_list_query);
		$chat_list_num_row=mysqli_num_rows($chat_list_result);
		if($chat_list_num_row>0)
		{
			while($chat_list_row=mysqli_fetch_array($chat_list_result))
			{
				if($chat_list_row['user_id']==$_COOKIE['uid'])
				{
					$friend=$chat_list_row['r_user_id'];
					if(!(in_array($friend,$friends)))
					{
						$friends[]=$friend;
					}
				}
				else
				{
					$friend=$chat_list_row['user_id'];
					if(!(in_array($friend,$friends)))
					{
						$friends[]=$friend;
					}
				}
			}
		}
		$selected_user=$friend_id;
		for($loopVar=0;$loopVar<count($friends);$loopVar++)
		{
			$friend_id=$friends[$loopVar];
			$friends_query="SELECT * FROM users WHERE id='$friend_id'";
			$friends_result=mysqli_query($conn,$friends_query);
			$friends_row=mysqli_fetch_array($friends_result);
			
			$message_query="SELECT * FROM users_chat WHERE ((r_user_id='$friend_id' AND user_id='$user_id' AND s_status=1 AND status=1) OR (user_id='$friend_id' AND r_user_id='$user_id' AND status=1 AND r_status=1)) ORDER BY added DESC LIMIT 1";
			$message_result=mysqli_query($conn,$message_query);
			$message_row=mysqli_fetch_array($message_result);
			?>
			
			<div class="p-3 d-flex align-items-center border-bottom osahan-post-header overflow-hidden" onclick="updateUser(<?php echo $friend_id; ?>);" style="cursor:pointer;">
				<div class="dropdown-list-image mr-3">
					<img class="rounded-circle" style="border:1px solid #eaebec !important;paddding:5px;" src="<?php echo getUserProfileImage($friend_id); ?>" title="<?php echo $friends_row['first_name']." ".$friends_row['last_name']; ?>" alt="<?php echo $friends_row['first_name']." ".$friends_row['last_name']; ?>">
					<div class="status-indicator <?php if(userLoggedIn($friend_id)){ echo 'bg-success';} else{ echo 'bg-danger'; } ?>"></div>
				</div>
				<div class="font-weight-bold mr-1 overflow-hidden">
					<div class="text-truncate name"><?php echo $friends_row['first_name']." ".$friends_row['last_name']; ?></div>
					<div class="small text-truncate overflow-hidden text-black-50" id="message_transaction_data_<?php echo $selected_user; ?>">
						<?php
							if($me==$message_row['r_user_id'])
							{
								?>
									<i class="feather-corner-down-right text-primary"></i>
								<?php
							}
							else if($message_row['flag']==0)
							{
								?>
									<i class="feather-check text-primary"></i>
								<?php
							}
							else if($message_row['flag']==1)
							{
								?>
									<i class="feather-check text-primary" style="font-size:bold"></i>
								<?php
							}
							else if($message_row['flag']==2)
							{
								?>
									<i class="feather-check text-primary" style="color:#fff !important;background: url(<?php echo base_url; ?>images/superlike.png) !important;background-size: contain !important;"></i>
								<?php
							}
						?>
						<?php 
							$text_message=$message_row['text_message'];
							$img_mesg=$message_row['img_mesg'];
							if($text_message=="**RUCONNECTED**")
							{
								$text_message="Bridge Constructed.Start Knowing Eachother.";
							}
							else if($img_mesg=="1" && $text_message!="")
							{
								$text_message='<img src="'.$text_message.'" width="20" height="20"> &nbsp;Photo';
							}
							echo $text_message;
						?>
					</div>
				</div>
				<span class="ml-auto mb-auto">
				   <div class="text-right text-muted pt-1 small"><?php echo date("D",strtotime($message_row['added'])); ?></div>
				</span>
			</div>
		<?php
			}
		?>
	</div>
</div>