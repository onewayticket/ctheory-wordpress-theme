<?php
/**
 * Template for displaying Category Archive pages
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

		<section id="primary">
			<div id="content" role="main">

				<?php

				$ctheory_category = get_the_category();
				
				echo "<h1 id=\"category-header\">" . $ctheory_category[0]->name . "</h1>";

				$args = array(
					'meta_key' 			=> 'Filename',	
					'orderby'  			=> 'meta_value',
					'order'   			=> 'DESC',
					'posts_per_page'	=> '-1',
					'category_name'		=> $ctheory_category[0]->name,
											'meta_query'		=> array (
													array(
													'key'	=> 'Book Chapter',
													'value'	=> 'True',
													'compare' => 'NOT EXISTS',
													),
												),
						 
				); 
				
				$the_query = new WP_Query( $args );
				
				while ( $the_query->have_posts() ) : $the_query->the_post(); 
				
				get_template_part('content', 'home');

				endwhile; 
				
				wp_reset_postdata();
								
				?>
				
		</div><!-- #content -->
		</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
