<?php
	session_start();
	define("BLOGGER","RYBlogger");
	define("base_url","http://ryblogger.ropeyou.com/");
	define("parent_url","https://ropeyou.com/ropeyou/");
	define("BLOGGER_ASSETS",base_url."assets-v1/");
	
	define("DB_HOST","localhost");
	define("DB_USERNAME","ropeyou_master");
	define("DB_PASSWORD","ropeyou#2019");
	define("DB_NAME","ropeyou_master");
	
	$BASEURL=base_url;
	$DBUSERNAME=DB_USERNAME;
	$DBPASSWORD=DB_PASSWORD;
	$DBNAME=DB_NAME;
	$DBHOST=DB_HOST;
	$conn=mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
	$conn->set_charset('utf8');
	error_reporting(0);
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

	function userExists($inputs=array())
	{
		$CONNECT=mysqli_connect($GLOBALS['DBHOST'],$GLOBALS['DBUSERNAME'],$GLOBALS['DBPASSWORD'],$GLOBALS['DBNAME']);
		$WHERE_CLAUSE="";
		foreach($inputs as $holder=>$value)
		{
			if($holder!="")
			{
				if($WHERE_CLAUSE!="")
				{
					$WHERE_CLAUSE.=" AND ".$holder."='$value'";
				}
				else{
					$WHERE_CLAUSE.=" WHERE ".$holder."='$value'";
				}
			}
		}
		
		if($WHERE_CLAUSE=="")
		{
			return false;
		}
		else
		{
			$CheckQuery="SELECT id FROM users".$WHERE_CLAUSE;
			$CheckResult=mysqli_query($CONNECT,$CheckQuery);
			if(mysqli_num_rows($CheckResult)>0)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
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
					$_profile=parent_url."alphas/".strtolower(substr($user_row['first_name'],0,1)).".png";
				}
				else{
					$_profile="default.png";
					$_profile=parent_url."uploads/".$_profile;
				}
			}
			else{
				$_profile=parent_url."uploads/".$_profile;
			}
		}
		return $_profile;
	}
	function createUser($user=array())
	{
		$CONNECT=mysqli_connect($GLOBALS['DBHOST'],$GLOBALS['DBUSERNAME'],$GLOBALS['DBPASSWORD'],$GLOBALS['DBNAME']);
		$QUERY="";
		foreach($user as $holder=>$value)
		{
			if($holder!="")
			{
				if($QUERY!="")
				{
					$QUERY.=",".$holder."='$value'";
				}
				else
				{
					$QUERY.=$holder."='$value'";
				}
			}
		}
		if($QUERY=="")
		{
			return false;
		}
		else
		{
			$INSERT_QUERY="INSERT INTO users SET ".$QUERY;
			if(mysqli_query($CONNECT,$INSERT_QUERY))
			{
				return true;
			}
			else{
				return false;
			}
		}
	}
?>