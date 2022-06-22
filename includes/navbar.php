<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/navbar.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/29ce918257.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/swup@latest/dist/swup.min.js"></script>  
</head>
<body>
    <div class="navigation">
        <div class="userBx">
            <?php
            $url = $_SERVER['PHP_SELF']; 
            $reg = '#^(.+[\\\/])*([^\\\/]+)$#';
            $url_courante = preg_replace($reg, '$2', $url);
            if(isset($_SERVER['HTTP_REFERER']) AND $url_courante != "room.php"){
            ?>
            
                <i class="fa-solid fa-angle-left" onclick="window.location.href='<?php echo $_SERVER['HTTP_REFERER']; ?>'"></i>

                <script>
                    $(document).ready(function(){
                        $(".username").css("margin-left", "20px");
                    })
                </script>    

            <?php
            }
            ?>

            <p class="username"><?php echo $_SESSION['username']; ?></p>
        </div>
        <div class="tools">
            <div class="User">
                <a href="myposts.php"><i class="fa-solid fa-image-portrait"></i></a>
            </div>
            <div class="WriteQuestion">
                <a href="publish.php"><i class="fa-solid fa-pen"></i></a>
            </div>
            <div class="QuitRoom">
                <a href="room.php"><i class="fa-solid fa-house"></i></a>
            </div>
        </div>
    </div>
</body>
</html>