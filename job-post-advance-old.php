<!DOCTYPE html>
<?php
	if(!isset($_REQUEST['token']) || $_REQUEST['token']=="")
	{
		?>
			<script>
				location.href='post-job';
			</script>
		<?php
	}
?>
<html lang="en" class="gr__ropeyou_com">
	<title>Screening Options | RopeYou Connects</title>
	<?php include_once 'head.php'; ?>	
	<link rel="stylesheet" href="<?php echo base_url; ?>css/time-line-css.css" />
	<link href="<?php echo base_url; ?>css/select2.min.css" rel="stylesheet" />
	<style>
		.font1{
			font: normal normal normal 14px/1.4em avenir-lt-w01_35-light1475496,sans-serif;
		}
		html, body { width:100%; height:100%; margin:0; padding:0; }
		.fa { font-family: 'FontAwesome' !important; }
	</style>
	<body class="font1">
	<?php
		if(isset($_POST['post_job']))
		{
			print_r($_POST);
			$job_id=$_POST['job_id'];
			$notice_period=addslashes($_POST['notice_period']);
			$notice_period_duration=addslashes($_POST['notice_period_duration']);
			$notice_period_duration_term=addslashes($_POST['notice_period_duration_term']);
			
			$positions_count=addslashes($_POST['positions_count']);
			$travelling_willingness=addslashes($_POST['travelling_willingness']);
			$work_permit=addslashes($_POST['work_permit']);
			
			$languages=implode("==",$_POST['languages']);
			$certifications=implode("==",$_POST['certifications']);
			$skills=implode("==",$_POST['skills_required']);
			$qusetions=implode("==",$_POST['qusetions']);
			
			$query="UPDATE jobs SET notice_period='".$notice_period."',notice_period_duration='$notice_period_duration',notice_period_duration_term='$notice_period_duration_term',positions_count='$positions_count',travelling_willingness='$travelling_willingness',work_permit='$work_permit',languages='$languages',certifications='$certifications',skills='$skills',questions='$qusetions' WHERE id='$job_id'";
			if(mysqli_query($conn,$query))
			{
				?>
				<script>
					location.href="<?php echo base_url; ?>my-jobs";
				</script>
				<?php
			}
			else
			{
				?>
				<script>
					alert("Something went wrong.Please try again.");
				</script>
				<?php
			}
		}
	?>
    <!-- Header
    ================================================= -->
	<?php include_once 'header.php'; ?>
   	<!--Header End-->
	
    <section style="padding:2%;">
		<div id="page-contents">
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);transition: box-shadow 83ms;background:#fff;padding:10px;padding-bottom:0px;margin: 0 0px 10px;border-radius:2px;border-bottom: 2px solid #ebebd5;">
					<form action="" method="post" id="post_job_form">
						<div class="row">
							<div class="col-md-12" style="padding-top:15px;padding-bottom:15px;border-bottom:1px solid #333;margin-bottom:20px;">
								<h3>Step 2: Screening Options?</h3>
								<input type="hidden" name="job_id" id="job_id" value="<?php echo base64_decode($_REQUEST['token']); ?>">
								<input type="hidden" name="token" id="token" value="<?php echo $_REQUEST['token']; ?>">
							</div>
							<div class="col-md-12">
								<h5 style="margin-bottom:7px;">Notice Period <span style="color:red;">*</span></h5>
								<input name="notice_period" value="Immediate" required type="radio" checked> Can hire Immediately?&nbsp;&nbsp;
								<input name="notice_period" value="later" required type="radio"> Have to hire later?&nbsp;&nbsp;<input type="number" name="notice_period_duration" placeholder="Duration?" style="width:80px;height:30px;border-radius:2px;"> &nbsp; <select style="width:80px;height:30px;border-radius:2px;" name="notice_period_duration_term">
									<option value="days">day(s)</option>
									<option value="weeks">week(s)</option>
									<option value="months" selected>month(s)</option>
								</select>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<h5 style="margin-bottom:7px;">No of Positions <span style="color:red;">*</span></h5>
									<input type="number" name="positions_count" id="positions_count" class="form-control" placeholder="How many vacancies are for this post?">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<h5 style="margin-bottom:7px;">Required Travelling <span style="color:red;">*</span></h5>
									<select type="number" name="travelling_willingness" id="travelling_willingness" class="form-control">
										<option value="No">No, not at all</option>
										<option value="National & International Both">Yes National & Interational Both</option>
										<option value="National">Yes National</option>
										<option value="Interational">Yes Interational</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<h5 style="margin-bottom:7px;">Required work permit? <span style="color:red;">*</span></h5>
									<select type="number" name="work_permit" id="work_permit" class="form-control">
										<option value="0">No</option>
										<option value="1" selected>Yes</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<h5 style="margin-bottom:7px;">Required Languages? </h5>
									<select type="number" name="languages[]" id="languages" multiple="multiple" class="form-control select2">
										<optgroup label="Do you speak?">
											<?php 
												$language_query="SELECT * FROM languages WHERE status=1 ORDER BY title ASC";
												$language_result=mysqli_query($conn,$language_query);
												if(mysqli_num_rows($language_result)>0)
												{
													while($language_row=mysqli_fetch_array($language_result))
													{
														?>
															<option value="<?php echo $language_row['id']; ?>"><?php echo $language_row['title']; ?></option>
														<?php
													}
												}
											?>
										</optgroup>
									</select>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<h5 style="margin-bottom:7px;">Certifications required? </h5>
									<select type="number" name="certifications[]" id="certifications" multiple="multiple" class="form-control certifications">
										<optgroup label="Do you have following certificate(s)?">
											<?php 
												$certifications_query="SELECT * FROM certifications WHERE status=1 ORDER BY title ASC";
												$certifications_result=mysqli_query($conn,$certifications_query);
												if(mysqli_num_rows($certifications_result)>0)
												{
													while($certifications_row=mysqli_fetch_array($certifications_result))
													{
														?>
															<option value="<?php echo $certifications_row['id']; ?>"><?php echo $certifications_row['title']; ?></option>
														<?php
													}
												}
											?>
										</optgroup>
									</select>
								</div>
							</div>
							<div class="col-md-12">
								<h5 style="margin-bottom:7px;">Skills Needed?</h5>
								<input id="skills_required" list="skills_list" name="skills_required[]" class="form-control" multiple="multiple" placeholder="Either type a skill your self or select from list.">
								<datalist id="skills_list">
									<?php 
										$questions_query="SELECT * FROM common_skills WHERE status=1";
										$questions_result=mysqli_query($conn,$questions_query);
										if(mysqli_num_rows($questions_result)>0)
										{
											while($questions_row=mysqli_fetch_array($questions_result))
											{
												?>
												<option value="<?php echo $questions_row['title']; ?>">
												<?php
											}
										}
									?>
								</datalist>
								<div style="width:100%;padding:20px;" id="meta_div_for_skills">
									
								</div>
							</div>
							<div class="col-md-12">
								<h5 style="margin-bottom:7px;">Do you have pre interview questions to ask?</h5>
								<div class="row">
									<div class="col-md-12">
										<input id="qusetions" list="questions_list" name="qusetions[]" multiple="multiple" class="form-control" placeholder="Either type your own question or select from the list">
										<datalist id="questions_list">
											<?php 
												$questions_query="SELECT * FROM common_screening_questions WHERE status=1";
												$questions_result=mysqli_query($conn,$questions_query);
												if(mysqli_num_rows($questions_result)>0)
												{
													while($questions_row=mysqli_fetch_array($questions_result))
													{
														?>
														<option value="<?php echo $questions_row['question_text']; ?>">
														<?php
													}
												}
											?>
										</datalist>
									</div>
								</div>
								<div style="width:100%;padding:20px;" id="meta_div_for_qusetions">
									
								</div>
							</div>
							<div class="col-md-12" style="margin-top:10px;padding:20px;">
								<button class="btn btn-primary" type="submit" onclick="submitForm();" name="post_job">Post Job</button>
							</div>
						</div>
					</form>
				</div>
				<div class="col-md-3"></div>
			</div>
		</div>	
	</section>
	<script src="<?php echo base_url; ?>landing_page/js/sweetalert.min.js"></script>
		<!-- Footer
    ================================================= -->
    <?php include_once 'footer.php'; ?>  
	<script src="https://cdn.tiny.cloud/1/uvg9xyxkcmqkpjaacpgnzrroxnefi5c72vf0k2u5686rwdmv/tinymce/5/tinymce.min.js"></script>
	<script>tinymce.init({selector:'textarea',height:320});</script>
	<script src="<?php echo base_url; ?>js/select2.min.js"></script>
	<script>
		function submitForm()
		{
			
		}
		$(document).ready(function() {
			$('.select2').select2({placeholder: "Do you speak?",allowClear: true});
			$('.certifications').select2({placeholder: "Do you have following certificate(s)?",allowClear: true});
		});
		var html1='<span style="border: 1px solid #6d6e71;background: #6d6e71;padding:10px;border-radius:2px;color: #fff;margin:1px;margin-top:10px;">';
		var html2='<i class="fa fa-times" style="cursor:pointer;" onclick="$(this).parent().remove();"></i></span>';
		$("#skills_required").on("keydown", function(e) {
			if (e.keyCode == 13) {
				e.preventDefault();
				var skill=$("#skills_required").val();
				if(skill=="" || skill==null)
				{
					
				}
				else
				{
					$("#meta_div_for_skills").append(html1+""+""+skill+""+" <input type='hidden' value='"+skill+"' name='skills[]'>"+html2);
					$("#skills_required").val("");
				}
			}
		});
		var html3='<div style="border: 1px solid #6d6e71;background: #6d6e71;padding:10px;border-radius:2px;color: #fff;margin:1px;margin-top:10px;">';
		var html4='<span class="pull-right"><i class="fa fa-times" style="cursor:pointer;" onclick="$(this).parent().parent().remove();"></i><span></div>';
		$("#qusetions").on("keydown", function(e) {
			if (e.keyCode == 13) {
				e.preventDefault();
				var qusetions=$("#qusetions").val();
				if(qusetions=="" || qusetions==null)
				{
					
				}
				else
				{
					$("#meta_div_for_qusetions").append(html3+""+""+qusetions+""+" <input type='hidden' value='"+qusetions+"' name='qusetions[]'> "+html4+"<br/>");
					$("#qusetions").val("");
				}
			}
		});
	</script>
</body>
</html>
