<?php

/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Viral
 */
if (!function_exists('viral_posted_on')) :

    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function viral_posted_on() {
        $time_string = '<span class="vl-month">%1$s</span><span class="vl-day">%2$s</span><span class="vl-year">%3$s</span>';

        $posted_on = sprintf($time_string, esc_attr(get_the_date('M')), esc_html(get_the_date('j')), esc_html(get_the_date('Y'))
        );

        $byline = sprintf(
                esc_html_x('by %s', 'post author', 'viral'), '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
        );

        $comment_count = get_comments_number(); // get_comments_number returns only a numeric value


        if ($comment_count == 0) {
            $comments = esc_html__('No Comments', 'viral');
        } elseif ($comment_count > 1) {
            $comments = $comment_count . ' ' . esc_html__('Comments', 'viral');
        } else {
            $comments = esc_html__('1 Comment', 'viral');
        }
        $comment_link = '<a class="entry-comment" href="' . get_comments_link() . '">' . $comments . '</a>';

        echo '<span class="entry-date published updated">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>' . $comment_link; // WPCS: XSS OK.
    }

endif;


if (!function_exists('viral_post_date')) :

    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function viral_post_date() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $posted_on = sprintf($time_string, esc_attr(get_the_date('c')), esc_html(get_the_date()), esc_attr(get_the_modified_date('c')), esc_html(get_the_modified_date())
        );

        $byline = sprintf(
                esc_html_x('by %s', 'post author', 'viral'), '<span class="author vcard">' . esc_html(get_the_author()) . '</span>'
        );

        echo '<div class="posted-on"><i class="mdi mdi-clock-time-three-outline"></i>' . $posted_on .'</div>'; // WPCS: XSS OK.
    }

endif;

if (!function_exists('viral_entry_footer')) :

    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function viral_entry_footer() {
        // Hide category and tag text for pages.
        if ('post' === get_post_type()) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list(', ');
            if ($categories_list && viral_categorized_blog()) {
                printf('<div class="cat-links"><i class="mdi mdi-book-open-outline"></i> ' . esc_html__('Posted in %1$s', 'viral') . '</div>', $categories_list); // WPCS: XSS OK.
            }

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list('', ', ');
            if ($tags_list) {
                printf('<div class="tags-links"><i class="mdi mdi-tag-multiple-outline"></i> ' . esc_html__('Tagged %1$s', 'viral') . '</div>', $tags_list); // WPCS: XSS OK.
            }
        }

        if (!is_single() && !post_password_required() && ( comments_open() || get_comments_number() )) {
            echo '<span class="comments-link">';
            comments_popup_link(esc_html__('Leave a comment', 'viral'), esc_html__('1 Comment', 'viral'), esc_html__('% Comments', 'viral'));
            echo '</span>';
        }
    }

endif;

if (!function_exists('viral_entry_category')) :

    /**
     * Prints HTML with meta information for the categories
     */
    function viral_entry_category() {
        // Hide category and tag text for pages.
        if ('post' == get_post_type()) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list(', ');
            if ($categories_list && viral_categorized_blog()) {
                echo '<i class="mdi mdi-book-open-outline"></i> ' . $categories_list; // WPCS: XSS OK.
            }
        }
    }

endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function viral_categorized_blog() {
    if (false === ( $all_the_cool_cats = get_transient('viral_categories') )) {
        // Create an array of all the categories that are attached to posts.
        $all_the_cool_cats = get_categories(array(
            'fields' => 'ids',
            'hide_empty' => 1,
            // We only need to know if there is more than one category.
            'number' => 2,
        ));

        // Count the number of categories that are attached to the posts.
        $all_the_cool_cats = count($all_the_cool_cats);

        set_transient('viral_categories', $all_the_cool_cats);
    }

    if ($all_the_cool_cats > 1) {
        // This blog has more than 1 category so viral_categorized_blog should return true.
        return true;
    } else {
        // This blog has only 1 category so viral_categorized_blog should return false.
        return false;
    }
}

