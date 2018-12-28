<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Class Gallery_Video_Widget
 */
class Gallery_Video_Widget extends WP_Widget {

	/**
	 * Huge_it_gallery_Widget constructor.
	 */
	public function __construct() {
		parent::__construct(
			'Huge_it_gallery_video_Widget',
			'Huge IT Video Gallery',
			array( 'description' => __( 'Huge IT Video Gallery', 'gallery-video' ), )
		);
	}

	/**
	 * Print out the Widget by calling shortcode
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		if ( isset( $instance['gallery_video_id'] ) ) {
			$gallery_video_id = $instance['gallery_video_id'];

			$title = apply_filters( 'widget_title', $instance['title'] );

			echo $args['before_widget'];
			if ( ! empty( $title ) ) {
				echo $args['before_title'] . $title .$args['after_title'];
			}

			echo do_shortcode( "[huge_it_videogallery id={$gallery_video_id}]" );
			echo $args['after_widget'];
		}
	}

	/**
	 * Update options
	 * @param array $new_instance
	 * @param array $old_instance
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance                 = array();
		$instance['gallery_video_id'] = strip_tags( $new_instance['gallery_video_id'] );
		$instance['title']        = strip_tags( $new_instance['title'] );

		return $instance;
	}

	/**
	 * Print out the widget's form HTML
	 * @param array $instance
	 */
	public function form( $instance ) {
		$selected_gallery_video = 0;
		$title              = "";
		if ( isset( $instance['title'] ) ) {
			$title = $instance['title'];
		}
		if (isset($instance['gallery_video_id'])) {
			$selected_gallery_video = $instance['gallery_video_id'];
		}

		?>
		<p>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
				       name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
				       value="<?php echo esc_attr( $title ); ?>"/>
			</p>
			<label
				for="<?php echo $this->get_field_id( 'gallery_video_id' ); ?>"><?php _e( 'Select gallery video:', 'gallery-video' ); ?></label>
			<select id="<?php echo $this->get_field_id( 'gallery_video_id' ); ?>"
			        name="<?php echo $this->get_field_name( 'gallery_video_id' ); ?>">
				<?php
				global $wpdb;
				$query     = "SELECT * FROM " . $wpdb->prefix . "huge_it_videogallery_galleries ";
				$rowwidget = $wpdb->get_results( $query );
				foreach ( $rowwidget as $rowwidgetecho ) { ?>
					<option <?php selected( $selected_gallery_video, $rowwidgetecho->id, true); ?> value="<?php echo $rowwidgetecho->id; ?>"><?php echo $rowwidgetecho->name; ?></option>
				<?php } ?>
			</select>
		</p>
		<?php
	}
}