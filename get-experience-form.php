<?php
	include_once 'connection.php';
	if(isset($_COOKIE['uid']) && $_COOKIE['uid']!="")
	{
		$experience_id="";
		$user_id=$_COOKIE['uid'];
		if(isset($_POST['item_token']) && $_POST['item_token']!="")
		{
			$experience_id=$_POST['item_token'];
			$experience_query="SELECT * FROM users_work_experience WHERE id='$experience_id' AND user_id='$user_id'";
			$experience_result=mysqli_query($conn,$experience_query);
			if(mysqli_num_rows($experience_result)>0)
			{
				$experience_row=mysqli_fetch_array($experience_result);
				?>
					<div class="row">
						<input type="hidden" name="work_item_token" id="work_item_token" value="<?php echo $experience_id; ?>">
						<div class="col-md-12" style="margin:10px;">
							<h6 style="text-align:center;">Edit <?php echo $experience_row['title']; ?> at <?php echo $experience_row['company']; ?><a href="javascript:void(0);" class="hidden-on-dashboard" style="float:right;margin-right:30px;" onclick='$("#experience_form").html("");$("#experience_form").hide();'>Close</a></h6>
						</div>
						<div class="col-md-12" id="work_error_mesg" style="color:red;text-align:center;font-size:12px;"></div>
						<div class="col-md-4">
							<div class="form-group">
								<h6>Designation</h6>
								<input type="text" name="work_designation" id="work_designation" required class="required form-control" value="<?php echo $experience_row['title']; ?>">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<h6>From</h6>
								<input class="form-control required" type="text" name="check_in" id="check_in" placeholder="From" value="<?php echo $experience_row['from_month'].".".$experience_row['from_day'].".".$experience_row['from_year']; ?>">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<h6>To <span style="float:right !important;"><input type="checkbox" <?php if($experience_row['working']=="1"){ echo 'checked'; } ?> id="currently_working_here" name="currently_working_here" value='1'><small style="font-weight:bold;">&nbsp;Currently working here</small></span></h6>
								<input class="form-control" type="text" name="check_out" id="check_out" <?php if($experience_row['working']!="1"){ echo 'value="'.$experience_row['to_month'].'.'.$experience_row['to_day'].'.'.$experience_row['to_year'].'"'; }else { echo "disabled='disabled'"; } ?> placeholder="To">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<h6>Country*</h6>
								<div class="styled-select">
									<select class="form-control required" id="work_country" name="work_country">
										<option value="">Country</option>
										<?php
											$c_query="SELECT * FROM country WHERE status=1";
											$c_result=mysqli_query($conn,$c_query);
											$selected_country=$experience_row['country'];
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
									<select class="form-control required" id="work_city" name="work_city">
										<option value="">City</option>
										<?php
											if($selected_country!=false)
											{
												$c_query="SELECT * FROM city WHERE country='$selected_country' AND status=1";
												$c_result=mysqli_query($conn,$c_query);
												while($c_row=mysqli_fetch_array($c_result))
												{
													?>
													<option value="<?php echo $c_row['id']; ?>" <?php if(strtolower($c_row['id'])==strtolower($experience_row['city'])){ echo "selected"; } ?>><?php echo htmlentities($c_row['title']); ?></option>
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
								<h6>Company Name</h6>
								<input type="text" name="company_name" id="company_name" required class="required form-control" value="<?php echo $experience_row['company']; ?>">
							</div>
						</div>
					</div>
					<div class="form-group">
						<h6>Brief Description of Responsibilities</h6>
						<textarea name="additional_message" id="work_description" class="form-control" style="height:150px;resize:none;" placeholder="Write about your responsibilities at this position"><?php echo $experience_row['description']; ?></textarea>
					</div>
					<div class="row hidden-on-dashboard">
						<div class="col-md-2">
							<button type="button" name="whatever" id="whatever" onclick="saveExperience();" class="btn btn-primary">Save</button>
						</div>
					</div>
					<script>
						$("#work_country").change(function(){
							var base_url=localStorage.getItem("base_url");
							var country=$("#work_country").val();
							if(country!="")
							{
								$.ajax({
									url:base_url+'getcities',
									data:{country:country},
									type:'post',
									success:function(data)
									{
										var parsedJson=JSON.parse(data);
										$("#work_city").html(parsedJson.htmlData);
									}
								});
							}
							else
							{
								$("work_city").html("<option value=''>Select Country First</option>");
							}
						});
						var date_year="<?php echo $experience_row['from_year'];?>";
						var date_month="<?php echo $experience_row['from_month']; ?>";
						var date_day="<?php echo $experience_row['from_day']; ?>";
						var checkin=null;
						var checkout=null;
						var nowTemp = new Date();
						var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
						function renderScript()
						{
							
							checkin = $('#check_in').datepicker({
								format: 'mm.dd.yyyy',
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
									format: 'mm.dd.yyyy',
									onRender: function(date) {
										return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : date.valueOf() > now.valueOf() ? 'disabled' : '';
									}
								}).on('changeDate', function(ev) {
								checkout.hide();
							}).data('datepicker');
						}
						renderScript();
						$("#currently_working_here").bind('change', function(){     
							if($("#currently_working_here").is(":checked"))
							{
								$('#check_out').val('');
								$("#check_out").prop('disabled', true);
							}
							else
							{
								$("#check_out").prop('disabled', false);
								checkout = $('#check_out').datepicker({
									format: 'mm.dd.yyyy',
									onRender: function(date) {
										return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : date.valueOf() > now.valueOf() ? 'disabled' : '';
									}
								}).on('changeDate', function(ev) {
									checkout.hide();
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
					<input type="hidden" name="work_item_token" id="work_item_token" value="<?php echo $experience_id; ?>">
					<div class="col-md-12" style="margin:10px;">
						<h6 style="text-align:center;">Add New Experience<a href="javascript:void(0);" class="hidden-on-dashboard" style="float:right;margin-right:30px;"  onclick="saveExperience();">Save</a>&nbsp;&nbsp;<a href="javascript:void(0);" class="hidden-on-dashboard" style="float:right;margin-right:30px;" onclick='$("#experience_form").html("");$("#experience_form").hide();'>Close</a></h6>
					</div>
					<div class="col-md-12" id="work_error_mesg" style="color:red;text-align:center;font-size:12px;"></div>
					<div class="col-md-4">
						<div class="form-group">
							<h6>Designation</h6>
							<input type="text" name="work_designation" id="work_designation" required class="required form-control" value="">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<h6>From</h6>
							<input class="form-control required" type="text" name="check_in" id="check_in" placeholder="From" value="">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<h6>To <span style="float:right !important;"><input type="checkbox" id="currently_working_here" name="currently_working_here" value='1'><small style="font-weight:bold;">&nbsp;Currently working here</small></span></h6>
							<input class="form-control" type="text" name="check_out" id="check_out" placeholder="To">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<h6>Country*</h6>
							<div class="styled-select">
								<select class="form-control required" id="work_country" name="work_country">
									<option value="">Country</option>
									<?php
										$c_query="SELECT * FROM country WHERE status=1";
										$c_result=mysqli_query($conn,$c_query);
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
								<select class="form-control required" id="work_city" name="work_city">
									<option value="">City</option>
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<h6>Company Name</h6>
							<input type="text" name="company_name" id="company_name" required class="required form-control" value="">
						</div>
					</div>
				</div>
				<div class="form-group">
					<h6>Brief Description of Responsibilities</h6>
					<textarea name="work_description" class="form-control" id="work_description" style="height:150px;resize:none;" placeholder="Write about your responsibilities at this position"></textarea>
				</div>	
				<div class="row hidden-on-dashboard">
					<div class="col-md-11"></div>
					<div class="col-md-1">
						<button type="button" name="whatever" id="whatever" onclick="saveExperience();" class="btn btn-primary">Save</button>
					</div>
				</div>
				<script>
					$("#work_country").change(function(){
						var base_url=localStorage.getItem("base_url");
						var country=$("#work_country").val();
						if(country!="")
						{
							$.ajax({
								url:base_url+'getcities',
								data:{country:country},
								type:'post',
								success:function(data)
								{
									var parsedJson=JSON.parse(data);
									$("#work_city").html(parsedJson.htmlData);
								}
							});
						}
						else
						{
							$("work_city").html("<option value=''>Select Country First</option>");
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
							format: 'mm.dd.yyyy',
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
							format: 'mm.dd.yyyy',
							onRender: function(date) {
								return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : date.valueOf() > now.valueOf() ? 'disabled' : '';
							}
						}).on('changeDate', function(ev) {
						  checkout.hide();
						}).data('datepicker');
					}
					renderScript();
					$("#currently_working_here").bind('change', function(){     
						if($("#currently_working_here").is(":checked"))
						{
							$('#check_out').val('');
							$("#check_out").prop('disabled', true);
						}
						else
						{
							$("#check_out").prop('disabled', false);
							checkout = $('#check_out').datepicker({
								format: 'mm.dd.yyyy',
								onRender: function(date) {
									return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : date.valueOf() > now.valueOf() ? 'disabled' : '';
								}
							}).on('changeDate', function(ev) {
								checkout.hide();
							}).data('datepicker');
						}
					});
				</script>
			<?php
		}
	}
	else
	{
		echo "<h6 style='text-align:center;'>Invalid Request</h6>";
	}
?>