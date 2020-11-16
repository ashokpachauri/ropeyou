<?php include_once 'connection.php'; ?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="author" content="RopeYou Connects">
<meta name="title" content="RopeYou Connects">
<meta name="description" content="">

<link rel="icon" type="image/png" href="<?php echo base_url; ?>img/fav.png">
<link rel="stylesheet" type="text/css" href="<?php echo base_url; ?>vendor/slick/slick.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url; ?>vendor/slick/slick-theme.min.css"/>
<link href="<?php echo base_url; ?>vendor/icons/feather.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url; ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url; ?>css/style.css" rel="stylesheet">
<script src="<?php echo base_url; ?>vendor/jquery/jquery.min.js"></script>
<style>
.network-item-header{
	min-height:90px !important;
	max-height:91px !important;
}
</style>
<style>
.ru-loader {
  border: 6px solid #f3f3f3;
  border-radius: 50%;
  border-top: 6px solid blue;
  border-bottom: 6px solid blue;
  width: 50px;
  height: 50px;
  -webkit-animation: spin 1s linear infinite;
  animation: spin 1s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

</style>
<style>
	.loader {
	  position: relative;
	  text-align: center;
	  margin: 15px auto 35px auto;
	  z-index: 9999;
	  display: block;
	  width: 80px;
	  height: 80px;
	  border: 10px solid rgba(0, 0, 0, .3);
	  border-radius: 50%;
	  border-top-color: #000;
	  animation: spin 1s ease-in-out infinite;
	  -webkit-animation: spin 1s ease-in-out infinite;
	}
	@keyframes spin {
	  to {
		-webkit-transform: rotate(360deg);
	  }
	}

	@-webkit-keyframes spin {
	  to {
		-webkit-transform: rotate(360deg);
	  }
	}
	.loader-txt {
	  p {
		font-size: 13px;
		color: #666;
		small {
		  font-size: 11.5px;
		  color: #999;
		}
	  }
	}
</style>