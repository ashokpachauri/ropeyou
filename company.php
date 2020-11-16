<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include_once 'head.php'; ?>
		<?php
			$banner_image_preview= base_url.'uploads/banner-tab-placeholder.png';
			$__comp_tag=$_REQUEST['__comp_tag'];
			$company_id="";
			$exp_comp=explode("-",$__comp_tag);
			$company_id=end($exp_comp);
			if(isset($_POST['company_id']) && $_POST['company_id']!='')
			{
				$company_id=$_POST['company_id'];
			}
			$company_query="SELECT * FROM companies WHERE id='$company_id'";
			$company_result=mysqli_query($conn,$company_query);
			if(mysqli_num_rows($company_result)<=0)
			{
				include_once '404.php';die();
			}
			$company_row=mysqli_fetch_array($company_result);
			if($company_row['banner_image']!=""){ 
				$banner_image_preview= $company_row['banner_image'];
			}
			
			//$company_id=$row['id'];
			function follower($id,$for="company")
			{
				return "14,128,005";
			}
			function all_employees($id,$for="company")
			{
				return "2000";
			}
			function common_connection($id,$for="company")
			{
				return "24";
			}
			function hasValue($value)
			{
				if($value!="" && $value!="null" && $value!=null)
				{
					return true;
				}
				return false;
			}
			$user_authenticated=false;
			$auth_query="SELECT id FROM companies WHERE id='$company_id' AND user_id='".$_COOKIE['uid']."'";
			$auth_response=mysqli_query($conn,$auth_query);
			if(mysqli_num_rows($auth_response)>0)
			{
				$user_authenticated=true;
			}
			//set_cookie("banner_image_preview",$banner_image_preview,time()+(30*24*60*60),"/");
		?>
		<title><?php echo $company_row['title']; ?> - RopeYou  Conects</title>
		<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
		<link href="<?php echo base_url; ?>croppie.css" rel="stylesheet" />
	</head>
	<style>
		h6{
			font-size: 0.7rem !important;
		}
	</style>
	<body>
      <!-- Navigation -->
		<?php include_once 'header.php'; ?>
		
		<div class="profile-cover text-center">
			<img class="img-fluid" id="banner_image_preview" data-sr="<?php  echo $banner_image_preview; ?>" src="<?php  echo $banner_image_preview; ?>" style="width:100%;height:250px;" alt="">
		</div>
		<div class="bg-white shadow-sm border-bottom">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="d-flex align-items-center py-3">
							<div class="profile-left">
								<input type="hidden" name="company_id" id="company_id" value="<?php echo $company_id; ?>">
								<h5 class="font-weight-bold text-dark mb-1 mt-0"><?php echo $company_row['title']; ?> <span class="text-info"><i data-toggle="tooltip" data-placement="top" title="<?php if($company_row['status']=="1"){ echo 'Verified'; } else { echo 'Under Verification'; }?>" class="feather-check-circle" style="<?php if($company_row['status']=="1"){  } else { echo 'color:gray !important;'; }?>"></i></span></h5>
								<p class="mb-0 text-muted"> <?php echo getCompanyCategoryByID($company_row['category']); ?> - <?php echo getCompanyFunctionalAreaByID($company_row['functional_area']); ?> | <?php echo $company_row['location']; ?> <?php echo getCityByID($company_row['city']); ?>, <?php echo getCountryByID($company_row['country']); ?> | <?php echo follower($company_id); ?> followers</p>
							</div>
							<div class="profile-right ml-auto">
								<?php
									if(hasValue($company_row['website']))
									{
								?>
										<a href="<?php echo $company_row['website']; ?>" target="_blank" class="btn btn-light mr-2"> <i class="feather-external-link"></i> Visit website </a>
								<?php
									}
								?>
								<button type="button" class="btn btn-primary"> <i class="feather-plus"></i> Follow </button>
								<?php
									if($user_authenticated)
									{
										?>
										<button type="button" class="btn btn-primary" onclick="editBasicInfo();"> <i class="feather-edit"></i> change </button>
										<?php
									}
								?>
								<input type="file" id="baner_image_input" class="baner_image_input" style="display:none;">
							</div>
						</div>
						<div class="modal fade editBasicInfoModal" id="editBasicInfoModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="editBasicInfoModalBackdrop" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document">
								<style>
									#upload-demo{
										width: 100%;
										height: 270px;
										padding-bottom:25px;
									}
								</style>
								<div class="modal-content">
									<div class="modal-header">
										<h6 class="modal-title" id="editBasicInfoModalBackdrop">Lets upload a beautiful picture to stand out of croud.</h6>
									</div>
									<div class="modal-body">											
										<div class="p-2 d-flex">
											<div id="upload-demo" class="center-block"></div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" id="" onclick="closeBannerEditModal();">Close</button>
										<button type="button" class="btn btn-primary" id="cropImageBtn">Save</button>
									</div>
								</div>
							</div>
						</div>
								
					</div>
				</div>
			</div>
		</div>
		<div class="pb-4 pt-3">
			<div class="container">
				<div class="row">
					<aside class="col col-xl-3 order-xl-1 col-lg-6 order-lg-2 col-md-6 col-sm-6 col-12">
						<div class="modal fade amazing_profile_image_backdrop_modal" id="amazing_profile_image_backdrop_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="amazingProfileImageBackdrop" aria-hidden="true">
							<div class="modal-dialog modal-md" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h6 class="modal-title" id="amazingProfileImageBackdrop">Lets upload a beautiful picture to stand out of croud.</h6>
									</div>
									<div class="modal-body">											
										<div class="p-2 d-flex" style="color:red;" id="file_err"></div>
										<form id="user_profile_image_form" method="post" enctype="multipart/form-data">
											<div class="p-2 d-flex">
												<div class="col-4">
													<?php
														$token="";
														$upquery="SELECT id FROM users_profile_pics WHERE user_id='".$_COOKIE['uid']."'";
														$upresult=mysqli_query($conn,$upquery);
														if(mysqli_num_rows($upresult)>0)
														{
															$uprow=mysqli_fetch_array($upresult);
															$token=$uprow['id'];
														}
													?>
													<input type="hidden" name="profile_image_token" id="profile_image_token" value="<?php echo $token; ?>">
													<img data-file="" id="user_profile_picture_demo" src="<?php echo $profile; ?>" class="img-fluid mt-2 rounded-circle image" style="width:100px;height:100px;border:1px solid #eaebec !important;" alt="<?php echo $user_row['first_name']." ".$user_row['last_name']; ?>">
													<button id="remove_image" type="button" name="remove_image" class="btn btn-danger" onclick="removeProfileImage();" style="margin-top:10px;">Remove</button>
												</div>
												<div class="col-8">
													<input type="file" name="user_profile_picture_field" id="user_profile_picture_field" required style="margin-top:40px;" class="form-control" accept="image/*">
												</div>
											</div>
										</form>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<button type="button" class="btn btn-primary" onclick="saveProfileImage();">Save</button>
									</div>
								</div>
							</div>
						</div>
								
						<div class="box mb-3 shadow-sm border rounded bg-white profile-box text-center">
							<div class="p-5">
								<img src="<?php echo getCompanyLogo($company_row['id']); ?>" style="background-color:transparent;" class="img-fluid" alt="Responsive image">
							 </div>
							 <div class="p-3 border-top border-bottom">
								<h6 class="font-weight-bold text-dark mb-1 mt-0">Tagline</h6>
								<p class="mb-0 text-muted"><?php echo $company_row['tagline']; ?>
								</p>
							 </div>
							 <div class="p-3">
								<div class="d-flex align-items-top mb-2">
								   <p class="mb-0 text-dark font-weight-bold">Common Connections</p>
								   <p class="font-weight-bold text-info mb-0 mt-0 ml-auto"><?php echo common_connection($company_id); ?></p>
								</div>
								<div class="d-flex align-items-top">
								   <p class="mb-0 text-dark font-weight-bold">All Employees</p>
								   <p class="font-weight-bold text-info mb-0 mt-0 ml-auto"><?php echo all_employees($company_id); ?></p>
								</div>
							 </div>
						</div>
						<div class="box shadow-sm mb-3 rounded bg-white ads-box text-center is_stuck">
							 <img src="<?php echo base_url; ?>img/job1.png" class="img-fluid" alt="Responsive image">
							 <div class="p-3 border-bottom">
								<h6 class="font-weight-bold text-dark">RopeYou Solutions</h6>
								<p class="mb-0 text-muted">Looking for talent?</p>
							 </div>
							 <div class="p-3">
								<button type="button" class="btn btn-outline-primary pl-4 pr-4"> POST A JOB </button>
							 </div>
						</div>
					</aside>
					<main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
						<div class="box shadow-sm rounded bg-white mb-3 overflow-hidden">
							<ul class="nav border-bottom osahan-line-tab" id="myTab" role="tablist">
								<li class="nav-item">
								   <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
								</li>
								<!--<li class="nav-item">
								   <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Update</a>
								</li>-->
								<li class="nav-item">
								   <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Jobs</a>
								</li>
								<li class="nav-item">
								   <a class="nav-link" id="type-tab" data-toggle="tab" href="#type" role="tab" aria-controls="type" aria-selected="false">Life</a>
								</li>
							</ul>
						</div>
						<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
								<div class="box shadow-sm border rounded bg-white mb-3">
								   <div class="box-title border-bottom p-3">
									  <h6 class="m-0">About <?php if($user_authenticated) { ?><a href="javascript:void(0);" style="float:right;" data-toggle="modal" data-target="#editAboutModal"><i class="feather-edit"></i></a> <?php } ?></h6>
								   </div>
								   <div class="box-body p-3">
										<p class="mb-0"><?php echo $company_row['about']; ?></p>
								   </div>
								</div>
								<div class="modal fade editAboutModal" id="editAboutModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="editAboutModalBackdrop" aria-hidden="true">
									<div class="modal-dialog modal-md" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h6 class="modal-title" id="editAboutModalBackdrop">Tell us about your company.</h6>
											</div>
											<div class="modal-body">											
												<div class="p-2 d-flex">
													<textarea class="form-control" rows="10" style="width:100%;resize:none;" required name="about" id="about"><?php echo stripslashes($company_row['about']); ?></textarea>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
												<button type="button" class="btn btn-primary" onclick="saveAboutInfo();" id="saveAboutInfo">Save</button>
											</div>
										</div>
									</div>
								</div>
								<div class="modal fade overViewModal" id="overViewModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="overViewModalBackdrop" aria-hidden="true">
									<div class="modal-dialog modal-md" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h6 class="modal-title" id="overViewModalBackdrop">Overview</h6>
											</div>
											<div class="modal-body" style="max-height:500px;overflow-y:auto;">	
												<div class="p-2 d-flex">
													<div class="col-12" id="over_view_error" style="color:red;font-size:12px;">
													</div>
												</div>
												<div class="p-2 d-flex">
													<div class="col-2">
														Tagline
													</div>
													<div class="col-10">
														<input type='text' name="tagline" id="tagline" value="<?php if(isset($company_row['tagline']) && $company_row['tagline']!=""){ echo filter_var($company_row['tagline'],FILTER_SANITIZE_STRING); } ?>" class="form-control" placeholder="Tagline if any.">
													</div>
												</div>
												<div class="p-2 d-flex">
													<div class="col-2">
														Country 
													</div>
													<div class="col-10">
														<select class="custom-select" name="country" id="overview_country" required>
														  <option value="">Select</option>
															<?php
																$country_query="SELECT * FROM country WHERE status=1 ORDER BY title";
																$country_result=mysqli_query($conn,$country_query);
																$country_num_rows=mysqli_num_rows($country_result);
																if($country_num_rows>0)
																{
																	while($country_row=mysqli_fetch_array($country_result))
																	{
																		?>
																		<option value="<?php echo $country_row['id']; ?>" <?php if(isset($company_row['country']) && $company_row['country']!=""){ if($country_row['id']==$company_row['country']){ echo "selected"; } } ?>><?php echo $country_row['title']; ?></option>
																		<?php
																	}
																}
															?>
													   </select>
													</div>
												</div>
												<div class="p-2 d-flex">
													<div class="col-2">
														City 
													</div>
													<div class="col-10">
														<select class="custom-select required" name="city" id="overview_city" required>
															<option value="">Select</option>
														  	<?php
																$city_query="SELECT * FROM city WHERE status=1 AND country='".$company_row['country']."' ORDER BY title";
																$city_result=mysqli_query($conn,$city_query);
																$city_num_rows=mysqli_num_rows($city_result);
																if($city_num_rows>0)
																{
																	while($city_row=mysqli_fetch_array($city_result))
																	{
																		?>
																		<option value="<?php echo $city_row['id']; ?>" <?php if(isset($company_row['city']) && $company_row['city']!=""){ if($city_row['id']==$company_row['city']){ echo "selected"; } } ?>><?php echo $city_row['title']; ?></option>
																		<?php
																	}
																}
															?>
														  <option value="5022" <?php if(isset($company_row['city']) && $company_row['city']!=""){ if("5022"==$company_row['city']){ echo "selected"; } } ?>>Noida</option>
													   </select>
													</div>
												</div>
												<div class="p-2 d-flex">
													<div class="col-2">
														Location 
													</div>
													<div class="col-10">
														<input type="text" class="form-control" name="location" id="location" value="<?php if(isset($company_row['location']) && $company_row['location']!=""){ echo filter_var($company_row['location'],FILTER_SANITIZE_STRING); } ?>" placeholder="Enter your location" aria-label="Enter your location" required="" aria-describedby="locationLabel" data-msg="Please enter your location." data-error-class="u-has-error" data-success-class="u-has-success">
													</div>
												</div>
												<div class="p-2 d-flex">
													<div class="col-2">
														Website 
													</div>
													<div class="col-10">
														<input type="text" name="website" id="website" value="<?php echo $company_row['website']; ?>" class="form-control">
													</div>
												</div>
												
												<div class="p-2 d-flex">
													<div class="col-2">
														Category 
													</div>
													<div class="col-10">
														<select class="custom-select" name="category" id="category" required>
															<option value="">Select</option>
															<?php
																$query="SELECT * FROM company_categories WHERE status=1 ORDER BY title";
																$result=mysqli_query($conn,$query);
																if(mysqli_num_rows($result)>0)
																{
																	while($row=mysqli_fetch_array($result))
																	{
																		?>
																		<option value="<?php echo $row['id']; ?>" <?php if(isset($company_row['category']) && $company_row['category']!=""){ if($row['id']==$company_row['category']){ echo "selected"; } } ?>><?php echo $row['title']; ?></option>
																		<?php
																	}
																}
															?>
														</select>
													</div>
												</div>
												<div class="p-2 d-flex">
													<div class="col-2">
														Functional Area 
													</div>
													<div class="col-10">
														<select class="custom-select" name="functional_area" id="functional_area" required>
														<option value="">Select</option>
															<?php
																$query="SELECT * FROM company_functional_areas WHERE status=1 ORDER BY title";
																$result=mysqli_query($conn,$query);
																if(mysqli_num_rows($result)>0)
																{
																	while($row=mysqli_fetch_array($result))
																	{
																		?>
																		<option value="<?php echo $row['id']; ?>" <?php if(isset($company_row['functional_area']) && $company_row['functional_area']!=""){ if($row['id']==$company_row['functional_area']){ echo "selected"; } } ?>><?php echo $row['title']; ?></option>
																		<?php
																	}
																}
															?>
														</select>
													</div>
												</div>
												<div class="p-2 d-flex">
													<div class="col-2">
														Provides
													</div>
													<div class="col-10">
														<select class="custom-select" name="provides" id="provides" required>
															<option value="2" <?php if(isset($company_row['provides']) && $company_row['provides']!=""){ if("2"==$company_row['provides']){ echo "selected"; } } ?>>Products</option>
															<option value="1" selected>Services</option>
														</select>
													</div>
												</div>
												<div class="p-2 d-flex">
													<div class="col-2">
														Company Size 
													</div>
													<div class="col-10">
														<input type="text" name="company_size" id="company_size" value="<?php echo $company_row['company_size']; ?>" class="form-control">
													</div>
												</div>
												<div class="p-2 d-flex">
													<div class="col-2">
														Headquarter
													</div>
													<div class="col-10">
														<input type="text" name="headquarter" id="headquarter" value="<?php echo $company_row['headquarter']; ?>" class="form-control">
													</div>
												</div>
												<div class="p-2 d-flex">
													<div class="col-2">
														Company Type
													</div>
													<div class="col-10">
														<select name="company_type" id="company_type" class="form-control">
															<option value="0" selected>None</option>
															<?php
																$ct_query="SELECT * FROM company_types WHERE status=1";
																$ct_result=mysqli_query($conn,$ct_query);
																while($ct_row=mysqli_fetch_array($ct_result))
																{
																	?>
																	<option value="<?php echo $ct_row['id']; ?>" <?php if($company_row['company_type']==$ct_row['id']){ echo "selected"; } ?>><?php echo $ct_row['title']; ?></option>
																	<?php
																}
															?>
														</select>
													</div>
												</div>
												<div class="p-2 d-flex">
													<div class="col-2">
														Founded
													</div>
													<div class="col-10">
														<select name="founded_in" id="founded_in" class="form-control">
															<?php
																for($i=1900;$i<=((int)(date('Y')));$i++)
																{
																	?>
																	<option value="<?php echo $i; ?>" <?php if($company_row['founded_in']==$i){ echo "selected"; } ?>><?php echo $i; ?></option>
																	<?php
																}
															?>
														</select>
													</div>
												</div>
												<div class="p-2 d-flex">
													<div class="col-2">
														CEO
													</div>
													<div class="col-10">
														<input type="text" name="ceo" id="ceo" value="<?php echo $company_row['ceo']; ?>" class="form-control">
													</div>
												</div>
												<div class="p-2 d-flex">
													<div class="col-2">
														Revenue
													</div>
													<div class="col-10">
														<input type="text" name="revenue" id="revenue" value="<?php echo $company_row['revenue']; ?>" class="form-control">
													</div>
												</div>
												<div class="p-2 d-flex">
													<div class="col-2">
														Specialities
													</div>
													<div class="col-10">
														<input type="text" name="specialities" id="specialities" value="<?php echo $company_row['specialities']; ?>" class="form-control">
													</div>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
												<button type="button" class="btn btn-primary" onclick="saveOverView();">Save</button>
											</div>
										</div>
									</div>
								</div>
								<div class="box shadow-sm border rounded bg-white mb-3">
								   <div class="box-title border-bottom p-3">
									  <h6 class="m-0">Overview <?php if($user_authenticated) { ?> <a href="javascript:void(0);" style="float:right;" data-toggle="modal" data-target="#overViewModal"><i class="feather-edit"></i></a> <?php } ?> </h6>
								   </div>
								   <div class="box-body">
									  <table class="table table-borderless mb-0">
										 <tbody>
											<tr class="border-bottom">
												<th class="p-3">Website</th>
												<td class="p-3">
													<?php
														if(hasValue($company_row['website']))
														{
													?>
															<a href="<?php echo $company_row['website']; ?>" target="_blank"><?php echo $company_row['website']; ?></a>
													<?php
														}
														else{
															echo "NA";
														}
													?>
												</td>
											</tr>
											<tr class="border-bottom">
											   <th class="p-3">Industry</th>
											   <td class="p-3"><?php echo getCompanyCategoryByID($company_row['category']); ?> - <?php echo getCompanyFunctionalAreaByID($company_row['functional_area']); ?></td>
											</tr>
											<tr class="border-bottom">
												<th class="p-3">Company size</th>
												<td class="p-3">
												<?php
													if(hasValue($company_row['company_size']))
													{
														echo $company_row['company_size'].' employees';
													}
													else{
														echo "NA";
													}
												?>
												 </td>
											</tr>
											<tr class="border-bottom">
											   <th class="p-3">Headquarters</th>
											   <td class="p-3">
												<?php
													if(hasValue($company_row['headquarter']))
													{
														echo $company_row['headquarter'];
													}
													else
													{
														echo "NA";
													}
												?>
											   </td>
											</tr>
											<tr class="border-bottom">
											   <th class="p-3">Type</th>
											   <td class="p-3">
												<?php
													if(hasValue($company_row['company_type']))
													{
														echo getCompanyTypeByID($company_row['company_type']);
													}
													else
													{
														echo "NA";
													}
												?>
											   </td>
											</tr>
											<tr class="border-bottom">
												<th class="p-3">Founded</th>
												<td class="p-3">
													<?php
														if(hasValue($company_row['founded_in']))
														{
															echo $company_row['founded_in'];
														}
														else
														{
															echo "NA";
														}
													?>
												</td>
											</tr>
											<tr class="border-bottom">
												<th class="p-3">CEO</th>
												<td class="p-3">
													<?php
														if(hasValue($company_row['ceo']))
														{
															echo $company_row['ceo'];
														}
														else
														{
															echo "NA";
														}
													?>
												</td>
											</tr>
											<tr class="border-bottom">
												<th class="p-3">Revenue</th>
												<td class="p-3">
													<?php
														if(hasValue($company_row['revenue']))
														{
															echo $company_row['revenue'];
														}
														else
														{
															echo "NA";
														}
													?>
												</td>
											</tr>
											<tr>
												<th class="p-3">Specialties</th>
												<td class="p-3">
													<?php
														if(hasValue($company_row['specialities']))
														{
															echo $company_row['specialities'];
														}
														else
														{
															echo "NA";
														}
													?>
												</td>
											</tr>
										 </tbody>
									  </table>
								   </div>
								</div>
								<!--<div class="box shadow-sm border rounded bg-white mb-3">
								   <div class="box-title border-bottom p-3">
									  <h6 class="m-0">Locations<a href="javascript:void(0);" style="float:right;" onclick="openEdit();"><i class="feather-edit"></i></a></h6>
								   </div>
								   <div class="p-3">
									  <div class="row">
										 <div class="col-md-6">
											<div class="card overflow-hidden">
											   <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3501889.172354371!2d73.15671299623955!3d31.003573085499198!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391964aa569e7355%3A0x8fbd263103a38861!2sPunjab!5e0!3m2!1sen!2sin!4v1575738201305!5m2!1sen!2sin" width="100%" height="150" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
											   <div class="card-body">
												  <h6 class="card-title">Postal Address</h6>
												  <p class="card-text">PO Box 16122 Collins Street West Victoria 8007 Australia</p>
												  <a href="#" class="text-link font-weight-bold"><i class="feather-external-link"></i> Get Directions</a>
											   </div>
											</div>
										 </div>
										 <div class="col-md-6">
											<div class="card overflow-hidden">
											   <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d109552.19658166621!2d75.78663235513761!3d30.900473637624447!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391a837462345a7d%3A0x681102348ec60610!2sLudhiana%2C%20Punjab!5e0!3m2!1sen!2sin!4v1575738867148!5m2!1sen!2sin" width="100%" height="150" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
											   <div class="card-body">
												  <h6 class="card-title">Envato HQ</h6>
												  <p class="card-text">121 King Street, Melbourne Victoria 3000 Australia</p>
												  <a href="#" class="text-link font-weight-bold"><i class="feather-external-link"></i> Get Directions</a>
											   </div>
											</div>
										 </div>
									  </div>
								   </div>
								</div>-->
							</div>
							<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
								<div class="box shadow-sm border rounded bg-white p-3">
								   <div class="row">
								   	<?php 
											$latest_opening_query="SELECT * FROM jobs WHERE company_id='$company_id' ORDER BY id DESC LIMIT 10";
											$latest_opening_result=mysqli_query($conn,$latest_opening_query);
											$latest_opening_num_rows=mysqli_num_rows($latest_opening_result);
										?>
										<?php
											if($latest_opening_num_rows>0)
											{
												while($latest_opening_row=mysqli_fetch_array($latest_opening_result))
												{
													$status_row=mysqli_fetch_array(mysqli_query($conn,"SELECT title FROM job_status WHERE id='".$latest_opening_row['status']."'"));
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
																 <img class="img-fluid ml-auto" src="<?php echo base_url; ?>img/l1.png" alt="">
															  </div>
															  <div class="d-flex align-items-center p-3 border-top border-bottom job-item-body">
																 <div class="overlap-rounded-circle">
																	<img class="rounded-circle shadow-sm" data-toggle="tooltip" data-placement="top" title="Sophia Lee" src="<?php echo base_url; ?>img/p1.png" alt="">
																	<img class="rounded-circle shadow-sm" data-toggle="tooltip" data-placement="top" title="John Doe" src="<?php echo base_url; ?>img/p2.png" alt="">
																	<img class="rounded-circle shadow-sm" data-toggle="tooltip" data-placement="top" title="Julia Cox" src="<?php echo base_url; ?>img/p3.png" alt="">
																	<img class="rounded-circle shadow-sm" data-toggle="tooltip" data-placement="top" title="Robert Cook" src="<?php echo base_url; ?>img/p4.png" alt="">
																	<img class="rounded-circle shadow-sm" data-toggle="tooltip" data-placement="top" title="Sophia Lee" src="<?php echo base_url; ?>img/p5.png" alt="">
																 </div>
																 <span class="font-weight-bold text-primary">18 connections</span>
															  </div>
															  <div class="p-3 job-item-footer">
																 <small class="text-gray-500"><i class="feather-clock"></i> Posted 3 Days ago</small>
															  </div>
														   </div>
														</a>
													</div>
										<?php
												}
											}
											else{
												?>
												<div class="col-md-12" style="padding:30px;">
													<h4 style="text-align: center;">There is no job data for this organization to show you.</h4>
												</div>
												<?php
											}
										?>
								   </div>
								</div>
							</div>
							<div class="tab-pane fade" id="type" role="tabpanel" aria-labelledby="type-tab">
								<div class="box shadow-sm border rounded bg-white mb-3">
								   <div class="box-title border-bottom p-3">
									  <h6 class="m-0">Culture at <?php echo $company_row['title']; ?> <?php if($user_authenticated) { ?><a href="javascript:void(0);" style="float:right;" onclick="openEdit();"><i class="feather-edit"></i></a> <?php } ?> </h6>
								   </div>
								   <div class="box-body p-3">
										<p class="mb-0">
											<?php
												if(hasValue($company_row['life_at_company']))
												{
													echo $company_row['life_at_company'];
												}
												else
												{
													echo "NA";
												}
											?>
										</p>
								   </div>
								</div>
							</div>
						</div>
					</main>
					<aside class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-6 col-12">
						<div class="box mb-3 shadow-sm border rounded bg-white profile-box text-center">
							<div class="p-2 border-bottom">
								<h6 class="font-weight-bold">Video <?php if($user_authenticated) { ?><a href="javascript:void(0);" onclick="getVideoCV();" style="float:right;"><i class="feather-settings"></i></a><?php } ?></h6>
							</div>
							<?php
								$v_query="SELECT * FROM company_videos WHERE company_id='".$company_id."' AND status=1 ORDER BY id DESC";
								$v_result=mysqli_query($conn,$v_query);
								$video_num_rows=mysqli_num_rows($v_result);
								$video_file="";
								$token_video="";
								$is_utube_video=0;
								if($video_num_rows>0)
								{
									//$profile_percentage=$profile_percentage+10;
									$v_row=mysqli_fetch_array($v_result);
									$video_file=base_url.$v_row['video_file'];
									$video_tags=$v_row['video_tags'];
									$video_title=$v_row['video_title'];
									//$profile_title=$v_row['tagline'];
									$video_type=$v_row['video_type'];
									$token_video=$v_row['id'];
									$video_description=$v_row['video_description'];
									$is_utube_video=$v_row['is_utube_video'];
									if($is_utube_video=="1")
									{
										$video_file="https://www.youtube.com/embed/".$v_row['video_file']."?rel=0&autoplay=0&mute=1&muted";
									}
								}
							?>
							
							<div class="modal fade video_cv_upload_modal" id="video_cv_upload_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="amazingVideoCVBackdrop" aria-hidden="true">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h6 class="modal-title" id="amazingVideoCVBackdrop">Let us upload a video to your company page.</h6>
										</div>
										<div class="modal-body">											
											<div class="p-2 d-flex" style="color:red;" id="video_file_err"></div>
											<form id="user_profile_video_form" method="post" enctype="multipart/form-data">
												<input type="hidden" name="company_id" value="<?php echo $company_id; ?>">
												<div class="d-flex p-2">
													<div class="col-12">
														<?php
															if($video_file!="")
															{
																?>
																	<!--<iframe src="<?php echo showVideo($video_file); ?>" id="utube_src" class="utube_src" style="width:250px;height:250px;overflow:hidden;" autoplay="false"></iframe>-->
																	<iframe src="<?php echo showVideo($video_file); ?>" frameborder="0" allow="accelerometer;  encrypted-media; gyroscope; picture-in-picture;nodownload;" allowfullscreen style="width:100%;height:auto;"></iframe>
																<?php
															}
														?>
													</div>
												</div>
												<div class="d-flex p-2">
													<input type="hidden" name="token" id="token_video" value="<?php echo $token_video; ?>">
													<div class="col-3">
														<h6 style="text-align:left;">Video Type*</h6>
														<select name="video_type" id="video_type" class="form-control">
															<?php
																$vt_query="SELECT * FROM video_types WHERE status=1 AND is_video=1 AND is_for_user=0";
																$vt_result=mysqli_query($conn,$vt_query);
																if(mysqli_num_rows($vt_result)>0)
																{
																	while($vt_row=mysqli_fetch_array($vt_result))
																	{
																		?>
																		<option value="<?php echo $vt_row['id']; ?>" <?php if($video_type==$vt_row['id']){ echo 'selected'; } ?>><?php echo $vt_row['title']; ?></option>
																		<?php
																	}
																}
															?>
														</select>
													</div>
													<div class="col-3 video_file_shown" <?php if($is_utube_video=="1"){ echo "style='display:none;'"; } ?>>
														<h6 style="text-align:left;">Video File*</h6>
														<input type="file" name="profile_video_cv" class="form-control" required id="profile_video_cv" accept=".mp4">
													</div>
													<div class="col-3 video_file_shown" <?php if($is_utube_video=="0"){ echo "style='display:none;'"; } ?>>
														<h6 style="text-align:left;">Utube Video Link*</h6>
														<input type="test" name="utube_url" value="<?php if($is_utube_video=="1"){ echo "https://www.youtube.com/watch?v=".$v_row['video_file']; } ?>" placeholder="Utube Video URL" onkeyup="utubeUrlDisplay();" class="form-control" required id="utube_url">
													</div>
													<div class="col-2">
														<h6 style="text-align:left;">Is utube Video*</h6>
														<select id="is_utube_video" name="is_utube_video" class="form-control" required>
															<option value="0" selected>No</option>
															<option value="1" <?php if($is_utube_video=="1"){ echo "selected"; } ?>>Yes</option>
														</select>
													</div>
												</div>
												<div class="p-2 d-flex">
													<div class="col-6">
														<h6 style="text-align:left;">Video Title*</h6>
														<input type="text" name="video_title" value="<?php echo $video_title; ?>" class="form-control" placeholder="Video Title">
													</div>
													<div class="col-6">
														<h6 style="text-align:left;">Video Tags*</h6>
														<input type="text" name="video_tags" value="<?php echo $video_tags; ?>" class="form-control" placeholder="comma seperated video tags">
													</div>
												</div>
												<div class="p-2 d-flex">
													<div class="col-12">
														<h6 style="text-align:left;">Video Description*</h6>
														<textarea style="resize:none;" rows="3" id="video_description" name="video_description"  class="form-control" placeholder="Description"><?php echo $video_description; ?></textarea>
													</div>
												</div>
											</form>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" id="close" data-dismiss="modal">Close</button>
											<button type="button" class="btn btn-primary" id="saveCompany" onclick="saveCompanyVideo();">Save</button>
										</div>
									</div>
								</div>
							</div>
							<div class="modal fade load_me" id="load_me" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="load_meBackdrop" aria-hidden="true">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h6 class="modal-title" id="load_meBackdrop">Action in Progress.</h6>
										</div>
										<div class="modal-body">											
											<div class="p-2 d-flex">
												
											</div>
										</div>
										<div class="modal-body text-center">
											<div class="loader"></div>
											<div class="loader-txt">
											  <p>the action performed is in progress. please wait a little.</p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="py-3 px-1 border-bottom">
								<!--<iframe src="<?php echo showVideo($video_file); ?>" class="utube_src" id="video_preview_data" style="width:250px;height:250px;overflow:hidden;" autoplay="false"></iframe>-->
								<?php
									if($video_file!="")
									{
										?>
										<iframe src="<?php echo showVideo($video_file); ?>" frameborder="0" allow="accelerometer;  encrypted-media; gyroscope; picture-in-picture;nodownload;" allowfullscreen style="width:100%;height:auto;"></iframe>
										<h6 class="text-truncate" id="video_profile_title" style="font-weight:normal !important;margin-top:20px;"><?php echo $video_title; ?></h6>
										<?php 
									} 
									else{
										echo 'video profile is not availble';
									}
								?>
							</div>
						</div>
						<div class="box shadow-sm border rounded bg-white mb-3">
							 <div class="box-title border-bottom p-3">
								<h6 class="m-0">Similar companies</h6>
							 </div>
							 <div class="box-body p-3">
								 <?php
									$comp_query="SELECT * FROM companies WHERE id!='$company_id' ORDER BY id DESC LIMIT 5";
									$comp_result=mysqli_query($conn,$comp_query);
									if(mysqli_num_rows($comp_result)>0)
									{
										while($comp_row=mysqli_fetch_array($comp_result))
										{
											?>
											<div class="d-flex align-items-center osahan-post-header mb-3 people-list">
											   <div class="dropdown-list-image mr-3">
												  <img class="rounded-circle" src="<?php echo getCompanyLogo($comp_row['id']); ?>" alt="">
											   </div>
											   <div class="font-weight-bold mr-2">
												  <div class="text-truncate"><?php echo $comp_row['title']; ?></div>
												  <div class="small text-gray-500"><?php echo $comp_row['headquarter']; ?>
												  </div>
											   </div>
											   <span class="ml-auto"><button type="button" class="btn btn-light btn-sm text-nowrap"><i class="feather-plus"></i> Follow</button>
											   </span>
											</div>
											<?php
										}
									}
								 ?>
							</div>
						</div>
						<?php include_once 'recent_profile_views.php'; ?>
						<!--<div class="box shadow-sm mb-3 border rounded bg-white ads-box text-center is_stuck">
							 <img src="<?php echo base_url; ?>img/ads1.png" class="img-fluid" alt="Responsive image">
							 <div class="p-3 border-bottom">
								<h6 class="font-weight-bold text-gold">RopeYou Premium</h6>
								<p class="mb-0 text-muted">Grow &amp; nurture your network</p>
							 </div>
							 <div class="p-3">
								<button type="button" class="btn btn-outline-gold pl-4 pr-4"> ACTIVATE </button>
							 </div>
						</div>-->
					</aside>
				</div>
			</div>
		</div>
		<?php include_once 'scripts.php'; ?>
		<script src="<?php echo base_url; ?>/js/sweetalert.min.js"></script>
		<script src="<?php echo base_url; ?>jquery.sticky-kit.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
		<script src="<?php echo base_url; ?>croppie.js"></script>
		<script src="<?php echo base_url; ?>crop.js"></script>
		<script>
			$(".is_stuck").stick_in_parent();
			var base_url="<?php echo base_url; ?>";
			function getVideoCV()
			{
				$("#video_cv_upload_modal").modal("show");
			}
			function loader(action)
			{
				if(action=="" || action=="open")
				{
					$("#load_me").modal({
					  backdrop: "static", //remove ability to close modal with click
					  keyboard: false, //remove option to close with keyboard
					  show: true //Display loader!
					});
				}
				else
				{
					$("#load_me").modal({show:false,hide:true});
				}
			}
			function utubeUrlDisplay(){
				console.log($("#utube_url").val());
				var url_input=$("#utube_url").val().trim();
				var arr=url_input.split("watch?v=");
				videoID="";
				if(arr.length>1)
				{
					videoID=arr[1];
				}
				var url = "https://www.youtube.com/embed/" + videoID+'?rel=0&autoplay=1&mute=1';
				$('.utube_src').attr("src",url);
				//var $source = $('#utube_src').attr("src",$("#utube_url").val());
				//$source[0].src = $("#utube_url").val().trim();
				//$source.parent()[0].load();
			}
			$("#is_utube_video").change(function(){
				$(".video_file_shown").toggle("display");
			});
			$(document).on("change", "#profile_video_cv", function(evt) {
				$('.utube_src').attr("src",URL.createObjectURL(this.files[0])+"?rel=0&autoplay=0&mute=1&muted");
				//$('.utube_src').load();
			});
			function saveCompanyVideo()
			{
				$("#video_file_err").html('');
				var form = $('#user_profile_video_form')[0]; // You need to use standard javascript object here
				var formData = new FormData(form);
				var video_title=$("#video_title").val();
				var video_tags=$("#video_tags").val();
				var video_description=$("#video_description").val();
				if(video_title=="" || video_tags=="" || video_description=="")
				{
					$("#video_file_err").html("Please fill all required fields.");
				}
				else
				{ 
					$("#close").attr("disabled",true);
					$("#saveCompany").attr("disabled",true);
					$("#load_me").modal('show');
					$.ajax({
						url:base_url+"savecompanyprofilevideo",
						type:"post",
						data:formData,
						contentType: false, 
						processData: false,
						success:function(data)
						{
							$("#load_me").modal('hide');
							var parsedJson=JSON.parse(data);
							if(parsedJson.status=="success")
							{
								$("#load_me").modal('hide');
								setTimeout(function(){
									$("#load_me").modal('hide');
									$('.utube_src').attr("src",parsedJson.data);
									$("#token_video").val(parsedJson.id);
									$("#video_profile_title").html(parsedJson.video_title);
									$(".modal").modal("hide");
									
									$("#close").removeAttr("disabled");
									$("#saveCompany").removeAttr("disabled");
								},1000);
							}
							else
							{
								$("#load_me").modal('hide');
								$("#video_file_err").html(parsedJson.message);
								$("#close").removeAttr("disabled");
								$("#saveCompany").removeAttr("disabled");
							}
						}
					});
				}
			}
			function saveOverView()
			{
				var tagline=$("#tagline").val().trim();
				var country=$("#overview_country").val().trim();
				var city=$("#overview_city").val().trim();
				var location=$("#location").val().trim();
				var website=$("#website").val().trim();
				var category=$("#category").val().trim();
				var functional_area=$("#functional_area").val().trim();
				var provides=$("#provides").val().trim();
				var company_size=$("#company_size").val().trim();
				var headquarter=$("#headquarter").val().trim();
				var company_type=$("#company_type").val().trim();
				var founded_in=$("#founded_in").val().trim();
				var ceo=$("#ceo").val().trim();
				var revenue=$("#revenue").val().trim();
				var specialities=$("#specialities").val().trim();
				var company_id=$("#company_id").val();
				if(country!="" && city!="" && location!="" && founded_in!="" && company_id!="" && category!="" && functional_area!="" && provides!="")
				{
					$.ajax({
						url:base_url+'save-company-overview',
						type:'post',
						data:{id:company_id,tagline:tagline,country:country,city:city,location:location,website:website,category:category,functional_area:functional_area,provides:provides,company_size:company_size,headquarter:headquarter,company_type:company_type,founded_in:founded_in,ceo:ceo,revenue:revenue,specialities:specialities},
						success:function(response)
						{
							var parsedJson=JSON.parse(response);
							if(parsedJson.status=="success")
							{
								$("#overViewModal").modal('hide');
							}
							else
							{
								$("#over_view_error").html(parsedJson.message);
							}
						}
					});
				}
				else
				{
					$("#over_view_error").html("Please fill all required fileds.");
				}
			}
			$("#overview_country").change(function(){
				var country=$("#overview_country").val();
				if(country=="")
				{
					$("#overview_city").html("<option value=''>Select a country first</option>");
				}
				else
				{
					$.ajax({
						url:base_url+'getcities',
						type:'post',
						data:{country:country},
						success:function(data)
						{
							var parsedJson=JSON.parse(data);
							$("#overview_city").html(parsedJson.htmlData);
						}
					});
				}
			});
			
			function saveAboutInfo()
			{
				var about=$("#about").val().trim();
				var company_id=$("#company_id").val();
				if(about!="")
				{
					$.ajax({
						url:base_url+'save-company-about',
						type:'post',
						data:{company_id:company_id,about:about},
						success:function(response)
						{
							var parsedJson=JSON.parse(response);
							
							$("#editAboutModal").modal('hide');
							if(parsedJson.status=="error")
							{
								alert(parsedJson.message);
							}
						}
					});
				}
				else
				{
					alert('Please fill all required fields.');
				}
			}
			var baner_croppie=null;
			/*function closeBannerEditModal()
			{
				//baner_croppie.destroy();
				$("#editBasicInfoModal").modal('hide');
			}
			function saveCompanyBanner()
			{
				//baner_croppie.destroy();
				$("#editBasicInfoModal").modal('hide');
			}*/
			function editBasicInfo()
			{
				$("#baner_image_input").click();
				/*$.ajax({
					url:base_url+'get-company-top-edit',
					type:'post',
					success:function(data){
						var parsedJSon=JSON.parse(data);
						$("#editBasicInfoModal").modal('show');
						/*var baner_croppie = $('#company_banner_demo').croppie({
							viewport: {
								width: 150,
								height: 200
							}
						});
						baner_croppie.croppie('bind', {
							url: $('#company_banner_demo_image').attr('src')
						});
						//on button click
						baner_croppie.croppie('result', 'html').then(function(html) {
							// html is div (overflow hidden)
							// with img positioned inside.
						});
						//$('#company_banner_demo_image').croppie();
					}
				});*/
			}
		</script>
	</body>
</html>
