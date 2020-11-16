<div id="v-card-holder" class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">

                <!-- V-CARD -->
                <div id="v-card" class="card">

                    <!-- PROFILE PICTURE -->
                    <div id="profile" class="right">
                        <img alt="profile-image" class="img-responsive" src="<?php echo $_WEB_AUTHOR_IMAGE; ?>">
                        <div class="slant"></div>

                        <!--EMPTY PLUS BUTTON-->
                        <!--<div class="btn-floating btn-large add-btn"><i class="material-icons">add</i></div>-->

                        <!--VIDEO PLAY BUTTON-->
                        <div id="button-holder" class="btn-holder">
                            <div id="play-btn" class="btn-floating btn-large btn-play">
                                <i id="icon-play" class="material-icons">play_arrow</i>
                            </div>
                        </div>
                    </div>
                    <!--VIDEO CLOSE BUTTON-->
                    <div id="close-btn" class="btn-floating icon-close">
                        <i class="fa fa-close"></i>
                    </div>

                    <div class="card-content">

                        <!-- NAME & STATUS -->
                        <div class="info-headings">
                            <h4 class="text-uppercase left"><?php echo "{$_WEB_AUTHOR}"; ?></h4>
                            <h6 class="text-capitalize left"><?php echo "{$_WEB_DESIGNATION}"; ?></h6>
                        </div>

                        <!-- CONTACT INFO -->
                        <div class="infos">
                            <ul class="profile-list">
                                <li class="clearfix">
                                    <span class="title"><i class="material-icons">email</i></span>
                                    <span class="content">
										<?php
											if($_users_row['email']!="")
											{
												echo $_users_row['email'];
											}
											else{ echo "NA"; }
										?>
									</span>
                                </li>
                                <li class="clearfix">
                                    <span class="title"><i class="material-icons">language</i></span>
                                    <span class="content"><?php
											if($_users_personal_row['website']!="")
											{
												echo $_users_personal_row['website'];
											}
											else{ echo "NA"; }
										?></span>
                                </li>
                                <li class="clearfix">
                                    <span class="title"><i class="material-icons">phone</i></span>
                                    <span class="content"><?php
											if($_users_row['mobile']!="")
											{
												echo $_users_row['mobile'];
											}
											else{ echo "NA"; }
										?></span>
                                </li>
                            </ul>
                        </div>

                        <!--LINKS-->
                        <div class="links">
                            <!-- FACEBOOK-->
                            <a href="<?php
											if($_users_personal_row['fb_p']!="")
											{
												echo $_users_personal_row['fb_p'];
											}else { echo '#'; } ?>" id="first_one"
                               class="social btn-floating indigo"><i
                                    class="fa fa-facebook"></i></a>
                            <a href="<?php
											if($_users_personal_row['tw_p']!="")
											{
												echo $_users_personal_row['tw_p'];
											}
											else{ echo "#"; }
										?>" class="social  btn-floating blue"><i
                                    class="fa fa-twitter"></i></a>
                            <a href="<?php
											if($_users_personal_row['ig_p']!="")
											{
												echo $_users_personal_row['ig_p'];
											}
											else{ echo "#"; }
										?>" class="social  btn-floating red"><i
                                    class="fa fa-instagram"></i></a>
                            <a href="<?php
											if($_users_personal_row['in_p']!="")
											{
												echo $_users_personal_row['in_p'];
											}
											else{ echo "#"; }
										?>" class="social  btn-floating blue darken-3"><i
                                    class="fa fa-linkedin"></i></a>
                        </div>
                    </div>
                    <!--HTML 5 VIDEO-->
                    <video id="html-video" class="video" poster="images/poster/poster.jpg" controls>
                        <!--SERVER HOSTED VIDEO-->
                        <source src="<?php echo $_THEME_BASE_URL; ?>videos/b.webm" type="video/webm">
                        <source src="<?php echo $_THEME_BASE_URL; ?>videos/a.mp4" type="video/mp4">
                    </video>

                </div>
            </div>
        </div>
    </div>
</div>
<!--==========================================
                   ABOUT
