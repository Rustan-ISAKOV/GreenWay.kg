<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Class Gallery_Video_Frontend_Scripts
 */
class Gallery_Video_Frontend_Scripts {

	/**
	 * Gallery_Video_Frontend_Scripts constructor.
	 */
	public function __construct() {
		add_action( 'gallery_video_shortcode_scripts', array( $this, 'frontend_scripts' ), 10, 4 );
		add_action( 'gallery_video_shortcode_scripts', array( $this, 'frontend_styles' ), 10, 2 );
		add_action( 'gallery_video_localize_scripts', array( $this, 'localize_scripts' ), 10, 1 );
	}

	/**
	 * Enqueue styles
	 */
	public function frontend_styles( $id, $gallery_video_view ) {
		$gallery_video_get_option = gallery_video_get_default_general_options();
		wp_register_style( 'gallery-video-style2-os-css', plugins_url( '../assets/style/style2-os.css', __FILE__ ) );
		wp_enqueue_style( 'gallery-video-style2-os-css' );

        if ( get_option('gallery_video_lightbox_type') == 'old_type' ) {
            wp_register_style( 'lightbox-css', plugins_url( '../assets/style/lightbox.css', __FILE__ ) );
            wp_enqueue_style( 'lightbox-css' );

            wp_register_style( 'gallery_video_colorbox_css', untrailingslashit( gallery_video()->plugin_url() ) . '/assets/style/colorbox-' . $gallery_video_get_option['gallery_video_light_box_style'] . '.css' );
            wp_enqueue_style( 'gallery_video_colorbox_css' );
        } elseif (  get_option('gallery_video_lightbox_type') == 'new_type' ) {
            wp_register_style( 'gallery_video_resp_lightbox_css', untrailingslashit( gallery_video()->plugin_url() ) . '/assets/style/responsive_lightbox.css' );
            wp_enqueue_style( 'gallery_video_resp_lightbox_css' );

                    }


        wp_register_style( 'fontawesome-css', plugins_url( '../assets/style/css/font-awesome.css', __FILE__ ) );
		wp_enqueue_style( 'fontawesome-css' );

		wp_enqueue_style( 'gallery_video_colorbox_css', untrailingslashit( Gallery_Video()->plugin_url() ) . '/assets/style/colorbox-' . $gallery_video_get_option[ 'gallery_video_light_box_style' ] . '.css' );

		if ( $gallery_video_view == '1' ) {
			wp_register_style( 'animate-css', plugins_url( '../assets/style/animate.min.css', __FILE__ ) );
			wp_enqueue_style( 'animate-css' );
			wp_register_style( 'liquid-slider-css', plugins_url( '../assets/style/liquid-slider.css', __FILE__ ) );
			wp_enqueue_style( 'liquid-slider-css' );
		}
		if ( $gallery_video_view == '4' ) {
			wp_register_style( 'thumb_view-css', plugins_url( '../assets/style/thumb_view.css', __FILE__ ) );
			wp_enqueue_style( 'thumb_view-css' );
		}
		if ( $gallery_video_view == '6' ) {
			wp_register_style( 'thumb_view-css', plugins_url( '../assets/style/justifiedGallery.css', __FILE__ ) );
			wp_enqueue_style( 'thumb_view-css' );
		}
	}

