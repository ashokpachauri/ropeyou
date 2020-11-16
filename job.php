<!DOCTYPE html>
<html lang="en">
	<head>
		<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
		<?php include_once 'head.php'; ?>
		<?php
			$job_settings_query="SELECT * FROM job_posting_settings WHERE id=1";
			$job_settings_result=mysqli_query($conn,$job_settings_query);
			$job_settings_row=mysqli_fetch_array($job_settings_result);

			//$company_id=$jobs_row['company_id'];
			$job_slug="";
			if(isset($_POST['additional_message']))
			{
				$additional_message=addslashes(filter_var($_POST['additional_message'],FILTER_SANITIZE_STRING));
				$cart_job_id=$_POST['cart_job_id'];
				$cquery="SELECT * FROM job_cart WHERE user_id='".$_COOKIE['uid']."' AND job_id='$cart_job_id'";
				$cresult=mysqli_query($cquery);
				if(mysqli_num_rows($cresult)>0)
				{
					?>
					<script>
						alert("already saved");
					</script>
					<?php
				}
				else
				{
					if(mysqli_query($conn,"INSERT INTO job_cart SET user_id='".$_COOKIE['uid']."',job_id='$cart_job_id',status=1,added=NOW(),additional_message='$additional_message'"))
					{
						?>
						<script>
							alert("saved successfully");
						</script>
						<?php
					}
					else
					{
						?>
						<script>
							alert("some technical issue please contact developer");
						</script>
						<?php
					}
				}
			}
			if(isset($_POST['add_job_alert']))
			{
				$keywords=$_POST['keywords'];
				$company_id=$_POST['company_id'];
				$country=$_POST['country'];
				$cities=implode("==",$_POST['cities']);
				$experience=$_POST['experience'];
				$expected_salery=$_POST['expected_salery'];
				$currency=$_POST['currency'];
				$paid_as=$_POST['paid_as'];
				$industry=$_POST['industry'];
				$functional_area=$_POST['functional_area'];
				$role=$_POST['role'];
				$alert_name=$_POST['alert_name'];
				$job_alert_query="INSERT INTO users_job_alerts SET user_id='".$_COOKIE['uid']."',company_id='$company_id',keywords='$keywords',country='$country',cities='$cities',experience='$experience',expected_salery='$expected_salery',currency='$currency',paid_as='$paid_as',industry='$industry',functional_area='$functional_area',role='$role',alert_name='$alert_name'";
				$job_alert_result=mysqli_query($conn,$job_alert_query);
				if($job_alert_result)
				{
					?>
					<script>
						alert('job alert has been created successfully.');
					</script>
					<?php
				}
				else
				{
					?>
					<script>
						alert('there is some technical error in creating job alert.');
					</script>
					<?php
				}

			}
			if(isset($_POST['apply_on_job']))
			{
				$first_name=$_POST['first_name'];
				$last_name=$_POST['last_name'];
				$email=$_POST['email'];
				$mobile=$_POST['mobile'];
				
				$user_query="SELECT * FROM users WHERE id='".$_COOKIE['uid']."'";
				$user_result=mysqli_query($conn,$user_query);
				if(mysqli_num_rows($user_result)>0)
				{
					$user_data=mysqli_fetch_array($user_result);
				}
				else
				{
					?>
					<script>
						window.location.href='<?php echo bse_url."logout"; ?>';
					</script>
					<?php
					die();
				}
				$job_id=$_POST['job_id'];
				$company_id=$_POST['company_id'];
				$experience=$_POST['experience'];
				$expected_salery=$_POST['expected_salery'];
				$currency=$_POST['currency'];
				$paid_as=$_POST['paid_as'];
				$custom_message=addslashes($_POST['custom_message']);
				$work_permission="";
				$travelling_willingness="";
				$uploadOk=1;
				if(isset($_POST['work_permission']))
				{
					$work_permission=$_POST['work_permission'];
				}
				if(isset($_POST['travelling_willingness']))
				{
					$travelling_willingness=$_POST['travelling_willingness'];
				}
				$languages="";
				if(isset($_POST['languages']))
				{
					$languages=implode("==",$_POST['languages']);
				}
				$questions="";
				if(isset($_POST['questions']))
				{
					$questions=implode("==",$_POST['questions']);
				}
				$answers="";
				if(isset($_POST['answers']))
				{
					$answers=implode("==",$_POST['answers']);
				}
				$doc_cv="";
				if(isset($_POST['uploaded_cv']) && $_POST['uploaded_cv']!="")
				{
					$doc_cv=$_POST['uploaded_cv'];
				}
				else
				{
					if(isset($_FILES['doc_cv']['name']) && $_FILES['doc_cv']['name']!="")
					{
						$target_dir="uploads/";
						$doc_cv=$user_data['username'].'-'.mt_rand(0,99999).'-'.str_replace(" ","-",trim(basename($_FILES["doc_cv"]["name"])));
						$target_file = $target_dir . $doc_cv;
						$uploadOk = 1;
						$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
						$size=$_FILES["doc_cv"]["size"];
						if ($size > 50000000) {
							$error_message="File size should not exceeds 50 mb.<br/>";
							$uploadOk = 0;
							$doc_cv="";
						}
						$check_array=array("pdf","doc","docx");
						if(!in_array($imageFileType,$check_array))
						{
							$error_message=$error_message."pdf,doc,docx formats are allowed.<br/>";
							$uploadOk = 0;
							$doc_cv="";
						}
						if($uploadOk=="1")
						{
							if(move_uploaded_file($_FILES["doc_cv"]["tmp_name"], $target_file))
							{
								$uploadOk=1;
								
							}
							else
							{
								$uploadOk=0;
								$doc_cv="";
								$error_message=$error_message." error uploading file<br/>";
							}
						}
					}
				}
				if(isset($_FILES['video_cv']['name']) && $_FILES['video_cv']['name']!="" && $uploadOk==1)
				{
					$target_dir="uploads/";
					$video_cv=$user_data['username'].'-'.mt_rand(0,99999).'-'.str_replace(" ","-",trim(basename($_FILES["video_cv"]["name"])));
					$target_file = $target_dir . $video_cv;
					$uploadOk = 1;
					$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
					$size=$_FILES["video_cv"]["size"];
					if ($size > 50000000) {
						$error_message="File size should not exceeds 50 mb.<br/>";
						$uploadOk = 0;
						$video_cv="";
					}
					$check_array=array("mp4");
					if(!in_array($imageFileType,$check_array))
					{
						$error_message=$error_message."mp4 format is allowed.<br/>";
						$uploadOk = 0;
						$video_cv="";
					}
					if($uploadOk=="1")
					{
						if(move_uploaded_file($_FILES["video_cv"]["tmp_name"], $target_file))
						{
							$uploadOk=1;
							
						}
						else
						{
							$uploadOk=0;
							$video_cv="";
						}
					}
				}
				if($uploadOk==1)
				{
					$apply_query="INSERT INTO job_applications SET user_id='".$_COOKIE['uid']."',company_id='$company_id',job_id='$job_id',first_name='$first_name',last_name='$last_name',email='$email',mobile='$mobile',job_apply_doc_cv='$doc_cv',job_apply_video_cv='$video_cv',custom_message='$custom_message',questions='$questions',answers='$answers',travelling_willingness='$travelling_willingness',work_permit='$work_permission',languages='$languages',expected_salery='$expected_salery',currency='$currency',paid_as='$paid_as',experience='$experience',added=NOW()";
					if(mysqli_query($conn,$apply_query))
					{
						?>
							<script>
								alert('applied successfully.');
							</script>
						<?php
					}
					else
					{
						?>
							<script>
								alert('there is some problem in applying to this job.');
							</script>
						<?php
					}
				}
				else
				{
					?>
					<script>
						alert('error uploading resume.');
					</script>
					<?php
				}
			}
			if(isset($_REQUEST['job_tag']) && $_REQUEST['job_tag']!="")
			{
				$job_tag=$_REQUEST['job_tag'];
				$job_slug=$job_tag;
				$break=explode("-",$job_tag);
				$mixture=explode(".html",end($break));
				$job_id=$mixture[0];
				$jobs_query="SELECT * FROM jobs WHERE id='$job_id' ORDER BY added DESC";
				$jobs_result=mysqli_query($conn,$jobs_query);
				$num_rows=mysqli_num_rows($jobs_result);
				$jobs_row=mysqli_fetch_array($jobs_result);
				$company_id=$jobs_row['company_id'];
				$og_title=$jobs_row['job_title']." ".strtoupper($jobs_row['job_company']);
				
				$og_title=trim(strtolower($jobs_row['job_title']))." ".trim(strtolower($jobs_row['job_company']));
				$og_url=str_replace(" ","-",$og_title);
				
				$og_url=$og_url."-".$jobs_row['id'].".html";
				
				$og_description=$jobs_row['job_description'];
				?>
				<title><?php echo $og_title; ?></title>
				<meta property="og:url" content="<?php echo base_url.'job/'.$og_url; ?>" />
				<meta property="og:type" content="website" />
				<meta property="og:title" content="<?php echo $og_title; ?>" />
				<meta property="og:description" content="<?php echo substr(strip_tags($og_description),0,100); ?>" />
				<meta property="og:image" content="<?php echo base_url.'uploads/@my_tag.jpg'; ?>" />
				<meta property="fb:app_id" content="465307587452391" />
				<?php
			}
			else
			{
				?>
				<title>Recruiters, Jobs & Social Network | RopeYou Connects</title>
				<meta property="og:url" content="<?php echo base_url."jobs"; ?>" />
				<meta property="og:type" content="website" />
				<meta property="og:title" content="Recruiters, Jobs & Social Network" />
				<meta property="og:description" content="Recruiters & Social Network,Video CV,Video Interviews" />
				<meta property="og:image" content="https://ropeyou.com/uploads/@my_tag.jpg"/>
				<meta property="fb:app_id" content="465307587452391"/>
				
				<meta http-equiv="content-type" content="text/html; charset=utf-8" />
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<?php
			}
			$company_query="SELECT * FROM companies WHERE id='$company_id'";
			$company_result=mysqli_query($conn,$company_query);
			
			$banner_image_preview= base_url.'uploads/banner-tab-placeholder.png';
			if(mysqli_num_rows($company_result)>0)
			{
				$company_row=mysqli_fetch_array($company_result);
				if($company_row['banner_image']!=""){ $banner_image_preview= $company_row['banner_image']; }
			}
		?>
	</head>
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" rel="stylesheet">
	<body>
		<?php include_once 'header.php'; ?>
		<?php
			$job_query="SELECT * FROM jobs WHERE id='$job_id'";
			$job_result=mysqli_query($conn,$job_query);
			$job_row=mysqli_fetch_array($job_result);
			
			$company_id=$job_row['company_id'];
			$company_query="SELECT * FROM companies WHERE id='$company_id'";
			$company_result=mysqli_query($conn,$company_query);
			if(mysqli_num_rows($company_result)>0)
			{
				$company_row=mysqli_fetch_array($company_result);
			}
		?>
		<!--<div class="profile-cover text-center">
			<img class="img-fluid" src="<?php echo $banner_image_preview; ?>" alt="<?php echo $company_row['title']; ?>">
		</div>-->
		<div class="bg-white shadow-sm border-bottom">
			<div class="container">
				<div class="row">
					<?php
				   		$user_query="SELECT * FROM users WHERE id='".$_COOKIE['uid']."'";
				   		$user_result=mysqli_query($conn,$user_query);
				   		$user_row=null;
				   		if(mysqli_num_rows($user_result)>0)
				   		{
				   			$user_row=mysqli_fetch_array($user_result);
				   		}
						$applied_query="SELECT * FROM job_applications WHERE job_id='".$job_row['id']."' AND user_id='".$_COOKIE['uid']."'";
						$applied_result=mysqli_query($conn,$applied_query);
						$applied_num_rows=mysqli_fetch_array($applied_result);
						
						$job_cart_query="SELECT * FROM job_cart WHERE job_id='".$job_row['id']."' AND user_id='".$_COOKIE['uid']."'";
						$job_cart_result=mysqli_query($conn,$job_cart_query);
						$saved_num_rows=mysqli_fetch_array($job_cart_result);
				   ?>
				   	<div class="col-md-12">
					  <div class="d-flex align-items-center py-3">
						 <div class="profile-left">
							<h5 class="font-weight-bold text-dark mb-1 mt-0"><?php echo $job_row['job_title']; ?></h5>
							<p class="mb-0 text-muted"><a class="mr-2 font-weight-bold" href="<?php echo base_url; ?>ru-comp/<?php echo strtolower(str_replace(" ","-",$job_row['job_company']));if($company_row['id']!=""){ echo "-".$company_row['id']; } ?>"><?php echo $job_row['job_company']; ?></a> <i class="feather-map-pin"></i> <?php echo $job_row['job_location']; ?> -- DatePosted <?php echo date("d-m-Y",strtotime($jobs_row['added'])); ?></p><?php echo $error_message; ?>
						 </div>
						 <div class="profile-right ml-auto">
							<?php
								if($saved_num_rows<=0)
								{
							?>
								<button type="button" class="btn btn-light mr-1" data-toggle="modal" data-target="#add_job_to_cart_modal"> &nbsp; Save &nbsp; </button>
							<?php
								}
								else
								{
									?>
									<button type="button" class="btn btn-danger" disabled> &nbsp; Saved &nbsp; </button>
									<?php
								}
								if($applied_num_rows<=0)
								{
							?>
									<button type="button" class="btn btn-primary" <?php if($user_row==null){} ?> data-toggle="modal" data-target="#job_application_form_modal"> &nbsp; Apply &nbsp; </button>
							<?php
								}
								else
								{
									?>
									<button type="button" class="btn btn-success" disabled> &nbsp; Applied &nbsp; </button>
									<?php
								}
							?>
						 </div>
					  </div>
				   	</div>
					   <div class="modal fade add_job_to_cart_modal" id="add_job_to_cart_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="jadd_job_to_cart_modal_backdrop" aria-hidden="true">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h6 class="modal-title" id="add_job_to_cart_modal_backdrop">Save  '<?php echo $job_row['job_title']; ?> at <?php echo $job_row['job_company']; ?>' to your cart</h6>
								</div>
								<div class="modal-body">	
									<form action="" method="post" id="job_cart_form" enctype="multipart/form-data">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label>Additional Message</label>
													<textarea rows="3" name="additional_message" class="form-control" style="resize:none;"></textarea>
													<input type="hidden" name="cart_job_id" value="<?php echo $job_row['id']; ?>">
												</div>
											</div>
											<div class="col-md-12">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
												<button type="submit" class="btn btn-primary" name="save_on_job">Save</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				
				   	<div class="modal fade job_application_form_modal" id="job_application_form_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="job_application_form_modal_backdrop" aria-hidden="true">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h6 class="modal-title" id="job_application_form_modal_backdrop">Apply for <?php echo $job_row['job_title']; ?></h6>
								</div>
								<div class="modal-body">	
									<form action="" method="post" id="job_alert_form" enctype="multipart/form-data">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>First Name</label>
													<input type="hidden" name="job_id" value="<?php echo $job_row['id']; ?>">
													<input type="hidden" name="company_id" value="<?php echo $job_row['company_id']; ?>">
													<input type="text" value="<?php echo $user_row['first_name']; ?>" class="form-control" id="first_name" name="first_name" placeholder="First Name" required>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Last Name</label>
													<input type="text" value="<?php echo $user_row['last_name']; ?>" class="form-control" id="last_name" name="last_name" placeholder="Last Name" required>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Email ID</label>
													<input type="text" class="form-control" value="<?php echo $user_row['email']; ?>" id="email_id" name="email" placeholder="Your email id" required>
													<input type="hidden" name="company_id" id="job_alert_company_id" class="job_alert_company_id" value="<?php echo $company_id; ?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Mobile</label>
													<input type="text" value="<?php echo $user_row['mobile']; ?>" class="form-control" id="mobile" name="mobile" placeholder="Your Mobile" required>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Work Exp</label>
													<?php
														$min_exp=(int)($job_settings_row['min_exp']);
														$max_exp=(int)($job_settings_row['max_exp']);
													?>
													<select class="form-control" id="job_alert_experience" name="experience" required>
														<?php
															for($i=0;$i<=$max_exp;$i++)
															{
																?>
																<option value="<?php echo $i; ?>" <?php if($i==$min_exp){ echo "selected"; } ?>><?php echo $i; ?> yrs</option>
																<?php
															}
														?>
													</select>
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<label>Expected Salery</label>
													<input type="text" class="form-control" id="job_alert_expected_salery" name="expected_salery" placeholder="your expected salery" required>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Currency</label>
													<select id="job_alert_currency" name="currency" class="form-control" required>
														<?php
															//GROUP BY currency
															$country_query="SELECT * FROM country WHERE status=1 ORDER BY currency";
															$country_result=mysqli_query($conn,$country_query);
															if(mysqli_num_rows($country_result)>0)
															{
																while($country_row=mysqli_fetch_array($country_result))
																{
																	?>
																	<option value="<?php echo $country_row['id']; ?>" <?php if($country_row['title']=="United States"){ echo "selected"; } ?>><?php echo $country_row['currency'].' - '.$country_row['title']; ?></option>
																	<?php
																}
															}
														?>
													</select>
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<label>Paid as</label>
													<select id="job_alert_paid_as" name="paid_as" class="form-control" required>
														<option value="Annually" selected>Annually</option>
														<option value="Monthly">Monthly</option>
														<option value="Hourly">Hourly</option>
													</select>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label>Custom Message</label>
													<textarea rows="3" name="custom_message" class="form-control" style="resize:none;"></textarea>
												</div>
											</div>
											<?php
												$work_permit=$job_row['work_permit'];
												if($work_permit=="1")
												{
													?>
													<div class="col-md-6">
														<div class="form-group">
															<label>do you have authority to work at this job location?</label>
															<select class="form-control" name="work_permission" required>
																<option value="0">No</option>
																<option value="1">Yes</option>
															</select>
														</div>
													</div>
													<?php
												}
												$languages=$job_row['languages'];
												if($languages!="")
												{
											?>
											<div class="col-md-6">
												<div class="form-group">
													<h6 style="margin-bottom:7px;">do you speak? </h6>
													<select type="number" name="languages[]" style="width:100%;" id="languages" multiple="multiple" class="form-control select2">
														<optgroup label="Do you speak?">
															<?php 
																$languages=explode("==",$job_row['languages']);
																$language_query="SELECT * FROM languages WHERE status=1 ORDER BY title ASC";
																$language_result=mysqli_query($conn,$language_query);
																if(mysqli_num_rows($language_result)>0)
																{
																	while($language_row=mysqli_fetch_array($language_result))
																	{
																		for($i=0;$i<count($languages);$i++){ 
																			if($languages[$i]==$language_row['id']){ 
																				?>
																				<option value="<?php echo $language_row['id']; ?>"><?php echo $language_row['title']; ?></option>
																				<?php
																			} 
																		}
																	}
																}
															?>
														</optgroup>
													</select>
												</div>
											</div>
											<?php
												}
												$qusetions=$job_row['qusetions'];
												if($qusetions!="")
												{
													$qusetions_arr=explode("==",$qusetions);
													if(count($qusetions_arr)!=0)
													{
														for($i=0;$i<count($qusetions_arr);$i++)
														{
															if($qusetions_arr[$i]!="")
															{
																?>
																<div class="col-md-6">
																	<div class="form-group">
																		<label><?php echo $qusetions_arr[$i]; ?></label>
																		<input type="text" name="answers" class="form-control" placeholder="Your answer">
																	</div>
																</div>
																<?php
															}
														}
													}
												}
												$travelling_willingness=$job_row['travelling_willingness'];
												if($travelling_willingness!="" && $travelling_willingness!="No")
												{
													?>
													<div class="col-md-6">
														<div class="form-group">
															<label><?php echo $travelling_willingness; ?> required do you agree?</label>
															<select class="form-control" name="travelling_willingness" required>
																<option value="Yes">Yes</option>
																<option value="No">No</option>
															</select>
														</div>
													</div>
													<?php
												}
											?>
											<div class="col-md-6">
												<div class="form-group">
													<label>Resume Doc</label>
													<input type="file" id='job_apply_doc_cv' accept=".pdf,.doc,.docx" name="doc_cv" class="form-control">
												</div>
											</div>
											<div class="col-md-6">
												<?php
													$v_query="SELECT * FROM users_resume WHERE user_id='".$_COOKIE['uid']."' AND profile_type!=1 AND is_default=1 ORDER BY id DESC";
													$v_result=mysqli_query($conn,$v_query);
													$video_num_rows=mysqli_num_rows($v_result);
													$video_file="mov_bbb.mp4";
													$token_video="";
													if($video_num_rows>0)
													{
														$profile_percentage=$profile_percentage+10;
														$v_row=mysqli_fetch_array($v_result);
														$video_file=base_url.$v_row['file'];
														$video_tags=$v_row['video_tags'];
														$profile_title=$v_row['profile_title'];
														$video_type=$v_row['video_type'];
														$token_video=$v_row['id'];
														$resume_headline=$v_row['resume_headline'];
													}
												?>
												<div class="form-group">
													<label>Video CV</label><i class="fa fa-cog pull-right" style="font-size:16px;cursor:pointer;" onclick="$('#job_apply_video_cv').click();"></i>
													<input type="file" style="display:none;" id="job_apply_video_cv" name="video_cv" class="form-control">
													<video id="job_apply_video_cv_preview" controls controlsList="nodownload" style="width:100%;">
														<source src="<?php echo $video_file; ?>" type="video/mp4"></source>
													</video>
												</div>
											</div>
											<div class="col-md-12">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
												<button type="submit" class="btn btn-primary" name="apply_on_job">Apply</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="py-4">
			<div class="container">
				<div class="row">
				   <!-- Main Content -->
				   <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
					<?php
						if($job_row['video_description']!="")
						{
					?>
							<div class="box shadow-sm border rounded bg-white mb-3">
								<div class="box-title border-bottom p-3">
									<h6 class="m-0">Video Job Description</h6>
								</div>
								<div class="box-body p-3">
									<iframe src="<?php echo base_url.'uploads/'.$job_row['video_description'].'?controlsList=nodownload'; ?>" frameborder="0" allow="accelerometer;  encrypted-media; gyroscope; picture-in-picture;nodownload;" allowfullscreen style="width:100%;height:auto;"></iframe>
									<!--<video id="" controls controlsList="nodownload" style="width:100%;">
										<source src="<?php echo base_url.'uploads/'.$job_row['video_description']; ?>" type="video/mp4"></source>
									</video>-->
								</div>
							</div>
					<?php
						}
						if($job_row['job_description']!="")
						{
					?>
						<div class="box shadow-sm border rounded bg-white mb-3">
							 <div class="box-title border-bottom p-3">
								<h6 class="m-0">Job Description</h6>
							 </div>
							 <div class="box-body p-3">
								<p><?php echo $job_row['job_description']; ?></p>
							 </div>
						</div>
					<?php
						}
					?>
					  <div class="box shadow-sm border rounded bg-white mb-3">
						 <div class="box-title border-bottom p-3">
							<h6 class="m-0">Job Details</h6>
						 </div>
						 <div class="box-body">
							<table class="table table-borderless mb-0">
							   <tbody>
									<?php
										if($jobs_row['notice_period']=="Immediate")
										{
											?>
											<tr class="border-bottom">
												 <th class="p-3">Hiring </th>
												 <td class="p-3"><i class="fa fa-clock-o"></i>&nbsp;Urgent Hiring </td>
											</tr>
											<?php
										}
									?>
									<tr class="border-bottom">
										<th class="p-3">Salery</th>
										<td class="p-3">
											<i class="fa fa-credit-card"></i>&nbsp; <?php if($jobs_row['salary']!=""){ echo $jobs_row['salary']; } else { echo "Not disclosed."; } ?> .
										</td>
									</tr>
									<tr class="border-bottom">
										<th class="p-3">Seniority Level</th>
										<td class="p-3"><?php echo ucwords(strtolower(str_replace("_"," ",$job_row['seniority']))); ?></td>
									</tr>
									<tr class="border-bottom">
										<th class="p-3">Industry</th>
										<td class="p-3">
											<?php
												$industry=$jobs_row['industry'];
												$industry_query="SELECT title FROM industries WHERE slug='$industry'";
												$industry_result=mysqli_query($conn,$industry_query);
												if(mysqli_num_rows($industry_result)>0)
												{
													$industry_row=mysqli_fetch_array($industry_result);
													echo $industry_row['title'];
												}
												else{
													echo $industry;
												}
											?>
										</td>
									</tr>
									<tr class="border-bottom">
										<th class="p-3">Employment Type</th>
										<td class="p-3">
											<?php
												if($jobs_row['employment_type']=="FULL_TIME")
												{
													echo "Full Time";
												}
												else if($jobs_row['employment_type']=="PART_TIME")
												{
													echo "Part Time";
												}
												else if($jobs_row['employment_type']=="CONTRACT")
												{
													echo "Contract";
												}
												else if($jobs_row['employment_type']=="TEMPORARY")
												{
													echo "Temporary";
												}
												else if($jobs_row['employment_type']=="VOLUNTEER")
												{
													echo "Volunteer";
												}
												else if($jobs_row['employment_type']=="INTERNSHIP")
												{
													echo "Internship";
												}
											?>
										</td>
									</tr>
									<tr class="border-bottom">
										<th class="p-3">Job Functions</th>
										<td class="p-3">Other</td>
									</tr>
							   </tbody>
							</table>
						 </div>
					  </div>
					  <?php
						if(isset($company_row) && !empty($company_row))
						{
							$company_id=$jobs_row['company_id'];
							$company_query="SELECT * FROM companies WHERE id='$company_id' AND status=1";
							$company_result=mysqli_query($conn,$company_query);
							if(mysqli_num_rows($company_result)>0)
							{
								$company_row=mysqli_fetch_array($company_result);
								?>
									<div class="box mb-3 shadow-sm border rounded bg-white osahan-post">
										<div class="p-3 d-flex align-items-center border-bottom osahan-post-header">
											<div class="dropdown-list-image mr-3">
											  
											   <?php
													/*$company_logo=base_url."img/p6.png";
													if($company_row['image']!="" && $company_row['image']!=null)
													{
														$company_logo=base_url.'uploads/'.$company_row['image'];
													}*/

											   ?>
											   <a href="<?php echo base_url; ?>ru-comp/<?php echo strtolower(str_replace(" ","-",$job_row['job_company']));if($company_row['id']!=""){ echo "-".$company_row['id']; } ?>">
												<img class="rounded-circle" src="<?php echo getCompanyLogo($company_id); ?>" alt="<?php echo $company_row['title']; ?>">
											</div>
											<div class="font-weight-bold">
											   <div class="text-truncate"><a href="<?php echo base_url; ?>ru-comp/<?php echo strtolower(str_replace(" ","-",$job_row['job_company']));if($company_row['id']!=""){ echo "-".$company_row['id']; } ?>"><?php echo $company_row['title']; ?> <?php if($company_row['tagline']!="") { echo " || ".$company_row['tagline'];} ?></a></div>
											   <div class="small text-gray-500">IT Computers & Software | 24,044 followers</div>
											</div>
											<span class="ml-auto"><button type="button" class="btn btn-light"><i class="feather-plus"></i> Follow</button></span>
									</div>
									<?php
										if($company_row['banner_image']!="" && $company_row['banner_image']!=null)
										{
											?>
											<img src="<?php echo $company_row['banner_image']; ?>" class="img-fluid" alt="<?php echo $company_row['title']; ?>">
											<?php
										}
									?>
									<div class="p-3 osahan-post-body">
											<h5 class="mb-3">About us</h5>
											<p><?php echo $company_row['about']; ?></p>
										</div>
										<div class="p-3 osahan-post-body">
											<h5 class="mb-3">Specialities</h5>
											<p><?php echo $company_row['specialities']; ?></p>
										</div>
										<div class="overflow-hidden border-top text-center">
											<a class="font-weight-bold p-3 d-block" href="<?php echo base_url; ?>ru-comp/<?php echo strtolower(str_replace(" ","-",$job_row['job_company']));if($company_row['id']!=""){ echo "-".$company_row['id']; } ?>"> READ MORE </a>
										</div>
									</div>
								<?php
							}
						}
					  ?>
					</main>
				   <aside class="col col-xl-3 order-xl-1 col-lg-6 order-lg-2 col-md-6 col-sm-6 col-12">
					  <div class="box mb-3 shadow-sm border rounded bg-white profile-box text-center">
						 <div class="p-5">
							<img src="<?php echo getCompanyLogo($company_id); ?>" class="img-fluid" alt="Responsive image">
						 </div>
						 <div class="p-3 border-top border-bottom">
							<h5 class="font-weight-bold text-dark mb-1 mt-0"><?php echo $job_row['job_title']; ?></h5>
							<p class="mb-0 text-muted"><?php echo $job_row['job_location']; ?>
							</p>
						 </div>
						 <div class="p-3">
							<div class="d-flex align-items-top mb-2">
							   <p class="mb-0 text-muted">Posted</p>
							   <p class="font-weight-bold text-dark mb-0 mt-0 ml-auto"><?php echo date("d-m-Y",strtotime($jobs_row['added'])); ?></p>
							</div>
						 </div>
					  </div>
					  <div class="box shadow-sm mb-3 rounded bg-white ads-box text-center">
						 <img src="<?php echo base_url; ?>img/job1.png" class="img-fluid" alt="Responsive image">
						 <div class="p-3 border-bottom">
							<h6 class="font-weight-bold text-dark">Ropeyou Solutions</h6>
							<p class="mb-0 text-muted">Looking for talent?</p>
						 </div>
						 <div class="p-3">
							<button type="button" class="btn btn-outline-primary pl-4 pr-4"> POST A JOB </button>
						 </div>
					  </div>
				   </aside>
				   <div class="modal fade free_alert_modal" id="free_alert_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="free_alert_modalBackdrop" aria-hidden="true">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h6 class="modal-title" id="free_alert_modalBackdrop">Create a free job alert</h6>
								</div>
								<div class="modal-body">	
									<form action="" method="post" id="job_alert_form">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label>Keywords</label>
													<input type="text" class="form-control" id="keywords" name="keywords" placeholder="Skills, Roles, Designations, Companies" required>
													<input type="hidden" name="company_id" id="job_alert_company_id" class="job_alert_company_id" value="<?php echo $company_id; ?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Location</label>
													<select id="job_alert_country" name="country" class="form-control select2" style="width:100%;" required>
														<?php
															$country_query="SELECT * FROM country WHERE status=1 ORDER BY title";
															$country_result=mysqli_query($conn,$country_query);
															if(mysqli_num_rows($country_result)>0)
															{
																while($country_row=mysqli_fetch_array($country_result))
																{
																	?>
																	<option value="<?php echo $country_row['id']; ?>"><?php echo $country_row['title']; ?></option>
																	<?php
																}
															}
														?>
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Location</label>
													<select id="job_alert_cities" name="cities[]" multiple="multiple" class="form-control select2" style="width:100%;" required>
														<?php
															$country_query="SELECT * FROM country WHERE status=1 ORDER BY title";
															$country_result=mysqli_query($conn,$country_query);
															if(mysqli_num_rows($country_result)>0)
															{
																while($country_row=mysqli_fetch_array($country_result))
																{
																	?>
																	<option value="<?php echo $country_row['id']; ?>"><?php echo $country_row['title']; ?></option>
																	<?php
																}
															}
														?>
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Work Exp</label>
													<?php
														$min_exp=(int)($job_settings_row['min_exp']);
														$max_exp=(int)($job_settings_row['max_exp']);
													?>
													<select class="form-control" id="job_alert_experience" name="experience" required>
														<?php
															for($i=0;$i<=$max_exp;$i++)
															{
																?>
																<option value="<?php echo $i; ?>" <?php if($i==$min_exp){ echo "selected"; } ?>><?php echo $i; ?> yrs</option>
																<?php
															}
														?>
													</select>
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<label>Expected Salery</label>
													<input type="text" class="form-control" id="job_alert_expected_salery" name="expected_salery" placeholder="your expected salery" required>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Currency</label>
													<select id="job_alert_currency" name="currency" class="form-control" required>
														<?php
															//GROUP BY currency
															$country_query="SELECT * FROM country WHERE status=1 ORDER BY currency";
															$country_result=mysqli_query($conn,$country_query);
															if(mysqli_num_rows($country_result)>0)
															{
																while($country_row=mysqli_fetch_array($country_result))
																{
																	?>
																	<option value="<?php echo $country_row['id']; ?>" <?php if($country_row['title']=="United States"){ echo "selected"; } ?>><?php echo $country_row['currency'].' - '.$country_row['title']; ?></option>
																	<?php
																}
															}
														?>
													</select>
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<label>Paid as</label>
													<select id="job_alert_paid_as" name="paid_as" class="form-control" required>
														<option value="Annually" selected>Annually</option>
														<option value="Monthly">Monthly</option>
														<option value="Hourly">Hourly</option>
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Industry</label>
													<input type="text" class="form-control" id="job_alert_industry" name="industry" placeholder="IT Hardware & Software" required>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Functional Area</label>
													<input type="text" class="form-control" id="job_alert_functio nal_area" name="functio nal_area" placeholder="Operations" required>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Role</label>
													<input type="text" class="form-control" id="job_alert_role" name="role" placeholder="Head of Department" required>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label>Give your alert a name</label>
													<input type="text" class="form-control" id="job_alert_name" name="alert_name" placeholder="Head of Department IT Operations Job Alert" required>
												</div>
											</div>
											<div class="col-md-12">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
												<button type="submit" class="btn btn-primary" name="add_job_alert">Save</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
						
				   <aside class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-6 col-12">
					  <button type="button" class="btn btn-lg btn-block btn-danger mb-3" data-toggle="modal" data-target="#free_alert_modal"> <i class="feather-bell"></i> Set alert for jobs </button>
					  <?php include_once 'recent_profile_views.php'; ?>
					  <div class="box shadow-sm border rounded bg-white mb-3">
						 <div class="box-title border-bottom p-3">
							<h6 class="m-0">Similar Jobs
							</h6>
						 </div>
						 <div class="box-body p-3">
						 	<?php 
								$latest_opening_query="SELECT * FROM jobs WHERE id!='$job_id' ORDER BY id DESC LIMIT 5";
								$latest_opening_result=mysqli_query($conn,$latest_opening_query);
								$latest_opening_num_rows=mysqli_num_rows($latest_opening_result);
							?>
							<?php
								if($latest_opening_num_rows>0)
								{
									while($latest_opening_row=mysqli_fetch_array($latest_opening_result))
									{
										$status_row=mysqli_fetch_array(mysqli_query($conn,"SELECT title FROM job_status WHERE id='".$latest_opening_row['status']."'"));
										$og_title=base_url."job/".trim(strtolower($latest_opening_row['job_title']))." ".trim(strtolower($latest_opening_row['job_company']));
										$og_title=str_replace(" ","-",$og_title);
										$og_url=$og_title."-".$latest_opening_row['id'].".html";
							?>
										<a href="<?php echo $og_url; ?>">
										   <div class="shadow-sm border rounded bg-white job-item mb-3">
											  <div class="d-flex align-items-center p-3 job-item-header">
												 <div class="overflow-hidden mr-2">
													<h6 class="font-weight-bold text-dark mb-0 text-truncate"><?php echo $latest_opening_row['job_title']; ?></h6>
													<div class="text-truncate text-primary"><?php echo $latest_opening_row['job_company']; ?></div>
													<div class="small text-gray-500"><i class="feather-map-pin"></i><?php echo $latest_opening_row['job_location']; ?></div>
												 </div>
												 <img class="img-fluid ml-auto" src="<?php echo base_url; ?>img/l3.png" alt="">
											  </div>
											  <div class="d-flex align-items-center p-3 border-top border-bottom job-item-body">
												 <div class="overlap-rounded-circle">
													<img class="rounded-circle shadow-sm" data-toggle="tooltip" data-placement="top" title="" src="<?php echo base_url; ?>img/p9.png" alt="" data-original-title="Sophia Lee">
													<img class="rounded-circle shadow-sm" data-toggle="tooltip" data-placement="top" title="" src="<?php echo base_url; ?>img/p10.png" alt="" data-original-title="John Doe">
													<img class="rounded-circle shadow-sm" data-toggle="tooltip" data-placement="top" title="" src="<?php echo base_url; ?>img/p11.png" alt="" data-original-title="Julia Cox">
													<img class="rounded-circle shadow-sm" data-toggle="tooltip" data-placement="top" title="" src="<?php echo base_url; ?>img/p12.png" alt="" data-original-title="Robert Cook">
												 </div>
												 <span class="font-weight-bold text-muted">18 connections</span>
											  </div>
											  <div class="p-3 job-item-footer">
												 <small class="text-gray-500"><i class="feather-clock"></i> Posted 3 Days ago</small>
											  </div>
										   </div>
										</a>
							<?php
									}
								}
							?>
						 </div>
					  </div>
					  	<!--<div class="box shadow-sm mb-3 rounded bg-white ads-box text-center">
							<img src="<?php echo base_url; ?>img/ads1.png" class="img-fluid" alt="Responsive image">
							<div class="p-3 border-bottom">
								<h6 class="font-weight-bold text-gold">Ropeyou Premium</h6>
								<p class="mb-0 text-muted">Grow &amp; nurture your network</p>
							</div>
							<div class="p-3">
								<button type="button" class="btn btn-outline-gold pl-4 pr-4"> ACTIVATE </button>
							</div>
						</div>-->
				   </aside>
				</div>
			</div>
		</div>
		<?php include_once 'scripts.php';  ?>
		<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
		<script>
			var base_url="<?php echo base_url; ?>";
			$(".select2").select2();
			$("#job_alert_country").change(function(){
				var country_slected=$("#job_alert_country").val();
				if(country_slected!="")
				{
					$.ajax({
						url:base_url+'getcities',
						data:{country:country_slected},
						type:'post',
						success:function(response)
						{
							var parsedJson=JSON.parse(response);
							if(parsedJson.status=="succcess")
							{
								var htmlData=parsedJson.htmlData;
								$("#job_alert_cities").select2('destroy');
								$("#job_alert_cities").html(htmlData);
								$("#job_alert_cities").select2();
							}
							else
							{
								var htmlData=parsedJson.htmlData;
								$("#job_alert_cities").select2('destroy');
								$("#job_alert_cities").html(htmlData);
								$("#job_alert_cities").select2();
							}
						}
					});
				}
			});
			$("#job_apply_video_cv").change(function(){
				var $source = $('#job_apply_video_cv_preview');
				$source[0].src = URL.createObjectURL(this.files[0]);
				//$source.parent()[0].load();
			});
		</script>
	</body>
</html>