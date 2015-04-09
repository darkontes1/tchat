//Variable pour l'actualisation plus bas (truc)
taille = 0;
id = 0;
on = false;

//Actualisation grace à une fonction récursive
function truc(){
    $.ajax({
        url:"tchat.php",
        success:function(r){
            var toto = eval(r);
            setTimeout(function(){truc();},500);  
            if(toto.length > taille){
                taille = toto.length;
                //trigger magique qui enlève des lignes de code useless
                $("#ok").trigger("click");
            }
        },
    });
      
}

//Affichage au début de l'irc
jQuery(window).load(function(){
    $("#false").css("display","block");
    $("#true").css("display","none");
    $("#inscription").css("display","none");
});

//Quand on click sur le bouton de connexion
$(document).on("click","#co",function(e){
    e.preventDefault();
    //Récupère la variable du message à ajouter
    var pseudo = $("#valueCo").val();
    var pass = $("#passCo").val();
    $.ajax({
        method:"POST",
        url:"verifco.php",
        data:{"pseudo":pseudo,
            "pass":pass
        },
        success:function(r){
            var titi = eval(r);
            //alert(titi);
            //Si l'utilisateur arrive à se co
            if(titi == 1){
                document.getElementById("error").innerHTML = "";
                $("#false").css("display","none");
                $("#true").css("display","block");
                $("#ok").trigger("click");
                $("#user").val(pseudo);
            }
            //Sinon on affiche une erreur dans la console
            else{
                document.getElementById("error").innerHTML = "";
                $("#error").append("Erreur lors de la connexion !");
                $("#passCo").val("");
            }
        }
    });
});

//Quand on click sur le bouton de deconnexion
$(document).on("click","#deco",function(e){
    e.preventDefault();
    $.ajax({
        method:"GET",
        url:"verifco.php",
        data:{"action":"deco"},
        success:function(r){
            $("#false").css("display","block");
            $("#true").css("display","none");
        }
    });
});

//Quand on click sur le bouton d'inscription
$(document).on("click","#insc",function(e){
    //Supprime la fonction par défaut de l'event 
    e.preventDefault();
    //Récupère la variable du message à ajouter
    var valueIns = $("#valueIns").val();
    var passIns = $("#passIns").val();
    var passVeri = $("#passVeri").val();
    //alert(message);
    $.ajax({
        method:"POST",
        url:"inscription.php",
        data:{"valueIns":valueIns,
            "passIns":passIns,
            "passVeri":passVeri
        },
        success:function(r){
            document.getElementById("error").innerHTML = "";
            $("#error").append("Les mots de passe sont différents !");
            $("#valueIns").val("");
            $("#passIns").val("");
            $("#passVeri").val("");
        }
    });
});

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
            "user":user,
            "id":id
        },
        success:function(r){
            //alert(r);
            var html = "";
            var toto = eval(r);
            taille = toto.length;
            //Si il n'y a aucun message dans l'irc
            if(toto.length==0){
                id = 0;
                console.log("PAS DE MESSAGES DANS LA BASE !");
            }
            //Sinon
            else{
                //On stock dans html à travers la boucle l'affichage

                for(i=0;i<toto.length;i++){
                    //On initialise une date pour afficher : [date] pseudo : message
                    var d = new Date(toto[i]['date']);
                    html += "["+(d.getHours())+":"+(d.getMinutes())+"] "+toto[i]['user']+" : "+toto[i]['message']+"\n";
                    id = toto[i]['id'];
                }
                //On l'ajoute dans le tchat
                $("#tchat").val(html);
                //$("#tchat").append(html);
                //On vide la boite de message de l'utilisateur
                $("#message").val("");
                //Permet de mettre le scroll en bas
                $("#tchat").animate({scrollTop : $("#tchat").height()},1);
            }
        }
    });
});

//Empêcher l'utilisateur de remplir la textarea du tchat
function cancel(e){
    e.preventDefault();
}

//Pour que le clavier n'intervienne pas pour modifier le tchat
$(document)
    .on("keydown","#tchat", cancel) //Quand on appuie
    .on("keypress","#tchat", cancel)    //Entre l'appuie et le soulevement
    .on("keyup","#tchat", cancel);  //Quand on retire
$(document)
    .on("keydown","#user", cancel)
    .on("keypress","#user", cancel)
    .on("keyup","#user", cancel);

//Modifie la touche tab/shift+enter
$(document).on("keydown","#message",function(e){
    //Fait une tabulation au lieu de changer de focus
    if(e.which == 9){
        e.preventDefault();
        //Attribut une tabulation comme action de "tab"
        $("#message").val($("#message").val()+"\t");
    }
    //Fait une \n
    if(e.shiftKey){
        if(e.which == 13){
            e.preventDefault();
            //Fait un retour chariot à la place de valider
            $("#message").val($("#message").val()+"\n");
        }
    }
});
//Modifie la touche enter
$(document).on("keypress","#message",function(e){
    //Envoie le formulaire quand on appuie sur enter
    if(e.which == 13){
        e.preventDefault();
        //Fait un envoi de trigger(click) sur "#ok" lorsque l'on appuie sur enter
        $("#ok").trigger("click");
    }
});

//Quand on click sur l'un des smiley
$(document).on("click","li",function(){
    $("#message").val($("#message").val()+$(this).attr("alt"));
});

//
$(document).on("click","#tchat",function(){

});

$(document).on("click","#test",function(e){
    e.preventDefault();
    if(on == false){
        $("#inscription").css("display","block");
        on = true;
    }else{
        $("#inscription").css("display","none");
        on = false;
    }
    
});

//Fait uniquement quand il y a une nouvelle entrée sur le serveur
$(document).ready(function(){truc();});