<?php
/*
Template Name: Integration
*/
get_header();
global $post;
$acfDT = get_fields($post->ID);
?>
   <div class="top-spacing">
        <section class="banner-section text-white integration-section bg-blue position-relative">
            <div class="container">
                <div class="col-lg-6">
                    <h1 class="h1 fw-800 text-start mb-4 pb-3"><?php the_title(); ?></h1>
                    <?php the_content(); ?>
                </div>
                <div class="webinar-hero-img-wrap d-flex justify-content-center align-items-center">
                    <?php echo get_the_post_thumbnail($post->ID, 'full', ['class'=>'img-fluid h-auto']); ?>
                </div>
            </div>
        </section>
        <section class="intergraion-card div-overlay text-white bg-blue position-relative">
            <div class="position-relative">
                <div class="container">
                    <h2 class="ie-services-ai-section__title fw-800 text-yellow mb-3"><?php echo $acfDT['features_heading']; ?></h2>
                    <?php if(!empty($acfDT['features'])){ ?>
                        <ul class="intergraion-card-li d-lg-flex justify-content-lg-between ps-0 m-0">
                            <?php foreach($acfDT['features'] as $ft){ ?>
                                <li class="intergraion-card-single list-inline d-flex d-lg-block">
                                    <div class="intergraion-card-img bg-white d-flex justify-content-center align-items-center rounded-circle">
                                        <?php echo wp_get_attachment_image($ft['icon'], 'full', '', ['class'=>'img-fluid w-auto'])?>
                                    </div>
                                    <div class="intergraion-card-desc ms-4 ms-lg-0">
                                        <h2 class="fw-600 mt-0 mt-lg-5"><?php echo $ft['heading']; ?></h2>
                                        <h5 class="lh-15 mt-3 mt-lg-4 fw-400"><?php echo $ft['text']; ?></h5>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </div>
            </div>
        </section>
        <section class="integration-ecosystem bg-blue text-white">
            <h2 class="ecosystem-title text-blue fw-800 m-0 lh-15 text-center bg-yellow"><?php the_title(); ?></h2>
            <?php if(!empty($acfDT['tabs'])){ ?>
                <div class="integration-tab div-overlay position-relative">
                    <div class="container">
                        <div class="integration-tab-main d-lg-flex align-items-start position-relative">
                            <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <?php $i=1; foreach($acfDT['tabs'] as $tb){ ?>
                                    <button class="nav-link text-start rounded-0 p-4 <?php echo ($i==1) ? 'active' : ''; ?>" id="v-integration<?php echo $i; ?>-tab" data-bs-toggle="pill" data-bs-target="#v-integration<?php echo $i; ?>" type="button" role="tab" aria-controls="v-integration<?php echo $i; ?>" aria-selected="<?php echo ($i==1) ? 'true' : 'false'; ?>"><?php echo $tb['tab_name']; ?></button>
                                <?php $i++; } ?>
                            </div>
                            <div class="tab-content" id="v-pills-tabContent">
                                <?php $i=1; foreach($acfDT['tabs'] as $tb){ ?>
                                    <div class="tab-pane <?php echo ($i==1) ? 'show active' : ''; ?>" id="v-integration<?php echo $i; ?>" role="tabpanel" aria-labelledby="v-integration<?php echo $i; ?>-tab" tabindex="<?php echo $i-1; ?>">
                                        <div class="integration-tab-content ms-xl-2">
                                            <?php if(!empty($tb['cards'])){ ?>
                                                <div class="row row-cols-1 row-cols-lg-3 m-0">
                                                    <?php foreach($tb['cards'] as $card){ ?>
                                                        <div class="card integration-tab-card border-0 me-md-4 mb-4 p-0">
                                                            <div class="card-body bg-white p-0 d-flex justify-content-center align-items-center">
                                                                <?php echo wp_get_attachment_image($card['logo'], 'full', '', ['class'=>'img-gluid w-auto']); ?>
                                                            </div>
                                                            <div class="card-footer text-center d-flex justify-content-center align-items-center flex-column">
                                                                <h4 class="fs-14 lh-15 text-black mb-3"><?php echo $card['bold_text']; ?></h4>
                                                                <p class="lh-15 mb-0 text-black"><?php echo $card['light_text']; ?></p>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php $i++; } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </section>
    </div>
<?php
get_footer();
?>