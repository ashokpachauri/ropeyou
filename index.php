<?php
	include_once 'connection.php';
	if(isset($_REQUEST['back']) && $_REQUEST['back']=="home")
	{
		unset($_SESSION);
		session_destroy();
		?>
		<script>
			location.href="<?php echo base_url; ?>";
		</script>
		<?php
		die();
	}
	if(isset($_COOKIE['uid']) && $_COOKIE['uid']!="")
	{
		if(isset($_SESSION['last_url']) && $_SESSION['last_url']!="")
		{
			$last_url=urldecode($_SESSION['last_url']);
			$_SESSION['last_url']="";
			?>
			<script>
				location.href="<?php echo $last_url; ?>";
			</script>
			<?php
			die();
		}
		else
		{
			?>
			<script>
				location.href="<?php echo base_url; ?>onboarding";
			</script>
			<?php
			die();
		}
	}
	if(isset($_REQUEST['register']))
	{
		$first_name=mysqli_real_escape_string($conn,$_REQUEST['first_name']);
		$last_name=mysqli_real_escape_string($conn,$_REQUEST['last_name']);
		$country_code=mysqli_real_escape_string($conn,$_REQUEST['country_code']);
		if($country_code=="")
		{
			$_SESSION['ccode']="Please select a country you belongs to.";
		}
		$mobile_email=$_REQUEST['mobile_email'];
		$password=$_REQUEST['password'];
		$md5Pass=md5($password);
		$random=mt_rand(1000,9999);
		$error=false;
		if($first_name=="")
		{
			$_SESSION['first_name']="First name can't be blank.";
			$error=true;
		}
		if($last_name=="")
		{
			$_SESSION['last_name']="Last name can't be blank.";
			$error=true;
		}
		if($mobile_email=="")
		{
			$_SESSION['mobile_email']="Mobile or Email can't be blank.";
			$error=true;
		}
		if($password=="")
		{
			$_SESSION['password']="Password can't be blank.";
			$error=true;
		}
		if(strlen($password)<6)
		{
			$_SESSION['password']="Password must be atleast 6 character's long.";
			$error=true;
		}
		if(!$error)
		{
			$role="RY_USER";
			$check_query="SELECT * FROM users WHERE mobile='$mobile_email' OR email='$mobile_email'";
			$check_result=mysqli_query($conn,$check_query);
			if(mysqli_num_rows($check_result)>0)
			{
				$check_again="SELECT * FROM users WHERE (mobile='$mobile_email' OR email='$mobile_email') AND password='$md5Pass'";
				$check_again_result=mysqli_query($conn,$check_again);
				if(mysqli_num_rows($check_again_result)>0)
				{
					session_destroy();
					session_start();
					$check_again_row=mysqli_fetch_array($check_again_result);
					if($check_again_row['validated']=="1")
					{
						$user_id_exists=$check_again_row['id'];
						$_SESSION['uid']=$user_id_exists;
						setcookie("uid",$user_id_exists,time()+(30*24*60*60),"/","");
						setcookie("blogger_id",$user_id_exists,time()+(30*24*60*60),"/","");
						$_SESSION['u_name']=$check_again_row['first_name'];
						
						
						$_SESSION['mesg_type']="success";
						$_SESSION['mesg']="";
						?>
						<script>
							location.href='<?php echo base_url."onboarding"; ?>';
						</script>
						<?php
						die();
					}
					else
					{
						$user_id_exists=$check_again_row['id'];
						mysqli_query($conn,"UPDATE users SET code='$random',country_code='$country_code' WHERE id='$user_id_exists'");
						if(ctype_digit($mobile_email))
						{
							if(sendOTP($mobile_email,$random,$country_code,'mobile'))
							{
								session_destroy();
								session_start();
								$_SESSION['atv']='mobile';
								$_SESSION['mobile']=trim($mobile_email);
								$_SESSION['ccode']=trim($country_code);
								?>
								<script>
									location.href='<?php echo base_url."verify-otp"; ?>';
								</script>
								<?php
								die();
							}
							else
							{
								session_destroy();
								session_start();
								$_SESSION['u_name']='user';
								$_SESSION['mesg_type']="error";
								$_SESSION['mesg']="OTP generation failed.";
							}
						}
						else
						{
							if(sendOTP($mobile_email,$random,$country_code,'email'))
							{
								session_destroy();
								session_start();
								$_SESSION['atv']='email';
								$_SESSION['mobile']=trim($mobile_email);
								$_SESSION['ccode']=trim($country_code);
								?>
								<script>
									location.href='<?php echo base_url."verify-otp"; ?>';
								</script>
								<?php
								die();
							}
							else
							{
								session_destroy();
								session_start();
								$_SESSION['u_name']='user';
								$_SESSION['mesg_type']="error";
								$_SESSION['mesg']="OTP generation failed.";
							}
						}
						
					}
				}
				else
				{
					session_destroy();
					session_start();
					$_SESSION['u_name']='user';
					$_SESSION['mesg_type']="error";
					$_SESSION['mesg']="An account has been already created with this mobile or email.";
				}
			}
			else
			{
				if(ctype_digit($mobile_email))
				{
					$query="INSERT INTO users SET country_code='$country_code',first_name='$first_name',last_name='$last_name',mobile='$mobile_email',password='$md5Pass',added=NOW(),role='$role',code='$random'";
					if(mysqli_query($conn,$query))
					{
						session_destroy();
						session_start();
						$uid=mysqli_insert_id($conn);
						
						$_SESSION['uid']=$uid;
						$username=generateUniqueUserName($mobile_email);
						mysqli_query($conn,"UPDATE users SET username='$username' WHERE id='$uid'");
						
						$_SESSION['u_name']=$first_name;
						$_SESSION['mesg_type']="success";
						$_SESSION['mesg']="We have sent an OTP on your registered mobile.Please verify your account in next step.";
						mysqli_query($conn,"INSERT INTO threats_to_user SET user_id='".$uid."',added=NOW(),message='New account created.Update your profile to increase your visibility.',heading='New account created.'");
						$contact_type="mobile";
						mysqli_query($conn,"INSERT INTO users_contact SET user_id='".$uid."',contact_name='Self',contact_type='$contact_type',contact='$mobile_email'");
						//mysqli_query($conn,"INSERT INTO users_personal SET user_id='".$_SESSION['uid']."'");
						if(sendOTP($mobile_email,$random,$country_code,'mobile'))
						{
							session_destroy();
							session_start();
							$_SESSION['atv']='mobile';
							$_SESSION['mobile']=trim($mobile_email);
							$_SESSION['ccode']=trim($country_code);
							?>
							<script>
								location.href='<?php echo base_url."verify-otp"; ?>';
							</script>
							<?php
							die();
						}
						else
						{
							session_destroy();
							session_start();
							$_SESSION['u_name']='user';
							$_SESSION['mesg_type']="error";
							$_SESSION['mesg']="OTP generation failed.";
						}
					}
					else
					{
						session_destroy();
						session_start();
						$_SESSION['u_name']=$first_name;
						$_SESSION['mesg_type']="error";
						$_SESSION['mesg']="We are sorry that you are facing this.We are working on this.Please try back after a moment.";
					}
				}
				else
				{
					if(filter_var($mobile_email, FILTER_VALIDATE_EMAIL))
					{
						$username=generateUniqueUserName($mobile_email);
						$query="INSERT INTO users SET first_name='$first_name',last_name='$last_name',email='$mobile_email',password='$md5Pass',added=NOW(),role='$role',code='$random'";
						if(mysqli_query($conn,$query))
						{
							session_destroy();
							session_start();
							$uid=mysqli_insert_id($conn);
							
							$_SESSION['uid']=$uid;
							mysqli_query($conn,"UPDATE users SET username='$username' WHERE id='$uid'");
							$_SESSION['u_name']=$first_name;
							$_SESSION['mesg_type']="success";
							$_SESSION['mesg']="We have sent an OTP on your registered email.Please verify your account in next step or follow the link send in email.";
							
							$email_content=email_html;
							$email_content=str_replace("RY-CODE",$random,$email_content);
							$email_content=str_replace("RY-USR",$uid,$email_content);
							$headers = "MIME-Version: 1.0" . "\r\n";
							$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
							$headers .= 'From: <no-reply@ropeyou.com>' . "\r\n";
							
							mail($mobile_email,"RopeYou Confirmation Email",$email_content,$headers);
							$contact_type="email";
							
							//mysqli_query($conn,"INSERT INTO users_personal SET user_id='".$_SESSION['uid']."'");
							if(mysqli_query($conn,"INSERT INTO users_contact SET user_id='".$uid."',contact_name='Self',contact_type='$contact_type',contact='$mobile_email'"))
							{
								session_destroy();
								session_start();
								$_SESSION['atv']='email';
								$_SESSION['mobile']=trim($mobile_email);
								$_SESSION['ccode']=trim($country_code);
								?>
								<script>
									location.href='<?php echo base_url."verify-otp"; ?>';
								</script>
								<?php
								die();
							}
							else
							{
								session_destroy();
								session_start();
								$_SESSION['u_name']='user';
								$_SESSION['mesg_type']="error";
								$_SESSION['mesg']="OTP generation failed.";
							}
						}
						else
						{
							session_destroy();
							session_start();
							$_SESSION['u_name']=$first_name;
							$_SESSION['mesg_type']="error";
							$_SESSION['mesg']="We are sorry that you are facing this.We are working on this.Please try back after a moment.";
						}
					}
					else
					{
						?>
						<script>
							location.href='<?php echo base_url."invalid-username"; ?>';
						</script>
						<?php
					}
				}
			}
		}
	}
	if(isset($_REQUEST['user_login']))
	{
		$username=$_REQUEST['mobile_email'];
		$password=$_REQUEST['password'];
		$pass=md5($password);
		$query="SELECT * FROM users WHERE (username='$username' OR mobile='$username' OR email='$username' OR id='$username') AND password='$pass'";
		$result=mysqli_query($conn,$query);
		if(mysqli_num_rows($result)>0)
		{
			$row=mysqli_fetch_array($result);
			if($row['validated']==1)
			{
				$uid=$row['id'];
				$_SESSION['uid']=$row['id'];			
				$cookie_name="uid";
				$cookie_value=$row['id'];
				
				setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/","");				
				$username=$row['username'];	
				setcookie("blogger_id",$cookie_value,time()+(30*24*60*60),"/","");
				setcookie("username",$username,time()+(30*24*60*60),"/","");
				if(isset($_SESSION['last_url']) && $_SESSION['last_url']!="")
				{
					$last_url=urldecode($_SESSION['last_url']);
					$_SESSION['last_url']="";
					?>
					<script>
						var user_id="<?php echo $row['id']; ?>";
						var user_role="<?php echo $row['role']; ?>";
						localStorage.setItem("user_id",user_id);
						localStorage.setItem("user_role",user_role);
						location.href="<?php echo $last_url; ?>";
					</script>
					<?php
					die();
				}
				else
				{
					?>
					<script>
						var user_id="<?php echo $row['id']; ?>";
						var user_role="<?php echo $row['role']; ?>";
						localStorage.setItem("user_id",user_id);
						localStorage.setItem("user_role",user_role);
						location.href="<?php echo base_url; ?>onboarding";
					</script>
					<?php
					die();
				}
			}
			else
			{
				$_SESSION['ccode']=$row['country_code'];
				if($row['mobile']==$username)
				{
					$_SESSION['atv']='mobile';
					$_SESSION['mobile']=$row['mobile'];
				}
				else
				{
					$_SESSION['atv']='email';
					$_SESSION['mobile']=$row['email'];
				}
				//echo $_SESSION['ccode'];die();
				//$_SESSION['uid']=$row['id'];
				?>
				<script>
					location.href="<?php echo base_url; ?>verify-otp";
				</script>
				<?php
				
				die();
			}
		}
		else
		{
			?>
			<script>
				window.location.href="<?php echo base_url; ?>?user=invalid";
			</script>
			<?php
		}
	}
