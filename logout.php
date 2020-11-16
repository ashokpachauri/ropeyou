<?php
	include_once 'connection.php';
	mysqli_query($conn,"UPDATE users_logs SET is_active=0 WHERE is_active=1 AND TIMESTAMPDIFF(MINUTE,added,NOW())>5");
	mysqli_query($conn,"UPDATE users_logs SET is_active=0 WHERE user_id='".$_COOKIE['uid']."'");
	session_start();
	unset($_SESSION);
	$cookie_name="uid";
	$cookie_name1="username";
	//$cookie_name=$row['id'];
	setcookie($cookie_name, "",time() - 3600,"/");
	setcookie($cookie_name1, "",time() - 3600,"/");
	setcookie("blogger_id", "",time() - 3600,"/");
	unset($_COOKIE['uid']);
	unset($_COOKIE['blogger_id']);
	unset($_COOKIE['username']);
	session_destroy();
	//die();
?>
<script>
	location.href="<?php echo base_url; ?>";
</script>