<?php include_once '../../data_master.php'; ?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta property="og:url" content="<?php echo base_url."w/".$_username; ?>" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="<?php echo "{$_WEB_AUTHOR}"; ?> - <?php echo "{$_WEB_DESIGNATION}"; ?> Powered by @RopeYou Connects" />
	<meta property="og:description" content="<?php echo @strip_tags($_WEB_AUTHOR_ABOUT); ?>" />
	<meta property="og:image" content="<?php echo "{$_WEB_AUTHOR_IMAGE}";?>"/>
	<meta property="fb:app_id" content="465307587452391"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="author" content="RopeYou Connects,<?php echo "{$_WEB_AUTHOR}"; ?>,<?php echo "{$_WEB_DESIGNATION}"; ?> #xboyonweb #xgirlonweb">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title><?php echo "{$_WEB_TITLE}"; ?></title>
    <!-- Fav Icon -->
    <link rel="icon" href="<?php echo base_url; ?>images/fav.png">
    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" href="<?php echo base_url; ?>images/fav.png">
    <!-- Google Font -->
    <link href='https://fonts.googleapis.com/css?family=Roboto' type="text/css" rel='stylesheet'>
    <!-- Google Material Icon -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" type="text/css" rel="stylesheet">
    <!-- Font Awesome Icon -->
    <link href="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>stylesheets/font-awesome.min.css" type="text/css" rel="stylesheet">
    <!-- IonIcons Icon -->
    <link href="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>stylesheets/ionicons.min.css" type="text/css" rel="stylesheet">

    <!-- Animation -->
    <link href="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>stylesheets/animate.css" type="text/css" rel="stylesheet">
    <!-- Animation On Scroll -->
    <link href="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>stylesheets/aos.min.css" type="text/css" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>stylesheets/bootstrap.css" type="text/css" rel="stylesheet">
    <!-- Materialize -->
    <link href="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>stylesheets/materialize.css" type="text/css" rel="stylesheet">
    <!-- Swiper Slider -->
    <link href="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>stylesheets/swiper.css" type="text/css" rel="stylesheet">


    <!-- Custom Style -->
    <!--<link href="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>stylesheets/style-red.css" type="text/css" rel="stylesheet">
    <link href="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>stylesheets/style-pink.css" type="text/css" rel="stylesheet">
    <link href="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>stylesheets/style-purple.css" type="text/css" rel="stylesheet">
    <link href="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>stylesheets/style-deep-purple.css" type="text/css" rel="stylesheet">
    <link href="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>stylesheets/style-indigo.css" type="text/css" rel="stylesheet">
    <link href="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>stylesheets/style-blue.css" type="text/css" rel="stylesheet">
    <link href="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>stylesheets/style-teal.css" type="text/css" rel="stylesheet">
    <link href="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>stylesheets/style-green.css" type="text/css" rel="stylesheet">
    <link href="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>stylesheets/style-light-green.css" type="text/css" rel="stylesheet">
    <link href="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>stylesheets/style-amber.css" type="text/css" rel="stylesheet">
    <link href="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>stylesheets/style-orange.css" type="text/css" rel="stylesheet">
    <link href="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>stylesheets/style-deep-orange.css" type="text/css" rel="stylesheet">
    <link href="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>stylesheets/style-brown.css" type="text/css" rel="stylesheet">
    <link href="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>stylesheets/style-blue-grey.css" type="text/css" rel="stylesheet"> 
    <link href="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>stylesheets/style-grey.css" type="text/css" rel="stylesheet">-->
	
    <link id="color-switcher" href="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>stylesheets/style-grey.css" type="text/css" rel="stylesheet">



    <!-- Google Analytics Tracking Code -->
    <script>
		
        /*(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','../../www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-83584273-1', 'auto');
        ga('send', 'pageview');*/
    </script>

</head>

<body>
<!--==========================================
                 PAGE LOADER
===========================================-->
<div id="page-loader">
    <div class="animated bounceInDown">
        <div class="spinner"></div>
    </div>
    <div class="text-div text-center animated zoomIn">
        <p class="text-uppercase"><?php echo "{$_WEB_INTRO_STATEMENT}"; ?></p>
        <!-- Name Only -->
        <h6 class="text-uppercase"><?php echo "{$_WEB_AUTHOR}"; ?></h6>
    </div>
</div>

<!--==========================================
                 HEADER
===========================================-->
<div id="header" class="shadow">
    <!-- Navigation -->
    <nav>
        <div class="nav nav-wrapper navbar-fixed-top">
            <div class="container-fluid">
				<?php if(!empty($_WEB_MENU)){ ?>
                <ul class="nav-justified hide-on-med-and-down">
					<?php 
					foreach($_WEB_MENU as $_WMENU){
						?>
						<li><a href="#<?php echo $_WMENU['url']; ?>"><?php echo $_WMENU['small_text']; ?></a></li>
						<?php
					}
					?>
                    <!--<li><a href="#header">About</a></li>
                    <li><a href="#experience">Experience</a></li>
                    <li><a href="#skills">Skills</a></li>
                    <li><a href="#education">Education</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#portfolios">Portfolios</a></li>
                    <li><a href="#achievement">Achievement</a></li>
                    <li><a href="#publications">Publications</a></li>
                    <li><a href="#blog">Blog</a></li>
                    <li><a href="#clients">Clients</a></li>
                    <li><a href="#pricing">Pricing</a></li>
                    <li><a href="#interest">Interest</a></li>
                    <li><a href="#contact">Contact</a></li>-->
                </ul>
				<a href="#0" data-activates="nav-mobile" id="nav-btn" class="button-collapse nav-icon">
                    <i class="ion-navicon"></i>
				</a>
                <!-- Side Nav -->
				<div id="side-nav">
                    <div id="nav-header">
                        <div id="nav-profile" class="center-block">

                            <!-- Profile Picture [Square] -->
                            <img src="<?php echo $_WEB_AUTHOR_IMAGE;?>">
                        </div>
                        <h6 class="text-center text-capitalize"><?php echo "{$_WEB_AUTHOR}"; ?></h6>
                    </div>

                    <div id="nav-link-wrapper">

                        <!-- Side Menu Option -->
                        <ul>
                            <?php 
								foreach($_WEB_MENU as $_WMENU){
									?>
									<li><a href="#<?php echo $_WMENU['url']; ?>"><?php echo $_WMENU['small_text']; ?></a></li>
									<?php
								}
							?>
                        </ul>
                    </div>
					<!-- ./Side Nav -->
					<!-- Side Nav Mask -->
					<div id="side-nav-mask"></div>
                </div>
				<?php } ?>
            </div>
        </div>
    </nav>
    <!-- Name and Status -->
    <div id="intro" class="container">
        <h1 class="text-center text-capitalize"><?php echo "{$_WEB_AUTHOR}"; ?></h1>
        <h4 class="text-center text-capitalize"><?php echo "{$_WEB_DESIGNATION}"; ?></h4>
    </div>
