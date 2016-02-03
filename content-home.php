<?php ?>				
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h3 id="issue-date"><?php echo $meta = get_post_meta( get_the_ID(),'Filename', true) . " - "; 
						  the_time('n/j/Y') ?></h3>
				<h2 id="post-<?php the_ID(); ?>" class="entry-title" > <a href="<?php the_permalink() ?>" rel="bookmark">
				<?php the_title(); ?></a></h2>
				<h3 id="post-author"><?php coauthors_posts_links(); ?></h3>
				</article>