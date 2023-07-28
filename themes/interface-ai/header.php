<?php
/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 */

global $thmOptACF; 
$site_url = site_url(); 
$thmOptACF = get_fields('options');
$bodyCls = '';
if($thmOptACF['enable_top_bar']){
	$bodyCls = 'ie-layout-has-ribbon';
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="format-detection" content="telephone=no" />
	<?php 
	if(is_tax()){
		$term = get_queried_object();
		if(!empty($term)){
			$keywords = get_field('page_seo_keywords', $term);
		}
	}else{
	   	$id = get_the_ID();
		if(!empty($id)){
		   $keywords = get_field('page_seo_keywords', $id);
		} 
	}
	if(empty($keywords)){ 
		$keywords = get_field('default_seo_keywords', 'option');
	} 
	echo '<meta name="keywords" content="'. $keywords .'"/>';
	?>
	<?php wp_head(); ?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css">
</head>
<body <?php body_class($bodyCls); ?>>
<?php wp_body_open(); ?>
	<!-- Navbar -->
	<header class="fixed-top top-header bg-blue">
		<?php if($thmOptACF['enable_top_bar']){ ?>
			<!-- Ribbon Banner -->
			<div class="ie-ribbon-banner">
				<div class="ie-ribbon-banner-left">
					<a href="<?php echo $thmOptACF['topbar_btn_link']; ?>"><?php echo $thmOptACF['topbar_msg']; ?></a>
				</div>
				<div class="ie-ribbon-banner-right">
					<a href="<?php echo $thmOptACF['topbar_btn_link']; ?>" class="ie-ribbon-banner-cta"><?php echo $thmOptACF['topbar_btn_label']; ?></a>
				</div>
				<div class="ie-ribbon-banner-close-btn"><svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5.30322 5.65698L16.2634 16.6171" stroke="black" stroke-width="2" stroke-linecap="round"></path><path d="M5.30322 16.2634L16.2634 5.30327" stroke="black" stroke-width="2" stroke-linecap="round"></path></svg></div>
			</div>
		<?php } ?>
		<div class="container-fluid">
			<nav class="navbar position-static navbar-expand-xl main-menu py-0 justify-content-xl-between align-items-center" aria-label="Main navigation">
				<div class="header-left d-flex align-items-center">
					<a class="navbar-brand p-0 m-0" aria-label="Site Logo" href="<?php echo $site_url; ?>">
						<?php echo wp_get_attachment_image($thmOptACF['site_logo'], 'full', '', ['class'=>'img-fluid main-logo']); ?>
					</a>
					<div>
						<button class="navbar-toggler p-0 border-0  bg-transparent" type="button" data-toggle="offcanvas" aria-label="Toggle navigation">
							<div class="bar1"></div>
							<div class="bar2"></div>
							<div class="bar3"></div>
						</button>
					</div>
					<div class="navbar-collapse offcanvas-collapse primary-menu flex-xl-grow-0" id="navbarsExampleDefault">
						<?php echo interface_mega_menu("primary"); ?>
						<div class="header-right d-block d-xl-none align-items-center nav-item">
							<?php if(!empty($thmOptACF['top_right_lable'])){ ?>
								<a class="nav-link text-white text-capitalize fw-400 fs-14" href="<?php echo $thmOptACF['top_right_link']; ?>"><?php echo $thmOptACF['top_right_lable']; ?></a>
							<?php } ?>
							<?php if(!empty($thmOptACF['top_right_cta_label'])){ ?>
								<button class="offcanvas-btn bg-yellow border-0 fw-600" type="button" data-bs-toggle="offcanvas" data-bs-target="<?php echo $thmOptACF['top_right_cta_link']; ?>" aria-controls="offcanvasRight"><?php echo $thmOptACF['top_right_cta_label']; ?></button>
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="header-right d-none d-xl-flex align-items-center nav-item">
					<?php if(!empty($thmOptACF['top_right_lable'])){ ?>
						<a class="nav-link text-white text-capitalize fw-400 fs-14" href="<?php echo $thmOptACF['top_right_link']; ?>"><?php echo $thmOptACF['top_right_lable']; ?></a>
					<?php } ?>
					<?php if(!empty($thmOptACF['top_right_cta_label'])){ ?>
						<button class="offcanvas-btn bg-yellow border-0 fw-600" type="button" data-bs-toggle="offcanvas" data-bs-target="<?php echo $thmOptACF['top_right_cta_link']; ?>" aria-controls="offcanvasRight"><?php echo $thmOptACF['top_right_cta_label']; ?></button>
					<?php } ?>
				</div>
			</nav>
		</div>
	</header>
	<div class="wrapper-outer">