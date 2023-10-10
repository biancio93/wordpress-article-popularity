function smart_Article_Loop(){
	$post_counter = 3;
	$args = array(
    'posts_per_page' => 3,
    'post_type' => 'post',
    'orderby' => 'comment_count',
    'order' => 'DESC',
    'date_query' => array(
        'after' => date('Y-m-d', strtotime('-30 days')) 
    )
); 
$posts = get_posts($args);
foreach ($posts as $post) {
  $post_Title = get_the_title($post);
  $post_Excerpt = get_the_excerpt($post);
  $post_Thumbnail_url = get_the_post_thumbnail_url($post);
  $post_date = get_the_date('D M j', $post);
  $post_url = get_permalink($post);
  $post_Category_List = "";
  $post_Category_Array = get_the_category($post);
	foreach ($post_Category_Array as $category) {
		$post_Category_Name = $category->name;
		$post_Category_List = $post_Category_List . $post_Category_Name;
	}
  $post_Content = "<div>" . "<img src='" . $post_Thumbnail_url . "' >" . "<p>" . $post_Category_List . "<span> | </span>" . $post_date . "</p>" . "<h4 class='post-title'>" . $post_Title . "</h4>" . "<p class='post-excerpt'>" . $post_Excerpt . "</p>" . "<a href='" . $post_url . "' class='read-more'>Leggi di più</a>" . "</div>";
  $post_Grid = $post_Grid . $post_Content;
}
$posts_count = count($posts);
if($posts_count < $post_counter){
	$post_difference = $post_counter - $posts_count;
	$args_Popular = array(
    'posts_per_page' => 3,
    'post_type' => 'post',
    'orderby' => 'wpb_post_views_count',
    'order' => 'DESC',
	'date_query' => array(
        'before' => date('Y-m-d', strtotime('-30 days')) 
    )	
	);
	$posts_Popular = get_posts($args_Popular);
	$posts_Popular_count = count($posts_Popular);
	for($i=0;$i<$post_difference;$i++){
		$popular_post_N = $posts_Popular[$i];
		$post_Title_p = get_the_title($popular_post_N);
		$post_Excerpt_p = get_the_excerpt($popular_post_N);
		$post_Thumbnail_url_p = get_the_post_thumbnail_url($popular_post_N);
		$post_date_p = get_the_date('D M j', $popular_post_N);
        $post_url_p = get_permalink($popular_post_N);
		$post_Category_List = "";
        $post_Category_Array_p = get_the_category($popular_post_N);
	       foreach ($post_Category_Array_p as $category_p) {
		      $post_Category_Name_p = $category_p->name;
		      $post_Category_List_p = $post_Category_List_p . $post_Category_Name_p;
	       }
		$post_Content_p = "<div>" . "<img src='" . $post_Thumbnail_url_p . "' >" . "<p>" . $post_Category_List_p . "<span> | </span>" . $post_date_p . "</p>" . "<h4 class='post-title'>" . $post_Title_p . "</h4>" . "<p class='post-excerpt'>" . $post_Excerpt_p . "</p>" . "<a href='" . $post_url_p . "' class='read-more'>Leggi di più</a>" . "</div>";
		$popular_post_Content = $popular_post_Content . $post_Content_p;
	}
	return "<div>" . $post_Grid . $popular_post_Content . "</div>";
}else{
	return "<div>" . $post_Grid . "</div>";
}   
}
add_shortcode('smartarticle', 'smart_Article_Loop');