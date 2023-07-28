<?php
/**
 * The template for displaying all single page
 */

get_header();
global $post;
$acf_data = get_fields($post->ID); 
?>
	<div class="default-content-wrapper">
		<?php
		/* Start the Loop */
		while ( have_posts() ) :
			the_post();
			
			the_content();

			// If comments are open or there is at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		endwhile; // End of the loop.
		?>
	</div>

<?php
get_footer();
