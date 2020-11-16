<!DOCTYPE html>
<html lang="en">
   <head>
		<?php include_once 'head.php'; ?>
		 <?php
			$job_id="";
			if(isset($_REQUEST['token']) && $_REQUEST['token']!="")
			{
				$job_id=base64_decode($_REQUEST['token']);
			}
			if($job_id!="")
			{
				$job_query="SELECT * FROM jobs WHERE user_id='".$_COOKIE['uid']."' AND id='$job_id'";
				$job_result=mysqli_query($conn,$job_query);
				if(mysqli_num_rows($job_result)>0)
				{
					$job_row=mysqli_fetch_array($job_result);
				}
				else
				{
					?>
					<script>
						window.location.href="<?php echo base_url; ?>404";
					</script>
					<?php
					die();
				}
			}
			$user_id=$_COOKIE['uid'];
			$company_id=$_COOKIE['company_id'];
			if(isset($_POST['continue']))
			{
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
				$job_title=addslashes($_POST['job_title']);
				$paid_as=addslashes($_POST['paid_as']);
				$currency=addslashes($_POST['currency']);
				$job_company=addslashes($_POST['job_company']);
				$company_id=$_POST['company_id'];
				$job_location=addslashes($_POST['job_location']);
				/*============== Google additional Address Info ================*/
					$street_number=addslashes($_POST['street_number']);
					$route=addslashes($_POST['route']);
					$locality=addslashes($_POST['locality']);
					$administrative_area_level_1=addslashes($_POST['administrative_area_level_1']);
					$postal_code=addslashes($_POST['postal_code']);
					$country=addslashes($_POST['country']);
					$latitude=addslashes($_POST['latitude']);
					$longitude=addslashes($_POST['longitude']);
				/*============== Google additional Address Info ================*/
				$min_exp=addslashes($_POST['min_exp']);
				$max_exp=addslashes($_POST['max_exp']);
				$employment_type=addslashes($_POST['employment_type']);
				$seniority=addslashes($_POST['seniority']);
				$industry=addslashes($_POST['industry']);
				$website=addslashes($_POST['website']);
				$salary=addslashes($_POST['salary']);
				$contact_number=addslashes($_POST['contact_number']);
				$email_id=addslashes($_POST['email_id']);
				$job_description=addslashes($_POST['job_description']);
				$additional="";
				if($video_description!="")
				{
					$additional.=",video_description='$video_description'";
				}
				$query="INSERT INTO jobs SET paid_as='$paid_as',currency='$currency',company_id='$company_id',user_id='".$_COOKIE['uid']."',job_title='$job_title',job_company='$job_company',job_location='$job_location',street_number='$street_number',route='$route',locality='$locality',administrative_area_level_1='$administrative_area_level_1',postal_code='$postal_code',country='$country',latitude='$latitude',longitude='$longitude',min_exp='$min_exp',max_exp='$max_exp',employment_type='$employment_type',seniority='$seniority',industry='$industry',website='$website',salary='$salary',video_description='$video_description',contact_number='$contact_number',email_id='$email_id',job_description='$job_description',status=0,added=NOW()";
				if(isset($_POST['job_id']) && $_POST['job_id']!="")
				{
					$job_id=$_POST['job_id'];
					$query="UPDATE jobs SET paid_as='$paid_as',currency='$currency',company_id='$company_id',user_id='".$_COOKIE['uid']."',job_title='$job_title',job_company='$job_company',job_location='$job_location',street_number='$street_number',route='$route',locality='$locality',administrative_area_level_1='$administrative_area_level_1',postal_code='$postal_code',country='$country',latitude='$latitude',longitude='$longitude',min_exp='$min_exp',max_exp='$max_exp',employment_type='$employment_type',seniority='$seniority',industry='$industry',website='$website',salary='$salary'".$additional.",contact_number='$contact_number',email_id='$email_id',job_description='$job_description',status=0,updated=NOW() WHERE id='$job_id'";
				}
				
				if(mysqli_query($conn,$query))
				{
					if(isset($job_id) && $job_id!="" && $job_id!=null)
					{
						
					}
					else
					{
						$job_id=mysqli_insert_id($conn);
					}
					?>
					<script>
						location.href="<?php echo base_url; ?>job-post-advance?token=<?php echo base64_encode($job_id); ?>";
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
		<title><?php if(isset($_REQUEST['token']) && $_REQUEST['token']!=""){ echo "Edit Job"; } else { echo "Post New Job"; } ?> | RopeYou Connects</title>
	</head>
	<style>
		h6{
			font-size: 0.7rem !important;
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
				<div class="row">
				   <!-- Main Content -->
					
					<main class="col-md-8 mx-auto">
						<div class="shadow-sm rounded bg-white mb-3">
							<div class="box-title border-bottom p-3">
								<h5 class="mb-2">Basic Info</h5>
								<p class="mb-0 mt-0 small">Step 1: What job do you want to post?.</p>
							</div>
							<div class="box-body px-2 py-3">
								<div class="col-md-12">
									<form action="" method="post" enctype="multipart/form-data">
										<div class="row">
											<?php
												$job_settings_query="SELECT * FROM job_posting_settings WHERE id=1";
												$job_settings_result=mysqli_query($conn,$job_settings_query);
												$job_settings_row=mysqli_fetch_array($job_settings_result);
											?>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<h6 style="margin-bottom:7px;">Job Title <span style="color:red;">*</span></h6>
													<input type="hidden" name="job_id" id="job_id" value="<?php echo $job_id; ?>">
													<input class="form-control" name="job_title" value="<?php echo $job_row['job_title']; ?>" id="job_title" required title="" type="text" placeholder="e.g, <?php echo $job_settings_row['job_title']; ?>">
												</div>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<h6 style="margin-bottom:7px;">Company Name <span style="color:red;">*</span></h6>
													<input id="job_company" list="questions_list" value="<?php echo $job_row['job_company']; ?>" required name="job_company" class="form-control" placeholder="For which job is being posted">
													<datalist id="questions_list">
														<?php 
															$user_id=$_COOKIE['uid'];
															$companies_printed=array();
															$c_query="SELECT * FROM users_work_experiences WHERE working=1 AND user_id='".$user_id."'";
															$c_result=mysqli_query($conn,$c_query);
															if(mysqli_num_rows($c_result)>0)
															{
																while($c_row=mysqli_fetch_array($c_result))
																{
																	$e_query="SELECT * FROM companies WHERE id='".$c_row['company_id']."'";
																	$e_result=mysqli_query($conn,$e_query);
																	if(mysqli_num_rows($e_result)>0)
																	{
																		$e_row=mysqli_fetch_array($e_result);
																		$companies_printed[]=$e_row['company_id'];
																		?>
																		<option data-id="<?php echo $e_row['id']; ?>" value="<?php echo $e_row['title']; ?>" <?php if($e_row['id']==$company_id){ echo "selected"; $job_company=$e_row['title']; } ?>><?php echo $e_row['title']; ?></option>
																		<?php
																	}
																}
															}
															$c_query="SELECT * FROM companies WHERE user_id='$user_id' AND status=1";
															$c_result=mysqli_query($conn,$c_query);
															$job_company="";
															if(mysqli_num_rows($c_result)>0)
															{
																while($c_row=mysqli_fetch_array($c_result))
																{
																	?>
																	<option data-id="<?php echo $c_row['id']; ?>" value="<?php echo $c_row['title']; ?>" <?php if($c_row['id']==$job_row['company_id']){ echo "selected"; $job_company=$c_row['title']; } ?>><?php echo $c_row['title']; ?></option>
																	<?php
																}
															}
														?>
													</datalist>
													<input type="hidden" name="company_id" id="company_id" value="<?php echo $job_row['company_id']; ?>">
												</div>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group" id="locationField">
													<h6 style="margin-bottom:7px;">Location <span style="color:red;">*</span></h6>
													<input class="form-control" value="<?php echo $job_row['job_location']; ?>" required name="job_location" id="autocomplete" title="" onFocus="geolocate()" type="text" placeholder="e.g, <?php echo $job_settings_row['job_location']; ?>">
													<input type="hidden" id="street_number" value="<?php echo $job_row['street_number']; ?>" name="street_number"/>
													<input type="hidden" id="route" value="<?php echo $job_row['route']; ?>" name="route" />
													<input type="hidden" id="locality" value="<?php echo $job_row['locality']; ?>" name="locality" />
													<input type="hidden" id="administrative_area_level_1" value="<?php echo $job_row['administrative_area_level_1']; ?>" name="administrative_area_level_1" />
													<input type="hidden" value="<?php echo $job_row['postal_code']; ?>" id="postal_code" name="postal_code" />
													<input type="hidden" value="<?php echo $job_row['country']; ?>" id="country" name="country" />
													<input type="hidden" value="<?php echo $job_row['latitude']; ?>" id="lat" name="latitude" />
													<input type="hidden" value="<?php echo $job_row['longitude']; ?>" id="long" name="longitude"/>
												</div>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="row">
													<div class="col-md-6 col-sm-6 col-xs-6">
														<div class="form-group">
															<h6 style="margin-bottom:7px;">Minimum Experience <span style="color:red;">*</span></h6>
															<select id="min_exp" name="min_exp" class="form-control" required>
																<option value="">MIN EXP.</option>
																<?php
																	$min_exp=(int)($job_settings_row['min_exp']);
																	$max_exp=(int)($job_settings_row['max_exp']);
																	for($i=0;$i<=$max_exp;$i++)
																	{
																		?>
																		<option value="<?php echo $i; ?>" <?php if($i==$job_row['min_exp']){ echo "selected"; } ?>><?php echo $i; ?> yrs</option>
																		<?php
																	}
																?>
															</select>
														</div>
													</div>
													<div class="col-md-6 col-sm-6 col-xs-6">
														<div class="form-group">
															<h6 style="margin-bottom:7px;">Maximum Experience</h6>
															<select id="max_exp" name="max_exp" class="form-control">
																<option value="">MAX EXP.</option>
																<?php
																	for($i=$min_exp;$i<=$max_exp;$i++)
																	{
																		?>
																		<option value="<?php echo $i; ?>" <?php if($i==$job_row['max_exp']){ echo "selected"; } ?>><?php echo $i; ?> yrs</option>
																		<?php
																	}
																?>
															</select>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<h6 style="margin-bottom:7px;">Employment Type <span style="color:red;">*</span></h6>
													<select id="employment_type" required name="employment_type" class="form-control">
															<option value="">Employment Type</option>
															<?php
																$emp_query="SELECT * FROM employment_types WHERE status=1 ORDER by title ASC";
																$emp_result=mysqli_query($conn,$emp_query);
																if(mysqli_num_rows($emp_result)>0)
																{
																	while($emp_row=mysqli_fetch_array($emp_result))
																	{
																		?>
																		<option value="<?php echo $emp_row['slug']; ?>" <?php if($job_row['employment_type']==$emp_row['slug']){ echo "selected"; } ?>>
																			<?php echo $emp_row['title']; ?>
																		</option>
																		<?php
																	}
																}
															?>
													</select>
												</div>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<h6 style="margin-bottom:7px;">Seniority Level <span style="color:red;">*</span></h6>
													<select id="seniority" required name="seniority" class="form-control">
														<?php
															$seniority_query="SELECT slug,title FROM seniority WHERE status=1 ORDER BY title ASC";
															$seniority_result=mysqli_query($conn,$seniority_query);
															if(mysqli_num_rows($seniority_result)>0)
															{
																while($seniority_row=mysqli_fetch_array($seniority_result))
																{
																	?>
																	<option value="<?php echo $seniority_row['slug']; ?>" <?php if($job_row['seniority']==$seniority_row['slug']){ echo "selected"; } ?>><?php echo $seniority_row['title']; ?></option>
																	<?php
																}
															}
														?>
													</select>
												</div>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<h6 style="margin-bottom:7px;">Industry <span style="color:red;">*</span></h6>
													<select class="form-control" required name="industry" id="industry">
														<?php
															$industry_query="SELECT slug,title FROM industries WHERE status=1 ORDER BY title ASC";
															$industry_result=mysqli_query($conn,$industry_query);
															if(mysqli_num_rows($industry_result)>0)
															{
																while($industry_row=mysqli_fetch_array($industry_result))
																{
																	?>
																	<option value="<?php echo $industry_row['slug']; ?>" <?php  if($job_row['industry']==$industry_row['slug']){ echo "selected"; } ?>><?php echo $industry_row['title']; ?></option>
																	<?php
																}
															}
														?>
													</select>
												</div>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<h6 style="margin-bottom:7px;">Website</h6>
													<input class="form-control" name="website" id="website" value="<?php echo $job_row['website']; ?>" title="" type="text" placeholder="e.g, <?php echo $job_settings_row['website']; ?>">
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12">
												<div class="form-group">
													<h6 style="margin-bottom:7px;">Salary </h6>
													<input class="form-control" name="salary" value="<?php echo $job_row['website']; ?>" id="salary" title="" type="text" placeholder="e.g, <?php echo $job_settings_row['salary']; ?>">
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12">
												<div class="form-group">
													<h6 style="margin-bottom:7px;">Currency </h6>
													<select class="form-control" name="currency" id="currency" title="">
														<option value="">NA</option>
														<?php
															$country_query="SELECT * FROM country WHERE status=1 AND currency!='' ORDER BY currency";
															$country_result=mysqli_query($conn,$country_query);
															if(mysqli_num_rows($country_result)>0)
															{
																while($country_row=mysqli_fetch_array($country_result))
																{
																	?>
																	<option value="<?php echo $country_row['currency']; ?>" <?php if($job_row['currency']==$country_row['currency']){ echo "selected"; } ?>><?php echo $country_row['currency'].' - '.$country_row['title']; ?></option>
																	<?php
																}
															}
														?>
													</select>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12">
												<div class="form-group">
													<h6 style="margin-bottom:7px;">Paid as</h6>
													<select class="form-control" name="paid_as" id="paid" title="">
														<option value="Annually" selected>Annually</option>
														<option value="Monthly" <?php if($job_row['paid_as']=="Monthly"){ echo 'selected'; } ?>>Monthly</option>
														<option value="Hourly" <?php if($job_row['paid_as']=="Hourly"){ echo 'selected'; } ?>>Hourly</option>
													</select>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12">
												<div class="form-group">
													<h6 style="margin-bottom:7px;">Email ID <span style="color:red;">*</span></h6>
													<input class="form-control" required value="<?php echo $job_row['email_id']; ?>" name="email_id" id="email_id" title="" type="text" placeholder="e.g, <?php echo $job_settings_row['email']; ?>">
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12">
												<div class="form-group">
													<h6 style="margin-bottom:7px;">Contact Number</h6>
													<input class="form-control" value="<?php echo $job_row['email_id']; ?>" name="contact_number" id="contact_number" title="" type="text" placeholder="e.g, <?php echo $job_settings_row['mobile']; ?>">
												</div>
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12">
												<div class="form-group">
													<h6 style="margin-bottom:7px;">Job Description <span style="color:red;">*</span></h6>
													<textarea name="job_description" class="form-control" id="job_description" style="resize:none;" placeholder=""><?php if($job_row['job_description']!=""){ echo $job_row['job_description']; } else { echo $job_settings_row['job_description']; } ?></textarea>
												</div>
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12">
												<div class="form-group">
													<h6 style="margin-bottom:7px;">Upload Video Description</h6>
													<input type="file" name="video_description" accept=".mp4" class="form-control" id="video_description">
												</div>
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12" id="video_description_preview" style="margin-top:20px;">
												<?php
													if($job_row['video_description']!="" && $job_row['video_description']!=null)
													{
														?>
														<video controls controlsList="nodownload" id='video_description_ele' style='width:100%;'>
															<source src="<?php echo base_url.'uploads/'.$job_row['video_description']; ?>" type='video/mp4'></source>
														</video>
														<?php
													}
												?>
												
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12 text-right">
												<button class="btn btn-primary" type="submit" name="continue">Continue</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
				   </main>
				</div>
			</div>
		</div>
		<?php include_once 'scripts.php';  ?>
		<script src="https://cdn.tiny.cloud/1/uvg9xyxkcmqkpjaacpgnzrroxnefi5c72vf0k2u5686rwdmv/tinymce/5/tinymce.min.js"></script>
		<script>tinymce.init({selector:'textarea',height:520,branding:false,resize:false,statusbar:false});</script>
		<script>
			$("#job_company").change(function(){
				var job_company=$("#job_company").val();
				if(job_company=="")
				{
					$("#company_id").val('');
				}
				else
				{
					$("#company_id").val($("#job_company option:selected").text());
					//console.log($("#company_id option:selected").text());
				}
			});
			
			$("#video_description").change(function(){
				//var domele=$('#video_description_preview');
				var dom_data="<video controls id='video_description_ele' style='width:100%;'><source src='"+URL.createObjectURL(this.files[0])+"' type='video/mp4'></source></video>";
				$('#video_description_preview').html(dom_data);
				$("#video_description_ele").load();
				//$source[0].src = URL.createObjectURL(this.files[0]);
				//$source.parent()[0].load();
			});
		</script>
		<script>
		
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
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCa27gHtUg_79772tpFkwzruM89feLVmiI&libraries=places&callback=initAutocomplete" async defer></script>
   </body>
</html>
