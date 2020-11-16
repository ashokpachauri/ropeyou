// Start upload preview image
//$(".gambar").attr("src", "https://user.gadjian.com/static/images/personnel_boy.png");
						var $uploadCrop,
						tempFilename,
						rawImg=$("#banner_image_preview").attr("data-sr"),
						imageId;
						function readFile(input) {
				 			if (input.files && input.files[0]) {
				              var reader = new FileReader();
					            reader.onload = function (e) {
									$('.upload-demo').addClass('ready');
									$('#editBasicInfoModal').modal('show');
						            rawImg = e.target.result;
					            }
					            reader.readAsDataURL(input.files[0]);
					        }
					        else {
						        swal("Sorry - you're browser doesn't support the FileReader API");
						    }
						}

						$uploadCrop = $('#upload-demo').croppie({
							viewport: {
								width: 400,
								height: 200,
							},
							boundary: { width: 450, height: 252 },
							showZoomer: false,
							enforceBoundary: true,
							enableExif: true
						});
						$('#editBasicInfoModal').on('shown.bs.modal', function(){
							// alert('Shown pop');
							$uploadCrop.croppie('bind', {
				        		url: rawImg
				        	}).then(function(){
				        		console.log('jQuery bind complete');
				        	});
						});

						$('.baner_image_input').on('change', function () { 
							imageId = $(this).data('id'); tempFilename = $(this).val();
							$('#cancelCropBtn').data('id', imageId); readFile(this); });
						$('#cropImageBtn').on('click', function (ev) {
							$uploadCrop.croppie('result', {
								type: 'base64',
								format: 'jpeg',
								size: {width:700, height: 350}
							}).then(function (resp) {
								//var image=resp;
								$('#banner_image_preview').attr('src', resp);
								$('#editBasicInfoModal').modal('hide');
								var company_id=$("#company_id").val();
								var base_url=$("#base_url").val();
								return $.ajax({url:base_url+'save-company-banner-image',data:{banner_image:resp,company_id:company_id},type:'post',success:function(response){ var parsedJson=JSON.parse(response); if(parsedJson.status=="error") { $("#banner_image_preview").attr("src",$("#banner_image_preview").attr("data-sr")); console.log(parsedJson.message);alert(parsedJson.message); } else { $("#banner_image_preview").attr("data-sr",$("#banner_image_preview").attr("src")); }}});
								
							});
						});
				// End upload preview image