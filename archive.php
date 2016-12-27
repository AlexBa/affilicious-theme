<?php get_header(); ?>

<main id="content" role="main" itemprop="mainContentOfPage" itemscope itemtype="http://schema.org/Blog">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-xs-12">
                <div class="row ias-container">
                    <?php if (have_posts()): ?>
                        <?php while (have_posts()) : the_post(); ?>
                            <div class="col-md-12 ias-item">
                                <?php if(aff_is_product_page()): ?>
                                    <?php get_template_part('partials/content-product-preview'); ?>
                                <?php else: ?>
                                    <?php get_template_part('partials/content-entry-preview'); ?>
                                <?php endif; ?>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div class="col-md-12">
                            <?php get_template_part('partials/content-not-found'); ?>
                        </div>
                    <?php endif ?>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div id="pagination" class="ias-pagination">
                            <div class="nav-previous"><?php previous_posts_link(__('Show previous', 'affilicious-theme')); ?></div>
                            <div class="nav-next ias-nav-next"><?php next_posts_link(__('Show next', 'affilicious-theme')); ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
