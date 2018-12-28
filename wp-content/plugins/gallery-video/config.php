<?php
/**
 * Plugin configurations
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$GLOBALS['gallery_video_aliases'] = array(
	'Gallery_Video_Install'          => 'includes/class-gallery-video-install',
	'Gallery_Video_Template_Loader'  => 'includes/class-gallery-video-template-loader',
	'Gallery_Video_Ajax'             => 'includes/class-gallery-video-ajax',
	'Gallery_Video_Widgets'          => 'includes/class-gallery-video-widgets',
	'Gallery_Video_Widget'           => 'includes/class-gallery-video-huge-it-gallery-widget',
	'Gallery_Video_Shortcode'        => 'includes/class-gallery-video-shortcode',
	'Gallery_Video_Frontend_Scripts' => 'includes/class-gallery-video-frontend-scripts',
	'Gallery_Video_Admin'            => 'includes/admin/class-gallery-video-admin',
	'Gallery_Video_Admin_Assets'     => 'includes/admin/class-gallery-video-admin-assets',
	'Gallery_Video_General_Options'  => 'includes/admin/class-gallery-video-general-options',
	'Gallery_Video_Galleries'        => 'includes/admin/class-gallery-video-galleries',
	'Gallery_Video_Lightbox_Options' => 'includes/admin/class-gallery-video-lightbox-options',
	'Gallery_Video_Featured_Plugins' => 'includes/admin/class-gallery-video-featured-plugins',
	'Gallery_Video_Licensing'        => 'includes/admin/class-gallery-video-licensing'
);

/**
 * @param $classname
 *
 * @throws Exception
 */
function gallery_video_aliases( $classname ) {
	global $gallery_video_aliases;

	/**
	 * We do not touch classes that are not related to us
	 */
	if ( ! strstr( $classname, 'Gallery_Video_' ) ) {
		return;
	}

	if ( ! key_exists( $classname, $gallery_video_aliases ) ) {
		throw new Exception( 'trying to load "' . $classname . '" class that is not registered in config file.' );
	}

	$path = Gallery_Video()->plugin_path() . '/' . $gallery_video_aliases[ $classname ] . '.php';

	if ( ! file_exists( $path ) ) {

		throw new Exception( 'the given path for class "' . $classname . '" is wrong, trying to load from ' . $path );

	}

	require_once $path;

	if ( ! interface_exists( $classname ) && ! class_exists( $classname ) ) {

		throw new Exception( 'The class "' . $classname . '" is not declared in "' . $path . '" file.' );

	}
}

spl_autoload_register( 'gallery_video_aliases' );