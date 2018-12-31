<?php 

add_theme_support( 'post-thumbnails' ); //Для превью

if (class_exists('MultiPostThumbnails')) {
	new MultiPostThumbnails(
		array(
        'label' => 'Вторая картинка',
        'id' => 'feature-image-1',
        'post_type' => 'post'
        )
    );
    new MultiPostThumbnails(
        array(
            'label' => 'Третья картинка',
            'id' => 'feature-image-2',
            'post_type' => 'post'
        )
    );
    new MultiPostThumbnails(array(
        'label' => 'Четвертая картинка',
        'id' => 'feature-image-3',
        'post_type' => 'post'
        )
    );

}

## Удаляет "Рубрика: ", "Метка: " и т.д. из заголовка архива
add_filter('get_the_archive_title', function( $title ){
	return preg_replace('~^[^:]+: ~', '', $title );
});



function my_custom_login_logo(){
	echo '<style type="text/css">
	h1 a { background-image:url('.get_bloginfo('template_directory').'/img/logo-b.png) !important; width: auto !important;
    background-size: contain !important;
    height: 100px !important; }
	</style>';
}
add_action('login_head', 'my_custom_login_logo');


function register_my_widgets(){
	register_sidebar( array(
		'name' => "Левая боковая панель сайта",
		'id' => 'left-sidebar',
		'before_widget' => '',
		'after_widget'  => "\n",
		'description' => 'Эти виджеты будут показаны в левой колонке сайта',
		'before_title' => "<h3 class='title'>",
		'after_title' => '</h3>'
	));
	register_sidebar( array(
		'name' => "Заявка",
		'id' => 'zayav-sidebar',
		'before_widget' => '',
		'after_widget'  => "\n",
		'description' => 'Эти виджеты будут показаны в левой колонке сайта',
		'before_title' => "<h3 class='title'>",
		'after_title' => '</h3>'
	));
}

add_action( 'widgets_init', 'register_my_widgets' );
/**
 * Extended Walker class for use with the
 * Twitter Bootstrap toolkit Dropdown menus in Wordpress.
 * Edited to support n-levels submenu.
 * @author johnmegahan https://gist.github.com/1597994, Emanuele 'Tex' Tessore https://gist.github.com/3765640
 * @license CC BY 4.0 https://creativecommons.org/licenses/by/4.0/
 */
class BootstrapNavMenuWalker extends Walker_Nav_Menu {
	function start_lvl( &$output, $depth ) {
		$indent = str_repeat( "\t", $depth );
		$submenu = ($depth > 0) ? ' sub-menu' : '';
		$output	   .= "\n$indent<ul class=\"dropdown-menu$submenu depth_$depth\">\n";
	}
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$li_attributes = '';
		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		
		// managing divider: add divider class to an element to get a divider before it.
		$divider_class_position = array_search('divider', $classes);
		if($divider_class_position !== false){
			$output .= "<li class=\"divider\"></li>\n";
			unset($classes[$divider_class_position]);
		}
		
		$classes[] = ($args->has_children) ? 'dropdown' : '';
		$classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
		$classes[] = 'menu-item-' . $item->ID;
		if($depth && $args->has_children){
			$classes[] = 'dropdown-submenu';
		}
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
		$output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		$attributes .= ($args->has_children) 	    ? ' class="dropdown-toggle" data-toggle="dropdown"' : '';
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= ($depth == 0 && $args->has_children) ? ' <b class="caret"></b></a>' : '</a>';
		$item_output .= $args->after;
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	
	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
		//v($element);
		if ( !$element )
			return;
		$id_field = $this->db_fields['id'];
		//display this element
		if ( is_array( $args[0] ) )
			$args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );
		else if ( is_object( $args[0] ) )
			$args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
		$cb_args = array_merge( array(&$output, $element, $depth), $args);
		call_user_func_array(array(&$this, 'start_el'), $cb_args);
		$id = $element->$id_field;
		// descend only when the depth is right and there are childrens for this element
		if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {
			foreach( $children_elements[ $id ] as $child ){
				if ( !isset($newlevel) ) {
					$newlevel = true;
					//start the child delimiter
					$cb_args = array_merge( array(&$output, $depth), $args);
					call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
				}
				$this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
			}
			unset( $children_elements[ $id ] );
		}
		if ( isset($newlevel) && $newlevel ){
			//end the child delimiter
			$cb_args = array_merge( array(&$output, $depth), $args);
			call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
		}
		//end this element
		$cb_args = array_merge( array(&$output, $element, $depth), $args);
		call_user_func_array(array(&$this, 'end_el'), $cb_args);
	}
}

register_nav_menu('top-bar', __('Main'));

function theme_register_nav_menu() {
	register_nav_menu( 'footerMenu', 'footerMenu' );
}
add_action( 'after_setup_theme', 'theme_register_nav_menu' );


/** filter for search 
function SearchFilter($query) {
    if ($query->is_search) {
        $query->set('cat','4,8');
    }
    return $query;
}

add_action('pre_get_posts','SearchFilter');
*/

/** Пагинация */
	function wpbeginner_numeric_posts_nav($max_num_pages = 0) {

		/** Stop execution if there's only 1 page */
		if( $max_num_pages <= 1 )
		    return;
		$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;

		/** Add current page to the array */
		if ( $paged >= 1 )
		    $links[] = $paged;

		/** Add the pages around the current page to the array */
		if ( $paged >= 3 ) {
		    $links[] = $paged - 1;
		    $links[] = $paged - 2;
		}

		if ( ( $paged + 2 ) <= $max_num_pages ) {
		    $links[] = $paged + 2;
		    $links[] = $paged + 1;
		}
		echo '<nav aria-label="Page navigation">
		  		<ul class="pagination">' . "\n";

		/** Previous Post Link */
		/*if ( get_previous_posts_link() )
		    printf( '<li>%s</li>' . "\n", get_previous_posts_link() );*/

		/** Link to first page, plus ellipses if necessary */
		if ( ! in_array( 1, $links ) ) {
		    $class = 1 == $paged ? ' class="active"' : '';
		    printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
		    if ( ! in_array( 2, $links ) )
		        echo '<li>…</li>';
		}

		/** Link to current page, plus 2 pages in either direction if necessary */
		sort( $links );
		foreach ( (array) $links as $link ) {
		    $class = $paged == $link ? ' class="active"' : '';
		    printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
		}

		/** Link to last page, plus ellipses if necessary */
		if ( ! in_array( $max_num_pages, $links ) ) {
		    if ( ! in_array( $max_num_pages - 1, $links ) )
		        echo '<li>…</li>' . "\n";
		    $class = $paged == $max_num_pages ? ' class="active"' : '';
		    printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max_num_pages ) ), $max_num_pages );
		}

		/** Next Post Link */
		if ( get_next_posts_link() )
		    printf( '<li>%s</li>' . "\n", get_next_posts_link() );
		echo '</ul></nav>' . "\n";
		}

?>