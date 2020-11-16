<?php
	include_once 'connection.php';
	$response=array();
	if(isset($_COOKIE['uid']) && $_COOKIE['uid']!="")
	{
		$user_id=$_COOKIE['uid'];
		$interest_id=$_POST['interest_id'];
		$query="DELETE FROM users_interests WHERE user_id='$user_id' AND id='$interest_id'";
		mysqli_query($conn,$query);
		$query="SELECT * FROM users_interests WHERE status=1 AND user_id='$user_id'";
		$result=mysqli_query($conn,$query);
		$response['status']='success';
		$htmlData="";
		if(mysqli_num_rows($result)>0)
		{
			while($row=mysqli_fetch_array($result))
			{
				$htmlData=$htmlData."<div class='col-md-6' style='margin-bottom:15px;border:1px solid gray;border-radius:10px;height:30px;max-width:48%;margin-right:1%;'><div class='row' style='margin-top:5px;'>";
				$htmlData.="<div class='col-md-10'><h6 style='font-size:14px;'>".$row['title']."</h6></div>";
				
				$htmlData.="<div class='col-md-2'><h6 style='font-size:12px;'><a href='javascript:void(0);' title='Remove' class='remove_interests' onclick='removeInterests(".$row['id'].");' style='text-decoration:none;'><img src='".base_url."img/remove-icon.png' style='width:16px;'></a></h6></div>";
				$htmlData.="</div></div>";
				$htmlData.="<script>
				var base_url=localStorage.getItem('base_url');
				function removeInterests(interest_id){
					if(interest_id!=='')
					{
						$.ajax({
							url:base_url+'removeinterests',
							type:'post',
							data:{interest_id:interest_id},
							success:function(data)
							{
								var parsedJson=JSON.parse(data);
								if(parsedJson.status=='success')
								{
									$('.value_wrapper_1').html(parsedJson.htmlData);
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