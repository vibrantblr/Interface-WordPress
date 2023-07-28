<?php 
if ( ! function_exists( 'interface_theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various
	 * WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme
	 * hook, which runs before the init hook. The init hook is too late
	 * for some features, such as indicating support post thumbnails.
	 */
	function interface_theme_setup() {

        /*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

        /**
         * Make theme available for translation.
         * Translations can be placed in the /languages/ directory.
         */
		//load_theme_textdomain( 'interface-theme', get_template_directory() . '/languages' );

		/**
		 * Add default posts and comments RSS feed links to <head>.
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Enable support for post thumbnails and featured images.
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Add support for two custom navigation menus.
		 */
		register_nav_menus( array(
			'primary'   => __( 'Primary Menu', 'interface-theme' ),
			'secondary' => __( 'Secondary Menu', 'interface-theme' ),
		) );

		/**
		 * Enable support for the following post formats:
		 * aside, gallery, quote, image, and video
		 */
		add_theme_support( 'post-formats', array( 'aside', 'gallery', 'quote', 'image', 'video' ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
	}
endif; // interface_theme_setup
add_action( 'after_setup_theme', 'interface_theme_setup' );

function interface_mce4_options($init) {

    $custom_colours = '
        "fdcd2d", "Orange",
    ';

    // build colour grid default+custom colors
    $init['textcolor_map'] = '['.$custom_colours.']';

    // change the number of rows in the grid if the number of colors changes
    // 8 swatches per row
    $init['textcolor_rows'] = 1;

    return $init;
}
add_filter('tiny_mce_before_init', 'interface_mce4_options');

// function interface_widgets_init() {

// 	register_sidebar( array(
// 		'name' => 'Global Widget',
// 		'id' => 'global_widget_area',
// 		'before_widget' => '<div>',
// 		'after_widget' => '</div>',
// 		'before_title' => '<h2 class="rounded pt-5">',
// 		'after_title' => '</h2>',
// 	) );

// }
// add_action( 'widgets_init', 'interface_widgets_init' );

// add_filter('nav_menu_css_class', function ($classes) {
// 	$classes[] = 'nav-item dropdown has-megamenu';
// 	return $classes;
// }, 10, 1);

function interface_mega_menu( $theme_location ) {
    if ( ($theme_location) && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location]) ) {

        $menu = get_term( $locations[$theme_location], 'nav_menu' );
        $menu_items = wp_get_nav_menu_items($menu->term_id);

		$main_menu_id = $menu->term_id;

        $menu_list = '';
        $bool = '';
		
		$menu_list .= '<ul class="navbar-nav w-100 ms-lg-auto mb-2 mb-lg-0">';
        foreach( $menu_items as $menu_item ) {
            if( $menu_item->menu_item_parent == 0 ) {

				$parent_class_menu = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $menu_item->classes ), $menu_item) ) );

                $parent = $menu_item->ID;

                $menu_array = array();
                foreach( $menu_items as $submenu ) {
                    if( $submenu->menu_item_parent == $parent ) {

                        $bool = true;
						$icon = get_field('menu_icon', $submenu);
                        $class = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $submenu->classes ), $submenu) ) );
                        $menu_array[] = '<li class="'. $class .'"><a class="nav-link text-white text-capitalize fs-14 fw-500 text-xl-center d-flex flex-column align-items-xl-center" href="' . $submenu->url . '">'. wp_get_attachment_image( $icon, "full", "", array( "class" => "img-fluid mt-3" ) ) .'<p class="mb-0 mt-xl-3">' . $submenu->title . '</p></a></li>' ."\n";
                    }
                }
                if( $bool == true && count( $menu_array ) > 0 ) {
					$menu_list .= '<li class="nav-item dropdown has-megamenu has-children">';
					$menu_list .= '<a class="nav-link text-white text-capitalize fw-400 fs-14 dropdown-toggle" href="' . $menu_item->url . '" data-bs-toggle="dropdown">' . $menu_item->title . '</a>';
					$menu_list .= '<div class="dropdown-menu megamenu py-xl-4 '. $parent_class_menu .'" role="menu">';
                    $menu_list .= '<ul class="mx-xl-auto p-0 list-inline d-flex justify-content-xl-center '. $parent_class_menu .'" id="sub-menu-item-'.$parent.'">' ."\n";
                    $menu_list .= implode( "\n", $menu_array );
                    $menu_list .= '</ul>' ."\n";
                    $menu_list .= '</div>' ."\n";
                    $menu_list .= '</li>' ."\n";


                } else {
                    $menu_list .= '<li class="nav-item dropdown has-megamenu"><a class="nav-link text-white text-capitalize fw-400 fs-14" href="' . $menu_item->url . '">' . $menu_item->title . '</a></li>' ."\n";
                }

            }
        }
		$menu_list .= '</ul>';

    } else {
        $menu_list = '<!-- no menu defined in location "'.$theme_location.'" -->';
    }

    echo $menu_list;
}

