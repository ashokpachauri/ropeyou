<!DOCTYPE html>
<html lang="en">
   <head>
		<?php include_once 'head.php'; ?>
		<?php
			if(isset($_POST['save_contact']))
			{
				$contact_type=$_POST['contact_type'];
				$contact=$_POST['contact'];
				$contact_name=$_POST['contact_name'];
				$check_query="SELECT id FROM users_contact WHERE contact_type='$contact_type' AND contact='$contact' AND contact_name='$contact_name'";
				$check_result=mysqli_query($conn,$check_query);
				if(mysqli_num_rows($check_result)>0)
				{
					?>
					<script>
						alert('contact already exists.');
					</script>
					<?php
				}
				else
				{
					$user_id=$_COOKIE['uid'];
					$insert_query="INSERT INTO users_contact SET contact_type='$contact_type',contact='$contact',contact_name='$contact_name',status=1,user_id='$user_id'";
					if(mysqli_query($conn,$insert_query))
					{
						?>
						<script>
							alert('contact saved successfully.');
						</script>
						<?php
					}
					else{
						?>
						<script>
							alert('Some server error.Please contact developer.');
						</script>
						<?php
					}
				}
			}
		?>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap.min.css">
		<title>Bridge | RopeYou Connects</title>
	</head>
	<body>
		<style>
			.overlap-rounded-circle>.rounded-circle{
				width:25px;
				height:25px;
			}
			.network-item-body{
				min-height: 39px;
				max-height: 40px;
			}
		</style>
		<?php include_once 'header.php'; ?>
		<div class="py-4">
			<div class="container">
				<div class="row">
				   <main class="col col-xl-9 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
					  <div class="box shadow-sm border rounded bg-white mb-3 osahan-share-post">
						 <h5 class="pl-3 pt-3 pr-3 border-bottom mb-0 pb-3">More suggestions for you</h5>
						 <ul class="nav border-bottom osahan-line-tab" id="myTab" role="tablist">
							<li class="nav-item" onclick="LoadData('home');">
							   <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Peoples you may know</a>
							</li>
							<li class="nav-item" onclick="LoadData('requests');">
							   <a class="nav-link" id="requests-tab" data-toggle="tab" href="#requests" role="tab" aria-controls="requests" aria-selected="false">Requests</a>
							</li>
							<li class="nav-item" onclick="LoadData('bridge');" id="bridge_tab">
							   <a class="nav-link" id="bridge-tab" data-toggle="tab" href="#bridge" role="tab" aria-controls="bridge" aria-selected="false">My Bridge</a>
							</li>
							<li class="nav-item" onclick="LoadData('nearby');">
							   <a class="nav-link" id="nearby-tab" data-toggle="tab" href="#nearby" role="tab" aria-controls="nearby" aria-selected="false">Nearby People</a>
							</li>
						 </ul>
						 <div class="tab-content" id="myTabContent">
							<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
								<div class="p-3">
									<div class="row">
									<?php
										$friends=array();
										$friends_query="SELECT * FROM user_joins_user WHERE user_id='".$_COOKIE['uid']."'  AND (status=1 OR status=4)";
										$friends_result=mysqli_query($conn,$friends_query);
										if(mysqli_num_rows($friends_result)>0)
										{
											while($friends_row=mysqli_fetch_array($friends_result))
											{
												$friends[]=$friends_row['r_user_id'];
											}
										}
										$friends_query="SELECT * FROM user_joins_user WHERE r_user_id='".$_COOKIE['uid']."' AND (status=1 OR status=4)";
										$friends_result=mysqli_query($conn,$friends_query);
										if(mysqli_num_rows($friends_result)>0)
										{
											while($friends_row=mysqli_fetch_array($friends_result))
											{
												$friends[]=$friends_row['user_id'];
											}
										}
										$friends[]=$_COOKIE['uid'];
										$bridge_query="SELECT * FROM users WHERE id NOT IN ('".implode("','",$friends)."')";
										$bridge_result=mysqli_query($conn,$bridge_query);
										$bridge_num_rows=mysqli_num_rows($bridge_result);
										if($bridge_num_rows>0)
										{
											while($bridge_row=mysqli_fetch_array($bridge_result))
											{
												$connect_user_id=$bridge_row['id'];
												$bridge_personal_query="SELECT * FROM users_personal WHERE user_id='".$bridge_row['id']."'";
												$bridge_personal_result=mysqli_query($conn,$bridge_personal_query);
												if(mysqli_num_rows($bridge_personal_result))
												{
													$bridge_personal_row=mysqli_fetch_array($bridge_personal_result);
												}
												$profile=getUserProfileImage($bridge_row['id']);
									?>
												 <div class="col-md-4" id="user_section_home_<?php echo $connect_user_id; ?>">
													<b href="profile">
													   <div class="border network-list network-item rounded mb-3">
														  <div class="p-3 text-center">
															 <div class="mb-3">
																<img class="rounded-circle" src="<?php echo $profile; ?>" alt="" style="border:1px solid #eaebec !important;">
															 </div>
															 <div class="font-weight-bold">
																<h6 class="font-weight-bold text-dark mb-0"><a href="<?php echo base_url; ?>u/<?php echo $bridge_row['username']; ?>" style="text-decoration:none;"><?php echo ucfirst($bridge_row['first_name']." ".$bridge_row['last_name']); ?></a></h6>
																<div class="small text-black-50"><?php echo $bridge_row['profile_title']; if($bridge_row['profile_title']==""){ echo "<br/>"; } ?></div>
															 </div>
														  </div>
														  <?php
															$mutual_connections_count=0;
															$m1_query="SELECT * FROM user_joins_user WHERE ((user_id=".$_COOKIE['uid']." AND r_user_id!=".$bridge_row['id'].") OR (r_user_id=".$_COOKIE['uid']." AND user_id!=".$bridge_row['id'].")) AND status=1 AND blocked=0";
															$m1_result=mysqli_query($conn,$m1_query);
															$num_rows=mysqli_num_rows($m1_result);
															$users_connection_1=array();
															$users_connection_2=array();
															if($num_rows>0)
															{
																$m2_query="SELECT * FROM user_joins_user WHERE ((user_id=".$bridge_row['id']." AND r_user_id!=".$_COOKIE['uid'].") OR (r_user_id=".$bridge_row['id']." AND user_id!=".$_COOKIE['uid'].")) AND status=1 AND blocked=0";
																$m2_result=mysqli_query($conn,$m2_query);
																//echo $m1_query;
																//echo $m2_query;
																$num_rows=mysqli_num_rows($m2_result);
																if($num_rows>0)
																{
																	while($m1_row=mysqli_fetch_array($m1_result))
																	{
																		if($m1_row['user_id']==$_COOKIE['uid'])
																		{
																			$users_connection_1[]=$m1_row['r_user_id'];
																		}
																		else{
																			$users_connection_1[]=$m1_row['user_id'];
																		}
																	}
																	while($m2_row=mysqli_fetch_array($m2_result))
																	{
																		if($m2_row['user_id']==$bridge_row['id'])
																		{
																			$users_connection_2[]=$m2_row['r_user_id'];
																		}
																		else{
																			$users_connection_2[]=$m2_row['user_id'];
																		}
																	}
																	$intersect_1=array_intersect($users_connection_1, $users_connection_2);
																	$mutual_connections_count=count($intersect_1);
																}
															}
														  ?>
														  <div class="d-flex align-items-center p-3 border-top border-bottom network-item-body">
															<?php
															$counter=0;
																if($mutual_connections_count>0)
																{
															?>
																	<div class="overlap-rounded-circle">
																		<?php
																			for($loopvar=0;$loopvar<count($users_connection_1);$loopvar++)
																			{
																				$m_user_id=$intersect_1[$loopvar];
																				if($m_user_id!="")
																				{
																					$counter=$counter+1;
																					$m_u_profile=getUserProfileImage($m_user_id);
																					$m_u_query="SELECT * FROM users WHERE id='".$m_user_id."'";
																					$m_u_result=mysqli_query($conn,$m_u_query);
																					$m_u_row=mysqli_fetch_array($m_u_result);
																					?>
																						<img class="rounded-circle shadow-sm" style="border:1px solid #eaebec !important;" data-toggle="tooltip" data-sm="<?php echo $m_user_id; ?>" data-placement="top" title="<?php echo $m_u_row['first_name']." ".$m_u_row['last_name']; ?>" src="<?php echo $m_u_profile; ?>" alt="<?php echo $m_u_row['first_name']." ".$m_u_row['last_name']; ?>">
																					<?php
																				}
																			}
																		?>
																	</div>
															<?php
																}
															?>
															 <span class="font-weight-bold small text-primary"><?php echo $counter; ?> mutual connections</span>
														  </div>
															<?php
																$connect_query="SELECT * FROM user_joins_user WHERE (user_id='".$_COOKIE['uid']."' AND r_user_id='".$bridge_row['id']."') OR (r_user_id='".$_COOKIE['uid']."' AND user_id='".$bridge_row['id']."')";
																$connect_result=mysqli_query($conn,$connect_query);
																$num_rows=mysqli_num_rows($connect_result);
																$text="Connect";
																$follow="Follow";
																if($num_rows>0)
																{
																	$connect_row=mysqli_fetch_array($connect_result);
																	if($connect_row['status']==1)
																	{
																		$text="Disconnect";
																		$follow="Following";
																	}
																	else if($connect_row['status']==4)
																	{
																		$text="Requested";
																		$follow="Following";
																	}
																	else 
																	{
																		$text="Connect";
																		$follow="Follow";
																	}
																}
																
															?>
														  <div class="network-item-footer py-3 d-flex text-center">
															 <div class="col-6 pl-3 pr-1">
																<button type="button" onclick="ConnectUser('<?php echo $connect_user_id; ?>');" class="btn btn-primary btn-sm btn-block"> <?php echo $text; ?> </button>
															 </div>
															 <div class="col-6 pr-3 pl-1">
																<button type="button" onclick="FollowUser('<?php echo $connect_user_id; ?>');" class="btn btn-outline-primary btn-sm btn-block"> <i class="feather-user-plus"></i> <?php echo $follow; ?> </button>
															 </div>
														  </div>
													   </div>
													</b>
												 </div>
										
										<?php
											}
										}
										else
										{
											?>
											<div class="col-md-12">
												<h5 style="text-align:center;">No more profiles to show</h5>
											</div>
											<?php
										}
									?>
									</div>
							   </div>
							</div>
							<div class="tab-pane fade" id="requests" role="tabpanel" aria-labelledby="requests-tab">
								
							</div>
							<div class="tab-pane fade" id="bridge" role="tabpanel" aria-labelledby="bridge-tab">
							</div>
							<div class="tab-pane fade" id="nearby" role="tabpanel" aria-labelledby="nearby-tab">
								
							</div>
						</div>
					  </div>
				   </main>
				   <aside class="col col-xl-3 order-xl-2 col-lg-12 order-lg-2 col-12">
					  <div class="box mb-3 shadow-sm border rounded bg-white list-sidebar">
						 <div class="box-title p-3">
							<h6 class="m-0">Manage my Bridge</h6>
						 </div>
							<?php
								$myConnections=getUserConnectionCounts($_COOKIE['uid']);
								$peopleIFollow=getUserFollowingCounts($_COOKIE['uid']);
								$requested=0;
								$user_id=$_COOKIE['uid'];
								$requested_query="SELECT user_id FROM user_joins_user WHERE r_user_id='$user_id' AND status=4";
								$requested_result=mysqli_query($conn,$requested_query);
								$requested=mysqli_num_rows($requested_result);
								
								$contacts_query="SELECT * FROM users_contact WHERE user_id='$user_id' AND status=1 ORDER BY id ASC";
								$contacts_result=mysqli_query($conn,$contacts_query);
							?>
						 <ul class="list-group list-group-flush">
							<a href="javascript:void(0);" onclick="$('#bridge-tab').click();">
							   <li class="list-group-item pl-3 pr-3 d-flex align-items-center text-dark"><i class="feather-users mr-2 text-dark"></i> Connections <span class="ml-auto font-weight-bold"><?php echo $myConnections; ?></span></li>
							</a>
							<a href="javascript:void(0);" onclick="requested_user_data_hub();">
							   <li class="list-group-item pl-3 pr-3 d-flex align-items-center text-dark"><i class="feather-book mr-2 text-dark"></i> Requested <span class="ml-auto font-weight-bold"><?php echo $requested; ?></span></li>
							</a>
							<a href="javascript:void(0);" onclick="users_contacts_data_hub();">
							   <li class="list-group-item pl-3 pr-3 d-flex align-items-center text-dark"><i class="feather-book mr-2 text-dark"></i> Contacts <span class="ml-auto font-weight-bold"><?php echo mysqli_num_rows($contacts_result); ?></span></li>
							</a>
							<a href="javascript:void(0);" data-toggle="modal" data-target='#add_contact'>
							   <li class="list-group-item pl-3 pr-3 d-flex align-items-center text-dark"><i class="feather-plus mr-2 text-dark"></i> Add Contact</li>
							</a>
							<a href="javascript:void(0);" onclick="followed_users_data_hub()">
							   <li class="list-group-item pl-3 pr-3 d-flex align-items-center text-dark"><i class="feather-user-check mr-2 text-dark"></i> People I Follow <span class="ml-auto font-weight-bold"><?php echo $peopleIFollow; ?></span></li>
							</a>
						 </ul>
					  </div>
					  <?php
						$profile=getUserProfileImage($_COOKIE['uid']);
					  ?>
					  <div class="box shadow-sm mb-3 border rounded bg-white ads-box text-center">
						 <div class="image-overlap-2 pt-4">
							<img src="<?php echo $profile; ?>" class="img-fluid rounded-circle shadow-sm" alt="Responsive image">
							<img src="img/jobs.jpg" class="img-fluid rounded-circle shadow-sm" alt="Responsive image">
						 </div>
						 <div class="p-3 border-bottom">
							<h6 class="text-dark"><?php echo $user_row['first_name']." ".$user_row['last_name'] ?>, grow your career by following <span class="font-weight-bold"> RopeYou</span></h6>
							<p class="mb-0 text-muted">Stay up-to industry trends!</p>
						 </div>
						 <div class="p-3">
							<button type="button" class="btn btn-outline-primary btn-sm pl-4 pr-4"> FOLLOW </button>
						 </div>
					  </div>
					</aside>
				</div>
			</div>
		</div>
		<div class="modal fade requested_users" id="requested_users" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="requested_users_backdrop" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h6 class="modal-title" id="requested_users_backdrop">Peoples you have requested to join</h6>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body requested_user_data_hub">											
						<div class="d-flex" style="width:100%;">
							<div class="row" id="requested_user_data_hub">
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade followed_users" id="followed_users" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="followed_users_backdrop" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h6 class="modal-title" id="followed_users_backdrop">Peoples you are following</h6>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body followed_users_data_hub">											
						<div class="d-flex" style="width:100%;">
							<div class="row" id="followed_users_data_hub">
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade users_contacts" id="users_contacts" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="users_contacts_backdrop" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h6 class="modal-title" id="users_contacts_backdrop">Your Contacts</h6>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body users_contacts_data_hub">											
						<div class="row" id="users_contacts_data_hub">
								
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade add_contact" id="add_contact" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="add_contact_backdrop" aria-hidden="true">
			<div class="modal-dialog modal-md" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h6 class="modal-title" id="add_contact_backdrop">Add Contact</h6>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body add_contact_modal_body">											
						<form action="" method="post">
							<div class="row" id="add_contact_modal_body">
								<div class="col-12">
									<h6>Contact Type</h6>
									<select id="contact_type" name="contact_type" class="form-control" required>
										<option value="">Select Contact Type</option>
										<option value="email">Email</option>
										<option value="mobile">Mobile</option>
										<option value="skype">Skype</option>
										<option value="hangout">Hangout</option>
										<option value="whatsapp">Whatsapp</option>
										<option value="website">Website</option>
										<option value="facebook">Facebook</option>
										<option value="instagram">Instagram</option>
										<option value="twitter">Twitter</option>
										<option value="linkedin">Linkedin</option>
										<option value="blog">Blog</option>
									</select>
								</div>
								<div class="col-12" style="margin-top:15px;">
									<h6>Name</h6>
									<input type="text" id="contact_name" name="contact_name" class="form-control" placeholder="Name of contact" required>
								</div>
								<div class="col-12" style="margin-top:15px;">
									<h6>Contact</h6>
									<input type="text" id="contact" name="contact" class="form-control" placeholder="Contact" required>
								</div>
								<div class="col-12" style="margin-top:15px;">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>&nbsp;&nbsp;
									<button type="submit" class="btn btn-primary" name="save_contact">Save</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<?php include_once 'scripts.php';  ?>
		<script>
			var user_id="<?php echo $_COOKIE['uid']; ?>";
			var base_url="<?php echo base_url; ?>";
			function users_contacts_data_hub()
			{
				$.ajax({
					url:base_url+'users-contacts',
					type:"post",
					success:function(response)
					{
						var parsed_json=JSON.parse(response);
						if(parsed_json.status=="success")
						{
							$("#users_contacts_data_hub").html(parsed_json.data);
							$("#users_contacts").modal("show");
						}
						else if(parsed_json.status=="timeout")
						{
							alert("session has been timeout.");
							window.location.href=base_url+"logout";
						}
					}
				});
			}
			function followed_users_data_hub()
			{
				$.ajax({
					url:base_url+'followed-users',
					type:"post",
					success:function(response)
					{
						var parsed_json=JSON.parse(response);
						if(parsed_json.status=="success")
						{
							$("#followed_users_data_hub").html(parsed_json.data);
							$("#followed_users").modal("show");
						}
						else if(parsed_json.status=="timeout")
						{
							alert("session has been timeout.");
							window.location.href=base_url+"logout";
						}
					}
				});
			}
			function requested_user_data_hub()
			{
				$.ajax({
					url:base_url+'requested-users',
					type:"post",
					success:function(response)
					{
						var parsed_json=JSON.parse(response);
						if(parsed_json.status=="success")
						{
							$("#requested_user_data_hub").html(parsed_json.data);
							$("#requested_users").modal("show");
						}
						else if(parsed_json.status=="timeout")
						{
							alert("session has been timeout.");
							window.location.href=base_url+"logout";
						}
					}
				});
			}
			function ConnectUser(connection_user_id)
			{
				if(connection_user_id!='')
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
								$("#user_section_home_"+connection_user_id).remove();
								//alert(parsed_json.message);
							}
							else
							{
								alert(parsed_json.message);
							}
						}
					});
				}
				else
				{
					alert('invalid action.');
				}
			}
			function DisConnectUser(connection_user_id)
			{
				if(connection_user_id!='')
				{
					$.ajax({
						url:base_url+'connection-action',
						type:"post",
						data:{connection_user_id:connection_user_id,method:"disconnect"},
						success:function(response)
						{
							var parsed_json=JSON.parse(response);
							if(parsed_json.status=="success")
							{
								$("#user_section_bridge_"+connection_user_id).remove();
								//alert(parsed_json.message);
							}
							else
							{
								alert(parsed_json.message);
							}
						}
					});
				}
				else
				{
					alert('invalid action.');
				}
			}
			function RejectUser(connection_user_id)
			{
				if(connection_user_id!='')
				{
					$.ajax({
						url:base_url+'connection-action',
						type:"post",
						data:{connection_user_id:connection_user_id,method:"reject"},
						success:function(response)
						{
							var parsed_json=JSON.parse(response);
							if(parsed_json.status=="success")
							{
								$("#user_section_requests_"+connection_user_id).remove();
								//alert(parsed_json.message);
							}
							else
							{
								alert(parsed_json.message);
							}
						}
					});
				}
				else
				{
					alert('invalid action.');
				}
			}
			function CancelUser(connection_user_id)
			{
				if(connection_user_id!='')
				{
					$.ajax({
						url:base_url+'connection-action',
						type:"post",
						data:{connection_user_id:connection_user_id,method:"cancel"},
						success:function(response)
						{
							var parsed_json=JSON.parse(response);
							if(parsed_json.status=="success")
							{
								$("#user_section_requested_"+connection_user_id).remove();
								//alert(parsed_json.message);
							}
							else
							{
								alert(parsed_json.message);
							}
						}
					});
				}
				else
				{
					alert('invalid action.');
				}
			}
			function AcceptUser(connection_user_id)
			{
				if(connection_user_id!='')
				{
					$.ajax({
						url:base_url+'connection-action',
						type:"post",
						data:{connection_user_id:connection_user_id,method:"accept"},
						success:function(response)
						{
							var parsed_json=JSON.parse(response);
							if(parsed_json.status=="success")
							{
								$("#user_section_requests_"+connection_user_id).remove();
								//alert(parsed_json.message);
							}
							else
							{
								alert(parsed_json.message);
							}
						}
					});
				}
				else
				{
					alert('invalid action.');
				}
			}
			function LoadData(data_section)
			{
				$("#"+data_section).load(base_url+"load-"+data_section);
			}
			function loadImage(div)
			{
				$("."+div+" img").css("cursor","pointer");
				$("."+div+" img").click(function(){
					$("#backdrop_image_to_show").attr("src",$(this).attr("src"));
					$("#image_backdrop_modal").modal('show');
				});
			}
			loadImage("py-4");
		</script>
		<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
	</body>
</html>
