<?php
	include_once 'connection.php';
	if(isset($_COOKIE['uid']) && $_COOKIE['uid']!="")
	{
		$education_id="";
		$user_id=$_COOKIE['uid'];
		if(isset($_POST['item_token']) && $_POST['item_token']!="")
		{
			$education_id=$_POST['item_token'];
			$education_query="SELECT * FROM users_education WHERE id='$education_id' AND user_id='$user_id'";
			$education_result=mysqli_query($conn,$education_query);
			if(mysqli_num_rows($education_result)>0)
			{
				$education_row=mysqli_fetch_array($education_result);
				?>
					<div class="row">
						<input type="hidden" name="edu_item_token" id="edu_item_token" value="<?php echo $education_id; ?>">
						<div class="col-md-12" style="margin:10px;">
							<h6 style="text-align:center;">Edit <?php echo $education_row['title']; ?> at <?php echo $education_row['university']; ?><a href="javascript:void(0);" class="hidden-on-dashboard" style="float:right;margin-right:20px !important;" onclick='$("#education_form").html("");$("#education_form").hide();'>Close</a></h6>
						</div>
						<div class="col-md-12" id="edu_error_mesg" style="color:red;text-align:center;font-size:12px;"></div>
						<div class="col-md-3">
							<div class="form-group">
								<h6>Course</h6>
								<input type="text" name="course" id="course" required class="required form-control" value="<?php echo $education_row['title']; ?>">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<h6>Majors</h6>
								<input type="text" name="majors" id="majors" required class="required form-control" value="<?php echo $education_row['major']; ?>">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<h6>From</h6>
								<input class="form-control required" type="text" value="<?php echo $education_row['from_month'].".".$education_row['from_day'].".".$education_row['from_year']; ?>" name="check_in" id="check_in" placeholder="From">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<h6>To <span style="float:right !important;"><input type="checkbox" id="currently_studying_here" name="currently_studying_here" value='1' <?php if($education_row['studying']=="1"){ echo 'checked'; } ?>><small style="font-weight:bold;">&nbsp;Currently studying here</small></span></h6>
								<input class="form-control" type="text" name="check_out" <?php if($education_row['studying']!="1"){ echo 'value="'.$education_row['to_month'].'.'.$education_row['to_day'].'.'.$education_row['to_year'].'"'; } else { echo "disabled='disabled'"; } ?> id="check_out" placeholder="To">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<h6>Country*</h6>
								<div class="styled-select">
									<select class="form-control required" id="edu_country" name="edu_country">
										<option value="">Country</option>
										<?php
											$c_query="SELECT * FROM country WHERE status=1";
											$c_result=mysqli_query($conn,$c_query);
											$selected_country=$education_row['country'];
											while($c_row=mysqli_fetch_array($c_result))
											{
												?>
												<option value="<?php echo $c_row['id']; ?>" <?php if(strtolower($c_row['id'])==strtolower($selected_country)){ echo "selected"; } ?>><?php echo htmlentities($c_row['title']); ?></option>
												<?php
											}
										?>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<h6>City*</h6>
								<div class="styled-select">
									<select class="form-control required" id="edu_city" name="edu_city">
										<option value="">City</option>
										<?php
											if($selected_country!=false)
											{
												$c_query="SELECT * FROM city WHERE country='$selected_country' AND status=1";
												$c_result=mysqli_query($conn,$c_query);
												while($c_row=mysqli_fetch_array($c_result))
												{
													?>
													<option value="<?php echo $c_row['id']; ?>" <?php if(strtolower($c_row['id'])==strtolower($education_row['city'])){ echo "selected"; } ?>><?php echo htmlentities($c_row['title']); ?></option>
													<?php
												}
											}
										?>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<h6>Institution Name</h6>
								<input type="text" name="institution_name" id="institution_name" required class="required form-control" value="<?php echo $education_row['university']; ?>">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<h6>Brief Description of Study</h6>
								<textarea name="edu_description" id="edu_description" class="form-control" style="height:150px;resize:none;" placeholder="Write about your learning, trainings and experiments if any."><?php echo strip_tags($education_row['description']); ?></textarea>
							</div>
						</div>
					</div>
					<div class="row hidden-on-dashboard">
						<div class="col-md-2">
							<button type="button" name="whatever" id="whatever" onclick="saveEducation();" class="btn btn-primary">Save</button>
						</div>
					</div>
					<script>
						$("#edu_country").change(function(){
							var base_url=localStorage.getItem("base_url");
							var country=$("#edu_country").val();
							if(country!="")
							{
								$.ajax({
									url:base_url+'getcities',
									data:{country:country},
									type:'post',
									success:function(data)
									{
										var parsedJson=JSON.parse(data);
										$("#edu_city").html(parsedJson.htmlData);
									}
								});
							}
							else
							{
								$("edu_city").html("<option value=''>Select Country First</option>");
							}
						});
						var date_selected=$("#checkin").val();
						var checkin=null;
						var checkout=null;
						var nowTemp = new Date();
						var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
						function renderScript()
						{
							var nowTemp = new Date();
							var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

							checkin = $('#check_in').datepicker({
								format:"mm.dd.yyyy",
								onRender: function(date) {
									return date.valueOf() > now.valueOf() ? 'disabled' : '';
							  }
							}).on('changeDate', function(ev) {
							  if (ev.date.valueOf() > checkout.date.valueOf()) {
								var newDate = new Date(ev.date)
								newDate.setDate(newDate.getDate() + 1);
								checkout.setValue(newDate);
							  }
							  checkin.hide();
							  $('#check_out')[0].focus();
							}).data('datepicker');
							checkout = $('#check_out').datepicker({
								format:"mm.dd.yyyy",
								onRender: function(date) {
									return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : date.valueOf() > now.valueOf() ? 'disabled' : '';
								}
							}).on('changeDate', function(ev) {
							  checkout.hide();
							}).data('datepicker');
						}
						renderScript();
						$("#currently_studying_here").bind('change', function(){ 
							if($("#currently_studying_here").is(":checked"))
							{
								$('#check_out').val('');
								$("#check_out").prop('disabled', true);
							}
							else
							{
								$("#check_out").prop('disabled', false);
								check_out = $('#check_out').datepicker({
									format:"mm.dd.yyyy",
									onRender: function(date) {
										return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : date.valueOf() > now.valueOf() ? 'disabled' : '';
									}
								}).on('changeDate', function(ev) {
								  check_out.hide();
								}).data('datepicker');
							}
						});
					</script>
				<?php
			}
			else
			{
				echo "<h6 style='text-align:center;'>Invalid Request</h6>";
			}
		}
		else
		{
			?>
			<div class="row">
				<input type="hidden" name="edu_item_token" id="edu_item_token" value="<?php echo $education_id; ?>">
				<div class="col-md-12" style="margin:10px;">
					<h6 style="text-align:center;">Add New Education<a href="javascript:void(0);" class="hidden-on-dashboard" style="float:right;margin-right:20px !important;" onclick='$("#education_form").html("");$("#education_form").hide();'>Close</a></h6>
				</div>
				<div class="col-md-12" id="edu_error_mesg" style="color:red;text-align:center;font-size:12px;"></div>
				<div class="col-md-3">
					<div class="form-group">
						<h6>Course</h6>
						<input type="text" name="course" id="course" required class="required form-control" value="">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<h6>Majors</h6>
						<input type="text" name="majors" id="majors" required class="required form-control" value="">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<h6>From</h6>
						<input class="form-control required" type="text" name="check_in" id="check_in" placeholder="From">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<h6>To <span style="float:right !important;"><input type="checkbox" id="currently_studying_here" name="currently_studying_here" value='1'><small style="font-weight:bold;">&nbsp;Currently studying here</small></span></h6>
						<input class="form-control" type="text" name="check_out" id="check_out" placeholder="To">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<h6>Country*</h6>
						<div class="styled-select">
							<select class="form-control required" id="edu_country" name="edu_country">
								<option value="">Country</option>
								<?php
									$c_query="SELECT * FROM country WHERE status=1";
									$c_result=mysqli_query($conn,$c_query);
									$selected_city=false;
									while($c_row=mysqli_fetch_array($c_result))
									{
										?>
										<option value="<?php echo $c_row['id']; ?>"><?php echo htmlentities($c_row['title']); ?></option>
										<?php
									}
								?>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<h6>City*</h6>
						<div class="styled-select">
							<select class="form-control required" id="edu_city" name="edu_city">
								<option value="">City</option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<h6>Institution Name</h6>
						<input type="text" name="institution_name" id="institution_name" required class="required form-control" value="">
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<h6>Brief Description of Study</h6>
						<textarea name="edu_description" id="edu_description" class="form-control" style="height:150px;resize:none;" placeholder="Write about your learning, trainings and experiments if any."></textarea>
					</div>
				</div>
			</div>
			<div class="row hidden-on-dashboard">
				<div class="col-md-2">
					<button type="button" name="whatever" id="whatever" onclick="saveEducation();" class="btn btn-primary">Save</button>
				</div>
			</div>
			<script>
				$("#edu_country").change(function(){
					var base_url=localStorage.getItem("base_url");
					var country=$("#edu_country").val();
					if(country!="")
					{
						$.ajax({
							url:base_url+'getcities',
							data:{country:country},
							type:'post',
							success:function(data)
							{
								var parsedJson=JSON.parse(data);
								$("#edu_city").html(parsedJson.htmlData);
							}
						});
					}
					else
					{
						$("edu_city").html("<option value=''>Select Country First</option>");
					}
				});
				var checkin=null;
				var checkout=null;
				var nowTemp = new Date();
				var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
				function renderScript()
				{
					var nowTemp = new Date();
					var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

					checkin = $('#check_in').datepicker({
						format:"mm.dd.yyyy",
						onRender: function(date) {
							return date.valueOf() > now.valueOf() ? 'disabled' : '';
						}
					}).on('changeDate', function(ev) {
					  if (ev.date.valueOf() > checkout.date.valueOf()) {
						var newDate = new Date(ev.date)
						newDate.setDate(newDate.getDate() + 1);
						checkout.setValue(newDate);
					  }
					  checkin.hide();
					  $('#check_out')[0].focus();
					}).data('datepicker');
					
					checkout = $('#check_out').datepicker({
						format:"mm.dd.yyyy",
						onRender: function(date) {
							return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : date.valueOf() > now.valueOf() ? 'disabled' : '';
						}
					}).on('changeDate', function(ev) {
					  checkout.hide();
					}).data('datepicker');
				}
				renderScript();
				$("#currently_studying_here").bind('change', function(){ 
					if($("#currently_studying_here").is(":checked"))
					{
						$('#check_out').val('');
						$("#check_out").prop('disabled', true);
					}
					else
					{
						$("#check_out").prop('disabled', false);
						check_out = $('#check_out').datepicker({
							format:"mm.dd.yyyy",
							onRender: function(date) {
								return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : date.valueOf() > now.valueOf() ? 'disabled' : '';
							}
						}).on('changeDate', function(ev) {
						  check_out.hide();
						}).data('datepicker');
					}
				});
			</script>
			<?php
		}
	}	
	else{
		echo "<h6 style='text-align:center;'>Invalid Request</h6>";
	}
?>