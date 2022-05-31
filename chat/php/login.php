<?php 
    session_start();
    include_once "config.php";
    $pseudo = mysqli_real_escape_string($conn, $_POST['pseudo']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    if(!empty($pseudo) && !empty($password)){
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE pseudo = '{$pseudo}'");
        if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
            $user_pass = md5($password);
            $enc_pass = $row['password'];
            if($user_pass === $enc_pass){
                $status = "Active now";
                $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");
                if($sql2){
                    $_SESSION['unique_id'] = $row['unique_id'];
                    echo "success";
                }else{
                    echo "Something went wrong. Please try again!";
                }
            }else{
                echo "Pseudo or Password is Incorrect!";
            }
        }else{
            echo "$email - This pseudo not Exist!";
        }
    }else{
        echo "All input fields are required!";
    }
?>