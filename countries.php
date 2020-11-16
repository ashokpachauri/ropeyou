<!DOCTYPE html>
<html lang="en">
   <head>
		<?php include_once 'head.php'; ?>
		<?php
			$user_id=$_COOKIE['uid'];
			if(isset($_REQUEST['id']) && isset($_REQUEST['action']))
			{
				$action=$_REQUEST['action'];
				$query="";
				$id=$_REQUEST['id'];
				if($action=="delete")
				{
					$query="DELETE FROM country WHERE id='$id'";
					mysqli_query($conn,"DELETE FROM city WHERE country='$id'");
				}
				else if($action=="activate")
				{
					$query="UPDATE country SET status=1 WHERE id='$id'";
					mysqli_query($conn,"UPDATE city SET status=1 WHERE country='$id'");
				}
				else if($action=="dactivate")
				{
					$query="UPDATE country SET status=0 WHERE id='$id'";
					mysqli_query($conn,"UPDATE city SET status=0 WHERE country='$id'");
				}
				if(mysqli_query($conn,$query))
				{
					?>
					<script>
						alert('action performed');
						location.href="<?php echo base_url; ?>countries";
					</script>
					<?php
				}
				else{
					?>
					<script>
						alert('action does not performed');
						location.href="<?php echo base_url; ?>countries";
					</script>
					<?php
				}
			}
			if(isset($_POST['add_country']))
			{
				$country_id=$_POST['country_id'];
				$title=addslashes($_POST['title']);
				$code=$_POST['code'];
				$phonecode=$_POST['phonecode'];
				$currency=$_POST['currency'];
				$query="SELECT * FROM country WHERE (code='$code' AND (phonecode='$phonecode' OR currency='$currency')) AND id!='$country_id'";
				$result=mysqli_query($conn,$query);
				if(mysqli_num_rows($result)>0)
				{
					?>
					<script>
						alert('duplicate entries for code or phonecode or currency');
						location.href="<?php echo base_url; ?>countries";
					</script>
					<?php
				}
				else{
					$query_ini="INSERT INTO ";
					$query_end="";
					if($country_id!="")
					{
						$query_ini="UPDATE ";
						$query_end=" WHERE id='$country_id'";
					}
					$query=$query_ini." country SET title='$title',code='$code',phonecode='$phonecode',currency='$currency' ".$query_end;
					if(mysqli_query($conn,$query))
					{
						?>
						<script>
							alert('record saved.');
							location.href="<?php echo base_url; ?>countries";
						</script>
						<?php
					}
					else
					{
						?>
						<script>
							alert('record does not saves.');
							location.href="<?php echo base_url; ?>countries";
						</script>
						<?php
					}
				}
			}
		?>
		<title>Manage Countries</title>
		<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" rel="stylesheet">
		<link href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" type="text/css" rel="stylesheet">
	</head>
	<style>
		h6{
			font-size: 0.7rem !important;
		}
		::-webkit-input-placeholder { /* Chrome/Opera/Safari */
		  color: #d8dfe3 !important;
		}
		::-moz-placeholder { /* Firefox 19+ */
		  color: #d8dfe3 !important;
		}
		:-ms-input-placeholder { /* IE 10+ */
		  color: #d8dfe3 !important;
		}
		:-moz-placeholder { /* Firefox 18- */
		  color: #d8dfe3 !important;
		}
	</style>
	<body>
		<?php include_once 'header.php'; ?>
		<div class="py-4">
			<div class="container">
				<div class="row">
					<main class="col-md-12">
						<div class="border rounded bg-white mb-3">
							<div class="box-title border-bottom p-3">
								<h6 class="m-0">Manage Countries<a href="javascript:void(0);" onclick="openEditModal();" class="btn btn-primary pull-right"><i class="fa fa-plus"></i>&nbsp; Add New</a></h6>
								<p class="mb-0 mt-0 small">Manage Countries you are working with</p>
							</div>
							<div class="box-body p-3">
								<div class="col-md-12" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);transition: box-shadow 83ms;background:#fff;padding:10px;padding-bottom:0px;margin: 0 0px 10px;border-radius:2px;border-bottom: 2px solid #ebebd5;">
									<div class="row">
										<?php
											$cquery="SELECT * FROM country ORDER BY title";
											$cresult=mysqli_query($conn,$cquery);
										?>
										<div class="col-md-12">
											<table id="example" class="display" style="width:100%">
												<thead>
													<tr>
														<th>Sr</th>
														<th>ID</th>
														<th>Code</th>
														<th>Name</th>
														<th>Phonecode</th>
														<th>Currency</th>
														<th>Status</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
												<?php
													if(mysqli_num_rows($cresult)>0)
													{
														function status($st)
														{
															if($st=="1"){
																return "Active";
															}else if($st=="0"){
																return "Inactive";
															}else {
																return "NA";
															}
														}
														$i=1;
														while($crow=mysqli_fetch_array($cresult))
														{
															$country_id=$crow['id'];
												?>
															<tr>
																<td><?php echo $i++; ?></td>
																<td><?php echo $crow['id']; ?></td>
																<td id="code_<?php echo $crow['id']; ?>"><?php echo $crow['code']; ?></td>
																<td id="title_<?php echo $crow['id']; ?>"><?php echo stripslashes($crow['title']); ?></td>
																<td id="phonecode_<?php echo $crow['id']; ?>"><?php echo $crow['phonecode']; ?></td>
																<td id="currency_<?php echo $crow['id']; ?>"><?php echo $crow['currency']; ?></td>
																<td><?php echo status($crow['status']); ?></td>
																<td>
																	<?php
																		if($crow['status']=="0")
																		{
																			?>
																			<a href="<?php echo base_url.'countries?action=activate&id='.$country_id ?>" title="Activate" class="btn btn-primary"><i class="fa fa-check"></i>&nbsp;</a>
																			<?php
																		}
																		else
																		{
																			?>
																			<a href="<?php echo base_url.'countries?action=dactivate&id='.$country_id ?>" title="Inactive" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;</a>
																			<?php
																		}
																	?>
																	&nbsp;|&nbsp;
																	<a href="javascript:void(0);" title="Edit" onclick="openEditModal('<?php echo $country_id; ?>');" class="btn btn-success"><i class="fa fa-pencil"></i>&nbsp;</a>
																	&nbsp;|&nbsp;
																	<a href="<?php echo base_url.'countries?action=delete&id='.$country_id ?>" onclick="return confirm('Are you sure about deleting this record?');" title="Delete" class="btn btn-danger"><i class="fa fa-trash"></i>&nbsp;</a>
																</td>
															</tr>
												<?php
														}
													}
												?>
												<tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
				   </main>
				</div>
			</div>
		</div>
		<div class="modal fade add_country_modal" id="add_country_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="add_country_backdrop" aria-hidden="true">
			<div class="modal-dialog modal-md" role="document">
				<div class="modal-content">
					<form id="country_form" action="" method="post">
						<div class="modal-header">
							<h6 style="font-size:14px;" class="modal-title" id="add_country_backdrop">Add / Update country</h6>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-md-12 col-lg-12 col-12" id="ask_rec_form">
									<div id="country_error" style="text-align:center;color:red;"></div>
									<div class="form-group">
										<h6>Title</h6>
										<input type="hidden" id="country_id" name="country_id" value="">
										<input type="text" id="title" value="" name="title" placeholder="United States of America" class="form-control" style="width:100%;">
									</div>
									<div class="form-group">
										<h6>Country Code</h6>
										<input type="text" id="code" value="" name="code" placeholder="USA" class="form-control" style="width:100%;">
									</div>
									<div class="form-group">
										<h6>Phone Code</h6>
										<input type="text" id="phonecode" value="" name="phonecode" placeholder="+1" class="form-control" style="width:100%;">
									</div>
									<div class="form-group">
										<h6>Currency</h6>
										<input type="text" id="currency" value="" name="currency" placeholder="USD" class="form-control" style="width:100%;">
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" name="add_country" class="btn btn-primary">Save</button>
						</div>
					</form>
				</div>
			</div>
		</div>
					
		<?php include_once 'scripts.php';  ?>
		<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
		<script>
			$(document).ready( function () {
				$('#example').DataTable({stateSave: true});
			});
			function openEditModal(country_id)
			{
				$("#country_id").val('');
				$("#code").val('');
				$("#title").val('');
				$("#phonecode").val('');
				$("#currency").val('');
				if(country_id!="")
				{
					$("#country_id").val(country_id);
					$("#code").val($("#code_"+country_id).text());
					$("#title").val($("#title_"+country_id).text());
					$("#phonecode").val($("#phonecode_"+country_id).text());
					$("#currency").val($("#currency_"+country_id).text());
				}
				
				$("#add_country_modal").modal('show');
			}
		</script>
		<script>
			var placeSearch, autocomplete;

			var componentForm = {
			  street_number: 'short_name',
			  route: 'long_name',
			  locality: 'long_name',
			  administrative_area_level_1: 'short_name',
			  country: 'long_name',
			  postal_code: 'short_name'
			};

			function initAutocomplete() {
			  autocomplete = new google.maps.places.Autocomplete(
				  document.getElementById('autocomplete'), {types: ['geocode']});

			  autocomplete.setFields(['address_component']);

			  autocomplete.addListener('place_changed', fillInAddress);
			}

			function fillInAddress() {
			  var place = autocomplete.getPlace();
			  console.log(autocomplete);
			  for (var component in componentForm) {
				document.getElementById(component).value = '';
				document.getElementById(component).disabled = false;
			  }

			  for (var i = 0; i < place.address_components.length; i++) {
				var addressType = place.address_components[i].types[0];
				if (componentForm[addressType]) {
				  var val = place.address_components[i][componentForm[addressType]];
				  document.getElementById(addressType).value = val;
				}
			  }
			}

			function geolocate() {
			  if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(function(position) {
				  var geolocation = {
					lat: position.coords.latitude,
					lng: position.coords.longitude
				  };
				  var circle = new google.maps.Circle(
					  {center: geolocation, radius: position.coords.accuracy});
				  autocomplete.setBounds(circle.getBounds());
				});
			  }
			}
		</script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCa27gHtUg_79772tpFkwzruM89feLVmiI&libraries=places&callback=initAutocomplete" async defer></script>
   </body>
</html>
