<!DOCTYPE html>
<html lang="en">
   <head>
		<?php include_once 'head_without_session.php'; ?>
		<?php
			$month_string_array=array("01"=>"Jan","02"=>"Feb","03"=>"Mar","04"=>"Apr","05"=>"May","06"=>"Jun","07"=>"Jul","08"=>"Aug","09"=>"Sep","10"=>"Oct","11"=>"Nov","12"=>"Dec");
			if(isset($_REQUEST['action']) && $_REQUEST['action']!="")
			{
				$action=$_REQUEST['action'];
				$target=$_REQUEST['target'];
				$token=$_REQUEST['token'];
				$type=$_REQUEST['type'];
				if($action=="delete")
				{
					if($target=="exp" && $type=="resume")
					{
						$query="DELETE FROM resume_experiences WHERE id='$token' AND creator_id='".$_COOKIE['creator_id']."'";
						if(mysqli_query($conn,$query))
						{
							?>
							<script>
								window.location.href="<?php echo base_url; ?>provide-resume-information.php";
							</script>
							<?php
						}
						else
						{
							?>
							<script>
								alert('It seems like, this action has been expired.');
								window.location.href="<?php echo base_url; ?>provide-resume-information.php";
							</script>
							<?php
						}
					}
					else if($target=="exp" && $type=="profile")
					{
						$query="UPDATE users_work_experience SET include_in_resume=0 WHERE id='$token' AND user_id='".$_COOKIE['uid']."' AND include_in_resume=1";
						if(mysqli_query($conn,$query))
						{
							?>
							<script>
								window.location.href="<?php echo base_url; ?>provide-resume-information.php";
							</script>
							<?php
						}
						else
						{
							?>
							<script>
								alert('It seems like, this action has been expired.');
								window.location.href="<?php echo base_url; ?>provide-resume-information.php";
							</script>
							<?php
						}
					}
					else if($target=="edu" && $type=="resume")
					{
						$query="DELETE FROM resume_education WHERE id='$token' AND creator_id='".$_COOKIE['creator_id']."'";
						if(mysqli_query($conn,$query))
						{
							?>
							<script>
								window.location.href="<?php echo base_url; ?>provide-resume-information.php";
							</script>
							<?php
						}
						else
						{
							?>
							<script>
								alert('It seems like, this action has been expired.');
								window.location.href="<?php echo base_url; ?>provide-resume-information.php";
							</script>
							<?php
						}
					}
					else if($target=="edu" && $type=="profile")
					{
						$query="UPDATE users_education SET include_in_resume=0 WHERE id='$token' AND user_id='".$_COOKIE['uid']."' AND include_in_resume=1";
						if(mysqli_query($conn,$query))
						{
							?>
							<script>
								window.location.href="<?php echo base_url; ?>provide-resume-information.php";
							</script>
							<?php
						}
						else
						{
							?>
							<script>
								alert('It seems like, this action has been expired.');
								window.location.href="<?php echo base_url; ?>provide-resume-information.php";
							</script>
							<?php
						}
					}
					else if($target=="skills" && $type=="resume")
					{
						$query="DELETE FROM resume_skills WHERE id='$token' AND creator_id='".$_COOKIE['creator_id']."'";
						if(mysqli_query($conn,$query))
						{
							?>
							<script>
								window.location.href="<?php echo base_url; ?>provide-resume-information.php";
							</script>
							<?php
						}
						else
						{
							?>
							<script>
								alert('It seems like, this action has been expired.');
								window.location.href="<?php echo base_url; ?>provide-resume-information.php";
							</script>
							<?php
						}
					}
					else if($target=="skills" && $type=="profile")
					{
						$query="UPDATE users_skills SET include_in_resume=0 WHERE id='$token' AND user_id='".$_COOKIE['uid']."' AND include_in_resume=1";
						if(mysqli_query($conn,$query))
						{
							?>
							<script>
								window.location.href="<?php echo base_url; ?>provide-resume-information.php";
							</script>
							<?php
						}
						else
						{
							?>
							<script>
								alert('It seems like, this action has been expired.');
								window.location.href="<?php echo base_url; ?>provide-resume-information.php";
							</script>
							<?php
						}
					}
					else if($target=="interests" && $type=="resume")
					{
						$query="DELETE FROM resume_interests WHERE id='$token' AND creator_id='".$_COOKIE['creator_id']."'";
						if(mysqli_query($conn,$query))
						{
							?>
							<script>
								window.location.href="<?php echo base_url; ?>provide-resume-information.php";
							</script>
							<?php
						}
						else
						{
							?>
							<script>
								alert('It seems like, this action has been expired.');
								window.location.href="<?php echo base_url; ?>provide-resume-information.php";
							</script>
							<?php
						}
					}
					else if($target=="interests" && $type=="profile")
					{
						$query="UPDATE users_interests SET include_in_resume=0 WHERE id='$token' AND user_id='".$_COOKIE['uid']."' AND include_in_resume=1";
						if(mysqli_query($conn,$query))
						{
							?>
							<script>
								window.location.href="<?php echo base_url; ?>provide-resume-information.php";
							</script>
							<?php
						}
						else
						{
							?>
							<script>
								alert('It seems like, this action has been expired.');
								window.location.href="<?php echo base_url; ?>provide-resume-information.php";
							</script>
							<?php
						}
					}
				}
			}
			if(isset($_REQUEST['resume_id']) && $_REQUEST['resume_id']!="")
			{
				$resume_id=$_REQUEST['resume_id'];
				$resume_time="time_".time();
				if(isset($_COOKIE['uid']) && $_COOKIE['uid']!="")
				{
					$resume_time=$_COOKIE['uid'];
				}
				else
				{
					if(isset($_COOKIE['resume_time']) && $_COOKIE['resume_time']!="")
					{
						$resume_time=$_COOKIE['resume_time'];
					}
					else
					{
						setcookie("resume_time",$resume_time,time()+(30*24*60*60),"/",".ropeyou.com");
					}
				}
				$check_query="SELECT * FROM resume_creator WHERE user_id='$resume_time'";
				$check_result=mysqli_query($conn,$check_query);
				if(mysqli_num_rows($check_result)>0)
				{
					$check_row=mysqli_fetch_array($check_result);
					$creator_id=$check_row['id'];
					setcookie("creator_id",$creator_id,time()+(30*24*60*60),"/",".ropeyou.com");
					$insert_query="UPDATE resume_creator SET resume_id='$resume_id',added=NOW() WHERE id='$creator_id'";
					mysqli_query($conn,$insert_query);
				}
				else
				{
					$insert_query="INSERT INTO resume_creator SET resume_id='$resume_id',user_id='$resume_time',added=NOW()";
					$insert_result=mysqli_query($conn,$insert_query);
					$creator_id=mysqli_insert_id($conn);
					setcookie("creator_id",$creator_id,time()+(30*24*60*60),"/",".ropeyou.com");
					?>
					<script>
						window.location.href="<?php echo base_url; ?>provide-resume-information.php";
					</script>
					<?php
				}
			}
			else
			{
				if(isset($_COOKIE['creator_id']) && $_COOKIE['creator_id']!="")
				{
					$creator_id=$_COOKIE['creator_id'];
				}
				else
				{
					?>
					<script>
						window.location.href="<?php echo base_url; ?>create-resume";
					</script>
					<?php
				}
			}
		?>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
		<title>Create your resume | RopeYou Connects</title>
	</head>
	<body>
		<?php include_once 'header.php'; ?>
		<?php
			if(isset($_REQUEST['reload']) && $_REQUEST['reload']!="")
			{
				$resume_step=$_REQUEST['step'];
				$experiences=array();
				$extra="";
				$creator_id=$_COOKIE['creator_id'];
				mysqli_query($conn,"UPDATE resume_creator SET ".$extra."resume_step='$resume_step' WHERE id='$creator_id'");
				?>
				<script>
					window.location.href="<?php echo base_url; ?>provide-resume-information.php";
				</script>
				<?php
			}
			$resume_step=1;
			$creator_id=$_COOKIE['creator_id'];
			if(isset($_POST['save_step_1']))
			{
				$first_name=addslashes(filter_var($_POST['first_name'],FILTER_SANITIZE_STRING));
				$last_name=addslashes(filter_var($_POST['last_name'],FILTER_SANITIZE_STRING));
				$email=addslashes(filter_var($_POST['email'],FILTER_SANITIZE_EMAIL));
				$mobile=addslashes(filter_var($_POST['mobile'],FILTER_SANITIZE_STRING));
				$website=addslashes(filter_var($_POST['website'],FILTER_SANITIZE_STRING));
				$passport=addslashes(filter_var($_POST['passport'],FILTER_SANITIZE_STRING));
				$relocation=addslashes(filter_var($_POST['relocation'],FILTER_SANITIZE_STRING));
				$profile_title=addslashes(filter_var($_POST['profile_title'],FILTER_SANITIZE_STRING));
				$user_id=null;
				if(isset($_COOKIE['uid']) && $_COOKIE['uid']!="")
				{
					$user_id=$_COOKIE['uid'];
				}
				else
				{
					$username=generateUniqueUserName($email);
					$check_query="SELECT * FROM users WHERE email='$email' OR mobile='$mobile'";
					$check_result=mysqli_query($conn,$check_query);
					if(mysqli_num_rows($check_result)>0)
					{
						$check_row=mysqli_fetch_array($check_result);
						$user_id=$check_row['id'];
					}
					else
					{
						$user_insert_query="INSERT INTO users SET first_name='$first_name',last_name='$last_name',email='$email',mobile='$mobile',profile_title='$profile_title',username='$username',status=1,added=NOW(),role='RY_USER',validated=0";
						if($user_insert_result=mysqli_query($conn,$user_insert_query))
						{
							$user_id=mysqli_insert_id($conn);
						}
						else
						{
							echo $user_insert_query;die();
							?>
							<script>
								alert('something went wrong.please contact developer.');
								window.location.href="<?php echo base_url; ?>provide-resume-information.php";
							</script>
							<?php
							die();
						}
					}
				}
				$query="UPDATE resume_creator SET user_id='$user_id',relocation='$relocation',passport='$passport',first_name='$first_name',last_name='$last_name',email='$email',mobile='$mobile',website='$website',profile_title='$profile_title',resume_step=2 WHERE id='$creator_id'";
				if(mysqli_query($conn,$query))
				{
					setcookie("resume_time",$user_id,time()+(30*24*60*60),"/",".ropeyou.com");
					?>
					<script>
						window.location.href="<?php echo base_url; ?>provide-resume-information.php";
					</script>
					<?php
					die();
				}
				else
				{
					
					?>
					<script>
						alert('something went wrong.please contact developer.');
						window.location.href="<?php echo base_url; ?>provide-resume-information.php";
					</script>
					<?php
					die();
				}
			}
			if(isset($_POST['save_step_2']))
			{
				$creator_id=$_COOKIE['creator_id'];
				$about=htmlspecialchars(addslashes(trim($_POST['about'])));
				$show_pref=$_POST['show_pref'];
				$resume_step=3;
				$query="UPDATE resume_creator SET about='$about',resume_step=3 WHERE id='$creator_id'";
				if(mysqli_query($conn,$query))
				{
					if($show_pref=="1")
					{
						$query="SELECT * FROM users_personal WHERE user_id='".$_COOKIE['uid']."'";
						$result_chk=mysqli_query($conn,$query);
						if(mysqli_num_rows($result_chk)>0)
						{
							$query="UPDATE users_personal SET about='$about' WHERE user_id='".$_COOKIE['uid']."'";
						}
						else
						{
							$query="INSERT INTO users_personal SET about='$about',user_id='".$_COOKIE['uid']."'";
						}
						mysqli_query($conn,$query);
					}
					?>
					<script>
						window.location.href="<?php echo base_url; ?>provide-resume-information.php";
					</script>
					<?php
					die();
				}
				else
				{
					?>
					<script>
						alert('something went wrong.please contact developer.');
						window.location.href="<?php echo base_url; ?>provide-resume-information.php";
					</script>
					<?php
					die();
				}
			}
			if(isset($_POST['save_step_3']))
			{
				$creator_id=$_COOKIE['creator_id'];
				$creator_exp_id=false;
				if(isset($_POST['creator_exp_id']) && $_POST['creator_exp_id']!="")
				{
					$creator_exp_id=$_POST['creator_exp_id'];
				}
				$designations=addslashes($_POST['title']);
				$companys=addslashes($_POST['company']);
				$locations=addslashes($_POST['location']);
				$from_months=addslashes($_POST['from_month']);
				$to_months=addslashes($_POST['to_month']);
				$from_years=addslashes($_POST['from_year']);
				$to_years=addslashes($_POST['to_year']);
				$descriptions=htmlspecialchars(addslashes(trim($_POST['description'])));
				$workings=addslashes($_POST['working']);
				$show_pref=addslashes($_POST['show_pref']);
				$resume_step=3;
				$query="INSERT INTO resume_experiences SET working='$workings',show_pref='$show_pref',description='$descriptions',to_year='$to_years',from_year='$from_years',to_month='$to_months',creator_id='$creator_id',designation='$designations',company='$companys',location='$locations',from_month='$from_months'";
				if($creator_exp_id)
				{
					$query="UPDATE resume_experiences SET working='$workings',show_pref='$show_pref',description='$descriptions',to_year='$to_years',from_year='$from_years',to_month='$to_months',creator_id='$creator_id',designation='$designations',company='$companys',location='$locations',from_month='$from_months' WHERE id='$creator_exp_id'";
				}
				if(mysqli_query($conn,$query))
				{
					if($show_pref=="1")
					{
						$chk_query="SELECT * FROM users_work_experience WHERE title='$title' AND designation='$designations' AND company='$companys'";
						$chk_result=mysqli_query($conn,$chk_query);
						if(mysqli_num_rows($chk_result)>0)
						{
							$chk_row=mysqli_fetch_array($chk_result);
							mysqli_query($conn,"UPDATE users_work_experience SET working='$workings',show_pref='$show_pref',description='$descriptions',to_year='$to_years',from_year='$from_years',to_month='$to_months',title='$designations',company='$companys',from_month='$from_months',include_in_resume=1 WHERE id='".$chk_row['id']."'");
						}
						else
						{
							$query="INSERT INTO users_work_experience SET user_id='".$_COOKIE['uid']."',working='$workings',show_pref='$show_pref',description='$descriptions',to_year='$to_years',from_year='$from_years',to_month='$to_months',title='$designations',company='$companys',from_month='$from_months',include_in_resume=1,added=NOW()";
							mysqli_query($conn,$query);
							//echo $query;die();
						}
					}
					$query="UPDATE resume_creator SET resume_step='$resume_step' WHERE id='$creator_id'";
					mysqli_query($conn,$query);
					?>
					<script>
						window.location.href="<?php echo base_url; ?>provide-resume-information.php";
					</script>
					<?php
					die();
				}
				else
				{
					echo $query;die();
					?>
					<script>
						alert('something went wrong.please contact developer.');
						window.location.href="<?php echo base_url; ?>provide-resume-information.php";
					</script>
					<?php
					die();
				}
			}
			if(isset($_POST['save_step_4']))
			{
				$creator_id=$_COOKIE['creator_id'];
				$creator_edu_id=false;
				if(isset($_POST['creator_edu_id']) && $_POST['creator_edu_id']!="")
				{
					$creator_edu_id=$_POST['creator_edu_id'];
				}
				$designations=addslashes($_POST['title']);
				$university=addslashes($_POST['university']);
				$locations=addslashes($_POST['location']);
				$from_months=addslashes($_POST['from_month']);
				$to_months=addslashes($_POST['to_month']);
				$from_years=addslashes($_POST['from_year']);
				$to_years=addslashes($_POST['to_year']);
				$descriptions=htmlspecialchars(addslashes(trim($_POST['description'])));
				$studying=addslashes($_POST['studying']);
				$show_pref=addslashes($_POST['show_pref']);
				$resume_step=4;
				$query="INSERT INTO resume_education SET studying='$studying',description='$descriptions',to_year='$to_years',from_year='$from_years',to_month='$to_months',creator_id='$creator_id',course='$designations',university='$university',location='$locations',from_month='$from_months',show_pref='$show_pref'";
				if($creator_edu_id)
				{
					$query="UPDATE resume_education SET studying='$studying',description='$descriptions',to_year='$to_years',from_year='$from_years',to_month='$to_months',creator_id='$creator_id',course='$designations',university='$university',location='$locations',from_month='$from_months',show_pref='$show_pref' WHERE id='$creator_edu_id'";
				}
				if(mysqli_query($conn,$query))
				{
					if($show_pref=="1")
					{
						$chk_query="SELECT * FROM users_education WHERE title='$title' AND university='$university'";
						$chk_result=mysqli_query($conn,$chk_query);
						if(mysqli_num_rows($chk_result)>0)
						{
							$chk_row=mysqli_fetch_array($chk_result);
							mysqli_query($conn,"UPDATE users_education SET show_pref='$show_pref',studying='$studying',description='$descriptions',to_year='$to_years',from_year='$from_years',to_month='$to_months',title='$designations',university='$university',from_month='$from_months',show_pref='$show_pref',status=1,include_in_resume=1 WHERE id='".$chk_row['id']."'");
						}
						else
						{
							mysqli_query($conn,"INSERT INTO users_education SET user_id='".$_COOKIE['uid']."',studying='$studying',description='$descriptions',to_year='$to_years',from_year='$from_years',to_month='$to_months',title='$designations',university='$university',from_month='$from_months',show_pref='$show_pref',status=1,include_in_resume=1");
						}
					}
					$query="UPDATE resume_creator SET resume_step='$resume_step' WHERE id='$creator_id'";
					mysqli_query($conn,$query);
					?>
					<script>
						window.location.href="<?php echo base_url; ?>provide-resume-information.php";
					</script>
					<?php
					die();
				}
				else
				{
					echo $query;die();
					?>
					<script>
						alert('something went wrong.please contact developer.');
						window.location.href="<?php echo base_url; ?>provide-resume-information.php";
					</script>
					<?php
					die();
				}
			}
			if(isset($_POST['save_step_5']))
			{
				$creator_id=$_COOKIE['creator_id'];
				$creator_skill_id=false;
				if(isset($_POST['creator_skill_id']) && $_POST['creator_skill_id']!="")
				{
					$creator_skill_id=$_POST['creator_skill_id'];
				}
				$title=addslashes($_POST['title']);
				$type=addslashes($_POST['type']);
				$proficiency=addslashes($_POST['proficiency']);
				$show_pref=addslashes($_POST['show_pref']);
				$resume_step=5;
				$query="INSERT INTO resume_skills SET title='$title',type='$type',proficiency='$proficiency',show_pref='$show_pref',creator_id='$creator_id'";
				if($creator_skill_id)
				{
					$query="UPDATE resume_skills SET title='$title',type='$type',proficiency='$proficiency',show_pref='$show_pref',creator_id='$creator_id' WHERE id='$creator_skill_id'";
				}
				if(mysqli_query($conn,$query))
				{
					if($show_pref=="1")
					{
						$chk_query="SELECT * FROM users_skills WHERE title='$title'";
						$chk_result=mysqli_query($conn,$chk_query);
						if(mysqli_num_rows($chk_result)>0)
						{
							$chk_row=mysqli_fetch_array($chk_result);
							mysqli_query($conn,"UPDATE users_skills SET title='$title',type='$type',proficiency='$proficiency',show_pref='$show_pref',status=1,include_in_resume=1 WHERE id='".$chk_row['id']."'");
						}
						else
						{
							mysqli_query($conn,"INSERT INTO users_skills SET user_id='".$_COOKIE['uid']."',title='$title',type='$type',proficiency='$proficiency',show_pref='$show_pref',status=1,include_in_resume=1");
						}
					}
					$query="UPDATE resume_creator SET resume_step='$resume_step' WHERE id='$creator_id'";
					mysqli_query($conn,$query);
					?>
					<script>
						window.location.href="<?php echo base_url; ?>provide-resume-information.php";
					</script>
					<?php
					die();
				}
				else
				{
					echo $query;die();
					?>
					<script>
						alert('something went wrong.please contact developer.');
						window.location.href="<?php echo base_url; ?>provide-resume-information.php";
					</script>
					<?php
					die();
				}
			}
			if(isset($_POST['save_step_6']))
			{
				$creator_id=$_COOKIE['creator_id'];
				$creator_interest_id=false;
				if(isset($_POST['creator_interest_id']) && $_POST['creator_interest_id']!="")
				{
					$creator_interest_id=$_POST['creator_interest_id'];
				}
				$title=addslashes($_POST['title']);
				$show_pref=addslashes($_POST['show_pref']);
				$resume_step=6;
				$query="INSERT INTO resume_interests SET title='$title',show_pref='$show_pref',creator_id='$creator_id'";
				if($creator_interest_id)
				{
					$query="UPDATE resume_interests SET title='$title',show_pref='$show_pref',creator_id='$creator_id' WHERE id='$creator_interest_id'";
				}
				if(mysqli_query($conn,$query))
				{
					if($show_pref=="1")
					{
						$chk_query="SELECT * FROM users_interests WHERE title='$title'";
						$chk_result=mysqli_query($conn,$chk_query);
						if(mysqli_num_rows($chk_result)>0)
						{
							$chk_row=mysqli_fetch_array($chk_result);
							mysqli_query($conn,"UPDATE users_interests SET user_id='".$_COOKIE['uid']."',title='$title',show_pref='$show_pref',include_in_resume=1 WHERE id='".$chk_row['id']."'");
						}
						else
						{
							mysqli_query($conn,"INSERT INTO users_interests SET user_id='".$_COOKIE['uid']."',title='$title',show_pref='$show_pref',include_in_resume=1");
						}
					}
					$query="UPDATE resume_creator SET resume_step='$resume_step' WHERE id='$creator_id'";
					mysqli_query($conn,$query);
					?>
					<script>
						window.location.href="<?php echo base_url; ?>provide-resume-information.php";
					</script>
					<?php
					die();
				}
				else
				{
					echo $query;die();
					?>
					<script>
						alert('something went wrong.please contact developer.');
						window.location.href="<?php echo base_url; ?>provide-resume-information.php";
					</script>
					<?php
					die();
				}
			}
			if(isset($_POST['save_step_7']))
			{
				$creator_id=$_COOKIE['creator_id'];
				$creator_certification_id=false;
				if(isset($_POST['creator_certification_id']) && $_POST['creator_certification_id']!="")
				{
					$creator_certification_id=$_POST['creator_certification_id'];
				}
				$title=addslashes($_POST['title']);
				$show_pref=addslashes($_POST['show_pref']);
				$resume_step=7;
				$query="INSERT INTO resume_certifications SET title='$title',show_pref='$show_pref',creator_id='$creator_id'";
				if($creator_certification_id)
				{
					$query="UPDATE resume_certifications SET title='$title',show_pref='$show_pref',creator_id='$creator_id' WHERE id='$creator_certification_id'";
				}
				if(mysqli_query($conn,$query))
				{
					if($show_pref=="1")
					{
						$chk_query="SELECT * FROM users_awards WHERE title='$title'";
						$chk_result=mysqli_query($conn,$chk_query);
						if(mysqli_num_rows($chk_result)>0)
						{
							$chk_row=mysqli_fetch_array($chk_result);
							mysqli_query($conn,"UPDATE users_awards SET title='$title',show_pref='$show_pref',status=1,include_in_resume=1 WHERE id='".$chk_row['id']."'");
						}
						else
						{
							mysqli_query($conn,"INSERT INTO users_awards SET user_id='".$_COOKIE['uid']."',title='$title',show_pref='$show_pref',status=1,include_in_resume=1,added=NOW()");
						}
					}
					$query="UPDATE resume_creator SET resume_step='$resume_step' WHERE id='$creator_id'";
					mysqli_query($conn,$query);
					?>
					<script>
						window.location.href="<?php echo base_url; ?>provide-resume-information.php";
					</script>
					<?php
					die();
				}
				else
				{
					echo $query;die();
					?>
					<script>
						alert('something went wrong.please contact developer.');
						window.location.href="<?php echo base_url; ?>provide-resume-information.php";
					</script>
					<?php
					die();
				}
			}
			if(isset($_POST['save_step_8']))
			{
				$creator_id=$_COOKIE['creator_id'];
				$resume_id=$_POST['resume_id'];
				$creator_certification_id=false;
				if(isset($_POST['creator_certification_id']) && $_POST['creator_certification_id']!="")
				{
					$creator_certification_id=$_POST['creator_certification_id'];
				}
				$include_references=addslashes($_POST['include_references']);
				$additional_description=htmlspecialchars(addslashes(trim($_POST['additional_description'])));
				
				$resume_step=8;
				$query="UPDATE resume_creator SET include_references='$include_references',additional_description='$additional_description',resume_step='$resume_step' WHERE id='$creator_id'";
				if(mysqli_query($conn,$query))
				{
					?>
					<script>
						window.location.href="<?php echo base_url; ?>ambiguity/<?php echo $resume_id; ?>";
					</script>
					<?php
					die();
				}
				else
				{
					echo $query;die();
					?>
					<script>
						alert('something went wrong.please contact developer.');
						window.location.href="<?php echo base_url; ?>provide-resume-information.php";
					</script>
					<?php
					die();
				}
			}
			$user_exists=false;
			$creator_query="SELECT * FROM resume_creator WHERE id='$creator_id'";
			$creator_result=mysqli_query($conn,$creator_query);
			$creator_row=mysqli_fetch_array($creator_result);
			$total_steps=8;
			$resume_step=(int)($creator_row['resume_step']);
			if(!($resume_step<=$total_steps) || !($resume_step>=1))
			{
				$resume_step=1;
			}
		?>
		<div class="container" id="html_controller">
			<div class="row">
				<main class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);transition: box-shadow 83ms;background:#fff;padding:25px 50px 25px;border-radius:2px;margin-top:40px;margin-bottom:10px;">
					<?php
						if($resume_step=="1")
						{
							$Basic=$creator_row;
							if(isset($_COOKIE['uid']) && $_COOKIE['uid']!="")
							{
								$resume_user_id=$_COOKIE['uid'];
								$user_query="SELECT * FROM users WHERE id='$resume_user_id'";
								$user_result=mysqli_query($conn,$user_query);
								if(mysqli_num_rows($user_result)>0)
								{
									$user_exists=true;
								}
								if($user_exists)
								{
									$user_row=mysqli_fetch_array($user_result);
								}
								$user_personal_query="SELECT * FROM users_personal WHERE user_id='$resume_user_id'";
								$user_personal_result=mysqli_query($conn,$user_personal_query);
								$user_personal_row=mysqli_fetch_array($user_personal_result);
								
								$_Basic['first_name']=$user_row['first_name'];
								$_Basic['last_name']=$user_row['last_name'];
								$_Basic['email']=$user_row['email'];
								$_Basic['mobile']=$user_row['mobile'];
								$_Basic['website']=$user_personal_row['website'];
								$_Basic['linkedin']=$user_personal_row['in_p'];
								$_Basic['passport']=$user_personal_row['passport'];
								$relocation=$user_personal_row['relocate_abroad'];
								if($relocation=="0" || $relocation=="")
								{
									$_Basic['relocation']='Can not relocate outside home town';
								}
								else if($relocation=="1")
								{
									$_Basic['relocation']='Can Relocate within home country';
								}
								else
								{
									$_Basic['relocation']='Can Relocate worldwide';
								}
							}
					?>
							<h5 class="pt-3 pr-3 border-bottom mb-0 pb-3">Provide Basic Information.</h5>
							<form action="" method="post" enctype="multipart/form-data"> 
								<div class="row" style="padding-top:30px;">
									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
										<div class="form-group">
											<label>First Name*</label>
											<input type="text" name="first_name" id="first_name" value="<?php if(isset($Basic) && $Basic['first_name']!="") { echo  $Basic['first_name']; } else { echo $_Basic['first_name']; } ?>" placeholder="First Name" class="form-control" required>
										</div>
									</div>
									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
										<div class="form-group">
											<label>Last Name*</label>
											<input type="text" name="last_name" id="last_name" value="<?php if(isset($Basic) && $Basic['last_name']!="") { echo  $Basic['last_name']; } else { echo $_Basic['last_name']; } ?>" placeholder="Last Name" class="form-control" required>
										</div>
									</div>
									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
										<div class="form-group">
											<label>Email*</label>
											<input type="email" name="email" id="email" value="<?php if(isset($Basic) && $Basic['email']!="") { echo  $Basic['email']; } else { echo $_Basic['email']; } ?>" placeholder="Email" class="form-control" required>
										</div>
									</div>
									<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
										<div class="form-group">
											<label>Mobile*</label>
											<input type="text" name="mobile" id="mobile" value="<?php if(isset($Basic) && $Basic['mobile']!="") { echo  $Basic['mobile']; } else { echo $_Basic['mobile']; } ?>" placeholder="Mobile" class="form-control" required>
										</div>
									</div>
									<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
										<div class="form-group">
											<label>Website</label>
											<input type="text" name="website" id="website" value="<?php if(isset($Basic) && $Basic['website']!="") { echo  $Basic['website']; } else { echo $_Basic['website']; } ?>" placeholder="Website" class="form-control">
										</div>
									</div>
									<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
										<div class="form-group">
											<label>Passport Status</label>
											<input type="text" name="passport" id="passport" value="<?php if(isset($Basic) && $Basic['passport']!="") { echo  $Basic['passport']; } else { echo $_Basic['passport']; } ?>" placeholder="Passport Status" class="form-control">
										</div>
									</div>
									<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
										<div class="form-group">
											<label>Relocation Status</label>
											<input type="text" name="relocation" id="relocation" value="<?php if(isset($Basic) && $Basic['relocation']!="") { echo  $Basic['relocation']; } else { echo $_Basic['relocation']; } ?>" placeholder="Relocation Status" class="form-control">
										</div>
									</div>
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
										<div class="form-group">
											<label>Profile Title</label>
											<input type="text" name="profile_title" id="profile_title" value="<?php if(isset($Basic) && $Basic['profile_title']!="") { echo  $Basic['profile_title']; } else { echo $_Basic['profile_title']; } ?>" placeholder="Working as / Looking for" class="form-control">
										</div>
									</div>
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
										<div class="form-group">
											<a class="btn btn-success" style="margin-left:10px;" href="<?php echo base_url; ?>ambiguity/<?php echo $creator_row['resume_id']; ?>" name="skip_to_preview">Preview</a>
											<button class="btn btn-primary pull-right" style="float:right;" type="submit" name="save_step_1">Save & Next</button>
										</div>
									</div>
								</div>
							</form>
					<?php
						}
						else if($resume_step=="2")
						{
							$About=$creator_row;
							if(isset($_COOKIE['uid']) && $_COOKIE['uid']!="")
							{
								$resume_user_id=$_COOKIE['uid'];
								$user_personal_query="SELECT * FROM users_personal WHERE user_id='$resume_user_id'";
								$user_personal_result=mysqli_query($conn,$user_personal_query);
								$user_personal_row=mysqli_fetch_array($user_personal_result);
								$_About['about']=$user_row['about'];
							}
					?>
							<h5 class="pt-3 pr-3 border-bottom mb-0 pb-3">Some description about you.</h5>
							<form action="" method="post" enctype=""> 
								<div class="row" style="padding-top:30px;">
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
										<div class="form-group">
											<input type="checkbox" name="show_pref" id="show_pref" value="1" checked>&nbsp;&nbsp;Add this about information to profile as well?
										</div>
									</div>
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
										<div class="form-group">
											<textarea name="about" style="resize:none;" id="about" placeholder="A sophesticated introduction about your professional stuff." class="form-control"><?php if(isset($About) && $About['about']!="") { echo  htmlspecialchars_decode(stripslashes($About['about'])); } else { echo htmlspecialchars_decode($_About['about']); }  ?></textarea>
										</div>
									</div>
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
										<div class="form-group">
											<a class="btn btn-danger" href="provide-resume-information.php?step=1&reload=force" type="submit" name="save_step_2">Back</a>
											<a class="btn btn-success" style="margin-left:10px;" href="<?php echo base_url; ?>ambiguity/<?php echo $creator_row['resume_id']; ?>" name="skip_to_preview">Preview</a>
											<button class="btn btn-primary pull-right" style="float:right;" type="submit" name="save_step_2">Save & Next</button>
										</div>
									</div>
								</div>
							</form>
							<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
							<script>
								CKEDITOR.replace('about');
							</script>
					<?php
						}
						else if($resume_step=="3")
						{
							$experiences=array();
							$creator_id=$_COOKIE['creator_id'];
							$experience_query="SELECT * FROM resume_experiences WHERE creator_id='$creator_id'";
							$experience_result=mysqli_query($conn,$experience_query);
							if(mysqli_num_rows($experience_result)>0)
							{
								while($experience_row=mysqli_fetch_array($experience_result))
								{
									$experiences[]=$experience_row;
								}
							}
							//print_r($creator_row);
							if(isset($_COOKIE['uid']) && $_COOKIE['uid']!="" && is_null($experiences))
							{
								$resume_user_id=$_COOKIE['uid'];
								$experiences_query="SELECT * FROM users_work_experiences WHERE user_id='$resume_user_id' AND status=1 AND include_in_resume=1";
								$experiences_result=mysqli_query($conn,$experiences_query);
								if(mysqli_num_rows($experiences_result)>0)
								{
									while($experience_row=mysqli_fetch_array($experiences_result))
									{
										$experience=array();
										$experience_id=$experience_row['id'];
										$country_query="SELECT title FROM country WHERE id='".$experience_row['country']."'";
										$country_result=mysqli_query($conn,$country_query);
										$country_row=mysqli_fetch_array($country_result);
										
										$city_query="SELECT title FROM city WHERE id='".$experience_row['city']."'";
										$city_result=mysqli_query($conn,$city_query);
										$city_row=mysqli_fetch_array($city_result);
										
										$experience['exp_id']=$experience_row['id'];
										$experience['title']=$experience_row['title'];
										$experience['company']=$experience_row['company'];
										$experience['from_month']=$experience_row['from_month'];
										$experience['from_year']=$experience_row['from_year'];
										$experience['working']=$experience_row['working'];
										$experience['to_month']=$experience_row['to_month'];
										$experience['to_year']=$experience_row['to_year'];
										$experience['description']=$experience_row['description'];
										$experience['city']=$city_row['city'];
										$experience['country']=$country_row['country'];
										$experiences[]=$experience;
									}
								}
							}
					?>
							
							<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12 col-12" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);margin-top:10px;margin-bottom:10px;padding:10px;">
									<h5>Adding experiences to resume.</h5>
								</div>
								<?php
									if(isset($experiences) && !is_null($experiences))
									{
										$i=1;
										foreach($experiences as $experience)
										{
											if(!(isset($experience['title'])))
											{
												$experience['title']=$experience['designation'];
											}
											?>
											<div class="col-md-12">
												<form action="" method="post" enctype=""> 
													<div class="row">
														<div class="col-md-12 col-sm-12 col-xs-12 col-12" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);margin-top:10px;margin-bottom:10px;padding:10px;">
															<h6><?php echo ucwords(strtolower($experience['title'].' at '.$experience['company'].', '.$experience['location'])); ?>&nbsp;&nbsp;<a href="provide-resume-information.php?action=delete&target=exp&token=<?php if(isset($experience['id']) && $experience['id']!="") { echo $experience['id'].'&type=resume'; } else { echo $experience['exp_id'].'&type=profile'; } ?>" class="pull-right" style="float:right;color:red;" title="Delete Record"><i class="fa fa-trash"></i></a>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="$('#editable_area_<?php echo $i; ?>').toggle('display');$('#add_resume_information').hide();" class="pull-right" style="float:right;margin-right:10px;" title="Edit Record"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;</h6>
														</div>
														<div class="col-md-12 col-sm-12 col-xs-12 col-12 editable_area_section" id="editable_area_<?php echo $i; ?>" style="display:none;box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);">
															<div class="row">
																<div class="col-md-12 col-sm-12 col-xs-12 col-12" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);margin-bottom:10px;padding:10px;">
																	<button class="btn btn-success" type="submit" name="save_step_3">Save current form</button><a href="javascript:void(0);" onclick="$('#editable_area_<?php echo $i; ?>').toggle('display');$('#add_resume_information').hide();" class="btn btn-danger pull-right" style="float:right;" title="Close"><i class="fa fa-times"></i></a>
																	<input type="hidden" name="creator_exp_id" value="<?php if(isset($experience['id']) && $experience['id']!="") { echo $experience['id']; } ?>">
																</div>
																<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
																	<div class="form-group">
																		<label>Designation*</label>
																		<input type="text" required name="title"  value="<?php if(isset($experience) && $experience['title']!="") { echo  $experience['title']; } ?>" placeholder="Designation" class="form-control">
																	</div>
																</div>
																<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
																	<div class="form-group">
																		<label>Company*</label>
																		<input type="text" required name="company" value="<?php if(isset($experience) && $experience['company']!="") { echo  $experience['company']; } ?>" placeholder="Company" class="form-control">
																	</div>
																</div>
																<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
																	<div class="form-group">
																		<label>Location*</label>
																		<input type="text" required name="location" value="<?php if(isset($experience) && $experience['location']!="") { echo  $experience['location']; } ?>" placeholder="City or Location" class="form-control">
																	</div>
																</div>
																<div class="col-md-6 col-xl-6 col-lg-6 col-sm-6 col-12">
																	<div class="row">
																		<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-6">
																			<div class="form-group">
																				<label>From Month*</label>
																				<select id="from_month_<?php echo $i; ?>" class="form-control" name="from_month" required>
																					<option value="">Select</option>
																					<?php
																						for($month_loop=1;$month_loop<=12;$month_loop++)
																						{
																							$month_val_to_print="";
																							if(($month_loop%10)>=1 && $month_loop<10){ $month_val_to_print= '0'.$month_loop; }else{ $month_val_to_print=$month_loop; }
																							?>
																							<option value="<?php echo $month_val_to_print; ?>" <?php if($month_val_to_print==$experience['from_month'] || $experience['from_month']==$month_loop){ echo "selected"; } ?>><?php echo $month_string_array[''.$month_val_to_print]; ?></option>
																							<?php
																						}
																					?>
																				</select>
																			</div>
																		</div>
																		<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-6">
																			<div class="form-group">
																				<label>From Year*</label>
																				<input type="text" name="from_year" value="<?php if(isset($experience) && $experience['from_year']!="") { echo  $experience['from_year']; } ?>" placeholder="e.g - 2007" class="form-control">
																			</div>
																		</div>
																		<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-6">
																			<div class="form-group">
																				<label>To Month</label>
																				<select id="to_month_<?php echo $i; ?>" class="form-control" name="to_month">
																					<option value="">Select</option>
																					<?php
																						for($month_loop=1;$month_loop<=12;$month_loop++)
																						{
																							$month_val_to_print="";
																							if(($month_loop%10)>=1 && $month_loop<10){ $month_val_to_print= '0'.$month_loop; }else{ $month_val_to_print=$month_loop; }
																							?>
																							<option value="<?php echo $month_val_to_print; ?>" <?php if($month_val_to_print==$experience['to_month'] || $experience['to_month']==$month_loop){ echo "selected"; } ?>><?php echo $month_string_array[''.$month_val_to_print]; ?></option>
																							<?php
																						}
																					?>
																				</select>
																			</div>
																		</div>
																		<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-6">
																			<div class="form-group">
																				<label>To Year</label>
																				<input type="text" name="to_year" value="<?php if(isset($experience) && $experience['to_year']!="") { echo  $experience['to_year']; } ?>" placeholder="e.g - 2009" class="form-control">
																			</div>
																		</div>
																	</div>
																</div>
																<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
																	<div class="form-group">
																		<label>Add to profile?</label>
																		<input type="checkbox" name="show_pref" value="1" <?php if(isset($experience) && $experience['show_pref']=="1") { echo  'checked'; } ?> class="form-control" style="width:20px;height:20px;">
																	</div>
																</div>
																<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
																	<div class="form-group">
																		<label>Currently Here?</label><br/>
																		<input type="radio" name="working" value="1" <?php if(isset($experience) && $experience['working']=="1") { echo  'checked="true"'; } ?>> &nbsp; I am currently working here.
																		<br/>
																		<input type="radio" name="working" value="0" <?php if($experience['working']!="1") { echo  'checked="true"'; } ?>> &nbsp; No I have left from here.
																	</div>
																</div>
																<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
																	<div class="form-group">
																		<textarea name="description" id="about_<?php echo $i; ?>" style="resize:none;" placeholder="if you have some details about the work experience?" class="form-control"><?php if(isset($experience) && $experience['description']!="") { echo  htmlspecialchars_decode(stripslashes($experience['description'])); } ?></textarea>
																	</div>
																</div>
																<div class="col-md-12 col-sm-12 col-xs-12 col-12" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);margin-top:10px;padding:10px;">
																	<button class="btn btn-success" type="submit" name="save_step_3">Save current form</button><a href="javascript:void(0);" onclick="$('#editable_area_<?php echo $i; ?>').toggle('display');$('#add_resume_information').hide();" class="btn btn-danger pull-right" style= float:right;" title="Close"><i class="fa fa-times"></i></a>
																</div>
															</div>
														</div>
													</div>
												</form>
											</div>
											<script>
												CKEDITOR.replace('about_<?php echo $i++; ?>');
											</script>
											<?php
										}
									}
								?>
							</div>
							<div class="row">
								<div class="col-md-12">
									<form action="" method="post" enctype="">
										<div class="row">
											<div class="col-md-12 col-sm-12 col-xs-12 col-12" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);margin-top:10px;margin-bottom:10px;padding:10px;">
												<h6>Add New Experience<a href="javascript:void(0);" onclick="$('#add_resume_information').toggle('display');$('.editable_area_section').hide();" class="pull-right" style="float:right;"><i class="fa fa-plus"></i></a></h6>
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12 col-12" id="add_resume_information" style="display:none;box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);">
												<div class="row">
													<div class="col-md-12 col-sm-12 col-xs-12 col-12" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);margin-bottom:10px;padding:10px;">
														<button class="btn btn-success" type="submit" name="save_step_3">Save current form</button><a href="javascript:void(0);" onclick="$('#add_resume_information').toggle('display');$('.editable_area_section').hide();" class="btn btn-danger pull-right" style="float:right;" title="Close"><i class="fa fa-times"></i></a>
													</div>
													<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
														<div class="form-group">
															<label>Designation*</label>
															<input type="text" name="title"  value="" placeholder="Designation" class="form-control">
														</div>
													</div>
													<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
														<div class="form-group">
															<label>Company*</label>
															<input type="text" name="company" value="" placeholder="Company" class="form-control">
														</div>
													</div>
													<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
														<div class="form-group">
															<label>Location*</label>
															<input type="text" name="location" value="" placeholder="City or Location" class="form-control">
														</div>
													</div>
													<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6">
														<div class="form-group">
															<label>From Month*</label>
															<input type="text" name="from_month" value="" placeholder="e.g - 07" class="form-control">
														</div>
													</div>
													<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6">
														<div class="form-group">
															<label>From Year*</label>
															<input type="text" name="from_year" value="" placeholder="e.g - 2007" class="form-control">
														</div>
													</div>
													<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6">
														<div class="form-group">
															<label>To Month</label>
															<input type="text" name="to_month" value="" placeholder="e.g - 01" class="form-control">
														</div>
													</div>
													<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6">
														<div class="form-group">
															<label>To Year</label>
															<input type="text" name="to_year" value="" placeholder="e.g - 2009" class="form-control">
														</div>
													</div>
													<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
														<div class="form-group">
															<label>Currently Here?</label><br/>
															<input type="radio" name="working" value="1" checked> &nbsp; I am currently working here.
															<br/>
															<input type="radio" name="working" value="0"> &nbsp; No I have left from here.
														</div>
													</div>
													<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
														<div class="form-group">
															<textarea name="description" id="about" style="resize:none;" placeholder="if you have some details about the work experience?" class="form-control"></textarea>
														</div>
													</div>
													<div class="col-md-12 col-sm-12 col-xs-12 col-12" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);margin-top:10px;padding:10px;">
														<button class="btn btn-success" type="submit" name="save_step_3">Save current form</button><a href="javascript:void(0);" onclick="$('#add_resume_information').toggle('display');$('.editable_area_section').hide();" class="btn btn-danger pull-right" style="float:right;" title="Close"><i class="fa fa-times"></i></a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</form>
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="margin-top:20px;">
									<div class="form-group">
										<a class="btn btn-danger" href="provide-resume-information.php?step=2&reload=force" type="submit" name="save_step_2">Back</a>
										<a class="btn btn-success" style="margin-left:10px;" href="<?php echo base_url; ?>ambiguity/<?php echo $creator_row['resume_id']; ?>" name="skip_to_preview">Preview</a>
										<a class="btn btn-primary pull-right" style="float:right;" href="provide-resume-information.php?step=4&reload=force" name="skip_to_step_4">Skip & Next</a>
									</div>
								</div>
							<script>
								CKEDITOR.replace('about');
							</script>
						</div>
				
					<?php
						}
						else if($resume_step=="4")
						{
							$experiences=array();
							$creator_id=$_COOKIE['creator_id'];
							$experience_query="SELECT * FROM resume_education WHERE creator_id='$creator_id'";
							$experience_result=mysqli_query($conn,$experience_query);
							if(mysqli_num_rows($experience_result)>0)
							{
								while($experience_row=mysqli_fetch_array($experience_result))
								{
									$experiences[]=$experience_row;
								}
							}
							//print_r($creator_row);
							if(isset($_COOKIE['uid']) && $_COOKIE['uid']!="" && is_null($experiences))
							{
								$resume_user_id=$_COOKIE['uid'];
								$experiences_query="SELECT * FROM users_education WHERE user_id='$resume_user_id' AND status=1 AND include_in_resume=1";
								$experiences_result=mysqli_query($conn,$experiences_query);
								if(mysqli_num_rows($experiences_result)>0)
								{
									while($experience_row=mysqli_fetch_array($experiences_result))
									{
										$experience=array();
										$experience_id=$experience_row['id'];
										$country_query="SELECT title FROM country WHERE id='".$experience_row['country']."'";
										$country_result=mysqli_query($conn,$country_query);
										$country_row=mysqli_fetch_array($country_result);
										
										$city_query="SELECT title FROM city WHERE id='".$experience_row['city']."'";
										$city_result=mysqli_query($conn,$city_query);
										$city_row=mysqli_fetch_array($city_result);
										
										$experience['edu_id']=$experience_row['id'];
										$experience['title']=$experience_row['title'];
										$experience['university']=$experience_row['university'];
										$experience['from_month']=$experience_row['from_month'];
										$experience['from_year']=$experience_row['from_year'];
										$experience['studying']=$experience_row['studying'];
										$experience['to_month']=$experience_row['to_month'];
										$experience['to_year']=$experience_row['to_year'];
										$experience['description']=$experience_row['description'];
										$experience['city']=$city_row['city'];
										$experience['country']=$country_row['country'];
										$experiences[]=$experience;
									}
								}
							}
					?>
							
							<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12 col-12" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);margin-top:10px;margin-bottom:10px;padding:10px;">
									<h5>Adding acedemics to resume.</h5>
								</div>
								<?php
									if(isset($experiences) && !is_null($experiences))
									{
										$i=1;
										foreach($experiences as $experience)
										{
											if(!(isset($experience['title'])))
											{
												$experience['title']=$experience['course'];
											}
											?>
											<div class="col-md-12">
												<form action="" method="post" enctype=""> 
													<div class="row">
														<div class="col-md-12 col-sm-12 col-xs-12 col-12" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);margin-top:10px;margin-bottom:10px;padding:10px;">
															<h6><?php echo ucwords(strtolower($experience['title'].' from '.$experience['university'].', '.$experience['location'])); ?>&nbsp;&nbsp;<a href="provide-resume-information.php?action=delete&target=edu&token=<?php if(isset($experience['id']) && $experience['id']!="") { echo $experience['id'].'&type=resume'; } else { echo $experience['edu_id'].'&type=profile'; } ?>" class="pull-right" style="float:right;color:red;" title="Delete Record"><i class="fa fa-trash"></i></a>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="$('#editable_area_<?php echo $i; ?>').toggle('display');$('#add_resume_information').hide();" class="pull-right" style="float:right;margin-right:10px;" title="Edit Record"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;</h6>
														</div>
														<div class="col-md-12 col-sm-12 col-xs-12 col-12 editable_area_section" id="editable_area_<?php echo $i; ?>" style="display:none;box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);">
															<div class="row">
																<div class="col-md-12 col-sm-12 col-xs-12 col-12" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);margin-bottom:10px;padding:10px;">
																	<button class="btn btn-success" type="submit" name="save_step_4">Save current form</button><a href="javascript:void(0);" onclick="$('#editable_area_<?php echo $i; ?>').toggle('display');$('#add_resume_information').hide();" class="btn btn-danger pull-right" style="float:right;" title="Close"><i class="fa fa-times"></i></a>
																	<input type="hidden" name="creator_edu_id" value="<?php if(isset($experience['id']) && $experience['id']!="") { echo $experience['id']; } ?>">
																</div>
																<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
																	<div class="form-group">
																		<label>Course*</label>
																		<input type="text" required name="title"  value="<?php if(isset($experience) && $experience['title']!="") { echo  $experience['title']; } ?>" placeholder="Designation" class="form-control">
																	</div>
																</div>
																<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
																	<div class="form-group">
																		<label>University*</label>
																		<input type="text" required name="university" value="<?php if(isset($experience) && $experience['university']!="") { echo  $experience['university']; } ?>" placeholder="niversity" class="form-control">
																	</div>
																</div>
																<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
																	<div class="form-group">
																		<label>Location*</label>
																		<input type="text" required name="location" value="<?php if(isset($experience) && $experience['location']!="") { echo  $experience['location']; } ?>" placeholder="City or Location" class="form-control">
																	</div>
																</div>
																<div class="col-md-6 col-xl-6 col-lg-6 col-sm-6 col-12">
																	<div class="row">
																		<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-6">
																			<div class="form-group">
																				<label>From Month*</label>
																				<select id="from_month_<?php echo $i; ?>" class="form-control" name="from_month" required>
																					<option value="">Select</option>
																					<?php
																						for($month_loop=1;$month_loop<=12;$month_loop++)
																						{
																							$month_val_to_print="";
																							if(($month_loop%10)>=1 && $month_loop<10){ $month_val_to_print= '0'.$month_loop; }else{ $month_val_to_print=$month_loop; }
																							?>
																							<option value="<?php echo $month_val_to_print; ?>" <?php if($month_val_to_print==$experience['from_month'] || $experience['from_month']==$month_loop){ echo "selected"; } ?>><?php echo $month_string_array[''.$month_val_to_print]; ?></option>
																							<?php
																						}
																					?>
																				</select>
																			</div>
																		</div>
																		<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-6">
																			<div class="form-group">
																				<label>From Year*</label>
																				<input type="text" name="from_year" value="<?php if(isset($experience) && $experience['from_year']!="") { echo  $experience['from_year']; } ?>" placeholder="e.g - 2007" class="form-control">
																			</div>
																		</div>
																		<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-6">
																			<div class="form-group">
																				<label>To Month</label>
																				<select id="to_month_<?php echo $i; ?>" class="form-control" name="to_month">
																					<option value="">Select</option>
																					<?php
																						for($month_loop=1;$month_loop<=12;$month_loop++)
																						{
																							$month_val_to_print="";
																							if(($month_loop%10)>=1 && $month_loop<10){ $month_val_to_print= '0'.$month_loop; }else{ $month_val_to_print=$month_loop; }
																							?>
																							<option value="<?php echo $month_val_to_print; ?>" <?php if($month_val_to_print==$experience['to_month'] || $experience['to_month']==$month_loop){ echo "selected"; } ?>><?php echo $month_string_array[''.$month_val_to_print]; ?></option>
																							<?php
																						}
																					?>
																				</select>
																			</div>
																		</div>
																		<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-6">
																			<div class="form-group">
																				<label>To Year</label>
																				<input type="text" name="to_year" value="<?php if(isset($experience) && $experience['to_year']!="") { echo  $experience['to_year']; } ?>" placeholder="e.g - 2009" class="form-control">
																			</div>
																		</div>
																	</div>
																</div>
																<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
																	<div class="form-group">
																		<label>Add to profile?</label>
																		<input type="checkbox" name="show_pref" value="1" <?php if(isset($experience) && $experience['show_pref']=="1") { echo  'checked'; } ?> class="form-control" style="width:20px;height:20px;">
																	</div>
																</div>
																<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
																	<div class="form-group">
																		<label>Currently Here?</label><br/>
																		<input type="radio" name="studying" value="1" <?php if(isset($experience) && $experience['studying']=="1") { echo  'checked="true"'; } ?>> &nbsp; I am currently studying here.
																		<br/>
																		<input type="radio" name="studying" value="0" <?php if($experience['studying']!="1") { echo  'checked="true"'; } ?>> &nbsp; No I have left from here.
																	</div>
																</div>
																<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
																	<div class="form-group">
																		<textarea name="description" id="about_<?php echo $i; ?>" style="resize:none;" placeholder="if you have some details about the learning experience?" class="form-control"><?php if(isset($experience) && $experience['description']!="") { echo  htmlspecialchars_decode(stripslashes($experience['description'])); } ?></textarea>
																	</div>
																</div>
																<div class="col-md-12 col-sm-12 col-xs-12 col-12" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);margin-top:10px;padding:10px;">
																	<button class="btn btn-success" type="submit" name="save_step_4">Save current form</button><a href="javascript:void(0);" onclick="$('#editable_area_<?php echo $i; ?>').toggle('display');$('#add_resume_information').hide();" class="btn btn-danger pull-right" style= float:right;" title="Close"><i class="fa fa-times"></i></a>
																</div>
															</div>
														</div>
													</div>
												</form>
											</div>
											<script>
												CKEDITOR.replace('about_<?php echo $i++; ?>');
											</script>
											<?php
										}
									}
								?>
							</div>
							<div class="row">
								<div class="col-md-12">
									<form action="" method="post" enctype="">
										<div class="row">
											<div class="col-md-12 col-sm-12 col-xs-12 col-12" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);margin-top:10px;margin-bottom:10px;padding:10px;">
												<h6>Add New Degree<a href="javascript:void(0);" onclick="$('#add_resume_information').toggle('display');$('.editable_area_section').hide();" class="pull-right" style="float:right;"><i class="fa fa-plus"></i></a></h6>
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12 col-12" id="add_resume_information" style="display:none;box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);">
												<div class="row">
													<div class="col-md-12 col-sm-12 col-xs-12 col-12" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);margin-bottom:10px;padding:10px;">
														<button class="btn btn-success" type="submit" name="save_step_4">Save current form</button><a href="javascript:void(0);" onclick="$('#add_resume_information').toggle('display');$('.editable_area_section').hide();" class="btn btn-danger pull-right" style="float:right;" title="Close"><i class="fa fa-times"></i></a>
													</div>
													<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
														<div class="form-group">
															<label>Course*</label>
															<input type="text" name="title"  value="" placeholder="Course" class="form-control">
														</div>
													</div>
													<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
														<div class="form-group">
															<label>University*</label>
															<input type="text" name="university" value="" placeholder="University" class="form-control">
														</div>
													</div>
													<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
														<div class="form-group">
															<label>Location*</label>
															<input type="text" name="location" value="" placeholder="City or Location" class="form-control">
														</div>
													</div>
													<div class="col-md-6 col-xl-6 col-lg-6 col-sm-6 col-12">
														<div class="row">
															<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-6">
																<div class="form-group">
																	<label>From Month*</label>
																	<select id="from_month_<?php echo $i; ?>" class="form-control" name="from_month" required>
																		<option value="">Select</option>
																		<?php
																			for($month_loop=1;$month_loop<=12;$month_loop++)
																			{
																				$month_val_to_print="";
																				if(($month_loop%10)>=1 && $month_loop<10){ $month_val_to_print= '0'.$month_loop; }else{ $month_val_to_print=$month_loop; }
																				?>
																				<option value="<?php echo $month_val_to_print; ?>"><?php echo $month_string_array[''.$month_val_to_print]; ?></option>
																				<?php
																			}
																		?>
																	</select>
																</div>
															</div>
															<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-6">
																<div class="form-group">
																	<label>From Year*</label>
																	<input type="text" name="from_year" value="" placeholder="e.g - 2007" class="form-control">
																</div>
															</div>
															<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-6">
																<div class="form-group">
																	<label>To Month</label>
																	<select id="to_month_<?php echo $i; ?>" class="form-control" name="to_month">
																		<option value="">Select</option>
																		<?php
																			for($month_loop=1;$month_loop<=12;$month_loop++)
																			{
																				$month_val_to_print="";
																				if(($month_loop%10)>=1 && $month_loop<10){ $month_val_to_print= '0'.$month_loop; }else{ $month_val_to_print=$month_loop; }
																				?>
																				<option value="<?php echo $month_val_to_print; ?>"><?php echo $month_string_array[''.$month_val_to_print]; ?></option>
																				<?php
																			}
																		?>
																	</select>
																</div>
															</div>
															<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-6">
																<div class="form-group">
																	<label>To Year</label>
																	<input type="text" name="to_year" value="" placeholder="e.g - 2009" class="form-control">
																</div>
															</div>
														</div>
													</div>
													<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
														<div class="form-group">
															<label>Add to profile?</label>
															<input type="checkbox" name="show_pref" value="1" checked="checked" class="form-control" style="width:20px;height:20px;">
														</div>
													</div>
													<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
														<div class="form-group">
															<label>Currently Here?</label><br/>
															<input type="radio" name="studying" value="1" checked> &nbsp; I am currently studying here.
															<br/>
															<input type="radio" name="studying" value="0"> &nbsp; No I have left from here.
														</div>
													</div>
													<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
														<div class="form-group">
															<textarea name="description" id="about" style="resize:none;" placeholder="if you have some details about the work experience?" class="form-control"></textarea>
														</div>
													</div>
													<div class="col-md-12 col-sm-12 col-xs-12 col-12" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);margin-top:10px;padding:10px;">
														<button class="btn btn-success" type="submit" name="save_step_4">Save current form</button><a href="javascript:void(0);" onclick="$('#add_resume_information').toggle('display');$('.editable_area_section').hide();" class="btn btn-danger pull-right" style="float:right;" title="Close"><i class="fa fa-times"></i></a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</form>
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="margin-top:20px;">
									<div class="form-group">
										<a class="btn btn-danger" href="provide-resume-information.php?step=3&reload=force" type="submit" name="save_step_3">Back</a>
										<a class="btn btn-success" style="margin-left:10px;" href="<?php echo base_url; ?>ambiguity/<?php echo $creator_row['resume_id']; ?>" name="skip_to_preview">Preview</a>
										<a class="btn btn-primary pull-right" style="float:right;" href="provide-resume-information.php?step=5&reload=force" name="skip_to_step_5">Skip & Next</a>
									</div>
								</div>
							<script>
								CKEDITOR.replace('about');
							</script>
						</div>
				
					<?php
						}
						else if($resume_step=="5")
						{
							$experiences=array();
							$creator_id=$_COOKIE['creator_id'];
							$experience_query="SELECT * FROM resume_skills WHERE creator_id='$creator_id' ORDER BY type ASC";
							$experience_result=mysqli_query($conn,$experience_query);
							if(mysqli_num_rows($experience_result)>0)
							{
								while($experience_row=mysqli_fetch_array($experience_result))
								{
									$experiences[]=$experience_row;
								}
							}
							//print_r($creator_row);
							if(isset($_COOKIE['uid']) && $_COOKIE['uid']!="" && is_null($experiences))
							{
								$resume_user_id=$_COOKIE['uid'];
								$experiences_query="SELECT * FROM users_skills WHERE user_id='$resume_user_id' AND status=1 AND include_in_resume=1 ORDER BY type ASC";
								$experiences_result=mysqli_query($conn,$experiences_query);
								if(mysqli_num_rows($experiences_result)>0)
								{
									while($experience_row=mysqli_fetch_array($experiences_result))
									{
										$experience=array();
										
										$experience['skill_id']=$experience_row['id'];
										$experience['title']=$experience_row['title'];
										$experience['type']=$experience_row['type'];
										$experience['proficiency']=$experience_row['proficiency'];
										$experience['show_pref']=$experience_row['show_pref'];
										$experiences[]=$experience;
									}
								}
							}
					?>
							
							<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12 col-12" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);margin-top:10px;margin-bottom:10px;padding:10px;">
									<h5>Adding skills to resume.</h5>
								</div>
								<div class="col-md-12" id="add_resume_information" style="margin-top:20px;box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);">
									<form action="" method="post" enctype="">
										<div class="row">
											<div class="col-md-4 col-sm-4 col-xs-4 col-6">
												<div class="form-group">
													<label>Title*</label>
													<input type="text" required name="title" value="" placeholder="Title" class="form-control">
												</div>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-2 col-6">
												<div class="form-group">
													<label>Type*</label>
													<select required name="type" class="form-control">
														<option value="">Select</option>
														<option value="1" >Professional</option>
														<option value="2" >Personal</option>
														<option value="3" >Linguistic</option>
													</select>
												</div>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-2 col-6">
												<div class="form-group">
													<label>Proficiency*</label>
													<select required name="proficiency" class="form-control">
														<option value="">Select</option>
														<option value="33">Beginner</option>
														<option value="66">Intermediate</option>
														<option value="100">Advance</option>
													</select>
												</div>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-2 col-6">
												<div class="form-group">
													<label>Add to profile*</label><br/>
													<input type="checkbox" name="show_pref" value="1" checked>
												</div>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-2 col-6">
												<div class="form-group">
													<label>&nbsp;</label><br/>
													<button class="btn btn-success" type="submit" name="save_step_5">Save</button>
												</div>
											</div>
										</div>
									</form>
								</div>
								<div class="col-md-12" style="max-height:300px;overflow-y:auto;padding-right:50px;padding-left:50px;margin-top:20px;">
									<div class="row">
								<?php
									$proficiency_txt_arr=array("33"=>"Beginner","66"=>"Intermediate","100"=>"Advance");
									$skill_type_arr=array("1"=>"Professional","2"=>"Personal","3"=>"Linguistic");
									if(isset($experiences) && !is_null($experiences))
									{
										$i=1;
										foreach($experiences as $experience)
										{
											$experience['proficiency_txt']=$proficiency_txt_arr[''.$experience['proficiency']];
											$experience['skill_type']=$skill_type_arr[''.$experience['type']];
											?>
											<div class="col-md-12">
												<form action="" method="post" enctype=""> 
													<div class="row">
														<div class="col-md-12 col-sm-12 col-xs-12 col-12" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);margin-top:10px;margin-bottom:10px;padding:10px;">
															<h6><?php echo ucwords(strtolower($experience['title'].' - '.$experience['skill_type'].' - '.$experience['proficiency_txt'])); ?>&nbsp;&nbsp;<a href="provide-resume-information.php?action=delete&target=skills&token=<?php if(isset($experience['id']) && $experience['id']!="") { echo $experience['id'].'&type=resume'; } else { echo $experience['skill_id'].'&type=profile'; } ?>" class="pull-right" style="float:right;color:red;" title="Delete Record"><i class="fa fa-trash"></i></a>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="$('#editable_area_<?php echo $i; ?>').toggle('display');$('#add_resume_information').toggle('display');" class="pull-right" style="float:right;margin-right:10px;" title="Edit Record"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;</h6>
														</div>
														<div class="col-md-12 col-sm-12 col-xs-12 col-12 editable_area_section" id="editable_area_<?php echo $i; ?>" style="display:none;box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);">
															<div class="row">
																<div class="col-md-4 col-sm-4 col-xs-4 col-6">
																	<div class="form-group">
																		<label>Title*</label>
																		<input type="hidden" name="creator_skill_id" value="<?php if(isset($experience['id']) && $experience['id']!="") { echo $experience['id']; } ?>">
																		<input type="text" required name="title" value="<?php echo $experience['title']; ?>" placeholder="Title" class="form-control">
																	</div>
																</div>
																<div class="col-md-2 col-sm-2 col-xs-2 col-6">
																	<div class="form-group">
																		<label>Type*</label>
																		<select required name="type" class="form-control">
																			<option value="">Select</option>
																			<option value="1" <?php if($experience['type']=="1"){ echo "selected"; } ?>>Professional</option>
																			<option value="2" <?php if($experience['type']=="2"){ echo "selected"; } ?>>Personal</option>
																			<option value="3" <?php if($experience['type']=="3"){ echo "selected"; } ?>>Linguistic</option>
																		</select>
																	</div>
																</div>
																<div class="col-md-2 col-sm-2 col-xs-2 col-6">
																	<div class="form-group">
																		<label>Proficiency*</label>
																		<select required name="proficiency" class="form-control">
																			<option value="">Select</option>
																			<option value="33" <?php if($experience['proficiency']=="33"){ echo "selected"; } ?>>Beginner</option>
																			<option value="66" <?php if($experience['proficiency']=="66"){ echo "selected"; } ?>>Intermediate</option>
																			<option value="100" <?php if($experience['proficiency']=="100"){ echo "selected"; } ?>>Advance</option>
																		</select>
																	</div>
																</div>
																<div class="col-md-2 col-sm-2 col-xs-2 col-6">
																	<div class="form-group">
																		<label>Add to profile*</label><br/>
																		<input type="checkbox" name="show_pref" value="1" <?php if($experience['show_pref']=="1"){ echo "checked"; } ?>>
																	</div>
																</div>
																<div class="col-md-2 col-sm-2 col-xs-2 col-6">
																	<div class="form-group">
																		<label>&nbsp;</label><br/>
																		<button class="btn btn-success" type="submit" name="save_step_5">Save</button>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</form>
											</div>
											<?php
											
										$i=$i+1;
										}
									}
								?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="margin-top:20px;">
									<div class="form-group">
										<a class="btn btn-danger" href="provide-resume-information.php?step=4&reload=force" type="submit" name="save_step_4">Back</a>
										<a class="btn btn-primary pull-right" style="float:right;" href="provide-resume-information.php?step=6&reload=force" name="skip_to_step_6">Skip & Next</a>
										<a class="btn btn-success" style="margin-left:10px;" href="<?php echo base_url; ?>ambiguity/<?php echo $creator_row['resume_id']; ?>" name="skip_to_preview">Preview</a>
									</div>
								</div>
							</div>
					<?php
						}
						else if($resume_step=="6")
						{
							$experiences=array();
							$creator_id=$_COOKIE['creator_id'];
							$experience_query="SELECT * FROM resume_interests WHERE creator_id='$creator_id' ORDER BY title";
							$experience_result=mysqli_query($conn,$experience_query);
							if(mysqli_num_rows($experience_result)>0)
							{
								while($experience_row=mysqli_fetch_array($experience_result))
								{
									$experiences[]=$experience_row;
								}
							}
							//print_r($creator_row);
							if(isset($_COOKIE['uid']) && $_COOKIE['uid']!="" && is_null($experiences))
							{
								$resume_user_id=$_COOKIE['uid'];
								$experiences_query="SELECT * FROM users_interests WHERE user_id='$resume_user_id' AND include_in_resume=1 ORDER BY title";
								$experiences_result=mysqli_query($conn,$experiences_query);
								if(mysqli_num_rows($experiences_result)>0)
								{
									while($experience_row=mysqli_fetch_array($experiences_result))
									{
										$experience=array();
										
										$experience['interest_id']=$experience_row['id'];
										$experience['title']=$experience_row['title'];
										$experience['show_pref']=$experience_row['show_pref'];
										$experiences[]=$experience;
									}
								}
							}
					?>
							
							<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12 col-12" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);margin-top:10px;margin-bottom:10px;padding:10px;">
									<h5>Adding interests to resume.</h5>
								</div>
								<div class="col-md-6" id="">
									<form action="" method="post" enctype="">
										<div class="row">
											<div class="col-md-12" style="margin-top:150px;box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);">
												<div class="row">
													<div class="col-md-6 col-sm-6 col-xs-12 col-12">
														<div class="form-group">
															<label>Title*</label>
															<input type="text" required name="title" value="" placeholder="Title" class="form-control">
														</div>
													</div>
													<div class="col-md-3 col-sm-3 col-xs-12 col-12">
														<div class="form-group">
															<label>Add to profile*</label><br/>
															<input type="checkbox" name="show_pref" value="1" checked>
														</div>
													</div>
													<div class="col-md-3 col-sm-3 col-xs-12 col-12">
														<div class="form-group">
															<label>&nbsp;</label><br/>
															<button class="btn btn-success" type="submit" name="save_step_6">Save</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
								<div class="col-md-6" style="max-height:350px;overflow-y:auto;padding-right:50px;padding-left:50px;margin-top:20px;">
									<div class="row">
								<?php
									if(isset($experiences) && !is_null($experiences))
									{
										$i=1;
										foreach($experiences as $experience)
										{
											?>
											<div class="col-md-12">
												<form action="" method="post" enctype=""> 
													<div class="row">
														<div class="col-md-12 col-sm-12 col-xs-12 col-12" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);margin-top:10px;margin-bottom:10px;padding:10px;">
															<h6><?php echo ucwords(strtolower($experience['title'])); ?>&nbsp;&nbsp;<a href="provide-resume-information.php?action=delete&target=interests&token=<?php if(isset($experience['id']) && $experience['id']!="") { echo $experience['id'].'&type=resume'; } else { echo $experience['interest_id'].'&type=profile'; } ?>" class="pull-right" style="float:right;color:red;" title="Delete Record"><i class="fa fa-trash"></i></a>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="$('#editable_area_<?php echo $i; ?>').toggle('display');" class="pull-right" style="float:right;margin-right:10px;" title="Edit Record"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;</h6>
														</div>
														<div class="col-md-12 col-sm-12 col-xs-12 col-12 editable_area_section" id="editable_area_<?php echo $i; ?>" style="display:none;box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);">
															<div class="row">
																<div class="col-md-6 col-sm-6 col-xs-12 col-12">
																	<div class="form-group">
																		<label>Title*</label>
																		<input type="hidden" name="creator_interest_id" value="<?php if(isset($experience['id']) && $experience['id']!="") { echo $experience['id']; } ?>">
																		<input type="text" required name="title" value="<?php echo $experience['title']; ?>" placeholder="Title" class="form-control">
																	</div>
																</div>
																
																<div class="col-md-3 col-sm-3 col-xs-12 col-12">
																	<div class="form-group">
																		<label>Add to profile*</label><br/>
																		<input type="checkbox" name="show_pref" value="1" <?php if($experience['show_pref']=="1"){ echo "checked"; } ?>>
																	</div>
																</div>
																<div class="col-md-3 col-sm-3 col-xs-12 col-12">
																	<div class="form-group">
																		<label>&nbsp;</label><br/>
																		<button class="btn btn-success" type="submit" name="save_step_6">Save</button>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</form>
											</div>
											<?php
										$i=$i+1;
										}
									}
								?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="margin-top:20px;">
									<div class="form-group">
										<a class="btn btn-danger" href="provide-resume-information.php?step=4&reload=force" type="submit" name="save_step_5">Back</a>
										<a class="btn btn-primary pull-right" style="float:right;" href="provide-resume-information.php?step=7&reload=force" name="skip_to_step_7">Skip & Next</a>
										<a class="btn btn-success" style="margin-left:10px;" href="<?php echo base_url; ?>ambiguity/<?php echo $creator_row['resume_id']; ?>" name="skip_to_preview">Preview</a>
									</div>
								</div>
							</div>
					<?php
						}
						else if($resume_step=="7")
						{
							$experiences=array();
							$creator_id=$_COOKIE['creator_id'];
							$experience_query="SELECT * FROM resume_certifications WHERE creator_id='$creator_id' ORDER BY title";
							$experience_result=mysqli_query($conn,$experience_query);
							if(mysqli_num_rows($experience_result)>0)
							{
								while($experience_row=mysqli_fetch_array($experience_result))
								{
									$experiences[]=$experience_row;
								}
							}
							//print_r($creator_row);
							if(isset($_COOKIE['uid']) && $_COOKIE['uid']!="" && is_null($experiences))
							{
								$resume_user_id=$_COOKIE['uid'];
								$experiences_query="SELECT * FROM users_awards WHERE user_id='$resume_user_id' AND include_in_resume=1 ORDER BY title";
								$experiences_result=mysqli_query($conn,$experiences_query);
								if(mysqli_num_rows($experiences_result)>0)
								{
									while($experience_row=mysqli_fetch_array($experiences_result))
									{
										$experience=array();
										
										$experience['creator_certification_id']=$experience_row['id'];
										$experience['title']=$experience_row['title'];
										$experience['show_pref']=$experience_row['show_pref'];
										$experiences[]=$experience;
									}
								}
							}
							$max_mr_top="150px";
							if(count($experiences)<5)
							{
								$max_mr_top=20*count($experiences)."px";
							}
					?>
							
							<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12 col-12" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);margin-top:10px;margin-bottom:10px;padding:10px;">
									<h5>Adding certifications to resume.</h5>
								</div>
								<div class="col-md-6" id="">
									<form action="" method="post" enctype="">
										<div class="row">
											<div class="col-md-12" style="margin-top:<?php echo $max_mr_top; ?>;box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);">
												<div class="row">
													<div class="col-md-6 col-sm-6 col-xs-12 col-12">
														<div class="form-group">
															<label>Title*</label>
															<input type="text" required name="title" value="" placeholder="Title" class="form-control">
														</div>
													</div>
													<div class="col-md-3 col-sm-3 col-xs-12 col-12">
														<div class="form-group">
															<label>Add to profile*</label><br/>
															<input type="checkbox" name="show_pref" value="1" checked>
														</div>
													</div>
													<div class="col-md-3 col-sm-3 col-xs-12 col-12">
														<div class="form-group">
															<label>&nbsp;</label><br/>
															<button class="btn btn-success" type="submit" name="save_step_7">Save</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
								<div class="col-md-6" style="max-height:350px;overflow-y:auto;padding-right:50px;padding-left:50px;margin-top:20px;">
									<div class="row">
								<?php
									if(isset($experiences) && !is_null($experiences))
									{
										$i=1;
										foreach($experiences as $experience)
										{
											?>
											<div class="col-md-12">
												<form action="" method="post" enctype=""> 
													<div class="row">
														<div class="col-md-12 col-sm-12 col-xs-12 col-12" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);margin-top:10px;margin-bottom:10px;padding:10px;">
															<h6><?php echo ucwords(strtolower($experience['title'])); ?>&nbsp;&nbsp;<a href="provide-resume-information.php?action=delete&target=certifications&token=<?php if(isset($experience['id']) && $experience['id']!="") { echo $experience['id'].'&type=resume'; } else { echo $experience['creator_certification_id'].'&type=profile'; } ?>" class="pull-right" style="float:right;color:red;" title="Delete Record"><i class="fa fa-trash"></i></a>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="$('#editable_area_<?php echo $i; ?>').toggle('display');" class="pull-right" style="float:right;margin-right:10px;" title="Edit Record"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;</h6>
														</div>
														<div class="col-md-12 col-sm-12 col-xs-12 col-12 editable_area_section" id="editable_area_<?php echo $i; ?>" style="display:none;box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);">
															<div class="row">
																<div class="col-md-6 col-sm-6 col-xs-12 col-12">
																	<div class="form-group">
																		<label>Title*</label>
																		<input type="hidden" name="creator_certification_id" value="<?php if(isset($experience['id']) && $experience['id']!="") { echo $experience['id']; } ?>">
																		<input type="text" required name="title" value="<?php echo $experience['title']; ?>" placeholder="Title" class="form-control">
																	</div>
																</div>
																
																<div class="col-md-3 col-sm-3 col-xs-12 col-12">
																	<div class="form-group">
																		<label>Add to profile*</label><br/>
																		<input type="checkbox" name="show_pref" value="1" <?php if($experience['show_pref']=="1"){ echo "checked"; } ?>>
																	</div>
																</div>
																<div class="col-md-3 col-sm-3 col-xs-12 col-12">
																	<div class="form-group">
																		<label>&nbsp;</label><br/>
																		<button class="btn btn-success" type="submit" name="save_step_7">Save</button>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</form>
											</div>
											<?php
										$i=$i+1;
										}
									}
								?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="margin-top:20px;">
									<div class="form-group">
										<a class="btn btn-danger" href="provide-resume-information.php?step=6&reload=force" type="submit" name="save_step_6">Back</a>
										<a class="btn btn-primary pull-right" style="float:right;" href="provide-resume-information.php?step=8&reload=force" name="skip_to_step_8">Skip & Next</a>
										<a class="btn btn-success" style="margin-left:10px;" href="<?php echo base_url; ?>ambiguity/<?php echo $creator_row['resume_id']; ?>" name="skip_to_preview">Preview</a>
									</div>
								</div>
							</div>
					<?php
						}
						else if($resume_step=="8")
						{
							$About=$creator_row;
							if(isset($_COOKIE['uid']) && $_COOKIE['uid']!="")
							{
								$resume_user_id=$_COOKIE['uid'];
							}
					?>
							<h5 class="pt-3 pr-3 border-bottom mb-0 pb-3">Additional Details.</h5>
							<form action="" method="post" enctype=""> 
								<div class="row" style="padding-top:30px;">
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
										<div class="form-group">
											<label>Write something additional about you</label>
											<input type="hidden" id="resume_id" name="resume_id" value="<?php echo $creator_row['resume_id']; ?>">
											<textarea name="additional_description" style="resize:none;" id="about" placeholder="Describe yourself in details if you wants to do? This section will be attached in bottom of your CV" class="form-control"><?php if(isset($About) && $About['additional_description']!="") { echo  stripslashes($About['additional_description']); }  ?></textarea>
										</div>
									</div>
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
										<div class="form-group">
											<label>Would you like to add below line to your CV?</label><br/>
											<input type="checkbox" value="1" checked name="include_references">&nbsp;&nbsp;References are available upon request.											
										</div>
									</div>
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
										<div class="form-group">
											<a class="btn btn-danger" href="provide-resume-information.php?step=7&reload=force" type="submit" name="save_step_7">Back</a>
											<button class="btn btn-success" type="submit" name="save_step_8">Save & Preview</button>
											<a class="btn btn-primary pull-right" style="float:right;" href="<?php echo base_url; ?>ambiguity/<?php echo $creator_row['resume_id']; ?>" name="skip_to_preview">Skip & Next</a>
										</div>
									</div>
								</div>
							</form>
							<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
							<script>
								CKEDITOR.replace('about');
							</script>
					<?php
						}
					?>
				</main>
			</div>
			<?php include_once 'scripts.php';  ?>
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
			<script>
				var user_id="<?php echo $_COOKIE['uid']; ?>";
				var base_url="<?php echo base_url; ?>";
				function loadImage(div)
				{
					$("."+div+" img").css("cursor","pointer");
					$("."+div+" img").click(function(){
						$("#backdrop_image_to_show").attr("src",$(this).attr("src"));
						$("#image_backdrop_modal").modal('show');
					});
				}
				loadImage("py-4");
			</script>
		</div>
		
	</body>
</html>