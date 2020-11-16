<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include_once 'head.php'; ?>
		<title>Jobs in Cart | RopeYou Connects</title>
	</head>
	<body>
      <!-- Navigation -->
      <?php include_once 'header.php'; ?>
	  <div class="py-4">
         <div class="container">
            <div class="row">
               <!-- Main Content -->
				<main class="col col-xl-9 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
                  <div class="box shadow-sm border rounded bg-white mb-3">
                     <div class="box-title border-bottom p-3">
                        <h6 class="m-0">Jobs in Cart</h6>
                     </div>
                     <div class="box-body p-1">
						<?php
							$ids=array();
							$job_cart_query="SELECT * FROM job_cart WHERE user_id='".$_COOKIE['uid']."' ORDER BY id DESC";
							$job_cart_result=mysqli_query($conn,$job_cart_query);
							$job_cart_num_row=mysqli_num_rows($job_cart_result);
							if($job_cart_num_row>0)
							{
								while($job_cart_row=mysqli_fetch_array($job_cart_result))
								{
									$cart_job_id=$job_cart_row['job_id'];
									$latest_opening_query="SELECT * FROM jobs WHERE id='".$cart_job_id."'";
									$latest_opening_result=mysqli_query($conn,$latest_opening_query);
									$latest_opening_num_rows=mysqli_num_rows($latest_opening_result);
									$latest_opening_row=mysqli_fetch_array($latest_opening_result);
									
									$og_title=base_url."job/".trim(strtolower($latest_opening_row['job_title']))." ".trim(strtolower($latest_opening_row['job_company']));
									$og_title=str_replace(" ","-",$og_title);
									$og_url=$og_title."-".$latest_opening_row['id'].".html";
									?>
										<div class="col-md-4">
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
													 <small class="text-gray-500"><i class="feather-clock"></i>&nbsp;<?php echo date("d M Y",strtotime($latest_opening_row['added'])); ?></small>
												  </div>
											   </div>
											</a>
										</div>
									<?php
								}
							}
							else
							{
								?>
								<p style="text-align:center;">There is no data to show</p>
								<?php
							}
						?>
                     </div>
					</div>
				</main>
				<aside class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-6 col-12">
					<?php include_once 'people_you_may_know.php'; ?>
					<?php include_once 'recent-jobs.php'; ?>
               </aside>
            </div>
         </div>
      </div>
      <!-- Bootstrap core JavaScript -->
      <script src="<?php echo base_url; ?>vendor/jquery/jquery.min.js"></script>
      <script src="<?php echo base_url; ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <!-- slick Slider JS-->
      <script type="text/javascript" src="<?php echo base_url; ?>vendor/slick/slick.min.js"></script>
      <!-- Custom scripts for all pages-->
      <script src="<?php echo base_url; ?>js/osahan.js"></script>
   </body>
</html>
