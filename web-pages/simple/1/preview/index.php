<?php
	include_once '../../../../connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="author" content="RopeYou Web Pages">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <title>Default Resume :: RopeYou</title>
    <!-- Fav Icon -->
    <link rel="icon" href="../images/fav-icon.png">
    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" href="../images/apple-touch-icon.png">


    <!-- Google Font -->
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>


    <!-- Google Material Icon -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Font Awesome Icon -->
    <link href="../stylesheets/font-awesome.min.css" rel="stylesheet">
    <!-- IonIcons Icon -->
    <link href="../stylesheets/ionicons.min.css" rel="stylesheet">


    <!-- Animation -->
    <link href="../stylesheets/animate.css" rel="stylesheet">
    <!-- Animation On Scroll -->
    <link href="../stylesheets/aos.min.css" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="../stylesheets/bootstrap.css" rel="stylesheet">
    <!-- Materialize -->
    <link href="../stylesheets/materialize.css" rel="stylesheet">
    <!-- Swiper Slider -->
    <link href="../stylesheets/swiper.css" rel="stylesheet">

    <link id="color-switcher" href="../stylesheets/style-grey.css" rel="stylesheet">

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
        <p class="text-uppercase">FEATURING</p>
        <!-- Name Only -->
        <h6 class="text-uppercase">JOHN ROBERT SMITH</h6>
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

                <!-- Menu Option -->
                <ul class="nav-justified hide-on-med-and-down">
                    <li><a href="#header">About</a></li>
                    <li><a href="#experience">Experience</a></li>
                    <li><a href="#skills">Skills</a></li>
                    <li><a href="#education">Education</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#portfolios">Portfolios</a></li>
                    <li><a href="#achievement">Achievement</a></li>
                    <li><a href="#publications">Publications</a></li>
                    <li><a href="#blog">blog</a></li>
                    <li><a href="#clients">Clients</a></li>
                    <li><a href="#pricing">Pricing</a></li>
                    <li><a href="#interest">Interest</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>

                <a href="#0" data-activates="nav-mobile" id="nav-btn" class="button-collapse nav-icon">
                    <i class="ion-navicon"></i></a>

                <!-- Side Nav -->
                <div id="side-nav">
                    <div id="nav-header">
                        <div id="nav-profile" class="center-block">

                            <!-- Profile Picture [Square] -->
                            <img src="../images/profile-pic.png">
                        </div>
                        <h6 class="text-center text-capitalize">John Robert Smith</h6>
                    </div>

                    <div id="nav-link-wrapper">

                        <!-- Side Menu Option -->
                        <ul>
                            <li><a class="nav-link" href="#header">About</a></li>
                            <li><a class="nav-link" href="#experience">Experience</a></li>
                            <li><a class="nav-link" href="#skills">Skills</a></li>
                            <li><a class="nav-link" href="#education">Education</a></li>
                            <li><a class="nav-link" href="#services">Services</a></li>
                            <li><a class="nav-link" href="#portfolios">Portfolios</a></li>
                            <li><a class="nav-link" href="#achievement">Achievement</a></li>
                            <li><a class="nav-link" href="#publications">Publications</a></li>
                            <li><a class="nav-link" href="#blog">blog</a></li>
                            <li><a class="nav-link" href="#clients">Clients</a></li>
                            <li><a class="nav-link" href="#pricing">Pricing</a></li>
                            <li><a class="nav-link" href="#interest">Interest</a></li>
                            <li><a class="nav-link" href="#contact">Contact</a></li>
                        </ul>
                    </div>

                </div>
                <!-- ./Side Nav -->

                <!-- Side Nav Mask -->
                <div id="side-nav-mask"></div>

            </div>
        </div>
    </nav>

    <!-- Name and Status -->
    <div id="intro" class="container">
        <h1 class="text-center text-capitalize">John Robert Smith</h1>
        <h4 class="text-center text-capitalize">Web Designer & Developer, UX/UI Expert</h4>
    </div>
</div>

<!--==========================================
                   ABOUT
