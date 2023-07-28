<?php
get_header();
?>
    <div class="c-site-container">
        <?php get_template_part('template-parts/common/blog', 'header'); ?>

        <main class="o-wrapper">
            <div class="o-grid">
                <div class="o-grid__col o-grid__col o-grid__col--center o-grid__col--9-10-m o-grid__col--2-3-l">
                    <?php if(is_tag()){
                        $tag = get_queried_object(); ?>
                        <div class="c-archive">
                            <h1 class="c-archive__title"><?php echo $tag->name; ?></h1>
                            <p class="c-archive__description">Unlocking the Future: Unleashing the Potential of Artificial Intelligence in Banking. Dive into the dynamic world of AI and its game-changing impact on the banking sector. From personalized customer experiences to fraud detection, witness how this groundbreaking technology is reshaping financial services for a smarter, more secure future.</p>
                        </div>
                    <?php } ?>
                    <?php if(is_author() ){ 
                        $author = get_queried_object();
                        $author_photo = $author_address = $author_name = $author_twitter = $author_fb = '';
                        if(!empty($author->ID)){ 
                            $author_photo = get_field('photo', 'user_'. $author->ID); 
                            $author_address = get_field('address', 'user_'. $author->ID); 
                            $author_name = get_the_author_meta( 'display_name', $author->ID );
                            $author_twitter = get_the_author_meta( 'twitter', $author->ID );
                            $author_fb = get_the_author_meta( 'facebook', $author->ID );
                        } ?>
                        <div class="c-author">
                            <div class="c-author__media">
                            <?php echo wp_get_attachment_image($author_photo, 'full', '', ['class'=>'img-fluid c-author__image']); ?>
                            </div>
                            <div class="c-author__content">
                                <h1 class="c-author__title"><?php echo $author_name; ?></h1>
                                <?php if(!empty($author->description)){ ?>
                                    <p class="c-author__bio"><?php echo $author->description; ?></p>
                                <?php } ?>
                                <ul class="o-plain-list c-author__links">
                                    <?php if(!empty($author_twitter)){ ?>
                                        <li class="c-author__links-item">
                                            <a href="<?php echo $author_twitter; ?>" aria-label="Twitter">
                                                <div class="icon icon--ei-sc-twitter icon--s c-author__links-icon">
                                                    <i class="fa fa-twitter"></i>
                                                </div>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(!empty($author_fb)){ ?>
                                        <li class="c-author__links-item">
                                            <a href="<?php echo $author_fb; ?>" aria-label="Facebook">
                                                <div class="icon icon--ei-sc-facebook icon--s c-author__links-icon">
                                                    <i class="fa fa-facebook"></i>
                                                </div>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <li class="c-author__links-item">
                                        <a href="<?php echo site_url(); ?>" aria-label="Website" target="_blank" rel="noopener">
                                            <div class="icon icon--ei-link icon--s c-author__links-icon">
                                                <i class="fa fa-link"></i>
                                            </div>
                                        </a>
                                    </li>
                                    <?php if(!empty($author_address)){ ?>
                                        <li class="c-author__links-item" aria-label="Location">
                                            <div class="icon icon--ei-location icon--s c-author__links-icon">
                                            <svg class="icon__cnt"><use xlink:href="#ei-location-icon"><svg id="ei-location-icon" viewBox="0 0 50 50"><path d="M25 42.5l-.8-.9C23.7 41.1 12 27.3 12 19c0-7.2 5.8-13 13-13s13 5.8 13 13c0 8.3-11.7 22.1-12.2 22.7l-.8.8zM25 8c-6.1 0-11 4.9-11 11 0 6.4 8.4 17.2 11 20.4 2.6-3.2 11-14 11-20.4 0-6.1-4.9-11-11-11z"></path><path d="M25 24c-2.8 0-5-2.2-5-5s2.2-5 5-5 5 2.2 5 5-2.2 5-5 5zm0-8c-1.7 0-3 1.3-3 3s1.3 3 3 3 3-1.3 3-3-1.3-3-3-3z"></path></svg></use></svg>
                                            </div>
                                            <?php echo $author_address; ?>
                                        </li>
                                    <?php } ?>
                                    <li class="c-author__links-item" aria-label="Posts">
                                        <div class="icon icon--ei-chart icon--s c-author__links-icon">
                                            <svg class="icon__cnt" id="ei-chart-icon" viewBox="0 0 50 50"><path d="M18 36h-2V26h-4v10h-2V24h8z"></path><path d="M28 36h-2V20h-4v16h-2V18h8z"></path><path d="M38 36h-2V14h-4v22h-2V12h8z"></path><path d="M8 36h32v2H8z"></path></svg>
                                        </div>
                                        <?php echo count_user_posts( $author->ID ); ?> Posts
                                    </li>
                                </ul>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="js-grid blog-posts-wrap">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php get_template_part( 'template-parts/parts/part', 'blog-item'); ?>
                        <?php endwhile; // end of the loop. ?>
                    </div>
                    <div class="o-grid__col o-grid__col--center o-grid__col--4-4-s o-grid__col--2-4-m o-grid__col--1-3-l">
                        <div class="c-pagination">
                            <button class="c-btn c-btn--outline c-btn--full js-load-posts blog_loadmore">More Posts</button>
                        </div>
                    </div>
                </div>
                <div class="o-grid__col o-grid__col o-grid__col--center o-grid__col--9-10-m o-grid__col--1-3-l">
                    <?php get_template_part('template-parts/common/blog', 'right-sidebar'); ?>
                </div>
            </div>
        </main>
    </div>
<?php
get_footer();
?>
<script>
var ajaxurl = "<?php echo admin_url( 'admin-ajax.php' ); ?>";
var posts = '<?php echo json_encode( $wp_query->query_vars ); ?>';
var current_page = "<?php echo get_query_var( 'paged' ) ? get_query_var('paged') : 1; ?>";
var max_page = "<?php echo $wp_query->max_num_pages; ?>";
jQuery(function($){ // use jQuery code inside this to avoid "$ is not defined" error
	$('.blog_loadmore').click(function(){
 
		var button = $(this),
		    data = {
			'action': 'interface_post_loadmore',
			'query': posts, // that's how we get params from wp_localize_script() function
			'page' : current_page
		};
 
		$.ajax({ // you can also use $.post here
			url : ajaxurl, // AJAX handler
			data : data,
			type : 'POST',
			beforeSend : function ( xhr ) {
				button.text('Loading...'); // change the button text, you can also add a preloader image
			},
			success : function( data ){
				if( data ) { 
					button.text( 'More Posts' ); // insert new posts
                    $('.blog-posts-wrap').append(data);
					current_page++;
 
					if ( current_page == max_page ) 
						button.remove(); // if last page, remove the button
 
					// you can also fire the "post-load" event here if you use a plugin that requires it
					// $( document.body ).trigger( 'post-load' );
				} else {
					button.remove(); // if no data, remove the button as well 
				}
			}
		});
	});
});
</script>
