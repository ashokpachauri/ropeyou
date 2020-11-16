<!DOCTYPE html>
<html lang="en">
   <head>
		<?php include_once 'head.php'; ?>
		<title>Gallery | RopeYou Connects</title>
		<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
		<!--<link href="<?php echo base_url; ?>fileuploader/dist/font/font-fileuploader.css" rel="stylesheet">
		<link href="<?php echo base_url; ?>fileuploader/dist/jquery.fileuploader.min.css" media="all" rel="stylesheet">
		<link href="<?php echo base_url; ?>fileuploader/examples/gallery/css/jquery.fileuploader-theme-gallery.css" media="all" rel="stylesheet">-->
	</head>
	<style>
		.comments_dropdown {
		  position: relative;
		  display: inline-block;
		}

		.comments_dropdown_content {
		  display: none;
		  position: absolute;
		  background-color: #f1f1f1;
		  min-width: 70px;
		  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
		  z-index: 1;
		}

		.comments_dropdown_content a {
		  color: black;
		  padding: 12px 16px;
		  text-decoration: none;
		  display: block;
		}

		.dropdown-content a:hover {background-color: #ddd;}

		.comments_dropdown:hover .comments_dropdown_content {display: block;}

		.comments_dropdown:hover  {background-color: #3e8e41;}
	</style>
	<style>
		.modal-dialog-full-width {
			width: 100% !important;
			height: 100% !important;
			margin: 0 !important;
			padding: 0 !important;
			max-width:none !important;
		}

		.modal-content-full-width  {
			height: auto !important;
			min-height: 100% !important;
			border-radius: 0 !important;
			background-color: #ececec !important 
		}

		.modal-header-full-width  {
			border-bottom: 1px solid #9ea2a2 !important;
		}

		.modal-footer-full-width  {
			border-top: 1px solid #9ea2a2 !important;
		}
		.photo-card{
			box-sizing: border-box;
			position: relative;
			overflow: hidden;
			height: 35px;
			display: flex;
			/*align-items: flex-end;*/
			transition: all ease .3s;
			border-top: 1px solid #eaebec !important;
			padding-top:10px;
		}
		.photo-card-content{
			position: relative;
			width: 100%;
			z-index: 2;
			display: flex;
			justify-content: space-between;
			align-items: center;
		}
		.loader_overlay{position: absolute;left: 0; top: 0; right: 0; bottom: 0;z-index: 2;background-color: rgba(255,255,255,0.8);}
		.loader_overlay_content {
			position: absolute;
			transform: translateY(-50%);
			 -webkit-transform: translateY(-50%);
			 -ms-transform: translateY(-50%);
			top: 50%;
			left: 0;
			right: 0;
			text-align: center;
			color: #555;
		}
	</style>
	<body>
		<?php include_once 'header.php'; ?>
		<div class="py-0">
			<div class="container">
				<div class="row">
				   <main class="col col-xl-9 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
					  <div class="box shadow-sm border rounded bg-white mb-3 osahan-share-post">
						 <h5 class="pl-3 pt-3 pr-3 border-bottom mb-0 pb-3">Manage your gallery</h5>
						 <ul class="nav border-bottom osahan-line-tab" id="myTab" role="tablist">
							<li class="nav-item">
							   <a class="nav-link active" id="home-tab" data-toggle="tab" href="#personal_gallery_data_tab" role="tab" aria-controls="home" aria-selected="true">Personal</a>
							</li>
							<li class="nav-item">
							   <a class="nav-link" id="profile-tab" data-toggle="tab" href="#professional_gallery_data_tab" role="tab" aria-controls="profile" aria-selected="false">Professional</a>
							</li>
							<!--<li class="nav-item">
							   <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Pages</a>
							</li>
							<li class="nav-item">
							   <a class="nav-link" id="type-tab" data-toggle="tab" href="#type" role="tab" aria-controls="type" aria-selected="false">Hashtags</a>
							</li>-->
						 </ul>
						 <div class="tab-content" id="myTabContent">	
							<div class="tab-pane fade show active" id="personal_gallery_data_tab" role="tabpanel" aria-labelledby="home-tab">
								<div class="p-3">
									<div class="row">
										<div class="col-md-12 col-sm-12 col-lg-12">
											<div class="row">
											<?php
												$is_professional=0;
												$preloadedFiles = array();
												$query = $conn->query("SELECT * FROM gallery WHERE user_id='".$_COOKIE['uid']."' AND is_professional='$is_professional' AND is_draft=0 ORDER BY `index` ASC");
												if ($query && $query->num_rows > 0) {
													while($row = $query->fetch_assoc()) {
														
														#===========================================
														$c_query="SELECT * FROM media_comments WHERE media_id='".$row['id']."'";
														$c_result=mysqli_query($conn,$c_query);
														$comments_num_rows=mysqli_num_rows($c_result);
														#============================================
														$l_query="SELECT * FROM media_likes WHERE media_id='".$row['id']."'";
														$l_result=mysqli_query($conn,$l_query);
														$likes_num_rows=mysqli_num_rows($l_result);
														#============================================
														$s_query="SELECT * FROM media_shares WHERE media_id='".$row['id']."'";
														$s_result=mysqli_query($conn,$s_query);
														$shares_num_rows=mysqli_num_rows($s_result);
														#============================================
														$preloadedFiles[] = array(
															'id' => $row['id'],
															'title' => $row['title'],
															'user_id' => $row['user_id'],
															'type' => $row['type'],
															'size' => $row['size'],
															'file' => $row['file'],
															'comments_num_rows' => $comments_num_rows,
															'likes_num_rows' => $likes_num_rows,
															'shares_num_rows' => $shares_num_rows,
															'date' => $row['date'],
															'isMain' => $row['is_main'],
															'isBanner' => $row['is_banner']
														);
														
													}
													if(count($preloadedFiles)>0)
													{
														$last_row=false;
														$next_row=false;
														$count=count($preloadedFiles);
														$i=0;
														foreach($preloadedFiles as $row)
														{
															if($i==0)
															{
																if($count>1)
																{
																	$last_row=$preloadedFiles[$count-1];
																	$next_row=$preloadedFiles[$i+1];
																}
															}
															else
															{
																$last_row=$preloadedFiles[$i-1];
																if($i==($count-1))
																{
																	$next_row=$preloadedFiles[0];
																}
																else
																{
																	$next_row=$preloadedFiles[$i+1];
																}
															}
															?>
															<div class="col-md-3" style="margin-top:10px;">
																<div class="card" style="padding:0px;">
																	<a href="javascript:void(0);" onclick="" id="media_file_clicked_<?php echo $row['id']; ?>" class="media_file_clicked" data-nextuserid="<?php if($next_row){ echo $next_row['user_id']; } ?>" data-prevuserid="<?php if($last_row){ echo $last_row['user_id']; } ?>" data-previd="<?php if($last_row){ echo $last_row['id']; } ?>" data-prevcaption="<?php if($last_row){ echo $last_row['title']; } ?>" data-prevsrc="<?php if($last_row){ echo base_url.$last_row['file']; } ?>" data-nextid="<?php if($next_row){ echo $next_row['id']; } ?>" data-nextcaption="<?php if($next_row){ echo $next_row['title']; } ?>" data-nextsrc="<?php if($next_row){ echo base_url.$next_row['file']; } ?>" data-id="<?php echo $row['id']; ?>" data-src="<?php echo base_url.$row['file']; ?>" data-caption="<?php echo $row['title']; ?>">
																		<img data-id="<?php echo $row['id']; ?>" data-src="<?php echo base_url.$row['file']; ?>" src="<?php echo base_url.$row['file']; ?>" data-caption="<?php echo $row['title']; ?>" class="img-fluid" style="min-height:150px;max-height:151px;width:100%;">
																		<div class="photo-card" data-id="<?php echo $row['id']; ?>" data-src="<?php echo base_url.$row['file']; ?>" data-caption="<?php echo $row['title']; ?>">
																			<div class="photo-card-content">
																				<div style="padding:0px;margin:0px;width:100%;">
																					<!--<h6 style="text-align:center;"><?php echo $row['title']; ?></h6>-->
																					<p style="text-align:center;color:#bfc3da;"> <span class="pull-left">&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-thumbs-up"></i> <?php echo $row['likes_num_rows']; ?></span>
																						<span><i class="fa fa-comments-o"></i> <?php echo $row['comments_num_rows']; ?>   </span>
																						<span class="pull-right"><i class="fa fa-share"></i> <?php echo $row['shares_num_rows']; ?>&nbsp;&nbsp;&nbsp;&nbsp;</span>
																					</p>
																				</div>
																			</div>
																		</div>
																	</a>
																</div>
															</div>
															<?php
															$i=$i+1;
														}
													}
												}
											?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="professional_gallery_data_tab" role="tabpanel" aria-labelledby="profile-tab">
								<div class="p-3">
									<div class="row">
										<div class="col-md-12 col-sm-12 col-lg-12">
											<div class="row">
											<?php
												$is_professional=1;
												$preloadedFiles = array();
												$query = $conn->query("SELECT * FROM gallery WHERE user_id='".$_COOKIE['uid']."' AND is_professional='$is_professional' AND is_draft=0 ORDER BY `index` ASC");
												if ($query && $query->num_rows > 0) {
													while($row = $query->fetch_assoc()) {
														
														#===========================================
														$c_query="SELECT * FROM media_comments WHERE media_id='".$row['id']."'";
														$c_result=mysqli_query($conn,$c_query);
														$comments_num_rows=mysqli_num_rows($c_result);
														#============================================
														$l_query="SELECT * FROM media_likes WHERE media_id='".$row['id']."'";
														$l_result=mysqli_query($conn,$l_query);
														$likes_num_rows=mysqli_num_rows($l_result);
														#============================================
														$s_query="SELECT * FROM media_shares WHERE media_id='".$row['id']."'";
														$s_result=mysqli_query($conn,$s_query);
														$shares_num_rows=mysqli_num_rows($s_result);
														#============================================
														$preloadedFiles[] = array(
															'id' => $row['id'],
															'title' => $row['title'],
															'user_id' => $row['user_id'],
															'type' => $row['type'],
															'size' => $row['size'],
															'file' => $row['file'],
															'comments_num_rows' => $comments_num_rows,
															'likes_num_rows' => $likes_num_rows,
															'shares_num_rows' => $shares_num_rows,
															'date' => $row['date'],
															'isMain' => $row['is_main'],
															'isBanner' => $row['is_banner']
														);
														
													}
													if(count($preloadedFiles)>0)
													{
														$last_row=false;
														$next_row=false;
														$count=count($preloadedFiles);
														$i=0;
														foreach($preloadedFiles as $row)
														{
															if($i==0)
															{
																if($count>1)
																{
																	$last_row=$preloadedFiles[$count-1];
																	$next_row=$preloadedFiles[$i+1];
																}
															}
															else
															{
																$last_row=$preloadedFiles[$i-1];
																if($i==($count-1))
																{
																	$next_row=$preloadedFiles[0];
																}
																else
																{
																	$next_row=$preloadedFiles[$i+1];
																}
															}
															?>
															<div class="col-md-3" style="margin-top:10px;">
																<div class="card" style="padding:0px;">
																	<a href="javascript:void(0);" id="media_file_clicked_<?php echo $row['id']; ?>" class="media_file_clicked" data-nextuserid="<?php if($next_row){ echo $next_row['user_id']; } ?>" data-prevuserid="<?php if($last_row){ echo $last_row['user_id']; } ?>" data-previd="<?php if($last_row){ echo $last_row['id']; } ?>" data-prevcaption="<?php if($last_row){ echo $last_row['title']; } ?>" data-prevsrc="<?php if($last_row){ echo base_url.$last_row['file']; } ?>" data-nextid="<?php if($next_row){ echo $next_row['id']; } ?>" data-nextcaption="<?php if($next_row){ echo $next_row['title']; } ?>" data-nextsrc="<?php if($next_row){ echo base_url.$next_row['file']; } ?>" data-id="<?php echo $row['id']; ?>" data-src="<?php echo base_url.$row['file']; ?>" data-caption="<?php echo $row['title']; ?>">
																		<img data-id="<?php echo $row['id']; ?>" data-src="<?php echo base_url.$row['file']; ?>" src="<?php echo base_url.$row['file']; ?>" data-caption="<?php echo $row['title']; ?>" class="img-fluid" style="min-height:150px;max-height:151px;width:100%;">
																		<div class="photo-card" data-id="<?php echo $row['id']; ?>" data-src="<?php echo base_url.$row['file']; ?>" data-caption="<?php echo $row['title']; ?>">
																			<div class="photo-card-content">
																				<div style="padding:0px;margin:0px;width:100%;">
																					<!--<h6 style="text-align:center;"><?php echo $row['title']; ?></h6>-->
																					<p style="text-align:center;color:#bfc3da;"> <span class="pull-left">&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-thumbs-up"></i> <?php echo $row['likes_num_rows']; ?></span>
																						<span><i class="fa fa-comments-o"></i> <?php echo $row['comments_num_rows']; ?>   </span>
																						<span class="pull-right"><i class="fa fa-share"></i> <?php echo $row['shares_num_rows']; ?>&nbsp;&nbsp;&nbsp;&nbsp;</span>
																					</p>
																				</div>
																			</div>
																		</div>
																	</a>
																</div>
															</div>
															<?php
															$i=$i+1;
														}
													}
												}
											?>
											</div>
										</div>
									</div>
								</div>
							</div>
						 </div>
					  </div>
				   </main>
				   <aside class="col col-xl-3 order-xl-2 col-lg-12 order-lg-2 col-12">
						<?php
							include_once 'people_you_may_know.php';
							$profile=getUserProfileImage($_COOKIE['uid']);
						?>
						<div class="box shadow-sm mb-3 border rounded bg-white ads-box text-center">
							 <div class="image-overlap-2 pt-4">
								<img src="<?php echo $profile; ?>" class="img-fluid rounded-circle shadow-sm" alt="Responsive image">
								<img src="img/jobs.jpg" class="img-fluid rounded-circle shadow-sm" alt="Responsive image">
							 </div>
							 <div class="p-3 border-bottom">
								<h6 class="text-dark"><?php echo $user_row['first_name']." ".$user_row['last_name'] ?>, grow your career by following <span class="font-weight-bold"> RopeYou</span></h6>
								<p class="mb-0 text-muted">Stay up-to industry trends!</p>
							 </div>
							 <div class="p-3">
								<button type="button" class="btn btn-outline-primary btn-sm pl-4 pr-4"> FOLLOW </button>
							 </div>
						</div>
					</aside>
				</div>
			</div>
		</div>
		<?php include_once 'scripts.php';  ?>
		<!--<script src="<?php echo base_url; ?>fileuploader/dist/jquery.fileuploader.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url; ?>fileuploader/examples/gallery/js/custom.js" type="text/javascript"></script>-->
		<?php include_once 'media_viewer.php'; ?> 
	</body>
</html>
