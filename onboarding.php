<!DOCTYPE html>
<?php 
	include_once 'connection.php';
	$user_id=$_COOKIE['uid'];
	$skipped=0;
	/*if(isset($_REQUEST['skipped']) && $_REQUEST['skipped']!="")
	{
		$_SESSION['skip_for_now']=$_REQUEST['skipped'];
	}
	if(isset($_SESSION['skip_for_now']) && $_SESSION['skip_for_now']!="")
	{
		$skipped=$_SESSION['skip_for_now'];
	}*/
	$onboarding=getOnBoarding($user_id,$skipped);
	$task_arr=array("basic_profile","bio","work_experience","education","skills","resume");
	if(in_array($onboarding,$task_arr))
	{
		
	}
	else
	{
		?>
		<script>
			window.location.href="<?php echo base_url.'dashboard'; ?>";
		</script>
		<?php
		die();
	}
?>
<html lang="en" style="" class=""><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="MAVIA - Register, Reservation, Questionare, Reviews form wizard">
	<meta name="author" content="Ansonika">
	<title>Onboarding | RopeYou Connects</title>
	<link rel="icon" type="image/png" href="<?php echo base_url; ?>img/fav.png">
	<link href="<?php echo base_url; ?>onboarding-assets/css.css" rel="stylesheet">
	<link href="<?php echo base_url; ?>onboarding-assets/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url; ?>onboarding-assets/style.css" rel="stylesheet">
	<link href="<?php echo base_url; ?>onboarding-assets/responsive.css" rel="stylesheet">
	<link href="<?php echo base_url; ?>onboarding-assets/menu.css" rel="stylesheet">
	<link href="<?php echo base_url; ?>onboarding-assets/animate.min.css" rel="stylesheet">
	<link href="<?php echo base_url; ?>onboarding-assets/all_icons_min.css" rel="stylesheet">
	<link href="<?php echo base_url; ?>onboarding-assets/grey.css" rel="stylesheet">
	<link href="<?php echo base_url; ?>onboarding-assets/date_time_picker.css" rel="stylesheet">
	<link href="<?php echo base_url; ?>onboarding-assets/custom.css" rel="stylesheet">
	<script src="<?php echo base_url; ?>onboarding-assets/modernizr.js.download"></script>
</head>

