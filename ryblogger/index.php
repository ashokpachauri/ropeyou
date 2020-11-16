<!doctype html>	
	<?php include_once 'blogger-connect.php';  ?>
	<?php
		$action_to_do_on_page="";
		if(isset($_SESSION['action_to_do_on_page']) && $_SESSION['action_to_do_on_page']!="")
		{
			$action_to_do_on_page=$_SESSION['action_to_do_on_page'];
		}
		if(isset($_COOKIE['blogger_id']))
		{
			?>
				<script>
					window.location.href='dashboard.php';
				</script>
			<?php
		}
		if(isset($_POST['signup']))
		{
			if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
			{
				$first_name=filter_var($_POST['first_name'], FILTER_SANITIZE_STRING);
				$last_name=filter_var($_POST['last_name'], FILTER_SANITIZE_STRING);
				$email=filter_var($_POST['email'], FILTER_SANITIZE_STRING);
				$password=filter_var($_POST['password'], FILTER_SANITIZE_STRING);
				if(!userExists(array("email"=>$email)))
				{
					$user=array("first_name"=>$first_name,"last_name"=>$last_name,"email"=>$email,"password"=>md5($password));
					$user_name=generateUniqueUserName($email);
					$user['username']=$user_name;
					$response=createUser($user);
					if($response===true)
					{
						$_SESSION['action_to_do_on_page']="login";
						?>
						<script>
							alert('You have been registered successfully.');
						</script>
						<?php
					}
					else
					{
						//echo $response;die();
						?>
						<script>
							alert('Unable to register.');
						</script>
						<?php
					}
				}
				else
				{
					$_SESSION['action_to_do_on_page']="login";
					?>
					<script>
						alert('Email is already in use.');
					</script>
					<?php
				}
			}
			else
			{
				?>
				<script>
					alert('Enter a valid email address');
				</script>
				<?php
			}
		}
		if(isset($_POST['login']))
		{
			$username=filter_var($_POST['username'], FILTER_SANITIZE_STRING);
			$password=filter_var($_POST['password'], FILTER_SANITIZE_STRING);
			$md5_password=md5($password);
			$login_query="SELECT * FROM users WHERE (username='$username' OR email='$username' or mobile='$username') AND password='$md5_password'";
			$login_result=mysqli_query($conn,$login_query);
			if(mysqli_num_rows($login_result)>0)
			{
				$login_row=mysqli_fetch_array($login_result);
				$uid=$login_row['id'];			
				$cookie_name="blogger_id";
				$cookie_value=$login_row['id'];
				setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/",".ropeyou.com");	
				setcookie("uid", $cookie_value, time() + (86400 * 30), "/",".ropeyou.com");	
				?>
					<script>
						window.location.href='dashboard.php';
					</script>
				<?php
			}
			else
			{
				?>
					<script>
						alert('invalid login.');
					</script>
				<?php
			}
		}
	?>
	<html lang="en">
	<head>
		<title><?php echo BLOGGER; ?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Socialite is - Professional A unique and beautiful collection of UI elements">
		<link rel="icon" href="<?php echo base_url; ?>favicon.ico">
		<link rel="stylesheet" href="<?php echo BLOGGER_ASSETS; ?>assets/css/style.css">
		<link rel="stylesheet" href="<?php echo BLOGGER_ASSETS; ?>assets/css/night-mode.css">
		<link rel="stylesheet" href="<?php echo BLOGGER_ASSETS; ?>assets/css/framework.css">
		<link rel="stylesheet" href="<?php echo BLOGGER_ASSETS; ?>assets/css/icons.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	</head>
	<body>
		<div uk-height-viewport class="uk-flex uk-flex-middle uk-grid-collapse uk-grid-match" uk-grid>
			<div class="form-media uk-width-2-3@m uk-width-1-2@s uk-visible@s uk-height-viewport uk-background-cover" data-src="<?php echo BLOGGER_ASSETS; ?>assets/images/blogger-bg.jpg" uk-img>        
			<div class="form-media-content uk-light"> 
				<div class="logo"><img src="https://ropeyou.com/ropeyou/img/logo.png" alt=""></div>
				<h1>Start Writing Your Own Blog  <br> with RYBlogger</h1>
				<!--<div class="form-media-footer">
					<ul>
						<li> <a href="#"> About </a></li><li> <a href="#"> Contact </a></li><li> <a href="#"> About </a></li><li> <a href="#"> Contact </a></li><li> <a href="#"> About </a></li><li> <a href="#"> Contact </a></li>
					</ul>
				</div>-->
			</div>
		</div>
        <div class="uk-width-1-3@m uk-width-1-2@s uk-animation-slide-right-medium"> 
			<div class="px-5" <?php if($action_to_do_on_page!="login"){ ?> style="display:none;" <?php } ?> id="login_screen">

                <div class="my-4 uk-text-center">

                    <h1 class="mb-2"> Sing in </h1>

                    <p class="my-2">Don't have an a account. <a href="javascript:void(0);" onclick="showRegister();"

                            class="uk-link text-primary"> Sing up</a> </p>

                </div>

                <form action="" method="post">

                    <div class="uk-form-group">

                        <div class="uk-position-relative">

                            <input class="uk-input bg-secondary" type="email" name="username" placeholder="email,mobile or username">

                        </div>

                    </div>

                    <div class="uk-form-group">

                        <div class="uk-position-relative">

                            <input class="uk-input bg-secondary" type="password" name="password" placeholder="Your password">

                        </div>

                    </div>

                    <button type="submit" name="login" class="button primary large block mb-4">Login</button>

                    <a href="javascript:void(0);" onclick="showPassword();" class="text-center uk-display-block"> Forget your password</a>

                </form>

            </div>
			<div class="px-5" style="display:none;" id="password_screen">

                <div class="my-4 uk-text-center">

                    <h1 class="mb-2"> Retrive Password </h1>

                    <p class="my-2">Don't have an a account. <a href="javascript:void(0);" onclick="showRegister();"

                            class="uk-link text-primary">Sing up</a> </p>

                </div>

                <form action="" method="post">

                    <div class="uk-form-group">

                        <div class="uk-position-relative">

                            <input class="uk-input bg-secondary" type="email" name="email" placeholder="email">

                        </div>

                    </div>

                    <button type="submit" name="retrieve_password" class="button primary large block mb-4">Retrieve</button>

                    <a href="javascript:void(0);" onclick="showLogin();" class="text-center uk-display-block"> Try Login to other account</a>

                </form>

            </div>
			<div class="px-5" <?php if($action_to_do_on_page=="login"){ ?> style="display:none;" <?php } ?>  id="register_screen">
                <div class="my-4 uk-text-center">
                    <h1 class="mb-2"> Sing up  </h1>
                    <p class="my-2">Do you have an a account. <a href="javascript:void(0);" onclick="showLogin();" class="uk-link text-primary"> Sing in</a> </p>
                </div>
                <form method="post" action="">				
                    <div class="uk-form-group">
                        <div class="uk-position-relative">
                            <input class="uk-input bg-secondary" type="text" name="first_name" placeholder="First Name*">
                        </div>
                    </div>
					<div class="uk-form-group">
                        <div class="uk-position-relative">
                            <input class="uk-input bg-secondary" type="text" name="last_name" placeholder="Last Name*">
                        </div>
                    </div>
                    <div class="uk-form-group">
                        <div class="uk-position-relative">
                            <input class="uk-input bg-secondary" type="email" name="email" placeholder="Your Email*">
                        </div>
                    </div>
                    <div class="uk-form-group">
                        <div class="uk-position-relative">
                            <input class="uk-input bg-secondary" type="password" name="password" placeholder="Your Password*">
                        </div>
                    </div>
                    <button type="submit" name="signup" class="button primary large block mb-4">Get Started</button>
                    <a href="#" class="text-center uk-display-block">  
                        <label><input class="uk-checkbox mr-2" required type="checkbox"> I Agree terms </label>
                    </a>
                </form>
            </div>
        </div>
    </div>
    <script src="<?php echo BLOGGER_ASSETS; ?>assets/js/framework.js"></script>
    <script src="<?php echo BLOGGER_ASSETS; ?>assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo BLOGGER_ASSETS; ?>assets/js/simplebar.js"></script>
    <script src="<?php echo BLOGGER_ASSETS; ?>assets/js/main.js"></script>
	<script>
		function showLogin()
		{
			$("#register_screen").hide();
			$("#password_screen").hide();
			$("#login_screen").show();
		}
		function showRegister()
		{
			$("#password_screen").hide();
			$("#login_screen").hide();
			$("#register_screen").show();
		}
		function showPassword()
		{
			$("#login_screen").hide();
			$("#register_screen").hide();
			$("#password_screen").show();
		}
	</script>
</body>
</html>