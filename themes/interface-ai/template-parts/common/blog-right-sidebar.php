<div class="c-sidebar">
    <div class="c-widget">
        <div class="c-subscribe">
            <h3 class="u-type-500 u-mb-8">Discover the Latest Insights on AI Solutions Newsletter</h3>
            <p class="u-type-500 u-mb-16">Join the newsletter to receive the latest updates in your inbox.</p>
            <div class="c-subscribe-form ">
                <?php echo do_shortcode('[newsletter]'); ?>
            </div>
            <!-- <form data-members-form="subscribe" class="c-subscribe-form ">
                <div class="form-group">
                    <label for="subscribe-email-sidebar" class="u-hidden-visually">Your email address</label>
                    <input type="email" name="email" class="c-subscribe-form__input" id="subscribe-email-sidebar" placeholder="Your email address" required="" data-members-email="">
                    <button type="submit" value="Subscribe" class="c-btn c-btn--small c-btn--action c-subscribe-form__btn">Subscribe</button>
                </div>
                <div class="c-alert c-alert--success">Please check your inbox and click the link to confirm your subscription.</div>
                <div class="c-alert c-alert--invalid">Please enter a valid email address!</div>
                <div class="c-alert c-alert--error">An error occurred, please try again later.</div>
            </form> -->
        </div>
    </div>
    <div class="c-widget">
    <ul class="c-social-icons o-plain-list">
        <li class="c-social-icons__item">
            <a href="https://twitter.com/interfaceAI" aria-label="Twitter" target="_blank" rel="noopener">
                <div class="icon icon--ei-sc-twitter icon--s c-social-icons__icon">
                <!-- <svg class="icon__cnt" width="0" height="0">
                    <use xlink:href="#ei-sc-twitter-icon"></use>
                </svg> -->
                    <i class="fa fa-twitter"></i>
                </div>
            </a>
        </li>
        <li class="c-social-icons__item">
            <a href="https://www.facebook.com/interfaceAI" aria-label="Facebook" target="_blank" rel="noopener">
                <div class="icon icon--ei-sc-facebook icon--s c-social-icons__icon">
                    <i class="fa fa-facebook"></i>
                </div>
            </a>
        </li>
    </ul>
    </div>
    <?php 
    $date_format = get_option( 'date_format' );
    $args = array(
        'meta_key' => 'feature_post',
        'meta_value' => '1',
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => -1
    );
    $featurePost = get_posts($args);
    // print_r($featurePost);
    ?>
    <?php if(!empty($featurePost)){ ?>
        <div class="c-widget">
            <div class="c-title-bar">
                <h3 class="c-title-bar__title">Featured Posts</h3>
            </div>
            <?php foreach($featurePost as $fp){ ?>
                <a href="<?php echo get_the_permalink($fp->ID); ?>" class="c-teaser">
                    <div class="c-teaser__content">
                        <h3 class="c-teaser__title"><?php echo $fp->post_title; ?></h3>
                        <time class="c-teaser__date" datetime="<?php echo $fp->post_date; ?>" title="<?php echo date($date_format, strtotime($fp->post_date)); ?>"><?php echo date($date_format, strtotime($fp->post_date)); ?></time>
                    </div>
                    <?php if(has_post_thumbnail($fp->ID)){ ?>
                        <div class="c-teaser__media">
                            <?php echo get_the_post_thumbnail($fp->ID, 'full', ['class'=>'c-teaser__image img-fluid']); ?>
                        </div>
                    <?php } ?>
                </a>
            <?php } ?>
        </div>
    <?php } ?>
    <?php
    $authors = get_users([
        'fields'  => ['ID', 'display_name'],
        'role'    => 'author',
        'orderby' => 'display_name',
    ]);
    if(!empty($authors)){
    ?>
        <div class="c-widget">
            <?php foreach($authors as $auth){ 
                $photo = get_field('photo', 'user_'. $auth->ID); ?>
                <a class="c-card-author-mini" href="<?php echo esc_url( get_author_posts_url( $auth->ID ) ); ?>">
                    <div class="c-card-author-mini__media">
                        <?php echo wp_get_attachment_image($photo, 'full', '', ['class'=>'img-fluid c-card-author-mini__image']); ?>
                    </div>
                    <div class="c-card-author-mini__content">
                        <h3 class="c-card-author-mini__name"><?php echo $auth->display_name; ?></h3>
                        <p class="c-card-author-mini__bio"><?php echo nl2br(get_the_author_meta('description', $auth->ID)); ?></p>
                    </div>
                </a>
            <?php } ?>
        </div>
    <?php } ?>
    <!-- <div class="blog-fixed-btn">
        <div class="gh-portal-triggerbtn-container with-label" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <svg id="Regular" viewBox="0 0 24 24" style="width: 26px; height: 26px; color: rgb(255, 255, 255);">
                <defs>
                <style>
                    .cls-1 {
                    fill: none;
                    stroke: currentColor;
                    stroke-linecap: round;
                    stroke-linejoin: round;
                    stroke-width: 0.8px;
                    }
                </style>
                </defs>
                    <circle class="cls-1" cx="12" cy="9.75" r="5.25"></circle>
                    <path class="cls-1" d="M18.913,20.876a9.746,9.746,0,0,0-13.826,0"></path>
                    <circle class="cls-1" cx="12" cy="12" r="11.25"></circle>
            </svg>
            <span class="gh-portal-triggerbtn-label"> Subscribe </span>
        </div> -->
    </div>

    <!-- Modal -->
    <!-- <div class="modal fade blog-modal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center border-0">
            <div class="modal-header position-absolute border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <img src="http://interface.verifinow.in/wp-content/uploads/2023/07/03-transparent.png" class="img-fluid" alt="">
                <h2 class="gh-portal-main-title">Log in to Discover the Latest Insights on Interactive Intelligence for Banking</h2>
                <div class="tnp tnp-subscription">
                    <form method="post" action="http://interface.verifinow.in/?na=s">
                        <label>Email</label>
                        <input type="hidden" name="nlang" value=""><div class="tnp-field tnp-field-email"><label for="tnp-3">Your email address</label>
                        <div class="form-group">
                            <input class="tnp-email c-subscribe-form__input" type="email" name="ne" id="tnp-3" placeholder="Your email address" value="" required>
                            <input class="tnp-submit c-btn" type="submit" value="Continue" >
                        </div>
                        
                    </form>
                    <div class="gh-portal-section">
                        <p class="gh-portal-invite-only-notification">This site is invite-only, contact the owner for access.</p>
                    </div>
                    <div class="d-flex blog-modal-footer">Don't have an account? 
                            <button class="blog-sign-up text-blue fw-700">Sign up</button>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    </div>
</div>