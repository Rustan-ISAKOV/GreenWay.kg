<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<div class="wrap">
    <div class="free_version_banner">
        <img class="manual_icon"
             src="<?php echo GALLERY_VIDEO_IMAGES_URL ?><?php echo DIRECTORY_SEPARATOR ?>admin_images<?php echo DIRECTORY_SEPARATOR ?>free-banner<?php echo DIRECTORY_SEPARATOR ?>plugin_logo.png"
             alt="user manual"/>
        <p class="usermanual_text"><?php _e('Wordpress Video Gallery', 'gallery-video'); ?></p>
        <a class="get_full_version" href="https://huge-it.com/wordpress-photo-gallery/" target="_blank">
            <?php _e('GO PRO', 'gallery-video'); ?>
        </a>
        <p class="close_banner">Close for now</p>
        <img class="closer_icon_only" alt="Close Icon"
             src="<?php echo GALLERY_VIDEO_IMAGES_URL ?><?php echo DIRECTORY_SEPARATOR ?>admin_images<?php echo DIRECTORY_SEPARATOR ?>free-banner<?php echo DIRECTORY_SEPARATOR ?>close_btn.png"/>
        <a href="http://huge-it.com" target="_blank"><img class="huge_it_logo"
                                                          src="<?php echo GALLERY_VIDEO_IMAGES_URL ?><?php echo DIRECTORY_SEPARATOR ?>admin_images<?php echo DIRECTORY_SEPARATOR ?>free-banner<?php echo DIRECTORY_SEPARATOR ?>huge-it_logo.png"/></a>
        <div class="mobile_icon_show hide">
            <a href="http://huge-it.com" target="_blank"><img class="huge_it_logo_mobile"
                                                              src="<?php echo GALLERY_VIDEO_IMAGES_URL ?><?php echo DIRECTORY_SEPARATOR ?>admin_images<?php echo DIRECTORY_SEPARATOR ?>free-banner<?php echo DIRECTORY_SEPARATOR ?>logo_mobile_screen.png"/></a>
        </div>
        <div style="clear: both;"></div>
        <div class="hg_social_link_buttons">
            <a target="_blank" class="hugeiticons-facebook" href="https://www.facebook.com/hugeit/"> </a>
            <a target="_blank" class="hugeiticons-twitter" href="https://twitter.com/HugeITcom"> </a>
            <a target="_blank" class="hugeiticons-google-plus-square" href="https://plus.google.com/111845940220835549549"> </a>
            <a target="_blank" class="hugeiticons-youtube-square" href="https://www.youtube.com/watch?v=Re16ci9iGVU"> </a>
        </div>
        <div class="hg_view_plugins_block">
            <ul class="inline_menu">
                <li>
                    <a target="_blank" href="https://huge-it.com/wordpress-video-gallery-demo-1-content-popup/">
                        <?php _e('Demo', 'gallery-video'); ?>
                    </a>
                </li>
                <li>
                    <a target="_blank" href="https://wordpress.org/plugins/gallery-video/#reviews">
                        <?php _e('Review', 'gallery-video'); ?>
                    </a>
                </li>
                <li class="help_element">

                    <?php _e('Help', 'gallery-video'); ?>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a target="_blank" href="https://huge-it.com/contact-us/">
                                <?php _e('Contact Us', 'gallery-video'); ?>
                            </a>
                        </li>
                        <li>
                            <a target="_blank" href="https://huge-it.com/wordpress-video-gallery-user-manual/">
                                <?php _e('User Manual', 'gallery-video'); ?>
                            </a>
                        </li>
                        <li>
                            <a target="_blank" href="https://huge-it.com/wordpress-video-gallery-faq/">
                                <?php _e('FAQ', 'gallery-video'); ?>
                            </a>
                        </li>
                        <li>
                            <a target="_blank" href="https://wordpress.org/support/plugin/gallery-video">
                                <?php _e('Forum', 'gallery-video'); ?>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="toggle_element">
                    <a href="#">
                        <img class="toggle_icon"
                             src="<?php echo GALLERY_VIDEO_IMAGES_URL ?><?php echo DIRECTORY_SEPARATOR ?>admin_images<?php echo DIRECTORY_SEPARATOR ?>free-banner<?php echo DIRECTORY_SEPARATOR ?>toggle_icon.png"/>
                    </a>
                </li>
            </ul>
            <div class="description_text">
                <p><?php _e('Click GO PRO to activate all additional customization options.', 'gallery-video'); ?></p>
            </div>
        </div>
        <div style="clear: both;"></div>
    </div>
</div>