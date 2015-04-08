//Quand on click sur le bouton du formulaire "ok"
$(document).on("click","#ok",function(e){
    //Supprime la fonction par défaut de l'event 
    e.preventDefault();
    //Récupère la variable du message à ajouter
    var message = $("#message").val();
    var user = $("#user").val();
    //alert(message);
    $.ajax({
        method:"POST",
        url:"tchat.php",
        data:{"message":message,
            "user":user
        },
        success:function(r){
            //alert(r);
            var html = "";
            var toto = eval(r);
            //console.log(toto[1][7]['loginUser']);
            if(toto.length==0){
                console.log("PAS DE MESSAGES DANS LA BASE !");
            }
            else{
                for(i=0;i<toto.length;i++){
                    var d = new Date(toto[i]['date']);
                    html += "["+(d.getHours())+":"+(d.getMinutes())+"] "+toto[i]['user']+" : "+toto[i]['message']+"\n";
                }
                $("#tchat").val(html);
                $("#message").val("");
            }
        }
    });
});

//Empêcher l'utilisateur de remplir la textarea du tchat
$(document).on("keypress","#tchat",function(e){
    e.preventDefault();
});
//Modifie la touche tab/shift+enter
$(document).on("keydown","#message",function(e){
    //Fait une tabulation au lieu de changer de focus
    if(e.which == 9){
        e.preventDefault();
        $("#message").val($("#message").val()+"\t");
    }
    //Fait une \n
    if(e.shiftKey){
        if(e.which == 13){
            e.preventDefault();
            $("#message").val($("#message").val()+"\n");
        }
    }
});
//Modifie la touche enter
$(document).on("keypress","#message",function(e){
    //Envoie le formulaire quand on appuie sur enter
    if(e.which == 13){
        e.preventDefault();
        $("#ok").trigger("click");
    }
});

//Actualisation
setInterval(function(){
    $("#ok").trigger("click");
},1500);