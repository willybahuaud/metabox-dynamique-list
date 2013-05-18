function get_post_meta_ordered($id,$meta_key){
  global $wpdb;
  $output = array();
  $sql = "SELECT m.meta_value FROM ".$wpdb->postmeta." m where m.meta_key = '".$meta_key."' and m.post_id = '".$id."' order by m.meta_id";
  $results = $wpdb->get_results( $sql );
  foreach( $results as $result ){
    $output[] = $result->meta_value;
  }
  return array_filter($output);
}