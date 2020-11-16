<?php
	include_once 'connection.php';
	$response=array();
	$origin=false;
	if(isset($_COOKIE['uid']) && $_COOKIE['uid']!="")
	{
		if(isset($_POST['origin']) && $_POST['origin']!="")
		{
			$origin=$_POST['origin'];
		}
		$additional_check_query="";
		$insert_query="";
		$insert_query_end="";
		$item_token=filter_var($_POST['item_token'],FILTER_SANITIZE_STRING);
		$user_id=$_COOKIE['uid'];
		if($item_token!="")
		{
			$additional_check_query="SELECT * FROM users_education WHERE id='$item_token' AND user_id='$user_id'";
			$additional_check_result=mysqli_query($conn,$additional_check_query);
			if(mysqli_num_rows($additional_check_result)==0)
			{
				$response['status']="error";
				$response['message']="Invalid request please try reloading the page.";
				echo json_encode($response);die();
			}
			$additional_check_query=" AND id!='$item_token'";
			$insert_query="UPDATE ";
			$insert_query_end=" WHERE id='$item_token'";
		}
		else
		{
			$additional_check_query="";
			$insert_query="INSERT INTO ";
			$insert_query_end="";
		}
		$course=filter_var($_POST['course'],FILTER_SANITIZE_STRING);
		$majors=filter_var($_POST['majors'],FILTER_SANITIZE_STRING);
		$university=filter_var($_POST['university'],FILTER_SANITIZE_STRING);
		
		$edu_country=filter_var($_POST['edu_country'],FILTER_SANITIZE_STRING);
		$edu_city=filter_var($_POST['edu_city'],FILTER_SANITIZE_STRING);
		
		$edu_description=filter_var($_POST['edu_description'],FILTER_SANITIZE_STRING);
		
		$from_day=filter_var($_POST['from_day'],FILTER_SANITIZE_STRING);
		$from_month=filter_var($_POST['from_month'],FILTER_SANITIZE_STRING);
		$from_year=filter_var($_POST['from_year'],FILTER_SANITIZE_STRING);
		
		$to_day=filter_var($_POST['to_day'],FILTER_SANITIZE_STRING);
		$to_month=filter_var($_POST['to_month'],FILTER_SANITIZE_STRING);
		$to_year=filter_var($_POST['to_year'],FILTER_SANITIZE_STRING);
		$studying=filter_var($_POST['studying'],FILTER_SANITIZE_STRING);
		
		$query="SELECT * FROM universities WHERE title='$university' AND city='$edu_city'";
		$result=mysqli_query($conn,$query);
		$num_rows=mysqli_num_rows($result);
		
		if($num_rows==0)
		{
			mysqli_query($conn,"INSERT INTO universities SET title='$university',city='$edu_city',added=NOW(),status=0");
		}
		
		$query="SELECT * FROM courses WHERE title='$course'";
		$result=mysqli_query($conn,$query);
		$num_rows=mysqli_num_rows($result);
		
		if($num_rows==0)
		{
			mysqli_query($conn,"INSERT INTO courses SET title='$course',status=0");
		}
		else
		{
			$row=mysqli_fetch_array($result);
			$course_id=$row['id'];
		}
		
		$query="SELECT * FROM majors WHERE title='$majors' AND course='$course_id'";
		$result=mysqli_query($conn,$query);
		$num_rows=mysqli_num_rows($result);
		
		if($num_rows==0)
		{
			mysqli_query($conn,"INSERT INTO majors SET title='$majors',course='$course_id',status=0");
		}
		
		if($studying=="1")
		{
			$to_day="";
			$to_month="";
			$to_year="";
		}
		$check_query="SELECT * FROM users_education WHERE title='$course' AND country='$edu_country' AND from_day='$from_day' AND from_month='$from_month' AND from_year='$from_year' AND city='$edu_city' AND major='$majors' AND user_id='$user_id' AND university='$university'".$additional_check_query;
		$check_result=mysqli_query($conn,$check_query);
		if(mysqli_num_rows($check_result)==0)
		{
			$insert_query=$insert_query."users_education SET major='$majors',user_id='$user_id',title='$course',country='$edu_country',from_day='$from_day',from_month='$from_month',from_year='$from_year',to_day='$to_day',to_month='$to_month',to_year='$to_year',city='$edu_city',university='$university',description='$edu_description',studying='$studying' ".$insert_query_end;
			$insert_result=mysqli_query($conn,$insert_query);
			if($insert_result)
			{
				
				$response['status']="success";
				$response['message']="Education saved successfully.";
				if($item_token=="")
				{
					$item_token=mysqli_insert_id($conn);
				}
				$response['id']=$item_token;
				$country_query="SELECT title FROM country WHERE id='".$edu_country."'";
				$country_result=mysqli_query($conn,$country_query);
				$country_row=mysqli_fetch_array($country_result);
				
				$city_query="SELECT title FROM city WHERE id='".$edu_city."'";
				$city_result=mysqli_query($conn,$city_query);
				$city_row=mysqli_fetch_array($city_result);
				$data="";
				if($origin==false)
				{					
					$data='<div class="col-md-12" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);transition: box-shadow 83ms;background:#fff;padding:10px;margin: 0 0px 10px;border-radius:2px;border-bottom: 2px solid #e8ebed;border-top: 2px solid #e8ebed;" id="edu_'.$item_token.'">
						<div class="row">
							<div class="col-md-8">
								<h6>'.ucfirst(strtolower($course)).'</h6>
								<p style="font-size:16px;margin-bottom:0px !important;">'.ucfirst(strtolower($university)).'</p>
								<small><i>'.ucfirst(strtolower($city_row['title'])).', '.ucfirst(strtolower($country_row['title'])).'</i></small>
							</div>
							<div class="col-md-3">
								<h6>'.print_month($from_month).' '.$from_year.'  to ';
								if($studying=="1"){ $data=$data."Present"; } else { $data=$data.print_month($to_month)." ".$to_year; }
								$data=$data.'</h6>
							</div>
							<div class="col-md-1">
								<h6><a href="javascript:void(0);" onclick="getExperience('.$item_token.');">Edit</a></h6>
							</div>
							<div class="col-md-12">
								<p>'; 
									if($edu_description==""){
										$data=$data. "<b>".ucfirst(strtolower($course))."</b> at <b>".ucfirst(strtolower($university))."</b> in <b>".ucfirst(strtolower($city_row['title'])).", ".ucfirst(strtolower($country_row['title']))."</b> from <b>".print_month($from_month)." ".$from_year."</b> to <b>";
										if($studying=="1"){ $data.= "Present</b>."; } else { $data.= print_month($to_month)." ".$to_year."</b>."; }
									}
									else
									{
										$data.= ucfirst(strtolower($edu_description));
									}
								$data.='</p>
							</div>
						</div>
					</div>';
				}
				else{
					$data='<div class="box-body p-3 border-bottom" id="edu_'.$item_token.'">
						<div class="d-flex align-items-top job-item-header pb-2">
						   <div class="mr-2">
							  <h6 class="font-weight-bold text-dark mb-0">'.ucfirst(strtolower($university)).'&nbsp;&nbsp;<a style="cursor:pointer;" title="Edit" onclick="getEducation('.$item_token.');" href="javascript:void(0);"><i class="feather-edit"></i></a>&nbsp;&nbsp;<a style="cursor:pointer;color:red;" title="Delete" onclick="deleteEducation('.$item_token.');" href="javascript:void(0);"><i class="feather-trash-2"></i></a></h6>
							  <div class="text-truncate text-primary">'.ucfirst(strtolower($course)).'</div>
							  <div class="small text-gray-500">'.print_month($from_month).' '.$from_year.'  to ';
								if($studying=="1"){ $data=$data."Present"; } else { $data=$data.print_month($to_month)." ".$to_year; }
								$data=$data.'</div>
						   </div>
						   <img class="img-fluid ml-auto mb-auto" src="'.base_url.'img/e1.png" alt="">
						</div>
						<p class="mb-0 more">'; 
							if($edu_description==""){
								$data=$data. "<b>".ucfirst(strtolower($course))."</b> at <b>".ucfirst(strtolower($university))."</b> in <b>".ucfirst(strtolower($city_row['title'])).", ".ucfirst(strtolower($country_row['title']))."</b> from <b>".print_month($from_month)." ".$from_year."</b> to <b>";
								if($studying=="1"){ $data.= "Present</b>."; } else { $data.= print_month($to_month)." ".$to_year."</b>."; }
							}
							else
							{
								$data.= ucfirst(strtolower($edu_description));
							}
						$data.='</p>
					</div>';
				}
				$response['data']=$data;
				echo json_encode($response);die();
			}
			else
			{
				$response['status']="error";
				$response['message']="Database error please contact developer";
				echo json_encode($response);die();
			}
		}
		else{
			$response['status']="error";
			$response['message']="Duplicate Entry Please Check Again";
			echo json_encode($response);die();
		}
	}
	else
	{
		$response['status']="error";
		$response['message']="Session Out Please Login Again";
		echo json_encode($response);die();
	}
?>