===========================================-->
<section id="about" class="section">
    <div class="container">
        <div class="row">
            <div class="col col-md-12">

                <!-- Profile Picture [Square] -->
                <div id="profile" class="center-block">
                    <img src="../images/profile-pic.png">
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

                    <!-- Some Intro About You -->
                    <p class="text-center">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi venenatis et tortor ac tincidunt.
                        In euismod iaculis lobortis. Vestibulum posuere molestie ipsum vel sollicitudin. Vestibulum
                        venenatis pharetra mi, ut vestibulum elit ultricies a. Vestibulum at mollis ex, ac consectetur
                        massa. Donec nunc dui, laoreet a nibh et, semper tincidunt nunc. Donec ac posuere tellus.
                        Pellentesque tempus suscipit velit sit amet bibendum.
                    </p>

                    <div class="row">
                        <!-- Download & Contact Button -->
                        <div class="col col-xs-12 col-sm-12 col-md-12 text-center">
                            <!-- Your CV File -->
                            <a href="../cv/cv-file.docx" download="cv-file.docx" class="btn waves-effect waves-light btn-primary custom-btn">Download CV</a>
                            
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<!--==========================================
                   EXPERIENCE
===========================================-->
<section id="experience" class="section">
    <h4 class="text-uppercase text-center">Experience</h4>
    <div class="container">
        <div class="row">
            <div class="col col-md-12 col-sm-12 col-xs-12">

                <!-- Timeline -->
                <div class="timeline center-block">
                    <ul>
                        <li class="card" data-aos="fade-up">
                            <i class="title-icon fa fa-circle"></i>
                            <div class="timeline-content">

                                <!-- Heading -->
                                <div class="timeline-header">
                                    <h3 class="text-capitalize">Chief Project Manager</h3>
                                </div>

                                <!-- Organization and Period -->
                                <p class="sub-heading">Lorem Ipsum Technology - South Africa</p>
                                <p class="sub-heading">January 2012 - December 2015</p>

                                <!-- Job Summary -->
                                <p class="content-p">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                    Atque, facilis quo. Maiores magnam modi ab libero praesentium
                                    blanditiis consequatur aspernatur accusantium maxime molestiae sunt ipsa.
                                </p>
                            </div>
                        </li>

                        <li class="card" data-aos="fade-up">
                            <i class="title-icon fa fa-circle"></i>
                            <div class="timeline-content">

                                <!-- Heading -->
                                <div class="timeline-header">
                                    <h3 class="text-capitalize">Senior UX/UI Designer</h3>
                                </div>

                                <!-- Organization and Period -->
                                <p class="sub-heading">Lorem Ipsum Technology - South Africa</p>
                                <p class="sub-heading">January 2012 - December 2015</p>

                                <!-- Job Summary -->
                                <p class="content-p">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                    Atque, facilis quo. Maiores magnam modi ab libero praesentium
                                    blanditiis consequatur aspernatur accusantium maxime molestiae sunt ipsa.
                                </p>
                            </div>
                        </li>

                        <li class="card" data-aos="fade-up">
                            <i class="title-icon fa fa-circle"></i>
                            <div class="timeline-content">

                                <!-- Heading -->
                                <div class="timeline-header">
                                    <h3 class="text-capitalize">Chief Project Manager</h3>
                                </div>

                                <!-- Organization and Period -->
                                <p class="sub-heading">Lorem Ipsum Technology - South Africa</p>
                                <p class="sub-heading">January 2012 - December 2015</p>

                                <!-- Job Summary -->
                                <p class="content-p">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                    Atque, facilis quo. Maiores magnam modi ab libero praesentium
                                    blanditiis consequatur aspernatur accusantium maxime molestiae sunt ipsa.
                                </p>
                            </div>
                        </li>

                        <li class="card" data-aos="fade-up">
                            <i class="title-icon fa fa-circle"></i>
                            <div class="timeline-content">

                                <!-- Heading -->
                                <div class="timeline-header">
                                    <h3 class="text-capitalize">Senior UX/UI Designer</h3>
                                </div>

                                <!-- Organization and Period -->
                                <p class="sub-heading">Lorem Ipsum Technology - South Africa</p>
                                <p class="sub-heading">January 2012 - December 2015</p>

                                <!-- Job Summary -->
                                <p class="content-p">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                    Atque, facilis quo. Maiores magnam modi ab libero praesentium
                                    blanditiis consequatur aspernatur accusantium maxime molestiae sunt ipsa.
                                </p>
                            </div>
                        </li>

                    </ul>
                </div>
                <!-- End of Timeline -->
            </div>
        </div>
    </div>
