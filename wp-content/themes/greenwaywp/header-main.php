<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php wp_title();?></title>
    <?php wp_head();?>

    <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri()?>/favicon-32x32.png" sizes="32x32">

    <link rel="stylesheet" href="<?php echo get_template_directory_uri()?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri()?>/js/owl.theme.green.css" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri()?>/js/owl.carousel.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,600i,700" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri()?>/style.css">
  
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

  <header>
    <nav id="header" class="main navbar navbar-default">
      <div id="header-container" class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a id="brand" class="navbar-brand" href="<?= get_home_url(); ?>"><img src="<?php echo get_template_directory_uri()?>/img/logo-b.png" alt="greenway_bishkek"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-collapse">
          <?php
        
          $args = array(
            'theme_location' => 'top-bar',
            'depth'    => 0,
            'container'  => false,
            'menu_class'   => 'nav navbar-nav',
            'walker'   => new BootstrapNavMenuWalker()
          );
          wp_nav_menu($args);
        
          ?>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container -->
    </nav>  
    <div class="line">
      <img class="logo" src="<?php echo get_template_directory_uri()?>/img/1.png" alt="">
      <div class="icon">
        <a href="#" target="_blank"><img src="<?php echo get_template_directory_uri()?>/img/facebook.png" alt="faceebok-greenway"></a>
        <a href="#" target="_blank"><img src="<?php echo get_template_directory_uri()?>/img/instagram.png" alt="faceebok-greenway"></a>
        <a href="#" target="_blank"><img src="<?php echo get_template_directory_uri()?>/img/vk1.png" alt="faceebok-greenway"></a>
      </div>
    </div>
  </header>