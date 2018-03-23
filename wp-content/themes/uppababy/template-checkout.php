<?php
/**
   Template Name: Checkout Page
*/

get_header();
?>

<div id="panels">
	<div id="content" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<div class="checkout-content entry-content">
				<?php the_content(); ?>
			</div><!-- .checkout-content -->

		<?php endwhile; // end of the loop. ?>

	</div><!-- #content -->
</div><!-- #panels -->

<?php get_footer(); ?>