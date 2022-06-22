<?php  
        
require("actions/users/securityAction.php");
require("actions/channels/createChannel.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a channel | InterCollege</title>
    <link rel="stylesheet" href="assets/css/publish.css">
    <link rel="stylesheet" href="assets/css/scrollbar.css">
    <script src="assets/js/scroll.js"></script>
    <script src="assets/js/typewriter.js"></script>
    <script src ="https://cdn.jsdelivr.net/npm/typelighterjs/typelighter.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<body>
    <?php include "includes/navbar.php"; ?>
    <div class="form-box">
        <h1 class="title-post">Create 
            <span class="typeWriter" data-text='["a channel", "friendships"]'>

            </span>
        </h1>
        <form method="POST">

        <?php
        
            if(isset($errorMsg)){
                echo "<div class='alert-msg' role='alert'>".$errorMsg."</div>";
            }

        ?>
            <input type="text" placeholder="Name of the channel" id="input-form" name="title"><br>
            <button type="submit" class="btn-form" name="create" onclick="check" id="create">Create</button><br>
        
        </form>
    </div>
    
</body>
</html>