<style>
/*.container, .container-lg, .container-md, .container-sm, .container-xl {
    max-width: 1240px !important;
}*/
</style>
<nav class="navbar navbar-expand navbar-dark bg-dark osahan-nav-top p-0">
	<input type="hidden" name="base_url" id="base_url" value="<?php echo $base_url; ?>">
	<div class="container">
		<a class="navbar-brand mr-2 d-none d-lg-inline" href="<?php if($_COOKIE['uid']!=""){ echo base_url.'dashboard'; } else{ echo base_url; } ?>"><img src="<?php echo base_url; ?>img/logo.png" alt="">
		</a>
		
		<?php
			if(isset($_COOKIE['uid']) && $_COOKIE['uid']!="")
			{
				?>
				<form class="d-none d-sm-inline-block form-inline mr-auto my-2 my-md-0 mw-100 navbar-search" style="margin-left:20px;">
				   <div class="input-group">
					  <input type="text" class="form-control shadow-none border-0" placeholder="Search people, jobs & more..." aria-label="Search" aria-describedby="basic-addon2">
					  <div class="input-group-append">
						 <button class="btn" type="button">
						 <i class="feather-search"></i>
						 </button>
					  </div>
				   </div>
				</form>
				<ul class="navbar-nav ml-auto d-flex align-items-center">
				   <!-- Nav Item - Search Dropdown (Visible Only XS) -->
				   <li class="nav-item dropdown no-arrow d-sm-none">
					  <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					  <i class="feather-search mr-2"></i>
					  </a>
					  <!-- Dropdown - Messages -->
					  <div class="dropdown-menu dropdown-menu-right p-3 shadow-sm animated--grow-in" aria-labelledby="searchDropdown">
						 <form class="form-inline mr-auto w-100 navbar-search">
							<div class="input-group">
							   <input type="text" class="form-control border-0 shadow-none" placeholder="Search people, jobs and more..." aria-label="Search" aria-describedby="basic-addon2">
							   <div class="input-group-append">
								  <button class="btn" type="button">
								  <i class="feather-search"></i>
								  </button>
							   </div>
							</div>
						 </form>
					  </div>
				   </li>
				   <li class="nav-item">
					  <a class="nav-link" href="<?php echo base_url; ?>dashboard"><i class="feather-clipboard mr-2"></i><span class="d-none d-lg-inline">Dashboard</span></a>
				   </li>
				   <li class="nav-item">
					  <a class="nav-link" href="<?php echo base_url; ?>broadcasts"><i class="feather-compass mr-2"></i><span class="d-none d-lg-inline">Broadcasts</span></a>
				   </li>
				   <li class="nav-item">
					  <a class="nav-link" href="<?php echo base_url; ?>bridge"><i class="feather-users mr-2"></i><span class="d-none d-lg-inline">My Bridge</span></a>
				   </li>
				   <li class="nav-item">
					  <a class="nav-link" href="<?php echo base_url; ?>jobs"><i class="feather-briefcase mr-2"></i><span class="d-none d-lg-inline">Jobs</span></a>
				   </li>
				   <li class="nav-item">
					  <a class="nav-link" href="<?php echo blog_base_url; ?>"><i class="feather-tablet mr-2"></i><span class="d-none d-lg-inline">Blogger</span></a>
				   </li>
				   <!--
				   <li class="nav-item dropdown mr-2">
					  <a class="nav-link dropdown-toggle pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					  <i class="feather-file-text mr-2"></i><span class="d-none d-lg-inline">Pages</span>
					  </a>
					  <div class="dropdown-menu dropdown-menu-right shadow-sm">
						 <a class="dropdown-item" href="jobs.html"><i class="feather-briefcase mr-1"></i> Jobs</a>
						 <a class="dropdown-item" href="profile.html"><i class="feather-user mr-1"></i> Profile</a>
						 <a class="dropdown-item" href="connection.html"><i class="feather-users mr-1"></i> Connection</a>
						 <a class="dropdown-item" href="company-profile.html"><i class="feather-user-plus mr-1"></i> Company Profile</a>
						 <a class="dropdown-item" href="job-profile.html"><i class="feather-globe mr-1"></i> Job Profile</a>
						 <a class="dropdown-item" href="messages.html"><i class="feather-message-circle mr-1"></i> Messages</a>
						 <a class="dropdown-item" href="notifications.html"><i class="feather-bell mr-1"></i> Notifications</a>
						 <a class="dropdown-item" href="not-found.html"><i class="feather-alert-triangle mr-1"></i> 404 Not Found</a>
						 <a class="dropdown-item" href="faq.html"><i class="feather-help-circle mr-1"></i> FAQ</a>
						 <a class="dropdown-item" href="terms.html"><i class="feather-book mr-1"></i> Terms</a>
						 <a class="dropdown-item" href="privacy.html"><i class="feather-list mr-1"></i> Privacy</a>
						 <a class="dropdown-item" href="contact.html"><i class="feather-mail mr-1"></i> Contact</a>
						 <a class="dropdown-item" href="pricing.html"><i class="feather-credit-card mr-1"></i> Pricing</a>
						 <a class="dropdown-item" href="maintence.html"><i class="feather-clock mr-1"></i> Maintence</a>
						 <a class="dropdown-item" href="coming-soon.html"><i class="feather-cloud mr-1"></i> Coming Soon</a>
						 <a class="dropdown-item" href="components.html"><i class="feather-list mr-1"></i> Components</a>
						 <a class="dropdown-item" href="sign-in.html"><i class="feather-log-in mr-1"></i> Sign In</a>
						 <a class="dropdown-item" href="sign-up.html"><i class="feather-lock mr-1"></i> Sign Up</a>
					  </div>
				   </li>
				   -->
					<?php
						$user_id=$_COOKIE['uid'];
						$data_count=0;
						$chat_query="SELECT DISTINCT(user_id),added FROM users_chat WHERE r_user_id='$user_id' AND status=1 AND flag!=2 AND s_status!=0 ORDER BY added DESC";
						$chat_result=mysqli_query($conn,$chat_query);
						$chat_num_rows=mysqli_num_rows($chat_result);
						$data=array();
						if($chat_num_rows>0)
						{
							$friends=array();
							while($chat_row=mysqli_fetch_array($chat_result))
							{
								$friend=$chat_row['user_id'];
								if(!(in_array($friend,$friends)))
								{
									$friends[]=$friend;
									$data_count=$data_count+1;
								}
							}
						}
					?>
				   <li class="nav-item dropdown no-arrow mx-1 osahan-list-dropdown">
					  <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						 <i class="feather-message-square"></i>
						 <!-- Counter - Alerts -->
						 <span class="badge badge-danger badge-counter" id="messages_counter"><?php echo $data_count; ?></span>
						 <div id="sound"></div>
					  </a>
					  <!-- Dropdown - Alerts -->
						<div class="dropdown-list dropdown-menu dropdown-menu-right shadow-sm">
							<h6 class="dropdown-header">
								New Messages
								<input type="hidden" name="unread_messages_count" id="unread_messages_count" value="<?php echo $chat_num_rows; ?>">
							</h6>	
							<div id="new_messages_data">
								<a class="dropdown-item text-center small text-gray-500" href="javascript:void(0);">Loading new messages...</a>
							</div>
							<a class="dropdown-item text-center small text-gray-500" href="<?php echo base_url; ?>messenger">Message Center</a>
					  </div>
				   </li>
				   <li class="nav-item dropdown no-arrow mx-1 osahan-list-dropdown">
					  <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						 <i class="feather-bell"></i>
						 <!-- Counter - Alerts -->
						 <span class="badge badge-info badge-counter">6</span>
					  </a>
					  <!-- Dropdown - Alerts -->
					  <div class="dropdown-list dropdown-menu dropdown-menu-right shadow-sm">
						 <h6 class="dropdown-header">
							Alerts Center
						 </h6>
						 <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url; ?>notifications">
							<div class="mr-3">
							   <div class="icon-circle bg-primary">
								  <i class="feather-download-cloud text-white"></i>
							   </div>
							</div>
							<div>
							   <div class="small text-gray-500">December 12, 2019</div>
							   <span class="font-weight-bold">A new monthly report is ready to download!</span>
							</div>
						 </a>
						 <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url; ?>notifications">
							<div class="mr-3">
							   <div class="icon-circle bg-success">
								  <i class="feather-edit text-white"></i>
							   </div>
							</div>
							<div>
							   <div class="small text-gray-500">December 7, 2019</div>
							   $290.29 has been deposited into your account!
							</div>
						 </a>
						 <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url; ?>notifications">
							<div class="mr-3">
							   <div class="icon-circle bg-warning">
								  <i class="feather-folder text-white"></i>
							   </div>
							</div>
							<div>
							   <div class="small text-gray-500">December 2, 2019</div>
							   Spending Alert: We've noticed unusually high spending for your account.
							</div>
						 </a>
						 <a class="dropdown-item text-center small text-gray-500" href="<?php echo base_url; ?>notifications">Show All Alerts</a>
					  </div>
				   </li>
				   <!-- Nav Item - User Information -->
					<?php
						$profile=getUserProfileImage($_COOKIE['uid']);
						$user_query="SELECT * FROM users WHERE id='".$_COOKIE['uid']."'";
						$user_result=mysqli_query($conn,$user_query);
						$user_row=mysqli_fetch_array($user_result);
				   ?>
				   <li class="nav-item dropdown no-arrow ml-1 osahan-profile-dropdown">
					  <a class="nav-link dropdown-toggle pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					  <img class="img-profile rounded-circle" src="<?php echo $profile; ?>" style="border:1px solid #fff !important;">
					  </a>
					  <!-- Dropdown - User Information -->
					  <div class="dropdown-menu dropdown-menu-right shadow-sm">
						 <div class="p-3 d-flex align-items-center">
							<div class="dropdown-list-image mr-3">
							   <img class="rounded-circle" src="<?php echo $profile; ?>" alt="" style="border:1px solid #eaebec !important;">
							   <div class="status-indicator bg-success"></div>
							</div>
							<div class="font-weight-bold">
							   <div class="text-truncate"><?php echo $user_row['first_name']." ".$user_row['last_name']; ?></div>
							   <div class="small text-gray-500"><?php echo $user_row['profile_title']; ?></div>
							</div>
						 </div>
						 <div class="dropdown-divider"></div>
						 <a class="dropdown-item" target="_blank" href="<?php echo base_url; ?>w/<?php echo $user_row['username']; ?>"><i class="feather-globe mr-1"></i> My Web Page</a>
						 <a class="dropdown-item" target="_blank" href="<?php echo base_url; ?>post-job"><i class="feather-edit mr-1"></i> Post a Job</a>
						 <a class="dropdown-item" href="<?php echo base_url; ?>settings"><i class="feather-user mr-1"></i> Edit Profile</a>
						 <a class="dropdown-item" href="<?php echo base_url; ?>pages"><i class="feather-aperture mr-1"></i> Pages</a>
						 <div class="dropdown-divider"></div>
						 <a class="dropdown-item" href="<?php echo base_url; ?>logout"><i class="feather-log-out mr-1"></i> Logout</a>
					  </div>
				   </li>
				</ul>
				<?php
			}
			else{
				?>
				<ul class="navbar-nav ml-auto d-flex align-items-center">
				   <li class="nav-item dropdown no-arrow d-sm-none">
					  <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					  <i class="feather-search mr-2"></i>
					  </a>
					  <!-- Dropdown - Messages -->
					  <div class="dropdown-menu dropdown-menu-right p-3 shadow-sm animated--grow-in" aria-labelledby="searchDropdown">
						 <form class="form-inline mr-auto w-100 navbar-search">
							<div class="input-group">
							   <input type="text" class="form-control border-0 shadow-none" placeholder="Search people, jobs and more..." aria-label="Search" aria-describedby="basic-addon2">
							   <div class="input-group-append">
								  <button class="btn" type="button">
								  <i class="feather-search"></i>
								  </button>
							   </div>
							</div>
						 </form>
					  </div>
				   </li>
				   <li class="nav-item">
					  <a class="nav-link" href="<?php echo base_url; ?>logout"><i class="feather-log-in mr-2"></i><span class="d-none d-lg-inline">Login</span></a>
				   </li>
				<?php
			}
		?>
	</div>
</nav>      
<div class="modal fade image_backdrop_modal" id="image_backdrop_modal" style="z-index:99999;" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="image_backdrop" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title" id="image_backdrop">&nbsp;</h6>
				<button type="button" class="close" onclick="$('#image_backdrop_modal').modal('hide');">&times;</button>
			</div>
			<div class="modal-body">											
				<div class="d-flex" style="width:100%;">
					<img class="form-control" id="backdrop_image_to_show" src="" style="width:100%;min-height:300px;max-height:310px;">
				</div>
			</div>
		</div>
	</div>
</div>
							