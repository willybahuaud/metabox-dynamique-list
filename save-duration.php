$duree_chose = get_post_meta_ordered($post->ID,'_duree_chose');
$to_do = get_post_meta_ordered($post->ID,'_duree_chose');
// je test s'il y a autant de tâches que de durées
if(count( $to_do )>0 && count( $to_do )==count( $duree_chose ) ):
foreach($to_do as $k => $thing){
?>
    <div class="item-chose"><label for="">Description : </label><input id="" class="description_des_choses" style="width: 50%;" type="text" name="descr_chose[]" value="<?php echo $thing; ?>" />
    <label for="">Durée allouée : </label><input id="" class="duree_des_choses" style="width: 56px;" type="text" name="duree_chose[]" value="<?php echo $duree_chose[$k]; ?>" />h
    <a class="suppr-chose button-secondary hide-if-no-js" href="javascript:void(0);">supprimer</a>
    <span class="hide-if-js"><em>Pour supprimer, videz les contenus.</em></span></div>
<?php 
}
//...