<div class="modal fade" id="gallery_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="amazingProfileImageBackdrop" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-full-width" role="document">
		<div class="modal-content modal-content-full-width">
			<div class="modal-body" style="overflow-y:auto;padding:0px;height:100%;bottom:0px;background:rgb(25, 29, 30);">											
				<div class="row" style="min-height:100%;padding:0px;margin:0px;">
					<div class="col-md-8 img-responsive text-center" style="min-height:100%;top:0px;bottom:0;left:0;position:fixed;">
						<div class="row">
							<div class="col-md-12" style="max-height:100%;min-height:99%;padding:50px;">
								<div class="row">
									<div class="col-md-12" style="padding:10px;margin-top:-10px;border-bottom:1px solid #fff;">
										<a href="javascript:void(0);" style="height:22px;width:22px;padding:1px;" onclick="cInterval();" data-dismiss="modal" class="pull-right btn btn-danger" title="Close">
											<i class="fa fa-times" style="font-size:18px;"></i>
										</a>
									</div>
									<div class="col-md-1">
										<a href="javascript:void(0);" data-src="" data-id="" data-userid="" data-caption="" class="pull-left" id="view_prev_media" title="Prev">
											<i class="fa fa-arrow-left" style="font-size:24px;color:#fff;"></i>
										</a>
									</div>
									<div class="col-md-10" style="padding-top:20px;padding-bottom:20px;">
										<div class="row">
											<div class="col-md-12" style="height:480px;">
												<img src="https://ropeyou.com/rope/uploads/jRC2wSLGr5pb.jpg" data-src="https://ropeyou.com/rope/uploads/jRC2wSLGr5pb.jpg" data-download="jRC2wSLGr5pb.jpg" id="projector_image" class="img-fluid" style="height:100%;">
											</div>
										</div>
									</div>
									<div class="col-md-1">
										<a href="javascript:void(0);" id="view_next_media" data-src="" data-id="" data-userid="" data-caption="" class="pull-right" title="Next">
											<i class="fa fa-arrow-right" style="font-size:24px;color:#fff;"></i>
										</a>
									</div>
									<div class="col-md-12 text-center" style="margin-top:30px;top:calc(100vh - 70px);position:absolute;left:0px;border-top:1px solid #fff;padding:10px;">
										<!--<a href="javascript:void(0);" title="Tag your connections">
											<i class="fa fa-tag" style="font-size:20px;color:#fff;"></i>
										</a>-->
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<a href="javascript:void(0);" id="projector_image_download" data-src="" data-download= "" download="" title="Download">
											<i class="fa fa-download" style="font-size:20px;color:#fff;"></i>
										</a>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<!--<a href="javascript:void(0);" title="Share">
											<i class="fa fa-share" style="font-size:20px;color:#fff;"></i>
										</a>-->
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<a href="javascript:void(0);" id="save_this_profile" data-id="" title="Make this your profile">
											<i class="fa fa-user" style="font-size:20px;color:#fff;"></i>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4" style="min-height:100%;padding:0px;top:0px;bottom:0;right:0;position:fixed;background:#fff;overflow-y:auto;overflow-x:hidden;">
						<div class="row">
							<div class="col-md-12" style="max-height:calc(100vh-100px);overflow-y:auto;padding:0px;margin:0px;margin-bottom:100px;">
								<div class="p-3 d-flex align-items-center w-100" href="#">
									<div class="dropdown-list-image mr-3">
										<img class="rounded-circle media_user_image" src="<?php echo $profile; ?>" alt="User Profile Picture"  style="border:1px solid #eaebec !important;">
										<div class="status-indicator bg-success"></div>
									</div>
									<div class="w-100">
										<h6 class='media_user'></h6>
										<span class='media_post_date'></span>
									</div>
								</div>
								<div class="border-top p-3 d-flex align-items-center media_text_content">
									<div class="row" style="width:100%;">
										<div class="col-md-12" id="media_text_content_wrapper" style="padding-top:5px;">
											<p style="font-size:16px;text-align:left !important;" id='media_text_content'></p>
											<button type="button" data-id="" id="edit_media_text_content" class="btn btn-secondary non_user_data">Edit</button>
										</div>
										<div class="col-md-12" id="media_text_content_editor_wrapper" style="padding-top:5px;display:none;">
											<div class="form-group non_user_data">
												<textarea rows="3" class="form-control" name="media_text_content_textarea" id="media_text_content_textarea" style="resize:none;min-width:100%;"></textarea>
											</div>
											<button type="button" data-id="" id="save_media_text_content" class="btn btn-success pull-left non_user_data">Save</button>
											<button type="button" id="close_media_text_content" onclick="$('#media_text_content_wrapper').show();$('#media_text_content_editor_wrapper').hide();" class="btn btn-danger pull-right non_user_data">Cancel</button>
										</div>
									</div>
								</div>
								<div class="border-top p-3 align-items-center">
									<div class="row">
										<div class="col-md-12" style="padding-top:5px;font-size:16px;">
											<a href="javascript:void(0);" style="float:left !important;"><i class="fa fa-thumbs-up"></i>&nbsp;&nbsp;<span id='likes_count'>0</span></a>
											<a href="javascript:void(0);" style="float:right !important;"><i class="fa fa-comments-o"></i>&nbsp;&nbsp;<span id='comments_count'>0</span> comments</a>
										</div>
									</div>
								</div>
								<div class="border-top p-2 align-items-center">
									<div class="row" id="comments_section">
									</div>
								</div>
						
							</div>
							<div class="col-md-12" style="min-height:54px;max-height:55px;position:fixed;bottom:0px;right:0px;top:calc(100vh-55px);left:calc(67%);background-color:#fff;">
								<div class="row">
									<div class="col-md-12">
										<div class="d-flex align-items-center w-100">
											<div class="dropdown-list-image mr-3">
												<img class="rounded-circle"  src="<?php  echo $profile; ?>" alt="<?php echo ucwords(strtolower($user_row['first_name'].' '.$user_row['last_name'])); ?>"  style="border:1px solid #eaebec !important;">
												<div class="status-indicator bg-success"></div>
											</div>
											<div class="w-100">
												<input type="text" data-media="" id="do_media_comment" data-userid="<?php echo $user_row['id']; ?>" data-src="<?php  echo $profile; ?>" data-username="<?php echo $user_row['username']; ?>" data-name="<?php echo ucwords(strtolower($user_row['first_name'].' '.$user_row['last_name'])); ?>" style="height:50px;border-radius:30px;width:350px;outline:none;" placeholder="Write a comment...">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="loader_overlay">
							<div class="loader_overlay_content"><img src="<?php echo base_url; ?>loader.gif" alt="Loading..."/></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
							