</section>

<!--==========================================
                   SKILLS
===========================================-->
<section id="skills" class="section">
    <h4 class="text-uppercase text-center">Skills</h4>
    <div class="container">
        <div class="row">

            <!-- Professional Skills -->
            <div class="col col-md-4 col-sm-4 col-xs-12">
                <div class="card content-wrapper skill-wrapper">
                    <h5 class="text-center skill-title">Professional</h5>

                    <div class="skill-progress-div">
                        <!-- Add Skill -->
                        <p>UI/UX Design<span>90%</span></p>
                        <!-- Edit Value Here -->
                        <div class="progress skill-progress" data-percent="90%">
                            <div class="determinate skill-determinate">
                                <i class="skill-determinate-circle fa fa-circle"
                                   data-aos="zoom-in" data-aos-delay="300" data-aos-offset="0"></i>
                            </div>
                        </div>
                    </div>

                    <div class="skill-progress-div">
                        <!-- Add Skill -->
                        <p>PHP Web Application<span>80%</span></p>
                        <!-- Edit Value Here -->
                        <div class="progress skill-progress" data-percent="80%">
                            <div class="determinate skill-determinate">
                                <i class="skill-determinate-circle fa fa-circle"
                                   data-aos="zoom-in" data-aos-delay="300" data-aos-offset="0"></i>
                            </div>
                        </div>
                    </div>
                    <div class="skill-progress-div">
                        <!-- Add Skill -->
                        <p>Android Development<span>70%</span></p>
                        <!-- Edit Value Here -->
                        <div class="progress skill-progress" data-percent="70%">
                            <div class="determinate skill-determinate">
                                <i class="skill-determinate-circle fa fa-circle"
                                   data-aos="zoom-in" data-aos-delay="300" data-aos-offset="0"></i>
                            </div>
                        </div>
                    </div>
                    <div class="skill-progress-div">
                        <!-- Add Skill -->
                        <p>Adobe Design Tools<span>70%</span></p>
                        <!-- Edit Value Here -->
                        <div class="progress skill-progress" data-percent="70%">
                            <div class="determinate skill-determinate">
                                <i class="skill-determinate-circle fa fa-circle"
                                   data-aos="zoom-in" data-aos-delay="300" data-aos-offset="0"></i>
                            </div>
                        </div>
                    </div>
                    <div class="skill-progress-div">
                        <!-- Add Skill -->
                        <p>Microsoft Office<span>80%</span></p>
                        <!-- Edit Value Here -->
                        <div class="progress skill-progress" data-percent="80%">
                            <div class="determinate skill-determinate">
                                <i class="skill-determinate-circle fa fa-circle"
                                   data-aos="zoom-in" data-aos-delay="300" data-aos-offset="0"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Personal Skills -->
            <div class="col col-md-4 col-sm-4 col-xs-12">
                <div class="card content-wrapper skill-wrapper">
                    <h5 class="text-center skill-title">Personal</h5>

                    <div class="skill-progress-div">
                        <!-- Add Skill -->
                        <p>Committed<span>100%</span></p>
                        <!-- Edit Value Here -->
                        <div class="progress skill-progress" data-percent="100%">
                            <div class="determinate skill-determinate">
                                <i class="skill-determinate-circle fa fa-circle"
                                   data-aos="zoom-in" data-aos-delay="300" data-aos-offset="0"></i>
                            </div>
                        </div>
                    </div>

                    <div class="skill-progress-div">
                        <!-- Add Skill -->
                        <p>Punctual<span>90%</span></p>
                        <!-- Edit Value Here -->
                        <div class="progress skill-progress" data-percent="90%">
                            <div class="determinate skill-determinate">
                                <i class="skill-determinate-circle fa fa-circle"
                                   data-aos="zoom-in" data-aos-delay="300" data-aos-offset="0"></i>
                            </div>
                        </div>
                    </div>
                    <div class="skill-progress-div">
                        <!-- Add Skill -->
                        <p>Leadership<span>80%</span></p>
                        <!-- Edit Value Here -->
                        <div class="progress skill-progress" data-percent="80%">
                            <div class="determinate skill-determinate">
                                <i class="skill-determinate-circle fa fa-circle"
                                   data-aos="zoom-in" data-aos-delay="300" data-aos-offset="0"></i>
                            </div>
                        </div>
                    </div>
                    <div class="skill-progress-div">
                        <!-- Add Skill -->
                        <p>Communicative<span>70%</span></p>
                        <!-- Edit Value Here -->
                        <div class="progress skill-progress" data-percent="70%">
                            <div class="determinate skill-determinate">
                                <i class="skill-determinate-circle fa fa-circle"
                                   data-aos="zoom-in" data-aos-delay="300" data-aos-offset="0"></i>
                            </div>
                        </div>
                    </div>
                    <div class="skill-progress-div">
                        <!-- Add Skill -->
                        <p>Analytical Skill<span>80%</span></p>
                        <!-- Edit Value Here -->
                        <div class="progress skill-progress" data-percent="80%">
                            <div class="determinate skill-determinate">
                                <i class="skill-determinate-circle fa fa-circle"
                                   data-aos="zoom-in" data-aos-delay="300" data-aos-offset="0"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Language Skills -->
            <div class="col col-md-4 col-sm-4 col-xs-12">
                <div class="card content-wrapper skill-wrapper">
                    <h5 class="text-center skill-title">Language</h5>

                    <div class="skill-progress-div">
                        <!-- Add Skill -->
                        <p>English (Native)<span>100%</span></p>
                        <!-- Edit Value Here -->
                        <div class="progress skill-progress" data-percent="100%">
                            <div class="determinate skill-determinate">
                                <i class="skill-determinate-circle fa fa-circle"
                                   data-aos="zoom-in" data-aos-delay="300" data-aos-offset="0"></i>
                            </div>
                        </div>
                    </div>

                    <div class="skill-progress-div">
                        <!-- Add Skill -->
                        <p>Spanish<span>90%</span></p>
                        <!-- Edit Value Here -->
                        <div class="progress skill-progress" data-percent="90%">
                            <div class="determinate skill-determinate">
                                <i class="skill-determinate-circle fa fa-circle"
                                   data-aos="zoom-in" data-aos-delay="300" data-aos-offset="0"></i>
                            </div>
                        </div>
                    </div>
                    <div class="skill-progress-div">
                        <!-- Add Skill -->
                        <p>French<span>80%</span></p>
                        <!-- Edit Value Here -->
                        <div class="progress skill-progress" data-percent="80%">
                            <div class="determinate skill-determinate">
                                <i class="skill-determinate-circle fa fa-circle"
                                   data-aos="zoom-in" data-aos-delay="300" data-aos-offset="0"></i>
                            </div>
                        </div>
                    </div>
                    <div class="skill-progress-div">
                        <!-- Add Skill -->
                        <p>Arabic<span>70%</span></p>
                        <!-- Edit Value Here -->
                        <div class="progress skill-progress" data-percent="70%">
                            <div class="determinate skill-determinate">
                                <i class="skill-determinate-circle fa fa-circle"
                                   data-aos="zoom-in" data-aos-delay="300" data-aos-offset="0"></i>
                            </div>
                        </div>
                    </div>
                    <div class="skill-progress-div">
                        <!-- Add Skill -->
                        <p>Hindi<span>60%</span></p>
                        <!-- Edit Value Here -->
                        <div class="progress skill-progress" data-percent="60%">
                            <div class="determinate skill-determinate">
                                <i class="skill-determinate-circle fa fa-circle"
                                   data-aos="zoom-in" data-aos-delay="300" data-aos-offset="0"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--==========================================
                   EDUCATION
