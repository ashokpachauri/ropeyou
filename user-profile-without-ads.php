<html lang="en">
	<head>
		<?php 
			include_once __DIR__.'/head.php';
			$username=$_REQUEST['__username'];
			$user_query="SELECT * FROM users WHERE username='$username'";
			//echo $user_query;die();
			$user_result=mysqli_query($conn,$user_query);
			if(mysqli_num_rows($user_result)<0)
			{
				require_once __DIR__.'/404.php';die();
			}
			$user_row=mysqli_fetch_array($user_result);
			$applicant_id=$user_row['id'];			
		?>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo $user_row['first_name']." ".$user_row['last_name']; ?>'s Profile | RopeYou Connects</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha256-siyOpF/pBWUPgIcQi17TLBkjvNgNQArcmwJB8YvkAgg=" crossorigin="anonymous" />
		<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
		<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
	</head>
	<style>
		h6{
			font-size: 0.8rem !important;
		}
		.morecontent span {
			display: none;
		}
		.morelink {
			display: block;
		}
		#morelink {
			display: block;
		}
		.image-container-custom{
			position: relative;
		}
		.overlay {
			cursor:pointer;
			position: absolute; 
			bottom: 0; 
			left:53px;
			background: rgb(0, 0, 0);
			background: rgba(0, 0, 0, 0.5); /* Black see-through */
			color: #f1f1f1; 
			width: 150px;
			height:75px;
			transition: .5s ease;
			opacity:0;
			color: white;
			font-size: 14px;
			text-align: center;
			border-bottom-left-radius: 150px;
			border-bottom-right-radius: 150px;
		}
		.image-container-custom:hover .overlay {
		  opacity: 1;
		}
		.hidden-on-dashboard {
			display:none;
		}
		 .feather-briefcase, .feather-edit, .feather-delete,.feather-plus-circle,.feather-settings
		{
			color:gray;
		}
		.social_icon_temp{
			padding: 5px;
			font-size: 16px;
			color: #fff;
			width: 30px;
			height: 30px;
			border-radius: 50%;
			background-color: #4167b2 !important;
		}
	</style>
	<body>
		<?php //include_once 'header.php'; ?>
		<?php 
			$users_personal_row=getUsersPersonalData($applicant_id);
		?>
		<div class="py-4">
			<div class="container" style="position:relative;">
				<div class="row">
				   <!-- Main Content -->
					<style>
						#progress-bar{
						  appearance:none;
						  width: 100%;
						  color: #000;
						  height: 2px;
						  margin: 0 auto;
						}
						.pp{
						  font-size: 12pt;
						  color: #000;
						  text-align: center;
						}
					</style>
					<?php
						$skipped=0;
						$onboarding=getOnBoarding($applicant_id,$skipped);
						$profile_percentage=0;
						$task_arr=array("basic_profile","bio","work_experience","education","skills","resume","profile_pic");
						if(in_array($onboarding,$task_arr))
						{
							switch($onboarding)
							{
								case "basic_profile":$profile_percentage=0;break;
								case "bio":$profile_percentage=10;break;
								case "work_experience":$profile_percentage=20;break;
								case "education":$profile_percentage=30;break;
								case "skills":$profile_percentage=40;break;
								case "resume":$profile_percentage=50;break;
								case "profile_pic":$profile_percentage=60;break;
								case "default":$profile_percentage=70;break;
							}
						}
						else
						{
							$profile_percentage=70;
						}
						$profile_pic=getUserProfileImage($applicant_id);
						$profile_pic_arr=explode("/",$profile_pic);
						$arr=array("a.png","b.png","c.png","d.png","e.png","f.png","g.png","h.png","i.png","j.png","k.png","l.png","m.png","n.png","o.png","p.png","q.png","r.png","s.png","t.png","u.png","v.png","w.png","x.png","y.png","z.png");
						if(in_array(end($profile_pic_arr),$arr))
						{
							$onboarding="profile_pic";
						}
					?>
				   <aside class="col col-xl-12 order-xl-1 col-lg-12 order-lg-1 col-12" id="left_side_bar" style="position:static;">
						<div class="row">
							<div class="col-md-6 col-xl-6 col-sm-6">
								<div class="box mb-3 shadow-sm border rounded bg-white profile-box text-center" style="max-height:336px;min-height: 335px;">
									<div class="py-4 px-3 border-bottom">
										<?php $profile=getUserProfileImage($applicant_id); ?>
										<div class="image-container-custom" style="width:100%;">
											<img id="user_profile_picture" src="<?php echo $profile; ?>" class="img-fluid mt-2 rounded-circle image" style="width:150px;height:150px;border:1px solid #eaebec !important;" alt="<?php echo $user_row['first_name']." ".$user_row['last_name']; ?>">
											<!--<div class="overlay" data-toggle="modal" data-target="#amazing_profile_image_backdrop_modal">Manage</div>-->
										</div>
										<h6 class="font-weight-bold text-dark mb-1 mt-4"><?php echo $user_row['first_name']." ".$user_row['last_name']; ?></h6>
										<p class="mb-0 text-muted"><?php echo $user_row['profile_title']; ?></p>
										<div class="progress progress-striped" style="margin-top:15px !important;height:0.8rem !important;"> 
											<div class="progress-bar progress-bar-success" style="background-color:#1d2f38 !important;"> Your Profile is 0% Completed.</div>
										</div>
										<p style="text-align:center;margin-bottom:-5px;">Profile Completeness</p>
									</div>
									<div class="d-flex">
										<div class="col-6 border-right p-1">
										   <p class="mb-0 text-black-50 small"><span class="font-weight-bold text-dark"><?php echo getUserConnectionCounts($applicant_id); ?></span>  Connections</p>
										</div>
										<div class="col-6 p-1">
										   <p class="mb-0 text-black-50 small"><span class="font-weight-bold text-dark"><?php echo getUserProfileViews($applicant_id); ?></span>  Views</p>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 col-xl-6 col-sm-6">
								<div class="box mb-3 shadow-sm border rounded bg-white profile-box text-center" style="max-height:336px;min-height: 335px;">
									<div class="p-2 border-bottom">
										<h6 class="font-weight-bold">Video cv or profile</h6>
									</div>
									<?php
										$v_query="SELECT * FROM users_resume WHERE user_id='".$applicant_id."' AND profile_type!=1 AND is_default=1 ORDER BY id DESC";
										$v_result=mysqli_query($conn,$v_query);
										$video_num_rows=mysqli_num_rows($v_result);
										$video_file="mov_bbb.mp4";
										$token_video="";
										if($video_num_rows>0)
										{
											$profile_percentage=$profile_percentage+10;
											$v_row=mysqli_fetch_array($v_result);
											$video_file=base_url.$v_row['file'];
											$video_tags=$v_row['video_tags'];
											$profile_title=$v_row['profile_title'];
											$video_type=$v_row['video_type'];
											$token_video=$v_row['id'];
											$resume_headline=$v_row['resume_headline'];
										}
									?>
									<div class="py-3 px-1 border-bottom" style='min-height:270px;max-height:271px;'>
										<?php
											if($video_file!="mov_bbb.mp4")
											{
										?>
										<video muted="" controls="" controlsList="nodownload" id="video_preview_data" style="width:90%;border:2px solid #efefef;border-radius:5px;background-color:#efefef;">
											<source src="<?php echo $video_file; ?>" type="video/mp4">
											Your browser does not support HTML5 video.
										</video>
										<?php
											}
											else{
												echo 'Video cv not provided.';
											}
										?>
										<h6 class="text-truncate" id="video_profile_title" style="font-weight:normal !important;margin-top:20px;"><?php echo $profile_title; ?></h6>
									</div>
									<div class="p-1">
										<h6 class="font-weight-bold text-gold mb-0">Profile Selections - (0)</h6>
									</div>
								</div>
							</div>
						</div>
						<div class="box shadow-sm border rounded bg-white mb-3">
							<div class="box-title border-bottom p-3">
								<h6 class="m-0">About You</h6>
							</div>
							<div class="box-body p-3">
								<?php if($users_personal_row!=false) { echo '<p class="more" id="amazing_about_you_text" style="font-size:14px !important;text-align:justify;">'.trim(filter_var(strip_tags($users_personal_row['about']),FILTER_SANITIZE_STRING)).'</p>'; } else { echo '<p id="amazing_about_you_text" class="more" style="font-size:14px !important;text-align:justify;">Your about information will be apear here when you provide.</p>'; } ?>
							</div>
						</div>
						<div class="box shadow-sm border rounded bg-white mb-3">
							<div class="box-title border-bottom p-3">
								<h6 class="m-0">Contact Details</h6>
							</div>
							<div class="box-body">
								
								<div class="d-flex" style="width:100%;">
								   <div class="col-12 border-right border-top p-2">
										<div class="font-weight-normal">
											<?php
												if($users_personal_row!=false)
												{
													if($users_personal_row['communication_email']!="" && $users_personal_row['communication_email']!=null){
											?>
													<!--<i class="feather-mail"></i>-->
														<div class="text-truncate" title="Email" style="font-size:11px !important;">
															<h6 style="font-size:12px;"><li>Email :&nbsp;<a href="mailto:<?php echo $users_personal_row['communication_email']; ?>" id="communication_email_html" target="_blank"><?php echo $users_personal_row['communication_email']; ?></a></li></h6>
														</div>
													<?php
													}
													if($users_personal_row['communication_mobile']!="" && $users_personal_row['communication_mobile']!=null){
											?>
														<!--<i class="feather-phone"></i>-->
														<div class="text-truncate" title="Mobile" style="font-size:11px !important;">
															<h6 style="font-size:12px;"><li>Mobile :&nbsp;<a href="tel:<?php echo $users_personal_row['communication_mobile']; ?>" target="_blank"><?php echo "(".$users_personal_row['phonecode'].") - ".$users_personal_row['communication_mobile']; ?></a></li></h6>
														</div>
													<?php
													}
													if($users_personal_row['website']!="" && $users_personal_row['website']!=null){
											?>
													<!--<i class="feather-globe"></i>-->
														<div class="text-truncate" title="Website" style="font-size:11px !important;">
															<h6 style="font-size:12px;"><li>Website :&nbsp;<a href="<?php echo $users_personal_row['website']; ?>" target="_blank"><?php echo $users_personal_row['website']; ?></a></li></h6>
														</div>
													<?php
													}
													?>
											<?php
												}
												?>
												<div class="text-truncate" title="Website" style="font-size:11px !important;">
													<h6 style="font-size:12px;"><li>Web View :&nbsp;<a href="<?php echo base_url; ?>u/<?php echo $user_row['username']; ?>" target="_blank"><?php echo base_url; ?>w/<?php echo $user_row['username']; ?></a></li></h6>
												</div>
												<?php
											?>
										</div>
								   </div>
								</div>
								<!--<div class="d-flex">
									<div class="col-6 border-right border-top">
									   <p class="mb-0 text-black-50 small"><a class="font-weight-bold p-1 d-block text-center" href="<?php //echo base_url; ?>u/<?php //echo $user_row['username']; ?>">Employer View</a></p>
									</div>
									<div class="col-6 border-top">
									   <p class="mb-0 text-black-50 small"><a class="font-weight-bold p-1 d-block text-center" href="<?php //echo base_url; ?>w/<?php //echo $user_row['username']; ?>">Web View</a></p>
									</div>
								</div>-->
								<?php
									$social_counts=0;
									$social_counts_arr=array();
									if($users_personal_row['fb_p']!="" && $users_personal_row['fb_p']!=null){
										$social_counts=$social_counts+1;
										$social_counts_arr[]=array($users_personal_row['fb_p'],"feather-facebook");
									}if($users_personal_row['ig_p']!="" && $users_personal_row['ig_p']!=null){
										$social_counts=$social_counts+1;
										$social_counts_arr[]=array($users_personal_row['ig_p'],"feather-instagram");
									}if($users_personal_row['tw_p']!="" && $users_personal_row['tw_p']!=null){
										$social_counts=$social_counts+1;
										$social_counts_arr[]=array($users_personal_row['tw_p'],"feather-twitter");
									}if($users_personal_row['in_p']!="" && $users_personal_row['in_p']!=null){
										$social_counts=$social_counts+1;
										$social_counts_arr[]=array($users_personal_row['in_p'],"feather-linkedin");
									}
									if($social_counts>0)
									{
										$col_width=12/$social_counts;
								?>
										<div class="d-flex text-center">
											<div class="col-3 border-right border-top p-1">
												<p class="mb-0 text-black-50 small text-center">
													<a class="font-weight-bold d-block text-center social_icon_temp" href="<?php 
													if($users_personal_row['fb_p']!="" && $users_personal_row['fb_p']!=null){
														echo $users_personal_row['fb_p'];
													}else{ echo 'javascript:void(0);'; }
												?>"  style="font-size:20px;margin-left:25%;"><i class="fa fa-facebook"></i></a></p><!--feather-facebook-->
											</div>
											<div class="col-3 border-right border-top p-1">
											   <p class="mb-0 text-black-50 small text-center"><a class="font-weight-bold d-block text-center social_icon_temp" href="<?php 
													if($users_personal_row['ig_p']!="" && $users_personal_row['ig_p']!=null){
														echo $users_personal_row['ig_p'];
													}else{ echo 'javascript:void(0);'; }
												?>" style="font-size:20px;background-color:#cf2217 !important;margin-left:25%;"><i class="fa fa-instagram"></i></a></p><!--feather-instagram-->
											</div>
											<div class="col-3 border-right border-top p-1">
											   <p class="mb-0 text-black-50 small text-center"><a class="font-weight-bold d-block text-center social_icon_temp" href="<?php 
													if($users_personal_row['tw_p']!="" && $users_personal_row['tw_p']!=null){
														echo $users_personal_row['tw_p'];
													}else{ echo 'javascript:void(0);'; }
												?>" style="font-size:20px;background-color:#00b7d6 !important;margin-left:25%;"><i class="fa fa-twitter"></i></a></p><!--feather-twitter-->
											</div>
											<div class="col-3 border-right border-top p-1">
											   <p class="mb-0 text-black-50 small text-center"><a class="font-weight-bold d-block text-center social_icon_temp" href="<?php 
													if($users_personal_row['in_p']!="" && $users_personal_row['in_p']!=null){
														echo $users_personal_row['in_p'];
													}else{ echo 'javascript:void(0);'; }
												?>" style="font-size:20px;background-color|:#0281ac !important;margin-left:25%;"><i class="fa fa-linkedin"></i></a></p><!--feather-linkedin-->
											</div>
										</div>
										<!--<div class="d-flex">
											<?php
												/*for($i=0;$i<$social_counts;$i++)
												{
													?>
													<div class="col-<?php echo $col_width; ?> border-right border-top p-1">
													   <p class="mb-0 text-black-50 small"><a class="font-weight-bold d-block" href="<?php echo $social_counts_arr[$i][0]; ?>" target="_blank" style="font-size:16px;"><i class="<?php echo $social_counts_arr[$i][1]; ?>"></i></a></p>
													</div>
													<?php
												}\*/
											?>
										</div>-->
								<?php
									}
									else
									{
										?>
										<div class="d-flex text-center">
											<div class="col-3 border-right border-top p-1">
											   <p class="mb-0 text-black-50 small text-center"><a class="font-weight-bold d-block text-center social_icon_temp" href="javascript:void(0);" style="font-size:20px;margin-left:25%;"><i class="fa fa-facebook"></i></a></p>
											</div>
											<div class="col-3 border-right border-top p-1">
											   <p class="mb-0 text-black-50 small text-center"><a class="font-weight-bold d-block text-center social_icon_temp" href="javascript:void(0);"  style="font-size:20px;background-color:#cf2217 !important;margin-left:25%;"><i class="fa fa-instagram"></i></a></p>
											</div>
											<div class="col-3 border-right border-top p-1">
											   <p class="mb-0 text-black-50 small text-center"><a class="font-weight-bold d-block text-center social_icon_temp" href="javascript:void(0);" style="font-size:20px;background-color:#00b7d6 !important;margin-left:25%;"><i class="fa fa-twitter"></i></a></p>
											</div>
											<div class="col-3 border-right border-top p-1">
											   <p class="mb-0 text-black-50 small text-center"><a class="font-weight-bold d-block text-center social_icon_temp" href="javascript:void(0);" style="font-size:20px;background-color|:#0281ac !important;margin-left:25%;"><i class="fa fa-linkedin"></i></a></p>
											</div>
										</div>
										<?php
									}
								?>
							</div>
						</div>
						<div class="box shadow-sm border rounded bg-white mb-3">
							<div class="box-title border-bottom p-3">
								<h6 class="m-0">Resume Downloads - (0)</h6>
							</div>
							<div class="box-body">
								<div class="d-flex" style="width:100%;">
								   <div class="col-12 border-right border-top p-1">
									   <div class="font-weight-bold">
											<div class="text-truncate p-1" style="font-size:11px !important;">
												<?php
													$v_query="SELECT * FROM users_resume WHERE user_id='".$applicant_id."' AND profile_type=1 ORDER BY id DESC LIMIT 1";
													$v_result=mysqli_query($conn,$v_query);
													if(mysqli_num_rows($v_result)>0)
													{
														$v_row=mysqli_fetch_array($v_result);
														?>
														</video>
														<span style="width:100% !important;"><a href="<?php echo base_url.$v_row['file']; ?>" target="_blank"><?php echo $v_row['file_title']; ?></a></span>
														<?php
													}
													else
													{
														?>
														<div style="min-height:150px;"><h6 style="text-align:center;font-size:12px;">Resume not uploaded</h6></div>
														<?php
													}
												?>
												
											</div>
									   </div>
								   </div>
								</div>
							</div>
						</div>
						<div class="box shadow-sm border rounded bg-white mb-3">
							<div class="box-title border-bottom p-3">
								<h6 class="m-0">Gallery<a href="<?php echo base_url.'gallery'; ?>" style="float:right;">View All</a></h6>
							</div>
							<div class="box-body">
								<div class="d-flex border-bottom" style="width:100%;">
									<div class="col-6 p-1" style="text-align:center;">
										<a href="javascript:void(0);" style="text-align:center;">Personal</a>
									</div>
									<div class="col-6 p-1" style="text-align:center;">
										<a href="javascript:void(0);" style="text-align:center;">Professional</a>
									</div>
								</div>
								<div class="row">
									<div id="professional_data_matrix" class="col-6 p-1" style="width:100%;min-height:100px;">
										<?php
											$gquery="SELECT * FROM gallery WHERE is_professional=0 AND is_private=0 AND is_draft=0 AND user_id='".$applicant_id."' AND type LIKE 'image/%' ORDER BY id DESC LIMIT 6";
											//echo $gquery;
											$gresult=mysqli_query($conn,$gquery);
											if(mysqli_num_rows($gresult)>0)
											{
												while($grow=mysqli_fetch_array($gresult))
												{
													if(is_file($grow['file']))
													{
														?>
														<img src="<?php echo base_url.$grow['file']; ?>" style="width:85px;padding:5px;border:1px solid gray;display:inline;height:85px !important;margin:4px;cursor:pointer;border-radius:50%;">
														<?php
													}
												}
											}
											else
											{
												?>
												<div class="col-12 p-1 border-left" id="nothing_to_show_gallery_1">
													<div class="font-weight-bold p-2">
														<h6 style="text-align:center;font-size:14px;">Nothing to show.</h6>
													</div>
												</div>
												<?php
											}
										?>										
									</div>
									<div id="personal_data_matrix" class="col-md-6 p-1 border-left" style="width:100%;min-height:100px;">
										<?php
											$gquery="SELECT * FROM gallery WHERE is_professional=1 AND is_private=0 AND is_draft=0 AND user_id='".$applicant_id."' AND type LIKE 'image/%' ORDER BY id DESC LIMIT 6";
											$gresult=mysqli_query($conn,$gquery);
											if(mysqli_num_rows($gresult)>0)
											{
												while($grow=mysqli_fetch_array($gresult))
												{
													if(is_file($grow['file']))
													{
														?>
														<img src="<?php echo base_url.$grow['file']; ?>"  style="width:85px;padding:5px;border:1px solid gray;display:inline;height:85px !important;margin:4px;cursor:pointer;border-radius:50%;">
														<?php
													}
												}
											}
											else
											{
												?>
												<div class="col-12 p-1" id="nothing_to_show_gallery">
													<div class="font-weight-bold p-2">
														<h6 style="text-align:center;font-size:14px;">Nothing to show.</h6>
													</div>
												</div>
												<?php
											}
										?>
									</div>
								
								</div>
							</div>
						</div>
						
						<div class="box shadow-sm border rounded bg-white mb-3">
							<div class="box-title border-bottom p-3">
								<h6 class="m-0">Experiences </h6>
							</div>
							<div class="box-body" id="experience_data_matrix">
							<?php
								$experience_query="SELECT * FROM users_work_experience WHERE user_id='$applicant_id' AND status=1 ORDER BY from_year DESC";
								$experience_result=mysqli_query($conn,$experience_query);
								if(mysqli_num_rows($experience_result)>0)
								{
									while($experience_row=mysqli_fetch_array($experience_result))
									{
										$experience_id=$experience_row['id'];
										$country_query="SELECT title FROM country WHERE id='".$experience_row['country']."'";
										$country_result=mysqli_query($conn,$country_query);
										$country_row=mysqli_fetch_array($country_result);
										
										$city_query="SELECT title FROM city WHERE id='".$experience_row['city']."'";
										$city_result=mysqli_query($conn,$city_query);
										$city_row=mysqli_fetch_array($city_result);
									?>
										<div class="box-body p-3 border-bottom" id="work_exp_<?php echo $experience_id; ?>">
											<div class="d-flex align-items-top job-item-header pb-2">
											   <div class="mr-2">
												  <h6 class="font-weight-bold text-dark mb-0" style="font-weight:normal !important;margin-bottom:5px !important;"><?php echo $experience_row['title']; ?>&nbsp;&nbsp;</h6>
												  <div class="text-truncate text-primary" style="margin-bottom:4px;"><?php echo $experience_row['company']; ?></div>
												  <div class="small text-gray-500"><?php echo print_month($experience_row['from_month'])." ".$experience_row['from_year']; ?>  to <?php if($experience_row['working']=="1"){ echo "Present"; } else { echo print_month($experience_row['to_month'])." ".$experience_row['to_year']; } ?></div>
											   </div>
											   <img class="img-fluid ml-auto mb-auto" src="<?php echo base_url; ?>img/l3.png" alt="">
											</div>
											<p class="mb-0 more">
												<?php
													if($experience_row['description']==""){
														echo "<b>".$experience_row['title']."</b> at <b>".$experience_row['company']."</b> in <b>".$city_row['title'].", ".$country_row['title']."</b> from <b>".print_month($experience_row['from_month'])." ".$experience_row['from_year']."</b> to <b>";
														if($experience_row['working']=="1"){ echo "Present</b>."; } else { echo print_month($experience_row['to_month'])." ".$experience_row['to_year']."</b>."; }
													}
													else
													{
														echo $experience_row['description'];
													}
												?>
											</p>
										</div>
									<?php
									}
								}
								else
								{
									?>
									<div class="box-body p-3 border-bottom" id="nothing_to_show_exp">
										<div class="d-flex align-items-top job-item-header pb-2">
											<div class="col-12 p-1">
												<div class="font-weight-bold p-2">
													<h6 style="text-align:center;">Nothing to show.</h6>
												</div>
											</div>
										</div>
									</div>
									<?php
								}
							?>
							</div>
						</div>
						<div class="box shadow-sm border rounded bg-white mb-3">
							<div class="box-title border-bottom p-3">
								<h6 class="m-0">Education</h6>
							</div>
							<div class="box-body" id="educational_data_matrix">
								<?php
									$education_query="SELECT * FROM users_education WHERE user_id='$applicant_id' AND status=1 ORDER BY from_year DESC";
									$education_result=mysqli_query($conn,$education_query);
									//echo $education_query;
									if(mysqli_num_rows($education_result)>0)
									{
										while($education_row=mysqli_fetch_array($education_result))
										{
											$education_id=$education_row['id'];
											$country_query="SELECT title FROM country WHERE id='".$education_row['country']."'";
											$country_result=mysqli_query($conn,$country_query);
											$country_row=mysqli_fetch_array($country_result);
											
											$city_query="SELECT title FROM city WHERE id='".$education_row['city']."'";
											$city_result=mysqli_query($conn,$city_query);
											$city_row=mysqli_fetch_array($city_result);
								?>
										<div class="box-body p-3 border-bottom" id="edu_<?php echo $education_id; ?>">
											<div class="d-flex align-items-top job-item-header pb-2">
											   <div class="mr-2">
												  <h6 class="font-weight-bold text-dark mb-0" style="font-weight:normal !important;margin-bottom:5px !important;"><?php echo $education_row['university']; ?>&nbsp;&nbsp;</h6>
												  <div class="text-truncate text-primary" style="margin-bottom:4px;"><?php echo $education_row['title']; ?></div>
												  <div class="small text-gray-500"><?php echo print_month($education_row['from_month'])." ".$education_row['from_year']; ?>  to <?php if($education_row['studying']=="1"){ echo "Present"; } else { echo print_month($education_row['to_month'])." ".$education_row['to_year']; } ?>  </div>
											   </div>
											   <img class="img-fluid ml-auto mb-auto" src="<?php echo base_url; ?>img/e1.png" alt="">
											</div>
											<p class="mb-0 more">
												<?php 
													if($education_row['description']==""){
														echo "<b>".$education_row['title']."</b> in <b>".$education_row['major']."</b> at <b>".$education_row['university']."</b> in <b>".$city_row['title'].", ".$country_row['title']."</b> from <b>".print_month($education_row['from_month'])." ".$education_row['from_year']."</b> to <b>";
														if($education_row['studying']=="1"){ echo "Present</b>."; } else { echo print_month($education_row['to_month'])." ".$education_row['to_year']."</b>."; }
													}
													else
													{
														echo $education_row['description'];
													}
												?>
											</p>
										</div>
								<?php
										}
									}
									else{
										?>
											<div class="box-body p-3 border-bottom" id="nothing_to_show_edu">
												<div class="d-flex align-items-top job-item-header pb-2">
													<div class="col-12 p-1">
														<div class="font-weight-bold p-2">
															<h6 style="text-align:center;">Nothing to show.</h6>
														</div>
													</div>
												</div>
											</div>
										<?php
									}
								?>
							</div>	
						</div>
						<?php
							$awards_query="SELECT * FROM users_awards WHERE status=1 AND user_id='".$applicant_id."'";
							$awards_result=mysqli_query($conn,$awards_query);
						?>
						<div class="box shadow-sm border rounded bg-white mb-3">
							<div class="box-title border-bottom p-3">
								<h6 class="m-0">Achievements</h6>
							</div>
							<div class="box-body" id="award_data_matrix">	
								<?php
									if(mysqli_num_rows($awards_result)>0)
									{
										$profile_percentage=$profile_percentage+10;
										while($awards_row=mysqli_fetch_array($awards_result))
										{
											$award_id=$awards_row['id'];
								?>
										<div class="d-flex border-bottom" style="width:100%;" id="award_<?php echo $award_id; ?>">
											<?php
												if($awards_row['image']!="" && $awards_row['image']!=null)
												{
													$image=base_url.$awards_row['image'];
											?>
													<div class="col-3 border-right border-top p-1">
														<img class="img-fluid" style="border:1px solid gray;width:100% !important;" src="<?php echo $image; ?>" alt="<?php echo $awards_row['title']; ?>">
													</div>
											<?php
												}
											?>
											<div class="col-<?php if($awards_row['image']!="" && $awards_row['image']!=null){ echo "9"; }else { echo "12"; } ?> border-top p-1">
												<h6 class="m-0" style="text-align:center;font-size:14px;font-weight:normal;"><?php echo $awards_row['title']; ?></h6>
												<p class="mt-1 p-1"><?php echo $awards_row['description']; ?></p>
											</div>
										</div>
								<?php
										}
									}
									else
									{
										?>
										<div class="d-flex border-bottom" style="width:100%;" id="nothing_to_show_award">
											<div class="col-12 p-1">
												<h6 class="m-0" style="text-align:center;">Nothing to show.</h6>
											</div>
										</div>
										<?php
									}
								?>
							</div>
						</div>
						<div class="box shadow-sm border rounded bg-white mb-3">
							<div class="box-title border-bottom p-3">
								<h6 class="m-0">Skills</h6>
							</div>
							<div class="box-body">
								<?php
									$skills_query="SELECT * FROM users_skills WHERE user_id='".$applicant_id."' AND status=1";
									$skills_result=mysqli_query($conn,$skills_query);
									if(mysqli_num_rows($skills_result)>0)
									{
										while($skills_row=mysqli_fetch_array($skills_result))
										{
											$skillMeterHtml="";
											$skillMeterTitle="";
											if(((int)($skills_row['proficiency']))<=33)
											{
												$skillMeterHtml='<span class="badge badge-success ml-1" style="border: 2px solid #00c9a7;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-dark ml-1" style="color: #343a40 !important;background-color: #fff !important;border: 2px solid #343a40 !important;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-dark ml-1" style="color: #343a40 !important;background-color: #fff !important;border: 2px solid #343a40 !important;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span>';
												$skillMeterTitle="Basic";
											}
											else if(((int)($skills_row['proficiency']))<=66)
											{
												$skillMeterHtml='<span class="badge badge-success ml-1" style="border: 2px solid #00c9a7;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-success ml-1" style="border: 2px solid #00c9a7;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-dark ml-1" style="color: #343a40 !important;background-color: #fff !important;border: 2px solid #343a40 !important;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span>';
												$skillMeterTitle="Proficient";
											}
											else if(((int)($skills_row['proficiency']))<=100)
											{
												$skillMeterHtml='<span class="badge badge-success ml-1" style="border: 2px solid #00c9a7;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-success ml-1" style="border: 2px solid #00c9a7;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-success ml-1" style="border: 2px solid #00c9a7;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span>';
												$skillMeterTitle="Expert";
											}
								?>			
											<div class="d-flex" style="width:100%;">
											   <div class="col-12 border-right border-top p-1">
												   <div class="font-weight-bold">
													  <div class="text-truncate" style="font-size:10px !important;"><span style="min-width:70% !important;"><?php echo $skills_row['title']; ?></span><span style="max-width:30% !important;float:right !important;" title="<?php echo $skillMeterTitle; ?>"><?php echo $skillMeterHtml; ?></span></div>
												   </div>
											   </div>
											</div>
								<?php
										}
									}
									else{
										?>
										<div class="col-12 p-1" id="nothing_to_show_gallery_1">
											<div class="font-weight-bold p-2">
												<h6 style="text-align:center;font-size:14px;">Nothing to show.</h6>
											</div>
										</div>
										<?php
									}
								?>
							</div>
						</div>
						<div class="box shadow-sm border rounded bg-white mb-3" id="left_sidebar_interests">
							<div class="box-title border-bottom p-3">
								<h6 class="m-0">Interests</h6>
							</div>
							<div class="box-body">	
								<?php
									$query="SELECT * FROM users_interests WHERE user_id='$applicant_id'";
									$result=mysqli_query($conn,$query);
									if(mysqli_num_rows($result)>0)
									{
										$profile_percentage=$profile_percentage+10;
										while($row=mysqli_fetch_array($result))
										{
										?>
										<div class="d-flex" style="width:100%;">
										   <div class="col-12 border-top p-1">
											   <div class="font-weight-bold">
												  <div class="text-truncate" style="font-size:12px !important;margin-bottom: -14px;"><ul><li><?php echo $row['title']; ?></li></ul></div>
											   </div>
										   </div>
										</div>
										<?php
										}
									}
									else
									{
										?>
										<div class="col-12 p-1" id="nothing_to_show_gallery_1">
											<div class="font-weight-bold p-2">
												<h6 style="text-align:center;font-size:14px;">Nothing to show.</h6>
											</div>
										</div>
										<?php
									}
								?>
							</div>
						</div>
						
						<div class="box shadow-sm border rounded bg-white mb-3">
							<div class="box-title border-bottom p-3">
								<h6 class="m-0">Influencers Following</h6>
							</div>
							<div class="box-body">
								<?php
									$follower_query="SELECT * FROM users_followers WHERE status=1 AND follower_id='".$applicant_id."' AND type=1";
									$follower_result=mysqli_query($conn,$follower_query);
									//echo $follower_query;
									if(mysqli_num_rows($follower_result)>0)
									{
										?>
										<div class="mb-3 shadow-sm rounded box bg-white osahan-slider-main">
											<div class="osahan-slider">
											<?php
												while($follower_row=mysqli_fetch_array($follower_result))
												{
													$influencer_id=$follower_row['user_id'];
													$follower_data=getUsersData($influencer_id);
													$follower_data_personal=getUsersPersonalData($influencer_id);
													?>
													<div class="osahan-slider-item">
														<a href="<?php echo base_url."u/".$follower_data['username']; ?>">
															<div class="shadow-sm border rounded bg-white job-item job-item mr-2 mt-3 mb-3">
																<div class="d-flex align-items-center p-3 job-item-header">
																	<img class="img-fluid img-responsive" src="<?php echo getUserProfileImage($influencer_id); ?>" alt="" style="border:1px solid #eaebec !important;padding: 2px;border-radius: 7px;width:50px;height:50px;border-radius:50%;">
																	<div class="overflow-hidden p-1">
																		<h6 class="font-weight-bold text-dark mb-0 text-truncate" style="font-size:12px;font-weight:normal !important;"><?php echo $follower_data['first_name']." ".$follower_data['last_name']; ?></h6>
																		<div class="text-truncate text-primary"><?php echo $follower_data['profile_title']; ?></div>
																		<?php
																			if($follower_data_personal!=false)
																			{
																	   ?>
																				<div class="small text-gray-500"><i class="feather-map-pin"></i> <?php echo getCityByID($follower_data_personal['home_town']).", ".getCountryByID($follower_data_personal['country']); ?></div>
																		<?php
																			}
																		?>
																	</div>
																</div>
																<div class="d-flex align-items-center p-3 border-top border-bottom job-item-body">
																	<div class="overlap-rounded-circle d-flex">
																		<img class="rounded-circle shadow-sm" data-toggle="tooltip" data-placement="top" title="" src="img/p1.png" alt="" data-original-title="Sophia Lee">
																		<img class="rounded-circle shadow-sm" data-toggle="tooltip" data-placement="top" title="" src="img/p2.png" alt="" data-original-title="John Doe">
																		<img class="rounded-circle shadow-sm" data-toggle="tooltip" data-placement="top" title="" src="img/p3.png" alt="" data-original-title="Julia Cox">
																		<img class="rounded-circle shadow-sm" data-toggle="tooltip" data-placement="top" title="" src="img/p4.png" alt="" data-original-title="Robert Cook">
																		<img class="rounded-circle shadow-sm" data-toggle="tooltip" data-placement="top" title="" src="img/p5.png" alt="" data-original-title="Sophia Lee">
																	</div>
																	<span class="font-weight-bold text-primary">18 connections</span>
																</div>
															</div>
														</a>
													</div>
													<?php
												}	
										?>
											</div>
										</div>
										<?php
									}
									else
									{
										?>
										<div class="d-flex" style="width:100%;">
											<div class="col-12 border-top p-1">
												<h6 class="m-0" style="text-align:center;">Nothing to show.</h6>
											</div>
										</div>
										<?php
									}
								?>
							</div>
						</div>
						<div class="box shadow-sm border rounded bg-white mb-3">
							<div class="box-title border-bottom p-3">
								<h6 class="m-0">Recommendations</h6>
							</div>
							<div class="box-body">
								<?php
									$r_query_1="SELECT * FROM recommendations WHERE r_user_id='$applicant_id' ORDER BY added ASC";
									$r_result_1=mysqli_query($conn,$r_query_1);
									
									$r_query="SELECT * FROM recommendations WHERE user_id='$applicant_id' AND status!=2 ORDER BY status DESC";
									$r_result=mysqli_query($conn,$r_query);
								?>
								<div class="d-flex border-bottom" style="width:100%;">
									<div class="col-12 p-1">
										<a href="javascript:void(0);" id="rr_anchor" onclick="showReceivedRec();">Received (<?php echo mysqli_num_rows($r_result); ?>)</a>
										&nbsp;&nbsp;
										<a href="javascript:void(0);" id="gr_anchor" onclick="showGivenRec();" style="color:black;">Given (<?php echo mysqli_num_rows($r_result_1); ?>)</a>
									</div>
								</div>
								<div style="width:100%;" id="received_recommendations">
									<div id="recommendation_data_matrix" style="width:100%;">
									<?php
										if(mysqli_num_rows($r_result))
										{
											while($r_row=mysqli_fetch_array($r_result))
											{
												$user_data_r=getUsersData($r_row['r_user_id']);
												$data='<div class="d-flex border-bottom" style="width:100%;" id="rec_'.$r_row['id'].'">
													<div class="col-3 border-right border-top p-1">
														<img class="img-fluid" style="border:1px solid gray;width:100% !important;border-radius: 50%;" src="'.getUserProfileImage($r_row['r_user_id']).'">
													</div>
													<div class="col-9 border-top p-1">
														<h6 class="m-0" style="text-align:center;font-size:14px;font-weight:normal !important;">'.$user_data_r['first_name'].' '.$user_data_r['last_name'].' - ';
														if($r_row['status']=="0")
														{
															$data=$data.'<span style="color:red;">Pending</span>';
															$data=$data.'<span style="float: right !important;">&nbsp;&nbsp;<a style="cursor:pointer;color:red;" title="Delete" onclick="deleteRec('.$r_row['id'].');" href="javascript:void(0);"><i class="feather-trash-2"></i></a></span></h6>
																	<p class="mt-1 p-1">'.$r_row['custom_message'].'</p>';
														}
														else
														{
															$data=$data.'<span style="color:green;">Active</span>';
															$data=$data.'<span style="float: right !important;">&nbsp;&nbsp;<a style="cursor:pointer;color:red;" title="Delete" onclick="deleteRec('.$r_row['id'].');" href="javascript:void(0);"><i class="feather-trash-2"></i></a></span></h6>
																	<p class="mt-1 p-1">'.$r_row['r_text'].'</p>';
														}
												$data=$data.'</div></div>';
														
												echo $data;
											}
										}
										else
										{
											?>
											<div class="col-12 p-1" id="nothing_to_show_rec">
												<div class="font-weight-bold p-2">
													<h6 style="text-align:center;font-size:14px;">Nothing to show.</h6>
												</div>
											</div>
											<?php
										}
									?>
									</div>
								</div>
								<div class="" style="width:100%;display:none;" id="given_recommendations">
									<div id="recommendation_data_matrix_1" style="width:100%;">
										<?php
											if(mysqli_num_rows($r_result_1))
											{
												while($r_row=mysqli_fetch_array($r_result_1))
												{
													$user_data_r=getUsersData($r_row['user_id']);
													$data='<div class="d-flex border-bottom" style="width:100%;" id="rec_'.$r_row['id'].'">
														<div class="col-3 border-right border-top p-1">
															<img class="img-fluid" style="border:1px solid gray;width:100% !important;border-radius: 50%;" src="'.getUserProfileImage($r_row['user_id']).'">
														</div>
														<div class="col-9 border-top p-1">
															<h6 class="m-0" style="text-align:center;font-size:14px;font-weight:normal !important;">'.$user_data_r['first_name'].' '.$user_data_r['last_name'].'';
															$data=$data.'';
															$data=$data.'<span style="float: right !important;">&nbsp;&nbsp;<a style="cursor:pointer;color:red;" title="Delete" onclick="deleteRec('.$r_row['id'].');" href="javascript:void(0);"><i class="feather-trash-2"></i></a></span></h6>
																	<p class="mt-1 p-1">'.$r_row['r_text'].'</p>
																</div>
															</div>';
															
													echo $data;
												}
											}
											else
											{
												?>
												<div class="col-12 p-1" id="nothing_to_show_rec_1">
													<div class="font-weight-bold p-2">
														<h6 style="text-align:center;font-size:14px;font-weight:normal !important;">Nothing to show.</h6>
													</div>
												</div>
												<?php
											}
										?>
									</div>
								</div>
							</div>
						</div>
					</aside>
				</div>
			</div>
		</div>
		<?php include_once 'scripts.php'; ?>
		<script src="<?php echo base_url; ?>/js/sweetalert.min.js"></script>
		<script src="<?php echo base_url; ?>jquery.sticky-kit.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha256-bqVeqGdJ7h/lYPq6xrPv/YGzMEb6dNxlfiTUHSgRCp8=" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
		<script>
			/*$("body").scroll(function(){
				var offset=$("#left_side_bar").offset();
				console.log(offset);
			});*/
			/*$(window).scroll(function (event) {
				var scroll = $(window).scrollTop();
				var offset=$("#left_sidebar_interests").offset();
				console.log(offset);
				console.log(scroll);
			});*/
			<?php
				if($onboarding=="profile_pic")
				{
					?>
					//$("#amazing_profile_image_backdrop_modal").modal('show');
					<?php
				}
			?>
			function loader(action)
			{
				if(action=="" || action=="open")
				{
					$("#loadMe").modal({
					  backdrop: "static", //remove ability to close modal with click
					  keyboard: false, //remove option to close with keyboard
					  show: true //Display loader!
					});
				}
				else{
					$("#loadMe").modal('hide');
				}
			}
			var profile_percentage="<?php echo $profile_percentage; ?>";
			$(document).ready( function(){
				var x = parseInt(profile_percentage);
				window.percent = 0;
				window.progressInterval = window.setInterval( function(){
					if(window.percent < x) {
						window.percent++;
						$('.progress').addClass('progress-striped').addClass('active');
						$('.progress .progress-bar:first').removeClass().addClass('progress-bar')
						.addClass ( (percent < 40) ? 'progress-bar-danger' : ( (percent < 80) ? 'progress-bar-warning' : 'progress-bar-success' ) ) ;
						$('.progress .progress-bar:first').width(window.percent+'%');
						$('.progress .progress-bar:first').text(window.percent+'%');
					} else {
						window.clearInterval(window.progressInterval);
						// jQuery('.progress').removeClass('progress-striped').removeClass('active');
						//jQuery('.progress .progress-bar:first').text('Done!');
					}
				}, 100 );
			});
			$(".is_stuck").stick_in_parent();
			var base_url="<?php echo base_url; ?>";
			$(document).ready(function(){
				var maxField = 10; //Input fields increment limitation
				var addButton = $('.add_button_1'); //Add button selector
				var value_wrapper_1 = $('.value_wrapper_1'); 
				var wrapper1 = $('.field_wrapper_1'); 
				
						//New input field html 
				var x = 1; //Initial field counter is 1
				
				//Once add button is clicked
				$(addButton).click(function(){
					$.ajax({
						url:base_url+'getaddinterestsform',
						type:'post',
						data:{},
						success:function(data)
						{
							$(wrapper1).html(data);
						}
					});
				});
				
				//Once remove button is clicked
				$(wrapper1).on('click', '.remove_button', function(e){
					$(wrapper1).html('');
				});
			});
			function getInterests()
			{
				$("#interests_modal_opner").modal("show");
			}
			function reloadPage()
			{
				//$("#skills_modal_opner").modal("hide");
				window.location.href=base_url+"dashboard";
			}
			$(document).ready(function(){
				var maxField = 10; //Input fields increment limitation
				var addButton = $('.add_button'); //Add button selector
				var value_wrapper = $('.value_wrapper'); 
				var wrapper = $('.field_wrapper'); 
				
						//New input field html 
				var x = 1; //Initial field counter is 1
				
				//Once add button is clicked
				$(addButton).click(function(){
					$.ajax({
						url:base_url+'getaddskillsform',
						type:'post',
						data:{},
						success:function(data)
						{
							$(wrapper).html(data);
						}
					});
				});
				
				//Once remove button is clicked
				$(wrapper).on('click', '.remove_button', function(e){
					$(wrapper).html('');
				});
			});
			function getSkills()
			{
				$("#skills_modal_opner").modal("show");
			}
			function saveContacts()
			{
				var communication_email=$("#communication_email").val().trim();
				var communication_mobile=$("#communication_mobile").val().trim();
				if(communication_email=="" || communication_mobile=="")
				{
					$("#contact_err").html('please fill all required fields.');
					return;
				}
				else
				{
					var form = $('#user_contact_form')[0]; // You need to use standard javascript object here
					var formData = new FormData(form);
					$.ajax({
						url:base_url+"saveusercontacts",
						type:"post",
						data:formData,
						contentType: false, 
						processData: false,
						success:function(data)
						{
							var parsedJson=JSON.parse(data);
							if(parsedJson.status=="success")
							{
								window.location.href=base_url+'dashboard';
							}
							else
							{
								$("#contact_err").html(parsedJson.message);
							}
						}
					});
				}
			}
			function getContacts()
			{
				$("#amazing_contact_backdrop_modal").modal("show");
			}
			$(document).on("change", "#profile_video_cv", function(evt) {
				var $source = $('#video_preview');
				$source[0].src = URL.createObjectURL(this.files[0]);
				$source.parent()[0].load();
			});
			function saveProfileVideo()
			{
				$("#video_file_err").html('');
				var form = $('#user_profile_video_form')[0]; // You need to use standard javascript object here
				var formData = new FormData(form);
				$("#loadMe").modal('show');
				$.ajax({
					url:base_url+"saveuserprofilevideo",
					type:"post",
					data:formData,
					contentType: false, 
					processData: false,
					success:function(data)
					{
						$("#loadMe").modal('hide');
						var parsedJson=JSON.parse(data);
						if(parsedJson.status=="success")
						{
							var $source = $('#video_preview');
							$source[0].src = parsedJson.data;
							//$source.parent()[0].load();
							
							var $source = $('#video_preview_data');
							$source[0].src = parsedJson.data;
							//$source.parent()[0].load();
							$("#token_video").val(parsedJson.id);
							$("#video_profile_title").html(parsedJson.profile_title);
							$("#video_cv_upload_modal").modal("hide");
						}
						else
						{
							$("#video_file_err").html(parsedJson.message);
						}
					}
				});
			}
			function getVideoCV()
			{
				$("#video_cv_upload_modal").modal("show");
			}
			function removeProfileImage()
			{
				var token=$("#profile_image_token").val();
				var is_default=$("#user_profile_picture_demo").attr("data-file");
				if(is_default!="")
				{
					$("#file_err").html("default image can not be removed.");
					return;
				}
				if(token!="")
				{
					$.ajax({
						url:base_url+'removeprofileimage',
						type:'post',
						data:{id:token},
						success:function(data)
						{
							var parsedJson=JSON.parse(data);
							if(parsedJson.status=="success")
							{
								$('#user_profile_picture_demo').attr("src",parsedJson.data);
								$('#user_profile_picture').attr("src",parsedJson.data);
								$("#user_profile_picture_demo").attr("data-file","default");
							}
							else{
								$("#file_err").html(parsedJson.message);
							}
						}
					});
				}
				else
				{
					alert('Invalid option');
				}
			}
			function saveProfileImage()
			{
				$("#file_err").html("");
				var form = $('#user_profile_image_form')[0]; // You need to use standard javascript object here
				var formData = new FormData(form);
				$.ajax({
					url:base_url+"saveuserprofilepicture",
					type:"post",
					data:formData,
					contentType: false, 
					processData: false,
					success:function(data)
					{
						var parsedJson=JSON.parse(data);
						if(parsedJson.status=="success")
						{
							$("#user_profile_picture").attr("src",parsedJson.data);
							$("#profile_image_token").val(parsedJson.id);
							$("#user_profile_picture_demo").attr("src",parsedJson.data);
							$("#amazing_profile_image_backdrop_modal").modal("hide");
						}
						else
						{
							$("#file_err").html(parsedJson.message);
						}
					}
				});
			}
			function readURLFromFile(input) {
			  if (input.files && input.files[0]) {
				var reader = new FileReader();
				
				reader.onload = function(e) {
				  $('#user_profile_picture_demo').attr("src",e.target.result);
				}
				
				reader.readAsDataURL(input.files[0]); 
			  }
			  else{
				  $("#file_err").html("Invalid file.Please select an image");
			  }
			}
			$("#user_profile_picture_field").change(function(){
				$("#file_err").html("");
				readURLFromFile(this);
			});
			function deleteRec(item_token="")
			{
				if(item_token!="")
				{
					$.ajax({
						url:base_url+'deletecommendation',
						type:'post',
						data:{id:item_token},
						success:function(data)
						{
							var parsedJson=JSON.parse(data);
							if(parsedJson.status=="success")
							{
								$("#rec_"+item_token).remove();
							}
							else
							{
								alert(parsedJson.message);
							}
						}
					});
				}
			}
			function askRecFromUser()
			{
				$("#rec_error").html('');
				var r_user_id=$("#choosen_user").val();
				var custom_message=$("#text_message_rec").val().trim();
				var designation=$("#position").val().trim();
				if(r_user_id!="" && custom_message!="" && designation!="")
				{
					$.ajax({
						url:base_url+'savereccommendation',
						type:'post',
						data:{r_user_id:r_user_id,custom_message:custom_message,designation:designation},
						success:function(data)
						{
							var parsedJson=JSON.parse(data);
							if(parsedJson.status=="success")
							{
								$("#rec_error").html('');
								if($("#nothing_to_show_rec").length>0)
								{
									$("#nothing_to_show_rec").remove();
								}
								if($("#rec_"+parsedJson.id).length>0)
								{
									$("#rec_"+parsedJson.id).remove();
								}
								$("#recommendation_data_matrix").append(parsedJson.data);
								$("#ask_for_recommendation_modal").modal("hide");
							}
							else
							{
								$("#rec_error").html(parsedJson.message);
							}
						}
					});
				}
				else
				{
					$("#rec_error").html('Please fill all required fields');
				}
			}
			var timeout=null;
			/*$("#user_select").bind("keyup",function(){
				clearTimeout(timeout);
				timeout = setTimeout(function () {
					var username=$("#user_select").val().trim();
					//var usr_arr=username.split(" ");
					$.ajax({
						url:base_url+"get-user-list",
						type:"post",
						data:{q:username},
						success:function(response)
						{
							
						}
					});
					console.log(username);
				},1000);
			});*/
			function askForRecommendation()
			{
				$("#ask_for_recommendation_modal").modal("show");
				$("#rec_error").html('');
				$("#user_select").select2({placeholder: "Search for user",templateResult: formatUserList,templateSelection:manageUserSelection});
				
			}
			function formatUserList (opt) {
				
				if (!opt.id) {
					return opt.text;
				} 

				var optimage = $(opt.element).attr('data-image'); 
				var profile_title = $(opt.element).attr('data-title'); 
				if(!optimage){
				   return opt.text;
				} else {                    
					var $opt = $(
					   '<div class="row" style="overflow:hidden;"><div class="col-1"><img src="' + optimage + '" style="height:40px;width:40px;border-radius:10px;border:1px solid gray;" /></div><div class="col-11" style="overflow:hidden;"><span style="color:black;font-weight:bold;font-size:14px;margin-left:20px;">' + opt.text + '<br/><span style="font-weight:normal;font-size:12px;padding-left:20px;">'+profile_title+'</span></span></div></div>'
					);
					return $opt;
				}
			}
			function manageUserSelection(opt)
			{
				if(opt.text!="" && opt.text!=null && opt.text!='Search for user')
				{
					$("#text_message_rec").val("Dear "+opt.text+",\nI am trying to build up my recommendations to progress in my professional careers, therefor i am hoping you will provide a recommendation for me.\nPlease let me know if you need any additional information to formulate the recommendation.\nThank you so much for considering my request.");
				}
				else
				{
					$("#text_message_rec").val("");
				}
				if (!opt.id) {
					$("#choosen_user").val('');
					return opt.text;
				} 

				var id = $(opt.element).attr('data-id'); 
				if(!id){
					$("#choosen_user").val('');
					return opt.text;
				} else { 
					$("#choosen_user").val(id);
					return opt.text;
				}
			}
			function showReceivedRec()
			{
				$("#rr_anchor").css('color','#007bff');
				$("#gr_anchor").css('color','black');
				$("#received_recommendations").show();
				$("#given_recommendations").hide();
			}
			function showGivenRec()
			{
				$("#gr_anchor").css('color','#007bff');
				$("#rr_anchor").css('color','black');
				$("#received_recommendations").hide();
				$("#given_recommendations").show();
			}
			function showProfessional()
			{
				$("#prg_anchor").css('color','#007bff');
				$("#peg_anchor").css('color','black');
				$("#professional_gallery").show();
				$("#personal_gallery").hide();
			}
			function showPersonal()
			{
				$("#peg_anchor").css('color','#007bff');
				$("#prg_anchor").css('color','black');
				$("#personal_gallery").show();
				$("#professional_gallery").hide();
			}
			function saveAward()
			{
				var form = $('#achievement_form')[0]; // You need to use standard javascript object here
				var formData = new FormData(form);
				$("#award_error_mesg").html('');
				
				var award_title=$("#award_title").val().trim();
				//var old_award_image=$("#old_award_image").val().trim();
				var award_description=$("#award_description").val();
				if(award_title=="" || award_description=="")
				{
					$("#award_error_mesg").html('Please Fill All Required Fields');
					return;
				}
				else
				{
					$.ajax({
						url:base_url+"saveuseraward",
						type:"post",
						data:formData,
						contentType: false, 
						processData: false,
						success:function(data)
						{
							var parsedJson=JSON.parse(data);
							if(parsedJson.status=="success")
							{
								$("#award_error_mesg").html(parsedJson.message);
								if($("#nothing_to_show_award").length>0)
								{
									$("#nothing_to_show_award").remove();
								}
								if($("#award_"+parsedJson.id).length>0)
								{
									$("#award_"+parsedJson.id).remove();
								}
								$("#award_data_matrix").append(parsedJson.data);
								$("#award_form").html("");
								$("#award_form_modal").modal('hide');
							}
							else
							{
								$("#award_error_mesg").html(parsedJson.message);
							}
						}
					});
				}
			}
			function saveEducation()
			{
				$("#edu_error_mesg").html('');
				var studying=0;
				var to_day="";
				var to_month="";
				var to_year="";
				var from_day="";
				var from_month="";
				var from_year="";
				if($("#currently_studying_here").is(":checked"))
				{
					studying=1;
					to_day="";
					to_month="";
					to_year="";
				}
				else
				{
					studying=0;
					var checkout=$("#check_out").val();
					if(checkout!="" && checkout!=null && checkout!="undefined")
					{
						var checkout_arr=checkout.split(".");
						studying=0;
						to_day=checkout_arr[1];
						to_month=checkout_arr[0];
						to_year=checkout_arr[2];
					}
					else
					{
						studying=1;
						to_day="";
						to_month="";
						to_year="";
					}
				}
				var checkin=$("#check_in").val();
				if(checkin!="" && checkin!=null && checkin!="undefined")
				{
					var checkin_arr=checkin.split(".");
					from_day=checkin_arr[1];
					from_month=checkin_arr[0];
					from_year=checkin_arr[2];
				}
				else
				{
					$("#edu_error_mesg").html('Please select a joining date');
					return;
				}
				var course=$("#course").val();
				var majors=$("#majors").val();
				var institution_name=$("#institution_name").val();
				var edu_description=$("#edu_description").val();
				var edu_country=$("#edu_country").val();
				var edu_item_token=$("#edu_item_token").val();
				var edu_city=$("#edu_city").val();
				if(institution_name=="" || majors=="" || course=="" || edu_city=="" || edu_country=="")
				{
					$("#edu_error_mesg").html('Please Fill All Required Fields');
					return;
				}
				else
				{
					$.ajax({
						url:base_url+"saveusereducation",
						type:"post",
						data:{course:course,majors:majors,university:institution_name,edu_country:edu_country,item_token:edu_item_token,edu_city:edu_city,edu_description:edu_description,from_day:from_day,from_month:from_month,from_year:from_year,to_day:to_day,to_month:to_month,to_year:to_year,studying:studying,origin:"dashboard"},
						success:function(data)
						{
							var parsedJson=JSON.parse(data);
							if(parsedJson.status=="success")
							{
								$("#edu_error_mesg").html(parsedJson.message);
								if($("#nothing_to_show_edu").length>0)
								{
									$("#nothing_to_show_edu").remove();
								}
								if($("#edu_"+parsedJson.id).length>0)
								{
									$("#edu_"+parsedJson.id).remove();
								}
								$("#educational_data_matrix").append(parsedJson.data);
								$("#education_form").html("");
								$("#education_form_modal").modal('hide');
							}
							else
							{
								$("#edu_error_mesg").html(parsedJson.message);
							}
						}
					});
				}
			}
			function getEducation(item_token="")
			{
				$.ajax({
					url:base_url+'get-education-form',
					type:'post',
					data:{item_token:item_token},
					success:function(data){
						$("#education_form").html(data);
						$("#education_form_modal").modal("show");
					}
				});
			}
			function saveExperience()
			{
				$("#work_error_mesg").html('');
				var working=0;
				var to_day="";
				var to_month="";
				var to_year="";
				var from_day="";
				var from_month="";
				var from_year="";
				if($("#currently_working_here").is(":checked"))
				{
					working=1;
					to_day="";
					to_month="";
					to_year="";
				}
				else
				{
					working=0;
					var checkout=$("#check_out").val();
					if(checkout!="" && checkout!=null && checkout!="undefined")
					{
						var checkout_arr=checkout.split(".");
						working=0;
						to_day=checkout_arr[1];
						to_month=checkout_arr[0];
						to_year=checkout_arr[2];
					}
					else
					{
						working=1;
						to_day="";
						to_month="";
						to_year="";
					}
				}
				var checkin=$("#check_in").val();
				if(checkin!="" && checkin!=null && checkin!="undefined")
				{
					var checkin_arr=checkin.split(".");
					from_day=checkin_arr[1];
					from_month=checkin_arr[0];
					from_year=checkin_arr[2];
				}
				else
				{
					$("#work_error_mesg").html('Please select a joining date');
					return;
				}
				var work_designation=$("#work_designation").val();
				var company_name=$("#company_name").val();
				var work_country=$("#work_country").val();
				var work_item_token=$("#work_item_token").val();
				var work_city=$("#work_city").val();
				var work_description=$("#work_description").val();
				if(work_designation=="" || company_name=="" || work_country=="" || work_city=="")
				{
					$("#work_error_mesg").html('Please Fill All Required Fields');
					return;
				}
				else
				{
					$.ajax({
						url:base_url+"saveuserexperience",
						type:"post",
						data:{work_designation:work_designation,company_name:company_name,work_country:work_country,item_token:work_item_token,work_city:work_city,work_description:work_description,from_day:from_day,from_month:from_month,from_year:from_year,to_day:to_day,to_month:to_month,to_year:to_year,working:working,origin:"dashboard"},
						success:function(data)
						{
							var parsedJson=JSON.parse(data);
							if(parsedJson.status=="success")
							{
								$("#work_error_mesg").html(parsedJson.message);
								if($("#nothing_to_show_exp").length>0)
								{
									$("#nothing_to_show_exp").remove();
								}
								if($("#work_exp_"+parsedJson.id).length>0)
								{
									$("#work_exp_"+parsedJson.id).remove();
								}
								$("#experience_data_matrix").append(parsedJson.data);
								$("#experience_form").html("");
								$("#experience_form_modal").modal('hide');
							}
							else
							{
								$("#work_error_mesg").html(parsedJson.message);
							}
						}
					});
				}
			}
			function getExperience(item_token="")
			{
				$.ajax({
					url:base_url+'get-experience-form',
					type:'post',
					data:{item_token:item_token},
					success:function(data){
						$("#experience_form_modal").modal("show");
						$("#experience_form").html(data);
					}
				});
			}
			function getAward(item_token="")
			{
				$.ajax({
					url:base_url+'get-award-form',
					type:'post',
					data:{item_token:item_token},
					success:function(data){
						$("#award_form_modal").modal("show");
						$("#award_form").html(data);
					}
				});
			}
			function deleteExperience(item_token)
			{
				
				if(confirm('Are you sure? you want to delete it?'))
				{
					if(item_token!="")
					{
						$.ajax({
							url:base_url+'remove-experience',
							type:'post',
							data:{item_token:item_token},
							success:function(data){
								var parsedJson=JSON.parse(data);
								if(parsedJson.status=="success")
								{
									$("#work_exp_"+item_token).remove();
								}
								else
								{
									swal({
										title: "Error",
										text: parsedJson.message,
										icon: "error",
										buttons: {
											confirm: {
												text: "Yes",
												value: true,
												visible: true,
												className: "",
												closeModal: true
											}
										}
									});
								}
							}
						});
					}
					else
					{
						swal({
							title: "Oh no!",
							text: "Invalid Action",
							icon: "error",
							buttons: {
								confirm: {
									text: "Yes",
									value: true,
									visible: true,
									className: "",
									closeModal: true
								}
							}
						});
					}
				}
			}	
			function deleteAward(item_token)
			{
				
				if(confirm('Are you sure? you want to delete it?'))
				{
					if(item_token!="")
					{
						$.ajax({
							url:base_url+'remove-award',
							type:'post',
							data:{item_token:item_token},
							success:function(data){
								var parsedJson=JSON.parse(data);
								if(parsedJson.status=="success")
								{
									$("#award_"+item_token).remove();
								}
								else
								{
									swal({
										title: "Error",
										text: parsedJson.message,
										icon: "error",
										buttons: {
											confirm: {
												text: "Yes",
												value: true,
												visible: true,
												className: "",
												closeModal: true
											}
										}
									});
								}
							}
						});
					}
					else
					{
						swal({
							title: "Oh no!",
							text: "Invalid Action",
							icon: "error",
							buttons: {
								confirm: {
									text: "Yes",
									value: true,
									visible: true,
									className: "",
									closeModal: true
								}
							}
						});
					}
				}
			}	
			function deleteEducation(item_token)
			{
				if(confirm('Are you sure? you want to delete it?'))
				{
					if(item_token!="")
					{
						$.ajax({
							url:base_url+'remove-education',
							type:'post',
							data:{item_token:item_token},
							success:function(data){
								var parsedJson=JSON.parse(data);
								if(parsedJson.status=="success")
								{
									$("#edu_"+item_token).remove();
								}
								else
								{
									swal({
										title: "Error!",
										text: parsedJson.message,
										icon: "error",
										buttons: {
											confirm: {
												text: "Yes",
												value: true,
												visible: true,
												className: "",
												closeModal: true
											}
										}
									});
								}
							}
						});
					}
					else
					{
						swal({
							title: "Oh no!",
							text: "Invalid Action",
							icon: "error",
							buttons: {
								confirm: {
									text: "Yes",
									value: true,
									visible: true,
									className: "",
									closeModal: true
								}
							}
						});
					}
				}
			}
			function saveAboutYou(element)
			{
				$("#amazing_about_you_error").html("");
				var amazing_about_you=$("#amazing_about_you").val().trim();
				if(amazing_about_you!="")
				{
					$.ajax({
						url:base_url+"updateaboutonly",
						type:"post",
						data:{about:amazing_about_you},
						success:function(data)
						{
							var parsedJson=JSON.parse(data);
							if(parsedJson.status=="success")
							{
								$("#"+element).html(parsedJson.data);
								styleReadMore(element);
								$("#amazing_about_backdrop_modal").modal("hide");
							}
							else
							{
								$("#amazing_about_you_error").html(parsedJson.message);
							}
						}
					});
				}
				else
				{
					$("#amazing_about_you_error").html("write something about you.");
				}
			}
			function styleReadMore(element)
			{
				var showChar = 406;  
				var ellipsestext = "...";
				var moretext = "Show more >";
				var lesstext = "Show less";
				

				$('#'+element).each(function() {
					var content = $(this).html();
			 
					if(content.length > showChar) {
			 
						var c = content.substr(0, showChar);
						var h = content.substr(showChar, content.length - showChar);
			 
						var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="javascript:void(0);"  id="morelink" style="width:100px;">' + moretext + '</a></span>';
			 
						$(this).html(html);
					}
			 
				});
 
				$("#morelink").click(function(){
					if($(this).hasClass("less")) {
						$(this).removeClass("less");
						$(this).html(moretext);
					} else {
						$(this).addClass("less");
						$(this).html(lesstext);
					}
					$(this).parent().prev().toggle();
					$(this).prev().toggle();
					return false;
				});
			}
			$(document).ready(function() {
				var showChar = 406;  
				var ellipsestext = "...";
				var moretext = "Show more >";
				var lesstext = "Show less";
				

				$('.more').each(function() {
					var content = $(this).html();
			 
					if(content.length > showChar) {
			 
						var c = content.substr(0, showChar);
						var h = content.substr(showChar, content.length - showChar);
			 
						var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="javascript:void(0);" class="morelink" style="width:100px;">' + moretext + '</a></span>';
			 
						$(this).html(html);
					}
			 
				});
 
				$(".morelink").click(function(){
					if($(this).hasClass("less")) {
						$(this).removeClass("less");
						$(this).html(moretext);
					} else {
						$(this).addClass("less");
						$(this).html(lesstext);
					}
					$(this).parent().prev().toggle();
					$(this).prev().toggle();
					return false;
				});
			});
		</script>
   </body>
</html>