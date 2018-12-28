<?php if ($has_vimeo==true){ ?>
<script src="<?php echo Gallery_Video()->plugin_url().'/assets/js/vimeo.lib.js';?>"></script>
<?php }?>
<?php if ($has_youtube==true){ ?>
<script src="<?php echo Gallery_Video()->plugin_url().'/assets/js/youtube.lib.js';?>"></script>
<?php }?>
<script>
var video_is_playing_videogallery_<?php echo $gallery_videoID; ?>=false;
<?php if ($has_vimeo==true){?>

		jQuery(function(){
			var vimeoPlayer = document.querySelector('iframe');
			jQuery('iframe.vimeo').each(function(){
				Froogaloop(this).addEvent('ready', ready);
			});
			jQuery(".sidedock,.controls").remove();
			function ready(player_id) {
				froogaloop = $f(player_id);
				function setupEventListeners() {
					function onPlay() {
						froogaloop.addEvent('play',
							function(){
								video_is_playing_videogallery_<?php echo $gallery_videoID; ?>=true;
							});
					}
					function onPause() {
						froogaloop.addEvent('pause',
							function(){
								video_is_playing_videogallery_<?php echo $gallery_videoID; ?>=false;
							});
					}
					function stopVimeoVideo(player){
						Froogaloop(player).api('pause');
					}
					onPlay();
					onPause();
					jQuery('#huge_it_slideshow_left_videogallery_<?php echo $gallery_videoID; ?>, #huge_it_slideshow_right_videogallery_<?php echo $gallery_videoID; ?>,.huge_it_slideshow_dots_videogallery_<?php echo $gallery_videoID; ?>').click(function(){
						stopVimeoVideo(player_id);
					});
				}
				setupEventListeners();
			}
		});
<?php } ?>

