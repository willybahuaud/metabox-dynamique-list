// jQuery no-conflict, car on est dans l'admin
jQuery(document).ready(function($){
  //je créer une fonction
  function remove_chose(){
    // lorsque l'on clic sur le bouton de suppression,
    // son parent est supprimé
    $('.suppr-chose').on('click',function(){
      $(this).parent().remove();
    });
  }
  // je lance cette fonction
  remove_chose();

  // lorsque l'on clique sur "ajouter une tâche"...
  $('#ajout-chose').on('click',function(){
    // ... on duplique/vide qui va bien, à la suite...
    $('.item-chose:last').clone().appendTo('#all_things');
    $('.item-chose:last input').val('');
    // ... et on relance la fonction remove_chose
    remove_chose();
  });
});