===========================================-->
<?php
	foreach($_WEB_MENU as $_WMENU){
		if($_WMENU['small_text']=="about")
		{
?>
<div id="about" class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- DETAILS -->
                <div id="about-card" class="card">
                    <div class="card-content">
                        <!-- ABOUT PARAGRAPH -->
                        <p>
                            <?php echo $_WEB_AUTHOR_ABOUT; ?>
                        </p>
                    </div>

                    <!-- BUTTONS -->
                    <div id="about-btn" class="card-action">
                        <div class="about-btn">
                            <!-- DOWNLOAD CV BUTTON -->
                            <a href="#" class="btn waves-effect">Download CV</a>
                            <!-- CONTACT BUTTON -->
                            <a href="#contact" class="btn waves-effect">Contact Me</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
		}
		if($_WMENU['small_text']=="experience")
		{
	?>
<section id="experience" class="section">
    <div class="container">
        <!-- SECTION TITLE -->
        <div class="section-title">
            <h4 class="text-uppercase text-center"><img src="<?php echo $_THEME_BASE_URL; ?>images/icons/layers.png" alt="demo">Experience</h4>
        </div>

        <div id="timeline-experience">
			<?php
				foreach($_WEB_EXP as $experience)
				{
					//print_r($experience);
					if(!empty($experience)){
			?>
				<div class="timeline-block">
					<div class="timeline-dot"><h6><?php echo substr($experience['designation']['title'],0,1); ?></h6></div>
					<div class="card timeline-content">
						<div class="card-content">
							<h6 class="timeline-title"><?php echo $experience['designation']['title']; ?></h6>
							<div class="timeline-info">
								<h6>
									<small>
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
									</small>
								</h6>
								<h6>
									<small><?php echo $experience['duration']; ?></small>
								</h6>
							</div>
							<p>
								<?php echo @strip_tags($experience['description']); ?>
							</p>
							<!--<a href="#" class="modal-dot" data-toggle="modal" data-target="#myModal-4">
								<i class="fa fa-ellipsis-h" aria-hidden="true"></i>
							</a>-->
						</div>
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
		if($_WMENU['small_text']=="skills")
		{
			?>
			<section id="skills" class="section">
				<div class="container">
					<div class="section-title">
						<h4 class="text-uppercase text-center"><img src="<?php echo $_THEME_BASE_URL; ?>images/icons/mixer.png" alt="demo">Skills</h4>
					</div>
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div id="skills-card" class="card">
								<div class="card-content">
									<div class="row">
										<div class="col-md-4 col-sm-4 col-xs-12" style="min-height:350px;max-height:351px;">
											<!-- FIRST SKILL SECTION -->
											<div class="skills-title">
												<h6 class="text-center">Professional</h6>
											</div>
											<?php
												if($_professional_skills){
													$printed=0;
													foreach($_professional_skills as $_professional_skill)
													{
														if($printed<5)
														{
															$printed=$printed+1;
															?>
															<div class="skillbar" data-percent="<?php echo $_professional_skill['proficiency']; ?>%">
																<div class="skillbar-title"><span><?php echo $_professional_skill['skill']; ?></span></div>
																<div class="skillbar-bar"></div>
																<div class="skill-bar-percent"><?php echo $_professional_skill['proficiency']; ?>%</div>
															</div>
															<?php
														}
														else if($printed==5)
														{
															$printed=$printed+1;
															?>
															<a href="#" class="modal-dot" style="color:#fff;" data-toggle="modal" data-target="#professional_skills_more">
																<i class="fa fa-ellipsis-h" aria-hidden="true"></i>
															</a>
															<?php
														}
													}
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
										<div class="col-md-4 col-sm-4 col-xs-12" style="min-height:350px;max-height:351px;">
											<!-- FIRST SKILL SECTION -->
											<div class="skills-title">
												<h6 class="text-center">Personal</h6>
											</div>
											<?php
												if($_personal_skills){
													$printed=0;
													foreach($_personal_skills as $_personal_skill)
													{
														if($printed<5)
														{
															$printed=$printed+1;
															?>
															<div class="skillbar" data-percent="<?php echo $_personal_skill['proficiency']; ?>%">
																<div class="skillbar-title"><span><?php echo $_personal_skill['skill']; ?></span></div>
																<div class="skillbar-bar"></div>
																<div class="skill-bar-percent"><?php echo $_personal_skill['proficiency']; ?>%</div>
															</div>
															<?php
														}
														else if($printed==5)
														{
															$printed=$printed+1;
															?>
															<a href="#" class="modal-dot" style="color:#fff;" data-toggle="modal" data-target="#personal_skills_more">
																<i class="fa fa-ellipsis-h" aria-hidden="true"></i>
															</a>
															<?php
														}
													}
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
										<div class="col-md-4 col-sm-4 col-xs-12" style="min-height:350px;max-height:351px;">
											<!-- FIRST SKILL SECTION -->
											<div class="skills-title">
												<h6 class="text-center">Language</h6>
											</div>
											<?php
												if($_professional_skills){
													$printed=0;
													foreach($_languages as $_language)
													{
														if($printed<5)
														{
															$printed=$printed+1;
															?>
															<div class="skillbar" data-percent="<?php echo $_language['proficiency']; ?>%">
																<div class="skillbar-title"><span><?php echo $_language['skill']; ?></span></div>
																<div class="skillbar-bar"></div>
																<div class="skill-bar-percent"><?php echo $_language['proficiency']; ?>%</div>
															</div>
															<?php
														}
														else if($printed==5)
														{
															$printed=$printed+1;
															?>
															<a href="#" class="modal-dot" style="color:#fff;" data-toggle="modal" data-target="#languages_skills_more">
																<i class="fa fa-ellipsis-h" aria-hidden="true"></i>
															</a>
															<?php
														}
													}
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
							</div>
						</div>
					</div>
				</div>
				<div id="professional_skills_more" class="modal" tabindex="-1" role="dialog" aria-labelledby="professional_skills_more_label">
					<div class="modal-dialog modal-md" role="document">
						<div class="modal-content animated zoomIn">
							<div class="modal-body">
								<h3 class="text-capitalize text-left" id="professional_skills_more_label" style="color:#333 !important;"> <?php echo "{$_WEB_AUTHOR}"; ?>'s Professional Skills</h3>
								<div class="row">
									<div class="content col-md-12 col-sm-12 col-xs-12">
										<div class="card content-wrapper skill-wrapper">
											<?php
												foreach($_professional_skills as $_professional_skill)
												{
												?>
													<div class="skillbar" data-percent="<?php echo $_professional_skill['proficiency']; ?>%">
														<div class="skillbar-title"><span><?php echo $_professional_skill['skill']; ?></span></div>
														<div class="skillbar-bar"></div>
														<div class="skill-bar-percent"><?php echo $_professional_skill['proficiency']; ?>%</div>
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
				</div>
				<div id="personal_skills_more" class="modal" tabindex="-1" role="dialog" aria-labelledby="personal_skills_more_label">
					<div class="modal-dialog modal-md" role="document">
						<div class="modal-content animated zoomIn">
							<div class="modal-body">
								<h3 class="text-capitalize text-left" id="personal_skills_more_label" style="color:#333 !important;"> <?php echo "{$_WEB_AUTHOR}"; ?>'s Personal Skills</h3>
								<div class="row">
									<div class="content col-md-12 col-sm-12 col-xs-12">
										<div class="card content-wrapper skill-wrapper">
											<?php
												foreach($_personal_skills as $_personal_skill)
												{
												?>
													<div class="skillbar" data-percent="<?php echo $_personal_skill['proficiency']; ?>%">
														<div class="skillbar-title"><span><?php echo $_personal_skill['skill']; ?></span></div>
														<div class="skillbar-bar"></div>
														<div class="skill-bar-percent"><?php echo $_personal_skill['proficiency']; ?>%</div>
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
				</div>
				<div id="languages_skills_more" class="modal" tabindex="-1" role="dialog" aria-labelledby="languages_skills_more_label">
					<div class="modal-dialog modal-md" role="document">
						<div class="modal-content animated zoomIn">
							<div class="modal-body">
								<h3 class="text-capitalize text-left" id="languages_skills_more_label" style="color:#333 !important;"> <?php echo "{$_WEB_AUTHOR}"; ?>'s Languages</h3>
								<div class="row">
									<div class="content col-md-12 col-sm-12 col-xs-12">
										<div class="card content-wrapper skill-wrapper">
											<?php
												foreach($_languages as $_language)
												{
												?>
													<div class="skillbar" data-percent="<?php echo $_language['proficiency']; ?>%">
														<div class="skillbar-title"><span><?php echo $_language['skill']; ?></span></div>
														<div class="skillbar-bar"></div>
														<div class="skill-bar-percent"><?php echo $_language['proficiency']; ?>%</div>
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
				</div>
			</section>
			<?php
		}
		if($_WMENU['small_text']=="education")
		{
			?>
			<section id="education" class="section">
				<div class="container">
					<div class="section-title">
						<h4 class="text-uppercase text-center"><img src="<?php echo $_THEME_BASE_URL; ?>images/icons/book.png" alt="demo">Education</h4>
					</div>
					<div id="timeline-education">
						<?php
							foreach($_WEB_EDU as $education)
							{
								//print_r($education);
								if(!empty($education)){
									?>
									<div class="timeline-block">
										<div class="timeline-dot"><h6><?php echo substr($education['course']['title'],0,1); ?></h6></div>
										<div class="card timeline-content">
											<div class="card-content">
												<h6 class="timeline-title"><?php echo $education['course']['title']; ?></h6>
												<div class="timeline-info">
													<h6>
														<small>
															<?php 
																echo $education['university']['title'];
																if(!!$education['university']['city'])
																{
																	echo ", ".$education['university']['city']['title'];
																}
																if(!!$education['university']['city']['state'])
																{
																	echo ", ".$education['university']['city']['state']['title'];
																}
																if(!!$education['university']['city']['country'])
																{
																	echo ", ".$education['university']['city']['country']['title'];
																}
															?>
														</small>
													</h6>
													<h6>
														<small><?php echo $education['duration']; ?></small>
													</h6>
												</div>
												<p>
													<?php echo @strip_tags($education['description']); ?>
												</p>
											</div>
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
			if($_WMENU['small_text']=="services")
			{
				?>
				<section id="services" class="section">
					<div class="container">
						<!-- SECTION TITLE -->
						<div class="section-title">
							<h4 class="text-uppercase text-center"><img src="<?php echo $_THEME_BASE_URL; ?>images/icons/handshake.png" alt="demo"><?php echo $_WMENU['text']; ?></h4>
						</div>
						<div id="testimonials-card" class="row card">
							<div class="col-md-12 col-xs-12">
								<div id="clients-slider" class="swiper-container swiper-container-clients">
									<div class="swiper-wrapper">
										<!-- SLIDE ONE -->
										<?php
											foreach($_WEB_SERVICES as $_WSERVICE)
											{
										?>
												<div class="swiper-slide">
													<div class="col-md-12">
														<h6 class="text-capitalize" style="text-align:center;"><?php echo $_WSERVICE['services']['title']; ?></h6>
														<div class="row">
															<div class="col-md-4 col-sm-4 col-xs-4">
																<?php
																	if(isset($_WSERVICE['services_media'][0]) && $_WSERVICE['services_media'][0]!="")
																	{
																?>
																	<div class="client-img center-block">
																		<img alt="client-image" alt="<?php echo $_WSERVICE['services']['title']; ?>" class="center-block img-responsive" src="<?php echo $_WSERVICE['services_media'][0]; ?>">
																	</div>
																<?php
																	}
																?>
															</div>
															<div class="col-md-8 col-sm-8 col-xs-8">
																<blockquote>
																	<?php echo $_WSERVICE['services']['description']; ?>
																</blockquote>
															</div>
														</div>
													</div>
												</div>
										<?php
											}
										?>
									</div>
									<div class="swiper-pagination swiper-pagination-clients"></div>
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
					<div class="container">
						<!-- SECTION TITLE -->
						<div class="section-title">
							<h4 class="text-uppercase text-center"><img src="<?php echo $_THEME_BASE_URL; ?>images/icons/safe.png" alt="demo"><?php echo $_WMENU['text'] ?></h4>
						</div>
						<div id="portfolios-card" class="row">
						<!--
							<ul class="nav nav-tabs">
								<li class="active waves-effect list-shuffle"><a id="all-sample" class="active" href="#all"
																				data-toggle="tab">ALL</a>
								<li class="waves-effect list-shuffle"><a class="cate" href="#a" data-toggle="tab">LOGO</a></li>
								<li class="waves-effect list-shuffle"><a class="cate" href="#b" data-toggle="tab">DRIBBLE</a></li>
								<li class="waves-effect list-shuffle"><a class="cate" href="#c" data-toggle="tab">WEBSITES</a></li>
							</ul>
						-->
							<div class="tab-content">
								<div id="all"></div>
								<div id="a">
									<div class="col-md-4 col-sm-12 col-xs-12 grid big inLeft">
										<figure class="port-effect-scale">
											<img src="<?php echo $_THEME_BASE_URL; ?>images/portfolios/big-1.jpg" class="img-responsive" alt="portfolio-demo"/>
											<figcaption>
												<h2>Lightbox <span> IMAGE</span></h2>
												<p>Two Hover Effect For Portfolio Grid Blocks. Its Scale</p>
												<a href="images/portfolios/big-1.jpg" class="popup-image" data-effect="mfp-3d-unfold">View
													more</a>
											</figcaption>
										</figure>
									</div>
									<div class="col-md-4 col-sm-6 col-xs-12 grid inRight">
										<figure class="port-effect-scale">
											<img src="<?php echo $_THEME_BASE_URL; ?>images/portfolios/portfolio-1.jpg" class="img-responsive" alt="portfolio-demo"/>
											<figcaption>
												<h2><i class="fa fa-play-circle" aria-hidden="true"></i>Lightbox <span> Video</span>
												</h2>
												<p>I designed this for a client for his cafe.</p>
												<a class="popup-vimeo" href="https://vimeo.com/45830194">View more</a>
											</figcaption>
										</figure>
									</div>
									<div class="col-md-4 col-sm-6 col-xs-12 grid inRight">
										<figure class="port-effect-up">
											<img src="<?php echo $_THEME_BASE_URL; ?>images/portfolios/portfolio-2.jpg" class="img-responsive" alt="portfolio-demo"/>
											<figcaption>
												<h2>Lightbox <span> IMAGE</span></h2>
												<p>Two Hover Effect For Portfolio Grid Blocks. Its Up</p>
												<a href="images/portfolios/portfolio-2.jpg" class="popup-image"
												   data-effect="mfp-move-horizontal">View more</a>
											</figcaption>
										</figure>
									</div>
								</div>
							</div>
							<!--<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12">
									<button id="add-more" class="center-block btn-large waves-effect"><i id="port-add-icon"
																										 class="fa fa-plus"></i>
									</button>
								</div>
							</div>-->
						</div>
					</div>
				</section>
				<?php
			}
			if($_WMENU['small_text']=="achievement")
			{
				?>
				<section id="achievement" class="section">
					<div class="container">
						<!-- SECTION TITLE -->
						<div class="section-title">
							<h4 class="text-uppercase text-center"><img src="<?php echo $_THEME_BASE_URL; ?>images/icons/post-it.png" alt="demo"><?php echo $_WMENU['text'] ?></h4>
						</div>
						<div id="blog-card-1" class="row">
							<div class="col-md-12 col-sm-12">
								<div class="card">
									<?php 
										$counter=1;
										foreach($_WEB_AWARDS as $_WAWARD)
										{
											?>
											<div class="achievement <?php if($counter%2==0){ echo "even"; }else{ echo "odd"; } ?>">
												<!--IMAGE-->
												<div class="image">
												<?php
													if(isset($_WAWARD['awards_media'][0]) && $_WAWARD['awards_media'][0]!="")
													{
												?>
													<img alt="<?php echo $_WAWARD['awards']['title']; ?>" src="<?php echo $_WAWARD['awards_media'][0]; ?>" alt="<?php echo $_WAWARD['awards']['title']; ?>"/>
													<div class="image-overlay">
														<div class="comments">
															<i class="fa fa-user"></i> <?php echo "{$_WEB_AUTHOR}"; ?>
															<i class="fa fa-clock-o"></i>
															<time datetime="2045-08-16"><?php echo date("M Y",strtotime($_WAWARD['awards']['added'])); ?></time>
															<!--<i class="fa fa-comments"></i> 168-->
														</div>
													</div>
												<?php
													}
													else
													{
														?>
														<!--<?php echo base_url.'uploads/awards.png'; ?>-->
														<a href="#" target="_blank">
															<img alt="blog-image" src="<?php echo $_THEME_BASE_URL; ?>images/blog/blog-2.png"/>
														</a>
														<!--<img alt="<?php echo $_WAWARD['awards']['title']; ?>" src="<?php echo $_THEME_BASE_URL; ?>images/blog/blog-2.png"/>-->
														<div class="image-overlay">
															<div class="comments">
																<i class="fa fa-user"></i> <?php echo "{$_WEB_AUTHOR}"; ?>
																<i class="fa fa-clock-o"></i>
																<time datetime="2045-08-16"><?php echo date("M Y",strtotime($_WAWARD['awards']['added'])); ?></time>
																<!--<i class="fa fa-comments"></i> 168-->
															</div>
														</div>
														<?php
													}
												?>
												</div>
												<!--DETAILS-->
												<div class="content">
													<h6><?php echo $_WAWARD['awards']['title']; ?></h6>
													<p>
														<?php echo $_WAWARD['awards']['description']; ?>
													</p>
												</div>
											</div>
											<?php
											$counter=$counter+1;
										}
									?>
								</div>
							</div>
						</div>
					</div>
				</section>
				<?php
			}
			if($_WMENU['small_text']=="blog")
			{
		?>
			<section id="blog" class="section">
				<div class="container">
					<div class="section-title">
						<h4 class="text-uppercase text-center"><img src="<?php echo $_THEME_BASE_URL; ?>images/icons/post-it.png" alt="demo"><?php echo $_WMENU['text']; ?></h4>
					</div>
					<div id="blog-card" class="row">
						<div class="col-md-12 col-sm-12">
							<div class="card">
								<?php
									$blog_counter=0;
									foreach($_WEB_BLOGS as $_WBLOG)
									{
										$blog_counter=$blog_counter+1;
										if($blog_counter<=3){
								?>
										<div class="blog <?php if($blog_counter%2==0){ echo "even"; }else{ echo "odd"; } ?>">
											<div class="image">
												<a href="<?php echo base_url.$_WBLOG['blogs']['blog_url']; ?>" target="_blank">
													<img alt="blog-image" src="<?php echo $_THEME_BASE_URL; ?>images/blog/blog-2.png"/>
												</a>
												<div class="image-overlay">
													<div class="comments">
														<i class="fa fa-user"></i>  <?php echo "{$_WEB_AUTHOR}"; ?>
														<i class="fa fa-clock-o"></i>
														<time datetime="2045-08-16"><?php echo date("d M Y",strtotime($_WBLOG['blogs']['added'])); ?></time>
														<i class="fa fa-thumbs-up"></i> <?php echo $_WBLOG['blogs']['likes']; ?>
													</div>
												</div>
											</div>
											<div class="content">
												<!--<ol class="breadcrumb">
													<li><a href="#">Frontend</a></li>
													<li><a href="#">Design</a></li>
													<li class="active">Material</li>
												</ol>-->
												<h6><?php echo $_WBLOG['blogs']['title']; ?></h6>
												<p>
													<?php echo substr(strip_tags($_WBLOG['blogs']['content']),0,250); ?>
												</p>
												<a class="forward" style="margin-bottom:10px;" target="_blank" href="<?php echo $_WBLOG['blogs']['blog_url']; ?>">Read More</a>
											</div>
										</div>
										<?php
										}
										else if($blog_counter==4){
											?>
											<div class="row text-center" style="margin-top:30px;">
												<div class="col col-xs-12 col-sm-12 col-md-12 text-center">
													<a href="<?php echo base_url."blogger/@".$_username; ?>" target="_blank" class="text-uppercase btn btn-primary" data-aos="zoom-in" data-aos-delay="100">MORE BLOGS</a>
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
			if($_WMENU['small_text']=="interest")
			{
		?>
			<section id="interest" class="section">	
				<div class="container">
					<div class="section-title">
						<h4 class="text-uppercase text-center"><img src="<?php echo $_THEME_BASE_URL; ?>images/icons/heart.png" alt="demo"><?php echo $_WMENU['text']; ?></h4>
					</div>

					<div id="interest-card" class="card">
						<div class="card-content">
							<!--<p>
								First of all I love music, country music is my favorite. Love watching
								football, movies and playing games with my buddies. I spend quite a lot of time
								in traveling and photography, these keeps me fresh for working environment.
								I also spend time volunteering at the Red Cross in London, UK each month.
							</p>-->
						</div>
						<div class="row no-gutters">
							<?php
								$counter=1;
								foreach($_WEB_INTERESTS as $_WINTEREST)
								{
									?>
										<div class="col-md-2 col-sm-4 col-xs-6  box text-center">
											<div class="interest-icon<?php if($counter%2==0){ echo "-even"; } ?>">
												<i class="pencil-square-o"></i>
												<span><?php echo $_WINTEREST['interests']['title']; ?></span>
											</div>
										</div>
									<?php
									$counter=$counter+1;
								}
							?>
						</div>
					</div>
				</div>
			</section>
		<?php
			}
		}
	?>