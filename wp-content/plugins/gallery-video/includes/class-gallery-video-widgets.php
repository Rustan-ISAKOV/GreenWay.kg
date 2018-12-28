<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Class Gallery_Video_Widgets
 */
class Gallery_Video_Widgets{

	/**
	 * Register Huge-IT  Gallery Video Widget
	 */
	public static function init(){
		register_widget( 'Gallery_Video_Widget' );
	}
}
