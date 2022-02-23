<?php
    session_start();


echo'<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


        <style>
            .categories{
                min-height: 185px;
            }
        </style>
    <title>iDiscuss</title>
</head>

<body>';
?>

    <?php include "partials/header.php" ?>
    <?php include "partials/_dbconnect.php" ?>

    <?php 

            if(!empty($_SESSION['signupsuccess'])){
                echo '
                    <div class="alert alert-success alert-dismissible fade show my-0" role="alert">
                    <strong>Registered </strong>Your registration has been completed successfully
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    ';  
                unset($_SESSION['signupsuccess']);
            }

            if(!empty($_SESSION['NotMatched'])){
                echo '
                    <div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
                    <strong>Failed!! </strong> Password should be same
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    ';  
                unset($_SESSION['NotMatched']);
            }

            if(!empty($_SESSION['alreadyExist'])){
                echo '
                    <div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
                    <strong>Failed! </strong>User already exist
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    ';  
                unset($_SESSION['alreadyExist']);
            }

            if(!empty($_SESSION['invalidPassword'])){
                echo '
                    <div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
                    <strong>Failed! </strong>Password does not match.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    ';  
                unset($_SESSION['invalidPassword']);
            }

            if(!empty($_SESSION['invalidEmail'])){
                echo '
                    <div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
                    <strong>Failed! </strong>User doesn\'t found.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    ';  
                unset($_SESSION['invalidEmail']);
            }
            
   


//   slider start from here
   echo '<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://source.unsplash.com/2400x700/?coding,python" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/2400x700/?Hacking,programmer" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/2400x700/?computing,blockchain" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>




    <!-- Category start from here -->
    <div class="container categories my-3">
        <h2 class="text-center my-3">iDiscuss - Browse Category</h2>
        <div class="row">';
    
    ?>

            <!-- Fetch all the category from the database -->
            <?php
             
             $sql = "SELECT * FROM category";
             $result = mysqli_query($conn, $sql);

             while($row = mysqli_fetch_assoc($result)){
              //  echo $row['category_name']." --> ".$row['category_description']." --> ".$row['created'];
              //  echo "<br>";

                 echo '<div class="col-md-3 my-3">
                  <div class="card" style="width: 18rem;">
                     <img src="https://source.unsplash.com/500x400/?'.$row['category_name'].',coding" class="card-img-top" alt="...">
                     <div class="card-body">
                         <h5 class="card-title"><a href="threadlist.php?catid='.$row['category_id'].'" style="text-decoration:none;">'.$row['category_name'].'</a></h5>
                         <p class="card-text">'.substr($row['category_description'],0, 50).'...</p>
                         <a href="threadlist.php?catid='.$row['category_id'].'" class="btn btn-primary">View Threads</a>
                     </div>
                  </div>
                </div>';
             }
         ?>


            

        </div>

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