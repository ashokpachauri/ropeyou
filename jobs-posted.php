<html lang="en">
	<head>
		<?php 
			include_once 'head.php';
			$userData=getUsersData($_COOKIE['uid']);
			if(isset($_REQUEST['token']) && $_REQUEST['token']!="")
			{
				$action=$_REQUEST['action'];
				$job_id=base64_decode($_REQUEST['token']);
				$check_query="SELECT * FROM jobs WHERE id='$job_id' AND user_id='".$_COOKIE['uid']."'";
				$check_result=mysqli_query($conn,$check_query);
				if(mysqli_num_rows($check_result)>0)
				{
					if($action=="rem")
					{
						mysqli_query($conn,"UPDATE jobs SET status=5 WHERE id='$job_id'");
						?>
						<script>
							alert('status updated');
							location.href="<?php echo base_url.'jobs-posted'; ?>";
						</script>
						<?php
					}
					else if($action=="act")
					{
						mysqli_query($conn,"UPDATE jobs SET status=1 WHERE id='$job_id'");
						?>
						<script>
							alert('status updated');
							location.href="<?php echo base_url.'jobs-posted'; ?>";
						</script>
						<?php
					}
					else if($action=="pas")
					{
						mysqli_query($conn,"UPDATE jobs SET status=4 WHERE id='$job_id'");
						?>
						<script>
							alert('status updated');
							location.href="<?php echo base_url.'jobs-posted'; ?>";
						</script>
						<?php
					}
					else if($action=="app_ch_status")
					{
						$app_id=base64_decode($_REQUEST['slug']);
						$app_query="SELECT * FROM job_applications WHERE id='$app_id' AND job_id='$job_id'";
						$app_result=mysqli_query($conn,$app_query);
						if(mysqli_num_rows($app_result)>0)
						{
							$status=base64_decode($_REQUEST['st_slug']);
							$arr=array(1,2,3,4,5,6,7);
							if(in_array($status,$arr))
							{
								if(mysqli_query($conn,"UPDATE job_applications SET status='$status' WHERE job_id='$job_id' AND id='$app_id'"))
								{
									?>
									<script>
										alert('status updated');
										location.href="<?php echo base_url.'jobs-posted'; ?>";
									</script>
									<?php
								}
								else
								{
									?>
									<script>
										alert('invalid action');
										location.href="<?php echo base_url.'jobs-posted'; ?>";
									</script>
									<?php
								}
							}
							else
							{
								?>
								<script>
									alert('invalid action');
									location.href="<?php echo base_url.'jobs-posted'; ?>";
								</script>
								<?php
							}
						}
						else
						{
							?>
							<script>
								alert('you are not authorised to perform this action.');
								location.href="<?php echo base_url.'jobs-posted'; ?>";
							</script>
							<?php
						}
					}
					else
					{
						?>
						<script>
							alert('this action is not recognised.');
							location.href="<?php echo base_url.'jobs-posted'; ?>";
						</script>
						<?php
					}
				}
				else
				{
					?>
					<script>
						alert('unauthorized action.can not proceed');
						location.href="<?php echo base_url.'jobs-posted'; ?>";
					</script>
					<?php
				}
			}
		?>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Jobs Posted | RopeYou Connects</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url; ?>css/feeling.css" />
	</head>
	<style>
		h6{
			font-size: 0.8rem !important;
		}
		.morecontent span {
			display: none;
		}
		.morelink {
			display: block;
		}
	</style>
	<body>
		<?php include_once 'header.php'; ?>
		<?php 
			$users_personal_row=getUsersPersonalData($_COOKIE['uid']);
		?>
		<div class="py-4">
			<div class="container">
				<div class="row">
				   <!-- Main Content -->
					<div class="modal fade user_profile_modal" id="user_profile_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="staticBackdropLabel">User Profile</h5>
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="col-md-12 col-sm-12 col-12 col-xs-12" id="user_profile_iframe">
											
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
					<div class="modal fade create_schedule_modal" id="create_schedule_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="create_schedule_modalBackdropLabel" aria-hidden="true">
						<div class="modal-dialog modal-md" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="create_schedule_modalBackdropLabel">Schedule Online Interview</h5>
								</div>
								<div class="modal-body">
									<form action="<?php echo base_url; ?>schedule-interview" method="post">
										<div class="row">
											<div class="col-md-12 col-sm-12 col-12 col-xs-12">
												<h6>Title</h6>
												<input type="hidden" name="user_id" id="schedule_user_id" value="" required>
												<input type="hidden" name="user_ref" id="schedule_user_ref" value="" required>
												<input type="hidden" name="job_id" id="schedule_job_id" value="" required>
												<input type="hidden" name="application_id" id="schedule_app_id" value="" required>
												<input type="text" name="title" class="form-control" placeholder="Enter a title for your reference purpose" required>
											</div>
											<div class="col-md-12 col-sm-12 col-12 col-xs-12" style="margin-top:25px;">
												<h6>Date of interview</h6>
												<input type="date" class="form-control" name="time_of_schedule" id="time_of_schedule" placeholder="Select date of interview" required>
											</div>
											<div class="col-md-12 col-sm-12 col-12 col-xs-12" style="margin-top:25px;">
												<button type="submit" class="btn btn-primary">Create</button>
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<aside class="col col-xl-4 order-xl-1 col-lg-12 order-lg-1 col-12">
						<div class="box shadow-sm border rounded bg-white mb-3">
							<div class="box-title border-bottom p-3">
								<h6 class="m-0">Filter By</h6>
							</div>
							<div class="box-body p-3" id="filter_card">
								<?php
									$job_application_status_query="SELECT * FROM job_application_status WHERE status=1 ORDER BY id";
									$job_application_status_result=mysqli_query($conn,$job_application_status_query);
									if(mysqli_num_rows($job_application_status_result)>0)
									{
										while($job_application_status_row=mysqli_fetch_array($job_application_status_result))
										{
											?>
											<input type="checkbox" name='application_status' checked onclick="filter('application_status');" value="<?php echo $job_application_status_row['id']; ?>">&nbsp;<?php echo $job_application_status_row['title']; ?><br/>
											<?php
										}
									}
								?>
							</div>
						</div>
						<?php 
							$latest_opening_query="SELECT * FROM jobs WHERE user_id='".$_COOKIE['uid']."' AND status!=5 ORDER BY id DESC LIMIT 10";
							$latest_opening_result=mysqli_query($conn,$latest_opening_query);
							$latest_opening_num_rows=mysqli_num_rows($latest_opening_result);
							$jobs_posted=array();
							if($latest_opening_num_rows>0)
							{
								?>
								<div class="box shadow-sm border rounded bg-white mb-3">
									<div class="box-title border-bottom p-3">
										<h6 class="m-0">Jobs<a href="javascript:void(0);" style="float:right;" onclick="$('#jobs_card').toggle('display');$('.feather-arrow-up-circle').toggleClass('feather-arrow-down-circle');"><i class="feather-arrow-up-circle"></i></a></h6>
									</div>
									<div class="box-body" id="jobs_card">
									<?php
									while($latest_opening_row=mysqli_fetch_array($latest_opening_result))
									{
										$jobs_posted[]=$latest_opening_row['id'];
										$status_row=mysqli_fetch_array(mysqli_query($conn,"SELECT title FROM job_status WHERE id='".$latest_opening_row['status']."'"));
										$job_id=$latest_opening_row['id'];
										$job_status_query="SELECT * FROM job_status WHERE id='".$latest_opening_row['status']."'";
										$job_status_result=mysqli_query($conn,$job_status_query);
										$job_status_row=mysqli_fetch_array($job_status_result);
									?>
										<div class="d-flex align-items-center p-3 job-item-header border-bottom">
											<input type="checkbox" name="job" checked onclick="filter('job');" value="<?php echo $latest_opening_row['id']; ?>">
											<div class="overflow-hidden ml-2">
												<h6 class="font-weight-bold text-dark mb-0 text-truncate"><?php echo $latest_opening_row['job_title']; ?> - <span style="font-weight:normal; font-size:14px !important;">(<?php echo $job_status_row['title']; ?>)</span></h6>
												<div class="text-truncate text-primary"><?php echo $latest_opening_row['job_company']; ?></div>
												<div class="small text-gray-500"><i class="feather-map-pin"></i> <?php echo $latest_opening_row['job_location']; ?></div>
												
											</div>
											<div class="ml-auto mr-0">
												<div class="btn-group">
													<button type="button" class="btn btn-light btn-sm rounded" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
													<i class="feather-more-vertical"></i>
													</button>
													<div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-129px, 29px, 0px);">
														<?php
															if($latest_opening_row['status']=="0" || $latest_opening_row['status']=="3" || $latest_opening_row['status']=="2")
															{
																?>
																	<button class="dropdown-item" data-has="<?php echo base64_encode($job_id); ?>"  onclick="edit_job('<?php echo $job_id; ?>');" type="button" id="edit_job_<?php echo $job_id; ?>">Edit</button>
																	<button class="dropdown-item" data-has="<?php echo base64_encode($job_id); ?>" type="button" id="delete_job_<?php echo $job_id; ?>" onclick="delete_job('<?php echo $job_id; ?>');">Delete</button>
																<?php
															}
															else if($latest_opening_row['status']=="1")
															{
																?>
																	<button class="dropdown-item" data-has="<?php echo base64_encode($job_id); ?>" onclick="edit_job('<?php echo $job_id; ?>');" type="button" id="edit_job_<?php echo $job_id; ?>">Edit</button>
																	<button class="dropdown-item" data-has="<?php echo base64_encode($job_id); ?>" type="button" id="passive_job_<?php echo $job_id; ?>" onclick="passive_job('<?php echo $job_id; ?>');">Mark Withdrawled</button>
																	<button class="dropdown-item" data-has="<?php echo base64_encode($job_id); ?>" type="button" id="delete_job_<?php echo $job_id; ?>" onclick="delete_job('<?php echo $job_id; ?>');">Delete</button>
																<?php
															}
															else if($latest_opening_row['status']=="4")
															{
																?>
																<button class="dropdown-item" data-has="<?php echo base64_encode($job_id); ?>" onclick="edit_job('<?php echo $job_id; ?>');" type="button" id="edit_job_<?php echo $job_id; ?>">Edit</button>
																<button class="dropdown-item" data-has="<?php echo base64_encode($job_id); ?>" type="button" id="active_job_<?php echo $job_id; ?>" onclick="active_job('<?php echo $job_id; ?>');">Mark Active</button>
																<button class="dropdown-item" data-has="<?php echo base64_encode($job_id); ?>" type="button" id="delete_job_<?php echo $job_id; ?>" onclick="delete_job('<?php echo $job_id; ?>');">Delete</button>
																<?php
															}
														?>
													</div>
												 </div>
											</div>
										</div>
									<?php
									}
									?>										
									</div>
								</div>
								<?php
							}
							else
							{
								?>
								<div class="box shadow-sm mb-3 rounded bg-white ads-box text-center overflow-hidden">
									 <img src="<?php echo base_url; ?>img/job1.png" class="img-fluid" alt="Responsive image">
									 <div class="p-3 border-bottom">
										<h6 class="font-weight-bold text-dark">RopeYou Solutions</h6>
										<p class="mb-0 text-muted">Looking for talent?</p>
									 </div>
									 <div class="p-3">
										<a href="<?php echo base_url; ?>post-job" class="btn btn-primary pl-4 pr-4"> POST A JOB </a>
									 </div>
								</div>
								<?php
							}
						?>
				   </aside>
					<main class="col col-xl-8 order-xl-2 col-lg-12 order-lg-2 col-md-12 col-sm-12 col-12">
						<div class="box shadow-sm border rounded bg-white mb-3">
							<div class="box-title border-bottom p-3">
								<h6 class="m-0">Job Applications</h6>
							</div>
							<?php
								//$job_id=2;
								if(count($jobs_posted)>0)
								{
									$cond_arr=implode("','",$jobs_posted);
									$application_query="SELECT * FROM job_applications WHERE job_id IN ('".$cond_arr."') ORDER BY added DESC";
									$application_result=mysqli_query($conn,$application_query);
									if(mysqli_num_rows($application_result)>0)
									{
										while($application_row=mysqli_fetch_array($application_result))
										{
											$applicant_user_id=$application_row['user_id'];
											$current_job_query="SELECT * FROM users_work_experience WHERE user_id='$applicant_user_id' AND working=1";
											$current_job_result=mysqli_query($conn,$current_job_query);
											$current_job_num_rows=mysqli_num_rows($current_job_result);
											//echo $current_job_query;
											$current_edu_query="SELECT * FROM users_education WHERE user_id='$applicant_user_id' ORDER BY from_year DESC LIMIT 1";
											$current_edu_result=mysqli_query($conn,$current_edu_query);
											$current_edu_num_rows=mysqli_num_rows($current_edu_result);
											
											$applicant_user_row=getUsersData($applicant_user_id);
											
											$users_personal_query="SELECT * FROM users_personal WHERE user_id='$applicant_user_id'";
											$users_personal_result=mysqli_query($conn,$users_personal_query);
											$users_personal_num_rows=mysqli_num_rows($users_personal_result);

											$profile_image=getUserProfileImage($applicant_user_id);
											if($users_personal_num_rows>0)
											{
												$users_personal_row=mysqli_fetch_array($users_personal_result);
											}
											$job_application_status_query="SELECT * FROM job_application_status WHERE id='".$application_row['status']."'";
											$job_application_status_result=mysqli_query($conn,$job_application_status_query);
											$job_application_status_row=mysqli_fetch_array($job_application_status_result);
											?>
												<div class="box-body p-3 border-bottom job_all job_<?php echo $application_row['job_id']; ?> status_<?php echo $application_row['status']; ?>">
													<div class="d-flex align-items-top job-item-header pb-2">
														<img class="img-fluid mb-auto rounded-circle" src="<?php echo $profile_image; ?>" alt="" style="border:1px solid gray;cursor:pointer;" data-toggle="modal" data-target="#user_profile_modal">
														<div class="ml-2">
															<h6 class="font-weight-bold text-dark mb-0" style="cursor:pointer;" data-user="<?php echo $applicant_user_id; ?>" onclick="showUserProfile('<?php echo $applicant_user_row['username']; ?>');"><?php echo $application_row['first_name'].' '.$application_row['last_name']; ?></h6>
															<?php
																if($current_job_num_rows>0)
																{
																	$current_job_row=mysqli_fetch_array($current_job_result);
																	?>
																		<div class="text-truncate text-primary">Currently working as <?php echo $current_job_row['title']; ?> at <?php echo $current_job_row['company']; ?></div>
																	<?php
																}
																else{
																	?>
																	<div class="text-truncate text-primary"><?php echo $users_personal_row['about']; ?></div>
																	<?php
																}

																if($current_edu_num_rows>0)
																{
																	$current_edu_row=mysqli_fetch_array($current_edu_result);
																	?>
																		<div class="text-truncate text-primary">Studied <b><?php echo $current_edu_row['title']; ?></b> in <b><?php echo $current_edu_row['major']; ?></b> at <b><?php echo $current_edu_row['university']; ?></b></div>
																	<?php
																}
															?>
															
															<div class="text-truncate text-primary">Application Status : <?php echo $job_application_status_row['title']; ?> </div>
														</div>
														<div class="ml-auto mr-0">
															<div class="btn-group">
																<button type="button" class="btn btn-light btn-sm rounded" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
																<i class="feather-more-vertical"></i>
																</button>
																<div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-129px, 29px, 0px);">
																	<?php
																		$job_application_status_query="SELECT * FROM job_application_status WHERE status=1 AND id!=0 ORDER BY id";
																		$job_application_status_result=mysqli_query($conn,$job_application_status_query);
																		if(mysqli_num_rows($job_application_status_result)>0)
																		{
																			while($job_application_status_row=mysqli_fetch_array($job_application_status_result))
																			{
																				?>
																					<button class="dropdown-item" data-has="<?php echo base64_encode($application_row['job_id']); ?>" data-app="<?php echo base64_encode($application_row['id']); ?>" data-st="<?php echo base64_encode($job_application_status_row['id']); ?>" onclick="app_ch_status('<?php echo $application_row['job_id']; ?>','<?php echo $application_row['id']; ?>','<?php echo $job_application_status_row['id']; ?>');" id="app_ch_status_<?php echo $application_row['job_id'].'_'.$application_row['id'].'_'.$job_application_status_row['id']; ?>" type="button">Mark <?php echo $job_application_status_row['title']; ?></button>
																				<?php
																			}
																		}
																	?>
																</div>
															 </div>
														</div>
													</div>
													<p class="mb-0 more">
														<span style="float:right;cursor:pointer;border-radius:50%;border:1px solid gray;" onclick="$('#know_more_<?php echo $i; ?>').toggle('display');$('#icon_more_<?php echo $i; ?>').toggleClass('feather-arrow-up');" title="Know More"><i class="feather-arrow-down" id="icon_more_<?php echo $i; ?>"></i></span>
													</p>
													<div id="know_more_<?php echo $i++; ?>" style="width:100%;display:none;">
														<?php
															if($users_personal_num_rows>0)
															{
																?>
																<div class="text-default" style="width:100%;">Profile Title : <?php if($users_personal_row['about']!="") { echo $users_personal_row['about']; } else{ echo 'NA'; } ?></div>	
																<?php
															}
														?>
														<div class="text-default" style="width:100%;"><b>Location</b> : <?php if($users_personal_row['address']!=""){ echo $users_personal_row['address']; }else { echo "NA"; } ?><br/></div>
														<div class="text-default" style="width:100%;"><b>Passport Status</b> : <?php if($users_personal_row['passport']!=""){ echo $users_personal_row['passport']; } else{ echo 'NA'; } ?><br/></div>
														<div class="text-default" style="width:100%;"><b>Common Bridge</b> : 32 connections<br/></div>
														<!--<div class="text-default" style="width:100%;"><b>Create Interview Schedule</b> : 
														<?php 
															/*if(((int)($application_row['status']))>=3)
															{
																if($room_id=is_interview_scheduled($_COOKIE['uid'],$applicant_user_id,$application_row['job_id'],$application_row['id']))
																{
																	echo "Created <b>Room ID : ".$room_id."</b>";
																}
																else
																{
																	$application_id=$application_row['id'];
																	?>
																	<a href="javascript:void(0);" id="create_schedule_<?php echo $application_row['id']; ?>" data-auid="<?php echo $applicant_user_id; ?>" data-uid="<?php echo $_COOKIE['uid']; ?>" data-jid="<?php echo $application_row['job_id']; ?>" onclick="createSchedule('<?php echo $application_id; ?>');">Create</a>
																	<?php
																}
															}*/
														?>
														<br/></div>-->
														<div class="text-default" style="width:100%;"><b>Doc Resume</b> : <?php if($application_row['job_apply_doc_cv']!="" && $application_row['job_apply_doc_cv']!=null){ echo '<a href="'.base_url.'uploads/'.$application_row['job_apply_doc_cv'].'" download="'.$application_row['job_apply_doc_cv'].'">Download Doc CV</a>'; } else { echo "NA"; } ?><br/></div>
														<div class="row" style="margin-top:50px;">
															<div class="col-md-6 border-bottom border-top border-right border-left">
																<div class="p-1 border-bottom text-center">
																	<h6 class="text-center" style="font-size:14px;text-align:center;float:none;margin-top:10px;">Custom Message</h6>
																</div>
																<div class="d-flex p-1">
																	<p><?php echo $application_row['custom_message']; ?></p>
																</div>
															</div>
															<div class="col-md-6 border-bottom border-top border-right">
																<div class="p-1 border-bottom text-center">
																	<h6 class="text-center" style="font-size:14px;float:none;margin-top:10px;">Video CV</h6>
																</div>
																<div class="d-flex p-1">
																	<?php
																		if($application_row['job_apply_video_cv']!="" && $application_row['job_apply_video_cv']!=null)
																		{
																	?>
																			<video style="width:100%;" controls controlsList="nodownload">
																				<source src="<?php echo $base_url.'uploads/'.$application_row['job_apply_video_cv']; ?>" type="video/mp4"></source>
																			</video>
																	<?php
																		}
																		else
																		{
																			?>
																			<p>Video cv is not provided by the candidate.</p>
																			<?php
																		}
																	?>
																</div>
															</div>
														</div>
													</div>
												</div>
											<?php
										}	
									}
								}
								else
								{
									?>
									<div class="box-body p-3">
										<div class="d-flex align-items-top job-item-header pb-2">
											<h6 style="text-align:center !important;font-size:14px;">When you will post a job, the applications to job will apear here.</h6>
										</div>
									</div>
									<?php
								}
							?>
						</div>
					</main>
				</div>
			</div>
		</div>
		<?php include_once 'scripts.php'; ?>
		<script>
			var base_url="<?php echo base_url; ?>";
			/*$(document).ready(function(){
				var maxLength = 400;
				$(".show-read-more").each(function(){
					var myStr = $(this).text();
					if($.trim(myStr).length > maxLength){
						var newStr = myStr.substring(0, maxLength);
						var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
						$(this).empty().html(newStr);
						$(this).append(' <a href="javascript:void(0);" class="read-more">read more...</a>');
						$(this).append('<span class="more-text" style="display:none;">' + removedStr + '</span>');
					}
				});
				$(".read-more").click(function(){
					$(this).siblings(".more-text").contents().unwrap();
					$(this).remove();
				});
			});*/
			function showUserProfile(username)
			{
				if(username!="")
				{
					$("#user_profile_iframe").load(base_url+"usr/"+username);
					$("#user_profile_modal").modal("show");
				}
			}
			$(document).ready(function() {
				var showChar = 406;  
				var ellipsestext = "...";
				var moretext = "Show more >";
				var lesstext = "Show less";
				

				$('.more').each(function() {
					var content = $(this).html();
			 
					if(content.length > showChar) {
			 
						var c = content.substr(0, showChar);
						var h = content.substr(showChar, content.length - showChar);
			 
						var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="javascript:void(0);" class="morelink" style="width:100px;">' + moretext + '</a></span>';
			 
						$(this).html(html);
					}
			 
				});
 
				$(".morelink").click(function(){
					if($(this).hasClass("less")) {
						$(this).removeClass("less");
						$(this).html(moretext);
					} else {
						$(this).addClass("less");
						$(this).html(lesstext);
					}
					$(this).parent().prev().toggle();
					$(this).prev().toggle();
					return false;
				});
			});
			function filter(type)
			{
				var jobs=[];
				var application_status=[];
				if(type=="job")
				{
					$("input:checkbox[name=job]:checked").each(function(){
						jobs.push($(this).val());
					});
					$("input:checkbox[name=application_status]:checked").each(function(){
						application_status.push($(this).val());
					});
					$(".job_all").hide();
					for(i=0;i<jobs.length;i++)
					{
						for(j=0;j<application_status.length;j++)
						{
							$(".job_"+jobs[i]+".status_"+application_status[j]+"").show();
						}
					}
				}
				if(type=="application_status")
				{
					$("input:checkbox[name=job]:checked").each(function(){
						jobs.push($(this).val());
					});
					$("input:checkbox[name=application_status]:checked").each(function(){
						application_status.push($(this).val());
					});
					$(".job_all").hide();
					for(i=0;i<jobs.length;i++)
					{
						for(j=0;j<application_status.length;j++)
						{
							$(".job_"+jobs[i]+".status_"+application_status[j]+"").show();
						}
					}
				}
				
					//console.log(application_status);
					//console.log(jobs);
			}
			function edit_job(job_id)
			{
				var token=$("#edit_job_"+job_id).attr('data-has');
				window.location.href=base_url+"post-job.php?token="+token;
			}
			function delete_job(job_id)
			{
				var token=$("#delete_job_"+job_id).attr('data-has');
				window.location.href=base_url+"jobs-posted.php?action=rem&token="+token;
			}
			function active_job(job_id)
			{
				var token=$("#active_job_"+job_id).attr('data-has');
				window.location.href=base_url+"jobs-posted.php?action=act&token="+token;
			}
			function passive_job(job_id)
			{
				var token=$("#passive_job_"+job_id).attr('data-has');
				window.location.href=base_url+"jobs-posted.php?action=pas&token="+token;
			}
			function app_ch_status(job_id,app_id,status)
			{
				var token=$("#app_ch_status_"+job_id+"_"+app_id+"_"+status).attr('data-has');
				var slug=$("#app_ch_status_"+job_id+"_"+app_id+"_"+status).attr('data-app');
				var st_slug=$("#app_ch_status_"+job_id+"_"+app_id+"_"+status).attr('data-st');
				if(token!="" && slug!="" && st_slug!="")
				{
					window.location.href=base_url+"jobs-posted?token="+token+"&slug="+slug+"&st_slug="+st_slug+"&action=app_ch_status";
				}
				else
				{
					alert('there is a problem with your request');
				}
			}
			function createSchedule(application_id)
			{
				$("#schedule_user_ref").val($("#create_schedule_"+application_id).attr('data-auid'));
				$("#schedule_user_id").val($("#create_schedule_"+application_id).attr('data-uid'));
				$("#schedule_job_id").val($("#create_schedule_"+application_id).attr('data-jid'));
				$("#schedule_app_id").val(application_id);
				$("#create_schedule_modal").modal('show');
				minDate();
			}
			function minDate()
			{
				var dtToday = new Date();
				
				var month = dtToday.getMonth() + 1;
				var day = dtToday.getDate();
				var year = dtToday.getFullYear();
				if(month < 10)
					month = '0' + month.toString();
				if(day < 10)
					day = '0' + day.toString();
				
				var maxDate = year + '-' + month + '-' + day;
				//alert(maxDate);
				$('#time_of_schedule').attr('min', maxDate);
			}
		</script>
   </body>
</html>
