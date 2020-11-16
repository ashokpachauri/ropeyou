<?php
	require_once __DIR__ . '/../../libraries/vendor/autoload.php';
	$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P','autoPageBreak '=>false]);
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
					<style media="print">
						#headshot {
							max-width: 12.5% !important;
							float: left !important;
							margin-right: 30px !important;
							vertical-align: baseline !important;
						}
						div{
							display:block !important;
						}
						#name {
							max-width:47.5% !important;
							float: left !important;
							vertical-align: baseline !important;
						}
						#contactDetails {
							max-width:40% !important;
							float: right !important;
							vertical-align: baseline !important;
						}
						.keySkills>li{
							margin:5px !important;
							padding:2px !important;
						}
						.keySkills{
							list-style-type: disc !important;
							display:list-item !important;
						}
						#cv{
							width:100% !important;
						}
						body,html{
							background: #ededed !important;
						}
						.sectionTitle{
							float: left !important;
							width: 28.5% !important;
						}
						.sectionContent{
							float: right !important;
							width: 70.5% !important;
						}
						h1{
							font-size:18px !important;
						}
						article{
							display:inline-block !important;
						}
						.sectionTitle h1{
							font-size:16px !important;
						}
					</style>
				</head>
				<body id="top">
					<div id="cv" class="instaFade">
						<div class="mainDetails">
							<div id="headshot" class="quickFade">
								<img src="'. $profile_image.'" alt="'.$_WEB_AUTHOR.'" />
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
								<div style="width:100%;margin-top:10px;padding:5px;"></div>
							</div>
							<div class="clear"></div>
						</div>
						
						<div id="mainArea" class="quickFade delayFive">';
								if($creator_row['about']!="")
								{
									$html_for_pdf.='<section>
									<article>
										<div class="sectionTitle">
											<h1>About</h1>
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
										<h1>About</h1>
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
												<h1>Skills</h1>
											</div>
											<div class="sectionContent">
												<div style="width:100%">';
													
														while($skills_row=mysqli_fetch_array($skills_result))
														{
															
															$html_for_pdf.='<div style="width:33%;margin-bottom:10px;float:left;">'. ucfirst($skills_row['title']).'</div>';												
															
														}
													
												$html_for_pdf.='</div>
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
												<h1>Skills</h1>
											</div>
											<div class="sectionContent">
												<div style="width:100%">';
													
														while($skills_row=mysqli_fetch_array($skills_result))
														{
															
															$html_for_pdf.='<div style="width:33%;margin-bottom:10px;float:left;">'. ucfirst($skills_row['title']).'</div>';												
															
														}
													
												$html_for_pdf.='</div>
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
											<h1>Experience(s)</h1>
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
												<h1>Experience(s)</h1>
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
											<h1>Acheivements</h1>
										</div>
										<div class="sectionContent">
											<div style="width:100%">';
												
													while($skills_row=mysqli_fetch_array($skills_result))
													{
														
														$html_for_pdf.='<div style="width:33%;margin-bottom:10px;float:left;">'. ucfirst($skills_row['title']).'</div>';													
														
													}
												
											$html_for_pdf.='</div>
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
												<h1>Acheivements</h1>
											</div>
											<div class="sectionContent">
												<div style="width:100%">';
													
														while($skills_row=mysqli_fetch_array($skills_result))
														{
															
															$html_for_pdf.='<div style="width:33%;margin-bottom:10px;float:left;">'. ucfirst($skills_row['title']).'</div>';													
															
														}
													
												$html_for_pdf.='</div>
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
											<h1>Interests</h1>
										</div>
										<div class="sectionContent">
											<div style="width:100%">';
												
													while($skills_row=mysqli_fetch_array($skills_result))
													{
														
														$html_for_pdf.='<div style="width:33%;margin-bottom:10px;float:left;">'. ucfirst($skills_row['title']).'</div>';													
														
													}
												
											$html_for_pdf.='</div>
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
												<h1>Interests</h1>
											</div>
											<div class="sectionContent">
												<div style="width:100%">';
													
														while($skills_row=mysqli_fetch_array($skills_result))
														{
															
															$html_for_pdf.='<div style="width:33%;margin-bottom:10px;float:left;">'. ucfirst($skills_row['title']).'</div>';													
															
														}
													
												$html_for_pdf.='</div>
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
											<h1>Academics</h1>
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
												<h1>Academics</h1>
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
												<h1>More about me</h1>
											</div><div class="sectionContent"><article>
											<p> '. htmlspecialchars_decode($creator_row['additional_description']).' </p></article>
										</div><div class="clear"></div>
									</section>';
									
								}
								if($creator_id && isset($creator_row['include_references']) && $creator_row['include_references']=="1")
								{
									
									$html_for_pdf.='<section>
											<div class="sectionTitle">
												<h1>References</h1>
											</div><div class="sectionContent">
											<article>
											<p style="font-size:14px;">References are available upon request.</p></article>
										</div><div class="clear"></div>
									</section>';
									
								}
								$html_for_pdf.='<section>
										<article>
										<div style="padding:5px;margin:0px;width:100% !important;border:1px solid gray;background-color:#1d2f38 !important;">
											<p style="text-align:center;font-size:20px;margin-top:-25px !important;padding:5px !important;font-style: italic;color:#fff !important;vertical-align:center;">This resume has been created by <a href="'.base_url.'" ><img src="'.base_url.'img/logo.png" style="align:center;height:20px;" /></a></p>
										</div>
										</article><div class="clear"></div>
									</section>';
						$html_for_pdf.='</div>
					</div>
					
				</body>
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
		$mpdf->SetHTMLHeader('<div style="width:100%;">
			<h5 style="text-align:right;width:100%;font-size:15px;">{PAGENO}</h5>
		</table>');
		//echo $html_for_pdf;
		$stylesheet1 = file_get_contents('style.css');
		$mpdf->WriteHTML($stylesheet1,\Mpdf\HTMLParserMode::HEADER_CSS);
		$stylesheet2 = file_get_contents('http://fonts.googleapis.com/css?family=Rokkitt:400,700|Lato:400,300');
		$mpdf->WriteHTML($stylesheet2,\Mpdf\HTMLParserMode::HEADER_CSS);
		$stylesheet3 = file_get_contents('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
		$mpdf->WriteHTML($stylesheet3,\Mpdf\HTMLParserMode::HEADER_CSS);
		$mpdf->WriteHTML($html_for_pdf_arr['html']);
		$file_name='../../user-data/ru-resume-'.$userToken.'.pdf';
		@unlink($file_name);
		$mpdf->Output($file_name,'F');
	}
	else
	{
		
	}
	echo "executed";
?>