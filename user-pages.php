<?php
	$module=$_REQUEST['__module'];
	$username=$_REQUEST['__username'];
	if($username!="")
	{
		if($module=="connections" )
		{
			include_once 'view_users_connections.php';
		}
		if($module=="gallery")
		{
			include_once 'view_users_gallery.php';
		}
		else if($module=="" || $module=="profile")
		{
			include_once 'user-profile.php';
		}
	}
	else
	{
		include_once '404.php';
	}
?>