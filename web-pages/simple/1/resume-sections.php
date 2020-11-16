<?php
	foreach($_WEB_MENU as $_WMENU){
		if($_WMENU['small_text']=="about")
		{
?>
		<section id="about" class="section">
			<div class="container">
				<div class="row">
					<div class="col col-md-12">
						<!--<div id="profile" class="center-block">
							<img src="<?php echo "{$_WEB_AUTHOR_IMAGE}"; ?>" style="max-width:100px;max-height:100px;">
						</div>-->
						<div id="intro-div" class="card content-wrapper">
							<!--<ul class="text-center list-inline">
								<li><a href="#0" target="_blank"><i class="ion-social-facebook"></i></a></li>
								<li><a href="#0" target="_blank"><i class="ion-social-twitter"></i></a></li>
								<li><a href="#0" target="_blank"><i class="ion-social-linkedin"></i></a></li>
								<li><a href="#0" target="_blank"><i class="ion-social-googleplus"></i></a></li>
								<li><a href="#0" target="_blank"><i class="ion-social-instagram"></i></a></li>
							</ul>-->
							<h4 style="text-align:center;">About Me</h4>
							<p style="text-align:justify !important;font-size:12px !important;">
								<?php echo $_WEB_AUTHOR_ABOUT; ?>
							</p>
						</div>
					</div>
				</div>
			</div>
		</section>
	<?php
		}
		if($_WMENU['small_text']=="experience")
		{
	?>
		<section id="experience" class="section">
			<h4 class="text-uppercase text-center">Experience</h4>
			<div class="container">
				<div class="row">
					<div class="col col-md-12 col-sm-12 col-xs-12">
						<div class="timeline center-block">
							<ul>
							<?php
								foreach($_WEB_EXP as $experience)
								{
									if(!empty($experience)){
							?>
								<li class="card" data-aos="fade-up">
									<i class="title-icon fa fa-circle"></i>
									<div class="timeline-content">
										<div class="timeline-header">
											<h3 class="text-capitalize"><?php echo $experience['designation']['title']; ?></h3>
										</div>
										<p class="sub-heading">
											<?php 
												echo $experience['company']['title'];
												if(!!$experience['company']['city'])
												{
													echo ", ".$experience['company']['city']['title'];
												}
												if(!!$experience['company']['city']['state'])
												{
													echo ", ".$experience['company']['city']['state']['title'];
												}
												if(!!$experience['company']['city']['country'])
												{
													echo ", ".$experience['company']['city']['country']['title'];
												}
											?>
										</p>
										<p class="sub-heading"><?php echo $experience['duration']; ?></p>
										<p class="content-p">
											<?php echo @strip_tags($experience['description']); ?>
										</p>
									</div>
								</li>
							<?php
									}
								}
							?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</section>
	<?php
		}
		if($_WMENU['small_text']=="skills")
		{
	?>
		<section id="skills" class="section">
			<h4 class="text-uppercase text-center">Skills</h4>
			<div class="container">
				<div class="row">
					<div class="col col-md-4 col-sm-4 col-xs-12">
						<div class="card content-wrapper skill-wrapper" style="min-height:450px;max-height:451px;">
							<h5 class="text-center skill-title">Professional</h5>
							<?php
								if($_professional_skills){
									$printed=0;
									foreach($_professional_skills as $_professional_skill)
									{
									?>
										<div class="skill-progress-div">
											<p><?php echo $_professional_skill['skill']; ?><span><?php echo $_professional_skill['proficiency']; ?>%</span></p>
											<div class="progress skill-progress" data-percent="<?php echo $_professional_skill['proficiency']; ?>%">
												<div class="determinate skill-determinate">
													<i class="skill-determinate-circle fa fa-circle"
													   data-aos="zoom-in" data-aos-delay="300" data-aos-offset="0"></i>
												</div>
											</div>
										</div>
									<?php
									}
								}
							?>
						</div>
					</div>
					<div class="col col-md-4 col-sm-4 col-xs-12">
						<div class="card content-wrapper skill-wrapper" style="min-height:450px;max-height:451px;">
							<h5 class="text-center skill-title">Personal</h5>
							<?php
								if($_personal_skills){
									$printed=0;
									foreach($_personal_skills as $_personal_skill)
									{
									?>
										<div class="skill-progress-div">
											<p><?php echo $_personal_skill['skill']; ?><span><?php echo $_personal_skill['proficiency']; ?>%</span></p>
											<div class="progress skill-progress" data-percent="<?php echo $_personal_skill['proficiency']; ?>%">
												<div class="determinate skill-determinate">
													<i class="skill-determinate-circle fa fa-circle"
													   data-aos="zoom-in" data-aos-delay="300" data-aos-offset="0"></i>
												</div>
											</div>
										</div>
									<?php
									}
								}
							?>
						</div>
					</div>
					<div class="col col-md-4 col-sm-4 col-xs-12">
						<div class="card content-wrapper skill-wrapper" style="min-height:450px;max-height:451px;">
							<h5 class="text-center skill-title">Languages</h5>
							<?php
								if($_languages){
									
									$printed=0;
									foreach($_languages as $_language)
									{
									?>
										<div class="skill-progress-div">
											<p><?php echo $_language['skill']; ?><span><?php echo $_language['proficiency']; ?>%</span></p>
											<div class="progress skill-progress" data-percent="<?php echo $_language['proficiency']; ?>%">
												<div class="determinate skill-determinate">
													<i class="skill-determinate-circle fa fa-circle"
													   data-aos="zoom-in" data-aos-delay="300" data-aos-offset="0"></i>
												</div>
											</div>
										</div>
									<?php
									}
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</section>
	<?php
		}
		if($_WMENU['small_text']=="education")
		{
	?>
		<section id="education" class="section">
			<h4 class="text-uppercase text-center">Education</h4>
			<div class="container">
				<div class="row">
					<div class="col col-md-12 col-sm-12 col-xs-12">
						<div class="timeline center-block">
							<ul>
							<?php
								foreach($_WEB_EDU as $experience)
								{
									if(!empty($experience)){
							?>
								<li class="card" data-aos="fade-up">
									<i class="title-icon fa fa-circle"></i>
									<div class="timeline-content">
										<div class="timeline-header">
											<h3 class="text-capitalize"><?php echo $experience['course']['title']; ?></h3>
										</div>
										<p class="sub-heading">
											<?php 
												echo $experience['university']['title'];
												if(!!$experience['university']['city'])
												{
													echo ", ".$experience['university']['city']['title'];
												}
												if(!!$experience['university']['city']['state'])
												{
													echo ", ".$experience['university']['city']['state']['title'];
												}
												if(!!$experience['university']['city']['country'])
												{
													echo ", ".$experience['university']['city']['country']['title'];
												}
											?>
										</p>
										<p class="sub-heading"><?php echo $experience['duration']; ?></p>
										<p class="content-p">
											<?php echo @strip_tags($experience['description']); ?>
										</p>
									</div>
								</li>
							<?php
									}
								}
							?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</section>
	<?php
		}
		if($_WMENU['small_text']=="portfolios")
		{
	?>
		<section id="portfolios" class="section">
			<h4 class="text-uppercase text-center"><?php echo $_WMENU['text'] ?></h4>
			<div class="container">
				<div class="row">
					<div class="filtr-container center-block">
						<?php 
							$_portfolio_counter=0;
							foreach($_WEB_PORTFOLIOS as $_WPORTFOLIO)
							{
								?>
								<div class="col col-md-3 col-sm-6 col-xs-12 filtr-item" data-category="1, 5">
									<div class="portfolio card">
										<figure class="hover-effect">
											<img class="img-responsive" src="<?php echo $_WPORTFOLIO['portfolios_media'][0]; ?>" alt="<?php echo $_WPORTFOLIO['portfolios']['title']; ?>">
										</figure>
										<h6 class="text-capitalize text-center"><?php echo $_WPORTFOLIO['portfolios']['title']; ?></h6>
										
									</div>
								</div>
								<?php
							}
						?>
					</div>
				</div>
			</div>
		</section>
	<?php
		}
		if($_WMENU['small_text']=="achievement")
		{
	?>
		<section id="achievement" class="section">
			<h4 class="text-uppercase text-center"><?php echo $_WMENU['text'] ?></h4>
			<div class="container">
				<div class="row">
					<?php 
						foreach($_WEB_AWARDS as $_WAWARD)
						{
							?>
								<div class="col col-md-4 col-sm-6 col-xs-12">
									<div class="achievement">
										<div class="achievement-top-bar">
											<h5 class="text-center text-capitalize"><?php echo $_WAWARD['awards']['title']; ?></h5>
										</div>
										<div class="achievement-inner">
											<div class="achievement-header">
												<div class="achievement-heading">
													<i class="text-center ion-ribbon-a"></i>
													<h6 class="text-center"><?php echo date("M Y",strtotime($_WAWARD['awards']['added'])); ?></h6>
													<p class="text-center">
														<?php echo $_WAWARD['awards']['description']; ?>
													</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php
						}
					?>
				</div>
			</div>
		</section>
	<?php
		}
		if($_WMENU['small_text']=="interest")
		{
	?>
		<section id="interest" class="section">
			<h4 class="text-uppercase text-center"><?php echo $_WMENU['text']; ?></h4>
			<div class="container">
				<div class="row">
					<div class="col col-md-12 col-sm-12 col-xs-12">
						<div class="card interest">
							<div class="row">
								<ul class="col-md-12 col-sm-12 col-xs-12 text-center list-inline">
									<?php
										foreach($_WEB_INTERESTS as $_WINTEREST)
										{
											?>
												<li class="interest-topic">
													<i class="ion-compose"></i>
													<span><?php echo $_WINTEREST['interests']['title']; ?></span>
												</li>
											<?php
										}
									?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	<?php
		}
	}
?>