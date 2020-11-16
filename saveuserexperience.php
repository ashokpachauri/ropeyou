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
			$additional_check_query="SELECT * FROM users_work_experience WHERE id='$item_token' AND user_id='$user_id'";
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
		$work_designation=filter_var($_POST['work_designation'],FILTER_SANITIZE_STRING);
		$company_name=filter_var($_POST['company_name'],FILTER_SANITIZE_STRING);
		$company_id=filter_var($_POST['company_id'],FILTER_SANITIZE_STRING);
		
		$work_country=filter_var($_POST['work_country'],FILTER_SANITIZE_STRING);
		$work_city=filter_var($_POST['work_city'],FILTER_SANITIZE_STRING);
		
		$work_description=filter_var($_POST['work_description'],FILTER_SANITIZE_STRING);
		
		$from_day=filter_var($_POST['from_day'],FILTER_SANITIZE_STRING);
		$from_month=filter_var($_POST['from_month'],FILTER_SANITIZE_STRING);
		$from_year=filter_var($_POST['from_year'],FILTER_SANITIZE_STRING);
		
		$to_day=filter_var($_POST['to_day'],FILTER_SANITIZE_STRING);
		$to_month=filter_var($_POST['to_month'],FILTER_SANITIZE_STRING);
		$to_year=filter_var($_POST['to_year'],FILTER_SANITIZE_STRING);
		$working=filter_var($_POST['working'],FILTER_SANITIZE_STRING);
		
		$query="SELECT * FROM companies WHERE title='$company_name' AND city='$work_city'";
		$result=mysqli_query($conn,$query);
		$num_rows=mysqli_num_rows($result);
		$company_status=0;
		if($num_rows==0 && $company_id=="")
		{
			mysqli_query($conn,"INSERT INTO companies SET title='$company_name',country='$work_country',city='$work_city',added=NOW(),status=0");
			$company_id=mysqli_insert_id($conn);
			$company_status=0;
		}
		else
		{
			$c_row=mysqli_fetch_array($result);
			$company_id=$c_row['id'];
			$company_status=$c_row['status'];
		}
		
		$query="SELECT * FROM designations WHERE title='$work_designation' AND status=1";
		$result=mysqli_query($conn,$query);
		$num_rows=mysqli_num_rows($result);
		
		if($num_rows==0)
		{
			mysqli_query($conn,"INSERT INTO designations SET title='$work_designation',status=0");
		}
		
		if($working=="1")
		{
			$to_day="";
			$to_month="";
			$to_year="";
		}
		$check_query="SELECT * FROM users_work_experience WHERE title='$work_designation' AND country='$work_country' AND from_day='$from_day' AND from_month='$from_month' AND from_year='$from_year' AND city='$work_city' AND user_id='$user_id' AND company='$company_id'".$additional_check_query;
		$check_result=mysqli_query($conn,$check_query);
		if(mysqli_num_rows($check_result)==0)
		{
			$insert_query=$insert_query."users_work_experience SET user_id='$user_id',title='$work_designation',country='$work_country',from_day='$from_day',from_month='$from_month',from_year='$from_year',to_day='$to_day',to_month='$to_month',to_year='$to_year',city='$work_city',company_id='$company_id',company='$company_name',description='$work_description',working='$working' ".$insert_query_end;
			$insert_result=mysqli_query($conn,$insert_query);
			if($insert_result)
			{
				
				$response['status']="success";
				$response['message']="Experience saved successfully.";
				if($item_token=="")
				{
					$item_token=mysqli_insert_id($conn);
				}
				$response['id']=$item_token;
				$country_query="SELECT title FROM country WHERE id='".$work_country."'";
				$country_result=mysqli_query($conn,$country_query);
				$country_row=mysqli_fetch_array($country_result);
				
				$city_query="SELECT title FROM city WHERE id='".$work_city."'";
				$city_result=mysqli_query($conn,$city_query);
				$city_row=mysqli_fetch_array($city_result);
				$data="";
				if($origin==false)
				{					
					$data='<div class="col-md-12" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);transition: box-shadow 83ms;background:#fff;padding:10px;margin: 0 0px 10px;border-radius:2px;border-bottom: 2px solid #e8ebed;border-top: 2px solid #e8ebed;" id="work_exp_'.$item_token.'">
						<div class="row">
							<div class="col-md-8">
								<h6>'.ucfirst(strtolower($work_designation)).'</h6>
								<p style="font-size:16px;margin-bottom:0px !important;">'.ucfirst(strtolower($company_name)).'</p>
								<small><i>'.ucfirst(strtolower($city_row['title'].', '.$country_row['title'])).'</i></small>
							</div>
							<div class="col-md-3">
								<h6>'.print_month($from_month).' '.$from_year.'  to ';
								if($working=="1"){ $data=$data."Present"; } else { $data=$data.print_month($to_month)." ".$to_year; }
								$data=$data.'</h6>
							</div>
							<div class="col-md-1">
								<h6><a href="javascript:void(0);" onclick="getExperience('.$item_token.');">Edit</a></h6>
							</div>
							<div class="col-md-12">
								<p>'; 
									if($work_description==""){
										$data=$data. "<b>".ucfirst(strtolower($work_designation."</b> at <b>".$company_name."</b> in <b>".$city_row['title'].", ".$country_row['title']))."</b> from <b>".print_month($from_month)." ".$from_year."</b> to <b>";
										if($working=="1"){ $data.= "Present</b>."; } else { $data.= print_month($to_month)." ".$to_year."</b>."; }
									}
									else
									{
										$data.= ucfirst(strtolower($work_description));
									}
								$data.='</p>
							</div>
						</div>
					</div>';
				}
				else
				{
					$data='<div class="box-body p-3 border-bottom" id="work_exp_'.$item_token.'">
						<div class="d-flex align-items-top job-item-header pb-2">
							<div class="mr-2">
								<h6 class="font-weight-bold text-dark mb-0">'.ucfirst(strtolower($work_designation)).'&nbsp;&nbsp;<a style="cursor:pointer;" title="Edit" onclick="getExperience('.$item_token.');" href="javascript:void(0);"><i class="feather-edit"></i></a>&nbsp;&nbsp;<a style="cursor:pointer;color:red;" title="Delete" onclick="deleteExperience('.$item_token.');" href="javascript:void(0);"><i class="feather-trash-2"></i></a></h6>
								<div class="text-truncate text-primary">'.ucfirst(strtolower($company_name)).'</div>
								<div class="small text-gray-500">'.print_month($from_month).' '.$from_year.'  to ';
								if($working=="1"){ $data=$data."Present"; } else { $data=$data.print_month($to_month)." ".$to_year; }
								$data=$data.'</div>
							</div>
							<img class="img-fluid ml-auto mb-auto" src="'.base_url.'img/l3.png" alt="">
						</div>
						<p class="mb-0 more">'; 
							if($work_description==""){
								$data=$data. "<b>".ucfirst(strtolower($work_designation."</b> at <b>".$company_name."</b> in <b>".$city_row['title'].", ".$country_row['title']))."</b> from <b>".print_month($from_month)." ".$from_year."</b> to <b>";
								if($working=="1"){ $data.= "Present</b>."; } else { $data.= print_month($to_month)." ".$to_year."</b>."; }
							}
							else
							{
								$data.= ucfirst(strtolower($work_description));
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