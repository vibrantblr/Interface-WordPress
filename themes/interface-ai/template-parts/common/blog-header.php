<?php
$tags = get_tags();
$blogPageLink = get_permalink( get_option( 'page_for_posts' ) );
?>
    <header class="c-header d-none d-lg-block">
        <div class="o-grid o-grid--center">
            <div class="o-grid__col">
                <div class="c-header__inner">
                    <!-- <div class="c-logo">
                        <a class="c-logo__link" href="<?php //echo $blogPageLink; ?>"><img src="<?php //echo THEME_IMG; ?>interfacefulllogo-color.png" class="img-fluid" style="max-height: 32px;"/></a>
                    </div> -->
                    <div class="c-nav-wrap">
                        <ul class="c-nav c-nav--left o-plain-list">
                            <li class="c-nav__item">
                                <a href="<?php echo $blogPageLink; ?>" class="c-nav__link  c-nav__link--current ">Blog</a>
                            </li>
                        </ul>
                        <!-- <ul class="c-nav c-nav--right  o-plain-list">
                        </ul> -->
                    </div>
                    <!-- <div class="js-nav-toggle c-nav-toggle">
                        <span class="c-nav-toggle__icon"></span>
                    </div> -->
                </div>
            </div>
        </div>
    </header>
    <?php /*
    <div class="c-search js-search">
        <div class="o-grid">
            <div class="o-grid__col o-grid__col--4-4-s o-grid__col--3-4-m o-grid__col--center">
                <form class="c-search__form">
                    <div class="c-search__icon">
                    <svg viewBox="0 0 18 18" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Krabi" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linejoin="round">
                            <g id="blog_home-[desktop]" transform="translate(-699.000000, -42.000000)" stroke="#687385" stroke-width="2">
                                <g id="Icons/16px/search" transform="translate(700.000000, 43.000000)">
                                <g id="search">
                                    <path d="M12.9032258,6.4516129 C12.9032258,10.0148883 10.0148883,12.9032258 6.4516129,12.9032258 C2.88833747,12.9032258 0,10.0148883 0,6.4516129 C0,2.88833747 2.88833747,0 6.4516129,0 C10.0148883,0 12.9032258,2.88833747 12.9032258,6.4516129 Z" id="Stroke-1"></path>
                                    <line x1="15.483871" y1="15.483871" x2="10.5806452" y2="10.5806452" id="Stroke-5"></line>
                                </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                    </div>
                    <label for="search-form-input" class="u-hidden-visually">Search Discover the Latest Insights on Intelligent Self-Service for Banks &amp; Credit Unions</label>
                    <input type="search" id="search-form-input" aria-label="Search Discover the Latest Insights on Intelligent Self-Service for Banks &amp; Credit Unions" class="c-search__input js-search-input" placeholder="Type to Search">
                </form>
            </div>
        </div>
        <div class="o-grid">
            <div class="o-grid__col o-grid__col--4-4-s o-grid__col--3-4-m o-grid__col--center">
                <div class="c-search-results js-search-results"></div>
            </div>
        </div>
        <div class="c-search__close js-search-close">
            <div class="icon icon--ei-close icon--s ">
                <svg class="icon__cnt" width="0" height="0">
                    <use xlink:href="#ei-close-icon"></use>
                </svg>
            </div>
        </div>
    </div>
    */ ?> 
    <div class="c-tags-list-container">
        <div class="o-grid">
            <div class="o-grid__col o-grid__col--full">
                <div class="c-tags-list-wrap">
                    <ul class="c-tags-list o-plain-list dragscroll">
                        <li class="c-tags-list__item">
                            <a href="<?php echo $blogPageLink; ?>" class="c-tags-list__link <?php echo is_home() ? 'c-tags-list__link--current' : ''; ?>">Latest</a>
                        </li>
                        <?php 
                        $curTag = '';
                        if(is_tag()){
                            $tag = get_queried_object();
                            $curTag = $tag->slug;
                        }
                        foreach ( $tags as $tag ) { ?>
                            <li class="c-tags-list__item">
                                <a href="<?php echo get_tag_link( $tag->term_id ); ?>" class="c-tags-list__link <?php echo ($tag->slug == $curTag) ? 'c-tags-list__link--current' : ''; ?>"><?php echo $tag->name; ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo THEME_DIR_URI; ?>/assets/js/dragscroll.js"></script>
