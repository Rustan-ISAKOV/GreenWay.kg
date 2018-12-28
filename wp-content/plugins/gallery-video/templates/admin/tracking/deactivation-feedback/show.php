<?php
/**
 * @var $slug string The plugin slug
 */
?>
<div id="<?php echo $slug ?>-deactivation-feedback" class="video-gallery-modal">
    <div class="video-gallery-modal-content">
        <div class="video-gallery-modal-content-header">
            <div class="video-gallery-modal-header-icon">
                <img src="<?php echo GALLERY_VIDEO_IMAGES_URL.'/admin/tracking/plugin-icon-mini.png'; ?>" alt="<?php echo $slug; ?>" />
            </div>
            <div class="video-gallery-modal-header-info">
                <div class="video-gallery-modal-header-title"><?php _e('We\'re sorry to see you go.','gallery-video'); ?></div>
                <div class="video-gallery-modal-header-subtitle"><?php _e('Before deactivating and deleting Video Gallery plugin, we\'d love to know why you\'re leaving us.','gallery-video'); ?></div>
            </div>
            <div class="video-gallery-modal-close"></div>
        </div>
        <div class="video-gallery-modal-content-body">
            <?php wp_nonce_field('hugeit-gallery-video-deactivation-feedback','gallery-video-deactivation-nonce'); ?>
            <div class="video-gallery-modal-cb">
                <label>
                    <input type="radio" value="useless_and_limited_plugin" name="<?php echo $slug ?>-deactivation-reason" /><span><?php _e('Useless and limited plugin','gallery-video'); ?></span>
                </label>
            </div>
            <div class="video-gallery-modal-cb">
                <label>
                    <input type="radio" value="found_another_plugin" name="<?php echo $slug ?>-deactivation-reason" /><span><?php _e('Found another plugin','gallery-video'); ?></span>
                </label>
            </div>
            <div class="video-gallery-modal-cb">
                <label>
                    <input type="radio" value="activating_pro_version" name="<?php echo $slug ?>-deactivation-reason" /><span><?php _e('Activating Pro version','gallery-video'); ?></span>
                </label>
            </div>
            <div class="video-gallery-modal-cb">
                <label>
                    <input type="radio" value="support_was_bad" name="<?php echo $slug ?>-deactivation-reason" /><span><?php _e('Support was bad','gallery-video'); ?></span>
                </label>
            </div>
            <div class="video-gallery-modal-cb">
                <label>
                    <input type="radio" value="plugin_does_not_meet_your_expectations" name="<?php echo $slug ?>-deactivation-reason" /><span><?php _e('Plugin doesn\'t meet your expectations','gallery-video'); ?></span>
                </label>
            </div>
            <div class="video-gallery-modal-textarea">
                <label for="<?php echo $slug; ?>-deactivation-comment" class="gallery-video-deactivation-feedback-textarea-label"><?php _e('My other reason is','gallery-video'); ?></label>
                <textarea name="<?php echo $slug; ?>-deactivation-comment" id="<?php echo $slug; ?>-deactivation-comment"></textarea>
            </div>
        </div>
        <div class="video-gallery-modal-content-footer">
            <a href="#" class="hugeit-deactivate-plugin"><?php _e('Deactivate','gallery-video') ?></a>
            <a href="#" class="hugeit-cancel-deactivation"><?php _e('Cancel','gallery-video') ?></a>
        </div>
    </div>
</div>