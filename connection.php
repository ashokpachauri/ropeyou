<?php
header("Access-Control-Allow-Origin: *");
date_default_timezone_set('Asia/Kolkata');
//echo date("Y-m-d H:i:s");
session_start();
define("base_url","https://ropeyou.com/rope/");
define("blog_base_url","http://ryblogger.ropeyou.com/");
define("interview_url","https://ropeyou.com/enable-x/client/");
define("site_title","RopeYou Connects");
define("DOMAIN","https://ropeyou.com/rope/");
define("DB_HOST","localhost");
define("DB_USERNAME","ropeyou_master");
define("DB_PASSWORD","ropeyou#2019");
define("DB_NAME","ropeyou_master");

define("CLIENT_ID", "81988qedme6y7f");
define("CLIENT_SECRET", "Z5jo8h3JV3UybHt2");
define("REDIRECT_URI", "https://ropeyou.com/cut/backup/index.php");
define("SCOPE", 'r_basicprofile r_emailaddress');

$BASEURL=base_url;
$DBUSERNAME=DB_USERNAME;
$DBPASSWORD=DB_PASSWORD;
$DBNAME=DB_NAME;
$DBHOST=DB_HOST;
$conn=mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
$conn->set_charset('utf8');
error_reporting(0);
/*-----------Manage User Activeness ----------*/
function getIPAddress() {  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }   
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
}  
function getLatLong($ip_address)
{
	$access_key = '4985d1432ad4a137720f0660bf48267d';
	$ch = curl_init('http://api.ipstack.com/'.$ip_address.'?access_key='.$access_key.'');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$json = curl_exec($ch);
	curl_close($ch);
	$api_result = json_decode($json, true);
	return $api_result;
}
function distance_between_points_on_earth($latitudeFrom=0, $longitudeFrom=0, $latitudeTo=0,  $longitudeTo=0) 
{ 
	if($latitudeFrom=="" || $latitudeFrom==null || $latitudeFrom=="NULL")
	{
		$latitudeFrom=0;
	}
	if($longitudeFrom=="" || $longitudeFrom==null || $longitudeFrom=="NULL")
	{
		$longitudeFrom=0;
	}
	if($latitudeTo=="" || $latitudeTo==null || $latitudeTo=="NULL")
	{
		$latitudeTo=0;
	}
	if($longitudeTo=="" || $longitudeTo==null || $longitudeTo=="NULL")
	{
		$longitudeTo=0;
	}
	if(($longitudeTo==$longitudeFrom) && ($latitudeFrom==$latitudeTo))
	{
		return mt_rand(0,50);
	}
   $long1 = deg2rad($longitudeFrom); 
   $long2 = deg2rad($longitudeTo); 
   $lat1 = deg2rad($latitudeFrom); 
   $lat2 = deg2rad($latitudeTo); 
	  
   //Haversine Formula 
   $dlong = $long2 - $long1; 
   $dlati = $lat2 - $lat1; 
	  
   $val = pow(sin($dlati/2),2)+cos($lat1)*cos($lat2)*pow(sin($dlong/2),2); 
	  
   $res = 2 * asin(sqrt($val)); 
	  
   $radius = 3958.756; 
	  
   return ($res*$radius)*1.609344*1000; 
}
function sendOTP($mobile_email,$random,$country_code,$otp_type='mobile')
{
	$country_code=trim($country_code);
	$mobile_email=trim($mobile_email);
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => "http://2factor.in/API/V1/0bc7eee2-1ea7-11eb-b380-0200cd936042/SMS/".$country_code.$mobile_email."/".$random,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_POSTFIELDS => "",
		CURLOPT_HTTPHEADER => array("content-type: application/x-www-form-urlencoded"),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
	if ($err) {
		//echo "cURL Error #:" . $err;
	} else {
		//echo $response;
	}
	return true;
}
if(isset($_COOKIE['uid']) && $_COOKIE['uid']!="")
{
	$user_id=$_COOKIE['uid'];
	$ip_address=getIPAddress();
	mysqli_query($conn,"UPDATE users SET ip_address='$ip_address',location_updated=NOW() WHERE id='$user_id' AND location_update NOT LIKE '%DATE(NOW())%'");
	$lat_long=getLatLong($ip_address);
	$lattitude=$lat_long['latitude'];
	$longitude=$lat_long['longitude'];
	if($lattitude!="" && $longitude!="")
	{
		mysqli_query($conn,"UPDATE users SET lattitude='$lattitude',longitude='$longitude' WHERE id='$user_id' AND location_update NOT LIKE '%DATE(NOW())%'");
	}
}
function getCommonPersonsOnJob($job_id,$loggedin_user_id)
{
	echo '<div class="d-flex align-items-center p-3 border-top border-bottom job-item-body">
																 <div class="overlap-rounded-circle">
																	<img class="rounded-circle shadow-sm" data-toggle="tooltip" data-placement="top" title="Sophia Lee" src="'.base_url.'img/p1.png" alt="">
																	<img class="rounded-circle shadow-sm" data-toggle="tooltip" data-placement="top" title="John Doe" src="'.base_url.'img/p2.png" alt="">
																	<img class="rounded-circle shadow-sm" data-toggle="tooltip" data-placement="top" title="Julia Cox" src="'.base_url.'img/p3.png" alt="">
																	<img class="rounded-circle shadow-sm" data-toggle="tooltip" data-placement="top" title="Robert Cook" src="'.base_url.'img/p4.png" alt="">
																	<img class="rounded-circle shadow-sm" data-toggle="tooltip" data-placement="top" title="Sophia Lee" src="'.base_url.'img/p5.png" alt="">
																 </div>
																 <span class="font-weight-bold text-primary">18 connections</span>
															  </div>';
}
mysqli_query($conn,"UPDATE users_logs SET is_active=0 WHERE is_active=1 AND TIMESTAMPDIFF(MINUTE,added,NOW())>5");
function showVideo($video)
{
	if($video=="")
	{
		//return $GLOBALS['BASEURL']."uploads/".$video;
		return $video;
	}
	else
	{
		$video_arr=explode("ropeyou.com",$video);
		if(count($video_arr)=="2")
		{
			//return $GLOBALS['BASEURL']."uploads/".$video;
			return $video;
		}
		else
		{
			return $video;
		}
	}
}
if(isset($_COOKIE['uid']) && $_COOKIE['uid']!="")
{
	$uid=$_COOKIE['uid'];
	$logquery="SELECT * FROM users_logs WHERE user_id='$uid'";
	$logresult=mysqli_query($conn,$logquery);
	if(mysqli_num_rows($logresult)>0)
	{
		mysqli_query($conn,"UPDATE users_logs SET is_active=1,added=NOW() WHERE user_id='$uid'");
	}
	else
	{
		mysqli_query($conn,"INSERT INTO users_logs SET is_active=1,user_id='$uid',added=NOW()");
	}
}
/*-----------End Manage User Activeness ----------*/

