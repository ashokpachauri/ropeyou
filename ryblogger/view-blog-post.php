<!doctype html><html lang="en">	<?php include_once 'head.php'; ?>	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">	<body>    <div id="wrapper">		<?php //include_once 'main-sidebar.php'; ?>		<?php include_once 'header.php'; ?>
        <div class="main_content">
            <div class="main_content_inner">				<?php					$blog_post_id=$_REQUEST['blog_post_id'];					$blog_root_id='';					$blog_post_query="SELECT * FROM users_blogs_posts WHERE id='$blog_post_id' AND user_id='".$_COOKIE['blogger_id']."'";					$blog_post_result=mysqli_query($conn,$blog_post_query);					if(mysqli_num_rows($blog_post_result)<=0)					{						?>						<script>							alert('you are not authorized.');							window.location.href='<?php echo base_url; ?>';						</script>						<?php						die();					}					$blog_post_row=mysqli_fetch_array($blog_post_result);					$user_id=$blog_post_row['user_id'];					$user_profile_picture=getUserProfileImage($user_id);					$blog_root_id=$blog_post_row['blog_id'];					$user_query="SELECT * FROM users WHERE id='$user_id'";					$user_result=mysqli_query($conn,$user_query);					$user_row=mysqli_fetch_array($user_result);				?>
                <div class="uk-width-4-5@m m-auto">
                    <div class="mt-lg-4" uk-grid>
                        <div class="uk-width-2-3@m">
                            <h1><?php echo stripslashes($blog_post_row['title']); ?></h1>

                            <div class="user-details-card pt-0">
                                <div class="user-details-card-avatar" style="max-width: 40px">
                                    <img src="<?php echo $user_profile_picture; ?>" alt="">
                                </div>
                                <div class="user-details-card-name">
                                    <?php echo $user_row['first_name']." ".$user_row['last_name']; ?> <span> <a href="javascript:void(0)">@<?php echo $user_row['username']; ?></a> <span> <?php echo date("d M Y",strtotime($blog_post_row['added'])); ?> </span> </span>
                                </div>
                            </div>

                        </div>
                        <div class="uk-width-1-3@m text-right">
                            <img src="<?php echo base_url; ?>images/blog/<?php echo $blog_post_row['post_feature_image']; ?>" class="rounded" alt="<?php echo stripslashes($blog_post_row['title']); ?>">
                        </div>
                    </div>

					<?php 						$tags=$blog_post_row['tags'];						$tags_arr=explode(",",$tags);						if(!empty($tags_arr))						{							for($i=0;$i<count($tags_arr);$i++)							{								if($tags_arr[$i]!="")								{									?>										<a href="javascript:void(0)" class="button default small"> <?php echo $tags_arr[$i]; ?> </a>&nbsp;&nbsp;									<?php								}							}						}					?>


                    <div class="blog-content mt-3 mt-lg-6 pt-2 pb-2" style="border-top:2px solid gray;border-bottom:2px solid gray;">						<?php							echo stripslashes(html_entity_decode($blog_post_row['content']));						?>
                    </div>
                    <br>
                    <br>					<div class="section-header pb-0">						<div class="section-header-left">							<h3>Other posts in this blog</h3>						</div>					</div>					<div class="uk-position-relative mb-4 mt-4" uk-slider="finite: true">						<div class="uk-slider-container py-3 px-1">							<?php 								$other_blogs_query="SELECT * FROM users_blogs_posts WHERE id!='$blog_post_id' AND blog_id='$blog_root_id' AND user_id='".$_COOKIE['blogger_id']."'";								$other_blogs_result=mysqli_query($conn,$other_blogs_query);								if(mysqli_num_rows($other_blogs_result)>0)								{									?>									<ul class="uk-slider-items uk-child-width-1-6@m uk-child-width-1-3@s uk-child-width-1-2 uk-grid-small uk-grid">									<?php									while($other_blogs_row=mysqli_fetch_array($other_blogs_result))									{										?>											<li>												<a href="<?php echo base_url; ?>view-blog-post.php?blog_post_id=<?php echo $other_blogs_row['id']; ?>">													<div class="course-card-category" style="padding:20px;min-height:200px;max-height:201px;min-width:300px;max-width:301px;">														<img  style="min-width:95%;" src="<?php echo base_url; ?>images/blog/<?php echo $other_blogs_row['post_feature_image']; ?>" alt="<?php echo stripslashes($other_blogs_row['title']); ?>">														<h6><?php echo substr(stripslashes($other_blogs_row['title']),0,75); ?></h6>													</div>												</a>											</li>										<?php									}									?>									</ul>									<a class="uk-position-center-left-out uk-position-small uk-hidden-hover slidenav-prev" href="javascript:void(0);" uk-slider-item="previous"></a>									<a class="uk-position-center-right-out uk-position-small uk-hidden-hover slidenav-next" href="javascript:void(0);" uk-slider-item="next"></a>									<?php								}								else								{									?>									<p>there are no more posts in this blog.</p>									<?php								}							?>						</div>					</div>					<?php						$comments_query="SELECT * FROM tbl_blog_post_comments WHERE post_id='$blog_post_id' AND status=1 ORDER by id DESC";						$comments_result=mysqli_query($conn,$comments_query);					?>
                    <div class="comments mt-4">
                        <h3>Comments
                            <span class="comments-amount"><?php echo mysqli_num_rows($comments_result); ?></span>
                        </h3>

                       <!--Comments--->					   <ul id="comments_section">							<?php								if(mysqli_num_rows($comments_result)>0)								{									while($comments_row=mysqli_fetch_array($comments_result))									{										$user_query="SELECT * FROM users WHERE id='".$_COOKIE['blogger_id']."'";										$user_result=mysqli_query($conn,$user_query);										$user_row=mysqli_fetch_array($user_result);										$user_profile_picture=getUserProfileImage($user_row['id']);										?>										 <li>											<div class="comments-avatar"><img src="<?php echo $user_profile_picture; ?>" alt="<?php echo $user_row['first_name'].' '.$user_row['last_name'] ?>">											</div>											<div class="comment-content">												<div class="comment-by"><?php echo $user_row['first_name'].' '.$user_row['last_name']; ?> <span><?php echo date("d M Y h:i a",strtotime($comments_row['added'])); ?></span>												</div>												<p><?php echo stripslashes($comments_row['comment_text']); ?></p>											</div>										</li>										<?php									}								}							?>					   </ul>                       <!--Comments--->
                    </div>

                    <hr>					<?php						$user_query="SELECT * FROM users WHERE id='".$_COOKIE['blogger_id']."'";						$user_result=mysqli_query($conn,$user_query);						$user_row=mysqli_fetch_array($user_result);						$user_profile_picture=getUserProfileImage($user_row['id']);					?>
                    <div class="comments">
                        <h3>Add Comment </h3>
                        <ul>
                            <li>
                                <div class="comments-avatar"><img id="comments_avtar" data-name="<?php echo $user_row['first_name'].' '.$user_row['last_name'] ?>" src="<?php echo $user_profile_picture; ?>" alt="">
                                </div>
                                <div class="comment-content">
                                    <form class="uk-grid-small uk-grid" uk-grid="">
                                        <div class="uk-width-1-1@s uk-grid-margin uk-first-column">
                                            <label class="uk-form-label">Comment</label>
                                            <textarea class="uk-textarea" id="comment_text" data-blog="<?php echo $blog_root_id; ?>" data-post="<?php echo $blog_post_id; ?>" name="comment_text" placeholder="Enter Your Comments here..." style=" height:160px"></textarea>
                                        </div>
                                        <div class="uk-grid-margin uk-first-column">
                                            <input type="button" onclick="saveComments()" value="submit" class="button primary">
                                        </div>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>		<?php include_once 'chat_sidebar.php'; ?>
    </div>
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
    <script src="<?php echo BLOGGER_ASSETS; ?>assets/js/main.js"></script>	<script>		function saveComments()		{			var comment_text=$("#comment_text").val();			if(comment_text!="")			{				var blog_id=$("#comment_text").data("blog");				var post_id=$("#comment_text").data("post");				$.ajax({					url:'save-blog-post-comment.php',					type:'post',					data:{comment_text:comment_text,blog_id:blog_id,post_id:post_id},					success:function(res)					{						parsedJson=JSON.parse(res);						if(parsedJson.status=="success")						{							var general_html='<li>'+							'<div class="comments-avatar">'+								'<img  src="'+$("#comments_avtar").attr("src")+'" alt="You">'+							'</div>'+							'<div class="comment-content">'+								'<div class="comment-by">'+$("#comments_avtar").data("name")+' <span>Now</span></div>'+								'<p>'+comment_text+'</p>'+							'</div>'+							'</li>';							$("#comments_section").append(general_html);							$("#comment_text").val("");						}						else{							alert('Something went wrong please contact developer.');						}					}				});			}		}	</script>
</body>
</html>