<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
	<head>
		<?php 
			include_once 'head.php';
		?>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>VIDEO RECORDING INTERFACE</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url; ?>css/feeling.css" />
		<link href="<?php echo base_url; ?>fileuploader/dist/font/font-fileuploader.css" rel="stylesheet">
		<link href="<?php echo base_url; ?>fileuploader/dist/jquery.fileuploader.min.css" rel="stylesheet">
		<link href="<?php echo base_url; ?>fileuploader/examples/avatar/css/jquery.fileuploader-theme-avatar.css" rel="stylesheet">
	</head>
	<body>
		<style>
			.commentssec .text-gray-500 {
				color: #72808c !important;
			}
			.fileuploader {
				width: 160px;
				height: 160px;
				margin: 15px;
			}
		</style>
		<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
		<?php include_once 'header.php'; ?>
		<div class="py-1">
			<div class="container" style="min-width:99%;">
				<div class="row">
				   <!-- Main Content -->
				   <main class="col col-xl-12 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
						<div class="box rounded mb-3 osahan-share-post">
							<div class="row">
								<div class="col-md-8" style="border:1px solid #000;">
									<div class="modal fade loadMe" id="loadMe" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="loadMeBackdrop" aria-hidden="true">
										<div class="modal-dialog modal-lg" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h6 class="modal-title" id="loadMeBackdrop">Action in Progress.</h6>
												</div>
												<div class="modal-body">											
													<div class="p-2 d-flex">
														
													</div>
												</div>
												<div class="modal-body text-center">
													<div class="loader"></div>
													<div class="loader-txt">
													  <p>the action performed is in progress. please wait a little.</p>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="modal fade teleprompter_backdrop_modal" id="teleprompter_backdrop_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="amazingProfileImageBackdrop" aria-hidden="true">
										<div class="modal-dialog modal-md" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h6 class="modal-title" id="teleprompter_backdrop_modal_backdrop">Lets set the teleprompter script.</h6>
												</div>
												<div class="modal-body">
													<?php 
														$teleprompter="";
														$query="SELECT * FROM teleprompter_script WHERE is_active=1 AND user_id='$user_id'";
														$result=mysqli_query($conn,$query);
														if(mysqli_num_rows($result)>0)
														{
															$row=mysqli_fetch_array($result);
															$teleprompter=$row['teleprompter'];
														}
														else{
															$teleprompter='Hi there! My name is Sarah Smith, and I’d love to take a minute to tell you why hiring me as your marketing associate will benefit your organisation. <br/><br/>
Currently, I am completing my junior year at Oxford University. I’ll be getting my Bachelor of Business Administration degree, with a major in marketing, in summer 2023. My coursework has provided me with a strong foundation in marketing, as I have already completed courses in the business development, consumer behaviour, and business analytics system. <br/><br/>
In the last three years, I have been able to augment my education with hands on experience, attained through a couple of previous internships. In my first internship, I worked on the company’s website, doing traffic analysis, design, and over all optimisation. They saw a 15% increase in traffic by the end of the winter. <br/><br/>
My second internship, at an advertising agency, had me creating and distributing marketing print materials, such as press releases and newsletters. Because of this, I learnt the basics of Adobe Creative Suite, which is a great asset. Along with my technical skills, I’ve worked with a diversity of people in a range of roles, so I am a true team player. My supervisors have all praised my relationship building and communication skills. <br/><br/>
Finally, I just love marketing. I love making an impact, spreading the word, and witnessing the change for the business. I am dedicated & passionate, and I guarantee that you will not regret hiring me. Thanks you so very much for taking the time to listen!
												';
														}
													?>
													<div class="d-flex">
														<div class="col-12">
															<textarea name="teleprompter_script" id="teleprompter_script" rows="10" class="form-control" placeholder="Enter an attractive script to run over teleprompter."><?php if($teleprompter!=""){ echo $teleprompter; } ?></textarea>
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" id="close_modal" data-dismiss="modal">Close</button>
													<button type="button" class="btn btn-primary" onclick="saveTeleprompter();">Save</button>
												</div>
											</div>
										</div>
									</div>
							
									<div class="row">
										<div class="col-md-12" style="padding:0px;max-height:480px;min-height:479px;">
											<video playsinline autoplay muted download="nodownload" id="gum" style="width:100% !important;">    
												<source src="abc.mp4" type="video/mp4"></source>
											</video>
										</div>
										<div class="col-md-12" id="toggle_popover_display" style="background:#000;opacity:0.7;color:#fff;max-height:300px;overflow-y:hidden;border:2px solid #efefef;text-align:justify;padding-top:10px;padding-bottom:10px;position:absolute;bottom:90px;display:none;">
											<div class="row">
												<div class="col-md-12" style="padding-bottom:20px;border-bottom:2px solid #fff;">
													<button class="btn btn-primary" id="pause_animation" data-pause="0"><i class="fa fa-play"></i></button>
													<button class="btn btn-danger pull-right" onclick="$('#toggle_popover_display').toggle('display');getTelePrompter();" style="float:right !important;"><i class="fa fa-times"></i></button>
												</div>
												<div class="col-md-12" id="animation_box" style="max-height:250px;overflow:hidden;">
													<p style="font-weight:bold;font-size:22px;color:#fff;">Hi there! My name is Sarah Smith, and I’d love to take a minute to tell you why hiring me as your marketing associate will benefit your organisation. <br/><br/>