<?php if ($has_youtube==true){?>
		<?php
		$i=0;
		foreach ($videos as $key => $video_row) {
		if($video_row->sl_type=="video" and strpos($video_row->image_url,'youtu') !== false){
		?>
		var player_<?php echo $video_row->id; ?>;
		<?php
		}else if (strpos($video_row->image_url,'vimeo') !== false){ ?>

		<?php
		}else{continue;}
		$i++;
		}
		?>
		video_is_playing_videogallery_<?php echo $gallery_videoID; ?>=false;
		function onYouTubeIframeAPIReady() {
			<?php
			foreach ($videos as $key => $video_row) {?>
			<?php if($video_row->sl_type=="video" and strpos($video_row->image_url,'youtu') !== false){
			    $thumb = gallery_video_get_video_id_from_url($video_row->image_url);
                $video_id = $thumb[0];
			?>
			player_<?php echo $video_row->id; ?> = new YT.Player('video_id_videogallery_<?php echo $gallery_videoID; ?>_<?php echo $key;?>', {
				height: '<?php echo esc_attr($sliderheight); ?>',
				width: '<?php echo esc_attr($sliderwidth); ?>',
				videoId: '<?php echo  $video_id;?>',
				playerVars: {
					'controls': <?php if ($videos[$key]->show_controls=="on"){ echo 1;}else{echo 0;} ?>,
					'showinfo': <?php if ($videos[$key]->show_info=="on"){ echo 1;}else{echo 0;} ?>
				},
				events: {
					'onStateChange': onPlayerStateChange_<?php echo esc_attr($video_row->id); ?>,
					'loop':1
				}
			});
			<?php
			}else{continue;}
			}
			?>
		}
		<?php
		foreach ($videos as $key => $video_row) {
		if($video_row->sl_type=="video" and strpos($video_row->image_url,'youtu') !== false){
		?>
		function onPlayerStateChange_<?php echo $video_row->id; ?>(event) {
			<?php $videos[$key]->name = htmlspecialchars($videos[$key]->name, ENT_QUOTES); ?>
			if (event.data == YT.PlayerState.PLAYING) {
				event.target.setPlaybackQuality('<?php echo $videos[$key]->name; ?>');
				video_is_playing_videogallery_<?php echo $gallery_videoID; ?>=true;
			}
			else{
				video_is_playing_videogallery_<?php echo $gallery_videoID; ?>=false;
			}
		}
		<?php
		}else{continue;}
		}
		?>
		function stopYoutubeVideo() {
			<?php
			$i=0;
			foreach ($videos as $key => $video_row) {
			if($video_row->sl_type=="video" and strpos($video_row->image_url,'youtu') !== false){
			?>
			player_<?php echo $video_row->id; ?>.pauseVideo();
			<?php
			}else{continue;}
			$i++;
			}
			?>
		}

<?php } ?>
	var data_videogallery_<?php echo $gallery_videoID; ?> = [];
	var event_stack_videogallery_<?php echo $gallery_videoID; ?> = [];
	<?php
	$i=0;
	foreach($videos as $image) {
        echo 'data_videogallery_' . $gallery_videoID . '["' . $i . '"]=[];';
        echo 'data_videogallery_' . $gallery_videoID . '["' . $i . '"]["id"]="' . $i . '";';
        echo 'data_videogallery_' . $gallery_videoID . '["' . $i . '"]["image_url"]="' . $image->image_url . '";';


        $strdesription = str_replace( '"', "'", $image->description );
        $strdesription = preg_replace( "/\r|\n/", " ", $strdesription );
        echo 'data_videogallery_' . $gallery_videoID . '["' . $i . '"]["description"]="' . $strdesription . '";';


        $stralt = str_replace( '"', "'", $image->name );
        $stralt = preg_replace( "/\r|\n/", " ", $stralt );
        echo 'data_videogallery_' . $gallery_videoID . '["' . $i . '"]["alt"]="' . $stralt . '";';
        $i ++;
    }
	?>
	var huge_it_trans_in_progress_videogallery_<?php echo $gallery_videoID; ?> = false;
	var huge_it_transition_duration_videogallery_<?php echo $gallery_videoID; ?> = <?php echo esc_attr($slidechangespeed);?>;
	var huge_it_playInterval_videogallery_<?php echo $gallery_videoID; ?>;
	// Stop autoplay.
	window.clearInterval(huge_it_playInterval_videogallery_<?php echo $gallery_videoID; ?>);
	var huge_it_current_key_videogallery_<?php echo $gallery_videoID; ?> = '<?php echo (isset($current_key) ? $current_key : ''); ?>';
	function huge_it_move_dots_videogallery_<?php echo $gallery_videoID; ?>() {
		var image_left = jQuery(".huge_it_slideshow_dots_active_videogallery_<?php echo $gallery_videoID; ?>").position().left;
		var image_right = jQuery(".huge_it_slideshow_dots_active_videogallery_<?php echo $gallery_videoID; ?>").position().left + jQuery(".huge_it_slideshow_dots_active_videogallery_<?php echo $gallery_videoID; ?>").outerWidth(true);

	}
	function huge_it_testBrowser_cssTransitions_videogallery_<?php echo $gallery_videoID; ?>() {
		return huge_it_testDom_videogallery_<?php echo $gallery_videoID; ?>('Transition');
	}
	function huge_it_testBrowser_cssTransforms3d_videogallery_<?php echo $gallery_videoID; ?>() {
		return huge_it_testDom_videogallery_<?php echo $gallery_videoID; ?>('Perspective');
	}
	function huge_it_testDom_videogallery_<?php echo $gallery_videoID; ?>(prop) {
		// Browser vendor CSS prefixes.
		var browserVendors = ['', '-webkit-', '-moz-', '-ms-', '-o-', '-khtml-'];
		// Browser vendor DOM prefixes.
		var domPrefixes = ['', 'Webkit', 'Moz', 'ms', 'O', 'Khtml'];
		var i = domPrefixes.length;
		while (i--) {
			if (typeof document.body.style[domPrefixes[i] + prop] !== 'undefined') {
				return true;
			}
		}
		return false;
	}
	function huge_it_cube_videogallery_<?php echo $gallery_videoID; ?>(tz, ntx, nty, nrx, nry, wrx, wry, current_image_class, next_image_class, direction) {
		/* If browser does not support 3d transforms/CSS transitions.*/
		if (!huge_it_testBrowser_cssTransitions_videogallery_<?php echo $gallery_videoID; ?>()) {
			jQuery(".huge_it_slideshow_dots_videogallery_<?php echo $gallery_videoID; ?>").removeClass("huge_it_slideshow_dots_active_videogallery_<?php echo $gallery_videoID; ?>").addClass("huge_it_slideshow_dots_deactive_videogallery_<?php echo $gallery_videoID; ?>");
			jQuery("#huge_it_dots_" + huge_it_current_key_videogallery_<?php echo $gallery_videoID; ?> + "_videogallery_<?php echo $gallery_videoID; ?>").removeClass("huge_it_slideshow_dots_deactive_videogallery_<?php echo $gallery_videoID; ?>").addClass("huge_it_slideshow_dots_active_videogallery_<?php echo $gallery_videoID; ?>");
			return huge_it_fallback_videogallery_<?php echo $gallery_videoID; ?>(current_image_class, next_image_class, direction);
		}
		if (!huge_it_testBrowser_cssTransforms3d_videogallery_<?php echo $gallery_videoID; ?>()) {
			return huge_it_fallback3d_videogallery_<?php echo $gallery_videoID; ?>(current_image_class, next_image_class, direction);
		}
		huge_it_trans_in_progress_videogallery_<?php echo $gallery_videoID; ?> = true;
		/* Set active thumbnail.*/
		jQuery(".huge_it_slideshow_dots_videogallery_<?php echo $gallery_videoID; ?>").removeClass("huge_it_slideshow_dots_active_videogallery_<?php echo $gallery_videoID; ?>").addClass("huge_it_slideshow_dots_deactive_videogallery_<?php echo $gallery_videoID; ?>");
		jQuery("#huge_it_dots_" + huge_it_current_key_videogallery_<?php echo $gallery_videoID; ?> + "_videogallery_<?php echo $gallery_videoID; ?>").removeClass("huge_it_slideshow_dots_deactive_videogallery_<?php echo $gallery_videoID; ?>").addClass("huge_it_slideshow_dots_active_videogallery_<?php echo $gallery_videoID; ?>");
		jQuery(".huge_it_slide_bg_videogallery_<?php echo $gallery_videoID; ?>").css('perspective', 1000);
		jQuery(current_image_class).css({
			transform : 'translateZ(' + tz + 'px)',
			backfaceVisibility : 'hidden'
		});

		jQuery(".huge_it_slideshow_image_wrap_videogallery_<?php echo $gallery_videoID; ?>,.huge_it_slide_bg_videogallery_<?php echo $gallery_videoID; ?>,.huge_it_slideshow_image_item_videogallery_<?php echo $gallery_videoID; ?>,.huge_it_slideshow_image_second_item_videogallery_<?php echo $gallery_videoID; ?> ").css('overflow', 'visible');

		jQuery(next_image_class).css({
			opacity : 1,
			filter: 'Alpha(opacity=100)',
			backfaceVisibility : 'hidden',
			transform : 'translateY(' + nty + 'px) translateX(' + ntx + 'px) rotateY('+ nry +'deg) rotateX('+ nrx +'deg)'
		});
		jQuery(".huge_it_slider_videogallery_<?php echo $gallery_videoID; ?>").css({
			transform: 'translateZ(-' + tz + 'px)',
			transformStyle: 'preserve-3d'
		});
		/* Execution steps.*/
		setTimeout(function () {
			jQuery(".huge_it_slider_videogallery_<?php echo $gallery_videoID; ?>").css({
				transition: 'all ' + huge_it_transition_duration_videogallery_<?php echo $gallery_videoID; ?> + 'ms ease-in-out',
				transform: 'translateZ(-' + tz + 'px) rotateX('+ wrx +'deg) rotateY('+ wry +'deg)'
			});
		}, 20);
		/* After transition.*/
		jQuery(".huge_it_slider_videogallery_<?php echo $gallery_videoID; ?>").one('webkitTransitionEnd transitionend otransitionend oTransitionEnd mstransitionend', jQuery.proxy(huge_it_after_trans));
		function huge_it_after_trans() {
			jQuery(".huge_it_slide_bg_videogallery_<?php echo $gallery_videoID; ?>,.huge_it_slideshow_image_item_videogallery_<?php echo $gallery_videoID; ?>,.huge_it_slideshow_image_second_item_videogallery_<?php echo $gallery_videoID; ?> ").css('overflow', 'hidden');
			jQuery(".huge_it_slide_bg_videogallery_<?php echo $gallery_videoID; ?>").removeAttr('style');
			jQuery(current_image_class).removeAttr('style');
			jQuery(next_image_class).removeAttr('style');
			jQuery(".huge_it_slider_videogallery_<?php echo $gallery_videoID; ?>").removeAttr('style');
			jQuery(current_image_class).css({'opacity' : 0, filter: 'Alpha(opacity=0)', 'z-index': 1});
			jQuery(next_image_class).css({'opacity' : 1, filter: 'Alpha(opacity=100)', 'z-index' : 2});
			// huge_it_change_watermark_container_videogallery_<?php echo $gallery_videoID; ?>();
			huge_it_trans_in_progress_videogallery_<?php echo $gallery_videoID; ?> = false;
			if (typeof event_stack_videogallery_<?php echo $gallery_videoID; ?> !== 'undefined' && event_stack_videogallery_<?php echo $gallery_videoID; ?>.length > 0) {
				key = event_stack_videogallery_<?php echo $gallery_videoID; ?>[0].split("-");
				event_stack_videogallery_<?php echo $gallery_videoID; ?>.shift();
				huge_it_change_image_videogallery_<?php echo $gallery_videoID; ?>(key[0], key[1], data_videogallery_<?php echo $gallery_videoID; ?>, true,false);
			}
		}
	}
	function huge_it_cubeH_videogallery_<?php echo $gallery_videoID; ?>(current_image_class, next_image_class, direction) {
		/* Set to half of image width.*/
		var dimension = jQuery(current_image_class).width() / 2;
		if (direction == 'right') {
			huge_it_cube_videogallery_<?php echo $gallery_videoID; ?>(dimension, dimension, 0, 0, 90, 0, -90, current_image_class, next_image_class, direction);
		}
		else if (direction == 'left') {
			huge_it_cube_videogallery_<?php echo $gallery_videoID; ?>(dimension, -dimension, 0, 0, -90, 0, 90, current_image_class, next_image_class, direction);
		}
	}
	function huge_it_cubeV_videogallery_<?php echo $gallery_videoID; ?>(current_image_class, next_image_class, direction) {
		/* Set to half of image height.*/
		var dimension = jQuery(current_image_class).height() / 2;
		/* If next slide.*/
		if (direction == 'right') {
			huge_it_cube_videogallery_<?php echo $gallery_videoID; ?>(dimension, 0, -dimension, 90, 0, -90, 0, current_image_class, next_image_class, direction);
		}
		else if (direction == 'left') {
			huge_it_cube_videogallery_<?php echo $gallery_videoID; ?>(dimension, 0, dimension, -90, 0, 90, 0, current_image_class, next_image_class, direction);
		}
	}
	/* For browsers that does not support transitions.*/
	function huge_it_fallback_videogallery_<?php echo $gallery_videoID; ?>(current_image_class, next_image_class, direction) {
		huge_it_fade_videogallery_<?php echo $gallery_videoID; ?>(current_image_class, next_image_class, direction);
	}
	/* For browsers that support transitions, but not 3d transforms (only used if primary transition makes use of 3d-transforms).*/
	function huge_it_fallback3d_videogallery_<?php echo $gallery_videoID; ?>(current_image_class, next_image_class, direction) {
		huge_it_sliceV_videogallery_<?php echo $gallery_videoID; ?>(current_image_class, next_image_class, direction);
	}
	function huge_it_none_videogallery_<?php echo $gallery_videoID; ?>(current_image_class, next_image_class, direction) {
		jQuery(current_image_class).css({'opacity' : 0, 'z-index': 1});
		jQuery(next_image_class).css({'opacity' : 1, 'z-index' : 2});

		/* Set active thumbnail.*/
		jQuery(".huge_it_slideshow_dots_videogallery_<?php echo $gallery_videoID; ?>").removeClass("huge_it_slideshow_dots_active_videogallery_<?php echo $gallery_videoID; ?>").addClass("huge_it_slideshow_dots_deactive_videogallery_<?php echo $gallery_videoID; ?>");
		jQuery("#huge_it_dots_" + huge_it_current_key_videogallery_<?php echo $gallery_videoID; ?> + "_videogallery_<?php echo $gallery_videoID; ?>").removeClass("huge_it_slideshow_dots_deactive_videogallery_<?php echo $gallery_videoID; ?>").addClass("huge_it_slideshow_dots_active_videogallery_<?php echo $gallery_videoID; ?>");
	}
	function huge_it_fade_videogallery_<?php echo $gallery_videoID; ?>(current_image_class, next_image_class, direction) {
		if (huge_it_testBrowser_cssTransitions_videogallery_<?php echo $gallery_videoID; ?>()) {
			jQuery(next_image_class).css('transition', 'opacity ' + huge_it_transition_duration_videogallery_<?php echo $gallery_videoID; ?> + 'ms linear');
			jQuery(current_image_class).css('transition', 'opacity ' + huge_it_transition_duration_videogallery_<?php echo $gallery_videoID; ?> + 'ms linear');
			jQuery(current_image_class).css({'opacity' : 0, 'z-index': 1});
			jQuery(next_image_class).css({'opacity' : 1, 'z-index' : 2});
		}
		else {
			jQuery(current_image_class).animate({'opacity' : 0, 'z-index' : 1}, huge_it_transition_duration_videogallery_<?php echo $gallery_videoID; ?>);
			jQuery(next_image_class).animate({
				'opacity' : 1,
				'z-index': 2
			}, {
				duration: huge_it_transition_duration_videogallery_<?php echo $gallery_videoID; ?>,
				complete: function () {return false;}
			});
			// For IE.
			jQuery(current_image_class).fadeTo(huge_it_transition_duration_videogallery_<?php echo $gallery_videoID; ?>, 0);
			jQuery(next_image_class).fadeTo(huge_it_transition_duration_videogallery_<?php echo $gallery_videoID; ?>, 1);
		}

		jQuery(".huge_it_slideshow_dots_videogallery_<?php echo $gallery_videoID; ?>").removeClass("huge_it_slideshow_dots_active_videogallery_<?php echo $gallery_videoID; ?>").addClass("huge_it_slideshow_dots_deactive_videogallery_<?php echo $gallery_videoID; ?>");
		jQuery("#huge_it_dots_" + huge_it_current_key_videogallery_<?php echo $gallery_videoID; ?> + "_videogallery_<?php echo $gallery_videoID; ?>").removeClass("huge_it_slideshow_dots_deactive_videogallery_<?php echo $gallery_videoID; ?>").addClass("huge_it_slideshow_dots_active_videogallery_<?php echo $gallery_videoID; ?>");
	}
	function huge_it_grid_videogallery_<?php echo $gallery_videoID; ?>(cols, rows, ro, tx, ty, sc, op, current_image_class, next_image_class, direction) {
		/* If browser does not support CSS transitions.*/
		if (!huge_it_testBrowser_cssTransitions_videogallery_<?php echo $gallery_videoID; ?>()) {
			jQuery(".huge_it_slideshow_dots_videogallery_<?php echo $gallery_videoID; ?>").removeClass("huge_it_slideshow_dots_active_videogallery_<?php echo $gallery_videoID; ?>").addClass("huge_it_slideshow_dots_deactive_videogallery_<?php echo $gallery_videoID; ?>");
			jQuery("#huge_it_dots_" + huge_it_current_key_videogallery_<?php echo $gallery_videoID; ?> + "_videogallery_<?php echo $gallery_videoID; ?>").removeClass("huge_it_slideshow_dots_deactive_videogallery_<?php echo $gallery_videoID; ?>").addClass("huge_it_slideshow_dots_active_videogallery_<?php echo $gallery_videoID; ?>");
			return huge_it_fallback_videogallery_<?php echo $gallery_videoID; ?>(current_image_class, next_image_class, direction);

		}
		huge_it_trans_in_progress_videogallery_<?php echo $gallery_videoID; ?> = true;
		/* Set active thumbnail.*/
		jQuery(".huge_it_slideshow_dots_videogallery_<?php echo $gallery_videoID; ?>").removeClass("huge_it_slideshow_dots_active_videogallery_<?php echo $gallery_videoID; ?>").addClass("huge_it_slideshow_dots_deactive_videogallery_<?php echo $gallery_videoID; ?>");
		jQuery("#huge_it_dots_" + huge_it_current_key_videogallery_<?php echo $gallery_videoID; ?> + "_videogallery_<?php echo $gallery_videoID; ?>").removeClass("huge_it_slideshow_dots_deactive_videogallery_<?php echo $gallery_videoID; ?>").addClass("huge_it_slideshow_dots_active_videogallery_<?php echo $gallery_videoID; ?>");
		/* The time (in ms) added to/subtracted from the delay total for each new gridlet.*/
		var count = (huge_it_transition_duration_videogallery_<?php echo $gallery_videoID; ?>) / (cols + rows);
		/* Gridlet creator (divisions of the image grid, positioned with background-images to replicate the look of an entire slide image when assembled)*/
		function huge_it_gridlet(width, height, top, img_top, left, img_left, src, imgWidth, imgHeight, c, r) {
			var delay = (c + r) * count;
			/* Return a gridlet elem with styles for specific transition.*/
			return jQuery('<div class="huge_it_gridlet_videogallery_<?php echo $gallery_videoID; ?>" />').css({
				width : width,
				height : height,
				top : top,
				left : left,
				backgroundImage : 'url("' + src + '")',
				backgroundColor: jQuery(".huge_it_slideshow_image_wrap_videogallery_<?php echo $gallery_videoID; ?>").css("background-color"),
				/*backgroundColor: rgba(0, 0, 0, 0),*/
				backgroundRepeat: 'no-repeat',
				backgroundPosition : img_left + 'px ' + img_top + 'px',
				backgroundSize : imgWidth + 'px ' + imgHeight + 'px',
				transition : 'all ' + huge_it_transition_duration_videogallery_<?php echo $gallery_videoID; ?> + 'ms ease-in-out ' + delay + 'ms',
				transform : 'none'
			});
		}
		/* Get the current slide's image.*/
		var cur_img = jQuery(current_image_class).find('img');
		/* Create a grid to hold the gridlets.*/
		var grid = jQuery('<div />').addClass('huge_it_grid_videogallery_<?php echo $gallery_videoID; ?>');
		/* Prepend the grid to the next slide (i.e. so it's above the slide image).*/
		jQuery(current_image_class).prepend(grid);
		/* vars to calculate positioning/size of gridlets*/
		var cont = jQuery(".huge_it_slide_bg_videogallery_<?php echo $gallery_videoID; ?>");
		var imgWidth = cur_img.width();
		var imgHeight = cur_img.height();
		var contWidth = cont.width(),
			contHeight = cont.height(),
			imgSrc = cur_img.attr('src'),/*.replace('/thumb', ''),*/
			colWidth = Math.floor(contWidth / cols),
			rowHeight = Math.floor(contHeight / rows),
			colRemainder = contWidth - (cols * colWidth),
			colAdd = Math.ceil(colRemainder / cols),
			rowRemainder = contHeight - (rows * rowHeight),
			rowAdd = Math.ceil(rowRemainder / rows),
			leftDist = 0,
			img_leftDist = (jQuery(".huge_it_slide_bg_videogallery_<?php echo $gallery_videoID; ?>").width() - cur_img.width()) / 2;
		/* tx/ty args can be passed as 'auto'/'min-auto' (meaning use slide width/height or negative slide width/height).*/
		tx = tx === 'auto' ? contWidth : tx;
		tx = tx === 'min-auto' ? - contWidth : tx;
		ty = ty === 'auto' ? contHeight : ty;
		ty = ty === 'min-auto' ? - contHeight : ty;
		/* Loop through cols*/
		for (var i = 0; i < cols; i++) {
			var topDist = 0,
				img_topDst = (jQuery(".huge_it_slide_bg_videogallery_<?php echo $gallery_videoID; ?>").height() - cur_img.height()) / 2,
				newColWidth = colWidth;
			/* If imgWidth (px) does not divide cleanly into the specified number of cols, adjust individual col widths to create correct total.*/
			if (colRemainder > 0) {
				var add = colRemainder >= colAdd ? colAdd : colRemainder;
				newColWidth += add;
				colRemainder -= add;
			}
			/* Nested loop to create row gridlets for each col.*/
			for (var j = 0; j < rows; j++)  {
				var newRowHeight = rowHeight,
					newRowRemainder = rowRemainder;
				/* If contHeight (px) does not divide cleanly into the specified number of rows, adjust individual row heights to create correct total.*/
				if (newRowRemainder > 0) {
					add = newRowRemainder >= rowAdd ? rowAdd : rowRemainder;
					newRowHeight += add;
					newRowRemainder -= add;
				}
				/* Create & append gridlet to grid.*/
				grid.append(huge_it_gridlet(newColWidth, newRowHeight, topDist, img_topDst, leftDist, img_leftDist, imgSrc, imgWidth, imgHeight, i, j));
				topDist += newRowHeight;
				img_topDst -= newRowHeight;
			}
			img_leftDist -= newColWidth;
			leftDist += newColWidth;
		}
		/* Set event listener on last gridlet to finish transitioning.*/
		var last_gridlet = grid.children().last();
		/* Show grid & hide the image it replaces.*/
		grid.show();
		cur_img.css('opacity', 0);
		/* Add identifying classes to corner gridlets (useful if applying border radius).*/
		grid.children().first().addClass('rs-top-left');
		grid.children().last().addClass('rs-bottom-right');
		grid.children().eq(rows - 1).addClass('rs-bottom-left');
		grid.children().eq(- rows).addClass('rs-top-right');
		/* Execution steps.*/
		setTimeout(function () {
			grid.children().css({
				opacity: op,
				transform: 'rotate('+ ro +'deg) translateX('+ tx +'px) translateY('+ ty +'px) scale('+ sc +')'
			});
		}, 1);
		jQuery(next_image_class).css('opacity', 1);
		/* After transition.*/
		jQuery(last_gridlet).one('webkitTransitionEnd transitionend otransitionend oTransitionEnd mstransitionend', jQuery.proxy(huge_it_after_trans));
		function huge_it_after_trans() {
			jQuery(current_image_class).css({'opacity' : 0, 'z-index': 1});
			jQuery(next_image_class).css({'opacity' : 1, 'z-index' : 2});
			cur_img.css('opacity', 1);
			grid.remove();
			huge_it_trans_in_progress_videogallery_<?php echo $gallery_videoID; ?> = false;
			if (typeof event_stack_videogallery_<?php echo $gallery_videoID; ?> !== 'undefined' && event_stack_videogallery_<?php echo $gallery_videoID; ?>.length > 0) {
				key = event_stack_videogallery_<?php echo $gallery_videoID; ?>[0].split("-");
				event_stack_videogallery_<?php echo $gallery_videoID; ?>.shift();
				huge_it_change_image_videogallery_<?php echo $gallery_videoID; ?>(key[0], key[1], data_videogallery_<?php echo $gallery_videoID; ?>, true,false);
			}
		}
	}
	function huge_it_sliceH_videogallery_<?php echo $gallery_videoID; ?>(current_image_class, next_image_class, direction) {
		if (direction == 'right') {
			var translateX = 'min-auto';
		}
		else if (direction == 'left') {
			var translateX = 'auto';
		}
		huge_it_grid_videogallery_<?php echo $gallery_videoID; ?>(1, 8, 0, translateX, 0, 1, 0, current_image_class, next_image_class, direction);
	}
	function huge_it_sliceV_videogallery_<?php echo $gallery_videoID; ?>(current_image_class, next_image_class, direction) {
		if (direction == 'right') {
			var translateY = 'min-auto';
		}
		else if (direction == 'left') {
			var translateY = 'auto';
		}
		huge_it_grid_videogallery_<?php echo $gallery_videoID; ?>(10, 1, 0, 0, translateY, 1, 0, current_image_class, next_image_class, direction);
	}
	function huge_it_slideV_videogallery_<?php echo $gallery_videoID; ?>(current_image_class, next_image_class, direction) {
		if (direction == 'right') {
			var translateY = 'auto';
		}
		else if (direction == 'left') {
			var translateY = 'min-auto';
		}
		huge_it_grid_videogallery_<?php echo $gallery_videoID; ?>(1, 1, 0, 0, translateY, 1, 1, current_image_class, next_image_class, direction);
	}
	function huge_it_slideH_videogallery_<?php echo $gallery_videoID; ?>(current_image_class, next_image_class, direction) {
		if (direction == 'right') {
			var translateX = 'min-auto';
		}
		else if (direction == 'left') {
			var translateX = 'auto';
		}
		huge_it_grid_videogallery_<?php echo $gallery_videoID; ?>(1, 1, 0, translateX, 0, 1, 1, current_image_class, next_image_class, direction);
	}
	function huge_it_scaleOut_videogallery_<?php echo $gallery_videoID; ?>(current_image_class, next_image_class, direction) {
		huge_it_grid_videogallery_<?php echo $gallery_videoID; ?>(1, 1, 0, 0, 0, 1.5, 0, current_image_class, next_image_class, direction);
	}
	function huge_it_scaleIn_videogallery_<?php echo $gallery_videoID; ?>(current_image_class, next_image_class, direction) {
		huge_it_grid_videogallery_<?php echo $gallery_videoID; ?>(1, 1, 0, 0, 0, 0.5, 0, current_image_class, next_image_class, direction);
	}
	function huge_it_blockScale_videogallery_<?php echo $gallery_videoID; ?>(current_image_class, next_image_class, direction) {
		huge_it_grid_videogallery_<?php echo $gallery_videoID; ?>(8, 6, 0, 0, 0, .6, 0, current_image_class, next_image_class, direction);
	}
	function huge_it_kaleidoscope_videogallery_<?php echo $gallery_videoID; ?>(current_image_class, next_image_class, direction) {
		huge_it_grid_videogallery_<?php echo $gallery_videoID; ?>(10, 8, 0, 0, 0, 1, 0, current_image_class, next_image_class, direction);
	}
	function huge_it_fan_videogallery_<?php echo $gallery_videoID; ?>(current_image_class, next_image_class, direction) {
		if (direction == 'right') {
			var rotate = 45;
			var translateX = 100;
		}
		else if (direction == 'left') {
			var rotate = -45;
			var translateX = -100;
		}
		huge_it_grid_videogallery_<?php echo $gallery_videoID; ?>(1, 10, rotate, translateX, 0, 1, 0, current_image_class, next_image_class, direction);
	}
	function huge_it_blindV_videogallery_<?php echo $gallery_videoID; ?>(current_image_class, next_image_class, direction) {
		huge_it_grid_videogallery_<?php echo $gallery_videoID; ?>(1, 8, 0, 0, 0, .7, 0, current_image_class, next_image_class);
	}
	function huge_it_blindH_videogallery_<?php echo $gallery_videoID; ?>(current_image_class, next_image_class, direction) {
		huge_it_grid_videogallery_<?php echo $gallery_videoID; ?>(10, 1, 0, 0, 0, .7, 0, current_image_class, next_image_class);
	}
	function huge_it_random_videogallery_<?php echo $gallery_videoID; ?>(current_image_class, next_image_class, direction) {
		var anims = ['sliceH', 'sliceV', 'slideH', 'slideV', 'scaleOut', 'scaleIn', 'blockScale', 'kaleidoscope', 'fan', 'blindH', 'blindV'];
		/* Pick a random transition from the anims array.*/
		this["huge_it_" + anims[Math.floor(Math.random() * anims.length)] + "_videogallery_<?php echo $gallery_videoID; ?>"](current_image_class, next_image_class, direction);
	}

	function iterator_videogallery_<?php echo $gallery_videoID; ?>() {
		var iterator = 1;

		return iterator;
	}

	function huge_it_change_image_videogallery_<?php echo $gallery_videoID; ?>(current_key, key, data_videogallery_<?php echo $gallery_videoID; ?>, from_effect,clicked) {

		if (data_videogallery_<?php echo $gallery_videoID; ?>[key]) {

			if(video_is_playing_videogallery_<?php echo $gallery_videoID; ?> && !clicked){
				return false;
			}

			if (!from_effect) {

				// Change image key.
				jQuery("#huge_it_current_image_key_videogallery_<?php echo $gallery_videoID; ?>").val(key);
				// if (current_key == '-2') { /* Dots.*/
				current_key = jQuery(".huge_it_slideshow_dots_active_videogallery_<?php echo $gallery_videoID; ?>").attr("data-image_key");
				//  }
			}

			if (huge_it_trans_in_progress_videogallery_<?php echo $gallery_videoID; ?>) {
				event_stack_videogallery_<?php echo $gallery_videoID; ?>.push(current_key + '-' + key);
				return;
			}
			var direction = 'right';
			if (huge_it_current_key_videogallery_<?php echo $gallery_videoID; ?> > key) {
				var direction = 'left';
			}
			else if (huge_it_current_key_videogallery_<?php echo $gallery_videoID; ?> == key) {
				return false;
			}
			huge_it_current_key_videogallery_<?php echo $gallery_videoID; ?> = key;
			//Change image id, title, description.
			jQuery("#huge_it_slideshow_image_videogallery_<?php echo $gallery_videoID; ?>").attr('data-image_id', data_videogallery_<?php echo $gallery_videoID; ?>[key]["id"]);
			jQuery(".huge_it_slideshow_title_text_videogallery_<?php echo $gallery_videoID; ?>").html(data_videogallery_<?php echo $gallery_videoID; ?>[key]["alt"]);
			jQuery(".huge_it_slideshow_description_text_videogallery_<?php echo $gallery_videoID; ?>").html(data_videogallery_<?php echo $gallery_videoID; ?>[key]["description"]);

			var current_image_class = "#image_id_videogallery_<?php echo $gallery_videoID; ?>_" + data_videogallery_<?php echo $gallery_videoID; ?>[current_key]["id"];
			var next_image_class = "#image_id_videogallery_<?php echo $gallery_videoID; ?>_" + data_videogallery_<?php echo $gallery_videoID; ?>[key]["id"];
			if(jQuery(current_image_class).find('.huge_it_video_frame_videogallery_<?php echo $gallery_videoID; ?>').length>0) {
				var streffect='<?php echo $slidereffect; ?>';
				if(streffect=="cubeV" || streffect=="cubeH" || streffect=="none" || streffect=="fade"){
					huge_it_<?php echo $slidereffect; ?>_videogallery_<?php echo $gallery_videoID; ?>(current_image_class, next_image_class, direction);
				}else{
					huge_it_fade_videogallery_<?php echo $gallery_videoID; ?>(current_image_class, next_image_class, direction);
				}
			}else{
				huge_it_<?php echo $slidereffect; ?>_videogallery_<?php echo $gallery_videoID; ?>(current_image_class, next_image_class, direction);
			}

			jQuery('.huge_it_slideshow_title_text_videogallery_<?php echo $gallery_videoID; ?>').removeClass('none');
			if(jQuery('.huge_it_slideshow_title_text_videogallery_<?php echo $gallery_videoID; ?>').html()==""){jQuery('.huge_it_slideshow_title_text_videogallery_<?php echo $gallery_videoID; ?>').addClass('none');}
			jQuery('.huge_it_slideshow_description_text_videogallery_<?php echo $gallery_videoID; ?>').removeClass('none');
			if(jQuery('.huge_it_slideshow_description_text_videogallery_<?php echo $gallery_videoID; ?>').html()==""){jQuery('.huge_it_slideshow_description_text_videogallery_<?php echo $gallery_videoID; ?>').addClass('none');}
			jQuery(current_image_class).find('.huge_it_slideshow_title_text_videogallery_<?php echo $gallery_videoID; ?>').addClass('none');
			jQuery(current_image_class).find('.huge_it_slideshow_description_text_videogallery_<?php echo $gallery_videoID; ?>').addClass('none');
			huge_it_move_dots_videogallery_<?php echo $gallery_videoID; ?>();
			<?php if ($has_youtube==true){?>stopYoutubeVideo(); <?php } ?>
			window.clearInterval(huge_it_playInterval_videogallery_<?php echo $gallery_videoID; ?>);
			play_videogallery_<?php echo $gallery_videoID; ?>();
		}
	}

	function huge_it_popup_resize_videogallery_<?php echo $gallery_videoID; ?>() {
		var staticsliderwidth=<?php echo $sliderwidth;?>;
		var sliderwidth=<?php echo $sliderwidth;?>;
		var sliderHeight=<?php echo $sliderheight;?>;
		var bodyWidth=jQuery(window).width();
		var parentWidth = jQuery(".huge_it_slideshow_image_wrap_videogallery_<?php echo $gallery_videoID; ?>").parent().width();
		//if responsive js late responsive.js @  take body size and not parent div
		if(sliderwidth>parentWidth){sliderwidth=parentWidth;}
		if(sliderwidth>bodyWidth){sliderwidth=bodyWidth;}

		var str=(<?php echo $sliderheight;?>/staticsliderwidth);
		var defaultRatio = sliderwidth/sliderHeight;

		jQuery(".huge_it_slideshow_image_wrap_videogallery_<?php echo $gallery_videoID; ?>").css({width: (sliderwidth)});
		jQuery(".huge_it_slideshow_image_wrap_videogallery_<?php echo $gallery_videoID; ?>").css({height: ((sliderwidth) * str)});

		if("<?php echo $slideshow_title_position[1]; ?>"=="middle"){var titlemargintopminus=jQuery(".huge_it_slideshow_title_text_videogallery_<?php echo $gallery_videoID; ?>").outerHeight()/2;}
		if("<?php echo $slideshow_title_position[0]; ?>"=="center"){var titlemarginleftminus=jQuery(".huge_it_slideshow_title_text_videogallery_<?php echo $gallery_videoID; ?>").outerWidth()/2;}
		jQuery(".huge_it_slideshow_title_text_videogallery_<?php echo $gallery_videoID; ?>").css({cssText: "margin-top:-" + titlemargintopminus + "px; margin-left:-"+titlemarginleftminus+"px;"});

		if("<?php echo $slideshow_description_position[1]; ?>"=="middle"){var descriptionmargintopminus=jQuery(".huge_it_slideshow_description_text_videogallery_<?php echo $gallery_videoID; ?>").outerHeight()/2;}
		if("<?php echo $slideshow_description_position[0]; ?>"=="center"){var descriptionmarginleftminus=jQuery(".huge_it_slideshow_description_text_videogallery_<?php echo $gallery_videoID; ?>").outerWidth()/2;}
		jQuery(".huge_it_slideshow_description_text_videogallery_<?php echo $gallery_videoID; ?>").css({cssText: "margin-top:-" + descriptionmargintopminus + "px; margin-left:-"+descriptionmarginleftminus+"px;"});


		if("<?php echo $gallery_video_get_option['gallery_video_slider_crop_image']; ?>"=="resize"){
			jQuery(".huge_it_slideshow_image_videogallery_<?php echo $gallery_videoID; ?>, .huge_it_slideshow_image_item1_videogallery_<?php echo $gallery_videoID; ?> img, .huge_it_slideshow_image_container_videogallery_<?php echo $gallery_videoID; ?> img").css({
				cssText: "width:" + sliderwidth + "px; height:" + ((sliderwidth) * str)	+"px;"
			});
		}else {
            jQuery("ul.huge_it_slider_videogallery_<?php echo $gallery_videoID; ?> li img").each(function(e,img){

	            var naturalRatio = jQuery(this).prop('naturalWidth') / jQuery(this).prop('naturalHeight');
	            if (naturalRatio <= defaultRatio) {
		            jQuery(img).css({
			            position: "relative",
			            width: '100%',
			            top: '50%',
			            transform: 'translateY(-50%)'
		            });
	            } else {
		            jQuery(img).css({
			            position: "relative",
			            height: '100%',
			            left: '50%',
			            transform: 'translateX(-50%)'
		            });
	            }
            });
			jQuery(".huge_it_slideshow_image_videogallery_<?php echo $gallery_videoID; ?>").css({
				cssText: "max-width: " + sliderwidth + "px !important; max-height: " + (sliderwidth * str) + "px !important;"
			});
		}
		jQuery('.huge_it_video_frame_videogallery_<?php echo $gallery_videoID; ?>').each(function (e) {
			jQuery(this).width(sliderwidth);
			jQuery(this).height(sliderwidth * str);
		});
	}

	jQuery(window).load(function () {
		jQuery(window).resize(function() {
			huge_it_popup_resize_videogallery_<?php echo $gallery_videoID; ?>();
		});
			huge_it_popup_resize_videogallery_<?php echo $gallery_videoID; ?>();
		jQuery('div[id^="huge_it_container"]').bind("contextmenu", function () {
			return false;
		});
		jQuery("#huge_it_slideshow_image_container_videogallery_<?php echo $gallery_videoID; ?>, .huge_it_slideshow_image_container_videogallery_<?php echo $gallery_videoID; ?>, .huge_it_slideshow_dots_container_videogallery_<?php echo $gallery_videoID; ?>,#huge_it_slideshow_right_videogallery_<?php echo $gallery_videoID; ?>,#huge_it_slideshow_left_videogallery_<?php echo $gallery_videoID; ?>").hover(function(){
			jQuery("#huge_it_slideshow_right_videogallery_<?php echo $gallery_videoID; ?>").css({'display':'inline'});
			jQuery("#huge_it_slideshow_left_videogallery_<?php echo $gallery_videoID; ?>").css({'display':'inline'});
		},function(){
			jQuery("#huge_it_slideshow_right_videogallery_<?php echo $gallery_videoID; ?>").css({'display':'none'});
			jQuery("#huge_it_slideshow_left_videogallery_<?php echo $gallery_videoID; ?>").css({'display':'none'});
		});
		var pausehover="<?php echo $sliderpauseonhover;?>";
		if(pausehover=="on"){
			jQuery("#huge_it_slideshow_image_container_videogallery_<?php echo $gallery_videoID; ?>, .huge_it_slideshow_image_container_videogallery_<?php echo $gallery_videoID; ?>, .huge_it_slideshow_dots_container_videogallery_<?php echo $gallery_videoID; ?>,#huge_it_slideshow_right_videogallery_<?php echo $gallery_videoID; ?>,#huge_it_slideshow_left_videogallery_<?php echo $gallery_videoID; ?>").hover(function(){
				window.clearInterval(huge_it_playInterval_videogallery_<?php echo $gallery_videoID; ?>);
			},function(){
				window.clearInterval(huge_it_playInterval_videogallery_<?php echo $gallery_videoID; ?>);
				play_videogallery_<?php echo $gallery_videoID; ?>();
			});
		}
		play_videogallery_<?php echo $gallery_videoID; ?>();
		jQuery('.huge_it_slideshow_image_wrap_videogallery_<?php echo $gallery_videoID; ?>').css('opacity','1');
	});

	function play_videogallery_<?php echo $gallery_videoID; ?>() {
		huge_it_playInterval_videogallery_<?php echo $gallery_videoID; ?> = setInterval(function () {
			var iterator = 1;
			huge_it_change_image_videogallery_<?php echo $gallery_videoID; ?>(parseInt(jQuery('#huge_it_current_image_key_videogallery_<?php echo $gallery_videoID; ?>').val()), (parseInt(jQuery('#huge_it_current_image_key_videogallery_<?php echo $gallery_videoID; ?>').val()) + iterator) % data_videogallery_<?php echo $gallery_videoID; ?>.length, data_videogallery_<?php echo $gallery_videoID; ?>,false,false);
		}, '<?php echo $slidepausetime; ?>');
	}

	jQuery(window).focus(function() {
		var i_videogallery_<?php echo $gallery_videoID; ?> = 0;
		jQuery(".huge_it_slider_videogallery_<?php echo $gallery_videoID; ?>").children("div").each(function () {
			if (jQuery(this).css('opacity') == 1) {
				jQuery("#huge_it_current_image_key_videogallery_<?php echo $gallery_videoID; ?>").val(i_videogallery_<?php echo $gallery_videoID; ?>);
			}
			i_videogallery_<?php echo $gallery_videoID; ?>++;
		});
	});
	jQuery(window).blur(function() {
		event_stack_videogallery_<?php echo $gallery_videoID; ?> = [];
		window.clearInterval(huge_it_playInterval_videogallery_<?php echo $gallery_videoID; ?>);
	});
