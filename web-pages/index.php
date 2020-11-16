<?php include_once 'data_master.php'; ?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<meta property="og:url" content="<?php echo base_url."w/".$_username; ?>" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="<?php echo "{$_WEB_AUTHOR}"; ?> - <?php echo "{$_WEB_DESIGNATION}"; ?> Powered by @RopeYou Connects" />
	<meta property="og:description" content="<?php echo @strip_tags($_WEB_AUTHOR_ABOUT); ?>" />
	<meta property="og:image" content="<?php echo "{$_WEB_AUTHOR_IMAGE}";?>"/>
	<meta property="fb:app_id" content="465307587452391"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <meta name="author" content="RopeYou Connects,<?php echo "{$_WEB_AUTHOR}"; ?>,<?php echo "{$_WEB_DESIGNATION}"; ?> #xboyonweb #xgirlonweb"/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <title><?php echo "{$_WEB_TITLE}"; ?></title>
    <link rel="icon" href="<?php echo base_url; ?>images/fav.png" />
    <link rel="apple-touch-icon" href="<?php echo base_url; ?>images/fav.png"/>
	<?php include_once "simple/".$_theme_selected."/theme-head.php"; ?>
</head>

<body>
<?php 
	include_once "simple/".$_theme_selected."/theme-loader.php";
	include_once "simple/".$_theme_selected."/theme-header.php";
	include_once "simple/".$_theme_selected."/theme-sections.php";
	include_once "simple/".$_theme_selected."/theme-footer.php"; 
?>
</body>
</html>