<?php
/**
 * Template for displaying Author Archive pages
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

		<section id="primary">
			<div id="content" role="main">

				<?php

				$ctheory_author_id = get_the_author_id();
				
				echo "<h1 id=\"author-header\">Articles by " . get_the_author() . "</h1>";
				
				$args = array(
					'posts_per_page'	=> '-1',
					'author'			=> $ctheory_author_id
				); 
				
				$the_query = new WP_Query( $args );
				
				while ( $the_query->have_posts() ) : $the_query->the_post(); 
				
				get_template_part('content', 'author');

				endwhile; 
				
				wp_reset_postdata();
								
				// end
				
				?>
				
		</div><!-- #content -->
		</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>