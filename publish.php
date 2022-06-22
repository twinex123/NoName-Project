<?php  
        
require("actions/users/securityAction.php");
require("actions/posts/postQuestion.php");
require("actions/channels/getChannels.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publish a question | InterCollege</title>
    <link rel="stylesheet" href="assets/css/publish.css">
    <link rel="stylesheet" href="assets/css/scrollbar.css">
    <script src="assets/js/scroll.js"></script>
    <script src ="https://cdn.jsdelivr.net/npm/typelighterjs/typelighter.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<body>
    <?php include "includes/navbar.php"; ?>
    <div class="form-box">
        <h1 class="title-post">Post your 
            <span class="typeWriter" data-text='["ideas", "feelings", "friends"]'>

            </span>
        </h1>
        <form method="POST">

        <?php
        
            if(isset($errorMsg)){
                echo "<div class='alert-msg' role='alert'>".$errorMsg."</div>";
            }

        ?>
            <input type="text" placeholder="Title" id="input-form" name="title"><br>
            <textarea type="text" placeholder="Content" name="content"></textarea><br>
            <div class="select">
                <p class="publish-in">Publish in </p> 
                <select name="select_channel">

                    <?php
                    while($channel = $getChannels->fetch()){
                    
                        if(isset($_GET['v']) AND !empty($_GET['v']) AND $_GET['v'] == $channel['channel_name']){
                        ?>
                            <option selected><?= $channel['channel_name']; ?></option>
                        <?php
                        }else{
                        ?>
                            <option><?= $channel['channel_name']; ?></option>
                        <?php
                        }
                        ?>

                    <?php
                    }
                    ?>
            
                </select>
            </div>
            <div class="btnSubmit" onclick="submitForm()">
                <button type="submit" class="btn-form" name="publish" onclick="check">Publish</button><br>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function(){
            $(window).scroll(function(){
                var scroll = $(window).scrollTop();
                if (scroll > 10) {
                    $(".navigation").css("transition" , "0.1s");
                    $(".navigation").css("background" , "#222831");
                    $(".navigation").css("top" , "0");
                    $(".navigation").css("left" , "0");
                    $(".navigation").css("margin-bottom" , "30px");
                    $(".userBx").css("margin-left" , "10px");
                    $(".userBx").css("margin-top" , "8px");
                    $(".tools").css("margin-left" , "20px");
                    $(".tools").css("margin-top" , "30px");
                    $(".cursor").css("display", "none");
                }

                else{
                    $(".navigation").css("background" , "transparent");  	
                }
            })
        })

        function submitForm() {
            console.log("submit")
            document.querySelector('.btn-form').click();
        }
    </script>
    
</body>
</html>