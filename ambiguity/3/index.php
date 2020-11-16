<?php
	function get_user_resume($resume_user_id)
	{
		include_once'../../connection.php';
		$user_query="SELECT * FROM users WHERE id='$resume_user_id'";
		$user_result=mysqli_query($conn,$user_query);
		if(mysqli_num_rows($user_result)>0)
		{
			$user_row=mysqli_fetch_array($user_result);
			$_WEB_AUTHOR=ucwords($user_row['first_name']." ".$user_row['last_name']);
			$profile_image=getUserProfileImage($resume_user_id);
			
			$user_personal_query="SELECT * FROM users_personal WHERE user_id='$resume_user_id'";
			$user_personal_result=mysqli_query($conn,$user_personal_query);
			$user_personal_row=mysqli_fetch_array($user_personal_result);
			$creator_id=false;
			$creator_query="SELECT * FROM resume_creator WHERE user_id='$resume_user_id'";
			$creator_result=mysqli_query($conn,$creator_query);
			if(mysqli_num_rows($creator_result)>0)
			{
				$creator_row=mysqli_fetch_array($creator_result);
				if($creator_row['first_name']!="" && $creator_row['first_name']!=null)
				{
					$_WEB_AUTHOR=ucwords($creator_row['first_name']." ".$creator_row['last_name']);
				}
				$creator_id=$creator_row['id'];
			}
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
			$_WEB_AUTHOR_IMAGE=getUserProfileImage($resume_user_id);
			$html_for_pdf='<!DOCTYPE html>
			<html lang="en">
				<title>'.$_WEB_AUTHOR.'  :: Resume By RopeYou</title>
				<link href="'.base_url.'vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
				<script src="'.base_url.'vendor/jquery/jquery.min.js"></script>
				<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
				<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
				<link href="'.base_url.'jquery-ui/jquery-ui.min.css" media="all" rel="stylesheet">
				<link href="'.base_url.'css/style.css" media="all" rel="stylesheet">
				<link href="'.base_url.'vendor/slick/slick.min.css" media="all" rel="stylesheet">
				<link href="'.base_url.'vendor/slick/slick-theme.min.css" media="all" rel="stylesheet">
				<script src="'.base_url.'jquery-ui/jquery-ui.min.js"></script>
				<body style="overflow-x:hidden;">
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-8" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);transition: box-shadow 83ms;background:#fff;padding:25px 50px 25px;border-radius:2px;margin-top:30px;margin-bottom:30px;">
							<div style="width:100%;background-color:#efefef;height:70px;">';
								if($creator_id)
								{
									$html_for_pdf.='<a href="javascript:void(0);" style="font-size:25px;float:left;border:1px solid gray;padding:3px;margin-right:20px;text-decoration:none;color:red;" onclick="ShareResume();" title="Share using email"><i class="fa fa-envelope"></i></a>';
									$html_for_pdf.='<a href="'.base_url.'ambiguity/'.$creator_row['resume_id'].'/get-pdf" target="_blank" style="font-size:25px;float:right;border:1px solid gray;padding:3px;margin-right:20px;" title="Download Resume"><i class="fa fa-download"></i></a>';
								}
								$html_for_pdf.='</div>
							<div style="width:100%;background-color:#efefef;">
								<h3 style="text-align:center;"><span id="full_name_html">'. $_WEB_AUTHOR; $html_for_pdf.='</span><a href="'.base_url.'provide-resume-information.php?step=1&reload=force" style="float:right;font-size:14px;">(edit)</a></h3>
								<p style="text-align:center !important;">'; if(isset($creator_row) && $creator_row['profile_title']!="") { $html_for_pdf.=  $creator_row['profile_title']; } else { $html_for_pdf.= $user_row['profile_title']; }$html_for_pdf.='</p>
								
							</div>
							<div style="text-align:center;width:100%;">
								<img id="user_image_html" src="'. $_WEB_AUTHOR_IMAGE; $html_for_pdf.='" class="" style="max-height:150px;cursor:pointer;border:1px solid #efefef;"><br/>
								
								<p style="text-align:center !important;"><a href="'.base_url.'u/'. $user_row['username']; $html_for_pdf.='" title="'.base_url.'u/'. $user_row['username']; $html_for_pdf.='" target="_blank">'.base_url.'u/'. $user_row['username']; $html_for_pdf.='</a></p>
								<p id="communication_details" >';
										
										if($user_personal_row['communication_mobile']!="")
										{
											
											$html_for_pdf.='Mobile: <span id="mobile_html">'. $user_personal_row['communication_mobile']; $html_for_pdf.='</span>';
											
										}
										if($user_personal_row['communication_email']!="")
										{
											if($user_personal_row['communication_mobile']!="")
											{
												$html_for_pdf.='&nbsp;|&nbsp;';
											}
											
											$html_for_pdf.='Email: <span id="email_html">'. strtolower($user_personal_row['communication_email']); $html_for_pdf.='</span>';
											
										}
									
								/*$html_for_pdf.='</p>
								<p id="abroad_details">';
									
										if($user_personal_row['passport']!="")
										{
											
											$html_for_pdf.='<span id="passport_html">'. ucfirst($user_personal_row['passport']); $html_for_pdf.='</span> ';
											
										}
										if($user_personal_row['relocate_abroad']!="" && $user_personal_row['relocate_abroad']!="")
										{
											if($user_personal_row['passport']!="")
											{
												$html_for_pdf.="&nbsp;|&nbsp;";
											}
											
											$html_for_pdf.='<span id="relocate_html"'. ucfirst($user_personal_row['relocate_abroad']);$html_for_pdf.='></span> ';
											
										}
									
								$html_for_pdf.='</p>';*/
							$html_for_pdf.='</div>
							<div class="row row_position">';
								
									if($creator_row['about']!="" && $creator_row['about']!=null)
									{
								
								$html_for_pdf.='<div id="professional_summary_draggable" style="width:100%;" draggable>
									<div style="width:100%;background-color:#efefef;cursor: move;" id="professional_summary_draggable_header">
										<h4 style="text-align:center;" id="profile_title">PROFESSIONAL SUMMARY<a href="'.base_url.'provide-resume-information.php?step=2&reload=force" style="float:right;font-size:14px;">(edit)</a></h4>
									</div>
									<div style="width:100%;">
										<div style="text-align:justify;background:none !important;background-color:none!important;page-break-after: auto;" id="about_html">
											'. @htmlspecialchars_decode($creator_row['about']); 
										$html_for_pdf.='</div>
									</div>
								</div>';
									}
									else if($user_personal_row['about']!="" && $user_personal_row['about']!=null)
									{
								
								$html_for_pdf.='<div id="professional_summary_draggable" style="width:100%;" draggable>
									<div style="width:100%;background-color:#efefef;cursor: move;" id="professional_summary_draggable_header">
										<h4 style="text-align:center;" id="profile_title">PROFESSIONAL SUMMARY<a href="'.base_url.'provide-resume-information.php?step=2&reload=force" style="float:right;font-size:14px;">(edit)</a></h4>
									</div>
									<div style="width:100%;">
										<div style="text-align:justify;background:none !important;background-color:none!important;page-break-after: auto;" id="about_html">
											'. @htmlspecialchars_decode($user_personal_row['about']); 
										$html_for_pdf.='</div>
									</div>
								</div>';
								
									}
									$experience_query="SELECT * FROM resume_experiences WHERE creator_id='$creator_id' ORDER BY from_year DESC";
									$experience_result=mysqli_query($conn,$experience_query);
									if(mysqli_num_rows($experience_result)>0)
									{
										
										$html_for_pdf.='<div id="experience_draggable" style="width:100%;resize:none;" draggable>
												<div class="row">
													<div class="col-md-12">
														<div style="width:100%;background-color:#efefef;cursor: move;" id="experience_draggable_header">
															<h4 style="text-align:center;" id="experience_1">
																EXPERIENCE <a href="'.base_url.'provide-resume-information.php?step=3&reload=force" style="float:right;font-size:14px;">(edit)</a>
															</h4>
														</div>
													</div>
												</div>';
												
												while($experience_row=mysqli_fetch_array($experience_result))
												{
													if(!empty($experience_row)){
														$experience_id=$experience_row['id'];
														$html_for_pdf.='<div class="row draggable" id="experience_'. $experience_row['id'];$html_for_pdf.='">
															<div class="col-md-12">
																<div style="width:100%;background-color:#efefef;cursor: move;" id="experience_draggable_header">
																	<h5 style="text-align:center;" id="experience_1">
																		'. ucfirst(strtolower($experience_row['designation'])); $html_for_pdf.=' at '. ucfirst(strtolower($experience_row['company'])); 
																	$html_for_pdf.='</h5>
																</div>
																<div style="width:100%;">
																	<h6>
																		 
																			'. $experience_row['company'];
																			
																		
																	$html_for_pdf.='</h6>
																	<h6>'. $experience_row['designation']; $html_for_pdf.='<span class="pull-right">'. print_month($experience_row['from_month'])." ".$experience_row['from_year']; $html_for_pdf.=' - '; if($experience_row['working']=="1"){$html_for_pdf.="Present"; } else {$html_for_pdf.=print_month($experience_row['to_month'])." ".$experience_row['to_year']; } $html_for_pdf.='</span></h6>
																	<p>
																		'. @strip_tags($experience_row['description']);  
																	$html_for_pdf.='</p>
																</div>
															</div>
														</div>';
														
													}
												}
												
											$html_for_pdf.='</div>';
										
									}
									else
									{
										$experience_query="SELECT * FROM users_work_experience WHERE user_id='$resume_user_id' AND status=1 ORDER BY from_year DESC";
										$experience_result=mysqli_query($conn,$experience_query);
										if(mysqli_num_rows($experience_result)>0)
										{
											
											$html_for_pdf.='<div id="experience_draggable" style="width:100%;resize:none;" draggable>
												<div class="row">
													<div class="col-md-12">
														<div style="width:100%;background-color:#efefef;cursor: move;" id="experience_draggable_header">
															<h4 style="text-align:center;" id="experience_1">
																EXPERIENCE <a href="'.base_url.'provide-resume-information.php?step=3&reload=force" style="float:right;font-size:14px;">(edit)</a>
															</h4>
														</div>
													</div>
												</div>';
												
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
														
														$html_for_pdf.='<div class="row draggable" id="experience_'. $experience_row['id'];$html_for_pdf.='">
															<div class="col-md-12">
																<div style="width:100%;background-color:#efefef;cursor: move;" id="experience_draggable_header">
																	<h5 style="text-align:center;" id="experience_1">
																		'. ucfirst(strtolower($experience_row['title'])); $html_for_pdf.=' at '. ucfirst(strtolower($experience_row['company'])); 
																	$html_for_pdf.='</h5>
																</div>
																<div style="width:100%;">
																	<h6>
																		 
																			'. $experience_row['company'];
																			if(!!$city_row['title'])
																			{
																				$html_for_pdf.=", ".$city_row['title'];
																			}
																			if(!!$country_row['title'])
																			{
																				$html_for_pdf.=", ".$country_row['title'];
																			}
																		
																	$html_for_pdf.='</h6>
																	<h6>'. $experience_row['title']; $html_for_pdf.='<span class="pull-right">'. print_month($experience_row['from_month'])." ".$experience_row['from_year']; $html_for_pdf.=' - '; if($experience_row['working']=="1"){$html_for_pdf.="Present"; } else {$html_for_pdf.=print_month($experience_row['to_month'])." ".$experience_row['to_year']; } $html_for_pdf.='</span></h6>
																	<p>
																		'. @htmlspecialchars_decode($experience_row['description']);  
																	$html_for_pdf.='</p>
																</div>
															</div>
														</div>';
														
													}
												}
												
											$html_for_pdf.='</div>';
									
										}
									}
									$skills_query="SELECT * FROM resume_skills WHERE creator_id='".$creator_id."' AND type=2 order by type ASC";
									$skills_result=mysqli_query($conn,$skills_query);
									if(mysqli_num_rows($skills_result)>0)
									{
										
										$html_for_pdf.='<div id="personal_skills_draggable" style="width:100%;" draggable>
												<div style="width:100%;background-color:#efefef;cursor: move;" id="personal_skills_draggable_header">
													<h4 style="text-align:center;" id="personal_skills_title">
														PERSONAL SKILLS<a href="'.base_url.'provide-resume-information.php?step=5&reload=force" style="float:right;font-size:14px;">(edit)</a>
													</h4>
												</div>
												<div class="row">';
													
													while($skills_row=mysqli_fetch_array($skills_result))
													{
														
														$html_for_pdf.='<div class="col-md-6 col-xs-6 col-sm-6 col-lg-6">
															<p>'. ucfirst($skills_row['title']); $html_for_pdf.='</p>
														</div>';
														
													}
												
												$html_for_pdf.='</div>
											</div>';
										
									}
									else
									{
										$skills_query="SELECT * FROM users_skills WHERE type=2 AND status=1 AND user_id='$resume_user_id' order by type ASC";
										$skills_result=mysqli_query($conn,$skills_query);
										if(mysqli_num_rows($skills_result)>0)
										{
											
											$html_for_pdf.='<div id="personal_skills_draggable" style="width:100%;" draggable>
												<div style="width:100%;background-color:#efefef;cursor: move;" id="personal_skills_draggable_header">
													<h4 style="text-align:center;" id="personal_skills_title">
														PERSONAL SKILLS<a href="'.base_url.'provide-resume-information.php?step=5&reload=force" style="float:right;font-size:14px;">(edit)</a>
													</h4>
												</div>
												<div class="row">';
													
													while($skills_row=mysqli_fetch_array($skills_result))
													{
														
														$html_for_pdf.='<div class="col-md-6 col-xs-6 col-sm-6 col-lg-6">
															<p>'. ucfirst($skills_row['title']); $html_for_pdf.='</p>
														</div>';
														
													}
												
												$html_for_pdf.='</div>
											</div>';
										
										}
									}
									$skills_query="SELECT * FROM resume_skills WHERE creator_id='".$creator_id."' AND type=1 order by type ASC";
									$skills_result=mysqli_query($conn,$skills_query);
									if(mysqli_num_rows($skills_result)>0)
									{
										
										$html_for_pdf.='<div id="professional_skills_draggable" style="width:100%;" draggable>
												<div style="width:100%;background-color:#efefef;cursor: move;" id="professional_skills_draggable_header">
													<h4 style="text-align:center;" id="personal_skills_title">
														PROFESSIONAL SKILLS<a href="'.base_url.'provide-resume-information.php?step=5&reload=force" style="float:right;font-size:14px;">(edit)</a>
													</h4>
												</div>
												<div class="row">';
													
													while($skills_row=mysqli_fetch_array($skills_result))
													{
														
														$html_for_pdf.='<div class="col-md-6 col-xs-6 col-sm-6 col-lg-6">
															<p>'. ucfirst($skills_row['title']); $html_for_pdf.='</p>
														</div>';
														
													}
													
												$html_for_pdf.='</div>
											</div>';
										
									}
									else
									{
										$skills_query="SELECT * FROM users_skills WHERE type=1 AND status=1 AND user_id='$resume_user_id' order by type ASC";
										$skills_result=mysqli_query($conn,$skills_query);
										if(mysqli_num_rows($skills_result)>0)
										{
											
											$html_for_pdf.='<div id="professional_skills_draggable" style="width:100%;" draggable>
												<div style="width:100%;background-color:#efefef;cursor: move;" id="professional_skills_draggable_header">
													<h4 style="text-align:center;" id="personal_skills_title">
														PROFESSIONAL SKILLS<a href="'.base_url.'provide-resume-information.php?step=5&reload=force" style="float:right;font-size:14px;">(edit)</a>
													</h4>
												</div>
												<div class="row">';
													
													while($skills_row=mysqli_fetch_array($skills_result))
													{
														
														$html_for_pdf.='<div class="col-md-6 col-xs-6 col-sm-6 col-lg-6">
															<p>'. ucfirst($skills_row['title']); $html_for_pdf.='</p>
														</div>';
														
													}
													
												$html_for_pdf.='</div>
											</div>';
											
										}
									}
									$skills_query="SELECT * FROM resume_skills WHERE creator_id='".$creator_id."' AND type=3 order by type ASC";
									$skills_result=mysqli_query($conn,$skills_query);
									if(mysqli_num_rows($skills_result)>0)
									{
										$html_for_pdf.='<div id="linguistic_skills_draggable" style="width:100%;" draggable>
											<div style="width:100%;background-color:#efefef;cursor: move;" id="linguistic_skills_draggable_header">
												<h4 style="text-align:center;" id="personal_skills_title">
													LINGUISTIC SKILLS<a href="'.base_url.'provide-resume-information.php?step=5&reload=force" style="float:right;font-size:14px;">(edit)</a>
												</h4>
											</div>
											<div class="row">';
											
												while($skills_row=mysqli_fetch_array($skills_result))
												{
													
													$html_for_pdf.='<div class="col-md-6 col-xs-6 col-sm-6 col-lg-6">
														<p>'. ucfirst($skills_row['title']); $html_for_pdf.='</p>
													</div>';
													
												}
									
											$html_for_pdf.='</div>
										</div>';
									}
									else
									{
										$skills_query="SELECT * FROM users_skills WHERE type=3 AND status=1 AND user_id='$resume_user_id' order by type ASC";
										$skills_result=mysqli_query($conn,$skills_query);
										if(mysqli_num_rows($skills_result)>0)
										{
											
											$html_for_pdf.='<div id="linguistic_skills_draggable" style="width:100%;" draggable>
												<div style="width:100%;background-color:#efefef;cursor: move;" id="linguistic_skills_draggable_header">
													<h4 style="text-align:center;" id="personal_skills_title">
														LINGUISTIC SKILLS<a href="'.base_url.'provide-resume-information.php?step=5&reload=force" style="float:right;font-size:14px;">(edit)</a>
													</h4>
												</div>
												<div class="row">';
												
													while($skills_row=mysqli_fetch_array($skills_result))
													{
														
														$html_for_pdf.='<div class="col-md-6 col-xs-6 col-sm-6 col-lg-6">
															<p>'. ucfirst($skills_row['title']); $html_for_pdf.='</p>
														</div>';
														
													}
										
												$html_for_pdf.='</div>
											</div>';
										
										}
									}
									$experience_query="SELECT * FROM resume_education WHERE creator_id='$creator_id' ORDER BY from_year DESC";
									$experience_result=mysqli_query($conn,$experience_query);
									if(mysqli_num_rows($experience_result)>0)
									{
										
										$html_for_pdf.='<div id="education_draggable" style="width:100%;" draggable>
											<div class="row">
												<div class="col-md-12">
													<div style="width:100%;background-color:#efefef;cursor: move;" id="experience_draggable_header">
														<h4 style="text-align:center;" id="experience_1">
															ACADEMICS <a href="'.base_url.'provide-resume-information.php?step=4&reload=force" style="float:right;font-size:14px;">(edit)</a>
														</h4>
													</div>
												</div>
											</div>';
										
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
												
												$html_for_pdf.='<div class="row draggable" id="education_'. $experience_row['id']; $html_for_pdf.='">
													<div class="col-md-12">
														<div style="width:100%;background-color:#efefef;cursor: move;" id="education_draggable_header">
															<h5 style="text-align:center;" id="experience_1">
																'. ucfirst(strtolower($experience_row['course'])).' at '. ucfirst(strtolower($experience_row['university'])); 
															$html_for_pdf.='</h5>
														</div>
														<div style="width:100%;">
															<h6>
																 
																	'. $experience_row['university'];
																
															$html_for_pdf.='</h6>
															<h6>'. $experience_row['course'].' <span class="pull-right">'. print_month($experience_row['from_month'])." ".$experience_row['from_year'].' - '; if($experience_row['studying']=="1"){$html_for_pdf.="Present"; } else {$html_for_pdf.=print_month($experience_row['to_month'])." ".$experience_row['to_year']; } $html_for_pdf.='</span></h6>
															<p>
																'. @htmlspecialchars_decode($experience_row['description']).' 
															</p>
														</div>
													</div>
												</div>';
												
											}
										}
										
									$html_for_pdf.='</div>';
										
									}
									else
									{
										$experience_query="SELECT * FROM users_education WHERE user_id='$resume_user_id' AND status=1 ORDER BY from_year DESC";
										$experience_result=mysqli_query($conn,$experience_query);
										if(mysqli_num_rows($experience_result)>0)
										{
											
											$html_for_pdf.='<div id="education_draggable" style="width:100%;" draggable>
												<div class="row">
													<div class="col-md-12">
														<div style="width:100%;background-color:#efefef;cursor: move;" id="experience_draggable_header">
															<h4 style="text-align:center;" id="experience_1">
																ACADEMICS <a href="'.base_url.'provide-resume-information.php?step=4&reload=force" style="float:right;font-size:14px;">(edit)</a>
															</h4>
														</div>
													</div>
												</div>';
											
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
													
													$html_for_pdf.='<div class="row draggable" id="education_'. $experience_row['id']; $html_for_pdf.='">
														<div class="col-md-12">
															<div style="width:100%;background-color:#efefef;cursor: move;" id="education_draggable_header">
																<h5 style="text-align:center;" id="experience_1">
																	'. ucfirst(strtolower($experience_row['title'])).' at '. ucfirst(strtolower($experience_row['university'])); 
																$html_for_pdf.='</h5>
															</div>
															<div style="width:100%;">
																<h6>
																	 
																		'. $experience_row['university'];
																		if(!!$city_row['title'])
																		{
																			$html_for_pdf.=", ".$city_row['title'];
																		}
																		if(!!$country_row['title'])
																		{
																			$html_for_pdf.=", ".$country_row['title'];
																		}
																	
																$html_for_pdf.='</h6>
																<h6>'. $experience_row['title'].' <span class="pull-right">'. print_month($experience_row['from_month'])." ".$experience_row['from_year'].' - '; if($experience_row['studying']=="1"){$html_for_pdf.="Present"; } else {$html_for_pdf.=print_month($experience_row['to_month'])." ".$experience_row['to_year']; } $html_for_pdf.='</span></h6>
																<p>
																	'. @strip_tags($experience_row['description']).' 
																</p>
															</div>
														</div>
													</div>';
													
												}
											}
											
										$html_for_pdf.='</div>';
									
										}
									}
									$skills_query="SELECT * FROM resume_certifications WHERE creator_id='$creator_id' order by title";
									$skills_result=mysqli_query($conn,$skills_query);
									if(mysqli_num_rows($skills_result)>0)
									{
										
										$html_for_pdf.='<div id="achievements_draggable" style="width:100%;" draggable>
												<div style="width:100%;background-color:#efefef;cursor: move;" id="achievements_draggable_header">
													<h4 style="text-align:center;" id="personal_skills_title">
														ACHIEVEMENTS<a href="'.base_url.'provide-resume-information.php?step=7&reload=force" style="float:right;font-size:14px;">(edit)</a>
													</h4>
												</div>
												<div class="row">';
													
													$i=1;
													while($skills_row=mysqli_fetch_array($skills_result))
													{
														
														$html_for_pdf.='<div class="col-md-6 col-xs-6 col-sm-6 col-lg-6" style="margin-bottom:10px;">
															<h6>'. $i++.'. &nbsp;'.ucfirst($skills_row['title']).' </h6>
															<p class="text-justify">
																'. ucfirst(strip_tags($skills_row['description'])).' 
															</p>
														</div>';
														
													}
													
												$html_for_pdf.='</div>
											</div>';
									}
									else
									{
										$skills_query="SELECT * FROM users_awards WHERE status=1 AND user_id='$resume_user_id' order by added DESC";
										$skills_result=mysqli_query($conn,$skills_query);
										if(mysqli_num_rows($skills_result)>0)
										{
											
											$html_for_pdf.='<div id="achievements_draggable" style="width:100%;" draggable>
												<div style="width:100%;background-color:#efefef;cursor: move;" id="achievements_draggable_header">
													<h4 style="text-align:center;" id="personal_skills_title">
														ACHIEVEMENTS<a href="'.base_url.'provide-resume-information.php?step=7&reload=force" style="float:right;font-size:14px;">(edit)</a>
													</h4>
												</div>
												<div class="row">';
													
													$i=1;
													while($skills_row=mysqli_fetch_array($skills_result))
													{
														
														$html_for_pdf.='<div class="col-md-6 col-xs-6 col-sm-6 col-lg-6" style="margin-bottom:10px;">
															<h6>'. $i++.'. &nbsp;'.ucfirst($skills_row['title']).' </h6>
															<p class="text-justify">
																'. ucfirst(strip_tags($skills_row['description'])).' 
															</p>
														</div>';
														
													}
													
												$html_for_pdf.='</div>
											</div>';
											
										}
									}
									$skills_query="SELECT * FROM resume_interests WHERE creator_id='$creator_id' order by title";
									$skills_result=mysqli_query($conn,$skills_query);
									if(mysqli_num_rows($skills_result)>0)
									{
										
										$html_for_pdf.='<div id="interests_draggable" style="width:100%;" draggable>
												<div style="width:100%;background-color:#efefef;cursor: move;" id="achievements_draggable_header">
													<h4 style="text-align:center;" id="personal_skills_title">
														INTERESTS<a href="'.base_url.'provide-resume-information.php?step=6&reload=force" style="float:right;font-size:14px;">(edit)</a>
													</h4>
												</div>
												<div class="row">';
													
													while($skills_row=mysqli_fetch_array($skills_result))
													{
														
														$html_for_pdf.='<div class="col-md-6 col-xs-6 col-sm-6 col-lg-6">
															<p>'. ucfirst($skills_row['title']).' </p>
														</div>';
														
													}
													
												$html_for_pdf.='</div>
											</div>';
									}
									else
									{
										$skills_query="SELECT * FROM users_interests WHERE status=1 AND user_id='$resume_user_id' order by added DESC";
										$skills_result=mysqli_query($conn,$skills_query);
										if(mysqli_num_rows($skills_result)>0)
										{
											
											$html_for_pdf.='<div id="interests_draggable" style="width:100%;" draggable>
												<div style="width:100%;background-color:#efefef;cursor: move;" id="achievements_draggable_header">
													<h4 style="text-align:center;" id="personal_skills_title">
														INTERESTS<a href="'.base_url.'provide-resume-information.php?step=6&reload=force" style="float:right;font-size:14px;">(edit)</a>
													</h4>
												</div>
												<div class="row">';
													
													while($skills_row=mysqli_fetch_array($skills_result))
													{
														
														$html_for_pdf.='<div class="col-md-6 col-xs-6 col-sm-6 col-lg-6">
															<p>'. ucfirst($skills_row['title']).' </p>
														</div>';
														
													}
													
												$html_for_pdf.='</div>
											</div>';
											
										}
									}
									if($creator_id && isset($creator_row['additional_description']) && $creator_row['additional_description']!="")
									{
										
										$html_for_pdf.='<div style="width:100%;">
												<div style="width:100%;background-color:#efefef;" id="">
													<h4 style="text-align:center;" id="personal_skills_title">
															Additional Details<a href="'.base_url.'provide-resume-information.php?step=8&reload=force" style="float:right;font-size:14px;">(edit)</a>
														</h4>
												</div>
												<div class="row">
													<p style="font-size:14px;">'. htmlspecialchars_decode($creator_row['additional_description']).'</p></article>
												</div>
											</div>';
										
									}
									if($creator_id && isset($creator_row['include_references']) && $creator_row['include_references']=="1")
									{
										$html_for_pdf.='<div style="width:100%;">
												<div style="width:100%;background-color:#efefef;" id="">
													<h4 style="text-align:center;" id="personal_skills_title">
															References<a href="'.base_url.'provide-resume-information.php?step=8&reload=force" style="float:right;font-size:14px;">(edit)</a>
														</h4>
												</div>
												<div class="row">
													<p style="font-size:14px;">References are available upon request.</p></article>
												</div>
											</div>';							
									}
								
							$html_for_pdf.='</div>
						</div>
						<div class="col-md-2"></div>
					</div>
				</body>
				<div class="modal fade amazing_contact_backdrop_modal" id="amazing_contact_backdrop_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="amazingContactBackdrop" aria-hidden="true">
						<div class="modal-dialog modal-md" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h6 class="modal-title" id="amazingContactBackdrop">Send InMail</h6>
								</div>
								<div class="modal-body">											
									<div class="p-2 d-flex" style="color:red;" id="contact_err"></div>
									<form id="user_contact_form" method="post" enctype="multipart/form-data">
										<div class="row">
											<div class="col-md-12">
												<h6>Email</h6>
												<input type="text" name="email" id="semail" class="form-control">
											</div>
											<div class="col-md-12">
												<h6>Subject</h6>
												<input type="text" name="subject" id="subject" class="form-control">
											</div>
											<div class="col-md-12">
												<h6>Message</h6>
												<textarea style="resize:none;" name="text_message" id="text_message" rows="3" class="form-control"></textarea>
											</div>
										</div>
									</form>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<button type="button" class="btn btn-primary" onclick="sendInMail();">Send</button>
								</div>
							</div>
						</div>
					</div>
				<script>
					$(".row_position").sortable({
						delay: 150,
						stop: function() {
						}
					});
					var base_url=localStorage.getItem("base_url");					
				</script>
			</html>';
			
			$profile_url=base_url.'u/'.$user_row['username'];
			return array('profile_url'=>$profile_url,'html'=>$html_for_pdf);
		}
		else
		{
			return false;
		}
	}
	$userToken=$_COOKIE['uid'];
	if(isset($_REQUEST['userToken']) && $_REQUEST['userToken']!="")
	{
		$userToken=$_REQUEST['userToken'];
	}
	$html_for_pdf_arr=get_user_resume($userToken);
	if($html_for_pdf_arr)
	{
		echo $html_for_pdf_arr['html'];
	}
