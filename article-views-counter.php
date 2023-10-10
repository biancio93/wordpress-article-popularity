function wpb_get_post_views($postID){
    $count_key = 'wpb_post_views_count';
    $count = get_field('wpb_post_views_count');
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}

add_shortcode('my_shortcode', 'wpb_get_post_views');