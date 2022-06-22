<?php
require("actions/users/securityAction.php");
require("actions/posts/myQuestions.php");
require("actions/users/changeUsername.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Posts | InterCollege</title>
    <link rel="stylesheet" href="assets/css/posts.css">
    <link rel="stylesheet" href="assets/css/modal.css">
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

    <div class="content">
        <!--<div class="settings">
        <div class="theme-toggle">
    <h2></h2>
    <label class="switch">
      <input type="checkbox" onclick="switchTheme()">
      <span class="slider"></span>
    </label>
  </div>
        </div>-->
        <div class="settings">
            <div class="username-container">
                <?= $_SESSION["username"]; ?><i class="fa-solid fa-pen-to-square" onclick="window.location.href='#changeUsername'"></i><i class="fa-solid fa-arrow-right-from-bracket" onclick="window.location.href='actions/users/logOutAction.php'" style="margin-left: 10px;"></i>
               
            </div>
            <div class="private-container">
                

                <?php

                $isPrivate = $bdd->prepare("SELECT private FROM users WHERE id = ?");
                $isPrivate->execute(array($_SESSION["id"]));

                $privateStatus = $isPrivate->fetch();
                ?>

                <form method="GET" id="privateForm">
                    <button name="passprivate" type="submit" class="privateBtn <?php if($privateStatus["private"] == "private"){echo "private";}else{echo "public";} ?>">
                        <?php if($privateStatus["private"] == "private"){echo "Go public";}else{echo "Go private";} ?>
                    </button>
                </form>
            </div>
        </div>
        <h1 class="title-post">My posts</h1>
        <div class="posts">
            <?php
            while($question = $getQuestions->fetch()){
                ?>
                <div class="card">
                    <div class="head" onclick="window.location.href='post.php?p=<?= $question['id'] ?>'">
                        <div class="title">
                            <?= $question['title']; ?>
                        </div>
                        <div class="date">
                            <?= ", ".$question['publication_date']; ?>
                        </div>
                    </div>
                    <div class="content-card" onclick="window.location.href='post.php?p=<?= $question['id'] ?>'">
                        <?= "<div class='readMore'>" . $question['content'] . "</div>"; ?>
                    </div>
                    <div class="footer">
                        <div class="modifyBtn">
                            <button onclick="window.location.href='editpost.php?id=<?= $question['id']; ?>'">Modify the post</button>
                        </div>
                        <div class="deleteBtn">
                            <button onclick="window.location.href='actions/posts/deleteQuestion.php?id=<?= $question['id']; ?>'"><i class="fa-solid fa-trash-can"></i></button>
                        </div>
                        <div class="statsBtn">
                            <button onclick="window.location.href='actions/posts/?id=<?= $question['id']; ?>'">Stats  <i class="fa-solid fa-square-poll-vertical"></i></button>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>

    <div id="changeUsername" class="modal">
		<div class="modal_content">
            <h1 style="text-align: center; color: #8E919A;">Change Username</h1>
            
                <form method="POST">
                <?php
      
                    if(isset($errorMsg)){
                        echo "<div class='alert-msg' role='alert' style='color: red;'>".$errorMsg."</div>";
                    }

                ?>
                    <p>
                        <br>
                            Set your new username :
                        
                        <br>
                        <br style="color: black;">
                    </p>
                    <input type="text" name="newusername" class="input-username">
                    <br><br>
                    <button type="submit" style="background-color: #F05454; color: #grey; border: none; border-radius: 10px; padding: 20px 130px; width: 100%; color: white;" name="changeusername">Change </button>
                </form>
                <a href="#" class="modal_close">&times;</a>
		</div>
    </div>

    <script src="assets/js/scroll.js"></script>
    <script src="assets/js/maxstr.js"></script>
    <script>

        $(function(){
            $("#privateForm").submit(function (e){
                e.preventDefault();
                if("<?= $privateStatus["private"]; ?>" == "private"){
                    $.get("changestatus.php", { pass : "public" } );
                }
                
                if("<?= $privateStatus["private"]; ?>" == "public"){
                    $.get("changestatus.php", { pass : "private" } );
                }

                window.location.reload();

            });
        });
    </script>
</body>
</html>