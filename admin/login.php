<?php session_start();

if (isset($_POST['username']) && isset($_POST['password']) && $_POST['username'] == 'admin' && $_POST['password'] == 'test123') {
    $_SESSION['login'] = date("H:i:s");
}
include '../functions.php';
include '../dbConfig.php'; ?>
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
        <link rel="stylesheet" type="text/css" href="css/admin.css">
        <link rel="stylesheet" type="text/css" href="../css/vendor/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/helper.css">
        <link rel="stylesheet" type="text/css" href="../css/responsive.css">
        <link rel="stylesheet" type="text/css" href="css/admin_responsive.css">
        <link rel="stylesheet" type="text/css" href="../css/vendor/all.min.css">
        <script defer src="../js/vendor/jquery.min.js"></script>
        <script defer src="../js/vendor/bootstrap.min.js"></script>
        <script defer src="js/admin.js"></script>
        <?php error_reporting(E_ALL);
        ini_set('display_errors', '1'); ?>
    </head>
    <body>
        <main class="content-wrapper">
            <article class="login-page">
                <section>
                    <div class="login-wrapper">
                        <div class="login-form">
                            <h2>Login</h2>
                            <?php if ( isset($_SESSION['login']) ) {
                                header('Location: index.php');
                                exit;
                            } else { ?>
                                <form data-ajax="false" id="login-form" action="#" method="POST">
                                    <div class="input-wrapper">
                                        <label for="username">Benutzername:</label>
                                        <input required type="text" id="username" name="username">
                                    </div>
                                    <div class="input-wrapper">
                                        <label for="password">Kennwort:</label>
                                        <input required type="password" id="password" name="password">
                                    </div>
                                    <button type="submit">Anmelden</button>
                                </form>
                            <?php } ?>
                            <a href="<?php echo get_directory_url(); ?>"><i class="fas fa-long-arrow-alt-left"></i> Zurück zu <?php echo get_field("Seitentitel"); ?></a> 
                        </div>
                        <div class="login-background">
                            <style>
                                .login-page .login-background {
                                    height: 100%;
                                    background-position: center;
                                    background-size: cover;
                                    background-image: url(<?php echo get_directory_url()."img/login.png"; ?>)
                                }
                            </style>
                        </div>
                    </div>  
                </section>
            </article>
        </main>
    </body>
</html>