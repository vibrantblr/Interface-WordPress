<?php
/*
Template Name: Media
*/
get_header();
global $post;
$acfDT = get_fields($post->ID);
$media_type = get_terms( array(
    'taxonomy'   => 'media-type',
    'hide_empty' => false,
) );
$media = get_posts(['post_type' => 'media-resources', 'post_status' => 'publish', 'numberposts' => -1,]);
?>
   <main>
        <section class="ie-section ie-section--media ie-media-section-wrapper">
            <div class="container" style="position:relative">
                <span class="ie-press_image">
                    <?php the_post_thumbnail($post->ID, 'full', ['class'=>'w-auto img-fluid']); ?>
                </span>
                <h1 class="ie-press__title"><?php the_title(); ?></h1>
                <div class="media-filter-button-wrapper">
                    <div class="form-group">
                        <label class="form-label" for="typeOfMedia">Type of media</label>
                        <div class="dropdown">
                            <button id="dropdown-basic" class="dropdown-toggle btn btn-success" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                All Types
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" data-href="all">All Types</a></li>
                                <?php foreach($media_type as $type){ ?>
                                    <li><a class="dropdown-item" data-href="<?php echo $type->slug; ?>"><?php echo $type->name; ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="categoryOfMedia">Select media</label>
                        <div class="dropdown">
                            <button id="cat-of-media-dd-wrap" class="dropdown-toggle btn btn-success" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Select All
                            </button>
                            <ul class="dropdown-menu" id="postItemsFilterList">
                                <li class="default-item"><a class="dropdown-item" data-href="all">Select All</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php if(!empty($media)){ ?>
                    <ul class="ie-press__list">
                        <?php foreach($media as $mi){ 
                            $miACF = get_fields($mi->ID); 
                            $mTypeList = get_the_terms( $mi->ID, 'media-type'); 
                            $mType = join(', ', wp_list_pluck($mTypeList, 'slug')); ?>
                            <li m-type="<?php echo $mType; ?>" filter-name="<?php echo $miACF['filter_label']; ?>" filter-slug="<?php echo $miACF['slug']; ?>">
                                <div class="ie-press-card">
                                    <span class="ie-press-card__date"><?php echo $miACF['date_label']; ?></span>
                                    <a class="ie-news-link">
                                        <h4 class="ie-press-card__title"><?php echo $mi->post_title; ?></h4>
                                        <?php echo apply_filters('the_content', $mi->post_content); ?>
                                        <!-- <div class="wistia_responsive_padding ie-wistia-video" style="padding: 56.25% 0px 0px; position: relative;">
                                            <div class="wistia_responsive_wrapper" style="height: 100%; left: 0px; position: absolute; top: 0px; width: 100%;">
                                            <div class="video-frame"> <span style="padding: 15px; display: block;"></span> </div>
                                        </div> 
                                        </div>-->
                                    </a>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } ?>
                <script src="https://fast.wistia.net/assets/external/E-v1.js" async=""></script>
            </div>
        </section>
    </main>
<?php
get_footer();
?>
<script>
    jQuery(window).on("load", function(){
        //if url parameters are available 
        var type = getUrlParameter('type');
        var category = getUrlParameter('category');
        if(type != false){
            $('#dropdown-basic + .dropdown-menu a[data-href='+ type +']').trigger('click');
        }
        if(category != false){
            $('#cat-of-media-dd-wrap + .dropdown-menu a[data-href='+ category +']').trigger('click');
        }
    })
    jQuery(document).ready(function($){
        //type filter
        $('#dropdown-basic + .dropdown-menu a').on('click', function(){
            var elm = $(this);
            var slug = elm.attr('data-href');
            $('#postItemsFilterList .default-item a').trigger('click');//rollback next filter to default item
            $('#dropdown-basic').text(elm.text()).attr('data-href', slug);
            if(slug == 'all'){
                $('.ie-press__list li').show();
            }else{
                $('.ie-press__list li').each(function(){
                   $(this).hide();
                    if($(this).attr('m-type') == slug){
                        $(this).show();
                    }
                })
            }
            //show options in next filter
            $('#postItemsFilterList li:not(.default-item)').remove();
            $('.ie-press__list li:visible').each(function(){
                var visibleLi = $(this);
                $('#postItemsFilterList').append('<li><a class="dropdown-item" data-href="'+ visibleLi.attr('filter-slug') +'" m-type="'+ slug  +'">'+ visibleLi.attr('filter-name') +'</a></li>');
            });

            //push parameter to url
            window.history.pushState(null, null, "?type=" + slug + "&category=all"); 
        });

        //category filter
        $(document).on('click', '#cat-of-media-dd-wrap + .dropdown-menu a', function(){
            var elm = $(this);
            var slug = $('#dropdown-basic').attr('data-href');
            $('#cat-of-media-dd-wrap').text(elm.text());
            var childSlug = elm.attr('data-href');
            if(childSlug == 'all'){
                $('.ie-press__list li[m-type='+ slug +']').show();//take slug from parent filter and show results
            }else{
                $('.ie-press__list li').each(function(){
                   $(this).hide();
                    if($(this).attr('filter-slug') == childSlug){
                        $(this).show();
                    }
                })
            }

            //push parameter to url
            window.history.pushState(null, null, "?type=" + slug + "&category=" + childSlug);
        });

    });
</script>