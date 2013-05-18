$duree_totale = array_sum( get_post_meta( $post->ID, '_duree_chose', false ) );
echo $duree_totale;