add_filter( 'nav_menu_link_attributes', function( $atts, $item, $args ) {
    $atts['class'] = 'nav-link';
    return $atts;
}, 10, 3);

//to create a theme settings page using ACF
add_action('acf/init', 'interface_theme_acf_op_init');
function interface_theme_acf_op_init()
{

	// Check function exists.
	if (function_exists('acf_add_options_page')) {

		// Register options page.
		$option_page = acf_add_options_page(array(
			'page_title'    => __('Theme General Settings'),
			'menu_title'    => __('Theme Settings'),
			'menu_slug'     => 'theme-general-settings',
			'capability'    => 'edit_posts',
			'redirect'      => false
		));
	}
}

if (!defined('THEME_DIR')) {
	define("THEME_DIR", get_template_directory());
}
if (!defined('THEME_DIR_URI')) {
	define("THEME_DIR_URI", get_template_directory_uri());
}
if (!defined('THEME_IMG')) {
	define("THEME_IMG", THEME_DIR_URI . "/assets/images/");
}
if (!defined('ST_DATE_FORMAT')) {
	$date_format = get_option('date_format');
	define("ST_DATE_FORMAT", $date_format);
}

add_action('wp_enqueue_scripts', 'load_interface_theme_frontend_scripts');
function load_interface_theme_frontend_scripts(){
	$theme_dir = THEME_DIR_URI;
	$post_id = get_the_ID();
	$elementor_page = get_post_meta( $post_id, '_elementor_edit_mode', true );

	wp_enqueue_style('bootstrap', $theme_dir . '/assets/css/bootstrap.min.css', true);

	wp_enqueue_script('bootstrap', $theme_dir . '/assets/js/bootstrap.bundle.min.js', '', '', true);
	wp_enqueue_script('scripts', $theme_dir . '/assets/js/scripts.js', array( 'jquery' ));
	wp_enqueue_script('outer', $theme_dir . '/assets/js/outer.js', '', '', true);

	// if ( (bool)$elementor_page ) {
	// 	if ( is_singular( 'case-studies' ) ){
	// 		wp_enqueue_style('slick', $theme_dir . '/assets/css/slick.css', true);
	// 		wp_enqueue_script('slick', $theme_dir . '/assets/js/slick.min.js', '', '', true);
	// 	}
	// }else{
		wp_enqueue_style('slick', $theme_dir . '/assets/css/slick.css', true);
		wp_enqueue_style('slick-theme', $theme_dir . '/assets/css/slick-theme.css', true);
		wp_enqueue_style('fontawesome', $theme_dir . '/assets/font-awesome/css/font-awesome.min.css', true);
		wp_enqueue_style('styles', $theme_dir . '/assets/css/styles.css', true);
		wp_enqueue_style('responsive', $theme_dir . '/assets/css/responsive.css', true);

		wp_enqueue_script('popper', $theme_dir . '/assets/js/popper.min.js', '', '', true);
		wp_enqueue_script('slick', $theme_dir . '/assets/js/slick.min.js', '', '', true);
		wp_enqueue_script('custom', $theme_dir . '/assets/js/custom.js', '', '', true);
	// }
	
	wp_enqueue_style('outer', $theme_dir . '/assets/css/outer.css', true);
	wp_enqueue_style('theme', $theme_dir . '/style.css', true);

	// $script_data = array( 'image_path' => THEME_IMG );
    // wp_localize_script(
    //     'interface-custom',
    //     'js_data',
    //     $script_data
    // );
}

function interface_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	$mimes['webp'] = 'image/webp';
	return $mimes;
}
add_filter('upload_mimes', 'interface_mime_types');

/* Custom Logo */
function interface_login_logo() {
	$logo = get_field('site_logo', 'option');
	if(!empty($logo)){
		echo '<style type="text/css">
		.login h1 a { background-image: url(' .wp_get_attachment_url($logo). ') !important;background-size: contain !important; width: 70% !important; }
		</style>';
	}
}
add_action('login_head', 'interface_login_logo');