?>
<!DOCTYPE html>
<html>
<style>
.navbar-default {
    background-color: #434341 !important;
    border: none !important;
}
.logo_wthree_agile .navbar-brand {
    padding: 5px 0px;
}
.m-r-5 {
    margin-right: 5px;
}
.flex-c-m {
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    justify-content: center;
    -ms-align-items: center;
    align-items: center;
}
.login100-form-social-item {
    width: 45px;
    height: 45px;
    font-size: 18px;
    color: #fff;
	cursor:pointer;
	padding:5px;
}
body, html {
  height: 100%;
  margin: 0;
}

.bg {
  background-image: url(<?php echo base_url; ?>home-images/screen_2x.jpg);
    height: 100%;
    right: 0;
    left: 0;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
.bg_over_ridden{
	background-color:rgba(255, 255, 255, 0.85);
	/*color:#515e72;*/
	top:90px;
	bottom:0px;
	padding:20px;
	border-radius: 2px;
    padding: 20px;
    border: 4px solid #fff;
}
.bg_over_ridden_1{
	background-color:rgba(255, 255, 255, 0.85);
	/*color:#515e72;*/
	top:150px;
	bottom:0px;
	padding:20px;
	border-radius: 2px;
    padding: 20px;
    border: 4px solid #fff;
}
.bg_over_ridden .form-control {
	box-shadow: 1px 1px 2px 1px #ccc;
	border: none;
	border-radius: 0px;
	height: 34px;
}

.bg_over_ridden_1 .form-control {
	box-shadow: 1px 1px 2px 1px #ccc;
	border: none;
	border-radius: 0px;
	height: 34px;
}

.bg_over_ridden_1 a, .bg_over_ridden a{
    font-size: 14px;
    font-weight: 600;
}
.btn-primary {
    background: -moz-linear-gradient(194deg, #00c9e4 0%, #007bff 100%);
    background: -webkit-gradient(linear, left top, right top, color-stop(0%, #007bff), color-stop(100%, #00c9e4)) !important;
    background: -webkit-linear-gradient(194deg, #00c9e4 0%, #007bff 100%)!important;
    background: -o-linear-gradient(194deg, #00c9e4 0%, #007bff 100%);
    background: -ms-linear-gradient(194deg, #00c9e4 0%, #007bff 100%);
    background: linear-gradient(256deg, #00c9e4 0%, #007bff 100%) !important;
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#007bff', endColorstr='#00c9e4',GradientType=1 );
    border-color: #007bff !important;
    color: #fff;
}
.navbar-brand img {
    height: 31px;
    margin: -4px 0 0 0;
}
</style>
<head>
	<title>Recruiters, Jobs & Social Network | RopeYou Connects</title>
	<meta property="og:url" content="<?php echo base_url; ?>" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="Recruiters, Jobs & Social Network" />
	<meta property="og:description" content="Recruiters & Social Network,Video CV,Video Interviews" />
	<meta property="og:image" content="<?php echo base_url; ?>uploads/@native.jpg"/>
	<meta property="fb:app_id" content="465307587452391"/>
	<meta name="google-signin-scope" content="profile email">
	<meta name="google-signin-client_id" content="940004341323-ubu6e063ut7bafuosk2952k8s84nenvs.apps.googleusercontent.com">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<meta name="keywords" content="RopeYou Connects,Recruiter,Job Seekers,Login,Register,Connect with Recruiters Socially,Watch your success grow,#ropeyou,@ropeyou,<?php echo base_url; ?>" />
	<script src="https://apis.google.com/js/api:client.js"></script>
	<link rel="shortcut icon" type="image/png" href="<?php echo base_url; ?>images/fav.png"/>
	<script type="application/x-javascript">
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
		
	</script>
	<link href="<?php echo base_url; ?>home-css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<link href="<?php echo base_url; ?>home-css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link href="<?php echo base_url; ?>home-css/prettyPhoto.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url; ?>home-css/easy-responsive-tabs.css" rel='stylesheet' type='text/css' />
	<link href="<?php echo base_url; ?>home-css/fontawesome-all.css" rel="stylesheet">
	<!-- //for bootstrap working -->
	<link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,600,600i,700" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Poppins:200,200i,300,300i,400,400i,500,500i,600,600i,700" rel="stylesheet">
</head>

<body class="bg">
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v5.0&appId=2561662937402369&autoLogAppEvents=1"></script>
	<div class="top_header" id="home" style="background-color:#1d2f38 !important;">
		<!-- Fixed navbar -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="nav_top_fx_w3layouts_agileits">
				<div class="navbar-header hidden-sm hidden-xs">
					<button type="button" class="navbar-toggle collapsed hidden-sm hidden-xs" data-toggle="collapse" data-target="#navbar" aria-expanded="false"
					    aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<div class="logo_wthree_agile  hidden-sm hidden-xs">
						<h1 style="text-align:center;">
							<a class="navbar-brand" href="index.php">
								<img src="img/logo.png" alt="RopeYou">
							</a>
						</h1>
					</div>
				</div>
				<div class="navbar-header hidden-md hidden-lg hidden-xl" style="margin-left:75px;">
					<div class="logo_wthree_agile hidden-md hidden-lg hidden-xl" style="margin-top:0.55em;">
						<h1 style="text-align:center;">
							<a class="navbar-brand" href="index.php" style="color:#fff;font-size:25px;text-align:center;text-transform: none;">
								RopeYou<br/><span style="font-size:10px;text-align:center;">Watch Your Success Grow</span>
								<!--<span class="desc"  style="color:#fff;">Give a little. Help a lot.</span>-->
							</a>
						</h1>
					</div>
				</div>
				<div id="navbar" class="navbar-collapse collapse hidden-sm hidden-xs">
					<div class="nav_right_top">
						<ul class="nav navbar-nav">
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12 col-sm-12 hidden-sm hidden-xs" style="padding:15px;">
									<div class="row">
										<div class="col-md-2 col-sm-2 col-xs-5 col-sm-3 col-5">
											<button type="button" name="user_login_button" id="user_login_button" style="width:80px;" class="btn btn-primary" onclick="login_div_show();"><?php if(isset($_REQUEST['user'])){ echo "Signup"; }else { echo "Login"; } ?></button>
										</div>
									</div>
								</div>
							</div>
						</ul>
					</div>
				</div>
				<!--/.nav-collapse -->
			</div>
		</nav>
		<div class="clearfix"></div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-sm-8 col-lg-8 hidden-xs">
			</div>
			<div class="col-md-4 col-sm-4 col-lg-4 col-xs-12 col-12 bg_over_ridden" style="min-height:490px;<?php if(isset($_REQUEST['user'])){ echo "display:none;"; }else {  } ?>" id="register_div">
				<div class="row">
					<div class="col-md-12">
						<h3 style="text-align:center;font-size:18px;">Be great at what you do.</h3>
						<h4 style="text-align:center;margin-top:8px;margin-bottom:14px;font-size:14px;">Get started - it's free.</h4>
					</div>
				</div>
				<form action="" method="post">
					<div class="row">
						<div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
							<div class="form-group">
								<input type="text" name="first_name" class="form-control" id="first_name" placeholder="First name*" required>
								<?php
									if(isset($_SESSION['first_name']) && $_SESSION['first_name']!='')
									{
										?>
										<span style="color:red;font-size:10px;padding:5px;"><?php echo $_SESSION['first_name']; ?></span>
										<?php
										$_SESSION['first_name']='';
									}
								?>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
							<div class="form-group">
								<input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last name*" required>
								<?php
									if(isset($_SESSION['last_name']) && $_SESSION['last_name']!='')
									{
										?>
										<span style="color:red;font-size:10px;padding:5px;"><?php echo $_SESSION['last_name']; ?></span>
										<?php
										$_SESSION['last_name']='';
									}
								?>
							</div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
							<div class="form-group">
								<input type="text" name="mobile_email" class="form-control" id="mobile_email" placeholder="Mobile or email address*" required>
								<?php
									if(isset($_SESSION['mobile_email']) && $_SESSION['mobile_email']!='')
									{
										?>
										<span style="color:red;font-size:10px;padding:5px;"><?php echo $_SESSION['mobile_email']; ?></span>
										<?php
										$_SESSION['mobile_email']='';
									}
								?>
							</div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
							<div class="form-group">
								<input type="password" name="password" class="form-control" id="password" placeholder="Password (6 or more characters)*" required>
								<?php
									if(isset($_SESSION['password']) && $_SESSION['password']!='')
									{
										?>
										<span style="color:red;font-size:10px;padding:5px;"><?php echo $_SESSION['password']; ?></span>
										<?php
										$_SESSION['password']='';
									}
									
								?>
							</div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
							<div class="form-group">
								<select name="country_code" class="form-control" id="country_code" required>
									<option value="">Select country</option>
									<?php
										$country_query="SELECT * FROM country WHERE status=1 ORDER by title";
										$country_result=mysqli_query($conn,$country_query);
										while($country_row=mysqli_fetch_array($country_result))
										{
											?>
											<option value="<?php echo $country_row['phonecode']; ?>"><?php echo $country_row['title']; ?></option>
											<?php
										}
									?>
								</select>
								<?php
									if(isset($_SESSION['ccode']) && $_SESSION['ccode']!='')
									{
										?>
										<span style="color:red;font-size:10px;padding:5px;"><?php echo $_SESSION['ccode']; ?></span>
										<?php
										$_SESSION['ccode']='';
									}
									
								?>
							</div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12" style="margin-top:10px;font-size:12px;">
							By clicking Register, you agree to our Terms and Conditions, Privacy Policy and Cookie Policy. You may receive SMS,Email or both kind of notifications from us and can opt out at any time.
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12" style="margin-top:10px;">
							<button class="btn btn-primary form-control" type="submit" name="register">Register</button>
						</div>
					</div>
				</form>
				<div class="row">
					<div class="col-sm-12 col-xs-12 col-12 col-md-12" style="margin-top:10px;">
						<span style="text-align:center;">Have an account? <a href="javascript:void(0);" onclick="login_div_show();" style="text-align:center;">Login</a>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12" style="margin-top:10px;">
						<h3 style="text-align:center;margin-bottom:5px;">______________</h3>
						<div class="login100-form-social flex-c-m">
							<a href="javascript:void(0);" class="login100-form-social-item flex-c-m bg1 m-r-5" id="fb_login_1" title="Login With Facebook">
								<image src="<?php echo base_url; ?>home-images/f.png" class="fb-login-button" style="width:40px;border:1px solid #515e72;border-radius: 50%;">
							</a>
							<!--<div class="fb-login-button" data-width="50" data-size="small" data-button-type="login_with" data-auto-logout-link="false" data-use-continue-as="false" style="display:none;"></div>-->
							<a href="javascript:void(0);" class="login100-form-social-item flex-c-m bg2 m-r-5 customGPlusSignIn" title="Login With Google" id="customBtn1">
								<image src="<?php echo base_url; ?>home-images/g.png" style="width:40px;border:1px solid #515e72;border-radius: 50%;">
							</a>
							<a href="javascript:void(0);" class="login100-form-social-item flex-c-m bg3 m-r-5" title="Login With Twitter" id="twitter-button">
								<image src="<?php echo base_url; ?>home-images/t.png" style="width:40px;border:1px solid #515e72;border-radius: 50%;">
							</a>
							<a href="javascript:void(0);" class="login100-form-social-item flex-c-m bg2 m-r-5" title="Login With Linkedin">
								<image src="<?php echo base_url; ?>home-images/l.png" style="width:40px;border:1px solid #515e72;border-radius: 50%;">
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 col-lg-4 col-xs-12 col-12 bg_over_ridden_1" style="min-height:350px;<?php if(isset($_REQUEST['user'])){  }else { echo "display:none;"; } ?>" id="login_div">
				<div class="row">
					<div class="col-md-12">
						<h3 style="text-align:center;font-size:18px;">Welcome Back!</h3>
						<?php if(isset($_REQUEST['user'])){ echo "<h6 style='text-align:center;margin-top:15px;color:red;'>Invalid Username/Password</h6>"; } ?>
					</div>
				</div>
				<form action="" method="post">
					<div class="row" style="margin-top:30px;">
						<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
							<div class="form-group">
								<input type="text" name="mobile_email" class="form-control" id="username" placeholder="Mobile or email address" required>
							</div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
							<div class="form-group">
								<input type="password" name="password" class="form-control" id="user_password" placeholder="Password" required>
							</div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12" style="margin-top:10px;">
							<button class="btn btn-primary form-control" type="submit" name="user_login">Login</button>
						</div>
					</div>
				</form>
				<div class="row">
					<div class="col-sm-12 col-xs-12 col-12 col-md-12" style="margin-top:15px;">
						<span class="pull-left"><a href="javascript:void(0);" style="text-align:center;">Forgot Password?</a></span>
						<span style="text-align:center;" class="pull-right">New to RopeYou? <a href="javascript:void(0);" onclick="register_div_show();" style="text-align:center;">Signup Now</a></span>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12" style="margin-top:10px;">
						<h3 style="text-align:center;margin-bottom:5px;">______________</h3>
						<div class="login100-form-social flex-c-m">
							<a href="#" class="login100-form-social-item flex-c-m bg1 m-r-5" id="fb_login_2" title="Login With Facebook">
								<image src="<?php echo base_url; ?>home-images/f.png" style="width:40px;border:1px solid #515e72;border-radius: 50%;">
							</a>
							<a href="javascript:void(0);" class="login100-form-social-item flex-c-m bg2 m-r-5 customGPlusSignIn" title="Login With Google" id="customBtn">
								<image src="<?php echo base_url; ?>home-images/g.png" class="g-signin2" data-onsuccess="onSignIn" style="width:40px;border:1px solid #515e72;border-radius: 50%;">
							</a>
							<a href="#" class="login100-form-social-item flex-c-m bg3 m-r-5" title="Login With Twitter">
								<image src="<?php echo base_url; ?>home-images/t.png" style="width:40px;border:1px solid #515e72;border-radius: 50%;">
							</a>
							<a href="#" class="login100-form-social-item flex-c-m bg2 m-r-5" title="Login With Linkedin">
								<image src="<?php echo base_url; ?>home-images/l.png" style="width:40px;border:1px solid #515e72;border-radius: 50%;">
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row" id="contact" style="max-height:50px !important;position: fixed;bottom: 0;width: 110%;">
		<div class="footer_inner_info_wthree_agileits" style="background-color:#fff !important;">
			<p class="copy-right">2020 © RopeYou. All rights reserved | Going through testing (Internally)
				<!--<a href="<?php echo base_url; ?>">With Love</a>-->
			</p>
		</div>
	</div>
	<!-- footer -->
	<!-- //footer -->
	<script type="text/javascript" src="<?php echo base_url; ?>home-js/jquery-2.2.3.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url; ?>home-js/bootstrap.js"></script>
	
	<script type="text/javascript" src="<?php echo base_url; ?>home-js/all.js"></script>
	<script type="text/javascript" src=" https://cdn.rawgit.com/oauth-io/oauth-js/c5af4519/dist/oauth.js"></script>
	<script>
	var base_url="<?php echo base_url; ?>";
		  var googleUser = {};
		  var startApp = function() {
			gapi.load('auth2', function(){
			  // Retrieve the singleton for the GoogleAuth library and set up the client.
			  auth2 = gapi.auth2.init({
				client_id: '940004341323-ubu6e063ut7bafuosk2952k8s84nenvs.apps.googleusercontent.com',
				cookiepolicy: 'single_host_origin',
				// Request scopes in addition to 'profile' and 'email'
				//scope: 'additional_scope'
			  });
			  attachSignin(document.getElementById('customBtn'));
			  attachSignin(document.getElementById('customBtn1'));
			});
		  };

		  function attachSignin(element) {
			//console.log(element.id);
			auth2.attachClickHandler(element, {},
				function(googleUser) {
				  var email=googleUser.getBasicProfile().getEmail();
				  var name=googleUser.getBasicProfile().getFamilyName();
				  var image=googleUser.getBasicProfile().getImageUrl();
				  var id=googleUser.getBasicProfile().getId();
				  var full_name=googleUser.getBasicProfile().getName();
				  var data={email:email,name:name,image:image,id:id,full_name:full_name};
				  //console.log(data);
				  $.ajax({
					  url:'<?php echo base_url; ?>webservices/get-google-signin.php',
					  type:'post',
					  data:data,
					  success:function(result){
						if(result=="SUCCESS")
						{
							window.location.href='<?php echo base_url; ?>onboarding';
						}
						else
						{
							swal({
							  title: "Oh!, Snap",
							  text: "Something went wrong please try again.",
							  icon: "error",
							  buttons: {
								cancel: false,
								confirm: "Close",
							  },
							  dangerMode: false,
							});
						}
					  },
					  error:function(error){
							swal({
							  title: "Oh!, Snap",
							  text: "Something went wrong please try again.",
							  icon: "error",
							  buttons: {
								cancel: false,
								confirm: "Close",
							  },
							  dangerMode: false,
							});
					  }
				  });
				}, function(error) {
				  //alert(JSON.stringify(error, undefined, 2));
				});
			}
		startApp();
	</script>
	<script>
		$('ul.dropdown-menu li').hover(function () {
			$(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
		}, function () {
			$(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
		});
	</script>
	<script type="text/javascript" src="<?php echo base_url; ?>home-js/easing.js"></script>
	<script type="text/javascript" src="<?php echo base_url; ?>home-js/move-top.js"></script>
	<script src="<?php echo base_url; ?>home-js/sweetalert.min.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			$(".scroll, .navbar li a, .footer li a").click(function (event) {
				$('html,body').animate({
					scrollTop: $(this.hash).offset().top
				}, 1000);
			});
			<?php
			if(isset($_SESSION['mesg_type']) && $_SESSION['mesg_type']!='')
			{
				if($_SESSION['mesg_type']=="error")
				{
					?>
					swal({
					  title: "Dear, <?php echo $_SESSION['u_name']; ?>",
					  text: "<?php echo $_SESSION['mesg']; ?>",
					  icon: "<?php echo $_SESSION['mesg_type']; ?>",
					  buttons: {
						cancel: false,
						confirm: "Close",
					  },
					  dangerMode: false,
					});
					/*.then((willDelete) => {
					  if (willDelete) {
						swal("Poof! Your imaginary file has been deleted!", {
						  icon: "success",
						});
					  } else {
						swal("Your imaginary file is safe!");
					  }
					});*/
					<?php
					session_destroy();
					session_start();
				}
			}
			?>
		});
	</script>
	<script type="text/javascript">
	var user_login_button_html=$("#user_login_button").text();
	function login_div_show()
	{
		if(user_login_button_html=="Login")
		{	
			user_login_button_html="Signup";
			$("#user_login_button").html(user_login_button_html);
			$("#register_div").hide();
			$("#login_div").show();
		}
		else
		{
			user_login_button_html="Login";
			$("#user_login_button").html(user_login_button_html);
			$("#login_div").hide();
			$("#register_div").show();
		}
	}
	function register_div_show()
	{
		if(user_login_button_html=="Login")
		{	
			user_login_button_html="Signup";
			$("#user_login_button").html(user_login_button_html);
			$("#register_div").hide();
			$("#login_div").show();
		}
		else
		{
			user_login_button_html="Login";
			$("#user_login_button").html(user_login_button_html);
			$("#login_div").hide();
			$("#register_div").show();
		}
	}
	$(document).ready(function () {

		$().UItoTop({
			easingType: 'easeOutQuart'
		});

	});
	var logged_out=0;
	function statusChangeCallback(response) {
		if (response.status === 'connected') {
		  if(logged_out!=0)
		  {
			 testAPI();
		  }
		  logged_out=1;
		} else {
			logged_out=1;
		}
	}
	document.getElementById('fb_login_1').addEventListener('click', function() {
		//do the login
		FB.login(statusChangeCallback, {scope: 'email,public_profile', return_scopes: true});
	}, false);
	document.getElementById('fb_login_2').addEventListener('click', function() {
		//do the login
		FB.login(statusChangeCallback, {scope: 'email,public_profile', return_scopes: true});
	}, false);
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
    FB.init({
      appId      : '465307587452391',
      cookie     : true,   
      xfbml      : true,  
      version    : 'v5.0' 
    });

    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });

  };
  
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
	  var id=response.id;
	  var name=response.name;
	 $.ajax({
			url:base_url+'webservices/get-facebook-signin.php',
			type:'post',
			data:{id:id,name:name,email:"",full_name:name,image:""},
			dataType:'html',
			success:function(res){
				//var parsed=JSON.parse(res);
				if(res=="SUCCESS")
				{
					redirect=base_url+"onboarding";
					window.location.href=redirect;
				}
				else
				{
					swal({
					  title: "Oh!, Snap",
					  text: "Something went wrong please try again.",
					  icon: "error",
					  buttons: {
						cancel: false,
						confirm: "Close",
					  },
					  dangerMode: false,
					});
				}
			}
		});
	  console.log(response);
    });
  }
</script>
	<a href="#home" class="scroll" id="toTop" style="display: block;">
		<span id="toTopHover" style="opacity: 1;"> </span>
	</a>
	<script type="text/javascript" src="<?php echo base_url; ?>home-js/jquery-3.1.1.min.js"></script>
	<script src="<?php echo base_url; ?>home-js/jquery.quicksand.js" type="text/javascript"></script>
	<script src="<?php echo base_url; ?>home-js/script.js" type="text/javascript"></script>
</body>
</html>