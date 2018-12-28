<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class Gallery_Video_Featured_Plugins{
	/**
	 * Prints Featured Plugins page 
	 */
	public function show_page( ){
		include( GALLERY_VIDEO_TEMPLATES_PATH.DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'gallery-video-admin-featured-plugins.php' );
	}
}