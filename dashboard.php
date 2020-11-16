<html lang="en">
	<head>
		<?php 
			include_once 'head.php';
			$user_row=getUsersData($_COOKIE['uid']);
			if(isset($_FILES['res_form_text_format_file']) && $_FILES['res_form_text_format_file']['name'])
			{
				$target_dir="uploads/";
				$target_file = $target_dir .$user_row['username'].'-'.mt_rand(1000,9999).'-'. str_replace("/","",str_replace(" ","-",basename($_FILES["res_form_text_format_file"]["name"])));
				if(move_uploaded_file($_FILES["res_form_text_format_file"]["tmp_name"], $target_file)) 
				{
					$cvquery="SELECT * FROM users_resume WHERE user_id='".$_COOKIE['uid']."' ORDER BY id DESC";
					$cvresult=mysqli_query($conn,$cvquery);
					$cv_insert_query="INSERT INTO users_resume SET user_id='".$_COOKIE['uid']."',resume_headline='',file='$target_file',is_default=1,profile_type=1,added=NOW(),status=1,file_title='',type='',size=0";
					if(mysqli_num_rows($cvresult)>0)
					{
						$cvrow=mysqli_fetch_array($cvresult);
						$id=$cvrow['id'];
						$file=$cvrow['file'];
						@unlink($file);
						$cv_insert_query="UPDATE users_resume SET file='$target_file' WHERE id='$id'";
					}
					if(mysqli_query($conn,$cv_insert_query))
					{
						?>
						<script>
							alert('Uploaded successfully.');
						</script>
						<?php
					}
					else
					{
						?>
						<script>
							alert('DB Connection error.');
						</script>
						<?php
					}
				}
				else
				{
					?>
					<script>
						alert('Some Technical error please contact developer.');
					</script>
					<?php
				}
			}
		?>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo $user_row['first_name']." ".$user_row['last_name']; ?>'s Dashboard | RopeYou Connects</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha256-siyOpF/pBWUPgIcQi17TLBkjvNgNQArcmwJB8YvkAgg=" crossorigin="anonymous" />
		<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
		<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
	</head>
	<style>
		.modal-dialog-full-width {
			width: 80% !important;
			height: 90% !important;
			margin: 5% !important;
			margin-left: 10% !important;
			padding: 2 !important;
			max-width:none !important;

		}

		.modal-content-full-width  {
			height: auto !important;
			min-height: 90% !important;
			border-radius: 0 !important;
			background-color: #ececec !important 
		}

		.modal-header-full-width  {
			border-bottom: 1px solid #9ea2a2 !important;
		}

		.modal-footer-full-width  {
			border-top: 1px solid #9ea2a2 !important;
		}
		.my_drop_down_content{
			display: none;
			position: absolute;
			background-color: #f9f9f9;
			min-width: 160px;
			box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
			padding: 0;
			right:-100px;
			top:20px;
			z-index: 1;
		}
		.my_dropdown {
			position: relative;
			display: inline-block;
		}
		.my_dropdown:hover .my_drop_down_content {
			display: block;
		}
		h6{
			font-size: 15px !important;
		}
		.morecontent span {
			display: none;
		}
		.morelink {
			display: block;
		}
		#morelink {
			display: block;
		}
		
		
		.social_icon_temp{
			padding: 5px;
			font-size: 16px;
			color: #fff !important;
			width: 30px;
			height: 30px;
			border-radius: 50%;
			margin: auto;
			background-color: #4167b2 !important;
		}
		.align-button {
			text-align: center;
		}
		.fileuploader {
			width: 160px;
			height: 160px;
			margin: 15px;
			background: none !important;
		}
	</style>
	<body>
		<?php include_once 'header.php'; ?>
		<?php 
			$users_personal_row=getUsersPersonalData($_COOKIE['uid']);
		?>
		<div class="py-4">
			<div class="container" style="position:relative;">
				<div class="row">
				   <!-- Main Content -->
					<style>
						#progress-bar{
						  appearance:none;
						  width: 100%;
						  color: #000;
						  height: 2px;
						  margin: 0 auto;
						}
						.pp{
						  font-size: 12pt;
						  color: #000;
						  text-align: center;
						}
					</style>
					
				   <aside class="col col-xl-3 order-xl-1 col-lg-12 order-lg-1 col-12" id="left_side_bar" style="position:static;">
						<?php
							include_once 'user-profile-section.php';
						?>
						<div class="box mb-3 shadow-sm border rounded bg-white profile-box text-center">
							<?php
								$v_query="SELECT * FROM users_resume WHERE user_id='".$_COOKIE['uid']."' AND profile_type=1 AND is_default=1 ORDER BY id DESC";
								$v_result=mysqli_query($conn,$v_query);
								$video_num_rows=mysqli_num_rows($v_result);
								if($video_num_rows>0)
								{
									$v_row=mysqli_fetch_array($v_result);
									$resume_file='';
									if($v_row['file']!="" && $v_row['file']!=null)
									{
										$resume_file=base_url.$v_row['file'];
									}
									$resume_file_title=$v_row['file_title'];
									$profile_percentage=$profile_percentage+10;
									$profile_title=$v_row['profile_title'];
								}
							?>
							<div class="p-2 text-left border-bottom">
								<h6 class="font-weight-bold mb-0" style=" text-transform: uppercase; font-size: 14px !important; "><img src="img/videocv.png" style="cursor: pointer;width: 25px;margin-right: 5px;"> CV Maker 
									<a href="javascript:void(0);" class="float-right btn small btn-sm btn-dark title-action-btn my_dropdown" style="margin-left:5px;margin-top:5px;"><i class="feather-settings"></i>
										<div class="my_drop_down_content" style="border:3px solid #edf2f6;">
											<ul style="list-style:none;color:black;font-size:12px;text-align:left;margin:0;padding:10;text-transform: none;">
												<li style="text-align:left;border:1px solid gray;padding:3px;font-weight:bold;color:gray;" onclick="createDocCV();">Create CV</li>
												<li style="border-top:1px solid gray;margin-top:5px;margin-bottom:5px;"></li>
												<li style="text-align:left;border:1px solid gray;padding:3px;font-weight:bold;color:gray;" onclick="fileOpener();">Upload CV</li>
												<?php
													if($resume_file!="")
													{
														?>
														<li style="border-top:1px solid gray;margin-top:5px;margin-bottom:5px;"></li>
														<li style="text-align:left;border:1px solid gray;padding:3px;font-weight:bold;color:gray;" onclick="downloadFile('<?php echo $resume_file; ?>');">Download CV</li>
														<?php
													}
												?>
												
											</ul>
										</div>
									</a>
								</h6>
							</div>
							<div class="p-1">
								<form id="res_form_text_format" action="" method="post" enctype="multipart/form-data">
									<input type="file" accept=".doc,.docx,.pdf" name="res_form_text_format_file" id="res_form_text_format_file" style="display:none;">
								</form>
								<?php
									if($profile_title!="")
									{
										?>
										<p class="m-0 font-weight-normel" id="video_profile_title" style="font-weight:normal !important;margin-top:20px;"><?php echo $profile_title; ?></p>
										<?php
									}
									else
									{
										?>
										<p class="m-0 font-weight-normel" id="video_profile_title" style="font-weight:normal !important;margin-top:20px;">NA</p>
										<?php
									}
								?>
							</div>
							<script>
								function fileOpener()
								{
									document.getElementById("res_form_text_format_file").click();
								}
								$("#res_form_text_format_file").change(function(){
									if(confirm('File would be uploaded to server. do you wants to continue uploading?'))
									{
										$("#res_form_text_format").submit();
									}
								});
								function downloadFile(url)
								{
									var link = document.createElement('a');
									link.href = url;
									link.target = "_blank";
									document.body.appendChild(link);
									link.click(); 
									document.body.removeChild(link);
								}
							</script>
						</div>
						<div class="box shadow-sm border rounded bg-white mb-3 gallery-box-main">
							<div class="box-title border-bottom p-3">
								<h6 class="m-0">Gallery<a href="<?php echo base_url.'gallery'; ?>" class="small float-right">View All <i class="feather-chevron-right"></i></a></h6>
							</div>
							<div class="box-body">
								<div class="d-flex border-bottom align-button" style="width:100%;">
									<div class="col-12 px-3 py-2">
										<a href="javascript:void(0);" onclick="showProfessional();" style="color: #fff; background-color: #6fb4ff; padding: 5px 10px;" class="btn-primary">Personal</a>&nbsp;&nbsp;&nbsp;&nbsp;
										<a href="javascript:void(0);"  onclick="showPersonal();" style="color: rgb(29, 47, 56); padding: 5px 10px;" class="btn-warning" >Professional</a>
									</div>
								</div>
								<div style="width:100%;" id="professional_gallery">
									<div id="professional_data_matrix" style="width:100%;min-height:100px;">
										<?php
											$gquery="SELECT * FROM gallery WHERE is_professional=0 AND is_private=0 AND is_draft=0 AND user_id='".$_COOKIE['uid']."' AND type LIKE 'image/%' ORDER BY id DESC LIMIT 6";
											//echo $gquery;
											$gresult=mysqli_query($conn,$gquery);
											if(mysqli_num_rows($gresult)>0)
											{
												while($grow=mysqli_fetch_array($gresult))
												{
													if(is_file($grow['file']))
													{
														?>
														<img src="<?php echo base_url.$grow['file']; ?>">
														<?php
													}
												}
											}
											else
											{
												?>
												<div class="col-12 p-1" id="nothing_to_show_gallery_1">
													<div class="font-weight-bold p-2">
														<h6 style="text-align:center;font-size:14px;">Nothing to show.</h6>
													</div>
												</div>
												<?php
											}
										?>										
									</div>
								</div>
								<div class="" style="width:100%;display:none;" id="personal_gallery">
									<div id="personal_data_matrix" style="width:100%;min-height:100px;">
										<?php
											$gquery="SELECT * FROM gallery WHERE is_professional=1 AND is_private=0 AND is_draft=0 AND user_id='".$_COOKIE['uid']."' AND type LIKE 'image/%' ORDER BY id DESC LIMIT 6";
											$gresult=mysqli_query($conn,$gquery);
											if(mysqli_num_rows($gresult)>0)
											{
												while($grow=mysqli_fetch_array($gresult))
												{
													if(is_file($grow['file']))
													{
														?>
														<img src="<?php echo base_url.$grow['file']; ?>">
														<?php
													}
												}
											}
											else
											{
												?>
												<div class="col-12 p-1" id="nothing_to_show_gallery">
													<div class="font-weight-bold p-2">
														<h6 style="text-align:center;font-size:14px;">Nothing to show.</h6>
													</div>
												</div>
												<?php
											}
										?>
									</div>
								</div>
							</div>
						</div>
						
						<div class="modal fade amazing_contact_backdrop_modal" id="amazing_contact_backdrop_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="amazingContactBackdrop" aria-hidden="true">
							<div class="modal-dialog modal-md" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h6 class="modal-title" id="amazingContactBackdrop">Contact Details</h6>
									</div>
									<div class="modal-body">											
										<div class="p-2 d-flex" style="color:red;" id="contact_err"></div>
										<form id="user_contact_form" method="post" enctype="multipart/form-data">
											<div class="p-2 d-flex">
												<div class="col-3">
													<h6>Employer View</h6>
												</div>
												<div class="col-9">
													<input type="text" readonly="readonly" name="employer_view" id="employer_view" class="form-control" placeholder="Employer View" value="<?php echo base_url.'u/'.$user_row['username']; ?>">
												</div>
											</div>
											<div class="p-2 d-flex">
												<div class="col-3">
													<h6>Web View</h6>
												</div>
												<div class="col-9">
													<input type="text" readonly="readonly" name="web_view" id="web_view" class="form-control" placeholder="Web View" value="<?php echo base_url.'w/'.$user_row['username']; ?>">
												</div>
											</div>
											<div class="p-2 d-flex">
												<div class="col-3">
													<h6>Email*</h6>
												</div>
												<div class="col-9">
													<input type="email" name="communication_email" id="communication_email" class="form-control" required placeholder="Communication email" value="<?php echo $users_personal_row['communication_email']; ?>">
												</div>
											</div>
											<div class="p-2 d-flex">
												<div class="col-3">
													<h6>Mobile*</h6>
												</div>
												<div class="col-9">
													<input type="text" name="communication_mobile" id="communication_mobile" class="form-control" required placeholder="Communication mobile" value="<?php echo $users_personal_row['communication_mobile']; ?>">
												</div>
											</div>
											<div class="p-2 d-flex">
												<div class="col-3">
													<h6>Website</h6>
												</div>
												<div class="col-9">
													<input type="text" name="website" id="website" class="form-control" placeholder="Personal website if any." value="<?php echo $users_personal_row['website']; ?>">
												</div>
											</div>
											<div class="p-2 d-flex">
												<div class="col-3">
													<h6>Facebook</h6>
												</div>
												<div class="col-9">
													<input type="text" name="fb_p" id="fb_p" class="form-control" placeholder="Facebook Profile" value="<?php echo $users_personal_row['fb_p']; ?>">
												</div>
											</div>
											<div class="p-2 d-flex">
												<div class="col-3">
													<h6>Instagram</h6>
												</div>
												<div class="col-9">
													<input type="text" name="ig_p" id="ig_p" class="form-control" placeholder="Instagram Profile" value="<?php echo $users_personal_row['ig_p']; ?>">
												</div>
											</div>
											<div class="p-2 d-flex">
												<div class="col-3">
													<h6>Linkedin</h6>
												</div>
												<div class="col-9">
													<input type="text" name="in_p" id="in_p" class="form-control" placeholder="Linkedin Profile" value="<?php echo $users_personal_row['in_p']; ?>">
												</div>
											</div>
											<div class="p-2 d-flex">
												<div class="col-3">
													<h6>Twitter</h6>
												</div>
												<div class="col-9">
													<input type="text" name="tw_p" id="tw_p" class="form-control" placeholder="Twitter Profile" value="<?php echo $users_personal_row['tw_p']; ?>">
												</div>
											</div>
										</form>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<button type="button" class="btn btn-primary" onclick="saveContacts();">Save</button>
									</div>
								</div>
							</div>
						</div>
						<div class="box shadow-sm border rounded bg-white mb-3">
							<div class="box-title border-bottom p-3">
								<h6 class="m-0 font-weight-bold">Contact Details<a href="javascript:void(0);" onclick="getContacts();" title="Edit contact details" class="float-right btn small btn-sm btn-dark title-action-btn"><i class="feather-edit"></i></a></h6>
							</div>
							<div class="box-body">
								<div class="d-flex border-bottom align-button" style="width:100%;">
									<div class="col-12 px-3 py-2">
										<a href="<?php echo base_url; ?>w/<?php echo strtolower($user_row['username']); ?>" target="_blank" style="color: #fff; background-color: #6fb4ff; padding: 5px 10px;" class="btn-primary">Web View</a>&nbsp;&nbsp;&nbsp;&nbsp;
										<a href="<?php echo base_url; ?>u/<?php echo strtolower($user_row['username']); ?>" class="btn-warning" style="color: rgb(29, 47, 56); padding: 5px 10px;" >Profile View</a>
									</div>
								</div>
								<div class="p-3 contact-details-box">
								   <div>
										<div>
											<?php
												if($users_personal_row!=false)
												{
													if($users_personal_row['communication_email']!="" && $users_personal_row['communication_email']!=null){
											?>
													<!--<i class="feather-mail"></i>-->
														<p title="Email"> <i class="feather-mail"></i>
															<a href="mailto:<?php echo $users_personal_row['communication_email']; ?>" id="communication_email_html" target="_blank"><?php echo $users_personal_row['communication_email']; ?></a>
													</p>
													<?php
													}
													if($users_personal_row['communication_mobile']!="" && $users_personal_row['communication_mobile']!=null){
											?>
														<!--<i class="feather-phone"></i>-->
														<p class="text-truncate" title="Mobile">
														<i class="feather-smartphone"></i>
															<a href="tel:<?php echo $users_personal_row['communication_mobile']; ?>" target="_blank"><?php echo "(".$users_personal_row['phonecode'].") - ".$users_personal_row['communication_mobile']; ?></a>
													</p>
													<?php
													}
													if($users_personal_row['website']!="" && $users_personal_row['website']!=null){
											?>
													<!--<i class="feather-globe"></i>-->
														<p class="text-truncate mb-0" title="Website">
														<i class="feather-globe"></i>
															<a href="<?php echo $users_personal_row['website']; ?>" target="_blank"><?php echo $users_personal_row['website']; ?></a>
													</p>
													<?php
													}
													?>
											<?php
												}
												else
												{
													?>
													<div class="text-truncate" title="Mobile" style="font-size:11px !important;">
														<h6 style="font-size:12px;color:blue;">Nothing to show in contacts.</h6>
													</div>
													<?php
												}
											?>
										</div>
								   </div>
								</div>
								
								<?php
									$social_counts=0;
									$social_counts_arr=array();
									if($users_personal_row['fb_p']!="" && $users_personal_row['fb_p']!=null){
										$social_counts=$social_counts+1;
										$social_counts_arr[]=array($users_personal_row['fb_p'],"feather-facebook");
									}if($users_personal_row['ig_p']!="" && $users_personal_row['ig_p']!=null){
										$social_counts=$social_counts+1;
										$social_counts_arr[]=array($users_personal_row['ig_p'],"feather-instagram");
									}if($users_personal_row['tw_p']!="" && $users_personal_row['tw_p']!=null){
										$social_counts=$social_counts+1;
										$social_counts_arr[]=array($users_personal_row['tw_p'],"feather-twitter");
									}if($users_personal_row['in_p']!="" && $users_personal_row['in_p']!=null){
										$social_counts=$social_counts+1;
										$social_counts_arr[]=array($users_personal_row['in_p'],"feather-linkedin");
									}
									if($social_counts>0)
									{
										$col_width=12/$social_counts;
								?>
										<div class="d-flex text-center">
											<div class="col-3 border-right border-top p-2">
												<p class="mb-0 text-black-50 small text-center">
													<a class="font-weight-bold d-block text-center social_icon_temp" href="<?php 
													if($users_personal_row['fb_p']!="" && $users_personal_row['fb_p']!=null){
														echo $users_personal_row['fb_p'];
													}else{ echo 'javascript:void(0);'; }
												?>"  style="font-size:20px;"><i class="fa fa-facebook"></i></a></p><!--feather-facebook-->
											</div>
											<div class="col-3 border-right border-top p-2">
											   <p class="mb-0 text-black-50 small text-center"><a class="font-weight-bold d-block text-center social_icon_temp" href="<?php 
													if($users_personal_row['ig_p']!="" && $users_personal_row['ig_p']!=null){
														echo $users_personal_row['ig_p'];
													}else{ echo 'javascript:void(0);'; }
												?>" style="font-size:20px;background-color:#cf2217 !important;"><i class="fa fa-instagram"></i></a></p><!--feather-instagram-->
											</div>
											<div class="col-3 border-right border-top p-2">
											   <p class="mb-0 text-black-50 small text-center"><a class="font-weight-bold d-block text-center social_icon_temp" href="<?php 
													if($users_personal_row['tw_p']!="" && $users_personal_row['tw_p']!=null){
														echo $users_personal_row['tw_p'];
													}else{ echo 'javascript:void(0);'; }
												?>" style="font-size:20px;background-color:#00b7d6 !important;"><i class="fa fa-twitter"></i></a></p><!--feather-twitter-->
											</div>
											<div class="col-3 border-top p-2">
											   <p class="mb-0 text-black-50 small text-center"><a class="font-weight-bold d-block text-center social_icon_temp" href="<?php 
													if($users_personal_row['in_p']!="" && $users_personal_row['in_p']!=null){
														echo $users_personal_row['in_p'];
													}else{ echo 'javascript:void(0);'; }
												?>" style="font-size:20px;background-color|:#0281ac !important"><i class="fa fa-linkedin"></i></a></p><!--feather-linkedin-->
											</div>
										</div>
										<!--<div class="d-flex">
											<?php
												/*for($i=0;$i<$social_counts;$i++)
												{
													?>
													<div class="col-<?php echo $col_width; ?> border-right border-top p-1">
													   <p class="mb-0 text-black-50 small"><a class="font-weight-bold d-block" href="<?php echo $social_counts_arr[$i][0]; ?>" target="_blank" style="font-size:16px;"><i class="<?php echo $social_counts_arr[$i][1]; ?>"></i></a></p>
													</div>
													<?php
												}\*/
											?>
										</div>-->
								<?php
									}
									else
									{
										?>
										<div class="d-flex text-center">
											<div class="col-3 border-right border-top p-2">
											   <p class="mb-0 text-black-50 small text-center"><a class="font-weight-bold d-block text-center social_icon_temp" href="javascript:void(0);" style="font-size:20px;"><i class="fa fa-facebook"></i></a></p>
											</div>
											<div class="col-3 border-right border-top p-2">
											   <p class="mb-0 text-black-50 small text-center"><a class="font-weight-bold d-block text-center social_icon_temp" href="javascript:void(0);"  style="font-size:20px;background-color:#cf2217 !important;"><i class="fa fa-instagram"></i></a></p>
											</div>
											<div class="col-3 border-right border-top p-2">
											   <p class="mb-0 text-black-50 small text-center"><a class="font-weight-bold d-block text-center social_icon_temp" href="javascript:void(0);" style="font-size:20px;background-color:#00b7d6 !important;"><i class="fa fa-twitter"></i></a></p>
											</div>
											<div class="col-3 border-top p-2">
											   <p class="mb-0 text-black-50 small text-center"><a class="font-weight-bold d-block text-center social_icon_temp" href="javascript:void(0);" style="font-size:20px;background-color|:#0281ac !important;"><i class="fa fa-linkedin"></i></a></p>
											</div>
										</div>
										<?php
									}
								?>
							</div>
						</div>
						<div class="box shadow-sm border rounded bg-white mb-3 skills-boxs">
							<div class="box-title border-bottom p-3">
								<h6 class="m-0 font-weight-bold">Skills<a href="javascript:void(0);" onclick="getSkills();" title="Manage Skills" class="float-right btn small btn-sm btn-dark title-action-btn"><i class="feather-edit"></i></a></h6>
							</div>
							<div class="box-body">
								<?php
									$skills_query="SELECT * FROM users_skills WHERE user_id='".$user_id."' AND status=1 ORDER BY proficiency DESC LIMIT 0,5";
									$skills_result=mysqli_query($conn,$skills_query);
									if(mysqli_num_rows($skills_result)>0)
									{
										while($skills_row=mysqli_fetch_array($skills_result))
										{
											$skillMeterHtml="";
											$skillMeterTitle="";
											if(((int)($skills_row['proficiency']))<=33)
											{
												$skillMeterHtml='<span class="badge badge-danger ml-1" style="border: 2px solid red;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-dark ml-1" style="color: #f54295 !important;background-color: #fff !important;border: 2px solid #343a40 !important;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-dark ml-1" style="color: #343a40 !important;background-color: #fff !important;border: 2px solid #343a40 !important;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span>';
												$skillMeterTitle="Basic";
											}
											else if(((int)($skills_row['proficiency']))<=66)
											{
												$skillMeterHtml='<span class="badge badge-warning ml-1" style="border: 2px solid #dbb716;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-warning ml-1" style="border: 2px solid #dbb716;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-dark ml-1" style="color: #343a40 !important;background-color: #fff !important;border: 2px solid #343a40 !important;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span>';
												$skillMeterTitle="Proficient";
											}
											else if(((int)($skills_row['proficiency']))<=100)
											{
												$skillMeterHtml='<span class="badge badge-success ml-1" style="border: 2px solid #00c9a7;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-success ml-1" style="border: 2px solid #00c9a7;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-success ml-1" style="border: 2px solid #00c9a7;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span>';
												$skillMeterTitle="Expert";
											}
											//$htmlData.=$skillMeterHtml;
								?>			
											<div class="d-flex" style="width:100%;">
											   <div class="col-12 border-right border-top p-1">
												   <div class="font-weight-bold">
													  <div class="text-truncate" style="font-size:10px !important;"><span style="min-width:70% !important;"><?php echo ucfirst(strtolower($skills_row['title'])); ?></span><span style="max-width:30% !important;float:right !important;" title="<?php echo $skillMeterTitle; ?>"><?php echo $skillMeterHtml; ?></span></div>
												   </div>
											   </div>
											</div>
								<?php
										}
									}
								?>
							</div>
							<div class="modal fade skills_modal_opner" id="skills_modal_opner" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="amazingSkillsBackdrop" aria-hidden="true">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h6 class="modal-title" id="amazingSkillsBackdrop">Skills are boosters of your profile selections</h6>
										</div>
										<div class="modal-body">											
											<div class="row">
												<div class="col-md-12" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);transition: box-shadow 83ms;background:#fff;padding:10px;margin: 0 0px 10px;border-radius:2px;">
													<h6>Manage Skills <a href="javascript:void(0);" style="float:right;margin-right:30px;" class="add_button" title="Add field"><i class="fa fa-plus" style="font-size:20px;"></i></a></h6>
												</div>
												<div class="col-md-12">
													<div class="row value_wrapper" style="margin-top:25px;">
														<?php
															$query="SELECT * FROM users_skills WHERE status=1 AND user_id='$user_id' ORDER BY proficiency DESC";
															$result=mysqli_query($conn,$query);
															$response['status']='success';
															$htmlData="";
															if(mysqli_num_rows($result)>0)
															{
																while($row=mysqli_fetch_array($result))
																{
																	
																	$htmlData=$htmlData."<div class='col-md-6' style='margin-bottom:15px;border:1px solid gray;border-radius:10px;height:30px;max-width:48%;margin-right:1%;'><div class='row' style='margin-top:5px;'>";
																	$htmlData.="<div class='col-md-7'><h6 style='font-size:14px;' class='text-truncate'>".ucfirst(strtolower($row['title']))."</h6></div>";
																	$htmlData.="<div class='col-md-3'><h6 style='font-size:12px;'>";
																	if(((int)($row['proficiency']))<=33)
																	{
																		$htmlData.='<span class="badge badge-danger ml-1" style="border: 2px solid red;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-dark ml-1" style="color: #f54295 !important;background-color: #fff !important;border: 2px solid #343a40 !important;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-dark ml-1" style="color: #343a40 !important;background-color: #fff !important;border: 2px solid #343a40 !important;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span>';
																		$skillMeterTitle="Basic";
																	}
																	else if(((int)($row['proficiency']))<=66)
																	{
																		$htmlData.='<span class="badge badge-warning ml-1" style="border: 2px solid #dbb716;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-warning ml-1" style="border: 2px solid #dbb716;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-dark ml-1" style="color: #343a40 !important;background-color: #fff !important;border: 2px solid #343a40 !important;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span>';
																		$skillMeterTitle="Proficient";
																	}
																	else if(((int)($row['proficiency']))<=100)
																	{
																		$htmlData.='<span class="badge badge-success ml-1" style="border: 2px solid #00c9a7;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-success ml-1" style="border: 2px solid #00c9a7;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-success ml-1" style="border: 2px solid #00c9a7;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span>';
																		$skillMeterTitle="Expert";
																	}
																	
																	/*if(((int)($row['proficiency']))<=33)
																	{
																		$htmlData.=$skillMeterHtml;
																	}
																	else if(((int)($row['proficiency']))<=66)
																	{
																		$htmlData.=$skillMeterHtml;
																	}
																	else if(((int)($row['proficiency']))<=100)
																	{
																		$htmlData.=$skillMeterHtml;
																	}*/
																	$htmlData.="</h6></div>";
																	$htmlData.="<div class='col-md-2'><h6><a href='javascript:void(0);' title='Remove' class='remove_skill' onclick='removeSkills(".$row['id'].");' style='text-decoration:none;'><i class='fa fa-trash' style='font-size:16px;color:red;'></i></a></h6></div>";
																	$htmlData.="</div></div>";
																}
																$htmlData.="<script>
																	var base_url=localStorage.getItem('base_url');
																	function removeSkills(skill_id){
																		if(skill_id!=='')
																		{
																			$.ajax({
																				url:base_url+'removeskills',
																				type:'post',
																				data:{skill_id:skill_id},
																				success:function(data)
																				{
																					var parsedJson=JSON.parse(data);
																					if(parsedJson.status=='success')
																					{
																						$('.value_wrapper').html(parsedJson.htmlData);
																					}
																				}
																			});
																		}
																	}
																	</script>";
															}
															else
															{
																$htmlData="<div class='col-md-12'><h6 style='text-align:center;'>No Skills has been added yet.</h6></div>";
															}
															echo $htmlData;
														?>
													</div>	
												</div>
												<div class="col-md-12 field_wrapper">
													
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" onclick="reloadPage();">Close</button>
										</div>
									</div>
								</div>
							</div>
						
						</div>
						
						<div class="modal fade interests_modal_opner" id="interests_modal_opner" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="amazingInterestsBackdrop" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h6 class="modal-title" id="amazingInterestsBackdrop">Manage Interests</h6>
									</div>
									<div class="modal-body">											
										<div class="row">
											<div class="col-md-12" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);transition: box-shadow 83ms;background:#fff;padding:10px;margin: 0 0px 10px;border-radius:2px;">
												<h6>Interests <a href="javascript:void(0);" style="float:right;margin-right:30px;" class="add_button_1" title="Add field"><i class="fa fa-plus" style="font-size:20px;"></i></a></h6>
											</div>
											<div class="col-md-12">
												<div class="row value_wrapper_1" style="margin-top:25px;">
													<?php
														$query="SELECT * FROM users_interests WHERE user_id='$user_id'";
														$result=mysqli_query($conn,$query);
														$response['status']='success';
														$htmlData="";
														if(mysqli_num_rows($result)>0)
														{
															while($row=mysqli_fetch_array($result))
															{
																$htmlData=$htmlData."<div class='col-md-6' style='margin-bottom:15px;border:1px solid gray;border-radius:10px;height:30px;max-width:48%;margin-right:1%;'><div class='row' style='margin-top:5px;'>";
																$htmlData.="<div class='col-md-10'><h6 style='font-size:14px;'>".$row['title']."</h6></div>";
																
																$htmlData.="<div class='col-md-2'><h6><a href='javascript:void(0);' title='Remove' class='remove_skill' onclick='removeInterests(".$row['id'].");' style='text-decoration:none;'><i class='fa fa-minus' style='font-size:20px;'></i></a></h6></div>";
																$htmlData.="</div></div>";
															}
															$htmlData.="<script>
																var base_url=localStorage.getItem('base_url');
																function removeInterests(interest_id){
																	if(interest_id!=='')
																	{
																		$.ajax({
																			url:base_url+'removeinterests',
																			type:'post',
																			data:{interest_id:interest_id},
																			success:function(data)
																			{
																				var parsedJson=JSON.parse(data);
																				if(parsedJson.status=='success')
																				{
																					$('.value_wrapper_1').html(parsedJson.htmlData);
																				}
																			}
																		});
																	}
																}
																</script>";
														}
														else
														{
															$htmlData="<div class='col-md-12'><h6 style='text-align:center;'>No Interests has been added yet.</h6></div>";
														}
														echo $htmlData;
													?>
												</div>	
											</div>
											<div class="col-md-12 field_wrapper_1">
												
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" onclick="reloadPage();">Close</button>
									</div>
								</div>
							</div>
						</div>
						
						<div class="box shadow-sm border rounded bg-white mb-3 is_stuck" id="left_sidebar_interests" style="margin-bottom:150px;">
							<div class="box-title border-bottom p-3">
								<h6 class="m-0 font-weight-bold">Interests<a href="javascript:void(0);" onclick="getInterests();" title="Manage Interests" class="float-right btn small btn-sm btn-dark title-action-btn"><i class="feather-edit"></i></a></h6>
							</div>
							<div class="box-body p-3">	
								<?php
									$query="SELECT * FROM users_interests WHERE user_id='$user_id' LIMIT 0,5";
									$result=mysqli_query($conn,$query);
									if(mysqli_num_rows($result)>0)
									{
										$profile_percentage=$profile_percentage+10;
										while($row=mysqli_fetch_array($result))
										{
										?>
										<div class="interests-tag">
										<?php echo $row['title']; ?>
										</div>
										<?php
										}
									}
									else
									{
										?>
										<div class="d-flex" style="width:100%;">
										   <div class="col-12 p-1">
											   <div class="font-weight-bold">
												  <div class="text-truncate" style="font-size:12px !important;">nothing to show.</div>
											   </div>
										   </div>
										</div>
										<?php
									}
								?>
							</div>
						</div>
					</aside>
					<main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-2 col-md-12 col-sm-12 col-12">
						<div class="box shadow-sm border rounded bg-white mb-3">
							<div class="box-title border-bottom p-3">
								<h6 class="m-0 font-weight-bold">About You<a href="javascript:void(0);" data-toggle="modal" data-target="#amazing_about_backdrop_modal" class="float-right btn small btn-sm btn-dark title-action-btn"><i class="feather-edit"></i></a></h6>
							</div>
							<div class="box-body p-3">
								<?php if($users_personal_row!=false) { echo '<p class="more" id="amazing_about_you_text" style="font-size:14px !important;text-align:justify;">'.trim(filter_var(htmlspecialchars_decode($users_personal_row['about']),FILTER_SANITIZE_STRING)).'</p>'; } else { echo '<p id="amazing_about_you_text" class="more" style="font-size:14px !important;text-align:justify;">Your about information will be apear here when you provide.</p>'; } ?>
							</div>
						</div>
						<div class="modal fade amazing_about_backdrop_modal" id="amazing_about_backdrop_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="amazingAboutInformation" aria-hidden="true">
							<div class="modal-dialog modal-md" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="amazingAboutInformation">Something amazing about you</h5>
									</div>
									<div class="modal-body">
										<div class="p-2 d-flex" style="max-height:20px;min-height:1px;">
											<div style="font-size:10px;min-width:100% !important;color:red;" id="amazing_about_you_error"></div>
										</div>
										<div class="p-2 d-flex">
											<textarea class="form-control" name="amazing_about_you" id="amazing_about_you" style="width:100%;resize:none;" rows="10"><?php echo trim(filter_var(strip_tags($users_personal_row['about']),FILTER_SANITIZE_STRING)); ?></textarea>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<button type="button" onclick="saveAboutYou('amazing_about_you_text');" class="btn btn-primary">Save</button>
									</div>
								</div>
							</div>
						</div>
						<div class="box shadow-sm border rounded bg-white mb-3 experiences-box">
							<div class="box-title border-bottom p-3">
								<h6 class="m-0 font-weight-bold">Experiences <a class="float-right btn small btn-sm btn-dark title-action-btn" onclick="getExperience();" title="Add New Experience" href="javascript:void(0);"><i class="feather-plus-circle"></i></a></h6>
							</div>
							<div class="box-body" id="experience_data_matrix">
							<?php
								$experience_query="SELECT * FROM users_work_experience WHERE user_id='$user_id' AND status=1 ORDER BY from_year DESC";
								$experience_result=mysqli_query($conn,$experience_query);
								if(mysqli_num_rows($experience_result)>0)
								{
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
										<div class="box-body p-3 border-bottom" id="work_exp_<?php echo $experience_id; ?>">
											<div class="d-flex align-items-top job-item-header pb-2">
											   <div class="mr-2">
												  <h6 class="font-weight-bold text-dark mb-0" style="font-weight:normal !important;margin-bottom:5px !important;"><?php echo ucfirst(strtolower($experience_row['title'])); ?>&nbsp;&nbsp;<a data-toggle="tooltip" data-placement="top" title="Edit" class="text-primary action-btn edit-btn" onclick="getExperience('<?php echo $experience_id; ?>');" href="javascript:void(0);"><i class="feather-edit"></i></a>&nbsp;&nbsp;<a class="text-danger action-btn delete-btn" data-toggle="tooltip" data-placement="top" title="Delete" onclick="deleteExperience('<?php echo $experience_id; ?>');" href="javascript:void(0);"><i class="feather-trash-2"></i></a></h6>
												  <div class="text-truncate text-primary" style="margin-bottom:4px;"><?php echo ucfirst(strtolower($experience_row['company'])); ?></div>
												  <div class="small text-gray-500"><?php echo print_month($experience_row['from_month'])." ".$experience_row['from_year']; ?>  to <?php if($experience_row['working']=="1"){ echo "Present"; } else { echo print_month($experience_row['to_month'])." ".$experience_row['to_year']; } ?></div>
											   </div>
											   <img class="img-fluid ml-auto mb-auto" src="<?php echo base_url; ?>alphas/<?php echo substr(strtolower($experience_row['company']),0,1).".png"; ?>" alt="">
											</div>
											<p class="mb-0 more">
												<?php
													if($experience_row['description']==""){
														echo "<b>".ucfirst(strtolower($experience_row['title']))."</b> at <b>".ucfirst(strtolower($experience_row['company']))."</b> in <b>".ucfirst(strtolower($city_row['title'])).", ".ucfirst(strtolower($country_row['title']))."</b> from <b>".print_month($experience_row['from_month'])." ".$experience_row['from_year']."</b> to <b>";
														if($experience_row['working']=="1"){ echo "Present</b>."; } else { echo print_month($experience_row['to_month'])." ".$experience_row['to_year']."</b>."; }
													}
													else
													{
														echo ucfirst(strtolower($experience_row['description']));
													}
												?>
											</p>
										</div>
									<?php
									}
								}
								else
								{
									?>
									<div class="box-body p-3 border-bottom" id="nothing_to_show_exp">
										<div class="d-flex align-items-top job-item-header pb-2">
											<div class="col-12 p-1">
												<div class="font-weight-bold p-2">
													<h6 style="text-align:center;">There is no data to show.</h6>
												</div>
											</div>
										</div>
									</div>
									<?php
								}
							?>
							</div>
							<div class="modal fade experience_form_modal" id="experience_form_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="amazingExperienceModal" aria-hidden="true">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h6 style="font-size:14px;" class="modal-title" id="amazingExperienceModal">Experiences tells loudly about you to recruiter</h6>
										</div>
										<div class="modal-body">
											<div class="row">
												<div class="col-md-12 col-lg-12 col-12" id="experience_form">
												
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" onclick="$('#experience_form').html('');" data-dismiss="modal">Close</button>
											<button type="button" onclick="saveExperience();" class="btn btn-primary">Save</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="box shadow-sm border rounded bg-white mb-3 education-box">
							<div class="box-title border-bottom p-3">
								<h6 class="m-0 font-weight-bold">Education<a class="float-right btn small btn-sm btn-dark title-action-btn" onclick="getEducation();" title="Add New Experience" href="javascript:void(0);"><i class="feather-plus-circle"></i></a></h6>
							</div>
							<div class="box-body" id="educational_data_matrix">
								<?php
									$education_query="SELECT * FROM users_education WHERE user_id='$user_id' AND status=1 ORDER BY from_year DESC";
									$education_result=mysqli_query($conn,$education_query);
									//echo $education_query;
									if(mysqli_num_rows($education_result)>0)
									{
										while($education_row=mysqli_fetch_array($education_result))
										{
											$education_id=$education_row['id'];
											$country_query="SELECT title FROM country WHERE id='".$education_row['country']."'";
											$country_result=mysqli_query($conn,$country_query);
											$country_row=mysqli_fetch_array($country_result);
											
											$city_query="SELECT title FROM city WHERE id='".$education_row['city']."'";
											$city_result=mysqli_query($conn,$city_query);
											$city_row=mysqli_fetch_array($city_result);
								?>
										<div class="box-body p-3 border-bottom" id="edu_<?php echo $education_id; ?>">
											<div class="d-flex align-items-top job-item-header pb-2">
											   <div class="mr-2">
												  <h6 class="font-weight-bold text-dark mb-0" style="font-weight:normal !important;margin-bottom:5px !important;"><?php echo ucfirst(strtolower($education_row['university'])); ?>&nbsp;&nbsp;<a class="text-primary action-btn edit-btn" data-toggle="tooltip" data-placement="top" title="Edit" onclick="getEducation('<?php echo $education_id; ?>');" href="javascript:void(0);"><i class="feather-edit"></i></a>&nbsp;&nbsp;<a class="text-danger action-btn delete-btn" data-toggle="tooltip" data-placement="top" title="Delete" onclick="deleteEducation('<?php echo $education_id; ?>');" href="javascript:void(0);"><i class="feather-trash-2"></i></a></h6>
												  <div class="text-truncate text-primary" style="margin-bottom:4px;"><?php echo ucfirst(strtolower($education_row['title'])); ?></div>
												  <div class="small text-gray-500"><?php echo print_month($education_row['from_month'])." ".$education_row['from_year']; ?>  to <?php if($education_row['studying']=="1"){ echo "Present"; } else { echo print_month($education_row['to_month'])." ".$education_row['to_year']; } ?>  </div>
											   </div>
											   <img class="img-fluid ml-auto mb-auto" src="<?php echo base_url; ?>alphas/<?php echo substr(strtolower($education_row['university']),0,1).".png"; ?>" alt="">
											</div>
											<p class="mb-0 more">
												<?php 
													if($education_row['description']==""){
														echo "<b>".ucfirst(strtolower($education_row['title']))."</b> in <b>".ucfirst(strtolower($education_row['major']))."</b> at <b>".ucfirst(strtolower($education_row['university']))."</b> in <b>".ucfirst(strtolower($city_row['title'])).", ".ucfirst(strtolower($country_row['title']))."</b> from <b>".print_month($education_row['from_month'])." ".$education_row['from_year']."</b> to <b>";
														if($education_row['studying']=="1"){ echo "Present</b>."; } else { echo print_month($education_row['to_month'])." ".$education_row['to_year']."</b>."; }
													}
													else
													{
														echo ucfirst(strtolower($education_row['description']));
													}
												?>
											</p>
										</div>
								<?php
										}
									}
									else{
										?>
											<div class="box-body p-3 border-bottom" id="nothing_to_show_edu">
												<div class="d-flex align-items-top job-item-header pb-2">
													<div class="col-12 p-1">
														<div class="font-weight-bold p-2">
															<h6 style="text-align:center;">Nothing to show.</h6>
														</div>
													</div>
												</div>
											</div>
										<?php
									}
								?>
							</div>	
							<div class="modal fade education_form_modal" id="education_form_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="amazingEducationModal" aria-hidden="true">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h6 style="font-size:14px;" class="modal-title" id="amazingEducationModal">Education tells recruiter about your preparations.</h6>
										</div>
										<div class="modal-body">
											<div class="row">
												<div class="col-md-12 col-lg-12 col-12" id="education_form">
												
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" onclick="$('#education_form').html('');" data-dismiss="modal">Close</button>
											<button type="button" onclick="saveEducation();" class="btn btn-primary">Save</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php
							$awards_query="SELECT * FROM users_awards WHERE status=1 AND user_id='".$_COOKIE['uid']."'";
							$awards_result=mysqli_query($conn,$awards_query);
						?>
						<div class="box shadow-sm border rounded bg-white mb-3 achievements-box">
							<div class="box-title border-bottom p-3">
								<h6 class="m-0 font-weight-bold">Achievements<a class="float-right btn small btn-sm btn-dark title-action-btn" onclick="getAward();" title="Add New Achievement" href="javascript:void(0);"><i class="feather-plus-circle"></i></a></h6>
							</div>
							<div class="box-body" id="award_data_matrix">	
								<?php
									if(mysqli_num_rows($awards_result)>0)
									{
										$profile_percentage=$profile_percentage+10;
										while($awards_row=mysqli_fetch_array($awards_result))
										{
											$award_id=$awards_row['id'];
								?>
										<div class="d-flex border-bottom p-3" style="width:100%;" id="award_<?php echo $award_id; ?>">
											<?php
												if($awards_row['image']!="" && $awards_row['image']!=null)
												{
													$image=base_url.$awards_row['image'];
											?>
													<div class="col-3 pl-0 pr-3">
														<img class="img-fluid rounded border w-100" src="<?php echo $image; ?>" alt="<?php echo ucfirst(strtolower($awards_row['title'])); ?>">
													</div>
											<?php
												}
											?>
											<div class="col-9 px-0 col-<?php if($awards_row['image']!="" && $awards_row['image']!=null){ echo "9"; }else { echo "12"; } ?>">
												<h6 class="mb-1 f-15"><?php echo ucfirst(strtolower($awards_row['title'])); ?><span style="float: right !important;">&nbsp;&nbsp;<a class="text-primary action-btn edit-btn" data-toggle="tooltip" data-placement="top" title="Edit" onclick="getAward('<?php echo $award_id; ?>');" href="javascript:void(0);"><i class="feather-edit"></i></a>&nbsp;&nbsp;<a class="text-danger action-btn delete-btn" data-toggle="tooltip" data-placement="top" title="Delete" onclick="deleteAward('<?php echo $award_id; ?>');" href="javascript:void(0);"><i class="feather-trash-2"></i></a></span></h6>
												<p class="m-0"><?php echo ucfirst(strtolower($awards_row['description'])); ?></p>
											</div>
										</div>
								<?php
										}
									}
									else
									{
										?>
										<div class="d-flex border-bottom" style="width:100%;" id="nothing_to_show_award">
											<div class="col-12 p-3">
												<h6 class="m-0" style="text-align:center;">Nothing to show.</h6>
											</div>
										</div>
										<?php
									}
								?>
							</div>
							<div class="modal fade award_form_modal" id="award_form_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="amazingAwardModal" aria-hidden="true">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h6 style="font-size:14px;" class="modal-title" id="amazingAwardModal">Achievements are to tell recruiters about your capabilities</h6>
										</div>
										<div class="modal-body">
											<div class="row">
												<div class="col-md-12 col-lg-12 col-12" id="award_form">
												
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" onclick="$('#award_form').html('');" data-dismiss="modal">Close</button>
											<button type="button" onclick="saveAward();" class="btn btn-primary">Save</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="box shadow-sm border rounded bg-white mb-3">
							<div class="box-title border-bottom p-3">
								<h6 class="m-0 font-weight-bold">Influencers Following</h6>
							</div>
							<div class="box-body">
								<?php
									$follower_query="SELECT * FROM users_followers WHERE status=1 AND follower_id='".$_COOKIE['uid']."' AND type=1";
									$follower_result=mysqli_query($conn,$follower_query);
									//echo $follower_query;
									if(mysqli_num_rows($follower_result)>0)
									{
										?>
										<div class="mb-3 shadow-sm rounded box bg-white osahan-slider-main">
											<div class="osahan-slider">
											<?php
												while($follower_row=mysqli_fetch_array($follower_result))
												{
													$influencer_id=$follower_row['user_id'];
													$follower_data=getUsersData($influencer_id);
													$follower_data_personal=getUsersPersonalData($influencer_id);
													?>
													<div class="osahan-slider-item">
														<a href="<?php echo base_url."u/".$follower_data['username']; ?>">
															<div class="shadow-sm border rounded bg-white job-item job-item mr-2 mt-3 mb-3">
																<div class="d-flex align-items-center p-3 job-item-header">
																	<img class="img-fluid img-responsive" src="<?php echo getUserProfileImage($influencer_id); ?>" alt="" style="border:1px solid #eaebec !important;padding: 2px;border-radius: 7px;width:50px;height:50px;border-radius:50%;">
																	<div class="overflow-hidden p-1">
																		<h6 class="font-weight-bold text-dark mb-0 text-truncate" style="font-size:12px;font-weight:normal !important;"><?php echo ucfirst(strtolower($follower_data['first_name']))." ".ucfirst(strtolower($follower_data['last_name'])); ?></h6>
																		<div class="text-truncate text-primary"><?php echo ucfirst(strtolower($follower_data['profile_title'])); ?></div>
																		<?php
																			if($follower_data_personal!=false)
																			{
																	   ?>
																				<div class="small text-gray-500"><i class="feather-map-pin"></i> <?php echo getCityByID(ucfirst(strtolower($follower_data_personal['home_town']))).", ".ucfirst(strtolower(getCountryByID($follower_data_personal['country']))); ?></div>
																		<?php
																			}
																		?>
																	</div>
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
									else
									{
										?>
										<div class="d-flex" style="width:100%;">
											<div class="col-12 py-2 px-3">
												<h6 class="m-0" style="text-align:center;">Nothing to show.</h6>
											</div>
										</div>
										<?php
									}
								?>
							</div>
						</div>
						<div class="box shadow-sm border rounded bg-white mb-3 recommendations-box">
							<div class="box-title border-bottom p-3">
								<h6 class="m-0 font-weight-bold">Recommendations<a href="javascript:void(0);" onclick="askForRecommendation();" class="float-right small btn-sm btn btn-warning" style="margin: -5px 0 0 0;">Ask for recommendation</a></h6>
							</div>
							<div class="box-body">
								<?php
									$r_query_1="SELECT * FROM recommendations WHERE r_user_id='$user_id' ORDER BY added ASC";
									$r_result_1=mysqli_query($conn,$r_query_1);
									
									$r_query="SELECT * FROM recommendations WHERE user_id='$user_id' AND status!=2 ORDER BY status DESC";
									$r_result=mysqli_query($conn,$r_query);
								?>
								<div class="d-flex border-bottom" style="width:100%;">
									<div class="col-12 px-3 py-2">
										<a href="javascript:void(0);" id="rr_anchor" onclick="showReceivedRec();">Received (<?php echo mysqli_num_rows($r_result); ?>)</a>
										&nbsp;&nbsp;
										<a href="javascript:void(0);" id="gr_anchor" onclick="showGivenRec();" style="color:black;">Given (<?php echo mysqli_num_rows($r_result_1); ?>)</a>
									</div>
								</div>
								<div style="width:100%;" id="received_recommendations">
									<div id="recommendation_data_matrix" style="width:100%;">
									<?php
										if(mysqli_num_rows($r_result))
										{
											$i=1;
											while($r_row=mysqli_fetch_array($r_result))
											{
												$user_data_r=getUsersData($r_row['r_user_id']);
												$data='<div class="d-flex border-bottom p-3" style="width:100%;" id="rec_'.$r_row['id'].'">
													<div class="col-2 pl-0 pr-3">
														<img class="img-fluid" style="width:100% !important;border-radius: 50%;" src="'.getUserProfileImage($r_row['r_user_id']).'">
													</div>
													<div class="col-10 px-0">
														<h6 class="mb-1">'.ucfirst(strtolower($user_data_r['first_name'].' '.$user_data_r['last_name'])).' - ';
														if($r_row['status']=="0")
														{
															$data=$data.'<span class="badge badge-danger">Pending</span>';
															$data=$data.'<span style="float: right !important;">&nbsp;&nbsp;<a class="text-danger action-btn delete-btn" data-toggle="tooltip" data-placement="top" title="Delete" onclick="deleteRec('.$r_row['id'].');" href="javascript:void(0);"><i class="feather-trash-2"></i></a></span></h6>
																	<p class="m-0">'.ucfirst(strtolower($r_row['custom_message'])).'</p>';
														}
														else
														{
															$data=$data.'<span class="badge badge-success">Active</span>';
															$data=$data.'<span style="float: right !important;">&nbsp;&nbsp;<a class="text-danger action-btn delete-btn" data-toggle="tooltip" data-placement="top" title="Delete" onclick="deleteRec('.$r_row['id'].');" href="javascript:void(0);"><i class="feather-trash-2"></i></a></span></h6>
																	<p class="m-0" id="received_rec_'.$i++.'">'.ucfirst(strtolower($r_row['r_text'])).'</p>';
														}
												$data=$data.'</div></div>';
														
												echo $data;
											}
										}
										else
										{
											?>
											<div class="col-12 p-1" id="nothing_to_show_rec">
												<div class="font-weight-bold p-2">
													<h6 style="text-align:center;font-size:14px;">Nothing to show.</h6>
												</div>
											</div>
											<?php
										}
									?>
									</div>
								</div>
								<div class="" style="width:100%;display:none;" id="given_recommendations">
									<div id="recommendation_data_matrix_1" style="width:100%;">
										<?php
											if(mysqli_num_rows($r_result_1))
											{
												while($r_row=mysqli_fetch_array($r_result_1))
												{
													$user_data_r=getUsersData($r_row['user_id']);
													$data='<div class="d-flex border-bottom" style="width:100%;" id="rec_'.$r_row['id'].'">
														<div class="col-3 border-right border-top p-1">
															<img class="img-fluid" style="border:1px solid gray;width:100% !important;border-radius: 50%;" src="'.getUserProfileImage($r_row['user_id']).'">
														</div>
														<div class="col-9 border-top p-1">
															<h6 class="m-0" style="text-align:center;font-size:14px;font-weight:normal !important;">'.ucfirst(strtolower($user_data_r['first_name'].' '.$user_data_r['last_name'])).'';
															$data=$data.'';
															$data=$data.'<span style="float: right !important;">&nbsp;&nbsp;<a class="text-danger action-btn delete-btn" data-toggle="tooltip" data-placement="top" title="Delete" onclick="deleteRec('.$r_row['id'].');" href="javascript:void(0);"><i class="feather-trash-2"></i></a></span></h6>
																	<p class="mt-1 p-1">'.ucfirst(strtolower($r_row['r_text'])).'</p>
																</div>
															</div>';
															
													echo $data;
												}
											}
											else
											{
												?>
												<div class="col-12 p-1" id="nothing_to_show_rec_1">
													<div class="font-weight-bold p-2">
														<h6 style="text-align:center;font-size:14px;font-weight:normal !important;">Nothing to show.</h6>
													</div>
												</div>
												<?php
											}
										?>
									</div>
								</div>
							</div>
						</div>
						<div class="modal fade ask_for_recommendation_modal" id="ask_for_recommendation_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="amazingRecModal" aria-hidden="true">
							<div class="modal-dialog modal-md" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h6 style="font-size:14px;" class="modal-title" id="amazingRecModal">Ask for a recommendation</h6>
									</div>
									<div class="modal-body">
										<div class="row">
											<input type="hidden" name="choosen_user" id="choosen_user" value="">
											<div class="col-md-12 col-lg-12 col-12" id="ask_rec_form">
												<div id="rec_error" style="text-align:center;color:red;"></div>
												<form id="ask_rec_form">
													<div class="form-group">
														<h6>Whom you want to ask for?</h6>
														<select id="user_select" name="user_select" class="form-control" style="width:100%;">
															<option value=""></option>
															<?php
																$list_query="SELECT * FROM user_joins_user WHERE user_id='".$_COOKIE['uid']."'";
																$list_result=mysqli_query($conn,$list_query);
																if(mysqli_num_rows($list_result)>0)
																{
																	while($list_row=mysqli_fetch_array($list_result))
																	{
																		?>
																		<option data-id="<?php echo $list_row['r_user_id']; ?>" data-image="<?php echo getUserProfileImage($list_row['r_user_id']); ?>" value="<?php $user=getUsersData($list_row['r_user_id']);echo ucfirst(strtolower($user['first_name'].' '.$user['last_name'])); ?>" data-title="<?php echo $user['profile_title']; ?>"><?php echo ucfirst(strtolower($user['first_name'].' '.$user['last_name'])); ?></option>
																		<?php
																	}
																}
															?>
															<?php
																$list_query="SELECT * FROM user_joins_user WHERE r_user_id='".$_COOKIE['uid']."'";
																$list_result=mysqli_query($conn,$list_query);
																if(mysqli_num_rows($list_result)>0)
																{
																	while($list_row=mysqli_fetch_array($list_result))
																	{
																		?>
																		<option data-id="<?php echo $list_row['user_id']; ?>" data-image="<?php echo getUserProfileImage($list_row['user_id']); ?>" value="<?php $user=getUsersData($list_row['user_id']);echo ucfirst(strtolower($user['first_name'].' '.$user['last_name'])); ?>" data-title="<?php echo ucfirst(strtolower($user['profile_title'])); ?>"><?php echo ucfirst(strtolower($user['first_name'].' '.$user['last_name'])); ?></option>
																		<?php
																	}
																}
															?>
														</select>
													</div>
													<div class="form-group">
														<h6>What was your position? *</h6>
														<select name="position" id="position" class="form-control">
															<option value="NA">None</option>
															<?php
																$pquery="SELECT title,company,id FROM users_work_experience WHERE user_id='".$_COOKIE['uid']."' AND status=1";
																$presult=mysqli_query($conn,$pquery);
																if(mysqli_num_rows($presult)>0)
																{
																	while($prow=mysqli_fetch_array($presult))
																	{
																		?>
																		<option value="<?php echo ucfirst(strtolower($prow['title'])); ?>"><?php echo ucfirst(strtolower($prow['title'].' at '.$prow['company'])); ?></option>
																		<?php
																	}
																}
															?>
														</select>
													</div>
													<div class="form-group">
														<h6>Message*</h6>
														<textarea name="text_message_rec" id="text_message_rec" rows="5" class="form-control" style="resize:none;" placeholder="Write a custom message to send him"></textarea>
													</div>
												</form>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" onclick="$('#ask_rec_form').reset();" data-dismiss="modal">Close</button>
										<button type="button" onclick="askRecFromUser();" class="btn btn-primary">Ask</button>
									</div>
								</div>
							</div>
						</div>
					
						<div class="box shadow-sm border rounded bg-white mb-3">
							<div class="box-title border-bottom p-3">
								<?php 
									$job_application_query="SELECT * FROM job_applications WHERE user_id='".$_COOKIE['uid']."' ORDER BY id DESC LIMIT 4";
									$job_application_result=mysqli_query($conn,$job_application_query);
									$job_application_num_rows=mysqli_num_rows($job_application_result);
								?>
								<h6 class="m-0 font-weight-bold">Jobs Applied 
									<?php
										if($job_application_num_rows>0)
										{
											?>
											<a href="<?php echo base_url; ?>jobs-applied" class="float-right btn small btn-sm btn-dark title-action-btn" title="View All"><i class="feather-briefcase"></i></a>
											<?php
										}
									?>
								</h6>
							</div>
							<div class="box-body" style="padding:5px;">
								<div class="row">
								<?php
									if($job_application_num_rows>0)
									{
										while($job_application_row=mysqli_fetch_array($job_application_result))
										{
											$application_job_id=$job_application_row['job_id'];
											$latest_opening_query="SELECT * FROM jobs WHERE id='".$application_job_id."'";
											$latest_opening_result=mysqli_query($conn,$latest_opening_query);
											$latest_opening_row=mysqli_fetch_array($latest_opening_result);
											
											$og_title=base_url."job/".trim(strtolower($latest_opening_row['job_title']))." ".trim(strtolower($latest_opening_row['job_company']));
											$og_title=str_replace(" ","-",$og_title);
											$og_url=$og_title."-".$latest_opening_row['id'].".html";
								?>
											<div class="col-md-6">
												<a href="<?php echo $og_url; ?>">
												   <div class="border job-item mb-3">
													  <div class="d-flex align-items-center p-3 job-item-header">
														 <div class="overflow-hidden mr-2">
															<h6 class="font-weight-bold text-dark mb-0 text-truncate"><?php echo $latest_opening_row['job_title']; ?></h6>
															<div class="text-truncate text-primary"><?php echo $latest_opening_row['job_company']; ?></div>
															<div class="small text-gray-500"><i class="feather-map-pin"></i><?php echo $latest_opening_row['job_location']; ?></div>
														 </div>
														 <img class="img-fluid ml-auto" src="<?php echo base_url; ?>alphas/<?php echo substr(strtolower($latest_opening_row['job_company']),0,1).".png"; ?>" alt="">
													  </div>
													  <?php
															getCommonPersonsOnJob($latest_opening_row['id'],$_COOKIE['uid']);
													  ?>
													  <div class="p-3 job-item-footer">
														 <small class="text-gray-500"><i class="feather-clock"></i>&nbsp;<?php echo date("d M Y",strtotime($latest_opening_row['added'])); ?></small>
													  </div>
												   </div>
												</a>
											</div>
								<?php
										}
									}
									else
									{
										?>
										<div class="col-md-12">
											<p style="text-align:center;margin-top:10px;margin-bottom:10px;">There is no data to show.</p>
										</div>
										<?php
									}
								?>
								</div>
							</div>
						</div>
						<div class="box shadow-sm border rounded bg-white mb-3">
							<div class="box-title border-bottom p-3">
								<?php 
									$cart_query="SELECT * FROM job_cart WHERE user_id='".$_COOKIE['uid']."' ORDER BY id DESC LIMIT 4";
									$cart_result=mysqli_query($conn,$cart_query);
									$cart_num_rows=mysqli_num_rows($cart_result);
								?>
								<h6 class="m-0 font-weight-bold">Jobs in Cart 
									<?php
										if($cart_num_rows>0)
										{
											?>
											<a href="<?php echo base_url; ?>jobs-in-cart" class="float-right btn small btn-sm btn-dark title-action-btn" title="View All"><i class="feather-briefcase"></i></a>
											<?php
										}
									?>
								</h6>
							</div>
							<div class="box-body" style="padding:5px;">
								<div class="row">
								<?php
									if($cart_num_rows>0)
									{
										while($cart_row=mysqli_fetch_array($cart_result))
										{
											$cart_job_id=$cart_row['job_id'];
											$latest_opening_query="SELECT * FROM jobs WHERE id='".$cart_job_id."'";
											$latest_opening_result=mysqli_query($conn,$latest_opening_query);
											$latest_opening_num_rows=mysqli_num_rows($latest_opening_result);
											$latest_opening_row=mysqli_fetch_array($latest_opening_result);
											
											$og_title=base_url."job/".trim(strtolower($latest_opening_row['job_title']))." ".trim(strtolower($latest_opening_row['job_company']));
											$og_title=str_replace(" ","-",$og_title);
											$og_url=$og_title."-".$latest_opening_row['id'].".html";
											?>
											<div class="col-md-6">
												<a href="<?php echo $og_url; ?>">
												   <div class="border job-item mb-3">
													  <div class="d-flex align-items-center p-3 job-item-header">
														 <div class="overflow-hidden mr-2">
															<h6 class="font-weight-bold text-dark mb-0 text-truncate"><?php echo $latest_opening_row['job_title']; ?></h6>
															<div class="text-truncate text-primary"><?php echo $latest_opening_row['job_company']; ?></div>
															<div class="small text-gray-500"><i class="feather-map-pin"></i><?php echo $latest_opening_row['job_location']; ?></div>
														 </div>
														 <img class="img-fluid ml-auto" src="<?php echo base_url; ?>alphas/<?php echo substr(strtolower($latest_opening_row['job_company']),0,1).".png"; ?>" alt="">
													  </div>
													  <?php
															getCommonPersonsOnJob($latest_opening_row['id'],$_COOKIE['uid']);
													  ?>
													  <div class="p-3 job-item-footer">
														 <small class="text-gray-500"><i class="feather-clock"></i>&nbsp;<?php echo date("d M Y",strtotime($latest_opening_row['added'])); ?></small>
													  </div>
												   </div>
												</a>
											</div>

											<?php
										}
									}
									else
									{
										?>
										<div class="col-md-12">
											<p style="text-align:center;margin-top:10px;margin-bottom:10px;">There is no data to show.</p>
										</div>
										<?php
									}
								?>
								</div>
							</div>
						</div>
						<div class="box shadow-sm border rounded bg-white mb-3">
							<div class="box-title border-bottom p-3">
								<?php 
									$latest_opening_query="SELECT * FROM jobs WHERE user_id='".$_COOKIE['uid']."'  ORDER BY id DESC LIMIT 4";
									$latest_opening_result=mysqli_query($conn,$latest_opening_query);
									$latest_opening_num_rows=mysqli_num_rows($latest_opening_result);
								?>
								<h6 class="m-0 font-weight-bold">Jobs Posted 
									<?php
										if($latest_opening_num_rows>0)
										{
											?>
											<a href="<?php echo base_url; ?>jobs-posted" target="_blank" class="float-right btn small btn-sm btn-dark title-action-btn" title="View All"><i class="feather-briefcase"></i></a>
											<?php
										}
									?>
								</h6>
							</div>
							<div class="box-body" style="padding:5px;">
								<div class="row">
								<?php
									if($latest_opening_num_rows>0)
									{
										while($latest_opening_row=mysqli_fetch_array($latest_opening_result))
										{
											$og_title=base_url."job/".trim(strtolower($latest_opening_row['job_title']))." ".trim(strtolower($latest_opening_row['job_company']));
											$og_title=str_replace(" ","-",$og_title);
											$og_url=$og_title."-".$latest_opening_row['id'].".html";
								?>
										<div class="col-md-6">
											<a href="<?php echo $og_url; ?>">
											   <div class="border job-item mb-3">
												  <div class="d-flex align-items-center p-3 job-item-header">
													 <div class="overflow-hidden mr-2">
														<h6 class="font-weight-bold text-dark mb-0 text-truncate"><?php echo $latest_opening_row['job_title']; ?></h6>
														<div class="text-truncate text-primary"><?php echo $latest_opening_row['job_company']; ?></div>
														<div class="small text-gray-500"><i class="feather-map-pin"></i><?php echo $latest_opening_row['job_location']; ?></div>
													 </div>
													 <img class="img-fluid ml-auto" src="<?php echo base_url; ?>alphas/<?php echo substr(strtolower($latest_opening_row['job_company']),0,1).".png"; ?>" alt="">
												  </div>
												  <?php
														getCommonPersonsOnJob($latest_opening_row['id'],$_COOKIE['uid']);
												  ?>
												  <div class="p-3 job-item-footer">
													 <small class="text-gray-500"><i class="feather-clock"></i>&nbsp;<?php echo date("d M Y",strtotime($latest_opening_row['added'])); ?></small>
												  </div>
											   </div>
											</a>
										</div>
								<?php
										}
									}
									else
									{
										?>
										<div class="col-md-12">
											<p style="text-align:center;margin-top:10px;margin-bottom:10px;">There is no data to show.</p>
										</div>
										<?php
									}
								?>
								</div>
							</div>
						</div>

						


						<div class="box shadow-sm border rounded bg-white mb-3">
							<div class="box-title border-bottom p-3">
								<?php 
									$latest_opening_query="SELECT * FROM jobs WHERE status=1 AND user_id!='".$_COOKIE['uid']."' ORDER BY id DESC LIMIT 4";
									$latest_opening_result=mysqli_query($conn,$latest_opening_query);
									$latest_opening_num_rows=mysqli_num_rows($latest_opening_result);
								?>
								<h6 class="m-0 font-weight-bold">Recent Openings
									<?php
										if($latest_opening_num_rows>0)
										{
											?>
											<a href="<?php echo base_url; ?>recent-openings" class="float-right btn small btn-sm btn-dark title-action-btn" title="View All"><i class="feather-briefcase"></i></a>
											<?php
										}
									?>
								</h6>
							</div>
							<div class="box-body" style="padding:5px;">
								<div class="row">
								<?php
									if($latest_opening_num_rows>0)
									{
										while($latest_opening_row=mysqli_fetch_array($latest_opening_result))
										{
											$og_title=base_url."job/".trim(strtolower($latest_opening_row['job_title']))." ".trim(strtolower($latest_opening_row['job_company']));
											$og_title=str_replace(" ","-",$og_title);
											$og_url=$og_title."-".$latest_opening_row['id'].".html";
								?>
										<div class="col-md-6">
											<a href="<?php echo $og_url; ?>">
											   <div class="border job-item mb-3">
												  <div class="d-flex align-items-center p-3 job-item-header">
													 <div class="overflow-hidden mr-2">
														<h6 class="font-weight-bold text-dark mb-0 text-truncate"><?php echo $latest_opening_row['job_title']; ?></h6>
														<div class="text-truncate text-primary"><?php echo $latest_opening_row['job_company']; ?></div>
														<div class="small text-gray-500"><i class="feather-map-pin"></i><?php echo $latest_opening_row['job_location']; ?></div>
													 </div>
													 <img class="img-fluid ml-auto" src="<?php echo base_url; ?>alphas/<?php echo substr(strtolower($latest_opening_row['job_company']),0,1).".png"; ?>" alt="">
												  </div>
												  <?php
														getCommonPersonsOnJob($latest_opening_row['id'],$_COOKIE['uid']);
												  ?>
												  <div class="p-3 job-item-footer">
													 <small class="text-gray-500"><i class="feather-clock"></i>&nbsp;<?php echo date("d M Y",strtotime($latest_opening_row['added'])); ?></small>
												  </div>
											   </div>
											</a>
										</div>
								<?php
										}
									}
									else
									{
										?>
										<div class="col-md-12">
											<p style="text-align:center;margin-top:10px;margin-bottom:10px;">There is no data to show.</p>
										</div>
										<?php
									}
								?>
								</div>
							</div>
						</div>
					
					</main>
											
					<aside class="col col-xl-3 order-xl-3 col-lg-12 order-lg-3 col-12" style="position:static;">
						<div class="box mb-3 shadow-sm border rounded bg-white profile-box text-center">
							<div class="p-2 text-left border-bottom">
								<h6 class="font-weight-bold mb-0" style=" text-transform: uppercase; font-size: 14px !important; "><img src="img/videocv.png" style="cursor: pointer;width: 25px;margin-right: 5px;"> Video cv or profile 
									<a href="javascript:void(0);" class="float-right btn small btn-sm btn-dark title-action-btn my_dropdown" style="margin-left:5px;margin-top:5px;"><i class="feather-settings"></i>
										<div class="my_drop_down_content" style="border:3px solid #edf2f6;">
											<ul style="list-style:none;color:black;font-size:12px;text-align:left;margin:0;padding:10;text-transform: none;">
												<li style="text-align:left;border:1px solid gray;padding:3px;font-weight:bold;color:gray;" onclick="recordVideoCV(2);">Record Video CV</li>
												<li style="border-top:1px solid gray;margin-top:5px;margin-bottom:5px;"></li>
												<li style="text-align:left;border:1px solid gray;padding:3px;font-weight:bold;color:gray;" onclick="getVideoCV();">Upload Video CV</li>
											</ul>
										</div>
									</a>
								</h6>
							</div>
							<?php
								$v_query="SELECT * FROM users_resume WHERE user_id='".$_COOKIE['uid']."' AND profile_type=2 AND is_default=1 ORDER BY id DESC";
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
							<div class="modal fade video_cv_upload_modal" id="video_cv_upload_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="amazingVideoCVBackdrop" aria-hidden="true">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h6 class="modal-title" id="amazingVideoCVBackdrop">Let us upload a video to profile.</h6>
										</div>
										<div class="modal-body">											
											<div class="p-2 d-flex" style="color:red;" id="video_file_err"></div>
											<form id="user_profile_video_form" method="post" enctype="multipart/form-data">
												<div class="d-flex p-2">
													<div class="col-4">
														<video style="width:100%;" controls controlsList="nodownload">
														  <source src="<?php echo $video_file; ?>" id="video_preview">
															Your browser does not support HTML5 video.
														</video>
													</div>
													<input type="hidden" name="token" id="token_video" value="<?php echo $token_video; ?>">
													<div class="col-4">
														<h6 style="text-align:left;">Video Type*</h6>
														<select name="video_type" id="video_type" class="form-control">
															<?php
																$v_query="SELECT * FROM video_types WHERE status=1 AND is_video=1 AND is_for_user=1";
																$v_result=mysqli_query($conn,$v_query);
																if(mysqli_num_rows($v_result)>0)
																{
																	while($v_row=mysqli_fetch_array($v_result))
																	{
																		?>
																		<option value="<?php echo $v_row['id']; ?>" <?php if($video_type==$v_row['id']){ echo 'selected'; } ?>><?php echo ucfirst(strtolower($v_row['title'])); ?></option>
																		<?php
																	}
																}
															?>
														</select>
													</div>
													<div class="col-4">
														<h6 style="text-align:left;">Video File*</h6>
														<input type="file" name="profile_video_cv" class="form-control" required id="profile_video_cv" accept=".mp4">
													</div>
												</div>
												<div class="p-2 d-flex">
													<div class="col-12">
														<h6 style="text-align:left;">Video Title*</h6>
														<input type="text" name="profile_title" value="<?php echo ucfirst(strtolower($profile_title)); ?>" class="form-control" placeholder="Video Title">
													</div>
												</div>
												<div class="p-2 d-flex">
													<div class="col-12">
														<h6 style="text-align:left;">Headline*</h6>
														<textarea style="resize:none;" rows="3" id="resume_headline" name="resume_headline"  class="form-control" placeholder="Headline"><?php echo ucfirst(strtolower($resume_headline)); ?></textarea>
													</div>
												</div>
												<div class="p-2 d-flex">
													<div class="col-12">
														<h6 style="text-align:left;">Video Tags*</h6>
														<input type="text" name="video_tags" value="<?php echo ucfirst(strtolower($video_tags)); ?>" class="form-control" placeholder="comma seperated video tags">
													</div>
												</div>
											</form>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											<button type="button" class="btn btn-primary" onclick="saveProfileVideo();">Save</button>
										</div>
									</div>
								</div>
							</div>
							<div class="modal fade loadMe" id="loadMe" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="loadMeBackdrop" aria-hidden="true">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h6 class="modal-title" id="loadMeBackdrop">Action in Progress.</h6>
										</div>
										<div class="modal-body">											
											<div class="p-2 d-flex">
												
											</div>
										</div>
										<div class="modal-body text-center">
											<div class="loader" id="gif_loader"></div>
											<div class="loader-txt">
											  <p>the action performed is in progress. please wait a little.</p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div>
							<video muted="" class="w-100" controls="" controlsList="nodownload" id="video_preview_data">
									<source src="<?php echo $video_file; ?>" type="video/mp4">
									Your browser does not support HTML5 video.
								</video>
								</div>
							<div class="p-3">
								
								<p class="m-0 font-weight-normel" id="video_profile_title" style="font-weight:normal !important;margin-top:20px;"><?php echo $profile_title; ?></p>
							</div>
						</div>
						
						<div class="box shadow-sm mb-3 rounded bg-white ads-box text-center overflow-hidden">
							<div class="p-3 border-bottom">
								<h6 class="font-weight-bold text-gold mb-0">Profile Selections - (0)</h6>
							</div>
						</div>
						<div class="box shadow-sm border rounded bg-white mb-3">
							<div class="box-title border-bottom p-3">
								<h6 class="m-0 font-weight-bold">World 360 degree</h6>
							</div>
							<div class="box-body">
								<div class="d-flex align-items-center p-3 job-item-header border-bottom">
								   <div class="overflow-hidden">
									  <h6 class="font-weight-bold text-dark mb-0 text-truncate" style="font-weight:normal !important;">Covid-19</h6>
									  <div class="text-truncate text-primary">Covid-19 in India</div>
									  <div class="small text-gray-500"> 
										Here are the latest fact checks.
									  </div>
								   </div>
								</div>
								<div class="d-flex align-items-center p-3 job-item-header border-bottom">
								   <div class="overflow-hidden">
									  <h6 class="font-weight-bold text-dark mb-0 text-truncate" style="font-weight:normal !important;">Trending in New Delhi</h6>
									  <div class="text-truncate text-primary">#ChinaWillPay</div>
								   </div>
								</div>
								<div class="d-flex align-items-center p-3 job-item-header border-bottom">
								   <div class="overflow-hidden">
									  <h6 class="font-weight-bold text-dark mb-0 text-truncate" style="font-weight:normal !important;">Trending in India</h6>
									  <div class="text-truncate text-primary">#indiawantsperman</div>
								   </div>
								</div>
								<div class="d-flex align-items-center p-3 job-item-header border-bottom">
								   <div class="overflow-hidden">
									  <h6 class="font-weight-bold text-dark mb-0 text-truncate" style="font-weight:normal !important;">Celebrities Trending</h6>
									  <div class="text-truncate text-primary">#AkshayKumar</div>
								   </div>
								</div>
								<div class="d-flex align-items-center p-3 job-item-header border-bottom">
								   <div class="overflow-hidden">
									  <h6 class="font-weight-bold text-dark mb-0 text-truncate" style="font-weight:normal !important;">Politics Trending</h6>
									  <div class="text-truncate text-primary">#JusticeForJayaPriya</div>
								   </div>
								</div>
								<div class="d-flex align-items-center p-3 job-item-header border-bottom">
								   <div class="overflow-hidden">
									  <h6 class="font-weight-bold text-dark mb-0 text-truncate" style="font-weight:normal !important;">Technology Trending</h6>
									  <div class="text-truncate text-primary">#TimeMachine</div>
								   </div>
								</div>
								<div class="d-flex align-items-center p-3 job-item-header border-bottom">
								   <div class="overflow-hidden">
									  <h6 class="font-weight-bold text-dark mb-0 text-truncate" style="font-weight:normal !important;">Entertainment Trending</h6>
									  <div class="text-truncate text-primary">#CBIMustForShushant</div>
								   </div>
								</div>
							</div>
						</div>
						<?php
							$viewers_query="SELECT * FROM users_profile_views WHERE user_id='".$_COOKIE['uid']."' ORDER BY id DESC";
							$viewers_result=mysqli_query($conn,$viewers_query);
							if(mysqli_num_rows($viewers_result)>0)
							{
						?>
								<div class="box shadow-sm border rounded bg-white mb-3">
									<div class="box-title border-bottom p-3">
										<h6 class="m-0">Who viewed your profile</h6>
									</div>
									<div class="box-body p-3" style="max-height:400px;overflow-y:auto;">
										<?php
											while($viewers_row=mysqli_fetch_array($viewers_result))
											{
												$viewer_id=$viewers_row['viewer_id'];
												$viewer_user=getUsersData($viewer_id);
												?>
												<div class="d-flex align-items-center osahan-post-header mb-3 people-list">
													<div class="dropdown-list-image mr-3">
														<a href="<?php echo base_url."u/".$viewer_user['username']; ?>">
															<img class="rounded-circle" style="border:1px solid #eaebec !important;" src="<?php echo getUserProfileImage($viewer_id); ?>" alt="<?php echo ucfirst(strtolower($viewer_user['first_name']." ".$viewer_user['last_name'])); ?>">
															<div class="status-indicator <?php if(userLoggedIn($viewer_id)){ echo 'bg-success';} else{ echo 'bg-danger'; } ?>">
															</div>
														</a>
													</div>
													<div class="font-weight-bold mr-2">
														<div class="text-truncate">
															<a href="<?php echo base_url."u/".$viewer_user['username']; ?>">
																<?php echo ucfirst(strtolower($viewer_user['first_name']." ".$viewer_user['last_name'])); ?>
															</a>
														</div>
														<div class="small text-gray-500">
															<?php echo ucfirst(strtolower($viewer_user['profile_title'])); ?>
														</div>
													</div>
													<span class="ml-auto">
														<button type="button" class="btn btn-light btn-sm">Connect</button>
													</span>
												</div>
												<?php
											}
										?>
									</div>
								</div>
						<?php
							}
						?>
						<div class="box shadow-sm mb-3 rounded bg-white ads-box text-center overflow-hidden">
							<img src="img/ads1.png" class="img-fluid" alt="RopeYou Premium">
							<div class="p-3 border-bottom">
								<h6 class="font-weight-bold text-gold">RopeYou Premium</h6>
								<p class="mb-0 text-muted">Grow &amp; nurture your network</p>
							</div>
							<div class="p-3">
								<button type="button" class="btn btn-outline-gold pl-4 pr-4"> ACTIVATE </button>
							</div>
						</div>
						<div class="box shadow-sm mb-3 rounded bg-white ads-box text-center overflow-hidden is_stuck">
							 <img src="img/job1.png" class="img-fluid" alt="Responsive image">
							 <div class="p-3 border-bottom">
								<h6 class="font-weight-bold text-dark">RopeYou Solutions</h6>
								<p class="mb-0 text-muted">Looking for talent?</p>
							 </div>
							 <div class="p-3">
								<a href="<?php echo base_url; ?>post-job" class="btn btn-primary pl-4 pr-4"> POST A JOB </a>
							 </div>
						</div>
					</aside>
				</div>
			</div>
		</div>
		<?php include_once 'scripts.php'; ?>
		<script src="<?php echo base_url; ?>/js/sweetalert.min.js"></script>
		<script src="<?php echo base_url; ?>jquery.sticky-kit.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha256-bqVeqGdJ7h/lYPq6xrPv/YGzMEb6dNxlfiTUHSgRCp8=" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
		
		<!--<script src="<?php echo base_url; ?>fileuploader/dist/jquery.fileuploader.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url; ?>fileuploader/examples/gallery/js/custom.js" type="text/javascript"></script>-->
		<script>
			var user_id="<?php echo $_COOKIE['uid']; ?>";
			/*$("body").scroll(function(){
				var offset=$("#left_side_bar").offset();
				console.log(offset);
			});*/
			/*$(window).scroll(function (event) {
				var scroll = $(window).scrollTop();
				var offset=$("#left_sidebar_interests").offset();
				console.log(offset);
				console.log(scroll);
			});*/
			<?php
				if($onboarding=="profile_pic")
				{
					?>
					//$("#amazing_profile_image_backdrop_modal").modal('show');
					<?php
				}
			?>
			function loader(action)
			{
				if(action=="" || action=="open")
				{
					$("#loadMe").modal({
					  backdrop: "static", //remove ability to close modal with click
					  keyboard: false, //remove option to close with keyboard
					  show: true //Display loader!
					});
				}
				else{
					$("#loadMe").modal('hide');
				}
			}
			
			$(".is_stuck").stick_in_parent();
			var base_url="<?php echo base_url; ?>";
			$(document).ready(function(){
				var maxField = 10; //Input fields increment limitation
				var addButton = $('.add_button_1'); //Add button selector
				var value_wrapper_1 = $('.value_wrapper_1'); 
				var wrapper1 = $('.field_wrapper_1'); 
				
						//New input field html 
				var x = 1; //Initial field counter is 1
				
				//Once add button is clicked
				$(addButton).click(function(){
					$.ajax({
						url:base_url+'getaddinterestsform',
						type:'post',
						data:{},
						success:function(data)
						{
							$(wrapper1).html(data);
						}
					});
				});
				
				//Once remove button is clicked
				$(wrapper1).on('click', '.remove_button', function(e){
					$(wrapper1).html('');
				});
			});
			function getInterests()
			{
				$("#interests_modal_opner").modal("show");
			}
			function reloadPage()
			{
				//$("#skills_modal_opner").modal("hide");
				window.location.href=base_url+"dashboard";
			}
			$(document).ready(function(){
				var maxField = 10; //Input fields increment limitation
				var addButton = $('.add_button'); //Add button selector
				var value_wrapper = $('.value_wrapper'); 
				var wrapper = $('.field_wrapper'); 
				
						//New input field html 
				var x = 1; //Initial field counter is 1
				
				//Once add button is clicked
				$(addButton).click(function(){
					$.ajax({
						url:base_url+'getaddskillsform',
						type:'post',
						data:{},
						success:function(data)
						{
							$(wrapper).html(data);
						}
					});
				});
				
				//Once remove button is clicked
				$(wrapper).on('click', '.remove_button', function(e){
					$(wrapper).html('');
				});
			});
			function getSkills()
			{
				$("#skills_modal_opner").modal("show");
			}
			function saveContacts()
			{
				var communication_email=$("#communication_email").val().trim();
				var communication_mobile=$("#communication_mobile").val().trim();
				if(communication_email=="" || communication_mobile=="")
				{
					$("#contact_err").html('please fill all required fields.');
					return;
				}
				else
				{
					var form = $('#user_contact_form')[0]; // You need to use standard javascript object here
					var formData = new FormData(form);
					$.ajax({
						url:base_url+"saveusercontacts",
						type:"post",
						data:formData,
						contentType: false, 
						processData: false,
						success:function(data)
						{
							var parsedJson=JSON.parse(data);
							if(parsedJson.status=="success")
							{
								window.location.href=base_url+'dashboard';
							}
							else
							{
								$("#contact_err").html(parsedJson.message);
							}
						}
					});
				}
			}
			function getContacts()
			{
				$("#amazing_contact_backdrop_modal").modal("show");
			}
			$(document).on("change", "#profile_video_cv", function(evt) {
				var $source = $('#video_preview');
				$source[0].src = URL.createObjectURL(this.files[0]);
				$source.parent()[0].load();
			});
			function saveProfileVideo()
			{
				$("#video_file_err").html('');
				var form = $('#user_profile_video_form')[0]; // You need to use standard javascript object here
				var formData = new FormData(form);
				$("#loadMe").modal({
					backdrop: "static", //remove ability to close modal with click
					keyboard: false, //remove option to close with keyboard
					show: true //Display loader!
				});
				$.ajax({
					url:base_url+"saveuserprofilevideo",
					type:"post",
					data:formData,
					contentType: false, 
					processData: false,
					success:function(data)
					{
						//$("#gif_loader").hide();
						//$(".modal").modal({show:false});
						$("#loadMe").modal("hide");
						var parsedJson=JSON.parse(data);
						window.setTimeout( function(){
							$("#loadMe").modal("hide");
							if(parsedJson.status=="success")
							{
								//$("#loadMe").modal({show:false});
								var $source = $('#video_preview');
								$source[0].src = parsedJson.data;
								//$source.parent()[0].load();
								
								var $source = $('#video_preview_data');
								$source[0].src = parsedJson.data;
								//$source.parent()[0].load();
								$("#token_video").val(parsedJson.id);
								$("#video_profile_title").html(parsedJson.profile_title);
								$(".modal").modal("hide");
							}
							else
							{
								$("#loadMe").modal({show:false});
								$("#video_file_err").html(parsedJson.message);
							}
						}, 2000 );
						
					}
				});
			}
			function getVideoCV()
			{
				$("#video_cv_upload_modal").modal("show");
			}
			function removeProfileImage()
			{
				var token=$("#profile_image_token").val();
				var is_default=$("#user_profile_picture_demo").attr("data-file");
				if(is_default!="")
				{
					$("#file_err").html("default image can not be removed.");
					return;
				}
				if(token!="")
				{
					$.ajax({
						url:base_url+'removeprofileimage',
						type:'post',
						data:{id:token},
						success:function(data)
						{
							var parsedJson=JSON.parse(data);
							if(parsedJson.status=="success")
							{
								$('#user_profile_picture_demo').attr("src",parsedJson.data);
								$('#user_profile_picture').attr("src",parsedJson.data);
								$("#user_profile_picture_demo").attr("data-file","default");
							}
							else{
								$("#file_err").html(parsedJson.message);
							}
						}
					});
				}
				else
				{
					alert('Invalid option');
				}
			}
			function saveProfileImage()
			{
				$("#file_err").html("");
				var form = $('#user_profile_image_form')[0]; // You need to use standard javascript object here
				var formData = new FormData(form);
				$.ajax({
					url:base_url+"saveuserprofilepicture",
					type:"post",
					data:formData,
					contentType: false, 
					processData: false,
					success:function(data)
					{
						var parsedJson=JSON.parse(data);
						if(parsedJson.status=="success")
						{
							$("#user_profile_picture").attr("src",parsedJson.data);
							$("#profile_image_token").val(parsedJson.id);
							$("#user_profile_picture_demo").attr("src",parsedJson.data);
							$("#amazing_profile_image_backdrop_modal").modal("hide");
						}
						else
						{
							$("#file_err").html(parsedJson.message);
						}
					}
				});
			}
			function readURLFromFile(input) {
			  if (input.files && input.files[0]) {
				var reader = new FileReader();
				
				reader.onload = function(e) {
				  $('#user_profile_picture_demo').attr("src",e.target.result);
				}
				
				reader.readAsDataURL(input.files[0]); 
			  }
			  else{
				  $("#file_err").html("Invalid file.Please select an image");
			  }
			}
			$("#user_profile_picture_field").change(function(){
				$("#file_err").html("");
				readURLFromFile(this);
			});
			function deleteRec(item_token="")
			{
				if(item_token!="")
				{
					$.ajax({
						url:base_url+'deletecommendation',
						type:'post',
						data:{id:item_token},
						success:function(data)
						{
							var parsedJson=JSON.parse(data);
							if(parsedJson.status=="success")
							{
								$("#rec_"+item_token).remove();
							}
							else
							{
								alert(parsedJson.message);
							}
						}
					});
				}
			}
			function askRecFromUser()
			{
				$("#rec_error").html('');
				var r_user_id=$("#choosen_user").val();
				var custom_message=$("#text_message_rec").val().trim();
				var designation=$("#position").val().trim();
				if(r_user_id!="" && custom_message!="" && designation!="")
				{
					$.ajax({
						url:base_url+'savereccommendation',
						type:'post',
						data:{r_user_id:r_user_id,custom_message:custom_message,designation:designation},
						success:function(data)
						{
							var parsedJson=JSON.parse(data);
							if(parsedJson.status=="success")
							{
								$("#rec_error").html('');
								if($("#nothing_to_show_rec").length>0)
								{
									$("#nothing_to_show_rec").remove();
								}
								if($("#rec_"+parsedJson.id).length>0)
								{
									$("#rec_"+parsedJson.id).remove();
								}
								$("#recommendation_data_matrix").append(parsedJson.data);
								$("#ask_for_recommendation_modal").modal("hide");
							}
							else
							{
								$("#rec_error").html(parsedJson.message);
							}
						}
					});
				}
				else
				{
					$("#rec_error").html('Please fill all required fields');
				}
			}
			var timeout=null;
			/*$("#user_select").bind("keyup",function(){
				clearTimeout(timeout);
				timeout = setTimeout(function () {
					var username=$("#user_select").val().trim();
					//var usr_arr=username.split(" ");
					$.ajax({
						url:base_url+"get-user-list",
						type:"post",
						data:{q:username},
						success:function(response)
						{
							
						}
					});
					console.log(username);
				},1000);
			});*/
			function askForRecommendation()
			{
				$("#ask_for_recommendation_modal").modal("show");
				$("#rec_error").html('');
				$("#user_select").select2({placeholder: "Search for user",templateResult: formatUserList,templateSelection:manageUserSelection});
				
			}
			function formatUserList (opt) {
				
				if (!opt.id) {
					return opt.text;
				} 

				var optimage = $(opt.element).attr('data-image'); 
				var profile_title = $(opt.element).attr('data-title'); 
				if(!optimage){
				   return opt.text;
				} else {                    
					var $opt = $(
					   '<div class="row" style="overflow:hidden;"><div class="col-1"><img src="' + optimage + '" style="height:40px;width:40px;border-radius:10px;border:1px solid gray;" /></div><div class="col-11" style="overflow:hidden;"><span style="color:black;font-weight:bold;font-size:14px;margin-left:20px;">' + opt.text + '<br/><span style="font-weight:normal;font-size:12px;padding-left:20px;">'+profile_title+'</span></span></div></div>'
					);
					return $opt;
				}
			}
			function manageUserSelection(opt)
			{
				if(opt.text!="" && opt.text!=null && opt.text!='Search for user')
				{
					$("#text_message_rec").val("Dear "+opt.text+",\nI am trying to build up my recommendations to progress in my professional careers, therefor i am hoping you will provide a recommendation for me.\nPlease let me know if you need any additional information to formulate the recommendation.\nThank you so much for considering my request.");
				}
				else
				{
					$("#text_message_rec").val("");
				}
				if (!opt.id) {
					$("#choosen_user").val('');
					return opt.text;
				} 

				var id = $(opt.element).attr('data-id'); 
				if(!id){
					$("#choosen_user").val('');
					return opt.text;
				} else { 
					$("#choosen_user").val(id);
					return opt.text;
				}
			}
			function showReceivedRec()
			{
				$("#rr_anchor").css('color','#007bff');
				$("#gr_anchor").css('color','black');
				$("#received_recommendations").show();
				$("#given_recommendations").hide();
			}
			function showGivenRec()
			{
				$("#gr_anchor").css('color','#007bff');
				$("#rr_anchor").css('color','black');
				$("#received_recommendations").hide();
				$("#given_recommendations").show();
			}
			function showProfessional()
			{
				$("#prg_anchor").css({"color": "#fff" ,
				"background-color": "#6fb4ff",
				"padding": "5px 10px", "border-radius": "20px"});
				$("#peg_anchor").css({"color": "#1d2f38" ,
				"background-color": "#edf2f6",
				"padding": "5px 10px", "border-radius": "20px"});
				$("#professional_gallery").show();
				$("#personal_gallery").hide();
			}
			function showPersonal()
			{
				$("#prg_anchor").css({"color": "#1d2f38" ,
				"background-color": "#edf2f6",
				"padding": "5px 10px", "border-radius": "20px"});
				$("#peg_anchor").css({"color": "#fff" ,
				"background-color": "#6fb4ff",
				"padding": "5px 10px", "border-radius": "20px"});
				$("#personal_gallery").show();
				$("#professional_gallery").hide();
			}
			function saveAward()
			{
				var form = $('#achievement_form')[0]; // You need to use standard javascript object here
				var formData = new FormData(form);
				$("#award_error_mesg").html('');
				
				var award_title=$("#award_title").val().trim();
				//var old_award_image=$("#old_award_image").val().trim();
				var award_description=$("#award_description").val();
				if(award_title=="" || award_description=="")
				{
					$("#award_error_mesg").html('Please Fill All Required Fields');
					return;
				}
				else
				{
					$.ajax({
						url:base_url+"saveuseraward",
						type:"post",
						data:formData,
						contentType: false, 
						processData: false,
						success:function(data)
						{
							var parsedJson=JSON.parse(data);
							if(parsedJson.status=="success")
							{
								$("#award_error_mesg").html(parsedJson.message);
								if($("#nothing_to_show_award").length>0)
								{
									$("#nothing_to_show_award").remove();
								}
								if($("#award_"+parsedJson.id).length>0)
								{
									$("#award_"+parsedJson.id).remove();
								}
								$("#award_data_matrix").append(parsedJson.data);
								$("#award_form").html("");
								$("#award_form_modal").modal('hide');
							}
							else
							{
								$("#award_error_mesg").html(parsedJson.message);
							}
						}
					});
				}
			}
			function saveEducation()
			{
				$("#edu_error_mesg").html('');
				var studying=0;
				var to_day="";
				var to_month="";
				var to_year="";
				var from_day="";
				var from_month="";
				var from_year="";
				if($("#currently_studying_here").is(":checked"))
				{
					studying=1;
					to_day="";
					to_month="";
					to_year="";
				}
				else
				{
					studying=0;
					var checkout=$("#check_out").val();
					if(checkout!="" && checkout!=null && checkout!="undefined")
					{
						var checkout_arr=checkout.split(".");
						studying=0;
						to_day=checkout_arr[1];
						to_month=checkout_arr[0];
						to_year=checkout_arr[2];
					}
					else
					{
						studying=1;
						to_day="";
						to_month="";
						to_year="";
					}
				}
				var checkin=$("#check_in").val();
				if(checkin!="" && checkin!=null && checkin!="undefined")
				{
					var checkin_arr=checkin.split(".");
					from_day=checkin_arr[1];
					from_month=checkin_arr[0];
					from_year=checkin_arr[2];
				}
				else
				{
					$("#edu_error_mesg").html('Please select a joining date');
					return;
				}
				var course=$("#course").val();
				var majors=$("#majors").val();
				var institution_name=$("#institution_name").val();
				var edu_description=$("#edu_description").val();
				var edu_country=$("#edu_country").val();
				var edu_item_token=$("#edu_item_token").val();
				var edu_city=$("#edu_city").val();
				if(institution_name=="" || majors=="" || course=="" || edu_city=="" || edu_country=="")
				{
					$("#edu_error_mesg").html('Please Fill All Required Fields');
					return;
				}
				else
				{
					$.ajax({
						url:base_url+"saveusereducation",
						type:"post",
						data:{course:course,majors:majors,university:institution_name,edu_country:edu_country,item_token:edu_item_token,edu_city:edu_city,edu_description:edu_description,from_day:from_day,from_month:from_month,from_year:from_year,to_day:to_day,to_month:to_month,to_year:to_year,studying:studying,origin:"dashboard"},
						success:function(data)
						{
							var parsedJson=JSON.parse(data);
							if(parsedJson.status=="success")
							{
								$("#edu_error_mesg").html(parsedJson.message);
								if($("#nothing_to_show_edu").length>0)
								{
									$("#nothing_to_show_edu").remove();
								}
								if($("#edu_"+parsedJson.id).length>0)
								{
									$("#edu_"+parsedJson.id).remove();
								}
								$("#educational_data_matrix").append(parsedJson.data);
								$("#education_form").html("");
								$("#education_form_modal").modal('hide');
							}
							else
							{
								$("#edu_error_mesg").html(parsedJson.message);
							}
						}
					});
				}
			}
			function getEducation(item_token="")
			{
				$.ajax({
					url:base_url+'get-education-form',
					type:'post',
					data:{item_token:item_token},
					success:function(data){
						$("#education_form").html(data);
						$("#education_form_modal").modal("show");
					}
				});
			}
			function saveExperience()
			{
				$("#work_error_mesg").html('');
				var working=0;
				var to_day="";
				var to_month="";
				var to_year="";
				var from_day="";
				var from_month="";
				var from_year="";
				if($("#currently_working_here").is(":checked"))
				{
					working=1;
					to_day="";
					to_month="";
					to_year="";
				}
				else
				{
					working=0;
					var checkout=$("#check_out").val();
					if(checkout!="" && checkout!=null && checkout!="undefined")
					{
						var checkout_arr=checkout.split(".");
						working=0;
						to_day=checkout_arr[1];
						to_month=checkout_arr[0];
						to_year=checkout_arr[2];
					}
					else
					{
						working=1;
						to_day="";
						to_month="";
						to_year="";
					}
				}
				var checkin=$("#check_in").val();
				if(checkin!="" && checkin!=null && checkin!="undefined")
				{
					var checkin_arr=checkin.split(".");
					from_day=checkin_arr[1];
					from_month=checkin_arr[0];
					from_year=checkin_arr[2];
				}
				else
				{
					$("#work_error_mesg").html('Please select a joining date');
					return;
				}
				var work_designation=$("#work_designation").val();
				var company_name=$("#company_name").val();
				var work_country=$("#work_country").val();
				var work_item_token=$("#work_item_token").val();
				var work_city=$("#work_city").val();
				var work_description=$("#work_description").val();
				if(work_designation=="" || company_name=="" || work_country=="" || work_city=="")
				{
					$("#work_error_mesg").html('Please Fill All Required Fields');
					return;
				}
				else
				{
					$.ajax({
						url:base_url+"saveuserexperience",
						type:"post",
						data:{work_designation:work_designation,company_name:company_name,work_country:work_country,item_token:work_item_token,work_city:work_city,work_description:work_description,from_day:from_day,from_month:from_month,from_year:from_year,to_day:to_day,to_month:to_month,to_year:to_year,working:working,origin:"dashboard"},
						success:function(data)
						{
							var parsedJson=JSON.parse(data);
							if(parsedJson.status=="success")
							{
								$("#work_error_mesg").html(parsedJson.message);
								if($("#nothing_to_show_exp").length>0)
								{
									$("#nothing_to_show_exp").remove();
								}
								if($("#work_exp_"+parsedJson.id).length>0)
								{
									$("#work_exp_"+parsedJson.id).remove();
								}
								$("#experience_data_matrix").append(parsedJson.data);
								$("#experience_form").html("");
								$("#experience_form_modal").modal('hide');
							}
							else
							{
								$("#work_error_mesg").html(parsedJson.message);
							}
						}
					});
				}
			}
			function getExperience(item_token="")
			{
				$.ajax({
					url:base_url+'get-experience-form',
					type:'post',
					data:{item_token:item_token},
					success:function(data){
						$("#experience_form_modal").modal("show");
						$("#experience_form").html(data);
					}
				});
			}
			function getAward(item_token="")
			{
				$.ajax({
					url:base_url+'get-award-form',
					type:'post',
					data:{item_token:item_token},
					success:function(data){
						$("#award_form_modal").modal("show");
						$("#award_form").html(data);
					}
				});
			}
			function deleteExperience(item_token)
			{
				
				if(confirm('Are you sure? you want to delete it?'))
				{
					if(item_token!="")
					{
						$.ajax({
							url:base_url+'remove-experience',
							type:'post',
							data:{item_token:item_token},
							success:function(data){
								var parsedJson=JSON.parse(data);
								if(parsedJson.status=="success")
								{
									$("#work_exp_"+item_token).remove();
								}
								else
								{
									swal({
										title: "Error",
										text: parsedJson.message,
										icon: "error",
										buttons: {
											confirm: {
												text: "Yes",
												value: true,
												visible: true,
												className: "",
												closeModal: true
											}
										}
									});
								}
							}
						});
					}
					else
					{
						swal({
							title: "Oh no!",
							text: "Invalid Action",
							icon: "error",
							buttons: {
								confirm: {
									text: "Yes",
									value: true,
									visible: true,
									className: "",
									closeModal: true
								}
							}
						});
					}
				}
			}	
			function deleteAward(item_token)
			{
				
				if(confirm('Are you sure? you want to delete it?'))
				{
					if(item_token!="")
					{
						$.ajax({
							url:base_url+'remove-award',
							type:'post',
							data:{item_token:item_token},
							success:function(data){
								var parsedJson=JSON.parse(data);
								if(parsedJson.status=="success")
								{
									$("#award_"+item_token).remove();
								}
								else
								{
									swal({
										title: "Error",
										text: parsedJson.message,
										icon: "error",
										buttons: {
											confirm: {
												text: "Yes",
												value: true,
												visible: true,
												className: "",
												closeModal: true
											}
										}
									});
								}
							}
						});
					}
					else
					{
						swal({
							title: "Oh no!",
							text: "Invalid Action",
							icon: "error",
							buttons: {
								confirm: {
									text: "Yes",
									value: true,
									visible: true,
									className: "",
									closeModal: true
								}
							}
						});
					}
				}
			}	
			function deleteEducation(item_token)
			{
				if(confirm('Are you sure? you want to delete it?'))
				{
					if(item_token!="")
					{
						$.ajax({
							url:base_url+'remove-education',
							type:'post',
							data:{item_token:item_token},
							success:function(data){
								var parsedJson=JSON.parse(data);
								if(parsedJson.status=="success")
								{
									$("#edu_"+item_token).remove();
								}
								else
								{
									swal({
										title: "Error!",
										text: parsedJson.message,
										icon: "error",
										buttons: {
											confirm: {
												text: "Yes",
												value: true,
												visible: true,
												className: "",
												closeModal: true
											}
										}
									});
								}
							}
						});
					}
					else
					{
						swal({
							title: "Oh no!",
							text: "Invalid Action",
							icon: "error",
							buttons: {
								confirm: {
									text: "Yes",
									value: true,
									visible: true,
									className: "",
									closeModal: true
								}
							}
						});
					}
				}
			}
			function saveAboutYou(element)
			{
				$("#amazing_about_you_error").html("");
				var amazing_about_you=$("#amazing_about_you").val().trim();
				if(amazing_about_you!="")
				{
					$.ajax({
						url:base_url+"updateaboutonly",
						type:"post",
						data:{about:amazing_about_you},
						success:function(data)
						{
							var parsedJson=JSON.parse(data);
							if(parsedJson.status=="success")
							{
								$("#"+element).html(parsedJson.data);
								styleReadMore(element);
								$("#amazing_about_backdrop_modal").modal("hide");
							}
							else
							{
								$("#amazing_about_you_error").html(parsedJson.message);
							}
						}
					});
				}
				else
				{
					$("#amazing_about_you_error").html("write something about you.");
				}
			}
			function styleReadMore(element)
			{
				var showChar = 406;  
				var ellipsestext = "...";
				var moretext = "Show more >";
				var lesstext = "Show less";
				

				$('#'+element).each(function() {
					var content = $(this).html();
			 
					if(content.length > showChar) {
			 
						var c = content.substr(0, showChar);
						var h = content.substr(showChar, content.length - showChar);
			 
						var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="javascript:void(0);"  id="morelink" style="width:100px;">' + moretext + '</a></span>';
			 
						$(this).html(html);
					}
			 
				});
 
				$("#morelink").click(function(){
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
			function loadImage(div)
			{
				$("."+div+" img").css("cursor","pointer");
				$("."+div+" img").click(function(){
					$("#backdrop_image_to_show").attr("src",$(this).attr("src"));
					$("#image_backdrop_modal").modal('show');
				});
			}
			loadImage("py-4");
			function recordVideo()
			{
				$("#video_cv_recording_model").modal('show');
			}
			function recordVideoCV(number)
			{
				if(number=="2")
				{
					window.location.href=base_url+'record-video-cv';
				}
				else{
					window.location.href=base_url+'record-video-profile';
				}
			}
			function getLocation() {
			  if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(showPosition);
			  } else { 
				console.log('GeoLocation is not supported.');
				//x.innerHTML = "Geolocation is not supported by this browser.";
			  }
			}

			function showPosition(position) {
				console.log(position);
				$.ajax({
					url:base_url+"update-location",
					method:"post",
					data:{user_id:user_id,lattitude:position.coords.latitude,longitude:position.coords.longitude},
					success:function(response){
						
					}
				});
			}
			function createDocCV()
			{
				window.location.href=base_url+'create-resume.php';
			}
			getLocation();
			
			function linkify(str) {
				var newStr = str.replace(/(<a href=")?((https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)))(">(.*)<\/a>)?/gi, function () {

					return '<a href="' + arguments[2] + '">' + (arguments[7] || arguments[2]) + '</a>'
				});
				console.log(newStr)
				$('#received_rec_1').html(newStr); //fill output area
			}

			var data = $('#received_rec_1').html(); //get input (content)
			linkify(data);
		</script>
   </body>
</html>