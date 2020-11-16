<!doctype html>
<html lang="en">	
	<?php include_once 'head.php'; ?>	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<body>
    <div id="wrapper">		
		<?php //include_once 'main-sidebar.php'; ?>		
		<?php include_once 'header.php'; ?>
        <!-- contents -->		<?php
			if(!isset($_REQUEST['blogdata']) || $_REQUEST['blogdata']=="")
			{
				?>
				<script>
					window.location.href="http://ryblogger.ropeyou.com";
				</script>
				<?php
			}			
			$is_blog_valid=false;			
			$blogdata=$_REQUEST['blogdata'];			
			$blog_query="SELECT * FROM users_blogs WHERE id='$blogdata' AND user_id='".$_COOKIE['blogger_id']."'";			
			$blog_result=mysqli_query($conn,$blog_query);			
			if(mysqli_num_rows($blog_result)>0)			
			{				
				$is_blog_valid=true;				
				$blog_row=mysqli_fetch_array($blog_result);			
			}
			else{
				?>
				<script>
					alert('you are not authorized');
					window.location.href="<?php echo base_url; ?>";
				</script>
				<?php
				die();
			}		?>
        <div class="main_content">
            <div class="main_content_inner">
                <h1> <?php echo stripslashes($blog_row['title']) ?> &nbsp;&nbsp;<a href="<?php echo base_url; ?>edit-blog.php?blogdata=<?php echo $blogdata; ?>" style="font-size:14px;text-decoration:none;"><i class="fa fa-pencil"></i>&nbsp;Edit</a> </h1>
                <div class="uk-flex uk-flex-between">
                    <nav class="responsive-tab style-1 mb-5">
                        <ul>
                            <li class="uk-active"><a href="javascript:void(0);" onclick="animate_dom(0);"> Recent </a></li>
                            <li><a href="javascript:void(0);" onclick="animate_dom(1);"> Oldest </a></li>
                        </ul>
                    </nav>
                    <a href="<?php echo base_url; ?>write-blog-post.php?blogdata=<?php echo $blogdata; ?>" class="button primary small circle uk-visible@s" style="text-decoration:none;"> <i class="uil-plus"> </i> Create new post</a>                </div>
                <div class="uk-position-relative mb-2" uk-slider="finite: true">
                    <div class="uk-slider-container video-grid-slider pb-3">
                        <ul class="uk-slider-items uk-child-width-1-4@m uk-child-width-1-3@s  pr-lg-1 uk-grid" id="uk_slider_animation" uk-scrollspy="target: > div; cls: uk-animation-slide-bottom-small; delay: 100">							<?php
								$blog_posts_query="SELECT * FROM users_blogs_posts WHERE blog_id='$blogdata'";
								$blog_posts_result=mysqli_query($conn,$blog_posts_query);
								if(mysqli_num_rows($blog_posts_result)>0)
								{
									while($blog_posts_row=mysqli_fetch_array($blog_posts_result))
									{
										?>
										<li>
											<a href="<?php echo base_url; ?>view-blog-post.php?blog_post_id=<?php echo $blog_posts_row['id']; ?>">
												<div class="course-card">
													<div class="course-card-thumbnail ">
														<img src="<?php echo base_url; ?>images/blog/<?php echo $blog_posts_row['post_feature_image']; ?>">
													</div>
													<div class="course-card-body">
														<div class="course-card-info">
															<div>
																<span class="catagroy"><?php echo str_replace(",#","&nbsp;#",stripslashes($blog_posts_row['tags'])); ?></span>
															</div>
															<div>
																<i class="icon-feather-bookmark icon-small"></i>
															</div>
														</div>
														<h4><?php echo stripslashes($blog_posts_row['title']); ?></h4>
														<p> <?php echo substr(stripslashes($blog_posts_row['description']),0,250)."..."; ?></p>
													</div>
												</div>
											</a>
										</li>
                        
										<?php
									}
								}
							?>
						</ul>
                    </div>
                    <a class="uk-position-center-left-out uk-position-small uk-hidden-hover slidenav-prev" href="javascript:void(0);" uk-slider-item="previous"></a>					<a class="uk-position-center-right-out uk-position-small uk-hidden-hover slidenav-next" href="javascript:void(0);" uk-slider-item="next"></a>				</div>
                <div class="section-header pb-0">
                    <div class="section-header-left">
                        <h3>Other Blogs</h3>
                    </div>
                </div>
                <div class="uk-position-relative mb-4 mt-4" uk-slider="finite: true">
                    <div class="uk-slider-container py-3 px-1">
						<?php 
							$other_blogs_query="SELECT * FROM users_blogs WHERE id!='$blogdata' AND status=1 AND user_id='".$_COOKIE['blogger_id']."'";
							$other_blogs_result=mysqli_query($conn,$other_blogs_query);
							if(mysqli_num_rows($other_blogs_result)>0)
							{
								?>
								<ul class="uk-slider-items uk-child-width-1-6@m uk-child-width-1-3@s uk-child-width-1-2 uk-grid-small uk-grid">
								<?php
								while($other_blogs_row=mysqli_fetch_array($other_blogs_result))
								{
									?>
										<li>
											<a href="<?php echo base_url; ?>blog-details.php?blogdata=<?php echo $other_blogs_row['id']; ?>">
												<div class="course-card-category" style="padding:20px;min-height:200px;max-height:201px;min-width:300px;max-width:301px;">
													<img  style="min-width:95%;" src="<?php echo base_url; ?>images/blog/<?php echo $other_blogs_row['blog_image']; ?>" alt="<?php echo stripslashes($other_blogs_row['title']); ?>">
													<h6><?php echo substr(stripslashes($other_blogs_row['title']),0,75); ?></h6>
												</div>
											</a>
										</li>
									<?php
								}
								?>
								</ul>
								<a class="uk-position-center-left-out uk-position-small uk-hidden-hover slidenav-prev" href="javascript:void(0);" uk-slider-item="previous"></a>
								<a class="uk-position-center-right-out uk-position-small uk-hidden-hover slidenav-next" href="javascript:void(0);" uk-slider-item="next"></a>
								<?php
							}
						?>
					</div>
                </div>
            </div>

        </div>
        
        <?php include_once 'chat_sidebar.php'; ?>
        
    </div>


            <!-- For Night mode -->
            <script>
                (function (window, document, undefined) {
                    'use strict';
                    if (!('localStorage' in window)) return;
                    var nightMode = localStorage.getItem('gmtNightMode');
                    if (nightMode) {
                        document.documentElement.className += ' night-mode';
                    }
                })(window, document);


                (function (window, document, undefined) {

                    'use strict';

                    // Feature test
                    if (!('localStorage' in window)) return;

                    // Get our newly insert toggle
                    var nightMode = document.querySelector('#night-mode');
                    if (!nightMode) return;

                    // When clicked, toggle night mode on or off
                    nightMode.addEventListener('click', function (event) {
                        event.preventDefault();
                        document.documentElement.classList.toggle('night-mode');
                        if (document.documentElement.classList.contains('night-mode')) {
                            localStorage.setItem('gmtNightMode', true);
                            return;
                        }
                        localStorage.removeItem('gmtNightMode');
                    }, false);

                })(window, document);
            </script>


            <!-- javaScripts
                ================================================== -->
            <script src="<?php echo BLOGGER_ASSETS; ?>assets/js/framework.js"></script>
            <script src="<?php echo BLOGGER_ASSETS; ?>assets/js/jquery-3.3.1.min.js"></script>
            <script src="<?php echo BLOGGER_ASSETS; ?>assets/js/simplebar.js"></script>
            <script src="<?php echo BLOGGER_ASSETS; ?>assets/js/main.js"></script>			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
			<script>
				var animated=0;
				function animate_dom(need_animation)
				{
					if(animated!=need_animation)
					{
						$("#uk_slider_animation").reverseChildren();
						animated=need_animation;
					}
				}
				$.fn.reverseChildren = function() {
				  return this.each(function(){
					var $this = $(this);
					$this.children().each(function(){ $this.prepend(this) });
				  });
				};
			</script>
</body></html>