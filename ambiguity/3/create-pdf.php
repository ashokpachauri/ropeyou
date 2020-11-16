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
				<style media="print">
					h6{
						font-size:1rem;
						width:100%;
					}
					h1,h2,h3,h4,h5,h6{
						padding:0px;
					}
					p{
						font-size:14px !important;
					}
				</style>
				<body style="overflow-x:hidden;">
						<div style="background:#fff;border-radius:2px;width:100% !important;">';
								$html_for_pdf.='
							<div style="width:100%;background-color:#efefef;">
								<h3 style="text-align:center;"><span id="full_name_html">'. $_WEB_AUTHOR; $html_for_pdf.='</span></h3>
								<p style="text-align:center !important;" class="communication_details">'; if(isset($creator_row) && $creator_row['profile_title']!="") { $html_for_pdf.=  $creator_row['profile_title']; } else { $html_for_pdf.= $user_row['profile_title']; }$html_for_pdf.='</p>
								
							</div>
							<div style="text-align:center;width:100%;">
								<img id="user_image_html" src="'. $_WEB_AUTHOR_IMAGE; $html_for_pdf.='" class="" style="max-height:150px;cursor:pointer;border:1px solid #efefef;"><br/>
								<p id="communication_details"><a href="'.base_url.'u/'. $user_row['username']; $html_for_pdf.='" title="'.base_url.'u/'. $user_row['username']; $html_for_pdf.='" target="_blank" style="text-align:center !important;">'.base_url.'u/'. $user_row['username']; $html_for_pdf.='</a><br/>';
										
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
									
								
							$html_for_pdf.='</div>
							<div class="row row_position">';
								
									if($creator_row['about']!="" && $creator_row['about']!=null)
									{
								
								$html_for_pdf.='<div id="professional_summary_draggable" style="width:100%;max-height:20px !important;padding:2px;" draggable>
									<div style="width:100%;background-color:#efefef;cursor: move;" id="professional_summary_draggable_header">
										<h4 style="text-align:center;padding:0px;margin:0px;" id="profile_title">PROFESSIONAL SUMMARY</h4>
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
								
								$html_for_pdf.='<div id="professional_summary_draggable" style="width:100%;height:20px !important;padding:2px;" draggable>
									<div style="width:100%;background-color:#efefef;cursor: move;" id="professional_summary_draggable_header">
										<h4 style="text-align:center;padding:0px;margin:0px;" id="profile_title">PROFESSIONAL SUMMARY</h4>
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
												<div style="width:100% !important;">
													<div class="col-md-12">
														<div style="width:100%;background-color:#efefef;cursor: move;margin-bottom:10px;" id="experience_draggable_header">
															<h4 style="text-align:center;padding:0px;margin:0px;" id="experience_1">
																EXPERIENCE 
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
																	<h5 style="text-align:center;padding:0px;margin:0px;" id="experience_1">
																		'. ucfirst(strtolower($experience_row['designation'])); $html_for_pdf.=' at '. ucfirst(strtolower($experience_row['company'])); 
																	$html_for_pdf.='</h5>
																</div>
																<table style="width:100%;margin-top:20px;margin-bottom:20px;" cellspacing="3" border="0">
																	<tr style="width:100%;">
																		<td style="width:70%"><h6>
																			 
																				'. $experience_row['company'];
																				
																			
																		$html_for_pdf.='</h6></td><td style="width:30%"></td></tr>
																		<tr style="width:100%;"><td style="width:70%"><h6>'. $experience_row['designation'].'</h6></td><td style="align:center;width:30%;">'; $html_for_pdf.=''. print_month($experience_row['from_month'])." ".$experience_row['from_year']; $html_for_pdf.=' - '; if($experience_row['working']=="1"){$html_for_pdf.="Present"; } else {$html_for_pdf.=print_month($experience_row['to_month'])." ".$experience_row['to_year']; } $html_for_pdf.='
																		<tr style="width:100%;">
																		<td style="width:99%"><p>
																			'. @htmlspecialchars_decode($experience_row['description']);  
																		$html_for_pdf.='</p></td><td style="width:1%;"></td></tr>
																	</tr>
																</table>
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
												<div style="width:100% !important;">
													<div class="col-md-12">
														<div style="width:100%;background-color:#efefef;cursor: move;margin-bottom:10px;" id="experience_draggable_header">
															<h4 style="text-align:center;padding:0px;margin:0px;" id="experience_1">
																EXPERIENCE 
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
																	<h5 style="text-align:center;padding:0px;margin:0px;" id="experience_1">
																		'. ucfirst(strtolower($experience_row['title'])); $html_for_pdf.=' at '. ucfirst(strtolower($experience_row['company'])); 
																	$html_for_pdf.='</h5>
																</div>
																<table style="width:100%;margin-top:20px;margin-bottom:20px;" cellspacing="3" border="0">
																	<tr style="width:100%;">
																		<td style="width:70%"><h6>
																			 
																				'. $experience_row['company'];
																				
																			
																		$html_for_pdf.='</h6></td><td style="width:30%"></td></tr>
																		<tr style="width:100%;"><td style="width:70%"><h6>'. $experience_row['title'].'</h6></td><td style="align:center;width:30%;">'; $html_for_pdf.=''. print_month($experience_row['from_month'])." ".$experience_row['from_year']; $html_for_pdf.=' - '; if($experience_row['working']=="1"){$html_for_pdf.="Present"; } else {$html_for_pdf.=print_month($experience_row['to_month'])." ".$experience_row['to_year']; } $html_for_pdf.='
																		<tr style="width:100%;">
																		<td style="width:99%"><p>
																			'. @htmlspecialchars_decode($experience_row['description']);  
																		$html_for_pdf.='</p></td><td style="width:1%;"></td></tr>
																	</tr>
																</table>
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
													<h4 style="text-align:center;padding:0px;margin:0px;" id="personal_skills_title">
														PERSONAL SKILLS
													</h4>
												</div>
												<div>';
													
													while($skills_row=mysqli_fetch_array($skills_result))
													{
														
														$html_for_pdf.='<div style="float:left;width:50%;padding:0px;margin-bottom:10px;">
															<span style="font-size:14px;">'. ucfirst($skills_row['title']); $html_for_pdf.='</span>
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
													<h4 style="text-align:center;padding:0px;margin:0px;" id="personal_skills_title">
														PERSONAL SKILLS
													</h4>
												</div>
												<div>';
													
													while($skills_row=mysqli_fetch_array($skills_result))
													{
														
														$html_for_pdf.='<div style="float:left;width:50%;padding:0px;margin-bottom:10px;">
															<span style="font-size:14px;">'. ucfirst($skills_row['title']); $html_for_pdf.='</span>
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
													<h4 style="text-align:center;padding:0px;margin:0px;" id="personal_skills_title">
														PROFESSIONAL SKILLS
													</h4>
												</div>
												<div>';
													
													while($skills_row=mysqli_fetch_array($skills_result))
													{
														
														$html_for_pdf.='<div style="float:left;width:50%;padding:0px;margin-bottom:10px;">
															<span style="font-size:14px;">'. ucfirst($skills_row['title']); $html_for_pdf.='</span>
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
													<h4 style="text-align:center;padding:0px;margin:0px;" id="personal_skills_title">
														PROFESSIONAL SKILLS
													</h4>
												</div>
												<div>';
													
													while($skills_row=mysqli_fetch_array($skills_result))
													{
														
														$html_for_pdf.='<div style="float:left;width:50%;padding:0px;margin-bottom:10px;">
															<span style="font-size:14px;">'. ucfirst($skills_row['title']); $html_for_pdf.='</span>
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
												<h4 style="text-align:center;padding:0px;margin:0px;" id="personal_skills_title">
													LINGUISTIC SKILLS
												</h4>
											</div>
											<div style="">';
											
												while($skills_row=mysqli_fetch_array($skills_result))
												{
													
													$html_for_pdf.='<div style="float:left;width:50%;padding:0px;margin-bottom:10px;">
														<span style="font-size:14px;">'. ucfirst($skills_row['title']); $html_for_pdf.='</span>
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
													<h4 style="text-align:center;padding:0px;margin:0px;" id="personal_skills_title">
														LINGUISTIC SKILLS
													</h4>
												</div>
												<div>';
												
													while($skills_row=mysqli_fetch_array($skills_result))
													{
														
														$html_for_pdf.='<div style="float:left;width:50%;padding:0px;margin-bottom:10px;">
															<span style="font-size:14px;">'. ucfirst($skills_row['title']); $html_for_pdf.='</span>
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
											<div style="width:100% !important;">
												<div class="col-md-12">
													<div style="width:100%;background-color:#efefef;cursor: move;margin-bottom:10px;" id="experience_draggable_header">
														<h4 style="text-align:center;padding:0px;margin:0px;" id="experience_1">
															ACADEMICS 
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
															<h5 style="text-align:center;padding:0px;margin:0px;" id="experience_1">
																'. ucfirst(strtolower($experience_row['course'])).' at '. ucfirst(strtolower($experience_row['university'])); 
															$html_for_pdf.='</h5>
														</div>
														
														<table style="width:100%;margin-top:20px;margin-bottom:20px;" cellspacing="3" border="0">
															<tr style="width:100%;">
																<td style="width:70%"><h6>
																	 
																		'. $experience_row['university'];
																		
																	
																$html_for_pdf.='</h6></td><td style="width:30%"></td></tr>
																<tr style="width:100%;"><td style="width:70%"><h6>'. $experience_row['course'].'</h6></td><td style="align:center;width:30%;">'; $html_for_pdf.=''. print_month($experience_row['from_month'])." ".$experience_row['from_year']; $html_for_pdf.=' - '; if($experience_row['working']=="1"){$html_for_pdf.="Present"; } else {$html_for_pdf.=print_month($experience_row['to_month'])." ".$experience_row['to_year']; } $html_for_pdf.='
																<tr style="width:100%;">
																<td style="width:99%"><p>
																	'. @htmlspecialchars_decode($experience_row['description']);  
																$html_for_pdf.='</p></td><td style="width:1%;"></td></tr>
															</tr>
														</table>
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
												<div style="width:100% !important;">
													<div class="col-md-12">
														<div style="width:100%;background-color:#efefef;cursor: move;margin-bottom:10px;height:30px;" id="experience_draggable_header">
															<h4 style="text-align:center;padding:0px;margin:0px;" id="experience_1">
																ACADEMICS 
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
																<h5 style="text-align:center;padding:0px;margin:0px;" id="experience_1">
																	'. ucfirst(strtolower($experience_row['title'])).' at '. ucfirst(strtolower($experience_row['university'])); 
																$html_for_pdf.='</h5>
															</div>
															<table style="width:100%;margin-top:20px;margin-bottom:20px;" cellspacing="3" border="0">
															<tr style="width:100%;">
																<td style="width:70%"><h6>
																	 
																		'. $experience_row['university'];
																		
																	
																$html_for_pdf.='</h6></td><td style="width:30%"></td></tr>
																<tr style="width:100%;"><td style="width:70%"><h6>'. $experience_row['course'].'</h6></td><td style="align:center;width:30%;">'; $html_for_pdf.=''. print_month($experience_row['from_month'])." ".$experience_row['from_year']; $html_for_pdf.=' - '; if($experience_row['working']=="1"){$html_for_pdf.="Present"; } else {$html_for_pdf.=print_month($experience_row['to_month'])." ".$experience_row['to_year']; } $html_for_pdf.='
																<tr style="width:100%;">
																<td style="width:99%"><p>
																	'. @htmlspecialchars_decode($experience_row['title']);  
																$html_for_pdf.='</p></td><td style="width:1%;"></td></tr>
															</tr>
														</table>
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
													<h4 style="text-align:center;padding:0px;margin:0px;" id="personal_skills_title">
														ACHIEVEMENTS
													</h4>
												</div>
												<div>';
													
													$i=1;
													while($skills_row=mysqli_fetch_array($skills_result))
													{
														
														$html_for_pdf.='<div style="float:left;width:50%;padding:0px;margin-bottom:10px;">
															<h6 style="margin:0px;padding:5px;">'. $i++.'. &nbsp;'.ucfirst($skills_row['title']).' </h6>';
															if($skills_row['description']!="" && $skills_row['description']!=null){
																$html_for_pdf.='<p class="text-justify">'. ucfirst(strip_tags($skills_row['description'])).' </p>';
															}
														$html_for_pdf.='</div>';
														
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
													<h4 style="text-align:center;padding:0px;margin:0px;" id="personal_skills_title">
														ACHIEVEMENTS
													</h4>
												</div>
												<div>';
													
													$i=1;
													while($skills_row=mysqli_fetch_array($skills_result))
													{
														$html_for_pdf.='<div style="float:left;width:50%;padding:0px;margin-bottom:10px;">
															<h6 style="margin:0px;padding:5px;">'. $i++.'. &nbsp;'.ucfirst($skills_row['title']).' </h6>';
															if($skills_row['description']!="" && $skills_row['description']!=null){
																$html_for_pdf.='<p class="text-justify">'. ucfirst(strip_tags($skills_row['description'])).' </p>';
															}
														$html_for_pdf.='</div>';
														
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
													<h4 style="text-align:center;padding:0px;margin:0px;" id="personal_skills_title">
														INTERESTS
													</h4>
												</div>
												<div>';
													
													while($skills_row=mysqli_fetch_array($skills_result))
													{
														
														$html_for_pdf.='<div style="float:left;width:50%;padding:0px;margin-bottom:10px;">
															<span style="font-size:14px;">'. ucfirst($skills_row['title']); $html_for_pdf.='</span>
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
													<h4 style="text-align:center;padding:0px;margin:0px;" id="personal_skills_title">
														INTERESTS
													</h4>
												</div>
												<div>';
													
													while($skills_row=mysqli_fetch_array($skills_result))
													{
														
														$html_for_pdf.='<div style="float:left;width:50%;padding:0px;margin-bottom:10px;">
															<span style="font-size:14px;">'. ucfirst($skills_row['title']); $html_for_pdf.='</span>
														</div>';
														
													}
													
												$html_for_pdf.='</div>
											</div>';
											
										}
									}
									if($creator_id && isset($creator_row['additional_description']) && $creator_row['additional_description']!="")
									{
										
										$html_for_pdf.='<div style="width:100%;background-color:#efefef;" id="">
													<h4 style="text-align:center;padding:0px;margin:0px;" id="personal_skills_title">
															More about me
														</h4>
												</div>
												<div style="width:100% !important;">
													<p style="font-size:14px;">'. htmlspecialchars_decode($creator_row['additional_description']).'</p></article>
												</div>';
										
									}
									if($creator_id && isset($creator_row['include_references']) && $creator_row['include_references']=="1")
									{
										$html_for_pdf.='<div style="width:100%;background-color:#efefef;" id="">
													<h4 style="text-align:center;padding:0px;margin:0px;" id="personal_skills_title">
															References
														</h4>
												</div>
												<div style="width:100% !important;">
													<p style="font-size:14px;">References are available upon request.</p></article>
												</div>';
										
									}
									$html_for_pdf.='<div style="width:100%;background-color:#1d2f38;" id="">
													<p style="text-align:center;font-size:20px;margin-top:-25px !important;padding:5px !important;font-style: italic;color:#fff !important;vertical-align:center;">This resume has been created by <a href="'.base_url.'" ><img src="'.base_url.'img/logo.png" style="align:center;height:20px;" /></a></p>
											</div>';
							$html_for_pdf.='</div>
						</div>
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
		$html = file_get_contents($url);
		//echo $html_for_pdf;
		/*$stylesheet1 = file_get_contents(base_url.'css/style.css');
		$mpdf->WriteHTML($stylesheet1,\Mpdf\HTMLParserMode::HEADER_CSS);*/
		$stylesheet2 = file_get_contents('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
		$mpdf->WriteHTML($stylesheet2,\Mpdf\HTMLParserMode::HEADER_CSS);
		$mpdf->WriteHTML($html_for_pdf_arr['html']);
		$file_name='../../user-data/ru-resume-'.$userToken.'.pdf';
		@unlink($file_name);
		$mpdf->Output($file_name,'F');
		//echo $file_name;
	}
	echo "executed";
?>