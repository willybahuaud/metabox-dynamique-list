add_action('save_post','ma_sauvegarde');
function ma_sauvegarde($post_id){
  if((!defined( 'DOING_AJAX' ) || !DOING_AJAX ) && isset($_POST['descr_chose'])){
    // je supprime les anciennes valeur...
    delete_post_meta($post_id, '_descr_chose');
    
    //...et j'enregistre toutes les nouvelles
    foreach($_POST['descr_chose'] as $d){
      //si elles ne sont pas vides
      if(!empty($d))
      add_post_meta($post_id, '_descr_chose', $d);
    }
  }
}