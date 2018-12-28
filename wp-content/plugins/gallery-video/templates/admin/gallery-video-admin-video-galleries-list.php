<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $wpdb;
$huge_it_gallery_video_nonce_add_gallery_video    = wp_create_nonce( 'huge_it_gallery_video_nonce_add_gallery_video' );
$huge_it_gallery_video_nonce_remove_gallery_video = wp_create_nonce( 'huge_it_gallery_video_nonce_remove_gallery_video' );
?>
<div class="wrap">
	<?php require(GALLERY_VIDEO_TEMPLATES_PATH.DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'gallery-video-admin-free-banner.php');?>
	<div style="clear: both;"></div>
	<div id="poststuff">
		<div id="videogallerys-list-page">
			<form method="post" onkeypress="doNothing()" action="admin.php?page=video_galleries_huge_it_video_gallery"
			      id="admin_form" name="admin_form">
				<h2>Huge-IT Video Galleries
					<a onclick="window.location.href='admin.php?page=video_galleries_huge_it_video_gallery&task=add_cat&huge_it_gallery_video_nonce_add_gallery_video=<?php echo $huge_it_gallery_video_nonce_add_gallery_video; ?>'"
					   class="add-new-h2">Add New Video Gallery</a>
				</h2>
				<?php
				$serch_value = '';
				if ( isset( $_POST['serch_or_not'] ) ) {
					if ( $_POST['serch_or_not'] == "search" ) {
						$serch_value = esc_html( stripslashes( $_POST['search_events_by_title'] ) );
					} else {
						$serch_value = "";
					}
				}
				$serch_fields = '<div class="alignleft actions"">
				<label for="search_events_by_title" style="font-size:14px">Search Gallery Video: </label>
					<input type="text" name="search_events_by_title" value="' . esc_attr($serch_value) . '" id="search_events_by_title" onchange="clear_serch_texts()">
			</div>
			<div class="alignleft actions">
				<input type="button" value="Search" onclick="document.getElementById(\'page_number\').value=\'1\'; document.getElementById(\'serch_or_not\').value=\'search\';
				 document.getElementById(\'admin_form\').submit();" class="button-secondary action">
				 <input type="button" value="Reset" onclick="window.location.href=\'admin.php?page=video_galleries_huge_it_video_gallery\'" class="button-secondary action">
			</div>';

				gallery_video_print_html_nav( $pageNav['total'], $pageNav['limit'], $serch_fields );
				?>
				<table class="wp-list-table widefat fixed pages" style="width:95%">
					<thead>
					<tr>
						<th scope="col" id="id" style="width:30px"><span>ID</span><span
								class="sorting-indicator"></span></th>
						<th scope="col" id="name" style="width:85px"><span>Name</span><span
								class="sorting-indicator"></span></th>
                        <th scope="col" id="shortcode" style="width:85px"><span>Shortcode</span><span
                                    class="sorting-indicator"></span></th>
						<th scope="col" id="prod_count" style="width:40px;"><span>Videos</span><span
								class="sorting-indicator"></span></th>
						<th style="width:40px"><span>Duplicate</span><span
								class="sorting-indicator"></span></th>
						<th style="width:40px"><span>Delete</span><span
								class="sorting-indicator"></span></th>
					</tr>
					</thead>
					<tbody>
					<?php
					$trcount = 1;
					for ( $i = 0; $i < count( $rows ); $i ++ ) {
						$trcount ++;
						$ka0                                              = 0;
						$ka1                                              = 0;
						$huge_it_gallery_video_nonce_remove_video_gallery = wp_create_nonce( 'huge_it_gallery_video_nonce_remove_video_gallery' . $rows[ $i ]->id );
						if ( isset( $rows[ $i - 1 ]->id ) ) {
							if ( $rows[ $i ]->sl_width == $rows[ $i - 1 ]->sl_width ) {
								$x1  = $rows[ $i ]->id;
								$x2  = $rows[ $i - 1 ]->id;
								$ka0 = 1;
							} else {
								$jj = 2;
								while ( isset( $rows[ $i - $jj ] ) ) {
									if ( $rows[ $i ]->sl_width == $rows[ $i - $jj ]->sl_width ) {
										$ka0 = 1;
										$x1  = $rows[ $i ]->id;
										$x2  = $rows[ $i - $jj ]->id;
										break;
									}
									$jj ++;
								}
							}
							if ( $ka0 ) {
								$move_up = '<span><a href="#reorder" onclick="return listItemTask(\'' . $x1 . '\',\'' . $x2 . '\')" title="Move Up">   <img src="' . plugins_url( 'images/uparrow.png', __FILE__ ) . '" width="16" height="16" border="0" alt="Move Up"></a></span>';
							} else {
								$move_up = "";
							}
						} else {
							$move_up = "";
						}

						if ( isset( $rows[ $i + 1 ]->id ) ) {
							if ( $rows[ $i ]->sl_width == $rows[ $i + 1 ]->sl_width ) {
								$x1  = $rows[ $i ]->id;
								$x2  = $rows[ $i + 1 ]->id;
								$ka1 = 1;
							} else {
								$jj = 2;
								while ( isset( $rows[ $i + $jj ] ) ) {
									if ( $rows[ $i ]->sl_width == $rows[ $i + $jj ]->sl_width ) {
										$ka1 = 1;
										$x1  = $rows[ $i ]->id;
										$x2  = $rows[ $i + $jj ]->id;
										break;
									}
									$jj ++;
								}
							}
							if ( $ka1 ) {
								$move_down = '<span><a href="#reorder" onclick="return listItemTask(\'' . $x1 . '\',\'' . $x2 . '\')" title="Move Down">  <img src="' . plugins_url( 'images/downarrow.png', __FILE__ ) . '" width="16" height="16" border="0" alt="Move Down"></a></span>';
							} else {
								$move_down = "";
							}
						}
						$uncat = $rows[ $i ]->par_name;
						if ( isset( $rows[ $i ]->prod_count ) ) {
							$pr_count = $rows[ $i ]->prod_count;
						} else {
							$pr_count = 0;
						}
						$huge_it_video_nonce_duplicate_gallery = wp_create_nonce('huge_it_gallery_video_nonce_duplicate_gallery'.$rows[$i]->id);
						?>
						<tr <?php if ( $trcount % 2 == 0 ) {
							echo 'class="has-background"';
						} ?>>
							<td><?php echo $rows[ $i ]->id; ?></td>
							<td>
								<a href="admin.php?page=video_galleries_huge_it_video_gallery&task=edit_cat&id=<?php echo $rows[ $i ]->id; ?>"><?php echo esc_html( stripslashes( $rows[ $i ]->name ) ); ?></a>
							</td>
                            <td>
                                [huge_it_videogallery id="<?php echo $rows[ $i ]->id; ?>"]
                            </td>
							<td>(<?php if ( ! ( $pr_count ) ) {
									echo '0';
								} else {
									echo $rows[ $i ]->prod_count;
								} ?>)
							</td>

							<td>
								<a href="admin.php?page=video_galleries_huge_it_video_gallery&task=duplicate_gallery_video&id=<?php echo $rows[ $i ]->id; ?>&gallery_video_duplicate_nonce=<?php echo $huge_it_video_nonce_duplicate_gallery; ?>" class="duplicate-link"><span class="duplicate-icon"></span></a>
							</td>
							<td><a class="delete-gallery-video delete-link"
							       href="admin.php?page=video_galleries_huge_it_video_gallery&task=remove_gallery_video&id=<?php echo $rows[ $i ]->id; ?>&huge_it_gallery_video_nonce_remove_video_gallery=<?php echo $huge_it_gallery_video_nonce_remove_video_gallery; ?>" ><span class="delete-icon"></span></a>
							</td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
				<input type="hidden" name="oreder_move" id="oreder_move" value=""/>
				<input type="hidden" name="asc_or_desc" id="asc_or_desc"
				       value="<?php if ( isset( $_POST['asc_or_desc'] ) ) {
					       echo esc_attr( stripslashes( $_POST['asc_or_desc'] ) );
				       } ?>"/>
				<input type="hidden" name="order_by" id="order_by" value="<?php if ( isset( $_POST['order_by'] ) ) {
					echo esc_attr( stripslashes( $_POST['order_by'] ) );
				} ?>"/>
				<input type="hidden" name="saveorder" id="saveorder" value=""/>
			</form>
		</div>
	</div>
</div>