if (!function_exists('viral_social_share')) :

    /**
     * Prints HTML with social share
     */
    function viral_social_share() {
        global $post;
        $post_url = get_permalink();

        // Get current page title
        $post_title = str_replace(' ', '%20', get_the_title());

        // Get Post Thumbnail for pinterest
        $post_thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');

        // Construct sharing URL
        $twitterURL = 'https://twitter.com/intent/tweet?text=' . $post_title . '&amp;url=' . $post_url;
        $facebookURL = 'https://www.facebook.com/sharer/sharer.php?u=' . $post_url;
        $pinterestURL = 'https://pinterest.com/pin/create/button/?url=' . $post_url . '&amp;media=' . $post_thumbnail[0] . '&amp;description=' . $post_title;
        $mailURL = 'mailto:?Subject=' . $post_title . '&amp;Body=' . $post_url;

        $content = '<div class="vl-share-buttons">';
        $content .= '<span>' . esc_html__('SHARE', 'viral') . '</span>';
        $content .= '<a title="' . esc_html__('Share on Facebook', 'viral') . '" href="' . $facebookURL . '" target="_blank"><i class="mdi mdi-facebook"></i></a>';
        $content .= '<a title="' . esc_html__('Share on Twitter', 'viral') . '" href="' . $twitterURL . '" target="_blank"><i class="mdi mdi-twitter"></i></a>';
        $content .= '<a title="' . esc_html__('Share on Pinterest', 'viral') . '" href="' . $pinterestURL . '" target="_blank"><i class="mdi mdi-pinterest"></i></a>';
        $content .= '<a title="' . esc_html__('Email', 'viral') . '" href="' . $mailURL . '"><i class="mdi mdi-email"></i></a>';
        $content .= '</div>';

        echo $content;
    }

endif;

if (!function_exists('viral_post_primary_category')) {

    function viral_post_primary_category($class = "post-categories") {
        $post_categories = viral_get_post_primary_category(get_the_ID());

        if (!empty($post_categories)) {
            $category_obj = $post_categories['primary_category'];
            $category_link = get_category_link($category_obj->term_id);
            echo '<ul class="' . esc_attr($class) . '">';
            echo '<li><a class="vl-primary-cat vl-category-' . esc_attr($category_obj->term_id) . '" href="' . esc_url($category_link) . '">' . esc_html($category_obj->name) . '</a></li>';
            echo '</ul>';
        }
    }

}


if (!function_exists('viral_get_post_primary_category')) {

    function viral_get_post_primary_category($post_id, $term = 'category', $return_all_categories = false) {
        $return = array();

        if (class_exists('WPSEO_Primary_Term')) {
            // Show Primary category by Yoast if it is enabled & set
            $wpseo_primary_term = new WPSEO_Primary_Term($term, $post_id);
            $primary_term = get_term($wpseo_primary_term->get_primary_term());

            if (!is_wp_error($primary_term)) {
                $return['primary_category'] = $primary_term;
            }
        }

        if (empty($return['primary_category']) || $return_all_categories) {
            $categories_list = get_the_terms($post_id, $term);

            if (empty($return['primary_category']) && !empty($categories_list)) {
                $return['primary_category'] = $categories_list[0];  //get the first category
            }

            if ($return_all_categories) {
                $return['all_categories'] = array();

                if (!empty($categories_list)) {
                    foreach ($categories_list as &$category) {
                        $return['all_categories'][] = $category->term_id;
                    }
                }
            }
        }

        return $return;
    }

}

/**
 * Flush out the transients used in viral_categorized_blog.
 */
function viral_category_transient_flusher() {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    // Like, beat it. Dig?
    delete_transient('viral_categories');
}

add_action('edit_category', 'viral_category_transient_flusher');
add_action('save_post', 'viral_category_transient_flusher');
