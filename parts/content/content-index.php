<article id="post-<?php the_ID(); ?>" <?php post_class("home-page"); ?>>
	<header class="entry-header">
		<h2 class="entry-title">
			<a href="<?PHP echo get_permalink(); ?>" rel="bookmark"><?PHP echo the_title(); ?></a>
		</h2>
		<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_content();
		?>
		</div><!-- .entry-content -->	
	</header><!-- .entry-header -->
</article><!-- #post-## -->