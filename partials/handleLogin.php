<?php

session_start();

    if($_SERVER['REQUEST_METHOD']=='POST'){
        include '_dbconnect.php';

        $email = $_POST['loginEmail'];
        $pass = $_POST['loginPassword'];
       
        $sql = "SELECT * FROM users where user_email='$email'";
        $result = mysqli_query($conn, $sql);
        
        if(mysqli_num_rows($result)==1){
            $row = mysqli_fetch_assoc($result);
       
            $hashPass = $row['user_pass'];

            if(password_verify($pass, $hashPass)){
               
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $row['name'];
                $_SESSION['userid'] = $row['sno'];
                header("Location: /forum/index.php");
            }
            else{
                
                $_SESSION['invalidPassword'] = "Login Failed";
                header("Location: /forum/index.php");
            }
        }
        else{
            $_SESSION['invalidEmail'] = "Login Failed";
            header("Location: /forum/index.php");
        }
        


    }

?>