Currently, I am completing my junior year at Oxford University. I’ll be getting my Bachelor of Business Administration degree, with a major in marketing, in summer 2023. My coursework has provided me with a strong foundation in marketing, as I have already completed courses in the business development, consumer behaviour, and business analytics system. <br/><br/>
In the last three years, I have been able to augment my education with hands on experience, attained through a couple of previous internships. In my first internship, I worked on the company’s website, doing traffic analysis, design, and over all optimisation. They saw a 15% increase in traffic by the end of the winter. <br/><br/>
My second internship, at an advertising agency, had me creating and distributing marketing print materials, such as press releases and newsletters. Because of this, I learnt the basics of Adobe Creative Suite, which is a great asset. Along with my technical skills, I’ve worked with a diversity of people in a range of roles, so I am a true team player. My supervisors have all praised my relationship building and communication skills. <br/><br/>
Finally, I just love marketing. I love making an impact, spreading the word, and witnessing the change for the business. I am dedicated & passionate, and I guarantee that you will not regret hiring me. Thanks you so very much for taking the time to listen!</p>
												</div>
											</div>
										</div>
										<div class="col-md-12" style="text-align:center;padding-top:10px;padding-bottom:10px;position:absolute;bottom:2px;background:#efefef;border-top:1px solid #000;">
											<button title="Add Teleprompter Script" data-toggle="modal" data-target="#teleprompter_backdrop_modal" class="btn btn-primary" style="margin-right:10px !important;"><i class="feather-settings"></i></button>
											<button class="btn btn-warning" style="margin-right:10px !important;" id="start" data-start="1" title="Start Camera"><i class="feather-video-off"></i></button>&nbsp;&nbsp;
											
											<button class="btn btn-success" style="margin-right:10px !important;" title="Start Teleprompter" onclick="$('#toggle_popover_display').toggle('display');getTelePrompter();"><i class="fa fa-television"></i></button>
											&nbsp;&nbsp;<button class="btn btn-primary" id="record" style="margin-right:10px !important;" title="Record Video"><i class="feather-circle"></i></button>&nbsp;&nbsp;
											<button class="btn btn-danger" style="margin-right:10px !important;" id="play" title="Play"><i class="feather-play"></i></button>&nbsp;&nbsp;
											<button class="btn btn-success" style="margin-right:10px !important;" id="download" title="Save"><i class="feather-save"></i></button>&nbsp;&nbsp;
											
											<button title="Reload Proccess" onclick="reloadProcess();" class="btn btn-danger pull-right" style="float:right !important;margin-right:10px !important;"><i class="feather-refresh-cw"></i></button>
										</div>
									</div>
									 <span id="errorMsg"></span>
								</div>
								<div class="col-md-4">
									<div class="row">
										<div class="col-md-12">
											<video id="recorded" playsinline loop controls autoplay style="width:100%;">
												<source src="<?php echo base_url; ?>sample-video-cv.mp4" type="video/mp4"></source>
											</video>
										</div>
										<div class="col-md-12">
											<p style="line-height:23px;font-size:15px;font-weight:bold;margin-top:10px;">Instructions:</p>
											<p style="line-height:23px;font-size:13px;font-weight:bold;">1. Click on <button class="btn btn-warning" style="height:19px;width:19px;padding:1px;margin:0px;margin:0px;" disabled id="start1" title="Start Camera"><i class="feather-video-off"></i></button>&nbsp;&nbsp; to start your web camera.<br/>
											2. Allow access to your web-cam & Audio devices in browser popup.<br/>
											3. Wait for the video stream to appear.<br/>
											4. Set yourself in the frame.<br/>
											5. Once you are ready, click on <button class="btn btn-primary" disabled style="height:19px;width:19px;padding:1px;margin:0px;margin:0px;" id="record1" title="Record Video"><i class="feather-circle"></i></button> to start recording your video cv.<br/>
											6.If you wants to use teleprompter, click on <button disabled class="btn btn-primary" style="height:19px;width:19px;padding:1px;margin:0px;margin:0px;" ><i class="feather-settings"></i></button><br/>
											7.Once you finish recording, to stop click on <button disabled class="btn btn-primary" style="height:19px;width:19px;padding:1px;margin:0px;margin:0px;" id="record2" title="Stop Video"><i class="feather-pause"></i></button><br/>
											8. click on <button class="btn btn-danger" disabled style="height:19px;width:19px;padding:1px;margin:0px;margin:0px;" id="play1" title="Play"><i class="feather-play"></i></button>&nbsp;&nbsp;to watch the preview of recorded video cv.<br/>
											9.Click on <button class="btn btn-success" disabled style="height:19px;width:19px;padding:1px;margin:0px;margin:0px;" id="download1" title="Save"><i class="feather-save"></i></button>&nbsp;&nbsp; to save your video cv.</p>
										</div>
									</div>
								</div>
							</div>
						</div>
				   </main>
				</div>
			</div>
		</div>
		<?php include_once 'scripts.php'; ?>
		<script src="<?php echo base_url; ?>fileuploader/dist/jquery.fileuploader.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url; ?>fileuploader/examples/avatar/js/custom.js" type="text/javascript"></script>
		<script src="<?php echo base_url; ?>/js/sweetalert.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url; ?>js/feeling.js"></script>
		<script src="https://webrtc.github.io/adapter/adapter-latest.js"></script>
		<script>
			var base_url="<?php echo base_url; ?>";
			var tpeompter=0;
			
			var animation_container=$("#animation_box");
			function getTelePrompter()
			{
				if(tpeompter==0)
				{
					console.log('teleprompter started...');
					tpeompter=tpeompter+1;
					$("#animation_box").teleprompter();
					$("#pause_animation").data('pause',0);
					$("#pause_animation").html('<i class="fa fa-play"></i>');
					
				}
				else
				{
					tpeompter=0;
					$("#pause_animation").data('pause',1);
					$("#pause_animation").html('<i class="fa fa-play"></i>');
					
					animation_container.clearQueue();
					animation_container.stop();
				}
			}
			(function($) {
				  "use strict"; 
				$('[data-toggle="tooltip"]').tooltip();
				var tDate=localStorage.getItem("tDate");
				var d = new Date();
				var month = d.getMonth()+1;
				var day = d.getDate();

				var outputDate = d.getFullYear() + '/' +
					((''+month).length<2 ? '0' : '') + month + '/' +
					((''+day).length<2 ? '0' : '') + day;
					localStorage.setItem("tDate",outputDate)
					//localStorage.setItem("teleprompter",$("#animation_box").html());
				if(tDate==outputDate)
				{
					$("#animation_box").html(localStorage.getItem("teleprompter"));
					$("#teleprompter_script").val($(localStorage.getItem("teleprompter")).text().trim());
				}
				else
				{
					localStorage.setItem("teleprompter",$("#animation_box").html());
				}
			})(jQuery);
			let mediaRecorder;
			let recordedBlobs;
			const errorMsgElement = document.querySelector('span#errorMsg');
			const recordedVideo = document.querySelector('video#recorded');
			const recordButton = document.querySelector('button#record');
			recordButton.addEventListener('click', () => {
			  if (recordButton.innerHTML === '<i class="feather-circle"></i>') {
				startRecording();
			  } else {
				stopRecording();
				recordButton.innerHTML = '<i class="feather-circle"></i>';
				playButton.disabled = false;
				downloadButton.disabled = false;
			  }
			});

			const playButton = document.querySelector('button#play');
			playButton.addEventListener('click', () => {
			  const superBuffer = new Blob(recordedBlobs, {type: 'video/mp4'});
			  recordedVideo.src = null;
			  recordedVideo.srcObject = null;
			  recordedVideo.src = window.URL.createObjectURL(superBuffer);
			  recordedVideo.controls = true;
			  recordedVideo.play();
			});
			const downloadButton = document.querySelector('button#download');
			downloadButton.addEventListener('click', () => {
				const blob = new Blob(recordedBlobs, {type: 'video/mp4'});
				const url = window.URL.createObjectURL(blob);
			 
				var data = new FormData();
				data.append('profile_type',2);
				data.append('video', blob);  //Correct: sending the Blob itself
				$("#loadMe").modal({
					backdrop: "static", //remove ability to close modal with click
					keyboard: false, //remove option to close with keyboard
					show: true //Display loader!
				});
				$.ajax({
					type: "POST",
					enctype: 'multipart/form-data',
					url: base_url+"save_recorded_video_cv",
					data: data,
					processData: false,
					contentType: false,
					cache: false,
					timeout: 600000,
					success: function (data) {
						$("#loadMe").modal('hide');
						var parsedJson=JSON.parse(data);
						if(parsedJson.status=="success")
						{
							alert('Your Video CV has been uploaded successfully.');
							window.location.href=base_url+'dashboard';
						}
						else
						{
							alert('Some server side issue.Please contact developer.');
						}
					},
					error: function (e) {
						console.log("ERROR : ", e);
					}
				});
			  /*const a = document.createElement('a');
			  a.style.display = 'none';
			  a.href = url;
			  a.download = 'video_cv_recording.mp4';
			  document.body.appendChild(a);
			  a.click();
			  setTimeout(() => {
				document.body.removeChild(a);
				window.URL.revokeObjectURL(url);
			  }, 100);*/
			});

			function handleDataAvailable(event) {
			  console.log('handleDataAvailable', event);
			  if (event.data && event.data.size > 0) {
				recordedBlobs.push(event.data);
			  }
			}

			function startRecording() {
			  recordedBlobs = [];
			  let options = {mimeType: 'video/mp4;codecs=vp9,opus'};
			  if (!MediaRecorder.isTypeSupported(options.mimeType)) {
				console.error(`${options.mimeType} is not supported`);
				options = {mimeType: 'video/mp4;codecs=vp8,opus'};
				if (!MediaRecorder.isTypeSupported(options.mimeType)) {
				  console.error(`${options.mimeType} is not supported`);
				  options = {mimeType: 'video/webm'};
				  if (!MediaRecorder.isTypeSupported(options.mimeType)) {
					console.error(`${options.mimeType} is not supported`);
					options = {mimeType: ''};
				  }
				}
			  }

			  try {
				mediaRecorder = new MediaRecorder(window.stream, options);
			  } catch (e) {
				console.error('Exception while creating MediaRecorder:', e);
				errorMsgElement.innerHTML = `Exception while creating MediaRecorder: ${JSON.stringify(e)}`;
				return;
			  }

			  console.log('Created MediaRecorder', mediaRecorder, 'with options', options);
			  recordButton.innerHTML = '<i class="feather-pause"></i>';
			  playButton.disabled = true;
			  downloadButton.disabled = true;
			  mediaRecorder.onstop = (event) => {
				console.log('Recorder stopped: ', event);
				console.log('Recorded Blobs: ', recordedBlobs);
			  };
			  mediaRecorder.ondataavailable = handleDataAvailable;
			  mediaRecorder.start();
			  console.log('MediaRecorder started', mediaRecorder);
			}

			function stopRecording() {
			  mediaRecorder.stop();
			  stream.getTracks().forEach(track => track.stop());
			  //localMediaStream.stop()
			}

			function handleSuccess(stream) {
			  recordButton.disabled = false;
			  console.log('getUserMedia() got stream:', stream);
			  window.stream = stream;

			  const gumVideo = document.querySelector('video#gum');
			  gumVideo.srcObject = stream;
			}

			async function init(constraints) {
			  try {
				const stream = await navigator.mediaDevices.getUserMedia(constraints);
				handleSuccess(stream);
			  } catch (e) {
				console.error('navigator.getUserMedia error:', e);
				errorMsgElement.innerHTML = `navigator.getUserMedia error:${e.toString()}`;
			  }
			}

			document.querySelector('button#start').addEventListener('click', async () => {
				var data_start=$("#start").data("start");
				if(data_start=="1")
				{
					$("#start").data("start","0");
					$("#start").html('<i class="feather-video"></i>');
					const hasEchoCancellation = true;
					const constraints = {
					audio: {
						echoCancellation: {exact: hasEchoCancellation}
					},
					video: {
						width:540, height: 320
					}
				  };
				  await init(constraints);
				}
				else
				{
					$("#start").data("start","1");
					$("#start").html('<i class="feather-video-off"></i>');
					recordButton.disabled = true;
					playButton.disabled = true;
					downloadButton.disabled = true;
					stream.getTracks().forEach(track => track.stop());
				}
			  
			});
			(function($) {
			  $.fn.teleprompter = function() {
				return this.each(function() {
					var container = $(this),
					containerHeight,
					script = container.children().first()[0],
					maxScrollTop;
					containerHeight = this.offsetHeight;
					script.style.marginBottom = containerHeight + "px";
					script.style.marginTop = containerHeight + "px";
					maxScrollTop = this.scrollHeight - containerHeight;
					
					$("#pause_animation").click(function(){
						var data_attr=$("#pause_animation").data('pause');
						if(data_attr=="1")
						{
							$("#pause_animation").data('pause',0);
							$("#pause_animation").html('<i class="fa fa-play"></i>');
							container.clearQueue();
							container.stop();
						}
						else
						{
							$("#pause_animation").data('pause',1);
							$("#pause_animation").html('<i class="fa fa-pause"></i>');
							container.animate(
								{ scrollTop: maxScrollTop },
								maxScrollTop * 95, // duration
								"linear" // easing
							);
						}
					});
				});
			  };
			}(jQuery));
			function saveTeleprompter()
			{
				if(confirm('Page will be reloaded if any add/change are made in script,do you want to continue?'))
				{
					animation_container.clearQueue();
					animation_container.stop();
					var teleprompter=$("#teleprompter_script").val();
					teleprompter='<p style="font-weight:bold;font-size:22px;color:#fff;">'+teleprompter+'</p>';
					/*teleprompter=teleprompter+'<p style="font-weight:bold;font-size:22px;color:#fff;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+
					'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+
					'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+
					'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+
					'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+
					'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+
					'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+
					'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+
					'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+
					'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+
					'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+
					'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+
					'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+
					'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+
					'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+
					'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+
					'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+
					'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+
					'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+
					'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+
					'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+
					'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+
					'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+
					'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+
					'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+
					'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+
					'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+
					'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+
					'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+
					'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+
					'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+
					'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+
					'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+
					'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>';
					localStorage.setItem("teleprompter",teleprompter);*/
					$("#animation_box").html(teleprompter);
					window.location.reload();
				}
			}
			function reloadProcess()
			{
				if(confirm("Your previous content will be deleted, Should you reload the page?"))
				{
					window.location.reload();
				}
			}
		</script>
   </body>
</html>
