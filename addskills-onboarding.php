<?php
	include_once 'connection.php';
	$response=array();
	if(isset($_COOKIE['uid']) && $_COOKIE['uid']!="")
	{
		$user_id=$_COOKIE['uid'];
		$proficiency=filter_var($_POST['proficiency'],FILTER_SANITIZE_STRING);
		$skill_name=filter_var($_POST['skill_name'],FILTER_SANITIZE_STRING);
		$query="SLECT * FROM skills WHERE title='$skill_name'";
		$result=mysqli_query($conn,$query);
		if(mysqli_num_rows($result)==0)
		{
			mysqli_query($conn,"INSERT INTO skills SET title='$skill_name',status=1");
		}
		$query="SELECT * FROM users_skills WHERE title='$skill_name' AND user_id='$user_id'";
		$result=mysqli_query($conn,$query);
		$query="INSERT INTO users_skills SET proficiency='$proficiency',title='$skill_name',user_id='$user_id'";
		if(mysqli_num_rows($result)>0)
		{
			$query="UPDATE users_skills SET proficiency='$proficiency' WHERE title='$skill_name' AND user_id='$user_id'";
		}
		$htmlData="";
		$response['status']='success';
		mysqli_query($conn,$query);
		$query="SELECT * FROM users_skills WHERE user_id='$user_id' AND status=1 ORDER BY proficiency DESC";
		$result=mysqli_query($conn,$query);
		if(mysqli_num_rows($result)>0)
		{
			while($row=mysqli_fetch_array($result))
			{
				$htmlData=$htmlData."<div class='col-md-5' style='margin-bottom:15px;border:1px solid gray;border-radius:10px;'><div class='row'>";
				$htmlData.="<div class='col-md-6'><h6>".ucfirst(strtolower($row['title']))."</h6></div>";
				$htmlData.="<div class='col-md-4'><h6>";
				/*if(((int)($row['proficiency']))<=33)
				{
					$htmlData.="Basic";
				}
				else if(((int)($row['proficiency']))<=66)
				{
					$htmlData.="Proficient";
				}
				else if(((int)($row['proficiency']))<=100)
				{
					$htmlData.="Expert";
				}*/
				$skillMeterHtml="";
				$skillMeterTitle="";
				if(((int)($row['proficiency']))<=33)
				{
					$htmlData.='<span class="badge badge-danger ml-1" style="border: 2px solid red;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-dark ml-1" style="color: #f54295 !important;background-color: #fff !important;border: 2px solid #343a40 !important;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-dark ml-1" style="color: #343a40 !important;background-color: #fff !important;border: 2px solid #343a40 !important;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span>';
					$skillMeterTitle="Basic";
				}
				else if(((int)($row['proficiency']))<=66)
				{
					$htmlData.='<span class="badge badge-warning ml-1" style="border: 2px solid #dbb716;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-warning ml-1" style="border: 2px solid #dbb716;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-dark ml-1" style="color: #343a40 !important;background-color: #fff !important;border: 2px solid #343a40 !important;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span>';
					$skillMeterTitle="Proficient";
				}
				else if(((int)($row['proficiency']))<=100)
				{
					$htmlData.='<span class="badge badge-success ml-1" style="border: 2px solid #00c9a7;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-success ml-1" style="border: 2px solid #00c9a7;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span><span class="badge badge-success ml-1" style="border: 2px solid #00c9a7;border-radius:50% !important;">&nbsp;&nbsp;&nbsp;</span>';
					$skillMeterTitle="Expert";
				}
				$htmlData.="</h6></div>";
				$htmlData.="<div class='col-md-2'><h6><a href='javascript:void(0);' title='Remove' class='remove_skill' onclick='removeSkills(".$row['id'].");' style='text-decoration:none;'><i class='fa fa-trash' style='color:red;font-size:16px;'></i></a></h6></div>";
				$htmlData.="</div></div><div class='col-md-1'></div>";
			}
		}
		else
		{
			$htmlData="<div class='col-md-12'><h6 style='text-align:center;'>No Skills has been added yet.</h6></div>";
		}
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
		$response['htmlData']=$htmlData;
	}
	else
	{
		$response['status']='error';
		$response['message']='Session Loggedout Try After login';
	}
	echo json_encode($response);
?>