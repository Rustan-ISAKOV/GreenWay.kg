<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Gallery_Video_Admin {

	/**
	 * Array of pages in admin
	 * @var array
	 */
	public $pages = array();

	/**
	 * Instance of Gallery_Video_General_Options class
	 *
	 * @var Gallery_Video_General_Options
	 */
	public $general_options = null;

	/**
	 * Instance of Gallery_Video_Galleries class
	 *
	 * @var Gallery_Video_Galleries
	 */
	public $video_galleries = null;

	/**
	 * Instance of Gallery_Video_Lightbox_Options class
	 *
	 * @var Gallery_Video_Lightbox_Options
	 */
	public $lightbox_options = null;

	/**
	 * Instance of Gallery_Video_Featured_Plugins class
	 *
	 * @var Gallery_Video_Featured_Plugins
	 */
	public $featured_plugins = null;


    /**
     * @return mixed
     */
    public function get_pages() {
        return $this->pages;
    }
	/**
	 * Gallery_Video_Admin constructor.
	 */
	public function __construct() {
		$this->init();
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'wp_loaded', array( $this, 'wp_loaded' ) );
		add_action( 'wp_loaded', array( $this, 'wp_loaded_add_video' ) );
		add_action( 'wp_loaded', array( $this, 'wp_loaded_edit_video' ) );
		add_action( 'wp_loaded', array( $this, 'wp_loaded_duplicate_video' ) );
	}

	/**
	 * Initialize Video Gallery's admin
	 */
	protected function init() {
		$this->general_options  = new Gallery_Video_General_Options();
		$this->video_galleries  = new Gallery_Video_Galleries();
		$this->lightbox_options = new Gallery_Video_Lightbox_Options();
		$this->featured_plugins = new Gallery_Video_Featured_Plugins();
		$this->licensing        = new Gallery_Video_Licensing();
	}

	/**
	 * Prints Video Gallery Menu
	 */
	public function admin_menu() {
		$this->pages[] = add_menu_page( __( 'Video Gallery', 'gallery-video' ), __( 'Video Gallery', 'gallery-video' ), 'delete_pages', 'video_galleries_huge_it_video_gallery', array(
			Gallery_Video()->admin->video_galleries,
			'load_video_gallery_page'
		), GALLERY_VIDEO_IMAGES_URL . "/admin_images/video_gallery_icon.png" );
		$this->pages[] = add_submenu_page( 'video_galleries_huge_it_video_gallery', __( 'Video Galleries', 'gallery-video' ), __( 'Video Galleries', 'gallery-video' ), 'delete_pages', 'video_galleries_huge_it_video_gallery', array(
			Gallery_Video()->admin->video_galleries,
			'load_video_gallery_page'
		) );

		$this->pages[] = add_submenu_page( 'video_galleries_huge_it_video_gallery', __( 'Advanced Features PRO', 'gallery-video' ), __( 'Advanced Features PRO', 'gallery-video' ), 'delete_pages', 'Options_video_gallery_styles', array(
			Gallery_Video()->admin->general_options,
			'load_page'
		) );

		$this->pages[] = add_submenu_page( 'video_galleries_huge_it_video_gallery', __( 'Lightbox Options', 'gallery-video' ), __( 'Lightbox Options', 'gallery-video' ), 'delete_pages', 'Options_video_gallery_lightbox_styles', array(
			Gallery_Video()->admin->lightbox_options,
			'load_page'
		) );

		$this->pages[] = add_submenu_page( 'video_galleries_huge_it_video_gallery', __( 'Featured Plugins', 'gallery-video' ), __( 'Featured Plugins', 'gallery-video' ), 'delete_pages', 'huge_it_video_gallery_featured_plugins', array(
			Gallery_Video()->admin->featured_plugins,
			'show_page'
		) );

		$this->pages[] = add_submenu_page( 'video_galleries_huge_it_video_gallery', __( 'Licensing', 'gallery-video' ), __( 'Licensing', 'gallery-video' ), 'delete_pages', 'huge_it_video_gallery_licensing', array(
			Gallery_Video()->admin->licensing,
			'show_page'
		) );
	}

	/**
	 * Inserts New Video Gallery
	 */
	public function wp_loaded() {
		if ( isset( $_GET['page'] ) && $_GET['page'] == 'video_galleries_huge_it_video_gallery' ) {
			if ( gallery_video_get_video_gallery_task() ) {
				if ( gallery_video_get_video_gallery_task() == 'add_cat' ) {
					if ( ! isset( $_REQUEST['huge_it_gallery_video_nonce_add_gallery_video'] ) || ! wp_verify_nonce( $_REQUEST['huge_it_gallery_video_nonce_add_gallery_video'], 'huge_it_gallery_video_nonce_add_gallery_video' ) ) {
						wp_die( 'Security check fail' );
					}
					global $wpdb;
					$table_name = $wpdb->prefix . "huge_it_videogallery_galleries";
					$wpdb->insert(
						$table_name,
						array(
							'name'                        => 'New Video Gallery',
							'sl_height'                   => 375,
							'sl_width'                    => 600,
							'pause_on_hover'              => 'on',
							'videogallery_list_effects_s' => 'cubeH',
							'description'                 => 4000,
							'param'                       => 1000,
							'ordering'                    => 1,
							'published'                   => 300,
							'huge_it_sl_effects'          => 4
						)
					);
					$apply_video_gallery_safe_link = wp_nonce_url(
						'admin.php?page=video_galleries_huge_it_video_gallery&id=' . $wpdb->insert_id . '&task=apply',
						'gallery_video_save_data_nonce' . $wpdb->insert_id,
						'save_data_nonce'
					);
					$apply_video_gallery_safe_link = htmlspecialchars_decode( $apply_video_gallery_safe_link );
					wp_redirect( $apply_video_gallery_safe_link );
				}
			}
		}
	}

	/**
	 * Inserts New Video into Video Gallery
	 */
	public function wp_loaded_add_video() {

		if ( isset( $_GET['page'] ) && $_GET['page'] == 'video_galleries_huge_it_video_gallery' ) {
			if ( gallery_video_get_video_gallery_task() && gallery_video_get_video_gallery_id() ) {
				if ( gallery_video_get_video_gallery_task() == 'videogallery_video' && $_GET['closepop'] == 1 ) {
					if ( ! isset( $_REQUEST['video_add_nonce'] ) || ! wp_verify_nonce( $_REQUEST['video_add_nonce'], 'huge_it_gallery_nonce_add_video' ) ) {
						wp_die( 'Security check fail' );
					}
					$id = gallery_video_get_video_gallery_id();
					global $wpdb;
					$title       = wp_kses( wp_unslash( $_POST["show_title"] ), 'default' );
					$description = wp_kses( wp_unslash( $_POST["show_description"] ), 'default' );
					$video_url   = sanitize_text_field( $_POST["huge_it_add_video_input"] );
					$link_url    = sanitize_text_field( $_POST["show_url"] );
					if ( isset( $_POST["huge_it_add_video_input"] ) ) {
						if ( $_POST["huge_it_add_video_input"] != '' ) {
							$table_name   = $wpdb->prefix . "huge_it_videogallery_videos";
							$query        = $wpdb->prepare( "SELECT * FROM " . $wpdb->prefix . "huge_it_videogallery_galleries WHERE id= %d", $id );
							$row          = $wpdb->get_row( $query );
							$query        = $wpdb->prepare( "SELECT * FROM " . $wpdb->prefix . "huge_it_videogallery_videos where videogallery_id = %d order by id ASC", $row->id );
							$rowplusorder = $wpdb->get_results( $query );

							foreach ( $rowplusorder as $key => $rowplusorders ) {
								$rowplusorderspl = $rowplusorders->ordering + 1;
								$wpdb->update(
									$table_name,
									array( 'ordering' => $rowplusorderspl ),
									array( 'id' => $rowplusorders->id )
								);
							}
							$wpdb->insert(
								$table_name,
								array(
									'name'                  => $title,
									'videogallery_id'       => $id,
									'description'           => $description,
									'image_url'             => $video_url,
									'sl_url'                => $link_url,
									'sl_type'               => 'video',
									'link_target'           => 'on',
									'ordering'              => 0,
									'published'             => 1,
									'published_in_sl_width' => 1
								)
							);
						}
					}
					$apply_video_gallery_safe_link = wp_nonce_url(
						'admin.php?page=video_galleries_huge_it_video_gallery&id=' . $id . '&task=apply',
						'gallery_video_save_data_nonce' . $id,
						'save_data_nonce'
					);
					$apply_video_gallery_safe_link = htmlspecialchars_decode( $apply_video_gallery_safe_link );
					wp_redirect( $apply_video_gallery_safe_link );
				}
			}
		}
	}

	/**
	 * Edit Video
	 */
	public function wp_loaded_edit_video() {
		if ( isset( $_GET['page'] ) && $_GET['page'] == 'video_galleries_huge_it_video_gallery' ) {
			if ( gallery_video_get_video_gallery_task() && gallery_video_get_video_gallery_task() == 'gallery_video_edit_video' && $_GET['closepop'] == 1 ) {
				if ( ! isset( $_REQUEST['video_edit_nonce'] ) || ! wp_verify_nonce( $_REQUEST['video_edit_nonce'], 'gallery_video_edit_video_nonce' ) ) {
					wp_die( 'Security check fail' );
				}
				global $wpdb;
                if ( !isset( $_GET["video_id"] ) || absint( $_GET['video_id'] ) != $_GET['video_id'] ) {
                    wp_die('"video_id" parameter is required to be not negative integer');
                }
				$video_unique_id  = absint( $_GET['video_id'] );
                if ( !isset( $_GET["gallery_video_id"] ) || absint( $_GET['gallery_video_id'] ) != $_GET['gallery_video_id'] ) {
                    wp_die('"gallery_video_id" parameter is required to be not negative integer');
                }
				$gallery_video_id = absint( $_GET['gallery_video_id'] );
				$video_url        = sanitize_text_field( $_GET['video_url'] );
				$table_name       = $wpdb->prefix . 'huge_it_videogallery_videos';
				$wpdb->update(
					$table_name,
					array( 'image_url' => $video_url ),
					array( 'id' => $video_unique_id )
				);
				$apply_video_gallery_safe_link = wp_nonce_url(
					'admin.php?page=video_galleries_huge_it_video_gallery&id=' . $gallery_video_id . '&task=apply',
					'gallery_video_save_data_nonce' . $gallery_video_id,
					'save_data_nonce'
				);
				$apply_video_gallery_safe_link = htmlspecialchars_decode( $apply_video_gallery_safe_link );
				wp_redirect( $apply_video_gallery_safe_link );
			}
		}
	}

	/**
	 * Duplicate Video
	 */
	function wp_loaded_duplicate_video() {
		if ( isset( $_GET['page'] ) && $_GET['page'] == 'video_galleries_huge_it_video_gallery' ) {
			if ( gallery_video_get_video_gallery_task() ) {
				if ( gallery_video_get_video_gallery_task() == 'duplicate_gallery_video' ) {
                    if ( !isset( $_GET["id"] ) || absint( $_GET['id'] ) != $_GET['id'] ) {
                        wp_die('"id" parameter is required to be not negative integer');
                    }
                    $id = absint( $_GET["id"] );
					if ( ! isset( $_REQUEST['gallery_video_duplicate_nonce'] ) || ! wp_verify_nonce( $_REQUEST['gallery_video_duplicate_nonce'], 'huge_it_gallery_video_nonce_duplicate_gallery' . $id) ) {
						wp_die( 'Security check fail' );
					}
					global $wpdb;
					$table_name    = $wpdb->prefix . "huge_it_videogallery_galleries";
					$query         = $wpdb->prepare( "SELECT * FROM " . $table_name . " WHERE id=%d", $id );
					$gallery_video = $wpdb->get_results( $query );
					$wpdb->insert(
						$table_name,
						array(
							'name'                        => $gallery_video[0]->name . ' Copy',
							'sl_height'                   => $gallery_video[0]->sl_height,
							'sl_width'                    => $gallery_video[0]->sl_width,
							'pause_on_hover'              => $gallery_video[0]->pause_on_hover,
							'videogallery_list_effects_s' => $gallery_video[0]->videogallery_list_effects_s,
							'description'                 => $gallery_video[0]->description,
							'param'                       => $gallery_video[0]->param,
							'sl_position'                 => $gallery_video[0]->sl_position,
							'ordering'                    => $gallery_video[0]->ordering,
							'published'                   => $gallery_video[0]->published,
							'huge_it_sl_effects'          => $gallery_video[0]->huge_it_sl_effects,
							'display_type'                => $gallery_video[0]->display_type,
							'content_per_page'            => $gallery_video[0]->content_per_page,
							'autoslide'                   => $gallery_video[0]->autoslide
						)
					);

					$query    = $wpdb->prepare( "SELECT id FROM " . $wpdb->prefix . "huge_it_videogallery_galleries order by id ASC");
					$row_ids = $wpdb->get_col( $query );
					$last_key = max($row_ids);
					$table_name  = $wpdb->prefix . "huge_it_videogallery_videos";
					$query       = $wpdb->prepare( "SELECT * FROM " . $table_name . " WHERE videogallery_id=%d", $id );
					$videos      = $wpdb->get_results( $query );
					$videos_list = "";
					foreach ( $videos as $key => $video ) {
						$new_video = "('";
						$new_video .= esc_sql($video->name) . "','" . esc_attr($last_key) . "','" . esc_sql( $video->description) . "','" . esc_url($video->image_url) . "','" .
                            esc_url($video->sl_url) . "','" . esc_attr($video->sl_type) . "','" . esc_attr($video->link_target) . "','" . esc_attr($video->ordering ). "','" .
                            esc_attr($video->published) . "','" . esc_attr($video->published_in_sl_width) . "','" . esc_url($video->thumb_url) . "','" .
                            esc_attr($video->show_controls) . "','" . esc_attr($video->show_info) . "')";
						$videos_list .= $new_video ."," ;
					}
					$videos_list      = substr($videos_list,0,strlen($videos_list)-1);
					$query = "INSERT into " . $table_name . " (name,videogallery_id,description,image_url,sl_url,sl_type,link_target,ordering,published,published_in_sl_width,thumb_url,show_controls,show_info)
					VALUES " . $videos_list ;
					$wpdb->query( $query);
					wp_redirect( 'admin.php?page=video_galleries_huge_it_video_gallery' );
				}
			}
		}
	}

}

