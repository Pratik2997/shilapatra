<?php
/**
 * @package Viral
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('vl-article-content'); ?>>
    <div class="get-author">
        - <?php echo the_author_posts_link();?>
    </div>
    <header class="entry-header">
        <?php viral_post_date(); ?>
    </header>

    <div class="entry-content">
        <?php
        $viral_display_featured_img = get_theme_mod('viral_display_featured_image');
        if ($viral_display_featured_img) {
            echo '<div class="single-featured-img">';
            the_post_thumbnail('large');
            echo '</div>';
        }?>
        <div class="d-flex justify-content-between my-4">
            <div class="d-flex font-resizer">
                <div class="decrease pe-3"><i class="fa-solid fa-a fa-sm"></i></div>
                <div class="resetMe pe-3"><i class="fa-solid fa-repeat"></i></div>
                <div class="increase"><i class="fa-solid fa-a fa-xl"></i></div>

            </div>
            <div>
            <?php echo sharethis_inline_buttons(); ?>
            </div>


        </div>
        <div id="innerbody">

            <?php the_content();?>
        </div>

        <?php wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'viral'),
            'after' => '</div>',
        ));
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php viral_entry_footer(); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-## -->