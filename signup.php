<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | </title>
    <link rel="stylesheet" href="assets/css/register.css">
</head>
<body>
  <?php require("actions/users/signup.php"); ?>
  <div class="login-box">
    <h1>Sign up</h1>
    <form method="POST">

      <?php
      
        if(isset($errorMsg)){
            echo "<div class='alert-msg' role='alert'>".$errorMsg."</div>";
        }

      ?>
      <input type="text" placeholder="Username" id="login-input" name="username">
      <input type="password" placeholder="Password" id="login-input" name="password">
      <input type="password" placeholder="Repeat password" id="login-input" name="repeat-password">
      <button type="submit" id="login-button" name="submit">Sign up</button>
      <br>
      <div class="sep">
        <p>Already signed up? <a href="login.php">Login</a></p>
      </div>
    </form>
  </div>

  <div class="theme-toggle">
    <h2></h2>
    <label class="switch">
      <input type="checkbox" onclick="switchTheme()">
      <span class="slider"></span>
    </label>
  </div>
</body>
<script src="lang/checkLanguage.js"></script>
<script src="assets/js/form.js"></script>
</html>