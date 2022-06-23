<?php
require("actions/users/securityAction.php");
require("actions/posts/showAnswers.php");

header("Cache-Control:no-cache");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post | NoName</title>
    <link rel="stylesheet" href="assets/css/post.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/29ce918257.js" crossorigin="anonymous"></script>
</head>
<body>
    <style>
        .User a{
            color: white;
        }
        .readMore .addText{
            display: none;
        }
        .lire-plus{
            color: #F05454;
        }
    </style>

    <?php include 'includes/navbar.php'; ?>

    <?php

    require("actions/config.php");

    if(isset($_GET["p"]) AND !empty($_GET["p"])){
        $getQuestion = $bdd->prepare("SELECT * FROM questions WHERE id = ?");
        $getQuestion->execute(array($_GET["p"]));
    }else{
        header("location: ".$_SERVER["HTTP_REFERER"]."");
    }

    
    ?>

    <div class="content">
        <div class="posts">
            <?php
            while($question = $getQuestion->fetch()){
                ?>
                <div class="card">
                    <div class="head">
                        <div class="title">
                            <?= $question['title']; ?>
                        </div>
                        <div class="date">
                            <?= ", ".$question['publication_date']; ?>
                        </div>
                    </div>
                    <div class="content-card">
                        <?= "<div class='readMore'>" . $question['content'] . "</div>"; ?>
                    </div>
                    <div class="footer">
                        <?php if($question['id_author'] == $_SESSION["id"]){ ?>
                            <div class="modifyBtn">
                                <button onclick="window.location.href='editpost.php?id=<?= $question['id']; ?>'">Modify the post</button>
                            </div>
                            <div class="deleteBtn">
                                <button onclick="window.location.href='actions/posts/deleteQuestion.php?id=<?= $question['id']; ?>'"><i class="fa-solid fa-trash-can"></i></button>
                            </div>
                            <div class="statsBtn">
                                <button onclick="window.location.href='actions/posts/?id=<?= $question['id']; ?>'">Stats  <i class="fa-solid fa-square-poll-vertical"></i></button>
                            </div>
                        <?php } ?>
                    </div>
                    <section class="answers">
                        <div class="comments">
                            <form class="form-content" method="POST" id="postComment">
                                <input name="answer" class="answer-btn" type="text" placeholder="Comment" autocomplete="off"><button type="submit" class="submit-btn" name="validate"><i class='fa-solid fa-paper-plane'></i></button>
                            </form>
                        </div> 
                        
                    </section>
                </div>
                <div class="answers-container" id="answers-container">

                            <?php
                                while($answer = $getAnswers->fetch()){
                                    ?>
                                    <?php
                                        $getAnswerRating = $bdd->prepare("SELECT * FROM answers_rating WHERE user_id = ? AND answer_id = ?");
                                        $getAnswerRating->execute(array($_SESSION["id"], $answer["id"]));
                                    ?>
                                    <div class="answer">
                                        <div class="answer_header">
                                            <?= "<div class='author'>".$answer["username_author"]."</div>"; ?><form method="POST" id="likeComment" action="actions/posts/answerLikes.php?id=<?=$answer['id']; ?>"><div class="likes" id="likes"><button type="submit"> <?php if($getAnswerRating->rowCount() > 0){echo "<i class='fa-solid fa-heart'></i>";}else{echo "<i class='fa-regular fa-heart'></i>";} ?><p><?= $answer["likes"]; ?></p></button></div></form>
                                        </div>
                                        <div class="answer_body">
                                            <?= "<div class='answer_content'>".$answer["content"]."</div>"; ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                            ?>

                        </div>
                
                <?php
            }
            ?>

        </div>
    </div>
    
    <script src="assets/js/scroll.js"></script>
    <script src="assets/js/maxstr.js"></script>
    <script>
        $(function(){
            $("form").submit(function (e){
 
                var answer_content = document.getElementById("answers-container");

                var answer = $(".answer-btn").val();

                var dataString = "answer=" + answer +"&post_id=" + <?= $_GET['p']; ?>

                $.ajax({
                    type: "POST",
                    url: "actions/posts/postAnswer.php",
                    data: dataString,
                    cache: false,
                    success: function(result){
                        console.log("Successfully");
                    }
                });

                answer_content.location.reload();

            });

            /* Computer Longpress */

            var delay;
            
            var longpress = 500;
            
            var listItems = document.getElementsByClassName('answer');
            var listItem;
            
            for (var i = 0, j = listItems.length; i < j; i++) {
                listItem = listItems[i];
                
                listItem.addEventListener('mousedown', function (e) {
                var _this = this;
                delay = setTimeout(check, longpress);
                
                function check() {
                    alert("Hello")
                    _this.classList.add('is-selected');
                }
                
                }, true);
                
                listItem.addEventListener('mouseup', function (e) {
                    clearTimeout(delay);
                });
                
                listItem.addEventListener('mouseout', function (e) {
                    clearTimeout(delay);
                });
                
            }

            /*Mobile Longpress*/

            var onlongtouch; 
            var timer;
            var touchduration = 800; //length of time we want the user to touch before we do something

            function touchstart(e) {
                e.preventDefault();
                if (!timer) {
                    timer = setTimeout(onlongtouch, touchduration);
                }
            }

            function touchend() {
                //stops short touches from firing the event
                if (timer) {
                    clearTimeout(timer);
                    timer = null;
                }
            }

            onlongtouch = function() { 
                timer = null;
                alert("Hello!");
                document.getElementByClassName('answer').innerText+='pressed\n'; 
            };

            document.addEventListener("DOMContentLoaded", function(event) { 
                window.addEventListener("touchstart", touchstart, false);
                window.addEventListener("touchend", touchend, false);
            });

            
        });
    </script>
</body>
</html>