</div>
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

						<!-- Social Links -->
						<div id="intro-div" class="card content-wrapper">
							<ul class="text-center list-inline">
								<li><a href="#0" target="_blank"><i class="ion-social-facebook"></i></a></li>
								<li><a href="#0" target="_blank"><i class="ion-social-twitter"></i></a></li>
								<li><a href="#0" target="_blank"><i class="ion-social-linkedin"></i></a></li>
								<li><a href="#0" target="_blank"><i class="ion-social-googleplus"></i></a></li>
								<li><a href="#0" target="_blank"><i class="ion-social-instagram"></i></a></li>
							</ul>

							<p class="text-center">
								<?php echo @strip_tags($_WEB_AUTHOR_ABOUT); ?>
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
									<a href="#contact" class="btn waves-effect waves-light btn-primary custom-btn">Contact Me</a>
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
			<h4 class="text-uppercase text-center">Services</h4>
			<div class="container">
				<ul class="row">

					<!-- 1st service -->
					<li class="col col-md-4 col-sm-6 col-xs-12">
						<div class="card service-item text-center">
							<!-- Edit icon and title here -->
							<i class="ion-social-android" data-aos="fade" data-aos-delay="300" data-aos-offset="0"></i>
							<h6 class="text-capitalize">Android Application</h6>
							<!-- service info here -->
							<p class="text-center">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi venenatis et tortor ac tincidunt.
								In euismod iaculis lobortis. Vestibulum posuere molestie ipsum vel. Vestibulum
								venenatis pharetra mi, ut vestibulum elit ultricies.
							</p>
						</div>
					</li>
					<!-- ./1st service -->

					<!-- 2nd service -->
					<li class="col col-md-4 col-sm-6 col-xs-12">
						<div class="card service-item text-center">
							<!-- Edit icon and title here -->
							<i class="ion-code" data-aos="fade" data-aos-delay="300" data-aos-offset="0"></i>
							<h6 class="text-capitalize">Web Development</h6>
							<!-- service info here -->
							<p class="text-center">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi venenatis et tortor ac tincidunt.
								In euismod iaculis lobortis. Vestibulum posuere molestie ipsum vel. Vestibulum
								venenatis pharetra mi, ut vestibulum elit ultricies.
							</p>
						</div>
					</li>
					<!-- ./2nd service -->

					<!-- 3rd service -->
					<li class="col col-md-4 col-sm-6 col-xs-12">
						<div class="card service-item text-center">
							<!-- Edit icon and title here -->
							<i class="ion-social-apple" data-aos="fade" data-aos-delay="300" data-aos-offset="0"></i>
							<h6 class="text-capitalize">IOS Application</h6>
							<!-- service info here -->
							<p class="text-center">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi venenatis et tortor ac tincidunt.
								In euismod iaculis lobortis. Vestibulum posuere molestie ipsum vel. Vestibulum
								venenatis pharetra mi, ut vestibulum elit ultricies.
							</p>
						</div>
					</li>
					<!-- ./3rd service -->

					<!-- 4th service -->
					<li class="col col-md-4 col-sm-6 col-xs-12">
						<div class="card service-item text-center">
							<!-- Edit icon and title here -->
							<i class="ion-cloud" data-aos="fade" data-aos-delay="300" data-aos-offset="0"></i>
							<h6 class="text-capitalize">Cloud Computing</h6>
							<!-- service info here -->
							<p class="text-center">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi venenatis et tortor ac tincidunt.
								In euismod iaculis lobortis. Vestibulum posuere molestie ipsum vel. Vestibulum
								venenatis pharetra mi, ut vestibulum elit ultricies.
							</p>
						</div>
					</li>
					<!-- ./5th service -->

					<!-- 5th service -->
					<li class="col col-md-4 col-sm-6 col-xs-12">
						<div class="card service-item text-center">
							<!-- Edit icon and title here -->
							<i class="ion-paintbrush" data-aos="fade" data-aos-delay="300" data-aos-offset="0"></i>
							<h6 class="text-capitalize">UI/UX Design</h6>
							<!-- service info here -->
							<p class="text-center">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi venenatis et tortor ac tincidunt.
								In euismod iaculis lobortis. Vestibulum posuere molestie ipsum vel. Vestibulum
								venenatis pharetra mi, ut vestibulum elit ultricies.
							</p>
						</div>
					</li>
					<!-- ./5th service -->

					<!-- 6th service -->
					<li class="col col-md-4 col-sm-6 col-xs-12">
						<div class="card service-item text-center">
							<!-- Edit icon and title here -->
							<i class="ion-settings" data-aos="fade" data-aos-delay="300" data-aos-offset="0"></i>
							<h6 class="text-capitalize">Troubleshooting</h6>
							<!-- service info here -->
							<p class="text-center">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi venenatis et tortor ac tincidunt.
								In euismod iaculis lobortis. Vestibulum posuere molestie ipsum vel. Vestibulum
								venenatis pharetra mi, ut vestibulum elit ultricies.
							</p>
						</div>
					</li>
					<!-- ./6th service -->

				</ul>
			</div>
		</section>
	<?php
		}
		if($_WMENU['small_text']=="portfolios")
		{
	?>
		<section id="portfolios" class="section">
			<h4 class="text-uppercase text-center">Portfolios</h4>
			<div class="container">

				<div class="row">
					<!-- A basic setup of simple mode filter controls, all you have to do is use data-filter="all"
					for an unfiltered gallery and then the values of your categories to filter between them -->
					<ul class="text-center simple-filter" data-aos="zoom-in" data-aos-duration="500" data-aos-delay="300">
						<li class="active-cat" data-filter="all"><a>All</a></li>
						<li data-filter="1"><a>Creative</a></li>
						<li data-filter="2"><a>Photography</a></li>
						<li data-filter="3"><a>Food</a></li>
						<li data-filter="4"><a>Colorful</a></li>
						<li data-filter="5"><a>Personal</a></li>
					</ul>

					<div class="filtr-container center-block">

						<!-- 1st Portfolio, Filter Option -->
						<div class="col col-md-3 col-sm-6 col-xs-12 filtr-item" data-category="1, 5">
							<div class="portfolio card">
								<figure class="hover-effect">
									<!-- Portfolio Image -->
									<img class="img-responsive" src="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>images/portfolios/p1.jpg" alt="">
									<!-- open-modal ID -->
									<a data-toggle="modal" data-target="#modal1" href="#0">
										<figcaption><span>View Details</span></figcaption>
									</a>
								</figure>
								<!-- Portfolio Title -->
								<h6 class="text-capitalize text-center">Portfolio Title Here</h6>
							</div>
						</div>
						<!-- ./Portfolio -->
						<!-- 1st MODAL -->
						<div id="modal1" class="modal" tabindex="-1" role="dialog">
							<div class="modal-dialog modal-lg">
								<div class="modal-content animated zoomIn">
									<h3 class="text-capitalize text-left">Project title will be placed here</h3>
									<div class="row">
										<!-- Modal Image -->
										<img class="img-responsive col-md-8 col-sm-12 col-xs-12" src="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>images/portfolios/p1.jpg" alt="">

										<!-- Modal Content -->
										<div class="content col-md-4 col-sm-12 col-xs-12">
											<!-- Date, Category & Client Name of the Project -->
											<p><span>Date:&nbsp;</span> 5, July 2015</p>
											<p><span>Category:&nbsp;</span> System Development</p>
											<p><span>Client:&nbsp;</span> Mr. John Doe</p>
											<!-- Live Demo Link -->
											<a href="#0" target="_blank" class="btn modal-btn waves-effect waves-light btn-primary custom-btn">Live Demo</a>
											<!-- Some Information Abut the Project -->
											<p class="text-left">
												Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi venenatis et tortor ac tincidunt.
												In euismod iaculis lobortis. Vestibulum posuere molestie ipsum vel sollicitudin. Vestibulum
												venenatis pharetra mi, ut vestibulum elit ultricies. Lorem ipsum dolor sit amet, consectetur
												adipiscing elit. Morbi venenatis et tortor ac tincidunt.
												In euismod iaculis lobortis. Vestibulum posuere molestie ipsum vel sollicitudin. Vestibulum
												venenatis pharetra mi, ut vestibulum elit ultricies. Lorem ipsum dolor sit amet.
											</p>
											<button data-dismiss="modal" class="btn right modal-btn close-btn waves-effect waves-light btn-primary custom-btn">Close</button>
										</div>

									</div>
								</div>
							</div>
						</div>
						<!-- ./modal -->


						<!-- 2nd Portfolio, Filter Option -->
						<div class="col col-md-3 col-sm-6 col-xs-12 filtr-item" data-category="2, 3, 4">
							<div class="portfolio card">
								<figure class="hover-effect">
									<!-- Portfolio Image -->
									<img class="img-responsive" src="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>images/portfolios/p2.jpg" alt="">
									<!-- open-modal ID -->
									<a data-toggle="modal" data-target="#modal2" href="#0">
										<figcaption><span>View Details</span></figcaption>
									</a>
								</figure>
								<!-- Portfolio Title -->
								<h6 class="text-capitalize text-center">Portfolio Title Here</h6>
							</div>
						</div>
						<!-- ./Portfolio -->
						<!-- 2nd MODAL -->
						<div id="modal2" class="modal" tabindex="-1" role="dialog">
							<div class="modal-dialog modal-lg">
								<div class="modal-content animated zoomIn">
									<h3 class="text-capitalize text-left">Project title will be placed here</h3>
									<div class="row">
										<!-- Modal Image -->
										<img class="img-responsive col-md-8 col-sm-12 col-xs-12" src="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>images/portfolios/p2.jpg" alt="">

										<!-- Modal Content -->
										<div class="content col-md-4 col-sm-12 col-xs-12">
											<!-- Date, Category & Client Name of the Project -->
											<p><span>Date:&nbsp;</span> 5, July 2015</p>
											<p><span>Category:&nbsp;</span> System Development</p>
											<p><span>Client:&nbsp;</span> Mr. John Doe</p>
											<!-- Live Demo Link -->
											<a href="#0" target="_blank" class="btn modal-btn waves-effect waves-light btn-primary custom-btn">Live Demo</a>
											<!-- Some Information Abut the Project -->
											<p class="text-left">
												Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi venenatis et tortor ac tincidunt.
												In euismod iaculis lobortis. Vestibulum posuere molestie ipsum vel sollicitudin. Vestibulum
												venenatis pharetra mi, ut vestibulum elit ultricies. Lorem ipsum dolor sit amet, consectetur
												adipiscing elit. Morbi venenatis et tortor ac tincidunt.
												In euismod iaculis lobortis. Vestibulum posuere molestie ipsum vel sollicitudin. Vestibulum
												venenatis pharetra mi, ut vestibulum elit ultricies. Lorem ipsum dolor sit amet.
											</p>
											<button data-dismiss="modal" class="btn right modal-btn close-btn waves-effect waves-light btn-primary custom-btn">Close</button>
										</div>

									</div>
								</div>
							</div>
						</div>
						<!-- ./modal -->


						<!-- 3rd Portfolio, Filter Option -->
						<div class="col col-md-3 col-sm-6 col-xs-12 filtr-item" data-category="1, 4">
							<div class="portfolio card">
								<figure class="hover-effect">
									<!-- Portfolio Imag e-->
									<img class="img-responsive" src="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>images/portfolios/p3.jpg" alt="">
									<!-- open-modal ID -->
									<a data-toggle="modal" data-target="#modal3" href="#0">
										<figcaption><span>View Details</span></figcaption>
									</a>
								</figure>
								<!-- Portfolio Title -->
								<h6 class="text-capitalize text-center">Portfolio Title Here</h6>
							</div>
						</div>
						<!-- ./Portfolio -->
						<!-- 3rd MODAL -->
						<div id="modal3" class="modal" tabindex="-1" role="dialog">
							<div class="modal-dialog modal-lg">
								<div class="modal-content animated zoomIn">
									<h3 class="text-capitalize text-left">Project title will be placed here</h3>
									<div class="row">
										<!-- Modal Image -->
										<img class="img-responsive col-md-8 col-sm-12 col-xs-12" src="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>images/portfolios/p3.jpg" alt="">

										<!-- Modal Content -->
										<div class="content col-md-4 col-sm-12 col-xs-12">
											<!-- Date, Category & Client Name of the Project -->
											<p><span>Date:&nbsp;</span> 5, July 2015</p>
											<p><span>Category:&nbsp;</span> System Development</p>
											<p><span>Client:&nbsp;</span> Mr. John Doe</p>
											<!-- Live Demo Link -->
											<a href="#0" target="_blank" class="btn modal-btn waves-effect waves-light btn-primary custom-btn">Live Demo</a>
											<!-- Some Information Abut the Project -->
											<p class="text-left">
												Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi venenatis et tortor ac tincidunt.
												In euismod iaculis lobortis. Vestibulum posuere molestie ipsum vel sollicitudin. Vestibulum
												venenatis pharetra mi, ut vestibulum elit ultricies. Lorem ipsum dolor sit amet, consectetur
												adipiscing elit. Morbi venenatis et tortor ac tincidunt.
												In euismod iaculis lobortis. Vestibulum posuere molestie ipsum vel sollicitudin. Vestibulum
												venenatis pharetra mi, ut vestibulum elit ultricies. Lorem ipsum dolor sit amet.
											</p>
											<button data-dismiss="modal" class="btn right modal-btn close-btn waves-effect waves-light btn-primary custom-btn">Close</button>
										</div>

									</div>
								</div>
							</div>
						</div>
						<!-- ./modal -->


						<!-- 4th Portfolio, Filter Option -->
						<div class="col col-md-3 col-sm-6 col-xs-12 filtr-item" data-category="1, 5">
							<div class="portfolio card">
								<figure class="hover-effect">
									<!-- Portfolio Image -->
									<img class="img-responsive" src="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>images/portfolios/p4.jpg" alt="">
									<!-- open-modal ID -->
									<a data-toggle="modal" data-target="#modal4" href="#0">
										<figcaption><span>View Details</span></figcaption>
									</a>
								</figure>
								<!-- Portfolio Title -->
								<h6 class="text-capitalize text-center">Portfolio Title Here</h6>
							</div>
						</div>
						<!-- ./Portfolio -->
						<!-- 4th MODAL -->
						<div id="modal4" class="modal" tabindex="-1" role="dialog">
							<div class="modal-dialog modal-lg">
								<div class="modal-content animated zoomIn">
									<h3 class="text-capitalize text-left">Project title will be placed here</h3>
									<div class="row">
										<!-- Modal Image -->
										<img class="img-responsive col-md-8 col-sm-12 col-xs-12" src="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>images/portfolios/p4.jpg" alt="">

										<!-- Modal Content -->
										<div class="content col-md-4 col-sm-12 col-xs-12">
											<!-- Date, Category & Client Name of the Project -->
											<p><span>Date:&nbsp;</span> 5, July 2015</p>
											<p><span>Category:&nbsp;</span> System Development</p>
											<p><span>Client:&nbsp;</span> Mr. John Doe</p>
											<!-- Live Demo Link -->
											<a href="#0" target="_blank" class="btn modal-btn waves-effect waves-light btn-primary custom-btn">Live Demo</a>
											<!-- Some Information Abut the Project -->
											<p class="text-left">
												Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi venenatis et tortor ac tincidunt.
												In euismod iaculis lobortis. Vestibulum posuere molestie ipsum vel sollicitudin. Vestibulum
												venenatis pharetra mi, ut vestibulum elit ultricies. Lorem ipsum dolor sit amet, consectetur
												adipiscing elit. Morbi venenatis et tortor ac tincidunt.
												In euismod iaculis lobortis. Vestibulum posuere molestie ipsum vel sollicitudin. Vestibulum
												venenatis pharetra mi, ut vestibulum elit ultricies. Lorem ipsum dolor sit amet.
											</p>
											<button data-dismiss="modal" class="btn right modal-btn close-btn waves-effect waves-light btn-primary custom-btn">Close</button>
										</div>

									</div>
								</div>
							</div>
						</div>
						<!-- ./modal -->


						<!-- 5th Portfolio, Filter Option -->
						<div class="col col-md-3 col-sm-6 col-xs-12 filtr-item" data-category="2, 3, 4">
							<div class="portfolio card">
								<figure class="hover-effect">
									<!-- Portfolio Image -->
									<img class="img-responsive" src="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>images/portfolios/p5.jpg" alt="">
									<!-- open-modal ID -->
									<a data-toggle="modal" data-target="#modal5" href="#0">
										<figcaption><span>View Details</span></figcaption>
									</a>
								</figure>
								<!-- Portfolio Title -->
								<h6 class="text-capitalize text-center">Portfolio Title Here</h6>
							</div>
						</div>
						<!-- ./Portfolio -->
						<!-- 5th MODAL -->
						<div id="modal5" class="modal" tabindex="-1" role="dialog">
							<div class="modal-dialog modal-lg">
								<div class="modal-content animated zoomIn">
									<h3 class="text-capitalize text-left">Project title will be placed here</h3>
									<div class="row">
										<!-- Modal Image -->
										<img class="img-responsive col-md-8 col-sm-12 col-xs-12" src="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>images/portfolios/p5.jpg" alt="">

										<!-- Modal Content -->
										<div class="content col-md-4 col-sm-12 col-xs-12">
											<!-- Date, Category & Client Name of the Project -->
											<p><span>Date:&nbsp;</span> 5, July 2015</p>
											<p><span>Category:&nbsp;</span> System Development</p>
											<p><span>Client:&nbsp;</span> Mr. John Doe</p>
											<!-- Live Demo Link -->
											<a href="#0" target="_blank" class="btn modal-btn waves-effect waves-light btn-primary custom-btn">Live Demo</a>
											<!-- Some Information Abut the Project -->
											<p class="text-left">
												Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi venenatis et tortor ac tincidunt.
												In euismod iaculis lobortis. Vestibulum posuere molestie ipsum vel sollicitudin. Vestibulum
												venenatis pharetra mi, ut vestibulum elit ultricies. Lorem ipsum dolor sit amet, consectetur
												adipiscing elit. Morbi venenatis et tortor ac tincidunt.
												In euismod iaculis lobortis. Vestibulum posuere molestie ipsum vel sollicitudin. Vestibulum
												venenatis pharetra mi, ut vestibulum elit ultricies. Lorem ipsum dolor sit amet.
											</p>
											<button data-dismiss="modal" class="btn right modal-btn close-btn waves-effect waves-light btn-primary custom-btn">Close</button>
										</div>

									</div>
								</div>
							</div>
						</div>
						<!-- ./modal -->


						<!-- 6th Portfolio, Filter Option -->
						<div class="col col-md-3 col-sm-6 col-xs-12 filtr-item" data-category="2">
							<div class="portfolio card">
								<figure class="hover-effect">
									<!-- Portfolio Image -->
									<img class="img-responsive" src="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>images/portfolios/p6.jpg" alt="">
									<!-- open-modal ID -->
									<a data-toggle="modal" data-target="#modal6" href="#0">
										<figcaption><span>View Details</span></figcaption>
									</a>
								</figure>
								<!-- Portfolio Title -->
								<h6 class="text-capitalize text-center">Portfolio Title Here</h6>
							</div>
						</div>
						<!-- ./Portfolio -->
						<!-- 6th MODAL -->
						<div id="modal6" class="modal" tabindex="-1" role="dialog">
							<div class="modal-dialog modal-lg">
								<div class="modal-content animated zoomIn">
									<h3 class="text-capitalize text-left">Project title will be placed here</h3>
									<div class="row">
										<!-- Modal Image -->
										<img class="img-responsive col-md-8 col-sm-12 col-xs-12" src="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>images/portfolios/p6.jpg" alt="">

										<!-- Modal Content -->
										<div class="content col-md-4 col-sm-12 col-xs-12">
											<!-- Date, Category & Client Name of the Project -->
											<p><span>Date:&nbsp;</span> 5, July 2015</p>
											<p><span>Category:&nbsp;</span> System Development</p>
											<p><span>Client:&nbsp;</span> Mr. John Doe</p>
											<!-- Live Demo Link -->
											<a href="#0" target="_blank" class="btn modal-btn waves-effect waves-light btn-primary custom-btn">Live Demo</a>
											<!-- Some Information Abut the Project -->
											<p class="text-left">
												Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi venenatis et tortor ac tincidunt.
												In euismod iaculis lobortis. Vestibulum posuere molestie ipsum vel sollicitudin. Vestibulum
												venenatis pharetra mi, ut vestibulum elit ultricies. Lorem ipsum dolor sit amet, consectetur
												adipiscing elit. Morbi venenatis et tortor ac tincidunt.
												In euismod iaculis lobortis. Vestibulum posuere molestie ipsum vel sollicitudin. Vestibulum
												venenatis pharetra mi, ut vestibulum elit ultricies. Lorem ipsum dolor sit amet.
											</p>
											<button data-dismiss="modal" class="btn right modal-btn close-btn waves-effect waves-light btn-primary custom-btn">Close</button>
										</div>

									</div>
								</div>
							</div>
						</div>
						<!-- ./modal -->


						<!-- 7th Portfolio, Filter Option -->
						<div class="col col-md-3 col-sm-6 col-xs-12 filtr-item" data-category="5">
							<div class="portfolio card">
								<figure class="hover-effect">
									<!-- Portfolio Image -->
									<img class="img-responsive" src="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>images/portfolios/p7.jpg" alt="">
									<!-- open-modal ID -->
									<a data-toggle="modal" data-target="#modal7" href="#0">
										<figcaption><span>View Details</span></figcaption>
									</a>
								</figure>
								<!-- Portfolio Title -->
								<h6 class="text-capitalize text-center">Portfolio Title Here</h6>
							</div>
						</div>
						<!-- ./Portfolio -->
						<!-- 7th MODAL -->
						<div id="modal7" class="modal" tabindex="-1" role="dialog">
							<div class="modal-dialog modal-lg">
								<div class="modal-content animated zoomIn">
									<h3 class="text-capitalize text-left">Project title will be placed here</h3>
									<div class="row">
										<!-- Modal Image -->
										<img class="img-responsive col-md-8 col-sm-12 col-xs-12" src="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>images/portfolios/p7.jpg" alt="">

										<!-- Modal Content -->
										<div class="content col-md-4 col-sm-12 col-xs-12">
											<!-- Date, Category & Client Name of the Project -->
											<p><span>Date:&nbsp;</span> 5, July 2015</p>
											<p><span>Category:&nbsp;</span> System Development</p>
											<p><span>Client:&nbsp;</span> Mr. John Doe</p>
											<!-- Live Demo Link -->
											<a href="#0" target="_blank" class="btn modal-btn waves-effect waves-light btn-primary custom-btn">Live Demo</a>
											<!-- Some Information Abut the Project -->
											<p class="text-left">
												Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi venenatis et tortor ac tincidunt.
												In euismod iaculis lobortis. Vestibulum posuere molestie ipsum vel sollicitudin. Vestibulum
												venenatis pharetra mi, ut vestibulum elit ultricies. Lorem ipsum dolor sit amet, consectetur
												adipiscing elit. Morbi venenatis et tortor ac tincidunt.
												In euismod iaculis lobortis. Vestibulum posuere molestie ipsum vel sollicitudin. Vestibulum
												venenatis pharetra mi, ut vestibulum elit ultricies. Lorem ipsum dolor sit amet.
											</p>
											<button data-dismiss="modal" class="btn right modal-btn close-btn waves-effect waves-light btn-primary custom-btn">Close</button>
										</div>

									</div>
								</div>
							</div>
						</div>
						<!-- ./modal -->


						<!-- 8th Portfolio, Filter Option -->
						<div class="col col-md-3 col-sm-6 col-xs-12 filtr-item" data-category="2, 3">
							<div class="portfolio card">
								<figure class="hover-effect">
									<!-- Portfolio Image -->
									<img class="img-responsive" src="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>images/portfolios/p8.jpg" alt="">
									<!-- open-modal ID -->
									<a data-toggle="modal" data-target="#modal8" href="#0">
										<figcaption><span>View Details</span></figcaption>
									</a>
								</figure>
								<!-- Portfolio Title -->
								<h6 class="text-capitalize text-center">Portfolio Title Here</h6>
							</div>
						</div>
						<!-- ./Portfolio -->
						<!-- 8th MODAL -->
						<div id="modal8" class="modal" tabindex="-1" role="dialog">
							<div class="modal-dialog modal-lg">
								<div class="modal-content animated zoomIn">
									<h3 class="text-capitalize text-left">Project title will be placed here</h3>
									<div class="row">
										<!-- Modal Image -->
										<img class="img-responsive col-md-8 col-sm-12 col-xs-12" src="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>images/portfolios/p8.jpg" alt="">

										<!-- Modal Content -->
										<div class="content col-md-4 col-sm-12 col-xs-12">
											<!-- Date, Category & Client Name of the Project -->
											<p><span>Date:&nbsp;</span> 5, July 2015</p>
											<p><span>Category:&nbsp;</span> System Development</p>
											<p><span>Client:&nbsp;</span> Mr. John Doe</p>
											<!-- Live Demo Link -->
											<a href="#0" target="_blank" class="btn modal-btn waves-effect waves-light btn-primary custom-btn">Live Demo</a>
											<!-- Some Information Abut the Project -->
											<p class="text-left">
												Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi venenatis et tortor ac tincidunt.
												In euismod iaculis lobortis. Vestibulum posuere molestie ipsum vel sollicitudin. Vestibulum
												venenatis pharetra mi, ut vestibulum elit ultricies. Lorem ipsum dolor sit amet, consectetur
												adipiscing elit. Morbi venenatis et tortor ac tincidunt.
												In euismod iaculis lobortis. Vestibulum posuere molestie ipsum vel sollicitudin. Vestibulum
												venenatis pharetra mi, ut vestibulum elit ultricies. Lorem ipsum dolor sit amet.
											</p>
											<button data-dismiss="modal" class="btn right modal-btn close-btn waves-effect waves-light btn-primary custom-btn">Close</button>
										</div>

									</div>
								</div>
							</div>
						</div>
						<!-- ./modal -->

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
			<h4 class="text-uppercase text-center">Achievement</h4>
			<div class="container">
				<div class="row">

					<!-- 1st Achievement -->
					<div class="col col-md-4 col-sm-6 col-xs-12">
						<div class="achievement">
							<div class="achievement-top-bar">
								<!-- Achievement Title Here -->
								<h5 class="text-center text-capitalize">ACM Software System Award</h5>
							</div>
							<div class="achievement-inner">
								<div class="achievement-header">
									<div class="achievement-heading">
										<!-- Icon and Date -->
										<i class="text-center ion-ribbon-a"></i>
										<h6 class="text-center">June 2016</h6>
									</div>

									<!-- Button ID For Content ID -->
									<a id="btn-1" class="btn-floating waves-effect waves-light btn-large achievement-more-btn custom-btn"
									   data-aos="zoom-in" data-aos-delay="300">
										<i class="ion-ios-arrow-down"></i>
									</a>
								</div>

								<!-- Content ID -->
								<div id="content-1" class="achievement-content">
									<!-- Description -->
									<p class="text-center">
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi venenatis et tortor ac tincidunt.
										In euismod iaculis lobortis. Vestibulum posuere molestie ipsum vel sollicitudin. Vestibulum
										venenatis pharetra mi, ut vestibulum elit ultricies.
									</p>
								</div>
							</div>
						</div>
					</div>
					<!-- ./1st Achievement -->

					<!-- 2nd Achievement -->
					<div class="col col-md-4 col-sm-6 col-xs-12">
						<div class="achievement">
							<div class="achievement-top-bar">
								<!-- Achievement Title Here -->
								<h5 class="text-center text-capitalize">National Badminton Champion</h5>
							</div>
							<div class="achievement-inner">
								<div class="achievement-header">
									<div class="achievement-heading">
										<!-- Icon and Date -->
										<i class="text-center ion-trophy"></i>
										<h6 class="text-center">April 2016</h6>
									</div>

									<!-- Button ID For Content ID -->
									<a id="btn-2" class="btn-floating waves-effect waves-light btn-large achievement-more-btn custom-btn"
									   data-aos="zoom-in" data-aos-delay="300">
										<i class="ion-ios-arrow-down"></i>
									</a>
								</div>

								<!-- Content ID -->
								<div id="content-2" class="achievement-content">
									<!-- Description -->
									<p class="text-center">
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi venenatis et tortor ac tincidunt.
										In euismod iaculis lobortis. Vestibulum posuere molestie ipsum vel sollicitudin. Vestibulum
										venenatis pharetra mi, ut vestibulum elit ultricies.
									</p>
								</div>
							</div>
						</div>
					</div>
					<!-- ./2nd Achievement -->

					<!-- 3rd Achievement -->
					<div class="col col-md-4 col-sm-6 col-xs-12">
						<div class="achievement">
							<div class="achievement-top-bar">
								<!-- Achievement Title Here -->
								<h5 class="text-center text-capitalize">Microsoft Award</h5>
							</div>
							<div class="achievement-inner">
								<div class="achievement-header">
									<div class="achievement-heading">
										<!-- Icon and Date -->
										<i class="text-center ion-ribbon-b"></i>
										<h6 class="text-center">June 2015</h6>
									</div>

									<!-- Button ID For Content ID -->
									<a id="btn-3" class="btn-floating waves-effect waves-light btn-large achievement-more-btn custom-btn"
									   data-aos="zoom-in" data-aos-delay="300">
										<i class="ion-ios-arrow-down"></i>
									</a>
								</div>

								<!-- Content ID -->
								<div id="content-3" class="achievement-content">
									<!-- Description -->
									<p class="text-center">
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi venenatis et tortor ac tincidunt.
										In euismod iaculis lobortis. Vestibulum posuere molestie ipsum vel sollicitudin. Vestibulum
										venenatis pharetra mi, ut vestibulum elit ultricies.
									</p>
								</div>
							</div>
						</div>
					</div>
					<!-- ./3rd Achievement -->

					<!-- 4th Achievement -->
					<div class="col col-md-4 col-sm-6 col-xs-12">
						<div class="achievement">
							<div class="achievement-top-bar">
								<!-- Achievement Title Here -->
								<h5 class="text-center text-capitalize">Fire Bal Pro Membership</h5>
							</div>
							<div class="achievement-inner">
								<div class="achievement-header">
									<div class="achievement-heading">
										<!-- Icon and Date -->
										<i class="text-center ion-fireball"></i>
										<h6 class="text-center">May 2015</h6>
									</div>

									<!-- Button ID For Content ID -->
									<a id="btn-4" class="btn-floating waves-effect waves-light btn-large achievement-more-btn custom-btn"
									   data-aos="zoom-in" data-aos-delay="300">
										<i class="ion-ios-arrow-down"></i>
									</a>
								</div>

								<!-- Content ID -->
								<div id="content-4" class="achievement-content">
									<!-- Description -->
									<p class="text-center">
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi venenatis et tortor ac tincidunt.
										In euismod iaculis lobortis. Vestibulum posuere molestie ipsum vel sollicitudin. Vestibulum
										venenatis pharetra mi, ut vestibulum elit ultricies.
									</p>
								</div>
							</div>
						</div>
					</div>
					<!-- ./4th Achievement -->

					<!-- 5th Achievement -->
					<div class="col col-md-4 col-sm-6 col-xs-12">
						<div class="achievement">
							<div class="achievement-top-bar">
								<!-- Achievement Title Here -->
								<h5 class="text-center text-capitalize">National Biking Champion</h5>
							</div>
							<div class="achievement-inner">
								<div class="achievement-header">
									<div class="achievement-heading">
										<!-- Icon and Date -->
										<i class="text-center ion-android-bicycle"></i>
										<h6 class="text-center">April 2014</h6>
									</div>

									<!-- Button ID For Content ID -->
									<a id="btn-5" class="btn-floating waves-effect waves-light btn-large achievement-more-btn custom-btn"
									   data-aos="zoom-in" data-aos-delay="300">
										<i class="ion-ios-arrow-down"></i>
									</a>
								</div>

								<!-- Content ID -->
								<div id="content-5" class="achievement-content">
									<!-- Description -->
									<p class="text-center">
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi venenatis et tortor ac tincidunt.
										In euismod iaculis lobortis. Vestibulum posuere molestie ipsum vel sollicitudin. Vestibulum
										venenatis pharetra mi, ut vestibulum elit ultricies.
									</p>
								</div>
							</div>
						</div>
					</div>
					<!-- ./5th Achievement -->

					<!-- 6th Achievement -->
					<div class="col col-md-4 col-sm-6 col-xs-12">
						<div class="achievement">
							<div class="achievement-top-bar">
								<!-- Achievement Title Here -->
								<h5 class="text-center text-capitalize">ECO Club Pro Membership</h5>
							</div>
							<div class="achievement-inner">
								<div class="achievement-header">
									<div class="achievement-heading">
										<!-- Icon and Date -->
										<i class="text-center ion-leaf"></i>
										<h6 class="text-center">June 2014</h6>
									</div>

									<!-- Button ID For Content ID -->
									<a id="btn-6" class="btn-floating waves-effect waves-light btn-large achievement-more-btn custom-btn"
									   data-aos="zoom-in" data-aos-delay="300">
										<i class="ion-ios-arrow-down"></i>
									</a>
								</div>

								<!-- Content ID -->
								<div id="content-6" class="achievement-content">
									<!-- Description -->
									<p class="text-center">
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi venenatis et tortor ac tincidunt.
										In euismod iaculis lobortis. Vestibulum posuere molestie ipsum vel sollicitudin. Vestibulum
										venenatis pharetra mi, ut vestibulum elit ultricies.
									</p>
								</div>
							</div>
						</div>
					</div>
					<!-- ./6th Achievement -->

				</div>
			</div>
		</section>
	<?php
		}
		if($_WMENU['small_text']=="publications")
		{
	?>
		<section id="publications" class="section">
			<h4 class="text-uppercase text-center">Publications</h4>
			<div class="container">
				<div class="row">

					<!-- 1st publication -->
					<div class="col col-md-6 col-sm-12 col-xs-12">
						<div class="publication card text-center">
							<!-- place Icon Here -->
							<div class="icon-div text-center" data-aos="zoom-in" data-aos-delay="300"><i class="ion-ios-book"></i></div>
							<h6 class="text-center text-capitalize">Name of the book will be placed here</h6>

							<!-- Type and Published date here -->
							<ul class="text-center list-inline">
								<li><i class="ion-ios-pricetag"></i>Type: Novel</li>
								<li><i class="ion-calendar"></i>Published On: 12 Jun 2015</li>
							</ul>

							<!-- Some Info About Item -->
							<p class="text-center">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi venenatis et tortor ac tincidunt.
								In euismod iaculis lobortis. Vestibulum posuere molestie ipsum vel. Vestibulum
								venenatis vestibulum elit ultricies.
							</p>

							<div class="row">
								<!-- Item link here -->
								<a href="#0" class="btn waves-effect waves-light btn-primary custom-btn">Read Now</a>
							</div>

						</div>
					</div>
					<!-- ./1st publication -->

					<!-- 2nd publication -->
					<div class="col col-md-6 col-sm-12 col-xs-12">
						<div class="publication card text-center">
							<!-- place Icon Here -->
							<div class="icon-div text-center" data-aos="zoom-in" data-aos-delay="300"><i class="ion-ios-paper"></i></div>
							<h6 class="text-center text-capitalize">Subject of research will be placed here</h6>

							<!-- Type and Published date here -->
							<ul class="text-center list-inline">
								<li><i class="ion-ios-pricetag"></i>Type: Research</li>
								<li><i class="ion-calendar"></i>Published On: 12 Jun 2015</li>
							</ul>

							<!-- Some Info About Item -->
							<p class="text-center">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi venenatis et tortor ac tincidunt.
								In euismod iaculis lobortis. Vestibulum posuere molestie ipsum vel. Vestibulum
								venenatis vestibulum elit ultricies.
							</p>

							<div class="row">
								<!-- Item link here -->
								<a href="#0" class="btn waves-effect waves-light btn-primary custom-btn">Read Now</a>
							</div>

						</div>
					</div>
					<!-- ./2nd publication -->

					<!-- 3rd publication -->
					<div class="col col-md-6 col-sm-12 col-xs-12">
						<div class="publication card text-center">
							<!-- place Icon Here -->
							<div class="icon-div text-center" data-aos="zoom-in" data-aos-delay="300"><i class="ion-ios-book"></i></div>
							<h6 class="text-center text-capitalize">Name of the book will be placed here</h6>

							<!-- Type and Published date here -->
							<ul class="text-center list-inline">
								<li><i class="ion-ios-pricetag"></i>Type: Novel</li>
								<li><i class="ion-calendar"></i>Published On: 12 Jun 2015</li>
							</ul>

							<!-- Some Info About Item -->
							<p class="text-center">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi venenatis et tortor ac tincidunt.
								In euismod iaculis lobortis. Vestibulum posuere molestie ipsum vel. Vestibulum
								venenatis vestibulum elit ultricies.
							</p>

							<div class="row">
								<!-- Item link here -->
								<a href="#0" class="btn waves-effect waves-light btn-primary custom-btn">Read Now</a>
							</div>

						</div>
					</div>
					<!-- ./3rd publication -->

					<!-- 4th publication -->
					<div class="col col-md-6 col-sm-12 col-xs-12">
						<div class="publication card text-center">
							<!-- place Icon Here -->
							<div class="icon-div text-center" data-aos="zoom-in" data-aos-delay="300"><i class="ion-ios-paper"></i></div>
							<h6 class="text-center text-capitalize">Subject of research will be placed here</h6>

							<!-- Type and Published date here -->
							<ul class="text-center list-inline">
								<li><i class="ion-ios-pricetag"></i>Type: Research</li>
								<li><i class="ion-calendar"></i>Published On: 12 Jun 2015</li>
							</ul>

							<!-- Some Info About Item -->
							<p class="text-center">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi venenatis et tortor ac tincidunt.
								In euismod iaculis lobortis. Vestibulum posuere molestie ipsum vel. Vestibulum
								venenatis vestibulum elit ultricies.
							</p>

							<div class="row">
								<!-- Item link here -->
								<a href="#0" class="btn waves-effect waves-light btn-primary custom-btn">Read Now</a>
							</div>

						</div>
					</div>
					<!-- ./4th publication -->

				</div>
			</div>
		</section>
	<?php
		}
		if($_WMENU['small_text']=="blog")
		{
	?>
		<section id="blog" class="section">
			<h4 class="text-uppercase text-center">From Blog</h4>
			<div class="container">
				<div class="row">

					<!-- 1st blog post -->
					<div class="col col-md-4 col-sm-12 col-xs-12">
						<div class="card blog">
							<!-- Blog image here -->
							<img class="img-responsive" src="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>images/blog/blog1.jpg">
							<div class="blog-content">
								<!-- Edit title and info here -->
								<div class="blog-title">
									<h6 class="text-capitalize">Blog title will be placed here</h6>
									<ul>
										<li><i class="ion-calendar"></i>28 July</li>
										<li><i class="ion-heart"></i>87</li>
										<li><i class="ion-android-share-alt"></i>26</li>
									</ul>
									<!-- Add link of full post -->
									<a href="post.html" target="_blank" class="btn-floating waves-effect waves-light btn-large more-btn custom-btn"
									   data-aos="zoom-in" data-aos-delay="200">
										<i class="ion-android-more-horizontal"></i></a>
								</div>
								<!-- some line of post -->
								<p class="text-left">
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi venenatis et tortor ac tincidunt.
									In euismod iaculis lobortis. Vestibulum posuere molestie ipsum vel sollicitudin. Vestibulum
									venenatis pharetra vestibulum elit ultricies.......
								</p>
							</div>
						</div>
					</div>
					<!-- ./1st blog post -->

					<!-- 2nd blog post -->
					<div class="col col-md-4 col-sm-12 col-xs-12">
						<div class="card blog">
							<!-- Blog image here -->
							<img class="img-responsive" src="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>images/blog/blog2.jpg">
							<div class="blog-content">
								<!-- Edit title and info here -->
								<div class="blog-title">
									<h6 class="text-capitalize">Blog title will be placed here</h6>
									<ul>
										<li><i class="ion-calendar"></i>12 July</li>
										<li><i class="ion-heart"></i>53</li>
										<li><i class="ion-android-share-alt"></i>73</li>
									</ul>
									<!-- Add link of full post -->
									<a href="post.html" target="_blank" class="btn-floating waves-effect waves-light btn-large more-btn custom-btn"
									   data-aos="zoom-in" data-aos-delay="200">
										<i class="ion-android-more-horizontal"></i></a>
								</div>
								<!-- some line of post -->
								<p class="text-left">
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi venenatis et tortor ac tincidunt.
									In euismod iaculis lobortis. Vestibulum posuere molestie ipsum vel sollicitudin. Vestibulum
									venenatis pharetra vestibulum elit ultricies.......
								</p>
							</div>
						</div>
					</div>
					<!-- ./2nd blog post -->

					<!-- 3rd blog post -->
					<div class="col col-md-4 col-sm-12 col-xs-12">
						<div class="card blog">
							<!-- Blog image here -->
							<img class="img-responsive" src="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>images/blog/blog3.jpg">
							<div class="blog-content">
								<!-- Edit title and info here -->
								<div class="blog-title">
									<h6 class="text-capitalize">Blog title will be placed here</h6>
									<ul>
										<li><i class="ion-calendar"></i>20 Jun</li>
										<li><i class="ion-heart"></i>36</li>
										<li><i class="ion-android-share-alt"></i>37</li>
									</ul>
									<!-- Add link of full post -->
									<a href="post.html" target="_blank" class="btn-floating waves-effect waves-light btn-large more-btn custom-btn"
									   data-aos="zoom-in" data-aos-delay="200">
										<i class="ion-android-more-horizontal"></i></a>
								</div>
								<!-- some line of post -->
								<p class="text-left">
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi venenatis et tortor ac tincidunt.
									In euismod iaculis lobortis. Vestibulum posuere molestie ipsum vel sollicitudin. Vestibulum
									venenatis pharetra vestibulum elit ultricies.......
								</p>
							</div>
						</div>
					</div>
					<!-- ./3rd blog post -->

				</div>

				<div class="row text-center">
					<div class="col col-xs-12 col-sm-12 col-md-12 text-center">
						<a href="blog.html" target="_blank" class="text-uppercase visit-blog btn btn-large custom-btn waves-effect waves-light"
						   data-aos="zoom-in" data-aos-delay="100">Visit MY BLOG</a>
					</div>
				</div>

			</div>
		</section>
	<?php
		}
		if($_WMENU['small_text']=="clients")
		{
	?>
		<section id="clients" class="section">
			<h4 class="text-uppercase text-center">Happy Clients</h4>
			<div class="container">
				<div class="row">

					<div id="client-slider" class="swiper-container">
						<div class="swiper-wrapper">

							<!-- 1st Reference from Client -->
							<div class="col col-md-12 col-sm-12 col-xs-12 swiper-slide">
								<div class="card clients-ref">

									<!-- Client Photo -->
									<div class="client-photo center-block">
										<img class="center-block" src="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>images/client/face-1.png">
									</div>

									<!-- Client Testimonial -->
									<blockquote class="text-center">
										"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi venenatis et tortor ac tincidunt.
										In euismod iaculis lobortis. Vestibulum posuere molestie ipsum vel sollicitudin. Vestibulum
										venenatis pharetra mi, ut vestibulum elit ultricies a. Vestibulum at mollis ex, ac consectetur
										massa. Donec nunc, laoreet a nibh et, semper tincidunt nunc. Donec ac posuere tellus."
										<cite>&mdash; Mr. John Mark, CEO </cite>
									</blockquote>
								</div>
							</div>
							<!-- ./1st Reference from Client -->

							<!-- 2nd Reference from Client -->
							<div class="col col-md-12 col-sm-12 col-xs-12 swiper-slide">
								<div class="card clients-ref">

									<!-- Client Photo -->
									<div class="client-photo center-block">
										<img class="center-block" src="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>images/client/face-2.png">
									</div>

									<!-- Client Testimonial -->
									<blockquote class="text-center">
										"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi venenatis et tortor ac tincidunt.
										In euismod iaculis lobortis. Vestibulum posuere molestie ipsum vel sollicitudin. Vestibulum
										venenatis pharetra mi, ut vestibulum elit ultricies a. Vestibulum at mollis ex, ac consectetur
										massa. Donec nunc, laoreet a nibh et, semper tincidunt nunc. Donec ac posuere tellus."
										<cite>&mdash; Mrs. July Sara, CEO </cite>
									</blockquote>
								</div>
							</div>
							<!-- ./2nd Reference from Client -->

							<!-- 3rd Reference from Client -->
							<div class="col col-md-12 col-sm-12 col-xs-12 swiper-slide">
								<div class="card clients-ref">

									<!-- Client Photo -->
									<div class="client-photo center-block">
										<img class="center-block" src="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>images/client/face-3.png">
									</div>

									<!-- Client Testimonial -->
									<blockquote class="text-center">
										"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi venenatis et tortor ac tincidunt.
										In euismod iaculis lobortis. Vestibulum posuere molestie ipsum vel sollicitudin. Vestibulum
										venenatis pharetra mi, ut vestibulum elit ultricies a. Vestibulum at mollis ex, ac consectetur
										massa. Donec nunc, laoreet a nibh et, semper tincidunt nunc. Donec ac posuere tellus."
										<cite>&mdash; Mr. Robart Hug, CEO </cite>
									</blockquote>
								</div>
							</div>
							<!-- ./3rd Reference from Client -->

							<!-- 4th Reference from Client -->
							<div class="col col-md-12 col-sm-12 col-xs-12 swiper-slide">
								<div class="card clients-ref">

									<!-- Client Photo -->
									<div class="client-photo center-block">
										<img class="center-block" src="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>images/client/face-4.png">
									</div>

									<!-- Client Testimonial -->
									<blockquote class="text-center">
										"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi venenatis et tortor ac tincidunt.
										In euismod iaculis lobortis. Vestibulum posuere molestie ipsum vel sollicitudin. Vestibulum
										venenatis pharetra mi, ut vestibulum elit ultricies a. Vestibulum at mollis ex, ac consectetur
										massa. Donec nunc, laoreet a nibh et, semper tincidunt nunc. Donec ac posuere tellus."
										<cite>&mdash; Mrs. Angela D-Suza, CEO </cite>
									</blockquote>
								</div>
							</div>
							<!-- ./4th Reference from Client -->

						</div>

						<!-- If we need pagination -->
						<div class="swiper-pagination"></div>
					</div>

				</div>

				<div class="row">
					<h5 class="text-uppercase text-center">Also Worked for</h5>

					<!-- Company Logo with Website LInk -->
					<ul class="text-center">
						<li data-aos="fade-up" data-aos-delay="300"><a href="#0">
							<img class="img-responsive media-middle" src="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>images/client/logo1.png" alt="">
						</a></li>
						<li data-aos="fade-up" data-aos-delay="450"><a href="#0">
							<img class="img-responsive media-middle" src="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>images/client/logo2.png" alt="">
						</a></li>
						<li data-aos="fade-up" data-aos-delay="600"><a href="#0">
							<img class="img-responsive media-middle" src="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>images/client/logo3.png" alt="">
						</a></li>
						<li data-aos="fade-up" data-aos-delay="750"><a href="#0">
							<img class="img-responsive media-middle" src="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>images/client/logo4.png" alt="">
						</a></li>
						<li data-aos="fade-up" data-aos-delay="750"><a href="#0">
							<img class="img-responsive media-middle" src="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>images/client/logo5.png" alt="">
						</a></li>
					</ul>
					<!-- ./Company Logo with Website LInk -->

				</div>
			</div>

		</section>
	<?php
		}
		if($_WMENU['small_text']=="interest")
		{
	?>
		<section id="interest" class="section">
			<h4 class="text-uppercase text-center">Interest</h4>
			<div class="container">
				<div class="row">
					<div class="col col-md-12 col-sm-12 col-xs-12">
						<div class="card interest">
							<div class="row">
								<div class="col col-md-12 col-sm-12 col-xs-12">

									<!-- Some brief about your interest -->
									<p class="text-center">
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi venenatis et tortor ac tincidunt.
										In euismod iaculis lobortis. Vestibulum posuere molestie ipsum vel sollicitudin.
										Vestibulum venenatis pharetrami. Lorem ipsum dolor sit amet.
									</p>
								</div>

								<!-- Interest Topic Icon and Name -->
								<ul class="col-md-12 col-sm-12 col-xs-12 text-center list-inline">
									<li class="interest-topic">
										<i class="ion-ios-film"></i>
										<span>Documentary</span>
									</li>
									<li class="interest-topic">
										<i class="ion-compose"></i>
										<span>Blogging</span>
									</li>
									<li class="interest-topic">
										<i class="ion-headphone"></i>
										<span>Music</span>
									</li>
									<li class="interest-topic">
										<i class="ion-ios-football"></i>
										<span>Football</span>
									</li>

									<li class="interest-topic">
										<i class="ion-plane"></i>
										<span>Traveling</span>
									</li>

									<li class="interest-topic">
										<i class="ion-ios-game-controller-b"></i>
										<span>Gaming</span>
									</li>
									<li class="interest-topic">
										<i class="ion-ios-camera"></i>
										<span>Photography</span>
									</li>
								</ul>
								<!-- ./Interest Topic Icon and Name -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	<?php
		}
		if($_WMENU['small_text']=="contact")
		{
	?>
		<section id="contact" class="section">
			<h4 class="text-uppercase text-center">Contact</h4>
			<div class="container">
				<div class="row">

					<!-- Contact Info -->
					<div class="col col-md-5 col-sm-6 col-xs-12">
						<div class="info card">

							<!-- Apply your own info here -->
							<ul class="text-center center-block" data-aos="fade" data-aos-delay="200" data-aos-offset="0">
								<li>
									<i class="ion-android-call center-block"></i>
									<span>+880 - 12345 - 67890</span>
								</li>
								<li>
									<i class="ion-ios-printer center-block"></i>
									<span>+880 - 12345 - 67890</span>
								</li>
								<li>
									<i class="ion-email center-block"></i>
									<span>emailid@domain.com</span>
								</li>
								<li>
									<i class="ion-earth center-block"></i>
									<span>websiteaddresslink.com</span>
								</li>
								<li>
									<i class="ion-ios-location center-block"></i>
									<span>25/A New Eskaton Road, Maghbazar</span>
								</li>
							</ul>

						</div>
					</div>
					<!-- ./Contact Info -->

					<!-- Contact Form -->
					<div class="col col-md-7 col-sm-6 col-xs-12">
						<div  class="contact card">

							<form id="contact-form" name="contact-form" role="form">
								<div class="input-field">
									<input  id="name" name="name" type="text" class="validate" required>
									<label for="name">Name</label>
								</div>
								<div class="input-field">
									<input id="subject" name="subject" type="text" class="validate" required>
									<label for="subject">Subject</label>
								</div>
								<div class="input-field">
									<input id="email" name="email" type="email" class="validate" required>
									<label for="email">Email</label>
								</div>
								<div class="input-field">
									<textarea id="textarea" name="message" class="materialize-textarea" required></textarea>
									<label for="textarea">Massage</label>
								</div>
								<div class="row">
									<div class="col col-md-12 col-sm-12 col-xs-12 text-center">
										<button type="submit" id="submit" name="submit-data" value="Submit" class="btn waves-effect waves-light btn-primary custom-btn">
											<!-- Button value here -->
											<i class="ion-ios-paperplane"></i>Send</button>
									</div>

									<!-- Message Sent and Error info -->
									<div id="snackbar">Your Message is sent</div>
									<div id="fail-snackbar">Something is going wrong, Please try again</div>
								</div>
							</form>

						</div>
					</div>
					<!-- ./Contact Form -->

				</div>

				<!-- Location MAP -->
				<div class="row">
					<div class="col col-md-12 col-sm-12 col-xs-12">
						<div id="google-map" data-aos="zoom-in" data-aos-delay="0" data-aos-offset="0">
							<div id="map-container"></div>
							<div id="cd-zoom-in" class="custom-btn"><i class="material-icons text-center">add</i></div>
							<div id="cd-zoom-out" class="custom-btn"><i class="material-icons text-center">remove</i></div>
							<!-- Your address here -->
							<address class="text-center">25/A New Eskaton Road, Maghbazar, Dhaka 1000, Bangladesh</address>
						</div>
					</div>
				</div>
			</div>
		</section>
	<?php
		}
	}
