<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include_once 'head.php'; ?>
		<title>Messenger | RopeYou Connects</title>
	</head>
	<style>
		#my_camera{
			width: 100% !important;
			height: 332px !important;
			border: 1px solid black;
			padding:5px;
		}
	</style>
	<body>
		<?php include_once 'header.php'; ?>
		<div class="py-0" style="padding-top:5px !important;">
			<div class="container">
				<div class="row">
				   <!-- Main Content -->
				   <main class="col col-xl-9 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
					  <div class="box shadow-sm rounded bg-white mb-0 osahan-chat">
						 <div class="row m-0">
							<div class="border-right col-lg-5 col-xl-4 px-0 d-none d-lg-inline" id="chat_list_dynamic">
							   <div class="osahan-chat-left people-list" id="people-list">
								  <div class="position-relative icon-form-control p-3 border-bottom search">
									 <i class="feather-search position-absolute"></i>
									 <input placeholder="Search messages" type="text" class="form-control">
								  </div>
									<?php
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
										//echo $chat_list_query;
										//print_r($friends);
									?>
								  <div class="osahan-chat-list list" id="oshan_chat_list">|<!-- style="max-height:550px !important;overflow-y:auto;"-->
									<?php
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
							</div>
							<div class="col-lg-7 col-xl-8 px-0" id="whole_div">
								<?php
									if(isset($friends[0]) && $friends[0]!="")
									{
										$selected_user=$friends[0];
										$mu_query="SELECT * FROM users WHERE id='$selected_user'";
										$mu_result=mysqli_query($conn,$mu_query);
										$mu_row=mysqli_fetch_array($mu_result);
										$selected_user_profile_image=getUserProfileImage($selected_user);
										$selected_user_name=$mu_row['first_name']." ".$mu_row['last_name'];
										
										$me_query="SELECT * FROM users WHERE id='$me'";
										$me_result=mysqli_query($conn,$me_query);
										$me_row=mysqli_fetch_array($me_result);
										$me_name=$me_row['first_name']." ".$me_row['last_name'];
										$me_image=getUserProfileImage($me);
								?>
										<div class="p-3 d-flex align-items-center  border-bottom osahan-post-header">
											<div class="dropdown-list-image mr-3 mb-auto"><img class="rounded-circle" id="active_user_image" style="cursor:pointer;border:1px solid #eaebec !important;padding:5px;" title="<?php echo $selected_user_name; ?>" src="<?php echo $selected_user_profile_image; ?>" alt="<?php echo $selected_user_name; ?>"></div>
											<div class="font-weight-bold mr-1 overflow-hidden">
												<div class="text-truncate" id="active_user_name"><?php echo $selected_user_name; ?>
												</div>
												<div class="small text-truncate overflow-hidden text-black-50" id="active_user_profile_title"><?php echo $mu_row['profile_title']; ?></div>
											</div>
											<span class="ml-auto">
												<!--<button type="button" class="btn btn-light btn-sm rounded d-none d-lg-inline">
													<i class="feather-phone"></i>
												</button>
												<button type="button" class="btn btn-light btn-sm rounded d-none d-lg-inline">
													<i class="feather-video"></i>
												</button>-->
												<div class="btn-group">
													<button type="button" class="btn btn-light btn-sm rounded" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														<i class="feather-more-vertical"></i>
													</button>
													<div class="dropdown-menu dropdown-menu-right">
														<button class="dropdown-item" type="button"><i class="feather-phone"></i> Voice Call</button>
														<button class="dropdown-item" type="button"><i class="feather-video"></i> Video Call</button>
														<button class="dropdown-item" type="button"><i class="feather-trash"></i> Delete</button>
														<button class="dropdown-item" type="button"><i class="feather-x-circle"></i> Turn Off</button>
													</div>
												</div>
											</span>
										</div>										
										<div class="row">
											<div class="col-lg-12 col-xl-12 col-md-12 chat-history" id="messages_stack">
												<div class="osahan-chat-box p-3 border-top border-bottom bg-light" id="chat_history" style="overflow-y:scroll !important;height:420px;">
													<?php
														$current_date="";
														$message_query="SELECT * FROM users_chat WHERE ((user_id='$me' AND r_user_id='$selected_user') OR (r_user_id='$me' AND user_id='$selected_user')) AND status=1 ORDER BY added ASC";
														$message_result=mysqli_query($conn,$message_query);
														if(mysqli_num_rows($message_result)>0)
														{
															mysqli_query($conn,"UPDATE users_chat SET flag=2,fetched=1 WHERE user_id='$selected_user' AND r_user_id='$me' AND (flag=0 OR flag=1)");
															while($message_row=mysqli_fetch_array($message_result))
															{
																
																$img_mesg=$message_row['img_mesg'];
																if(date("M d,Y",strtotime($message_row['added']))!=$current_date)
																{
																	$current_date=date("M d,Y",strtotime($message_row['added']));
																	?>
																	<div class="text-center my-3">
																		<span class="px-3 py-2 small bg-white shadow-sm  rounded"><?php echo $current_date; ?></span>
																	</div>
																	<?php
																}
																if($message_row['text_message']=="**RUCONNECTED**")
																{
																	?>
																	<div class="d-flex align-items-center osahan-post-header" style="margin-top:10px;margin-bottom:10px;">
																		<div class="mr-auto ml-auto">
																			<p style="text-align:center;" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo date("h:i a",strtotime($message_row['added'])); ?>">Bridge Constructed.Start Knowing Eachother.</p>
																		</div>
																	</div>
																	<?php
																}
																else if($me==$message_row['user_id'])
																{
																	?>
																	<div class="d-flex align-items-center osahan-post-header" style="margin-top:10px;margin-bottom:10px;">
																		<span class="mr-auto mb-auto">
																		</span>
																		<div class="mr-2 ml-1" style="max-width:60% !important;">
																			<?php
																				if($img_mesg=="1" && $message_row['text_message']!="")
																				{
																					echo '<img src="'.$message_row['text_message'].'" width="320" height="240" style="width:100%;border-radius:10px;" data-toggle="tooltip" data-placement="top" data-original-title="'.date("h:i a",strtotime($message_row['added'])).'">';
																				}
																				else
																				{
																			?>
																					<p data-toggle="tooltip" data-placement="top" data-original-title="<?php echo date("h:i a",strtotime($message_row['added'])); ?>"><?php echo filter_var($message_row['text_message'],FILTER_SANITIZE_STRING); ?></p>
																			<?php
																				}
																			?>
																		</div>
																		<div class="dropdown-list-image ml-3 mb-auto">
																			<img class="rounded-circle" style="border:1px solid #eaebec !important;padding:5px;cursor:pointer;height:2rem;width:2rem;" src="<?php echo $me_image; ?>"  data-toggle="tooltip" data-placement="top" data-original-title="<?php echo $me_name; ?>" alt="<?php echo $me_name; ?>">
																			<p style="margin-top:5px;font-size:9px;">
																				<?php 
																					if($message_row['flag']=="0")
																					{
																						echo "Sent";
																					}
																					else if($message_row['flag']=="1")
																					{
																						echo "Delivered";
																					}
																					else if($message_row['flag']=="2")
																					{
																						echo "Seen";
																					}
																				?>
																			</p>
																		</div>
																	</div>
																	<?php
																}
																else if($me==$message_row['r_user_id'])
																{
																	?>
																	<div class="d-flex align-items-center osahan-post-header" style="margin-top:10px;margin-bottom:10px;">
																		<div class="dropdown-list-image mr-1 mb-auto">
																			<img class="rounded-circle" style="cursor:pointer;border:1px solid #eaebec !important;padding:5px;height:2rem;width:2rem;" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo $selected_user_name; ?>" src="<?php echo $selected_user_profile_image; ?>" alt="<?php echo $selected_user_name; ?>">
																		</div>
																		<div class="mr-1" style="max-width:60% !important;">
																			<?php
																				if($img_mesg==1 && $message_row['text_message']!="")
																				{
																					echo '<img src="'.$message_row['text_message'].'" width="320" height="240" style="width:100%;border-radius:10px;" data-toggle="tooltip" data-placement="top" data-original-title="'.date("h:i a",strtotime($message_row['added'])).'">';
																				}
																				else
																				{
																			?>
																					<p data-toggle="tooltip" data-placement="top" data-original-title="<?php echo date("h:i a",strtotime($message_row['added'])); ?>"><?php echo filter_var($message_row['text_message'],FILTER_SANITIZE_STRING); ?></p>
																			<?php
																				}
																			?>
																		</div>
																	</div>
																	<?php
																}
															}
														}
													?>
												</div>
											</div>
										</div>
										<div class="w-100 border-top border-bottom">
											<textarea placeholder="Write a message…" id="message_box" class="form-control border-0 p-3 shadow-none" style="resize:none;" rows="2"></textarea>
										</div>
										<div class="p-3 d-flex align-items-center">
											<div class="overflow-hidden">
												 <button type="button" onclick="openFileChooser();" class="btn btn-light btn-sm rounded">
													<i class="feather-image"></i>
												 </button>
												 <button type="button" class="btn btn-light btn-sm rounded">
													<i class="feather-paperclip"></i>
												 </button>	
												 <button type="button" onclick="openCamRecorder();" class="btn btn-light btn-sm rounded">
													<i class="feather-camera"></i>
												 </button>
											</div>
											<span class="ml-auto">
												<button type="button" class="btn btn-primary btn-sm rounded" id="message_box_button" data-msnm="<?php echo $me_name; ?>" data-ruid="<?php echo $selected_user; ?>" data-suid="<?php echo $me; ?>" data-suimg="<?php echo $me_image; ?>">
													<i class="feather-send"></i> Send
												</button>
											</span>
										</div>
								<?php
									}
								?>
								<div class="modal fade openCamRecorder" id="openCamRecorder" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="staticBackdropLabel">Capture & Send</h5>
											</div>
											<div class="modal-body">
												<div class="p-2 d-flex">
													<div id="my_camera"></div>
													<br/>
													<div id="results"></div>												
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-warning" onClick="configure();">Reload</button>
												<button type="button" class="btn btn-primary" onClick="take_snapshot();">Capture</button>
												<button type="button" class="btn btn-success" onClick="saveSnap();">Send</button>
												<button type="button" class="btn btn-secondary" onClick="closeModal();">Close</button>
											</div>
										</div>
									</div>
								</div>
								<div class="modal fade openFileChooser" id="openFileChooser" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="staticBackdropLabel">Upload Image And Send</h5>
											</div>
											<div class="modal-body">
												<div class="p-2 d-flex">
													<form id="image_input_form" method="post">
														<input type='file'	name="image_input" id="image_input" accept="image/*">	
													</form>
												</div>
												<div class="p-2 d-flex" id="image_result">
																						
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-primary" onClick="changeImage();">Change Image</button>
												<button type="button" class="btn btn-success" onClick="sendImage();">Send</button>
												<button type="button" class="btn btn-secondary" onClick="closeModalUpload();">Close</button>
											</div>
										</div>
									</div>
								</div>
								<script>
									localStorage.setItem('r_user_id','<?php echo $selected_user; ?>');
									function updateUser(user)
									{
										if(user!="")
										{
											localStorage.setItem('r_user_id',user);
											$('#chat_list_dynamic').load(base_url+"test-chat-list?user_id="+user);
											$('#whole_div').load(base_url+"test-chat?user_id="+user);
											//getUserChat(user);
										}
									}
									function readURLFromFile(input) {
										  if (input.files && input.files[0]) {
											var reader = new FileReader();
											
											reader.onload = function(e) {
											  $('#image_result').html("<image id='image_to_send' src='"+e.target.result+"' style='width:100%;border-radius:10px;'>");
											}
											reader.readAsDataURL(input.files[0]); 
										  }
										}
										function changeImage()
										{
											$("#image_input_form")[0].reset();
											$('#image_result').html("");
											$("#image_input").click();
										}
										function sendImage()
										{
											var base64image=$("#image_to_send").attr("src");
											$("#image_input_form")[0].reset();
											$('#image_result').html("");
											$("#openFileChooser").modal("hide");
											var messageSenderName = $("#message_box_button").attr("data-msnm").trim();
											var messageSenderImage = $("#message_box_button").attr("data-suimg").trim();
											var r_user_id=$("#message_box_button").attr("data-ruid").trim();
											var s_user_id=$("#message_box_button").attr("data-suid").trim();
											if(base64image!="" && base64image!=null && base64image!="undefined")
											{
												var template = Handlebars.compile( $("#image-message-template").html());
												var context = { 
												  messageOutput: base64image,
												  time: getTime(),
												  messageSenderImage:messageSenderImage,
												  r_user_id:r_user_id,
												  s_user_id:s_user_id,
												  messageSenderName:messageSenderName,
												  messageStatus:'Sent'
												};
												var message_transaction_data='<i class="feather-check text-primary"></i><img src="'+base64image+'" width="20" height="20"> &nbsp;Photo';
												$("#chat_history").append(template(context));
												$("#message_transaction_data_"+r_user_id).html(message_transaction_data);
												$.ajax({
													type:'POST',
													url: base_url+"send-message",
													data:{img_mesg:1,r_user_id:r_user_id,s_user_id:s_user_id,s_user_img:messageSenderImage,page_refer:"messenger",text_message:base64image},
													success:function(data){
														var parsedJson=JSON.parse(data);
														if(parsedJson.status=="success")
														{
															
														}
													}
												});
											}
										}
										$("#image_input").change(function() {
										  readURLFromFile(this);
										});
										function openFileChooser()
										{
											$("#openFileChooser").modal("show");
											$("#image_input").click();
										}
										function closeModalUpload()
										{
											$('#image_result').html("");
											$("#image_input_form")[0].reset();
											$("#openFileChooser").modal("hide");
										}
										/*-------------- Capture ----------------------*/
										function openCamRecorder()
										{
											$("#openCamRecorder").modal("show");
											configure();
										}
										function configure(){
											$('#my_camera').show();
											Webcam.set({
												width: 448,
												height: 322,
												image_format: 'jpeg',
												jpeg_quality: 90
											});
											Webcam.attach('#my_camera');
											$("#results").hide();
										}
										function closeModal()
										{
											Webcam.reset();
											$("#openCamRecorder").modal("hide");
										}
										var shutter = new Audio();
										shutter.autoplay = false;
										shutter.src = navigator.userAgent.match(/Firefox/) ? 'shutter.ogg' : 'shutter.mp3';

										function take_snapshot() {
											// play sound effect
											shutter.play();

											// take snapshot and get image data
											Webcam.snap( function(data_uri) {
												$("#results").show();
												document.getElementById('results').innerHTML = '<img id="imageprev" src="'+data_uri+'" style="width:100%;"/>';
											});

											Webcam.reset();
											$('#my_camera').hide();
										}
										function getTime() {
											var date=new Date();
											var hours = date.getHours();
											var minutes = date.getMinutes();
											var ampm = hours >= 12 ? 'PM' : 'AM';
											hours = hours % 12;
											hours = hours ? hours : 12; // the hour '0' should be '12'
											minutes = minutes < 10 ? '0'+minutes : minutes;
											var strTime = hours + ':' + minutes + ' ' + ampm;
											return strTime;
										}
										function saveSnap(){
											var base64image =  document.getElementById("imageprev").src;
											//this.messageToSend = this.$textarea.val().trim();
											var messageSenderName = $("#message_box_button").attr("data-msnm").trim();
											var messageSenderImage = $("#message_box_button").attr("data-suimg").trim();
											var r_user_id=$("#message_box_button").attr("data-ruid").trim();
											var s_user_id=$("#message_box_button").attr("data-suid").trim();
											$("#results").hide();
											if(base64image!="" && base64image!=null && base64image!="undefined")
											{
												var template = Handlebars.compile( $("#image-message-template").html());
												var context = { 
												  messageOutput: base64image,
												  time: getTime(),
												  messageSenderImage:messageSenderImage,
												  r_user_id:r_user_id,
												  s_user_id:s_user_id,
												  messageSenderName:messageSenderName,
												  messageStatus:'Sent'
												};
												var message_transaction_data='<i class="feather-check text-primary"></i><img src="'+base64image+'" width="20" height="20"> &nbsp;Photo';
												$("#chat_history").append(template(context));
												$("#message_transaction_data_"+r_user_id).html(message_transaction_data);
												document.getElementById('results').innerHTML = '';
												Webcam.reset();
												$("#openCamRecorder").modal("hide");
												$.ajax({
													type:'POST',
													url: base_url+"send-message",
													data:{img_mesg:1,r_user_id:r_user_id,s_user_id:s_user_id,s_user_img:messageSenderImage,page_refer:"messenger",text_message:base64image},
													success:function(data){
														var parsedJson=JSON.parse(data);
														if(parsedJson.status=="success")
														{
															
														}
													}
												});
											}
											 /*Webcam.upload(base64image, 'upload.php', function(code, text) {
												 console.log(base64image);
											});*/

										}
									</script>
									<script id="message-template" type="text/x-handlebars-template">
										<div class="d-flex align-items-center osahan-post-header" style="margin-top:10px;margin-bottom:10px;">
											<span class="mr-auto mb-auto">
											</span>
											<div class="mr-2 ml-1" style="max-width:60% !important;">
												<p data-toggle="tooltip" data-placement="top" data-original-title="{{time}}">{{messageOutput}}</p>
											</div>
											<div class="dropdown-list-image ml-3 mb-auto">
												<img class="rounded-circle" style="border:1px solid #eaebec !important;padding:5px;cursor:pointer;height:2rem;width:2rem;" src="{{messageSenderImage}}"  data-toggle="tooltip" data-placement="top" data-original-title="{{messageSenderName}}" alt="{{messageSenderName}}">
												<p style="margin-top:5px;font-size:9px;">
													{{messageStatus}}
												</p>
											</div>
										</div>
									</script>
									<script id="image-message-template" type="text/x-handlebars-template">
										<div class="d-flex align-items-center osahan-post-header" style="margin-top:10px;margin-bottom:10px;">
											<span class="mr-auto mb-auto">
											</span>
											<div class="mr-2 ml-1" style="max-width:60% !important;">
												<img src="{{messageOutput}}" width="320" height="240" style="width:100%;border-radius:10px;"  data-toggle="tooltip" data-placement="top" data-original-title="{{time}}">
											</div>
											<div class="dropdown-list-image ml-3 mb-auto">
												<img class="rounded-circle" style="border:1px solid #eaebec !important;padding:5px;cursor:pointer;height:2rem;width:2rem;" src="{{messageSenderImage}}"  data-toggle="tooltip" data-placement="top" data-original-title="{{messageSenderName}}" alt="{{messageSenderName}}">
												<p style="margin-top:5px;font-size:9px;">
													{{messageStatus}}
												</p>
											</div>
										</div>
									</script>
									<script id="message-response-template" type="text/x-handlebars-template">
									  <li>
										<div class="message-data">
										  <span class="message-data-name"><i class="fa fa-circle online"></i> Vincent</span>
										  <span class="message-data-time">{{time}}, Today</span>
										</div>
										<div class="message my-message">
										  {{response}}
										</div>
									  </li>
									</script>
									<script id="image-message-response-template" type="text/x-handlebars-template">
									  <li>
										<div class="message-data">
										  <span class="message-data-name"><i class="fa fa-circle online"></i> Vincent</span>
										  <span class="message-data-time">{{time}}, Today</span>
										</div>
										<div class="message my-message">
											<img src="{{response}}" width="320" height="240" style="width:100%;border-radius:10px;"  data-toggle="tooltip" data-placement="top" data-original-title="{{time}}">
										</div>
									  </li>
									</script>
									<script src="<?php echo base_url; ?>js/list.min.js"></script>
									<script src="<?php echo base_url; ?>handlebars.js"></script>
									<script type="text/javascript" src="<?php echo base_url; ?>capture/webcamjs/webcam.min.js"></script>
									<script src="<?php echo base_url; ?>chat.js"></script>
							</div>
						 </div>
					  </div>
				   </main>
				   <aside class="col col-xl-3 order-xl-2 col-lg-12 order-lg-2 col-12 d-none d-lg-inline">
					  <div class="box mb-3 shadow-sm border rounded bg-white list-sidebar">
						 <div class="box-title p-3">
							<h6 class="m-0">Manage my network</h6>
						 </div>
						 <ul class="list-group list-group-flush">
							<a href="#">
							   <li class="list-group-item pl-3 pr-3 d-flex align-items-center text-dark"><i class="feather-users mr-2 text-dark"></i> Connections <span class="ml-auto font-weight-bold">68</span></li>
							</a>
							<a href="#">
							   <li class="list-group-item pl-3 pr-3 d-flex align-items-center text-dark"><i class="feather-book mr-2 text-dark"></i> Contacts <span class="ml-auto font-weight-bold">869</span></li>
							</a>
							<a href="#">
							   <li class="list-group-item pl-3 pr-3 d-flex align-items-center text-dark"><i class="feather-user-check mr-2 text-dark"></i> People I Follow <span class="ml-auto font-weight-bold">156</span></li>
							</a>
							<a href="#">
							   <li class="list-group-item pl-3 pr-3 d-flex align-items-center text-dark"><i class="feather-message-circle mr-2 text-dark"></i> Groups <span class="ml-auto font-weight-bold">15</span></li>
							</a>
							<a href="#">
							   <li class="list-group-item pl-3 pr-3 d-flex align-items-center text-dark"><i class="feather-clipboard mr-2 text-dark"></i> Page <span class="ml-auto font-weight-bold">3</span></li>
							</a>
							<a href="#">
							   <li class="list-group-item pl-3 pr-3 d-flex align-items-center text-dark"><i class="feather-tag mr-2 text-dark"></i> Hashtag <span class="ml-auto font-weight-bold">8</span></li>
							</a>
						 </ul>
					  </div>
					  <div class="box shadow-sm mb-3 border rounded bg-white ads-box text-center">
						 <div class="image-overlap-2 pt-4">
							<img src="img/l4.png" class="img-fluid rounded-circle shadow-sm" alt="Responsive image">
							<img src="img/user.png" class="img-fluid rounded-circle shadow-sm" alt="Responsive image">
						 </div>
						 <div class="p-3 border-bottom">
							<h6 class="text-dark">Gurdeep, grow your career by following <span class="font-weight-bold"> Askbootsrap</span></h6>
							<p class="mb-0 text-muted">Stay up-to industry trends!</p>
						 </div>
						 <div class="p-3">
							<button type="button" class="btn btn-outline-primary btn-sm pl-4 pr-4"> FOLLOW </button>
						 </div>
					  </div>
				   </aside>
				</div>
			</div>
		</div>
		<?php include_once 'scripts.php';  ?>
		<script>
			var base_url="<?php echo base_url; ?>";
			var last_message_id="<?php echo $last_message_id ?>";
			localStorage.setItem("last_message_id",last_message_id);
			localStorage.setItem("base_url",base_url);
			
			/*function getUserChat()
			{
				$.ajax({
					url:'',
					type:'post',
					data:{user_id:user},
					success:function(data)
					{
						var parsedJson=JSON.parse(data);
						if(parsedJson.status=="success")
						{
							$("#active_user_image").attr("src",parsedJson.active_user_image);
						}
						else
						{
							console.log(data);
						}
					}
				});
			}*/
			/*-------------- Upload ----------------------*/
			
   </body>
</html>