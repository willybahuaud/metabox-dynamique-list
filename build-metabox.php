function to_do_list($post){
  $to_do = get_post_meta($post->ID,'_descr_chose',false);
  echo '<div id="all_things">';
  //si $to_do n'est pas vide
  if(count( $to_do )>0):
  foreach($to_do as $k => $thing){
    echo '<div class="item-chose"><label for="">Description : </label><input id="" style="width: 50%;" type="text" name="descr_chose[]" value="'.$thing.'" /></div>';
  }

  //sinon le même sans value
  endif;
  //j'ajoute un champ vide, quoi qu'il arrive
  echo '<div class="item-chose"><label for="">Description : </label><input id="" style="width: 50%;" type="text" name="descr_chose[]" /></div>';
  echo '</div>';
}