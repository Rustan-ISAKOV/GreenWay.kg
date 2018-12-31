    <?php 
      get_header();
    /*Template Name: Страница*/
    ?>  
    <div class="line">
      <img class="logo" src="<?php echo get_template_directory_uri()?>/img/1.png" alt="">
      <ol class="breadcrumb container">
        <li><a href="<?= get_home_url();?>"><span class="glyphicon glyphicon-home"></span> Главная </a></li>
        <li><?php $cat_id = $GLOBALS['cat']; echo get_category_parents( $cat_id, true, ' / '); ?></li>
      </ol>
      <div class="icon">
        <a href="#" target="_blank"><img src="<?php echo get_template_directory_uri()?>/img/facebook.png" alt="faceebok-greenway"></a>
        <a href="#" target="_blank"><img src="<?php echo get_template_directory_uri()?>/img/instagram.png" alt="instagram-greenway"></a>
        <a href="#" target="_blank"><img src="<?php echo get_template_directory_uri()?>/img/vk1.png" alt="vk-greenway"></a>
      </div>
    </div>
  </header>
   

  <div class="container content-catalog">
    <div class="row">
      <div class="col-md-3">
        <div class="categ" style="display: block;">
        <h2>Категории</h2>
          <ul id="nav-one" class="dropmenu">
            <?php wp_list_categories('child_of=4&show_count=0& hide_empty=0& title_li='); ?>
          </ul>
        </div>
        <?php get_sidebar('left'); ?>
      </div>
      <div class="col-md-9 catalog">
        <h1 class="page-title"><?php the_archive_title();?></h1>
        <div class="description"><?php echo category_description( $category_id ); ?></div>
        <div class="row">
            <?php
          if ( have_posts() ) : ?>
            <?php
            /* Start the Loop */
            while ( have_posts() ) : the_post();?>

          <div class="catalog-item col-md-4">
            <div class="catalog-item-wrap">
              <a href="<?php the_permalink();?>" class="catalog-item-img"><img class="img-responsive" src="<?= get_the_post_thumbnail_url();?>" alt="<?php the_title();?>"></a>
              <div class="catalog-body">
                <div class="catalog-code">Артикул: <?php echo get_post_meta($post->ID, 'art', true) ?></div>
                <a class="catalog-title" href="<?php the_permalink();?>"><?php the_title();?></a>
                <div class="catalog-info">
                  <p class="clearfix">
                    <span>Цена</span>
                    <span class="cost"><?php echo get_post_meta($post->ID, 'cost', true) ?> сом</span>
                  </p>                                
                </div>
              </div>
            </div>
          </div>
            <?php
      endwhile;

            ?>
            <div class="clear"></div>

             <?php 
    $args = array(
      'show_all'     => false, // показаны все страницы участвующие в пагинации
      'end_size'     => 1,     // количество страниц на концах
      'mid_size'     => 1,     // количество страниц вокруг текущей
      'prev_next'    => false,  // выводить ли боковые ссылки "предыдущая/следующая страница".
      'prev_text'    => __('« Previous'),
      'next_text'    => __('Next »'),
      'add_args'     => false, // Массив аргументов (переменных запроса), которые нужно добавить к ссылкам.
      'add_fragment' => '',     // Текст который добавиться ко всем ссылкам.
      'screen_reader_text' => __( ' ' ),
    );
      the_posts_pagination($args);

    else :

      echo "<div class='alert alert-danger' role='alert'>К сожалению товаров нет</div>";

    endif; ?>

        </div>
      </div>
    </div>
    
  </div>



    <?php 
      get_footer();
    ?>