<?php
	function get_user_resume($resume_user_id,$resume_id="")
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
			
			$html_for_pdf='<!DOCTYPE html>
			<html>
				<head>
					<title>'.$_WEB_AUTHOR.'  :: Resume By RopeYou</title>

					<meta name="viewport" content="width=device-width"/>
					<meta name="description" content="The Curriculum Vitae of Joe Bloggs."/>
					<meta charset="UTF-8"> 

					<link type="text/css" rel="stylesheet" href="style.css">
					<link href="https://fonts.googleapis.com/css?family=Rokkitt:400,700|Lato:400,300" rel="stylesheet" type="text/css">
					<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
					<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" type="text/css">
					<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
					<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
					<style>
						.keySkills>li{
							margin:5px;
						}
						#cv{
							width:100% !important;
						}
					</style>
				</head>
				<body id="top">
					<div id="cv" class="instaFade">
						<div style="width:100%;padding:10px;">';
						if($creator_id)
						{
								$html_for_pdf.='<a href="javascript:void(0);" style="font-size:25px;float:left;border:1px solid gray;padding:3px;margin-right:20px;text-decoration:none;color:red;" onclick="ShareResume();" title="Share using email"><i class="fa fa-envelope"></i></a>';
								$html_for_pdf.='<a href="'.base_url.'ambiguity/'.$creator_row['resume_id'].'/get-pdf" target="_blank" style="font-size:25px;float:right;border:1px solid gray;padding:3px;margin-right:20px;" title="Download Resume"><i class="fa fa-download"></i></a>';
						}
						$html_for_pdf.='</div>
						<div class="mainDetails" style="margin-top:30px;">
							<div id="headshot" class="quickFade">
								<img src="'. $profile_image.' " alt="'.$_WEB_AUTHOR.'" />
							</div>
							
							<div id="name" style="max-width:45%;">
								<h2 class="quickFade delayTwo">'.$_WEB_AUTHOR.' </h2>
								<p class="quickFade delayThree">';
								if(isset($creator_row) && $creator_row['first_name']!="") { $html_for_pdf.=  $creator_row['profile_title']; } else { $html_for_pdf.= $user_row['profile_title']; }								
								$html_for_pdf.='</p>
								<h5 class="quickFade delayThree"><a href="'. base_url.'u/'. $user_row['username'].'">'.base_url.'u/'. $user_row['username'].' </a></h5>
							</div>
							
							<div id="contactDetails" class="quickFade delayFour">
								<ul>';
									
										$communication_email=$user_row['email'];
										if($user_personal_row['communication_email']!="")
										{
											$communication_email=$user_personal_row['communication_email'];
										}
										$communication_mobile=$user_row['mobile'];
										if($user_personal_row['communication_mobile']!="")
										{
											$communication_mobile=$user_personal_row['phonecode'].''.$user_personal_row['communication_mobile'];
										}
										if($communication_email!="")
										{
											
											$html_for_pdf.='<li>e: '. $communication_email.'</li>';
											
										}
										if($communication_mobile!="")
										{
											
												$html_for_pdf.='<li>m: '. $communication_mobile.'</li>';
											
										}
										if($website!="")
										{
											
												$html_for_pdf.='<li>w: '. $website.'</li>';
											
										}
									
								$html_for_pdf.='</ul>
								<div style="width:100%;margin-top:10px;padding:5px;"><a href="'.base_url.'provide-resume-information.php?step=1&reload=force" style="float:right;font-size:14px;">(edit)</a></div>
							</div>
							<div class="clear"></div>
						</div>
						
						<div id="mainArea" class="quickFade delayFive">';
								if($creator_row['about']!="")
								{
									$html_for_pdf.='<section>
									<article>
										<div class="sectionTitle">
											<h1>About<a href="'.base_url.'provide-resume-information.php?step=2&reload=force" style="float:right;font-size:14px;">(edit)</a></h1>
										</div>
										
										<div class="sectionContent">
											<p style="font-size:14px;">'. stripslashes(html_entity_decode($creator_row['about']));
												
											$html_for_pdf.='</p>
										</div>
									</article>
									<div class="clear"></div>
								</section>';
									
								}
								else if($user_personal_row['about']!="")
								{
							
							$html_for_pdf.='<section>
								<article>
									<div class="sectionTitle">
										<h1>About<a href="'.base_url.'provide-resume-information.php?step=2&reload=force" style="float:right;font-size:14px;">(edit)</a></h1>
									</div>
									
									<div class="sectionContent">
										<p style="font-size:14px;">'. stripslashes(html_entity_decode($user_personal_row['about']));
											
										$html_for_pdf.='</p>
									</div>
								</article>
								<div class="clear"></div>
							</section>';
							
								}
								$skills_query="SELECT * FROM resume_skills WHERE creator_id='".$creator_id."' order by type ASC";
								$skills_result=mysqli_query($conn,$skills_query);
								if(mysqli_num_rows($skills_result)>0)
								{
									
									$html_for_pdf.='<section>
											<div class="sectionTitle">
												<h1>Skills<a href="'.base_url.'provide-resume-information.php?step=5&reload=force" style="float:right;font-size:14px;">(edit)</a></h1>
											</div>
											<div class="sectionContent">
												<ul class="keySkills" style="font-size:14px;">';
													
														while($skills_row=mysqli_fetch_array($skills_result))
														{
															
															$html_for_pdf.='<li>'. ucfirst($skills_row['title']); $html_for_pdf.='</li>';												
															
														}
													
												$html_for_pdf.='</ul>
											</div>
											<div class="clear"></div>
										</section>';
									
								}
								else
								{
									$skills_query="SELECT * FROM users_skills WHERE status=1 AND user_id='$resume_user_id' order by type ASC";
									$skills_result=mysqli_query($conn,$skills_query);
									if(mysqli_num_rows($skills_result)>0)
									{
										
										$html_for_pdf.='<section>
											<div class="sectionTitle">
												<h1>Skills<a href="'.base_url.'provide-resume-information.php?step=5&reload=force" style="float:right;font-size:14px;">(edit)</a></h1>
											</div>
											<div class="sectionContent">
												<ul class="keySkills" style="font-size:14px;">';
													
														while($skills_row=mysqli_fetch_array($skills_result))
														{
															
															$html_for_pdf.='<li>'. ucfirst($skills_row['title']); $html_for_pdf.='</li>';												
															
														}
													
												$html_for_pdf.='</ul>
											</div>
											<div class="clear"></div>
										</section>';
										
									}
								}
								$experience_query="SELECT * FROM resume_experiences WHERE creator_id='$creator_id' ORDER BY from_year DESC";
								$experience_result=mysqli_query($conn,$experience_query);
								if(mysqli_num_rows($experience_result)>0)
								{
									
									$html_for_pdf.='<section>
										<div class="sectionTitle">
											<h1>Experience(s)<a href="'.base_url.'provide-resume-information.php?step=3&reload=force" style="float:right;font-size:14px;">(edit)</a></h1>
										</div>
										<div class="sectionContent">';
											
												while($experience_row=mysqli_fetch_array($experience_result))
												{
													$experience_id=$experience_row['id'];
													
													
													$html_for_pdf.='<article>';
														$html_for_pdf.='<h3>'. ucfirst(strtolower($experience_row['designation'])).'  at '. ucfirst(strtolower($experience_row['company'])).' </h3>';
														$html_for_pdf.='<p class="subDetails">'. print_month($experience_row['from_month'])." ".$experience_row['from_year'].'  - '; if($experience_row['working']=="1"){$html_for_pdf.= "Present"; } else {$html_for_pdf.= print_month($experience_row['to_month'])." ".$experience_row['to_year']; } $html_for_pdf.='</p>
														<p style="font-size:14px;">';
															
																if($experience_row['description']==""){
																	$html_for_pdf.= "<b>".ucfirst(strtolower($experience_row['designation']))."</b> at <b>".ucfirst(strtolower($experience_row['company']))."</b> in <b>".ucfirst(strtolower($city_row['title'])).", ".ucfirst(strtolower($country_row['title']))."</b> from <b>".print_month($experience_row['from_month'])." ".$experience_row['from_year']."</b> to <b>";
																	if($experience_row['working']=="1"){$html_for_pdf.= "Present</b>."; } else {$html_for_pdf.= print_month($experience_row['to_month'])." ".$experience_row['to_year']."</b>."; }
																}
																else
																{
																	$html_for_pdf.= ucfirst(strtolower($experience_row['description']));
																}
															
														$html_for_pdf.='</p>
													</article>';
													
												}
											
										$html_for_pdf.='</div>
										<div class="clear"></div>
									</section>';
									
								}
								else
								{
									$experience_query="SELECT * FROM users_work_experience WHERE user_id='$resume_user_id' AND status=1 ORDER BY from_year DESC";
									$experience_result=mysqli_query($conn,$experience_query);
									if(mysqli_num_rows($experience_result)>0)
									{
										
										$html_for_pdf.='<section>
											<div class="sectionTitle">
												<h1>Experience(s)<a href="'.base_url.'provide-resume-information.php?step=3&reload=force" style="float:right;font-size:14px;">(edit)</a></h1>
											</div>
											<div class="sectionContent">';
												
													while($experience_row=mysqli_fetch_array($experience_result))
													{
														$experience_id=$experience_row['id'];
														$country_query="SELECT title FROM country WHERE id='".$experience_row['country']."'";
														$country_result=mysqli_query($conn,$country_query);
														$country_row=mysqli_fetch_array($country_result);
														
														$city_query="SELECT title FROM city WHERE id='".$experience_row['city']."'";
														$city_result=mysqli_query($conn,$city_query);
														$city_row=mysqli_fetch_array($city_result);
														
														$html_for_pdf.='<article>';
															$html_for_pdf.='<h3>'. ucfirst(strtolower($experience_row['title'])).'  at '. ucfirst(strtolower($experience_row['company'])).' </h3>';
															$html_for_pdf.='<p class="subDetails">'. print_month($experience_row['from_month'])." ".$experience_row['from_year'].'  - '; if($experience_row['working']=="1"){$html_for_pdf.= "Present"; } else {$html_for_pdf.= print_month($experience_row['to_month'])." ".$experience_row['to_year']; } $html_for_pdf.='</p>
															<p style="font-size:14px;">';
																
																	if($experience_row['description']==""){
																		$html_for_pdf.= "<b>".ucfirst(strtolower($experience_row['title']))."</b> at <b>".ucfirst(strtolower($experience_row['company']))."</b> in <b>".ucfirst(strtolower($city_row['title'])).", ".ucfirst(strtolower($country_row['title']))."</b> from <b>".print_month($experience_row['from_month'])." ".$experience_row['from_year']."</b> to <b>";
																		if($experience_row['working']=="1"){$html_for_pdf.= "Present</b>."; } else {$html_for_pdf.= print_month($experience_row['to_month'])." ".$experience_row['to_year']."</b>."; }
																	}
																	else
																	{
																		$html_for_pdf.= ucfirst(strtolower($experience_row['description']));
																	}
																
															$html_for_pdf.='</p>
														</article>';
														
													}
												
											$html_for_pdf.='</div>
											<div class="clear"></div>
										</section>';
									}
								}
								$skills_query="SELECT * FROM resume_certifications WHERE creator_id='$creator_id' order by title";
								$skills_result=mysqli_query($conn,$skills_query);
								if(mysqli_num_rows($skills_result)>0)
								{
									
									$html_for_pdf.='<section>
										<div class="sectionTitle">
											<h1>Acheivements<a href="'.base_url.'provide-resume-information.php?step=7&reload=force" style="float:right;font-size:14px;">(edit)</a></h1>
										</div>
										<div class="sectionContent">
											<ul class="keySkills" style="font-size:14px;">';
												
													while($skills_row=mysqli_fetch_array($skills_result))
													{
														
														$html_for_pdf.='<li>'. ucfirst($skills_row['title']).'</li>';													
														
													}
												
											$html_for_pdf.='</ul>
										</div>
										<div class="clear"></div>
									</section>';
								}
								else
								{
									$skills_query="SELECT * FROM users_awards WHERE status=1 AND user_id='$resume_user_id' order by added DESC";
									$skills_result=mysqli_query($conn,$skills_query);
									if(mysqli_num_rows($skills_result)>0)
									{
										
										$html_for_pdf.='<section>
											<div class="sectionTitle">
												<h1>Acheivements<a href="'.base_url.'provide-resume-information.php?step=7&reload=force" style="float:right;font-size:14px;">(edit)</a></h1>
											</div>
											<div class="sectionContent">
												<ul class="keySkills" style="font-size:14px;">';
													
														while($skills_row=mysqli_fetch_array($skills_result))
														{
															
															$html_for_pdf.='<li>'. ucfirst($skills_row['title']).'</li>';													
															
														}
													
												$html_for_pdf.='</ul>
											</div>
											<div class="clear"></div>
										</section>';
										
									}	
								}
								$skills_query="SELECT * FROM resume_interests WHERE creator_id='$creator_id' order by title";
								$skills_result=mysqli_query($conn,$skills_query);
								if(mysqli_num_rows($skills_result)>0)
								{
									
									$html_for_pdf.='<section>
										<div class="sectionTitle">
											<h1>Interests<a href="'.base_url.'provide-resume-information.php?step=6&reload=force" style="float:right;font-size:14px;">(edit)</a></h1>
										</div>
										<div class="sectionContent">
											<ul class="keySkills" style="font-size:14px;">';
												
													while($skills_row=mysqli_fetch_array($skills_result))
													{
														
														$html_for_pdf.='<li>'. ucfirst($skills_row['title']).'</li>	';													
														
													}
												
											$html_for_pdf.='</ul>
										</div>
										<div class="clear"></div>
									</section>';
								}
								else
								{
									$skills_query="SELECT * FROM users_interests WHERE user_id='$resume_user_id' order by id DESC";
									$skills_result=mysqli_query($conn,$skills_query);
									if(mysqli_num_rows($skills_result)>0)
									{
										
										$html_for_pdf.='<section>
											<div class="sectionTitle">
												<h1>Interests<a href="'.base_url.'provide-resume-information.php?step=6&reload=force" style="float:right;font-size:14px;">(edit)</a></h1>
											</div>
											<div class="sectionContent">
												<ul class="keySkills" style="font-size:14px;">';
													
														while($skills_row=mysqli_fetch_array($skills_result))
														{
															
															$html_for_pdf.='<li>'. ucfirst($skills_row['title']).'</li>	';													
															
														}
													
												$html_for_pdf.='</ul>
											</div>
											<div class="clear"></div>
										</section>';
										
									}
								}
								$experience_query="SELECT * FROM resume_education WHERE creator_id='$creator_id' ORDER BY from_year DESC";
								$experience_result=mysqli_query($conn,$experience_query);
								if(mysqli_num_rows($experience_result)>0)
								{
									
									$html_for_pdf.='<section>
										<div class="sectionTitle">
											<h1>Academics<a href="'.base_url.'provide-resume-information.php?step=4&reload=force" style="float:right;font-size:14px;">(edit)</a></h1>
										</div>
										<div class="sectionContent">';
											
												while($experience_row=mysqli_fetch_array($experience_result))
												{
													$experience_id=$experience_row['id'];
													
													$html_for_pdf.='<article>
														<h3>'. ucfirst(strtolower($experience_row['course'])).'  at '. ucfirst(strtolower($experience_row['university'])).' </h3>
														<p class="subDetails">'. print_month($experience_row['from_month'])." ".$experience_row['from_year'].'  - '; if($experience_row['studying']=="1"){ $html_for_pdf.= "Present"; } else { $html_for_pdf.= print_month($experience_row['to_month'])." ".$experience_row['to_year']; } $html_for_pdf.='</p>
														<p style="font-size:14px;">';
															
																if($experience_row['description']==""){
																	$html_for_pdf.= "<b>".ucfirst(strtolower($experience_row['course']))."</b> at <b>".ucfirst(strtolower($experience_row['university']))."</b> in <b>".ucfirst(strtolower($city_row['title'])).", ".ucfirst(strtolower($country_row['title']))."</b> from <b>".print_month($experience_row['from_month'])." ".$experience_row['from_year']."</b> to <b>";
																	if($experience_row['studying']=="1"){ $html_for_pdf.= "Present</b>."; } else { $html_for_pdf.= print_month($experience_row['to_month'])." ".$experience_row['to_year']."</b>."; }
																}
																else
																{
																	$html_for_pdf.= ucfirst(strtolower($experience_row['description']));
																}
															
														$html_for_pdf.='</p>
													</article>';
													
												}
											
										$html_for_pdf.='</div>
										<div class="clear"></div>
									</section>';
									
								}
								else
								{
									$experience_query="SELECT * FROM users_education WHERE user_id='$resume_user_id' AND status=1 ORDER BY from_year DESC";
									$experience_result=mysqli_query($conn,$experience_query);
									if(mysqli_num_rows($experience_result)>0)
									{
										
										$html_for_pdf.='<section>
											<div class="sectionTitle">
												<h1>Academics<a href="'.base_url.'provide-resume-information.php?step=4&reload=force" style="float:right;font-size:14px;">(edit)</a></h1>
											</div>
											<div class="sectionContent">';
												
													while($experience_row=mysqli_fetch_array($experience_result))
													{
														$experience_id=$experience_row['id'];
														$country_query="SELECT title FROM country WHERE id='".$experience_row['country']."'";
														$country_result=mysqli_query($conn,$country_query);
														$country_row=mysqli_fetch_array($country_result);
														
														$city_query="SELECT title FROM city WHERE id='".$experience_row['city']."'";
														$city_result=mysqli_query($conn,$city_query);
														$city_row=mysqli_fetch_array($city_result);
														
														$html_for_pdf.='<article>
															<h3>'. ucfirst(strtolower($experience_row['title'])).'  at '. ucfirst(strtolower($experience_row['university'])).' </h3>
															<p class="subDetails">'. print_month($experience_row['from_month'])." ".$experience_row['from_year'].'  - '; if($experience_row['studying']=="1"){ $html_for_pdf.= "Present"; } else { $html_for_pdf.= print_month($experience_row['to_month'])." ".$experience_row['to_year']; } $html_for_pdf.='</p>
															<p style="font-size:14px;">';
																
																	if($experience_row['description']==""){
																		$html_for_pdf.= "<b>".ucfirst(strtolower($experience_row['title']))."</b> at <b>".ucfirst(strtolower($experience_row['university']))."</b> in <b>".ucfirst(strtolower($city_row['title'])).", ".ucfirst(strtolower($country_row['title']))."</b> from <b>".print_month($experience_row['from_month'])." ".$experience_row['from_year']."</b> to <b>";
																		if($experience_row['studying']=="1"){ $html_for_pdf.= "Present</b>."; } else { $html_for_pdf.= print_month($experience_row['to_month'])." ".$experience_row['to_year']."</b>."; }
																	}
																	else
																	{
																		$html_for_pdf.= ucfirst(strtolower($experience_row['description']));
																	}
																
															$html_for_pdf.='</p>
														</article>';
														
													}
												
											$html_for_pdf.='</div>
											<div class="clear"></div>
										</section>';
										
									}
								}
								if($creator_id && isset($creator_row['additional_description']) && $creator_row['additional_description']!="")
								{
									
									$html_for_pdf.='<section>
											<div class="sectionTitle">
												<h1>More about me<a href="'.base_url.'provide-resume-information.php?step=8&reload=force" style="float:right;font-size:14px;">(edit)</a></h1>
											</div><div class="sectionContent">
											<article>
											<p> '. htmlspecialchars_decode($creator_row['additional_description']).' </p>
											</article>
										</div>
										<div class="clear"></div>
									</section>';
									
								}
								if($creator_id && isset($creator_row['include_references']) && $creator_row['include_references']=="1")
								{
									
									$html_for_pdf.='<section>
											<div class="sectionTitle">
												<h1>References<a href="'.base_url.'provide-resume-information.php?step=8&reload=force" style="float:right;font-size:14px;">(edit)</a></h1>
											</div>
											<div class="sectionContent">
												<article>
												<p style="font-size:14px;">References are available upon request.</p>
												</article>
											</div>
											<div class="clear"></div>
									</section>';
									
								}
								$html_for_pdf.='<section>
										<article>
										<div style="padding:5px;margin:0px;width:100% !important;border:1px solid gray;background-color:#1d2f38 !important;">
											<p style="text-align:center;font-size:20px;padding:5px !important;font-style: italic;color:#fff !important;vertical-align:center;">This resume has been created by <a href="'.base_url.'" ><img src="'.base_url.'img/logo.png" style="align:center;height:20px;" /></a></p>
										</div>
										</article><div class="clear"></div>
									</section>';
						$html_for_pdf.='</div>
					</div>
					
				</body>
			</html><div class="modal fade amazing_contact_backdrop_modal" id="amazing_contact_backdrop_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="amazingContactBackdrop" aria-hidden="true">
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
						</div>';
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
				url:'<?php echo base_url; ?>ambiguity/1/create-pdf',
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
	function PrintDiv(divContents) 
	{  
		var printWindow = window.open('', '', 'height=200,width=400');  
		printWindow.document.write('<html><head><title>Print DIV Content</title>');  
		printWindow.document.write('</head><body >');  
		printWindow.document.write(divContents);  
		printWindow.document.write('</body></html>');  
		printWindow.document.close();  
		printWindow.print();  
	}  
	function PrintResume(){
		$.ajax({
			url:'<?php echo base_url; ?>ambiguity/1/create-pdf',
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
			url:'<?php echo base_url; ?>ambiguity/1/get-pdf',
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
</script>