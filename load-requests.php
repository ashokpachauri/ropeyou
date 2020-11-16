<?php
	include_once 'connection.php';
?>
<div class="p-3 user_section_requests">
	<div class="row">
	<?php
		$friends=array();
		$friends_query="SELECT * FROM user_joins_user WHERE user_id='".$_COOKIE['uid']."' AND status=4";
		$friends_result=mysqli_query($conn,$friends_query);
		if(mysqli_num_rows($friends_result)>0)
		{
			while($friends_row=mysqli_fetch_array($friends_result))
			{
				$friends[]=$friends_row['r_user_id'];
			}
		}
		
		$bridge_query="SELECT * FROM users WHERE id IN ('".implode("','",$friends)."')";
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
				$profile=getUserProfileImage($connect_user_id);
	?>
			 <div class="col-md-4" id="user_section_requests_<?php echo $connect_user_id; ?>">
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
							<button type="button" onclick="AcceptUser('<?php echo $connect_user_id; ?>');" class="btn btn-primary btn-sm btn-block"> Accept </button>
						 </div>
						 <div class="col-6 pr-3 pl-1">
							<button type="button" onclick="RejectUser('<?php echo $connect_user_id; ?>');" class="btn btn-outline-danger btn-sm btn-block"> Reject </button>
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
				<h5 style="text-align:center;">No more connect requests</h5>
			</div>
			<?php
		}
	?>
	</div>
</div>
<script>
	loadImage("user_section_requests");
</script>	
							
							