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
    #ques {
        min-height: 391px;
    }

    .jumbotron {
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
        $id = $_GET['catid'];
        $sql = "SELECT * FROM category WHERE category_id=$id";
        $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($result)){
            $catname = $row['category_name'];
            $catdesc = $row['category_description'];
        }
    
    ?>
    
    <?php

       
       

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
               
                if(isset($_POST['submit'])){
                    $tittle = $_POST['tittle'];
                    $tittle = str_replace("<", "&lt;", $tittle);
                    $tittle = str_replace(">", "&gt;", $tittle);
                    
                    $description = $_POST['description'];
                    $description = str_replace("<", "&lt;", $description);
                    $description = str_replace(">", "&gt;", $description);
 
                    $thread_cat_id = $_GET['catid'];
                    $userid = $_SESSION['userid'];
                    
                    
                    $sql = "INSERT INTO threads (`thread_tittle`, `thread_desc`, `thread_cat_id`, `thread_user_id`) VALUES ('$tittle', '$description', '$thread_cat_id','$userid')";
                    $result = mysqli_query($conn, $sql);
                    
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Successfully posted</strong> Your concern has been posted🤩
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                } 
            }

        
    ?>

    <div class="container my-3">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catname; ?> forum</h1>
            <p class="lead"><?php echo $catdesc; ?> </p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
            <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
        </div>

    </div>

<?php

    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
        echo '<div class="container">
                <h1 class="my-3">Start discussion</h1>
                <form action="'.$_SERVER['REQUEST_URI'].'" method="POST">
                    <div class="form-group">
                        <label for="tittle">Tittle</label>
                        <input type="text" class="form-control" name="tittle" id="tittle" aria-describedby="emailHelp"
                            placeholder="">
                        <small id="tittleText" class="form-text text-muted ">Keep tittle size as short and crisp as you
                            can</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1" class="my-2">Elaborati your concern</label>
                        <textarea class="form-control" name="description" id="desc" rows="3"></textarea>
                    </div>

                    <button type="submit" name="submit" class="btn btn-success my-3">Submit</button>
                </form>
            </div>';
    }
    else{   
        echo '
        <div class="container">
            <p class="lead">You are not logged in. Please login to be able to start a discussion.</p>
        </div>
        ';
    }
?>

    

    <div class="container" id="ques">
        <h1 class="my-4">Browse Questions</h1>

        <?php
            $id = $_GET['catid'];
            $sql = "SELECT * FROM threads WHERE thread_cat_id=$id";
            $result = mysqli_query($conn, $sql);
            
            $noResult = true;
            while($row = mysqli_fetch_assoc($result)){
                $noResult = false;
                $thread_id = $row['thread_id'];
                $thread_tittle = $row['thread_tittle'];
                $thread_desc = $row['thread_desc'];
                
                // fetching user data for thread 
                $thread_user_id = $row['thread_user_id'];
                $sqluser = "SELECT * FROM users WHERE sno='$thread_user_id'";
                $userresult = mysqli_query($conn, $sqluser);

                $userrow = mysqli_fetch_assoc($userresult);


                echo ' <div class="media d-flex my-3">
                <img src="img/userdefault.png" width="54px" height="70px" class="mr-3 mx-3" alt="...">
                <div class="media-body ">
                    <p class=" my-0">'.$userrow['name'].' at '.$row['timeStamp'].' </p>
                    <h5 class="mt-0"><a href="thread.php?thread_id='.$thread_id.'" class="text-dark text-decoration-none">'. $thread_tittle.'</a></h5>
                    <p>'.$thread_desc.'</p>
                </div>
            </div>';
            }

            if($noResult){
                echo '<div class="jumbotron jumbotron-fluid">
                <div class="container">
                  <p class="display-4">No Result Found!</p>
                  <p class="lead"> Be the first to ask a question </p>
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