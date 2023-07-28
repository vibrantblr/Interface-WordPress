<?php
/*
Template Name: Career
*/
get_header();
global $post;
$acfDT = get_fields($post->ID);
?>
    <!-- Hear from our employees -->
   <section class="ie-career-section">
      <div class="ie-career-derive-section ie-career-section--hero">
         <div class="container">
            <div class="row">
               <div class="col-lg-8">
                  <h1><?php the_title(); ?></h1>
               </div>
            </div>
         </div>
         <?php if(!empty($acfDT['testimonial'])){ ?>
            <section class="ie-section ie-case-study-section">
                <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <div class="ie-career-nav-slider" dir="ltr">
                                <?php foreach($acfDT['testimonial'] as $tm){ ?>
                                    <div>
                                        <div class="et-first-slider-item-wrap" tabindex="-1" style="width: 100%; display: inline-block;">
                                            <picture>
                                                <?php echo wp_get_attachment_image($tm['profile'], 'medium', '', ['class'=>'img-fluid']); ?>
                                            </picture>
                                            <h4><?php echo $tm['name']; ?></h4>
                                            <p class="mb-5"><?php echo $tm['designation']; ?></p>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="ie-career-for-slider et-second-slider-main-wrap ie-employee-mobile-img" dir="ltr">
                                <?php foreach($acfDT['testimonial'] as $tm){ ?>
                                    <div>
                                        <div class="et-second-slider-item-wrap ie-case-study-slider-quote" tabindex="-1" style="width: 100%; display: inline-block;">
                                            <p class="ie-desc"><?php echo $tm['quote']; ?></p>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </section>
         <?php } ?>
      </div>
      <?php if(!empty($acfDT['join_us_heading']) || !empty($acfDT['join_us_text']) || !empty($acfDT['join_us_cta_label'])){ ?>
        <div class="ie-section ie-career-ai-title-section">
            <div class="container">
                <div class="row">
                <div class="col-lg-6">
                    <h2><?php echo $acfDT['join_us_heading']; ?></h2>
                </div>
                <div class="col-lg-6">
                    <div class="ai-title-right-area">
                        <h5><?php echo $acfDT['join_us_text']; ?></h5>
                        <?php if(!empty($acfDT['join_us_cta_label'])){ ?>
                        <a class="button-module--primaryLink--2sXtv undefined" href="<?php echo $acfDT['join_us_cta_link']; ?>"><span><?php echo $acfDT['join_us_cta_label']; ?></span></a>
                        <?php } ?>
                        </div>
                </div>
                </div>
            </div>
        </div>
      <?php } ?>
      <?php if(!empty($acfDT['feature_section'])){ ?>
        <?php $j=1; $totaFtSec = count($acfDT['feature_section']); 
        foreach($acfDT['feature_section'] as $fs){ ?>
            <div class="ie-career-derive-section alternate-bg-section-wrapper ie-career-white-bg <?php echo ($j<$totaFtSec) ? 'mb-0' : ''; ?>">
                <div class="ie-career-section-extra-padding">
                    <div class="container">
                        <?php if(!empty($fs['features'])){ ?>
                            <div class="row">
                                <?php $i=1; foreach($fs['features'] as $ft){ ?>
                                    <div class="col-lg-6">
                                        <?php echo $i==1 ? '<h3>'. $fs['heading'] .'</h3>' : ''; ?>
                                        <div class="<?php echo ($j==1) ? '' : 'values-desc-area'; ?>">
                                            <h5><?php echo $ft['heading']; ?></h5>
                                            <p><?php echo $ft['text']; ?></p>
                                        </div>
                                    </div>
                                <?php $i++; } ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php $j++; } ?>
      <?php } ?>
      <?php if(!empty($acfDT['benefits_heading']) || !empty($acfDT['benefits'])){ ?>
        <div class="ie-career-derive-section ie-career-perks-benefits">
            <div class="container">
                <div class="row">
                <div class="col-lg-8">
                    <h3><?php echo $acfDT['benefits_heading']; ?></h3>
                </div>
                </div>
                <div class="row">
                    <?php foreach($acfDT['benefits'] as $ben){ ?>
                        <div class="col-lg-6">
                            <div class="values-desc-area">
                                <?php echo wp_get_attachment_image($ben['icon'], 'full', '', ['class'=>'img-fluid w-auto']); ?>
                                <div class="perks-text-area">
                                    <h5><?php echo $ben['heading']; ?></h5>
                                    <p><?php echo $ben['text']; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
      <?php } ?>
   </section>
   <script>
      jQuery(document).ready(function($) {
         $('.ie-career-for-slider').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            adaptiveHeight: true,
            asNavFor: '.ie-career-nav-slider',
            cssEase: 'linear'
         });
         $('.ie-career-nav-slider').slick({
            slidesToShow: 6,
            slidesToScroll: 1,
            asNavFor: '.ie-career-for-slider',
            dots: false,
            centerMode: false,
            focusOnSelect: true,
            infinite: true,
            responsive: [
               {
                  breakpoint: 1024,
                  settings: {
                     slidesToShow: 2
                  }
               },
               {
                  breakpoint: 480,
                  settings: {
                     slidesToShow: 1
                  }
               }
            ]
         });
      });
   </script>
<?php
get_footer();
?>