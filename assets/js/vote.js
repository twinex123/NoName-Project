$(document).ready(function() {
    $('a').click(function(){
        var id_article = $(this).attr('class');
        $.post('actions/posts/show_like.php',{id_article:id_article}, function(data){
            if(data=="ok"){
                add_like(id_article);
                $("#feedback").text("Merci d'avoir liké!").css("color", "green");
            }else{
                $("#feedback").text("Déjà liké!").css("color", "red");
            }
        })
    });

    function add_like(id_article){
        $.post('actions/posts/add_like.php',{id_article:id_article}, function(data){
            document.getElementById("id"+id_article).innerText = data;
        })
    }
})