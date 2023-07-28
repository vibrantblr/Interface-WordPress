<?php
/*
Template Name: Press
*/
get_header();
global $post;
$acfDT = get_fields($post->ID);
$date_format = get_option( 'date_format' );
$press = get_posts(['post_type' => 'press', 'post_status' => 'publish', 'numberposts' => -1, 'orderby'=>'date', 'order', 'desc']);
?>
   <div class="top-spacing">
        <section class="banner-section call-to-speak press-section">
            <div class="container">
                <div class="position-relative">
                    <h1 class="h1 fw-800 mb-50"><?php the_title(); ?></h1>
                    <div class="press-img d-none d-lg-block position-absolute">
                        <?php the_post_thumbnail($post->ID, 'full', ['class'=>'img-fluid w-auto']) ?>
                    </div>
                    <?php if(!empty($press)){ ?>
                        <ul class="press-card-li list-inline">
                            <?php foreach($press as $news){ 
                                $newsACF = get_fields($news->ID); 
                                $featured_img_url = get_the_post_thumbnail_url($news->ID,'full');  ?>
                                <li class="press-card">
                                    <h6 class="press-card-title ibm fs-14 fst-italic fw-300 m-0"><?php echo date($date_format, strtotime($news->post_date)); ?></h6>
                                    <a class="news-link d-block" href="<?php echo $newsACF['external_link']; ?>">
                                        <h4 class="fs-28 ibm fst-italic fw-500  mt-2"><?php echo $news->post_title; ?></h4>
                                        <?php if(!empty($featured_img_url)){ ?>
                                            <img src="<?php echo $featured_img_url; ?>" alt="logo" class="img-fluid" <?php echo !empty($newsACF['logo_height']) ? 'style="max-height:'. $newsACF['logo_height'] .'px;"' : ''; ?> />
                                        <?php } ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </div>
            </div>
        </section>
    </div>
<?php
get_footer();
?>