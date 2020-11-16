<script src="<?php echo base_url; ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="<?php echo base_url; ?>vendor/slick/slick.min.js"></script>
<script src="<?php echo base_url; ?>js/osahan.js"></script>
<script src="https://kit.fontawesome.com/4c37ac5d89.js" crossorigin="anonymous"></script>
<script>
	var base_url="<?php echo base_url; ?>";
	localStorage.setItem("base_url",base_url);
	function playSound(filename="sounds/bing"){
		var mp3Source = '<source src="' +base_url+ filename + '.mp3" type="audio/mpeg">';
		var oggSource = '<source src="' + base_url+filename + '.ogg" type="audio/ogg">';
		var embedSource = '<embed hidden="true" autostart="true" loop="false" src="' +base_url+ filename +'.mp3">';
		document.getElementById("sound").innerHTML='<audio autoplay="autoplay">' + mp3Source + oggSource + embedSource + '</audio>';
	}
	var ajax_call = function() {
		$.ajax({
			type:'POST',
			url: base_url+"messenger-api",
			data:{endpoint:"all_unread_messages"},
			success:function(data){
				var parsedJson=JSON.parse(data);
				if(parsedJson.status=="success")
				{
					//console.log(parsedJson);
					if(parseInt(parsedJson.sound_to_play)==1)
					{
						playSound();
					}
					$("#unread_messages_count").val(parsedJson.count);
					if(parseInt(parsedJson.count)>0)
					{
						var messages_data=parsedJson.data;
						var messages_html='';
						//console.log(messages_data);
						for(loopVar=0;loopVar<parseInt(parsedJson.count);loopVar++)
						{
							var messages_arr=messages_data[loopVar];
							//console.log(messages_arr);
							messages_html=messages_html+'<a class="dropdown-item d-flex align-items-center" href="javascript:void(0);" title="'+messages_arr.s_name+'">'+
							'<div class="dropdown-list-image mr-3">'+
							'<img class="rounded-circle" src="'+messages_arr.s_user_image+'" alt="'+messages_arr.s_name+'" - "'+messages_arr.s_user_profile_title+'" style="border:1px solid #eaebec !important;">'+
							'<div class="status-indicator ';
							if(messages_arr.is_online=="1")
							{
								messages_html+='bg-success"></div>';
							}	
							else{
								messages_html+='bg-danger"></div>';
							}
							messages_html+='</div>'+
							'<div class="font-weight-bold overflow-hidden">'+
							'<div class="text-truncate">'+messages_arr.text_message+'</div>'+
							'<div class="small text-gray-500">'+messages_arr.s_name+' · '+messages_arr.datetime+'</div>'+
							'</div>'+
							'</a>';
							//console.log(messages_html);
						}
						$("#new_messages_data").html(messages_html);
					}
					else
					{
						$("#new_messages_data").html('<a class="dropdown-item text-center small text-gray-500" href="javascript:void(0)">No more new messages</a>');
					}
					$("#messages_counter").html(parseInt(parsedJson.count));
				}
				else
				{
					$("#messages_counter").html(parseInt(parsedJson.count));
					$("#new_messages_data").html('<a class="dropdown-item text-center small text-gray-500" href="javascript:void(0)">Unable to fetch new messages</a>');
				}
			}
		});
	};
	var interval = 1000 * 60 * 0.3;
	ajax_call();
	setInterval(ajax_call, interval);
</script>