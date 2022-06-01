<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/navbar.css">
    <script src="https://kit.fontawesome.com/29ce918257.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="navigation">
        <div class="userBx">
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
                <a href="index.php"><i class="fa-solid fa-right-from-bracket"></i></a>
            </div>
        </div>
    </div>
</body>
</html>