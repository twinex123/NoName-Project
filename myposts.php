<?php
require("actions/posts/myQuestions.php");
require("actions/users/securityAction.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Posts | InterCollege</title>
    <link rel="stylesheet" href="assets/css/posts.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <div class="content">
        <div class="posts">
            <?php
            while($question = $getQuestions->fetch()){
                ?>
                <div class="card">
                    <div class="head">
                        <div class="title">
                            <?= $question['title']; ?>
                        </div>
                        <div class="date">
                            <?= $question['publication_date']; ?>
                        </div>
                    </div>
                    <div class="content-card">
                        <?= $question['content']; ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <script>
                
    $(document).ready(function(){
        $(window).scroll(function(){
            var scroll = $(window).scrollTop();
            if (scroll > 10) {
                $(".navigation").css("transition" , "0.3s");
                $(".navigation").css("background" , "#222831");
                $(".navigation").css("top" , "0");
                $(".navigation").css("left" , "0");
                $(".navigation").css("margin-bottom" , "15px");
                $(".userBx").css("margin-left" , "10px");
                $(".userBx").css("margin-top" , "8px");
                $(".tools").css("margin-left" , "20px");
                $(".tools").css("margin-top" , "30px");
            }

            else{
                $(".navigation").css("background" , "transparent");  	
            }
        })
    })

    </script>
</body>
</html>