<!DOCTYPE html>
<html lang="en">
   <head>
		<?php include_once 'head_without_session.php'; ?>
		<?php
			if(isset($_POST['verify_mobile_otp']))
			{
				$otp=$_POST['otp'];
				$country_code=$_POST['country_code'];
				$mobile=$_POST['mobile'];
				$query="SELECT * FROM users WHERE country_code='$country_code' AND mobile='$mobile' AND code='$otp'";
				$result=mysqli_query($conn,$query);
				if(mysqli_num_rows($result)>0)
				{
					//echo "hello";
					$row=mysqli_fetch_array($result);
					if(mysqli_query($conn,"UPDATE users SET validated=1 WHERE country_code='$country_code' AND mobile='$mobile' AND code='$otp'"))
					{
						//echo "hi";
						$uid=$row['id'];
						$username=$row['username'];
						setcookie("uid",$uid,time()+(30*24*60*60),"/","");
						setcookie("blogger_id",$uid,time()+(30*24*60*60),"/","");
						setcookie("username",$username,time()+(30*24*60*60),"/","");
						//die();
						?>
						<script>
							window.location.href="<?php echo base_url; ?>survey";
						</script>
						<?php
					}
					else{
						?>
						<script>
							alert('there is some issue');
							//window.location.href="<?php echo base_url; ?>survey";
						</script>
						<?php
					}
				}
			}
			if(isset($_POST['verify_email_otp']))
			{
				$otp=$_POST['otp'];
				$country_code=$_POST['country_code'];
				$mobile=$_POST['mobile'];
				$query="SELECT * FROM users WHERE email='$mobile' AND code='$otp'";
				$result=mysqli_query($conn,$query);
				if(mysqli_num_rows($result)>0)
				{
					$row=mysqli_fetch_array($result);
					if(mysqli_query($conn,"UPDATE users SET validated=1 WHERE email='$mobile' AND code='$otp'"))
					{
						$uid=$row['id'];
						$username=$row['username'];
						setcookie("uid",$uid,time()+(30*24*60*60),"/","");
						setcookie("blogger_id",$uid,time()+(30*24*60*60),"/","");
						setcookie("username",$username,time()+(30*24*60*60),"/","");
						?>
						<script>
							window.location.href="<?php echo base_url; ?>survey";
						</script>
						<?php
					}
				}
			}
		?>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
		<title>Create your resume | RopeYou Connects</title>
	</head>
	<body>
		<style>
			.overlap-rounded-circle>.rounded-circle{
				width:25px;
				height:25px;
			}
			.network-item-body{
				min-height: 39px;
				max-height: 40px;
			}
		</style>
		<?php include_once 'header.php'; ?>
		<?php
			//@session_start();
			$atv=false;
			if(isset($_SESSION['atv']) && $_SESSION['atv']!="")
			{
				$atv=$_SESSION['atv'];
			}
			if(isset($_REQUEST['atv']) && $_REQUEST['atv']!="")
			{
				$atv=$_REQUEST['atv'];
			}
			if(!$atv)
			{
				?>
				<script>
					window.location.href="<?php echo base_url; ?>logout";
				</script>
				<?php
			}
		?>
		<div class="container">
			<div class="row">
				<main class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
					<h5 class="pt-3 pr-3 border-bottom mb-0 pb-3" style="text-align:center;">Verify OTP</h5>
					<div class="row">
						<?php
							if($atv=="mobile")
							{
								?>
								<div class="col-md-12" style="margin-top:50px;">
									<form action="" method="post">
										<div class="row">
											<input type="hidden" name="country_code" value="<?php echo $_SESSION['ccode']; ?>">
											<input type="hidden" name="mobile" value="<?php echo $_SESSION['mobile']; ?>">
											<input type="hidden" name="atv" value="<?php echo $_SESSION['atv']; ?>">
											<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12"></div>
											<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
												<div class="row">
													<div class="col-md-12">
														<div class="form-group">
															<input type="text" name="otp" value="" placeholder="One Time Password" required class="form-control">
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<button name="verify_mobile_otp" type="submit" value="1" class="btn btn-success">Verify</button>
														</div>
													</div>
												</div>
											</div>
											<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12"></div>
										</div>
									</form>
								</div>
								<?php
							}
							else if($atv=="email")
							{
								?>
								<div class="col-md-12" style="margin-top:50px;">
									<form action="" method="post">
										<div class="row">
											<input type="hidden" name="country_code" value="<?php echo $_SESSION['ccode']; ?>">
											<input type="hidden" name="mobile" value="<?php echo $_SESSION['mobile']; ?>">
											<input type="hidden" name="atv" value="<?php echo $_SESSION['atv']; ?>">
											<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12"></div>
											<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
												<div class="row">
													<div class="col-md-12">
														<div class="form-group">
															<input type="text" name="otp" value="" placeholder="One Time Password" required class="form-control">
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<button name="verify_email_otp" type="submit" value="1" class="btn btn-success">Verify</button>
														</div>
													</div>
												</div>
											</div>
											<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12"></div>
										</div>
									</form>
								</div>
								<?php
							}
						?>
					</div>
				</main>
			</div>
		</div>
		<?php include_once 'scripts.php';  ?>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	</body>
</html>
