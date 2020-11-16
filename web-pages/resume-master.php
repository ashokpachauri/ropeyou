<?php
	include_once '../connection.php';
	define("base_url","https://ropeyou.com/");
	define("resume_dir","web-pages/");
	define("sub_dir_simple","web-pages/simple/");
	$_WEB_STEP=false;
	if(isset($_REQUEST['step']) && $_REQUEST['step']!="")
	{
		$_WEB_STEP=$_REQUEST['step'];
	}
	$EXP_SKIPPED=false;
	$ACH_SKIPPED=false;
	if(isset($_SESSION['es']) && $_SESSION['es']==1)
	{
		$EXP_SKIPPED=true;
	}
	if(isset($_SESSION['as']) && $_SESSION['as']==1)
	{
		$ACH_SKIPPED=true;
	}
	$_WEB_AUTHOR_ABOUT="";
	$_WEB_MENU=array();
	$_WEB_EXP=array();
	$_WEB_EDU=array();
	$_WEB_COLOR=false;
	$_WEB_THEME=false;
	$_WEB_TEMPLATE_ID="1/";
	$_username=$_REQUEST['__username'];
	$_id=null;
	$_users_query="SELECT * FROM users WHERE username='".$_username."'";
	$_users_result=$conn->query($_users_query);
	if(!mysqli_num_rows($_users_result)>0)
	{
		include_once '../404.php';
		die();
	}
	$_users_row=mysqli_fetch_array($_users_result);
	$_id=$_users_row['id'];
	
	
	if($_id!=$_COOKIE['uid'])
	{
		include_once '../404.php';
		die();
	}
	function getIformation($form,$_username,$step)
	{
		$conn=mysqli_connect($GLOBALS['DBHOST'],$GLOBALS['DBUSERNAME'],$GLOBALS['DBPASSWORD'],$GLOBALS['DBNAME']);
		//include '../connection.php';
		if($form=="About")
		{
			$user_id=$_COOKIE['uid'];
			$query="SELECT * FROM users WHERE id='$user_id'";
			$result=mysqli_query($conn,$query);
			$row=mysqli_fetch_array($result);
			
			$users_personal_query="SELECT * FROM users_personal WHERE user_id='$user_id'";
			$users_personal_result=mysqli_query($conn,$users_personal_query);
			$users_personal_row=mysqli_fetch_array($users_personal_result);
			?>
			<!DOCTYPE HTML>
			<html>
				<title>Add Profile Summary to the resume / CV :: RUResume</title>
				<?php //include_once '../head.php'; ?>
				<link rel="stylesheet" href="<?php echo base_url; ?>css/bootstrap.min.css" />
				<link rel="stylesheet" href="<?php echo base_url; ?>css/style.css" />
				<link rel="stylesheet" href="<?php echo base_url; ?>css/ionicons.min.css" />
				<link rel="stylesheet" href="<?php echo base_url; ?>css/font-awesome.min.css" />
				<link href="<?php echo base_url; ?>css/emoji.css" rel="stylesheet">
				
				<!--Google Font-->
				<link href="<?php echo base_url; ?>css/css0b81.css?family=Lato:300,400,400i,700,700i" rel="stylesheet">
				<!--Favicon-->
				<link rel="shortcut icon" type="image/png" href="<?php echo base_url; ?>images/fav.png"/>
				<body>
					<div class="container">
						<div id="page-contents">
							<div class="row">
								<div class="col-md-1"></div>
								<div class="col-md-10">
									<h2 style="text-align:center;padding:10px;">Write about yourself to describe in the resume</h2>
									<form name="basic-info" id="basic_info_2" class="form-inline" action="<?php echo base_url; ?>update-basic-profile" method="post">
										<div class="edit-profile-container" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);transition: box-shadow 83ms;background:#fff;padding:10px;margin: 0 0px 10px;border-radius:2px;">
											<div class="block-title">
												<h4 class="grey"><i class="icon ion-android-checkmark-circle"></i>Basic Information</h4>
												<div class="line"></div>
											</div>
											<div class="edit-block">
												<div class="row">
													<div class="form-group col-xs-4">
														<label for="first_name">First name</label>
														<input id="first_name" class="form-control input-group-lg" type="text" name="first_name" title="Enter first name" placeholder="First name" value="<?php echo $row['first_name']; ?>" />
													</div>
													<div class="form-group col-xs-4">
														<label for="last_name" class="">Last name</label>
														<input id="last_name" class="form-control input-group-lg" type="text" name="last_name" title="Enter last name" placeholder="Last name" value="<?php echo $row['last_name']; ?>" />
													</div>
													<div class="form-group col-xs-4">
														<label for="username">Username</label>
														<input id="username" class="form-control input-group-lg" type="text" name="username" title="Username" placeholder="Username" value="<?php echo $row['username']; ?>" />
													</div>
												</div>
												<div class="form-group gender">
													<span class="custom-label"><strong>I am a: </strong></span>
													<label class="radio-inline">
														<input type="radio" name="gender" checked value="Male">Male
													</label>
													<label class="radio-inline">
														<input type="radio" name="gender" value="Female" <?php if("Female"==$users_personal_row['gender']){ echo "checked"; } ?>>Female
													</label>
												</div>
												<div class="row">
													<div class="col-xs-12 col-sm-4">
														<div class="row">
															<p class="custom-label"><strong>Date of Birth</strong></p>
															<div class="form-group col-sm-4 col-xs-6">
																<label for="month" class="sr-only"></label>
																<select class="form-control" id="day" name="day_birth">
																	<option>Day</option>
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
															<div class="form-group col-sm-4 col-xs-6">
																<label for="month" class="sr-only"></label>
																<select class="form-control" id="month" name="month_birth">
																	<option value="">Month</option>
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
															<div class="form-group col-sm-4 col-xs-12">
																<label for="year" class="sr-only"></label>
																<select class="form-control" id="year" name="year_birth">
																	<option value="">Year</option>
																	<?php
																		for($i=2019;$i>=1930;$i--)
																		{
																			?>
																			<option value="<?php echo $i; ?>" <?php if($i==$users_personal_row['year_birth']){ echo "selected"; } ?>><?php echo $i; ?></option>
																			<?php
																		}
																	?>
																</select>
															</div>
														</div>
													</div>
													<div class="form-group col-xs-12 col-sm-4">
														<label for="address">Address</label>
														<input id="address" required class="form-control input-group-lg" type="text" name="address" title="Enter first name" placeholder="e.g, John Villa, Los Vegas" value="<?php echo $users_personal_row['address']; ?>" />
													</div>
													<div class="form-group col-xs-12 col-sm-4">
														<label for="communication_email">Communication Email</label>
														<input id="communication_email" class="form-control input-group-lg" type="text" name="communication_email" title="Enter Communication Email" required placeholder="e.g, john@mailserver.com" value="<?php echo $users_personal_row['communication_email']; ?>" />
													</div>
													<div class="form-group col-xs-12 col-sm-4">
														<label for="communication_mobile">Communication Phone</label>
														<input id="communication_mobile" class="form-control input-group-lg" type="text" name="communication_mobile" title="Enter Communication Phone" required placeholder="e.g, +91 9876 5432 10" value="<?php echo $users_personal_row['communication_mobile']; ?>" />
													</div>
													<div class="form-group col-xs-12 col-sm-4">
														<label for="passport">Passport Status</label>
														<input id="passport" class="form-control input-group-lg" type="text" name="passport" title="Enter Passport Status" placeholder="e.g, Indian Passport" required value="<?php echo $users_personal_row['passport']; ?>" />
													</div>
													<div class="form-group col-xs-12 col-sm-4">
														<label for="relocate_abroad">Relocate Abroad?</label>
														<select id="relocate_abroad" name="relocate_abroad" title="let us know if you are ready or not to relocate to abroad?" class="form-control input-group-lg" required>
															<option value="0" <?php if($users_personal_row['relocate_abroad']=="0" || $users_personal_row['relocate_abroad']==""){ echo "selected"; } ?>>Can not relocate outside home town</option>
															<option value="1" <?php if($users_personal_row['relocate_abroad']=="1"){ echo "selected"; } ?>>Can Relocate within home country</option>
															<option value="2" <?php if($users_personal_row['relocate_abroad']=="2"){ echo "selected"; } ?>>Can Relocate worldwide</option>
														</select>
													</div>
													<div class="form-group col-xs-12 col-sm-4">
														<label for="city"> Home Town</label>
														<input id="city" required class="form-control input-group-lg" type="text" name="home_town" title="Enter city" placeholder="Your city" value="<?php echo $users_personal_row['home_town']; ?>"/>
													</div>
													<div class="form-group col-xs-12 col-sm-4">
														<label for="country">My country</label>
														<select class="form-control" id="country" name="country" required>
															<option value="">Country</option>
															<?php
																$c_query="SELECT * FROM country WHERE status=1";
																$c_result=mysqli_query($conn,$c_query);
																while($c_row=mysqli_fetch_array($c_result))
																{
																	?>
																	<option value="<?php echo $c_row['code']; ?>" <?php if(strtolower($c_row['code'])==strtolower($users_personal_row['country'])){ echo "selected"; } ?>><?php echo htmlentities($c_row['title']); ?></option>
																	<?php
																}
															?>
														</select>
													</div>
												</div>
												<div class="row">
													<div class="form-group col-xs-12">
														<textarea id="my-info" name="about" class="form-control" placeholder="Some texts about yourself" rows="8" cols="400"><?php echo $users_personal_row['about']; ?></textarea>
													</div>
												</div>
												<input type="hidden" name="page_refer" value="resume/<?php echo $_username; ?>">
												<div class="line"></div>
												<button type="submit" class="btn btn-primary" value="Save Changes" name="save_basic_profile_and_about" id="save_basic_profile_and_about">Save & Continue To Resume</button>
											</div>
										
										</div>
									</form>
								</div>
								<div class="col-md-1"></div>
							</div>
						</div>
					</div>
					<?php //include_once '../footer.php'; ?>
					<script src="<?php echo base_url; ?>js/jquery-3.1.1.min.js"></script>
					<script src="<?php echo base_url; ?>js/bootstrap.min.js"></script>
					<script src="<?php echo base_url; ?>js/jquery.sticky-kit.min.js"></script>
					<script src="<?php echo base_url; ?>js/jquery.scrollbar.min.js"></script>
					<script src="<?php echo base_url; ?>js/script.js"></script>
					<script src="https://cdn.tiny.cloud/1/uvg9xyxkcmqkpjaacpgnzrroxnefi5c72vf0k2u5686rwdmv/tinymce/5/tinymce.min.js"></script>
					<script>tinymce.init({selector:'textarea',height:320,branding:false});</script>
				</body>
			</html>
			<?php
		}
		else if($form=="Education")
		{
			?>
			<!DOCTYPE HTML>
			<html>
				<title>Add Education to the Resume / CV :: RUResume</title>
				<?php //include_once '../head.php'; ?>
				
				<link rel="stylesheet" href="<?php echo base_url; ?>css/bootstrap.min.css" />
				<link rel="stylesheet" href="<?php echo base_url; ?>css/style.css" />
				<link rel="stylesheet" href="<?php echo base_url; ?>css/ionicons.min.css" />
				<link rel="stylesheet" href="<?php echo base_url; ?>css/font-awesome.min.css" />
				<link href="<?php echo base_url; ?>css/emoji.css" rel="stylesheet">
				
				<!--Google Font-->
				<link href="<?php echo base_url; ?>css/css0b81.css?family=Lato:300,400,400i,700,700i" rel="stylesheet">
				<!--Favicon-->
				<link rel="shortcut icon" type="image/png" href="<?php echo base_url; ?>images/fav.png"/>
				<link href="<?php echo base_url; ?>css/select2.min.css" rel="stylesheet" />
				<body>
					<div class="container">
						<div id="page-contents">
							<div class="row">
								<div class="col-md-1"></div>
								<div class="col-md-10" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);transition: box-shadow 83ms;background:#fff;padding:10px;margin: 0 0px 10px;border-radius:2px;">
									<h2 style="text-align:center;padding:10px;">Add some education to the resume</h2>
									<form name="education" id="education_form_0" class="form-inline" method="post" action="<?php echo base_url; ?>update-user-education">
										<input type="hidden" name="page_refer" value="resume/<?php echo $_username; ?>">
										<div class="row">
											<div class="form-group col-xs-4">
												<label for="title">Class / Degree</label>
												<input id="title" class="form-control input-group-lg" type="text" name="title" title="Class / Degree" placeholder="Class / Degree"/>
											</div>
											<div class="form-group col-xs-4">
												<label for="school">School / University</label>
												<input id="school" class="form-control input-group-lg" type="text" name="school" title="Enter School / University" placeholder="School / University"/>
											</div>
											<div class="form-group col-xs-4">
												<label for="edu-city">City/Town</label>
												<select class="js-example-basic-single input-group-lg" name="city" id="edu-city" required style="width:97%;">
													<?php
														$get_country_query="SELECT city.*,country.title as country_title FROM city INNER JOIN country ON country.id=city.country WHERE city.status=1 AND country.status=1 ORDER BY city.country,city.title";
														$get_country_result=mysqli_query($conn,$get_country_query);
														if(mysqli_num_rows($get_country_result)>0)
														{
															$current_country="";
															$get_country_row=mysqli_fetch_array($get_country_result);
															do{
																if($current_country!=$get_country_row['country_title'])
																{
																	if($current_country!="")
																	{
																		?>
																		</optgroup>
																		<?php
																	}
																	?>
																	<optgroup label="<?php echo $get_country_row['country_title']; ?>">
																	<?php
																}
																?>
																	<option value="<?php echo $get_country_row['id']; ?>"><?php echo $get_country_row['title']; ?></option>
																<?php
																$current_country=$get_country_row['country_title'];
															}while($get_country_row=mysqli_fetch_array($get_country_result));
															?>
															</optgroup>
															<?php
														}
													?>
												</select>
											</div>
										</div>	
										<div class="row">
											<div class="form-group col-sm-3">
												<label for="from_month">From Month</label>
												<select class="form-control" id="from_month" name="from_month">
													<option value="">Month</option>
													<?php
														for($i=1;$i<=12;$i++)
														{
															?>
															<option value="<?php echo $i; ?>"><?php echo print_month($i); ?></option>
															<?php
														}
													?>
												</select>
											</div>
											<div class="form-group col-sm-3">
												<label for="from_year">From Year</label>
												<select class="form-control" id="from_year" name="from_year">
													<option value="">Year</option>
													<?php
														for($i=2019;$i>=1930;$i--)
														{
															?>
															<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
															<?php
														}
													?>
												</select>
											</div>
											<div class="form-group col-sm-3">
												<label for="to_month">To Month</label>
												<select class="form-control" id="to_month" name="to_month">
													<option value="">Month</option>
													<?php
														for($i=1;$i<=12;$i++)
														{
															?>
															<option value="<?php echo $i; ?>"><?php echo print_month($i); ?></option>
															<?php
														}
													?>
												</select>
											</div>
											<div class="form-group col-sm-3">
												<label for="to_year">To Year</label>
												<select class="form-control" id="to_year" name="to_year">
													<option value="">Year</option>
													<?php
														for($i=2019;$i>=1930;$i--)
														{
															?>
															<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
															<?php
														}
													?>
												</select>
											</div>
										</div>
										<div class="row">
											<div class="form-group col-xs-12">
												<label for="edu-description">Description</label>
												<textarea id="edu-description" name="description" class="form-control" placeholder="Description goes here..." rows="4" cols="400"></textarea>
											</div>
										</div>
										<div class="row">
											<div class="form-group col-xs-6">
												<div class="settings-block">
													<div class="row">
														<div class="col-sm-9">
															<div class="switch-description">
																<div><strong>Graduated?:</strong></div>
																<p>Enable this if you have been awarded a degree</p>
															</div>
														</div>
														<div class="col-sm-3">
															<div class="toggle-switch">
															<label class="switch">
																<input type="checkbox" name="graduate" id="graduate" value="1" checked>
																<span class="slider round"></span>
															</label>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="form-group col-xs-6">
												<div class="settings-block">
													<div class="row">
														<div class="col-sm-9">
															<div class="switch-description">
																<div><strong>Share?:</strong></div>
																<p>Enable this if you wish to share this within your Bridge elements.</p>
															</div>
														</div>
														<div class="col-sm-3">
															<div class="toggle-switch">
															<label class="switch">
																<input type="checkbox" name="show_pref" id="share" value="1" checked>
																<span class="slider round"></span>
															</label>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<button class="btn btn-primary" type="submit" name="save_education">Save & Continue to Resume</button>
									</form>
								</div>
								<div class="col-md-1"></div>
							</div>
						</div>
					</div>
					<script src="<?php echo base_url; ?>js/jquery-3.1.1.min.js"></script>
					<script src="<?php echo base_url; ?>js/bootstrap.min.js"></script>
					<script src="<?php echo base_url; ?>js/jquery.sticky-kit.min.js"></script>
					<script src="<?php echo base_url; ?>js/jquery.scrollbar.min.js"></script>
					<script src="<?php echo base_url; ?>js/script.js"></script>

					<?php //include_once '../footer.php'; ?> 
					<script src="<?php echo base_url; ?>js/select2.min.js"></script>
					<script src="https://cdn.tiny.cloud/1/uvg9xyxkcmqkpjaacpgnzrroxnefi5c72vf0k2u5686rwdmv/tinymce/5/tinymce.min.js"></script>
					<script>tinymce.init({selector:'textarea',height:320,branding:false});</script>
					<script>
						$(document).ready(function() {
							$('.js-example-basic-single').select2();
						});
					</script>
				</body>
			</html>
			<?php
		}
		else if($form=="Experience")
		{
			?>
			<!DOCTYPE HTML>
			<html>
				<title>Add Experience to the Resume / CV :: RUResume</title>
				<?php //include_once '../head.php'; ?>
				<link rel="stylesheet" href="<?php echo base_url; ?>css/bootstrap.min.css" />
				<link rel="stylesheet" href="<?php echo base_url; ?>css/style.css" />
				<link rel="stylesheet" href="<?php echo base_url; ?>css/ionicons.min.css" />
				<link rel="stylesheet" href="<?php echo base_url; ?>css/font-awesome.min.css" />
				<link href="<?php echo base_url; ?>css/emoji.css" rel="stylesheet">
				
				<!--Google Font-->
				<link href="<?php echo base_url; ?>css/css0b81.css?family=Lato:300,400,400i,700,700i" rel="stylesheet">
				<!--Favicon-->
				<link rel="shortcut icon" type="image/png" href="<?php echo base_url; ?>images/fav.png"/>
				<link href="<?php echo base_url; ?>css/select2.min.css" rel="stylesheet" />
				<body>
					<div class="container">
						<div id="page-contents">
							<div class="row">
								<div class="col-md-1"></div>
								<div class="col-md-10" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);transition: box-shadow 83ms;background:#fff;padding:10px;margin: 0 0px 10px;border-radius:2px;">
									<h2 style="text-align:center;padding:10px;">Add some experience to the resume</h2>
									<form name="work" id="work_0" class="form-inline" action="<?php echo base_url; ?>update-user-experience" method="post">
										<div class="row">
											<input type="hidden" name="page_refer" value="resume/<?php echo $_username; ?>">
											<div class="form-group col-xs-4">
												<label for="company">Company</label>
												<input id="company" class="form-control input-group-lg" type="text" name="company" title="Your Company" placeholder="Your Company" value="" />
											</div>
											<div class="form-group col-xs-4">
												<label for="designation">Designation</label>
												<input id="designation" class="form-control input-group-lg" type="text" name="designation" title="Your designation in company" placeholder="Your designation in company" value="" />
											</div>
											<div class="form-group col-xs-4">
												<label for="work-city1">City/Town</label>
												<select class="js-example-basic-single input-group-lg" name="city" id="work-city1" style="width:97%;">
													<?php
														$get_country_query="SELECT city.*,country.title as country_title FROM city INNER JOIN country ON country.id=city.country WHERE city.status=1 AND country.status=1 ORDER BY city.country,city.title";
														$get_country_result=mysqli_query($conn,$get_country_query);
														if(mysqli_num_rows($get_country_result)>0)
														{
															$current_country="";
															$get_country_row=mysqli_fetch_array($get_country_result);
															do{
																if($current_country!=$get_country_row['country_title'])
																{
																	if($current_country!="")
																	{
																		?>
																		</optgroup>
																		<?php
																	}
																	?>
																	<optgroup label="<?php echo $get_country_row['country_title']; ?>">
																	<?php
																}
																?>
																	<option value="<?php echo $get_country_row['id']; ?>"><?php echo $get_country_row['title']; ?></option>
																<?php
																$current_country=$get_country_row['country_title'];
															}while($get_country_row=mysqli_fetch_array($get_country_result));
															?>
															</optgroup>
															<?php
														}
													?>
												</select>
											</div>
										</div>
										<div class="row">
											<div class="form-group col-sm-3">
												<label for="from_month">From Month</label>
												<select class="form-control" id="from_month"  name="from_month">
													<option value="">Month</option>
													<?php
														for($i=1;$i<=12;$i++)
														{
															?>
															<option value="<?php echo $i; ?>"><?php echo print_month($i); ?></option>
															<?php
														}
													?>
												</select>
											</div>
											<div class="form-group col-sm-3">
												<label for="from_year">From Year</label>
												<select class="form-control" id="from_year" name="from_year">
													<option value="">Year</option>
													<?php
														for($i=2019;$i>=1930;$i--)
														{
															?>
															<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
															<?php
														}
													?>
												</select>
											</div>
											<div class="form-group col-sm-3">
												<label for="to_month">To Month</label>
												<select class="form-control" id="to_month" name="to_month">
													<option value="">Month</option>
													<?php
														for($i=1;$i<=12;$i++)
														{
															?>
															<option value="<?php echo $i; ?>"><?php echo print_month($i); ?></option>
															<?php
														}
													?>
												</select>
											</div>
											<div class="form-group col-sm-3">
												<label for="to_year">To Year</label>
												<select class="form-control" id="to_year" name="to_year">
													<option value="">Year</option>
													<?php
														for($i=2019;$i>=1930;$i--)
														{
															?>
															<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
															<?php
														}
													?>
												</select>
											</div>
										</div>
										<div class="row">
											<div class="form-group col-xs-12">
												<label for="edu-description">Description</label>
												<textarea id="edu-description" name="description" class="form-control" placeholder="Description goes here..." rows="4" cols="400"></textarea>
											</div>
										</div>
										<div class="row">
											<div class="form-group col-xs-12">
												<div class="settings-block">
													<div class="row">
														<div class="col-sm-9">
															<div class="switch-description">
																<div><strong>I work here?</strong></div>
																<p>Enable this if you currently working here.</p>
															</div>
														</div>
														<div class="col-sm-3">
															<div class="toggle-switch">
															<label class="switch">
																<input type="checkbox" name="working" id="working" value="1" checked>
																<span class="slider round"></span>
															</label>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="form-group col-xs-12">
												<div class="settings-block">
													<div class="row">
														<div class="col-sm-9">
															<div class="switch-description">
																<div><strong>Share?:</strong></div>
																<p>Enable this if you wish to share this within your Bridge elements.</p>
															</div>
														</div>
														<div class="col-sm-3">
															<div class="toggle-switch">
															<label class="switch">
																<input type="checkbox" name="show_pref" id="share" value="1" checked>
																<span class="slider round"></span>
															</label>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<button class="btn btn-primary" type="submit" name="continue_to_resume">Save & Continue to Resume</button>
										
									</form>
								</div>
								<div class="col-md-1"></div>
							</div>
						</div>
					</div>
					<?php //include_once '../footer.php'; ?> 
					<script src="<?php echo base_url; ?>js/jquery-3.1.1.min.js"></script>
					<script src="<?php echo base_url; ?>js/bootstrap.min.js"></script>
					<script src="<?php echo base_url; ?>js/jquery.sticky-kit.min.js"></script>
					<script src="<?php echo base_url; ?>js/jquery.scrollbar.min.js"></script>
					<script src="<?php echo base_url; ?>js/script.js"></script>
					<script src="<?php echo base_url; ?>js/select2.min.js"></script>
					<script src="https://cdn.tiny.cloud/1/uvg9xyxkcmqkpjaacpgnzrroxnefi5c72vf0k2u5686rwdmv/tinymce/5/tinymce.min.js"></script>
					<script>tinymce.init({selector:'textarea',height:320,branding:false});</script>
					<script>
						$(document).ready(function() {
							$('.js-example-basic-single').select2();
						});
					</script>
				</body>
			</html>
			<?php
		}
		else if($form=="Interests")
		{
			?>
			<!DOCTYPE HTML>
			<html>
				<title>Add Interests & Hobbies to the Resume / CV :: RUResume</title>
				<?php //include_once '../head.php'; ?>
				<link rel="stylesheet" href="<?php echo base_url; ?>css/bootstrap.min.css" />
				<link rel="stylesheet" href="<?php echo base_url; ?>css/style.css" />
				<link rel="stylesheet" href="<?php echo base_url; ?>css/ionicons.min.css" />
				<link rel="stylesheet" href="<?php echo base_url; ?>css/font-awesome.min.css" />
				<link href="<?php echo base_url; ?>css/emoji.css" rel="stylesheet">
				
				<!--Google Font-->
				<link href="<?php echo base_url; ?>css/css0b81.css?family=Lato:300,400,400i,700,700i" rel="stylesheet">
				<!--Favicon-->
				<link rel="shortcut icon" type="image/png" href="<?php echo base_url; ?>images/fav.png"/>
				<link href="<?php echo base_url; ?>css/select2.min.css" rel="stylesheet" />
				<body>
					<div class="container">
						<div id="page-contents">
							<div class="row">
								<div class="col-md-1"></div>
								<div class="col-md-10" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);transition: box-shadow 83ms;background:#fff;padding:10px;margin: 0 0px 10px;border-radius:2px;">
									<h2 style="text-align:center;padding:10px;">Add Interests & Hobbies to the resume</h2>
										<div class="edit-profile-container">
											<div class="edit-block">
												<?php
													$selected_i=array();
													$interests_query="SELECT users_interests.id,users_interests.title,interests.title as interest,interests.icon FROM users_interests INNER JOIN interests ON interests.id=users_interests.title WHERE users_interests.user_id='".$_COOKIE['uid']."'";
													$interests_result=mysqli_query($conn,$interests_query);
													if(mysqli_num_rows($interests_result)>0)
													{
														while($interests_row=mysqli_fetch_array($interests_result))
														{
															$selected_i[]=$interests_row['title'];
															
														}
													}
												?>
												<div class="row">
													<form action="<?php echo base_url.'update-profile-interests'; ?>" method="post">
														<p class="custom-label" style="margin-top:5px;margin-bottom:5px;"><strong style="font-size:18px;">Try from dropdown <i class="fa fa-smile-o"></i></strong></p>
														<div class="form-group col-sm-12">
															<input type="hidden" name="page_refer" value="resume/<?php echo $_username; ?>">
															<select id="interests" name="interests[]" class="form-control" multiple="multiple">
																<optgroup label="Interests. For example, photography">
																<?php
																	$list_query="SELECT id,title,icon FROM interests WHERE status=1";
																	$list_result=mysqli_query($conn,$list_query);
																	if(mysqli_num_rows($list_result)>0)
																	{
																		while($list_row=mysqli_fetch_array($list_result))
																		{
																			?>
																				<option value="<?php echo $list_row['id']; ?>" <?php if(in_array($list_row['id'],$selected_i)){ echo "selected"; } ?>><?php echo $list_row['title']; ?></option>
																			<?php
																		}
																	}
																?>
																</optgroup>
															</select>
														</div>
														<div class="form-group col-sm-12">
															<button class="btn btn-primary" style="width:100%;" name="update_all" type="submit">Save & Continue to Resume</button>
														</div>
													</form>
												</div>
												<div class="row">
													<form action="<?php echo base_url.'update-profile-interests'; ?>" method="post">
														<p class="custom-label" style="margin-top:5px;margin-bottom:5px;"><strong style="font-size:18px;">Wants to add Custom <i class="fa fa-pencil"></i></strong></p>
														<div class="form-group col-sm-12">
															<input type="hidden" name="page_refer" value="resume/<?php echo $_username; ?>">
															<input type="text" id="interest" name="interest" class="form-control" required>
														</div>
														<div class="form-group col-sm-12">
														  <button class="btn btn-primary" name="update_single" type="submit">Save & Continue to Resume</button>
														</div>
													</form>
												</div>
											  <div class="line"></div>
											</div>
										  </div>
									</form>
								</div>
								<div class="col-md-1"></div>
							</div>
						</div>
					</div>
					<?php //include_once '../footer.php'; ?> 
					<script src="<?php echo base_url; ?>js/jquery-3.1.1.min.js"></script>
					<script src="<?php echo base_url; ?>js/bootstrap.min.js"></script>
					<script src="<?php echo base_url; ?>js/jquery.sticky-kit.min.js"></script>
					<script src="<?php echo base_url; ?>js/jquery.scrollbar.min.js"></script>
					<script src="<?php echo base_url; ?>js/script.js"></script>
					<script src="<?php echo base_url; ?>js/select2.min.js"></script>
					<script src="https://cdn.tiny.cloud/1/uvg9xyxkcmqkpjaacpgnzrroxnefi5c72vf0k2u5686rwdmv/tinymce/5/tinymce.min.js"></script>
					<script>tinymce.init({selector:'textarea',height:320,branding:false});</script>
					<script>
						$(document).ready(function() {
							$('#interests').select2();
						});
					</script>
				</body>
			</html>
			<?php
		}
		else if($form=="Acheivements")
		{
			?>
			<!DOCTYPE HTML>
			<html>
				<title>Add Acheivements to the Resume / CV :: RUResume</title>
				<?php //include_once '../head.php'; ?>
				<link rel="stylesheet" href="<?php echo base_url; ?>css/bootstrap.min.css" />
				<link rel="stylesheet" href="<?php echo base_url; ?>css/style.css" />
				<link rel="stylesheet" href="<?php echo base_url; ?>css/ionicons.min.css" />
				<link rel="stylesheet" href="<?php echo base_url; ?>css/font-awesome.min.css" />
				<link href="<?php echo base_url; ?>css/emoji.css" rel="stylesheet">
				<link href="<?php echo base_url; ?>fileuploader/dist/font/font-fileuploader.css" rel="stylesheet">
				<link href="<?php echo base_url; ?>fileuploader/dist/jquery.fileuploader.min.css" media="all" rel="stylesheet">
				<link href="<?php echo base_url; ?>fileuploader/examples/thumbnails/css/jquery.fileuploader-theme-thumbnails.css" media="all" rel="stylesheet">
				<!--Google Font-->
				<link href="<?php echo base_url; ?>css/css0b81.css?family=Lato:300,400,400i,700,700i" rel="stylesheet">
				<!--Favicon-->
				<link rel="shortcut icon" type="image/png" href="<?php echo base_url; ?>images/fav.png"/>
				<link href="<?php echo base_url; ?>css/select2.min.css" rel="stylesheet" />
				<body>
					<section style="padding:2%;">
						<div id="page-contents">
							<div class="row">
								<div class="col-md-12" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);transition: box-shadow 83ms;background:#fff;padding:10px;margin: 0 0px 10px;border-radius:2px;">
									<h2 style="text-align:center;padding:10px;">Add Acheivements to the resume</h2>
									<form name="service_form" id="service_form" method="post" action="<?php echo base_url; ?>php/addAchievements.php" class="form-inline" enctype="multipart/form-data">
										<div class="row">
											<div class="col-md-4">
												<div class="row">
													<div class="col-md-12 form-group">
														<label for="award">Achievement Title</label>
														<input id="award" required class="form-control input-group-lg" type="text" name="award" title="Enter Achievement" placeholder="e.g, Paper Published" value="" />
														<input type="hidden" name="page_refer" value="resume/<?php echo $_username; ?>">
														<input type="hidden" name="award_id" value="">
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 form-group">
														<label for="media_uploader">Achievement Image</label>
														<input id="media_uploader" required class="form-control input-group-lg" type="file" name="media_uploader" title="Choose Image File"/>
													</div>
												</div>
											</div>
											<div class="col-md-8">
												<div class="row">
													<div class="col-md-12 form-group">
														<label for="description">Description</label>
														<textarea id="description" name="description" class="form-control" placeholder="Some texts about your achievement" rows="4" cols="400"></textarea>
													</div>
												</div>
											</div>
										</div>
										<button class="btn btn-info" name="Save" value="1">Save & Continue To Resume</button>
										<a href="<?php echo base_url; ?>php/addAchievements.php?Escape=<?php echo $_username; ?>" class="btn btn-danger">Skip & Continue To Resume</a>
									</form>
								</div>
							</div>
						</div>
					</section>
					<?php //include_once '../footer.php'; ?> 
					<script src="<?php echo base_url; ?>js/jquery-3.1.1.min.js"></script>
					<script src="<?php echo base_url; ?>js/bootstrap.min.js"></script>
					<script src="<?php echo base_url; ?>js/jquery.sticky-kit.min.js"></script>
					<script src="<?php echo base_url; ?>js/jquery.scrollbar.min.js"></script>
					<script src="<?php echo base_url; ?>js/script.js"></script>
					<script src="<?php echo base_url; ?>js/select2.min.js"></script>
					<script src="<?php echo base_url; ?>fileuploader/dist/jquery.fileuploader.min.js" type="text/javascript"></script>
					<script src="<?php echo base_url; ?>fileuploader/examples/thumbnails/js/custom.js" type="text/javascript"></script>
					<script src="https://cdn.tiny.cloud/1/uvg9xyxkcmqkpjaacpgnzrroxnefi5c72vf0k2u5686rwdmv/tinymce/5/tinymce.min.js"></script>
					<script>tinymce.init({selector:'textarea',height:320,branding:false});</script>
					<script>
						$(document).ready(function() {
							$('#interests').select2();
						});
					</script>
				</body>
			</html>
			<?php
		}
	}
	/*------------------------ThemeInfo--------------------------------------------------------
	=========================================================================================*/
	$_theme_selected=false;
	$_theme_color_selected=false;
	$_theme_settings_query="SELECT * FROM users_web_theme_settings WHERE user_id='$_id'";
	$_theme_settings_result=$conn->query($_theme_settings_query);
	if(mysqli_num_rows($_theme_settings_result)>0)
	{
		$_theme_settings_row=mysqli_fetch_array($_theme_settings_result);
		$_theme_selected=$_theme_settings_row['theme_id'];
		$_theme_color_selected=$_theme_settings_row['color_id'];
	}
	if(!$_theme_selected)
	{
		$_theme_query="SELECT * FROM web_themes WHERE status=1 AND is_default=1";
		$_theme_result=$conn->query($_theme_query);
		if(mysqli_num_rows($_theme_result))
		{
			$_theme_row=mysqli_fetch_array($_theme_result);
			$_theme_selected=$_theme_row['id'];
			$_WEB_THEME=$_theme_row;
			$_color_query="SELECT * FROM web_themes_colors WHERE status=1 AND theme_id='$_theme_selected' AND is_default=1";
			$_color_result=$conn->query($_color_query);
			if(mysqli_num_rows($_color_result))
			{
				$_color_row=mysqli_fetch_array($_color_result);
				$_theme_color_selected=$_color_row['id'];
				$_WEB_COLOR=$_color_row;
			}
			else
			{
				$_color_query="SELECT * FROM web_themes_colors WHERE id=1";
				$_color_result=$conn->query($_color_query);
				$_color_row=mysqli_fetch_array($_color_result);
				$_WEB_COLOR=$_color_row;
				$_theme_color_selected=1;
			}
		}
	}
	else
	{
		$_theme_query="SELECT * FROM web_themes WHERE id='$_theme_selected'";
		$_theme_result=$conn->query($_theme_query);
		$_theme_row=mysqli_fetch_array($_theme_result);
		$_WEB_THEME=$_theme_row;
		
		$_color_query="SELECT * FROM web_themes_colors WHERE id='$_theme_color_selected'";
		$_color_result=$conn->query($_color_query);
		$_color_row=mysqli_fetch_array($_color_result);
		$_WEB_COLOR=$_color_row;
	}
	$_WEB_TEMPLATE_ID=$_theme_selected."/";
	$_THEME_BASE_URL=base_url.sub_dir_simple.$_WEB_TEMPLATE_ID;
	$_THEME_DEFAULT_CSS=$_WEB_COLOR['style_name'];
	/*------------------------/////////////////////ThemeInfo------------------------------------
	==========================================================================================*/
	$_WEB_INTRO_STATEMENT="FEATURING";
	$_WEB_TITLE=$_users_row['first_name']." "."".$_users_row['last_name']."@ROPEYOU CONNECTS"; //"ASHOK K. PACHAURY @ROPEYOU CONNECTS";
	$_WEB_AUTHOR=$_users_row['first_name']." "."".$_users_row['last_name'];
	$_WEB_DESIGNATION="Blogger, Poet, Software Developer";
	$_WEB_AUTHOR_IMAGE=getUserProfileImage($_id);
	
	/*--------------------- User's About or Summary -----------------------*/
	
	$_WEB_COMMUNICATION_EMAIL="";
	$_WEB_COMMUNICATION_MOBILE="";
	$_WEB_COMMUNICATION_ADDRESS="";
	$_WEB_PASSPORT="";
	$_WEB_RELOCATE_ABROAD="";
	
	$_users_personal_query="SELECT * FROM users_personal WHERE user_id='$_id'";
	$_users_personal_result=$conn->query($_users_personal_query);
	if(mysqli_num_rows($_users_personal_result)>0)
	{
		$_users_personal_row=mysqli_fetch_array($_users_personal_result);
		$_WEB_AUTHOR_ABOUT=$_users_personal_row['about'];
		$_WEB_MENU[]=array("url"=>"header","text"=>"Professional Summery","small_text"=>"about");
		
		$_WEB_COMMUNICATION_EMAIL=$_users_personal_row['communication_email'];
		$_WEB_COMMUNICATION_MOBILE=$_users_personal_row['communication_mobile'];
		$_WEB_COMMUNICATION_ADDRESS=$_users_personal_row['address'];;
		$_WEB_PASSPORT=$_users_personal_row['passport'];
		$_WEB_RELOCATE_ABROAD=$_users_personal_row['relocate_abroad'];
	}	
	if($_WEB_RELOCATE_ABROAD=="0" || $_WEB_RELOCATE_ABROAD=="")
	{
		$_WEB_RELOCATE_ABROAD="No";
	}
	else if($_WEB_RELOCATE_ABROAD=="1")
	{
		$_WEB_RELOCATE_ABROAD="Yes Within Home Country";
	}
	else if($_WEB_RELOCATE_ABROAD=="2")
	{
		$_WEB_RELOCATE_ABROAD="Yes Worldwide";
	}
	if($_WEB_AUTHOR_ABOUT=="" || $_WEB_AUTHOR_ABOUT==false)
	{
		$_SESSION['es']=0;
		getIformation('About',$_username,$_WEB_STEP);
		die();
	}
	/*--------------------- User's Experience -----------------------*/
	$_users_exp_query="SELECT * FROM users_work_experience WHERE user_id='$_id' ORDER BY from_month DESC,from_year DESC";
	$_users_exp_result=$conn->query($_users_exp_query);
	if(mysqli_num_rows($_users_exp_result)>0)
	{
		while($_users_exp_row=mysqli_fetch_array($_users_exp_result))
		{
			$_experience=array();
			$_designations=designations($_users_exp_row['title'],false,false,false);
			$_designation=$_designations[0];
			if(!empty($_designation))
			{
				$_experience['designation']=$_designation;
			}
			$_companies=companies($_users_exp_row['company'],false,false,false,false);
			$_company=$_companies[0];
			if(!empty($_company))
			{
				$_cities=city($_company['city'],false,false,false,false);
				$_city=$_cities[0];
				if(!empty($_city))
				{
					$_states=state($_city['state'],false,false,false);
					$_state=$_states[0];
					if(empty($_state))
					{
						$_state=false;
					}
					$_countries=country($_city['country'],false,false,false);
					$_country=$_countries[0];
					if(empty($_country))
					{
						$_country=false;
					}
					$_city['state']=$_state;
					$_city['country']=$_country;
				}
				else
				{
					$_city=false;
				}
				$_company['city']=$_city;
				$_experience['company']=$_company;
			}
			$_duration=false;
			$_from_month=print_month($_users_exp_row['from_month']);
			$_from_year=$_users_exp_row['from_year'];
			$_working=$_users_exp_row['working'];
			
			$_to_month=print_month($_users_exp_row['to_month']);
			$_to_year=$_users_exp_row['to_year'];
			
			if($_from_month)
			{
				$_duration.=$_from_month.", ".$_from_year." - ";
				if($_working=="1")
				{
					$_duration.="Present";
				}
				else
				{
					if($_to_month)
					{
						$_duration.=$_to_month.", ".$_to_year;
					}
					else{
						$_duration.="Present";
					}
				}
			}
			
			$_experience['duration']=$_duration;
			$_experience['description']=$_users_exp_row['description'];
			$_experience['added']=$_users_exp_row['added'];
			$_WEB_EXP[]=$_experience;
		}
		$_WEB_MENU[]=array("url"=>"experience","text"=>"Experience","small_text"=>"experience");
	}
	if(($_WEB_EXP==null || empty($_WEB_EXP) || $_WEB_EXP==false) && !$EXP_SKIPPED)
	{
		getIformation('Experience',$_username,$_WEB_STEP);
		die();
	}
	//************************Education
	$_users_edu_query="SELECT * FROM users_education WHERE user_id='$_id' ORDER BY from_month DESC,from_year DESC";
	$_users_edu_result=$conn->query($_users_edu_query);
	if(mysqli_num_rows($_users_edu_result)>0)
	{
		while($_users_edu_row=mysqli_fetch_array($_users_edu_result))
		{
			$_education=array();
			$_courses=courses($_users_edu_row['title'],false,false,false);
			$_course=$_courses[0];
			if(!empty($_course))
			{
				$_education['course']=$_course;
			}
			$_universities=universities($_users_edu_row['company'],false,false,false,false);
			$_university=$_universities[0];
			if(!empty($_university))
			{
				$_cities=city($_university['city'],false,false,false,false);
				$_city=$_cities[0];
				if(!empty($_city))
				{
					$_states=state($_city['state'],false,false,false);
					$_state=$_states[0];
					if(empty($_state))
					{
						$_state=false;
					}
					$_countries=country($_city['country'],false,false,false);
					$_country=$_countries[0];
					if(empty($_country))
					{
						$_country=false;
					}
					$_city['state']=$_state;
					$_city['country']=$_country;
				}
				else
				{
					$_city=false;
				}
				$_university['city']=$_city;
				$_education['university']=$_university;
			}
			$_duration=false;
			$_from_month=print_month($_users_edu_row['from_month']);
			$_from_year=$_users_edu_row['from_year'];
			$_working=$_users_edu_row['working'];
			
			$_to_month=print_month($_users_edu_row['to_month']);
			$_to_year=$_users_edu_row['to_year'];
			
			if($_from_month)
			{
				$_duration.=$_from_month.", ".$_from_year." - ";
				if($_working=="1")
				{
					$_duration.="Present";
				}
				else
				{
					if($_to_month)
					{
						$_duration.=$_to_month.", ".$_to_year;
					}
					else{
						$_duration.="Present";
					}
				}
			}
			
			$_education['duration']=$_duration;
			$_education['description']=$_users_edu_row['description'];
			$_education['added']=$_users_edu_row['added'];
			$_WEB_EDU[]=$_education;
		}
		$_WEB_MENU[]=array("url"=>"education","text"=>"Education","small_text"=>"education");
	}
	if(($_WEB_EDU==null || empty($_WEB_EDU) || $_WEB_EDU==false))
	{
		getIformation('Education',$_username,$_WEB_STEP);
		die();
	}
	//*************************Professional Skills
	$_professional_skills=professional_skills($_id);
	$_personal_skills=personal_skills($_id);
	$_languages=languages($_id);
	if($_languages || $_personal_skills || $_professional_skills)
	{
		$_WEB_MENU[]=array("url"=>"skills","text"=>"Skills","small_text"=>"skills");
	}
	
	//***********************************Acheivements
	$_WEB_AWARDS=array();
	$services_query="SELECT * FROM users_awards WHERE user_id='$_id'";
	$services_result=$conn->query($services_query);
	if(mysqli_num_rows($services_result)>0)
	{
		
		$_WEB_MENU[]=array("url"=>"achievement","text"=>"Acheivements","small_text"=>"achievement");
		while($services_row=mysqli_fetch_array($services_result)){
			$_arr=array();
			$services_media_query="SELECT media_file FROM users_award_media WHERE award_id='".$services_row['id']."'";
			$services_media_result=mysqli_query($conn,$services_media_query);
			$media=array();
			if(mysqli_num_rows($services_media_result)>0)
			{
				while($services_media_row=mysqli_fetch_array($services_media_result))
				{
					$media[]=getMediaByID($services_media_row['media_file']);
				}
			}
			$_arr['awards']=$services_row;
			$_arr['awards_media']=$media;
			$_WEB_AWARDS[]=$_arr;
		}
	}
	
	if(($_WEB_AWARDS==null || empty($_WEB_AWARDS) || $_WEB_AWARDS==false)  && !$ACH_SKIPPED)
	{
		getIformation('Acheivements',$_username,$_WEB_STEP);
		die();
	}
	//***********************************Interests
	$_WEB_INTERESTS=array();
	$services_query="SELECT * FROM users_interests WHERE user_id='$_id'";
	$services_result=$conn->query($services_query);
	if(mysqli_num_rows($services_result)>0)
	{
		
		$_WEB_MENU[]=array("url"=>"interest","text"=>"Interests","small_text"=>"interests");
		while($services_row=mysqli_fetch_array($services_result)){
			$_arr=array();
			$_arr['interests']=$services_row;
			$int_id=$services_row['title'];
			$int_query="SELECT * FROM interests WHERE id='$int_id'";
			$int_result=$conn->query($int_query);
			if(mysqli_num_rows($int_result)>0)
			{
				$int_row=mysqli_fetch_array($int_result);
				$_arr['interests']['title']=$int_row['title'];
			}
			$_WEB_INTERESTS[]=$_arr;
		}
	}
	if(($_WEB_INTERESTS==null || empty($_WEB_INTERESTS) || $_WEB_INTERESTS==false))
	{
		getIformation('Interests',$_username,$_WEB_STEP);
		die();
	}
?>