
<?php

session_start();

    $isUserExist = false;
    $isInserted = false;

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include '_dbconnect.php';

        $name = $_POST['name'];
        $user_email = $_POST['signUpemail'];
        $user_pass = $_POST['password'];
        $user_cpass = $_POST['cpassword'];

        $sql = "SELECT * FROM users WHERE user_email='$user_email'";
        $result = mysqli_query($conn, $sql);

        $rows = mysqli_num_rows($result);
        

        if($rows>0){
            $_SESSION['alreadyExist'] = "exist";
            header("Location: /forum/index.php");
        }
        else{
            if($user_pass == $user_cpass){
                
                $hashpass = password_hash($user_pass, PASSWORD_DEFAULT);
                echo $hashpass;

                $sql = "INSERT INTO `users` (`name`, `user_email`, `user_pass`, `TimeStamp`) VALUES
                                 ('$name', '$user_email', '$hashpass', current_timestamp());";
                $result = mysqli_query($conn, $sql); 
                
                if($result){
                    $_SESSION['signupsuccess'] = "Registered";
                    header("Location: /forum/index.php");
                    exit();
                }
               
                
            }
            else{
                $_SESSION['NotMatched'] = "Not Matched";
                header("Location: /forum/index.php");  
            }

            

        }


    }
    
    

?>