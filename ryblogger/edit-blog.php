<!doctype html>
<html lang="en">
	<?php include_once 'head.php'; ?>
	<?php
		if(!isset($_REQUEST['blogdata']) || $_REQUEST['blogdata']=="")
		{
			?>
			<script>
				window.location.href="http://ryblogger.ropeyou.com";
			</script>
			<?php
		}
		if(isset($_POST['save']))
		{
			$blogdata=$_POST['blogdata'];
			$user_id=$_COOKIE['blogger_id'];
			$post_title=addslashes(htmlentities($_POST['post_title']));
			$tags=addslashes(htmlentities($_POST['tags']));
			$keywords=addslashes(htmlentities($_POST['keywords']));
			$meta_description=addslashes(htmlentities($_POST['meta_description']));
			$post_content=addslashes(htmlentities($_POST['post_content']));
			$post_feature_image="";
			$post_feature_image=time().'_'.strtolower(str_replace(" ","-",basename($_FILES['post_feature_image']['name'])));
			if(move_uploaded_file($_FILES['post_feature_image']['tmp_name'],"images/blog/".$post_feature_image))
			{
				
			}
			else
			{
				$post_feature_image="";
			}
			$additional_query="";
			if($post_feature_image!="")
			{
				$additional_query="blog_image='$post_feature_image',";
			}
			$query="UPDATE users_blogs SET ".$additional_query."keywords='$keywords',user_id='$user_id',added=NOW(),tags='$tags',title='$post_title',description='$meta_description' WHERE id='$blogdata'";
			if(mysqli_query($conn,$query))
			{
				?>
				<script>
					alert('blog has been updated successfully');
					window.location.href="<?php echo base_url; ?>blog-details.php?blogdata=<?php echo $blogdata; ?>";
				</script>
				<?php
			}
			else
			{
				//echo $query;die();
				?>
				<script>
					alert('some technical error.please contact developer.');
				</script>
				<?php
			}
		}
		$blog_post_id=$_REQUEST['blogdata'];
	?>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<body>
    <div id="wrapper">
		<?php //include_once 'main-sidebar.php'; ?>
		<?php include_once 'header.php'; ?>
        <!-- contents -->
		<?php
			$is_blog_valid=false;
			$blog_query="SELECT * FROM users_blogs WHERE id='$blog_post_id' AND user_id='".$_COOKIE['blogger_id']."'";
			$blog_result=mysqli_query($conn,$blog_query);
			if(mysqli_num_rows($blog_result)>0)
			{
				$is_blog_valid=true;
				$blog_row=mysqli_fetch_array($blog_result);
			}
			if(!$is_blog_valid)
			{
				?>
				<script>
					alert('you are not authorized');
				</script>
				<?php
			}
		?>
        <div class="main_content">
            <div class="main_content_inner">
                <div class="uk-position-relative mb-2">
					<div class="row">
						<div class="col-md-12">
							<form action="" method="post" enctype="multipart/form-data">
								<div class="row">
									<div class="col-md-12" style="padding:20px;text-align:right;">
										<button class="btn btn-success" name="save" value="1">Save</button>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="hidden" name="blogdata" id="blogdata" value="<?php echo $blog_row['id']; ?>">
											<h6>Blog Title*</h6>
											<input type="text" class="form-control" value="<?php echo stripslashes($blog_row['title']); ?>" style="height:50px;border-radius:0px;" name="post_title" placeholder="Your blog title..." required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<h6>Feature Image</h6>
											<input type="file" accept="image/*" style="height:50px;border-radius:0px;" class="form-control" name="post_feature_image">
										</div>
									</div>
								</div>
								<div class="form-group">
									<h6>Tags*</h6>
									<input type="text" class="form-control" value="<?php echo stripslashes($blog_row['tags']); ?>" style="height:50px;border-radius:0px;" name="tags" placeholder="Tags..." required>
								</div>
								<div class="form-group">
									<h6>Keywords*</h6>
									<input type="text" class="form-control" value="<?php echo stripslashes($blog_row['keywords']); ?>" style="height:50px;border-radius:0px;" name="keywords" placeholder="Keywords..." required>
								</div>
								<div class="form-group">
									<h6>Description*</h6>
									<textarea name="meta_description" style="resize:none;" id="meta_description" class="form-control" rows="3" placeholder="Meta description for the post"><?php echo stripslashes($blog_row['description']); ?></textarea>
								</div>
							</form>
						</div>
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

            <script src="<?php echo BLOGGER_ASSETS; ?>assets/js/main.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</body>
</html>