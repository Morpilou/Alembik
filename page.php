<?php get_header(); ?>

<section id="main-content">

	<?php 
		global $post;
		$post_slug = $post->post_name;
	?>

	<?php
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();

			// Displays the page's content
			echo the_content();

		} // end while
	} // end if
	?>

</section>

<?php get_footer(); ?>
