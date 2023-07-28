<?php
/**
 * Template part for displaying page content in single.php
 */
global $post;
$tags = get_the_tags($post->ID);
$date_format = get_option( 'date_format' );
$author_photo = $author_name = $author_twitter = '';
if(!empty($post->post_author)){ 
    $author_photo = get_field('photo', 'user_'. $post->post_author); 
    $author_name = get_the_author_meta( 'display_name', $post->post_author );
    $author_bio = get_the_author_meta( 'description', $post->post_author );
    $author_twitter = get_the_author_meta( 'twitter', $post->post_author );
}
// print_r($post);
// $acfDt = get_fields($post->ID);
?>
    
    <div class="c-site-container">
        <?php get_template_part('template-parts/common/blog', 'header'); ?>  
        <main class="o-wrapper">
            <div class="o-grid">
                <div class="o-grid__col o-grid__col o-grid__col--center o-grid__col--9-10-m o-grid__col--2-3-l">
                    <article class="c-post">
                        <?php if(has_post_thumbnail()){ ?>
                            <figure class="c-post-image-wrap">
                                <?php echo get_the_post_thumbnail($post->ID, 'full', ['class'=>'img-fluid c-post-image']); ?>
                            </figure>
                        <?php } ?>
                        <header class="c-post-header">
                            <h1 class="c-post-header__title"><?php the_title(); ?></h1>
                            <div class="c-post-header__meta"> 
                                <?php if(!empty($post->post_author)){  ?>
                                    <a href="<?php echo esc_url( get_author_posts_url( $post->post_author ) ); ?>" class="c-post-header__author">
                                        <div class="c-post-header__author_media">
                                            <?php echo wp_get_attachment_image($author_photo, 'full', '', ['class'=>'img-fluid c-post-header__author_image ']); ?>
                                        </div>
                                        <div class="c-post-header__author_info">
                                            <div class="c-post-header__author_name"><?php echo $author_name; ?></div>
                                            <time class="c-post-header__date" datetime="<?php echo $post->post_date; ?>" title="<?php echo date($date_format, strtotime($post->post_date)); ?>"><?php echo date($date_format, strtotime($post->post_date)); ?></time>
                                        </div>
                                    </a>
                                <?php } ?>
                                <?php $curUrl = get_the_permalink($post->ID); 
                                $thumbnailURL = get_the_post_thumbnail_url($post->ID); ?>
                                <ul class="c-share o-plain-list">
                                    <li class="c-share__item">
                                        <a class="c-share__link" title="Share on Twitter" aria-label="Share on Twitter" href="https://twitter.com/share?text=<?php echo esc_url($post->post_title); ?>&amp;url=<?php echo esc_url($curUrl); ?>" onclick="window.open(this.href, 'twitter-share', 'width=550, height=235'); return false;">
                                            <div class="icon icon--ei-sc-twitter icon--s c-share__icon"><i class="fa fa-twitter"></i></div>
                                        </a>
                                    </li>
                                    <li class="c-share__item">
                                        <a class="c-share__link" title="Share on Facebook" aria-label="Share on Facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url($curUrl); ?>" onclick="window.open(this.href, 'facebook-share', 'width=580, height=296'); return false;">
                                            <div class="icon icon--ei-sc-facebook icon--s c-share__icon"><i class="fa fa-facebook"></i></div>
                                        </a>
                                    </li>
                                    <li class="c-share__item">
                                        <a class="c-share__link" title="Share on LinkedIn" aria-label="Share on LinkedIn" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url($curUrl); ?>&amp;title=<?php echo esc_url($post->post_title); ?>" onclick="window.open(this.href, 'linkedin-share', 'width=580, height=296'); return false;">
                                            <div class="icon icon--ei-sc-linkedin icon--s c-share__icon"><i class="fa fa-linkedin"></i></div>
                                        </a>
                                    </li>
                                    <li class="c-share__item">
                                        <a class="c-share__link" title="Share on Pinterest" aria-label="Share on Pinterest" href="http://pinterest.com/pin/create/button/?url=<?php echo esc_url($curUrl); ?>&amp;media=<?php echo esc_url($thumbnailURL); ?>&amp;description=<?php echo esc_url($post->post_title); ?>" onclick="window.open(this.href, 'pinterest-share', 'width=580, height=296'); return false;">
                                            <div class="icon icon--ei-sc-pinterest icon--s c-share__icon"><i class="fa fa-pinterest"></i></div>
                                        </a>
                                    </li>
                                    <li class="c-share__item">
                                        <a class="c-share__link" title="Share via Email" aria-label="Share via Email" href="mailto:?subject=<?php echo esc_url($post->post_title); ?>&amp;body=<?php echo esc_url($curUrl); ?>">
                                            <div class="icon icon--ei-envelope icon--s c-share__icon"><i class="fa fa-envelope"></i></div>
                                        </a>
                                    </li>
                                    <li class="c-share__item">
                                        <a class="c-share__link js-share__link--clipboard" title="Link copied to clipboard" aria-label="Link copied to clipboard" data-clipboard-text="<?php echo esc_url($curUrl); ?>" >
                                            <div class="icon icon--ei-link icon--s c-share__icon"><i class="fa fa-link"></i></div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </header>
                        <section class="c-content">
                            <?php the_content(); ?>
                        </section>
                        <?php if(!empty($tags)){ ?>
                            <section class="c-tags">
                                <?php foreach($tags as $tag){ ?>
                                    <a href="<?php echo get_term_link($tag->term_id); ?>"><?php echo $tag->name; ?></a>
                                <?php } ?>
                            </section>
                        <?php } ?>
                        <?php if(!empty($post->post_author)){  ?>
                            <section class="c-card-author">
                                <div class="c-card-author__media">
                                    <a href="<?php echo esc_url( get_author_posts_url( $post->post_author ) ); ?>">
                                        <?php echo wp_get_attachment_image($author_photo, 'full', '', ['class'=>'img-fluid c-card-author__image']); ?>
                                    </a>
                                </div>
                                <div class="c-card-author__content">
                                    <h3 class="c-card-author__name">
                                        <a href="<?php echo esc_url( get_author_posts_url( $post->post_author ) ); ?>"><?php echo $author_name; ?></a>
                                        <?php if(!empty($author_twitter)){ ?>
                                            <a href="<?php echo $author_twitter; ?>" aria-label="Twitter">
                                                <div class="icon icon--ei-sc-twitter icon--s">
                                                    <i class="fa fa-twitter"></i>
                                                </div>
                                            </a>
                                        <?php } ?>
                                    </h3>
                                    <p class="c-card-author__bio"><?php echo $author_bio; ?></p>
                                </div>
                            </section>
                        <?php } ?>

                        <section class="c-subscribe c-subscribe--center d-none d-lg-block">
                            <h3 class="u-type-500 u-mb-8">Discover the Latest Insights on AI Solutions Newsletter</h3>
                            <p class="u-type-500 u-mb-16">Join the newsletter to receive the latest updates in your inbox.</p>
                            <div class="c-subscribe-form c-subscribe-form--compact">
                                <div class="tnp tnp-subscription">
                                    <form method="post" action="http://interface.verifinow.in/?na=s">
                                        <input type="hidden" name="nlang" value=""><div class="tnp-field tnp-field-email"><label for="tnp-3">Your email address</label>
                                        <div class="form-group">
                                            <input class="tnp-email c-subscribe-form__input" type="email" name="ne" id="tnp-3" placeholder="Your email address" value="" required>
                                            <input class="tnp-submit c-btn" type="submit" value="Subscribe" >
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- <form data-members-form="subscribe" class="c-subscribe-form c-subscribe-form--compact">
                                <div class="form-group">
                                <label for="subscribe-email-post" class="u-hidden-visually">Your email address</label>
                                <input type="email" name="email" class="c-subscribe-form__input" id="subscribe-email-post" placeholder="Your email address" required="" data-members-email="">
                                <button type="submit" value="Subscribe" class="c-btn c-btn--small c-btn--action c-subscribe-form__btn">Subscribe</button>
                                </div>
                                <div class="c-alert c-alert--success">Please check your inbox and click the link to confirm your subscription.</div>
                                <div class="c-alert c-alert--invalid">Please enter a valid email address!</div>
                                <div class="c-alert c-alert--error">An error occurred, please try again later.</div>
                            </form> -->
                        </section>
                        <hr>
                    </article>
                    <?php 
                    $tag_ids = array();
                    if(!empty($tags)){
                        foreach($tags as $tag){
                            $tag_ids[] = $tag->term_id;
                        }

                        $tag_posts = new WP_Query(
                            array(
                                'post__not_in' => array($post->ID),
                                'tag__in' => $tag_ids,
                                'posts_per_page' => 2,
                                'post_type' => array('post'),
                                'post_status' => 'publish',
								'orderby' => 'post_date',
								'order' => 'desc'
                            )
                        );
                        if( $tag_posts->have_posts() ) { ?>
                            <!-- Get related posts based on tags -->
                            <div class="c-related">
                                <div class="c-title-bar">
                                    <h3 class="c-title-bar__title">You might also like</h3>
                                </div>
                                <div class="js-grid">
                                    <?php while( $tag_posts->have_posts() ) { $tag_posts->the_post(); ?>
                                        <?php get_template_part( 'template-parts/parts/part', 'blog-item'); ?>
                                    <?php } wp_reset_postdata(); // end of the loop. ?>
                                </div>
                            </div>
                            <?php 
                        }
                    }
                    ?>
                    
                </div>
                <div class="o-grid__col o-grid__col o-grid__col--center o-grid__col--9-10-m o-grid__col--1-3-l">
                    <?php get_template_part('template-parts/common/blog', 'right-sidebar'); ?>
                </div>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.11/dist/clipboard.min.js"></script>
    <script>
        jQuery(document).ready(function(){
            jQuery('.js-share__link--clipboard').tooltip({
                trigger: 'click',
                placement: 'bottom'
            });
        })

        function setTooltip(btn, message) {
            jQuery(btn).tooltip('hide').attr('data-original-title', message).tooltip('show');
        }

        function hideTooltip(btn) {
            setTimeout(function() {
                jQuery(btn).tooltip('hide');
            }, 1000);
        }
        var clipboard = new ClipboardJS(".js-share__link--clipboard");

        clipboard.on("success", function (e) {
            e.clearSelection();
            setTooltip(e.trigger, 'Link copied to clipboard');
            hideTooltip(e.trigger);
        });

        clipboard.on("error", function (e) {
            setTooltip(e.trigger, 'Failed!');
            hideTooltip(e.trigger);
        });

    </script>