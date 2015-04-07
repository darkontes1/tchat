$(document).on("click","#ok",function(e){
    e.preventDefault();
    var message = $("#message").val();
    alert(message);
    $.ajax({
        method:"POST",
        url:"tchat.html",
        //data:{},
        success:function(r){
            //$("container").html($(r).find("container").html());
            var html = "";
            var toto = eval(r);
            alert(toto);
        }
    });
});