<?php
require("actions/users/securityAction.php");
require("actions/posts/myQuestions.php");
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
    <style>
        .User a{
            color: white;
        }
    </style>

    <?php include 'includes/navbar.php'; ?>

    <div class="content">
        <h1 class="title-post">My posts</h1>
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
                            <?= ", ".$question['publication_date']; ?>
                        </div>
                    </div>
                    <div class="content-card">
                        <?= $question['content']; ?>
                    </div>
                    <div class="footer">
                        <div class="modifyBtn">
                            <button onclick="window.location.href='editpost.php?id=<?= $question['id']; ?>'">Modify the post</button>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <script src="assets/js/scroll.js"></script>

</body>
</html>