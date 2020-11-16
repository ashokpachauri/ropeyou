<div id="header" class="shadow">
    <!--<nav>
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
				<?php } ?>
            </div>
        </div>
    </nav>-->
    <div id="intro" class="container">
        <h1 class="text-center text-capitalize"><?php echo "{$_WEB_AUTHOR}"; ?></h1>
        <h4 class="text-center text-capitalize"><?php echo "{$_WEB_DESIGNATION}"; ?></h4>
    </div>
</div>