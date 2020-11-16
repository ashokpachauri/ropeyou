<html lang="en">
<?php 
	include_once 'connection.php';
	$user_row=null;
	$username=$_REQUEST['__username'];
	$uquery="SELECT * FROM users WHERE username='$username' AND status=1";
	$uresult=mysqli_query($conn,$uquery);
	if(mysqli_num_rows($uresult)>0)
	{
	
		$user_row=mysqli_fetch_array($uresult);
		$profile_user_id=$user_row['id'];
		if($profile_user_id!=$_COOKIE['uid'] && isset($_COOKIE['uid']) && $_COOKIE['uid']!="")
		{
			
			mysqli_query($conn,"DELETE FROM users_profile_views WHERE user_id='$profile_user_id' AND viewer_id='".$_COOKIE['uid']."'");
			$pvquery="INSERT INTO users_profile_views SET user_id='$profile_user_id',viewer_id='".$_COOKIE['uid']."',status=1,added=NOW()";
			mysqli_query($conn,$pvquery);
			mysqli_query($conn,"UPDATE users_profile_views SET status=2 WHERE viewer_id='$profile_user_id' AND user_id='".$_COOKIE['uid']."'");
		}
	?>
		<head>
				<?php 
					include_once 'profile-head.php';
					$user_id=$profile_user_id;
				?>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<title><?php echo $user_row['first_name']." ".$user_row['last_name']; ?>'s profile | RopeYou Connects</title>
				<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha256-siyOpF/pBWUPgIcQi17TLBkjvNgNQArcmwJB8YvkAgg=" crossorigin="anonymous" />
				<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
				<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
				
				<link href="<?php echo base_url; ?>fileuploader/dist/font/font-fileuploader.css" rel="stylesheet">
				<link href="<?php echo base_url; ?>fileuploader/dist/jquery.fileuploader.min.css" rel="stylesheet">
				<link href="<?php echo base_url; ?>fileuploader/examples/avatar/css/jquery.fileuploader-theme-avatar.css" rel="stylesheet">
			</head>
			<style>
				.my_drop_down_content{
					display: none;
					position: absolute;
					background-color: #f9f9f9;
					min-width: 160px;
					box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
					padding: 0;
					right:-100px;
					top:20px;
					z-index: 1;
				}
				.my_dropdown {
					position: relative;
					display: inline-block;
				}
				.my_dropdown:hover .my_drop_down_content {
					display: block;
				}
				h6{
					font-size: 15px !important;
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
					cursor: pointer;
					position: absolute;
					bottom: 0;
					left: 0;
					background: rgba(0, 0, 0, 0.5);
					width: 150px;
					height: 75px;
					transition: .5s ease;
					opacity: 0;
					color: white;
					font-size: 15px;
					text-align: center;
					border-bottom-left-radius: 150px;
					border-bottom-right-radius: 150px;
					right: 0;
					margin: auto;
					padding: 17px 0;
				}
				.image-container-custom:hover .overlay {
				  opacity: 1;
				}
				.hidden-on-dashboard {
					display:none;
				}
				
				.social_icon_temp{
					padding: 5px;
					font-size: 16px;
					color: #fff !important;
					width: 30px;
					height: 30px;
					border-radius: 50%;
					margin: auto;
					background-color: #4167b2 !important;
				}
				.align-button {
					text-align: center;
				}
				.fileuploader {
						width: 160px;
						height: 160px;
						margin: 15px;
					}
				.fileuploader-menu{
					disply:none;
				}
			</style>
			<body>
				<?php include_once 'header.php'; ?>
				<?php 
					$user_id=$profile_user_id;
					$users_personal_row=getUsersPersonalData($profile_user_id);
					$user_row=getUsersData($profile_user_id);
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
								$onboarding=getOnBoarding($user_id,$skipped);
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
								$profile_pic=getUserProfileImage($profile_user_id);
								$profile_pic_arr=explode("/",$profile_pic);
								$arr=array("a.png","b.png","c.png","d.png","e.png","f.png","g.png","h.png","i.png","j.png","k.png","l.png","m.png","n.png","o.png","p.png","q.png","r.png","s.png","t.png","u.png","v.png","w.png","x.png","y.png","z.png");
								if(in_array(end($profile_pic_arr),$arr))
								{
									$onboarding="profile_pic";
								}
								include('fileuploader/src/php/class.fileuploader.php');
								$enabled = true;
							?>
						   <aside class="col col-xl-3 order-xl-1 col-lg-12 order-lg-1 col-12" id="left_side_bar" style="position:static;">
								<div class="box mb-3 shadow-sm border rounded bg-white profile-box text-center">
									<div class="py-4 px-3 border-bottom">
										<?php $profile=getUserProfileImage($profile_user_id); ?>
										<div class="image-container-custom" style="width:100%;">
											<img id="user_profile_picture" src="<?php echo $profile; ?>" class="img-fluid mt-2 rounded-circle image" style="width:150px;height:150px;border:1px solid #eaebec !important;" alt="<?php echo $user_row['first_name']." ".$user_row['last_name']; ?>">
										</div>
										<h6 class="font-weight-bold text-dark mb-1 mt-4"><?php echo $user_row['first_name']." ".$user_row['last_name']; ?></h6>
										<p class="mb-0 text-muted"><?php echo $user_row['profile_title']; ?></p>
										<div class="progress progress-striped" style="margin-top:15px !important;height:0.6rem !important;"> 
											<div class="progress-bar progress-bar-success" style="background-color:#1d2f38 !important;"> Your Profile is 0% Completed.</div>
										</div>
										<p style="text-align:center;margin-bottom:-5px;">Profile Completeness</p>
									</div>
									<div class="d-flex">
										<div class="col-6 border-right px-3 py-2">
										   <p class="mb-0 text-black-50 small"><span class="font-weight-bold text-dark"><?php echo getUserConnectionCounts($profile_user_id); ?></span>  Connections</p>
										</div>
										<div class="col-6 px-3 py-2">
										   <p class="mb-0 text-black-50 small"><span class="font-weight-bold text-dark"><?php echo getUserProfileViews($profile_user_id); ?></span>  Views</p>
										</div>
									</div>
								</div>
								<div class="box shadow-sm border rounded bg-white mb-3 gallery-box-main">
									<div class="box-title border-bottom p-3">
										<h6 class="m-0">Gallery<a href="<?php echo base_url.'u/'.$user_row['username'].'/gallery'; ?>" class="small float-right">View All <i class="feather-chevron-right"></i></a></h6>
									</div>
									<div class="box-body">
										<div class="d-flex border-bottom align-button" style="width:100%;">
											<div class="col-12 px-3 py-2">
												<a href="javascript:void(0);" onclick="showProfessional();" style="color: #fff; background-color: #6fb4ff; padding: 5px 10px;" class="btn-primary">Personal</a>&nbsp;&nbsp;&nbsp;&nbsp;
												<a href="javascript:void(0);"  onclick="showPersonal();" style="color: rgb(29, 47, 56); padding: 5px 10px;" class="btn-warning" >Professional</a>
											</div>
										</div>
										<div style="width:100%;" id="professional_gallery">
											<div id="professional_data_matrix" style="width:100%;min-height:100px;">
												<?php
													$gquery="SELECT * FROM gallery WHERE is_professional=0 AND is_private=0 AND is_draft=0 AND user_id='".$profile_user_id."' AND type LIKE 'image/%' ORDER BY id DESC LIMIT 6";
													//echo $gquery;
													$gresult=mysqli_query($conn,$gquery);
													if(mysqli_num_rows($gresult)>0)
													{
														while($grow=mysqli_fetch_array($gresult))
														{
															if(is_file($grow['file']))
															{
																?>
																<img src="<?php echo base_url.$grow['file']; ?>">
																<?php
															}
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
										<div class="" style="width:100%;display:none;" id="personal_gallery">
											<div id="personal_data_matrix" style="width:100%;min-height:100px;">
												<?php
													$gquery="SELECT * FROM gallery WHERE is_professional=1 AND is_private=0 AND is_draft=0 AND user_id='".$profile_user_id."' AND type LIKE 'image/%' ORDER BY id DESC LIMIT 6";
													$gresult=mysqli_query($conn,$gquery);
													if(mysqli_num_rows($gresult)>0)
													{
														while($grow=mysqli_fetch_array($gresult))
														{
															if(is_file($grow['file']))
															{
																?>
																<img src="<?php echo base_url.$grow['file']; ?>">
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
										<h6 class="m-0 font-weight-bold">Contact Details</h6>
									</div>
									<div class="box-body">
										<div class="d-flex border-bottom align-button" style="width:100%;">
											<div class="col-12 px-3 py-2">
												<a href="<?php echo base_url; ?>w/<?php echo strtolower($user_row['username']); ?>" target="_blank" style="color: #fff; background-color: #6fb4ff; padding: 5px 10px;" class="btn-primary">Web View</a>&nbsp;&nbsp;&nbsp;&nbsp;
												<a href="<?php echo base_url; ?>u/<?php echo strtolower($user_row['username']); ?>"  class="btn-warning" style="color: rgb(29, 47, 56); padding: 5px 10px;" >Profile View</a>
											</div>
										</div>
										<div class="p-3 contact-details-box">
										   <div>
												<div>
													<?php
													if(isset($_COOKIE['uid']) && $_COOKIE['uid']!=""){
														if($users_personal_row!=false)
														{
															if($users_personal_row['communication_email']!="" && $users_personal_row['communication_email']!=null){
													?>
															<!--<i class="feather-mail"></i>-->
																<p title="Email"> <i class="feather-mail"></i>
																	<a href="mailto:<?php echo $users_personal_row['communication_email']; ?>" id="communication_email_html" target="_blank"><?php echo $users_personal_row['communication_email']; ?></a>
															</p>
															<?php
															}
															if($users_personal_row['communication_mobile']!="" && $users_personal_row['communication_mobile']!=null){
													?>
																<!--<i class="feather-phone"></i>-->
																<p class="text-truncate" title="Mobile">
																<i class="feather-smartphone"></i>
																	<a href="tel:<?php echo $users_personal_row['communication_mobile']; ?>" target="_blank"><?php echo "(".$users_personal_row['phonecode'].") - ".$users_personal_row['communication_mobile']; ?></a>
															</p>
															<?php
															}
															if($users_personal_row['website']!="" && $users_personal_row['website']!=null){
													?>
															<!--<i class="feather-globe"></i>-->
																<p class="text-truncate mb-0" title="Website">
																<i class="feather-globe"></i>
																	<a href="<?php echo $users_personal_row['website']; ?>" target="_blank"><?php echo $users_personal_row['website']; ?></a>
															</p>
															<?php
															}
															?>
													<?php
														}
														else
														{
															?>
															<div class="text-truncate" title="Mobile" style="font-size:11px !important;">
																<h6 style="font-size:12px;color:blue;">Nothing to show in contacts.</h6>
															</div>
															<?php
														}
													}
													else
													{
														?>
														<div class="text-truncate" title="Mobile" style="font-size:11px !important;">
															<h6 style="font-size:12px;color:blue;">You needs to be login.</h6>
														</div>
														<?php
													}
													?>
												</div>
										   </div>
										</div>
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
													<div class="col-3 border-right border-top p-2">
														<p class="mb-0 text-black-50 small text-center">
															<a class="font-weight-bold d-block text-center social_icon_temp" href="<?php 
															if($users_personal_row['fb_p']!="" && $users_personal_row['fb_p']!=null){
																echo $users_personal_row['fb_p'];
															}else{ echo 'javascript:void(0);'; }
														?>"  style="font-size:20px;"><i class="fa fa-facebook"></i></a></p><!--feather-facebook-->
													</div>
													<div class="col-3 border-right border-top p-2">
													   <p class="mb-0 text-black-50 small text-center"><a class="font-weight-bold d-block text-center social_icon_temp" href="<?php 
															if($users_personal_row['ig_p']!="" && $users_personal_row['ig_p']!=null){
																echo $users_personal_row['ig_p'];
															}else{ echo 'javascript:void(0);'; }
														?>" style="font-size:20px;background-color:#cf2217 !important;"><i class="fa fa-instagram"></i></a></p><!--feather-instagram-->
													</div>
													<div class="col-3 border-right border-top p-2">
													   <p class="mb-0 text-black-50 small text-center"><a class="font-weight-bold d-block text-center social_icon_temp" href="<?php 
															if($users_personal_row['tw_p']!="" && $users_personal_row['tw_p']!=null){
																echo $users_personal_row['tw_p'];
															}else{ echo 'javascript:void(0);'; }
														?>" style="font-size:20px;background-color:#00b7d6 !important;"><i class="fa fa-twitter"></i></a></p><!--feather-twitter-->
													</div>
													<div class="col-3 border-top p-2">
													   <p class="mb-0 text-black-50 small text-center"><a class="font-weight-bold d-block text-center social_icon_temp" href="<?php 
															if($users_personal_row['in_p']!="" && $users_personal_row['in_p']!=null){
																echo $users_personal_row['in_p'];
															}else{ echo 'javascript:void(0);'; }
														?>" style="font-size:20px;background-color|:#0281ac !important"><i class="fa fa-linkedin"></i></a></p><!--feather-linkedin-->
													</div>
												</div>
										<?php
											}
											else
											{
												?>
												<div class="d-flex text-center">
													<div class="col-3 border-right border-top p-2">
													   <p class="mb-0 text-black-50 small text-center"><a class="font-weight-bold d-block text-center social_icon_temp" href="javascript:void(0);" style="font-size:20px;"><i class="fa fa-facebook"></i></a></p>
													</div>
													<div class="col-3 border-right border-top p-2">
													   <p class="mb-0 text-black-50 small text-center"><a class="font-weight-bold d-block text-center social_icon_temp" href="javascript:void(0);"  style="font-size:20px;background-color:#cf2217 !important;"><i class="fa fa-instagram"></i></a></p>
													</div>
													<div class="col-3 border-right border-top p-2">
													   <p class="mb-0 text-black-50 small text-center"><a class="font-weight-bold d-block text-center social_icon_temp" href="javascript:void(0);" style="font-size:20px;background-color:#00b7d6 !important;"><i class="fa fa-twitter"></i></a></p>
													</div>
													<div class="col-3 border-top p-2">
													   <p class="mb-0 text-black-50 small text-center"><a class="font-weight-bold d-block text-center social_icon_temp" href="javascript:void(0);" style="font-size:20px;background-color|:#0281ac !important;"><i class="fa fa-linkedin"></i></a></p>
													</div>
												</div>
												<?php
											}
										?>
									</div>
								</div>
								<div class="box shadow-sm border rounded bg-white mb-3">
									<div class="box-title border-bottom p-3">
										<h6 class="m-0 font-weight-bold">Resume Downloads</h6>
									</div>
									<div class="box-body">
										<div class="d-flex" style="width:100%;">
										   <div class="col-12 border-right border-top p-3">
											   <div>
													<div class="text-truncate">
														<?php
															if(isset($_COOKIE['uid']) && $_COOKIE['uid']!="")
															{
																$v_query="SELECT * FROM users_resume WHERE user_id='".$profile_user_id."' AND profile_type=1 ORDER BY id DESC LIMIT 1";
																$v_result=mysqli_query($conn,$v_query);
																if(mysqli_num_rows($v_result)>0)
																{
																	$v_row=mysqli_fetch_array($v_result);
																	?>
																	</video>
																	<span style="width:100% !important;"><i class="feather-file"></i> <a href="<?php echo base_url.$v_row['file']; ?>" target="_blank"><?php echo $v_row['file_title']; ?></a></span>
																	<?php
																}
																else
																{
																	?>
																	<div style="min-height:150px;"><h6 style="text-align:center;font-size:12px;">Resume not uploaded</h6></div>
																	<?php
																}
															}
															else
															{
																?>
																<div style="min-height:150px;"><p style="text-align:center;font-size:12px;">you need to be login</p></div>
																<?php
															}
														?>
														
													</div>
											   </div>
										   </div>
										</div>
									</div>
								</div>
								
								<div class="box shadow-sm border rounded bg-white mb-3 skills-boxs">
									<div class="box-title border-bottom p-3">
										<h6 class="m-0 font-weight-bold">Skills</h6>
									</div>
									<div class="box-body">
										<?php
											$skills_query="SELECT * FROM users_skills WHERE user_id='".$profile_user_id."' AND status=1 ORDER BY proficiency DESC";
											$skills_result=mysqli_query($conn,$skills_query);
											if(mysqli_num_rows($skills_result)>0)
											{
												while($skills_row=mysqli_fetch_array($skills_result))
												{
													$skillMeterHtml="";
													$skillMeterTitle="";
													if(((int)($skills_row['proficiency']))<=33)
													{
														$skillMeterHtml='<span class="badge badge-danger ml-1" style="border: 2px solid red;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-dark ml-1" style="color: #f54295 !important;background-color: #fff !important;border: 2px solid #343a40 !important;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-dark ml-1" style="color: #343a40 !important;background-color: #fff !important;border: 2px solid #343a40 !important;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span>';
														$skillMeterTitle="Basic";
													}
													else if(((int)($skills_row['proficiency']))<=66)
													{
														$skillMeterHtml='<span class="badge badge-warning ml-1" style="border: 2px solid #dbb716;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-warning ml-1" style="border: 2px solid #dbb716;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-dark ml-1" style="color: #343a40 !important;background-color: #fff !important;border: 2px solid #343a40 !important;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span>';
														$skillMeterTitle="Proficient";
													}
													else if(((int)($skills_row['proficiency']))<=100)
													{
														$skillMeterHtml='<span class="badge badge-success ml-1" style="border: 2px solid #00c9a7;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-success ml-1" style="border: 2px solid #00c9a7;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-success ml-1" style="border: 2px solid #00c9a7;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span>';
														$skillMeterTitle="Expert";
													}
													//$htmlData.=$skillMeterHtml;
										?>			
													<div class="d-flex" style="width:100%;">
													   <div class="col-12 border-right border-top p-1">
														   <div class="font-weight-bold">
															  <div class="text-truncate" style="font-size:10px !important;"><span style="min-width:70% !important;"><?php echo ucfirst(strtolower($skills_row['title'])); ?></span><span style="max-width:30% !important;float:right !important;" title="<?php echo $skillMeterTitle; ?>"><?php echo $skillMeterHtml; ?></span></div>
														   </div>
													   </div>
													</div>
										<?php
												}
											}
										?>
									</div>
									<div class="modal fade skills_modal_opner" id="skills_modal_opner" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="amazingSkillsBackdrop" aria-hidden="true">
										<div class="modal-dialog modal-lg" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h6 class="modal-title" id="amazingSkillsBackdrop">Skills are boosters of your profile selections</h6>
												</div>
												<div class="modal-body">											
													<div class="row">
														<div class="col-md-12" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);transition: box-shadow 83ms;background:#fff;padding:10px;margin: 0 0px 10px;border-radius:2px;">
															<h6>Manage Skills <a href="javascript:void(0);" style="float:right;margin-right:30px;" class="add_button" title="Add field"><i class="fa fa-plus" style="font-size:20px;"></i></a></h6>
														</div>
														<div class="col-md-12">
															<div class="row value_wrapper" style="margin-top:25px;">
																<?php
																	$query="SELECT * FROM users_skills WHERE status=1 AND user_id='$user_id' ORDER BY proficiency DESC";
																	$result=mysqli_query($conn,$query);
																	$response['status']='success';
																	$htmlData="";
																	if(mysqli_num_rows($result)>0)
																	{
																		while($row=mysqli_fetch_array($result))
																		{
																			
																			$htmlData=$htmlData."<div class='col-md-6' style='margin-bottom:15px;border:1px solid gray;border-radius:10px;height:30px;max-width:48%;margin-right:1%;'><div class='row' style='margin-top:5px;'>";
																			$htmlData.="<div class='col-md-7'><h6 style='font-size:14px;' class='text-truncate'>".ucfirst(strtolower($row['title']))."</h6></div>";
																			$htmlData.="<div class='col-md-3'><h6 style='font-size:12px;'>";
																			if(((int)($row['proficiency']))<=33)
																			{
																				$htmlData.='<span class="badge badge-danger ml-1" style="border: 2px solid red;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-dark ml-1" style="color: #f54295 !important;background-color: #fff !important;border: 2px solid #343a40 !important;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-dark ml-1" style="color: #343a40 !important;background-color: #fff !important;border: 2px solid #343a40 !important;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span>';
																				$skillMeterTitle="Basic";
																			}
																			else if(((int)($row['proficiency']))<=66)
																			{
																				$htmlData.='<span class="badge badge-warning ml-1" style="border: 2px solid #dbb716;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-warning ml-1" style="border: 2px solid #dbb716;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-dark ml-1" style="color: #343a40 !important;background-color: #fff !important;border: 2px solid #343a40 !important;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span>';
																				$skillMeterTitle="Proficient";
																			}
																			else if(((int)($row['proficiency']))<=100)
																			{
																				$htmlData.='<span class="badge badge-success ml-1" style="border: 2px solid #00c9a7;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-success ml-1" style="border: 2px solid #00c9a7;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-success ml-1" style="border: 2px solid #00c9a7;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span>';
																				$skillMeterTitle="Expert";
																			}
																			
																			/*if(((int)($row['proficiency']))<=33)
																			{
																				$htmlData.=$skillMeterHtml;
																			}
																			else if(((int)($row['proficiency']))<=66)
																			{
																				$htmlData.=$skillMeterHtml;
																			}
																			else if(((int)($row['proficiency']))<=100)
																			{
																				$htmlData.=$skillMeterHtml;
																			}*/
																			$htmlData.="</h6></div>";
																			$htmlData.="<div class='col-md-2'><h6><a href='javascript:void(0);' title='Remove' class='remove_skill' onclick='removeSkills(".$row['id'].");' style='text-decoration:none;'><i class='fa fa-trash' style='font-size:16px;color:red;'></i></a></h6></div>";
																			$htmlData.="</div></div>";
																		}
																		$htmlData.="<script>
																			var base_url=localStorage.getItem('base_url');
																			function removeSkills(skill_id){
																				if(skill_id!=='')
																				{
																					$.ajax({
																						url:base_url+'removeskills',
																						type:'post',
																						data:{skill_id:skill_id},
																						success:function(data)
																						{
																							var parsedJson=JSON.parse(data);
																							if(parsedJson.status=='success')
																							{
																								$('.value_wrapper').html(parsedJson.htmlData);
																							}
																						}
																					});
																				}
																			}
																			</script>";
																	}
																	else
																	{
																		$htmlData="<div class='col-md-12'><h6 style='text-align:center;'>No Skills has been added yet.</h6></div>";
																	}
																	echo $htmlData;
																?>
															</div>	
														</div>
														<div class="col-md-12 field_wrapper">
															
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" onclick="reloadPage();">Close</button>
												</div>
											</div>
										</div>
									</div>
								
								</div>
								
								<div class="box shadow-sm border rounded bg-white mb-3 is_stuck" id="left_sidebar_interests" style="margin-bottom:150px;">
									<div class="box-title border-bottom p-3">
										<h6 class="m-0 font-weight-bold">Interests</h6>
									</div>
									<div class="box-body p-3">	
										<?php
											$query="SELECT * FROM users_interests WHERE user_id='$user_id'";
											$result=mysqli_query($conn,$query);
											if(mysqli_num_rows($result)>0)
											{
												$profile_percentage=$profile_percentage+10;
												while($row=mysqli_fetch_array($result))
												{
												?>
												<div class="interests-tag">
												<?php echo $row['title']; ?>
												</div>
												<?php
												}
											}
											else
											{
												?>
												<div class="d-flex" style="width:100%;">
												   <div class="col-12 p-1">
													   <div class="font-weight-bold">
														  <div class="text-truncate" style="font-size:12px !important;">nothing to show.</div>
													   </div>
												   </div>
												</div>
												<?php
											}
										?>
									</div>
								</div>
							</aside>
							<main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-2 col-md-12 col-sm-12 col-12">
								<div class="box shadow-sm border rounded bg-white mb-3">
									<div class="box-title border-bottom p-3">
										<h6 class="m-0 font-weight-bold">About <?php echo $user_row['first_name']; ?></h6>
									</div>
									<div class="box-body p-3">
										<?php if($users_personal_row!=false) { echo '<p class="more" id="amazing_about_you_text" style="font-size:14px !important;text-align:justify;">'.trim(filter_var(strip_tags($users_personal_row['about']),FILTER_SANITIZE_STRING)).'</p>'; } else { echo '<p id="amazing_about_you_text" class="more" style="font-size:14px !important;text-align:justify;">There is no data to show.</p>'; } ?>
									</div>
								</div>
								<div class="box shadow-sm border rounded bg-white mb-3 experiences-box">
									<div class="box-title border-bottom p-3">
										<h6 class="m-0 font-weight-bold">Experiences </h6>
									</div>
									<div class="box-body" id="experience_data_matrix">
									<?php
										$experience_query="SELECT * FROM users_work_experience WHERE user_id='$user_id' AND status=1 ORDER BY from_year DESC";
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
														  <h6 class="font-weight-bold text-dark mb-0" style="font-weight:normal !important;margin-bottom:5px !important;"><?php echo ucfirst(strtolower($experience_row['title'])); ?>&nbsp;&nbsp;</h6>
														  <div class="text-truncate text-primary" style="margin-bottom:4px;"><?php echo ucfirst(strtolower($experience_row['company'])); ?></div>
														  <div class="small text-gray-500"><?php echo print_month($experience_row['from_month'])." ".$experience_row['from_year']; ?>  to <?php if($experience_row['working']=="1"){ echo "Present"; } else { echo print_month($experience_row['to_month'])." ".$experience_row['to_year']; } ?></div>
													   </div>
													   <img class="img-fluid ml-auto mb-auto" src="<?php echo base_url; ?>alphas/<?php echo substr(strtolower($experience_row['company']),0,1).".png"; ?>" alt="">
													</div>
													<p class="mb-0 more">
														<?php
															if($experience_row['description']==""){
																echo "<b>".ucfirst(strtolower($experience_row['title']))."</b> at <b>".ucfirst(strtolower($experience_row['company']))."</b> in <b>".ucfirst(strtolower($city_row['title'])).", ".ucfirst(strtolower($country_row['title']))."</b> from <b>".print_month($experience_row['from_month'])." ".$experience_row['from_year']."</b> to <b>";
																if($experience_row['working']=="1"){ echo "Present</b>."; } else { echo print_month($experience_row['to_month'])." ".$experience_row['to_year']."</b>."; }
															}
															else
															{
																echo ucfirst(strtolower($experience_row['description']));
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
															<h6 style="text-align:center;">There is no data to show.</h6>
														</div>
													</div>
												</div>
											</div>
											<?php
										}
									?>
									</div>
								</div>
								<div class="box shadow-sm border rounded bg-white mb-3 education-box">
									<div class="box-title border-bottom p-3">
										<h6 class="m-0 font-weight-bold">Education </h6>
									</div>
									<div class="box-body" id="educational_data_matrix">
										<?php
											$education_query="SELECT * FROM users_education WHERE user_id='$user_id' AND status=1 ORDER BY from_year DESC";
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
														  <h6 class="font-weight-bold text-dark mb-0" style="font-weight:normal !important;margin-bottom:5px !important;"><?php echo ucfirst(strtolower($education_row['university'])); ?>&nbsp;&nbsp; </h6>
														  <div class="text-truncate text-primary" style="margin-bottom:4px;"><?php echo ucfirst(strtolower($education_row['title'])); ?></div>
														  <div class="small text-gray-500"><?php echo print_month($education_row['from_month'])." ".$education_row['from_year']; ?>  to <?php if($education_row['studying']=="1"){ echo "Present"; } else { echo print_month($education_row['to_month'])." ".$education_row['to_year']; } ?>  </div>
													   </div>
													   <img class="img-fluid ml-auto mb-auto" src="<?php echo base_url; ?>alphas/<?php echo substr(strtolower($education_row['university']),0,1).".png"; ?>" alt="">
													</div>
													<p class="mb-0 more">
														<?php 
															if($education_row['description']==""){
																echo "<b>".ucfirst(strtolower($education_row['title']))."</b> in <b>".ucfirst(strtolower($education_row['major']))."</b> at <b>".ucfirst(strtolower($education_row['university']))."</b> in <b>".ucfirst(strtolower($city_row['title'])).", ".ucfirst(strtolower($country_row['title']))."</b> from <b>".print_month($education_row['from_month'])." ".$education_row['from_year']."</b> to <b>";
																if($education_row['studying']=="1"){ echo "Present</b>."; } else { echo print_month($education_row['to_month'])." ".$education_row['to_year']."</b>."; }
															}
															else
															{
																echo ucfirst(strtolower($education_row['description']));
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
									$awards_query="SELECT * FROM users_awards WHERE status=1 AND user_id='".$profile_user_id."'";
									$awards_result=mysqli_query($conn,$awards_query);
								?>
								<div class="box shadow-sm border rounded bg-white mb-3 achievements-box">
									<div class="box-title border-bottom p-3">
										<h6 class="m-0 font-weight-bold">Achievements</h6>
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
												<div class="d-flex border-bottom p-3" style="width:100%;" id="award_<?php echo $award_id; ?>">
													<?php
														if($awards_row['image']!="" && $awards_row['image']!=null)
														{
															$image=base_url.$awards_row['image'];
													?>
															<div class="col-3 pl-0 pr-3">
																<img class="img-fluid rounded border w-100" src="<?php echo $image; ?>" alt="<?php echo ucfirst(strtolower($awards_row['title'])); ?>">
															</div>
													<?php
														}
													?>
													<div class="col-9 px-0 col-<?php if($awards_row['image']!="" && $awards_row['image']!=null){ echo "9"; }else { echo "12"; } ?>">
														<h6 class="mb-1 f-15"><?php echo ucfirst(strtolower($awards_row['title'])); ?></h6>
														<p class="m-0"><?php echo ucfirst(strtolower($awards_row['description'])); ?></p>
													</div>
												</div>
										<?php
												}
											}
											else
											{
												?>
												<div class="d-flex border-bottom" style="width:100%;" id="nothing_to_show_award">
													<div class="col-12 p-3">
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
										<h6 class="m-0 font-weight-bold">Influencers Following</h6>
									</div>
									<div class="box-body">
										<?php
											$follower_query="SELECT * FROM users_followers WHERE status=1 AND follower_id='".$profile_user_id."' AND type=1";
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
																				<h6 class="font-weight-bold text-dark mb-0 text-truncate" style="font-size:12px;font-weight:normal !important;"><?php echo ucfirst(strtolower($follower_data['first_name']))." ".ucfirst(strtolower($follower_data['last_name'])); ?></h6>
																				<div class="text-truncate text-primary"><?php echo ucfirst(strtolower($follower_data['profile_title'])); ?></div>
																				<?php
																					if($follower_data_personal!=false)
																					{
																			   ?>
																						<div class="small text-gray-500"><i class="feather-map-pin"></i> <?php echo getCityByID(ucfirst(strtolower($follower_data_personal['home_town']))).", ".ucfirst(strtolower(getCountryByID($follower_data_personal['country']))); ?></div>
																				<?php
																					}
																				?>
																			</div>
																		</div>
																		<div class="d-flex align-items-center p-3 border-top border-bottom job-item-body">
																			<div class="overlap-rounded-circle d-flex">
																				<img class="rounded-circle shadow-sm" data-toggle="tooltip" data-placement="top" title="" src="<?php echo base_url; ?>img/p1.png" alt="" data-original-title="Sophia Lee">
																				<img class="rounded-circle shadow-sm" data-toggle="tooltip" data-placement="top" title="" src="<?php echo base_url; ?>img/p2.png" alt="" data-original-title="John Doe">
																				<img class="rounded-circle shadow-sm" data-toggle="tooltip" data-placement="top" title="" src="<?php echo base_url; ?>img/p3.png" alt="" data-original-title="Julia Cox">
																				<img class="rounded-circle shadow-sm" data-toggle="tooltip" data-placement="top" title="" src="<?php echo base_url; ?>img/p4.png" alt="" data-original-title="Robert Cook">
																				<img class="rounded-circle shadow-sm" data-toggle="tooltip" data-placement="top" title="" src="<?php echo base_url; ?>img/p5.png" alt="" data-original-title="Sophia Lee">
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
													<div class="col-12 py-2 px-3">
														<h6 class="m-0" style="text-align:center;">Nothing to show.</h6>
													</div>
												</div>
												<?php
											}
										?>
									</div>
								</div>
								<div class="box shadow-sm border rounded bg-white mb-3 recommendations-box">
									<div class="box-title border-bottom p-3">
										<h6 class="m-0 font-weight-bold">Recommendations</h6>
									</div>
									<div class="box-body">
										<?php
											$r_query_1="SELECT * FROM recommendations WHERE r_user_id='$profile_user_id' AND status=1 ORDER BY added ASC";
											$r_result_1=mysqli_query($conn,$r_query_1);
											
											$r_query="SELECT * FROM recommendations WHERE user_id='$profile_user_id' AND status=1 ORDER BY status DESC";
											$r_result=mysqli_query($conn,$r_query);
										?>
										<div class="d-flex border-bottom" style="width:100%;">
											<div class="col-12 px-3 py-2">
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
													$i=1;
													while($r_row=mysqli_fetch_array($r_result))
													{
														$user_data_r=getUsersData($r_row['r_user_id']);
														$data='<div class="d-flex border-bottom p-3" style="width:100%;" id="rec_'.$r_row['id'].'">
															<div class="col-2 pl-0 pr-3">
																<img class="img-fluid" style="width:100% !important;border-radius: 50%;" src="'.getUserProfileImage($r_row['r_user_id']).'">
															</div>
															<div class="col-10 px-0">
																<h6 class="mb-1">'.ucfirst(strtolower($user_data_r['first_name'].' '.$user_data_r['last_name'])).' - ';
																if($r_row['status']=="0")
																{
																	$data=$data.'<span class="badge badge-danger">Pending</span>';
																	$data=$data.'</h6>
																			<p class="m-0">'.ucfirst(strtolower($r_row['custom_message'])).'</p>';
																}
																else
																{
																	$data=$data.'<span class="badge badge-success">Active</span>';
																	if($_COOKIE['uid']==$profile_user_id)
																	{
																		$data=$data.'<span style="float: right !important;">&nbsp;&nbsp;<a class="text-danger action-btn delete-btn" data-toggle="tooltip" data-placement="top" title="Delete" onclick="deleteRec('.$r_row['id'].');" href="javascript:void(0);"><i class="feather-trash-2"></i></a></span>';
																	}
																	$data=$data.'<p class="m-0" id="received_rec_'.$i++.'">'.ucfirst(strtolower($r_row['r_text'])).'</p>';
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
																	<h6 class="m-0" style="text-align:center;font-size:14px;font-weight:normal !important;">'.ucfirst(strtolower($user_data_r['first_name'].' '.$user_data_r['last_name'])).'';
																	$data=$data.'';
																	if($_COOKIE['uid']==$profile_user_id)
																	{
																		$data=$data.'<span style="float: right !important;">&nbsp;&nbsp;<a class="text-danger action-btn delete-btn" data-toggle="tooltip" data-placement="top" title="Delete" onclick="deleteRec('.$r_row['id'].');" href="javascript:void(0);"><i class="feather-trash-2"></i></a></span>';
																	}
																	$data=$data.'</h6>
																			<p class="mt-1 p-1">'.ucfirst(strtolower($r_row['r_text'])).'</p>
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
							</main>
													
							<aside class="col col-xl-3 order-xl-3 col-lg-12 order-lg-3 col-12" style="position:static;">
								<div class="box mb-3 shadow-sm border rounded bg-white profile-box text-center">
									<div class="p-2 text-left border-bottom">
										<h6 class="font-weight-bold mb-0" style=" text-transform: uppercase; font-size: 14px !important; ">
											<img src="<?php echo base_url; ?>img/videocv.png" style="cursor: pointer;width: 25px;margin-right: 5px;"> Video cv or profile 
										</h6>
									</div>
									<?php
										$v_query="SELECT * FROM users_resume WHERE user_id='".$profile_user_id."' AND profile_type!=1 AND is_default=1 ORDER BY id DESC";
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
									<?php
										if(isset($_COOKIE['uid']) && $_COOKIE['uid']!="")
										{
											?>
											<div>
												<video muted="" class="w-100" controls="" controlsList="nodownload" id="video_preview_data">
													<source src="<?php echo $video_file; ?>" type="video/mp4">
													Your browser does not support HTML5 video.
												</video>
											</div>
											<div class="p-3">
												<p class="m-0 font-weight-normel" id="video_profile_title" style="font-weight:normal !important;margin-top:20px;"><?php echo $profile_title; ?></p>
											</div>
											<?php
										}
										else
										{
											?>
											<div>
												<p style="text-align:center;">You needs to be login to view video cv/profile</p>
											</div>
											<?php
										}
									?>
								</div>
								<div class="box shadow-sm border rounded bg-white mb-3">
									<div class="box-title border-bottom p-3">
										<h6 class="m-0 font-weight-bold">World 360 degree</h6>
									</div>
									<div class="box-body">
										<div class="d-flex align-items-center p-3 job-item-header border-bottom">
										   <div class="overflow-hidden">
											  <h6 class="font-weight-bold text-dark mb-0 text-truncate" style="font-weight:normal !important;">Covid-19</h6>
											  <div class="text-truncate text-primary">Covid-19 in India</div>
											  <div class="small text-gray-500"> 
												Here are the latest fact checks.
											  </div>
										   </div>
										</div>
										<div class="d-flex align-items-center p-3 job-item-header border-bottom">
										   <div class="overflow-hidden">
											  <h6 class="font-weight-bold text-dark mb-0 text-truncate" style="font-weight:normal !important;">Trending in New Delhi</h6>
											  <div class="text-truncate text-primary">#ChinaWillPay</div>
										   </div>
										</div>
										<div class="d-flex align-items-center p-3 job-item-header border-bottom">
										   <div class="overflow-hidden">
											  <h6 class="font-weight-bold text-dark mb-0 text-truncate" style="font-weight:normal !important;">Trending in India</h6>
											  <div class="text-truncate text-primary">#indiawantsperman</div>
										   </div>
										</div>
										<div class="d-flex align-items-center p-3 job-item-header border-bottom">
										   <div class="overflow-hidden">
											  <h6 class="font-weight-bold text-dark mb-0 text-truncate" style="font-weight:normal !important;">Celebrities Trending</h6>
											  <div class="text-truncate text-primary">#AkshayKumar</div>
										   </div>
										</div>
										<div class="d-flex align-items-center p-3 job-item-header border-bottom">
										   <div class="overflow-hidden">
											  <h6 class="font-weight-bold text-dark mb-0 text-truncate" style="font-weight:normal !important;">Politics Trending</h6>
											  <div class="text-truncate text-primary">#JusticeForJayaPriya</div>
										   </div>
										</div>
										<div class="d-flex align-items-center p-3 job-item-header border-bottom">
										   <div class="overflow-hidden">
											  <h6 class="font-weight-bold text-dark mb-0 text-truncate" style="font-weight:normal !important;">Technology Trending</h6>
											  <div class="text-truncate text-primary">#TimeMachine</div>
										   </div>
										</div>
										<div class="d-flex align-items-center p-3 job-item-header border-bottom">
										   <div class="overflow-hidden">
											  <h6 class="font-weight-bold text-dark mb-0 text-truncate" style="font-weight:normal !important;">Entertainment Trending</h6>
											  <div class="text-truncate text-primary">#CBIMustForShushant</div>
										   </div>
										</div>
									</div>
								</div>
								<div class="box shadow-sm mb-3 rounded bg-white ads-box text-center overflow-hidden">
									<img src="<?php echo base_url; ?>img/ads1.png" class="img-fluid" alt="RopeYou Premium">
									<div class="p-3 border-bottom">
										<h6 class="font-weight-bold text-gold">RopeYou Premium</h6>
										<p class="mb-0 text-muted">Grow &amp; nurture your network</p>
									</div>
									<div class="p-3">
										<button type="button" class="btn btn-outline-gold pl-4 pr-4"> ACTIVATE </button>
									</div>
								</div>
								<div class="box shadow-sm mb-3 rounded bg-white ads-box text-center overflow-hidden is_stuck">
									 <img src="<?php echo base_url; ?>img/job1.png" class="img-fluid" alt="Responsive image">
									 <div class="p-3 border-bottom">
										<h6 class="font-weight-bold text-dark">RopeYou Solutions</h6>
										<p class="mb-0 text-muted">Looking for talent?</p>
									 </div>
									 <div class="p-3">
										<a href="<?php echo base_url; ?>post-job" class="btn btn-primary pl-4 pr-4"> POST A JOB </a>
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
				
				<script src="<?php echo base_url; ?>fileuploader/dist/jquery.fileuploader.min.js" type="text/javascript"></script>
				<script src="<?php echo base_url; ?>fileuploader/examples/avatar/js/custom.js" type="text/javascript"></script>
				<script>
					var user_id="<?php echo $profile_user_id; ?>";
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
						$("#loadMe").modal({
							backdrop: "static", //remove ability to close modal with click
							keyboard: false, //remove option to close with keyboard
							show: true //Display loader!
						});
						$.ajax({
							url:base_url+"saveuserprofilevideo",
							type:"post",
							data:formData,
							contentType: false, 
							processData: false,
							success:function(data)
							{
								//$("#gif_loader").hide();
								//$(".modal").modal({show:false});
								$("#loadMe").modal("hide");
								var parsedJson=JSON.parse(data);
								window.setTimeout( function(){
									$("#loadMe").modal("hide");
									if(parsedJson.status=="success")
									{
										//$("#loadMe").modal({show:false});
										var $source = $('#video_preview');
										$source[0].src = parsedJson.data;
										//$source.parent()[0].load();
										
										var $source = $('#video_preview_data');
										$source[0].src = parsedJson.data;
										//$source.parent()[0].load();
										$("#token_video").val(parsedJson.id);
										$("#video_profile_title").html(parsedJson.profile_title);
										$(".modal").modal("hide");
									}
									else
									{
										$("#loadMe").modal({show:false});
										$("#video_file_err").html(parsedJson.message);
									}
								}, 2000 );
								
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
						$("#prg_anchor").css({"color": "#fff" ,
						"background-color": "#6fb4ff",
						"padding": "5px 10px", "border-radius": "20px"});
						$("#peg_anchor").css({"color": "#1d2f38" ,
						"background-color": "#edf2f6",
						"padding": "5px 10px", "border-radius": "20px"});
						$("#professional_gallery").show();
						$("#personal_gallery").hide();
					}
					function showPersonal()
					{
						$("#prg_anchor").css({"color": "#1d2f38" ,
						"background-color": "#edf2f6",
						"padding": "5px 10px", "border-radius": "20px"});
						$("#peg_anchor").css({"color": "#fff" ,
						"background-color": "#6fb4ff",
						"padding": "5px 10px", "border-radius": "20px"});
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
					function loadImage(div)
					{
						$("."+div+" img").css("cursor","pointer");
						$("."+div+" img").click(function(){
							$("#backdrop_image_to_show").attr("src",$(this).attr("src"));
							$("#image_backdrop_modal").modal('show');
						});
					}
					loadImage("py-4");
					function recordVideo()
					{
						$("#video_cv_recording_model").modal('show');
					}
					function recordVideoCV(number)
					{
						if(number=="2")
						{
							window.location.href=base_url+'record-video-cv';
						}
						else{
							window.location.href=base_url+'record-video-profile';
						}
					}
					function getLocation() {
					  if (navigator.geolocation) {
						navigator.geolocation.getCurrentPosition(showPosition);
					  } else { 
						console.log('GeoLocation is not supported.');
						//x.innerHTML = "Geolocation is not supported by this browser.";
					  }
					}

					function showPosition(position) {
						console.log(position);
						$.ajax({
							url:base_url+"update-location",
							method:"post",
							data:{user_id:user_id,lattitude:position.coords.latitude,longitude:position.coords.longitude},
							success:function(response){
								
							}
						});
					}
					getLocation();
					function linkify(str) {
						var newStr = str.replace(/(<a href=")?((https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)))(">(.*)<\/a>)?/gi, function () {

							return '<a href="' + arguments[2] + '">' + (arguments[7] || arguments[2]) + '</a>'
						});
						console.log(newStr)
						$('#received_rec_1').html(newStr); //fill output area
					}

					var data = $('#received_rec_1').html(); //get input (content)
					linkify(data);
				</script>
		   </body>
		</html>
	<?php
	}
	else
	{
		include_once '404.php';
	}
	?>
	