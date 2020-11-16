<?php include_once 'blogger-connect.php';  ?>
<?php
	if(!((isset($_COOKIE['blogger_id'])) && ($_COOKIE['blogger_id']!="")))
	{
		?>
		<script>
			window.location.href="<?php echo base_url; ?>";
		</script>
		<?php
	}
?>
<head>
    <title><?php echo BLOGGER; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Socialite is - Professional A unique and beautiful collection of UI elements">
    <link rel="icon" href="<?php echo base_url; ?>favicon.ico">
    <link rel="stylesheet" href="<?php echo BLOGGER_ASSETS; ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo BLOGGER_ASSETS; ?>assets/css/night-mode.css">
    <link rel="stylesheet" href="<?php echo BLOGGER_ASSETS; ?>assets/css/framework.css">
    <link rel="stylesheet" href="<?php echo BLOGGER_ASSETS; ?>assets/css/icons.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
</head>
<style>
	.main_content{
		margin-left:0px !important;
	}
	.main_content_inner{
		max-width:1200px !important;
	}
</style>