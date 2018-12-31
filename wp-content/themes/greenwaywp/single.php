    <?php 
      get_header();
    /*Template Name: отдельная запись*/
    ?>  
  <script type="text/javascript">
  function setBigImage(foto) {
  $("#adpdp14").attr('href', $(foto).parent('.it').children('a').attr('href'));
    document.getElementById("dp14").src = foto.src;
  }
</script>
    <div class="line">
      <img class="logo" src="<?php echo get_template_directory_uri()?>/img/1.png" alt="">
      <ol class="breadcrumb container">
        <li><a href="<?= get_home_url();?>"><span class="glyphicon glyphicon-home"></span> Главная /</a></li>
        <?php
          $categories = get_the_category($post_id);
          if($categories){
            foreach($categories as $category) {
              $idcat = $category->cat_ID;
            }
          }
          echo get_category_parents( $idcat, true, ' / ');
        ?>
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
          <?php get_sidebar('zayav'); ?>
        <div class="categ" style="display: block;">
        <h2>Категории</h2>      
          <ul id="nav-one" class="dropmenu">
            <?php wp_list_categories('child_of=4&show_count=0& hide_empty=0& title_li='); ?>
          </ul>
        </div>      
        <?php get_sidebar('left'); ?>
      </div>
      <div class="col-md-9 catalog more">
        <h1 class="page-title"><?php the_title();?></h1>
          <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
          <div class="row">


            <div class="col-md-6 img">
              <a href="<?= get_the_post_thumbnail_url();?>" class="fancybox image" rel="gallery-0" id="adpdp14">
              <img src="<?= get_the_post_thumbnail_url();?>"  id="dp14" alt="<?php the_title();?>">
              </a>

                <div class="thumbs">
                <div class="it"><a style="display:none;" href="<?= get_the_post_thumbnail_url();?>"></a><img src="<?= get_the_post_thumbnail_url();?>" onclick='setBigImage(this);' alt="<?php the_title();?>"></div>
              <?php    

                  if (class_exists('MultiPostThumbnails')) {                              
                  // Loops through each feature image and grabs thumbnail URL
                  $i=1;
                      while ($i<=5) {
                          $image_name = 'feature-image-'.$i;  // sets image name as feature-image-1, feature-image-2 etc.
                          if (MultiPostThumbnails::has_post_thumbnail('post', $image_name)) { 
                              $image_id = MultiPostThumbnails::get_post_thumbnail_id( 'post', $image_name, $post->ID );  // use the MultiPostThumbnails to get the image ID
                              $image_thumb_url = wp_get_attachment_image_src( $image_id,'small-thumb');  // define thumb src based on image ID
                              $image_feature_url = wp_get_attachment_image_src( $image_id,'feature-image' ); // define full size src based on image ID
                              $attr = array(
                                  'class' => "folio-sample",      // set custom class
                                  'rel' => $image_thumb_url[0],   // sets the url for the image thumbnails size
                                  'src' => $image_feature_url[0], // sets the url for the full image size 
                                  'onclick' => "setBigImage(this);",
                                 
                              );                                                                                      
                              // Use wp_get_attachment_image instead of standard MultiPostThumbnails to be able to tweak attributes
                              $image = wp_get_attachment_image( $image_id, 'feature-image', false, $attr );                     
                              echo " <div class='it'><a style='display:none;' href='".$image_feature_url[0]."'></a>".$image."</div>";
                          }                           
                          $i++;
                      }                            
                   
                  }; // end if MultiPostThumbnails 
               ?>
                </div>
            </div>

            <div class="col-md-6 main-info">
              <h2><?php the_title();?></h2>
              <ul class="atrib">
                <li><span>Линия продуктов:</span> <a href=" <?= get_category_link($category->cat_ID)?> "><?php
$category = get_the_category(); 
echo $category[0]->cat_name;
?></a></li>
                <li><span>Артикул:</span> <?php echo get_post_meta($post->ID, 'art', true) ?></li>
                <li><span>Наличие:</span> Есть в наличии.</li>
                <li><span>Баллы:</span> <?php echo get_post_meta($post->ID, 'ball', true) ?></li>
              </ul>
              <h3 class="costing"><span>Цена</span><span class="cost"><?php echo get_post_meta($post->ID, 'cost', true) ?> сом</span></h3>
            </div>
          </div>
          <div class="descrip">
            <?php the_content();?>
          </div>
          <?php endwhile; ?>
          <?php endif; ?>
      </div>
    </div>
    
  </div>



    <?php 
      get_footer();
    ?>