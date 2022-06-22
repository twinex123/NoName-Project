<?php

require("../config.php");

if(isset($_GET["passprivate"]) AND !empty($_GET["passprivate"])){
    if($_GET["passprivate"] == "yes"){
        $updateStatus = $bdd->prepare("UPDATE users SET private = ? WHERE id = ?");
        $updateStatus->execute(array("yes", $_SESSION["id"]));
    }else{
        $updateStatus = $bdd->prepare("UPDATE users SET private = ? WHERE id = ?");
        $updateStatus->execute(array("no", $_SESSION["id"]));
    }
}