?>
<!--==========================================
                    FOOTER
===========================================-->
<footer>
    <div class="container">
        <p class="text-center">
            © ROPEYOU Profile Pages 2019. Designed By
            <a href="<?php echo base_url; ?>" target="_blank">
                <strong>ROPEYOU</strong>
            </a> In INDIA With LOVE.
        </p>
    </div>
</footer>

<!-- Back To Top Button -->
<a href="#header" id="btp" class="back-to-top btn-floating waves-effect waves-light btn-large custom-btn">
    <i class="ion-ios-arrow-up"></i>
</a>

<!--==========================================
                COLOR SWITCHER
===========================================-->
<div class="switcher">
    <div class="switcher-btn custom-btn waves-effect waves-light text-center">
        <i class="ion-android-color-palette text-center"></i>
    </div>
    <div class="back custom-btn waves-effect waves-light text-center">
        <i class="ion-ios-arrow-right text-center"></i>
    </div>
    <div class="colors">
        <p class="text-center text-capitalize">Choose Your Favourite Color</p>
        <ul>
            <li id="color-red" class="color-btn"></li>
            <li id="color-pink" class="color-btn"></li>
            <li id="color-purple" class="color-btn"></li>
            <li id="color-deep-purple" class="color-btn"></li>
            <li id="color-indigo" class="color-btn"></li>
            <li id="color-blue" class="color-btn"></li>
            <li id="color-teal" class="color-btn"></li>
            <li id="color-green" class="color-btn"></li>
            <li id="color-light-green" class="color-btn"></li>
            <li id="color-amber" class="color-btn"></li>
            <li id="color-orange" class="color-btn"></li>
            <li id="color-deep-orange" class="color-btn"></li>
            <li id="color-brown" class="color-btn"></li>
            <li id="color-blue-gray" class="color-btn"></li>
            <li id="color-gray" class="color-btn"></li>
        </ul>
    </div>
</div>

<!-- ================== SCRIPTS ================== -->
<script src="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>javascript/jquery-2.1.3.min.js"></script>
<script>
	$(window).load(function(){
		localStorage.setItem('this_page_base_url',"<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>");
	});
</script>
<script src="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>javascript/aos.min.js"></script>
<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCa27gHtUg_79772tpFkwzruM89feLVmiI"></script>
<script src="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>javascript/custom-map.js"></script>-->
<script src="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>javascript/bootstrap.min.js"></script>
<script src="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>javascript/materialize.min.js"></script>
<script src="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>javascript/retina.min.js"></script>
<script src="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>javascript/jquery.filterizr.min.js"></script>
<script src="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>javascript/swiper.jquery.min.js"></script>
<script src="<?php echo base_url.sub_dir_simple.$_WEB_TEMPLATE_ID; ?>javascript/custom-script.js"></script>
</body>
</html>