<?php
/**
 * Main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 */

get_header(); ?>

		<div id="primary">
			<div id="content" role="main">
			TESTING
			<?php
				
				 
				// This excludes categories by ID from the homepage. 
				// New categories are displayed by default and can be sorted by the Taxonomy Order plugin
				$args = array(
						'exclude'  => '3,8,9,4,11,12,14,13,15');
					
				$categories = get_categories($args);	
				//var_dump($categories)
				
				foreach ($categories as $cat) {
				echo "<h1 id=\"category-header\">" . $cat->name . "</h1>";
				
				$args = array(
					'meta_key' 			=> 'Filename',	
					'orderby'  			=> 'meta_value',
					'order'   			=> 'DESC',
					'posts_per_page'	=> '-1',
					'category_name'		=> $cat->name
				); 
				
				$the_query = new WP_Query( $args );
				
				while ( $the_query->have_posts() ) : $the_query->the_post(); 
				
				get_template_part('content', 'home');

				endwhile; 
				
				wp_reset_postdata();
				
				// close foreach
				}
			
				?>	

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>