<?php
    session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
        #ques{
            min-height: 87.5vh; 
        }
        .jumbotron{
            background-color: #95ae95;
            padding: 41px;
            border-radius: 10px;
        }
    </style>
    <title>Threads - iDiscuss</title>
</head>

<body>

    <?php include "partials/header.php" ?>
    <?php include "partials/_dbconnect.php" ?>

    <?php

        $isInserted = false;    
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $id = $_GET['thread_id'];
            $content = $_POST['comment'];
            $content = str_replace("<", "&lt;", $content);
            $content = str_replace(">", "&gt;", $content);
           
            $comment_by = $_SESSION['userid'];

            $sql = "INSERT INTO comments (`comment_by`,`comment_content`, `thread_id`) VALUES ('$comment_by','$content', '$id')";
            $result = mysqli_query($conn, $sql);
            $isInserted = true;
        }

        if($isInserted){
            echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Successfully posted</strong> Your concern has been posted🤩
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ';
        }


    ?>


    <div class="container" id="ques">

        <?php
            $id = $_GET['thread_id'];
            $sql = "SELECT * FROM threads WHERE thread_id=$id";
            $result = mysqli_query($conn, $sql);
            
            while($row = mysqli_fetch_assoc($result)){
                $thread_id = $row['thread_id'];
                $thread_tittle = $row['thread_tittle'];
                $thread_desc = $row['thread_desc'];

                // Fetching user id 
                $thread_user_id = $row['thread_user_id'];
                $sql_for_user = "SELECT name FROM users WHERE sno='$thread_user_id'";
                $result_for_user = mysqli_query($conn, $sql_for_user);
                $row_for_user = mysqli_fetch_assoc($result_for_user);

                echo '<div class="container my-3">
                <div class="jumbotron">
                    <h1 class="display-4"><b>'.$thread_tittle.'</b></h1>
                    <p class="lead"><?php echo $catdesc; ?> </p>
                    <hr class="my-4">
                    <p>'.$thread_desc.'</p>
                    <p>Posted by : <em><b>'.$row_for_user['name'].'</b></em></p>
                </div>
        
            </div>';
            }

        ?>

<?php

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    echo '<div class="container">
                <h1 class="my-3">Post your comment</h1>

                <form action="'.$_SERVER['REQUEST_URI'].'" method="POST">
                    
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1" class="my-2">Type your comment</label>
                        <textarea class="form-control" name="comment" id="desc" rows="3"></textarea>
                    </div>

                    <button type="submit" name="submit" class="btn btn-success my-3">Post Comment</button>
                </form>
            </div>';
}
else{
    echo'
    <div class="container">
        <p  class="lead text-danger">You are not logged in. Please login to be able to post comment.</p>
    </div>
    ';
}
?>

       
        <?php
            $id = $_GET['thread_id'];
            $sql = "SELECT * FROM comments WHERE thread_id=$id";
            $result = mysqli_query($conn, $sql);

            $numRows = mysqli_num_rows($result);
            
            if($numRows>0){
                while($row=mysqli_fetch_assoc($result)){
                    $comment_id = $row['comment_id'];
                    $comment_content = $row['comment_content'];

                // fetching user data for thread 
                    $thread_user_id = $row['comment_by'];
                    $sqluser = "SELECT * FROM users WHERE sno='$thread_user_id'";
                    $userresult = mysqli_query($conn, $sqluser);
    
                    $userrow = mysqli_fetch_assoc($userresult);
    
                    echo '
                    <div class="media d-flex align-items-center my-4">
                        <img src="img/userdefault.png" width="54px" class="mr-3" alt="...">
                        <div class="media-body ">
                            <h5 class="mx-3 my-0"> '.$userrow['name'].' at '.$row['comment_time'].' </h5>
                            <p class="mt-0"><a href="thread.php?thread_id='.$thread_id.'" class="text-dark 
                            text-decoration-none mx-3">'.$comment_content.'</a></p>
                        
                        </div>
                </div>
                    ';
                }
            }
            else{
                echo '<div class="jumbotron jumbotron-fluid my-3">
                <div class="container">
                  <p class="display-4">There is no comment</p>
                  <p class="lead"> Please give some solutions. </p>
                </div>
              </div>';
            }

           


        ?>

 
    </div>



    <?php include "partials/footer.php" ?>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>