	/**
	 * Enqueue scripts
	 */
	public function frontend_scripts( $id, $gallery_video_view, $has_youtube, $has_vimeo ) {
		$view_slug = gallery_video_get_view_slag_by_id( $id );
        $gallery_video_get_option = gallery_video_get_default_general_options();
		if ( ! wp_script_is( 'jquery' ) ) {
			wp_enqueue_script( 'jquery' );
		}

        if (  get_option('gallery_video_lightbox_type') == 'old_type' ) {
            wp_register_script( 'jquery.vgcolorbox-js', plugins_url( '../assets/js/jquery.colorbox.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
            wp_enqueue_script( 'jquery.vgcolorbox-js' );
        } elseif (  get_option('gallery_video_lightbox_type') == 'new_type' ) {
            wp_register_script( 'gallery-video-resp-lightbox-js', plugins_url( '../assets/js/lightbox.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
            wp_enqueue_script( 'gallery-video-resp-lightbox-js' );

            wp_register_script( 'mousewheel-min-js', plugins_url( '../assets/js/mousewheel.min.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
            wp_enqueue_script( 'mousewheel-min-js' );

            wp_register_script( 'froogaloop2-min-js', plugins_url( '../assets/js/froogaloop2.min.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
            wp_enqueue_script( 'froogaloop2-min-js' );
        }

		wp_register_script( 'gallery-video-hugeitmicro-min-js', plugins_url( '../assets/js/jquery.hugeitmicro.min.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script( 'gallery-video-hugeitmicro-min-js' );

		wp_register_script( 'gallery-video-front-end-js-' . $view_slug, plugins_url( '../assets/js/view-' . $view_slug . '.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script( 'gallery-video-front-end-js-' . $view_slug );

		wp_register_script( 'gallery-video-custom-js', plugins_url( '../assets/js/custom.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script( 'gallery-video-custom-js' );

		if ( $gallery_video_view == '1' ) {
			wp_register_script( 'easing-js', plugins_url( '../assets/js/jquery.easing.min.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
			wp_enqueue_script( 'easing-js' );
			wp_register_script( 'touch_swipe-js', plugins_url( '../assets/js/jquery.touchSwipe.min.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
			wp_enqueue_script( 'touch_swipe-js' );
			wp_register_script( 'liquid-slider-js', plugins_url( '../assets/js/jquery.liquid-slider.min.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
			wp_enqueue_script( 'liquid-slider-js' );
		}
		if ( $gallery_video_view == '4' ) {
			wp_register_script( 'thumb-view-js', plugins_url( '../assets/js/thumb_view.min.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
			wp_enqueue_script( 'thumb-view-js' );
			wp_register_script( 'lazyload-min-js', plugins_url( '../assets/js/jquery.lazyload.min.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
			wp_enqueue_script( 'lazyload--min-js' );
		}
		if ( $gallery_video_view == '6' ) {
			wp_register_script( 'video-jusiifed-js', plugins_url( '../assets/js/justifiedGallery.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
			wp_enqueue_script( 'video-jusiifed-js' );
		}


	}

	public function localize_scripts( $id ) {
		global $wpdb;
        $query=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_videogallery_galleries where id = '%d' order by id ASC",$id);
		$gallery_video        = $wpdb->get_results( $query );
		$admin_url      = admin_url( "admin-ajax.php" );
		$gallery_video_params = gallery_video_get_default_general_options();
        $query=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_videogallery_videos where videogallery_id = '%d' order by ordering ASC",$id);
		$videos         = $wpdb->get_col( $query );
		$has_youtube    = 'false';
		$has_vimeo      = 'false';
		$view_slug      = $view_slug = gallery_video_get_view_slag_by_id( $id );
		foreach ( $videos as $video_row ) {
			if ( strpos( $video_row, 'youtu' ) !== false ) {
				$has_youtube = 'true';
			}
			if ( strpos( $video_row, 'vimeo' ) !== false ) {
				$has_vimeo = 'true';
			}
		}
		$gallery_video_get_option = gallery_video_get_default_general_options();
		$gallery_video_view = $gallery_video[0]->huge_it_sl_effects;
        $lightbox     = array(
            'lightbox_transition'     => $gallery_video_get_option[ 'gallery_video_light_box_transition' ],
            'lightbox_speed'          => $gallery_video_get_option[ 'gallery_video_light_box_speed' ],
            'lightbox_fadeOut'        => $gallery_video_get_option[ 'gallery_video_light_box_fadeout' ],
            'lightbox_title'          => $gallery_video_get_option[ 'gallery_video_light_box_title' ],
            'lightbox_scalePhotos'    => $gallery_video_get_option[ 'gallery_video_light_box_scalephotos' ],
            'lightbox_scrolling'      => $gallery_video_get_option[ 'gallery_video_light_box_scrolling' ],
            'lightbox_opacity'        => ( $gallery_video_get_option[ 'gallery_video_light_box_opacity' ] / 100 ) + 0.001,
            'lightbox_open'           => $gallery_video_get_option[ 'gallery_video_light_box_open' ],
            'lightbox_returnFocus'    => $gallery_video_get_option[ 'gallery_video_light_box_returnfocus' ],
            'lightbox_trapFocus'      => $gallery_video_get_option[ 'gallery_video_light_box_trapfocus' ],
            'lightbox_fastIframe'     => $gallery_video_get_option[ 'gallery_video_light_box_fastiframe' ],
            'lightbox_preloading'     => $gallery_video_get_option[ 'gallery_video_light_box_preloading' ],
            'lightbox_overlayClose'   => $gallery_video_get_option[ 'gallery_video_light_box_overlayclose' ],
            'lightbox_escKey'         => $gallery_video_get_option[ 'gallery_video_light_box_esckey' ],
            'lightbox_arrowKey'       => $gallery_video_get_option[ 'gallery_video_light_box_arrowkey' ],
            'lightbox_loop'           => $gallery_video_get_option[ 'gallery_video_light_box_loop' ],
            'lightbox_closeButton'    => $gallery_video_get_option[ 'gallery_video_light_box_closebutton' ],
            'lightbox_previous'       => $gallery_video_get_option[ 'gallery_video_light_box_previous' ],
            'lightbox_next'           => $gallery_video_get_option[ 'gallery_video_light_box_next' ],
            'lightbox_close'          => $gallery_video_get_option[ 'gallery_video_light_box_close' ],
            'lightbox_html'           => $gallery_video_get_option[ 'gallery_video_light_box_html' ],
            'lightbox_photo'          => $gallery_video_get_option[ 'gallery_video_light_box_photo' ],
            'lightbox_innerWidth'     => $gallery_video_get_option[ 'gallery_video_light_box_innerwidth' ],
            'lightbox_innerHeight'    => $gallery_video_get_option[ 'gallery_video_light_box_innerheight' ],
            'lightbox_initialWidth'   => $gallery_video_get_option[ 'gallery_video_light_box_initialwidth' ],
            'lightbox_initialHeight'  => $gallery_video_get_option[ 'gallery_video_light_box_initialheight' ],
            'lightbox_slideshow'      => $gallery_video_get_option[ 'gallery_video_light_box_slideshow' ],
            'lightbox_slideshowSpeed' => $gallery_video_get_option[ 'gallery_video_light_box_slideshowspeed' ],
            'lightbox_slideshowAuto'  => $gallery_video_get_option[ 'gallery_video_light_box_slideshowauto' ],
            'lightbox_slideshowStart' => $gallery_video_get_option[ 'gallery_video_light_box_slideshowstart' ],
            'lightbox_slideshowStop'  => $gallery_video_get_option[ 'gallery_video_light_box_slideshowstop' ],
            'lightbox_fixed'          => $gallery_video_get_option[ 'gallery_video_light_box_fixed' ],
            'lightbox_reposition'     => $gallery_video_get_option[ 'gallery_video_light_box_reposition' ],
            'lightbox_retinaImage'    => $gallery_video_get_option[ 'gallery_video_light_box_retinaimage' ],
            'lightbox_retinaUrl'      => $gallery_video_get_option[ 'gallery_video_light_box_retinaurl' ],
            'lightbox_retinaSuffix'   => $gallery_video_get_option[ 'gallery_video_light_box_retinasuffix' ],
            'lightbox_maxWidth'       => $gallery_video_get_option[ 'gallery_video_light_box_maxwidth' ],
            'lightbox_maxHeight'      => $gallery_video_get_option[ 'gallery_video_light_box_maxheight' ],
            'lightbox_sizeFix'        => $gallery_video_get_option[ 'gallery_video_light_box_size_fix' ],
            'galleryVideoID'          => $id,
            'liquidSliderInterval'    => $gallery_video[0]->description
        );

        if ( $gallery_video_get_option[ 'gallery_video_light_box_size_fix' ] == 'false' ) {
            $lightbox['lightbox_width'] = '';
        } else {
            $lightbox['lightbox_width'] = $gallery_video_get_option[ 'gallery_video_light_box_width' ];
        }

        if ( $gallery_video_get_option[ 'gallery_video_light_box_size_fix' ] == 'false' ) {
            $lightbox['lightbox_height'] = '';
        } else {
            $lightbox['lightbox_height'] = $gallery_video_get_option[ 'gallery_video_light_box_height' ];
        }

        $pos = $gallery_video_get_option[ 'gallery_video_lightbox_open_position' ];
        switch ( $pos ) {
            case 1:
                $lightbox['lightbox_top']    = '10%';
                $lightbox['lightbox_bottom'] = 'false';
                $lightbox['lightbox_left']   = '10%';
                $lightbox['lightbox_right']  = 'false';
                break;
            case 2:
                $lightbox['lightbox_top']    = '10%';
                $lightbox['lightbox_bottom'] = 'false';
                $lightbox['lightbox_left']   = 'false';
                $lightbox['lightbox_right']  = 'false';
                break;
            case 3:
                $lightbox['lightbox_top']    = '10%';
                $lightbox['lightbox_bottom'] = 'false';
                $lightbox['lightbox_left']   = 'false';
                $lightbox['lightbox_right']  = '10%';
                break;
            case 4:
                $lightbox['lightbox_top']    = 'false';
                $lightbox['lightbox_bottom'] = 'false';
                $lightbox['lightbox_left']   = '10%';
                $lightbox['lightbox_right']  = 'false';
                break;
            case 5:
                $lightbox['lightbox_top']    = 'false';
                $lightbox['lightbox_bottom'] = 'false';
                $lightbox['lightbox_left']   = 'false';
                $lightbox['lightbox_right']  = 'false';
                break;
            case 6:
                $lightbox['lightbox_top']    = 'false';
                $lightbox['lightbox_bottom'] = 'false';
                $lightbox['lightbox_left']   = 'false';
                $lightbox['lightbox_right']  = '10%';
                break;
            case 7:
                $lightbox['lightbox_top']    = 'false';
                $lightbox['lightbox_bottom'] = '10%';
                $lightbox['lightbox_left']   = '10%';
                $lightbox['lightbox_right']  = 'false';
                break;
            case 8:
                $lightbox['lightbox_top']    = 'false';
                $lightbox['lightbox_bottom'] = '10%';
                $lightbox['lightbox_left']   = 'false';
                $lightbox['lightbox_right']  = 'false';
                break;
            case 9:
                $lightbox['lightbox_top']    = 'false';
                $lightbox['lightbox_bottom'] = '10%';
                $lightbox['lightbox_left']   = 'false';
                $lightbox['lightbox_right']  = '10%';
                break;
        }

        $justified        = array(
            'imagemargin'            => $gallery_video_get_option[ 'gallery_video_ht_view8_element_padding' ],
            'imagerandomize'         => $gallery_video_get_option[ 'gallery_video_ht_view8_element_randomize' ],
            'imagecssAnimation'      => $gallery_video_get_option[ 'gallery_video_ht_view8_element_cssAnimation' ],
            'imagecssAnimationSpeed' => $gallery_video_get_option[ 'gallery_video_ht_view8_element_animation_speed' ],
            'imageheight'            => $gallery_video_get_option[ 'gallery_video_ht_view8_element_height' ],
            'imagejustify'           => $gallery_video_get_option[ 'gallery_video_ht_view8_element_justify' ],
            'imageshowcaption'       => $gallery_video_get_option[ 'gallery_video_ht_view8_element_show_caption' ]
        );
		$justified_params = array();
		foreach ( $justified as $name => $value ) {
			$justified_params[ $name ] = $value;
		}


        $lightbox_options = array(
            'gallery_video_lightbox_slideAnimationType'            => $gallery_video_get_option['gallery_video_lightbox_slideAnimationType'],
            'gallery_video_lightbox_lightboxView'                  => get_option('gallery_video_lightbox_lightboxView'),
            'gallery_video_lightbox_speed_new'                     => get_option('gallery_video_lightbox_speed_new'),
            'gallery_video_lightbox_width_new'                     => $gallery_video_get_option['gallery_video_lightbox_width_new'],
            'gallery_video_lightbox_height_new'                    => $gallery_video_get_option['gallery_video_lightbox_height_new'],
            'gallery_video_lightbox_videoMaxWidth'                 => $gallery_video_get_option['gallery_video_lightbox_videoMaxWidth'],
            'gallery_video_lightbox_overlayDuration'               => $gallery_video_get_option['gallery_video_lightbox_overlayDuration'],
            'gallery_video_lightbox_overlayClose_new'              => get_option('gallery_video_lightbox_overlayClose_new'),
            'gallery_video_lightbox_loop_new'                      => get_option('gallery_video_lightbox_loop_new'),
            'gallery_video_lightbox_escKey_new'                    => $gallery_video_get_option['gallery_video_lightbox_escKey_new'],
            'gallery_video_lightbox_keyPress_new'                  => $gallery_video_get_option['gallery_video_lightbox_keyPress_new'],
            'gallery_video_lightbox_arrows'                        => $gallery_video_get_option['gallery_video_lightbox_arrows'],
            'gallery_video_lightbox_mouseWheel'                    => $gallery_video_get_option['gallery_video_lightbox_mouseWheel'],
            'gallery_video_lightbox_showCounter'                   => $gallery_video_get_option['gallery_video_lightbox_showCounter'],
            'gallery_video_lightbox_nextHtml'                      => $gallery_video_get_option['gallery_video_lightbox_nextHtml'],
            'gallery_video_lightbox_prevHtml'                      => $gallery_video_get_option['gallery_video_lightbox_prevHtml'],
            'gallery_video_lightbox_sequence_info'                 => $gallery_video_get_option['gallery_video_lightbox_sequence_info'],
            'gallery_video_lightbox_sequenceInfo'                  => $gallery_video_get_option['gallery_video_lightbox_sequenceInfo'],
            'gallery_video_lightbox_slideshow_new'                 => $gallery_video_get_option['gallery_video_lightbox_slideshow_new'],
            'gallery_video_lightbox_slideshow_auto_new'            => $gallery_video_get_option['gallery_video_lightbox_slideshow_auto_new'],
            'gallery_video_lightbox_slideshow_speed_new'           => $gallery_video_get_option['gallery_video_lightbox_slideshow_speed_new'],
            'gallery_video_lightbox_slideshow_start_new'           => $gallery_video_get_option['gallery_video_lightbox_slideshow_start_new'],
            'gallery_video_lightbox_slideshow_stop_new'            => $gallery_video_get_option['gallery_video_lightbox_slideshow_stop_new'],
            'gallery_video_lightbox_watermark'                     => $gallery_video_get_option['gallery_video_lightbox_watermark'],
            'gallery_video_lightbox_socialSharing'                 => $gallery_video_get_option['gallery_video_lightbox_socialSharing'],
            'gallery_video_lightbox_facebookButton'                => $gallery_video_get_option['gallery_video_lightbox_facebookButton'],
            'gallery_video_lightbox_twitterButton'                 => $gallery_video_get_option['gallery_video_lightbox_twitterButton'],
            'gallery_video_lightbox_googleplusButton'              => $gallery_video_get_option['gallery_video_lightbox_googleplusButton'],
            'gallery_video_lightbox_pinterestButton'               => $gallery_video_get_option['gallery_video_lightbox_pinterestButton'],
            'gallery_video_lightbox_linkedinButton'                => $gallery_video_get_option['gallery_video_lightbox_linkedinButton'],
            'gallery_video_lightbox_tumblrButton'                  => $gallery_video_get_option['gallery_video_lightbox_tumblrButton'],
            'gallery_video_lightbox_redditButton'                  => $gallery_video_get_option['gallery_video_lightbox_redditButton'],
            'gallery_video_lightbox_bufferButton'                  => $gallery_video_get_option['gallery_video_lightbox_bufferButton'],
            'gallery_video_lightbox_diggButton'                    => $gallery_video_get_option['gallery_video_lightbox_diggButton'],
            'gallery_video_lightbox_vkButton'                      => $gallery_video_get_option['gallery_video_lightbox_vkButton'],
            'gallery_video_lightbox_yummlyButton'                  => $gallery_video_get_option['gallery_video_lightbox_yummlyButton'],
            'gallery_video_lightbox_watermark_text'                => $gallery_video_get_option['gallery_video_lightbox_watermark_text'],
            'gallery_video_lightbox_watermark_textColor'           => $gallery_video_get_option['gallery_video_lightbox_watermark_textColor'],
            'gallery_video_lightbox_watermark_textFontSize'        => $gallery_video_get_option['gallery_video_lightbox_watermark_textFontSize'],
            'gallery_video_lightbox_watermark_containerBackground' => $gallery_video_get_option['gallery_video_lightbox_watermark_containerBackground'],
            'gallery_video_lightbox_watermark_containerOpacity'    => $gallery_video_get_option['gallery_video_lightbox_watermark_containerOpacity'],
            'gallery_video_lightbox_watermark_containerWidth'      => $gallery_video_get_option['gallery_video_lightbox_watermark_containerWidth'],
            'gallery_video_lightbox_watermark_position_new'        => $gallery_video_get_option['gallery_video_lightbox_watermark_position_new'],
            'gallery_video_lightbox_watermark_opacity'             => $gallery_video_get_option['gallery_video_lightbox_watermark_opacity'],
            'gallery_video_lightbox_watermark_margin'              => $gallery_video_get_option['gallery_video_lightbox_watermark_margin'],
            'gallery_video_lightbox_watermark_img_src_new'         => $gallery_video_get_option['gallery_video_lightbox_watermark_img_src_new'],
        );

        if ( get_option('gallery_video_lightbox_type')== 'old_type' ) {
            wp_localize_script( 'jquery.vgcolorbox-js', 'lightbox_obj', $lightbox );
        }
        elseif ( get_option('gallery_video_lightbox_type') == 'new_type' ) {
            list($r,$g,$b) = array_map('hexdec',str_split($gallery_video_get_option['gallery_video_lightbox_watermark_containerBackground'],2));
            $titleopacity=$gallery_video_get_option["gallery_video_lightbox_watermark_containerOpacity"]/100;
            $lightbox_options['gallery_video_lightbox_watermark_container_bg_color'] =  'rgba('.$r.','.$g.','.$b.','.$titleopacity.')';
            wp_localize_script( 'gallery-video-resp-lightbox-js', 'gallery_video_resp_lightbox_obj', $lightbox_options );
            wp_localize_script( 'gallery-video-custom-js', 'is_watermark', $gallery_video_get_option['gallery_video_lightbox_watermark'] );
            wp_localize_script( 'gallery-video-resp-lightbox-js', 'videoGalleryDisableRightClickLightbox', get_option( 'gallery_video_disable_right_click' ) );
        }
        wp_localize_script( 'gallery-video-custom-js', 'video_lightbox_type', get_option('gallery_video_lightbox_type') );

		wp_localize_script( 'gallery-video-front-end-js-' . $view_slug, 'param_obj', $gallery_video_params );
		wp_localize_script( 'gallery-video-front-end-js-' . $view_slug, 'adminUrl', $admin_url );
		wp_localize_script( 'gallery-video-front-end-js-' . $view_slug, 'hasYoutube', $has_youtube );
		wp_localize_script( 'gallery-video-front-end-js-' . $view_slug, 'hasVimeo', $has_vimeo );
		wp_localize_script( 'jquery.vgcolorbox-js', 'lightbox_obj', $lightbox );
		wp_localize_script( 'gallery-video-custom-js', 'galleryVideoId', $id );
		wp_localize_script( 'video-jusiifed-js', 'justified_obj', $justified );
        wp_localize_script( 'gallery-video-custom-js', 'gallery_video_view', $view_slug );

    }
}
