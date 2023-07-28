<?php
/*
Template Name: Call to speak
*/
get_header();
global $post;
// $acfDT = get_fields($post->ID);

$subPages = NULL;
if($post->post_parent){
    $subPages = get_posts(array(
        'post_type' => 'page',
        'post_parent' => $post->post_parent,
        'posts_per_page' => -1,
        'post_status' => 'publish'
    ));
}
?>
    <div class="top-spacing">
        <section class="banner-section call-to-speak bg-blue">
            <div class="container">
                <?php the_content(); ?>
            </div>
            <?php if(!empty($subPages)){ ?>
                <div class="theme-tab">
                    <div class="container">
                        <ul class="nav nav-tabs border-0 subpage-tabs" id="myTab" role="tablist">
                            <?php $i=0; foreach($subPages as $tb){ ?>
                                <li class="nav-item" role="presentation">
                                    <button data-href="<?php echo get_the_permalink($tb->ID); ?>" class="nav-link position-relative bg-transparent border-0 fs-18 p-0 text-white fw-600 <?php echo ($tb->ID==$post->ID) ? 'active' : ''; ?>" id="main-tab-<?php echo $i; ?>" data-bs-toggle="tab" data-bs-target="#main-tab-<?php echo $i; ?>-pane" type="button" role="tab" aria-controls="main-tab-<?php echo $i; ?>-pane" aria-selected="<?php echo ($tb->ID==$post->ID) ? 'true' : 'false'; ?>"><?php echo $tb->post_title; ?></button>
                                </li>
                            <?php $i++; } ?>
                        </ul>
                    </div>
                </div>
            <?php } ?>
            <div class="tab-content text-white" id="myTabContent">
                <?php $i=0; foreach($subPages as $tb){ 
                    $acfDT = get_fields($tb); ?>
                    <div class="tab-pane fade <?php echo ($tb->ID==$post->ID) ? 'show active' : ''; ?>" id="main-tab-<?php echo $i; ?>-pane" role="tabpanel" aria-labelledby="main-tab-<?php echo $i; ?>" tabindex="<?php echo $i-1; ?>">
                        <?php if($acfDT['select_tab'] == 'Try asking'){ ?>
                            <div class="tab-content-inner">
                                <div class="container">
                                    <!-- try asking -->
                                    <div class="try-asking">
                                        <ul class="list-inline d-flex justify-content-between">
                                            <?php foreach($acfDT['try_asking'] as $ta){ ?>
                                                <li>
                                                    <?php echo wp_get_attachment_image($ta['icon'], 'full', '', ['class'=>'img-fluid w-auto']); ?>
                                                    <h4 class="fw-400 ibm fst-italic fs-22 mt-5 pt-1 mb-4"><?php echo $ta['heading']; ?></h4>
                                                    <div class="cta-asking">
                                                        <div class="d-flex align-items-center">
                                                            <img src="<?php echo THEME_IMG; ?>/que-mark.svg" class="img-fluid" alt="img">
                                                            <span class="fs-12">Try Asking</span>
                                                        </div>
                                                        <p class="fs-18 ibm fst-italic text-yellow"><?php echo $ta['cursive_orange_text']; ?></p>
                                                    </div>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                        <p class="terms-condition-text text-white fw-500"><?php echo $acfDT['try_asking_note']; ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php }elseif($acfDT['select_tab'] == 'More questions to try'){ ?>
                            <div class="tab-content-inner">
                                <div class="container">
                                    <!-- More questions -->
                                    <div class="questions-tab d-md-flex align-items-start pt-5">
                                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                            <?php $j=1; foreach($acfDT['more_questions_to_try'] as $mt){ ?>
                                                <button class="nav-link text-start fs-12 <?php echo ($j==1) ? 'active' : ''; ?> " id="v-pills-que<?php echo $j; ?>-tab" data-bs-toggle="pill" data-bs-target="#v-pills-que<?php echo $j; ?>" type="button" role="tab" aria-controls="v-pills-que<?php echo $j; ?>" aria-selected="<?php echo ($j==1) ? 'true' : 'false'; ?>">
                                                <?php echo wp_get_attachment_image($mt['tab_icon'], 'full', '', ['class'=>'img-fluid w-auto me-3']); ?>
                                                    <?php echo $mt['tab_name']; ?>
                                                </button>
                                            <?php $j++; } ?>
                                        </div>
                                        <div class="tab-content bg-transparent" id="v-pills-tabContent">
                                            <?php $j=1; foreach($acfDT['more_questions_to_try'] as $mt){ ?>
                                                <div class="tab-pane fade <?php echo ($j==1) ? 'show active' : ''; ?>" id="v-pills-que<?php echo $j; ?>" role="tabpanel" aria-labelledby="v-pills-que<?php echo $j; ?>-tab" tabindex="<?php echo $j-1; ?>">
                                                    <div class="qta-content-wrap">
                                                        <?php echo $mt['questions']; ?>
                                                    </div>
                                                </div>
                                            <?php $j++; } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }elseif($acfDT['select_tab'] == 'Calculate ROI'){ ?>
                            <div class="tab-content-inner bg-white">
                                <?php echo do_shortcode('[roi_calculator]'); ?>
                            </div>
                        <?php } ?>
                    </div>
                <?php $i++; } ?>
            </div>
        </section>
    </div>
<?php
get_footer();
?>