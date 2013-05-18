// nonce
wp_nonce_field('update-taches_'.$post->ID,'_wpnonce_update_taches');

// check referer
check_admin_referer( 'update-taches_'.$post_id,'_wpnonce_update_taches' );