<body style="overflow: visible;background-color:#fff !important;">
	<header>
		<div class="container-fluid">
		    <div class="row">
                <div class="col-3">
                    <div id="logo_home">
                        <h1><a href="<?php echo base_url; ?>onboarding" style="font-size:32px !important;">RopeYou</a></h1>
                    </div>
                </div>
                <div class="col-9">
                    <a href="<?php echo base_url; ?>logout" style="color:black !important;font-size:13px !important;float:right !important;margin-right:100px !important;font-family: 'Ubuntu', sans-serif;font-weight:bold;">Logout</a>
                </div>
            </div>
		</div>
		<!-- container -->
	</header>
	<!-- End Header -->

	<main>
		<div id="form_container" style="padding:0px 15px !important;width:100% !important;">
			<div class="row">
				<div class="col-lg-3">
					<div id="left_form" style="background-color:#e4edf2 !important;min-height:500px;">
						<figure><img src="<?php echo base_url; ?>onboarding-assets/registration_bg.svg" alt=""></figure>
						<h3 class="main_question wizard-header" style="margin:0px !important;"><strong id="location">Step 1 of 6</strong></h3>
						<h2 id="topic_heading" style="font-weight:500;color:#000;">Basic Information</h2>
						<p id="topic_tagline" style="font-weight:800;color:#000;">Please fill in the basic details to continue.</p>
						<!--<a href="javascript:void(0);" id="more_info" data-toggle="modal" data-target="#more-info"><i class="pe-7s-info"></i></a>-->
					</div>
				</div>
				<?php
					$query="SELECT * FROM users WHERE id='$user_id'";
					$result=mysqli_query($conn,$query);
					$row=mysqli_fetch_array($result);
					
					$users_personal_query="SELECT * FROM users_personal WHERE user_id='$user_id'";
					$users_personal_result=mysqli_query($conn,$users_personal_query);
					$users_personal_row=mysqli_fetch_array($users_personal_result);
				?>
				<div class="col-lg-9">
					<div id="wizard_container" class="wizard" novalidate="novalidate">
						<div id="top-wizard">
							<div id="progressbar" class="ui-progressbar ui-widget ui-widget-content ui-corner-all" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="ui-progressbar-value ui-widget-header ui-corner-left" style="display: none; width: 0%;"></div></div>
						</div>
						<form name="example-1" id="wrapped" method="POST" action="<?php echo base_url; ?>finalize.php" enctype="multipart/form-data" class="wizard-form">
							<input id="website" name="website" type="text" value="">
							<div id="middle-wizard" class="wizard-branch wizard-wrapper" style="padding:15px !important;padding-bottom:50px;">
								<div class="step wizard-step <?php if($onboarding=="basic_profile"){ echo "current"; } ?>" id="basic_info_wizard">
									<div class="row">
										<div class="col-md-12" id="basic_error" style="color:red;text-align:center;font-size:12px;"></div>
										<div class="col-md-4">
											<div class="form-group">
												<h6>First Name*</h6>
												<input type="text" name="firstname" id="firstname" class="form-control required" value="<?php echo $row['first_name']; ?>" placeholder="First name">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<h6>Last Name*</h6>
												<input type="text" name="lastname" id="lastname" class="form-control required" value="<?php echo $row['last_name']; ?>" placeholder="Last name">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<h6>Username*</h6>
												<input required id="username" class="form-control required" type="text" name="username" title="Username" placeholder="Username" value="<?php echo $row['username']; ?>" />
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<h6>Communication Email*</h6>
												<input type="email" name="communication_email" id="communication_email" value="<?php if($users_personal_row['communication_email']!=""){ echo $users_personal_row['communication_email']; } else { echo $row['email']; } ?>" class="form-control required" placeholder="Your Email">
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<h6>Phone Code*</h6>
												<select class="form-control required" required name="phonecode" id="phonecode">
													<?php
														$c_query="SELECT title,phonecode,code FROM country WHERE status=1 ORDER BY title";
														$c_result=mysqli_query($conn,$c_query);
														while($c_row=mysqli_fetch_array($c_result))
														{
															?>
															<option value="<?php echo $c_row['phonecode']; ?>" <?php if(strtolower($c_row['phonecode'])==strtolower($users_personal_row['phonecode'])){ echo "selected"; } else if($row['country_code']==strtolower($c_row['phonecode'])){ echo "selected"; } ?>><?php echo $c_row['title']." ( ".$c_row['phonecode']." )"; ?></option>
															<?php
														}
													?>
												</select>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<h6>Communication Mobile*</h6>
												<input type="text" name="communication_mobile" id="communication_mobile" value="<?php if($users_personal_row['communication_mobile']!=""){ echo $users_personal_row['communication_mobile']; } else { echo $row['mobile']; } ?>" class="form-control required" placeholder="10 Digit Mobile">
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<h6>Mobile Visibility*</h6>
												<select class="form-control required" required name="mobile_visibility" id="mobile_visibility">
													<option value="0" <?php if($users_personal_row['mobile_visibility']=="" || $users_personal_row['mobile_visibility']=="0"){ echo "selected"; } ?>>Only Me</option>
													<option value="1" <?php if($users_personal_row['mobile_visibility']=="1"){ echo "selected"; } ?>>Connections</option>
													<option value="2" <?php if($users_personal_row['mobile_visibility']=="2"){ echo "selected"; } ?>>Public</option>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<h6>D.O.B*</h6>
										</div>
										<div class="col-md-4" title="Birth Day">
											<div class="form-group">
												<select class="form-control required" id="day_birth" name="day_birth" required>
													<option value="">Birth Day</option>
													<?php
														for($i=1;$i<=31;$i++)
														{
															?>
															<option value="<?php echo $i; ?>" <?php if($i==$users_personal_row['day_birth']){ echo "selected"; } ?>><?php echo $i; ?></option>
															<?php
														}
													?>
												</select>
											</div>
										</div>
										<div class="col-md-4" title="Birth Month">
											<div class="form-group">
												<select class="form-control required" id="month_birth" name="month_birth" required>
													<option value="">Birth Month</option>
													<option value="1" <?php if("1"==$users_personal_row['month_birth']){ echo "selected"; } ?>>Jan</option>
													<option value="2" <?php if("2"==$users_personal_row['month_birth']){ echo "selected"; } ?>>Feb</option>
													<option value="3" <?php if("3"==$users_personal_row['month_birth']){ echo "selected"; } ?>>Mar</option>
													<option value="4" <?php if("4"==$users_personal_row['month_birth']){ echo "selected"; } ?>>Apr</option>
													<option value="5" <?php if("5"==$users_personal_row['month_birth']){ echo "selected"; } ?>>May</option>
													<option value="6" <?php if("6"==$users_personal_row['month_birth']){ echo "selected"; } ?>>Jun</option>
													<option value="7" <?php if("7"==$users_personal_row['month_birth']){ echo "selected"; } ?>>Jul</option>
													<option value="8" <?php if("8"==$users_personal_row['month_birth']){ echo "selected"; } ?>>Aug</option>
													<option value="9" <?php if("9"==$users_personal_row['month_birth']){ echo "selected"; } ?>>Sep</option>
													<option value="10" <?php if("10"==$users_personal_row['month_birth']){ echo "selected"; } ?>>Oct</option>
													<option value="11" <?php if("11"==$users_personal_row['month_birth']){ echo "selected"; } ?>>Nov</option>
													<option value="12" <?php if("12"==$users_personal_row['month_birth']){ echo "selected"; } ?>>Dec</option>
												</select>
											</div>
										</div>
										<div class="col-md-4" title="Birth Year">
											<div class="form-group">
												<select class="form-control required" id="year_birth" name="year_birth" required>
													<option value="">Birth Year</option>
													<?php
														for($i=(((int)(date('Y')))-10);$i>=1930;$i--)
														{
															?>
															<option value="<?php echo $i; ?>" <?php if($i==$users_personal_row['year_birth']){ echo "selected"; } ?>><?php echo $i; ?></option>
															<?php
														}
													?>
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<h6>Gender*</h6>
												<input type="radio" name="gender" id="male" required checked value="Male">&nbsp;Male&nbsp;&nbsp;
												<input type="radio" name="gender" id="female" required value="Female" <?php if("Female"==$users_personal_row['gender']){ echo "checked"; } ?>>&nbsp;Female&nbsp;&nbsp;<input type="radio" name="gender" id="prefer_not_mention" required value="Prefer not to mention" <?php if("Prefer not to mention"==$users_personal_row['gender']){ echo "checked"; } ?>>&nbsp;Prefer not to mention
											</div>
										</div>
									</div>
									<!--<div class="row">
										<div class="col-md-2">
											<button type="button" onclick="saveBasicInformation();" id="mybutton" class="btn btn-primary">Save</button>
										</div>
									</div>-->
									<!-- /row -->
								</div>
								<!-- /step-->

								<div class="step wizard-step <?php if($onboarding=="bio"){ echo "current"; } ?>"  style="display:none;" id="bio_wizard">
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<h6>Address</h6>
												<input type="text" name="address" id="address" class="form-control" value="<?php echo $users_personal_row['address']; ?>" placeholder="Address">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<h6>Country*</h6>
												<div class="styled-select">
													<select class="form-control required" id="country" name="country">
														<option value="">Country</option>
														<?php
															$country_selected=false;
															$c_query="SELECT * FROM country WHERE status=1";
															$c_result=mysqli_query($conn,$c_query);
															$selected_country=$users_personal_row['country'];
															while($c_row=mysqli_fetch_array($c_result))
															{
																?>
																<option value="<?php echo $c_row['id']; ?>" <?php if($c_row['id']==$users_personal_row['country']){ echo "selected"; $selected_country=$c_row['id'];} else if($row['country_code']==strtolower($c_row['phonecode'])){ echo "selected";$selected_country=$c_row['id']; } ?>><?php echo htmlentities($c_row['title']); ?></option>
																<?php
															}
														?>
													</select>
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<h6>City*</h6>
												<div class="styled-select">
													<select class="form-control required" id="home_town" name="home_town">
														<option value="">City</option>
														<?php
															if($selected_country!=false)
															{
																$c_query="SELECT * FROM city WHERE country='$selected_country' AND status=1";
																$c_result=mysqli_query($conn,$c_query);
																while($c_row=mysqli_fetch_array($c_result))
																{
																	?>
																	<option value="<?php echo $c_row['id']; ?>" <?php if($c_row['id']==$users_personal_row['home_town']){ echo "selected"; } ?>><?php echo htmlentities($c_row['title']); ?></option>
																	<?php
																}
															}
														?>
													</select>
												</div>
											</div>
										</div>
										<!-- /col-sm-12 -->
									</div>
									<!-- /row -->
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<h6>Pincode</h6>
												<input type="text" name="pincode" id="pincode" class="form-control" placeholder="your area pincode" value="<?php echo $users_personal_row['pincode']; ?>">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<h6>Passport Status</h6>
												<input type="text" name="passport" id="passport"  class="form-control " placeholder="Having Indian, Canadian and UK passport" value="<?php echo $users_personal_row['passport']; ?>">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<h6>Relocation Status*</h6>
												<select id="relocate_abroad" name="relocate_abroad" title="let us know if you are ready or not to relocate to abroad?" class="form-control input-group-lg required" required>
													<option value="0" <?php if($users_personal_row['relocate_abroad']=="0"){ echo "selected"; } ?>>Can not relocate outside home town</option>
													<option value="1" <?php if($users_personal_row['relocate_abroad']=="1"){ echo "selected"; } ?>>Can Relocate within home country</option>
													<option value="2" <?php if($users_personal_row['relocate_abroad']=="2" || $users_personal_row['relocate_abroad']==""){ echo "selected"; } ?>>Can Relocate worldwide</option>
												</select>
											</div>
										</div>
									</div>
									<!-- /row -->
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<h6>Profile Summery</h6>
												<textarea name="about" id="about" class="form-control" rows="5" style="height:150px;resize:none;"><?php echo strip_tags($users_personal_row['about']); ?></textarea>
											</div>
										</div>
									</div>
									<!-- /row -->
								</div>
								<!-- /step-->

								<div class="step wizard-step <?php if($onboarding=="work_experience"){ echo "current"; } ?>" disabled="disabled" style="display: none;" id="experience_wizard">
									<div class="row">
										<div class="col-md-12" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);transition: box-shadow 83ms;background:#fff;padding:10px;margin: 0 0px 10px;border-radius:2px;">
											<h6>
												Professional Experiences 
												<a href="javascript:void(0);" onclick="getExperience();" style="float:right;margin-right:20px;"><img src="<?php echo base_url; ?>img/add-icon.png"></a>
											</h6>
										</div>
									</div>
									<div class="row" id="experience_data_matrix">
										<?php
											$experience_query="SELECT * FROM users_work_experience WHERE user_id='$user_id' AND status=1 ORDER BY from_year DESC";
											$experience_result=mysqli_query($conn,$experience_query);
											if(mysqli_num_rows($experience_result)>0)
											{
												while($experience_row=mysqli_fetch_array($experience_result))
												{
													$experience_id=$experience_row['id'];
													$company_query="SELECT * FROM companies WHERE id='".$experience_row['company']."'";
													
													$country_query="SELECT title FROM country WHERE id='".$experience_row['country']."'";
													$country_result=mysqli_query($conn,$country_query);
													$country_row=mysqli_fetch_array($country_result);
													
													$city_query="SELECT title FROM city WHERE id='".$experience_row['city']."'";
													$city_result=mysqli_query($conn,$city_query);
													$city_row=mysqli_fetch_array($city_result);
												?>
													<div class="col-md-12" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);transition: box-shadow 83ms;background:#fff;padding:10px;margin: 0 0px 10px;border-radius:2px;border-bottom: 2px solid #e8ebed;border-top: 2px solid #e8ebed;" id="work_exp_<?php echo $experience_id; ?>">
														<div class="row">
															<div class="col-md-8">
																<h6><?php echo ucfirst(strtolower($experience_row['title'])); ?></h6>
																<p style="font-size:16px;margin-bottom:0px !important;"><?php echo ucfirst(strtolower($experience_row['company'])); ?></p>
																<small><i><?php echo ucfirst(strtolower($city_row['title'])); ?>, <?php echo ucfirst(strtolower($country_row['title'])); ?></small></i>
															</div>
															<div class="col-md-3">
																<h6><?php echo print_month($experience_row['from_month'])." ".$experience_row['from_year']; ?>  to <?php if($experience_row['working']=="1"){ echo "Present"; } else { echo print_month($experience_row['to_month'])." ".$experience_row['to_year']; } ?></h6>
															</div>
															<div class="col-md-1">
																<h6><a href="javascript:void(0);" onclick='getExperience("<?php echo $experience_id; ?>");'>Edit</a></h6>
															</div>
															<div class="col-md-12">
																<p>
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
														</div>
													</div>
												<?php
												}
											}
										?>
									</div>
									<div class="row">
										<div class="col-md-12" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);transition: box-shadow 83ms;background:#fff;padding:10px;margin: 0 0px 10px;border-radius:2px;display:none;" id="experience_form">
											
										</div>
									</div>
								</div>
								<div class="step wizard-step <?php if($onboarding=="education"){ echo "current"; } ?>" disabled="disabled" style="display: none;">
									<div class="row">
										<div class="col-md-12" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);transition: box-shadow 83ms;background:#fff;padding:10px;margin: 0 0px 10px;border-radius:2px;">
											<h6>
												Educational Details
												<a href="javascript:void(0);" style="float:right;margin-right:20px;" onclick='getEducation();'><img src="<?php echo base_url; ?>img/add-icon.png"></a>
											</h6>
										</div>
									</div>
									<div class="row" id="educational_data_matrix">
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
													<div class="col-md-12" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);transition: box-shadow 83ms;background:#fff;padding:10px;margin: 0 0px 10px;border-radius:2px;border-bottom: 2px solid #e8ebed;border-top: 2px solid #e8ebed;" id="edu_<?php echo $education_id; ?>">
														<div class="row">
															<div class="col-md-8">
																<h6><?php echo ucfirst(strtolower($education_row['title'])); ?></h6>
																<p style="font-size:16px;margin-bottom:0px !important;"><?php echo ucfirst(strtolower($education_row['university'])); ?></p>
																<small><i><?php echo ucfirst(strtolower($city_row['title'])); ?>, <?php echo ucfirst(strtolower($country_row['title'])); ?></small></i>
															</div>
															<div class="col-md-3">
																<h6><?php echo print_month($education_row['from_month'])." ".$education_row['from_year']; ?>  to <?php if($education_row['studying']=="1"){ echo "Present"; } else { echo print_month($education_row['to_month'])." ".$education_row['to_year']; } ?></h6>
															</div>
															<div class="col-md-1">
																<h6><a href="javascript:void(0);" onclick='getEducation("<?php echo $education_id; ?>")'>Edit</a></h6>
															</div>
															<div class="col-md-12">
																<p>
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
														</div>
													</div>
										<?php
												}
											}
										?>
									</div>	
									<div class="row">
										<div class="col-md-12" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);transition: box-shadow 83ms;background:#fff;padding:10px;margin: 0 0px 10px;border-radius:2px;border-bottom: 2px solid #e8ebed;border-top: 2px solid #e8ebed;display:none;" id="education_form">
											
										</div>
									</div>
								</div>
								<div class="step wizard-step <?php if($onboarding=="skills"){ echo "current"; } ?>" disabled="disabled" style="display: none;">
									<div class="row">
										<div class="col-md-12" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);transition: box-shadow 83ms;background:#fff;padding:10px;margin: 0 0px 10px;border-radius:2px;">
											<h6>Manage Skills <a href="javascript:void(0);" style="float:right;margin-right:30px;" class="add_button" title="Add field"><img src="<?php echo base_url; ?>img/add-icon.png"/></a></h6>
										</div>
										<div class="col-md-12">
											<div class="row value_wrapper">
												<?php
													$query="SELECT * FROM users_skills WHERE status=1 AND user_id='$user_id' ORDER BY proficiency DESC";
													$result=mysqli_query($conn,$query);
													$response['status']='success';
													$htmlData="";
													if(mysqli_num_rows($result)>0)
													{
														while($row=mysqli_fetch_array($result))
														{
															$htmlData=$htmlData."<div class='col-md-5' style='margin-bottom:15px;border:1px solid gray;border-radius:10px;'><div class='row'>";
															$htmlData.="<div class='col-md-6'><h6>".ucfirst(strtolower($row['title']))."</h6></div>";
															$htmlData.="<div class='col-md-4'><h6>";
															/*if(((int)($row['proficiency']))<=33)
															{
																$htmlData.="Basic";
															}
															else if(((int)($row['proficiency']))<=66)
															{
																$htmlData.="Proficient";
															}
															else if(((int)($row['proficiency']))<=100)
															{
																$htmlData.="Expert";
															}*/
															/*if(((int)($row['proficiency']))<=33)
															{
																$htmlData.='<span class="badge badge-success ml-1" style="border: 2px solid #00c9a7;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-dark ml-1" style="color: #343a40 !important;background-color: #fff !important;border: 2px solid #343a40 !important;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-dark ml-1" style="color: #343a40 !important;background-color: #fff !important;border: 2px solid #343a40 !important;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span>';
																//$skillMeterTitle="Basic";
															}
															else if(((int)($row['proficiency']))<=66)
															{
																$htmlData.='<span class="badge badge-success ml-1" style="border: 2px solid #00c9a7;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-success ml-1" style="border: 2px solid #00c9a7;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-dark ml-1" style="color: #343a40 !important;background-color: #fff !important;border: 2px solid #343a40 !important;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span>';
																//$skillMeterTitle="Proficient";
															}
															else if(((int)($row['proficiency']))<=100)
															{
																$htmlData.='<span class="badge badge-success ml-1" style="border: 2px solid #00c9a7;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-success ml-1" style="border: 2px solid #00c9a7;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-success ml-1" style="border: 2px solid #00c9a7;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span>';
																//$skillMeterTitle="Expert";
															}*/
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
															$htmlData.="</h6></div>";
															$htmlData.="<div class='col-md-2'><h6><a href='javascript:void(0);' title='Remove' class='remove_skill' onclick='removeSkills(".$row['id'].");' style='text-decoration:none;'><i class='fa fa-trash' style='color:red;font-size:16px;'></i></a></h6></div>";
															$htmlData.="</div></div><div class='col-md-1'></div>";
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
								<div class="submit step wizard-step <?php if($onboarding=="resume"){ echo "current"; } ?>" disabled="disabled" style="display: none;">
									<div class="row">
										<div class="col-md-12" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);transition: box-shadow 83ms;background:#fff;padding:10px;margin: 0 0px 10px;border-radius:2px;">
											<h4>Provide your resume to build a strong profile.</h4>
										</div>
										<!--<div class="col-md-4">
											<div class="row" style="padding:15px;">
												<div class="col-md-12" style="border:1px solid gray;border-radius:10px;min-height:350px;max-height:351px;">
													<div class="row">
														<div class="col-md-12">
															<h6 style="padding-bottom:15px;border-bottom:1px solid gray;">Profile Picture</h6>
															<input type="file" name="profile_image" id="profile_image" accept="image/*">
														</div>
													</div>
													<div class="row">
														<div class="col-md-12" id="image_result" style="margin-top:20px;">
															<img src="<?php //echo getUserProfileImage($user_id); ?>" style="width:100%;border-radius:10px;border:1px solid gray;min-height:100px;max-height:200px;" class="img-responsive">
														</div>
													</div>
												</div>
											</div>
										</div>-->
										<div class="col-md-12">
											<div class="row">
												<div class="col-md-12">
													<div class="row">
														<div class="col-md-12">
															<h6>Profile Title*</h6>
															<input type="text" value="<?php echo $row['profile_title']; ?>" placeholder="e.g, Marketing, IT-Software, IT-Hardware, Pharmaceutical etc." class="required form-control" name="profile_title" id="profile_title">
														</div>
													</div>
													<?php
														/*$profile_query="SELECT * FROM users_work_experience WHERE status=1 AND user_id='$user_id' GROUP BY title";
														$profile_result=mysqli_query($conn,$profile_query);
														if(mysqli_num_rows($profile_result)>0)
														{
															?>
															<div class="row">
																<div class="col-md-12">
																	<h6>You can also choose from: </h6>
																</div>
															</div>
															<?php
															while($profile_row=mysqli_fetch_array($profile_result))
															{
																?>
																<div class="col-md-4">
																
																</div>
																<?php
															}
														}*/
													?>
												</div>
											</div>
										</div>
										
										<div class="col-md-6">
											<h6>Resume Headline*</h6>
											<textarea placeholder="Write a short summery about this profile." class="required form-control" name="resume_headline" rows="5" style="min-height:150px;max-height:151px;resize:none;" id="resume_headline"><?php echo $users_personal_row['about']; ?></textarea>
										</div>
										<div class="col-md-6">
											<div class="row" style="padding:15px;">
												<div class="col-md-12" style="border:1px solid gray;border-radius:10px;min-height:150px;max-height:151px;">
													<div class="row">
														<div class="col-md-12">
															<h6 style="padding-bottom:15px;border-bottom:1px solid gray;">Upload&nbsp;&nbsp;
																<select name="video_type" class="required" id="video_type" style="float:right;">
																	<?php
																		$v_query="SELECT * FROM video_types WHERE status=1 AND is_for_user=1";
																		$v_result=mysqli_query($conn,$v_query);
																		if(mysqli_num_rows($v_result)>0)
																		{
																			while($v_row=mysqli_fetch_array($v_result))
																			{
																				?>
																				<option value="<?php echo $v_row['id']; ?>" <?php if("1"==$v_row['id']){ echo 'selected'; } ?>><?php echo $v_row['title']; ?></option>
																				<?php
																			}
																		}
																	?>
																</select>
															</h6>
															<input type="file" name="profile_cv" id="profile_cv" accept=".doc,.docx,.pdf">
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div id="bottom-wizard" style="bottom:-50px !important;">
								<button type="button" name="backward" class="backward" disabled="disabled">Previous </button>
								<button type="button" name="forward" class="forward" id="forward">Next</button>
								<button type="submit" name="process" class="submit" id="final" value="1" disabled="disabled">Continue</button>
								<button onclick="window.location.href='<?php echo base_url; ?>dashboard'" name="skip" class="submit" id="skip" disabled="disabled">Skip</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</main>
	
	<!--<footer id="home" class="clearfix">
		<p>© 2020 RopeYou Connects</p>
	</footer>-->
	<!-- end footer-->
	<!-- Modal terms -->
	<div class="modal fade" id="terms-txt" tabindex="-1" role="dialog" aria-labelledby="termsLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="termsLabel">Terms and conditions</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<p>Lorem ipsum dolor sit amet, in porro albucius qui, in <strong>nec quod novum accumsan</strong>, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
					<p>Lorem ipsum dolor sit amet, in porro albucius qui, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus. Lorem ipsum dolor sit amet, <strong>in porro albucius qui</strong>, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
					<p>Lorem ipsum dolor sit amet, in porro albucius qui, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn_1" data-dismiss="modal">Close</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->

	<!-- Modal info -->
	<div class="modal fade" id="more-info" tabindex="-1" role="dialog" aria-labelledby="more-infoLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="more-infoLabel">Frequently asked questions</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<p>Lorem ipsum dolor sit amet, in porro albucius qui, in <strong>nec quod novum accumsan</strong>, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
					<p>Lorem ipsum dolor sit amet, in porro albucius qui, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus. Lorem ipsum dolor sit amet, <strong>in porro albucius qui</strong>, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
					<p>Lorem ipsum dolor sit amet, in porro albucius qui, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn_1" data-dismiss="modal">Close</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->

	<!-- SCRIPTS -->
	<!-- Jquery-->
	<script src="<?php echo base_url; ?>onboarding-assets/jquery-3.2.1.min.js"></script>
	<!-- Common script -->
	<script src="<?php echo base_url; ?>onboarding-assets/common_scripts_min.js"></script>
	<!-- Wizard script -->
	<script src="<?php echo base_url; ?>onboarding-assets/registration_wizard_func.js"></script>
	<!-- Menu script -->
	<script src="<?php echo base_url; ?>onboarding-assets/velocity.min.js"></script>
	<script src="<?php echo base_url; ?>onboarding-assets/main.js"></script>
	<!-- Theme script -->
	<script src="<?php echo base_url; ?>onboarding-assets/functions.js"></script>
	<script type="text/javascript">
		var base_url="<?php echo base_url; ?>";
		localStorage.setItem("base_url",base_url);
		$("#video_type").change(function(){
			var video_type=parseInt($("#video_type").val());
			if(video_type=="1")
			{
				$("#profile_cv").prop("accept",".doc,.docx,.pdf");
			}
			else if(video_type=="2")
			{
				$("#profile_cv").prop("accept",".mp4");
			}
			else if(video_type=="3")
			{
				$("#profile_cv").prop("accept",".mp4");
			}
			else
			{
				alert("Select valid options only");
			}
		});
		function readURLFromFile(input) {
		  if (input.files && input.files[0]) {
			var reader = new FileReader();
			
			reader.onload = function(e) {
			  $('#image_result').html("<image id='image_to_send' class='img-responsive' src='"+e.target.result+"' style='width:100%;border-radius:10px;border:1px solid gray;min-height:100px;max-height:200px;'>");
			}
			
			reader.readAsDataURL(input.files[0]); 
		  }
		}
		
		$("#profile_image").change(function() {
		  readURLFromFile(this);
		});
		/*-------------------------------------------------------------------------*/
		$("#country").change(function(){
			var base_url=localStorage.getItem('base_url');
			var country=$("#country").val();
			if(country!="")
			{
				$.ajax({
					url:base_url+'getcities',
					data:{country:country},
					type:'post',
					success:function(data)
					{
						var parsedJson=JSON.parse(data);
						$("#home_town").html(parsedJson.htmlData);
					}
				});
			}
			else
			{
				$("home_town").html("<option value=''>Select Country First</option>");
			}
		});
		function saveExperience()
		{
			var base_url=localStorage.getItem('base_url');
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
					data:{work_designation:work_designation,company_name:company_name,work_country:work_country,item_token:work_item_token,work_city:work_city,work_description:work_description,from_day:from_day,from_month:from_month,from_year:from_year,to_day:to_day,to_month:to_month,to_year:to_year,working:working},
					success:function(data)
					{
						var parsedJson=JSON.parse(data);
						if(parsedJson.status=="success")
						{
							$("#work_error_mesg").html(parsedJson.message);
							if($("#work_exp_"+parsedJson.id).length>0)
							{
								$("#work_exp_"+parsedJson.id).remove();
							}
							$("#experience_data_matrix").append(parsedJson.data);
							$("#experience_form").html('');
							$("#experience_form").hide();
						}
						else
						{
							$("#work_error_mesg").html(parsedJson.message);
						}
					}
				});
			}
		}
		function saveEducation()
		{
			var base_url=localStorage.getItem('base_url');
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
					data:{course:course,majors:majors,university:institution_name,edu_country:edu_country,item_token:edu_item_token,edu_city:edu_city,edu_description:edu_description,from_day:from_day,from_month:from_month,from_year:from_year,to_day:to_day,to_month:to_month,to_year:to_year,studying:studying},
					success:function(data)
					{
						var parsedJson=JSON.parse(data);
						if(parsedJson.status=="success")
						{
							$("#edu_error_mesg").html(parsedJson.message);
							if($("#edu_"+parsedJson.id).length>0)
							{
								$("#edu_"+parsedJson.id).remove();
							}
							$("#educational_data_matrix").append(parsedJson.data);
							$("#education_form").html('');
							$("#education_form").hide();
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
			var base_url=localStorage.getItem('base_url');
			$.ajax({
				url:base_url+'get-education-form',
				type:'post',
				data:{item_token:item_token},
				success:function(data){
					$("#education_form").html(data);
					$("#education_form").show();
				}
			});
		}
		function getExperience (item_token="")
		{
			var base_url=localStorage.getItem('base_url');
			$.ajax({
				url:base_url+'get-experience-form',
				type:'post',
				data:{item_token:item_token},
				success:function(data){
					$("#experience_form").html(data);
					$("#experience_form").show();
				}
			});
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
					url:base_url+'getaddskillsformonboarding',
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
	</script>
	<script>
		function saveBasicInformation(event,state)
		{
			var base_url=localStorage.getItem('base_url');
			var gender="Male";
			var first_name=$("#firstname").val().trim();
			var last_name=$("#lastname").val().trim();
			var username=$("#username").val().trim();
			$("#username").val(username);
			var communication_email =$("#communication_email").val().trim();
			var communication_mobile =$("#communication_mobile").val().trim();
			var day_birth =$("#day_birth").val().trim();
			var month_birth =$("#month_birth").val().trim();
			var year_birth =$("#year_birth").val().trim();
			var phonecode =$("#phonecode").val().trim();
			var mobile_visibility =$("#mobile_visibility").val().trim();
			if($("#male").is(":checked"))
			{
				gender="Male";
			}
			else
			{
				gender="Female";
			}
			if(username=="" || first_name=="" || last_name=="" || communication_email=="" || communication_mobile=="" || day_birth=="" || month_birth=="" || year_birth=="" || phonecode=="")
			{
				$("#basic_error").html('Please Fill All Required Fields');
				return false;
			}
			else
			{
				$("#basic_error").html('');
				$.ajax({
					url:base_url+'savebasicprofile',
					type:'post',
					data:{mobile_visibility:mobile_visibility,gender:gender,first_name:first_name,last_name:last_name,username:username,communication_email:communication_email,communication_mobile:communication_mobile,phonecode:phonecode,day_birth:day_birth,month_birth:month_birth,year_birth:year_birth},
					success:function(data){
						var parsedJson=JSON.parse(data);
						if(parsedJson.status=="success")
						{
							$("#basic_error").html(parsedJson.message);
							return true;
						}
						else 
						{
							$("#basic_error").html(parsedJson.message);
							$(".backward").click();
							return false;
						}
					}
				});
			}
		}
		function saveAboutInformation(event,state)
		{
			var base_url=localStorage.getItem('base_url');
			var about=$("#about").val().trim();
			var relocate_abroad=$("#relocate_abroad").val().trim();
			var passport=$("#passport").val().trim();
			var country=$("#country").val().trim();
			var pincode=$("#pincode").val().trim();
			var city =$("#home_town").val().trim();
			var address =$("#address").val().trim();
			
			if(about=="" || relocate_abroad=="" || passport=="" || country=="" || city=="" || address=="" || pincode=="")
			{
				$("#about_error").html('Please Fill All Required Fields');
				return false;
			}
			else
			{
				$("#about_error").html('');
				$.ajax({
					url:base_url+'saveaboutprofile',
					type:'post',
					data:{about:about,relocate_abroad:relocate_abroad,passport:passport,country:country,city:city,address:address,pincode:pincode},
					success:function(data){
						var parsedJson=JSON.parse(data);
						if(parsedJson.status=="success")
						{
							$("#about_error").html('Data Saved Successfully');
							return true;
						}
						else 
						{
							$("#about_error").html(parsedJson.message);
							$(".backward").click();
							return false;
						}
					}
				});
			}
		}
	</script>
</body></html>