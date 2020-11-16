<?php
	include_once 'connection.php';
	$additional_query="";
	if(isset($_REQUEST['search']) && $_REQUEST['search']!="")
	{
		$search=$_REQUEST['search'];
		$search_arr=explode("+",$search);
		for($i=0;$i<count($search_arr);$i++)
		{
			if($search_arr[$i]!="")
			{
				if($additional_query=="")
				{
					$additional_query.=" AND (";
				}
				else
				{
					$additional_query.=" OR ";
				}
				$search_str=$search_arr[$i];
				$additional_query.="job_title LIKE '%".$search_str."%'";
				$additional_query.=" OR job_company LIKE '%".$search_str."%'";
				$additional_query.=" OR job_location LIKE '%".$search_str."%'";
				$additional_query.=" OR employment_type LIKE '%".$search_str."%'";
				$additional_query.=" OR industry LIKE '%".$search_str."%'";
				$additional_query.=" OR skills LIKE '%".$search_str."%'";
			}
			if($additional_query!="")
			{
				$additional_query.=")";
			}
		}
		//echo $additional_query;die();
	}
	if(isset($_REQUEST['industry']) && $_REQUEST['industry']!="")
	{
		$industry=$_REQUEST['industry'];
		$additional_query.=" AND industry LIKE '%".$industry."%'";
	}
?>
<div class="p-3 border-top">
	<div class="row">
		 <?php 
			$latest_opening_query="SELECT * FROM jobs WHERE status=1 ".$additional_query." ORDER BY id DESC LIMIT 10";
			$latest_opening_result=mysqli_query($conn,$latest_opening_query);
			$latest_opening_num_rows=mysqli_num_rows($latest_opening_result);
		
			if($latest_opening_num_rows>0)
			{
				while($latest_opening_row=mysqli_fetch_array($latest_opening_result))
				{
					$status_row=mysqli_fetch_array(mysqli_query($conn,"SELECT title FROM job_status WHERE id='".$latest_opening_row['status']."'"));
					$og_title=base_url."job/".trim(strtolower($latest_opening_row['job_title']))." ".trim(strtolower($latest_opening_row['job_company']));
					$og_title=str_replace(" ","-",$og_title);
					$og_url=$og_title."-".$latest_opening_row['id'].".html";
		?>
					<div class="col-md-6">
						<a href="<?php echo $og_url; ?>">
						   <div class="border job-item mb-3">
							  <div class="d-flex align-items-center p-3 job-item-header">
								 <div class="overflow-hidden mr-2">
									<h6 class="font-weight-bold text-dark mb-0 text-truncate"><?php echo $latest_opening_row['job_title']; ?></h6>
									<div class="text-truncate text-primary"><?php echo $latest_opening_row['job_company']; ?></div>
									<div class="small text-gray-500"><i class="feather-map-pin"></i><?php echo $latest_opening_row['job_location']; ?></div>
								 </div>
								 <img class="img-fluid ml-auto" src="<?php echo base_url; ?>alphas/<?php echo substr(strtolower($latest_opening_row['job_company']),0,1).".png"; ?>" alt="">
							  </div>
							  <?php
									getCommonPersonsOnJob($latest_opening_row['id'],$_COOKIE['uid']);
							  ?>
							  <div class="p-3 job-item-footer">
								 <small class="text-gray-500"><i class="feather-clock"></i><?php echo date("d M Y",strtotime($latest_opening_row['added'])); ?></small>
							  </div>
						   </div>
						</a>
					</div>
		<?php
				}
			}
			else
			{
				?>
				<div class="col-md-12">
					<p style="text-alig:center;">0 related jobs has been found.</p>
				</div>
				<?php
			}
		?>
	</div>
</div>