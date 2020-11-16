<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="hi">
	<head>
		<?php 
			include_once 'head.php';
		?>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Broadcasts | RopeYou Connects</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url; ?>css/feeling.css" />
		<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
	</head>
	<body>
		<style>
			.commentssec .text-gray-500 {
				color: #72808c !important;
			}
			.fileuploader {
				width: 160px;
				height: 160px;
				margin: 15px;
			}
			.guteurlsBottom{
				display:none !important;
			}
		</style>
		<?php include_once 'header.php'; ?>
		<div class="py-4">
			<div class="container">
				<div class="row">
				   <!-- Main Content -->
				   <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
					  <div class="box shadow-sm border rounded bg-white mb-3 osahan-share-post">
						 <ul class="nav nav-justified border-bottom osahan-line-tab" id="myTab" role="tablist">
							<li class="nav-item">
							   <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="feather-edit"></i> Share an update</a>
							</li>
							<li class="nav-item pull-right" style="float:right;">
							   <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="feather-image"></i> Upload Media</a>
							</li>
						 </ul>
						 <div class="tab-content" id="myTabContent">
							<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
								<div class="w-100" data-toggle="modal" data-target="#do_post_modal" style="cursor:pointer;">
									<div class="row" style="width:100%;">
										<div class="col-md-2" style="padding:10px;">
											<div class="dropdown-list-image mr-3" style="width:50px;height:50px;">
												<img class="rounded-circle" src="<?php echo $profile; ?>" alt="User Profile Picture"  style="border:1px solid #eaebec !important;height:50px;width:50px;">
												<div class="status-indicator bg-success"></div>
											</div>
										</div>
										<div class="col-md-10" style="padding:10px;">
											<textarea placeholder="Write your thoughts..." name="" id="" class="form-control border-0 p-0 shadow-none status_text" rows="3"></textarea>
										</div>
										<div class="col-md-12">
											<div class="ru-loader" id="ru-loader" style="display:none;"></div>
											<div class="w-100" id="status_text_preview">
												
											</div>
										</div>
									</div>
								</div>
								<!--<div class="border-top p-3 d-flex align-items-center">
									<div class="mr-auto">
										<a href="javascript:void(0);" class="text-link small post_matrix"><i class="feather-settings"></i>&nbsp;<span class="post_matrix_text">Anyone</span></a>
										<input type="hidden" name="post_matrix" id="post_matrix" value="1,0,0,0,0">
										<input type="hidden" name="post_matrix_users" id="post_matrix_users" value="">
									</div>
									<div class="flex-shrink-1">
									   <button type="button" class="btn btn-primary btn-sm" onclick="submitPost();">Post Status</button>
									</div>
								</div>-->
							</div>
							<div class="modal fade do_post_modal" id="do_post_modal" style="z-index:99999 !important;" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="do_post_modal_static" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<form action="" method="post" id="media_form">
											<input type="file" data-idslug="" class="image_selector" id="media_image_selector" name="image_selector[]" multiple="multiple" accept="image/*" style="display:none;">
											<input type="file" data-idslug="" class="video_selector" id="media_video_selector" name="video_selector[]" multiple="multiple" accept="video/*" style="display:none;">
											<input type="file" data-idslug="" class="image_selector" id="image_selector" name="image_selector[]" multiple="multiple" accept="image/*" style="display:none;">
											<input type="file" data-idslug="" class="video_selector" id="video_selector" name="video_selector[]" multiple="multiple" accept="video/*" style="display:none;">
										</form>
										<div class="row post_modal_section" style="padding:0px;margin:0px;display:none;" id="create_media_post_modal_section">
											<div class="col-md-12" style="padding:0px;margin:0px;">
												<div class="modal-header" style="width:100%;">
													<div class="row" style="width:100%;">
														<div class="col-md-8">
															<h5 class="modal-title" id="do_post_modal_static">Choose what to upload </h5>
															
														</div>
														<div class="col-md-4">
															<button onclick="resetPost();" data-dismiss="modal" style="border-color:none !important;float:right !important;background-color:#efefef;color:#000;font-size:15px;border-radius:50%;height:30px;width:30px;" type="button"><i class="fa fa-times"></i></button>
														</div>
													</div>
												</div>
												<div class="modal-body" style="padding:0px;">
													<?php
														$user_profile_query="SELECT * FROM users WHERE id='".$_COOKIE['uid']."'";
														$user_profile_result=mysqli_query($conn,$user_profile_query);
														$user_profile_data=mysqli_fetch_array($user_profile_result);
													?>
													<div class="w-100">
														<div class="row" style="width:100%;padding:0px;margin:0px;">
															<div class="col-md-12" style="padding:10px;border-top:1px solid #dee2e6">
																<div class="row">
																	<div class="col-md-12 text-center">
																		<button type="button" class="btn btn-primary" onclick="$('#media_image_selector').click();" title="Add photos" style="font-size:16px;border:2px solid gray;border-radius:50%;"><i class="fa fa-picture-o"></i></button>&nbsp;&nbsp;&nbsp;
																		<button type="button" class="btn btn-warning" onclick="$('#media_video_selector').click();" title="Add videos" style="font-size:16px;border:2px solid gray;border-radius:50%;"><i class="fa fa-video-camera"></i></button>
																	</div>
																</div>
															</div>
														</div>											
													</div>
												</div>
											</div>
										</div>
										<div class="row post_modal_section" style="padding:0px;margin:0px;" id="create_post_modal_section">
											<div class="col-md-12" style="padding:0px;margin:0px;">
												<div class="modal-header" style="width:100%;">
													<div class="row" style="width:100%;">
														<div class="col-md-8">
															<h5 class="modal-title" id="do_post_modal_static">Create Post </h5>
														</div>
														<div class="col-md-4">
															<button onclick="resetPost();" data-dismiss="modal" style="border-color:none !important;float:right !important;background-color:#efefef;color:#000;font-size:15px;border-radius:50%;height:30px;width:30px;" type="button"><i class="fa fa-times"></i></button>
														</div>
													</div>
												</div>
												<div class="modal-body" style="padding:0px;">
													<?php
														$user_profile_query="SELECT * FROM users WHERE id='".$_COOKIE['uid']."'";
														$user_profile_result=mysqli_query($conn,$user_profile_query);
														$user_profile_data=mysqli_fetch_array($user_profile_result);
													?>
													<div class="w-100">
														<div class="row" style="width:100%;padding:0px;margin:0px;">
															<div class="col-md-2" style="padding:10px;">
																<div class="dropdown-list-image mr-3" style="width:50px;height:50px;">
																	<img class="rounded-circle" src="<?php echo getUserProfileImage($_COOKIE['uid']); ?>" alt="User Profile Picture"  style="border:1px solid #eaebec !important;height:50px;width:50px;">
																	<div class="status-indicator bg-success"></div>
																</div>
															</div>
															<div class="col-md-10" style="padding:10px;">
																<h6><?php
																	echo ucwords(strtolower($user_profile_data['first_name'].' '.$user_profile_data['last_name']));
																?></h6>
																<button type="button" class="btn btn-default" style="padding:0px;" onclick="$('#mode_modal_section').show();$('#create_post_modal_section').hide();" id="mode" data-val="1,0,0,0,0"><i class="fa fa-globe"></i>&nbsp;&nbsp;Anyone</button>
															</div>
															<div class="col-md-12" id="textContent" style="min-height:180px !important;max-height:350px !important;overflow-y:auto;">
																<div class="row">
																	<div class="col-md-12" style="padding:10px;max-height:170px;overflow-y:auto;">
																		<textarea placeholder="Write your thoughts..." autofocus onkeyup="keyupFunction();" style="resize:none;font-size:20px;" name="status_text" id="status_text" class="form-control border-0 p-0 shadow-none status_text" rows="5"></textarea>
																	</div>
																	<div class="col-md-12" style="padding:10px;max-height:170px;overflow-y:auto;" id="post_preview_section">
																		
																	</div>
																</div>
															</div>
															<div class="col-md-12" style="padding:10px;border-top:1px solid #dee2e6">
																<div class="row">
																	<div class="col-md-12">
																		<button type="button" class="btn btn-secondary" onclick="$('#add_tags_modal_section').show();$('#create_post_modal_section').hide();"  title="Tag your friends" style="font-size:16px;border:2px solid gray;border-radius:50%;"><i class="fa fa-tag"></i></button>&nbsp;&nbsp;&nbsp;
																		<button type="button" class="btn btn-primary" onclick="$('#image_selector').click();" title="Add photos" style="font-size:16px;border:2px solid gray;border-radius:50%;"><i class="fa fa-picture-o"></i></button>&nbsp;&nbsp;&nbsp;
																		<button type="button" class="btn btn-warning" onclick="$('#video_selector').click();" title="Add videos" style="font-size:16px;border:2px solid gray;border-radius:50%;"><i class="fa fa-video-camera"></i></button>
																		<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Words Count : <span id="word_count">0</span></span>
																		<button type="button" class="btn btn-success" id="save_brodcast_post" onclick="statusTextKeyup();" style="float:right;font-size:16px;;">Post</button>
																	</div>
																</div>
															</div>
														</div>											
													</div>
												</div>
											</div>
										</div>
										<div class="row post_modal_section" style="padding:0px;margin:0px;display:none;" id="mode_modal_section">
											<div class="col-md-12" style="padding:0px;margin:0px;">
												<div class="modal-header" style="width:100%;">
													<div class="row" style="width:100%;">
														<div class="col-md-4">
															<button title="Back" onclick="$('#create_post_modal_section').show();$('#mode_modal_section').hide();" style="border-color:none !important;float:left !important;background-color:#efefef;color:#000;font-size:15px;border-radius:50%;height:30px;width:30px;" type="button"><i class="fa fa-arrow-left"></i></button>
														</div>
														<div class="col-md-8">
															<h5 class="modal-title" id="do_post_modal_static">Who can see this?</h5>
														</div>
													</div>
												</div>
												<div class="modal-body" style="padding:0px;">
													<div class="w-100">
														<div class="row" style="width:100%;padding:0px;margin:0px;">
															<div class="col-md-12" id="tagContent" style="min-height:250px !important;max-height:400px !important;overflow-y:auto;">
																<div class="row">
																	<div class="col-md-12" style="padding:10px;">
																		<div class="row">
																			<div class="col-md-12" style="margin-bottom:20px;">
																				<select id="mode_seection_dropdown" onchange="connections_selection_div();" name="mode_seection_dropdown" class="form-control">
																					<option value="1,0,0,0,0" selected>Anyone</option>
																					<option value="0,1,0,0,0">Only Me</option>
																					<option value="0,0,1,0,0">Only Connections</option>
																					<option value="0,0,1,1,0">Connections of Connections</option>
																					<option value="0,0,1,0,1">Allow Specific Connections</option>
																					<option value="0,0,1,0,2">Block Specific Connections</option>
																				</select>
																			</div>
																		</div>
																		<?php
																			$__user_id=$_COOKIE['uid'];
																			$friends=array();
																			$friends_query="SELECT * FROM user_joins_user WHERE user_id='".$__user_id."' AND status=1";
																			$friends_result=mysqli_query($conn,$friends_query);
																			if(mysqli_num_rows($friends_result)>0)
																			{
																				while($friends_row=mysqli_fetch_array($friends_result))
																				{
																					$friends[]=$friends_row['r_user_id'];
																				}
																			}
																			$friends_query="SELECT * FROM user_joins_user WHERE r_user_id='".$__user_id."' AND status=1";
																			$friends_result=mysqli_query($conn,$friends_query);
																			if(mysqli_num_rows($friends_result)>0)
																			{
																				while($friends_row=mysqli_fetch_array($friends_result))
																				{
																					$friends[]=$friends_row['user_id'];
																				}
																			}
																			$bridge_query="SELECT * FROM users WHERE id IN ('".implode("','",$friends)."')";
																			$bridge_result=mysqli_query($conn,$bridge_query);
																			$bridge_num_rows=mysqli_num_rows($bridge_result);
																			if($bridge_num_rows>0)
																			{
																				?>
																				<div class="row" id="connections_selection_div" style="display:none;">
																				<?php
																				while($bridge_row=mysqli_fetch_array($bridge_result))
																				{
																					$connect_user_id=$bridge_row['id'];
																					$tag_profile=getUserProfileImage($connect_user_id);
																					?>
																					<div class="col-md-12" style="margin-bottom:5px;font-size:16px;">
																						<input type="checkbox" name="mode_friends[]" class="mode_friends" value="<?php echo $connect_user_id; ?>" style="width:20px;height:20px;vertical-align:-6px;">&nbsp;&nbsp;
																						<a href="<?php echo base_url."u/".$bridge_row['username']; ?>" onclick="return confirm('This may cause to loss your unsaved data.Still want to continue?');" style="text-decoration:none;"><img src="<?php echo $tag_profile; ?>" style="height:40px;width:40px;border-radius:50%;">&nbsp;&nbsp;<?php echo ucwords(strtolower($bridge_row['first_name'].' '.$bridge_row['last_name'])); ?></a>
																					</div>
																					<?php
																				}
																				?>
																				</div>
																				<?php
																			}
																			else
																			{
																				?>
																				<h6 style="text-align:center;">There is no connections.</h6>
																				<?php
																			}
																		?>
																	</div>
																</div>
															</div>
														</div>											
													</div>
												</div>
											</div>
										</div>
										<div class="row post_modal_section" style="padding:0px;margin:0px;display:none;" id="add_tags_modal_section">
											<div class="col-md-12" style="padding:0px;margin:0px;">
												<div class="modal-header" style="width:100%;">
													<div class="row" style="width:100%;">
														<div class="col-md-4">
															<button title="Back" onclick="$('#create_post_modal_section').show();$('#add_tags_modal_section').hide();" style="border-color:none !important;float:left !important;background-color:#efefef;color:#000;font-size:15px;border-radius:50%;height:30px;width:30px;" type="button"><i class="fa fa-arrow-left"></i></button>
														</div>
														<div class="col-md-8">
															<h5 class="modal-title" id="do_post_modal_static">Tag Connections </h5>
														</div>
													</div>
												</div>
												<div class="modal-body" style="padding:0px;">
													<div class="w-100">
														<div class="row" style="width:100%;padding:0px;margin:0px;">
															<div class="col-md-12" id="tagContent" style="min-height:250px !important;max-height:400px !important;overflow-y:auto;">
																<div class="row">
																	<div class="col-md-12" style="padding:10px;">
																		<?php
																			$__user_id=$_COOKIE['uid'];
																			$friends=array();
																			$friends_query="SELECT * FROM user_joins_user WHERE user_id='".$__user_id."' AND status=1";
																			$friends_result=mysqli_query($conn,$friends_query);
																			if(mysqli_num_rows($friends_result)>0)
																			{
																				while($friends_row=mysqli_fetch_array($friends_result))
																				{
																					$friends[]=$friends_row['r_user_id'];
																				}
																			}
																			$friends_query="SELECT * FROM user_joins_user WHERE r_user_id='".$__user_id."' AND status=1";
																			$friends_result=mysqli_query($conn,$friends_query);
																			if(mysqli_num_rows($friends_result)>0)
																			{
																				while($friends_row=mysqli_fetch_array($friends_result))
																				{
																					$friends[]=$friends_row['user_id'];
																				}
																			}
																			$bridge_query="SELECT * FROM users WHERE id IN ('".implode("','",$friends)."')";
																			$bridge_result=mysqli_query($conn,$bridge_query);
																			$bridge_num_rows=mysqli_num_rows($bridge_result);
																			if($bridge_num_rows>0)
																			{
																				?>
																				<div class="row">
																				<?php
																				while($bridge_row=mysqli_fetch_array($bridge_result))
																				{
																					$connect_user_id=$bridge_row['id'];
																					$tag_profile=getUserProfileImage($connect_user_id);
																					?>
																					<div class="col-md-12" style="margin-bottom:5px;font-size:16px;">
																						<input type="checkbox" name="tagged_friends[]" class="tagged_friends" value="<?php echo $connect_user_id; ?>" style="width:20px;height:20px;vertical-align:-6px;">&nbsp;&nbsp;
																						<a href="<?php echo base_url."u/".$bridge_row['username']; ?>" onclick="return confirm('This may cause to loss your unsaved data.Still want to continue?');" style="text-decoration:none;"><img src="<?php echo $tag_profile; ?>" style="height:40px;width:40px;border-radius:50%;">&nbsp;&nbsp;<?php echo ucwords(strtolower($bridge_row['first_name'].' '.$bridge_row['last_name'])); ?></a>
																					</div>
																					<?php
																				}
																				?>
																				</div>
																				<?php
																			}
																			else
																			{
																				?>
																				<h6 style="text-align:center;">There is no connections to tag.</h6>
																				<?php
																			}
																		?>
																	</div>
																</div>
															</div>
														</div>											
													</div>
												</div>
											</div>
										</div>
										<div class="row post_modal_section" style="padding:0px;margin:0px;display:none;" id="offered_posting_as_blog">
											<div class="col-md-12" style="padding:0px;margin:0px;">
												<div class="modal-header" style="width:100%;">
													<div class="row" style="width:100%;">
														<div class="col-md-4">
															<button title="Back" onclick="$('#create_post_modal_section').show();$('#offered_posting_as_blog').hide();" style="border-color:none !important;float:left !important;background-color:#efefef;color:#000;font-size:15px;border-radius:50%;height:30px;width:30px;" type="button"><i class="fa fa-arrow-left"></i></button>
														</div>
														<div class="col-md-8">
															<h6 class="modal-title">Whether you wish to post it as blog too? </h6>
														</div>
													</div>
												</div>
												<div class="modal-body" style="padding:0px;">
													<div class="w-100">
														<div class="row" style="width:100%;padding:0px;margin:0px;">
															<div class="col-md-12" id="offerBlogContent" style="min-height:150px !important;max-height:400px !important;overflow-y:auto;">
																<div class="row">
																	<div class="col-md-12" style="padding:10px;">
																		<div class="form-group">
																			<input type="radio" name="save_as_blog_too" onclick="$('#blog_title_section').show();" checked id="save_as_blog_too_yes" value="1">&nbsp;&nbsp;Yes&nbsp;&nbsp;
																			<input type="radio" name="save_as_blog_too" onclick="$('#blog_title_section').hide();" id="save_as_blog_too_no" value="0">&nbsp;&nbsp;No
																		</div>
																		<div class="form-group" id="blog_title_section">
																			<input type="text" name="blog_title" id="blog_title" placeholder="Write down the suitable blog post title" class="form-control">
																		</div>
																	</div>
																</div>
															</div>
														</div>											
													</div>
												</div>
											</div>
										</div>
									
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
								<div class="w-100" onclick="uploadMedia();" style="cursor:pointer;">
									<div class="row" style="width:100%;">
										<div class="col-md-2" style="padding:10px;">
											<div class="dropdown-list-image mr-3" style="width:50px;height:50px;">
												<img class="rounded-circle" src="<?php echo $profile; ?>" alt="User Profile Picture"  style="border:1px solid #eaebec !important;height:50px;width:50px;">
												<div class="status-indicator bg-success"></div>
											</div>
										</div>
										<div class="col-md-10" style="padding:10px;">
											<textarea placeholder="Upload Media..." name="media_status_text" id="media_status_text" class="form-control border-0 p-0 shadow-none status_text" rows="3"></textarea>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
								<div class="p-3 d-flex align-items-center w-100" href="#">
									<div class="dropdown-list-image mr-3">
										<img class="rounded-circle" src="<?php echo $profile; ?>" alt="User Profile Picture"  style="border:1px solid #eaebec !important;">
										<div class="status-indicator bg-success"></div>
									</div>
									<div class="w-100">
										<textarea placeholder="Write an article..." class="form-control border-0 p-0 shadow-none status_text" rows="3"></textarea>
									</div>
								</div>
								<div class="border-top p-3 d-flex align-items-center">
									<div class="mr-auto">
										<a href="javascript:void(0);" class="text-link small post_matrix"><i class="feather-settings"></i>&nbsp;<span class="post_matrix_text">Anyone</span></a>
									</div>
									<div class="flex-shrink-1">
									   <button type="button" class="btn btn-light btn-sm">Preview</button>
									   <button type="button" class="btn btn-primary btn-sm">Post Status</button>
									</div>
								</div>
							</div>
						 </div>
					  </div>
						<?php
							function conn_selec_text_arr($mode_seection_dropdown){
								switch($mode_seection_dropdown)
								{
									case "1,0,0,0,0": return "<i class='fa fa-globe'></i>&nbsp;&nbsp;Any One";break;
									case "0,1,0,0,0":return "<i class='fa fa-user'></i>&nbsp;&nbsp;Only Me";break;
									case "0,0,1,0,0":return "<i class='fa fa-users'></i>&nbsp;&nbsp;Only Connections";break;
									case "0,0,1,1,0":return "<i class='fa fa-users'></i>&nbsp;&nbsp;Connections of Connections";break;
									case "0,0,1,0,1":return "<i class='fa fa-users'></i>&nbsp;+&nbsp;Allowed Specific";break;
									case "0,0,1,0,2":return "<i class='fa fa-users'></i>&nbsp;-&nbsp;Blocked Specific";break;
								}
							}
							$post_count=0;
							$posts_query="SELECT * FROM users_posts WHERE is_private=0 AND status=1 ORDER BY added DESC"; 
							//(user_id='".$_COOKIE['uid']."' OR r_user_id='".$_COOKIE['uid']."')
							$posts_result=mysqli_query($conn,$posts_query);
							//echo $posts_query;
							if(mysqli_num_rows($posts_result)>0)
							{
								while($posts_row=mysqli_fetch_array($posts_result))
								{
									$post_count=$post_count+1;
									if($post_count==2)
									{
										$jobs_query="SELECT * FROM jobs WHERE status=1";
										$jobs_result=mysqli_query($conn,$jobs_query);
										if(mysqli_num_rows($jobs_result)>0)
										{
											?>
												<div class="mb-3 shadow-sm rounded box bg-white osahan-slider-main">
													<div class="osahan-slider">
														<?php
															while($jobs_row=mysqli_fetch_array($jobs_result))
															{
																$og_title=base_url."job/".trim(strtolower($jobs_row['job_title']))." ".trim(strtolower($jobs_row['job_company']));
																$og_title=str_replace(" ","-",$og_title);
																$og_url=$og_title."-".$jobs_row['id'].".html";
																
																$og_image=base_url."alphas/".strtolower(substr($jobs_row['job_company'],0,1)).".png";
																?>
																<div class="osahan-slider-item">
																	<a href="<?php echo $og_url; ?>">
																		<div class="shadow-sm border rounded bg-white job-item job-item mr-2 mt-3 mb-3">
																			<div class="d-flex align-items-center p-3 job-item-header">
																				<div class="overflow-hidden mr-2">
																				   <h6 class="font-weight-bold text-dark mb-0 text-truncate"><?php echo $jobs_row['job_title']; ?></h6>
																				   <div class="text-truncate text-primary"><?php echo $jobs_row['job_company']; ?></div>
																				   <div class="small text-gray-500"><i class="feather-map-pin"></i> <?php echo $jobs_row['job_location']; ?></div>
																				</div>
																				<img class="img-fluid ml-auto" src="<?php echo $og_image; ?>" alt="" style="border:1px solid #eaebec !important;padding: 2px;border-radius: 7px;">
																			</div>
																			<div class="d-flex align-items-center p-3 border-top border-bottom job-item-body">
																				<div class="overlap-rounded-circle d-flex">
																					<img class="rounded-circle shadow-sm" data-toggle="tooltip" data-placement="top" title="" src="img/p1.png" alt="" data-original-title="Sophia Lee">
																					<img class="rounded-circle shadow-sm" data-toggle="tooltip" data-placement="top" title="" src="img/p2.png" alt="" data-original-title="John Doe">
																					<img class="rounded-circle shadow-sm" data-toggle="tooltip" data-placement="top" title="" src="img/p3.png" alt="" data-original-title="Julia Cox">
																					<img class="rounded-circle shadow-sm" data-toggle="tooltip" data-placement="top" title="" src="img/p4.png" alt="" data-original-title="Robert Cook">
																					<img class="rounded-circle shadow-sm" data-toggle="tooltip" data-placement="top" title="" src="img/p5.png" alt="" data-original-title="Sophia Lee">
																				</div>
																				<span class="font-weight-bold text-primary">18 connections</span>
																			</div>
																			<div class="p-3 job-item-footer">
																				<small class="text-gray-500"><i class="feather-clock"></i> Posted <?php echo date("d-m-Y",strtotime($jobs_row['added'])); ?></small>
																			</div>
																		</div>
																	</a>
																</div>
																<?php
															}
														?>
													</div>
												</div>
											<?php
										}
									}
									$p_user_id=$posts_row['user_id'];
									$p_user_profile=getUserProfileImage($p_user_id);
									
									$p_user_query="SELECT * FROM users WHERE id='$p_user_id'";
									$p_user_result=mysqli_query($conn,$p_user_query);
									$p_user_row=mysqli_fetch_array($p_user_result);
									
									//$occu_query="SELECT * FROM users_"; 
									
									$time="";

									$t=strtotime('now')- strtotime($posts_row['added']);

									$days=floor($t/(60*60*24));

									$hours=floor(($t/(60*60))-($days*24));

									$minutes=floor(($t/(60))-($days*24)-($hours*60));

									$seconds=floor(($t)-($days*24)-($hours*60)-($minutes*60));

									if($days!=0)

									{

										$time="about ".$days." days ago.";

									}

									else if($hours!=0){

										$time="about ".$hours." hours ago.";

									}

									else if($minutes!=0){

										$time="about ".$minutes." minutes ago.";

									}

									else if($seconds!=0){

										$time="about ".$seconds." seconds ago.";

									}
									
									$r_user_query="SELECT * FROM users WHERE id='".$posts_row['r_user_id']."'";

									$r_user_result=mysqli_query($conn,$r_user_query);

									$r_user_row=mysqli_fetch_array($r_user_result);
									
									$post_title=$posts_row['post_title'];

									$post_title=str_replace("{first_name}",$first_name,$post_title);

									$post_title=str_replace("{last_name}",$last_name,$post_title);

									$post_id=$posts_row['id'];

									$post_media_query="SELECT * FROM users_posts_media WHERE post_id='$post_id'";

									$post_media_result=mysqli_query($conn,$post_media_query);
									
									$num_rows=mysqli_num_rows($post_media_result);
								?>
									<div class="box shadow-sm border rounded bg-white mb-3 osahan-post" id="user_posts_container_number_<?php echo $post_id; ?>">
										<div class="p-3 d-flex align-items-center border-bottom osahan-post-header">
											<div class="dropdown-list-image mr-3">
											   <img class="rounded-circle" style="border:1px solid #eaebec !important;" src="<?php echo $p_user_profile; ?>" alt="<?php echo $p_user_row['first_name']." ".$p_user_row['last_name']; ?>">
											   <div class="status-indicator bg-success"></div>
											</div>
											<div class="font-weight-bold">
											   <div class="text-truncate">
													<a href="<?php echo base_url; ?>u/<?php echo $p_user_row['username']; ?>" style="text-decoration:none;">
														<?php echo $p_user_row['first_name']." ".$p_user_row['last_name']; ?>
													</a><?php
														$already_tagged=array();
														$tagged_query="SELECT * FROM users_posts_tags WHERE post_id='".$posts_row['id']."'";
														$tagged_result=mysqli_query($conn,$tagged_query);
														$tagged_num_rows=mysqli_num_rows($tagged_result);
														if($tagged_num_rows>0)
														{
															$tagged_row=mysqli_fetch_array($tagged_result);
															$tagged_user_query="SELECT * FROM users WHERE id='".$tagged_row['r_user_id']."'";
															$tagged_user_result=mysqli_query($conn,$tagged_user_query);
															if(mysqli_num_rows($tagged_user_result)>0)
															{
																$already_tagged[]=$tagged_row['r_user_id'];
																$tagged_user=mysqli_fetch_array($tagged_user_result);
																?>
																&nbsp;is with&nbsp; <a href="<?php echo base_url; ?>u/<?php echo $tagged_user['username']; ?>"><?php echo ucwords(strtolower($tagged_user['first_name'].' '.$tagged_user['last_name'])); ?></a>
																<?php
															}
															if($tagged_num_rows==2)
															{
																$tagged_row=mysqli_fetch_array($tagged_result);
																$tagged_user_query="SELECT * FROM users WHERE id='".$tagged_row['r_user_id']."'";
																$tagged_user_result=mysqli_query($conn,$tagged_user_query);
																if(mysqli_num_rows($tagged_user_result)>0)
																{
																	$already_tagged[]=$tagged_row['r_user_id'];
																	$tagged_user=mysqli_fetch_array($tagged_user_result);
																	?>
																	&nbsp;and&nbsp; <a href="<?php echo base_url; ?>u/<?php echo $tagged_user['username']; ?>"><?php echo ucwords(strtolower($tagged_user['first_name'].' '.$tagged_user['last_name'])); ?></a>
																	<?php
																}
															}
															else if($tagged_num_rows>2){
																?>
																&nbsp;and&nbsp;<a href="javascript:void(0);"><?php echo ($tagged_num_rows-1); ?> others</a>
																<?php
																while($tagged_row=mysqli_fetch_array($tagged_result))
																{
																	$already_tagged[]=$tagged_row['r_user_id'];
																}
															}
														}
													?>
												</div>
											   <div class="small text-gray-500"><?php echo substr($p_user_row['profile_title'],0,50).'...'; ?><br/><?php //echo $post_title.'&nbsp;'; ?><?php echo $time; ?></div>
											</div>
											<div class="dropdown ml-auto" style="max-width:50px;min-width:50px;">
												<a class="dropdown-toggle" href="javascript:void(0);" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
												<ul class="dropdown-menu" style="max-width:100px;min-width:80px;margin-left:-20px;">
													<?php
														if($posts_row['user_id']==$_COOKIE['uid'])
														{
													?>
													<li style="max-width:100px;min-width:80px;text-align:center;border-bottom: 2px solid gray;padding-bottom: 4px;margin-bottom: 5px;" data-toggle="modal" data-target="#do_post_modal_<?php echo $post_id; ?>"><a href="javascript:void(0);">Edit</a></li>
													<li style="max-width:100px;min-width:80px;text-align:center;border-bottom: 2px solid gray;padding-bottom: 4px;margin-bottom: 5px;" onclick="deletePost('<?php echo $posts_row['id']; ?>');"><a href="javascript:void(0);">Delete</a></li>
													<?php
														}
													?>
													<li style="max-width:100px;min-width:80px;text-align:center;"><a href="javascript:void(0);">Report Post</a></li>
												</ul>
											</div>
										</div>
										<div class="p-3 border-bottom osahan-post-body">
											<p class="mb-1 url_meta">
												<?php echo $posts_row['post_text']; ?>
											</p>
											<div class="row" style="padding:0px;margin:0px;">
												<?php 
													if($num_rows>0)
													{
														while($post_media_row=mysqli_fetch_array($post_media_result))
														{
															$media_id=$post_media_row['media_id'];
															$gallery_query="SELECT * FROM gallery WHERE id='$media_id'";
															$gallery_result=mysqli_query($conn,$gallery_query);
															$num_rows=mysqli_num_rows($gallery_result);
															if($num_rows>0)
															{
																$gallery_row=mysqli_fetch_array($gallery_result);
																$type=$gallery_row['type'];
																$type_arr=explode("/",$type);
																if($type_arr[0]=="image")
																{
																	?>
																	<div class="col-md-4" style="padding:5px;border:1px solid gray;cursor:pointer;min-height:200px;max-height:201px;margin-bottom:10px;">
																		<image src="<?php echo base_url.$gallery_row['file']; ?>" class="img-responsive" style="width:100%;min-height:190px;max-height:191px;display:inline;">
																	</div>
																<?php
																}
																else if($type_arr[0]=="video")
																{
																	?>
																	<div class="col-md-4" style="padding:5px;border:1px solid gray;cursor:pointer;margin-bottom:10px;">
																		<video controls nodownload  style="width:100%;min-height:190px;max-height:191px;" autoplay="false">
																			<source src="<?php echo base_url.$gallery_row['file']; ?>" type="video/<?php echo $type_arr[1]; ?>">
																		</video>
																	</div>
																	<?php
																}
															}
														}
													}
												?>
											</div>
											<?php
												$url_preview=$posts_row['url_preview'];
												$preview_arr=explode("*RUBREAK*",$url_preview);
												/*if($num_rows>1)
												{
													?>
													<div class="osahan-slider-main">
														<div class="osahan-slider">
															<?php
															while($post_media_row=mysqli_fetch_array($post_media_result))
															{
																$media_id=$post_media_row['media_id'];
																$post_media=getMediaByID($media_id);
																if($post_media!="" && $post_media!=false)
																{
																	?>
																		<div class="osahan-slider-item">
																			<a href="javascript:void(0);">
																				<div class="shadow-sm border rounded bg-white job-item job-item mr-2 mt-3 mb-3">
																					<img src="<?php echo $post_media; ?>" class="img-fluid" alt="<?php echo $post_media; ?>" style="width:100% !important;">
																				</div>
																			</a>
																		</div>
																	<?php
																}
															}
															?>
														</div>
													</div>
												<?php
												}
												else if($num_rows>0)
												{
													$post_media_row=mysqli_fetch_array($post_media_result);
													$media_id=$post_media_row['media_id'];
													$post_media=getMediaByID($media_id);
													if($post_media!="" && $post_media!=false)
													{
														if(isset($preview_arr[3]) && $preview_arr[3]!="")
														{
															?>
															<a href="<?php echo $preview_arr[3]; ?>" target="_blank">
															<?php
														}
														?>
														<img src="<?php echo $post_media; ?>" class="img-fluid img-responsive p-3" style="width:100% !important;" alt="<?php echo $post_media_row['caption']; ?>">
														<?php
														if(isset($preview_arr[3]) && $preview_arr[3]!="")
														{
															?>
															</a>
															<?php
														}
													}
												}
												else if(isset($preview_arr[1]) && $preview_arr[1]!="")
												{
													?>
													
													<div class="d-flex align-items-center" style="width:100% !important;">
														<div class="box shadow-sm mb-3 rounded bg-white ads-box text-center overflow-hidden" style="width:100% !important;">
															 <a href="<?php echo $preview_arr[3]; ?>" target="_blank" style="width:100% !important;">
																<img src="<?php echo $preview_arr[1]; ?>" class="img-fluid img-responsive p-3" style="width:100% !important;" title="<?php echo $preview_arr[0]; ?>" alt="<?php echo $preview_arr[1]; ?>">
															 </a>
															 <div class="p-3">
																<p class="mb-0 text-muted" style="text-align:justify !important;"><a href="<?php echo $preview_arr[3]; ?>" target="_blank"><?php echo $preview_arr[2]; ?></a></p>
															 </div>
														</div>
													</div>
													<?php
												}*/
											?>
										</div>
										<?php
											/*feelings assessment*/
													$data_feeling="Like";
													$dquery="SELECT COUNT(id) as total FROM users_posts_activity WHERE post_id='$post_id' AND activity_id='Reacted' AND user_id!='".$_COOKIE['uid']."'";
													$dresult=mysqli_query($conn,$dquery);
													$drow=mysqli_fetch_array($dresult);
													$_other_reactions=$drow['total'];
													if(!isset($_other_reactions) || $_other_reactions<0)
													{
														$_other_reactions=0;
													}
													$liked=false;
													$dquery="SELECT id,data_feeling FROM users_posts_activity WHERE post_id='$post_id' AND activity_id='Reacted'";
													$dresult=mysqli_query($conn,$dquery);
													if(mysqli_num_rows($dresult)>0)
													{
														$liked=true;
														$drow=mysqli_fetch_array($dresult);
														$data_feeling=strtolower($drow['data_feeling']);
													}
												/*feelings assessment*/
										?>
										<div class="p-4 border-bottom osahan-post-footer">
											<div class="ru-reaction-box" data-post="<?php echo $post_id; ?>" style="margin-top: -10px !important;">
												<span class="like-btn" data-post="<?php echo $post_id; ?>">
													<span class="like-btn-emo <?php if($liked){ echo 'like-btn-'.strtolower($data_feeling); } else{ echo 'like-btn-default'; } ?>" data-post="<?php echo $post_id; ?>"></span> 
													<span class="like-btn-text <?php if($liked) { echo ' like-btn-text-thoughtful active';}  ?>"  data-post="<?php echo $post_id; ?>"><?php echo $data_feeling; ?></span> 
													<ul class="feelings-box" data-post="<?php echo $post_id; ?>"> 
														<li class="feeling feeling-like" data-post="<?php echo $post_id; ?>" data-feeling="Like"></li>
														<li class="feeling feeling-superlike" data-post="<?php echo $post_id; ?>" data-feeling="Superlike"></li>
														<li class="feeling feeling-thoughtful" data-post="<?php echo $post_id; ?>" data-feeling="Thoughtful"></li>
														<li class="feeling feeling-loved-it" data-post="<?php echo $post_id; ?>" data-feeling="Loved-It"></li>
														<li class="feeling feeling-describe-plz" data-post="<?php echo $post_id; ?>" data-feeling="Describe-Plz"></li>
														<li class="feeling feeling-bang-on" data-post="<?php echo $post_id; ?>" data-feeling="Bang-On"></li>
														<li class="feeling feeling-boring" data-post="<?php echo $post_id; ?>" data-feeling="Boring"></li>
													</ul>
												</span>
												<?php
													$comments_query="SELECT * FROM users_posts_comments WHERE post_id='$post_id' AND status=1 ORDER BY added ASC LIMIT 5";
													$comments_result=mysqli_query($conn,$comments_query);
													$comments_count=mysqli_num_rows($comments_result);
												
												?>
												<span class="like-stat"> 
													<span class="like-emo" data-post="<?php echo $post_id; ?>"> 
														<?php
															if($liked)
															{
																?>
																<span class="like-btn-<?php echo $data_feeling; ?>"></span>
																<?php
															}
														?>
													</span>
													
													<span class="like-details" data-post="<?php echo $post_id; ?>"><?php if($liked){ echo "You and "; } echo $_other_reactions." others reacted"; ?></span>
													<span class="like-details1" data-post="<?php echo $post_id; ?>">
														<a href="#" class="mr-3 text-secondary"><i class="feather-message-square"></i> <?php echo $comments_count; ?></a>
														<a href="#" class="mr-3 text-secondary"><i class="feather-share-2"></i> 0</a>
													</span>
												</span>
											</div>
											<!--<a href="#" class="mr-3 text-secondary"><i class="feather-heart text-danger"></i> 16</a>-->
										</div>
										<div class="commentssec" id="post_comments_data_<?php echo $post_id; ?>">
											<?php
												if($comments_count>0)
												{
													while($comments_row=mysqli_fetch_array($comments_result))
													{
														$u_query="SELECT first_name,last_name FROM users WHERE id='".$comments_row['user_id']."'";
														$u_result=mysqli_query($conn,$u_query);
														$u_row=mysqli_fetch_array($u_result);
														?>
														<div class="p-3 d-flex align-items-top border-bottom osahan-post-comment">
															<div class="dropdown-list-image mr-3">
																<a href="<?php echo base_url; ?>u/<?php echo $u_row['username']; ?>" style="text-decoration:none;">
																	<img class="rounded-circle img-nf" style="border:1px solid #eaebec; !important;" src="<?php echo getUserProfileImage($comments_row['user_id']); ?>" alt="<?php echo $u_row['first_name']." ".$u_row['last_name']; ?>">
																	<div class="status-indicator bg-success"></div>
																</a>
															</div>
															<div class="font-weight-bold" style="width:100% !important">
															   <div class="text-truncate"><a href="<?php echo base_url; ?>u/<?php echo $u_row['username']; ?>" style="text-decoration:none;"> <?php echo $u_row['first_name']." ".$u_row['last_name']; ?></a> <span class="float-right small"><?php echo date("d-m-Y H:i:s",strtotime($comments_row['added'])); ?></span></div>
															   <div class="small text-gray-500"><?php echo $comments_row['comment_text']; ?></div>
															</div>
														</div>
														<?php
													}
												}
											?>
										</div>
										<div class="p-3 d-flex align-items-center w-100">
											<div class="w-100">
												<textarea placeholder="Post a comment" data-img="<?php echo getUserProfileImage($_COOKIE['uid']); ?>" data-uid="<?php echo $_COOKIE['uid']; ?>" data-name="<?php echo $user_row['first_name']." ".$user_row['last_name']; ?>" id="comment_text_<?php echo $post_id; ?>" class="form-control border-0 p-0 shadow-none" rows="1" style="resize:none;"></textarea>
											</div>
											<div class="ml-3">
												<button class="btn btn-primary btn-sm" type="button" onclick="addComment('<?php echo $post_id; ?>');">Send</button>
											</div>
										</div>
										<div class="p-3 border-top osahan-slider-main auto-w">
											<div class="quote_slider" id="osahan-slider">
												<div class="osahan-slider-item" style="width:100px !important;max-width:227px !important;">
													<button type="button" onclick="addComment('<?php echo $post_id; ?>','Love that broadcast!!');" class="btn btn-light btn-sm mr-1">Love that broadcast!!</button>
												</div>
												<div class="osahan-slider-item">
													<button type="button" onclick="addComment('<?php echo $post_id; ?>','Congratulations!!');" class="btn btn-light btn-sm mr-1">Congratulations!!</button>
												</div>
												<div class="osahan-slider-item">
													<button type="button" onclick="addComment('<?php echo $post_id; ?>','Excited!!');" class="btn btn-light btn-sm mr-1">Excited!!</button>
												</div>
												<div class="osahan-slider-item">
													<button type="button" onclick="addComment('<?php echo $post_id; ?>','Thanks a milion for helping out');" class="btn btn-light btn-sm mr-1">Thanks a milion for helping out</button>
												</div>
												<div class="osahan-slider-item">
													<button type="button" onclick="addComment('<?php echo $post_id; ?>','Whats it about?');" class="btn btn-light btn-sm mr-1">Whats it about?</button>
												</div>
												<div class="osahan-slider-item">
													<button type="button" onclick="addComment('<?php echo $post_id; ?>','Oooo Great Wow');" class="btn btn-light btn-sm mr-1">Oooo Great Wow</button>
												</div>
												<div class="osahan-slider-item">
													<button type="button" onclick="addComment('<?php echo $post_id; ?>','Curious');" class="btn btn-light btn-sm mr-1">Curious</button>
												</div>
											</div>
										</div>
										<?php
											$is_public=$posts_row['is_public'];
											$is_private=$posts_row['is_private'];
											$is_protected=$posts_row['is_protected'];
											$is_friendly_protected=$posts_row['is_friendly_protected'];
											$is_magic=$posts_row['is_magic'];
											$who_can_see_selected=$is_public.','.$is_private.','.$is_protected.','.$is_friendly_protected.','.$is_magic;
										?>
										<div class="modal fade do_post_modal_<?php echo $post_id; ?>" id="do_post_modal_<?php echo $post_id; ?>" style="z-index:99999 !important;" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="do_post_modal_static_<?php echo $post_id; ?>" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<form action="" method="post" id="media_form">
														<input type="hidden" name="edit_post_id" value="<?php echo $post_id ?>" id="edit_post_id_<?php echo $post_id; ?>">
														<input type="file" data-idslug="_<?php echo $post_id; ?>" class="image_selector_<?php echo $post_id; ?>" id="media_image_selector_<?php echo $post_id; ?>" name="image_selector[]" multiple="multiple" accept="image/*" style="display:none;">
														<input type="file" data-idslug="_<?php echo $post_id; ?>" class="video_selector_<?php echo $post_id; ?>" id="media_video_selector_<?php echo $post_id; ?>" name="video_selector[]" multiple="multiple" accept="video/*" style="display:none;">
														<input type="file" data-idslug="_<?php echo $post_id; ?>" class="image_selector_<?php echo $post_id; ?>" id="image_selector_<?php echo $post_id; ?>" name="image_selector[]" multiple="multiple" accept="image/*" style="display:none;">
														<input type="file" data-idslug="_<?php echo $post_id; ?>" class="video_selector_<?php echo $post_id; ?>" id="video_selector_<?php echo $post_id; ?>" name="video_selector[]" multiple="multiple" accept="video/*" style="display:none;">
													</form>
													
													<div class="row post_modal_section_<?php echo $post_id; ?>" style="padding:0px;margin:0px;" id="create_post_modal_section_<?php echo $post_id; ?>">
														<div class="col-md-12" style="padding:0px;margin:0px;">
															<div class="modal-header" style="width:100%;">
																<div class="row" style="width:100%;">
																	<div class="col-md-8">
																		<h5 class="modal-title" id="do_post_modal_static_<?php echo $post_id; ?>">Create Post </h5>
																	</div>
																	<div class="col-md-4">
																		<button onclick="resetPost('_<?php echo $post_id; ?>');" data-dismiss="modal" style="border-color:none !important;float:right !important;background-color:#efefef;color:#000;font-size:15px;border-radius:50%;height:30px;width:30px;" type="button"><i class="fa fa-times"></i></button>
																	</div>
																</div>
															</div>
															<div class="modal-body" style="padding:0px;">
																<?php
																	$user_profile_query="SELECT * FROM users WHERE id='".$_COOKIE['uid']."'";
																	$user_profile_result=mysqli_query($conn,$user_profile_query);
																	$user_profile_data=mysqli_fetch_array($user_profile_result);
																?>
																<div class="w-100">
																	<div class="row" style="width:100%;padding:0px;margin:0px;">
																		<div class="col-md-2" style="padding:10px;">
																			<div class="dropdown-list-image mr-3" style="width:50px;height:50px;">
																				<img class="rounded-circle" src="<?php echo getUserProfileImage($_COOKIE['uid']); ?>" alt="User Profile Picture"  style="border:1px solid #eaebec !important;height:50px;width:50px;">
																				<div class="status-indicator bg-success"></div>
																			</div>
																		</div>
																		<div class="col-md-10" style="padding:10px;">
																			<h6><?php
																				echo ucwords(strtolower($user_profile_data['first_name'].' '.$user_profile_data['last_name']));
																			?></h6>
																			<button type="button" class="btn btn-default" style="padding:0px;" onclick="$('#mode_modal_section_<?php echo $post_id; ?>').show();$('#create_post_modal_section_<?php echo $post_id; ?>').hide();" id="mode_<?php echo $post_id; ?>" data-val="<?php echo $who_can_see_selected; ?>"><?php echo conn_selec_text_arr($who_can_see_selected); ?></button>
																		</div>
																		<div class="col-md-12" id="textContent_<?php echo $post_id; ?>" style="min-height:180px !important;max-height:350px !important;overflow-y:auto;">
																			<div class="row">
																				<div class="col-md-12" style="padding:10px;max-height:170px;overflow-y:auto;">
																					<textarea placeholder="Write your thoughts..." autofocus onkeyup="keyupFunction('_<?php echo $post_id; ?>');" style="resize:none;font-size:20px;" name="status_text" id="status_text_<?php echo $post_id; ?>" class="form-control border-0 p-0 shadow-none status_text" rows="5"><?php echo $posts_row['post_text']; ?></textarea>
																				</div>
																				<div class="col-md-12" style="padding:10px;max-height:170px;overflow-y:auto;" id="post_preview_section_<?php echo $post_id; ?>">
																					<?php
																						$post_media_query="SELECT * FROM users_posts_media WHERE post_id='$post_id'";

																						$post_media_result=mysqli_query($conn,$post_media_query);
																						
																						$num_rows=mysqli_num_rows($post_media_result);
																						if($num_rows>0)
																						{
																							?>
																							<div class="row">
																							<?php
																							while($post_media_row=mysqli_fetch_array($post_media_result))
																							{
																								$media_id=$post_media_row['media_id'];
																								$gallery_query="SELECT * FROM gallery WHERE id='$media_id'";
																								$gallery_result=mysqli_query($conn,$gallery_query);
																								$num_rows=mysqli_num_rows($gallery_result);
																								if($num_rows>0)
																								{
																									$gallery_row=mysqli_fetch_array($gallery_result);
																									$type=$gallery_row['type'];
																									$type_arr=explode("/",$type);
																									if($type_arr[0]=="image")
																									{
																										?>
																										<div class="col-md-4" style="padding:5px;border:1px solid gray;cursor:pointer;min-height:200px;max-height:201px;margin-bottom:10px;">
																											<image src="<?php echo base_url.$gallery_row['file']; ?>" class="img-responsive" style="width:100%;min-height:190px;max-height:191px;display:inline;">
																										</div>
																									<?php
																									}
																									else if($type_arr[0]=="video")
																									{
																										?>
																										<div class="col-md-4" style="padding:5px;border:1px solid gray;cursor:pointer;margin-bottom:10px;">
																											<video controls nodownload  style="width:100%;min-height:190px;max-height:191px;" autoplay="false">
																												<source src="<?php echo base_url.$gallery_row['file']; ?>" type="video/<?php echo $type_arr[1]; ?>">
																											</video>
																										</div>
																										<?php
																									}
																								}
																							}
																							?>
																							</div>
																							<?php
																						}
																					?>
																				</div>
																			</div>
																		</div>
																		<div class="col-md-12" style="padding:10px;border-top:1px solid #dee2e6">
																			<div class="row">
																				<div class="col-md-12">
																					<button type="button" class="btn btn-secondary" onclick="$('#add_tags_modal_section_<?php echo $post_id; ?>').show();$('#create_post_modal_section_<?php echo $post_id; ?>').hide();"  title="Tag your friends" style="font-size:16px;border:2px solid gray;border-radius:50%;"><i class="fa fa-tag"></i></button>&nbsp;&nbsp;&nbsp;
																					<button type="button" class="btn btn-primary" onclick="$('#image_selector_<?php echo $post_id; ?>').click();" title="Add photos" style="font-size:16px;border:2px solid gray;border-radius:50%;"><i class="fa fa-picture-o"></i></button>&nbsp;&nbsp;&nbsp;
																					<button type="button" class="btn btn-warning" onclick="$('#video_selector_<?php echo $post_id; ?>').click();" title="Add videos" style="font-size:16px;border:2px solid gray;border-radius:50%;"><i class="fa fa-video-camera"></i></button>
																					<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Words Count : <span id="word_count"><?php $words=explode(" ",$posts_row['post_text']);echo count($words); ?></span></span>
																					<button type="button" class="btn btn-success" id="save_brodcast_post_<?php echo $post_id; ?>" onclick="statusTextKeyup('_<?php echo $post_id; ?>');" style="float:right;font-size:16px;;">Post</button>
																				</div>
																			</div>
																		</div>
																	</div>											
																</div>
															</div>
														</div>
													</div>
													<div class="row post_modal_section_<?php echo $post_id; ?>" style="padding:0px;margin:0px;display:none;" id="mode_modal_section_<?php echo $post_id; ?>">
														<div class="col-md-12" style="padding:0px;margin:0px;">
															<div class="modal-header" style="width:100%;">
																<div class="row" style="width:100%;">
																	<div class="col-md-4">
																		<button title="Back" onclick="$('#create_post_modal_section_<?php echo $post_id; ?>').show();$('#mode_modal_section_<?php echo $post_id; ?>').hide();" style="border-color:none !important;float:left !important;background-color:#efefef;color:#000;font-size:15px;border-radius:50%;height:30px;width:30px;" type="button"><i class="fa fa-arrow-left"></i></button>
																	</div>
																	<div class="col-md-8">
																		<h5 class="modal-title" id="do_post_modal_static">Who can see this?</h5>
																	</div>
																</div>
															</div>
															<div class="modal-body" style="padding:0px;">
																<div class="w-100">
																	<div class="row" style="width:100%;padding:0px;margin:0px;">
																		<div class="col-md-12" id="tagContent" style="min-height:250px !important;max-height:400px !important;overflow-y:auto;">
																			<div class="row">
																				<div class="col-md-12" style="padding:10px;">
																					<div class="row">
																						<div class="col-md-12" style="margin-bottom:20px;">
																							<select id="mode_seection_dropdown_<?php echo $post_id; ?>" onchange="connections_selection_div('_<?php echo $post_id; ?>');" name="mode_seection_dropdown" class="form-control">
																								<option value="1,0,0,0,0" <?php if($who_can_see_selected=="" || $who_can_see_selected=="1,0,0,0,0"){ echo 'selected'; } ?>>Anyone</option>
																								<option value="0,1,0,0,0" <?php if($who_can_see_selected=="0,1,0,0,0"){ echo 'selected'; } ?>>Only Me</option>
																								<option value="0,0,1,0,0" <?php if($who_can_see_selected=="0,0,1,0,0"){ echo 'selected'; } ?>>Only Connections</option>
																								<option value="0,0,1,1,0" <?php if($who_can_see_selected=="0,0,1,1,0"){ echo 'selected'; } ?>>Connections of Connections</option>
																								<option value="0,0,1,0,1" <?php if($who_can_see_selected=="0,0,1,0,1"){ echo 'selected'; } ?>>Allow Specific Connections</option>
																								<option value="0,0,1,0,2" <?php if($who_can_see_selected=="0,0,1,0,2"){ echo 'selected'; } ?>>Block Specific Connections</option>
																							</select>
																						</div>
																					</div>
																					<?php
																						$__user_id=$_COOKIE['uid'];
																						$friends=array();
																						$friends_query="SELECT * FROM user_joins_user WHERE user_id='".$__user_id."' AND status=1";
																						$friends_result=mysqli_query($conn,$friends_query);
																						if(mysqli_num_rows($friends_result)>0)
																						{
																							while($friends_row=mysqli_fetch_array($friends_result))
																							{
																								$friends[]=$friends_row['r_user_id'];
																							}
																						}
																						$friends_query="SELECT * FROM user_joins_user WHERE r_user_id='".$__user_id."' AND status=1";
																						$friends_result=mysqli_query($conn,$friends_query);
																						if(mysqli_num_rows($friends_result)>0)
																						{
																							while($friends_row=mysqli_fetch_array($friends_result))
																							{
																								$friends[]=$friends_row['user_id'];
																							}
																						}
																						$bridge_query="SELECT * FROM users WHERE id IN ('".implode("','",$friends)."')";
																						$bridge_result=mysqli_query($conn,$bridge_query);
																						$bridge_num_rows=mysqli_num_rows($bridge_result);
																						if($bridge_num_rows>0)
																						{
																							?>
																							<div class="row" id="connections_selection_div" style="<?php if($is_magic=='0') {  ?>display:none;<?php } ?>">
																							<?php
																							$allowed=false;
																							$allowed_arr=array();
																							if($is_magic==1)
																							{
																								$allowed=$posts_row['users_allowed'];
																							}
																							else if($is_magic==2)
																							{
																								$allowed=$posts_row['users_blocked'];
																							}
																							if($allowed!=false)
																							{
																								$allowed_arr=explode(",",$allowed);
																							}
																							while($bridge_row=mysqli_fetch_array($bridge_result))
																							{
																								$connect_user_id=$bridge_row['id'];
																								$tag_profile=getUserProfileImage($connect_user_id);
																								?>
																								<div class="col-md-12" style="margin-bottom:5px;font-size:16px;">
																									<input type="checkbox" <?php if(in_array($connect_user_id,$allowed_arr)){ echo 'checked'; } ?> name="mode_friends_<?php echo $post_id; ?>[]" class="mode_friends_<?php echo $post_id; ?>" value="<?php echo $connect_user_id; ?>" style="width:20px;height:20px;vertical-align:-6px;">&nbsp;&nbsp;
																									<a href="<?php echo base_url."u/".$bridge_row['username']; ?>" onclick="return confirm('This may cause to loss your unsaved data.Still want to continue?');" style="text-decoration:none;"><img src="<?php echo $tag_profile; ?>" style="height:40px;width:40px;border-radius:50%;">&nbsp;&nbsp;<?php echo ucwords(strtolower($bridge_row['first_name'].' '.$bridge_row['last_name'])); ?></a>
																								</div>
																								<?php
																							}
																							?>
																							</div>
																							<?php
																						}
																						else
																						{
																							?>
																							<h6 style="text-align:center;">There is no connections.</h6>
																							<?php
																						}
																					?>
																				</div>
																			</div>
																		</div>
																	</div>											
																</div>
															</div>
														</div>
													</div>
													<div class="row post_modal_section_<?php echo $post_id; ?>" style="padding:0px;margin:0px;display:none;" id="add_tags_modal_section_<?php echo $post_id; ?>">
														<div class="col-md-12" style="padding:0px;margin:0px;">
															<div class="modal-header" style="width:100%;">
																<div class="row" style="width:100%;">
																	<div class="col-md-4">
																		<button title="Back" onclick="$('#create_post_modal_section_<?php echo $post_id; ?>').show();$('#add_tags_modal_section_<?php echo $post_id; ?>').hide();" style="border-color:none !important;float:left !important;background-color:#efefef;color:#000;font-size:15px;border-radius:50%;height:30px;width:30px;" type="button"><i class="fa fa-arrow-left"></i></button>
																	</div>
																	<div class="col-md-8">
																		<h5 class="modal-title" id="do_post_modal_static">Tag Connections </h5>
																	</div>
																</div>
															</div>
															<div class="modal-body" style="padding:0px;">
																<div class="w-100">
																	<div class="row" style="width:100%;padding:0px;margin:0px;">
																		<div class="col-md-12" id="tagContent_<?php echo $post_id; ?>" style="min-height:250px !important;max-height:400px !important;overflow-y:auto;">
																			<div class="row">
																				<div class="col-md-12" style="padding:10px;">
																					<?php
																						$__user_id=$_COOKIE['uid'];
																						$friends=array();
																						$friends_query="SELECT * FROM user_joins_user WHERE user_id='".$__user_id."' AND status=1";
																						$friends_result=mysqli_query($conn,$friends_query);
																						if(mysqli_num_rows($friends_result)>0)
																						{
																							while($friends_row=mysqli_fetch_array($friends_result))
																							{
																								$friends[]=$friends_row['r_user_id'];
																							}
																						}
																						$friends_query="SELECT * FROM user_joins_user WHERE r_user_id='".$__user_id."' AND status=1";
																						$friends_result=mysqli_query($conn,$friends_query);
																						if(mysqli_num_rows($friends_result)>0)
																						{
																							while($friends_row=mysqli_fetch_array($friends_result))
																							{
																								$friends[]=$friends_row['user_id'];
																							}
																						}
																						$bridge_query="SELECT * FROM users WHERE id IN ('".implode("','",$friends)."')";
																						$bridge_result=mysqli_query($conn,$bridge_query);
																						$bridge_num_rows=mysqli_num_rows($bridge_result);
																						if($bridge_num_rows>0)
																						{
																							?>
																							<div class="row">
																							<?php
																							while($bridge_row=mysqli_fetch_array($bridge_result))
																							{
																								$connect_user_id=$bridge_row['id'];
																								$tag_profile=getUserProfileImage($connect_user_id);
																								?>
																								<div class="col-md-12" style="margin-bottom:5px;font-size:16px;">
																									<input type="checkbox" name="tagged_friends_<?php echo $post_id; ?>[]" <?php if(in_array($connect_user_id,$already_tagged)){ echo 'checked'; } ?> class="tagged_friends_<?php echo $post_id; ?>" value="<?php echo $connect_user_id; ?>" style="width:20px;height:20px;vertical-align:-6px;">&nbsp;&nbsp;
																									<a href="<?php echo base_url."u/".$bridge_row['username']; ?>" onclick="return confirm('This may cause to loss your unsaved data.Still want to continue?');" style="text-decoration:none;"><img src="<?php echo $tag_profile; ?>" style="height:40px;width:40px;border-radius:50%;">&nbsp;&nbsp;<?php echo ucwords(strtolower($bridge_row['first_name'].' '.$bridge_row['last_name'])); ?></a>
																								</div>
																								<?php
																							}
																							?>
																							</div>
																							<?php
																						}
																						else
																						{
																							?>
																							<h6 style="text-align:center;">There is no connections to tag.</h6>
																							<?php
																						}
																					?>
																				</div>
																			</div>
																		</div>
																	</div>											
																</div>
															</div>
														</div>
													</div>
													<div class="row post_modal_section_<?php echo $post_id; ?>" style="padding:0px;margin:0px;display:none;" id="offered_posting_as_blog_<?php echo $post_id; ?>">
														<div class="col-md-12" style="padding:0px;margin:0px;">
															<div class="modal-header" style="width:100%;">
																<div class="row" style="width:100%;">
																	<div class="col-md-4">
																		<button title="Back" onclick="$('#create_post_modal_section_<?php echo $post_id; ?>').show();$('#offered_posting_as_blog_<?php echo $post_id; ?>').hide();" style="border-color:none !important;float:left !important;background-color:#efefef;color:#000;font-size:15px;border-radius:50%;height:30px;width:30px;" type="button"><i class="fa fa-arrow-left"></i></button>
																	</div>
																	<div class="col-md-8">
																		<h6 class="modal-title">Whether you wish to post it as blog too? </h6>
																	</div>
																</div>
															</div>
															<div class="modal-body" style="padding:0px;">
																<div class="w-100">
																	<div class="row" style="width:100%;padding:0px;margin:0px;">
																		<div class="col-md-12" id="offerBlogContent_<?php echo $post_id; ?>" style="min-height:150px !important;max-height:400px !important;overflow-y:auto;">
																			<div class="row">
																				<div class="col-md-12" style="padding:10px;">
																					<div class="form-group">
																						<input type="radio" name="save_as_blog_too" onclick="$('#blog_title_section_<?php echo $post_id; ?>').show();" checked id="save_as_blog_too_yes_<?php echo $post_id; ?>" value="1">&nbsp;&nbsp;Yes&nbsp;&nbsp;
																						<input type="radio" name="save_as_blog_too" onclick="$('#blog_title_section_<?php echo $post_id; ?>').hide();" id="save_as_blog_too_no_<?php echo $post_id; ?>" value="0">&nbsp;&nbsp;No
																					</div>
																					<div class="form-group" id="blog_title_section">
																						<input type="text" name="blog_title" id="blog_title_<?php echo $post_id; ?>" placeholder="Write down the suitable blog post title" class="form-control">
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>											
																</div>
															</div>
														</div>
													</div>
												
												</div>
											</div>
										</div>
									</div>
									<?php
								}
							}
							/*$my_bridge=getMyBridge($_COOKIE['uid']);
							$extra_stuff="";
							if($my_bridge!=false && $my_bridge!=FALSE)
							{
								$extra_stuff=" AND id NOT IN (".implode(',',$my_bridge).")";
							}
							$suggestions_query="SELECT * FROM users WHERE status=1".$extra_stuff;*/
							
						?>
				   </main>
				   <aside class="col col-xl-3 order-xl-1 col-lg-6 order-lg-2 col-md-6 col-sm-6 col-12">
						<?php
							include_once 'user-profile-section.php';
						?>
						<div class="box shadow-sm mb-3 rounded bg-white ads-box text-center">
							<img src="<?php echo base_url; ?>img/job1.png" class="img-fluid" alt="Responsive image">
							<div class="p-3 border-bottom">
								<h6 class="font-weight-bold text-dark">RopeYou Solutions</h6>
								<p class="mb-0 text-muted">Looking for talent?</p>
							</div>
							<div class="p-3">
								<a href="<?php echo base_url; ?>post-job" class="btn btn-outline-primary pl-4 pr-4"> POST A JOB </a>
							</div>
						</div>
					</aside>
				   <aside class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-6 col-12">
						<?php include_once 'people_you_may_know.php'; ?>
						<div class="box shadow-sm mb-3 rounded bg-white ads-box text-center overflow-hidden">
							<img src="img/ads1.png" class="img-fluid" alt="Responsive image">
							<div class="p-3 border-bottom">
								<h6 class="font-weight-bold text-gold">RopeYou Premium</h6>
								<p class="mb-0 text-muted">Grow & nurture your network</p>
							</div>
							<div class="p-3">
								<button type="button" class="btn btn-outline-gold pl-4 pr-4"> ACTIVATE </button>
							</div>
						</div>
						<?php
							$jobs_query="SELECT * FROM jobs WHERE status=1 ORDER BY id DESC LIMIT 0,5";
							$jobs_result=mysqli_query($conn,$jobs_query);
							if(mysqli_num_rows($jobs_result)>0)
							{
						?>
								<div class="box shadow-sm border rounded bg-white mb-3">
									<div class="box-title border-bottom p-3">
										<h6 class="m-0">Jobs
										</h6>
									</div>
									<div class="box-body p-3">
										<?php
											while($jobs_row=mysqli_fetch_array($jobs_result))
											{
												$og_title=base_url."job/".trim(strtolower($jobs_row['job_title']))." ".trim(strtolower($jobs_row['job_company']));
												$og_title=str_replace(" ","-",$og_title);
												$og_url=$og_title."-".$jobs_row['id'].".html";
												$og_image=base_url."alphas/".strtolower(substr($jobs_row['job_company'],0,1)).".png";
												
										?>
												<a href="<?php echo $og_url; ?>">
												   <div class="shadow-sm border rounded bg-white job-item mb-3">
													  <div class="d-flex align-items-center p-3 job-item-header">
														 <div class="overflow-hidden mr-2">
															<h6 class="font-weight-bold text-dark mb-0 text-truncate"><?php echo $jobs_row['job_title']; ?></h6>
															<div class="text-truncate text-primary"><?php echo $jobs_row['job_company']; ?></div>
															<div class="small text-gray-500"><i class="feather-map-pin"></i> <?php echo $jobs_row['job_location']; ?></div>
														 </div>
														 <img class="img-fluid ml-auto" src="<?php echo $og_image; ?>" alt="<?php echo $jobs_row['job_company']; ?>" style="border:1px solid #eaebec !important;padding: 2px;border-radius: 7px;">
													  </div>
													  <div class="d-flex align-items-center p-3 border-top border-bottom job-item-body">
														 <div class="overlap-rounded-circle">
															<img class="rounded-circle shadow-sm" data-toggle="tooltip" data-placement="top" title="" src="img/p9.png" alt="" data-original-title="Sophia Lee">
															<img class="rounded-circle shadow-sm" data-toggle="tooltip" data-placement="top" title="" src="img/p10.png" alt="" data-original-title="John Doe">
															<img class="rounded-circle shadow-sm" data-toggle="tooltip" data-placement="top" title="" src="img/p11.png" alt="" data-original-title="Julia Cox">
															<img class="rounded-circle shadow-sm" data-toggle="tooltip" data-placement="top" title="" src="img/p12.png" alt="" data-original-title="Robert Cook">
														 </div>
														 <span class="font-weight-bold text-muted">18 connections</span>
													  </div>
													  <div class="p-3 job-item-footer">
														 <small class="text-gray-500"><i class="feather-clock"></i> Posted <?php echo date("d-m-Y",strtotime($jobs_row['added'])); ?></small>
													  </div>
												   </div>
												</a>
										<?php
											}
										?>
									</div>
								</div>
						<?php
							}
						?>
				   </aside>
				</div>
			</div>
		</div>
		<?php include_once 'scripts.php'; ?>
		<script src="<?php echo base_url; ?>/js/sweetalert.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url; ?>js/feeling.js"></script>
		<script>
			localStorage.setItem("uid","<?php echo $_COOKIE['uid']; ?>");
			localStorage.setItem("base_url","<?php echo base_url; ?>");
			function editPost(post_id="")
			{
				if(post_id!="")
				{
					$.ajax({
						url:base_url+'get-edit-data-for-post',
						type:'post',
						data:{post_id:post_id},
						success:function(response)
						{
							var ParsedResponse=JSON.parse(response);
							if(ParsedResponse.status=="success")
							{
								
							}
							else
							{
								alert('Something is not right.we are working on that please try back later.');
							}
						}
					});
				}
				else
				{
					alert('There is an issue please try back later.');
				}
			}
			function deletePost(post_id="")
			{
				if(post_id!="")
				{
					if(confirm('Do you really want to delete this post?'))
					{
						$.ajax({
							url:base_url+'delete-users-post',
							type:'post',
							data:{id:post_id},
							success:function(response)
							{
								var parsedResponse=JSON.parse(response);
								if(parsedResponse.status=="success")
								{
									if($("#user_posts_container_number_"+post_id).length>0)
									{
										$("#user_posts_container_number_"+post_id).remove();
									}
								}
								else
								{
									alert(parsedResponse.mesg);
								}
							}
						});
						
					}
					else
					{
						return false;
					}
				}
				else
				{
					alert('There is an issue removing this post.');
				}
			}
			function conn_selec_text_arr(mode_seection_dropdown){
				switch(mode_seection_dropdown)
				{
					case "1,0,0,0,0": return "<i class='fa fa-globe'></i>&nbsp;&nbsp;Any One";break;
					case "0,1,0,0,0":return "<i class='fa fa-user'></i>&nbsp;&nbsp;Only Me";break;
					case "0,0,1,0,0":return "<i class='fa fa-users'></i>&nbsp;&nbsp;Only Connections";break;
					case "0,0,1,1,0":return "<i class='fa fa-users'></i>&nbsp;&nbsp;Connections of Connections";break;
					case "0,0,1,0,1":return "<i class='fa fa-users'></i>&nbsp;+&nbsp;Allowed Specific";break;
					case "0,0,1,0,2":return "<i class='fa fa-users'></i>&nbsp;-&nbsp;Blocked Specific";break;
				}
			}
			function connections_selection_div(){
				var mode_seection_dropdown=$("#mode_seection_dropdown").val();
				$("#mode").data("val",mode_seection_dropdown);
				$("#mode").html(conn_selec_text_arr(mode_seection_dropdown));
				if(mode_seection_dropdown=="0,0,1,0,2" || mode_seection_dropdown=="0,0,1,0,1")
				{
					$("#connections_selection_div").show();
				}
				else
				{
					$("#connections_selection_div").hide();
				}
			}
			var Upload = function (file) {
				this.file = file;
			};

			Upload.prototype.getType = function() {
				return this.file.type;
			};
			Upload.prototype.getSize = function() {
				return this.file.size;
			};
			Upload.prototype.getName = function() {
				return this.file.name;
			};
			Upload.prototype.doUpload = function (img_id) {
				$("#save_brodcast_post").attr("disabled",true);
				var that = this;
				var formData = new FormData();

				// add assoc key values, this will be posts values
				formData.append("file", this.file, this.getName());
				formData.append("upload_file", true);

				$.ajax({
					type: "POST",
					url: "upload-file-on-server-temp",
					xhr: function () {
						var myXhr = $.ajaxSettings.xhr();
						if (myXhr.upload) {
							myXhr.upload.addEventListener('progress', that.progressHandling, false);
						}
						return myXhr;
					},
					success: function (data) {
						console.log(data);
						var this_parsed_json=JSON.parse(data);
						if(this_parsed_json.id!="")
						{
							$("#"+img_id).attr("imgid",this_parsed_json.id);
						}
						else
						{
							$("#"+img_id).remove();
						}
						$("#save_brodcast_post").attr("disabled",false);
					},
					error: function (error) {
						// handle error
					},
					async: true,
					data: formData,
					cache: false,
					contentType: false,
					processData: false,
					timeout: 6000000
				});
			};

			Upload.prototype.progressHandling = function (event) {
				var percent = 0;
				var position = event.loaded || event.position;
				var total = event.total;
				var progress_bar_id = "#progress-wrp";
				if (event.lengthComputable) {
					percent = Math.ceil(position / total * 100);
				}
				// update progressbars classes so it fits your code
				$(progress_bar_id + " .progress-bar").css("width", +percent + "%");
				$(progress_bar_id + " .status").text(percent + "%");
			};
			
			function uploadMedia()
			{
				$(".post_modal_section").hide();
				$("#create_media_post_modal_section").show();
				$("#do_post_modal").modal('show');
			}
			var offered_posting_as_blog=null;
			function offerPostingAsBlog()
			{
				if(offered_posting_as_blog==null)
				{
					offered_posting_as_blog=1;
					$(".post_modal_section").hide();
					$("#offered_posting_as_blog").show();
				}
			}
			function unOfferPostingAsBlog()
			{
				if(offered_posting_as_blog==1)
				{
					offered_posting_as_blog=null;
					$("#offered_posting_as_blog").hide();
					$("#create_post_modal_section").show();
				}
			}
			function keyupFunction()
			{
				var status_text=$("#status_text").val();
				status_text_trim=status_text.trim();
				var str_arr=status_text_trim.split(" ");
				$("#word_count").text(str_arr.length);
			}
			function saveWallPost()
			{
				var files_uploaded=0;
				var files="";
				if($(".uploaded_file_class").length>0)
				{
					$(".uploaded_file_class").each(function(){
						var img_file_id=$(this).attr("imgid");
						console.log(img_file_id);
						if(files_uploaded>0)
						{
							files=files+",";
						}
						files=files+''+img_file_id;
						files_uploaded=files_uploaded+1;
					});
				}
				
				var status_text=$("#status_text").val();
				$("#status_text").css({"outline":"none"});
				if(files_uploaded>0 || status_text!="")
				{
					var mode=$("#mode").data("val");
					var friends_include_exclude="";
					$(".mode_friends:checkbox:checked").each(function () {
						if(friends_include_exclude!="")
						{
							friends_include_exclude+",";
						}
						friends_include_exclude+=$(this).val();
						
					});
					var tagged="";
					$(".tagged_friends:checkbox:checked").each(function () {
						if(tagged!="")
						{
							tagged+",";
						}
						tagged+=$(this).val();
						
					});
					console.log({files_uploaded:files,tagged:tagged,friends_include_exclude:friends_include_exclude,text_content:status_text,mode:mode});
					
					$.ajax({
						url:base_url+'save-text-post',
						type:'post',
						data:{files_uploaded:files,tagged:tagged,friends_include_exclude:friends_include_exclude,text_content:status_text,mode:mode},
						success:function(response){
							console.log(response);
							var parsed_response=JSON.parse(response);
							if(parsed_response.status=="success")
							{
								swal({
								  title: "Great!",
								  text: "Successfully posted to your timeline.",
								  icon: "success",
								  buttons: {
									cancel: false,
									confirm: "Close",
								  },
								  dangerMode: false,
								  closeOnConfirm: false,
								  closeOnCancel: false
								}).then((value) => {
									location.href=base_url+"broadcasts";
								});
								$("#do_post_modal").modal('hide');
							}
							else if(parsed_response.status=="duplicate")
							{
								swal({
								  title: "OH!",
								  text: "Possibally duplicate post!",
								  icon: "warning",
								  buttons: {
									cancel: false,
									confirm: "Close",
								  },
								  dangerMode: false,
								});
								$("#do_post_modal").modal('hide');
							}
							else
							{
								swal({
								  title: "It's not You!",
								  text: "We are working on this try it after a moment.",
								  icon: "error",
								  buttons: {
									cancel: false,
									confirm: "Close",
								  },
								  dangerMode: false,
								});
								$("#do_post_modal").modal('hide');
							}
						}
					});
				}
				else
				{
					$("#status_text").css({"outline":"1 px solid red"});
				}
			}
			function statusTextKeyup(id_slug="")
			{
				if(id_slug!="")
				{
					var id=id_slug.replace("_","");
				}
				var status_text=$("#status_text"+id_slug).val();
				$("#status_text"+id_slug).css({"outline":"none"});
				status_text_trim=status_text.trim();
				var str_arr=status_text_trim.split(" ");
				$("#word_count"+id_slug).text(str_arr.length);
				if(str_arr.length>300)
				{
					offerPostingAsBlog(id_slug);
				}
				else
				{
					unOfferPostingAsBlog(id_slug);
					saveWallPost(id_slug);
				}
			}
			function resetPost(id_slug)
			{
				if(id_slug=="")
				{
					$(".post_modal_section"+id_slug).hide();
					$(".tagged_friends"+id_slug).prop("checked",false);
					$("#create_post_modal_section"+id_slug).show();
					$(".image_selector"+id_slug).val(null);
					$(".video_selector"+id_slug).val(null);
					$("#status_text"+id_slug).val();
					$("#post_preview_section"+id_slug).html("");
				}
			}
			var img_id_counter=0;
			var file_id="preview_image_";
			var imagesPreview = function(input, placeToInsertImagePreview,id_slug="") {
				if (input.files) {
					var filesAmount = input.files.length;
					for (i = 0; i < filesAmount; i++) {
						img_id_counter=img_id_counter+1;
						var reader = new FileReader();
						reader.onload = function(event) {
							var image_created=$.parseHTML('<img>');
							$(image_created).attr('src', event.target.result);
							$(image_created).attr('id', file_id+img_id_counter+id_slug);
							$(image_created).attr('class', "uploaded_file_class"+id_slug);
							$(image_created).css({"width": "100%","margin-bottom":"15px","border":"1 px solid gray;","padding":"5px"});
							$(image_created).appendTo(placeToInsertImagePreview);
						}
						/*------------------------------------*/
							var file = input.files[i];
							var upload = new Upload(file);
							upload.doUpload(file_id+img_id_counter+id_slug);
						/*------------------------------------*/
						reader.readAsDataURL(input.files[i]);
					}
				}
			};
			var videoPreview = function(input, placeToInsertImagePreview,id_slug="") {
				if (input.files) {
					var filesAmount = input.files.length;
					for (i = 0; i < filesAmount; i++) {
						img_id_counter=img_id_counter+1;
						var reader = new FileReader();
						reader.onload = function(event) {
							var video_created=$.parseHTML('<video>');
							$(video_created).attr('src', event.target.result);
							$(video_created).attr('id', file_id+img_id_counter+id_slug);
							$(video_created).attr('class', "uploaded_file_class"+id_slug);
							$(video_created).attr('controls', true);
							$(video_created).attr('download', false);
							$(video_created).css({"width": "100%","margin-bottom":"15px","border":"1 px solid gray;","padding":"5px"});
							$(video_created).appendTo(placeToInsertImagePreview);
						}
						/*------------------------------------*/
							var file = input.files[i];
							var upload = new Upload(file);
							upload.doUpload(file_id+img_id_counter+id_slug);
						/*------------------------------------*/
						reader.readAsDataURL(input.files[i]);
					}
				}
			};

			$('#image_selector').on('change',function(){
				imagesPreview(this, $("#post_preview_section"),$(this).data('idslug'));
			});
			$('#video_selector').on('change',function(){
				videoPreview(this, $("#post_preview_section"),$(this).data('idslug'));
			});
			$('#media_image_selector').on('change',function(){
				var id_slug=$(this).data('idslug');
				$(".post_modal_section"+id_slug).hide();
				$("#create_post_modal_section"+id_slug).show();
				imagesPreview(this, $("#post_preview_section"),id_slug);
			});
			$('#media_video_selector').on('change',function(){
				var id_slug=$(this).data('idslug');
				$(".post_modal_section"+id_slug).hide();
				$("#create_post_modal_section"+id_slug).show();
				videoPreview(this, $("#post_preview_section"),id_slug);
			});
			(function($) {
				  "use strict"; // Start of use strict

				// Tooltip
				$('[data-toggle="tooltip"]').tooltip();

				// Osahan Slider
				$('.quote_slider').slick({
				  centerMode: true,
				  centerPadding: '30px',
				  slidesToShow: 3,
				  responsive: [
					{
					  breakpoint: 768,
					  settings: {
						arrows: false,
						centerMode: true,
						centerPadding: '40px',
						slidesToShow: 1
					  }
					},
					{
					  breakpoint: 480,
					  settings: {
						arrows: false,
						centerMode: true,
						centerPadding: '40px',
						slidesToShow: 1
					  }
					}
				  ]
				});

			})(jQuery);
			function addComment(post_id,comment_text="")
			{
				if(comment_text=="")
				{
					comment_text=$("#comment_text_"+post_id).val();
				}
				comment_text=comment_text.trim();
				if(comment_text=="")
				{
					swal({
					  title: "Attention!",
					  text: "Blank comment can not be posted.",
					  icon: "error",
					  buttons: {
						cancel: false,
						confirm: "Close",
					  },
					  dangerMode: false,
					});
				}
				else
				{
					var username=$("#comment_text_"+post_id).attr('data-name');
					var userimage=$("#comment_text_"+post_id).attr('data-img');
					var user_id=$("#comment_text_"+post_id).attr('data-uid');
					$.ajax({
						type:'POST',
						url: base_url+"post-comment",
						data:{post_id:post_id,user_id:user_id,comment_text:comment_text},
						success:function(data){
							var data_obj=JSON.parse(data);
							if(data_obj.status=="success")
							{
								var html='<div class="p-3 d-flex align-items-top border-bottom osahan-post-comment" style="width:100%;">'+
								'<div class="dropdown-list-image mr-3">'+
								   '<img class="rounded-circle img-nf" style="border:1px solid #eaebec; !important;" src="'+userimage+'" alt="'+username+'">'+
								   '<div class="status-indicator bg-success"></div>'+
								'</div>'+
							   ' <div class="font-weight-bold" style="width:100% !important">'+
								  ' <div class="text-truncate"> '+username+' <span class="float-right small">just now</span></div>'+
								   '<div class="small text-gray-500">'+data_obj.comment_text+'</div>'+
								'</div>'+
							 '</div>';
							 $("#post_comments_data_"+post_id).append(html);
							 $("#comment_text_"+post_id).val("");
							}
							else{
								swal({
								  title: "Attention!",
								  text: data_obj.message,
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
				}
			}
			$(".post_matrix").click(function(){
				var post_matrix=$("#post_matrix").val();
				$("#mode").val(post_matrix);
				if(post_matrix=="0,0,1,0,1" || post_matrix=="0,0,1,0,2")
				{
					$("#mode_options_html").css("visibility","visible");
					$("#mode_options").val("");
					$("#selected_mode_options").val($("#post_matrix_users").val());
				}
				else
				{
					$("#mode_options").val("");
					$("#selected_mode_options").val("");
					$("#mode_options_html").css("visibility","hidden");
				}
				$("#post_matrix_settings_modal").modal('show');
			});
			$("#mode").change(function(){
				var mode=$("#mode").val();
				if(mode=="0,0,1,0,1" || mode=="0,0,1,0,2")
				{
					$("#mode_options_html").css("visibility","visible");
					$("#mode_options").val("");
					$("#selected_mode_options").val($("#post_matrix_users").val());
				}
				else
				{
					$("#mode_options").val("");
					$("#selected_mode_options").val("");
					$("#mode_options_html").css("visibility","hidden");
				}
			});
			/* Detect a Url in the status text */
			
			var timeout=null;
			/*$('#status_text').bind("keyup",function() {
				$("#ru-loader").hide();
				clearTimeout(timeout);
				timeout = setTimeout(function () {
					var html=$('#status_text').val();
					var url_caught=0;
					console.log(html);
					var h_words=html.split(" ");
					for(i=0;i<h_words.length;i++)
					{
						if(isUrl(h_words[i])){
							$("#ru-loader").show();
							localStorage.setItem('text_status_url',h_words[i]);
							var url=h_words[i];
							url_caught=1;
							$.ajax({
								url:base_url+"preview",
								type:"post",
								data:{url:url},
								success:function(res)
								{
									var preview_html="";
									var resp=JSON.parse(res);
									if(resp.data=="")
									{
										$("#status_text_preview").html(preview_html);
									}
									else
									{
										var response=resp.data;
										var title=response.title;
										var img_url=response.img_url;
										var desc=response.desc;
										var host_url=response.host_url;
										if(title=="")
										{
											title=getWebTitle(url);
										}
										if(img_url=="")
										{
											img_url=base_url+"alphas/"+getWebImage(url)+".png";
										}
										if(host_url=="")
										{
											host_url=url;
										}
										if(desc=="")
										{
											desc="visit "+url;
										}
										if(title=="" && img_url=="" && desc=="")
										{ 
											preview_html="";
										}
										else
										{
											preview_html='<div class="p-3 osahan-post-body">'+
											'<p class="mb-1">'+title+'</p>'+								
													'<div class="d-flex align-items-center" style="width:100% !important;">'+
														'<div class="box shadow-sm mb-3 rounded bg-white ads-box text-center overflow-hidden" style="width:100% !important;">'+
															 '<a href="'+host_url+'" target="_blank" style="width:100% !important;padding:5px;">'+
																'<img src="'+img_url+'" class="img-fluid img-responsive p-3" title="'+host_url+'" alt="'+img_url+'" style="width:100% !important;">'+
															'</a>'+
															 '<div class="border-top">'+
																'<p class="mb-0 text-muted p-3" style="text-align:justify !important;"><a href="'+host_url+'" target="_blank"></a>'+desc+'</p>'+
															 '</div>'+
														'</div>'+
													'</div>'+
													'<input type="hidden" name="url_preview" id="url_preview" value="'+title+'*RUBREAK*'+img_url+'*RUBREAK*'+desc+'*RUBREAK*'+url+'">'+
												'</div>';
										}
										$("#status_text_preview").html(preview_html);
									}
									$("#ru-loader").hide();
								}
							});
						}
					}
					if(url_caught==0)
					{
						$("#status_text_preview").html("");
					}
				}, 1000);
			});*/
			function isUrl(str) {
				switch (str)
				{
					case "http": return false;break;
					case "https": return false;break;
					case "http:": return false;break;
					case "https:": return false;break;
					case "http:/": return false;break;
					case "https:/": return false;break;
					case "http://": return false;break;
					case "https://": return false;break;
				}
				var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
					'((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
					'((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
					'(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
					'(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
					'(\\#[-a-z\\d_]*)?$','i'); // fragment locator
				  return !!pattern.test(str);
			}
			function getWebImage(str) {
				switch (str)
				{
					case "http": return false;break;
					case "https": return false;break;
					case "http:": return false;break;
					case "https:": return false;break;
					case "http:/": return false;break;
					case "https:/": return false;break;
					case "http://": return false;break;
					case "https://": return false;break;
					case "https://w": return false;break;
					case "https://ww": return false;break;
					case "https://www": return false;break;
					case "https://www.": return false;break;
					case "http://w": return false;break;
					case "http://ww": return false;break;
					case "http://www": return false;break;
					case "http://www.": return false;break;
				}
				str = str.replace("https://www.", "");
				str = str.replace("https://", "");
				str = str.replace("http://", "");
				var arr=str.split(".");
				if(arr[0]!="")
				{
					var latter=arr[0].substring(0, 1);
					latter=latter.toLowerCase();
					return latter;
				}
				else if(arr[1]!="")
				{
					var latter=arr[1].substring(0, 1);
					latter=latter.toLowerCase();
					return latter;
				}
				else{
					return "w";
				}
			}
			function getWebTitle(str) {
				switch (str)
				{
					case "http": return false;break;
					case "https": return false;break;
					case "http:": return false;break;
					case "https:": return false;break;
					case "http:/": return false;break;
					case "https:/": return false;break;
					case "http://": return false;break;
					case "https://": return false;break;
					case "https://w": return false;break;
					case "https://ww": return false;break;
					case "https://www": return false;break;
					case "https://www.": return false;break;
					case "http://w": return false;break;
					case "http://ww": return false;break;
					case "http://www": return false;break;
					case "http://www.": return false;break;
				}
				str = str.replace("https://www.", "");
				str = str.replace("https://", "");
				str = str.replace("http://", "");
				var arr=str.split(".");
				if(arr[0]!="")
				{
					return arr[0];
				}
				else if(arr[1]!="")
				{
					return arr[1];
				}
				else{
					return str;
				}
			}
			function submitPost()
			{
				var status_text=$("#status_text").val();
				status_text=status_text.trim();
				if(status_text=="")
				{
					return false;
				}
				var post_matrix=$("#post_matrix").val();
				var post_matrix_users=$("#post_matrix_users").val();
				var url_preview="";
				if($("#url_preview").length>0)
				{
					url_preview=$("#url_preview").val();
				}
				$.ajax({
					url: base_url+"save-text-post",
					type:"post",
					data:{post_text:status_text,url_preview:url_preview,post_matrix:post_matrix,post_matrix_users:post_matrix_users},
					success:function(res){
						if(res=="success")
						{
							swal({
							  title: "Great!",
							  text: "Successfully posted to your timeline.",
							  icon: "success",
							  buttons: {
								cancel: false,
								confirm: "Close",
							  },
							  dangerMode: false,
							  closeOnConfirm: false,
							  closeOnCancel: false
							}).then((value) => {
								location.href=base_url+"broadcasts";
							});
						}
						else if(res=="duplicate")
						{
							swal({
							  title: "OH!",
							  text: "Possibally duplicate post!",
							  icon: "warning",
							  buttons: {
								cancel: false,
								confirm: "Close",
							  },
							  dangerMode: false,
							});
						}
						else 
						{
							swal({
							  title: "It's not You!",
							  text: "We are working on this try it after a moment.",
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
			}
		</script>
   </body>
</html>
<script async src="https://guteurls.de/guteurls.js" selector=".url_meta"> </script> 