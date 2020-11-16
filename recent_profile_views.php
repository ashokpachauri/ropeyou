<div class="box shadow-sm border rounded bg-white mb-3">
						 <div class="box-title border-bottom p-3">
							<h6 class="m-0">Recent profile views <a href='<?php echo base_url; ?>profile-views' class="pull-right">view all</a></h6>
						 </div>
						 <div class="box-body p-3">
							<?php
								$profile_views_query="SELECT * FROM users_profile_views where user_id='".$_COOKIE['uid']."' ORDER BY id DESC LIMIT 5";
								$profile_views_results=mysqli_query($conn,$profile_views_query);
								if(mysqli_num_rows($profile_views_results)>0)
								{
									while($profile_views_row=mysqli_fetch_array($profile_views_results))
									{
										$viewer_id=$profile_views_row['viewer_id'];
										$users_personal_data=getUsersPersonalData($viewer_id);
										$users_data=getUsersData($viewer_id);
										$active_query="SELECT * FROM users_logs WHERE user_id='$viewer_id'";
										$active_res=mysqli_query($conn,$active_query);
										$active_row=mysqli_fetch_array($active_res);
										$active_status="bg-success";
										if($active_row['is_active']=="0")
										{
											$active_status="bg-danger";
										}
										?>
										<div class="d-flex align-items-center osahan-post-header mb-3 people-list">
										   <div class="dropdown-list-image mr-3">
											 <a href="<?php echo base_url; ?>u/<?php echo $users_data['username']; ?>"><img class="rounded-circle" src="<?php echo getUserProfileImage($viewer_id); ?>" alt="<?php echo $users_data['first_name']; ?>">
											  <div class="status-indicator <?php echo $active_status; ?>"></div></a>
										   </div>
										   <div class="font-weight-bold mr-2">
											  <div class="text-truncate"><a href="<?php echo base_url; ?>u/<?php echo $users_data['username']; ?>"><?php echo $users_data['first_name']." ".$users_data['last_name']; ?></a></div>
											  <div class="small text-gray-500"><?php echo substr($users_data['profile_title'],0,50); ?></div>
										   </div>
										   <span class="ml-auto"><button type="button" class="btn btn-outline-primary btn-sm">Connect</button></span>
										</div></a>
										<?php
									}
								}
							?>
							
						 </div>
					  </div>