function sendInviteEmail($user_id,$email_id)
{
	
}
function generateUniqueCompanyUsername($username)
{
	$CONNECT=mysqli_connect($GLOBALS['DBHOST'],$GLOBALS['DBUSERNAME'],$GLOBALS['DBPASSWORD'],$GLOBALS['DBNAME']);
	$username=trim($username);
	if($username=="")
	{
		$username="company_".mt_rand(1,10000);
	}
	$username_to_test=$username;
	$numRows=1;
	$counter=1;
	while($numRows>0)
	{
		$query="SELECT * FROM companies WHERE username='$username_to_test'";
		$result=mysqli_query($CONNECT,$query);
		$numRows=mysqli_num_rows($result);
		if($numRows>0)
		{
			$username_to_test=$username."_".$counter++;
		}
	}
	return $username_to_test;
}
function generateUniqueUserName($email)
{
	$username="";
	if($email=="")
	{
		$username="r_".mt_rand(1,10000)."_y";
	}
	else
	{
		$email_arr=explode("@",$email);
		$username=$email_arr[0];
	}
	$CONNECT=mysqli_connect($GLOBALS['DBHOST'],$GLOBALS['DBUSERNAME'],$GLOBALS['DBPASSWORD'],$GLOBALS['DBNAME']);
	$username=trim($username);
	$username = preg_replace('/[^\w.]/', '', $username);
	$username_to_test=$username;
	$numRows=1;
	$counter=1;
	while($numRows>0)
	{
		$query="SELECT * FROM users WHERE username='$username_to_test' OR email='$username_to_test' OR mobile='$username_to_test'";
		$result=mysqli_query($CONNECT,$query);
		$numRows=mysqli_num_rows($result);
		if($numRows>0)
		{
			$username_to_test=$username."_".$counter++;
		}
	}
	return $username_to_test;
}
function getOnBoarding($user_id,$skipped)
{
	$onboarding="dashboard";
	$CONNECT=mysqli_connect($GLOBALS['DBHOST'],$GLOBALS['DBUSERNAME'],$GLOBALS['DBPASSWORD'],$GLOBALS['DBNAME']);
	
	$users_query="SELECT * FROM users WHERE id='$user_id'";
	$users_result=mysqli_query($CONNECT,$users_query);
	if(mysqli_num_rows($users_result)>0)
	{
		$users_row=mysqli_fetch_array($users_result);
		switch($skipped){
			case "0": 	$basic_query="SELECT * FROM users_personal WHERE user_id='$user_id'";
						$basic_result=mysqli_query($CONNECT,$basic_query);
						if(mysqli_num_rows($basic_result)>0)
						{
							$basic_row=mysqli_fetch_array($basic_result);
							if($basic_row['address']=="" || $basic_row['country']=="" || $basic_row['home_town']=="" || $basic_row['passport']==""  || $basic_row['relocate_abroad']=="" || $basic_row['about']=="")
							{
								$onboarding="bio";
							}
							else
							{
								$basic_query="SELECT * FROM users_work_experience WHERE user_id='$user_id'";
								$basic_result=mysqli_query($CONNECT,$basic_query);
								if(mysqli_num_rows($basic_result)>0)
								{
									$basic_query="SELECT * FROM users_education WHERE user_id='$user_id'";
									$basic_result=mysqli_query($CONNECT,$basic_query);
									if(mysqli_num_rows($basic_result)>0)
									{
										$basic_query="SELECT * FROM users_skills WHERE user_id='$user_id'";
										$basic_result=mysqli_query($CONNECT,$basic_query);
										if(mysqli_num_rows($basic_result)>0)
										{
											$basic_query="SELECT * FROM users_resume WHERE user_id='$user_id'";
											$basic_result=mysqli_query($CONNECT,$basic_query);
											if(mysqli_num_rows($basic_result)>0)
											{
												$profile_pic=getUserProfileImage($user_id);
												$profile_pic_arr=explode("/",$profile_pic);
												$arr=array("a.png","b.png","c.png","d.png","e.png","f.png","g.png","h.png","i.png","j.png","k.png","l.png","m.png","n.png","o.png","p.png","q.png","r.png","s.png","t.png","u.png","v.png","w.png","x.png","y.png","z.png");
												if(in_array(end($profile_pic_arr),$arr))
												{
													$onboarding="profile_pic";
												}
												else if($users_row['status']=="0")
												{
													$onboarding="email_verification";
												}
											}
											else
											{
												$onboarding="resume";
											}
										}
										else
										{
											$onboarding="skills";
										}
									}
									else
									{
										$onboarding="education";
									}
								}
								else
								{
									$onboarding="work_experience";
								}
							}
						}
						else
						{
							$onboarding="basic_profile";
						}break;
			case "1": 	$basic_query="SELECT * FROM users_work_experience WHERE user_id='$user_id'";
						$basic_result=mysqli_query($CONNECT,$basic_query);
						if(mysqli_num_rows($basic_result)>0)
						{
							$basic_query="SELECT * FROM users_education WHERE user_id='$user_id'";
							$basic_result=mysqli_query($CONNECT,$basic_query);
							if(mysqli_num_rows($basic_result)>0)
							{
								$basic_query="SELECT * FROM users_skills WHERE user_id='$user_id'";
								$basic_result=mysqli_query($CONNECT,$basic_query);
								if(mysqli_num_rows($basic_result)>0)
								{
									if($users_row['status']=="0")
									{
										$onboarding="email_verification";
									}
								}
								else
								{
									$onboarding="skills";
								}
							}
							else
							{
								$onboarding="education";
							}
						}
						else
						{
							$onboarding="work_experience";
						}break;
			case "2": 	$basic_query="SELECT * FROM users_education WHERE user_id='$user_id'";
						$basic_result=mysqli_query($CONNECT,$basic_query);
						if(mysqli_num_rows($basic_result)>0)
						{
							$basic_query="SELECT * FROM users_skills WHERE user_id='$user_id'";
							$basic_result=mysqli_query($CONNECT,$basic_query);
							if(mysqli_num_rows($basic_result)>0)
							{
								if($users_row['status']=="0")
								{
									$onboarding="email_verification";
								}
							}
							else
							{
								$onboarding="skills";
							}
						}
						else
						{
							$onboarding="education";
						}break;
			case "3": 	$basic_query="SELECT * FROM users_skills WHERE user_id='$user_id'";
						$basic_result=mysqli_query($CONNECT,$basic_query);
						if(mysqli_num_rows($basic_result)>0)
						{
							if($users_row['status']=="0")
							{
								$onboarding="email_verification";
							}
						}
						else
						{
							$onboarding="skills";
						}break;
			case "4": 	if($users_row['status']=="0")
						{
							$onboarding="email_verification";
						}break;
			default:$onboarding="broadcasts";break;
		}
	}
	else
	{
		$onboarding="session_expired";
	}
	return $onboarding;
}
function getWishListStatusByJobID($job_id,$user_id)
{
	$CONNECT=mysqli_connect($GLOBALS['DBHOST'],$GLOBALS['DBUSERNAME'],$GLOBALS['DBPASSWORD'],$GLOBALS['DBNAME']);
	$query="SELECT * FROM job_cart WHERE job_id='$job_id' AND user_id='$user_id'";
	$result=mysqli_query($CONNECT,$query);
	if(mysqli_num_rows($result)>0)
	{
		return mysqli_fetch_array($result);
	}
	else
	{
		return false;
	}
}
function getResumeByID($file_id)
{
	$CONNECT=mysqli_connect($GLOBALS['DBHOST'],$GLOBALS['DBUSERNAME'],$GLOBALS['DBPASSWORD'],$GLOBALS['DBNAME']);
	$query="SELECT * FROM gallery WHERE id='$file_id'";
	$result=mysqli_query($CONNECT,$query);
	if(mysqli_num_rows($result)>0)
	{
		return mysqli_fetch_array($result);
	}
	else
	{
		return false;
	}
}
function getDesignationByID($id)
{
	$CONNECT=mysqli_connect($GLOBALS['DBHOST'],$GLOBALS['DBUSERNAME'],$GLOBALS['DBPASSWORD'],$GLOBALS['DBNAME']);
	$query="SELECT title FROM designations WHERE id='$id'";
	$result=mysqli_query($CONNECT,$query);
	if(mysqli_num_rows($result)>0)
	{
		$row=mysqli_fetch_array($result);
		return $row['title'];
	}
	else
	{
		return false;
	}
}
function getCompanyByID($id)
{
	$CONNECT=mysqli_connect($GLOBALS['DBHOST'],$GLOBALS['DBUSERNAME'],$GLOBALS['DBPASSWORD'],$GLOBALS['DBNAME']);
	$query="SELECT title FROM companies WHERE id='$id'";
	$result=mysqli_query($CONNECT,$query);
	if(mysqli_num_rows($result)>0)
	{
		$row=mysqli_fetch_array($result);
		return $row['title'];
	}
	else
	{
		return false;
	}
}
function getUsersCurrentDesignation($user_id)
{
	$CONNECT=mysqli_connect($GLOBALS['DBHOST'],$GLOBALS['DBUSERNAME'],$GLOBALS['DBPASSWORD'],$GLOBALS['DBNAME']);
	$query="SELECT title,company FROM users_work_experience WHERE user_id='$user_id' ORDER BY id DESC";
	$result=mysqli_query($CONNECT,$query);
	if(mysqli_num_rows($result)>0)
	{
		$row=mysqli_fetch_array($result);
		$designation=getDesignationByID($row['title']);
		$company=getCompanyByID($row['company']);
		if($designation && $company)
		{
			return $designation." at ".$company;
		}
		else
		{
			return "Designation not provided yet.";
		}
	}
	else
	{
		return "Designation not provided yet.";
	}
}
function companies($id=false,$title=false,$city=false,$image=false,$added=false)
{
	$CONNECT=mysqli_connect($GLOBALS['DBHOST'],$GLOBALS['DBUSERNAME'],$GLOBALS['DBPASSWORD'],$GLOBALS['DBNAME']);
	$partial="";
	if($id)
	{
		$partial.=" WHERE id='$id'";
	}
	if($title)
	{
		if($partial=="")
		{
			$partial.=" WHERE ";
		}
		else{
			$partial.=" AND ";
		}
		$partial.="title='$title'";
	}
	if($city)
	{
		if($partial=="")
		{
			$partial.=" WHERE ";
		}
		else{
			$partial.=" AND ";
		}
		$partial.="city='$city'";
	}
	if($image)
	{
		if($partial=="")
		{
			$partial.=" WHERE ";
		}
		else{
			$partial.=" AND ";
		}
		$partial.="image='$image'";
	}
	if($added)
	{
		if($partial=="")
		{
			$partial.=" WHERE ";
		}
		else{
			$partial.=" AND ";
		}
		$partial.="added='$added'";
	}
	$_query="SELECT * FROM companies".$partial;
	$_result=mysqli_query($CONNECT,$_query);
	$_companies=array();
	if(mysqli_num_rows($_result)>0)
	{
		while($_row=mysqli_fetch_array($_result))
		{
			$_companies[]=$_row;
		}
	}
	return $_companies;
}
function universities($id=false,$title=false,$city=false,$image=false,$added=false)
{
	$CONNECT=mysqli_connect($GLOBALS['DBHOST'],$GLOBALS['DBUSERNAME'],$GLOBALS['DBPASSWORD'],$GLOBALS['DBNAME']);
	$partial="";
	if($id)
	{
		$partial.=" WHERE id='$id'";
	}
	if($title)
	{
		if($partial=="")
		{
			$partial.=" WHERE ";
		}
		else{
			$partial.=" AND ";
		}
		$partial.="title='$title'";
	}
	if($city)
	{
		if($partial=="")
		{
			$partial.=" WHERE ";
		}
		else{
			$partial.=" AND ";
		}
		$partial.="city='$city'";
	}
	if($image)
	{
		if($partial=="")
		{
			$partial.=" WHERE ";
		}
		else{
			$partial.=" AND ";
		}
		$partial.="image='$image'";
	}
	if($added)
	{
		if($partial=="")
		{
			$partial.=" WHERE ";
		}
		else{
			$partial.=" AND ";
		}
		$partial.="added='$added'";
	}
	$_query="SELECT * FROM universities".$partial;
	$_result=mysqli_query($CONNECT,$_query);
	$_companies=array();
	if(mysqli_num_rows($_result)>0)
	{
		while($_row=mysqli_fetch_array($_result))
		{
			$_companies[]=$_row;
		}
	}
	return $_companies;
}

