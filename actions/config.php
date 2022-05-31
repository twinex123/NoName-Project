<?php

try{
    session_start();
    $bdd = new PDO('mysql:host=localhost;dbname=fapp;charset=utf8', 'root', '');
}catch(Exception $e){
    die('A connection error occured : '. $e->getMessage());
}