<?php
global $post;
$date_format = get_option( 'date_format' );
$tags = wp_get_post_tags($post->ID);
$author_photo = $author_name = $author_twitter = '';
if(!empty($post->post_author)){ 
    $author_photo = get_field('photo', 'user_'. $post->post_author); 
    $author_name = get_the_author_meta( 'display_name', $post->post_author );
    $author_twitter = get_the_author_meta( 'twitter', $post->post_author );
}
?>
<div class="c-post-card js-post-card post">
    <?php if(has_post_thumbnail()){ ?>
        <div class="c-post-card__media">
            <div class="c-post-card__image-wrap">
                <?php echo get_the_post_thumbnail($post->ID, 'full', ['class'=>'img-fluid c-post-image']); ?>
            </div>
        </div>
    <?php } ?>
    <div class="c-post-card__content">
        <h2 class="c-post-card__title">
            <a href="<?php the_permalink(); ?>" class="c-post-card__url"><?php the_title(); ?></a>
            <div class="c-post-card__visibility c-post-card__visibility--public">
                <span class="paid">Paid</span>
                <span class="members">Members</span>
                <span class="public">Public</span>
            </div>
        </h2>
        <p class="c-post-card__excerpt"><?php the_excerpt(); ?></p>
        <div class="c-post-card__meta">
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
            <div class="c-post-card__tag">
                <?php if(!empty($tags)){ ?>
                    <a href="<?php echo get_tag_link( $tags[0]->term_id ); ?>"><?php echo $tags[0]->name; ?></a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>