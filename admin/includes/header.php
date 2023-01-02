<?php 
include("../functions.php");
session_start();

if(admin()) {
	$_SESSION['login'] = date("H:i:s");
}

if ( !isset($_SESSION['login']) ) { 
    header('Location: login.php');
}

if ( isset($_GET['action']) and $_GET['action'] == "logout") {
    unset($_SESSION['login']);
    header('Location: ../');
} ?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin | <?php echo get_field("Seitentitel"); ?></title>
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php get_directory_url(); ?>/img/fav/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php get_directory_url(); ?>/img/fav/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php get_directory_url(); ?>/img/fav/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php get_directory_url(); ?>/img/fav/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="<?php get_directory_url(); ?>/img/fav/apple-touch-icon-60x60.png" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php get_directory_url(); ?>/img/fav/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?php get_directory_url(); ?>/img/fav/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php get_directory_url(); ?>/img/fav/apple-touch-icon-152x152.png" />
    <link rel="icon" type="image/png" href="<?php get_directory_url(); ?>/img/fav/favicon-196x196.png" sizes="196x196" />
    <link rel="icon" type="image/png" href="<?php get_directory_url(); ?>/img/fav/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/png" href="<?php get_directory_url(); ?>/img/fav/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="<?php get_directory_url(); ?>/img/fav/favicon-16x16.png" sizes="16x16" />
    <link rel="icon" type="image/png" href="<?php get_directory_url(); ?>/img/fav/favicon-128.png" sizes="128x128" />
    <meta name="application-name" content="&nbsp;"/>
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="<?php get_directory_url(); ?>/img/fav/mstile-144x144.png" />
    <meta name="msapplication-square70x70logo" content="<?php get_directory_url(); ?>/img/fav/mstile-70x70.png" />
    <meta name="msapplication-square150x150logo" content="<?php get_directory_url(); ?>/img/fav/mstile-150x150.png" />
    <meta name="msapplication-wide310x150logo" content="<?php get_directory_url(); ?>/img/fav/mstile-310x150.png" />
    <meta name="msapplication-square310x310logo" content="<?php get_directory_url(); ?>/img/fav/mstile-310x310.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/admin.css">
    <link rel="stylesheet" type="text/css" href="../css/vendor/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/helper.css">
    <link rel="stylesheet" type="text/css" href="css/admin_responsive.css">
    <link rel="stylesheet" type="text/css" href="../css/vendor/all.min.css">
    <script defer src="../js/vendor/jquery.min.js"></script>
    <script defer src="../js/vendor/bootstrap.min.js"></script> 
    <script defer src="../js/custom.js"></script>
    <script defer src="js/admin.js"></script>
    <?php error_reporting(E_ALL);
    ini_set('display_errors', '1'); ?>
    <?php $actual_link = "$_SERVER[REQUEST_URI]"; //disable create site option -> redirect to site with id 1
    if($actual_link === "/bylizhartmann/admin/" || $actual_link === "/bylizhartmann/admin/index.php" ){
        header( 'Location: '.$_SERVER['REQUEST_URI'].'?page=index&id=1');
    } ?>
</head>
<body class="page">
    <header>
        <div class="container-large">
            <div class="row">
                <div class="col-12">
                    <nav>
                        <ul>
                            <li><a class="headerlink" href="<?php echo get_directory_url(); ?>admin/"><i class="fas fa-file-alt"></i><span>Seiten</span></a></li>
                            <li><a class="headerlink" href="<?php echo get_directory_url(); ?>admin/blocks.php"><i class="fas fa-th-large"></i><span>Blöcke</span></a></li>
                            <li><a class="headerlink" href="<?php echo get_directory_url(); ?>admin/menus.php"><i class="fas fa-compass"></i><span>Menüs</span></a></li>
                            <li><a class="headerlink" href="<?php echo get_directory_url(); ?>admin/settings.php"><i class="fas fa-cogs"></i><span>Einstellungen</span></a></li>
                            <?php if ( isset($_SESSION['login']) ) {
                                echo '<li><a class="headerlink" data-ajax="false" href="?action=logout"><i class="fas fa-sign-out-alt"></i><span>ausloggen</span></a></li>';
                            } ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>