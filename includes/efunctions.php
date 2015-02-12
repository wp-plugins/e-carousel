<?php
function e_carousel_shortcode($atts){
	extract( shortcode_atts( array(
  
		'post_type' => 'e-carousel',
		
	), $atts, 'wishlist' ) );
	
    $q = new WP_Query(
        array('posts_per_page' => -1, 'post_type' => $post_type,'orderby' =>'meta_value', 'order' => 'ASC'
        	) //, 'meta_key' => 'order_number',
        );		
		
		
	$list = '<div class="e-carousel autoplay">';
	while($q->have_posts()) : $q->the_post();
		$idd = get_the_ID();

		$list .= '

   <div class="image">'.get_the_post_thumbnail().'</div>
    '; 
   
	endwhile;
	$list.= '</div>';
	wp_reset_query();
	return $list;
}
add_shortcode('e_carousel', 'e_carousel_shortcode');
add_theme_support( 'post-thumbnails', array( 'e-carousel') );
add_image_size( 'e-carousel',200, 200 );
// [e_carousel post_type=""]