function current_year_shortcode () {
	$year = date_i18n ('Y');
	return $year;
}
add_shortcode ('current_year', 'current_year_shortcode');

function interface_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'interface_excerpt_more' );

//set excerpt words length
function interface_excerpt_length( $length ) {
	return 33;
}
add_filter( 'excerpt_length', 'interface_excerpt_length', 999 );

function interface_roi_calculator_shortcode () {
	ob_start();
	$thmOptACF = get_fields('option');
	?>
	<div class="calculate-roi">
        <div class="container">
			<!-- ROI -->
			<?php if(!empty($thmOptACF['cal_roi_heading'])){ ?>
				<h2 class="h1 fw-800 text-center text-black"><?php echo $thmOptACF['cal_roi_heading']; ?></h2>
			<?php } ?>
			<div class="roi-calculator-wrapper text-theme d-xl-flex justify-content-start">
				<div class="roi-calculator-left-section">
					<form>  
						<div class="mb-5">
							<label class="fw-700 fs-16 mb-3 d-block"><?php echo $thmOptACF['cal_step_1_label']; ?></label>
							<input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" class="form-control" name="numCustomers" placeholder="Enter the Number of Customers" value="">
						</div>
						<div class="mb-5">
							<label class="fw-700 fs-16 mb-3 d-block"><?php echo $thmOptACF['cal_step_2_label']; ?></label>
							<input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" class="form-control roi-second-field-disable" name="estimatedCalls" placeholder="Will be auto calculated" value="">
							<span class="fs-12 fw-500 d-block mt-2"><?php echo $thmOptACF['cal_step_2_instruction']; ?></span>
						</div>
						<div class="mb-5">
							<label class="fw-700 fs-16 mb-3 d-block"><?php echo $thmOptACF['cal_step_3_label']; ?></label>
							<input type="button" id="calculateRoi" class="theme-btn fs-18 fw-600 calculate-roi-submit-btn submit-btn" value="<?php echo $thmOptACF['cal_step_3_cta_label']; ?>">
						</div>
					</form>
				</div>
				<div class="roi-calculator-right-section">
					<!-- before submit  -->
					<div class="roi-calculator-top d-md-flex justify-content-between">
						<div class="roi-calculator-top-single">
							<div class="roi-result-title d-flex">
								<?php echo wp_get_attachment_image($thmOptACF['cal_output1_icon'], 'full', '', ['class'=>'img-fluid w-auto']); ?>
								<h5 class="fs-22 fw-800 mb-3 ms-3 d-inline-block"><?php echo $thmOptACF['cal_output1_label']; ?></h5>
							</div>
							<h2 id="savingsOpportunity" class="bebas mt-2">$<span>0</span></h2>
						</div>
						<div class="roi-calculator-top-single">
							<div class="roi-result-title d-flex">
							<?php echo wp_get_attachment_image($thmOptACF['cal_output2_icon'], 'full', '', ['class'=>'img-fluid w-auto']); ?>
								<h5 class="fs-22 fw-800 mb-3 ms-3 d-inline-block"><?php echo $thmOptACF['cal_output2_label']; ?></h5>
							</div>
							<h2 id="newRevenueOpportunity" class="bebas mt-2">$<span>0</span></h2>
						</div>
					</div>
					<?php if(!empty($thmOptACF['cal_after_output_features'])){ ?>
						<div class="roi-show-more-details" id="roiFeaturesIncludes" style="display:none;">
							<ul class="roi-more-info-grid list-inline d-flex text-center justify-content-between">
								<?php foreach($thmOptACF['cal_after_output_features'] as $aof){ ?>
									<li>
										<div class="roi-feaure-icon <?php echo $aof['icon_color']; ?>">
											<img src="<?php echo $aof['icon']; ?>" class="img-fluid" alt="<?php echo $aof['label']; ?> icon" />
										</div>
										<h6 class="key-metrics-desc"><?php echo $aof['label']; ?></h6>
									</li>
								<?php } ?>
							</ul>
						</div>
					<?php } ?>
					<?php if(!empty($thmOptACF['cal_default_features'])){ ?>
						<ul class="roi-estimated-features d-flex p-0 list-inline">
							<?php foreach($thmOptACF['cal_default_features'] as $df){ ?>
								<li class="d-md-flex align-items-center fs-14 fw-500">
									<?php echo wp_get_attachment_image($df['icon'], 'full', '', ['class'=>'img-fluid me-2 w-auto']); ?>
									<span><?php echo $df['label']; ?></span>
								</li>
							<?php } ?>
						</ul>
					<?php } ?>
					<p class="roi-note fs-12 fw-500"><?php echo $thmOptACF['calculation_note']; ?></p>
				</div>
			</div>
		</div>
	</div>
	<script>
        jQuery(document).ready(function($){
            $('input[name=numCustomers]').on('input', function(){
                var elm = $(this);
                var numCustomersVal = elm.val();
                if( numCustomersVal != ''){
                    var formattedVal = numCustomersVal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ','); // Add commas
                    elm.val(formattedVal);
                    // Get the number of customers from the input field and remove commas
                    let numCustomers = parseInt(numCustomersVal.replace(/,/g, ''));
                    let estimatedCalls = parseInt($('input[name=estimatedCalls]').val().replace(/,/g, ''));
                    // Calculate estimated calls and round to the nearest whole number
                    let newEstimatedCalls = Math.round(numCustomers * 0.285).toLocaleString();
                    $('input[name=estimatedCalls]').val(newEstimatedCalls);
                }
            });
            $('#calculateRoi').on('click', function(){
                $('#newRevenueOpportunity, #savingsOpportunity').removeClass('text-black');
                $('#roiFeaturesIncludes').hide();
                // Get the number of customers from the input field and remove commas
                let numCustomers = parseInt($('input[name=numCustomers]').val().replace(/,/g, ''));
                let estimatedCalls = parseInt($('input[name=estimatedCalls]').val().replace(/,/g, ''));
                if(numCustomers != '' && estimatedCalls){
                    // Calculate savings opportunity and remove fractional digits
                    var savingsOpportunity = Math.floor(75.789 * estimatedCalls).toLocaleString();

                    // Calculate new revenue opportunity and remove fractional digits
                    var newRevenueOpportunity = Math.floor(313.541 * estimatedCalls).toLocaleString();

                    $('#savingsOpportunity span').text(savingsOpportunity);
                    $('#newRevenueOpportunity span').text(newRevenueOpportunity);

                    if(parseInt($('#savingsOpportunity span').text()) > 0 || parseInt($('#newRevenueOpportunity span').text()) > 0){
                        $('#savingsOpportunity').addClass('text-black');
                        $('#newRevenueOpportunity').addClass('text-black');
                        $('#roiFeaturesIncludes').show();
                    }
                }else{
                    $('#savingsOpportunity span').text('0');
                    $('#newRevenueOpportunity span').text('0');
                }
            });
        });
    </script>
	<?php
	return ob_get_clean();
}
add_shortcode ('roi_calculator', 'interface_roi_calculator_shortcode');

