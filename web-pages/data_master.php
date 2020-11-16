<?php
	include_once '../connection.php';
	define("base_url","https://ropeyou.com/");
	define("resume_dir","web-pages/");
	define("sub_dir_simple","web-pages/simple/");
	$_WEB_AUTHOR_ABOUT="";
	$_WEB_MENU=array();
	$_WEB_EXP=array();
	$_WEB_EDU=array();
	$_WEB_COLOR=false;
	$_WEB_THEME=false;
	$_WEB_TEMPLATE_ID="1/";
	$_username=$_REQUEST['__username'];
	$_id=null;
	$_users_query="SELECT * FROM users WHERE username='".$_username."'";
	$_users_result=$conn->query($_users_query);
	if(!mysqli_num_rows($_users_result)>0)
	{
		include_once '../404.php';
		die();
	}
	$_users_row=mysqli_fetch_array($_users_result);
	$_id=$_users_row['id'];
	/*------------------------ThemeInfo--------------------------------------------------------
	=========================================================================================*/
	$_theme_selected=false;
	$_theme_color_selected=false;
	$_theme_settings_query="SELECT * FROM users_web_theme_settings WHERE user_id='$_id'";
	$_theme_settings_result=$conn->query($_theme_settings_query);
	if(mysqli_num_rows($_theme_settings_result)>0)
	{
		$_theme_settings_row=mysqli_fetch_array($_theme_settings_result);
		$_theme_selected=$_theme_settings_row['theme_id'];
		$_theme_color_selected=$_theme_settings_row['color_id'];
	}
	if(!$_theme_selected)
	{
		$_theme_query="SELECT * FROM web_themes WHERE status=1 AND is_default=1";
		$_theme_result=$conn->query($_theme_query);
		if(mysqli_num_rows($_theme_result))
		{
			$_theme_row=mysqli_fetch_array($_theme_result);
			$_theme_selected=$_theme_row['id'];
			$_WEB_THEME=$_theme_row;
			$_color_query="SELECT * FROM web_themes_colors WHERE status=1 AND theme_id='$_theme_selected' AND is_default=1";
			$_color_result=$conn->query($_color_query);
			if(mysqli_num_rows($_color_result))
			{
				$_color_row=mysqli_fetch_array($_color_result);
				$_theme_color_selected=$_color_row['id'];
				$_WEB_COLOR=$_color_row;
			}
			else
			{
				$_color_query="SELECT * FROM web_themes_colors WHERE id=1";
				$_color_result=$conn->query($_color_query);
				$_color_row=mysqli_fetch_array($_color_result);
				$_WEB_COLOR=$_color_row;
				$_theme_color_selected=1;
			}
		}
	}
	else
	{
		$_theme_query="SELECT * FROM web_themes WHERE id='$_theme_selected'";
		$_theme_result=$conn->query($_theme_query);
		$_theme_row=mysqli_fetch_array($_theme_result);
		$_WEB_THEME=$_theme_row;
		
		$_color_query="SELECT * FROM web_themes_colors WHERE id='$_theme_color_selected'";
		$_color_result=$conn->query($_color_query);
		$_color_row=mysqli_fetch_array($_color_result);
		$_WEB_COLOR=$_color_row;
	}
	$_WEB_TEMPLATE_ID=$_theme_selected."/";
	$_THEME_BASE_URL=base_url.sub_dir_simple.$_WEB_TEMPLATE_ID;
	$_THEME_DEFAULT_CSS=$_WEB_COLOR['style_name'];
	/*------------------------/////////////////////ThemeInfo------------------------------------
	==========================================================================================*/
	$_WEB_INTRO_STATEMENT="FEATURING";
	$_WEB_TITLE=$_users_row['first_name']." "."".$_users_row['last_name']."@ROPEYOU CONNECTS"; //"ASHOK K. PACHAURY @ROPEYOU CONNECTS";
	$_WEB_AUTHOR=$_users_row['first_name']." "."".$_users_row['last_name'];
	$_WEB_DESIGNATION="Blogger, Poet, Software Developer";
	$_WEB_AUTHOR_IMAGE=getUserProfileImage($_id);
	
	$_users_personal_query="SELECT * FROM users_personal WHERE user_id='$_id'";
	$_users_personal_result=$conn->query($_users_personal_query);
	if(mysqli_num_rows($_users_personal_result)>0)
	{
		$_users_personal_row=mysqli_fetch_array($_users_personal_result);
		$_WEB_AUTHOR_ABOUT=$_users_personal_row['about'];
		$_WEB_MENU[]=array("url"=>"header","text"=>"Professional Summery","small_text"=>"about");
	}
	
	$_users_exp_query="SELECT * FROM users_work_experience WHERE user_id='$_id' ORDER BY from_month DESC,from_year DESC";
	$_users_exp_result=$conn->query($_users_exp_query);
	if(mysqli_num_rows($_users_exp_result)>0)
	{
		while($_users_exp_row=mysqli_fetch_array($_users_exp_result))
		{
			$_experience=array();
			$_designations=designations($_users_exp_row['title'],false,false,false);
			$_designation=$_designations[0];
			if(!empty($_designation))
			{
				$_experience['designation']=$_designation;
			}
			$_companies=companies($_users_exp_row['company'],false,false,false,false);
			$_company=$_companies[0];
			if(!empty($_company))
			{
				$_cities=city($_company['city'],false,false,false,false);
				$_city=$_cities[0];
				if(!empty($_city))
				{
					$_states=state($_city['state'],false,false,false);
					$_state=$_states[0];
					if(empty($_state))
					{
						$_state=false;
					}
					$_countries=country($_city['country'],false,false,false);
					$_country=$_countries[0];
					if(empty($_country))
					{
						$_country=false;
					}
					$_city['state']=$_state;
					$_city['country']=$_country;
				}
				else
				{
					$_city=false;
				}
				$_company['city']=$_city;
				$_experience['company']=$_company;
			}
			$_duration=false;
			$_from_month=print_month($_users_exp_row['from_month']);
			$_from_year=$_users_exp_row['from_year'];
			$_working=$_users_exp_row['working'];
			
			$_to_month=print_month($_users_exp_row['to_month']);
			$_to_year=$_users_exp_row['to_year'];
			
			if($_from_month)
			{
				$_duration.=$_from_month.", ".$_from_year." - ";
				if($_working=="1")
				{
					$_duration.="Present";
				}
				else
				{
					if($_to_month)
					{
						$_duration.=$_to_month.", ".$_to_year;
					}
					else{
						$_duration.="Present";
					}
				}
			}
			
			$_experience['duration']=$_duration;
			$_experience['description']=$_users_exp_row['description'];
			$_experience['added']=$_users_exp_row['added'];
			$_WEB_EXP[]=$_experience;
		}
		$_WEB_MENU[]=array("url"=>"experience","text"=>"Experience","small_text"=>"experience");
	}
	
	$_WEB_CV=getUserResume($_id);
	//************************Education
	$_users_edu_query="SELECT * FROM users_education WHERE user_id='$_id' ORDER BY from_month DESC,from_year DESC";
	$_users_edu_result=$conn->query($_users_edu_query);
	if(mysqli_num_rows($_users_edu_result)>0)
	{
		while($_users_edu_row=mysqli_fetch_array($_users_edu_result))
		{
			$_education=array();
			$_courses=courses($_users_edu_row['title'],false,false,false);
			$_course=$_courses[0];
			if(!empty($_course))
			{
				$_education['course']=$_course;
			}
			$_universities=universities($_users_edu_row['university'],false,false,false,false);
			$_university=$_universities[0];
			if(!empty($_university))
			{
				$_cities=city($_university['city'],false,false,false,false);
				$_city=$_cities[0];
				if(!empty($_city))
				{
					$_states=state($_city['state'],false,false,false);
					$_state=$_states[0];
					if(empty($_state))
					{
						$_state=false;
					}
					$_countries=country($_city['country'],false,false,false);
					$_country=$_countries[0];
					if(empty($_country))
					{
						$_country=false;
					}
					$_city['state']=$_state;
					$_city['country']=$_country;
				}
				else
				{
					$_city=false;
				}
				$_university['city']=$_city;
				$_education['university']=$_university;
			}
			$_duration=false;
			$_from_month=print_month($_users_edu_row['from_month']);
			$_from_year=$_users_edu_row['from_year'];
			$_working=$_users_edu_row['working'];
			
			$_to_month=print_month($_users_edu_row['to_month']);
			$_to_year=$_users_edu_row['to_year'];
			
			if($_from_month)
			{
				$_duration.=$_from_month.", ".$_from_year." - ";
				if($_working=="1")
				{
					$_duration.="Present";
				}
				else
				{
					if($_to_month)
					{
						$_duration.=$_to_month.", ".$_to_year;
					}
					else{
						$_duration.="Present";
					}
				}
			}
			
			$_education['duration']=$_duration;
			$_education['description']=$_users_edu_row['description'];
			$_education['added']=$_users_edu_row['added'];
			$_WEB_EDU[]=$_education;
		}
		$_WEB_MENU[]=array("url"=>"education","text"=>"Education","small_text"=>"education");
	}
	//*************************Professional Skills
	$_professional_skills=professional_skills($_id);
	$_personal_skills=personal_skills($_id);
	$_languages=languages($_id);
	if($_languages || $_personal_skills || $_professional_skills)
	{
		$_WEB_MENU[]=array("url"=>"skills","text"=>"Skills","small_text"=>"skills");
	}
	//***********************************Services
	$_WEB_SERVICES=array();
	$services_query="SELECT * FROM users_services WHERE user_id='$_id'";
	$services_result=$conn->query($services_query);
	if(mysqli_num_rows($services_result)>0)
	{
		$_WEB_MENU[]=array("url"=>"services","text"=>"Services","small_text"=>"services");
		while($services_row=mysqli_fetch_array($services_result)){
			$_arr=array();
			$services_media_query="SELECT media_file FROM users_service_media WHERE service_id='".$services_row['id']."'";
			$services_media_result=mysqli_query($conn,$services_media_query);
			$media=array();
			if(mysqli_num_rows($services_media_result)>0)
			{
				while($services_media_row=mysqli_fetch_array($services_media_result))
				{
					$media[]=getMediaByID($services_media_row['media_file']);
				}
			}
			$_arr['services']=$services_row;
			$_arr['services_media']=$media;
			$_WEB_SERVICES[]=$_arr;
		}
	}
	//***********************************Portfolio
	$_WEB_PORTFOLIOS=array();
	$services_query="SELECT * FROM users_portfolios WHERE user_id='$_id'";
	$services_result=$conn->query($services_query);
	if(mysqli_num_rows($services_result)>0)
	{
		
		$_WEB_MENU[]=array("url"=>"portfolios","text"=>"Portfolios","small_text"=>"portfolios");
		while($services_row=mysqli_fetch_array($services_result)){
			$_arr=array();
			$services_media_query="SELECT media_file FROM users_portfolio_media WHERE portfolio_id='".$services_row['id']."'";
			$services_media_result=mysqli_query($conn,$services_media_query);
			$media=array();
			if(mysqli_num_rows($services_media_result)>0)
			{
				while($services_media_row=mysqli_fetch_array($services_media_result))
				{
					$media[]=getMediaByID($services_media_row['media_file']);
				}
			}
			$_arr['portfolios']=$services_row;
			$_arr['portfolios_media']=$media;
			$_WEB_PORTFOLIOS[]=$_arr;
		}
	}
	//***********************************Acheivements
	$_WEB_AWARDS=array();
	$services_query="SELECT * FROM users_awards WHERE user_id='$_id'";
	$services_result=$conn->query($services_query);
	if(mysqli_num_rows($services_result)>0)
	{
		
		$_WEB_MENU[]=array("url"=>"achievement","text"=>"Acheivements","small_text"=>"achievement");
		while($services_row=mysqli_fetch_array($services_result)){
			$_arr=array();
			$services_media_query="SELECT media_file FROM users_award_media WHERE award_id='".$services_row['id']."'";
			$services_media_result=mysqli_query($conn,$services_media_query);
			$media=array();
			if(mysqli_num_rows($services_media_result)>0)
			{
				while($services_media_row=mysqli_fetch_array($services_media_result))
				{
					$media[]=getMediaByID($services_media_row['media_file']);
				}
			}
			$_arr['awards']=$services_row;
			$_arr['awards_media']=$media;
			$_WEB_AWARDS[]=$_arr;
		}
	}
	//***********************************Clients
	$_WEB_CLIENTS=array();
	$services_query="SELECT * FROM users_clients WHERE user_id='$_id'";
	$services_result=$conn->query($services_query);
	if(mysqli_num_rows($services_result)>0)
	{
		
		$_WEB_MENU[]=array("url"=>"clients","text"=>"Clients","small_text"=>"clients");
		while($services_row=mysqli_fetch_array($services_result)){
			$_arr=array();
			$services_media_query="SELECT media_file FROM users_client_media WHERE client_id='".$services_row['id']."'";
			$services_media_result=mysqli_query($conn,$services_media_query);
			$media=array();
			if(mysqli_num_rows($services_media_result)>0)
			{
				while($services_media_row=mysqli_fetch_array($services_media_result))
				{
					$media[]=getMediaByID($services_media_row['media_file']);
				}
			}
			$_arr['clients']=$services_row;
			$_arr['clients_media']=$media;
			$_WEB_CLIENTS[]=$_arr;
		}
	}
	//***********************************Interests
	$_WEB_INTERESTS=array();
	$services_query="SELECT * FROM users_interests WHERE user_id='$_id'";
	$services_result=$conn->query($services_query);
	if(mysqli_num_rows($services_result)>0)
	{
		$_WEB_MENU[]=array("url"=>"interest","text"=>"Interests","small_text"=>"interests");
		while($services_row=mysqli_fetch_array($services_result)){
			$_arr=array();
			$_arr['interests']=$services_row;
			$int_id=$services_row['title'];
			$int_query="SELECT * FROM interests WHERE id='$int_id'";
			$int_result=$conn->query($int_query);
			if(mysqli_num_rows($int_result)>0)
			{
				$int_row=mysqli_fetch_array($int_result);
				$_arr['interests']['title']=$int_row['title'];
			}
			$_WEB_INTERESTS[]=$_arr;
		}
	}
	//***********************************Blogs
	$_WEB_BLOGS=array();
	$services_query="SELECT * FROM users_blogs WHERE user_id='$_id'";
	$services_result=$conn->query($services_query);
	if(mysqli_num_rows($services_result)>0)
	{
		
		$_WEB_MENU[]=array("url"=>"blog","text"=>"From Blogs","small_text"=>"blog");
		while($services_row=mysqli_fetch_array($services_result)){
			$_arr=array();
			/*$services_media_query="SELECT media_file FROM users_client_media WHERE client_id='".$services_row['id']."'";
			$services_media_result=mysqli_query($conn,$services_media_query);
			$media=array();
			if(mysqli_num_rows($services_media_result)>0)
			{
				while($services_media_row=mysqli_fetch_array($services_media_result))
				{
					$media[]=getMediaByID($services_media_row['media_file']);
				}
			}*/
			$_arr['blogs']=$services_row;
			//$_arr['clients_media']=$media;
			$_WEB_BLOGS[]=$_arr;
		}
	}
	
	/*================== CORE FUNCTIONS =====================================*/
	
	function getThemeHead($_THEME_BASE_URL,$_THEME_DEFAULT_CSS)
	{
		$_HTML=file_get_contents($_THEME_BASE_URL."theme-head.html");
		$_HTML=str_replace("{{_THEME_BASE_URL}}",$_THEME_BASE_URL,$_HTML);
		$_HTML=str_replace("{{_THEME_DEFAULT_CSS}}",$_THEME_DEFAULT_CSS,$_HTML);
		return $_HTML;
	}
	function getThemeLoader($_THEME_BASE_URL,$_WEB_INTRO_STATEMENT,$_WEB_AUTHOR)
	{
		$_HTML=file_get_contents($_THEME_BASE_URL."theme-loader.html");
		$_HTML=str_replace("{{_WEB_INTRO_STATEMENT}}",$_WEB_INTRO_STATEMENT,$_HTML);
		$_HTML=str_replace("{{_WEB_AUTHOR}}",$_WEB_AUTHOR,$_HTML);
		return $_HTML;
	}
	function getThemeFooter($_BASE_URL,$_THEME_BASE_URL)
	{
		$_HTML=file_get_contents($_THEME_BASE_URL."theme-footer.html");
		$_HTML=str_replace("{{_THEME_BASE_URL}}",$_THEME_BASE_URL,$_HTML);
		$_HTML=str_replace("{{_BASE_URL}}",$_BASE_URL,$_HTML);
		return $_HTML;
	}
	function getThemeHeader($_THEME_BASE_URL,$_WEB_DESIGNATION,$_WEB_AUTHOR,$_WEB_AUTHOR_IMAGE,$_WEB_MENU)
	{
		$_HTML=file_get_contents($_THEME_BASE_URL."theme-header.html");
		$_HTML=str_replace("{{_THEME_BASE_URL}}",$_THEME_BASE_URL,$_HTML);
		$_HTML=str_replace("{{_BASE_URL}}",$_BASE_URL,$_HTML);
		return $_HTML;
	}
?>