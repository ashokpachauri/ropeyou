<div class="box shadow-sm border rounded bg-white mb-3">
	<div class="box-title border-bottom p-3">
		<h6 class="m-0">Recent Jobs</h6>
	</div>
	<div class="box-body p-3">
		<?php
			$__recent_jobs_query="SELECT * FROM jobs WHERE user_id!='".$_COOKIE['uid']."' AND status=1 ORDER BY id DESC LIMIT 5";
			$__recent_jobs_result=mysqli_query($conn,$__recent_jobs_query);
			if(mysqli_num_rows($__recent_jobs_result)>0)
			{
				while($__recent_jobs_row=mysqli_fetch_array($__recent_jobs_result))
				{
					$og_title=base_url."job/".trim(strtolower($__recent_jobs_row['job_title']))." ".trim(strtolower($__recent_jobs_row['job_company']));
					$og_title=str_replace(" ","-",$og_title);
					$og_url=$og_title."-".$latest_opening_row['id'].".html";
					?>
					<a href="<?php echo $og_url; ?>">
					   <div class="shadow-sm border rounded bg-white job-item mb-3">
						  <div class="d-flex align-items-center p-3 job-item-header">
							 <div class="overflow-hidden mr-2">
								<h6 class="font-weight-bold text-dark mb-0 text-truncate"><?php echo $__recent_jobs_row['job_title']; ?></h6>
								<div class="text-truncate text-primary"><?php echo $__recent_jobs_row['job_company']; ?></div>
								<div class="small text-gray-500"><i class="feather-map-pin"></i> <?php echo $__recent_jobs_row['job_location']; ?></div>
							 </div>
							 <img class="img-fluid ml-auto" src="<?php echo base_url; ?>alphas/<?php echo substr(strtolower($__recent_jobs_row['job_company']),0,1).".png"; ?>" alt="">
						  </div>
						  <?php getCommonPersonsOnJob($__recent_jobs_row['id'],$_COOKIE['uid']); ?>
						  <div class="p-3 job-item-footer">
							 <small class="text-gray-500"><i class="feather-clock"></i> Posted on <?php echo date("d M Y",strtotime($__recent_jobs_row['added'])); ?></small>
						  </div>
					   </div>
					</a>
					<?php
				}
			}
		?>
	</div>
</div>