add_shortcode ('casestudy_news', 'interface_case_study_news_shortcode');
function interface_case_study_news_shortcode(){
	ob_start();
	$post_id = get_the_ID();
	$news = get_field('news', $post_id);
	if(!empty($news)){
		$date_format = get_option( 'date_format' );
		?>
		<div class="ie-cs-section ie-cs-section--in-the-news bg-white">
            <div class="container">
                <div class="cs-content-block">
                    <h3 class="title title--md fw-800">In the news</h3>
                    <div class="row my-5">
						<?php foreach($news as $ni){ 
							$newsACF = get_fields($ni->ID); 
							$featured_img_url = get_the_post_thumbnail_url($ni->ID,'full'); ?>
							<div class="col-md-4 in-the-news-wrap">
								<a class="ie-cs-in-the-news italic d-block" href="<?php echo $newsACF['external_link']; ?>">
									<img src="<?php echo $featured_img_url; ?>" class="img-fluid" alt="img">
									<p class="mb-0 fs-14 ibm fst-italic"><?php echo date($date_format, strtotime($ni->post_date)); ?></p>
									<h4 class="news-title"><?php echo $ni->post_title; ?></h4>
								</a>
							</div>
						<?php } ?>
                    </div>
                </div>
            </div>
        </div>
	<?php
	}
	return ob_get_clean();
}

//use same template for index.php and archive
add_filter( 'template_include', 'interface_archive_home_page_template', 99 );
function interface_archive_home_page_template( $template ) {
    if ( is_archive()) {
        $new_template = locate_template( array( 'index.php' ) );
        if ( '' != $new_template ) {
            return $new_template;
        }
    }

    return $template;
}

