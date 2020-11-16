<?php
	include_once 'connection.php';
	$response=array();
	if(isset($_COOKIE['uid']) && $_COOKIE['uid']!="")
	{
		$user_id=$_COOKIE['uid'];
		$response['status']="success";
		$requested_query="SELECT * FROM user_joins_user WHERE (user_id='".$user_id."' OR r_user_id='".$user_id."') AND (status=1 OR status=4) AND blocked=0";
		$requested_result=mysqli_query($conn,$requested_query);
		$requested=mysqli_num_rows($requested_result);
		if($requested<=0)
		{
			$data="<h5 style='text-align:center;'>You have no pending requests.</h5>";
		}
		else
		{
			$data="";
			while($requested_row=mysqli_fetch_array($requested_result))
			{
				$connect_user_id=$requested_row['user_id'];
				if($requested_row['user_id']==$user_id)
				{
					$connect_user_id=$requested_row['r_user_id'];
				}
				$user_query="SELECT * FROM users WHERE id='$connect_user_id'";
				$user_result=mysqli_query($conn,$user_query);
				if(mysqli_num_rows($user_result)>0)
				{
					$bridge_row=mysqli_fetch_array($user_result);
					$bridge_personal_query="SELECT * FROM users_personal WHERE user_id='".$connect_user_id."'";
					$bridge_personal_result=mysqli_query($conn,$bridge_personal_query);
					if(mysqli_num_rows($bridge_personal_result))
					{
						$bridge_personal_row=mysqli_fetch_array($bridge_personal_result);
					}
					$profile=getUserProfileImage($connect_user_id);
					$data.='<div class="col-4" id="user_section_followed_'.$connect_user_id.'">
					<b href="profile">
					   <div class="border network-list network-item rounded mb-3">
						  <div class="p-3 text-center">
							 <div class="mb-3">
								<img class="rounded-circle" src="'.$profile.'" alt="" style="border:1px solid #eaebec !important;">
							 </div>
							 <div class="font-weight-bold">
								<h6 class="font-weight-bold text-dark mb-0">'.$bridge_row['first_name']." ".$bridge_row['last_name'].'</h6>
								<div class="small text-black-50">'.$bridge_row['profile_title'];
								if($bridge_row['profile_title']==""){ $data.="<br/>"; }
								$data.='</div>
							 </div>
						  </div>';
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
						  $data.='<div class="d-flex align-items-center p-3 border-top border-bottom network-item-body">';
								$counter=0;
								if($mutual_connections_count>0)
								{
									$data.='<div class="overlap-rounded-circle">';
										
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
											$data.='<img class="rounded-circle shadow-sm" style="border:1px solid #eaebec !important;" data-toggle="tooltip" data-sm="'.$m_user_id.'" data-placement="top" title="'.$m_u_row['first_name']." ".$m_u_row['last_name'].'" src="'.$m_u_profile.'" alt="'.$m_u_row['first_name']." ".$m_u_row['last_name'].'">';
										}
									}
									$data.='</div>';
								}
							$data.='<span class="font-weight-bold small text-primary">'.$counter.' mutual connections</span>
						  </div>';
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
						  $data.='<div class="network-item-footer py-3 d-flex text-center">
							 <div class="col-6 pl-3 pr-1">
								<button type="button" onclick="CancelUser('.$connect_user_id.');" class="btn btn-warning btn-sm btn-block"> '.$text.' </button>
							 </div>
							 <div class="col-6 pr-3 pl-1">
								<button type="button" class="btn btn-outline-primary btn-sm btn-block"> <i class="feather-user-plus"></i> '.$follow.' </button>
							 </div>
						  </div>
					   </div>
					</b>
				 </div>';
				}
			}
		}
		$response['data']=$data.'<script>
	loadImage("requested_user_data_hub");
</script>';
	}
	else
	{
		$response['status']="timeout";
	}
	echo json_encode($response);
?>