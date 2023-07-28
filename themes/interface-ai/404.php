<?php
/**
 * The template for displaying the 404 page
 */

get_header();
?>
<main>
	<section class="ie-section ie-404-page-wrapper">
		<div class="container">
			<div class="col-lg-12">
				<img src="<?php echo THEME_IMG; ?>404-img.svg" alt="404-image">
				<h1>PAGE NOT FOUND</h1>
				<p>The page you are looking for was moved , removed, renamed or might never existed.</p>
				<div class="ie-404-cta-wrapper">
				<div class="ie-404-home-btn"><a class="button-module--primaryLink--2sXtv undefined" href="/"><span>Home</span></a></div>
				</div>
			</div>
		</div>
	</section>
</main>
<?php
get_footer();