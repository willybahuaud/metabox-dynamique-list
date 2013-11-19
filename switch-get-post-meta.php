
$to_do = get_post_meta($post->ID,'_descr_chose',false);

// devient
$to_do = get_post_meta_ordered($post->ID,'_descr_chose');

