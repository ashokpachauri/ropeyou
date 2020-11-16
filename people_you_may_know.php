   <div class="box shadow-sm border rounded bg-white mb-3">
                     <div class="box-title border-bottom p-3">
                        <h6 class="m-0">People you might know</h6>
                     </div>
                     <div class="box-body p-3" style="max-height:400px;overflow:auto;">
						<?php
							$___friends=array();
							$___friends_query="SELECT * FROM user_joins_user WHERE user_id='".$_COOKIE['uid']."'  AND (status=1 OR status=4) ORDER BY rand() LIMIT 10";
							$___friends_result=mysqli_query($conn,$___friends_query);
							if(mysqli_num_rows($___friends_result)>0)
							{
								while($___friends_row=mysqli_fetch_array($___friends_result))
								{
									$___friends[]=$___friends_row['r_user_id'];
								}
							}
							$___friends_query="SELECT * FROM user_joins_user WHERE r_user_id='".$_COOKIE['uid']."' AND (status=1 OR status=4)";
							$___friends_result=mysqli_query($conn,$___friends_query);
							if(mysqli_num_rows($___friends_result)>0)
							{
								while($___friends_row=mysqli_fetch_array($___friends_result))
								{
									$___friends[]=$___friends_row['user_id'];
								}
							}
							$___friends[]=$_COOKIE['uid'];
							$___bridge_query="SELECT * FROM users WHERE id NOT IN ('".implode("','",$___friends)."')";
							$___bridge_result=mysqli_query($conn,$___bridge_query);
							$___bridge_num_rows=mysqli_num_rows($___bridge_result);
							if($___bridge_num_rows>0)
							{
								while($___bridge_row=mysqli_fetch_array($___bridge_result))
								{
									$_active_query="SELECT * FROM users_logs WHERE user_id='".$___bridge_row['id']."'";
									$_active_res=mysqli_query($conn,$_active_query);
									$_active_row=mysqli_fetch_array($_active_res);
									$_active_status="bg-success";
									if($_active_row['is_active']=="0")
									{
										$_active_status="bg-danger";
									}
									$___id=$___bridge_row['id'];
								?>
									<div class="d-flex align-items-center osahan-post-header mb-3 people-list" id="people_you_may_know_widget_<?php echo $___id; ?>">
									   <div class="dropdown-list-image mr-3">
										  <a href="<?php echo base_url; ?>u/<?php echo $___bridge_row['username']; ?>"><img class="rounded-circle" src="<?php echo getUserProfileImage($___bridge_row['id']); ?>" alt="<?php echo $___bridge_row['first_name']." ".$___bridge_row['last_name']; ?>">
										  <div class="status-indicator <?php echo $_active_status; ?>"></div></a>
									   </div>
									   <div class="font-weight-bold mr-2">
										  <div class="text-truncate"> <a href="<?php echo base_url; ?>u/<?php echo $___bridge_row['username']; ?>"><?php echo $___bridge_row['first_name']." ".$___bridge_row['last_name']; ?></a></div>
										  <div class="small text-gray-500 text-truncate"><?php echo $___bridge_row['profile_title']; ?>
										  </div>
									   </div>
									   <span class="ml-auto"><button type="button" onclick="sendConnectRequest('<?php echo $___id; ?>');" class="btn btn-outline-primary btn-sm">Connect</button>
									   </span>
									</div>
									<?php
								}
							}
						?>
                     </div>
                  </div>
				  <script>
					var base_url="<?php echo base_url; ?>";
					var r_user_id="<?php echo $_COOKIE['uid']; ?>";
					function sendConnectRequest(connection_user_id)
					{
						if(connection_user_id!="")
						{
							$.ajax({
								url:base_url+'connection-action',
								type:"post",
								data:{connection_user_id:connection_user_id,method:"connect"},
								success:function(response)
								{
									var parsed_json=JSON.parse(response);
									if(parsed_json.status=="success")
									{
										$("#people_you_may_know_widget_"+connection_user_id).remove();
										//alert(parsed_json.message);
									}
									else
									{
										alert(parsed_json.message);
									}
								}
							});
						}
					}
				  </script>
               