===========================================-->
<section id="education" class="section">
    <h4 class="text-uppercase text-center">Education</h4>
    <div class="container">
        <div class="row">
            <div class="col col-md-12 col-sm-12 col-xs-12">

                <!-- Timeline -->
                <div class="timeline center-block">
                    <ul>
                        <li class="card" data-aos="fade-up">
                            <i class="title-icon fa fa-circle"></i>
                            <div class="timeline-content">

                                <!-- Heading -->
                                <div class="timeline-header">
                                    <h3 class="text-capitalize">Master of Computer Science & engineering</h3>
                                </div>

                                <!-- Institution, Period & result -->
                                <p class="sub-heading">Harvard University - United States</p>
                                <p class="sub-heading">January 2012 - December 2015</p>
                                <p class="sub-heading">Result: 4.0 out of 4.0</p>

                                <!-- Education Summary -->
                                <p class="content-p">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                    Atque, facilis quo. Maiores magnam modi ab libero praesentium
                                    blanditiis consequatur aspernatur accusantium maxime molestiae sunt ipsa.
                                </p>
                            </div>
                        </li>

                        <li class="card" data-aos="fade-up">
                            <i class="title-icon fa fa-circle"></i>
                            <div class="timeline-content">

                                <!-- Heading -->
                                <div class="timeline-header">
                                    <h3 class="text-capitalize">Bachelor Of Computer Science & Engineering</h3>
                                </div>

                                <!-- Institution, Period & result -->
                                <p class="sub-heading">Harvard University - United States</p>
                                <p class="sub-heading">January 2012 - December 2015</p>
                                <p class="sub-heading">Result: 4.0 out of 4.0</p>

                                <!-- Education Summary -->
                                <p class="content-p">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                    Atque, facilis quo. Maiores magnam modi ab libero praesentium
                                    blanditiis consequatur aspernatur accusantium maxime molestiae sunt ipsa.
                                </p>
                            </div>
                        </li>

                        <li class="card" data-aos="fade-up">
                            <i class="title-icon fa fa-circle"></i>
                            <div class="timeline-content">

                                <!-- Heading -->
                                <div class="timeline-header">
                                    <h3 class="text-capitalize">Master of Computer Science & engineering</h3>
                                </div>

                                <!-- Institution, Period & result -->
                                <p class="sub-heading">Harvard University - United States</p>
                                <p class="sub-heading">January 2012 - December 2015</p>
                                <p class="sub-heading">Result: 4.0 out of 4.0</p>

                                <!-- Education Summary -->
                                <p class="content-p">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                    Atque, facilis quo. Maiores magnam modi ab libero praesentium
                                    blanditiis consequatur aspernatur accusantium maxime molestiae sunt ipsa.
                                </p>
                            </div>
                        </li>

                        <li class="card" data-aos="fade-up">
                            <i class="title-icon fa fa-circle"></i>
                            <div class="timeline-content">

                                <!-- Heading -->
                                <div class="timeline-header">
                                    <h3 class="text-capitalize">Bachelor Of Computer Science & Engineering</h3>
                                </div>

                                <!-- Institution, Period & result -->
                                <p class="sub-heading">Harvard University - United States</p>
                                <p class="sub-heading">January 2012 - December 2015</p>
                                <p class="sub-heading">Result: 4.0 out of 4.0</p>

                                <!-- Education Summary -->
                                <p class="content-p">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                    Atque, facilis quo. Maiores magnam modi ab libero praesentium
                                    blanditiis consequatur aspernatur accusantium maxime molestiae sunt ipsa.
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- End of Timeline -->
            </div>
        </div>
    </div>
