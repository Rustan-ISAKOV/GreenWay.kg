  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <h3>Наши контакты</h3>
          <p><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> Кыргызская Республика г. Бишкек</p>
          <p><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> greenwaykgz@gmail.com</p>
          <p><span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span> 0555 96 23 41</p>
          <p><span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span> 0555 96 23 45</p>
          <p class="icon">
              <a href="#" target="_blank"><img src="<?php echo get_template_directory_uri()?>/img/facebook.png" alt=""></a> 
              <a href="#" target="_blank"><img src="<?php echo get_template_directory_uri()?>/img/instagram.png" alt=""></a> 
              <a href="#" target="_blank"><img src="<?php echo get_template_directory_uri()?>/img/vk1.png" alt=""></a> 
            </p>
        </div>
        <div class="col-md-4">
          <div class="footer-logo"></div>
        </div>
        <div class="col-md-4">
          <?php
        
          $args = array(
            'theme_location' => 'footerMenu',
            'depth'    => 0,
            'container'  => false,
            'walker'   => new BootstrapNavMenuWalker()
          );
          wp_nav_menu($args);
        
          ?>
        </div>
      </div>
    </div>
  </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="<?php echo get_template_directory_uri()?>/js/bootstrap.min.js"></script>
    <script src="<?php echo get_template_directory_uri()?>/js/owl.carousel.min.js" ></script>
    <script src="<?php echo get_template_directory_uri()?>/js/common.js"></script>
	<?php wp_footer();?>
  </body>
</html>		