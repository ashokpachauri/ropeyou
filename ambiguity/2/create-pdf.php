<?php
	require_once __DIR__ . '/../../libraries/vendor/autoload.php';
	$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P','autoPageBreak '=>false]);
	function get_user_resume($resume_user_id,$resume_id="")
	{
		include_once '../../connection.php';
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
			
			$html_for_pdf='
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
					<title>'.$_WEB_AUTHOR.' :: Resume By RopeYou</title>
					
					<style media="print">
						h1{
							width:100% !important;
							font-size:25px;
						}
						h2{
							font-size:20px;
							text-align:left !important;
						}
						#myh2{
							width:100% !important;
							float:left !important;
							text-align:left;
							margin-block-start: 0px !important;
							font-size:15px !important;
							margin-top:-80px !important;
							clear:both;
						}
						.entry{
							padding-top:30px !important;
						}
						.self{
							width:100% !important;
						}
					</style>
				</head>
				<body>
					<div id="wrapper">
						<div class=""></div>
							<div class="">
								<div id="paper">
									<div id="paper-mid">
										<div class="entry">
											<img class="portrait" src="'.$profile_image.'" alt="'.$_WEB_AUTHOR.'" />
											<div class="self">
												<h1 class="name">';
												if(isset($creator_row) && $creator_row['first_name']!="") { $html_for_pdf.=  ucwords($creator_row['first_name']." ".$creator_row['last_name']); } else { $html_for_pdf.= $_WEB_AUTHOR; } $html_for_pdf.='</h1>
												<p id="myh2" style="margin-left:180px;">';
												 if(isset($creator_row) && $creator_row['first_name']!="") { $html_for_pdf.=  $creator_row['profile_title']; } else { $html_for_pdf.= $user_row['profile_title']; } $html_for_pdf.='</p>
												<ul style="margin-top:25px !important;clear:both;margin-left:180px;">';
												$communication_email=$user_row['email'];
														if($user_personal_row['communication_email']!="")
														{
															$communication_email=$user_personal_row['communication_email'];
														}
														$communication_mobile=$user_row['mobile'];
														if($user_personal_row['communication_mobile']!="")
														{
															$communication_mobile=$user_personal_row['phonecode'].' '.$user_personal_row['communication_mobile'];
														}
														if($communication_email!="")
														{
															$html_for_pdf.='
																<li class="mail">';$html_for_pdf.= $communication_email; $html_for_pdf.='</li>';
														}
														if($communication_mobile!="")
														{
																$html_for_pdf.='<li class="tel">';$html_for_pdf.= $communication_mobile; $html_for_pdf.='</li>';
														}
														if($website!="")
														{
															$html_for_pdf.='
																<li class="web">';$html_for_pdf.= $website; $html_for_pdf.='</li>';
															
														}
													$html_for_pdf.='<li class="web">'.base_url.'u/';$html_for_pdf.= $user_row['username']; $html_for_pdf.='</li>';
												$html_for_pdf.='</ul>
											</div>
										</div>';
										if($creator_row['about']!="")
										{
											$html_for_pdf.='
											<div class="entry">
												<h2>About</h2>
												<p style="font-size:14px;text-align:justify;">';
													 
														$html_for_pdf.= htmlspecialchars_decode($creator_row['about']);
													
												$html_for_pdf.='</p>
											</div>';
											
										}
										else if($user_personal_row['about']!="")
										{
											$html_for_pdf.='
											<div class="entry">
												<h2>About</h2>
												<p style="font-size:14px;text-align:justify;">';
													 
														$html_for_pdf.= htmlspecialchars_decode($user_personal_row['about']);
													
												$html_for_pdf.='</p>
											</div>';
											
										}
										$skills_query="SELECT * FROM resume_skills WHERE creator_id='".$creator_id."' order by type ASC";
										$skills_result=mysqli_query($conn,$skills_query);
										if(mysqli_num_rows($skills_result)>0)
										{
											
											$html_for_pdf.='<div class="entry">
											  <h2>Skills</h2>
											  <div class="content">
												<ul class="skills">';
													
														while($skills_row=mysqli_fetch_array($skills_result))
														{
															
															$html_for_pdf.='<li>'.ucwords($skills_row['title']).' </li>';													
															
														}
													
												$html_for_pdf.='</ul>
											</div>';
											
										}
										else
										{
											$skills_query="SELECT * FROM users_skills WHERE user_id='".$resume_user_id."' order by type ASC";
											$skills_result=mysqli_query($conn,$skills_query);
											if(mysqli_num_rows($skills_result)>0)
											{
												
												$html_for_pdf.='<div class="entry">
												  <h2>Skills</h2>
												  <div class="content">
													<ul class="skills">';
														
															while($skills_row=mysqli_fetch_array($skills_result))
															{
																
																$html_for_pdf.='<li> '. ucwords($skills_row['title']).' </li>';											
																
															}
														
													$html_for_pdf.='</ul>
												</div>';
												
											}
										}
										$experience_query="SELECT * FROM resume_experiences WHERE creator_id='$creator_id' ORDER BY from_year DESC";
										$experience_result=mysqli_query($conn,$experience_query);
										if(mysqli_num_rows($experience_result)>0)
										{
											
											$html_for_pdf.='<div class="entry">
												<h2>Experiences</h2>';
												
													while($experience_row=mysqli_fetch_array($experience_result))
													{
														$experience_id=$experience_row['id'];
														$country_query="SELECT title FROM country WHERE id='".$experience_row['country']."'";
														$country_result=mysqli_query($conn,$country_query);
														$country_row=mysqli_fetch_array($country_result);
														
														$city_query="SELECT title FROM city WHERE id='".$experience_row['city']."'";
														$city_result=mysqli_query($conn,$city_query);
														$city_row=mysqli_fetch_array($city_result);
														
														$html_for_pdf.='<div class="content">
															<h3> '. print_month($experience_row['from_month']).' '.$experience_row['from_year'];  $html_for_pdf.='-';  if($experience_row['working']=="1"){ $html_for_pdf.="Present"; } else { $html_for_pdf.=print_month($experience_row['to_month'])." ".$experience_row['to_year']; } $html_for_pdf.='</h3>
															<p> '. ucfirst(strtolower($experience_row['company'])).' ,  '. ucfirst(strtolower($country_row['title'])).'  <br />
															<em> '. ucfirst(strtolower($experience_row['title'])).' </em></p>
															<ul class="info">
															  <li>';
																	if($experience_row['description']==""){
																		$html_for_pdf.="<b>".ucfirst(strtolower($experience_row['title']))."</b> at <b>".ucfirst(strtolower($experience_row['company']))."</b> in <b>".ucfirst(strtolower($city_row['title'])).", ".ucfirst(strtolower($country_row['title']))."</b> from <b>".print_month($experience_row['from_month'])." ".$experience_row['from_year']."</b> to <b>";
																		if($experience_row['working']=="1"){ $html_for_pdf.="Present</b>."; } else { $html_for_pdf.=print_month($experience_row['to_month'])." ".$experience_row['to_year']."</b>."; }
																	}
																	else
																	{
																		$html_for_pdf.=ucfirst(strtolower($experience_row['description']));
																	}
																$html_for_pdf.='</li>
															</ul>
														</div>';
														
													}
												
											$html_for_pdf.='</div>';
											
										}
										else
										{
											$experience_query="SELECT * FROM users_work_experience WHERE user_id='$resume_user_id' ORDER BY from_year DESC";
											$experience_result=mysqli_query($conn,$experience_query);
											if(mysqli_num_rows($experience_result)>0)
											{
												
												$html_for_pdf.='<div class="entry">
													<h2>Experiences</h2>';
													
														while($experience_row=mysqli_fetch_array($experience_result))
														{
															$experience_id=$experience_row['id'];
															$country_query="SELECT title FROM country WHERE id='".$experience_row['country']."'";
															$country_result=mysqli_query($conn,$country_query);
															$country_row=mysqli_fetch_array($country_result);
															
															$city_query="SELECT title FROM city WHERE id='".$experience_row['city']."'";
															$city_result=mysqli_query($conn,$city_query);
															$city_row=mysqli_fetch_array($city_result);
															
															$html_for_pdf.='<div class="content">
																<h3> '. print_month($experience_row['from_month'])." ".$experience_row['from_year'].'  - '; if($experience_row['working']=="1"){ $html_for_pdf.="Present"; } else { $html_for_pdf.=print_month($experience_row['to_month'])." ".$experience_row['to_year']; } $html_for_pdf.='</h3>
																<p> '. ucfirst(strtolower($experience_row['company'])).' ,  '. ucfirst(strtolower($country_row['title']));  $html_for_pdf.='<br />
																<em> '. ucfirst(strtolower($experience_row['title'])).' </em></p>
																<ul class="info">
																  <li>';
																		if($experience_row['description']==""){
																			$html_for_pdf.= "<b>".ucfirst(strtolower($experience_row['title']))."</b> at <b>".ucfirst(strtolower($experience_row['company']))."</b> in <b>".ucfirst(strtolower($city_row['title'])).", ".ucfirst(strtolower($country_row['title']))."</b> from <b>".print_month($experience_row['from_month'])." ".$experience_row['from_year']."</b> to <b>";
																			if($experience_row['working']=="1"){ $html_for_pdf.= "Present</b>."; } else { $html_for_pdf.= print_month($experience_row['to_month'])." ".$experience_row['to_year']."</b>."; }
																		}
																		else
																		{
																			$html_for_pdf.= ucfirst(strtolower($experience_row['description']));
																		}
																	$html_for_pdf.='</li>
																</ul>
															</div>';
															
														}
													
												$html_for_pdf.='</div>';
												
											}
										}
										$skills_query="SELECT * FROM resume_certifications WHERE creator_id='$creator_id' order by title";
										$skills_result=mysqli_query($conn,$skills_query);
										if(mysqli_num_rows($skills_result)>0)
										{
											
											$html_for_pdf.='<div class="entry">
											  <h2>Acheivements</h2>
											  <div class="content">
												<ul class="skills">';
													
														while($skills_row=mysqli_fetch_array($skills_result))
														{
															
															$html_for_pdf.='<li> '. ucwords($skills_row['title']).' </li>';												
															
														}
													
												$html_for_pdf.='</ul>
											</div>';
											
										}
										else
										{
											$skills_query="SELECT * FROM users_awards WHERE status=1 AND user_id='$resume_user_id' order by title";
											$skills_result=mysqli_query($conn,$skills_query);
											if(mysqli_num_rows($skills_result)>0)
											{
												
												$html_for_pdf.='<div class="entry">
												  <h2>Acheivements</h2>
												  <div class="content">
													<ul class="skills">';
														
															while($skills_row=mysqli_fetch_array($skills_result))
															{
																
																$html_for_pdf.='<li> '. ucwords($skills_row['title']).' </li>';														
																
															}
														
													$html_for_pdf.='</ul>
												</div>';
												
											}
										}
										$skills_query="SELECT * FROM resume_interests WHERE creator_id='$creator_id' order by title";
										$skills_result=mysqli_query($conn,$skills_query);
										if(mysqli_num_rows($skills_result)>0)
										{
											
											$html_for_pdf.='<div class="entry">
											  <h2>Interests</h2>
											  <div class="content">
												<ul class="skills">';
													
														while($skills_row=mysqli_fetch_array($skills_result))
														{
															
															$html_for_pdf.='<li> '. ucwords($skills_row['title']).' </li>	';													
															
														}
													
												$html_for_pdf.='</ul>
											</div>';
											
										}
										else
										{
											$skills_query="SELECT * FROM users_interests WHERE user_id='$resume_user_id' order by title";
											$skills_result=mysqli_query($conn,$skills_query);
											if(mysqli_num_rows($skills_result)>0)
											{
												
												$html_for_pdf.='<div class="entry">
												  <h2>Interests</h2>
												  <div class="content">
													<ul class="skills">';
														
															while($skills_row=mysqli_fetch_array($skills_result))
															{
																
																$html_for_pdf.='<li> '. ucwords($skills_row['title']).'. </li>';														
																
															}
														
													$html_for_pdf.='</ul>
												</div>';
												
											}
										}
										$experience_query="SELECT * FROM resume_education WHERE creator_id='$creator_id' ORDER BY from_year DESC";
										$experience_result=mysqli_query($conn,$experience_query);
										if(mysqli_num_rows($experience_result)>0)
										{
											
											$html_for_pdf.='<div class="entry">
												<h2>Acedemics</h2>';
												
													while($experience_row=mysqli_fetch_array($experience_result))
													{
														$experience_id=$experience_row['id'];
														$country_query="SELECT title FROM country WHERE id='".$experience_row['country']."'";
														$country_result=mysqli_query($conn,$country_query);
														$country_row=mysqli_fetch_array($country_result);
														
														$city_query="SELECT title FROM city WHERE id='".$experience_row['city']."'";
														$city_result=mysqli_query($conn,$city_query);
														$city_row=mysqli_fetch_array($city_result);
														
														$html_for_pdf.='<div class="content">
															<h3> '. print_month($experience_row['from_month'])." ".$experience_row['from_year'].'  - '; if($experience_row['studying']=="1"){ $html_for_pdf.= "Present"; } else { $html_for_pdf.= print_month($experience_row['to_month'])." ".$experience_row['to_year']; } $html_for_pdf.='</h3>
															<p> '. ucfirst(strtolower($experience_row['university'])).' ,  '. ucfirst(strtolower($country_row['title']));  $html_for_pdf.='<br />
															<em> '. ucfirst(strtolower($experience_row['title'])).' </em></p>
															<ul class="info">
															  <li>';
																	if($experience_row['description']==""){
																		$html_for_pdf.= "<b>".ucfirst(strtolower($experience_row['title']))."</b> at <b>".ucfirst(strtolower($experience_row['university']))."</b> in <b>".ucfirst(strtolower($city_row['title'])).", ".ucfirst(strtolower($country_row['title']))."</b> from <b>".print_month($experience_row['from_month'])." ".$experience_row['from_year']."</b> to <b>";
																		if($experience_row['studying']=="1"){ $html_for_pdf.= "Present</b>."; } else { $html_for_pdf.= print_month($experience_row['to_month'])." ".$experience_row['to_year']."</b>."; }
																	}
																	else
																	{
																		$html_for_pdf.= htmlspecialchars_decode(ucfirst(strtolower($experience_row['description'])));
																	}
																$html_for_pdf.='</li>
															</ul>
														</div>';
														
													}
												
											$html_for_pdf.='</div>';
											
										}
										else
										{
											$experience_query="SELECT * FROM users_education WHERE user_id='$resume_user_id' AND status=1 ORDER BY from_year DESC";
											$experience_result=mysqli_query($conn,$experience_query);
											if(mysqli_num_rows($experience_result)>0)
											{
												
												$html_for_pdf.='<div class="entry">
													<h2>Acedemics</h2>';
													
														while($experience_row=mysqli_fetch_array($experience_result))
														{
															$experience_id=$experience_row['id'];
															$country_query="SELECT title FROM country WHERE id='".$experience_row['country']."'";
															$country_result=mysqli_query($conn,$country_query);
															$country_row=mysqli_fetch_array($country_result);
															
															$city_query="SELECT title FROM city WHERE id='".$experience_row['city']."'";
															$city_result=mysqli_query($conn,$city_query);
															$city_row=mysqli_fetch_array($city_result);
															
															$html_for_pdf.='<div class="content">
																<h3> '. print_month($experience_row['from_month'])." ".$experience_row['from_year'].'  -  ';if($experience_row['studying']=="1"){ $html_for_pdf.= "Present"; } else { $html_for_pdf.= print_month($experience_row['to_month'])." ".$experience_row['to_year']; } $html_for_pdf.='</h3>
																<p> '. ucfirst(strtolower($experience_row['university'])).' ,  '. ucfirst(strtolower($country_row['title']));  $html_for_pdf.='<br />
																<em> '. ucfirst(strtolower($experience_row['title'])).' </em></p>
																<ul class="info">
																  <li>';
																		if($experience_row['description']==""){
																			$html_for_pdf.= "<b>".ucfirst(strtolower($experience_row['title']))."</b> at <b>".ucfirst(strtolower($experience_row['university']))."</b> in <b>".ucfirst(strtolower($city_row['title'])).", ".ucfirst(strtolower($country_row['title']))."</b> from <b>".print_month($experience_row['from_month'])." ".$experience_row['from_year']."</b> to <b>";
																			if($experience_row['studying']=="1"){ $html_for_pdf.= "Present</b>."; } else { $html_for_pdf.= print_month($experience_row['to_month'])." ".$experience_row['to_year']."</b>."; }
																		}
																		else
																		{
																			$html_for_pdf.= htmlspecialchars_decode(ucfirst(strtolower($experience_row['description'])));
																		}
																	$html_for_pdf.='</li>
																</ul>
															</div>';
															
														}
													
												$html_for_pdf.='</div>';
												
											}
										}
										if($creator_id && isset($creator_row['additional_description']) && $creator_row['additional_description']!="")
										{
											
											$html_for_pdf.='<div class="entry">
												<h2>More about me</h2>
												<div class="content">
													<p> '. htmlspecialchars_decode($creator_row['additional_description']).' </p>
												</div>
											</div>';
											
										}
										if($creator_id && isset($creator_row['include_references']) && $creator_row['include_references']=="1")
										{
											
											$html_for_pdf.='<pagebreak/><div class="entry" style="margin:0px;padding-top:10px;">
												<h2>References</h2>
												<div class="content" style="margin:0px;padding:5px;">
													<p style="font-size:14px;">References are available upon request.</p>
												</div>
											</div>';
											
										}
										$html_for_pdf.='<div class="entry">
												<div class="content" style="padding:5px;margin:0px;width:100% !important;border:1px solid gray;background-color:#1d2f38 !important;">
													<p style="text-align:center;font-size:20px;margin-top:-25px !important;padding:5px !important;font-style: italic;color:#fff !important;vertical-align:center;">This resume has been created by <a href="'.base_url.'" ><img src="'.base_url.'img/logo.png" style="align:center;height:20px;" /></a></p>
												</div>
											</div>';
								$html_for_pdf.='</div>
								<div class="clear"></div>
							</div>
						</div>
						<div class=""></div>
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
		$stylesheet1 = file_get_contents('css/green.css');
		$mpdf->WriteHTML($stylesheet1,\Mpdf\HTMLParserMode::HEADER_CSS);
		$stylesheet2 = file_get_contents('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
		$mpdf->WriteHTML($stylesheet2,\Mpdf\HTMLParserMode::HEADER_CSS);
		$stylesheet3 = file_get_contents('css/print.css');
		$mpdf->WriteHTML($stylesheet3,\Mpdf\HTMLParserMode::HEADER_CSS);
		$mpdf->WriteHTML($html_for_pdf_arr['html']);
		$file_name='../../user-data/ru-resume-'.$userToken.'.pdf';
		@unlink($file_name);
		$mpdf->Output($file_name,'F');
		//echo $file_name;
	}
	else
	{
		//echo "error";
	}
	echo "executed";
?>