function interface_post_loadmore_ajax_handler(){
	// prepare our arguments for the query
	$args = json_decode( stripslashes( $_POST['query'] ), true );
	$args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
	$args['post_status'] = 'publish';
 
	// it is always better to use WP_Query but not here
	query_posts( $args );
	if( have_posts() ) :
 
		// run the loop
		while( have_posts() ): the_post();
			get_template_part( 'template-parts/parts/part', 'blog-item');
		endwhile;
 
	endif;
	die; // here we exit the script and even no wp_reset_query() required!
}

add_action('wp_ajax_interface_post_loadmore', 'interface_post_loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_interface_post_loadmore', 'interface_post_loadmore_ajax_handler'); // wp_ajax_nopriv_{action}

add_shortcode ('tabs_with_images', 'interface_tabs_with_images_shortcode');
function interface_tabs_with_images_shortcode(){
	ob_start();
	$post_id = get_the_ID();
	$tabs_heading = get_field('tabs_heading', $post_id);
	$tabs = get_field('tabs', $post_id);
	if(!empty($tabs_heading) || !empty($tabs)){
		?>
        <div class="solution-section-div positive-relative">
            <div class="container">
                <h3 class="elementor-heading-title text-white text-center fw-700"><?php echo $tabs_heading; ?></h3>
				<?php if(!empty($tabs)){ ?>
					<div class="solution-tab-main">
						<ul class="nav nav-tabs m-0" id="myTab" role="tablist">
							<?php $i=1; foreach($tabs as $tab){ ?>
								<li class="nav-item" role="presentation">
									<button class="nav-link d-flex w-100 flex-column align-items-center <?php echo ($i==1) ? 'active' : ''; ?>" id="sol-tab<?php echo $i; ?>-pill" data-bs-toggle="tab" data-bs-target="#sol-tab<?php echo $i; ?>-tab" type="button" role="tab" aria-controls="sol-tab<?php echo $i; ?>-tab" aria-selected="true">
										<?php echo wp_get_attachment_image($tab['tab_icon'], 'full', '', ['class'=>'img-fluid default-img']); ?>	
										<?php echo wp_get_attachment_image($tab['tab_icon_active'], 'full', '', ['class'=>'img-fluid active-img']); ?>	
										<span class="d-none d-lg-block"><?php echo $tab['tab_name']; ?></span>
									</button>
								</li>
							<?php $i++; } ?>
						</ul>
						<div class="tab-content" id="myTabContent">
							<?php $i=1; foreach($tabs as $tab){ ?>
								<div class="tab-pane fade <?php echo ($i==1) ? 'show active' : ''; ?>" id="sol-tab<?php echo $i; ?>-tab" role="tabpanel" aria-labelledby="sol-tab<?php echo $i; ?>-tab">
									<div class="container-fluid ie-gen-ai-features-tab-content">
										<div class="row">
											<div class="col-12 col-lg-6">
												<h4 class="ie-gen-ai-title-dark fw-700 text-blue"><?php echo $tab['tab_name']; ?></h4>
												<?php echo $tab['tab_content']; ?>
											</div>
											<div class="col-12 col-lg-6 text-center d-none d-lg-block">
												<?php echo wp_get_attachment_image($tab['content_image'], 'full', '', ['class'=>'img-fluid']); ?>	
											</div>
										</div>
									</div>
								</div>
							<?php $i++; } ?>
						</div>
					</div>
				<?php } ?>
            </div>
        </div>
	<?php
	 }
	return ob_get_clean();
}


