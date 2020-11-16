<!DOCTYPE html>
<html lang="en">
   <head>
		<?php include_once 'head.php'; ?>
		<?php
			$user_id=$_COOKIE['uid'];
		?>
		<title>Manage Cities</title>
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
								<h6 class="m-0">Manage Cities<select id="filter_by_country" class="pull-right form-control" style="width:200px;height:30px;">
									<option value="">All</option>
									<?php
										$country_name="";
										$cquery="SELECT * FROM country ORDER BY title";
										$cresult=mysqli_query($conn,$cquery);
										while($crow=mysqli_fetch_array($cresult))
										{
											?>
											<option value="<?php echo $crow['id']; ?>" <?php if($_REQUEST['country']==$crow['id']){ echo "selected";$country_name=$crow['title']; } ?>><?php echo $crow['title']; ?></option>
											<?php
										}
									?>
								</select><a href="javascript:void(0);" class="btn btn-primary pull-right" style="margin-right:50px;"><i class="fa fa-plus"></i>&nbsp; Add New</a>&nbsp;&nbsp;&nbsp;&nbsp;</h6>
								<p class="mb-0 mt-0 small">Manage Cities <?php if($country_name!=""){ echo " of <b>".$country_name."</b> "; } ?> you are working with</p>
							</div>
							<div class="box-body p-3">
								<div class="col-md-12" style="box-shadow: 0 0 0 1px rgba(0,0,0,.15), 0 2px 3px rgba(0,0,0,.2);transition: box-shadow 83ms;background:#fff;padding:10px;padding-bottom:0px;margin: 0 0px 10px;border-radius:2px;border-bottom: 2px solid #ebebd5;">
									<div class="row">
										<?php
											$additional="";
											if(isset($_REQUEST['country']) && $_REQUEST['country']!="")
											{
												$country=$_REQUEST['country'];
												$additional=" WHERE country='$country'";
											}
											$cquery="SELECT * FROM city ".$additional." ORDER BY title";
											$cresult=mysqli_query($conn,$cquery);
										?>
										<div class="col-md-12">
											<table id="example" class="display" style="width:100%">
												<thead>
													<tr>
														<th>Sr</th>
														<th>ID</th>
														<th>Name</th>
														<th>Country</th>
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
														$country_arr=array();
														$country="";
														while($crow=mysqli_fetch_array($cresult))
														{
															$country_id=$crow['country'];
															if($country_id!=$country && !isset($country_arr[$country_id]))
															{
																$country=$country_id;
																$cnquery="SELECT * FROM country WHERE id='$country_id'";
																$cnresult=mysqli_query($conn,$cnquery);
																if(mysqli_num_rows($cnresult)>0)
																{
																	$cn_row=mysqli_fetch_array($cnresult);
																	$country_arr[$country_id]=$cn_row['title'];
																}
															}
												?>
															<tr>
																<td><?php echo $i++; ?></td>
																<td><?php echo $crow['id']; ?></td>
																<td><?php echo $crow['title']; ?></td>
																<td><?php echo $country_arr[$country_id]; ?></td>
																<td><?php echo status($crow['status']); ?></td>
																<td>
																	<?php
																		if($crow['status']=="0")
																		{
																			?>
																			<a href="javascript:void(0);" title="Activate" class="btn btn-primary"><i class="fa fa-check"></i>&nbsp;</a>
																			<?php
																		}
																		else
																		{
																			?>
																			<a href="javascript:void(0);" title="Dactivate" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;</a>
																			<?php
																		}
																	?>
																	&nbsp;|&nbsp;
																	<a href="javascript:void(0);" title="Edit" class="btn btn-success"><i class="fa fa-pencil"></i>&nbsp;</a>
																	&nbsp;|&nbsp;
																	<a href="javascript:void(0);" title="Delete" class="btn btn-danger"><i class="fa fa-trash"></i>&nbsp;</a>
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
		<?php include_once 'scripts.php';  ?>
		<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
		<script>
			var base_url="<?php echo base_url; ?>";
			$(document).ready( function () {
				$('#example').DataTable();
			});
			
			$("#filter_by_country").change(function(){
				var country=$("#filter_by_country").val();
				window.location.href=base_url+"cities?country="+country;
			});
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
