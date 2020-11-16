<?php
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
			?>
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
					<title><?php echo "{$_WEB_AUTHOR}"; ?> :: Resume By RopeYou</title>
					<link type="text/css" rel="stylesheet" href="<?php echo base_url; ?>ambiguity/2/css/green.css" />
					
					<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
					<link type="text/css" rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
					<link type="text/css" rel="stylesheet" href="<?php echo base_url; ?>ambiguity/2/css/print.css" media="print"/>
					<script type="text/javascript" src="<?php echo base_url; ?>ambiguity/2/js/jquery-1.4.2.min.js"></script>
					
					<script type="text/javascript" src="<?php echo base_url; ?>ambiguity/2/js/jquery.tipsy.js"></script>
					<script type="text/javascript" src="<?php echo base_url; ?>ambiguity/2/js/cufon.yui.js"></script>
					<script type="text/javascript" src="<?php echo base_url; ?>ambiguity/2/js/scrollTo.js"></script>
					<script type="text/javascript" src="<?php echo base_url; ?>ambiguity/2/js/myriad.js"></script>
					<script type="text/javascript" src="<?php echo base_url; ?>ambiguity/2/js/jquery.colorbox.js"></script>
					<script type="text/javascript" src="<?php echo base_url; ?>ambiguity/2/js/custom.js"></script>
					<!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>-->
					<script type="text/javascript">
							Cufon.replace('h1,h2');
					</script>
					<style>
						h1{
							width:500px !important;
						}
						h2{
							font-size:20px;
						}
						#myh2{
							width:500px !important;
							float:left !important;
							text-align:left;
							margin-block-start: 0px !important;
							margin-left:5px !important;
							font-size:15px !important;
							margin-top:20px !important;
							clear:both;
						}
						.entry{
							padding-top:30px !important;
						}
					</style>
				</head>
				<body>
					<div id="wrapper">
						<div class=""></div>
							<div class="">
								<div id="paper">
									<div id="paper-mid">
										<div class="entry"><!--onclick="DownloadResume();"-->
											<!--<a href="javascript:void(0);" onclick="PrintResume();" style="font-size:25px;float:right;border:1px solid gray;padding:3px;" title="Print Resume"><i class="fa fa-print"></i></a>-->
											<?php
												if($creator_id)
												{
													?>
														<!--<a href="javascript:void(0);" style="font-size:25px;float:left;border:1px solid gray;padding:3px;margin-right:20px;text-decoration:none;color:red;" onclick="ShareResume();" title="Share using email"><i class="fa fa-envelope"></i></a>-->
								
														<a href="<?php echo base_url; ?>ambiguity/<?php echo $creator_row['resume_id']; ?>/get-pdf" target="_blank" style="font-size:25px;float:right;border:1px solid gray;padding:3px;" title="Download Resume"><i class="fa fa-download"></i></a>
													<?php
												}
											?>
										</div>
										<div class="entry">
											<img class="portrait" src="<?php echo $profile_image; ?>" alt="<?php echo "{$_WEB_AUTHOR}"; ?>" />
											<div class="self">
												<h1 class="name"><?php if(isset($creator_row) && $creator_row['first_name']!="") { echo  ucwords($creator_row['first_name']." ".$creator_row['last_name']); } else { echo $_WEB_AUTHOR; } ?><a href="<?php echo base_url; ?>provide-resume-information.php?step=1&reload=force" style="float:right;font-size:15px;text-decoration: underline !important;" class="pull-right">(edit)</a></h1>
												<p id="myh2"><?php if(isset($creator_row) && $creator_row['first_name']!="") { echo  $creator_row['profile_title']; } else { echo $user_row['profile_title']; } ?></p>
												<ul style="margin-top:25px !important;clear:both;">
													<?php
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
															?>
																<li class="mail"><a href="mailto:<?php echo $communication_email; ?>" target="_blank"><?php echo $communication_email; ?></a></li>
															<?php
														}
														if($communication_mobile!="")
														{
															?>
																<li class="tel"><a href="tel:<?php echo $communication_mobile; ?>" target="_blank"><?php echo $communication_mobile; ?></a></li>
															<?php
														}
														if($website!="")
														{
															?>
																<li class="web"><a href="<?php echo $website; ?>" target="_blank"><?php echo $website; ?></a></li>
															<?php
														}
													?>
													<li class="web"><a href="<?php echo base_url; ?>u/<?php echo $user_row['username']; ?>"><?php echo base_url; ?>u/<?php echo $user_row['username']; ?></a></li>
												</ul>
											</div>
										</div>
									<?php
										if($user_personal_row['about']!="")
										{
											?>
											<div class="entry">
												<h2><a href="<?php echo base_url; ?>provide-resume-information.php?step=2&reload=force" style="font-size:15px;text-decoration: underline !important;">(edit)</a>&nbsp;&nbsp;About</h2>
												<p style="font-size:14px;text-align:justify;">
													<?php 
														echo htmlspecialchars_decode($user_personal_row['about']);
													?>
												</p>
											</div>
											<?php
										}
										$skills_query="SELECT * FROM resume_skills WHERE creator_id='".$creator_id."' order by type ASC";
										$skills_result=mysqli_query($conn,$skills_query);
										if(mysqli_num_rows($skills_result)>0)
										{
											?>
											<div class="entry">
											  <h2><a href="<?php echo base_url; ?>provide-resume-information.php?step=5&reload=force" style="font-size:15px;text-decoration: underline !important;">(edit)</a>&nbsp;&nbsp;Skills</h2>
											  <div class="content">
												<ul class="skills">
													<?php
														while($skills_row=mysqli_fetch_array($skills_result))
														{
															?>
															<li><?php echo ucwords($skills_row['title']); ?></li>														
															<?php
														}
													?>
												</ul>
											</div>
											<?php
										}
										else
										{
											$skills_query="SELECT * FROM users_skills WHERE user_id='".$resume_user_id."' order by type ASC";
											$skills_result=mysqli_query($conn,$skills_query);
											if(mysqli_num_rows($skills_result)>0)
											{
												?>
												<div class="entry">
												  <h2><a href="<?php echo base_url; ?>provide-resume-information.php?step=5&reload=force" style="font-size:15px;text-decoration: underline !important;">(edit)</a>&nbsp;&nbsp;Skills</h2>
												  <div class="content">
													<ul class="skills">
														<?php
															while($skills_row=mysqli_fetch_array($skills_result))
															{
																?>
																<li><?php echo ucwords($skills_row['title']); ?></li>														
																<?php
															}
														?>
													</ul>
												</div>
												<?php
											}
										}
										$experience_query="SELECT * FROM resume_experiences WHERE creator_id='$creator_id' ORDER BY from_year DESC";
										$experience_result=mysqli_query($conn,$experience_query);
										if(mysqli_num_rows($experience_result)>0)
										{
											?>
											<div class="entry">
												<h2><a href="<?php echo base_url; ?>provide-resume-information.php?step=3&reload=force" style="font-size:15px;text-decoration: underline !important;">(edit)</a>&nbsp;&nbsp;Experiences</h2>
												<?php
													while($experience_row=mysqli_fetch_array($experience_result))
													{
														$experience_id=$experience_row['id'];
														$country_query="SELECT title FROM country WHERE id='".$experience_row['country']."'";
														$country_result=mysqli_query($conn,$country_query);
														$country_row=mysqli_fetch_array($country_result);
														
														$city_query="SELECT title FROM city WHERE id='".$experience_row['city']."'";
														$city_result=mysqli_query($conn,$city_query);
														$city_row=mysqli_fetch_array($city_result);
														?>
														<div class="content">
															<h3><?php echo print_month($experience_row['from_month'])." ".$experience_row['from_year']; ?> - <?php if($experience_row['working']=="1"){ echo "Present"; } else { echo print_month($experience_row['to_month'])." ".$experience_row['to_year']; } ?></h3>
															<p><?php echo ucfirst(strtolower($experience_row['company'])); ?>, <?php echo ucfirst(strtolower($country_row['title'])); ?> <br />
															<em><?php echo ucfirst(strtolower($experience_row['title'])); ?></em></p>
															<ul class="info">
															  <li><?php
																	if($experience_row['description']==""){
																		echo "<b>".ucfirst(strtolower($experience_row['title']))."</b> at <b>".ucfirst(strtolower($experience_row['company']))."</b> in <b>".ucfirst(strtolower($city_row['title'])).", ".ucfirst(strtolower($country_row['title']))."</b> from <b>".print_month($experience_row['from_month'])." ".$experience_row['from_year']."</b> to <b>";
																		if($experience_row['working']=="1"){ echo "Present</b>."; } else { echo print_month($experience_row['to_month'])." ".$experience_row['to_year']."</b>."; }
																	}
																	else
																	{
																		echo ucfirst(strtolower($experience_row['description']));
																	}
																?></li>
															</ul>
														</div>
														<?php
													}
												?>
											</div>
											<?php
										}
										else
										{
											$experience_query="SELECT * FROM users_work_experience WHERE user_id='$resume_user_id' ORDER BY from_year DESC";
											$experience_result=mysqli_query($conn,$experience_query);
											if(mysqli_num_rows($experience_result)>0)
											{
												?>
												<div class="entry">
													<h2><a href="<?php echo base_url; ?>provide-resume-information.php?step=3&reload=force" style="font-size:15px;text-decoration: underline !important;">(edit)</a>&nbsp;&nbsp;Experiences</h2>
													<?php
														while($experience_row=mysqli_fetch_array($experience_result))
														{
															$experience_id=$experience_row['id'];
															$country_query="SELECT title FROM country WHERE id='".$experience_row['country']."'";
															$country_result=mysqli_query($conn,$country_query);
															$country_row=mysqli_fetch_array($country_result);
															
															$city_query="SELECT title FROM city WHERE id='".$experience_row['city']."'";
															$city_result=mysqli_query($conn,$city_query);
															$city_row=mysqli_fetch_array($city_result);
															?>
															<div class="content">
																<h3><?php echo print_month($experience_row['from_month'])." ".$experience_row['from_year']; ?> - <?php if($experience_row['working']=="1"){ echo "Present"; } else { echo print_month($experience_row['to_month'])." ".$experience_row['to_year']; } ?></h3>
																<p><?php echo ucfirst(strtolower($experience_row['company'])); ?>, <?php echo ucfirst(strtolower($country_row['title'])); ?> <br />
																<em><?php echo ucfirst(strtolower($experience_row['title'])); ?></em></p>
																<ul class="info">
																  <li><?php
																		if($experience_row['description']==""){
																			echo "<b>".ucfirst(strtolower($experience_row['title']))."</b> at <b>".ucfirst(strtolower($experience_row['company']))."</b> in <b>".ucfirst(strtolower($city_row['title'])).", ".ucfirst(strtolower($country_row['title']))."</b> from <b>".print_month($experience_row['from_month'])." ".$experience_row['from_year']."</b> to <b>";
																			if($experience_row['working']=="1"){ echo "Present</b>."; } else { echo print_month($experience_row['to_month'])." ".$experience_row['to_year']."</b>."; }
																		}
																		else
																		{
																			echo ucfirst(strtolower($experience_row['description']));
																		}
																	?></li>
																</ul>
															</div>
															<?php
														}
													?>
												</div>
												<?php
											}
										}
										$skills_query="SELECT * FROM resume_certifications WHERE creator_id='$creator_id' order by title";
										$skills_result=mysqli_query($conn,$skills_query);
										if(mysqli_num_rows($skills_result)>0)
										{
											?>
											<div class="entry">
											  <h2><a href="<?php echo base_url; ?>provide-resume-information.php?step=7&reload=force" style="font-size:15px;text-decoration: underline !important;">(edit)</a>&nbsp;&nbsp;Acheivements</h2>
											  <div class="content">
												<ul class="skills">
													<?php
														while($skills_row=mysqli_fetch_array($skills_result))
														{
															?>
															<li><?php echo ucwords($skills_row['title']); ?></li>														
															<?php
														}
													?>
												</ul>
											</div>
											<?php
										}
										else
										{
											$skills_query="SELECT * FROM users_awards WHERE status=1 AND user_id='$resume_user_id' order by title";
											$skills_result=mysqli_query($conn,$skills_query);
											if(mysqli_num_rows($skills_result)>0)
											{
												?>
												<div class="entry">
												  <h2><a href="<?php echo base_url; ?>provide-resume-information.php?step=7&reload=force" style="font-size:15px;text-decoration: underline !important;">(edit)</a>&nbsp;&nbsp;Acheivements</h2>
												  <div class="content">
													<ul class="skills">
														<?php
															while($skills_row=mysqli_fetch_array($skills_result))
															{
																?>
																<li><?php echo ucwords($skills_row['title']); ?></li>														
																<?php
															}
														?>
													</ul>
												</div>
												<?php
											}
										}
										$skills_query="SELECT * FROM resume_interests WHERE creator_id='$creator_id' order by title";
										$skills_result=mysqli_query($conn,$skills_query);
										if(mysqli_num_rows($skills_result)>0)
										{
											?>
											<div class="entry">
											  <h2><a href="<?php echo base_url; ?>provide-resume-information.php?step=6&reload=force" style="font-size:15px;text-decoration: underline !important;">(edit)</a>&nbsp;&nbsp;Interests</h2>
											  <div class="content">
												<ul class="skills">
													<?php
														while($skills_row=mysqli_fetch_array($skills_result))
														{
															?>
															<li><?php echo ucwords($skills_row['title']); ?></li>														
															<?php
														}
													?>
												</ul>
											</div>
											<?php
										}
										else
										{
											$skills_query="SELECT * FROM users_interests WHERE user_id='$resume_user_id' order by title";
											$skills_result=mysqli_query($conn,$skills_query);
											if(mysqli_num_rows($skills_result)>0)
											{
												?>
												<div class="entry">
												  <h2><a href="<?php echo base_url; ?>provide-resume-information.php?step=6&reload=force" style="font-size:15px;text-decoration: underline !important;">(edit)</a>&nbsp;&nbsp;Interests</h2>
												  <div class="content">
													<ul class="skills">
														<?php
															while($skills_row=mysqli_fetch_array($skills_result))
															{
																?>
																<li><?php echo ucwords($skills_row['title']); ?></li>														
																<?php
															}
														?>
													</ul>
												</div>
												<?php
											}
										}
										$experience_query="SELECT * FROM resume_education WHERE creator_id='$creator_id' ORDER BY from_year DESC";
										$experience_result=mysqli_query($conn,$experience_query);
										if(mysqli_num_rows($experience_result)>0)
										{
											?>
											<div class="entry">
												<h2><a href="<?php echo base_url; ?>provide-resume-information.php?step=4&reload=force" style="font-size:15px;text-decoration: underline !important;">(edit)</a>&nbsp;&nbsp;Acedemics</h2>
												<?php
													while($experience_row=mysqli_fetch_array($experience_result))
													{
														$experience_id=$experience_row['id'];
														$country_query="SELECT title FROM country WHERE id='".$experience_row['country']."'";
														$country_result=mysqli_query($conn,$country_query);
														$country_row=mysqli_fetch_array($country_result);
														
														$city_query="SELECT title FROM city WHERE id='".$experience_row['city']."'";
														$city_result=mysqli_query($conn,$city_query);
														$city_row=mysqli_fetch_array($city_result);
														?>
														<div class="content">
															<h3><?php echo print_month($experience_row['from_month'])." ".$experience_row['from_year']; ?> - <?php if($experience_row['studying']=="1"){ echo "Present"; } else { echo print_month($experience_row['to_month'])." ".$experience_row['to_year']; } ?></h3>
															<p><?php echo ucfirst(strtolower($experience_row['university'])); ?>, <?php echo ucfirst(strtolower($country_row['title'])); ?> <br />
															<em><?php echo ucfirst(strtolower($experience_row['title'])); ?></em></p>
															<ul class="info">
															  <li><?php
																	if($experience_row['description']==""){
																		echo "<b>".ucfirst(strtolower($experience_row['title']))."</b> at <b>".ucfirst(strtolower($experience_row['university']))."</b> in <b>".ucfirst(strtolower($city_row['title'])).", ".ucfirst(strtolower($country_row['title']))."</b> from <b>".print_month($experience_row['from_month'])." ".$experience_row['from_year']."</b> to <b>";
																		if($experience_row['studying']=="1"){ echo "Present</b>."; } else { echo print_month($experience_row['to_month'])." ".$experience_row['to_year']."</b>."; }
																	}
																	else
																	{
																		echo ucfirst(strtolower($experience_row['description']));
																	}
																?></li>
															</ul>
														</div>
														<?php
													}
												?>
											</div>
											<?php
										}
										else
										{
											$experience_query="SELECT * FROM users_education WHERE user_id='$resume_user_id' AND status=1 ORDER BY from_year DESC";
											$experience_result=mysqli_query($conn,$experience_query);
											if(mysqli_num_rows($experience_result)>0)
											{
												?>
												<div class="entry">
													<h2><a href="<?php echo base_url; ?>provide-resume-information.php?step=4&reload=force" style="font-size:15px;text-decoration: underline !important;">(edit)</a>&nbsp;&nbsp;Acedemics</h2>
													<?php
														while($experience_row=mysqli_fetch_array($experience_result))
														{
															$experience_id=$experience_row['id'];
															$country_query="SELECT title FROM country WHERE id='".$experience_row['country']."'";
															$country_result=mysqli_query($conn,$country_query);
															$country_row=mysqli_fetch_array($country_result);
															
															$city_query="SELECT title FROM city WHERE id='".$experience_row['city']."'";
															$city_result=mysqli_query($conn,$city_query);
															$city_row=mysqli_fetch_array($city_result);
															?>
															<div class="content">
																<h3><?php echo print_month($experience_row['from_month'])." ".$experience_row['from_year']; ?> - <?php if($experience_row['studying']=="1"){ echo "Present"; } else { echo print_month($experience_row['to_month'])." ".$experience_row['to_year']; } ?></h3>
																<p><?php echo ucfirst(strtolower($experience_row['university'])); ?>, <?php echo ucfirst(strtolower($country_row['title'])); ?> <br />
																<em><?php echo ucfirst(strtolower($experience_row['title'])); ?></em></p>
																<ul class="info">
																  <li><?php
																		if($experience_row['description']==""){
																			echo "<b>".ucfirst(strtolower($experience_row['title']))."</b> at <b>".ucfirst(strtolower($experience_row['university']))."</b> in <b>".ucfirst(strtolower($city_row['title'])).", ".ucfirst(strtolower($country_row['title']))."</b> from <b>".print_month($experience_row['from_month'])." ".$experience_row['from_year']."</b> to <b>";
																			if($experience_row['studying']=="1"){ echo "Present</b>."; } else { echo print_month($experience_row['to_month'])." ".$experience_row['to_year']."</b>."; }
																		}
																		else
																		{
																			echo ucfirst(strtolower($experience_row['description']));
																		}
																	?></li>
																</ul>
															</div>
															<?php
														}
													?>
												</div>
												<?php
											}
										}
										if($creator_id && isset($creator_row['additional_description']) && $creator_row['additional_description']!="")
										{
											?>
											<div class="entry">
												<h2><a href="<?php echo base_url; ?>provide-resume-information.php?step=8&reload=force" style="font-size:15px;text-decoration: underline !important;">(edit)</a>&nbsp;&nbsp;More about me</h2>
												<div class="content">
													<p><?php echo htmlspecialchars_decode($creator_row['additional_description']); ?></p>
												</div>
											</div>
											<?php
										}
										if($creator_id && isset($creator_row['include_references']) && $creator_row['include_references']=="1")
										{
											?>
											<div class="entry">
												<h2><a href="<?php echo base_url; ?>provide-resume-information.php?step=8&reload=force" style="font-size:15px;text-decoration: underline !important;">(edit)</a>&nbsp;&nbsp;References</h2>
												<div class="content">
													<p>References are available upon request.</p>
												</div>
											</div>
											<?php
										}
									?>
								</div>
								<div class="clear"></div>
							</div>
						</div>
						<div class=""></div>
					</div>
				</body>
			</html>
			
			<?php
		}
		else
		{
			echo 'Nothing found for the given user';
		}
	}
	$userToken=$_COOKIE['uid'];
	if(isset($_REQUEST['userToken']) && $_REQUEST['userToken']!="")
	{
		$userToken=$_REQUEST['userToken'];
	}
	get_user_resume($userToken);
?>
<script>
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
			url:'<?php echo base_url; ?>ambiguity/2/create-pdf',
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
			url:'<?php echo base_url; ?>ambiguity/2/get-pdf',
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
				url:'<?php echo base_url; ?>ambiguity/2/create-pdf',
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
<!--<div class="modal fade amazing_contact_backdrop_modal" id="amazing_contact_backdrop_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="amazingContactBackdrop" aria-hidden="true">
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
			</div>-->