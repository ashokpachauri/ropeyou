<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
	<head>
		<?php 
			include_once 'head.php';
			$id=$_COOKIE['uid'];
			$query="SELECT * FROM users WHERE id='$id'";
			$result=mysqli_query($conn,$query);
			$row=mysqli_fetch_array($result);
			
			$profile=getUserProfileImage($id);
			$profile_banner=getUserBannerImage($id);
			$user_profile_banner=$profile_banner;
			$profile_image=$profile;
			$blog_url="";
			
			if(isset($_REQUEST['blog_tag']) && $_REQUEST['blog_tag']!="")
			{
				$blog_tag=$_REQUEST['blog_tag'];
				$blog_url="@rub-".$blog_tag;
				//$break=explode("-",$blog_tag);
				//$mixture=explode(".html",end($break));
				//$blog_id=$mixture[0];
				$blogs_query="SELECT * FROM users_blogs WHERE blog_url='$blog_url' AND status=1 ORDER BY added DESC";
				$blogs_result=mysqli_query($conn,$blogs_query);
				$num_rows=mysqli_num_rows($blogs_result);
				$blogs_row=mysqli_fetch_array($blogs_result);
				
				$og_title=trim($blogs_row['title']);
				
				//$og_title=trim(strtolower($blogs_row['title']));
				$og_url=$blog_url;
				
				$og_description=$blogs_row['description'];
				?>
				<title><?php echo $og_title; ?> :: RUBlogger</title>
				<meta property="og:url" content="<?php echo base_url.$blog_url; ?>" />
				<meta property="og:type" content="website" />
				<meta property="og:title" content="<?php echo $og_title; ?>" />
				<meta property="og:description" content="<?php echo substr(strip_tags($og_description),0,100); ?>" />
				<meta property="og:image" content="<?php echo base_url.'uploads/@my_tag.jpg'; ?>" />
				<meta property="fb:app_id" content="465307587452391" />
				<?php
			}
			else
			{
				?>
				<title>RUBlogger | RopeYou Connects</title>
				<?php
			}
		?>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url; ?>css/feeling.css" />
	</head>
	<body>
		<?php include_once 'header.php'; ?>
		<div class="py-4">
			<div class="container">
				<div class="row">
				   <!-- Main Content -->
				   <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
					 <?php
						//echo $blog_url;
						$blogs_query="SELECT * FROM users_blogs WHERE blog_url='$blog_url' AND status=1 ORDER BY added DESC";
						$blogs_result=mysqli_query($conn,$blogs_query);
						$num_rows=mysqli_num_rows($blogs_result);
						$blogs_row=mysqli_fetch_array($blogs_result);
						$_user_id=$blogs_row['user_id'];
						
						$_query="SELECT * FROM users WHERE id='$_user_id'";
						$_result=mysqli_query($conn,$_query);
						$p_user_row=$_row=mysqli_fetch_array($_result);
						$_username=$_row['username'];
						$og_title=$blogs_row['title'];
						$og_description=$blogs_row['description'];
						if($num_rows>0)
						{
							
							$blog_status_style="background:#00c4b5;";
							$blog_status="";
							if($blogs_row['status']=="0")
							{
								$blog_status_style="background:red;";
								$blog_status= "Pending";
							}
							else if($blogs_row['status']=="1")
							{
								$blog_status_style="background:#00c4b5;";
								$blog_status= "Active";
							}
							else if($blogs_row['status']=="2")
							{
								$blog_status_style="background:#333;";
								$blog_status= "Closed";
							}
							$p_user_profile=getUserProfileImage($_user_id);
							
							$time="";

									$t=strtotime('now')- strtotime($blogs_row['added']);

									$days=floor($t/(60*60*24));

									$hours=floor(($t/(60*60))-($days*24));

									$minutes=floor(($t/(60))-($days*24)-($hours*60));

									$seconds=floor(($t)-($days*24)-($hours*60)-($minutes*60));

									if($days!=0)

									{

										$time="about ".$days." days ago.";

									}

									else if($hours!=0){

										$time="about ".$hours." hours ago.";

									}

									else if($minutes!=0){

										$time="about ".$minutes." minutes ago.";

									}

									else if($seconds!=0){

										$time="about ".$seconds." seconds ago.";

									}
								?>
								<div class="box shadow-sm border rounded bg-white mb-3 osahan-post">
									<div class="p-3 d-flex align-items-center border-bottom osahan-post-header">
										<div class="dropdown-list-image mr-3">
										   <img class="rounded-circle" style="border:1px solid #eaebec !important;" src="<?php echo $p_user_profile; ?>" alt="<?php echo $p_user_row['first_name']." ".$p_user_row['last_name']; ?>">
										   <div class="status-indicator bg-success"></div>
										</div>
										<div class="font-weight-bold">
										   <div class="text-truncate"><?php echo $p_user_row['first_name']." ".$p_user_row['last_name']; ?></div>
										   <div class="small text-gray-500"><?php echo $p_user_row['profile_title']; ?></div>
										</div>
										<span class="ml-auto small"><?php echo $time; ?></span>
									</div>
									<div class="p-3">
										<div class="row">
											<div class="col-md-12" style="padding:10px;">
												<h4 class="grey"><i class="icon ion-ios-briefcase-outline"></i><?php echo $blogs_row['title']; ?><span class="pull-right" style='<?php echo $blog_status_style; ?>color:#fff;border-radius:4px;padding:10px;font-size:12px;'>
												<?php echo $blog_status; ?>
											</span></h4>
											</div>
											<div class="col-md-12" style="padding:10px;">
												<div data-network="twitter" class="st-custom-button"><i class="fa fa-twitter"></i></div>
												<div data-network="facebook" class="st-custom-button"><i class="fa fa-facebook"></i></div> 
												<div data-network="whatsapp" class="st-custom-button"><i class="fa fa-whatsapp"></i></div> 
												<div data-network="skype" class="st-custom-button"><i class="fa fa-skype"></i></div> 
												<div data-network="linkedin" class="st-custom-button"><i class="fa fa-linkedin"></i></div> 
												<div data-network="email" class="st-custom-button"><i class="fa fa-envelope-o"></i></div> 
												<div data-network="sms" class="st-custom-button"><i class="fa fa-envelope"></i></div> 
												<span class="pull-right" style="margin-right:10px;margin-top:10px;">Posted at : <?php echo date("d-m-Y",strtotime($blogs_row['added'])); ?></span>
											</div>
										</div>
									</div>
									<div class="p-3 border-bottom osahan-post-body">
										<p class="mb-1">
											<?php echo $blogs_row['content']; ?>
										</p>
									</div>
								</div>
					<?php
						}
						else
						{
							?>
							<div class="edit-profile-container" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);transition: box-shadow 83ms;background:#fff;padding:10px;margin: 0 0px 10px;border-radius:2px;">
								<div class="block-title">
									<h3 style="text-align:center;">Broken link or content has been removed or replaced</h3>
									<div class="line"></div>
								</div>
							</div>
							<?php
						}
					?>
				   </main>
				   <aside class="col col-xl-3 order-xl-1 col-lg-6 order-lg-2 col-md-6 col-sm-6 col-12">
						<div class="box mb-3 shadow-sm border rounded bg-white profile-box text-center">
							<div class="py-4 px-3 border-bottom">
								<?php $profile=getUserProfileImage($_COOKIE['uid']); ?>
								<img src="<?php echo $profile; ?>" class="img-fluid mt-2 rounded-circle" style="width:100px;border:1px solid #eaebec !important;" alt="<?php echo $user_row['first_name']." ".$user_row['last_name']; ?>">
								<h5 class="font-weight-bold text-dark mb-1 mt-4"><?php echo $user_row['first_name']." ".$user_row['last_name']; ?></h5>
								<p class="mb-0 text-muted"><?php echo $user_row['profile_title']; ?></p>
							</div>
							<div class="d-flex">
								<div class="col-6 border-right p-3">
								   <h6 class="font-weight-bold text-dark mb-1"><?php echo getUserConnectionCounts($_COOKIE['uid']); ?></h6>
								   <p class="mb-0 text-black-50 small">Connections</p>
								</div>
								<div class="col-6 p-3">
								   <h6 class="font-weight-bold text-dark mb-1"><?php echo getUserProfileViews($_COOKIE['uid']); ?></h6>
								   <p class="mb-0 text-black-50 small">Views</p>
								</div>
							</div>
							<div class="overflow-hidden border-top">
								<a class="font-weight-bold p-3 d-block" href="u/<?php echo $user_row['username']; ?>"> View my profile </a>
							</div>
						</div>
						<div class="box mb-3 shadow-sm rounded bg-white view-box overflow-hidden">
						 <div class="box-title border-bottom p-3">
							<h6 class="m-0">Profile Views</h6>
						 </div>
						 <div class="d-flex text-center">
							<div class="col-6 border-right py-4 px-2">
							   <h5 class="font-weight-bold text-info mb-1">08 <i class="feather-bar-chart-2"></i></h5>
							   <p class="mb-0 text-black-50 small">last 5 days</p>
							</div>
							<div class="col-6 py-4 px-2">
							   <h5 class="font-weight-bold text-success mb-1">+ 43% <i class="feather-bar-chart"></i></h5>
							   <p class="mb-0 text-black-50 small">Since last week</p>
							</div>
						 </div>
						 <div class="overflow-hidden border-top text-center">
							<img src="img/chart.png" class="img-fluid" alt="Responsive image">
						 </div>
					  </div>
						<div class="box shadow-sm mb-3 rounded bg-white ads-box text-center">
						 <img src="img/job1.png" class="img-fluid" alt="Responsive image">
						 <div class="p-3 border-bottom">
							<h6 class="font-weight-bold text-dark">RopeYou Solutions</h6>
							<p class="mb-0 text-muted">Looking for talent?</p>
						 </div>
						 <div class="p-3">
							<button type="button" class="btn btn-outline-primary pl-4 pr-4"> POST A JOB </button>
						 </div>
					  </div>
					</aside>
				   <aside class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-6 col-12">
						<?php
							$extra_stuff="";
							$user_connections=getUserConnections($_COOKIE['uid']);
							//print_r($user_connections);
							if($user_connections==0)
							{
								$extra_stuff="";
							}
							else{
								$user_connections[]=$_COOKIE['uid'];
								$extra_stuff=" AND id NOT IN (".implode(',',$user_connections).")";
							}
							$pusr_query = "SELECT * FROM users WHERE status=1".$extra_stuff; 
							//echo $pusr_query;
							$pusr_result=mysqli_query($conn,$pusr_query);
							if(mysqli_num_rows($pusr_result)>0)
							{
						?>
						<div class="box shadow-sm border rounded bg-white mb-3">
							<div class="box-title border-bottom p-3">
								<h6 class="m-0">People you can connect</h6>
							</div>
							<div class="box-body p-3" style="max-height:400px;overflow:auto;">
							<?php
								while($pusr_row=mysqli_fetch_array($pusr_result))
								{
							?>
								<div class="d-flex align-items-center osahan-post-header mb-3 people-list" id="user_suggestion_<?php echo $pusr_row['id']; ?>">
								   <div class="dropdown-list-image mr-3">
									  <img class="rounded-circle" style="border:1px solid #eaebec !important;" src="<?php echo getUserProfileImage($pusr_row['id']); ?>" alt="<?php echo $pusr_row['first_name']." ".$pusr_row['last_name']; ?>">
									  <div class="status-indicator  <?php if(userLoggedIn($pusr_row['id'])){ echo 'bg-success';} else{ echo 'bg-danger'; } ?>"></div>
								   </div>
								   <div class="font-weight-bold mr-2">
									  <div class="text-truncate"><?php echo $pusr_row['first_name']." ".$pusr_row['last_name']; ?></div>
									  <div class="small text-gray-500"><?php echo $pusr_row['profile_title']; ?>
									  </div>
								   </div>
								   <span class="ml-auto"><button type="button" class="btn btn-light btn-sm"><i class="feather-user-plus"></i></button>
								   </span>
								</div>
							<?php
								}
							?>
								<!--
								<div class="d-flex align-items-center osahan-post-header mb-3 people-list">
								   <div class="dropdown-list-image mr-3">
									  <img class="rounded-circle" src="img/p9.png" alt="">
									  <div class="status-indicator bg-success"></div>
								   </div>
								   <div class="font-weight-bold mr-2">
									  <div class="text-truncate">John Doe</div>
									  <div class="small text-gray-500">Traveler
									  </div>
								   </div>
								   <span class="ml-auto"><button type="button" class="btn btn-light btn-sm"><i class="feather-user-plus"></i></button>
								   </span>
								</div>
								<div class="d-flex align-items-center osahan-post-header mb-3 people-list">
								   <div class="dropdown-list-image mr-3">
									  <img class="rounded-circle" src="img/p10.png" alt="">
									  <div class="status-indicator bg-success"></div>
								   </div>
								   <div class="font-weight-bold mr-2">
									  <div class="text-truncate">Julia Cox</div>
									  <div class="small text-gray-500">Art Designer
									  </div>
								   </div>
								   <span class="ml-auto"><button type="button" class="btn btn-light btn-sm"><i class="feather-user-plus"></i></button>
								   </span>
								</div>
								<div class="d-flex align-items-center osahan-post-header mb-3 people-list">
								   <div class="dropdown-list-image mr-3">
									  <img class="rounded-circle" src="img/p11.png" alt="">
									  <div class="status-indicator bg-success"></div>
								   </div>
								   <div class="font-weight-bold mr-2">
									  <div class="text-truncate">Robert Cook</div>
									  <div class="small text-gray-500">Photographer at Photography
									  </div>
								   </div>
								   <span class="ml-auto"><button type="button" class="btn btn-light btn-sm"><i class="feather-user-plus"></i></button>
								   </span>
								</div>
								<div class="d-flex align-items-center osahan-post-header people-list">
								   <div class="dropdown-list-image mr-3">
									  <img class="rounded-circle" src="img/p12.png" alt="">
									  <div class="status-indicator bg-success"></div>
								   </div>
								   <div class="font-weight-bold mr-2">
									  <div class="text-truncate">Richard Bell</div>
									  <div class="small text-gray-500">Graphic Designer at Envato
									  </div>
								   </div>
								   <span class="ml-auto"><button type="button" class="btn btn-light btn-sm"><i class="feather-user-plus"></i></button>
								   </span>
								</div>
								-->
							</div>
						</div>
					  <?php
							}
					  ?>
						<div class="box shadow-sm mb-3 rounded bg-white ads-box text-center overflow-hidden">
							<img src="img/ads1.png" class="img-fluid" alt="Responsive image">
							<div class="p-3 border-bottom">
								<h6 class="font-weight-bold text-gold">RopeYou Premium</h6>
								<p class="mb-0 text-muted">Grow & nurture your network</p>
							</div>
							<div class="p-3">
								<button type="button" class="btn btn-outline-gold pl-4 pr-4"> ACTIVATE </button>
							</div>
						</div>
						<?php
							$jobs_query="SELECT * FROM jobs WHERE status=1 LIMIT 0,5";
							$jobs_result=mysqli_query($conn,$jobs_query);
							if(mysqli_num_rows($jobs_result)>0)
							{
						?>
								<div class="box shadow-sm border rounded bg-white mb-3">
									<div class="box-title border-bottom p-3">
										<h6 class="m-0">Jobs
										</h6>
									</div>
									<div class="box-body p-3">
										<?php
											while($jobs_row=mysqli_fetch_array($jobs_result))
											{
												$og_title=base_url."job/".trim(strtolower($jobs_row['job_title']))." ".trim(strtolower($jobs_row['job_company']));
												$og_title=str_replace(" ","-",$og_title);
												$og_url=$og_title."-".$jobs_row['id'].".html";
												$og_image=base_url."alphas/".strtolower(substr($jobs_row['job_company'],0,1)).".png";
												
										?>
												<a href="<?php echo $og_url; ?>">
												   <div class="shadow-sm border rounded bg-white job-item mb-3">
													  <div class="d-flex align-items-center p-3 job-item-header">
														 <div class="overflow-hidden mr-2">
															<h6 class="font-weight-bold text-dark mb-0 text-truncate"><?php echo $jobs_row['job_title']; ?></h6>
															<div class="text-truncate text-primary"><?php echo $jobs_row['job_company']; ?></div>
															<div class="small text-gray-500"><i class="feather-map-pin"></i> <?php echo $jobs_row['job_location']; ?></div>
														 </div>
														 <img class="img-fluid ml-auto" src="<?php echo $og_image; ?>" alt="<?php echo $jobs_row['job_company']; ?>" style="border:1px solid #eaebec !important;padding: 2px;border-radius: 7px;">
													  </div>
													  <div class="d-flex align-items-center p-3 border-top border-bottom job-item-body">
														 <div class="overlap-rounded-circle">
															<img class="rounded-circle shadow-sm" data-toggle="tooltip" data-placement="top" title="" src="img/p9.png" alt="" data-original-title="Sophia Lee">
															<img class="rounded-circle shadow-sm" data-toggle="tooltip" data-placement="top" title="" src="img/p10.png" alt="" data-original-title="John Doe">
															<img class="rounded-circle shadow-sm" data-toggle="tooltip" data-placement="top" title="" src="img/p11.png" alt="" data-original-title="Julia Cox">
															<img class="rounded-circle shadow-sm" data-toggle="tooltip" data-placement="top" title="" src="img/p12.png" alt="" data-original-title="Robert Cook">
														 </div>
														 <span class="font-weight-bold text-muted">18 connections</span>
													  </div>
													  <div class="p-3 job-item-footer">
														 <small class="text-gray-500"><i class="feather-clock"></i> Posted <?php echo date("d-m-Y",strtotime($jobs_row['added'])); ?></small>
													  </div>
												   </div>
												</a>
										<?php
											}
										?>
									</div>
								</div>
						<?php
							}
						?>
				   </aside>
				</div>
			</div>
		</div>
		<?php include_once 'scripts.php'; ?>
		<script src="<?php echo base_url; ?>/js/sweetalert.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url; ?>js/feeling.js"></script>
		<script>
			(function($) {
				  "use strict"; // Start of use strict

				// Tooltip
				$('[data-toggle="tooltip"]').tooltip();

				// Osahan Slider
				$('.quote_slider').slick({
				  centerMode: true,
				  centerPadding: '30px',
				  slidesToShow: 3,
				  responsive: [
					{
					  breakpoint: 768,
					  settings: {
						arrows: false,
						centerMode: true,
						centerPadding: '40px',
						slidesToShow: 1
					  }
					},
					{
					  breakpoint: 480,
					  settings: {
						arrows: false,
						centerMode: true,
						centerPadding: '40px',
						slidesToShow: 1
					  }
					}
				  ]
				});

			})(jQuery);
			function addComment(post_id,comment_text="")
			{
				if(comment_text=="")
				{
					comment_text=$("#comment_text_"+post_id).val();
				}
				comment_text=comment_text.trim();
				if(comment_text=="")
				{
					swal({
					  title: "Attention!",
					  text: "Blank comment can not be posted.",
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
					var username=$("#comment_text_"+post_id).attr('data-name');
					var userimage=$("#comment_text_"+post_id).attr('data-img');
					var user_id=$("#comment_text_"+post_id).attr('data-uid');
					$.ajax({
						type:'POST',
						url: base_url+"post-comment",
						data:{post_id:post_id,user_id:user_id,comment_text:comment_text},
						success:function(data){
							var data_obj=JSON.parse(data);
							if(data_obj.status=="success")
							{
								var html='<div class="p-3 d-flex align-items-top border-bottom osahan-post-comment" style="width:100%;">'+
								'<div class="dropdown-list-image mr-3">'+
								   '<img class="rounded-circle img-nf" style="border:1px solid #eaebec; !important;" src="'+userimage+'" alt="'+username+'">'+
								   '<div class="status-indicator bg-success"></div>'+
								'</div>'+
							   ' <div class="font-weight-bold" style="width:100% !important">'+
								  ' <div class="text-truncate"> '+username+' <span class="float-right small">just now</span></div>'+
								   '<div class="small text-gray-500">'+data_obj.comment_text+'</div>'+
								'</div>'+
							 '</div>';
							 $("#post_comments_data_"+post_id).append(html);
							 $("#comment_text_"+post_id).val("");
							}
							else{
								swal({
								  title: "Attention!",
								  text: data_obj.message,
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
			}
			$(".post_matrix").click(function(){
				var post_matrix=$("#post_matrix").val();
				$("#mode").val(post_matrix);
				if(post_matrix=="0,0,1,0,1" || post_matrix=="0,0,1,0,2")
				{
					$("#mode_options_html").css("visibility","visible");
					$("#mode_options").val("");
					$("#selected_mode_options").val($("#post_matrix_users").val());
				}
				else
				{
					$("#mode_options").val("");
					$("#selected_mode_options").val("");
					$("#mode_options_html").css("visibility","hidden");
				}
				$("#post_matrix_settings_modal").modal('show');
			});
			$("#mode").change(function(){
				var mode=$("#mode").val();
				if(mode=="0,0,1,0,1" || mode=="0,0,1,0,2")
				{
					$("#mode_options_html").css("visibility","visible");
					$("#mode_options").val("");
					$("#selected_mode_options").val($("#post_matrix_users").val());
				}
				else
				{
					$("#mode_options").val("");
					$("#selected_mode_options").val("");
					$("#mode_options_html").css("visibility","hidden");
				}
			});
			/* Detect a Url in the status text */
			
			var timeout=null;
			$('#status_text').bind("keyup",function() {
				$("#ru-loader").hide();
				clearTimeout(timeout);
				timeout = setTimeout(function () {
					var html=$('#status_text').val();
					var url_caught=0;
					console.log(html);
					var h_words=html.split(" ");
					for(i=0;i<h_words.length;i++)
					{
						if(isUrl(h_words[i])){
							$("#ru-loader").show();
							localStorage.setItem('text_status_url',h_words[i]);
							var url=h_words[i];
							url_caught=1;
							$.ajax({
								url:base_url+"preview",
								type:"post",
								data:{url:url},
								success:function(res)
								{
									var preview_html="";
									var resp=JSON.parse(res);
									if(resp.data=="")
									{
										$("#status_text_preview").html(preview_html);
									}
									else
									{
										var response=resp.data;
										var title=response.title;
										var img_url=response.img_url;
										var desc=response.desc;
										var host_url=response.host_url;
										if(title=="")
										{
											title=getWebTitle(url);
										}
										if(img_url=="")
										{
											img_url=base_url+"alphas/"+getWebImage(url)+".png";
										}
										if(host_url=="")
										{
											host_url=url;
										}
										if(desc=="")
										{
											desc="visit "+url;
										}
										if(title=="" && img_url=="" && desc=="")
										{ 
											preview_html="";
										}
										else
										{
											preview_html='<div class="p-3 osahan-post-body">'+
											'<p class="mb-1">'+title+'</p>'+								
													'<div class="d-flex align-items-center" style="width:100% !important;">'+
														'<div class="box shadow-sm mb-3 rounded bg-white ads-box text-center overflow-hidden" style="width:100% !important;">'+
															 '<a href="'+host_url+'" target="_blank" style="width:100% !important;padding:5px;">'+
																'<img src="'+img_url+'" class="img-fluid img-responsive p-3" title="'+host_url+'" alt="'+img_url+'" style="width:100% !important;">'+
															'</a>'+
															 '<div class="border-top">'+
																'<p class="mb-0 text-muted p-3" style="text-align:justify !important;"><a href="'+host_url+'" target="_blank"></a>'+desc+'</p>'+
															 '</div>'+
														'</div>'+
													'</div>'+
													'<input type="hidden" name="url_preview" id="url_preview" value="'+title+'*RUBREAK*'+img_url+'*RUBREAK*'+desc+'*RUBREAK*'+url+'">'+
												'</div>';
										}
										$("#status_text_preview").html(preview_html);
									}
									$("#ru-loader").hide();
								}
							});
						}
					}
					if(url_caught==0)
					{
						$("#status_text_preview").html("");
					}
				}, 1000);
			});
			function isUrl(str) {
				switch (str)
				{
					case "http": return false;break;
					case "https": return false;break;
					case "http:": return false;break;
					case "https:": return false;break;
					case "http:/": return false;break;
					case "https:/": return false;break;
					case "http://": return false;break;
					case "https://": return false;break;
				}
				var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
					'((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
					'((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
					'(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
					'(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
					'(\\#[-a-z\\d_]*)?$','i'); // fragment locator
				  return !!pattern.test(str);
			}
			function getWebImage(str) {
				switch (str)
				{
					case "http": return false;break;
					case "https": return false;break;
					case "http:": return false;break;
					case "https:": return false;break;
					case "http:/": return false;break;
					case "https:/": return false;break;
					case "http://": return false;break;
					case "https://": return false;break;
					case "https://w": return false;break;
					case "https://ww": return false;break;
					case "https://www": return false;break;
					case "https://www.": return false;break;
					case "http://w": return false;break;
					case "http://ww": return false;break;
					case "http://www": return false;break;
					case "http://www.": return false;break;
				}
				str = str.replace("https://www.", "");
				str = str.replace("https://", "");
				str = str.replace("http://", "");
				var arr=str.split(".");
				if(arr[0]!="")
				{
					var latter=arr[0].substring(0, 1);
					latter=latter.toLowerCase();
					return latter;
				}
				else if(arr[1]!="")
				{
					var latter=arr[1].substring(0, 1);
					latter=latter.toLowerCase();
					return latter;
				}
				else{
					return "w";
				}
			}
			function getWebTitle(str) {
				switch (str)
				{
					case "http": return false;break;
					case "https": return false;break;
					case "http:": return false;break;
					case "https:": return false;break;
					case "http:/": return false;break;
					case "https:/": return false;break;
					case "http://": return false;break;
					case "https://": return false;break;
					case "https://w": return false;break;
					case "https://ww": return false;break;
					case "https://www": return false;break;
					case "https://www.": return false;break;
					case "http://w": return false;break;
					case "http://ww": return false;break;
					case "http://www": return false;break;
					case "http://www.": return false;break;
				}
				str = str.replace("https://www.", "");
				str = str.replace("https://", "");
				str = str.replace("http://", "");
				var arr=str.split(".");
				if(arr[0]!="")
				{
					return arr[0];
				}
				else if(arr[1]!="")
				{
					return arr[1];
				}
				else{
					return str;
				}
			}
			function submitPost()
			{
				var status_text=$("#status_text").val();
				status_text=status_text.trim();
				if(status_text=="")
				{
					return false;
				}
				var post_matrix=$("#post_matrix").val();
				var post_matrix_users=$("#post_matrix_users").val();
				var url_preview="";
				if($("#url_preview").length>0)
				{
					url_preview=$("#url_preview").val();
				}
				$.ajax({
					url: base_url+"save-text-post",
					type:"post",
					data:{post_text:status_text,url_preview:url_preview,post_matrix:post_matrix,post_matrix_users:post_matrix_users},
					success:function(res){
						if(res=="success")
						{
							swal({
							  title: "Great!",
							  text: "Successfully posted to your timeline.",
							  icon: "success",
							  buttons: {
								cancel: false,
								confirm: "Close",
							  },
							  dangerMode: false,
							  closeOnConfirm: false,
							  closeOnCancel: false
							}).then((value) => {
								location.href=base_url+"broadcasts";
							});
						}
						else if(res=="duplicate")
						{
							swal({
							  title: "OH!",
							  text: "Possibally duplicate post!",
							  icon: "warning",
							  buttons: {
								cancel: false,
								confirm: "Close",
							  },
							  dangerMode: false,
							});
						}
						else 
						{
							swal({
							  title: "It's not You!",
							  text: "We are working on this try it after a moment.",
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
		</script>
   </body>
</html>