</script>


<div class="huge_it_slideshow_image_wrap_videogallery_<?php echo $gallery_videoID; ?>" style="opacity: 0;">

	<?php
	$current_pos = 0;
	?>
	<div class="huge_it_slideshow_dots_container_videogallery_<?php echo $gallery_videoID; ?>">
		<div class="huge_it_slideshow_dots_thumbnails_videogallery_<?php echo $gallery_videoID; ?>">
			<?php
			$current_image_id=0;
			$current_pos =0;
			$current_key=0;
			$stri=0;
			foreach ($videos as $key => $video_row) {
				if ($video_row->id == $current_image_id) {
					$current_pos = $stri;
					$current_key = $stri;
				}
				?>
				<div id="huge_it_dots_<?php echo $stri; ?>_videogallery_<?php echo $gallery_videoID; ?>" class="huge_it_slideshow_dots_videogallery_<?php echo $gallery_videoID; ?> <?php echo (($key==$current_image_id) ? 'huge_it_slideshow_dots_active_videogallery_' . $gallery_videoID : 'huge_it_slideshow_dots_deactive_videogallery_' . $gallery_videoID); ?>" onclick="huge_it_change_image_videogallery_<?php echo $gallery_videoID; ?>(parseInt(jQuery('#huge_it_current_image_key_videogallery_<?php echo $gallery_videoID; ?>').val()), '<?php echo $stri; ?>', data_videogallery_<?php echo $gallery_videoID; ?>,false,true);return false;" data-image_id="<?php echo $video_row->id; ?>" data-image_key="<?php echo $stri; ?>"></div>
				<?php
				$stri++;
			}
			?>
		</div>

		<?php
		if ($gallery_video_get_option['gallery_video_slider_show_arrows']=="on") {
			?>
			<a id="huge_it_slideshow_left_videogallery_<?php echo $gallery_videoID; ?>" href="#" onclick="huge_it_change_image_videogallery_<?php echo $gallery_videoID; ?>(parseInt(jQuery('#huge_it_current_image_key_videogallery_<?php echo $gallery_videoID; ?>').val()), (parseInt(jQuery('#huge_it_current_image_key_videogallery_<?php echo $gallery_videoID; ?>').val()) - iterator_videogallery_<?php echo $gallery_videoID; ?>()) >= 0 ? (parseInt(jQuery('#huge_it_current_image_key_videogallery_<?php echo $gallery_videoID; ?>').val()) - iterator_videogallery_<?php echo $gallery_videoID; ?>()) % data_videogallery_<?php echo $gallery_videoID; ?>.length : data_videogallery_<?php echo $gallery_videoID; ?>.length - 1, data_videogallery_<?php echo $gallery_videoID; ?>,false,true);return false;">
				<div id="huge_it_slideshow_left-ico_videogallery_<?php echo $gallery_videoID; ?>">
					<div><i class="huge_it_slideshow_prev_btn_videogallery_<?php echo $gallery_videoID; ?> fa"></i></div></div>
			</a>

			<a id="huge_it_slideshow_right_videogallery_<?php echo $gallery_videoID; ?>" href="#" onclick="huge_it_change_image_videogallery_<?php echo $gallery_videoID; ?>(parseInt(jQuery('#huge_it_current_image_key_videogallery_<?php echo $gallery_videoID; ?>').val()), (parseInt(jQuery('#huge_it_current_image_key_videogallery_<?php echo $gallery_videoID; ?>').val()) + iterator_videogallery_<?php echo $gallery_videoID; ?>()) % data_videogallery_<?php echo $gallery_videoID; ?>.length, data_videogallery_<?php echo $gallery_videoID; ?>,false,true);return false;">
				<div id="huge_it_slideshow_right-ico_<?php echo $gallery_videoID;?>">
					<div><i class="huge_it_slideshow_next_btn_videogallery_<?php echo $gallery_videoID; ?> fa"></i></div></div>
			</a>
			<?php
		}
		?>
	</div>
	<script>


		jQuery(document).ready(function($) {

			jQuery('.thumb_wrapper').on('click', function(ev) {
				var hg_youtube_or_vimeo = jQuery(this).find(".playbutton");
				if(hg_youtube_or_vimeo.hasClass('vimeo-icon')){
					var hg_y_or_v = 'vimeo';
				}else if(hg_youtube_or_vimeo.hasClass('youtube-icon')){
					hg_y_or_v = 'youtube';
				}
				if( hg_y_or_v == "youtube") {
					var hugeid = jQuery(this).data('rowid');
					var myid = hugeid;
					myid = parseInt(myid);
					eval('player_'+myid+'.playVideo()')
					ev.preventDefault();
				}
				if( hg_y_or_v == "vimeo") {
					the_video_src = jQuery(this).parent().find("#thevideo iframe").attr("src");
					jQuery(this).parent().find("#thevideo iframe").attr('src', the_video_src + '&autoplay=1');
					jQuery(this).parent().find(".playbutton").css("display", "none");
				}
			});
		});
	</script>
	<div id="huge_it_slideshow_image_container_videogallery_<?php echo $gallery_videoID; ?>" class="huge_it_slideshow_image_container_videogallery_<?php echo $gallery_videoID; ?>">
		<div class="huge_it_slide_container_videogallery_<?php echo $gallery_videoID; ?>">
			<div class="huge_it_slide_bg_videogallery_<?php echo $gallery_videoID; ?>">
				<ul class="huge_it_slider_videogallery_<?php echo $gallery_videoID; ?>">
					<?php
					$i=0;
					foreach ($videos as $key => $video_row) {
						$video_thumb = $video_row->thumb_url;
						$videourl = $video_row->image_url;
						$icon = gallery_video_youtube_or_vimeo($videourl);
						?>
						<li  class="huge_it_slideshow_image<?php if ($i != $current_image_id) {$current_key = $key; echo '_second';} ?>_item_videogallery_<?php echo $gallery_videoID; ?>" id="image_id_videogallery_<?php echo $gallery_videoID.'_'.$i ?>" data-id="<?php echo $video_row->id; ?>">
							<?php
							if(strpos($video_row->image_url,'youtu') !== false){
								$video_thumb1 = gallery_video_get_video_id_from_url($video_row->image_url);
								$video_thumb_url=$video_thumb1[0];
								?>
                                <div id="thevideo" style="display: block;" class="thevideo" >
                                    <div id="video_id_videogallery_<?php echo $gallery_videoID;?>_<?php echo $key ;?>" class="huge_it_video_frame_videogallery_<?php echo $gallery_videoID; ?> framvideo"></div>
                                </div>
								<?php if($video_thumb != '' ):?>
									<div  class="thumb_wrapper" data-rowid="<?php echo $video_row->id; ?>" onclick="thevid=document.getElementById('thevideo'); thevid.style.display='block'; this.style.display='none'">
										<div class="playbutton hg_play_button <?php echo $icon; ?>-icon" data-id="<?php echo $video_row->id; ?>"></div>
										<img  src="<?php echo esc_attr($video_row->thumb_url); ?>">
									</div>
								<?php else : ?>
									<div class="thumb_wrapper" data-rowid="<?php echo $video_row->id; ?>" onclick="thevid=document.getElementById('thevideo'); thevid.style.display='block'; this.style.display='none'">
										<img  class="thumb_image" src="//i.ytimg.com/vi/<?php echo $video_thumb_url; ?>/hqdefault.jpg">
										<div class="playbutton <?php echo $icon;?>-icon"></div>
									</div>
								<?php endif;?>

							<?php }else {
								$vimeo = $video_row->image_url;
								$vimeo_explode = explode( "/", $vimeo );
								$imgid =  end($vimeo_explode);
								?>
                                <div id="thevideo" style="display: block;" class="thevideo">
                                    <iframe id="player_<?php echo $key ;?>"  class="huge_it_video_frame_videogallery_<?php echo $gallery_videoID; ?> framvideo vimeo" src="//player.vimeo.com/video/<?php echo $imgid; ?>?api=1&amp;player_id=player_<?php echo $key ;?>&amp;showinfo=0&amp;controls=0" style="border: 0;" allowfullscreen></iframe>
                                </div>
								<?php if($video_thumb != ''): ?>
									<div class="thumb_wrapper" data-rowid="<?php echo $video_row->id; ?>" onclick="thevid=document.getElementById('thevideo'); thevid.style.display='block'; this.style.display='none'">
										<div class="playbutton <?php echo $icon; ?>-icon"></div>
										<img  src="<?php echo esc_attr($video_row->thumb_url); ?>">
									</div>
								<?php else: ?>
								<div class="thumb_wrapper" data-rowid="<?php echo $video_row->id; ?>" onclick="thevid=document.getElementById('thevideo'); thevid.style.display='block'; this.style.display='none'">
									<div class="hg_play_button playbutton <?php echo $icon;?>-icon" data-id="<?php echo $video_row->id; ?>"></div>
								</div>
                                <?php endif;?>
							<?php }
							?>
						</li>
						<?php
						$i++;
					}
					?>
				</ul>
				<input type="hidden" id="huge_it_current_image_key_videogallery_<?php echo $gallery_videoID; ?>" value="0" />
			</div>
		</div>
	</div>
</div>