<?php
	include_once 'connection.php';
	$user_id=$_POST['user_id'];
	$user_ref=$_POST['user_ref'];
	$application_id=$_POST['application_id'];
	$job_id=$_POST['job_id'];
	$title=$_POST['title'];
	$time_of_schedule=$_POST['time_of_schedule'];
	$room_id=md5($user_id.$user_ref.$job_id.$title.$time_of_schedule.$application_id.time().mt_rand(9999,999999));
	$_query="SELECT * FROM interview_schedules WHERE user_id='$user_id' AND user_ref='$user_ref' AND job_id='$job_id' AND application_id='$application_id'";
	$_result=mysqli_query($conn,$_query);
	if(mysqli_num_rows($_result)>0)
	{
		?>
		<script>
			alert('already created');
			window.location.href="<?php echo base_url; ?>jobs-posted";
		</script>
		<?php
		die();
	}
	else
	{
		$query="INSERT INTO interview_schedules SET user_id='$user_id',user_ref='$user_ref',job_id='$job_id',application_id='$application_id',title='$title',time_of_schedule='$time_of_schedule',room_id='$room_id',added=NOW()";
		if(mysqli_query($conn,$query))
		{
			?>
			<script>
				alert('Schedule created');
				window.location.href="<?php echo base_url; ?>jobs-posted";
			</script>
			<?php
		}
		else
		{
			?>
			<script>
				alert('Something went wrong in creating schedule');
				window.location.href="<?php echo base_url; ?>jobs-posted";
			</script>
			<?php
			die();
		}
	}
?>