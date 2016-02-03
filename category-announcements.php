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

				$ctheory_category = 'Announcements';
				
				query_posts('order=DESC&posts_per_page=-1&category_name='.$ctheory_category);
				
				echo "<h1 id=\"category-header\">" . $ctheory_category . "</h1>";

				get_template_part('ctheory', 'announcements');	
				
				// end
				
				?>
				
		</div><!-- #content -->
		</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
