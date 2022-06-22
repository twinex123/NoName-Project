<?php

require("actions/users/securityAction.php");
require("actions/posts/getInfosOfEditedQuestion.php");
require("actions/posts/editPost.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit My Posts | InterCollege</title>
    <link rel="stylesheet" href="assets/css/edit.css">
    <link rel="stylesheet" href="assets/css/publish.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<body>
    <?php include "includes/navbar.php"; ?>
    <div class="form-box">
        
        <h1 class="title-post">Modify a post</h1>
        <?php
            
            if(isset($errorMsg)){
                echo "<div class='alert-msg' role='alert'>".$errorMsg."</div>";
            }

        ?>
        <?php
            if(isset($postContent)){
                ?>
                <form method="POST">
                    <input type="text" placeholder="Title" id="input-form" name="title" value="<?php echo $postTitle; ?>"><br>
                    <textarea type="text" placeholder="Content" name="content" cols="215" rows="20"><?php echo $postContent; ?></textarea><br>
                    <button type="submit" class="btn-form" name="modify">Modify</button><br>
                </form>
                <?php
            }
        ?>
    </div>
    <script src="assets/js/scroll.js"></script>
</body>
</html>