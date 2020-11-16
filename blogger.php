<?php
	if(isset($_REQUEST['__username']) && $_REQUEST['__username']!="")
	{
		include_once 'connection.php';
		$__username=$_REQUEST['__username'];
		$username=str_replace("@","",$__username);
		$_query="SELECT * FROM users WHERE username='$username'";
		$_result=$conn->query($_query);
		if(mysqli_num_rows($_result)>0){
			$_row=mysqli_fetch_array($_result);
			$_user_id=$_row['id'];
			$_user_profile=getUserProfileImage($_user_id);
			?>
			<!DOCTYPE html>
			<html lang="en">
				<head>
					<title>BLOG Bucket of <?php echo $__username; ?> :: RUBlogger</title>
					<meta property="og:url" content="<?php echo base_url.'blogger/'.$__username; ?>" />
					<meta property="og:type" content="website" />
					<meta property="og:title" content="BLOG Bucket of <?php echo $__username; ?> :: RUBlogger" />
					<meta property="og:description" content="BLOG Bucket of <?php echo $__username; ?> :: RUBlogger" />
					<meta property="og:image" content="<?php echo $_user_profile; ?>" />
					<meta property="fb:app_id" content="465307587452391" />
					<link rel="stylesheet" href="<?php echo base_url; ?>css/bootstrap.min.css" />
					<link rel="stylesheet" href="<?php echo base_url; ?>css/style.css" />
					<link rel="stylesheet" href="<?php echo base_url; ?>css/ionicons.min.css" />
					<link rel="stylesheet" href="<?php echo base_url; ?>css/font-awesome.min.css" />
					<link href="<?php echo base_url; ?>css/emoji.css" rel="stylesheet">
					<link href="<?php echo base_url; ?>css/css0b81.css?family=Lato:300,400,400i,700,700i" rel="stylesheet">
					<link rel="shortcut icon" type="image/png" href="<?php echo base_url; ?>images/fav.png"/>
					<link href="<?php echo base_url; ?>fileuploader/dist/font/font-fileuploader.css" rel="stylesheet">
					<link href="<?php echo base_url; ?>fileuploader/dist/jquery.fileuploader.min.css" media="all" rel="stylesheet">
					<link href="<?php echo base_url; ?>fileuploader/examples/avatar/css/jquery.fileuploader-theme-avatar.css" media="all" rel="stylesheet">
					<script>
						localStorage.setItem('base_url',"<?php echo base_url; ?>");
					</script>
					<link href="<?php echo base_url; ?>css/select2.min.css" rel="stylesheet" />
					<link rel="stylesheet" href="<?php echo base_url; ?>css/time-line-css.css" />
				</head>
				<body class="font1" style="background:#4f6873;background-color:#4f6873;">
					
					<?php include_once 'header.php'; ?>
					<section style="padding:2%;">
						<div id="page-contents">
							<div class="row">
								<div class="col-md-2"></div>
								<div class="col-md-8">
									<div class="row">
										<div class="col-md-12" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);transition: box-shadow 83ms;background:#fff;padding:10px;padding-bottom:0px;margin: 0 0px 10px;border-radius:2px;border-bottom: 2px solid #ebebd5;">
											<div class="row">
												<div class="col-md-12" style="padding:10px;margin-bottom:10px;">
													<a  data-toggle="modal" data-target="#blog_modal" href="#" class="pull-left" style="text-decoration:none;color:#4f6873;font-size:20px;"><i class="fa fa-pencil"></i>&nbsp;Write a New Blog</a>
												</div>
											</div>
										</div>
										<div class="modal fade" id="blog_modal" tabindex="-1" role="dialog" aria-hidden="true">
											<div class="modal-dialog modal-lg">
												<div class="modal-content">
													<div class="row">
														<div class="col-md-12" style="padding:30px;">
															<form action="<?php echo base_url; ?>post-blog" method="post">
																<div class="row">
																	<div class="col-md-12" style="border-bottom:1px solid #333;margin-bottom:20px;">
																		<h4 style="text-align:center;font-size:20px;color:#4f6873;">Post a Blog </h4>
																		<h5 style="text-align:center;color:#4f6873;">Let the world know your thoughts</h5>
																	</div>
																	<input type="hidden" name="page_refer" value="blogger">
																	<div class="col-md-12">
																		<div class="form-group">
																			<h5 style="margin-bottom:7px;">Title <span style="color:red;">*</span></h5>
																			<input class="form-control" name="title" id="title" required title="" type="text" placeholder="Blog Title">
																		</div>
																	</div>
																	<div class="col-md-12">
																		<div class="form-group">
																			<h5 style="margin-bottom:7px;">Tags <span style="color:red;">*</span></h5>
																			<input class="form-control" name="tags" id="tags" required title="" type="text" placeholder="enter tags by seperating with ,">
																		</div>
																	</div>
																	<div class="col-md-12">
																		<div class="form-group">
																			<h5 style="margin-bottom:7px;">Description <span style="color:red;">*</span></h5>
																			<textarea name="description" class="form-control" id="description" placeholder="Job Description"></textarea>
																		</div>
																	</div>
																	<div class="col-md-12">
																		<div class="form-group">
																			<h5 style="margin-bottom:7px;">Content <span style="color:red;">*</span></h5>
																			<textarea name="content" class="form-control" id="content" placeholder="Job Description"></textarea>
																		</div>
																	</div>
																	<div class="col-md-12" style="margin-top:10px;padding:20px;">
																		<button class="btn btn-info pull-left" type="submit" name="post_blog">Post</button>
																		<button class="btn btn-default pull-right" type="button" name="cancel" data-toggle="modal" data-dismiss="modal">Cancel</button>
																	</div>
																</div>
															</form>
														</div>
													</div>
											
												</div>
											</div>
										</div>
									</div>
									<?php
										$blogger_query="SELECT * FROM users_blogs WHERE user_id='".$_user_id."' AND status!='2' ORDER BY added DESC";
										$blogger_result=mysqli_query($conn,$blogger_query);
										if(mysqli_num_rows($blogger_result)>0)
										{
											?>
											<div class="row">
											<?php
											while($blogger_row=mysqli_fetch_array($blogger_result))
											{
												?>
												<div class="col-md-12" id="blogg_content_<?php echo $blogger_row['id']; ?>" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);transition: box-shadow 83ms;background:#fff;padding:10px;padding-bottom:0px;margin: 0 0px 10px;border-radius:2px;border-bottom: 2px solid #ebebd5;">
													<div class="row">
														<div class="col-md-12" style="padding:10px;">
															<a href="<?php echo base_url.$blogger_row['blog_url']; ?>" class="pull-left" style="text-decoration:none;color:#4f6873;font-size:20px;"><?php echo $blogger_row['title']; ?></a>
															<?php
																if($_user_id==$_COOKIE['uid'])
																{
															?>
																<a href="#" class="pull-right delete_blog" data-id='<?php echo $blogger_row['id']; ?>' style="text-decoration:none;color:red;font-size:20px;" title="Delete Blog"><i class="fa fa-trash"></i></a>
															<?php
																}
															?>
														</div>
														<div class="col-md-12" style="padding:10px;">
															<ul style="list-style-type: none !important;">
																<li style="display:inline-block !important;margin-right:10px;"><i class="fa fa-calendar"></i> <?php echo date("d M Y",strtotime($blogger_row['added'])); ?></li>
																<li style="display:inline-block !important;margin-right:10px;"><i class="fa fa-heart"></i> <?php echo $blogger_row['likes']; ?></li>
																<li style="display:inline-block !important;margin-right:10px;"><i class="fa fa-share-alt"></i> <?php echo $blogger_row['shares']; ?></li>
															</ul>
														</div>
														<div class="col-md-12" style="padding:20px;">
															<a href="<?php echo base_url.$blogger_row['blog_url']; ?>" style="color:#4f6873;font-size:16px;text-decoration:none;"><?php echo substr(strip_tags($blogger_row['content']),0,500)." <span style='color:blue;'>.... Read More</span>"; ?></a>
														</div>
													</div>
												</div>
												<?php
											}
											?>
											</div>
											<?php
										}
									?>
								</div>
								<div class="col-md-2"></div>
							</div>
						</div>	
					</section>
						<!-- Footer
					================================================= -->
					<?php include_once 'footer.php'; ?>  
					<?php include_once 'scripts.php';  ?>
					<script src="https://cdn.tiny.cloud/1/uvg9xyxkcmqkpjaacpgnzrroxnefi5c72vf0k2u5686rwdmv/tinymce/5/tinymce.min.js"></script>
					<script>tinymce.init({selector:'textarea',height:320,branding:false,resize:false});</script>
					<script>
						var base_url="<?php echo base_url; ?>";
						$(".delete_blog").bind("click",function(e){
							var blog_id=$(this).attr("data-id");
							if(blog_id=="" || blog_id==null)
							{
								swal({
								  title: "Invalid action",
								  text: "Action you are trying to perform is not valid.",
								  icon: "error",
								  buttons: {
									cancel: false,
									confirm: "Close",
								  },
								  dangerMode: false,
								});
							}
							else
							{
								$.ajax({
									url:base_url+'delete-blog',
									type:'post',
									data:{blog_id:blog_id},
									success:function(res){
										if(res=="SUCCESS")
										{
											$("#blogg_content_"+blog_id).remove();
										}
										else
										{
											swal({
											  title: "Oh!, Snap",
											  text: "Something went wrong please try again.",
											  icon: "error",
											  buttons: {
												cancel: false,
												confirm: "Close",
											  },
											  dangerMode: false,
											});
										}
									}
								});
							}
						});
					</script>
				</body>
			</html>
			
			<?php
		}
		else
		{
			include_once 'blogger_404.php';
		}
	}
	else
	{
?>
		<!DOCTYPE html>
		<html lang="en">
			<title>RUBlogger</title>
			<?php include_once 'head.php'; ?>	
			<link rel="stylesheet" href="<?php echo base_url; ?>css/time-line-css.css" />
			
			<body style="background:#4f6873;background-color:#4f6873;">
			
			<!-- Header
			================================================= -->
			<?php include_once 'header.php'; ?>
			<!--Header End-->
			
			<section style="padding:2%;">
				<div id="page-contents">
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-8">
<div class="box p-4 blog-post shadow-sm border rounded bg-white">
						<form action="<?php echo base_url; ?>post-blog" method="post">
														<div class="row">
														<div class="col-md-12" style="">
																<h4 class="font-weight-bold" style="">Post a Blog </h4>
																<h5 class="border-bottom mb-4 pb-3" style="">Let the world know your thoughts</h5>
															</div>
															<input type="hidden" name="page_refer" value="blogger">
															<div class="col-md-12">
																<div class="form-group">
																	<h6 style="margin-bottom:7px;">Title <span style="color:red;">*</span></h6>
																	<input class="form-control" name="title" id="title" required title="" type="text" placeholder="Blog Title">
																</div>
															</div>
															<div class="col-md-12">
																<div class="form-group">
																	<h6 style="margin-bottom:7px;">Tags <span style="color:red;">*</span></h6>
																	<input class="form-control" name="tags" id="tags" required title="" type="text" placeholder="enter tags by seperating with ,">
																</div>
															</div>
															<div class="col-md-12">
																<div class="form-group">
																	<h6 style="margin-bottom:7px;">Description <span style="color:red;">*</span></h6>
																	<textarea name="description" class="form-control" id="description" placeholder="Job Description"></textarea>
																</div>
															</div>
															<div class="col-md-12">
																<div class="form-group">
																	<h6 style="margin-bottom:7px;">Content <span style="color:red;">*</span></h6>
																	<textarea name="content" class="form-control" id="content" placeholder="Job Description"></textarea>
																</div>
															</div>
															<div class="col-md-12 text-right">
																
																<button class="btn btn-default" type="button" name="cancel" data-toggle="modal" data-dismiss="modal">Cancel</button>
																<button class="btn btn-primary" type="submit" name="post_blog">Post</button>
															</div>
														</div>
													</form>
	</div>

							<!-- <div class="row">
								<div class="col-md-12" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);transition: box-shadow 83ms;background:#fff;padding:10px;padding-bottom:0px;margin: 0 0px 10px;border-radius:2px;border-bottom: 2px solid #ebebd5;">
									<div class="row">
										<div class="col-md-12" style="padding:10px;margin-bottom:10px;">
											<a data-toggle="modal" data-target="#blog_modal" href="javascript:void(0);" class="pull-left" style="text-decoration:none;color:#4f6873;font-size:20px;"><i class="fa fa-pencil"></i>&nbsp;Write a New Blog</a>
										</div>
									</div>
								</div>
								<div class="modal fade" id="blog_modal" tabindex="-1" role="dialog" aria-hidden="true">
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
											<div class="row">
												<div class="col-md-12" style="padding:30px;">
													
												</div>
											</div>
									
										</div>
									</div>
								</div>
							</div> -->
							<?php
								$blogger_query="SELECT * FROM users_blogs WHERE user_id='".$_COOKIE['uid']."' AND status!='2' ORDER BY added DESC";
								$blogger_result=mysqli_query($conn,$blogger_query);
								if(mysqli_num_rows($blogger_result)>0)
								{
									?>
									<div class="row">
									<?php
									while($blogger_row=mysqli_fetch_array($blogger_result))
									{
										?>
										<div class="col-md-12" id="blogg_content_<?php echo $blogger_row['id']; ?>" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);transition: box-shadow 83ms;background:#fff;padding:10px;padding-bottom:0px;margin: 0 0px 10px;border-radius:2px;border-bottom: 2px solid #ebebd5;">
											<div class="row">
												<div class="col-md-12" style="padding:10px;">
													<a href="<?php echo base_url.$blogger_row['blog_url']; ?>" class="pull-left" style="text-decoration:none;color:#4f6873;font-size:20px;"><?php echo $blogger_row['title']; ?></a>
													<a href="#" class="pull-right delete_blog" data-id='<?php echo $blogger_row['id']; ?>' style="text-decoration:none;color:red;font-size:20px;" title="Delete Blog"><i class="fa fa-trash"></i></a>
												</div>
												<div class="col-md-12" style="padding:10px;">
													<ul style="list-style-type: none !important;">
														<li style="display:inline-block !important;margin-right:10px;"><i class="fa fa-calendar"></i> <?php echo date("d M Y",strtotime($blogger_row['added'])); ?></li>
														<li style="display:inline-block !important;margin-right:10px;"><i class="fa fa-heart"></i> <?php echo $blogger_row['likes']; ?></li>
														<li style="display:inline-block !important;margin-right:10px;"><i class="fa fa-share-alt"></i> <?php echo $blogger_row['shares']; ?></li>
													</ul>
												</div>
												<div class="col-md-12" style="padding:20px;">
													<a href="<?php echo base_url.$blogger_row['blog_url']; ?>" style="color:#4f6873;font-size:16px;text-decoration:none;"><?php echo substr(strip_tags($blogger_row['content']),0,500)." <span style='color:blue;'>.... Read More</span>"; ?></a>
												</div>
											</div>
										</div>
										<?php
									}
									?>
									</div>
									<?php
								}
							?>
						</div>
						<div class="col-md-2"></div>
					</div>
				</div>	
			</section>
				<!-- Footer
			================================================= -->
			<?php include_once 'footer.php'; ?>  
			<?php include_once 'scripts.php';  ?>
			<script src="https://cdn.tiny.cloud/1/uvg9xyxkcmqkpjaacpgnzrroxnefi5c72vf0k2u5686rwdmv/tinymce/5/tinymce.min.js"></script>
			<script>tinymce.init({selector:'textarea',height:320,branding:false,resize:false});</script>
			<script>
				var base_url="<?php echo base_url; ?>";
				$(".delete_blog").bind("click",function(e){
					var blog_id=$(this).attr("data-id");
					if(blog_id=="" || blog_id==null)
					{
						swal({
						  title: "Invalid action",
						  text: "Action you are trying to perform is not valid.",
						  icon: "error",
						  buttons: {
							cancel: false,
							confirm: "Close",
						  },
						  dangerMode: false,
						});
					}
					else
					{
						$.ajax({
							url:base_url+'delete-blog',
							type:'post',
							data:{blog_id:blog_id},
							success:function(res){
								if(res=="SUCCESS")
								{
									$("#blogg_content_"+blog_id).remove();
								}
								else
								{
									swal({
									  title: "Oh!, Snap",
									  text: "Something went wrong please try again.",
									  icon: "error",
									  buttons: {
										cancel: false,
										confirm: "Close",
									  },
									  dangerMode: false,
									});
								}
							}
						});
					}
				});
			</script>
		</body>
		</html>
<?php
	}
?>