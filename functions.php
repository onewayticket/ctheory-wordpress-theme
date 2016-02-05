<?php 
	function twentyeleven_posted_on() {
	printf( __( '<span class="sep"></span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'twentyeleven' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'twentyeleven' ), get_the_author() ) ),
		get_the_author()
	);
}

add_filter('widget_text', 'do_shortcode');


// Custom function that reverses co-authors plugin output

function coauthors_wp_list_authors_reverse( $args = array() ) {
	global $coauthors_plus;

	$defaults = array(
		'optioncount'      => false,
		'show_fullname'    => true,
		'hide_empty'       => true,
		'feed'             => '',
		'feed_image'       => '',
		'feed_type'        => '',
		'echo'             => true,
		'style'            => 'list',
		'html'             => true,
		'number'           => 1000, // A sane limit to start to avoid breaking all the things
	);

	$args = wp_parse_args( $args, $defaults );
	$return = '';

	$term_args = array(
			'orderby'      => 'name',
			'hide_empty'   => 0,
			'number'       => (int)$args['number'],
		);
	$author_terms = get_terms( $coauthors_plus->coauthor_taxonomy, $term_args );
	$authors = array();
	foreach( $author_terms as $author_term ) {
		// Something's wrong in the state of Denmark
		if ( false === ( $coauthor = $coauthors_plus->get_coauthor_by( 'user_login', $author_term->name ) ) )
			continue;

		$authors[$author_term->name] = $coauthor;
	
		$authors[$author_term->name]->post_count = $author_term->count;
	}

	$authors = apply_filters( 'coauthors_wp_list_authors_array', $authors );

	foreach ( (array) $authors as $author ) {

		$link = '';

		if ( $args['show_fullname'] && ( $author->last_name && $author->first_name) )
			$name = "$author->last_name" . ", " . "$author->first_name";
		else
			$name = $author->display_name;


		if ( ! $args['html'] ) {
			if ( $author->post_count == 0 ) {
				if ( ! $args['hide_empty'] )
					$return .= $name . ', ';
			} else
				$return .= $name . ', ';

			// No need to go further to process HTML.
			continue;
		}

		if ( ! ( $author->post_count == 0 && $args['hide_empty'] ) && 'list' == $args['style'] )
			$return .= '<li>';
		if ( $author->post_count == 0 ) {
			if ( ! $args['hide_empty'] )
				$link = $name;
		} else {
			$link = '<a href="' . get_author_posts_url( $author->ID, $author->user_nicename ) . '" title="' . esc_attr( sprintf( __("Posts by %s", 'co-authors-plus' ), $name ) ) . '">' . esc_html( $name ) . '</a>';

			if ( (! empty( $args['feed_image'] ) ) || ( ! empty( $args['feed'] ) ) ) {
				$link .= ' ';
				if ( empty( $args['feed_image'] ) )
					$link .= '(';
				$link .= '<a href="' . get_author_feed_link( $author->ID ) . '"';

				if ( !empty( $args['feed'] ) ) {
					$title = ' title="' . esc_attr( $args['feed'] ) . '"';
					$alt = ' alt="' . esc_attr( $args['feed'] ) . '"';
					$name = $feed;
					$link .= $title;
				}

				$link .= '>';

				if ( ! empty( $args['feed_image'] ) )
					$link .= "<img src=\"" . esc_url( $args['feed_image'] ) . "\" style=\"border: none;\"$alt$title" . ' />';
				else
					$link .= $name;

				$link .= '</a>';

				if ( empty( $args['feed_image'] ) )
					$link .= ')';
			}

			if ( $args['optioncount'] )
				$link .= ' ('. $author->post_count . ')';

		}

		if ( ! ( $author->post_count == 0 && $args['hide_empty'] ) && 'list' == $args['style'] )
			$return .= $link . '</li>';
		else if ( ! $args['hide_empty'] )
			$return .= $link . ', ';
	}

	$return = trim( $return, ', ' );

	if ( ! $args['echo'] )
		return $return;
	echo $return;
}

function ctheory_list_authors() {
			
			// get all post IDs and store in array $postids
			
			$the_query = get_posts( 'posts_per_page=-1&fields=ids' );
			if($the_query){
				foreach($the_query as $id) {
					$postids[] = $id;
				}
			}
			
			
			// loop through $postids and store relevant author data (using coauthors function) in $authorlist
						
			foreach ($postids as $id) {

				$authors = get_coauthors($id);

					foreach ($authors as $auth) {
						
						
						//exclude CTheory Editor (only posts announcements)
						
						if ($auth->last_name != 'Editor') {
						
						$authorlist[] = array (
							"last_name" => $auth->last_name,
							"first_name" => $auth->first_name,
							"user_login" => $auth->user_login
						);
						
						}
						
					}
		
			}
			
			// delete duplicates
			
			$authorlist_nodups = array_unique($authorlist, SORT_REGULAR);
			
			// sort by last name, case insensitive
									
			function last_name_sort($a, $b) {
				return strnatcasecmp($a["last_name"], $b["last_name"]);
			}
			
			usort($authorlist_nodups, 'last_name_sort');
			
			// loop through each author and echo link to author page
									
			foreach ($authorlist_nodups as $list) {
				echo '<a href="' . get_home_url() . '/author/' . $list['user_login'] . '">' . $list['last_name'];
				
				// Check to see if there is a first name, don't echo the comma if it's a group/artist with only one name				
				if ($list['first_name'] == '') {
					echo '<br />';
				}
				
				else {
				  	echo ', ' . $list['first_name'] .'<br />';
				}
			
			}
}

add_filter( 'template_include', 'var_template_include', 1000 );
function var_template_include( $t ){
    $GLOBALS['current_theme_template'] = basename($t);
    return $t;
}

function get_current_template( $echo = false ) {
    if( !isset( $GLOBALS['current_theme_template'] ) )
        return false;
    if( $echo )
        echo $GLOBALS['current_theme_template'];
    else
        return $GLOBALS['current_theme_template'];
}

//php in widgets
function php_execute($html){
if(strpos($html,"<"."?php")!==false){ ob_start(); eval("?".">".$html);
$html=ob_get_contents();
ob_end_clean();
}
return $html;
}
add_filter('widget_text','php_execute',100);

//
?>