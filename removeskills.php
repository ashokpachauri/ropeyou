<?php
	include_once 'connection.php';
	$response=array();
	if(isset($_COOKIE['uid']) && $_COOKIE['uid']!="")
	{
		$user_id=$_COOKIE['uid'];
		$skill_id=$_POST['skill_id'];
		$query="DELETE FROM users_skills WHERE user_id='$user_id' AND id='$skill_id'";
		mysqli_query($conn,$query);
		$query="SELECT * FROM users_skills WHERE status=1 AND user_id='$user_id'";
		$result=mysqli_query($conn,$query);
		$response['status']='success';
		$htmlData="";
		if(mysqli_num_rows($result)>0)
		{
			while($row=mysqli_fetch_array($result))
			{
				$htmlData=$htmlData."<div class='col-md-6' style='margin-bottom:15px;border:1px solid gray;border-radius:10px;height:30px;max-width:48%;margin-right:1%;'><div class='row' style='margin-top:5px;'>";
				$htmlData.="<div class='col-md-7'><h6 style='font-size:14px;' class='text-truncate'>".$row['title']."</h6></div>";
				$htmlData.="<div class='col-md-3'><h6 style='font-size:12px;'>";
				if(((int)($row['proficiency']))<=33)
				{
					$htmlData.='<span class="badge badge-success ml-1" style="border: 2px solid #00c9a7;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-dark ml-1" style="color: #343a40 !important;background-color: #fff !important;border: 2px solid #343a40 !important;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-dark ml-1" style="color: #343a40 !important;background-color: #fff !important;border: 2px solid #343a40 !important;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span>';
					//$skillMeterTitle="Basic";
				}
				else if(((int)($row['proficiency']))<=66)
				{
					$htmlData.='<span class="badge badge-success ml-1" style="border: 2px solid #00c9a7;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-success ml-1" style="border: 2px solid #00c9a7;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-dark ml-1" style="color: #343a40 !important;background-color: #fff !important;border: 2px solid #343a40 !important;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span>';
					//$skillMeterTitle="Proficient";
				}
				else if(((int)($row['proficiency']))<=100)
				{
					$htmlData.='<span class="badge badge-success ml-1" style="border: 2px solid #00c9a7;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-success ml-1" style="border: 2px solid #00c9a7;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-success ml-1" style="border: 2px solid #00c9a7;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span>';
					//$skillMeterTitle="Expert";
				}
				$htmlData.="</h6></div>";
				$htmlData.="<div class='col-md-2'><h6><a href='javascript:void(0);' title='Remove' class='remove_skill' onclick='removeSkills(".$row['id'].");' style='text-decoration:none;'><img src='".base_url."img/remove-icon.png' style='width:16px;'></a></h6></div>";
				$htmlData.="</div></div>";
				$htmlData.="<script>
				var base_url=localStorage.getItem('base_url');
				function removeSkills(skill_id){
					if(skill_id!=='')
					{
						$.ajax({
							url:base_url+'removeskills',
							type:'post',
							data:{skill_id:skill_id},
							success:function(data)
							{
								var parsedJson=JSON.parse(data);
								if(parsedJson.status=='success')
								{
									$('.value_wrapper').html(parsedJson.htmlData);
								}
							}
						});
					}
				}
				</script>";
			}
		}
		else
		{
			$htmlData="<div class='col-md-12'><h6 style='text-align:center;'>No Skills has been added yet.</h6></div>";
		}
		$response['htmlData']=$htmlData;
	}
	else
	{
		$response['status']='error';
		$response['message']='Session Loggedout Try After login';
	}
	echo json_encode($response);
?>