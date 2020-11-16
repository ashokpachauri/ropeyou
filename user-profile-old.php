<html lang="en">
		<?php 
			include_once 'head.php';
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
					
					mysqli_query($conn,"DELETE FROM users_profile_views WHERE user_id='$profile_user_id' AND viewer_id='".$_COOKIE['uid']."' AND added LIKE '%DATE(NOW)%'");
					$pvquery="INSERT INTO users_profile_views SET user_id='$profile_user_id',viewer_id='".$_COOKIE['uid']."',status=1,added=NOW()";
					mysqli_query($conn,$pvquery);
					mysqli_query($conn,"UPDATE users_profile_views SET status=2 WHERE viewer_id='$profile_user_id' AND user_id='".$_COOKIE['uid']."'");
				}
				$profile_user_id=$user_row['id'];
				?>
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
					<title><?php echo $user_row['first_name']." ".$user_row['last_name']; ?>'s profile | RopeYou Connects</title>
					<link rel="stylesheet" type="text/css" href="<?php echo base_url; ?>css/feeling.css" />
				</head>
				<style>
					.morecontent span {
						display: none;
					}
					.morelink {
						display: block;
					}
				</style>
				<body>
					<?php include_once 'header.php'; ?>
					<?php 
						$user_row=getUsersData($profile_user_id);
						$users_personal_row=getUsersPersonalData($profile_user_id);
					?>
					<div class="py-4">
						<div class="container">
							<div class="row">
							   <!-- Main Content -->
							   <aside class="col col-xl-3 order-xl-1 col-lg-12 order-lg-1 col-12">
									<div class="box mb-3 shadow-sm border rounded bg-white profile-box text-center">
										<div class="py-4 px-3 border-bottom">
											<?php $profile=getUserProfileImage($profile_user_id); ?>
											<img src="<?php echo $profile; ?>" class="img-fluid mt-2 rounded-circle" style="width:100px;height:100px;border:1px solid #eaebec !important;" alt="<?php echo $user_row['first_name']." ".$user_row['last_name']; ?>">
											<h6 class="font-weight-bold text-dark mb-1 mt-4"><?php echo $user_row['first_name']." ".$user_row['last_name']; ?></h6>
											<p class="mb-0 text-muted" style="font-size:14px;"><?php echo $user_row['profile_title']; ?></p>
										</div>
										<div class="d-flex">
											<div class="col-6 border-right p-1">
											   <p class="mb-0 text-black-50 small" style="font-size:14px;"><span class="font-weight-bold text-dark"><?php echo getUserConnectionCounts($profile_user_id); ?></span>  Connections</p>
											</div>
											<div class="col-6 p-1">
											   <p class="mb-0 text-black-50 small" style="font-size:14px;"><span class="font-weight-bold text-dark"><?php echo getUserProfileViews($profile_user_id); ?></span>  Views</p>
											</div>
										</div>
										<div class="d-flex">
											<div class="col-6 border-right border-top">
											   <p class="mb-0 text-black-50 small" style="font-size:14px;"><a class="font-weight-bold p-1 d-block" href="<?php echo base_url; ?>u/<?php echo $user_row['username']; ?>">Employer View</a></p>
											</div>
											<div class="col-6 border-top">
											   <p class="mb-0 text-black-50 small" style="font-size:14px;"><a class="font-weight-bold p-1 d-block" href="<?php echo base_url; ?>w/<?php echo $user_row['username']; ?>">Web View</a></p>
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
												<div class="d-flex">
													<?php
														for($i=0;$i<$social_counts;$i++)
														{
															?>
															<div class="col-<?php echo $col_width; ?> <?php if(($social_counts-1)>$i) { echo 'border-right';} ?> border-top p-1">
															   <p class="mb-0 text-black-50 small"><a class="font-weight-bold d-block" href="<?php echo $social_counts_arr[$i][0]; ?>" target="_blank" style="font-size:16px;"><i class="<?php echo $social_counts_arr[$i][1]; ?>"></i></a></p>
															</div>
															<?php
														}
													?>
												</div>
										<?php
											}
										?>
									</div>
									<div class="box shadow-sm border rounded bg-white mb-3">
										<div class="box-title border-bottom p-3">
											<h6 class="m-0">Contact Details</h6>
										</div>
										<div class="box-body">
											<div class="d-flex" style="width:100%;">
											   <div class="col-12 border-top p-2">
													<div class="font-weight-normal">
														<?php
															if($users_personal_row!=false)
															{
																if($users_personal_row['communication_email']!="" && $users_personal_row['communication_email']!=null){
														?>
																<!--<i class="feather-mail"></i>-->
																	<div class="text-truncate" title="Email" style="font-size:11px !important;">
																		<h6 style="font-size:12px;"><li>&nbsp;<a href="mailto:<?php echo $users_personal_row['communication_email']; ?>" target="_blank"><?php echo $users_personal_row['communication_email']; ?></a></li></h6>
																	</div>
																<?php
																}
																if($users_personal_row['communication_mobile']!="" && $users_personal_row['communication_mobile']!=null){
														?>
																	<!--<i class="feather-phone"></i>-->
																	<div class="text-truncate" title="Mobile" style="font-size:11px !important;">
																		<h6 style="font-size:12px;"><li>&nbsp;<a href="tel:<?php echo $users_personal_row['communication_mobile']; ?>" target="_blank"><?php echo "(".$users_personal_row['phonecode'].") - ".$users_personal_row['communication_mobile']; ?></a></li></h6>
																	</div>
																<?php
																}
																if($users_personal_row['website']!="" && $users_personal_row['website']!=null){
														?>
																<!--<i class="feather-globe"></i>-->
																	<div class="text-truncate" title="Website" style="font-size:11px !important;">
																		<h6 style="font-size:12px;"><li>&nbsp;<a href="<?php echo $users_personal_row['website']; ?>" target="_blank"><?php echo $users_personal_row['website']; ?></a></li></h6>
																	</div>
																<?php
																}
																?>
														<?php
															}
															else
															{
																?>
																<div class="text-truncate" title="Nothing found in contacts" style="font-size:11px !important;">
																	<h6 style="font-size:14px;text-align:center;">Nothing to show in contacts.</h6>
																</div>
																<?php
															}
														?>
													</div>
											   </div>
											</div>
										</div>
									</div>
									<div class="box shadow-sm border rounded bg-white mb-3">
										<div class="box-title border-bottom p-3">
											<h6 class="m-0">Resume Downloads - (0)</h6>
										</div>
										<div class="box-body">
											<div class="d-flex" style="width:100%;">
											   <div class="col-12  border-top p-1">
												   <div class="font-weight-bold">
														<div class="text-truncate p-1" style="font-size:11px !important;">
															<?php
																$v_query="SELECT * FROM users_resume WHERE user_id='".$profile_user_id."' AND profile_type=1 ORDER BY id DESC LIMIT 1";
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
																	<h6 style="font-size:14px;text-align:center;">Resume not provided.</h6>
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
											<h6 class="m-0">Skills</h6>
										</div>
										<div class="box-body">
											<?php
												$skills_query="SELECT * FROM users_skills WHERE user_id='".$profile_user_id."' AND status=1";
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
														   <div class="col-12 border-top p-1">
															   <div class="font-weight-bold">
																  <div class="text-truncate" style="font-size:12px !important;"><span style="min-width:70% !important;"><?php echo $skills_row['title']; ?></span><span style="max-width:30% !important;float:right !important;" title="<?php echo $skillMeterTitle; ?>"><?php echo $skillMeterHtml; ?></span></div>
															   </div>
														   </div>
														</div>
											<?php
													}
												}
												else
												{
													?>
														<div class="d-flex p-1" style="width:100%;">
														   <h6 style="text-align:center;font-size:14px;">Nothing to show in skills</h6>
														</div>
													<?php
												}
											?>
										</div>
									</div>
									<div class="box shadow-sm mb-3 rounded bg-white ads-box text-center overflow-hidden">
										 <img src="<?php echo base_url; ?>img/job1.png" class="img-fluid" alt="Responsive image">
										 <div class="p-3 border-bottom">
											<h6 class="font-weight-bold text-dark">RopeYou Solutions</h6>
											<p class="mb-0 text-muted">Looking for talent?</p>
										 </div>
										 <div class="p-3">
											<button type="button" class="btn btn-outline-primary pl-4 pr-4"> POST A JOB </button>
										 </div>
									</div>
									<div class="box shadow-sm border rounded bg-white mb-3">
										<div class="box-title border-bottom p-3">
											<h6 class="m-0">Interests</h6>
										</div>
										<div class="box-body">	
											<div class="d-flex" style="width:100%;">
											   <div class="col-12 border-top p-1">
												   <div class="font-weight-bold">
													  <div class="text-truncate" style="font-size:12px !important;"><ul><li>Swimming</li></ul></div>
												   </div>
											   </div>
											</div>
											<div class="d-flex" style="width:100%;">
											   <div class="col-12 border-top p-1">
												   <div class="font-weight-bold">
													  <div class="text-truncate" style="font-size:12px !important;"><ul><li>Mountaining</li></ul></div>
												   </div>
											   </div>
											</div>
											<div class="d-flex" style="width:100%;">
											   <div class="col-12 border-top p-1">
												   <div class="font-weight-bold">
													  <div class="text-truncate" style="font-size:12px !important;"><ul><li>Listening To Music</li></ul></div>
												   </div>
											   </div>
											</div>
											<div class="d-flex" style="width:100%;">
											   <div class="col-12 border-top p-1">
												   <div class="font-weight-bold">
													  <div class="text-truncate" style="font-size:12px !important;"><ul><li>Bycycles</li></ul></div>
												   </div>
											   </div>
											</div>
											<div class="d-flex" style="width:100%;">
											   <div class="col-12 border-top p-1">
												   <div class="font-weight-bold">
													  <div class="text-truncate" style="font-size:12px !important;"><ul><li>Reading</li></ul></div>
												   </div>
											   </div>
											</div>
											<div class="d-flex" style="width:100%;">
											   <div class="col-12 border-top p-1">
												   <div class="font-weight-bold">
													  <div class="text-truncate" style="font-size:12px !important;"><ul><li>Poetry</li></ul></div>
												   </div>
											   </div>
											</div>
											<div class="d-flex" style="width:100%;">
											   <div class="col-12 border-top p-1">
												   <div class="font-weight-bold">
													  <div class="text-truncate" style="font-size:12px !important;"><ul><li>SEO</li></ul></div>
												   </div>
											   </div>
											</div>
											<div class="d-flex" style="width:100%;">
											   <div class="col-12 border-top p-1">
												   <div class="font-weight-bold">
													  <div class="text-truncate" style="font-size:12px !important;"><ul><li>Networking</li></ul></div>
												   </div>
											   </div>
											</div>
										</div>
									</div>
								</aside>
								<main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-2 col-md-12 col-sm-12 col-12">
									<div class="box shadow-sm border rounded bg-white mb-3">
										<div class="box-title border-bottom p-3">
											<h6 class="m-0">About <?php echo $user_row['first_name']; ?>
											<?php
												if($user_row['id']==$_COOKIE['uid'])
												{
											?>
													<a href="javascript:void(0);" style="float:right;"><i class="feather-edit"></i></a>
											<?php
												}
											?>
											</h6>
										</div>
										<div class="box-body p-3">
											<?php if($users_personal_row!=false) { echo '<p class="more" style="font-size:14px !important;text-align:justify;">'.trim(filter_var(strip_tags($users_personal_row['about']),FILTER_SANITIZE_STRING)).'</p>'; } else { echo '<h6 style="text-align:center;font-size:14px;">Nothing to show.</h6>'; } ?>
										</div>
									</div>
									<div class="box shadow-sm border rounded bg-white mb-3">
										<div class="box-title border-bottom p-3">
											<h6 class="m-0">Experience</h6>
										</div>
										<?php
											$experience_query="SELECT * FROM users_work_experience WHERE user_id='$profile_user_id' AND status=1 ORDER BY from_year DESC";
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
													<div class="box-body p-3 border-bottom">
														<div class="d-flex align-items-top job-item-header pb-2">
														   <div class="mr-2">
															  <h6 class="font-weight-bold text-dark mb-0" style="font-size:14px;"><?php echo $experience_row['title']; ?></h6>
															  <div class="text-truncate text-primary"><?php echo $experience_row['company']; ?></div>
															  <div class="small text-gray-500"><?php echo print_month($experience_row['from_month'])." ".$experience_row['from_year']; ?>  to <?php if($experience_row['working']=="1"){ echo "Present"; } else { echo print_month($experience_row['to_month'])." ".$experience_row['to_year']; } ?></div>
														   </div>
														   <img class="img-fluid ml-auto mb-auto" src="<?php echo base_url; ?>img/l3.png" alt="">
														</div>
														<p class="mb-0 more" style="font-size:14px !important;">
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
												<div class="box-body p-3">
													<div class="d-flex align-items-top job-item-header pb-2">
														<div class="col-12  p-1">
															<div class="font-weight-bold p-2">
																<h6 style="text-align:center;font-size:14px;">Nothing to show.</h6>
															</div>
														</div>
													</div>
												</div>
												<?php
											}
										?>
									</div>
									<div class="box shadow-sm border rounded bg-white mb-3">
										<div class="box-title border-bottom p-3">
											<h6 class="m-0" style="font-size:14px;">Education</h6>
										</div>
									 <?php
										$education_query="SELECT * FROM users_education WHERE user_id='$profile_user_id' AND status=1 ORDER BY from_year DESC";
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
												<div class="box-body p-3 border-bottom">
													<div class="d-flex align-items-top job-item-header pb-2">
													   <div class="mr-2">
														  <h6 class="font-weight-bold text-dark mb-0"><?php echo $education_row['university']; ?></h6>
														  <div class="text-truncate text-primary"><?php echo $education_row['title']; ?></div>
														  <div class="small text-gray-500"><?php echo print_month($education_row['from_month'])." ".$education_row['from_year']; ?>  to <?php if($education_row['studying']=="1"){ echo "Present"; } else { echo print_month($education_row['to_month'])." ".$education_row['to_year']; } ?> </div>
													   </div>
													   <img class="img-fluid ml-auto mb-auto" src="<?php echo base_url; ?>img/e1.png" alt="">
													</div>
													<p class="mb-0 more" style="font-size:14px !important;">
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
												<div class="box-body p-3">
													<div class="d-flex align-items-top job-item-header pb-2">
														<div class="col-12 p-1">
															<div class="font-weight-bold p-2">
																<h6 style="text-align:center;font-size:14px;">Nothing to show.</h6>
															</div>
														</div>
													</div>
												</div>
											<?php
										}
									?>
									</div>
									<?php
										$awards_query="SELECT * FROM users_awards WHERE status=1 AND user_id='".$profile_user_id."'";
										$awards_result=mysqli_query($conn,$awards_query);
									?>
									<div class="box shadow-sm border rounded bg-white mb-3">
										<div class="box-title border-bottom p-3">
											<h6 class="m-0">Achievements</h6>
										</div>
										<div class="box-body">	
											<?php
												if(mysqli_num_rows($awards_result)>0)
												{
													while($awards_row=mysqli_fetch_array($awards_result))
													{
											?>
													<div class="d-flex border-bottom" style="width:100%;">
														<?php
															if($awards_row['image']!="" && $awards_row['image']!=null)
															{
																$image=base_url.$awards_row['image'];
														?>
																<div class="col-4 border-right border-top p-1">
																	<img class="img-fluid" style="border:1px solid gray;width:100% !important;" src="<?php echo $image; ?>" alt="<?php echo $awards_row['title']; ?>">
																</div>
														<?php
															}
														?>
														<div class="col-<?php if($awards_row['image']!="" && $awards_row['image']!=null){ echo "8"; }else { echo "12"; } ?> border-top p-1">
															<h6 class="m-0" style="text-align:center;"><?php echo $awards_row['title']; ?></h6>
															<p class="mt-1 p-1" style="font-size:14px !important;"><?php echo $awards_row['description']; ?></p>
														</div>
													</div>
											<?php
													}
												}
												else
												{
													?>
													<div class="d-flex" style="width:100%;">
														<div class="col-12 p-1">
															<h6 class="m-0" style="text-align:center;font-size:14px;">Nothing to show.</h6>
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
																					<h6 class="font-weight-bold text-dark mb-0 text-truncate" style="font-size:12px;"><?php echo $follower_data['first_name']." ".$follower_data['last_name']; ?></h6>
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
														<div class="col-12 p-1">
															<h6 class="m-0" style="text-align:center;font-size:14px;">Nothing to show.</h6>
														</div>
													</div>
													<?php
												}
											?>
										</div>
									</div>
									<div class="box shadow-sm border rounded bg-white mb-3">
										<div class="box-title border-bottom p-3">
											<h6 class="m-0">Recommendations<a href="javascript:void(0);" style="float:right;">Ask for recommendation</a></h6>
										</div>
										<div class="box-body">
											<div class="d-flex border-bottom" style="width:100%;">
												<div class="col-12 p-1">
													<a href="javascript:void(0);" id="rr_anchor" onclick="showReceivedRec();">Received (0)</a>
													&nbsp;&nbsp;
													<a href="javascript:void(0);" id="gr_anchor" onclick="showGivenRec();" style="color:black;">Given (0)</a>
												</div>
											</div>
											<div  style="width:100%;" id="received_recommendations">
												<div class="col-12 p-1">
													<div class="font-weight-bold p-2">
														<h6 style="text-align:center;font-size:14px;">Nothing to show.</h6>
													</div>
												</div>
											</div>
											<div style="width:100%;display:none;" id="given_recommendations">
												<div class="col-12 p-1">
													<div class="font-weight-bold p-2">
														<h6 style="text-align:center;font-size:14px;">Nothing to show.</h6>
													</div>
												</div>
											</div>
										</div>
									</div>
								</main>
								<aside class="col col-xl-3 order-xl-3 col-lg-12 order-lg-3 col-12">
									<div class="box mb-3 shadow-sm border rounded bg-white profile-box text-center">
										<div class="p-2 border-bottom">
											<h6 class="font-weight-bold">Video cv or profile
											<?php
												if($user_row['id']==$_COOKIE['uid'])
												{
											?>
													<a href="javascript:void(0);" style="float:right;"><i class="feather-edit"></i></a>
											<?php
												}
											?>
											</h6>
										</div>
										<div class="py-3 px-1">
											<?php
												$v_query="SELECT * FROM users_resume WHERE user_id='".$profile_user_id."' AND profile_type!=1";
												$v_result=mysqli_query($conn,$v_query);
												if(mysqli_num_rows($v_result)>0)
												{
													$v_row=mysqli_fetch_array($v_result);
													?>
													<video muted="" controls="" controlsList="nodownload" style="width:250px;height:150px;border:2px solid #efefef;border-radius:5px;background-color:#efefef;">
														<source src="<?php echo base_url.$v_row['file']; ?>" type="video/mp4">
														Your browser does not support HTML5 video.
													</video>
													<?php
												}
												else
												{
													?>
													<div style="min-height:30px;"><p style="text-align:center;font-size:14px;">Video cv or profile not available</p></div>
													<?php
												}
											?>
										</div>
									</div>
									<?php
										$viewers_query="SELECT * FROM users_profile_views WHERE user_id='".$_COOKIE['uid']."' ORDER BY id DESC";
										$viewers_result=mysqli_query($conn,$viewers_query);
										if(mysqli_num_rows($viewers_result)>0)
										{
									?>
											<div class="box shadow-sm border rounded bg-white mb-3">
												<div class="box-title border-bottom p-3">
													<h6 class="m-0">Who viewed your profile</h6>
												</div>
												<div class="box-body p-3" style="max-height:400px;">
													<?php
														while($viewers_row=mysqli_fetch_array($viewers_result))
														{
															$viewer_id=$viewers_row['viewer_id'];
															$viewer_user=getUsersData($viewer_id);
															?>
															<div class="d-flex align-items-center osahan-post-header mb-3 people-list">
																<div class="dropdown-list-image mr-3">
																	<a href="<?php echo base_url."u/".$viewer_user['username']; ?>">
																		<img class="rounded-circle" style="border:1px solid #eaebec !important;" src="<?php echo getUserProfileImage($viewer_id); ?>" alt="<?php echo $viewer_user['first_name']." ".$viewer_user['last_name']; ?>">
																		<div class="status-indicator <?php if(userLoggedIn($viewer_id)){ echo 'bg-success';} else{ echo 'bg-danger'; } ?>">
																		</div>
																	</a>
																</div>
																<div class="font-weight-bold mr-2">
																	<div class="text-truncate">
																		<a href="<?php echo base_url."u/".$viewer_user['username']; ?>">
																			<?php echo $viewer_user['first_name']." ".$viewer_user['last_name']; ?>
																		</a>
																	</div>
																	<div class="small text-gray-500">
																		<?php echo $viewer_user['profile_title']; ?>
																	</div>
																</div>
																<span class="ml-auto">
																	<button type="button" class="btn btn-light btn-sm">Connect</button>
																</span>
															</div>
															<?php
														}
													?>
												</div>
											</div>
									<?php
										}
									?>
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
									<div class="box shadow-sm border rounded bg-white mb-3">
										<div class="box-title border-bottom p-3">
											<?php 
												$latest_opening_query="SELECT * FROM jobs ORDER BY id DESC LIMIT 10";
												$latest_opening_result=mysqli_query($conn,$latest_opening_query);
												$latest_opening_num_rows=mysqli_num_rows($latest_opening_result);
											?>
											<h6 class="m-0">Recent Openings
												<?php
													if($latest_opening_num_rows>0)
													{
														?>
														<a href="<?php echo base_url; ?>jobs-posted" target="_blank" class="pull-right" style="cursor:pointer;text-decoration:none;float:right;" title="View All"><i class="feather-briefcase"></i></a>
														<?php
													}
												?>
											</h6>
										</div>
										<div class="box-body">
											<?php
												if($latest_opening_num_rows>0)
												{
													while($latest_opening_row=mysqli_fetch_array($latest_opening_result))
													{
											?>
													<div class="d-flex align-items-center p-3 job-item-header border-bottom">
													   <div class="overflow-hidden">
														  <h6 class="font-weight-bold text-dark mb-0 text-truncate"><?php echo $latest_opening_row['job_title']; ?></h6>
														  <div class="text-truncate text-primary"><?php echo $latest_opening_row['job_company']; ?></div>
														  <div class="small text-gray-500"><i class="feather-map-pin"></i> <?php echo $latest_opening_row['job_location']; ?></div>
													   </div>
													</div>
											<?php
													}
												}
											?>
										</div>
									</div>
								  
							   </aside>
							</div>
						</div>
					</div>
					<?php include_once 'scripts.php'; ?>
					<script>
						/*$(document).ready(function(){
							var maxLength = 400;
							$(".show-read-more").each(function(){
								var myStr = $(this).text();
								if($.trim(myStr).length > maxLength){
									var newStr = myStr.substring(0, maxLength);
									var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
									$(this).empty().html(newStr);
									$(this).append(' <a href="javascript:void(0);" class="read-more">read more...</a>');
									$(this).append('<span class="more-text" style="display:none;">' + removedStr + '</span>');
								}
							});
							$(".read-more").click(function(){
								$(this).siblings(".more-text").contents().unwrap();
								$(this).remove();
							});
						});*/
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
				<?php
			}
			else
			{
				?>
					<head>
						<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
						<title><?php echo $username; ?>'s profile | RopeYou Connects</title>
						<link rel="stylesheet" type="text/css" href="<?php echo base_url; ?>css/feeling.css" />
					</head>
					<style>
						.morecontent span {
							display: none;
						}
						.morelink {
							display: block;
						}
					</style>
					<body>
						<?php include_once 'header.php'; ?>
						<?php 
							$users_personal_row=getUsersPersonalData($profile_user_id);
						?>
						<div class="py-4">
							<div class="container">
								<div class="row">
								   <main class="col col-xl-9 order-xl-2 col-lg-12 order-lg-2 col-md-12 col-sm-12 col-12">
										<div class="box shadow-sm border rounded bg-white mb-3">
											<div class="box-body p-3">
												<p class="more">The page you are looking for is not available either temporarily or permanantly.</p>
												<p class="more">this can be due to either you or the profile owner has blocked mutually or the profile has been locked by RopeYou or profile has been removed by the owner.</p>
											</div>
										</div>
										<div class="box shadow-sm border rounded bg-white mb-3">
											<div class="box-title border-bottom p-3">
												<?php 
													$latest_opening_query="SELECT * FROM jobs ORDER BY id DESC LIMIT 10";
													$latest_opening_result=mysqli_query($conn,$latest_opening_query);
													$latest_opening_num_rows=mysqli_num_rows($latest_opening_result);
												?>
												<h6 class="m-0">Recent Openings
													<?php
														if($latest_opening_num_rows>0)
														{
															?>
															<a href="<?php echo base_url; ?>jobs-posted" target="_blank" class="pull-right" style="cursor:pointer;text-decoration:none;float:right;" title="View All"><i class="feather-briefcase"></i></a>
															<?php
														}
													?>
												</h6>
											</div>
											<div class="box-body">
												<?php
													if($latest_opening_num_rows>0)
													{
														while($latest_opening_row=mysqli_fetch_array($latest_opening_result))
														{
												?>
														<div class="d-flex align-items-center p-3 job-item-header border-bottom">
														   <div class="overflow-hidden">
															  <h6 class="font-weight-bold text-dark mb-0 text-truncate"><?php echo $latest_opening_row['job_title']; ?></h6>
															  <div class="text-truncate text-primary"><?php echo $latest_opening_row['job_company']; ?></div>
															  <div class="small text-gray-500"><i class="feather-map-pin"></i> <?php echo $latest_opening_row['job_location']; ?></div>
														   </div>
														</div>
												<?php
														}
													}
												?>
											</div>
										</div>
									</main>
									<aside class="col col-xl-3 order-xl-3 col-lg-12 order-lg-3 col-12">
										<?php
											$viewers_query="SELECT * FROM users_profile_views WHERE user_id='".$_COOKIE['uid']."' ORDER BY id DESC";
											$viewers_result=mysqli_query($conn,$viewers_query);
											if(mysqli_num_rows($viewers_result)>0)
											{
										?>
												<div class="box shadow-sm border rounded bg-white mb-3">
													<div class="box-title border-bottom p-3">
														<h6 class="m-0">Who viewed your profile</h6>
													</div>
													<div class="box-body p-3" style="max-height:400px;">
														<?php
															while($viewers_row=mysqli_fetch_array($viewers_result))
															{
																$viewer_id=$viewers_row['viewer_id'];
																$viewer_user=getUsersData($viewer_id);
																?>
																<div class="d-flex align-items-center osahan-post-header mb-3 people-list">
																   <div class="dropdown-list-image mr-3">
																	  <img class="rounded-circle" style="border:1px solid #eaebec !important;" src="<?php echo getUserProfileImage($viewer_id); ?>" alt="<?php echo $viewer_user['first_name']." ".$viewer_user['last_name']; ?>">
																	  <div class="status-indicator <?php if(userLoggedIn($viewer_id)){ echo 'bg-success';} else{ echo 'bg-danger'; } ?>"></div>
																   </div>
																   <div class="font-weight-bold mr-2">
																	  <div class="text-truncate"><?php echo $viewer_user['first_name']." ".$viewer_user['last_name']; ?></div>
																	  <div class="small text-gray-500"><?php echo $viewer_user['profile_title']; ?>
																	  </div>
																   </div>
																   <span class="ml-auto"><button type="button" class="btn btn-light btn-sm">Connect</button>
																   </span>
																</div>
																<?php
															}
														?>
													</div>
												</div>
										<?php
											}
										?>
										<div class="box shadow-sm mb-3 rounded bg-white ads-box text-center overflow-hidden">
											<img src="img/ads1.png" class="img-fluid" alt="RopeYou Premium">
											<div class="p-3 border-bottom">
												<h6 class="font-weight-bold text-gold">RopeYou Premium</h6>
												<p class="mb-0 text-muted">Grow &amp; nurture your network</p>
											</div>
											<div class="p-3">
												<button type="button" class="btn btn-outline-gold pl-4 pr-4"> ACTIVATE </button>
											</div>
										</div>
									</aside>
								</div>
							</div>
						</div>
						<?php include_once 'scripts.php'; ?>
						<script>
							/*$(document).ready(function(){
								var maxLength = 400;
								$(".show-read-more").each(function(){
									var myStr = $(this).text();
									if($.trim(myStr).length > maxLength){
										var newStr = myStr.substring(0, maxLength);
										var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
										$(this).empty().html(newStr);
										$(this).append(' <a href="javascript:void(0);" class="read-more">read more...</a>');
										$(this).append('<span class="more-text" style="display:none;">' + removedStr + '</span>');
									}
								});
								$(".read-more").click(function(){
									$(this).siblings(".more-text").contents().unwrap();
									$(this).remove();
								});
							});*/
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
				<?php
			}
			$user_row=getUsersData($profile_user_id);
		?>