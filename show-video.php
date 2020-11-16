<?php
	$width="250px";
	$height="250px";
	$height=$_REQUEST['height'];
	if(isset($_REQUEST['height']) && $_REQUEST['height']!="")
	{
		$height=$_REQUEST['height'];
	}
	if(isset($_REQUEST['width']) && $_REQUEST['width']!="")
	{
		$width=$_REQUEST['width'];
	}
	if(isset($_REQUEST['video_url']) && $_REQUEST['video_url']!="")
	{
		if(is_file(filter_var($_REQUEST['video_url'],FILTER_SANITIZE_STRING)))
		{
			//echo $_REQUEST['video_url'];
			?>
			<video autoplay="false" controls controlsList="nodownload" name="media" style="width:<?php echo $width; ?>;height:<?php echo $height; ?>;">
				<source src="<?php echo filter_var($_REQUEST['video_url'],FILTER_SANITIZE_STRING); ?>" type="video/mp4">
			</video>
			<?php
		}
		else{
			?>
			<video autoplay="false" controls controlsList="nodownload" name="media" style="width:<?php echo $width; ?>;height:<?php echo $height; ?>;">
				<source src="<?php echo $_REQUEST['video_url']; ?>" type="video/mp4">
			</video>
			<?php
		}
	}
	else
	{
		?>
		<video autoplay="false" controls controlsList="nodownload" name="media" style="width:<?php echo $width; ?>;height:<?php echo $height; ?>;">
			<source src="<?php echo $_REQUEST['video_url']; ?>" type="video/mp4">
		</video>
		<?php
	}
?>