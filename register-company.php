<!DOCTYPE html>
<html lang="en">
   <head>
		<?php include_once 'head.php'; ?>
		<title>Register Your | RopeYou Connects</title>
	</head>
	<body>
		<?php
			if(isset($_POST['create_company']))
			{
				$user_id="";$fb_p="";$ig_p="";$in_p="";$tw_p="";$yt_p="";$gh_p="";$website="";$logo_image="";$banner_image="";
				if(isset($_POST['fb_p']) && $_POST['fb_p']!=""){ $fb_p=filter_var($_POST['fb_p'],FILTER_SANITIZE_URL); }
				if(isset($_POST['ig_p']) && $_POST['ig_p']!=""){ $ig_p=filter_var($_POST['ig_p'],FILTER_SANITIZE_URL); }
				if(isset($_POST['in_p']) && $_POST['in_p']!=""){ $in_p=filter_var($_POST['in_p'],FILTER_SANITIZE_URL); }
				if(isset($_POST['tw_p']) && $_POST['tw_p']!=""){ $tw_p=filter_var($_POST['tw_p'],FILTER_SANITIZE_URL); }
				if(isset($_POST['yt_p']) && $_POST['yt_p']!=""){ $yt_p=filter_var($_POST['yt_p'],FILTER_SANITIZE_URL); }
				if(isset($_POST['gh_p']) && $_POST['gh_p']!=""){ $gh_p=filter_var($_POST['gh_p'],FILTER_SANITIZE_URL); }
				if(isset($_POST['website']) && $_POST['website']!=""){ $website=filter_var($_POST['website'],FILTER_SANITIZE_URL); }
				$title=addslashes(filter_var($_POST['name'],FILTER_SANITIZE_STRING));
				$username=filter_var($_POST['username'],FILTER_SANITIZE_STRING);
				$username = preg_replace('/[^\w.]/', '', $username);
				$phonecode=filter_var($_POST['phonecode'],FILTER_SANITIZE_STRING);
				$mobile=filter_var($_POST['mobile'],FILTER_SANITIZE_STRING);
				$email=filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
				$location=addslashes(filter_var($_POST['location'],FILTER_SANITIZE_STRING));
				$country=filter_var($_POST['country'],FILTER_SANITIZE_STRING);
				$city=filter_var($_POST['city'],FILTER_SANITIZE_STRING);
				$category=filter_var($_POST['category'],FILTER_SANITIZE_STRING);
				$functional_area=filter_var($_POST['functional_area'],FILTER_SANITIZE_STRING);
				$provides=filter_var($_POST['provides'],FILTER_SANITIZE_STRING);
				$tagline=addslashes(filter_var($_POST['tagline'],FILTER_SANITIZE_STRING));
				$about=addslashes(filter_var($_POST['about'],FILTER_SANITIZE_STRING));
				
				$username=generateUniqueCompanyUsername($username);
				if(isset($_COOKIE['uid']) && $_COOKIE['uid']!="")
				{
					$user_id=$_COOKIE['uid'];
				}
				else
				{
					$query="SELECT id,username FROM users WHERE email='$email'";
					$result=mysqli_query($conn,$query);
					if(mysqli_num_rows($result)>0)
					{
						$row=mysqli_fetch_array($result);
						$user_id=$row['id'];
						$user_name=$row['username'];
						$cookie_name="uid";
						setcookie("username",$user_name,time()+(30*24*60*60),"/");
						setcookie($cookie_name, $user_id, time() + (86400 * 30), "/");
					}
					else
					{
						$password=md5($email);
						$user_name=generateUniqueUserName($email);
						$mark_my_query="INSERT INTO users SET first_name='$title',role='RY_USER',username='".$user_name."',email='$email',mobile='$mobile',profile_title='$tagline',added=NOW(),status=1,password='$password'";
						$result=mysqli_query($conn,$mark_my_query);
						if($result)
						{
							$user_id=mysqli_insert_id($conn);
							$query="INSERT INTO users_personal SET user_id='$user_id',address='$location',country='$country',home_town='$city',about='$about',phonecode='$phonecode',communication_email='$email',communication_mobile='$mobile',fb_p='$fb_p',ig_p='$ig_p',in_p='$in_p',tw_p='$tw_p',website='$website'";
							
							$result=mysqli_query($conn,$query);
							
							$cookie_name="uid";
							setcookie("username",$user_name,time()+(30*24*60*60),"/");
							setcookie($cookie_name, $user_id, time() + (86400 * 30), "/");
						}
						else
						{
							$user_id=1000;
						}
					}
				}
				
				$query="INSERT INTO companies SET user_id='$user_id',website='$website',fb_p='$fb_p',ig_p='$ig_p',in_p='$in_p',tw_p='$tw_p',yt_p='$yt_p',gh_p='$gh_p',title='$title',username='$username',phonecode='$phonecode',mobile='$mobile',email='$email',location='$location',country='$country',city='$city',category='$category',functional_area='$functional_area',provides='$provides',tagline='$tagline',about='$about',image='$logo_image',banner_image='$banner_image',status=0,added=NOW()";
				$result=mysqli_query($conn,$query);
				if($result)
				{
					//echo $mark_my_query;die();
					?>
					<script>
						location.href="<?php echo base_url.'company/'.$username; ?>";
					</script>
					<?php
				}
				else
				{
					?>
					<script>
						alert('something went wrong.please try again.');
					</script>
					<?php
				}
			}
		?>
		<?php include_once 'header.php'; ?>
		<div class="py-4">
			<div class="container">
				<form class="js-validate" action="" method="post">
					<div class="row">
					   <!-- Main Content -->
					   <aside class="col-md-4">
							<div class="border rounded bg-white mb-3">
								<div class="box-title border-bottom p-3">
									<h6 class="m-0">Social Presence
									<span class="text-primary">(optional)</span></h6>
								</div>
								<div class="box-body">
									<div class="p-3 border-bottom">
										<div class="position-relative icon-form-control mb-2">
											<i class="feather-instagram position-absolute text-warning"></i>
											<input placeholder="Add Instagram link" name="ig_p" value="<?php if(isset($_POST['ig_p']) && $_POST['ig_p']!=""){ echo filter_var($_POST['ig_p'],FILTER_SANITIZE_URL); } ?>" type="text" class="form-control">
										</div>
										<div class="position-relative icon-form-control mb-2">
											<i class="feather-facebook position-absolute text-primary"></i>
											<input placeholder="Add Facebook link" name="fb_p" value="<?php if(isset($_POST['fb_p']) && $_POST['fb_p']!=""){ echo filter_var($_POST['fb_p'],FILTER_SANITIZE_URL); } ?>" type="text" class="form-control">
										</div>
										<div class="position-relative icon-form-control mb-2">
											<i class="feather-twitter position-absolute text-info"></i>
											<input placeholder="Add Twitter link" name="tw_p" value="<?php if(isset($_POST['tw_p']) && $_POST['tw_p']!=""){ echo filter_var($_POST['tw_p'],FILTER_SANITIZE_URL); } ?>" type="text" class="form-control">
										</div>
										<div class="position-relative icon-form-control mb-2">
											<i class="feather-linkedin position-absolute text-danger"></i>
											<input placeholder="Add Linkedin link" name="in_p" value="<?php if(isset($_POST['in_p']) && $_POST['in_p']!=""){ echo filter_var($_POST['in_p'],FILTER_SANITIZE_URL); } ?>" type="text" class="form-control">
										</div>
										<div class="position-relative icon-form-control mb-2">
											<i class="feather-github position-absolute text-dark"></i>
											<input placeholder="Add Github link" name="gh_p" value="<?php if(isset($_POST['gh_p']) && $_POST['gh_p']!=""){ echo filter_var($_POST['gh_p'],FILTER_SANITIZE_URL); } ?>" type="text" class="form-control">
										</div>
										<div class="position-relative icon-form-control mb-2">
											<i class="feather-globe position-absolute text-dark"></i>
											<input placeholder="Add Your Website link" name="website" value="<?php if(isset($_POST['website']) && $_POST['website']!=""){ echo filter_var($_POST['website'],FILTER_SANITIZE_URL); } ?>" type="text" class="form-control">
										</div>
										<div class="position-relative icon-form-control mb-0">
											<i class="feather-youtube position-absolute text-dark"></i>
											<input placeholder="Add Youtube link" name="yt_p" value="<?php if(isset($_POST['yt_p']) && $_POST['yt_p']!=""){ echo filter_var($_POST['yt_p'],FILTER_SANITIZE_URL); } ?>" type="text" class="form-control">
										</div>
									</div>
								</div>
							</div>
							<div class="mb-3 border rounded bg-white profile-box text-center w-10">
								<div class="row" style="margin-top:20px;margin-bottom:15px;">
									<div class="col-7">
										<h6 class="text-center">Logo</h6>
										<img src="<?php echo base_url; ?>img/p13.png" data-org="<?php echo base_url; ?>img/p13.png" id="logo_image" class="img-fluid" style="width:95%;margin-left:4%;" alt="Responsive image">
									</div>
									<div class="col-5">
										<h6 class="text-center">&nbsp;</h6>
										<div class="p-4">
											<label data-toggle="tooltip" data-placement="top" data-original-title="Upload New Picture" class="btn btn-info m-0" for="fileAttachmentBtn">
												<i class="feather-image"></i>
												<input id="fileAttachmentBtn" name="logo_image" type="file" accept=".png,.jpg,.jpeg" class="d-none">
											</label>
											<button data-toggle="tooltip" data-placement="top" data-original-title="Remove" type="button" class="btn btn-danger" onclick="$('#fileAttachmentBtn').val('');$('#logo_image').attr('src',$('#logo_image').attr('data-org'));"><i class="feather-trash-2"></i></button>
										</div>
									</div>
								</div>
							</div>
							<div class="mb-3 border rounded bg-white profile-box text-center w-10">
								<div class="row">
									<div class="col-12">
										<h6 class="text-center p-1">Banner
									</h6>
									</div>
								</div>
								<div class="row">
									<div class="col-12">
										<img src="<?php echo base_url; ?>img/job1.png" data-org="<?php echo base_url; ?>img/job1.png" id="banner_image" style="max-height:175px;width:100%;" class="img-fluid" alt="Responsive image">
									</div>
								</div>
								<div class="row">
									<div class="col-12">
										<div class="p-4">
											<label data-toggle="tooltip" data-placement="top" data-original-title="Upload New Picture" class="btn btn-info m-0" for="fileAttachmentBtn1">
												<i class="feather-image"></i>
												<input id="fileAttachmentBtn1" name="banner_image" type="file" accept=".png,.jpg,.jpeg" class="d-none">
											</label>
											<button data-toggle="tooltip" data-placement="top" data-original-title="Remove" type="button" class="btn btn-danger" onclick="$('#fileAttachmentBtn1').val('');$('#banner_image').attr('src',$('#banner_image').attr('data-org'));"><i class="feather-trash-2"></i></button>
										</div>
									</div>
								</div>
							</div>
						</aside>
						<main class="col-md-8">
							<div class="border rounded bg-white mb-3">
								<div class="box-title border-bottom p-3">
									<h6 class="m-0">More Details about your company or team</h6>
								</div>
								<div class="box-body p-3">
								   <div class="row">
									  <!-- Input -->
									  <div class="col-sm-6 mb-1">
										 <div class="js-form-message">
											<label id="nameLabel" class="form-label">
											Name
											<span class="text-danger">*</span>
											</label>
											<div class="form-group">
											   <input type="text" class="form-control" name="name" value="<?php if(isset($_POST['name']) && $_POST['name']!=""){ echo filter_var($_POST['name'],FILTER_SANITIZE_STRING); } ?>" placeholder="Enter Your Company or Team Name" aria-label="Enter Your Company or Team Name" required="" aria-describedby="nameLabel" data-msg="Enter Your Company or Team Name." data-error-class="u-has-error" data-success-class="u-has-success">
											   <small class="form-text text-muted">This is what your company or team will be known as.</small>
											</div>
										 </div>
									  </div>
									  <!-- End Input -->
									  <!-- Input -->
									  <div class="col-sm-6 mb-1">
										 <div class="js-form-message">
											<label id="usernameLabel" class="form-label">
											Username
											<span class="text-danger">*</span>
											</label>
											<div class="form-group">
											   <input type="text" class="form-control" name="username"  value="<?php if(isset($_POST['username']) && $_POST['username']!=""){ echo filter_var($_POST['username'],FILTER_SANITIZE_STRING); } ?>" placeholder="Enter unique name for your company or team" aria-label="Enter unique name for your company or team" required="" aria-describedby="usernameLabel" data-msg="Enter unique name for your company or team" data-error-class="u-has-error" data-success-class="u-has-success">
											    <small class="form-text text-muted">If provided username is already occupied we will provide a random username which later can be changed.</small>
											</div>
										 </div>
									  </div>
								   </div>
								   <div class="row">
									  <!-- Input -->
									  <div class="col-sm-6 mb-1">
										 <div class="js-form-message">
											<label id="emailLabel" class="form-label">
											Email address
											<span class="text-danger">*</span>
											</label>
											<div class="form-group">
											   <input type="email" class="form-control" name="email" value="<?php if(isset($_POST['email']) && $_POST['email']!=""){ echo filter_var($_POST['email'],FILTER_SANITIZE_EMAIL); } ?>" placeholder="Enter your email address" aria-label="Enter your email address" required="" aria-describedby="emailLabel" data-msg="Please enter a valid email address." data-error-class="u-has-error" data-success-class="u-has-success">
											   <small class="form-text text-muted">We'll never share your email with anyone else.</small>
											</div>
										 </div>
									  </div>
									  <!-- End Input -->
									  <!-- Input -->
									  <div class="col-sm-2 mb-1">
										 <div class="js-form-message">
											<label id="phoneCodeLabel" class="form-label">
											phonecode
											<span class="text-danger">*</span>
											</label>
											<div class="form-group">
											   <select class="form-control" name="phonecode" aria-label="Select Phonecode" required="" aria-describedby="phoneCodeLabel" data-msg="Select Phonecode" data-error-class="u-has-error" data-success-class="u-has-success">
													<option>Select</option>
													<option value="+91" <?php if(isset($_POST['phonecode']) && $_POST['phonecode']=="+91"){ echo "selected"; } ?>>+91</option>
											   </select>
											</div>
										 </div>
									  </div>
									  <div class="col-sm-4 mb-1">
										 <div class="js-form-message">
											<label id="phoneNumberLabel" class="form-label">
											Phone number
											<span class="text-danger">*</span>
											</label>
											<div class="form-group">
											   <input class="form-control" type="tel" name="mobile" value="<?php if(isset($_POST['mobile']) && $_POST['mobile']!=""){ echo filter_var($_POST['mobile'],FILTER_SANITIZE_STRING); } ?>" placeholder="Enter your phone number" aria-label="Enter your phone number" required="" aria-describedby="phoneNumberLabel" data-msg="Please enter a valid phone number" data-error-class="u-has-error" data-success-class="u-has-success">
											</div>
										 </div>
									  </div>
									  
									  <!-- End Input -->
								   </div>
								   <div class="row">
										<div class="col-sm-6 mb-1">
											 <div class="js-form-message">
												<label class="form-label">
												Country
												<span class="text-danger">*</span>
												</label>
												<div class="form-group">
												   <select class="custom-select" name="country">
													  <option value="">Select</option>
													  <option value="101" <?php if(isset($_POST['country']) && $_POST['country']!=""){ if("101"==$_POST['country']){ echo "selected"; } } ?>>English</option>
														<?php
															$query
														?>
												   </select>
												</div>
											 </div>
										</div>
										<div class="col-sm-6 mb-1">
											 <div class="js-form-message">
												<label class="form-label">
												City
												<span class="text-danger">*</span>
												</label>
												<div class="form-group">
												   <select class="custom-select" name="city">
													  <option value="">Select</option>
													  <option value="5022" <?php if(isset($_POST['city']) && $_POST['city']!=""){ if("5022"==$_POST['city']){ echo "selected"; } } ?>>Noida</option>
												   </select>
												</div>
											 </div>
										</div>
										
									  <!-- End Input -->
								   </div>
								   <div class="row">
										<div class="col-sm-6 mb-1">
											<div class="js-form-message">
												<label id="locationLabel" class="form-label">
												Location
												<span class="text-danger">*</span>
												</label>
												<div class="form-group">
												   <input type="text" class="form-control" name="location" value="<?php if(isset($_POST['location']) && $_POST['location']!=""){ echo filter_var($_POST['location'],FILTER_SANITIZE_STRING); } ?>" placeholder="Enter your location" aria-label="Enter your location" required="" aria-describedby="locationLabel" data-msg="Please enter your location." data-error-class="u-has-error" data-success-class="u-has-success">
												</div>
											</div>
										</div>
										<div class="col-sm-6 mb-1">
											<div class="js-form-message">
												<label class="form-label">
												Category
												<span class="text-danger">*</span>
												</label>
												<div class="form-group">
													<select class="custom-select" name="category" required>
														<option value="">Select</option>
														<?php
															$query="SELECT * FROM company_categories WHERE status=1 ORDER BY title";
															$result=mysqli_query($conn,$query);
															if(mysqli_num_rows($result)>0)
															{
																while($row=mysqli_fetch_array($result))
																{
																	?>
																	<option value="<?php echo $row['id']; ?>" <?php if(isset($_POST['category']) && $_POST['category']!=""){ if($row['id']==$_POST['category']){ echo "selected"; } } ?>><?php echo $row['title']; ?></option>
																	<?php
																}
															}
														?>
													</select>
												</div>
											</div>
										</div>										
									</div>
									<div class="row">
										<div class="col-sm-6 mb-1">
											<div class="js-form-message">
												<label class="form-label">
												Functional Area
												<span class="text-danger">*</span>
												</label>
												<div class="form-group">
													<select class="custom-select" name="functional_area" required>
														<option value="">Select</option>
														<?php
															$query="SELECT * FROM company_functional_areas WHERE status=1 ORDER BY title";
															$result=mysqli_query($conn,$query);
															if(mysqli_num_rows($result)>0)
															{
																while($row=mysqli_fetch_array($result))
																{
																	?>
																	<option value="<?php echo $row['id']; ?>" <?php if(isset($_POST['functional_area']) && $_POST['functional_area']!=""){ if($row['id']==$_POST['functional_area']){ echo "selected"; } } ?>><?php echo $row['title']; ?></option>
																	<?php
																}
															}
														?>
													</select>
												</div>
											</div>
										</div>
										<div class="col-sm-6 mb-1">
											<div class="js-form-message">
												<label id="provides_label" class="form-label">
													Provides
													<span class="text-danger">*</span>
												</label>
												<div class="form-group">
													<select class="custom-select" name="provides" required>
														<option value="2" <?php if(isset($_POST['provides']) && $_POST['provides']!=""){ if("2"==$_POST['provides']){ echo "selected"; } } ?>>Products</option>
														<option value="1" selected>Services</option>
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12 mb-1">
											<div class="js-form-message">
												<label class="form-label">
												Tagline 
												<span class="text-primary">(optional)</span>
												</label>
												<div class="form-group">
												   <input type='text'  name="tagline" value="<?php if(isset($_POST['tagline']) && $_POST['tagline']!=""){ echo filter_var($_POST['tagline'],FILTER_SANITIZE_STRING); } ?>" class="form-control" placeholder="Tagline if any.">
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12 mb-1">
											<div class="js-form-message">
												<label class="form-label">
												About your company or team 
												<span class="text-danger">*</span>
												</label>
												<div class="form-group">
												   <textarea style="resize:none;" name="about" rows="10" class="form-control" placeholder="Tell us about your company or team."><?php if(isset($_POST['about']) && $_POST['about']!=""){ echo filter_var($_POST['about'],FILTER_SANITIZE_STRING); } ?></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="mb-3 text-right">
							 <button class="font-weight-bold btn btn-primary rounded p-3" type="submit" name="create_company"> &nbsp;&nbsp;&nbsp;&nbsp;  Sava Chenges &nbsp;&nbsp;&nbsp;&nbsp; </button>
							</div>
						</main>
					</div>
				</form>
			</div>
		</div>
		<?php include_once 'scripts.php';  ?>
		<script>
			function changeBannerImage(input) {
			  if (input.files && input.files[0]) {
				var reader = new FileReader();
				
				reader.onload = function(e) {
				  $('#banner_image').attr("src",e.target.result);
				}
				
				reader.readAsDataURL(input.files[0]); 
			  }
			}
			function changeLogoImage(input) {
			  if (input.files && input.files[0]) {
				var reader = new FileReader();
				
				reader.onload = function(e) {
				  $('#logo_image').attr("src",e.target.result);
				}
				
				reader.readAsDataURL(input.files[0]); 
			  }
			}
			$("#fileAttachmentBtn1").change(function(){
				changeBannerImage(this);
			});
			$("#fileAttachmentBtn").change(function(){
				changeLogoImage(this);
			});
		</script>
	</body>
</html>
