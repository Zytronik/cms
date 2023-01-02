<!DOCTYPE html>
<?php error_reporting(E_ALL);
ini_set('display_errors', '1'); 
include 'functions.php';
include 'dbConfig.php'; ?>
<html lang="de">
    <head>
    	<?php $pagename = get_pagename(); ?>
		<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<!-- Google Fonts -->
    	<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="<?php echo get_directory_url(); ?>css/style.css">
        <link rel="stylesheet" type="text/css" href="<?php echo get_directory_url(); ?>css/vendor/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo get_directory_url(); ?>css/helper.css">
        <link rel="stylesheet" type="text/css" href="<?php echo get_directory_url(); ?>css/responsive.css">
        <link rel="stylesheet" type="text/css" href="<?php echo get_directory_url(); ?>css/vendor/slick.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo get_directory_url(); ?>css/vendor/slick-theme.min.css"/>

        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_directory_url(); ?>img/fav/apple-touch-icon-180x180.png">
        <!-- Für Browser -->
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo get_directory_url(); ?>img/fav/favicon-32x32.ico">
        <link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_directory_url(); ?>img/fav/favicon-96x96.png">
        <!-- Für Windows Metro -->
        <meta name="msapplication-square310x310logo" content="<?php echo get_directory_url(); ?>img/fav/mstile-310x310.png">
        <meta name="msapplication-TileColor" content="#292929">
		
		<script src="<?php echo get_directory_url(); ?>js/vendor/jquery.min.js"></script>
        <script defer src="<?php echo get_directory_url(); ?>js/vendor/bootstrap.min.js"></script>
		<script defer src="<?php echo get_directory_url(); ?>js/vendor/masonry.pkgd.min.js"></script> 
        <script defer src="<?php echo get_directory_url(); ?>js/custom.js"></script>
        <script defer src="<?php echo get_directory_url(); ?>js/vendor/slick.min.js"></script>
        <script defer src="<?php echo get_directory_url(); ?>js/jquery.easing.min.js"></script>
        <?php $page_title = "SELECT title FROM page WHERE name='".$pagename."'";
        $page_title = $conn->query($page_title);
        if ($page_title->num_rows === 1) {
        	$p_title = $page_title->fetch_assoc()["title"]; ?>
        	<title><?php 
        	echo get_field("Seitentitel");
        	if($p_title != "Home"){
        		echo " | ".$p_title; 
        	}
        ?></title>
        <?php } ?>
    </head>
    <body class="<?php $name =  str_replace('/index', '', get_pagename()); 
    	$isHome = false;
		if($name === "index"){
			echo "home";
			$isHome = true;
		}else{
			echo $name;
		} ?>">
    	<div id="top"></div>
    	<?php //get_pagename(); ?>
		<?php /*if(admin()){
			echo "<a href='./admin'>Admin</a>";
		}*/ ?>
		<header class="noselect">
			<div class="container-large">
				<div class="row">
					<div class="col-10 col-sm-8 col-md-4 col-xl-4 title-wrapper">
						<a class="top-scroll" href="<?php echo get_directory_url(); ?>#top">
							<img src="<?php echo get_directory_url(); ?>img/logo.png" class="logo">
						</a>
					</div>
					<div class="col-2 col-sm-4 col-md-8 col-xl-8 menu-wrapper">
						<?php $menu_header = getHeaderMenu(getPageId(get_pagename()));
						if(!empty($menu_header)){ ?>
							<nav>
								<ul>
									<?php foreach ($menu_header as $key => $h_menupoint) { ?>
										<li <?php if($h_menupoint['icon'] == "separator"){echo 'class="separator">/</li>';}else{?>>
											<a class="page-scroll" href="<?php
												if($isHome){
													echo $h_menupoint['url'];
												}else{
													echo get_directory_url().$h_menupoint['url'];
												} 
											?>"><?php echo $h_menupoint['name'];?></a>
										</li><?php } ?>
									<?php } ?>
								</ul>
							</nav>
						<?php } ?>
					</div>
					<div id="nbw" class="hamburger hamburger--collapse menu-open-button">
						<div id="navbtn"></div>
					</div>
				</div>
			</div>
		</header>