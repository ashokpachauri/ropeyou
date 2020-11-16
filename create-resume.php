<!DOCTYPE html>
<html lang="en">
   <head>
		<?php include_once 'head_without_session.php'; ?>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
		<title>Create your resume | RopeYou Connects</title>
	</head>
	<body>
		<style>
			.overlap-rounded-circle>.rounded-circle{
				width:25px;
				height:25px;
			}
			.network-item-body{
				min-height: 39px;
				max-height: 40px;
			}
		</style>
		<?php include_once 'header.php'; ?>
		<div class="container">
			<div class="row">
				<main class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
					<h5 class="pt-3 pr-3 border-bottom mb-0 pb-3">Start creating your resume by selecting a template.</h5>
					<div class="row">
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12" style="text-align:center;">
							<img src="<?php echo base_url; ?>descent.png" class="img-responsive" style="align:center;margin-top:40px;border:1px solid gray;border-radius:5px;padding:10px;max-width:300px;min-width:299px;min-height:300px;max-height:301px;">
							<br/><a href="<?php echo base_url; ?>provide-resume-information.php?resume_id=1" class="btn btn-primary mt-3">Start Using</a>
						</div>
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12" style="text-align:center;">
							<img src="<?php echo base_url; ?>iconic.png" class="img-responsive" style="align:center;margin-top:40px;border:1px solid gray;border-radius:5px;padding:10px;max-width:300px;min-width:299px;min-height:300px;max-height:301px;">
							<br/><a href="<?php echo base_url; ?>provide-resume-information.php?resume_id=2" class="btn btn-primary mt-3">Start Using</a>
						</div>
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12" style="text-align:center;">
							<img src="<?php echo base_url; ?>default.png" class="img-responsive" style="align:center;margin-top:40px;border:1px solid gray;border-radius:5px;padding:10px;max-width:300px;min-width:299px;min-height:300px;max-height:301px;">
							<br/><a href="<?php echo base_url; ?>provide-resume-information.php?resume_id=3" class="btn btn-primary mt-3">Start Using</a>
						</div>
					</div>
				</main>
			</div>
		</div>
		<?php include_once 'scripts.php';  ?>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
		<script>
			var user_id="<?php echo $_COOKIE['uid']; ?>";
			var base_url="<?php echo base_url; ?>";
			
			function loadImage(div)
			{
				$("."+div+" img").css("cursor","pointer");
				$("."+div+" img").click(function(){
					$("#backdrop_image_to_show").attr("src",$(this).attr("src"));
					$("#image_backdrop_modal").modal('show');
				});
			}
			loadImage("py-4");
		</script>
	</body>
</html>
