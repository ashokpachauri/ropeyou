<?php 
	include_once 'connection.php';
	$user_row=null;
	$username=$_REQUEST['__username'];
	$uquery="SELECT * FROM users WHERE username='$username' AND status=1";
	$uresult=mysqli_query($conn,$uquery);
	if(mysqli_num_rows($uresult)>0)
	{
	
		$userrow=mysqli_fetch_array($uresult);
		$profile_user_id=$userrow['id'];
	?>
		<head>
				<?php 
					include_once 'profile-head.php';
					$user_id=$profile_user_id;
				?>
		<title><?php echo ucwords(strtolower($userrow['first_name'].' '.$userrow['last_name'])); ?>'s Gallery | RopeYou Connects</title>
		<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
		<link href="<?php echo base_url; ?>fileuploader/dist/font/font-fileuploader.css" rel="stylesheet">
		<link href="<?php echo base_url; ?>fileuploader/dist/jquery.fileuploader.min.css" media="all" rel="stylesheet">
		<link href="<?php echo base_url; ?>fileuploader/examples/gallery/css/jquery.fileuploader-theme-gallery.css" media="all" rel="stylesheet">
	</head>
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
		<?php 
			include_once 'header.php';
			$user_id=$profile_user_id;
			$uquery="SELECT * FROM users WHERE id='$profile_user_id'";
			$uresult=mysqli_query($conn,$uquery);
			$userrow=mysqli_fetch_array($uresult);
		?>
		<div class="py-0">
			<div class="container">
				<div class="row">
				   <main class="col col-xl-9 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
					  <div class="box shadow-sm border rounded bg-white mb-3 osahan-share-post">
						 <h5 class="pl-3 pt-3 pr-3 border-bottom mb-0 pb-3"><?php echo ucwords(strtolower($userrow['first_name'].' '.$userrow['last_name'])); ?>'s Gallery</h5>
						 <ul class="nav border-bottom osahan-line-tab" id="myTab" role="tablist">
							<li class="nav-item">
							   <a class="nav-link active" id="home-tab" data-toggle="tab" href="#personal_gallery_data_tab" role="tab" aria-controls="home" aria-selected="true">Personal</a>
							</li>
							<li class="nav-item">
							   <a class="nav-link" id="profile-tab" data-toggle="tab" href="#professional_gallery_data_tab" role="tab" aria-controls="profile" aria-selected="false">Professional</a>
							</li>
						 </ul>
						 <div class="tab-content" id="myTabContent">
							<div class="modal fade" id="gallery_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="amazingProfileImageBackdrop" aria-hidden="true">
								<div class="modal-dialog modal-lg modal-dialog-full-width" role="document">
									<div class="modal-content modal-content-full-width">
										
										<?php
											$usquery="SELECT * FROM users WHERE id='".$_COOKIE['uid']."'";
											$usresult=mysqli_query($conn,$usquery);
											$user_row=mysqli_fetch_array($usresult);
										?>
										<div class="modal-body" style="overflow-y:auto;padding:0px;height:100%;bottom:0px;background:rgb(25, 29, 30);">											
											<div class="row" style="min-height:100%;padding:0px;margin:0px;">
												<div class="col-md-8 img-responsive text-center" style="min-height:100%;top:0px;bottom:0;left:0;position:fixed;">
													<div class="row">
														<div class="col-md-12" style="max-height:100%;min-height:100%;padding:50px;">
															<div class="row">
																<div class="col-md-12" style="padding:10px;margin-top:-20px;padding-bottom:20px;">
																	<a href="javascript:void(0);" style="height:22px;width:22px;padding:1px;" onclick="cInterval();" data-dismiss="modal" class="pull-right btn btn-danger" title="Close">
																		<i class="fa fa-times" style="font-size:18px;"></i>
																	</a>
																</div>
																<div class="col-md-1">
																	<a href="javascript:void(0);" class="pull-left" title="Prev">
																		<i class="fa fa-arrow-left" style="font-size:24px;color:#fff;"></i>
																	</a>
																</div>
																<div class="col-md-10" style="padding-top:20px;padding-bottom:20px;height:calc(100vh - 100px)">
																	<div class="row">
																		<div class="col-md-12" style="height:480px;">
																			<img src="https://ropeyou.com/rope/uploads/jRC2wSLGr5pb.jpg" data-src="https://ropeyou.com/rope/uploads/jRC2wSLGr5pb.jpg" data-download="jRC2wSLGr5pb.jpg" id="projector_image" class="img-fluid" style="height:100%;">
																		</div>
																	</div>
																</div>
																<div class="col-md-1">
																	<a href="javascript:void(0);" class="pull-right" title="Next">
																		<i class="fa fa-arrow-right" style="font-size:24px;color:#fff;"></i>
																	</a>
																</div>
																<div class="col-md-12 text-center" style="margin-top:30px;top:calc(100vh - 70px);position:absolute;left:0px;border-top:1px solid #fff;padding:10px;">
																	<a href="javascript:void(0);" title="Tag your connections">
																		<i class="fa fa-tag" style="font-size:24px;color:#fff;"></i>
																	</a>
																	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																	<a href="javascript:void(0);" id="projector_image_download" data-src="" data-download= "" download="" title="Download">
																		<i class="fa fa-download" style="font-size:24px;color:#fff;"></i>
																	</a>
																	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																	<a href="javascript:void(0);" title="Share">
																		<i class="fa fa-share" style="font-size:24px;color:#fff;"></i>
																	</a>
																	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																	<a href="javascript:void(0);" title="Make this your profile">
																		<i class="fa fa-user" style="font-size:24px;color:#fff;"></i>
																	</a>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-4" style="min-height:100%;padding:0px;top:0px;bottom:0;right:0;position:fixed;background:#fff;overflow-y:auto;overflow-x:hidden;">
													<div class="row">
														<div class="col-md-12" style="max-height:calc(100vh-100px);overflow-y:auto;padding:0px;margin:0px;margin-bottom:100px;">
															<div class="p-3 d-flex align-items-center w-100" href="#">
																<div class="dropdown-list-image mr-3">
																	<img class="rounded-circle media_user_image" src="<?php echo getUserProfileImage($profile_user_id); ?>" alt="User Profile Picture"  style="border:1px solid #eaebec !important;">
																	<div class="status-indicator bg-success"></div>
																</div>
																<div class="w-100">
																	<h6 class='media_user'></h6>
																	<span class='media_post_date'></span>
																</div>
															</div>
															<div class="border-top p-3 d-flex align-items-center media_text_content">
																<div class="row">
																	<div class="col-md-12" style="padding-top:5px;">
																		<p style="font-size:16px;text-align:left !important;" id='media_text_content'></p>
																		<button type="button" class="btn btn-secondary">Edit</button>
																	</div>
																</div>
															</div>
															<div class="border-top p-3 align-items-center">
																<div class="row">
																	<div class="col-md-12" style="padding-top:5px;font-size:16px;">
																		<a href="javascript:void(0);" style="float:left !important;"><i class="fa fa-thumbs-up"></i>&nbsp;&nbsp;<span id='likes_count'>0</span></a>
																		<a href="javascript:void(0);" style="float:right !important;"><i class="fa fa-comments-o"></i>&nbsp;&nbsp;<span id='comments_count'>0</span> comments</a>
																	</div>
																</div>
															</div>
															<div class="border-top p-2 align-items-center">
																<div class="row" id="comments_section">
																</div>
															</div>
													
														</div>
														<div class="col-md-12" style="min-height:54px;max-height:55px;position:fixed;bottom:0px;right:0px;top:calc(100vh-55px);left:calc(67%);background-color:#fff;">
															<div class="row">
																<div class="col-md-12">
																	<div class="d-flex align-items-center w-100">
																		<div class="dropdown-list-image mr-3">
																			<img class="rounded-circle"  src="<?php  echo $profile; ?>" alt="<?php echo ucwords(strtolower($user_row['first_name'].' '.$user_row['last_name'])); ?>"  style="border:1px solid #eaebec !important;">
																			<div class="status-indicator bg-success"></div>
																		</div>
																		<div class="w-100">
																			<input type="text" data-media="" id="do_media_comment" data-userid="<?php echo $_COOKIE['uid']; ?>" data-src="<?php  echo $profile; ?>" data-username="<?php echo $user_row['username']; ?>" data-name="<?php echo ucwords(strtolower($user_row['first_name'].' '.$user_row['last_name'])); ?>" style="height:50px;border-radius:30px;width:350px;outline:none;padding: 5px 17px;" placeholder="Write a comment...">
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="loader_overlay">
														<div class="loader_overlay_content"><img src="<?php echo base_url; ?>loader.gif" alt="Loading..."/></div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane fade show active" id="personal_gallery_data_tab" role="tabpanel" aria-labelledby="home-tab">
								<div class="p-3">
									<div class="row">
										<div class="col-md-12 col-sm-12 col-lg-12">
											<div class="row">
											<?php
												$is_professional=0;
												$preloadedFiles = array();
												$query = $conn->query("SELECT * FROM gallery WHERE user_id='".$profile_user_id."' AND is_professional='$is_professional' AND is_draft=0 ORDER BY `index` ASC");
												if ($query && $query->num_rows > 0) {
													while($row = $query->fetch_assoc()) {
														$preloadedFiles[] = array(
															'id' => $row['id'],
															'name' => $row['title'],
															'type' => $row['type'],
															'size' => $row['size'],
															'file' => $row['file'],
															'data' => array(
																'readerForce' => true,
																'url' => $row['file'],
																'date' => $row['date'],
																'isMain' => $row['is_main'],
																'isBanner' => $row['is_banner'],
																'listProps' => array(
																	'id' => $row['id'],
																)
															),
														);
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
														?>
														<div class="col-md-3" style="margin-top:10px;">
															<div class="card" style="padding:0px;">
																<a href="javascript:void(0);" class="media_file_clicked" data-id="<?php echo $row['id']; ?>" data-src="<?php echo base_url.$row['file']; ?>" data-caption="<?php echo $row['title']; ?>">
																	<img data-id="<?php echo $row['id']; ?>" data-src="<?php echo base_url.$row['file']; ?>" src="<?php echo base_url.$row['file']; ?>" data-caption="<?php echo $row['title']; ?>" class="img-fluid" style="min-height:150px;max-height:151px;width:100%;">
																	<div class="photo-card" data-id="<?php echo $row['id']; ?>" data-src="<?php echo base_url.$row['file']; ?>" data-caption="<?php echo $row['title']; ?>">
																		<div class="photo-card-content">
																			<div style="padding:0px;margin:0px;width:100%;">
																				<!--<h6 style="text-align:center;"><?php echo $row['title']; ?></h6>-->
																				<p style="text-align:center;color:#bfc3da;"> <span class="pull-left">&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-thumbs-up"></i> <?php echo $likes_num_rows; ?></span>
																					<span><i class="fa fa-comments-o"></i> <?php echo $comments_num_rows; ?>   </span>
																					<span class="pull-right"><i class="fa fa-share"></i> <?php echo $shares_num_rows; ?>&nbsp;&nbsp;&nbsp;&nbsp;</span>
																				</p>
																			</div>
																		</div>
																	</div>
																</a>
															</div>
														</div>
														<?php
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
												$query = $conn->query("SELECT * FROM gallery WHERE user_id='".$profile_user_id."' AND is_professional='$is_professional' AND is_draft=0 ORDER BY `index` ASC");
												if ($query && $query->num_rows > 0) {
													while($row = $query->fetch_assoc()) {
														$preloadedFiles[] = array(
															'id' => $row['id'],
															'name' => $row['title'],
															'type' => $row['type'],
															'size' => $row['size'],
															'file' => $row['file'],
															'data' => array(
																'readerForce' => true,
																'url' => $row['file'],
																'date' => $row['date'],
																'isMain' => $row['is_main'],
																'isBanner' => $row['is_banner'],
																'listProps' => array(
																	'id' => $row['id'],
																)
															),
														);
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
														?>
														<div class="col-md-3" style="margin-top:10px;">
															<div class="card" style="padding:0px;">
																<a href="javascript:void(0);" class="media_file_clicked" data-id="<?php echo $row['id']; ?>" data-src="<?php echo base_url.$row['file']; ?>" data-caption="<?php echo $row['title']; ?>">
																	<img data-id="<?php echo $row['id']; ?>" data-src="<?php echo base_url.$row['file']; ?>" src="<?php echo base_url.$row['file']; ?>" data-caption="<?php echo $row['title']; ?>" class="img-fluid" style="min-height:150px;max-height:151px;width:100%;">
																	<div class="photo-card" data-id="<?php echo $row['id']; ?>" data-src="<?php echo base_url.$row['file']; ?>" data-caption="<?php echo $row['title']; ?>">
																		<div class="photo-card-content">
																			<div style="padding:0px;margin:0px;width:100%;">
																				<!--<h6 style="text-align:center;"><?php echo $row['title']; ?></h6>-->
																				<p style="text-align:center;color:#bfc3da;"> <span class="pull-left">&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-thumbs-up"></i> <?php echo $likes_num_rows; ?></span>
																					<span><i class="fa fa-comments-o"></i> <?php echo $comments_num_rows; ?>   </span>
																					<span class="pull-right"><i class="fa fa-share"></i> <?php echo $shares_num_rows; ?>&nbsp;&nbsp;&nbsp;&nbsp;</span>
																				</p>
																			</div>
																		</div>
																	</div>
																</a>
															</div>
														</div>
														<?php
													}
												}
											?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
							   <div class="p-3 w-100">
								  <h6>Soon in next free update</h6>
							   </div>
							</div>
							<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
							   <div class="p-3 w-100">
								  <h6>Soon in next free update</h6>
							   </div>
							</div>
							<div class="tab-pane fade" id="type" role="tabpanel" aria-labelledby="type-tab">
							   <div class="p-3 w-100">
								  <h6>Soon in next free update</h6>
							   </div>
							</div>-->
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
							<img src="<?php echo base_url; ?>img/jobs.jpg" class="img-fluid rounded-circle shadow-sm" alt="Responsive image">
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
		<script src="<?php echo base_url; ?>fileuploader/dist/jquery.fileuploader.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url; ?>fileuploader/examples/gallery/js/custom.js" type="text/javascript"></script>
		<script>
			$(document).ready(function(){
				//$("#gallery_modal").modal('show');
			});
			function loadAjax(img_id){
				$.ajax({
					url:base_url+'get-media-comments',
					type:'post',
					data:{id:img_id},
					success:function(res)
					{
						var parsedJson=JSON.parse(res);
						console.log(res);
						$(".media_user_image").prop("src",parsedJson.user.profile_image);
						$(".media_user").html(parsedJson.user.name);
						$(".media_post_date").html(parsedJson.date);
						if(parsedJson.text_content!='' && parsedJson.text_content!=null)
						{
							$("#media_text_content").html(parsedJson.text_content);
							$(".media_text_content").show();
						}
						else
						{
							$("#media_text_content").hide();
						}
						
						var comments_section="";
						$("#comments_count").html(parseInt(parsedJson.count));
						$("#likes_count").html(parseInt(parsedJson.likes_count));
						if(parseInt(parsedJson.count)>0)
						{
							var comments=parsedJson.comments;
							for(i=0;i<comments.length;i++)
							{
								var comment=comments[i];
								comments_section+='<div class="col-md-12">'+
								'<div class="p-2 d-flex align-items-center w-100">'+
									'<div class="dropdown-list-image mr-3">'+
										'<img class="rounded-circle" data-mediaid="" src="'+comment.user.profile_image+'" alt="'+comment.user.name+'"  style="border:1px solid #eaebec !important;">'+
										'<div class="status-indicator bg-success"></div>'+
									'</div>'+
									'<div class="w-100">'+
										'<h6>'+comment.user.name+'</h6>'+
										'<span>'+comment.date+'</span>'+
										'<p style="font-size:16px;">'+comment.text_content+
										'</p>'+
									'</div>'+
								'</div>'+
							'</div>';
							}
						}
						$("#comments_section").html(comments_section);
						$(".loader_overlay").hide();
					}
				});
			}
			var interval=null;
			$(".media_file_clicked").click(function(){
				$("#comments_section").html('');
				$(".loader_overlay").show();
				var img_src=$(this).data('src');
				var img_title=$(this).data('caption');
				var img_id=$(this).data('id');
				$("#projector_image").data("download",img_title);
				$("#projector_image").data("src",img_src);
				$("#projector_image").prop("src",img_src);
				$("#projector_image_download").data("download",img_title);
				$("#projector_image_download").prop("download",img_title);
				$("#projector_image_download").data("src",img_src);
				$("#projector_image_download").attr("href",img_src);
				interval=setInterval(function(){ loadAjax(img_id); }, 5000);
				
				$("#gallery_modal").modal('show');
				$("#do_media_comment").data("media",img_id);
			});
			function cInterval(){
				clearInterval(interval);
			}
			$("#do_media_comment").on('keyup', function (e) {
				if (e.key === 'Enter' || e.keyCode === 13) {
					var media_id=$("#do_media_comment").data("media");
					var user_id=$("#do_media_comment").data("userid");
					var name=$("#do_media_comment").data("name");
					var profile_image=$("#do_media_comment").data("src");
					var username=$("#do_media_comment").data("username");
					var text_content=$("#do_media_comment").val();
					var date='Just Now';
					if(text_content!="" && text_content!=null)
					{
						var comments_section="";
						comments_section+='<div class="col-md-12">'+
							'<div class="p-2 d-flex align-items-center w-100">'+
								'<div class="dropdown-list-image mr-3">'+
									'<img class="rounded-circle" data-mediaid="" src="'+profile_image+'" alt="'+name+'"  style="border:1px solid #eaebec !important;">'+
									'<div class="status-indicator bg-success"></div>'+
								'</div>'+
								'<div class="w-100">'+
									'<h6>'+name+'</h6>'+
									'<span>'+date+'</span>'+
									'<p style="font-size:16px;">'+text_content+
									'</p>'+
								'</div>'+
							'</div>'+
						'</div>';
						
						$("#comments_section").append(comments_section);
						$("#do_media_comment").val('');
						$.ajax({
							url:base_url+'save-media-comments',
							type:'post',
							data:{media_id:media_id,user_id:user_id,text_content:text_content,comment_id:''},
							success:function(response)
							{
								//loadAjax(media_id);
							}
						});
					}
					
				}
			});
		</script>
	</body>
</html>
<?php
	}
	else
	{
		include_once '404.php';
	}
?>
