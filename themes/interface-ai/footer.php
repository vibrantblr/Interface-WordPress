<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 */
 global $thmOptACF;
 $post_id = get_the_ID();
	?>
	</div><!-- wrapper-outer tag open in header.php -->
	<?php get_template_part('template-parts/common/right', 'side-form-canvas'); ?>
	<?php 
	$hide_footer_cta = false;
	$footer_cta_text = $thmOptACF['footer_cta_text'];
	$footer_cta_label = $thmOptACF['footer_cta_label'];
	$footer_cta_link = $thmOptACF['footer_cta_link'];
	if(!empty($post_id)){
		$override_footer_cta = get_field('override_footer_cta', $post_id);
		if($override_footer_cta){
			$hide_footer_cta = get_field('hide_footer_cta', $post_id);
			$footer_cta_text = get_field('footer_cta_text', $post_id);
			$footer_cta_label = get_field('footer_cta_label', $post_id);
			$footer_cta_link = get_field('footer_cta_link', $post_id);
		}
	}
	?>
	<footer class="site-footer position-relative <?php echo $hide_footer_cta ? 'ie-footer-page--careers' : ''; ?>">
		<?php if(!$hide_footer_cta){ ?>
			<?php if(!empty($footer_cta_text) || !empty($footer_cta_label)){ ?>
				<div class="footer-upgrade bg-yellow position-relative">
					<?php echo $footer_cta_text; ?>
					<button class="theme-btn" data-bs-toggle="offcanvas" data-bs-target="<?php echo $footer_cta_link; ?>" aria-controls="offcanvasRight" tabindex="-1"><?php echo $footer_cta_label; ?></button>
				</div>
			<?php } ?>
		<?php } ?>
		<div class="footer-bootom">
			<div class="container">
				<div class="row">
					<div class="col-lg-3">
						<div class="interface-logo">
							<?php echo $thmOptACF['footer_left_text']; ?>
						</div>
					</div>
					<!-- desktop footer list   -->
					<?php if(!empty($thmOptACF['footer_menu'])){ ?>
						<div class="col-lg-9 hide-mobile">
							<div class="row">
								<?php foreach($thmOptACF['footer_menu'] as $footer_menu){ ?>
									<div class="col-md-4 col-lg-3">
										<div class="footer-links">
											<h5 class="fw-700 mb-2"><?php echo $footer_menu['heading']; ?></h5>
											<ul class="list-inline m-0">
												<?php 
												if(!empty($footer_menu['menu'])){
													foreach($footer_menu['menu'] as $menu){ ?>
														<li>
															<a href="<?php echo $menu['link']; ?>" class="footer-link text-blue"><?php echo $menu['label']; ?></a>
														</li>
													<?php }
												} ?>
											</ul>
										</div>
									</div>
								<?php } ?>
							</div>
						</div>
					<?php } ?>
				</div>
				<?php if(!empty($thmOptACF['footer_menu'])){ ?>
					<!-- Mobile footer list   -->
					<div class="d-block d-md-none">
						<div class="footer-accordion accordion accordion-flush" id="accordionFooter">
							<?php $i=1; foreach($thmOptACF['footer_menu'] as $footer_menu){ ?>
								<div class="accordion-item">
									<h2 class="accordion-header" id="flush-heading<?php echo $i; ?>">
										<div class="fs-14 fw-700 accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?php echo $i; ?>"><?php echo $footer_menu['heading']; ?></div>
									</h2>
									<div id="flush-collapse<?php echo $i; ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?php echo $i; ?>" data-bs-parent="#accordionFooter">
										<div class="accordion-body p-0">
											<ul class="list-inline m-0">
												<?php 
													if(!empty($footer_menu['menu'])){
														foreach($footer_menu['menu'] as $menu){ ?>
															<li>
																<a href="<?php echo $menu['link']; ?>" class="footer-link text-blue"><?php echo $menu['label']; ?></a>
															</li>
													<?php }
												} ?>
											</ul>
										</div>
									</div>
								</div>
							<?php $i++; } ?>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
		<div class="footer-copyright position-relative py-3 text-center">
			<div class="container">
				<p class="mb-0 fs-12 text-blue"><?php echo do_shortcode($thmOptACF['copyright_text']); ?></p>
			</div>
			<div class="footer-cr-img position-absolute d-none d-lg-block">
				<img src="<?php echo THEME_IMG; ?>/copyright.svg" class="img-fluid" alt="copyright-illustration">
			</div>
		</div>
	</footer>
<?php wp_footer(); ?>
</body>
</html>