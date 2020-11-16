<?php
	foreach($_WEB_MENU as $_WMENU){
		if($_WMENU['small_text']=="about")
		{
?>
		<section id="about" class="section">
			<div class="container">
				<div class="row">
					<div class="col col-md-12">

						<!-- Profile Picture [Square] -->
						<div id="profile" class="center-block">
							<img src="<?php echo "{$_WEB_AUTHOR_IMAGE}"; ?>">
						</div>
						<style>
							#intro-div>p{
								text-align:justify !important;font-size:18px !important;line-height:20px !important;font-weight:400 !important;
							}
						</style>
						<!-- Social Links -->
						<div id="intro-div" class="card content-wrapper">
							<ul class="text-center list-inline">
								<li><a href="#0" target="_blank"><i class="ion-social-facebook"></i></a></li>
								<li><a href="#0" target="_blank"><i class="ion-social-twitter"></i></a></li>
								<li><a href="#0" target="_blank"><i class="ion-social-linkedin"></i></a></li>
								<li><a href="#0" target="_blank"><i class="ion-social-googleplus"></i></a></li>
								<li><a href="#0" target="_blank"><i class="ion-social-instagram"></i></a></li>
							</ul>

							<p style="text-align:justify !important;font-size:18px !important;font-weight:300;">
								<?php echo $_WEB_AUTHOR_ABOUT; ?>
							</p>
							<div class="row">
								<!-- Download & Contact Button -->
								<div class="col col-xs-12 col-sm-12 col-md-12 text-center">
									<?php
										if($_WEB_CV)
										{
									?>
										<a href="<?php echo base_url.$_WEB_CV['resume_file']; ?>" download="<?php echo str_replace("uploads/","",$_WEB_CV['resume_file']); ?>" class="btn waves-effect waves-light btn-primary custom-btn">Download CV</a>
									<?php
										}
									?>
									<!--<a href="#contact" class="btn waves-effect waves-light btn-primary custom-btn">Contact Me</a>-->
								</div>
							</div>

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

						<!-- Timeline -->
						<div class="timeline center-block">
							<ul>
							<?php
								foreach($_WEB_EXP as $experience)
								{
									//print_r($experience);
									if(!empty($experience)){
							?>
								<li class="card" data-aos="fade-up">
									<i class="title-icon fa fa-circle"></i>
									<div class="timeline-content">

										<!-- Heading -->
										<div class="timeline-header">
											<h3 class="text-capitalize"><?php echo $experience['designation']['title']; ?></h3>
										</div>

										<!-- Organization and Period -->
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

										<!-- Job Summary -->
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
						<!-- End of Timeline -->
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

					<!-- Professional Skills -->
					<div class="col col-md-4 col-sm-4 col-xs-12">
						<div class="card content-wrapper skill-wrapper" style="min-height:450px;max-height:451px;">
							<h5 class="text-center skill-title">Professional</h5>
							<?php
								if($_professional_skills){
									$printed=0;
									foreach($_professional_skills as $_professional_skill)
									{
										if($printed<5)
										{
											$printed=$printed+1;
									?>
										<div class="skill-progress-div">
											<!-- Add Skill -->
											<p><?php echo $_professional_skill['skill']; ?><span><?php echo $_professional_skill['proficiency']; ?>%</span></p>
											<!-- Edit Value Here -->
											<div class="progress skill-progress" data-percent="<?php echo $_professional_skill['proficiency']; ?>%">
												<div class="determinate skill-determinate">
													<i class="skill-determinate-circle fa fa-circle"
													   data-aos="zoom-in" data-aos-delay="300" data-aos-offset="0"></i>
												</div>
											</div>
										</div>
										<?php
										}
										else if($printed==5)
										{
											$printed=$printed+1;
											?>
											<div class="skill-progress-div">
												<a data-toggle="modal" data-target="#professional_skills_more" href="#0">
													<figcaption><span>View More</span></figcaption>
												</a>
											</div>
											<?php
										}
									}
									?>
									<div id="professional_skills_more" class="modal" tabindex="-1" role="dialog">
										<div class="modal-dialog modal-md">
											<div class="modal-content animated zoomIn">
												<h3 class="text-capitalize text-left" style="color:#333 !important;"> <?php echo "{$_WEB_AUTHOR}"; ?>'s Professional Skills</h3>
												<div class="row">
													<div class="content col-md-12 col-sm-12 col-xs-12">
														<div class="card content-wrapper skill-wrapper">
															<?php
																foreach($_professional_skills as $_professional_skill)
																{
																?>
																	<div class="skill-progress-div">
																		<!-- Add Skill -->
																		<p><?php echo $_professional_skill['skill']; ?><span><?php echo $_professional_skill['proficiency']; ?>%</span></p>
																		<!-- Edit Value Here -->
																		<div class="progress skill-progress" data-percent="<?php echo $_professional_skill['proficiency']; ?>%">
																			<div class="determinate skill-determinate">
																				<i class="skill-determinate-circle fa fa-circle"
																				   data-aos="zoom-in" data-aos-delay="300" data-aos-offset="0"></i>
																			</div>
																		</div>
																	</div>
																<?php
																}
																?>
														</div>
														<button data-dismiss="modal" class="btn right modal-btn close-btn waves-effect waves-light btn-primary custom-btn">Close</button>
													</div>

												</div>
											</div>
										</div>
									</div>
									<?php
								}
								else{
									?>
									<div class="row">
										<div class="col-md-12">
											<img src="<?php echo base_url."images/not-provided.png"; ?>" class="img-responsive">
										</div>
									</div>
									<?php
								}
							?>
						</div>
					</div>

					<!-- Personal Skills -->
					<div class="col col-md-4 col-sm-4 col-xs-12">
						<div class="card content-wrapper skill-wrapper" style="min-height:450px;max-height:451px;">
							<h5 class="text-center skill-title">Personal</h5>
							<?php
								if($_personal_skills){
									$printed=0;
									foreach($_personal_skills as $_personal_skill)
									{
										if($printed<5)
										{
											$printed=$printed+1;
									?>
										<div class="skill-progress-div">
											<!-- Add Skill -->
											<p><?php echo $_personal_skill['skill']; ?><span><?php echo $_personal_skill['proficiency']; ?>%</span></p>
											<!-- Edit Value Here -->
											<div class="progress skill-progress" data-percent="<?php echo $_personal_skill['proficiency']; ?>%">
												<div class="determinate skill-determinate">
													<i class="skill-determinate-circle fa fa-circle"
													   data-aos="zoom-in" data-aos-delay="300" data-aos-offset="0"></i>
												</div>
											</div>
										</div>
										<?php
										}
										else if($printed==5)
										{
											$printed=$printed+1;
											?>
											<div class="skill-progress-div">
												<a data-toggle="modal" data-target="#personal_skills_more" href="#0">
													<figcaption><span>View More</span></figcaption>
												</a>
											</div>
											<?php
										}
									}
									?>
									<div id="personal_skills_more" class="modal" tabindex="-1" role="dialog">
										<div class="modal-dialog modal-md">
											<div class="modal-content animated zoomIn">
												<h3 class="text-capitalize text-left" style="color:#333 !important;"> <?php echo "{$_WEB_AUTHOR}"; ?>'s Personal Skills</h3>
												<div class="row">
													<div class="content col-md-12 col-sm-12 col-xs-12">
														<div class="card content-wrapper skill-wrapper">
															<?php
																foreach($_personal_skills as $_personal_skill)
																{
																?>
																	<div class="skill-progress-div">
																		<!-- Add Skill -->
																		<p><?php echo $_personal_skill['skill']; ?><span><?php echo $_personal_skill['proficiency']; ?>%</span></p>
																		<!-- Edit Value Here -->
																		<div class="progress skill-progress" data-percent="<?php echo $_personal_skill['proficiency']; ?>%">
																			<div class="determinate skill-determinate">
																				<i class="skill-determinate-circle fa fa-circle"
																				   data-aos="zoom-in" data-aos-delay="300" data-aos-offset="0"></i>
																			</div>
																		</div>
																	</div>
																<?php
																}
																?>
														</div>
														<button data-dismiss="modal" class="btn right modal-btn close-btn waves-effect waves-light btn-primary custom-btn">Close</button>
													</div>

												</div>
											</div>
										</div>
									</div>
									<?php
								}
								else{
									?>
									<div class="row">
										<div class="col-md-12">
											<img src="<?php echo base_url."images/not-provided.png"; ?>" class="img-responsive">
										</div>
									</div>
									<?php
								}
							?>
						</div>
					</div>

					<!-- Language Skills -->
					<div class="col col-md-4 col-sm-4 col-xs-12">
						<div class="card content-wrapper skill-wrapper" style="min-height:450px;max-height:451px;">
							<h5 class="text-center skill-title">Language</h5>
							<?php
								if($_languages){
									
									$printed=0;
									foreach($_languages as $_language)
									{
										if($printed<5)
										{
											$printed=$printed+1;
									?>
										<div class="skill-progress-div">
											<!-- Add Skill -->
											<p><?php echo $_language['skill']; ?><span><?php echo $_language['proficiency']; ?>%</span></p>
											<!-- Edit Value Here -->
											<div class="progress skill-progress" data-percent="<?php echo $_language['proficiency']; ?>%">
												<div class="determinate skill-determinate">
													<i class="skill-determinate-circle fa fa-circle"
													   data-aos="zoom-in" data-aos-delay="300" data-aos-offset="0"></i>
												</div>
											</div>
										</div>
										<?php
										}
										else if($printed==5)
										{
											$printed=$printed+1;
											?>
											<div class="skill-progress-div">
												<a data-toggle="modal" data-target="#languages_skills_more" href="#0">
													<figcaption><span>View More</span></figcaption>
												</a>
											</div>
											<?php
										}
									}
									?>
									<div id="languages_skills_more" class="modal" tabindex="-1" role="dialog">
										<div class="modal-dialog modal-md">
											<div class="modal-content animated zoomIn">
												<h3 class="text-capitalize text-left" style="color:#333 !important;"> <?php echo "{$_WEB_AUTHOR}"; ?>'s Languages</h3>
												<div class="row">
													<div class="content col-md-12 col-sm-12 col-xs-12">
														<div class="card content-wrapper skill-wrapper">
															<?php
																foreach($_languages as $_language)
																{
																?>
																	<div class="skill-progress-div">
																		<!-- Add Skill -->
																		<p><?php echo $_language['skill']; ?><span><?php echo $_language['proficiency']; ?>%</span></p>
																		<!-- Edit Value Here -->
																		<div class="progress skill-progress" data-percent="<?php echo $_language['proficiency']; ?>%">
																			<div class="determinate skill-determinate">
																				<i class="skill-determinate-circle fa fa-circle"
																				   data-aos="zoom-in" data-aos-delay="300" data-aos-offset="0"></i>
																			</div>
																		</div>
																	</div>
																<?php
																}
																?>
														</div>
														<button data-dismiss="modal" class="btn right modal-btn close-btn waves-effect waves-light btn-primary custom-btn">Close</button>
													</div>

												</div>
											</div>
										</div>
									</div>
									<?php
								}
								else{
									?>
									<div class="row">
										<div class="col-md-12">
											<img src="<?php echo base_url."images/not-provided.png"; ?>" class="img-responsive">
										</div>
									</div>
									<?php
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
									//print_r($experience);
									if(!empty($experience)){
							?>
								<li class="card" data-aos="fade-up">
									<i class="title-icon fa fa-circle"></i>
									<div class="timeline-content">

										<!-- Heading -->
										<div class="timeline-header">
											<h3 class="text-capitalize"><?php echo $experience['course']['title']; ?></h3>
										</div>

										<!-- Organization and Period -->
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

										<!-- Job Summary -->
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
		if($_WMENU['small_text']=="services")
		{
	?>
		<section id="services" class="section">
			<h4 class="text-uppercase text-center"><?php echo $_WMENU['text']; ?></h4>
			<div class="container">
				<ul class="row text-center">
					<?php
						foreach($_WEB_SERVICES as $_WSERVICE)
						{
							//print_r($_WSERVICE);
							?>
							<li class="col col-md-4 col-sm-6 col-xs-12">
								<div class="card service-item text-center" style="min-height:449px;max-height:450px;">
									<i class="ion-code" data-aos="fade" data-aos-delay="300" data-aos-offset="0"></i>
									<h6 class="text-capitalize"><?php echo $_WSERVICE['services']['title']; ?></h6>
									<p class="text-center">
										<?php echo $_WSERVICE['services']['description']; ?>
									</p>
								</div>
							</li>
							<?php
						}
					?>
				</ul>
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
											<a data-toggle="modal" data-target="#portfolio_modal_<?php echo $_portfolio_counter; ?>" href="#0">
												<figcaption><span>View Details</span></figcaption>
											</a>
										</figure>
										<h6 class="text-capitalize text-center"><?php echo $_WPORTFOLIO['portfolios']['title']; ?></h6>
									</div>
								</div>
								<div id="portfolio_modal_<?php echo $_portfolio_counter++; ?>" class="modal" tabindex="-1" role="dialog">
									<div class="modal-dialog modal-lg">
										<div class="modal-content animated zoomIn">
											<h3 class="text-capitalize text-left"><?php echo $_WPORTFOLIO['portfolios']['title']; ?></h3>
											<div class="row">
												<img class="img-responsive col-md-8 col-sm-12 col-xs-12" src="<?php echo $_WPORTFOLIO['portfolios_media'][0]; ?>" alt="<?php echo $_WPORTFOLIO['portfolios']['title']; ?>">
												<div class="content col-md-4 col-sm-12 col-xs-12">
													<p><span>Date:&nbsp;</span><?php echo date("d,M Y",strtotime($_WAWARD['portfolios']['added'])); ?></p>
													<!--<p><span>Category:&nbsp;</span> System Development</p>
													<p><span>Client:&nbsp;</span> Mr. John Doe</p>-->
													<a href="#0" target="_blank" class="btn modal-btn waves-effect waves-light btn-primary custom-btn">Live Demo</a>
													<p class="text-left">
														<?php echo $_WPORTFOLIO['portfolios']['description']; ?>
													</p>
													<button data-dismiss="modal" class="btn right modal-btn close-btn waves-effect waves-light btn-primary custom-btn">Close</button>
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
												</div>
												<a id="btn-<?php echo $_WAWARD['awards']['id']; ?>" class="btn-floating waves-effect waves-light btn-large achievement-more-btn custom-btn"
												   data-aos="zoom-in" data-aos-delay="300">
													<i class="ion-ios-arrow-down"></i>
												</a>
											</div>
											<div id="content-<?php echo $_WAWARD['awards']['id']; ?>" class="achievement-content" style="min-height:250px;max-height:251px;">
												<p class="text-center">
													<?php echo $_WAWARD['awards']['description']; ?>
												</p>
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
		if($_WMENU['small_text']=="blog")
		{
	?>
		<section id="blog" class="section">
			<h4 class="text-uppercase text-center"><?php echo $_WMENU['text']; ?></h4>
			<div class="container">
				<div class="row">
					<?php
						$blog_counter=0;
						foreach($_WEB_BLOGS as $_WBLOG)
						{
							$blog_counter=$blog_counter+1;
							if($blog_counter<=3){
					?>
						<div class="col col-md-12 col-sm-12 col-xs-12">
							<div class="card blog">
								<!--<img class="img-responsive" src="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>images/blog/blog1.jpg">-->
								<div class="blog-content">
									<div class="blog-title">
										<h6 class="text-capitalize"><a target="_blank" href="<?php echo $_WBLOG['blogs']['blog_url']; ?>"><?php echo $_WBLOG['blogs']['title']; ?></a></h6>
										<ul>
											<li><i class="ion-calendar"></i><?php echo date("d M Y",strtotime($_WBLOG['blogs']['added'])); ?></li>
											<li><i class="ion-heart"></i><?php echo $_WBLOG['blogs']['likes']; ?></li>
											<li><i class="ion-android-share-alt"></i><?php echo $_WBLOG['blogs']['shares']; ?></li>
										</ul>
										<a href="<?php echo $_WBLOG['blogs']['blog_url']; ?>" target="_blank" class="btn-floating waves-effect waves-light btn-large more-btn custom-btn"
										   data-aos="zoom-in" data-aos-delay="200">
											<i class="ion-android-more-horizontal"></i></a>
									</div>
									<p class="text-left">
										<?php echo substr(strip_tags($_WBLOG['blogs']['content']),0,500)." .... <a href='".$_WBLOG['blogs']['blog_url']."' target='_blank'>Read More</a>"; ?>
									</p>
								</div>
							</div>
						</div>
					<?php
							}
							else if($blog_counter==4){
								?>
								<div class="row text-center">
									<div class="col col-xs-12 col-sm-12 col-md-12 text-center">
										<a href="<?php echo base_url."blogger/@".$_username; ?>" target="_blank" class="text-uppercase visit-blog btn btn-large custom-btn waves-effect waves-light"
										   data-aos="zoom-in" data-aos-delay="100">MORE BLOGS</a>
									</div>
								</div>
								<?php
							}
						}
					?>
				</div>
			</div>
		</section>
	<?php
		}
		if($_WMENU['small_text']=="clients")
		{
	?>
		<section id="clients" class="section">
			<h4 class="text-uppercase text-center"><?php echo $_WMENU['text']; ?></h4>
			<div class="container">
				<div class="row">

					<div id="client-slider" class="swiper-container">
						<div class="swiper-wrapper">
							<?php
								foreach($_WEB_CLIENTS as $_WCLIENT)
								{
									?>
									<div class="col col-md-12 col-sm-12 col-xs-12 swiper-slide">
										<div class="card clients-ref">
											<div class="client-photo center-block">
												<img class="center-block" src="<?php echo $_WCLIENT['clients_media'][0]; ?>" alt="<?php echo $_WCLIENT['clients']['title']; ?>">
											</div>
											<blockquote class="text-center">
												"<?php echo $_WCLIENT['clients']['description']; ?>"
												<cite>&mdash; <?php echo $_WCLIENT['clients']['title']; ?> </cite>
											</blockquote>
										</div>
									</div>
									<?php
								}
							?>
						</div>
						<div class="swiper-pagination"></div>
					</div>

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