</section>

<!--==========================================
                   SERVICES
===========================================-->
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

<!--==========================================
                   PORTFOLIOS
===========================================-->
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
                            <img class="img-responsive" src="../images/portfolios/p1.jpg" alt="">
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
                                <img class="img-responsive col-md-8 col-sm-12 col-xs-12" src="../images/portfolios/p1.jpg" alt="">

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
                            <img class="img-responsive" src="../images/portfolios/p2.jpg" alt="">
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
                                <img class="img-responsive col-md-8 col-sm-12 col-xs-12" src="../images/portfolios/p2.jpg" alt="">

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
                            <img class="img-responsive" src="../images/portfolios/p3.jpg" alt="">
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
                                <img class="img-responsive col-md-8 col-sm-12 col-xs-12" src="../images/portfolios/p3.jpg" alt="">

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
                            <img class="img-responsive" src="../images/portfolios/p4.jpg" alt="">
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
                                <img class="img-responsive col-md-8 col-sm-12 col-xs-12" src="../images/portfolios/p4.jpg" alt="">

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
                            <img class="img-responsive" src="../images/portfolios/p5.jpg" alt="">
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
                                <img class="img-responsive col-md-8 col-sm-12 col-xs-12" src="../images/portfolios/p5.jpg" alt="">

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
                            <img class="img-responsive" src="../images/portfolios/p6.jpg" alt="">
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
                                <img class="img-responsive col-md-8 col-sm-12 col-xs-12" src="../images/portfolios/p6.jpg" alt="">

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
                            <img class="img-responsive" src="../images/portfolios/p7.jpg" alt="">
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
                                <img class="img-responsive col-md-8 col-sm-12 col-xs-12" src="../images/portfolios/p7.jpg" alt="">

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
                            <img class="img-responsive" src="../images/portfolios/p8.jpg" alt="">
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
                                <img class="img-responsive col-md-8 col-sm-12 col-xs-12" src="../images/portfolios/p8.jpg" alt="">

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

