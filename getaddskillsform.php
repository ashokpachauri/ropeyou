<?php
	include_once 'connection.php';
?>
<div class="row">
	<div class="col-md-4">
		<h6>Skill Name*</h6>
		<input type="text" name="skill_name" id="skill_name" value="" class="form-control required"/>
	</div>
	<div class="col-md-4">
		<h6>Proficiency*</h6>
		<select class="form-control required" id="proficiency" name="proficiency">
			<option value="">Select </option>
			<option value="33">Basic</option>
			<option value="66">Proficient</option>
			<option value="100">Expert</option>
		</select>
	</div>
	<div class="col-md-1">
	<h6>&nbsp;</h6>
		<button type="button" name="add_skill" id="add_skill" onclick="addSkills();" class="btn btn-primary">Save</button>
	</div>
	<div class="col-md-1">
	<h6>&nbsp;</h6>
		<a href="javascript:void(0);" style="text-decoration:none;" class="remove_button"><i class='fa fa-trash' style='font-size:16px;margin-top:10px;color:red;'></i></a>
	</div>
	<script>
		var base_url=localStorage.getItem("base_url");
		function addSkills(){
			var proficiency=$("#proficiency").val().trim();;
			var skill_name=$("#skill_name").val().trim();
			if(skill_name!=="" && proficiency!="")
			{
				$.ajax({
					url:base_url+'addskills',
					type:'post',
					data:{proficiency:proficiency,skill_name:skill_name},
					success:function(data)
					{
						var parsedJson=JSON.parse(data);
						if(parsedJson.status=="success")
						{
							$(".value_wrapper").html(parsedJson.htmlData);
							$(".field_wrapper").html("");
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