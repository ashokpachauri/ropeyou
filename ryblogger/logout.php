<?php
	session_start();
	setcookie("blogger_id", "",time() - 3600,"/",".ropeyou.com");
	setcookie("uid", "",time() - 3600,"/",".ropeyou.com");
	unset($_COOKIE['uid']);
	unset($_COOKIE['blogger_id']);
	session_destroy();
?>
<script>
	window.location.href='index.php';
</script>