<!--==========================================
               ACHIEVEMENT
===========================================-->
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

<section id="blog" class="section">
    <h4 class="text-uppercase text-center">From Posts</h4>
    <div class="container">
        <div class="row">

            <!-- 1st blog blog -->
            <div class="col col-md-4 col-sm-12 col-xs-12">
                <div class="card blog">
                    <!-- blog image here -->
                    <img class="img-responsive" src="../images/blog/blog1.jpg">
                    <div class="blog-content">
                        <!-- Edit title and info here -->
                        <div class="blog-title">
                            <h6 class="text-capitalize">Posts title will be placed here</h6>
                            <ul>
                                <li><i class="ion-calendar"></i>28 July</li>
                                <li><i class="ion-heart"></i>87</li>
                                <li><i class="ion-android-share-alt"></i>26</li>
                            </ul>
                            <!-- Add link of full blog -->
                            <a href="#" target="_blank" class="btn-floating waves-effect waves-light btn-large more-btn custom-btn"
                               data-aos="zoom-in" data-aos-delay="200">
                                <i class="ion-android-more-horizontal"></i></a>
                        </div>
                        <!-- some line of blog -->
                        <p class="text-left">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi venenatis et tortor ac tincidunt.
                            In euismod iaculis lobortis. Vestibulum posuere molestie ipsum vel sollicitudin. Vestibulum
                            venenatis pharetra vestibulum elit ultricies.......
                        </p>
                    </div>
                </div>
            </div>
            <!-- ./1st blog blog -->

            <!-- 2nd blog blog -->
            <div class="col col-md-4 col-sm-12 col-xs-12">
                <div class="card blog">
                    <!-- blog image here -->
                    <img class="img-responsive" src="../images/blog/blog2.jpg">
                    <div class="blog-content">
                        <!-- Edit title and info here -->
                        <div class="blog-title">
                            <h6 class="text-capitalize">Posts title will be placed here</h6>
                            <ul>
                                <li><i class="ion-calendar"></i>12 July</li>
                                <li><i class="ion-heart"></i>53</li>
                                <li><i class="ion-android-share-alt"></i>73</li>
                            </ul>
                            <!-- Add link of full blog -->
                            <a href="#" target="_blank" class="btn-floating waves-effect waves-light btn-large more-btn custom-btn"
                               data-aos="zoom-in" data-aos-delay="200">
                                <i class="ion-android-more-horizontal"></i></a>
                        </div>
                        <!-- some line of blog -->
                        <p class="text-left">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi venenatis et tortor ac tincidunt.
                            In euismod iaculis lobortis. Vestibulum posuere molestie ipsum vel sollicitudin. Vestibulum
                            venenatis pharetra vestibulum elit ultricies.......
                        </p>
                    </div>
                </div>
            </div>
            <!-- ./2nd blog blog -->

            <!-- 3rd blog blog -->
            <div class="col col-md-4 col-sm-12 col-xs-12">
                <div class="card blog">
                    <!-- blog image here -->
                    <img class="img-responsive" src="../images/blog/blog3.jpg">
                    <div class="blog-content">
                        <!-- Edit title and info here -->
                        <div class="blog-title">
                            <h6 class="text-capitalize">Posts title will be placed here</h6>
                            <ul>
                                <li><i class="ion-calendar"></i>20 Jun</li>
                                <li><i class="ion-heart"></i>36</li>
                                <li><i class="ion-android-share-alt"></i>37</li>
                            </ul>
                            <!-- Add link of full blog -->
                            <a href="#" target="_blank" class="btn-floating waves-effect waves-light btn-large more-btn custom-btn"
                               data-aos="zoom-in" data-aos-delay="200">
                                <i class="ion-android-more-horizontal"></i></a>
                        </div>
                        <!-- some line of blog -->
                        <p class="text-left">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi venenatis et tortor ac tincidunt.
                            In euismod iaculis lobortis. Vestibulum posuere molestie ipsum vel sollicitudin. Vestibulum
                            venenatis pharetra vestibulum elit ultricies.......
                        </p>
                    </div>
                </div>
            </div>
            <!-- ./3rd blog blog -->

        </div>

        <div class="row text-center">
            <div class="col col-xs-12 col-sm-12 col-md-12 text-center">
                <a href="#" target="_blank" class="text-uppercase visit-blog btn btn-large custom-btn waves-effect waves-light"
                   data-aos="zoom-in" data-aos-delay="100">Visit MY blog</a>
            </div>
        </div>

    </div>