<script>
			var logged_in_user="<?php echo $_COOKIE['uid']; ?>";
			$("#save_this_profile").click(function(){
				var media_id=$("#save_this_profile").data("id");
				if(media_id!="" && media_id!=null)
				{
					$.ajax({
						url:base_url+'set-gallery-image-as-profile.php',
						type:'post',
						data:{id:media_id},
						success:function(response)
						{
							var parsedJson=JSON.parse(response);
							if(parsedJson.status=="success")
							{
								location.reload();
							}
							else
							{
								return false;
							}
						}
					});
				}
			});
			function initdeleteComments(comment_id)
			{
				if(comment_id!="" && comment_id!=null)
				{
					$("#comment_id_"+comment_id).click(function(){
						$.ajax({
							url:base_url+'delete-media-comments',
							type:'post',
							data:{id:comment_id},
							success:function(response)
							{
								var parsedJson=JSON.parse(response);
								if(parsedJson.status=="success")
								{
									$("#comment_div_"+comment_id).remove();
								}
								else
								{
									alert('Something went wrong please retry');
									return false;
								}
							}
						});
					});
					$("#edit_id_"+comment_id).click(function(){
						if($("#edit_comment_div_"+comment_id).length>0)
						{
							$(".edit_comment_div").hide();
							$("#edit_comment_div_"+comment_id).show('');
						}
						$("#save_comment_"+comment_id).click(function(){
							var text_content=$("#edit_comment_text_"+comment_id).val();
							var media_id=$("#edit_comment_text_"+comment_id).data('mediaid');
							var user_id=$("#edit_comment_text_"+comment_id).data('userid');
							if(text_content!="" && text_content!=null)
							{
								$.ajax({
									url:base_url+'save-media-comments',
									type:'post',
									data:{comment_id:comment_id,text_content:text_content,user_id:user_id,media_id:media_id},
									success:function(response)
									{
										var parsedJson=JSON.parse(response);
										if(parsedJson.status=="success")
										{
											loadAjax(media_id);
										}
										else
										{
											alert('Something went wrong please retry');
											return false;
										}
									}
								});
							}
						});
						
					});
				}
			}
			function loadAjax(img_id){
				$.ajax({
					url:base_url+'get-media-comments',
					type:'post',
					data:{id:img_id},
					success:function(res)
					{
						var parsedJson=JSON.parse(res);
						console.log(res);
						if(parsedJson.user_id==logged_in_user)
						{
							$(".non_user_data").show();
						}
						else
						{
							$(".non_user_data").hide();
						}
						$(".media_user_image").prop("src",parsedJson.user.profile_image);
						$(".media_user").html(parsedJson.user.name);
						$(".media_post_date").html(parsedJson.date);
						if(parsedJson.text_content!='' && parsedJson.text_content!=null)
						{
							$("#media_text_content").html(parsedJson.text_content);
							$(".media_text_content").show();
						}
						else
						{
							if(parsedJson.user_id==logged_in_user)
							{
								$("#media_text_content").html('Click on edit button to add some description about this media.');
							}
							else{
								$("#media_text_content").html('');
							}
							$("#media_text_content").show();
						}
						
						var comments_section="";
						$("#comments_count").html(parseInt(parsedJson.count));
						$("#likes_count").html(parseInt(parsedJson.likes_count));
						if(parseInt(parsedJson.count)>0)
						{
							$("#comments_section").html('');
							var comments=parsedJson.comments;
							for(i=0;i<comments.length;i++)
							{
								var comment=comments[i];
								comments_section='<div class="col-md-12" id="comment_div_'+comment.id+'">'+
									'<div class="p-2 d-flex align-items-center w-100">'+
										'<div class="dropdown-list-image mr-3">'+
											'<img class="rounded-circle" data-mediaid="" src="'+comment.user.profile_image+'" alt="'+comment.user.name+'"  style="border:1px solid #eaebec !important;">'+
											'<div class="status-indicator bg-success"></div>'+
										'</div>'+
										'<div class="w-100">'+
											'<h6>'+comment.user.name;
											if(comment.user_id==logged_in_user)
											{
												comments_section+='<span class="pull-right delete_comment" title="Delete" style="cursor:pointer;" id="comment_id_'+comment.id+'" data-id="comment_id_'+comment.id+'"><i class="fa fa-trash"></i></span><span class="pull-right edit_comment" style="cursor:pointer;margin-right:15px;" id="edit_id_'+comment.id+'" data-id="comment_id_'+comment.id+'" title="Edit"><i class="fa fa-pencil"></i></span>';
											}
											comments_section+='</h6><span>'+comment.date+'</span>'+
											'<p style="font-size:16px;" id="comment_text_'+comment.id+'">'+comment.text_content+
											'</p>'+
										'</div>'+
									'</div>'+
									'<div class="row edit_comment_div" id="edit_comment_div_'+comment.id+'" style="display:none;">'+
									'<div class="col-md-10" style="padding:10px;">'+
									'<input type="text" name="edit_comment_text" class="form-control" style="height:45px;" data-mediaid="'+comment.media_id+'" data-userid="'+comment.user_id+'" value="'+comment.text_content+'" id="edit_comment_text_'+comment.id+'"></div>'+
									'<div class="col-md-2" style="padding:10px;">'+
									'<button class="pull-right btn btn-success" style="height:45px;" type="button" id="save_comment_'+comment.id+'">Save</button></div></div>'+
								'</div>';
								$("#comments_section").append(comments_section);
								initdeleteComments(comment.id);
							}
						}
						$(".loader_overlay").hide();
					}
				});
			}
			var interval=null;
			$("#view_prev_media").click(function(){
				var image_id=$("#view_prev_media").data("id");
				if(image_id!="" && image_id!=null)
				{
					loadImage(image_id);
				}
			});
			$("#view_next_media").click(function(){
				var image_id=$("#view_next_media").data("id");
				if(image_id!="" && image_id!=null)
				{
					loadImage(image_id);
					$("#save_this_profile").data("id",image_id);
				}
				else
				{
					$("#save_this_profile").data("id","");
				}
			});
			function loadImage(image_id)
			{
				cInterval();
				$(".loader_overlay").show();
				$("#comments_section").html('');
				$("#media_text_content_editor_wrapper").hide();
				$("#media_text_content_wrapper").show();
				$("#edit_media_text_content").data("id",image_id);
				$("#save_media_text_content").data("id",image_id);
				$(".loader_overlay").show();
				var img_src=$("#media_file_clicked_"+image_id).data('src');
				var img_title=$("#media_file_clicked_"+image_id).data('caption');
				
				//========================================
				
				var data_next_id=$("#media_file_clicked_"+image_id).data('nextid');
				var data_next_caption=$("#media_file_clicked_"+image_id).data('nextcaption');
				var data_next_src=$("#media_file_clicked_"+image_id).data('nextsrc');
				var data_next_user_id=$("#media_file_clicked_"+image_id).data('nextuserid');
				$("#view_next_media").data("id",data_next_id);
				$("#view_next_media").data("caption",data_next_caption);
				$("#view_next_media").data("src",data_next_src);
				$("#view_next_media").data("userid",data_next_user_id);
				
				//========================================
				
				var data_prev_id=$("#media_file_clicked_"+image_id).data('previd');
				var data_prev_caption=$("#media_file_clicked_"+image_id).data('prevcaption');
				var data_prev_src=$("#media_file_clicked_"+image_id).data('prevsrc');
				var data_prev_user_id=$("#media_file_clicked_"+image_id).data('prevuserid');
				$("#view_prev_media").data("id",data_prev_id);
				$("#view_prev_media").data("caption",data_prev_caption);
				$("#view_prev_media").data("src",data_prev_src);
				$("#view_prev_media").data("userid",data_prev_user_id);
				//========================================
				
				$("#projector_image").data("download",img_title);
				$("#projector_image").data("src",img_src);
				$("#projector_image").prop("src",img_src);
				$("#projector_image_download").data("download",img_title);
				$("#projector_image_download").prop("download",img_title);
				$("#projector_image_download").data("src",img_src);
				$("#projector_image_download").attr("href",img_src);
				loadAjax(image_id);
				interval=setInterval(function(){ loadAjax(image_id); }, 100000);
				$("#do_media_comment").data("media",image_id);
			}
			$(".media_file_clicked").click(function(){
				var image_id=$(this).data('id');
				loadImage(image_id);
				$("#save_this_profile").data("id",image_id);
				$("#gallery_modal").modal('show');
			});
			function cInterval(){
				clearInterval(interval);
			}
			$("#do_media_comment").on('keyup', function (e) {
				if (e.key === 'Enter' || e.keyCode === 13) {
					var media_id=$("#do_media_comment").data("media");
					var user_id=$("#do_media_comment").data("userid");
					var name=$("#do_media_comment").data("name");
					var profile_image=$("#do_media_comment").data("src");
					var username=$("#do_media_comment").data("username");
					var text_content=$("#do_media_comment").val();
					var date='Just Now';
					if(text_content!="" && text_content!=null)
					{
						$.ajax({
							url:base_url+'save-media-comments',
							type:'post',
							data:{media_id:media_id,user_id:user_id,text_content:text_content,comment_id:''},
							success:function(response)
							{
								var parsedJson=JSON.parse(response);
								if(parsedJson.status=="success")
								{
									var comments_section="";
									comments_section+='<div class="col-md-12" id="comment_div_'+parsedJson.id+'">'+
										'<div class="p-2 d-flex align-items-center w-100">'+
											'<div class="dropdown-list-image mr-3">'+
												'<img class="rounded-circle" data-mediaid="" src="'+profile_image+'" alt="'+name+'"  style="border:1px solid #eaebec !important;">'+
												'<div class="status-indicator bg-success"></div>'+
											'</div>'+
											'<div class="w-100">'+
												'<h6>'+name;
											comments_section+='<span class="pull-right text-danger" style="cursor:pointer;" id="comment_id_'+parsedJson.id+'" data-id="'+parsedJson.id+'"><i class="fa fa-trash"></i></span><span class="pull-right edit_comment" style="cursor:pointer;margin-right:15px;" id="edit_id_'+parsedJson.id+'" data-id="comment_id_'+parsedJson.id+'" title="Edit"><i class="fa fa-pencil"></i></span>';
											
											comments_section+='</h6>';
												comments_section+='<span>'+date+'</span>'+
												'<p style="font-size:16px;" id="comment_text_'+parsedJson.id+'">'+text_content+
												'</p>'+
											'</div>'+
										'</div>'+
										'<div class="row edit_comment_div" id="edit_comment_div_'+parsedJson.id+'" style="display:none;">'+
									'<div class="col-md-10" style="padding:10px;">'+
									'<input type="text" name="edit_comment_text" class="form-control" style="height:45px;" data-mediaid="'+parsedJson.media_id+'" data-userid="'+parsedJson.user_id+'" value="'+text_content+'" id="edit_comment_text_'+parsedJson.id+'"></div>'+
									'<div class="col-md-2" style="padding:10px;">'+
									'<button class="pull-right btn btn-success" type="button" style="height:45px;" id="save_comment_'+parsedJson.id+'">Save</button></div></div>'+
									'</div>';
									$("#comments_section").append(comments_section);
									initdeleteComments(parsedJson.id);
									$("#do_media_comment").val('');
								}
								else
								{
									alert('Something went wrong please retry');
									return false;
								}
							}
						});
					}
					
				}
			});
			$("#edit_media_text_content").click(function(){
				var image_id=$("#edit_media_text_content").data("id");
				$("#save_media_text_content").data("id",image_id);
				var media_text_content=$("#media_text_content").text();
				if(media_text_content=="Click on edit button to add some description about this media.")
				{
					media_text_content="";
				}
				$("#media_text_content_wrapper").hide();
				$("#media_text_content_editor_wrapper").show();
				$("#media_text_content_textarea").val(media_text_content);
			});
			$("#save_media_text_content").click(function(){
				var image_id=$("#save_media_text_content").data("id");
				var media_text_content=$("#media_text_content_textarea").val();
				if(image_id!="" && image_id!=null)
				{
					$.ajax({
						url:base_url+'save-media-content-to-gallery',
						type:'post',
						data:{id:image_id,text_content:media_text_content},
						success:function(response)
						{
							var parsedJson=JSON.parse(response);
							if(media_text_content=="")
							{
								media_text_content="Click on edit button to add some description about this media.";
							}
							if(parsedJson.status=="success")
							{
								$("#media_text_content_wrapper").show();
								$("#media_text_content_editor_wrapper").hide();
								$("#media_text_content").text(media_text_content);
							}
							else
							{
								$("#media_text_content_wrapper").show();
								$("#media_text_content_editor_wrapper").hide();
								return false;
							}
						}
					});
				}
				
			});
		</script>