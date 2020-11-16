<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include_once 'head.php'; ?>
		<title>Notification | RopeYou Connects</title>
	</head>
   <body>
      <!-- Navigation -->
      <?php include_once 'header.php'; ?>
	  <div class="py-4">
         <div class="container">
            <div class="row">
               <!-- Main Content -->
               <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
                  
				  <?php
					$recent_profile_views_query="SELECT * FROM threats_to_user WHERE user_id='".$_COOKIE['uid']."' ORDER BY id DESC LIMIT 50";
					$recent_profile_views_result=mysqli_query($conn,$recent_profile_views_query);
					$earlier_num_rows=mysqli_num_rows($recent_profile_views_result);
				  ?>
					<div class="box shadow-sm border rounded bg-white mb-3">
					 <div class="box-title border-bottom p-3">
						<h6 class="m-0">Notifications</h6>
					 </div>
					 <div class="box-body p-0">
						<?php
							if($earlier_num_rows>0)
							{
								while($earlier_row=mysqli_fetch_array($recent_profile_views_result))
								{
									$viewer_id=$earlier_row['user_id'];
									$users_personal_data=getUsersPersonalData($viewer_id);
									$users_data=getUsersData($viewer_id);
									
									$active_query="SELECT * FROM users_logs WHERE user_id='$viewer_id'";
									$active_res=mysqli_query($conn,$active_query);
									$active_row=mysqli_fetch_array($active_query);
									$active_status="bg-success";
									if($active_row['is_active']=="0")
									{
										$active_status="bg-danger";
									}
									?>
									<a href="<?php echo base_url; ?>u/<?php echo $users_data['username']; ?>"><div class="p-3 d-flex align-items-center bg-light border-bottom osahan-post-header">
									   <div class="dropdown-list-image mr-3">
										 <img class="rounded-circle" src="<?php echo getUserProfileImage($viewer_id); ?>" alt="">
										  <div class="status-indicator <?php echo $active_status; ?>"></div>
									   </div>
									   <div class="font-weight-bold">
										  <div class="text-truncate"><?php echo $earlier_row['heading']; ?><span style="float:right;"><?php echo date("M d Y h:i a",strtotime($earlier_row['added'])); ?></span></div>
										  <div class="small"><?php echo $earlier_row['message']; ?></div>
									   </div>
									</div></a>
									<?php
								}
							}
							else
							{
								?>
								<p style="text-align:center;">no more data available for profile views</p>
								<?php
							}
						?>
					 </div>
				  </div>
			   </main>
               <aside class="col col-xl-3 order-xl-1 col-lg-6 order-lg-2 col-md-6 col-sm-6 col-12">
                  <div class="box shadow-sm mb-3 rounded bg-white ads-box text-center">
                     <img src="img/job1.png" class="img-fluid" alt="Responsive image">
                     <div class="p-3 border-bottom">
                        <h6 class="font-weight-bold text-dark">Notifications</h6>
                        <p class="mb-0 text-muted">You’re all caught up! Check back later for new notifications
                        </p>
                     </div>
                     <div class="p-3">
                        <button type="button" class="btn btn-outline-primary pl-4 pr-4"> View settings </button>
                     </div>
                  </div>
                  <div class="box mb-3 shadow-sm border rounded bg-white profile-box text-center">
                     <div class="p-5">
                        <img src="img/clogo2.png" class="img-fluid" alt="Responsive image">
                     </div>
                     <div class="p-3 border-top border-bottom">
                        <h5 class="font-weight-bold text-dark mb-1 mt-0">Envato</h5>
                        <p class="mb-0 text-muted">Melbourne, AU
                        </p>
                     </div>
                     <div class="p-3">
                        <div class="d-flex align-items-top mb-2">
                           <p class="mb-0 text-muted">Posted</p>
                           <p class="font-weight-bold text-dark mb-0 mt-0 ml-auto">1 day ago</p>
                        </div>
                        <div class="d-flex align-items-top">
                           <p class="mb-0 text-muted">Applicant Rank</p>
                           <p class="font-weight-bold text-dark mb-0 mt-0 ml-auto">25</p>
                        </div>
                     </div>
                  </div>
               </aside>
               <aside class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-6 col-12">
					<?php include_once 'recent-jobs.php'; ?>
					<?php include_once 'people_you_may_know.php'; ?>
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
