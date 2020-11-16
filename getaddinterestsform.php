<?php
	include_once 'connection.php';
?>
<div class="row">
	<div class="col-md-6">
		<h6>Interest*</h6>
		<input type="text" name="interest_title" id="interest_title" value="" class="form-control required"/>
	</div>
	<div class="col-md-2">
	<h6>&nbsp;</h6>
		<button type="button" name="add_interest" id="add_interest" onclick="addInterest();" class="btn btn-primary">Save</button>
	</div>
	<div class="col-md-2">
	<h6>&nbsp;</h6>
		<a href="javascript:void(0);" class="remove_interest_button"><i class="fa fa-minus" style="font-size:20px;"></i></a>
	</div>
	<script>
		var base_url=localStorage.getItem("base_url");
		function addInterest(){
			var interest_title=$("#interest_title").val().trim();
			if(interest_title!=="")
			{
				$.ajax({
					url:base_url+'addinterests',
					type:'post',
					data:{interest_title:interest_title},
					success:function(data)
					{
						var parsedJson=JSON.parse(data);
						if(parsedJson.status=="success")
						{
							$(".value_wrapper_1").html(parsedJson.htmlData);
							$(".field_wrapper_1").html("");
						}
					}
				});
			}
			else
			{
				alert('please fill required fields');
			}
		}
	</script>
</div>