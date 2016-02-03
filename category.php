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
				
				query_posts('meta_key=Filename&orderby=meta_value&order=DESC&posts_per_page=-1&category_name='.$ctheory_category[0]->name);
				
				echo "<h1 id=\"category-header\">" . $ctheory_category[0]->name . "</h1>";

				get_template_part('content', 'home');	
				
				// end
				
				?>
				
		</div><!-- #content -->
		</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
