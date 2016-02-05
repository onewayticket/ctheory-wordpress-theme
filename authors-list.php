<?php
/*
 *	Template Name: Authors List
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 */

get_header(); ?>

		<div id="primary">
			<div id="content" role="main">

			<?php 	while ( have_posts() ) : the_post(); 
				  	
				  	get_template_part( 'content', 'page' ); 
				  	

					
				  	endwhile; // end of the loop. ?>
	 	
				  				
				  	<div id="author-list">
			<?php	//in functions.php
					ctheory_list_authors(); ?>
				  	</div>
	 	
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