add_shortcode ('slider_with_content', 'interface_slider_with_content_shortcode');
function interface_slider_with_content_shortcode(){
	ob_start();
	$post_id = get_the_ID();
	$slider_heading = get_field('slider_heading', $post_id);
	$slider = get_field('slider', $post_id);
	if(!empty($slider_heading) || !empty($slider)){
		?>
        <div class="solution-slider-div positive-relative">
            <div class="container pt-lg-4">
                <h3 class="elementor-heading-title text-white text-center fw-500 text-capitalize"><?php echo $slider_heading; ?></h3>
                <?php if(!empty($slider)){ ?>
					<div class="row justify-content-center pt-lg-5">
						<div class="col-11">
							<div class="solution-slider-main slider slick-slider">
								<?php foreach($slider as $slide){ ?>
									<div class="slide">
										<div class="slider-card">
											<?php echo wp_get_attachment_image($slide['icon'], 'full', '', ['class'=>'img-fluid']); ?>
											<h4 class="ie-gen-ai-slider-title fw-700"><?php echo $slide['title']; ?></h4>
											<p class="ie-gen-ai-slider-desc"><?php echo $slide['text']; ?></p>
										</div>
									</div> 
								<?php } ?>   
							</div>
						</div>
					</div>
				<?php } ?>
            </div>
        </div>
		<script>
			jQuery(document).ready(function($){
				contentwithslide();
				$(window).on('resize', function() {
					contentwithslide();
				});
			});
			function contentwithslide(){
				//if (jQuery(window).width()>767) {
                    jQuery('.solution-slider-main').slick({
                        dots: false,
                        infinite: false,
                        speed: 500,
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        autoplay: false,
                        autoplaySpeed: 5000,
                        arrows: true,
                        responsive: [{
                            breakpoint: 991,
                            settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2,
                            dots: true,
                            }
                        }, {
							breakpoint: 767,
							slidesToShow: 1,
							settings: "unslick"
						}]
                    });  
                //}
			}
		</script>
	<?php
	}
	return ob_get_clean();
}

add_shortcode ('homepage_webinar_section', 'homepage_webinar_section_shortcode');
function homepage_webinar_section_shortcode(){
	ob_start();
	$post_id = get_the_ID();
	$webHeading = get_field('webinar_heading', $post_id);
	$webinars = get_field('webinars', $post_id);
	if(!empty($webHeading) || !empty($webinars)){
		?>
		<div class="case-studies-section pt-5 pb-5">
		  <div class="container">
			  <div class="row justify-content-center mb-6">
				<div class="col-12 col-md-8 pt-4 customers-served-section-title"><?php echo $webHeading; ?></div>
			  </div>
			  <?php if(!empty($webinars)){ ?>
				<div class="case-studies-list justify-content-center row">
					<?php $i=1; foreach($webinars as $wb){ 
						$cleanedVideo = preg_replace("/\r|\n/", "", $wb['video']); ?>
						<div class="cs-item col-12 col-md-5">
							<div class="cs-banner">
								<div class="cs-banner-img-container">
									<div class="gatsby-image-wrapper gatsby-image-wrapper-constrained cs-banner-image">
										<?php echo wp_get_attachment_image($wb['thumbnail'], 'full', '', ['class'=>'img-fluid']); ?>
									</div>
								</div>
								<div class="cs-banner-title"><?php echo $wb['title']; ?></div>
							</div>
							<div class="cs-description"><?php echo $wb['text']; ?></div>
							<?php if(!empty($wb['stats'])){ ?>
								<div class="cs-impact">
									<div class="cs-impact-cards">
										<?php foreach($wb['stats'] as $stat){ ?>
											<div class="cs-impact-cards-item">
												<div class="cs-impact-cards-item-number"><?php echo $stat['title']; ?></div>
												<div class="cs-impact-cards-item-desc"><?php echo $stat['text']; ?></div>
											</div>
										<?php } ?>
									</div>
								</div>
							<?php } ?>
							<?php if(!empty($wb['video'])){ ?>
								<div class="row justify-content-center justify-content-md-start">
									<div class="col-8 col-md-12">
										<div class="ie-video-popup-trigger"><button data-bs-toggle="modal" data-bs-target="#csWebinar<?php echo $i; ?>" class="cs-watch">Watch the Webinar</button></div>
									</div>
								</div>
							<?php } ?>
						</div>
						<?php if(!empty($wb['video'])){ ?>
							<div class="modal fade" id="csWebinar<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="Weninar" aria-hidden="true">
								<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-body" style="font-size:0;line-height:0;"></div>
									</div>
								</div>
							</div>
						<?php } ?>
						<script>
						var html<?php echo $i; ?> = '<?php echo json_encode($cleanedVideo, JSON_NUMERIC_CHECK); ?>';
						var myModalEl<?php echo $i; ?> = document.getElementById('csWebinar<?php echo $i; ?>')
						myModalEl<?php echo $i; ?>.addEventListener('shown.bs.modal', function (event) {
							if(jQuery('#csWebinar<?php echo $i; ?> .modal-body').html() == ''){
								jQuery('#csWebinar<?php echo $i; ?> .modal-body').html(html<?php echo $i; ?>);
							}
						});
						</script>
					<?php $i++; } ?>
				</div>
			  <?php } ?>
		  </div>
		</div>
	<?php
	}
	return ob_get_clean();
}

