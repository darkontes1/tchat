//Quand on click sur le bouton du formulaire "ok"
$(document).on("click","#ok",function(e){
    //Supprime la fonction par défaut de l'event form
    e.preventDefault();
    //Récupère la variable du message à ajouter
    var message = $("#message").val();
    //alert(message);
    $.ajax({
        method:"POST",
        url:"tchat.php",
        success:function(r){
            //$("container").html($(r).find("container").html());
            /*var html = "";
            var toto = eval(r);
            alert(toto);*/
        }
    });
});