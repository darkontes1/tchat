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
            }
        }
    });
});
//Empêcher l'utilisateur de remplir la textarea du tchat
$(document).on("keypress","#tchat",function(e){
    e.preventDefault();
});

setInterval(function(){
    $.ajax({
        method:"POST",
        url:"tchat.php",
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
            }
        }
    });
},1500);