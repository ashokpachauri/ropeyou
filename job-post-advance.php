<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include_once 'head.php'; ?>
		<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" rel="stylesheet">
		<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
		<?php
			if(isset($_POST['post_job']))
			{
				//print_r($_POST);
				$job_id=$_POST['job_id'];
				/*------------------------Uploading Video----------------------*/
				$user_id=$_COOKIE['uid'];
				$user_data=getUsersData($user_id);
				$target_dir="uploads/";
				$video_description=$user_data['username'].'-'.mt_rand(0,99999).'-'.str_replace(" ","-",trim(basename($_FILES["video_description"]["name"])));
				$target_file = $target_dir . $video_description;
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				$size=$_FILES["video_description"]["size"];
				if ($size > 50000000) {
					$error_message="File size should not exceeds 50 mb.<br/>";
					$uploadOk = 0;
					$video_description="";
				}
				$check_array=array("mp4");
				if(!in_array($imageFileType,$check_array))
				{
					$error_message=$error_message."Only mp4 extensions allowed.<br/>";
					$uploadOk = 0;
					$video_description="";
				}
				if($uploadOk=="1")
				{
					if(move_uploaded_file($_FILES["video_description"]["tmp_name"], $target_file))
					{
						$uploadOk=1;
					}
					else
					{
						$uploadOk=0;
						$video_description="";
					}
				}
				
				
				$question_description=$user_data['username'].'-'.mt_rand(0,99999).'-'.str_replace(" ","-",trim(basename($_FILES["question_description"]["name"])));
				$target_file = $target_dir . $question_description;
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				$size=$_FILES["question_description"]["size"];
				if ($size > 50000000) {
					$error_message="File size should not exceeds 50 mb.<br/>";
					$uploadOk = 0;
					$question_description="";
				}
				$check_array=array("mp4");
				if(!in_array($imageFileType,$check_array))
				{
					$error_message=$error_message."Only mp4 extensions allowed.<br/>";
					$uploadOk = 0;
					$question_description="";
				}
				if($uploadOk=="1")
				{
					if(move_uploaded_file($_FILES["question_description"]["tmp_name"], $target_file))
					{
						$uploadOk=1;
					}
					else
					{
						$uploadOk=0;
						$question_description="";
					}
				}
				$conditional="";
				if($video_description!="")
				{
					$conditional=",video_description='$video_description'";
				}
				if($question_description!="")
				{
					$conditional=$conditional.",question_description='$question_description'";
				}
				/*------------------------------- Uploading videos-------*/
				
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
				$status=0;
				$query="UPDATE jobs SET notice_period='".$notice_period."',notice_period_duration='$notice_period_duration',notice_period_duration_term='$notice_period_duration_term',positions_count='$positions_count',travelling_willingness='$travelling_willingness',work_permit='$work_permit',languages='$languages',certifications='$certifications',skills='$skills',questions='$qusetions',status='$status'".$conditional." WHERE id='$job_id'";
				
				//echo $query;die();
				if(mysqli_query($conn,$query))
				{
					?>
					<script>
						location.href="<?php echo base_url; ?>jobs-posted";
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
		<title>Publish Job | RopeYou Connects</title>
		<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
	</head>
	<style>
		h6{
			font-size: 0.8rem !important;
		}
		#notice_period_duration:placeholder{
			
		}
		::-webkit-input-placeholder { /* Chrome/Opera/Safari */
		  color: #d8dfe3 !important;
		}
		::-moz-placeholder { /* Firefox 19+ */
		  color: #d8dfe3 !important;
		}
		:-ms-input-placeholder { /* IE 10+ */
		  color: #d8dfe3 !important;
		}
		:-moz-placeholder { /* Firefox 18- */
		  color: #d8dfe3 !important;
		}
	</style>
	<body>
		<?php include_once 'header.php'; ?>
		<div class="py-4">
			<div class="container">
				<form action="" method="post" id="post_job_form" enctype="multipart/form-data">
					<div class="row">
						<aside class="col-md-5">
							<?php
								if(isset($_REQUEST['token']) && $_REQUEST['token']!="")
								{
									$token=base64_decode($_REQUEST['token']);
									$job_query="SELECT * FROM jobs WHERE id='$token'";
									$job_result=mysqli_query($conn,$job_query);
									if(mysqli_num_rows($job_result)<=0)
									{
										?>
										<script>
											location.href="<?php echo base_url; ?>404";
										</script>
										<?php
									}
									else
									{
										$job_row=mysqli_fetch_array($job_result);
									}
								}
							?>
							<div class="box mb-3 shadow-sm border rounded bg-white profile-box">
								<div class="box-title border-bottom p-3">
									<h6 class="m-0">Video Job Description</h6>
									<p class="mb-0 mt-0 small"><a href="javascript:void(0);" onclick="$('#server_data_1').click();"><i class="feather-settings"></i> click here to change</a></p>
								</div>
								<!--<div class="p-2 border-bottom">
									<h6 class="font-weight-bold">Video Job Description<a href="javascript:void(0);" onclick="$('#server_data_1').click();" style="float:right;"><i class="feather-settings"></i> click here to change</a></h6>
								</div>-->
								<div class="py-3 px-1">
									<video id="server_data_1_privew" controls cotrolsList="nodownload" style="width:100%;">
										<source src="<?php echo base_url.'uploads/'.$job_row['video_description']; ?>" type="video/mp4"></source>
									</video>
								</div>
								<input type="file" accept="video/mp4" style="display:none;" class="form-control" name="video_description" id="server_data_1">
							</div>
							<div class="box mb-3 shadow-sm border rounded bg-white profile-box is_stuck">
								<!--<div class="p-2 border-bottom">
									<h6 class="font-weight-bold">Video Questionnaire<a href="javascript:void(0);" onclick="$('#server_data').click();" style="float:right;"><i class="feather-settings"></i> click here to change</a></h6>
								</div>-->
								<div class="box-title border-bottom p-3">
									<h6 class="m-0">Video Questionnaire</h6>
									<p class="mb-0 mt-0 small"><a href="javascript:void(0);" onclick="$('#server_data').click();"><i class="feather-settings"></i> click here to change</a></p>
								</div>
								<div class="py-3 px-1">
									<video controls cotrolsList="nodownload" id="server_data_file" style="width:100%;">
										<source src="<?php echo base_url.'uploads/'.$job_row['question_description']; ?>" type="video/mp4"></source>
									</video>
								</div>
								<input type="file" accept="video/mp4" style="display:none;" class="form-control" name="question_description" id="server_data">
							</div>
						</aside>
						<main class="col-md-7">
							<div class="border rounded bg-white mb-3" style="min-height:630px;">
								<div class="box-title border-bottom p-3">
									<h6 class="m-0">More Info</h6>
									<p class="mb-0 mt-0 small">Step 2: Screening Options?.</p>
								</div>
								<div class="box-body p-3">
									<div class="col-md-12" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);transition: box-shadow 83ms;background:#fff;padding:10px;padding-bottom:0px;margin: 0 0px 10px;border-radius:2px;border-bottom: 2px solid #ebebd5;min-height:630px;overflow-y:auto;">
										<div class="row">
											<?php
												$status=2;
												$status_result=mysqli_query($conn,"SELECT * FROM job_posting_settings WHERE id=1");
												if(mysqli_num_rows($status_result)>0)
												{
													mysqli_fetch_array($status_result);
													$status=$status_row['job_default_status'];
												}
											?>
											<div class="col-md-12" style="margin-bottom:15px;">
												<h6 style="margin-bottom:7px;">Notice Period <span style="color:red;">*</span></h6>
												<input type="hidden" name="job_id" id="job_id" value="<?php echo base64_decode($_REQUEST['token']); ?>">
												<input type="hidden" name="token" id="token" value="<?php echo $_REQUEST['token']; ?>">
												<input type="hidden" name="status" id="status" value="<?php echo $status; ?>">
												<input name="notice_period" id="immediate" value="Immediate" required type="radio" checked> Can hire Immediately?&nbsp;&nbsp;
												<input name="notice_period" <?php if($job_row['notice_period']=="Later"){ echo 'checked'; } ?> id="later" value="Later" required type="radio">Can hire in&nbsp;&nbsp;<input type="number" id="notice_period_duration" name="notice_period_duration" value="<?php if($job_row['notice_period']=="Later"){ echo $job_row['notice_period_duration']; } ?>" placeholder="   duration?" style="width:80px;height:30px;border-radius:2px;"> &nbsp; <select style="width:80px;height:30px;border-radius:2px;" id="notice_period_duration_term" name="notice_period_duration_term">
													<option value="months" selected>month(s)</option>
													<option value="weeks" <?php if($job_row['notice_period']=="Later"){ if($job_row['notice_period_duration_term']=="weeks"){ echo "selected"; } } ?>>week(s)</option>
													<option value="days" <?php if($job_row['notice_period']=="Later"){ if($job_row['notice_period_duration_term']=="days"){ echo "selected"; } } ?>>day(s)</option>
												</select>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<h6 style="margin-bottom:7px;">No of Positions <span style="color:red;">*</span></h6>
													<input type="number" value="<?php echo $job_row['positions_count']; ?>" name="positions_count" id="positions_count" class="form-control" placeholder="How many vacancies are for this post?">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<h6 style="margin-bottom:7px;">Required Travelling <span style="color:red;">*</span></h6>
													<select type="number" name="travelling_willingness" id="travelling_willingness" class="form-control">
														<option value="No" <?php if($job_row['travelling_willingness']=="No"){ echo 'selected'; } ?>>No, not at all</option>
														<option value="National & International Both" <?php if($job_row['travelling_willingness']=="No"){ echo 'selected'; } ?>>Yes National & Interational Both</option>
														<option value="National & International Both" <?php if($job_row['travelling_willingness']=="National"){ echo 'selected'; } ?>>Yes National</option>
														<option value="Interational" <?php if($job_row['travelling_willingness']=="Interational"){ echo 'selected'; } ?>>Yes Interational</option>
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<h6 style="margin-bottom:7px;">Required work permit? <span style="color:red;">*</span></h6>
													<select type="number" name="work_permit" id="work_permit" class="form-control">
														<option value="1" selected>Yes</option>
														<option value="0" <?php if($job_row['work_permit']=="0"){ echo 'selected'; } ?>>No</option>
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<h6 style="margin-bottom:7px;">Required Languages? </h6>
													<select type="number" name="languages[]" id="languages" multiple="multiple" class="form-control select2">
														<optgroup label="Do you speak?">
															<?php 
																$languages=explode("==",$job_row['languages']);
																$language_query="SELECT * FROM languages WHERE status=1 ORDER BY title ASC";
																$language_result=mysqli_query($conn,$language_query);
																if(mysqli_num_rows($language_result)>0)
																{
																	while($language_row=mysqli_fetch_array($language_result))
																	{
																		?>
																			<option value="<?php echo $language_row['id']; ?>" <?php for($i=0;$i<count($languages);$i++){ if($languages[$i]==$language_row['id']){ echo "selected"; } } ?>><?php echo $language_row['title']; ?></option>
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
													<h6 style="margin-bottom:7px;">Certifications required? </h6>
													<select type="number" name="certifications[]" id="certifications" multiple="multiple" class="form-control select2">
														<optgroup label="Do you have following certificate(s)?">
															<?php 
																$certifications=explode("==",$job_row['certifications']);
																$certifications_query="SELECT * FROM certifications WHERE status=1 ORDER BY title ASC";
																$certifications_result=mysqli_query($conn,$certifications_query);
																if(mysqli_num_rows($certifications_result)>0)
																{
																	while($certifications_row=mysqli_fetch_array($certifications_result))
																	{
																		?>
																			<option value="<?php echo $certifications_row['id']; ?>" <?php for($i=0;$i<count($certifications);$i++){ if($certifications[$i]==$certifications_row['id']){ echo "selected"; } } ?>><?php echo $certifications_row['title']; ?></option>
																		<?php
																	}
																}
															?>
														</optgroup>
													</select>
												</div>
											</div>
											<div class="col-md-12">
												<h6 style="margin-bottom:7px;">Skills Needed?</h6>
												<select id="skills_required"  name="skills_required[]" class="form-control select2" multiple="multiple">
													<?php 
														$skills=explode("==",$job_row['skills']);
														$questions_query="SELECT * FROM common_skills WHERE status=1";
														$questions_result=mysqli_query($conn,$questions_query);
														if(mysqli_num_rows($questions_result)>0)
														{
															while($questions_row=mysqli_fetch_array($questions_result))
															{
																?>
																<option value="<?php echo $questions_row['title']; ?>" <?php for($i=0;$i<count($skills);$i++){ if($skills[$i]==$questions_row['title']){ echo "selected"; } } ?>><?php echo $questions_row['title']; ?></option>
																<?php
															}
														}
													?>
												</select>
												<div style="width:100%;padding:20px;" id="meta_div_for_skills">
													
												</div>
											</div>
											<div class="col-md-12">
												<h6 style="margin-bottom:7px;" style="float:none;">Do you have pre interview questions to ask?<a href="javascript:void(0);" onclick="clone();" style="font-size:12px;float:right;" class="pull-right">
																		<i class="fa fa-plus" style="color:red !important;"></i> &nbsp;
																	</a></h6>
												<div class="row">
													<div class="col-md-12" id="append_to">
														<?php
															$questions=$job_row['questions'];
															if($questions=="" || $questions==null || $questions=="==")
															{
														?>
															<div class="row" style="margin-top:20px;">
																<div class="col-md-10">
																	<input id="qusetions" list="questions_list" name="qusetions[]" class="form-control" placeholder="Either type your own question or select from the list">
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
																<div class="col-md-2">
																	<div class="form-group">
																		
																	</div>
																</div>
															</div>
														<?php
															}
															else
															{
																$questions_arr=explode("==",$questions);
																for($i=0;$i<count($questions_arr);$i++)
																{
																	if($questions_arr[$i]!="")
																	{
																?>
																	<div class="row" style="margin-top:15px;">
																		<div class="col-md-10">
																			<input id="qusetions" list="questions_list" name="qusetions[]" class="form-control" value="<?php echo $questions_arr[$i]; ?>" placeholder="Either type your own question or select from the list">
																		</div>
																		<div class="col-md-2">
																			<div class="form-group">
																				<a href="javascript:void(0);" style="font-size:12px;" onclick="$(this).parent().parent().parent().remove();" style="color:red !important;"><i class="fa fa-trash" style="color:red !important;"></i>&nbsp;</a>
																			</div>
																		</div>
																	</div>
																<?php
																	}
																}
															}
														?>
													</div>
												</div>
												<div style="width:100%;padding:20px;display:none;" id="meta_div_for_qusetions">
													<div class="row" style="margin-top:15px;">
														<div class="col-md-10">
															<input id="qusetions" list="questions_list" name="qusetions[]" class="form-control" placeholder="Either type your own question or select from the list">
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<a href="javascript:void(0);" style="font-size:12px;" onclick="$(this).parent().parent().parent().remove();" style="color:red !important;"><i class="fa fa-trash" style="color:red !important;"></i>&nbsp;</a>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-12" style="margin-top:10px;padding:20px;">
												<button class="btn btn-primary" type="submit" onclick="submitForm();" name="post_job">Publish Job</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</main>
					</div>
				</form>
			</div>
		</div>
		<?php include_once 'scripts.php';  ?>
		<script src="https://cdn.tiny.cloud/1/uvg9xyxkcmqkpjaacpgnzrroxnefi5c72vf0k2u5686rwdmv/tinymce/5/tinymce.min.js"></script>
		<script>tinymce.init({selector:'textarea',height:520,branding:false,resize:false,statusbar:false});</script>
		<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
		<script src="<?php echo base_url; ?>jquery.sticky-kit.js"></script>
		<script>
			$("#notice_period_duration").on("blur keyup focus",function(){
				$("#later").prop("checked",true);
			});
			$("#notice_period_duration_term").change(function(){
				$("#later").prop("checked",true);
			});
			$("#immediate").change(function(){
				if($("#immediate").is(":checked"));
				{
					$("#notice_period_duration").val("");
					$("#notice_period_duration_term").val("months");
				}
			});
			$(".select2").select2();
			var placeSearch, autocomplete;
			var componentForm = {
			  street_number: 'short_name',
			  route: 'long_name',
			  locality: 'long_name',
			  administrative_area_level_1: 'short_name',
			  country: 'long_name',
			  postal_code: 'short_name'
			};
			function initAutocomplete() {
			  autocomplete = new google.maps.places.Autocomplete(
				  document.getElementById('autocomplete'), {types: ['geocode']});

			  autocomplete.setFields(['address_component']);

			  autocomplete.addListener('place_changed', fillInAddress);
			}
			function fillInAddress() {
			  var place = autocomplete.getPlace();
			  console.log(autocomplete);
			  for (var component in componentForm) {
				document.getElementById(component).value = '';
				document.getElementById(component).disabled = false;
			  }

			  for (var i = 0; i < place.address_components.length; i++) {
				var addressType = place.address_components[i].types[0];
				if (componentForm[addressType]) {
				  var val = place.address_components[i][componentForm[addressType]];
				  document.getElementById(addressType).value = val;
				}
			  }
			}
			function geolocate() {
			  if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(function(position) {
				  var geolocation = {
					lat: position.coords.latitude,
					lng: position.coords.longitude
				  };
				  var circle = new google.maps.Circle(
					  {center: geolocation, radius: position.coords.accuracy});
				  autocomplete.setBounds(circle.getBounds());
				});
			  }
			}
			$("#server_data_1").change(function(){
				var $source = $('#server_data_1_privew');
				$source[0].src = URL.createObjectURL(this.files[0]);
				$source.parent()[0].load();
			});
			$("#server_data").change(function(){
				var $source = $('#server_data_file');
				$source[0].src = URL.createObjectURL(this.files[0]);
				$source.parent()[0].load();
			});
			function clone()
			{
				$("#append_to").append($("#meta_div_for_qusetions").html());
			}
			$(".is_stuck").stick_in_parent();
		</script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCa27gHtUg_79772tpFkwzruM89feLVmiI&libraries=places&callback=initAutocomplete" async defer></script>
   </body>
</html>