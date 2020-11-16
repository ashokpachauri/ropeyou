<?php
	function get_user_resume($resume_user_id)
	{
		include_once 'connection.php';
		$user_query="SELECT * FROM users WHERE id='$resume_user_id'";
		$user_result=mysqli_query($conn,$user_query);
		if(mysqli_num_rows($user_result)>0)
		{
			$user_row=mysqli_fetch_array($user_result);
			$_WEB_AUTHOR=ucfirst($user_row['first_name']." ".$user_row['last_name']);
			$profile_image=getUserProfileImage($resume_user_id);
			
			$user_personal_query="SELECT * FROM users_personal WHERE user_id='$resume_user_id'";
			$user_personal_result=mysqli_query($conn,$user_personal_query);
			$user_personal_row=mysqli_fetch_array($user_personal_result);
			?>
			<!DOCTYPE html>
			<html lang="en">
				<title><?php echo "{$_WEB_AUTHOR}"; ?> :: Resume By RopeYou</title>
				<?php include_once 'head.php'; ?>
				<link href="<?php echo base_url; ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
				<link href="<?php echo base_url; ?>jquery-ui/jquery-ui.min.css" media="all" rel="stylesheet">
				<script src="<?php echo base_url; ?>vendor/jquery/jquery.min.js"></script>
				<script src="<?php echo base_url; ?>jquery-ui/jquery-ui.min.js"></script>
				<body style="overflow-x:hidden;">
					<?php 
						function relocate($type="")
						{
							if($type=="2")
							{
								return "Can Relocate Worldwide";
							}
							else if($type=="1")
							{
								return "Can Relocate within home country";
							}
							else if($type=="0")
							{
								return "Can not relocate outside home town";
							}
							else{
								return "";
							}
						}
					?>
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-8" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);transition: box-shadow 83ms;background:#fff;padding:25px 50px 25px;border-radius:2px;margin-top:30px;margin-bottom:30px;">
							<div style="width:100%;background-color:#efefef;">
								<h3 style="text-align:center;"><span id="full_name_html"><?php echo $user_row['first_name']." ".$user_row['last_name']; ?></span></h3>
								<p style="text-align:center !important;"><a href="<?php echo base_url; ?>u/<?php echo $user_row['username']; ?>" title="<?php echo base_url; ?>u/<?php echo $user_row['username']; ?>" target="_blank"><?php echo base_url; ?>u/<?php echo $user_row['username']; ?></a></p>
							</div>
							<div style="text-align:center;width:100%;">
								<?php
									$_WEB_AUTHOR_IMAGE=getUserProfileImage($resume_user_id);
								?>
								<img id="user_image_html" src="<?php echo $_WEB_AUTHOR_IMAGE; ?>" class="" style="max-height:150px;cursor:pointer;border:1px solid #efefef;"><br/>
								<!--<p class="address" id="address_html" ><?php echo $user_personal_row['address']; ?></p>-->
								
								<p id="communication_details" >
									<?php
										if($user_personal_row['communication_mobile']!="")
										{
											?>
											Mobile: <span id="mobile_html"><?php echo $user_personal_row['communication_mobile']; ?></span>
											<?php
										}
										if($user_personal_row['communication_email']!="")
										{
											if($user_personal_row['communication_mobile']!="")
											{
												echo "&nbsp;|&nbsp;";
											}
											?>
											Email: <span id="email_html"><?php echo strtolower($user_personal_row['communication_email']); ?></span>
											<?php
										}
									?>
								</p>
								<p id="abroad_details">
									<?php
										if($user_personal_row['passport']!="")
										{
											?>
											<span id="passport_html"><?php echo ucfirst($user_personal_row['passport']); ?></span> 
											<?php
										}
										if($user_personal_row['relocate_abroad']!="" && $user_personal_row['relocate_abroad']!="")
										{
											if($user_personal_row['passport']!="")
											{
												echo "&nbsp;|&nbsp;";
											}
											?>
											<span id="relocate_html"<?php echo ucfirst($user_personal_row['relocate_abroad']); ?>></span> 
											<?php
										}
									?>
								</p>
							</div>
							<div class="row row_position">
								<?php
									if($user_personal_row['about']!="" && $user_personal_row['about']!=null)
									{
								?>
								<div id="professional_summary_draggable" style="width:100%;" draggable>
									<div style="width:100%;background-color:#efefef;cursor: move;" id="professional_summary_draggable_header">
										<h4 style="text-align:center;" id="profile_title">PROFESSIONAL SUMMARY</h4>
									</div>
									<div style="width:100%;">
										<div style="text-align:justify;background:none !important;background-color:none!important;page-break-after: auto;" id="about_html">
											<?php echo @strip_tags($user_personal_row['about']); ?>
										</div>
									</div>
								</div>
								<?php
									}
									$experience_query="SELECT * FROM users_work_experience WHERE user_id='$resume_user_id' AND status=1 ORDER BY from_year DESC";
									$experience_result=mysqli_query($conn,$experience_query);
									if(mysqli_num_rows($experience_result)>0)
									{
										?>
										<div id="experience_draggable" style="width:100%;resize:none;" draggable>
											<div class="row">
												<div class="col-md-12">
													<div style="width:100%;background-color:#efefef;cursor: move;" id="experience_draggable_header">
														<h4 style="text-align:center;" id="experience_1">
															EXPERIENCE 
														</h4>
													</div>
												</div>
											</div>
											<?php
											while($experience_row=mysqli_fetch_array($experience_result))
											{
												if(!empty($experience_row)){
													$experience_id=$experience_row['id'];
													$country_query="SELECT title FROM country WHERE id='".$experience_row['country']."'";
													$country_result=mysqli_query($conn,$country_query);
													$country_row=mysqli_fetch_array($country_result);
													
													$city_query="SELECT title FROM city WHERE id='".$experience_row['city']."'";
													$city_result=mysqli_query($conn,$city_query);
													$city_row=mysqli_fetch_array($city_result);
													?>
													<div class="row draggable" id="experience_<?php echo $experience_row['id']; ?>">
														<div class="col-md-12">
															<div style="width:100%;background-color:#efefef;cursor: move;" id="experience_draggable_header">
																<h5 style="text-align:center;" id="experience_1">
																	<?php echo ucfirst(strtolower($experience_row['title'])); ?> at <?php echo ucfirst(strtolower($experience_row['company'])); ?>
																</h5>
															</div>
															<div style="width:100%;">
																<h6>
																	<?php 
																		echo $experience_row['company'];
																		if(!!$city_row['title'])
																		{
																			echo ", ".$city_row['title'];
																		}
																		if(!!$country_row['title'])
																		{
																			echo ", ".$country_row['title'];
																		}
																	?>
																</h6>
																<h6><?php echo $experience_row['title']; ?><span class="pull-right"><?php echo print_month($experience_row['from_month'])." ".$experience_row['from_year']; ?> - <?php if($experience_row['working']=="1"){ echo "Present"; } else { echo print_month($experience_row['to_month'])." ".$experience_row['to_year']; } ?></span></h6>
																<p>
																	<?php echo @strip_tags($experience_row['description']); ?> 
																</p>
															</div>
														</div>
													</div>
													<?php
												}
											}
											?>
										</div>
								<?php
									}
									$skills_query="SELECT * FROM users_skills WHERE type=2 AND status=1 AND user_id='$resume_user_id' order by type ASC";
									$skills_result=mysqli_query($conn,$skills_query);
									if(mysqli_num_rows($skills_result)>0)
									{
										?>
										<div id="personal_skills_draggable" style="width:100%;" draggable>
											<div style="width:100%;background-color:#efefef;cursor: move;" id="personal_skills_draggable_header">
												<h4 style="text-align:center;" id="personal_skills_title">
													PERSONAL SKILLS
												</h4>
											</div>
											<div class="row">
												<?php
												while($skills_row=mysqli_fetch_array($skills_result))
												{
													?>
													<div class="col-md-6 col-xs-6 col-sm-6 col-lg-6">
														<p><?php echo ucfirst($skills_row['title']); ?></p>
													</div>
													<?php
												}
											?>
											</div>
										</div>
									<?php
									}
									$skills_query="SELECT * FROM users_skills WHERE type=1 AND status=1 AND user_id='$resume_user_id' order by type ASC";
									$skills_result=mysqli_query($conn,$skills_query);
									if(mysqli_num_rows($skills_result)>0)
									{
										?>
										<div id="professional_skills_draggable" style="width:100%;" draggable>
											<div style="width:100%;background-color:#efefef;cursor: move;" id="professional_skills_draggable_header">
												<h4 style="text-align:center;" id="personal_skills_title">
													PROFESSIONAL SKILLS
												</h4>
											</div>
											<div class="row">
												<?php
												while($skills_row=mysqli_fetch_array($skills_result))
												{
													?>
													<div class="col-md-6 col-xs-6 col-sm-6 col-lg-6">
														<p><?php echo ucfirst($skills_row['title']); ?></p>
													</div>
													<?php
												}
												?>
											</div>
										</div>
										<?php
									}
									$skills_query="SELECT * FROM users_skills WHERE type=3 AND status=1 AND user_id='$resume_user_id' order by type ASC";
									$skills_result=mysqli_query($conn,$skills_query);
									if(mysqli_num_rows($skills_result)>0)
									{
										?>
										<div id="linguistic_skills_draggable" style="width:100%;" draggable>
											<div style="width:100%;background-color:#efefef;cursor: move;" id="linguistic_skills_draggable_header">
												<h4 style="text-align:center;" id="personal_skills_title">
													LINGUISTIC SKILLS
												</h4>
											</div>
											<div class="row">
											<?php
												while($skills_row=mysqli_fetch_array($skills_result))
												{
													?>
													<div class="col-md-6 col-xs-6 col-sm-6 col-lg-6">
														<p><?php echo ucfirst($skills_row['title']); ?></p>
													</div>
													<?php
												}
									?>
											</div>
										</div>
									<?php
									}
									$experience_query="SELECT * FROM users_education WHERE user_id='$resume_user_id' AND status=1 ORDER BY from_year DESC";
									$experience_result=mysqli_query($conn,$experience_query);
									if(mysqli_num_rows($experience_result)>0)
									{
										?>
										<div id="education_draggable" style="width:100%;" draggable>
											<div class="row">
												<div class="col-md-12">
													<div style="width:100%;background-color:#efefef;cursor: move;" id="experience_draggable_header">
														<h4 style="text-align:center;" id="experience_1">
															ACADEMICS 
														</h4>
													</div>
												</div>
											</div>
										<?php
										while($experience_row=mysqli_fetch_array($experience_result))
										{
											if(!empty($experience_row)){
												$experience_id=$experience_row['id'];
												$country_query="SELECT title FROM country WHERE id='".$experience_row['country']."'";
												$country_result=mysqli_query($conn,$country_query);
												$country_row=mysqli_fetch_array($country_result);
												
												$city_query="SELECT title FROM city WHERE id='".$experience_row['city']."'";
												$city_result=mysqli_query($conn,$city_query);
												$city_row=mysqli_fetch_array($city_result);
												?>
												<div class="row draggable" id="education_<?php echo $experience_row['id']; ?>">
													<div class="col-md-12">
														<div style="width:100%;background-color:#efefef;cursor: move;" id="education_draggable_header">
															<h5 style="text-align:center;" id="experience_1">
																<?php echo ucfirst(strtolower($experience_row['title'])); ?> at <?php echo ucfirst(strtolower($experience_row['university'])); ?>
															</h5>
														</div>
														<div style="width:100%;">
															<h6>
																<?php 
																	echo $experience_row['university'];
																	if(!!$city_row['title'])
																	{
																		echo ", ".$city_row['title'];
																	}
																	if(!!$country_row['title'])
																	{
																		echo ", ".$country_row['title'];
																	}
																?>
															</h6>
															<h6><?php echo $experience_row['title']; ?><span class="pull-right"><?php echo print_month($experience_row['from_month'])." ".$experience_row['from_year']; ?> - <?php if($experience_row['studying']=="1"){ echo "Present"; } else { echo print_month($experience_row['to_month'])." ".$experience_row['to_year']; } ?></span></h6>
															<p>
																<?php echo @strip_tags($experience_row['description']); ?> 
															</p>
														</div>
													</div>
												</div>
												<?php
											}
										}
										?>
									</div>
								<?php
									}
									$skills_query="SELECT * FROM users_awards WHERE status=1 AND user_id='$resume_user_id' order by added DESC";
									$skills_result=mysqli_query($conn,$skills_query);
									if(mysqli_num_rows($skills_result)>0)
									{
										?>
										<div id="achievements_draggable" style="width:100%;" draggable>
											<div style="width:100%;background-color:#efefef;cursor: move;" id="achievements_draggable_header">
												<h4 style="text-align:center;" id="personal_skills_title">
													ACHIEVEMENTS
												</h4>
											</div>
											<div class="row">
												<?php
												$i=1;
												while($skills_row=mysqli_fetch_array($skills_result))
												{
													?>
													<div class="col-md-6 col-xs-6 col-sm-6 col-lg-6" style="margin-bottom:10px;">
														<h6><?php echo $i++; echo '. &nbsp;'.ucfirst($skills_row['title']); ?></h6>
														<p class="text-justify">
															<?php echo ucfirst(strip_tags($skills_row['description'])); ?>
														</p>
													</div>
													<?php
												}
												?>
											</div>
										</div>
										<?php
									}
									$skills_query="SELECT * FROM users_interests WHERE status=1 AND user_id='$resume_user_id' order by added DESC";
									$skills_result=mysqli_query($conn,$skills_query);
									if(mysqli_num_rows($skills_result)>0)
									{
										?>
										<div id="interests_draggable" style="width:100%;" draggable>
											<div style="width:100%;background-color:#efefef;cursor: move;" id="achievements_draggable_header">
												<h4 style="text-align:center;" id="personal_skills_title">
													INTERESTS
												</h4>
											</div>
											<div class="row">
												<?php
												while($skills_row=mysqli_fetch_array($skills_result))
												{
													?>
													<div class="col-md-6 col-xs-6 col-sm-6 col-lg-6">
														<p><?php echo ucfirst($skills_row['title']); ?></p>
													</div>
													<?php
												}
												?>
											</div>
										</div>
										<?php
									}
								?>
							</div>
						</div>
						<div class="col-md-2"></div>
					</div>
				</body>
				<script>
					$( ".row_position" ).sortable({
						delay: 150,
						stop: function() {
							//var selectedData = new Array();
							//$('.row_position>tr').each(function() {
								//selectedData.push($(this).attr("id"));
							//});
							//updateOrder(selectedData);
						}
					});
					var base_url=localStorage.getItem('base_url');					
				</script>
			</html>
	<?php
		}
		else
		{
			echo 'Nothing found for the given user';
		}
	}
	get_user_resume(1007);
?>