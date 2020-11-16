<!doctype html>
	<html lang="en">		<?php include_once 'head.php'; ?>		<?php			$blog=false;			if(isset($_POST['save_blog_basic_details']))			{				$blog=$_POST['blog'];				$description=addslashes(filter_var($blog['description'], FILTER_SANITIZE_STRING));				$title=addslashes(filter_var($blog['title'], FILTER_SANITIZE_STRING));				$tags=addslashes(filter_var($blog['tags'], FILTER_SANITIZE_STRING));
				$keywords=addslashes(filter_var($blog['keywords'], FILTER_SANITIZE_STRING));				$blog_url=filter_var($blog['blog_url'], FILTER_SANITIZE_URL);				$query="SELECT * FROM users_blogs WHERE blog_url='".$blog_url."'";				$result=mysqli_query($conn,$query);
				$blog_image="";
				$blog_image=time().'_'.strtolower(str_replace(" ","-",basename($_FILES['blog_image']['name'])));
				if(move_uploaded_file($_FILES['blog_image']['tmp_name'],"images/blog/".$blog_image))
				{
					
				}
				else{
					$blog_image="";
				}				if(mysqli_num_rows($result)>0)				{					?>					<script>						alert('Blog URL is not available.Please choose an unique blog url.');					</script>					<?php				}				else				{					$query="INSERT INTO users_blogs SET title='".$title."',keywords='$keywords',blog_image='$blog_image',description='".$description."',tags='".$tags."',blog_url='".$blog_url."',user_id='".$_COOKIE['blogger_id']."',added=NOW(),status=1";					$result=mysqli_query($conn,$query);					if($result)					{						?>						<script>							alert('Congratulations! yourblog is ready.Start posting to your blog.');						</script>						<?php					}					else					{						?>						<script>							alert('Some technical error.Please contact developer.');						</script>						<?php					}				}			}		?>		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<body>	<style>		a{			text-decoration:none;		}
		.error_class{
			outline:1px solid red !important;
		}	</style>
    <div id="wrapper">
        <div class="content">

        <!-- sidebar -->
        <?php //include_once 'main-sidebar.php'; ?>

        <!-- header -->
        <?php include_once 'header.php'; ?>
		<div id="start_creating_own_blog_modal" class="modal fade" role="dialog">			<div class="modal-dialog modal-lg">				<div class="modal-content">					<div class="modal-header">												<h4 class="modal-title">Start Creating Your Own Blog</h4>						<button type="button" class="close" data-dismiss="modal">&times;</button>					</div>					<div class="modal-body">						<div class="row">							<div class="col-md-12">								<form action="" method="post" enctype="multipart/form-data">									<div class="form-group">
										<div class="row">
											<div class="col-md-2">
												<label class="form-group">Blog Title*</label>
											</div>
											<div class="col-md-10">
												<input type="text" name="blog[title]" <?php if($blog){ ?> value="<?php echo $blog['title']; ?>"  <?php } ?> id="blog_title" required class="form-control" placeholder="Blog Title*">
											</div>	
										</div>									</div>									<div class="row">
										<div class="col-md-2">
											<label class="form-group">Blog URL*</label><br/>
										</div>										<div class="col-md-10">											<div class="form-group">												<input type="text" name="blog[blog_url]" <?php if($blog){ ?> value="<?php echo $blog['blog_url']; ?>"  <?php } else{ ?> value="http://ryblogger.ropeyou.com/" <?php } ?> id="blog_url" required class="form-control" placeholder="Blog URL*">												<a href="javascript:void(0);" onclick="check_avalability();" style="color:red !important;margin-top:10px;">check availability</a>
											</div>										</div>									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-md-2">
												<label class="form-group">Image*</label>
											</div>
											<div class="col-md-10">
												<input type="file" accept="image/*" class="form-control" name="blog_image" id="blog_image" required>
											</div>	
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-md-2">
												<label class="form-group">Tags*</label>
											</div>
											<div class="col-md-10">
												<textarea type="text" name="blog[tags]" required id="blog_tags" class="form-control" placeholder="Tags you want to assign." style="resize:none;"><?php if($blog){ echo $blog['tags'];  } ?></textarea>
											</div>	
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-md-2">
												<label class="form-group">Keywords*</label>
											</div>
											<div class="col-md-10">
												<textarea type="text" name="blog[keywords]" required id="keywords" class="form-control" placeholder="Seo Keywords." style="resize:none;"><?php if($blog){ echo $blog['keywords'];  } ?></textarea>
											</div>	
										</div>
									</div>
									<div class="row">
										<div class="col-md-2">
											<label class="form-group">Description*</label>
										</div>
										<div class="col-md-10">
											<textarea type="text" name="blog[description]" rows="5" required id="blog_description" class="form-control" placeholder="What is it about..." style="resize:none;"><?php if($blog){ echo $blog['description'];  } ?></textarea>
										</div>	
									</div>									<div class="form-group">										<button id="save_blog_basic_details" name="save_blog_basic_details" class="btn btn-success" type="submit">Save</button>									</div>								</form>							</div>						</div>					</div>					<div class="modal-footer">						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>					</div>				</div>			</div>		</div>
        <!-- contents -->		<?php			$blogs_available=false;			$last_blog=array();			$blog_query="SELECT* FROM users_blogs WHERE user_id='".$_COOKIE['blogger_id']."' ORDER BY id DESC";			$blog_result=mysqli_query($conn,$blog_query);			if(mysqli_num_rows($blog_result)>0)			{				$blogs_available=true;				$blog_row=mysqli_fetch_array($blog_result);				$last_blog=$blog_row;			}			$last_blog_id=$last_blog['id'];		?>
        <div class="main_content">
            <div class="main_content_inner">				
                <h1 style="text-transform:none;"><?php if($last_blog['title']!=""){ echo "Recent Blog : ".stripslashes($last_blog['title']); } else{ echo "you have not added any blog so far."; } ?> </h1>
                <div class="uk-flex uk-flex-between">
                    <nav class="responsive-tab style-1 mb-5">
                        <ul>
                            <li class="uk-active"><a href="javascript:void(0);" onclick="animate_dom(0);">Recent</a></li>
                            <li><a href="javascript:void(0);" onclick="animate_dom(1);"> Oldest </a></li>
                        </ul>
                    </nav>
                    <a href="javascript:void(0);" onclick="$('#start_creating_own_blog_modal').modal('show');" class="button primary small circle uk-visible@s" style="text-decoration:none;"> <i class="uil-plus"> </i> Create new</a>

                </div>


                <div class="uk-grid-large" uk-grid>
                    <div class="uk-width-expand" id="uk_slider_animation">						<?php							if($blogs_available)							{								do{									?>									<a href="blog-details.php?blogdata=<?php echo $last_blog['id']; ?>" class="blog-post" style="min-height:250px;">										<div class="blog-post-thumbnail">											<div class="blog-post-thumbnail-inner">												<span class="blog-item-tag"><?php echo str_replace(",#","&nbsp;#",stripslashes($last_blog['tags'])); ?></span>												<img src="<?php echo base_url; ?>/images/blog/<?php echo $last_blog['blog_image']; ?>" alt="<?php echo stripslashes($last_blog['title']); ?>">											</div>										</div>										<!-- Blog Post Content -->										<div class="blog-post-content">											<div class="blog-post-content-info">												<!--<span class="blog-post-info-tag button soft-danger"> <?php echo stripslashes($last_blog['title']); ?> </span>-->												<span class="blog-post-info-date"><?php echo date("d M",strtotime($last_blog['added'])); ?></span>											</div>											<h3><?php echo stripslashes($last_blog['title']); ?></h3>											<p><?php echo stripslashes($last_blog['description']); ?></p>										</div>									</a>									<?php								}while($last_blog=mysqli_fetch_array($blog_result));							}						?>
                        
                    </div>
                    <div class="uk-width-1-3@s">

                        <div uk-sticky="offset:86;media: @m ; bottom:true">

                        <div class="uk-card-default rounded mb-4">

                            <ul class="uk-child-width-expand uk-tab" uk-switcher="animation: uk-animation-fade">
                                <li><a href="#">Newest</a></li>
                                <li><a href="#">Popular</a></li>
                            </ul>

                            <ul class="uk-switcher">
                                <!-- tab 1 -->
                                <li>
                                    <div class="py-3 px-4">
										<?php
											$blog_query="SELECT * FROM users_blogs WHERE user_id!='".$_COOKIE['blogger_id']."' ORDER BY id DESC LIMIT 10";
											$blog_result=mysqli_query($conn,$blog_query);
											if(mysqli_num_rows($blog_result)>0)
											{
												while($blog_row=mysqli_fetch_array($blog_result))
												{
													?>
													<div class="uk-grid-small" uk-grid>
														<div class="uk-width-expand">
															<p><?php echo stripslashes($blog_row['title']); ?></p>
														</div>
														<div class="uk-width-1-3">
															<img src="<?php echo base_url; ?>images/blog/<?php echo $blog_row['blog_image']; ?>" alt="<?php echo stripslashes($blog_row['title']); ?>" class="rounded-sm">
														</div>
													</div>
													<?php
												}
											}
										?>
                                    </div>
                                </li>

                                <!-- tab 2 -->
                                <li>
                                    <div class="py-3 px-4">

                                        <?php
											$blog_query="SELECT * FROM users_blogs WHERE user_id!='".$_COOKIE['blogger_id']."' ORDER BY RAND() LIMIT 10";
											$blog_result=mysqli_query($conn,$blog_query);
											if(mysqli_num_rows($blog_result)>0)
											{
												while($blog_row=mysqli_fetch_array($blog_result))
												{
													?>
													<div class="uk-grid-small" uk-grid>
														<div class="uk-width-expand">
															<p><?php echo stripslashes($blog_row['title']); ?></p>
														</div>
														<div class="uk-width-1-3">
															<img src="<?php echo base_url; ?>images/blog/<?php echo $blog_row['blog_image']; ?>" alt="<?php echo stripslashes($blog_row['title']); ?>" class="rounded-sm">
														</div>
													</div>
													<?php
												}
											}
										?>

                                    </div>
                                </li>
                            </ul>

                        </div>

                        <!--<div class="uk-card-default rounded uk-overflow-hidden">
                            <div class="p-4 text-center">

                                <h4 class="uk-text-bold"> Subsicribe </h4>
                                <p> Get the Latest Posts and Article from us On Your Email</p>
                                <form class="mt-3">
                                    <input type="text" class="uk-input uk-form-small"
                                        placeholder="Enter your email address">
                                    <input type="submit" value="Subscirbe" class="button button-default block mt-3">
                                </form>
                            </div>
                        </div>-->

                    </div>


                    </div>
                </div>




            </div>
        </div>


        <?php include_once 'chat_sidebar.php'; ?>
    </div>
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
    <script src="<?php echo BLOGGER_ASSETS; ?>assets/js/main.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>	<script>		$("#blog_url").keydown(function(e) {			var oldvalue=$(this).val();			var field=this;			setTimeout(function () {				if(field.value.indexOf('http://ryblogger.ropeyou.com/') !== 0) {					$(field).val(oldvalue);				} 			}, 1);		});
		$("#blog_url").change(function(){
			if($(this).val()=="http://ryblogger.ropeyou.com/")
			{
				$(this).addClass('error_class');
			}
			else{
				$(this).removeClass('error_class');
			}
		});
		function check_avalability()
		{
			var url=$("#blog_url").val();
			if(url=="http://ryblogger.ropeyou.com/")
			{
				$("#blog_url").addClass('error_class');
			}
			else
			{
				$.ajax({
					url:'blog-url-availability.php',
					data:{blog_url:url},
					type:'post',
					success:function(result)
					{
						var response=JSON.parse(result);
						if(response.status=="1")
						{
							$("#blog_url").removeClass('error_class');
						}
						else{
							$("#blog_url").addClass('error_class');
						}
					}
				});
			}
		}		$("#blog_title").keyup(function(e) {			var str=$(this).val();			var url_prefix=str.split(" ").join("-");			$("#blog_url").val('http://ryblogger.ropeyou.com/'+url_prefix.toLowerCase());		});		var animated=0;
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
		};	</script>	
</body>

</html>