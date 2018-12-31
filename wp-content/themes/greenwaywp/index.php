    <?php 
      get_header('main');
    /*Template Name: Страница*/
    ?>  

  <section id="main_slider" class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="owl-banner owl-carousel owl-theme">
          <div> <img src="<?php echo get_template_directory_uri()?>/img/banner1.jpg" alt=""> </div>
          <div> <img src="<?php echo get_template_directory_uri()?>/img/banner2.jpg" alt=""> </div>
        </div>      
      </div>
    </div>  
  </section>

  <section>
    <div class="container">
      <h2 class="page-title green">Рекомендуем</h2>
      <div class="owl-recomed owl-carousel owl-theme">
      <?php
      $args = array(
        'category_name' => 'recomed'
      );

      $query = new WP_Query( $args );
      $i = 0;
      // Цикл
      if ( $query->have_posts() ):
        while ( $query->have_posts() ) {
          $query->the_post();        ?>
        <div>
          <div class="catalog-item" style="padding-left: 10px; padding-right: 10px;">
            <div class="catalog-item-wrap">
              <a href="<?php the_permalink();?>" class="catalog-item-img"><img class="img-responsive" src="<?php echo get_the_post_thumbnail_url();?>" alt="<?php the_title();?>"></a>
              <div class="catalog-body">
                <div class="catalog-code">Артикул: <?php echo get_post_meta($post->ID, 'art', true) ?></div>
                <a class="catalog-title" href="<?php the_permalink();?>"><?php the_title();?></a>
              </div>
            </div>
          </div>
        </div>
    <?php            
      } else :
        echo "<p>Рекомендаций нет</p>";
      
      /* Возвращаем оригинальные данные поста. Сбрасываем $post. */
      wp_reset_postdata();
      endif;?>

      </div>
    </div>
  </section>

  <section>
    <div class="container">
      <h2 class="title-prod">Наша продукция</h2>
      <div class="row">
        <div class="col-md-4 product-item">
          <a href="/category/catalog/aquamagic/">
            <img class="brand-logo" src="<?php echo get_template_directory_uri()?>/img/br_aqua-magic.png" alt="">
            <div class="product-title">Новая технология чистоты <br>без химии</div>
            <div class="product-info"><p>Cерия высокотехнологичных салфеток из расщепленного микроволокна для ухода за телом и всех видов уборки</p>
            </div>
            <img class="product-img" src="<?php echo get_template_directory_uri()?>/img/pr_aqua-magic.jpg" alt="">
          </a>
        </div>
        <div class="col-md-4 product-item">
          <a href="/category/catalog/aquamatic/">
            <img class="brand-logo" src="<?php echo get_template_directory_uri()?>/img/matic.png" alt="">
            <div class="product-title">Инновационные системы <br>для уборки</div>
            <div class="product-info"><p>Cерия высокотехнологичных салфеток из расщепленного микроволокна для ухода за телом и всех видов уборки</p>
            </div>
            <img class="product-img" src="<?php echo get_template_directory_uri()?>/img/matic.jpg" alt="">
          </a>
        </div>
        <div class="col-md-4 product-item">
          <a href="/category/catalog/sharmeessential/">
            <img class="brand-logo" src="<?php echo get_template_directory_uri()?>/img/sharme.png" alt="">
            <div class="product-title">Натуральные аромамасла <br>для широкого применения</div>
            <div class="product-info"><p>Живительная сила растений в каждой капле, дарящая человеку здоровье, красоту и душевный комфорт</p></div>
            <img class="product-img" src="<?php echo get_template_directory_uri()?>/img/sharme.jpg" alt="">
          </a>
        </div>
        <div class="col-md-4 product-item">
          <a href="/category/catalog/sharme/">
            <img class="brand-logo" src="<?php echo get_template_directory_uri()?>/img/sharme-ph.png" alt="">
            <div class="product-title">Линия сухой косметики <br>и питательных кремов</div>
            <div class="product-info"><p>Натуральный фитоминеральный комплекс для ухода за кожей и волосами дарит бережный уход и неувядающую молодость</p></div>
            <img class="product-img" src="<?php echo get_template_directory_uri()?>/img/sharme-ph.jpg" alt="">
          </a>
        </div>
        <div class="col-md-4 product-item">
          <a href="/category/catalog/teavitall/">
            <img class="brand-logo" src="<?php echo get_template_directory_uri()?>/img/tea-vitall.png" alt="">
            <div class="product-title">Изысканная коллекция <br>чайных напитков</div>
            <div class="product-info"><p>Уникальные сорта душистого чая созданы по авторским рецептам, чтобы с каждым глотком очаровывать нежным букетом натуральных трав и ягод</p></div>
            <img class="product-img" src="<?php echo get_template_directory_uri()?>/img/tea-vitall.jpg" alt="">
          </a>
        </div>
        <div class="col-md-4 product-item">
          <a href="/category/catalog/avital/">
            <img class="brand-logo" src="<?php echo get_template_directory_uri()?>/img/avitall.png" alt="">
            <div class="product-title">Коктейли для коррекции <br>привычек питания</div>
            <div class="product-info"><p>Низкокалорийные коктейли с уникальным растением Худия Гордони регулируют аппетит, обеспечивают всем необходимым и радуют разнообразием вкусов</p></div>
            <img class="product-img" src="<?php echo get_template_directory_uri()?>/img/avitall.jpg" alt="">
          </a>
        </div>
        <div class="col-md-4 product-item">
          <a href="/category/catalog/baofiber/">
            <img class="brand-logo" src="<?php echo get_template_directory_uri()?>/img/baofiber.png" alt="">
            <div class="product-title">Растворимые напитки <br>для красоты и здоровья</div>
            <div class="product-info"><p>Активно снижают уровень плохого холестерина и нормализующие процессы очищения всего организма за счет свойств входящего в состав баобаба</p></div>
            <img class="product-img" src="<?php echo get_template_directory_uri()?>/img/baofiber.jpg" alt="">
          </a>
        </div>
        <div class="col-md-4 product-item">
          <a href="/category/catalog/ecopam/">
            <img class="brand-logo" src="<?php echo get_template_directory_uri()?>/img/ecopam.png" alt="">
            <div class="product-title">Активный источник <br>жизненной энергии</div>
            <div class="product-info"><p>Биологически активные добавки с колострумом эффективно укрепляют организм, осуществляя перезапуск всех его основных систем</p></div>
            <img class="product-img" src="<?php echo get_template_directory_uri()?>/img/ecopam.jpg" alt="">
          </a>
        </div>
        <div class="col-md-4 product-item">
          <a href="/category/catalog/healthberry/">
            <img class="brand-logo" src="<?php echo get_template_directory_uri()?>/img/healthberry.png" alt="">
            <div class="product-title">Палитра растворимых <br>ягодных напитков</div>
            <div class="product-info"><p>Серия ягодных напитков направленного действия с комплексом Тримарин. Шесть ярких вкусов для удовольствия, сбалансированный состав для бодрости и оптимизма</p></div>
            <img class="product-img" src="<?php echo get_template_directory_uri()?>/img/healthberry.jpg" alt="">
          </a>
        </div>
        <div class="col-md-4 product-item">
          <a href="/category/catalog/igen/">
            <img class="brand-logo" src="<?php echo get_template_directory_uri()?>/img/igen.png" alt="">
            <div class="product-title">Генетические тесты для <br>домашнего ипользования</div>
            <div class="product-info"><p>Подробный отчет расскажет всё о ваших особенностях: от обмена веществ и пищеварения до предрасположенности к сердечно-сосудистым и другим заболеваниям</p></div>
            <img class="product-img" src="<?php echo get_template_directory_uri()?>/img/igen.jpg" alt="">
          </a>
        </div>
      </div>
    </div>
  </section>

    <?php 
      get_footer();
    ?>