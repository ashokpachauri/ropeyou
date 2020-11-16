$(document).ready(function(){
	var last_html="";
	$(".feeling").on("click",function(){   // like click
		var data_feeling = $(this).attr("data-feeling");
		last_html=$(this).parent().parent().parent().find(".like-details").html();
		last_html=last_html.replace("You ","");
		if(last_html!="")
		{
			last_html=last_html.replace("and ","");
			last_html="and "+last_html;
		}
		$(this).parent().parent().parent().find(".like-details").html("You "+last_html);
		$(this).parent().parent().find(".like-btn-emo").removeClass().addClass('like-btn-emo').addClass('like-btn-'+data_feeling.toLowerCase());
		$(this).parent().parent().find(".like-btn-text").text(data_feeling).removeClass().addClass('like-btn-text').addClass('like-btn-text-'+data_feeling.toLowerCase()).addClass("active");;
		
		if(data_feeling == "Like")
		{ $(this).parent().parent().find(".like-emo").data('feelings',"like");$(this).parent().parent().find(".like-emo").html('<span class="like-btn-like"></span>'); }
		else
		{ $(this).parent().parent().find(".like-emo").data('feelings',data_feeling.toLowerCase());$(this).parent().parent().find(".like-emo").html('<span class="like-btn-like"></span><span class="like-btn-'+data_feeling.toLowerCase()+'"></span>'); }
		var user_id=localStorage.getItem("uid");
		var base_url=localStorage.getItem("base_url");
		var post_id= $(this).data("post");
		$.ajax({
			url:base_url+'get-user-post-like',
			type:'post',
			data:{post_id:post_id,data_feeling:data_feeling},
			success:function(res){
		  
			}
		});
 });
  
  $(".like-btn-text").on("click",function(){ // undo like click
	  if($(this).hasClass("active")){
		  $(this).text("Like").removeClass().addClass('like-btn-text');
		  $(this).parent().find(".like-btn-emo").removeClass().addClass('like-btn-emo').addClass("like-btn-default");
		  $(this).parent().find(".like-emo").html('<span class="like-btn-like"></span>');
		  var last_html=$(this).parent().find(".like-details").html();
		  var data_feeling= $(this).parent().find(".like-emo").data('feelings');
		  $(this).parent().find(".like-details").html(last_html.replace("You and "));
		  var user_id=localStorage.getItem("uid");
		  var base_url=localStorage.getItem("base_url");
		  var post_id= $(this).data("post");
		  $.ajax({
			  url:base_url+'get-user-post-unlike',
			  type:'post',
			  data:{post_id:post_id,data_feeling:data_feeling},
			  success:function(res){
				  
			  }
		  });
	  }	  
  });
  
});