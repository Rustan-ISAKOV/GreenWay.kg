<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Gallery_Video_General_Options {
	/**
	 * Loads General options page
	 */
	public function load_page() {
		if ( isset( $_GET['page'] ) && $_GET['page'] == 'Options_video_gallery_styles' ) {
            $this->show_page();
		}
	}

	/**
	 * Shows General options page
	 */
	public function show_page() {
		require( GALLERY_VIDEO_TEMPLATES_PATH . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'gallery-video-admin-general-options-html.php' );
	}

}