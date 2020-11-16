<!DOCTYPE html>
<html lang="en">
   <head>
		<?php include_once 'head.php'; ?>
		<title>Recent Openings | RopeYou Connects</title>
	</head>
	<body>
		<?php include_once 'header.php'; ?>
		<div class="py-4">
			<div class="container" style="position:relative;">
				<div class="row">
				   <!-- Main Content -->
				   <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
					  <div class="box shadow-sm border rounded bg-white mb-3 osahan-share-post">
						 <form class="job-search p-3 border-bottom">
							<div class="input-group">
							   <input type="text" class="form-control" placeholder="Search jobs" id="search_field" aria-label="Search" aria-describedby="basic-addon2">
							   <div class="input-group-append">
									<button class="btn btn-outline-secondary" onclick="change_dom();" type="button">
										<i class="feather-search"></i>
									</button>
							   </div>
							</div>
						 </form>
						 <div class="tab-content" id="myTabContent">
							<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
							   <div class="p-3 border-top">
									<div class="row">
										 <?php 
											$latest_opening_query="SELECT * FROM jobs ORDER BY added DESC LIMIT 10";
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
																 <img class="img-fluid ml-auto" src="<?php echo base_url; ?>alphas/<?php echo substr(strtolower($latest_opening_row['job_company']),0,1).".png"; ?>" alt="">
															  </div>
															  <?php
																	getCommonPersonsOnJob($latest_opening_row['id'],$_COOKIE['uid']);
															  ?>
															  <div class="p-3 job-item-footer">
																 <small class="text-gray-500"><i class="feather-clock"></i><?php echo date("d M Y",strtotime($latest_opening_row['added'])); ?></small>
															  </div>
														   </div>
														</a>
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
				   </main>
					<aside class="col col-xl-3 order-xl-1 col-lg-6 order-lg-2 col-md-6 col-sm-6 col-12">
						<div class="box shadow-sm mb-3 rounded bg-white ads-box text-center overflow-hidden">
							<a href="javascript:void(0)" onclick="change_dom('no');" class="btn btn-outline-secondary mr-1" style="margin:5px;">All</a>
							<?php
								$industry_query="SELECT id,slug,title FROM industries WHERE status=1 ORDER BY title ASC";
								$industry_result=mysqli_query($conn,$industry_query);
								if(mysqli_num_rows($industry_result)>0)
								{
									while($industry_row=mysqli_fetch_array($industry_result))
									{
										$slug=$industry_row['slug'];
										?>
											<a href="javascript:void(0)" onclick="loadIndustries('<?php echo $slug; ?>');" style="margin:5px;" class="btn btn-outline-secondary mr-1" data-target="<?php echo $industry_row['slug']; ?>"><?php echo $industry_row['title']; ?></a>
										<?php
									}
								}
							?>
						</div>
					</aside>
				   <aside class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-6 col-12">
						<div class="pb-3">
							<h6 class="font-weight-bold text-dark mb-1">Sponsered Jobs</h6>
						</div>
						<?php 
							$latest_opening_query="SELECT * FROM jobs ORDER BY rand() ASC LIMIT 5";
							$latest_opening_result=mysqli_query($conn,$latest_opening_query);
							$latest_opening_num_rows=mysqli_num_rows($latest_opening_result);
							while($job_row=mysqli_fetch_array($latest_opening_result))
							{
								?>
								<a href="job-profile.html">
									<div class="shadow-sm rounded bg-white job-item mb-3">
										<div class="d-flex align-items-center p-3 job-item-header">
										   <div class="overflow-hidden mr-2">
											  <h6 class="font-weight-bold text-dark mb-0 text-truncate"><?php echo $job_row['job_title']; ?></h6>
											  <div class="text-truncate text-primary"><?php echo $job_row['job_company']; ?></div>
											  <div class="small text-gray-500"><i class="feather-map-pin"></i><?php echo $job_row['job_location']; ?></div>
										   </div>
										   <img class="img-fluid ml-auto" src="<?php echo base_url; ?>alphas/<?php echo substr(strtolower($job_row['job_company']),0,1).".png"; ?>" alt="<?php echo $job_row['job_title']; ?>">
										</div>
										<?php getCommonPersonsOnJob($job_row['id'],$_COOKIE['uid']); ?>
										<div class="p-3 job-item-footer">
										   <small class="text-gray-500"><i class="feather-clock"></i><?php echo date("d M Y",strtotime($job_row['added'])); ?></small>
										</div>
									</div>
								</a>
								<?php
							}
						?>
						<?php include_once 'people_you_may_know.php'; ?>
					</aside>
				</div>
			</div>
		</div>
		<?php include_once 'scripts.php';  ?>
		<script src="<?php echo base_url; ?>jquery.sticky-kit.js"></script>
		<script>
			$(".is_stuck").stick_in_parent();
			var base_url="<?php echo base_url; ?>";
			function change_dom(search_field='yes')
			{
				if(search_field=="yes")
				{
					search_field=$("#search_field").val();
					search_field=search_field.split(" ").join("-");
				}
				else
				{
					search_field='';
				}
				$("#home").load(base_url+'get-job-recent-search.php?search='+search_field);
			}
			function loadIndustries(industry)
			{
				$("#home").load(base_url+'get-job-recent-search.php?industry='+industry);
			}
		</script>
   </body>
</html>
