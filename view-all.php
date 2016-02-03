<?php
/*
 *	Template Name: View All
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 */

get_header(); ?>

		<div id="primary">
			<div id="content" role="main">
			<?php 
				
				
				$args = array(
						'exclude'  => '3');
					
				$categories = get_categories($args);	
				//var_dump($categories)
				
				foreach ($categories as $cat) {
				echo "<h1 id=\"category-header\">" . $cat->name . "</h1>";
				query_posts('meta_key=Filename&orderby=meta_value&order=DESC&posts_per_page=-1&category_name='.$cat->name);
				get_template_part('content', 'home');
				}
				?>
									
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