?>
<script>
	function PrintDiv(divContents) 
	{  
		var printWindow = window.open('','','height=200,width=400');  
		printWindow.document.write('<html><head><title>Print DIV Content</title>');  
		printWindow.document.write('</head><body >');  
		printWindow.document.write(divContents);  
		printWindow.document.write('</body></html>');  
		printWindow.document.close();  
		printWindow.print();  
	}  
	function PrintResume(){
		$.ajax({
			url:'<?php echo base_url; ?>ambiguity/3/create-pdf',
			data:{},
			type:'post',
			success:function(res)
			{
				if(res=="error")
				{
					alert('provide information first.');
				}
				else{
					PrintDiv(res);
				}
			}
		});
	}
	function DownloadResume(){
		$.ajax({
			url:'<?php echo base_url; ?>ambiguity/3/get-pdf',
			data:{},
			type:'post',
			success:function(res)
			{
				/*if(res=="error")
				{
					alert('provide information first.');
				}
				else
				{
					var downloader=document.createElement("a");
					downloader.setAttribute('href',res);
					downloader.setAttribute('download','download');
					document.body.appendChild(downloader);
					downloader.trigger('click');
					document.body.removeChild(downloader);
				}*/
			}
		});
	}
	function ShareResume()
	{
		$("#amazing_contact_backdrop_modal").modal("show");
	}
	function sendInMail()
	{
		var email=$("#semail").val();
		var subject=$("#subject").val();
		var text_message=$("#text_message").val();
		if(email!="" && subject!="")
		{
			$.ajax({
				url:'<?php echo base_url; ?>ambiguity/3/create-pdf',
				data:{},
				type:'post',
				success:function(result)
				{
					$.ajax({
						url:'<?php echo base_url; ?>libraries/swiftmailer/send-users-resume-to-an-email',
						data:{email:email,subject:subject,text_message:text_message},
						type:'post',
						success:function(res)
						{
							var parsedJson=JSON.parse(res);
							if(parsedJson.status=="success")
							{
								//alert('Email has been sent successfully.');
								$("#amazing_contact_backdrop_modal").modal("hide");
								$("#semail").val('');
								$("#subject").val('');
								$("#text_message").val('');
							}
							else
							{
								alert('Unable to send email.');
								$("#amazing_contact_backdrop_modal").modal("hide");
								$("#semail").val('');
								$("#subject").val('');
								$("#text_message").val('');
							}
						}
					});
				}
			});
		}
	}
</script>