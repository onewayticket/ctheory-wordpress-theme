<?php
/*
Template Name Posts: Book Chapter
*/

get_header(); ?>

		<div id="primary">
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<div class="share-links">
							<?php echo do_shortcode('[ssba]'); ?>
							
							</div>
								
						<header class="entry-header">
							<h1 class="entry-title"><?php the_title(); ?></h1>
					
							<?php if ( 'post' == get_post_type() ) : ?>
						
					
						
							<div class="entry-meta">
						
							<div class="entry-left">		
							
							<h3> <strong><?php $categories = get_the_category();
									
									echo esc_html( $categories[0]->name ); ?></strong>: 
									
									<?php   $meta = get_post_meta( get_the_ID(), 'Filename', true );
									echo $meta; ?>
							</h3>
							<h3> <strong>Date Published:</strong> <?php the_date('j/n/Y'); ?></h3>
							<h3><strong>Arthur and Marilouise Kroker, Editors</strong> </h3>
							
						
							</div> <!-- .entry-left -->
							<?php if(function_exists('pf_show_link')){echo pf_show_link();} ?>
						</div><!-- .entry-meta -->
						<?php endif; ?>
					</header><!-- .entry-header -->
					
					<div class="entry-content">
					
						<h2 class="issue-heading"><?php echo get_post_meta( get_the_ID(), 'Custom Category Heading', true ); ?></h2>		
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
					</div><!-- .entry-content -->
					
					<footer class="entry-meta">
					</footer><!-- .entry-meta -->
				</article>


				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>