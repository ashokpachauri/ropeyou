<style>
.image-container-custom{
	position: relative;
}
.overlay {
	cursor: pointer;
	position: absolute;
	bottom: 0;
	left: 0;
	background: rgba(0, 0, 0, 0.5);
	width: 150px;
	height: 75px;
	transition: .5s ease;
	opacity: 0;
	color: white;
	font-size: 15px;
	text-align: center;
	border-bottom-left-radius: 150px;
	border-bottom-right-radius: 150px;
	right: 0;
	margin: auto;
	padding: 17px 0;
}
.image-container-custom:hover .overlay {
  opacity: 1;
}
.hidden-on-dashboard {
	display:none;
}
#progress-bar{
  appearance:none;
  width: 100%;
  color: #000;
  height: 2px;
  margin: 0 auto;
}
.pp{
  font-size: 12pt;
  color: #000;
  text-align: center;
}
</style>
<?php
	include_once 'connection.php';
	$skipped=0;
	$onboarding=getOnBoarding($_COOKIE['uid'],$skipped);
	$profile_percentage=0;
	$task_arr=array("basic_profile","bio","work_experience","education","skills","resume","profile_pic");
	if(in_array($onboarding,$task_arr))
	{
		switch($onboarding)
		{
			case "basic_profile":$profile_percentage=0;break;
			case "bio":$profile_percentage=10;break;
			case "work_experience":$profile_percentage=20;break;
			case "education":$profile_percentage=30;break;
			case "skills":$profile_percentage=40;break;
			case "resume":$profile_percentage=50;break;
			case "profile_pic":$profile_percentage=60;break;
			case "default":$profile_percentage=70;break;
		}
	}
	else
	{
		$profile_percentage=70;
	}
	$profile_pic=getUserProfileImage($_COOKIE['uid']);
	$profile_pic_arr=explode("/",$profile_pic);
	$arr=array("a.png","b.png","c.png","d.png","e.png","f.png","g.png","h.png","i.png","j.png","k.png","l.png","m.png","n.png","o.png","p.png","q.png","r.png","s.png","t.png","u.png","v.png","w.png","x.png","y.png","z.png");
	if(in_array(end($profile_pic_arr),$arr))
	{
		$onboarding="profile_pic";
	}
	include_once('fileuploader/src/php/class.fileuploader.php');
	$enabled = true;
?>
<div class="box mb-3 shadow-sm border rounded bg-white profile-box text-center">
	<div class="py-y px-3 border-bottom">
		<?php $profile=getUserProfileImage($_COOKIE['uid']); ?>
		<div class="image-container-custom" style="width:100%;">
			<img id="user_profile_picture" src="<?php echo $profile; ?>"  data-src="<?php echo $profile; ?>"  class="img-fluid mt-2 rounded-circle image" style="width:150px;height:150px;border:1px solid #eaebec !important;" alt="<?php echo $user_row['first_name']." ".$user_row['last_name']; ?>">
			<div class="overlay" onclick="personal_gallery_media_data();" data-toggle="modal" data-target="#amazing_profile_image_backdrop_modal"><i class="feather-edit"></i><br>Change</div>
			<!--<input type="file" name="profiles" data-fileuploader-default="<?php echo $profile;?>" data-fileuploader-files='<?php echo isset($avatar) ? json_encode(array($avatar)) : '';?>'<?php echo !$enabled ? ' disabled' : ''?>>-->
		
		</div>
		<h6 class="font-weight-bold text-dark mb-1 mt-4"><?php echo $user_row['first_name']." ".$user_row['last_name']; ?></h6>
		<p class="mb-0 text-muted"><?php echo $user_row['profile_title']; ?></p>
		<div class="progress progress-striped" style="margin-top:15px !important;height:0.6rem !important;"> 
			<div class="progress-bar progress-bar-success" style="background-color:#1d2f38 !important;"> Your Profile is 0% Completed.</div>
		</div>
		<p style="text-align:center;margin-bottom:-5px;">Profile Completeness</p>
	</div>
	<div class="modal fade amazing_profile_image_backdrop_modal" id="amazing_profile_image_backdrop_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="amazingProfileImageBackdrop" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-full-width" role="document">
			<div class="modal-content modal-content-full-width">
				<div class="modal-header modal-header-full-width">
					<h6 class="modal-title" id="amazingProfileImageBackdrop">Lets upload a beautiful picture to stand out of croud.</h6>
				</div>
				<div class="modal-body" style="overflow-y:auto;">											
					<div class="p-0" id="personal_gallery_media_data">												
						<div class="form" style="width:100%;">
							<input type="file" name="files" id="personal" class="gallery_media">
						</div>
					</div>
				</div>
				<div class="modal-footer-full-width">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<div class="d-flex">
		<div class="col-6 border-right px-3 py-2">
		   <p class="mb-0 text-black-50 small"><a href="<?php echo base_url; ?>u/<?php echo $user_row['username']; ?>/connections"><span class="font-weight-bold text-dark"><?php echo getUserConnectionCounts($_COOKIE['uid']); ?></span>  Connections</a></p>
		</div>
		<div class="col-6 px-3 py-2">
		   <p class="mb-0 text-black-50 small"><a href="<?php echo base_url; ?>u/<?php echo $user_row['username']; ?>/profile-views"><span class="font-weight-bold text-dark"><?php echo getUserProfileViews($_COOKIE['uid']); ?></span>  Views</a></p>
		</div>
	</div>
</div>
<script>
	var profile_percentage="<?php echo $profile_percentage; ?>";
	$(document).ready( function(){
		var x = parseInt(profile_percentage);
		window.percent = 0;
		window.progressInterval = window.setInterval( function(){
			if(window.percent < x) {
				window.percent++;
				$('.progress').addClass('progress-striped').addClass('active');
				$('.progress .progress-bar:first').removeClass().addClass('progress-bar')
				.addClass ( (percent < 40) ? 'progress-bar-danger' : ( (percent < 80) ? 'progress-bar-warning' : 'progress-bar-success' ) ) ;
				$('.progress .progress-bar:first').width(window.percent+'%');
				$('.progress .progress-bar:first').text(window.percent+'%');
			} else {
				window.clearInterval(window.progressInterval);
				// jQuery('.progress').removeClass('progress-striped').removeClass('active');
				//jQuery('.progress .progress-bar:first').text('Done!');
			}
		}, 100 );
	});
	var click_counter=0;
	function personal_gallery_media_data()
	{
		if(click_counter==0)
		{
			click_counter=click_counter+1;
			$("#personal_gallery_media_data").html('');
			$("#personal_gallery_media_data").load('gallery_media.php');
		}
	}
</script>