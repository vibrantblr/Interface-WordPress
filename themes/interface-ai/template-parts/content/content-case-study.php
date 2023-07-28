<?php
/**
 * Template part for displaying page content in single.php
 */
global $post;
$acfDt = get_fields($post->ID);
$other_cs = get_posts(['post_type'=>'case-studies', 'post_status'=>'publish', 'numberposts'=>-1, 'post_parent' => 0, 'exclude'=>[$post->ID]]);
?>
    <div class="case-study-content-wrapper">
        <?php if($post->post_parent != 0){?>
            <div class="cs-tab-navigate-back-wrapper">
                <a href="<?php echo get_the_permalink($post->post_parent); ?>">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCIgdmlld0JveD0iMCAwIDIwIDIwIj4KICAgIDxnIGZpbGw9Im5vbmUiIGZpbGwtcnVsZT0iZXZlbm9kZCI+CiAgICAgICAgPGcgZmlsbD0iIzAwMCIgZmlsbC1ydWxlPSJub256ZXJvIj4KICAgICAgICAgICAgPGc+CiAgICAgICAgICAgICAgICA8cGF0aCBkPSJNLjI4MyAxMC4yODNMMS40OCAxMS40OGMuMTU2LjE1Ni40MS4xNTYuNTY2IDBMOC43NSA0Ljc4N1YxOS42YzAgLjIyLjE4LjQuNC40aDEuN2MuMjIgMCAuNC0uMTguNC0uNFY0Ljc4N2w2LjY5MiA2LjcwNWMuMTU2LjE1Ny40MS4xNTcuNTY2IDBsMS4yMS0xLjIxYy4xNTUtLjE1NS4xNTUtLjQwOSAwLS41NjVMMTAgMCAuMjgzIDkuNzE3Yy0uMTU2LjE1Ni0uMTU2LjQxIDAgLjU2NnoiIHRyYW5zZm9ybT0idHJhbnNsYXRlKC0xNiAtNzApIHRyYW5zbGF0ZSgxNiA3MCkgcm90YXRlKC05MCAxMCAxMCkiLz4KICAgICAgICAgICAgPC9nPgogICAgICAgIDwvZz4KICAgIDwvZz4KPC9zdmc+Cg==" alt="Go Back">
                    <?php the_title(); ?>
                </a>
            </div>
        <?php } ?>
		<?php the_content(); ?>
		<!-- Other case study sections -->
        <?php if(!empty($other_cs)){ ?>
            <div class="ie-cs-section ie-other-cs-slider">
                <div class="container">
                    <h3 class="title title--md fw-800 text-white">Other Case Studies</h3>
                </div>
                <div class="ie-other-cs-slider-wrap">
                    <div class="other-cs-slider slider">
                        <?php foreach($other_cs as $cs){ 
                            $acfCS = get_fields($cs->ID); ?>
                            <div class="slide">
                                <div class="card ie-cs-card d-flex flex-column ie-cs-card--padding">
                                    <div class="ie-cs-card-header d-flex align-items-start align-items-lg-center">
                                        <div class="logo me-4">
                                            <?php echo get_the_post_thumbnail($cs->ID, 'full', ['class'=>'img-fluid w-auto']); ?>
                                        </div>
                                        <h4 class="title title--sm"><?php echo $cs->post_title; ?></h4>
                                    </div>
                                    <div class="ie-cs-card-body">
                                        <div class="ie-cs-statement">
                                            <div class="italic my-4 py-1"><?php echo get_the_excerpt($cs->ID); ?></div>
                                            <div class="ie-cs-author d-flex align-items-center">
                                                <div class="ie-cs-author-img mr-4">
                                                    <?php echo wp_get_attachment_image($acfCS['cs_author'], 'full', '', ['class'=>'img-fluid w-auto']); ?>
                                                </div>
                                                <div class="ie-cs-author-details d-flex flex-column justify-content-center">
                                                    <h4><?php echo $acfCS['cs_author_name']; ?></h4>
                                                    <p><?php echo $acfCS['cs_author_designation']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="<?php echo get_the_permalink($cs->ID); ?>" class="theme-btn theme-btn2">Read Case Study</a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
	</div>

    <script>
    jQuery(document).ready(function() {
        jQuery('.other-cs-slider').slick({
            dots: false,
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            // centerMode: true,
            centerMode: true,
            variableWidth: true,
            responsive: [{
                breakpoint: 991,
                settings: {
                    slidesToShow: 2,
                    centerMode: false,
                    variableWidth: false,
                }
                },
                {
                    breakpoint: 767,
                    settings: {
                        centerMode: true,
                        variableWidth: false,
                        slidesToShow: 1,
                        arrows: false,
                    }
                }
            ], 
        });
    });
</script>
