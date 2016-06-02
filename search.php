<?php

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<h1 class="page-title">Search Results</h1>
		<?PHP

			get_template_part("parts/search/search");

		?></main><!-- .site-main -->
		<?php get_sidebar( 'sidebar-right' ); ?>
	</section><!-- .content-area -->

<?php get_footer(); ?>
