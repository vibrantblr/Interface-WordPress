<?php
/*
Template Name: Homepage
*/
get_header();
global $post;
$acfDT = get_fields($post->ID);
?>
  <div class="">
    <?php if(!empty($acfDT['slides']) || !empty($acfDT['slider_bottom_logo'])){ ?>
      <section class="slider-section bg-blue">
          <div class="container position-relative">
              <?php if(!empty($acfDT['slides'])){ ?>
                <div class="home-slider slider">
                    <?php foreach($acfDT['slides'] as $slide){ ?>
                      <div class="slide">
                          <div class="single-slide">
                              <div class="row">
                                  <div class="col-md-7 d-flex align-items-center">
                                      <div class="slide-left text-white">
                                          <?php if(!empty($slide['intro_text'])){ ?>
                                            <h3 class="fw-300 h3 mb-0"><?php echo $slide['intro_text']; ?></h3>
                                          <?php } ?>
                                          <?php if(!empty($slide['primary_heading'])){ ?>
                                            <h2 class="h1 slide-title fw-700"><?php echo $slide['primary_heading']; ?></h2>
                                          <?php } ?>
                                          <?php if(!empty($slide['secondary_heading'])){ ?>
                                            <h3 class="slide-sub-title fw-500"><?php echo $slide['secondary_heading']; ?></h3>
                                          <?php } ?>
                                          <?php if(!empty($slide['orange_text'])){ ?>
                                            <h2 class="h1 slide-title fw-700 text-yellow"><?php echo $slide['orange_text']; ?></h2>
                                          <?php } ?>
                                          <?php if(!empty($slide['cursive_text'])){ ?>
                                            <p class="ibm fst-italic fs-24  my-4 py-3 py-md-2"><?php echo $slide['cursive_text']; ?></p>
                                          <?php } ?>
                                          <?php if(!empty($slide['profile']) || !empty($slide['name']) || !empty($slide['designation'])){ ?>
                                            <div class="slide-author d-flex align-items-center">
                                              <?php echo wp_get_attachment_image($slide['profile'], 'full', '', ['class'=>'img-fluid']); ?>
                                                <div class="author-info">
                                                    <h6 class="fw-600 text-yellow"><?php echo $slide['name']; ?></h6>
                                                    <p class="mb-0"><?php echo $slide['designation']; ?></p>
                                                </div>
                                            </div>
                                          <?php } ?>
                                          <?php if(!empty($slide['ctas'])){ ?>
                                            <div class="btn-grp">
                                                <?php if(count($slide['ctas']) == 1){ 
                                                    if($slide['ctas'][0]['link']=='#offcanvasRight'){ ?>
                                                      <button class="theme-btn" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><?php echo $slide['ctas'][0]['label']; ?></button>
                                                    <?php }else{ ?>
                                                      <a href="<?php echo $slide['ctas'][0]['link']; ?>" class="theme-btn"><?php echo $slide['ctas'][0]['label']; ?></a>
                                                    <?php } ?>
                                                <?php }else{ 
                                                  foreach($slide['ctas'] as $cta){ 
                                                    if($cta['link']=='#offcanvasRight'){ ?>
                                                      <button class="theme-btn" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><?php echo $cta['label']; ?></button>
                                                    <?php }else{ ?>
                                                      <a href="<?php echo $cta['link']; ?>" class="theme-btn theme-btn2 mt-4 mt-xl-0 ms-xl-4"><?php echo $cta['label']; ?></a>
                                                    <?php }
                                                  } 
                                                } ?>
                                            </div>
                                          <?php } ?>
                                      </div>
                                  </div>
                                  <div class="col-md-5 d-flex align-items-center justify-content-center">
                                      <div class="slide-right text-center d-none d-md-block">
                                          <?php echo wp_get_attachment_image($slide['right_illustration'], 'full', '', ['class'=>'img-fluid w-auto']); ?>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                    <?php } ?>
                </div>
              <?php } ?>
              <?php if(!empty($acfDT['slider_bottom_logo'])){ ?>
                <div class="slider-bottom position-absolute">
                    <span class="slider-bottom-logos-label">Awards</span>
                    <ul class="d-flex p-0 list-inline align-items-center">
                        <?php foreach($acfDT['slider_bottom_logo'] as $slidelogo){ ?>
                          <li>
                              <?php echo wp_get_attachment_image($slidelogo, 'full', '', ['class'=>'img-fluid w-auto']); ?>
                          </li>
                        <?php } ?>
                    </ul>
                </div>
              <?php } ?>
          </div>
      </section>
    <?php } ?>
    <?php if(!empty($acfDT['video_heading']) || !empty($acfDT['video_subheading'])){ ?>
      <section class="video-section text-center">
            <div class="container">
                <h3 class="fw-700"><?php echo $acfDT['video_heading']; ?></h3>
                <p class="ibm mb-0"><?php echo $acfDT['video_subheading']; ?></p>
                
                <script src="https://fast.wistia.com/embed/medias/ckvxkw0p66.jsonp" async></script>
                <script src="https://fast.wistia.com/assets/external/E-v1.js" async></script>
                <div class="video-div position-relative">
                    
                    <div class="wistia_responsive_padding" style="padding:56.04% 0 0 0;position:relative;">
                        
                        <div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;">
                            <div class="video-play position-absolute">
                                <div class="video-play-animation"></div>
                                <div class="video-play-animation has-delay-short"></div>
                                <svg height="30px" width="30px" fill="#111">
                                    <polygon class="triangle" points="5,0 30,15 5,30" viewBox="0 0 30 15"></polygon>
                                    <path class="path" d="M5,0 L30,15 L5,30z" fill="#111" stroke="#111" stroke-width="1"></path>
                                </svg>
                            </div>
                            <span class="video-custom-cls wistia_embed wistia_async_ckvxkw0p66 popover=true popoverAnimateThumbnail=true videoFoam=true" style="display:inline-block;height:100%;position:relative;width:100%">
                            </span>
                        </div>
                    </div>
                </div>
            </div>
      </section>
    <?php } ?>
    <div class="home-content-wrap">
      <?php the_content(); ?>
    </div>
    <?php if(!empty($acfDT['trusted_by']) || !empty($acfDT['companies'])){ ?>
      <section class="client-logo-section text-center">
          <div class="container">
              <h2 class="fw-700 logo-header pt-4 mb-5"><?php echo $acfDT['trusted_by']; ?></h2>
              <div class="client-logo-slider slider">
                  <?php foreach($acfDT['companies'] as $comp){ ?>
                    <div class="slide">
                      <?php echo wp_get_attachment_image($comp, 'full', '', ['class'=>'img-fluid w-auto mx-auto']); ?>
                    </div>
                  <?php } ?>
              </div>
          </div>
      </section>
    <?php } ?>
    <?php if(!empty($acfDT['case_studies'])){ ?>
      <section class="case-study-section bg-blue text-white">
          <div class="container">
              <div class="case-study-slider slider">
                  <?php foreach($acfDT['case_studies'] as $cs){ ?>
                    <div class="slide">
                        <div class="row">
                            <div class="col-lg-10 offset-md-2">
                                <div class="case-study-single">
                                    <div class="d-flex align-items-center case-study-top">
                                        <div class="case-study-img">
                                          <?php echo wp_get_attachment_image($cs['logo'], 'full', '', ['class'=>'img-fluid w-auto']); ?>
                                        </div>
                                        <div class="case-study-right ms-4 ps-3 fs-18 mb-0">
                                            <h2 class="fw-700 mb-3"><?php echo $cs['heading']; ?></h2>
                                            <p><?php echo $cs['sub_heading']; ?></p>
                                        </div>
                                    </div>
                                    <div class="case-study-quote  position-relative">
                                        <p class="ibm fst-italic fs-24"><?php echo $cs['quote']; ?></p>
                                        <div class="slide-author d-flex align-items-center">
                                            <?php echo wp_get_attachment_image($cs['profile'], 'full', '', ['class'=>'img-fluid w-auto']); ?>
                                            <div class="author-info">
                                                <h6 class="fw-600"><?php echo $cs['name']; ?></h6>
                                                <p class="mb-0"><?php echo $cs['designation']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if(!empty($cs['monthly_impact'])){ ?>
                                      <div class="monthly-impact d-none d-md-block">
                                          <h2 class="fs-24 mb-4 pb-1 fw-700">Monthly Impact </h2>
                                          <div class="ie-card_list d-flex flex-wrap">
                                            <?php $m=1; foreach($cs['monthly_impact'] as $mi){ 
                                              if($m==1){
                                                $cls = 'price';
                                              }elseif($m==2){
                                                $cls = 'time';
                                              }else{
                                                $cls = 'support';
                                              } ?>
                                              <div class="card me-4 me-lg-5 ie-card ie-card--curved ie-card--case-study-card">
                                                  <div class="card-body">
                                                      <h2 class="fw-600 mb-0 <?php echo $cls; ?>"><?php echo $mi['number']; ?><span><?php echo $mi['unit']; ?></span></h2>
                                                      <p class="ibm mb-0 fst-italic fw-600"><?php echo $mi['label']; ?></p>
                                                  </div>
                                              </div>
                                            <?php $m++; } ?>
                                          </div>
                                      </div>
                                    <?php } ?>
                                    <?php if(!empty($cs['ctas'])){ ?>
                                      <div class="btn-grp mt-5">
                                          <?php $c=1; foreach($cs['ctas'] as $cta){ ?>
                                            <a href="<?php echo $cta['link']; ?>" class="theme-btn <?php echo ($c!=1) ? 'theme-btn2 mt-4 mt-md-0 ms-md-4' : ''; ?>"><?php echo $cta['label']; ?></a>
                                          <?php $c++; } ?>
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
    <?php } ?>
    <?php if(!empty($acfDT['solution_primary_heading']) || !empty($acfDT['solution_secondary_heading']) || !empty($acfDT['solution_cards'])){ ?>
      <section class="solution-section bg-blue text-white">
          <div class="container no-padding">
              <div class="row">
                  <div class="col-lg-7 solution-top" >
                      <h2 class="fw-700 solution-title ps-md-5 ps-lg-0 ms-md-4 ms-lg-0"><?php echo $acfDT['solution_primary_heading']; ?></h2>
                  </div>
                  <div class="col-lg-5 fw-300 ibm fs-28 ps-md-5 ps-lg-0 ms-md-4 ms-lg-0 solution-top">
                      <p class="ms-lg-5"><?php echo $acfDT['solution_secondary_heading']; ?></p>
                  </div>
              </div>
              <?php if(!empty($acfDT['solution_cards'])){ ?>
                <div class="sol-card-wrap d-block d-lg-flex flex-wrap justify-content-between text-black">
                    <?php foreach($acfDT['solution_cards'] as $sc){ ?>
                      <div class="sol-card-single">
                          <div class="sol-card-single-inner bg-white d-flex flex-column justify-content-between">
                              <div class="sol-card-top">
                                  <h4 class="fw-800"><?php echo $sc['heading']; ?></h4>
                                  <p class="ibm fs-18 fw-300 text-black"><?php echo $sc['text']; ?></p>
                                  <?php if(!empty($sc['stats'])){ ?>
                                  <ul class="list-inline d-none d-lg-flex flex-wrap justify-content-between">
                                    <?php foreach($sc['stats'] as $stat){ ?>
                                      <li class="mt-5 pt-1">
                                          <h2 class="sol-card-num mb-0 bebas"><?php echo $stat['number']; ?></h2>
                                          <div class="fw-200 fs-16 sol-card-desc pe-5"><?php echo $stat['text']; ?></div>
                                      </li>
                                    <?php } ?>
                                  </ul>
                                  <?php } ?>
                              </div>
                              <div class="sol-card-footer mt-3">
                                  <div class="sol-footer-main d-flex justify-content-between align-items-end">
                                    <?php if(!empty($sc['cta_url'])){ ?>
                                      <div class="sol-card-btn">
                                          <a href="<?php echo $sc['cta_url']; ?>" class="theme-btn theme-btn2">Learn More</a>
                                      </div>
                                    <?php } ?>
                                      <div class="sol-card-img">
                                        <?php echo wp_get_attachment_image($sc['illustration'], 'full', '', ['class'=>'img-fluid m-auto']); ?>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                    <?php } ?>
                </div>
              <?php } ?>
          </div>
      </section>
    <?php } ?>
    <?php if(!empty($acfDT['featured_in_heading']) || !empty($acfDT['logo'])){ ?>
      <section class="feature-section client-logo-section">
          <div class="container">
              <h2 class="fw-700 logo-header pt-4 mb-5 text-center text-lg-start"><?php echo $acfDT['featured_in_heading']; ?></h2>
              <div class="client-logo-slider slider">
                  <?php foreach($acfDT['logo'] as $logo){ ?>
                    <div class="slide">
                        <?php echo wp_get_attachment_image($logo, 'full', '', ['class'=>'img-fluid w-auto mx-auto']); ?>
                    </div>
                  <?php } ?>
              </div>
          </div>
      </section>
    <?php } ?>
    <?php if(!empty($acfDT['platform_primary_heading']) || !empty($acfDT['platform_secondary_heading']) || !empty($acfDT['platform_features'])){ ?>
      <section class="platform-section bg-blue text-white">
          <div class="container">
              <div class="row">
                  <div class="col-md-6">
                      <h2 class="fw-700 platform-title"><?php echo $acfDT['platform_primary_heading']; ?></h2>
                  </div>
                  <div class="col-md-6 fw-300 ibm fs-28">
                      <p class="sol-p ms-md-5 ps-md-4"><?php echo $acfDT['platform_secondary_heading']; ?></p>
                  </div>
              </div>
              <div class="plateform-listing">
                  <div class="row">
                      <?php foreach($acfDT['platform_features'] as $pf){ ?>
                        <div class="col-6 col-lg-3">
                            <div class="single-plateform text-md-center">
                                <div class="platform-img rounded-circle d-flex justify-content-center align-items-center mx-md-auto bg-white">
                                    <?php echo wp_get_attachment_image($pf['icon'], 'full', '', ['class'=>'img-fluid w-auto']); ?>
                                </div>
                                <div class="platform-desc">
                                    <h5 class="fw-800 fs-24 mb-3"><?php echo $pf['heading']; ?></h5>
                                    <p class="fs-18 fw-500 ibm mb-0 fst-italic"><?php echo $pf['text']; ?></p>
                                </div>
                            </div>
                        </div>
                      <?php } ?>
                  </div>
              </div>
          </div>
      </section>
    <?php } ?>
</div>
<?php get_footer(); ?>