function city($id=false,$title=false,$state=false,$country=false,$status=false)
{
	$CONNECT=mysqli_connect($GLOBALS['DBHOST'],$GLOBALS['DBUSERNAME'],$GLOBALS['DBPASSWORD'],$GLOBALS['DBNAME']);
	$partial="";
	if($id)
	{
		$partial.=" WHERE id='$id'";
	}
	if($title)
	{
		if($partial=="")
		{
			$partial.=" WHERE ";
		}
		else{
			$partial.=" AND ";
		}
		$partial.="title='$title'";
	}
	if($state)
	{
		if($partial=="")
		{
			$partial.=" WHERE ";
		}
		else{
			$partial.=" AND ";
		}
		$partial.="state='$state'";
	}
	if($country)
	{
		if($partial=="")
		{
			$partial.=" WHERE ";
		}
		else{
			$partial.=" AND ";
		}
		$partial.="country='$country'";
	}
	if($status)
	{
		if($partial=="")
		{
			$partial.=" WHERE ";
		}
		else{
			$partial.=" AND ";
		}
		$partial.="status='$status'";
	}
	$_query="SELECT * FROM city".$partial;
	$_result=mysqli_query($CONNECT,$_query);
	$_city=array();
	if(mysqli_num_rows($_result)>0)
	{
		while($_row=mysqli_fetch_array($_result))
		{
			$_city[]=$_row;
		}
	}
	return $_city;
}
function getCityByID($city_id)
{
	if($city_id=="")
	{
		return "NA";
	}
	$CONNECT=mysqli_connect($GLOBALS['DBHOST'],$GLOBALS['DBUSERNAME'],$GLOBALS['DBPASSWORD'],$GLOBALS['DBNAME']);
	$_result=mysqli_query($CONNECT,"SELECT * FROM city WHERE id='$city_id'");
	if(mysqli_num_rows($_result)>0)
	{
		$_row=mysqli_fetch_array($_result);
		return $_row['title'];
	}
	return "NA";
}
function getCountryByID($country_id)
{
	if($country_id=="")
	{
		return "NA";
	}
	$CONNECT=mysqli_connect($GLOBALS['DBHOST'],$GLOBALS['DBUSERNAME'],$GLOBALS['DBPASSWORD'],$GLOBALS['DBNAME']);
	$_result=mysqli_query($CONNECT,"SELECT * FROM country WHERE id='$country_id'");
	if(mysqli_num_rows($_result)>0)
	{
		$_row=mysqli_fetch_array($_result);
		return $_row['title'];
	}
	return "NA";
}
function getCompanyCategoryByID($category_id)
{
	if($category_id=="")
	{
		return "NA";
	}
	$CONNECT=mysqli_connect($GLOBALS['DBHOST'],$GLOBALS['DBUSERNAME'],$GLOBALS['DBPASSWORD'],$GLOBALS['DBNAME']);
	$_result=mysqli_query($CONNECT,"SELECT * FROM company_categories WHERE id='$category_id'");
	if(mysqli_num_rows($_result)>0)
	{
		$_row=mysqli_fetch_array($_result);
		return $_row['title'];
	}
	return "NA";
}
function getCompanyLogo($company_id)
{
	$CONNECT=mysqli_connect($GLOBALS['DBHOST'],$GLOBALS['DBUSERNAME'],$GLOBALS['DBPASSWORD'],$GLOBALS['DBNAME']);
	$_query="SELECT image,title FROM companies WHERE id='$company_id'";
	$_result=mysqli_query($CONNECT,$_query);
	$_profile="";
	$_title="";
	if(mysqli_num_rows($_result)>0)
	{
		$_row=mysqli_fetch_array($_result);
		$_profile=$_row['image'];
		$_title=$_row['title'];
	}
	if (strpos($_profile, 'http') !== false) {
		
	}
	else
	{
		if($_profile=="")
		{
			if($_title!="")
			{
				$user_row=mysqli_fetch_array($_user_result);
				$_profile=base_url."alphas/".strtolower(substr($_title,0,1)).".png";
			}
			else
			{
				$_profile="default.jpg";
				$_profile=base_url."uploads/".$_profile;
			}
		}
		else{
			$_profile=base_url."uploads/".$_profile;
		}
	}
	return $_profile;
}
function getCompanyBanner($company_id)
{
	$CONNECT=mysqli_connect($GLOBALS['DBHOST'],$GLOBALS['DBUSERNAME'],$GLOBALS['DBPASSWORD'],$GLOBALS['DBNAME']);
	$_query="SELECT banner_image,title FROM companies WHERE id='$company_id'";
	$_result=mysqli_query($CONNECT,$_query);
	$_profile="";
	$_title="";
	if(mysqli_num_rows($_result)>0)
	{
		$_row=mysqli_fetch_array($_result);
		$_profile=$_row['banner_image'];
		$_title=$_row['title'];
	}
	if (strpos($_profile, 'http') !== false) {
		
	}
	else
	{
		if($_profile=="")
		{
			$_profile=base_url."uploads/default-company-banner.png";
		}
		else
		{
			$_profile=base_url."uploads/company/".$company_id."/banner/".$_profile;
		}
	}
	return $_profile;
}
function getCompanyFunctionalAreaByID($functional_area_id)
{
	if($functional_area_id=="")
	{
		return "NA";
	}
	$CONNECT=mysqli_connect($GLOBALS['DBHOST'],$GLOBALS['DBUSERNAME'],$GLOBALS['DBPASSWORD'],$GLOBALS['DBNAME']);
	$_result=mysqli_query($CONNECT,"SELECT * FROM company_functional_areas WHERE id='$functional_area_id'");
	if(mysqli_num_rows($_result)>0)
	{
		$_row=mysqli_fetch_array($_result);
		return $_row['title'];
	}
	return "NA";
}
function getCompanyTypeByID($company_type)
{
	if($company_type=="")
	{
		return "NA";
	}
	$CONNECT=mysqli_connect($GLOBALS['DBHOST'],$GLOBALS['DBUSERNAME'],$GLOBALS['DBPASSWORD'],$GLOBALS['DBNAME']);
	$_result=mysqli_query($CONNECT,"SELECT * FROM company_types WHERE id='$company_type'");
	if(mysqli_num_rows($_result)>0)
	{
		$_row=mysqli_fetch_array($_result);
		return $_row['title'];
	}
	return "NA";
}
function state($id=false,$title=false,$country=false,$status=false)
{
	$CONNECT=mysqli_connect($GLOBALS['DBHOST'],$GLOBALS['DBUSERNAME'],$GLOBALS['DBPASSWORD'],$GLOBALS['DBNAME']);
	$partial="";
	if($id)
	{
		$partial.=" WHERE id='$id'";
	}
	if($title)
	{
		if($partial=="")
		{
			$partial.=" WHERE ";
		}
		else{
			$partial.=" AND ";
		}
		$partial.="title='$title'";
	}
	
	if($country)
	{
		if($partial=="")
		{
			$partial.=" WHERE ";
		}
		else{
			$partial.=" AND ";
		}
		$partial.="country='$country'";
	}
	if($status)
	{
		if($partial=="")
		{
			$partial.=" WHERE ";
		}
		else{
			$partial.=" AND ";
		}
		$partial.="status='$status'";
	}
	$_query="SELECT * FROM state".$partial;
	$_result=mysqli_query($CONNECT,$_query);
	$_state=array();
	if(mysqli_num_rows($_result)>0)
	{
		while($_row=mysqli_fetch_array($_result))
		{
			$_state[]=$_row;
		}
	}
	return $_state;
}
function country($id=false,$title=false,$code=false,$status=false)
{
	$CONNECT=mysqli_connect($GLOBALS['DBHOST'],$GLOBALS['DBUSERNAME'],$GLOBALS['DBPASSWORD'],$GLOBALS['DBNAME']);
	$partial="";
	if($id)
	{
		$partial.=" WHERE id='$id'";
	}
	if($title)
	{
		if($partial=="")
		{
			$partial.=" WHERE ";
		}
		else{
			$partial.=" AND ";
		}
		$partial.="title='$title'";
	}
	
	if($code)
	{
		if($partial=="")
		{
			$partial.=" WHERE ";
		}
		else{
			$partial.=" AND ";
		}
		$partial.="code='$code'";
	}
	if($status)
	{
		if($partial=="")
		{
			$partial.=" WHERE ";
		}
		else{
			$partial.=" AND ";
		}
		$partial.="status='$status'";
	}
	$_query="SELECT * FROM country".$partial;
	$_result=mysqli_query($CONNECT,$_query);
	$_country=array();
	if(mysqli_num_rows($_result)>0)
	{
		while($_row=mysqli_fetch_array($_result))
		{
			$_country[]=$_row;
		}
	}
	return $_country;
}
function professional_skills($user_id)
{
	$CONNECT=mysqli_connect($GLOBALS['DBHOST'],$GLOBALS['DBUSERNAME'],$GLOBALS['DBPASSWORD'],$GLOBALS['DBNAME']);
	$_professional_skills=array();
	$_skills_query="SELECT users_skills.id,users_skills.title,skills.title as skill,skills.icon,users_skills.proficiency AS proficiency FROM users_skills INNER JOIN skills ON skills.id=users_skills.title WHERE users_skills.user_id='".$user_id."' AND users_skills.type=1";
	
	$_skills_result=mysqli_query($CONNECT,$_skills_query);
	if(mysqli_num_rows($_skills_result)>0)
	{
		while($_skills_row=mysqli_fetch_array($_skills_result))
		{
			$_professional_skills[]=$_skills_row;
		}
	}
	else
	{
		$_professional_skills=false;
	}
	return $_professional_skills;
}
function personal_skills($user_id)
{
	$CONNECT=mysqli_connect($GLOBALS['DBHOST'],$GLOBALS['DBUSERNAME'],$GLOBALS['DBPASSWORD'],$GLOBALS['DBNAME']);
	$_professional_skills=array();
	$_skills_query="SELECT users_skills.id,users_skills.title,personal_skills.title as skill,personal_skills.icon,users_skills.proficiency AS proficiency FROM users_skills INNER JOIN personal_skills ON personal_skills.id=users_skills.title WHERE users_skills.user_id='".$user_id."' AND users_skills.type=2";
	
	$_skills_result=mysqli_query($CONNECT,$_skills_query);
	if(mysqli_num_rows($_skills_result)>0)
	{
		while($_skills_row=mysqli_fetch_array($_skills_result))
		{
			$_professional_skills[]=$_skills_row;
		}
	}
	else
	{
		$_professional_skills=false;
	}
	return $_professional_skills;
}
function userLoggedIn($user_id)
{
	$CONNECT=mysqli_connect($GLOBALS['DBHOST'],$GLOBALS['DBUSERNAME'],$GLOBALS['DBPASSWORD'],$GLOBALS['DBNAME']);
	$_response=false;
	$_query="SELECT * FROM users_logs WHERE user_id='$user_id'";
	$_result=mysqli_query($CONNECT,$_query);
	if(mysqli_num_rows($_result)>0)
	{
		$_row=mysqli_fetch_array($_result);
		if($_row['is_active']=="1")
		{
			$_response=true;
		}
		else
		{
			$_response=false;
		}
	}
	return $_response;
}
function is_interview_scheduled($user_id,$user_ref,$job_id,$application_id)
{
	$CONNECT=mysqli_connect($GLOBALS['DBHOST'],$GLOBALS['DBUSERNAME'],$GLOBALS['DBPASSWORD'],$GLOBALS['DBNAME']);
	$_query="SELECT * FROM interview_schedules WHERE user_id='$user_id' AND user_ref='$user_ref' AND job_id='$job_id' AND application_id='$application_id'";
	$_result=mysqli_query($CONNECT,$_query);
	if(mysqli_num_rows($_result)>0)
	{
		$_row=mysqli_fetch_array($_result);
		return $_row['room_id'];
	}
	else{
		return false;
	}
}
function getUsersPersonalData($user_id)
{
	$CONNECT=mysqli_connect($GLOBALS['DBHOST'],$GLOBALS['DBUSERNAME'],$GLOBALS['DBPASSWORD'],$GLOBALS['DBNAME']);
	$_response=false;
	$_query="SELECT * FROM users_personal WHERE user_id='$user_id'";
	$_result=mysqli_query($CONNECT,$_query);
	if(mysqli_num_rows($_result)>0)
	{
		$_response=mysqli_fetch_array($_result);
	}
	return $_response;
}
function getUsersData($user_id)
{
	$CONNECT=mysqli_connect($GLOBALS['DBHOST'],$GLOBALS['DBUSERNAME'],$GLOBALS['DBPASSWORD'],$GLOBALS['DBNAME']);
	$_response=false;
	$_query="SELECT * FROM users WHERE id='$user_id'";
	$_result=mysqli_query($CONNECT,$_query);
	if(mysqli_num_rows($_result)>0)
	{
		$_response=mysqli_fetch_array($_result);
	}
	return $_response;
}
function languages($user_id)
{
	$CONNECT=mysqli_connect($GLOBALS['DBHOST'],$GLOBALS['DBUSERNAME'],$GLOBALS['DBPASSWORD'],$GLOBALS['DBNAME']);
	$_professional_skills=array();
	$_skills_query="SELECT users_skills.id,users_skills.title,languages.title as skill,languages.icon,users_skills.proficiency AS proficiency FROM users_skills INNER JOIN languages ON languages.id=users_skills.title WHERE users_skills.user_id='".$user_id."' AND users_skills.type=3";
	
	$_skills_result=mysqli_query($CONNECT,$_skills_query);
	if(mysqli_num_rows($_skills_result)>0)
	{
		while($_skills_row=mysqli_fetch_array($_skills_result))
		{
			$_professional_skills[]=$_skills_row;
		}
	}
	else
	{
		$_professional_skills=false;
	}
	return $_professional_skills;
}
function designations($id=false,$title=false,$stream=false,$status=false)
{
	$CONNECT=mysqli_connect($GLOBALS['DBHOST'],$GLOBALS['DBUSERNAME'],$GLOBALS['DBPASSWORD'],$GLOBALS['DBNAME']);
	$partial="";
	if($id)
	{
		$partial.=" WHERE id='$id'";
	}
	if($title)
	{
		if($partial=="")
		{
			$partial.=" WHERE ";
		}
		else{
			$partial.=" AND ";
		}
		$partial.="title='$title'";
	}
	if($stream)
	{
		if($partial=="")
		{
			$partial.=" WHERE ";
		}
		else{
			$partial.=" AND ";
		}
		$partial.="stream='$stream'";
	}
	if($status)
	{
		if($partial=="")
		{
			$partial.=" WHERE ";
		}
		else{
			$partial.=" AND ";
		}
		$partial.="status='$status'";
	}
	$_query="SELECT * FROM designations".$partial;
	$_result=mysqli_query($CONNECT,$_query);
	$_designations=array();
	if(mysqli_num_rows($_result)>0)
	{
		while($_row=mysqli_fetch_array($_result))
		{
			$_designations[]=$_row;
		}
	}
	return $_designations;
}
function courses($id=false,$title=false,$stream=false,$status=false)
{
	$CONNECT=mysqli_connect($GLOBALS['DBHOST'],$GLOBALS['DBUSERNAME'],$GLOBALS['DBPASSWORD'],$GLOBALS['DBNAME']);
	$partial="";
	if($id)
	{
		$partial.=" WHERE id='$id'";
	}
	if($title)
	{
		if($partial=="")
		{
			$partial.=" WHERE ";
		}
		else{
			$partial.=" AND ";
		}
		$partial.="title='$title'";
	}
	if($stream)
	{
		if($partial=="")
		{
			$partial.=" WHERE ";
		}
		else{
			$partial.=" AND ";
		}
		$partial.="stream='$stream'";
	}
	if($status)
	{
		if($partial=="")
		{
			$partial.=" WHERE ";
		}
		else{
			$partial.=" AND ";
		}
		$partial.="status='$status'";
	}
	$_query="SELECT * FROM courses".$partial;
	$_result=mysqli_query($CONNECT,$_query);
	$_designations=array();
	if(mysqli_num_rows($_result)>0)
	{
		while($_row=mysqli_fetch_array($_result))
		{
			$_designations[]=$_row;
		}
	}
	return $_designations;
}
function getUserProfileImage($user_id)
{
	$CONNECT=mysqli_connect($GLOBALS['DBHOST'],$GLOBALS['DBUSERNAME'],$GLOBALS['DBPASSWORD'],$GLOBALS['DBNAME']);
	$_query="SELECT media_id,caption FROM users_profile_pics WHERE user_id='$user_id' AND status=1";
	$_result=mysqli_query($CONNECT,$_query);
	$_profile="";
	if(mysqli_num_rows($_result)>0)
	{
		$_row=mysqli_fetch_array($_result);
		$_profile=$_row['caption'];
	}
	if (strpos($_profile, 'http') !== false) {
		
	}
	else
	{
		if($_profile=="")
		{
			$_user_query="SELECT first_name FROM users WHERE id='$user_id'";
			$_user_result=mysqli_query($CONNECT,$_user_query);
			if(mysqli_num_rows($_user_result)>0)
			{
				$user_row=mysqli_fetch_array($_user_result);
				$_profile=base_url."alphas/".strtolower(substr($user_row['first_name'],0,1)).".png";
			}
			else{
				$_profile="default.png";
				$_profile=base_url."uploads/".$_profile;
			}
		}
		else{
			$_profile=base_url."uploads/".$_profile;
		}
	}
	return $_profile;
}
function getUserConnectionCounts($user_id)
{
	$CONNECT=mysqli_connect($GLOBALS['DBHOST'],$GLOBALS['DBUSERNAME'],$GLOBALS['DBPASSWORD'],$GLOBALS['DBNAME']);
	$_query="SELECT id FROM user_joins_user WHERE (user_id='".$user_id."' OR r_user_id='".$user_id."') AND status=1 AND blocked=0";
	$_result=mysqli_query($CONNECT,$_query);
	$_myConnections=mysqli_num_rows($_result);
	return $_myConnections;
}
function getUserConnections($user_id)
{
	$CONNECT=mysqli_connect($GLOBALS['DBHOST'],$GLOBALS['DBUSERNAME'],$GLOBALS['DBPASSWORD'],$GLOBALS['DBNAME']);
	$_query="SELECT * FROM user_joins_user WHERE (user_id='".$user_id."' OR r_user_id='".$user_id."') AND status=1 AND blocked=0";
	$_result=mysqli_query($CONNECT,$_query);
	$_myConnections=mysqli_num_rows($_result);
	if($_myConnections>0)
	{
		$_arr=array();
		while($_row=mysqli_fetch_array($_result)){
			if($_row['user_id']==$user_id)
			{
				$_arr[]=$_row['r_user_id'];
			}
			else{
				$_arr[]=$_row['user_id'];
			}
		}
		return $_arr;
	}
	else{
		return $_myConnections;
	}
}
function getUserProfileViews($user_id)
{
	$CONNECT=mysqli_connect($GLOBALS['DBHOST'],$GLOBALS['DBUSERNAME'],$GLOBALS['DBPASSWORD'],$GLOBALS['DBNAME']);
	/*$_query="SELECT id FROM user_joins_user WHERE (user_id='".$user_id."' OR r_user_id='".$user_id."') AND status=1 AND blocked=0";
	$_result=mysqli_query($CONNECT,$_query);
	$_myConnections=mysqli_num_rows($_result);
	return $_myConnections;*/
	return 0;
}
function getUserFollowingCounts($user_id)
{
	$CONNECT=mysqli_connect($GLOBALS['DBHOST'],$GLOBALS['DBUSERNAME'],$GLOBALS['DBPASSWORD'],$GLOBALS['DBNAME']);
	$_query="SELECT id FROM user_joins_user WHERE (user_id='".$user_id."' OR r_user_id='".$user_id."') AND (status=1 OR status=4) AND blocked=0";
	$_result=mysqli_query($CONNECT,$_query);
	$_myConnections=mysqli_num_rows($_result);
	return $_myConnections;
}
function getMediaByID($mediaID)
{
	$CONNECT=mysqli_connect($GLOBALS['DBHOST'],$GLOBALS['DBUSERNAME'],$GLOBALS['DBPASSWORD'],$GLOBALS['DBNAME']);
	
	$_profile_query="SELECT * FROM gallery WHERE id='$mediaID'";
	$_profile_result=mysqli_query($CONNECT,$_profile_query);
	$_profile="";
	if(mysqli_num_rows($_profile_result)>0)
	{
		$_profile_row=mysqli_fetch_array($_profile_result);
		$_profile=$_profile_row['title'];
	}
	if (strpos($_profile, 'http') !== false) {
		
	}
	else
	{
		if($_profile=="")
		{
			$_profile="default.png";
		}
		$_profile=base_url."uploads/".$_profile;
	}
	return $_profile;
}
function getMyBridge($user_id)
{
	$CONNECT=mysqli_connect($GLOBALS['DBHOST'],$GLOBALS['DBUSERNAME'],$GLOBALS['DBPASSWORD'],$GLOBALS['DBNAME']);
	$_query="SELECT * FROM user_joins_user WHERE (user_id='$user_id' OR r_user_id='$user_id') AND status=1";
	$_result=mysqli_query($CONNECT,$_query);
	if(mysqli_num_rows($_result)>0)
	{
		$_arr=array();
		while($_row=mysqli_fetch_array($_result))
		{
			if($user_id==$_row['user_id'])
			{
				$_arr[]=$_row['r_user_id'];
			}
			else
			{
				$_arr[]=$_row['user_id'];
			}
		}
		$_arr[]=$user_id;
		return $_arr;
	}
	else
	{
		return false;
	}
}
function getUserBannerImage($user_id)
{
	$CONNECT=mysqli_connect($GLOBALS['DBHOST'],$GLOBALS['DBUSERNAME'],$GLOBALS['DBPASSWORD'],$GLOBALS['DBNAME']);
	$_query="SELECT banner FROM users WHERE id='$user_id'";
	$_result=mysqli_query($CONNECT,$_query);
	$_row=mysqli_fetch_array($_result);
	
	$_profile_image=$_row['banner'];
	$_profile_query="SELECT * FROM gallery WHERE user_id='$user_id' AND id='$_profile_image'";
	$_profile_result=mysqli_query($CONNECT,$_profile_query);
	$_profile="";
	if(mysqli_num_rows($_profile_result)>0)
	{
		$_profile_row=mysqli_fetch_array($_profile_result);
		$_profile=$_profile_row['title'];
	}
	if (strpos($_profile, 'http') !== false) {
		
	}
	else
	{
		if($_profile=="")
		{
			$_profile="bg.jpg";
		}
		$_profile=base_url."uploads/".$_profile;
	}
	return $_profile;
}
function print_month($month){
	switch($month)
	{
		case "1":return "Jan";break;
		case "2":return "Feb";break;
		case "3":return "Mar";break;
		case "4":return "Apr";break;
		case "5":return "May";break;
		case "6":return "Jun";break;
		case "7":return "Jul";break;
		case "8":return "Aug";break;
		case "9":return "Sep";break;
		case "10":return "Oct";break;
		case "11":return "Nov";break;
		case "12":return "Dec";break;
		case "01":return "Jan";break;
		case "02":return "Feb";break;
		case "03":return "Mar";break;
		case "04":return "Apr";break;
		case "05":return "May";break;
		case "06":return "Jun";break;
		case "07":return "Jul";break;
		case "08":return "Aug";break;
		case "09":return "Sep";break;
		default:return false;break;
	}
}

