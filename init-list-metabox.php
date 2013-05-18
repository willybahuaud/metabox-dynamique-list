add_action( 'add_meta_boxes', 'mes_metaboxes' );
function mes_metaboxes() {
  add_meta_box( 'to_do_list', 'choses à faire', 'to_do_list', 'post', 'normal', 'default' );
}