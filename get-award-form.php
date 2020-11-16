<?php
	include_once 'connection.php';
	if(isset($_COOKIE['uid']) && $_COOKIE['uid']!="")
	{
		$award_id="";
		$user_id=$_COOKIE['uid'];
		if(isset($_POST['item_token']) && $_POST['item_token']!="")
		{
			$award_id=$_POST['item_token'];
			$award_query="SELECT * FROM users_awards WHERE id='$award_id' AND user_id='$user_id'";
			$award_result=mysqli_query($conn,$award_query);
			if(mysqli_num_rows($award_result)>0)
			{
				$award_row=mysqli_fetch_array($award_result);
				?>
					<form id="achievement_form" action="" enctype="multipart/form-data">
						<div class="row">
							<input type="hidden" name="origin" id="origin" value="dashboard">
							<input type="hidden" name="item_token" id="award_item_token" value="<?php echo $award_id; ?>">
							<div class="col-md-12" style="margin:10px;">
								<h6 style="text-align:center;">Edit <?php echo $award_row['title']; ?><a href="javascript:void(0);" class="hidden-on-dashboard" style="float:right;margin-right:30px;" onclick='$("#award_form").html("");'>Close</a></h6>
							</div>
							<div class="col-md-12" id="award_error_mesg" style="color:red;text-align:center;font-size:12px;"></div>
							<div class="col-md-6">
								<div class="form-group">
									<h6>Title*</h6>
									<input type="text" name="award_title" id="award_title" required class="required form-control" value="<?php echo $award_row['title']; ?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<h6>File (optional)</h6>
									<input class="form-control" type="file" accept="image/*" name="award_file" id="award_file">
									<input type="hidden" name="old_award_image" id="old_award_image" value="<?php echo $award_row['image']; ?>">
								</div>
							</div>
						</div>
						<?php
							if($award_row['image']!=null && $award_row['image']!="")
							{
								?>
								<div class="row" id="image_content">
									<img src="<?php echo base_url.$award_row['image']; ?>" style="width:75px;height:75px;">
									<a href="javascript:void(0);" id="remove_award_image" onclick="$('#old_award_image').val('');$('#image_content').remove();" style="color:red;margin-top:25px;">&nbsp;&nbsp;&nbsp;Remove Image</a>
								</div>
								<?php
							}
						?>
						<div class="form-group">
							<h6>Description of Achievement*</h6>
							<textarea name="award_description" required id="award_description" class="form-control" style="height:150px;resize:none;" placeholder="Write about your achievement"><?php echo $award_row['description']; ?></textarea>
						</div>
						<div class="row hidden-on-dashboard">
							<div class="col-md-2">
								<button type="button" name="whatever" id="whatever" onclick="saveAward();" class="btn btn-primary">Save</button>
							</div>
						</div>
					</form>
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
				<form id="achievement_form" action="" enctype="multipart/form-data">
					<div class="row">
						<input type="hidden" name="origin" id="origin" value="dashboard">
						<input type="hidden" name="item_token" id="award_item_token" value="<?php echo $award_id; ?>">
						<div class="col-md-12" style="margin:10px;">
							<h6 style="text-align:center;">Add new achievement<a href="javascript:void(0);" class="hidden-on-dashboard" style="float:right;margin-right:30px;" onclick='$("#award_form").html("");'>Close</a></h6>
						</div>
						<div class="col-md-12" id="award_error_mesg" style="color:red;text-align:center;font-size:12px;"></div>
						<div class="col-md-6">
							<div class="form-group">
								<h6>Title*</h6>
								<input type="text" name="award_title" id="award_title" required class="required form-control" value="">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<input type="hidden" name="old_award_image" id="old_award_image" value="">
								<h6>File (optional)</h6>
								<input class="form-control" type="file" accept="image/*" name="award_file" id="award_file">
							</div>
						</div>
					</div>
					<div class="form-group">
						<h6>Description of Achievement*</h6>
						<textarea name="award_description" required id="award_description" class="form-control" style="height:150px;resize:none;" placeholder="Write about your achievement"></textarea>
					</div>
					<div class="row hidden-on-dashboard">
						<div class="col-md-2">
							<button type="button" name="whatever" id="whatever" onclick="saveAward();" class="btn btn-primary">Save</button>
						</div>
					</div>
				</form>
			<?php
		}
	}
	else
	{
		echo "<h6 style='text-align:center;'>Invalid Request</h6>";
	}
?>