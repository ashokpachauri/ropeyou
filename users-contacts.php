<?php
	include_once 'connection.php';
	$user_id=$_COOKIE['uid'];
	if(isset($_COOKIE['uid']) && $_COOKIE['uid']!="")
	{
		$user_id=$_COOKIE['uid'];
		$response['status']="success";
		$contacts_query="SELECT * FROM users_contact WHERE user_id='$user_id' AND status=1 ORDER BY id ASC";
		$contacts_result=mysqli_query($conn,$contacts_query);
		$data='<div class="table-responsive" style="min-width:100%;">
				<table id="example" class="table table-striped table-bordered nowrap" style="min-width:100%">
					<thead>
						<tr>
							<th>Sr No</th>
							<th>Name</th>
							<th>Contact</th>
							<th>Type</th>
						</tr>
					</thead>
					<tbody>';
		if(mysqli_num_rows($contacts_result)>0)
		{
			$i=1;
			while($contacts_row=mysqli_fetch_array($contacts_result))
			{
				$data.='<tr>
					<td>'.$i++.'</td>
					<td>'.ucfirst($contacts_row['contact_name']).'</td>
					<td>'.$contacts_row['contact'].'</td>
					<td>'.ucfirst($contacts_row['contact_type']).'</td>
				</tr>';
			}
		}
		$data.='					</tbody>
					<tfoot>
						<tr>
							<th>Sr No</th>
							<th>Name</th>
							<th>Contact</th>
							<th>Type</th>
						</tr>
					</tfoot>
				</table>
			</div><script>
	$("#example").DataTable({"bSort" : false,dom: "Bfrtip",
        buttons: [
            "csv", "excel"
        ]});
</script>';
		$response['data']=$data;
	}
	else
	{
		$response['status']="timeout";
	}
	echo json_encode($response);
?>