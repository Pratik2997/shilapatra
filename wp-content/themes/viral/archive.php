<?php

/**
 * @package Viral
 */
get_header();

?>
<?php
$cat_title = single_cat_title('', false);
?>
<div class="vl-container vl-clearfix">
    <div class="content-area w-100">
        <div class="archive-top-block text-center">
            <span class="archive-top-label"><?php echo $cat_title; ?></span>
        </div>

        <div class="row top-part-archive">
            <?php if (have_posts()) : ?>
                <div class="col-md-6">
                    <div class="card h-100">
                        <?php if (has_post_thumbnail()) : ?>
                            <figure class="entry-figure card-img-top">
                                <?php
                                $viral_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'viral-780x440');
                                ?>
                                <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($viral_image[0]); ?>" alt="<?php echo esc_attr(get_the_title()) ?>"></a>
                            </figure>
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h5>
                            <p class="card-text"> <?php echo viral_excerpt(get_the_content(), 100); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        <?php $args = new WP_query(array(
                            'posts_per_page' => '4',
                            'post_type' => 'post',
                            'offset' => '1'
                        )); ?>
                        <?php while ($args->have_posts()) : $args->the_post(); ?>
                            <div class="col">
                                <article id="post-<?php the_ID(); ?>" <?php post_class('vl-archive-post h-100'); ?>>
                                    <div class="card h-100">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <figure class="entry-figure archive-top-right-image">
                                                <?php
                                                $viral_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'viral-780x440');
                                                ?>
                                                <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($viral_image[0]); ?>" alt="<?php echo esc_attr(get_the_title()) ?>"></a>
                                            </figure>
                                        <?php endif; ?>
                                        <div class="card-body">
                                            <h5 class="card-title entry-title side"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
        </div>
        <div class="row">
            <div class="col">
                <?php $archiveMain = new WP_query(array(
                    'posts_per_page' => '10',
                    'post_type' => 'post',
                    'offset' => '5'
                )); ?>

                <div class="row">
                    <?php while ($archiveMain->have_posts()) : $archiveMain->the_post(); ?>
                        <div class="col-md-12">
                            <article id="post-<?php the_ID(); ?>" <?php post_class('vl-archive-post'); ?>>
                                <div class="card mb-3">
                                    <div class="row g-0">
                                        <div class="col-md-6">
                                            <?php if (has_post_thumbnail()) : ?>

                                                <figure class="entry-figure">
                                                    <?php
                                                    $viral_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'viral-780x440');
                                                    ?>
                                                    <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($viral_image[0]); ?>" class="img-fluid rounded-start" alt="<?php echo esc_attr(get_the_title()) ?>"></a>
                                                </figure>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card-body">
                                                <h5 class="card-title entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                                <p class="card-text"><span class="text-muted"><?php viral_post_date(); ?></span></p>
                                                <p class="card-text"> <?php echo viral_excerpt(get_the_content(), 100); ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- .entry-content -->
                            </article><!-- #post-## -->
                        </div>
                    <?php endwhile; ?>
                </div>


            </div>
        </div>






    </div>

    <?php the_posts_pagination(); ?>

<?php else : ?>

    <?php get_template_part('template-parts/content', 'none'); ?>

<?php endif; ?>

</div><!-- #primary -->
</div>
<?php get_footer(); ?>