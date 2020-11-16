<!DOCTYPE html>
<html>
<head>
<?php include_once '../connection.php'; ?>
<meta charset="UTF-8">
<title>Video Chat</title>

<!-- Stylesheet Ressources -->
<link rel="stylesheet" href="<?php echo base_url; ?>video_chat/css/fts-webrtc-styles.css">

</head>

<body>

<!-- main container -->
<div id="mainContainer" class="main-container">

	<!-- local video -->
	<video id="localVideo" class="local-video"></video>

	<!-- remote video -->
	<video id="remoteVideo" class="remote-video" autoplay></video>

	<!-- video status & room entry bar -->
	<div id="videoStatus" class="video-status">
	</div>

</div>


<!-- JavaScript Ressources -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="<?php echo base_url; ?>video_chat/js/jquery.fresh-tilled-soil-webrtc.js"></script>

<!-- Plugin Initialization -->
<script type="text/javascript">
	$(function() {
		$('#mainContainer').createVideoChat();
	});
</script>

</body>
</html>
