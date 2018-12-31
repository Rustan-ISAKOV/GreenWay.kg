    <?php 
      get_header();
    /*Template Name: Страница*/
    ?>  
    <div class="line">
      <img class="logo" src="<?php echo get_template_directory_uri()?>/img/1.png" alt="">
      <ol class="breadcrumb container">
        <li><a href="<?= get_home_url();?>"><span class="glyphicon glyphicon-home"></span> Главная</a></li>
        <li class="active"><?php the_title();?></li>  
      </ol>
      <div class="icon">
        <a href="#" target="_blank"><img src="<?php echo get_template_directory_uri()?>/img/facebook.png" alt="faceebok-greenway"></a>
        <a href="#" target="_blank"><img src="<?php echo get_template_directory_uri()?>/img/instagram.png" alt="instagram-greenway"></a>
        <a href="#" target="_blank"><img src="<?php echo get_template_directory_uri()?>/img/vk1.png" alt="vk-greenway"></a>
      </div>
    </div>
  </header>
  

  <div class="container content">
    <h1 class="page-title"><?php the_title();?></h1>
      <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
        <?php the_content();?>
      <?php endwhile; ?>
      <?php endif; ?>
  </div>


    <?php 
      get_footer();
    ?>