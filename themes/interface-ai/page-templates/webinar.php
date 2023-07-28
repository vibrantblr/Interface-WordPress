<?php
/*
Template Name: Webinar
*/
get_header();
global $post;
$acfDT = get_fields($post->ID);
?>
   <main>
        <section class="ie-section od-hero-section-wrap ie-call-center-section revamped webinar-main-section partner-revamp-hero-section">
            <div class="">
                <div class="container">
                    <div class="row">
                    <div class="col-lg-6 col-md-6 text-center webinar-hero-img-wrap d-md-none d-lg-none od-hero-img-sm">
                        <?php the_post_thumbnail('full', ['class'=>'h-auto img-fluid']); ?>
                    </div>
                    <div class="col-lg-6 col-md-6 partner-integration-title-area">
                        <h1 class="primary-color"><?php the_title(); ?></h1>
                        <?php the_content(); ?>
                    </div>
                    <div class="col-lg-6 col-md-6 text-left d-none d-sm-none d-md-block d-lg-block od-hero-img-md">
                        <?php the_post_thumbnail('full', ['class'=>'h-auto img-fluid']); ?>
                    </div>
                    </div>
                </div>
            </div>
        </section>
        <?php if(!empty($acfDT['ft_web_video']) || !empty($acfDT['ft_web_heading']) || !empty($acfDT['ft_web_spk']) || !empty($acfDT['ft_web_spk_name']) || !empty($acfDT['ft_web_spk_desig'])){ ?>
            <section class="od-featured-webinar-section-wrap">
                <div class="container">
                    <div class="row od-bg-image full-circle">
                        <div class="col-md-12">
                            <h2>Featured Webinar</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        <div class="od-featured-media-wrapper">
                            <div class="od-featured-video-wrap" aria-describedby="popup-2">
                                <!-- <div class="od-popup-trigger"></div> -->
                                <?php echo $acfDT['ft_web_video']; ?>
                            </div>
                        </div>
                        <div class="od-feat-deatils-wrap">
                            <div class="od-feat-details-head">
                                <h5><?php echo $acfDT['ft_web_heading']; ?></h5>
                            </div>
                            <div class="od-feat-details-img-wrap">
                                <?php echo wp_get_attachment_image($acfDT['ft_web_spk'], 'full', '', ['class'=>'img-fluid w-auto']); ?>
                                <div class="od-feat-im-details">
                                    <h6><?php echo $acfDT['ft_web_spk_name']; ?></h6>
                                    <p><?php echo $acfDT['ft_web_spk_desig']; ?></p>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>
        <?php if(!empty($acfDT['list_of_webinars'])){ ?>
            <section class="od-featured-webinar-section-wrap bg-white list-of-webinar-section od-bg-image thick-circle">
                <div class="container od-list-of-webinar-title-wrapper">
                    <div class="row">
                        <div class="col-md-12 od-bg-image half-circle">
                        <h2>List of Webinars</h2>
                        </div>
                    </div>
                    <div class="row od-webinar-video-list-wrapper">
                        <?php foreach($acfDT['list_of_webinars'] as $wi){ ?>
                            <div class="col-sm-12 col-md-6 col-lg-6 video-list">
                                <div class="od-popup-trigger-wrap" aria-describedby="popup-3">
                                    <!-- <div class="od-popup-trigger"></div> -->
                                    <!-- <div style="width:100%;height:100%" class="on-demand-page-video" allow="autoplay; fullscreen" allowtransparency="true" frameborder="0" scrolling="no" name="wistia_embed">
                                        <div class="video-frame"> <span style="padding: 15px; display: block;">wistia video goes here...</span> </div>
                                    </div> -->
                                    <?php echo apply_filters('the_content', $wi->post_content); ?>
                                </div>
                                <div class="webinar-list-deatils">
                                    <h4><?php echo $wi->post_title; ?></h4>
                                    <h5 class="d-none d-md-none d-lg-block"><?php echo get_the_excerpt($wi->ID); ?></h5>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </section>
        <?php } ?>
    </main>
<?php
get_footer();
?>