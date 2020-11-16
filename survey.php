<!DOCTYPE html>
<html lang="en">
   <head>
		<?php include_once 'head.php'; ?>
		<?php
			if(isset($_POST['take_the_survey']))
			{
				$ambessdor_code=$_POST['ambessdor_code'];
				$how_did_you_hear_about_us=$_POST['how_did_you_hear_about_us'];
				
				$query="UPDATE users SET ambessdor_code='$ambessdor_code',how_did_you_hear_about_us='$how_did_you_hear_about_us' WHERE id='".$_COOKIE['uid']."'";
				if(mysqli_query($conn,$query))
				{
					?>
					<script>
						window.location.href="<?php echo base_url; ?>onboarding";
					</script>
					<?php
					die();
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
			if(!isset($_COOKIE['uid']) || $_COOKIE['uid']=="")
			{
				?>
				<script>
					window.location.href="<?php echo base_url; ?>logout";
				</script>
				<?php
				die();
			}
			$uid=$_COOKIE['uid'];
		?>
		<div class="container">
			<div class="row">
				<main class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
					<h5 class="pt-3 pr-3 border-bottom mb-0 pb-3" style="text-align:center;">Please take this small survey</h5>
					<div class="row">
						<?php
							if($uid)
							{
								?>
								<div class="col-md-12" style="margin-top:50px;">
									<form action="" method="post">
										<div class="row">
											<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12"></div>
											<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 box shadow-sm mb-3 rounded bg-white ads-box overflow-hidden" style="padding:50px;">
												<div class="row">
													<div class="col-md-12">
														<div class="form-group">
															<h5>How did you hear about us?*</h5>
															<select type="text" name="how_did_you_hear_about_us" required class="form-control">
																<option value="">Select</option>
																<?php
																	$survey_query="SELECT * FROM how_did_you_hear_about_survey WHERE status=1";
																	$survey_result=mysqli_query($conn,$survey_query);
																	while($survey_row=mysqli_fetch_array($survey_result))
																	{
																		?>
																		<option value="<?php echo $survey_row['id']; ?>"><?php echo $survey_row['title']; ?></option>
																		<?php
																	}
																?>
															</select>
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<h5>Reference code (optional)</h5>
															<input type="text" name="ambessdor_code" class="form-control" value="" placeholder="Please enter the reference code.">
														</div>
													</div>
													<div class="col-md-12">
														<button name="take_the_survey" type="submit" value="1" class="btn btn-success">Submit the survey</button>
														<a name="skip_the_survey" href="<?php echo base_url; ?>onboarding" class="btn btn-danger pull-right" style="float:right;">Skip</a>
													</div>
												</div>
											</div>
											<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12"></div>
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