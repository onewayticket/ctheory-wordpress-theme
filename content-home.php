<?php 
			
				while ( have_posts() ) : the_post(); ?>
				
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h3 id="issue-date"><?php echo $meta = get_post_meta( get_the_ID(),'Filename', true) . " - "; 
						  the_time('n/j/Y') ?> <!-- by <?php the_author() ?> --></h3>
				<h2 id="post-<?php the_ID(); ?>" class="entry-title" > <a href="<?php the_permalink() ?>" rel="bookmark">
				<?php the_title(); ?></a></h2>
				<h3 id="post-author">
					<?php coauthors_posts_links(); ?>
					<!-- <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php 
											echo the_author_meta( 'first_name' );?> <?php
											echo the_author_meta( 'last_name' ); ?></a></h3>
											-->
				
				</article>
				
				<?php endwhile; 
					
				wp_reset_query(); ?>