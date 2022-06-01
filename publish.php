<?php  
        
require("actions/users/securityAction.php");
require("actions/posts/postQuestion.php");

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<body>
    <?php include "includes/navbar.php"; ?>
    <div class="form-box">
        <h1 class="title-post">Post a</h1>
        <form method="POST">

        <?php
        
            if(isset($errorMsg)){
                echo "<div class='alert-msg' role='alert'>".$errorMsg."</div>";
            }

        ?>
            <input type="text" placeholder="Title" id="input-form" name="title"><br>
            <textarea type="text" placeholder="Content" name="content" cols="207" rows="20" ></textarea><br>
            <button type="submit" class="btn-form" name="publish">Publish</button><br>
        
        </form>
    </div>
</body>
</html>