function getUserResume($user_id)
{
	$CONNECT=mysqli_connect($GLOBALS['DBHOST'],$GLOBALS['DBUSERNAME'],$GLOBALS['DBPASSWORD'],$GLOBALS['DBNAME']);
	$_query="SELECT users_resume.id,users_resume.user_id,users_resume.file,users_resume.resume_headline,users_resume.status,gallery.file as resume_file,gallery.type,gallery.size,gallery.title FROM users_resume INNER JOIN gallery ON users_resume.file=gallery.id WHERE users_resume.user_id='$user_id' AND users_resume.status=1 AND users_resume.file!=''";
	$_result=mysqli_query($CONNECT,$_query);
	if(mysqli_num_rows($_result)>0)
	{	
		$_row=mysqli_fetch_array($_result);
		return $_row;
	}
	return false;
}

$email_html_template='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<meta charset="UTF-8">
		<meta content="width=device-width, initial-scale=1" name="viewport">
		<meta name="x-apple-disable-message-reformatting">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="telephone=no" name="format-detection">
		<title></title>
		<link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,700,700i" rel="stylesheet">
	</head>
	<body>
		<div class="es-wrapper-color">
			<table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0">
				<tbody>
					<tr> 
						<td class="esd-email-paddings st-br" valign="top">
							<table cellpadding="0" cellspacing="0" class="es-header esd-header-popover" align="center">
								<tbody>
									<tr>
										<td class="esd-stripe esd-checked" align="center" style="background-image:url(https://fhficc.stripocdn.email/content/guids/CABINET_d21e6d1c5a6807d34e1eb6c59a588198/images/20841560930387653.jpg);background-color: transparent; background-position: center bottom; background-repeat: no-repeat;" bgcolor="transparent" background="https://fhficc.stripocdn.email/content/guids/CABINET_d21e6d1c5a6807d34e1eb6c59a588198/images/20841560930387653.jpg">
											<div style="max-height:80px;">
												<table bgcolor="transparent" class="es-header-body" align="center" cellpadding="0" cellspacing="0" width="600" style="background-color: transparent;">
													<tbody>
														<tr>
															<td class="esd-structure es-p20t es-p20r es-p20l es-p20b" align="left">
																<table cellpadding="0" cellspacing="0" width="100%">
																	<tbody>
																		<tr>
																			<td width="560" class="esd-container-frame" align="center" valign="top">
																				<table cellpadding="0" cellspacing="0" width="100%">
																					<tbody>
																						<tr>
																							<td align="center" class="esd-block-image">
																								<a target="_blank" href="'.base_url.'" style="text-decoration:none;">
																									<h1 style="color:#fff">RopeYou</h1>
																									<h3 style="color:#337ab7;margin-top: -20px;">Watch your success grow</h3>
																								</a>
																							</td>
																						</tr>
																						<tr>
																							<td align="center" class="esd-block-spacer" height="65"></td>
																						</tr>
																					</tbody>
																				</table>
																			</td>
																		</tr>
																	</tbody>
																</table>
															</td>
														</tr>
													</tbody>
												</table>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
							<table cellpadding="0" cellspacing="0" class="es-content" align="center">
								<tbody>
									<tr>
										<td class="esd-stripe" align="center" bgcolor="transparent" style="background-color: transparent;">
											<table bgcolor="transparent" class="es-content-body" align="center" cellpadding="0" cellspacing="0" width="600" style="background-color: transparent;">
												<tbody>
													<tr>
														<td class="esd-structure es-p30t es-p15b es-p30r es-p30l" align="left" style="border-radius: 10px 10px 0px 0px; background-color: rgb(255, 255, 255); background-position: left bottom;" bgcolor="#ffffff">
															<table cellpadding="0" cellspacing="0" width="100%">
																<tbody>
																	<tr>
																		<td width="540" class="esd-container-frame" align="center" valign="top">
																			<table cellpadding="0" cellspacing="0" width="100%" style="background-position: left bottom;">
																				<tbody>
																					<tr>
																						<td align="center" class="esd-block-text">
																							<h1>Welcome to the RopeYou!</h1>
																						</td>
																					</tr>
																				</tbody>
																			</table>
																		</td>
																	</tr>
																</tbody>
															</table>
														</td>
													</tr>
													<tr>
														<td class="esd-structure es-p5t es-p5b es-p30r es-p30l" align="left" style="border-radius: 0px 0px 10px 10px; background-position: left top; background-color: rgb(255, 255, 255);">
															<table cellpadding="0" cellspacing="0" width="100%">
																<tbody>
																	<tr>
																		<td width="540" class="esd-container-frame" align="center" valign="top">
																			<table cellpadding="0" cellspacing="0" width="100%">
																				<tbody>
																					<tr>
																						<td align="center" class="esd-block-text">
																							<a href="'.base_url.'verify-email?code=RY-CODE&token=RY-USR" style="text-decoration:none;"><button style="height:35px;width:275px;background-color:#333;margin-bottom:10px;border-radius:5px;color:#fff;font-size:20px;"><b>Click To Confirm Email</b></button></a>
																							<br/><b>OR</b><br/>
																							Use <span style="color:green;font-size:20px;"><b>RY-CODE</b></span> for manual confirmation.
																						</td>
																					</tr>
																				</tbody>
																			</table>
																		</td>
																	</tr>
																</tbody>
															</table>
														</td>
													</tr>
													<tr>
														<td class="esd-structure es-p5t es-p5b es-p30r es-p30l" align="left" style="border-radius: 0px 0px 10px 10px; background-position: left top; background-color: rgb(255, 255, 255);">
															<table cellpadding="0" cellspacing="0" width="100%" style="border-top:2px solid #83e837;margin-top:80px;">
																<tbody>
																	<tr>
																		<td width="540" class="esd-container-frame" align="center" valign="top">
																			<table cellpadding="0" cellspacing="0" width="100%">
																				<tbody>
																					<tr>
																						<td align="left" class="esd-block-text">
																						   <h2 style="color:#333;margin-left:20px;">Know RopeYou at a Glance</h2> 
																						</td>
																					</tr>
																					<tr>
																						<td align="left" class="esd-block-text">
																							<ul style="margin-top:-10px;">
																								<li>We are creating the &quot;Bridge&quot; between recruiters and job seekers.</li>
																								<li>Connecting Socially</li>
																								<li>We help users to create and represent their Video CV</li>
																								<li>Globalization of jobs and social configurations.</li>
																							</ul>
																						</td>
																					</tr>
																				</tbody>
																			</table>
																		</td>
																	</tr>
																</tbody>
															</table>
														</td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
								</tbody>
							</table>
							<table cellpadding="0" cellspacing="0" class="esd-footer-popover es-footer" align="center">
								<tbody>
									<tr>
										<td class="esd-stripe esd-checked" align="center" style="background-image:url(https://fhficc.stripocdn.email/content/guids/CABINET_d21e6d1c5a6807d34e1eb6c59a588198/images/31751560930679125.jpg);background-position: left bottom; background-repeat: no-repeat;">
											<table bgcolor="#31cb4b" class="es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600">
												<tbody>
													<tr>
														<td class="esd-structure" align="left" style="background-position: left top;">
															<table cellpadding="0" cellspacing="0" width="100%">
																<tbody>
																	<tr>
																		<td width="600" class="esd-container-frame" align="center" valign="top">
																			<table cellpadding="0" cellspacing="0" width="100%">
																				<tbody>
																					<tr>
																						<td align="center" class="esd-block-spacer" height="40"><h3>&copy; 2019 RopeYou Connects</h3></td>
																					</tr>
																				</tbody>
																			</table>
																		</td>
																	</tr>
																</tbody>
															</table>
														</td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</body>
</html>';
define("email_html",$email_html_template);
define("email_html_1",$email_html_template);
?>