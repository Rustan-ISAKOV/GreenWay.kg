<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div id="huge_it_gallery_video_add_videos" style="display: none;">
    <div id="huge_it_gallery_video_add_videos">
        <div id="huge_it_gallery_video_add_videos_wrap" data-add-video-nonce="" data-videgallery-id="">
            <h2><?php _e('Add Video URL From Youtube or Vimeo', 'gallery-video');?></h2>
            <div class="control-panel">
                <form method="post" action="" >
                    <input type="text" id="huge_it_add_video_input" name="huge_it_add_video_input" />
                    <button class='save-slider-options button-primary huge-it-insert-video-button' id='huge-it-insert-video-button'> <?php _e('Insert Video', 'gallery-video');?></button>
                    <div id="add-video-popup-options">
                        <div>
                            <div>
                                <label for="show_title"><?php _e('Title', 'gallery-video');?>:</label>
                                <div>
                                    <input name="show_title" value="" type="text" />
                                </div>
                            </div>
                            <div>
                                <label for="show_description"><?php _e('Description', 'gallery-video');?>:</label>
                                <textarea id="show_description" name="show_description"></textarea>
                            </div>
                            <div>
                                <label for="show_url"> <?php _e('Url', 'gallery-video');?> :</label>
                                <input type="text" name="show_url" value="" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
