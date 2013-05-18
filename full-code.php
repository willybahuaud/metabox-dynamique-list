//Initialisation
add_action('add_meta_boxes','mes_metaboxes');
function mes_metaboxes(){
  add_meta_box('things', 'choses à faire', 'things_to_do', 'post', 'normal', 'default');
}

//fonction alternative à get_post_meta
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

// Fonction de construction de la metabox
function things_to_do($post){
  global $wpdb;

  //taches
  $to_do = get_post_meta_ordered($post->ID,'_descr_chose');
  //duree
  $duree_chose = get_post_meta_ordered($post->ID,'_duree_chose');

  // nonce
  wp_nonce_field( 'update-taches_'.$post->ID, '_wpnonce_update_taches' );

  //boucle
  echo '<div id="all_things">';
  if(count( $to_do )>0 && count( $to_do )==count( $duree_chose ) ):
    foreach($to_do as $k => $thing){
      $duree_c = $duree_chose[$k];
      ?>
      <div class="item-chose"><label for="">Description : </label><input id="" class="description_des_choses" style="width: 50%;" type="text" name="descr_chose[]" value="<?php echo $thing; ?>" /> <label for="">Durée allouée : </label><input id="" class="duree_des_choses" style="width: 56px;" type="text" name="duree_chose[]" value="<?php echo $duree_c; ?>" />h <a class="suppr-chose button-secondary hide-if-no-js" href="javascript:void(0);">supprimer</a></div>
      <span class="hide-if-js"><em>Pour supprimer, videz les contenus.</em></span>

      <?php
    }
  endif; ?>

  <div class="item-chose"><label for="">Description : </label><input id="" class="description_des_choses" style="width: 50%;" type="text" name="descr_chose[]" /> <label for="">Durée allouée : </label><input id="" class="duree_des_choses" style="width: 56px;" type="text" name="duree_chose[]" />h <a class="suppr-chose button-secondary hide-if-no-js" href="javascript:void(0);">supprimer</a></div>
  <span class="hide-if-js"><em>Pour supprimer, videz les contenus.</em></span>
  <?php
  echo '</div>';
  ?>

  <!-- lien ajout -->

  <a id="ajout-chose" class="button-primary hide-if-no-js" style="margin-top: 10px; position: relative; display: inline-block;" href="javascript:void(0);">Ajouter une tâche</a>
  <span class="hide-if-js">Pour ajouter une nouvelle entrée, sauvegardez l'article.
  <em>JAVASCRIPT désactivé, vous aurez une meilleure ergonomie avec le javascript activé.</em></span>

  <!-- script-->
  <script type="mce-text/javascript">// <![CDATA[
  jQuery(document).ready(function($){
      //suppresion champ
      function remove_chose(){
        $('.suppr-chose').on('click',function(){
          $(this).parent().remove();
        });
      }
      remove_chose();

      //ajout champ
      $('#ajout-chose').on('click',function(){
        $('.item-chose:last').clone().appendTo('#all_things');
        $('.item-chose:last input').val('');
        remove_chose();
      });
    });

  // ]]></script>
  <?php
  }

  // Sauvegarde
  add_action('save_post','ma_sauvegarde');
  function ma_sauvegarde($post_id){

  if( ( !defined( 'DOING_AJAX' ) || !DOING_AJAX ) && isset( $_POST['descr_chose'], $_POST['duree_chose']) ){
    check_admin_referer( 'update-taches_'.$post_id,'_wpnonce_update_taches' );
    delete_post_meta($post_id, '_descr_chose');
    delete_post_meta($post_id, '_duree_chose');
    foreach($_POST['descr_chose'] as $d){
      if(!empty($d))
        add_post_meta($post_id, '_descr_chose', $d);
    }
    foreach($_POST['duree_chose'] as $d){
      if(!empty($d))
        add_post_meta($post_id, '_duree_chose', $d);
    }
  }
}