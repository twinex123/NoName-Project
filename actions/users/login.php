<?php

session_start();
require('actions/config.php');

if(isset($_POST['submit'])){
    if(!empty($_POST['username']) AND !empty($_POST['password'])){

        $username = htmlspecialchars($_POST["username"]);
        $password = htmlspecialchars($_POST["password"]);

        $checkIfUserExists = $bdd->prepare("SELECT * FROM users WHERE username = ?");
        $checkIfUserExists->execute(array($username));

        if($checkIfUserExists->rowCount() > 0){

            $usersInfos = $checkIfUserExists->fetch();

            if(password_verify($password, $usersInfos['password'])){

                $_SESSION['auth'] = true;
                $_SESSION['id'] = $usersInfos['id'];
                $_SESSION['username'] = $usersInfos['username'];
                
                header('Location: index.php');

            }else{
                $errorMsg = "Your password is incorrect.";
            }

        }else{
            $errorMsg = "This user is not registered.";
        }

    }else{
        $errorMsg = "All fields must be completed.";
    }
}