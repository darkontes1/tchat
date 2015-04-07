//Quand on click sur le bouton du formulaire "ok"
$(document).on("click","#ok",function(e){
<<<<<<< HEAD
    e.preventDefault();
=======
    //Supprime la fonction par défaut de l'event form
    e.preventDefault();
    //Récupère la variable du message à ajouter
>>>>>>> origin/master
    var message = $("#message").val();
    //alert(message);
    $.ajax({
        method:"POST",
<<<<<<< HEAD
        url:"tchat.html",
        //data:{},
=======
        url:"tchat.php",
>>>>>>> origin/master
        success:function(r){
            //$("container").html($(r).find("container").html());
            /*var html = "";
            var toto = eval(r);
            alert(toto);*/
        }
    });
});