</section>

<!--==========================================
                   CLIENTS
===========================================-->
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
                                <img class="center-block" src="../images/client/face-1.png">
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
                                <img class="center-block" src="../images/client/face-2.png">
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
                                <img class="center-block" src="../images/client/face-3.png">
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
                                <img class="center-block" src="../images/client/face-4.png">
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
                    <img class="img-responsive media-middle" src="../images/client/logo1.png" alt="">
                </a></li>
                <li data-aos="fade-up" data-aos-delay="450"><a href="#0">
                    <img class="img-responsive media-middle" src="../images/client/logo2.png" alt="">
                </a></li>
                <li data-aos="fade-up" data-aos-delay="600"><a href="#0">
                    <img class="img-responsive media-middle" src="../images/client/logo3.png" alt="">
                </a></li>
                <li data-aos="fade-up" data-aos-delay="750"><a href="#0">
                    <img class="img-responsive media-middle" src="../images/client/logo4.png" alt="">
                </a></li>
                <li data-aos="fade-up" data-aos-delay="750"><a href="#0">
                    <img class="img-responsive media-middle" src="../images/client/logo5.png" alt="">
                </a></li>
            </ul>
            <!-- ./Company Logo with Website LInk -->

        </div>
    </div>

</section>

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
                                <span>blogging</span>
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

<!--==========================================
                    FOOTER
===========================================-->
<footer>
    <div class="container">
        <p class="text-center">
            © RopeYou Web Pages | Resume 2019. Designed by
            <a href="<?php echo base_url; ?>" target="_blank">
                <strong>RopeYou Web Pages</strong> With LOVE in INDIA.
            </a>
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
<script src="../javascript/jquery-2.1.3.min.js"></script>
<script src="../javascript/aos.min.js"></script>
<script src="../javascript/bootstrap.min.js"></script>
<script src="../javascript/materialize.min.js"></script>
<script src="../javascript/retina.min.js"></script>
<script src="../javascript/jquery.filterizr.min.js"></script>
<script src="../javascript/swiper.jquery.min.js"></script>
<script src="../javascript/custom-script.js"></script>


</body>
</html>