//used on contact page
add_shortcode ('load_custom_form', 'load_custom_form_shortcode');
function load_custom_form_shortcode( $atts ){
	ob_start();
	$post_id = get_the_ID();
	$custom_form_script = get_field('custom_form_script', $post_id);
	if(!empty($custom_form_script)){
		if($atts['show_only_desktop']=='1'){
			 if(!wp_is_mobile()){
				?>
				<script src="//digital-assistants.interface-ai.com/js/forms2/js/forms2.min.js"></script>
				<?php echo $custom_form_script;
			 }
		}else{
			?>
			<script src="//digital-assistants.interface-ai.com/js/forms2/js/forms2.min.js"></script>
			<?php echo $custom_form_script;
		}
	}
	return ob_get_clean();
}

add_shortcode ('thankyou_slider_section', 'thankyou_slider_section_shortcode');
function thankyou_slider_section_shortcode(){
	ob_start();
	$post_id = get_the_ID();
	$testimonials = get_field('testimonials', $post_id);
	if(!empty($testimonials)){
		?>
		 <section class="case-study-section thankyou-cs bg-blue text-white">
                <div class="container">
                <h2 class="case-study_title text-center">What our customers are saying</h2>
                    <div class="case-study-slider slider">
						<?php foreach($testimonials as $tm){ ?>
							<div class="slide">
								<div class="row">
									<div class="col-lg-10 offset-md-2">
										<div class="case-study-single">
											<div class="d-flex align-items-center case-study-top">
												<div class="case-study-img">
													<?php echo wp_get_attachment_image($tm['logo'], 'full', '', ['class'=>'img-fluid']); ?>
												</div>
												<div class="case-study-right ms-4 ps-3 fs-18 mb-0">
													<h2 class="fw-700 mb-3"><?php echo $tm['company_name']; ?></h2>
													<p><?php echo $tm['company_text']; ?></p>
												</div>
											</div>
											<div class="case-study-quote  position-relative">
												<p class="ibm fst-italic fs-24"><?php echo $tm['message']; ?></p>
												<div class="slide-author d-flex align-items-center">
													<?php echo wp_get_attachment_image($tm['photo'], 'full', '', ['class'=>'img-fluid']); ?>
													<div class="author-info">
														<h6 class="fw-600"><?php echo $tm['name']; ?></h6>
														<p class="mb-0"><?php echo $tm['designation']; ?></p>
													</div>
												</div>
											</div>
											<?php if(!empty($tm['monthly_impact'])){ ?>
												<div class="monthly-impact d-none d-md-block">
													<h2 class="fs-24 mb-4 pb-1 fw-700">Monthly Impact </h2>
													<div class="ie-card_list d-flex flex-wrap">
														<?php $i=1; foreach($tm['monthly_impact'] as $mi){ 
															if($i==1){
																$cls = 'price';
															}elseif($i==2){
																$cls = 'time';
															}elseif($i==3){
																$cls = 'support';
															} ?>
															<div class="card me-4 me-lg-5 ie-card ie-card--curved ie-card--case-study-card">
																<div class="card-body">
																	<h2 class="fw-600 mb-0 <?php echo $cls; ?>"><?php echo $mi['numbers']; ?></h2>
																	<p class="ibm mb-0 fst-italic fw-600"><?php echo $mi['label']; ?></p>
																</div>
															</div>
														<?php $i++; } ?>
													</div>
												</div>
											<?php } ?>
											<?php if(!empty($tm['ctas'])){ ?>
												<div class="btn-grp mt-0 mt-md-5">
													<?php $i=1; foreach($tm['ctas'] as $cta){ ?>
														<?php if($i==1){ ?>
															<a href="<?php echo $cta['link']; ?>" class="theme-btn"><?php echo $cta['label']; ?></a>
														<?php }else{ ?>
															<a href="<?php echo $cta['link']; ?>" class="theme-btn theme-btn2 mt-4 mt-md-0 ms-md-4"><?php echo $cta['label']; ?></a>
														<?php } 
													$i++; } ?>
												</div>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
                    </div>
                </div>
            </section>
	<?php
	}
	return ob_get_clean();
}