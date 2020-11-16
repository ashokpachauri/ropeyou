<div id="header" class="shadow">
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
                </ul>
				<a href="#0" data-activates="nav-mobile" id="nav-btn" class="button-collapse nav-icon">
                    <i class="ion-navicon"></i>
				</a>
				<div id="side-nav">
                    <div id="nav-header">
                        <div id="nav-profile" class="center-block">
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