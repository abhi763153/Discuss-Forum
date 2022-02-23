<?php 

echo '
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
            <a class="navbar-brand" href="/forum">iDiscuss</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/forum">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Blogs</a>
                </li>
                
                
            </ul>
            <div class=" d-flex mx-2">
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-success mx-2" type="submit">Search</button>
                </form>';

                if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true){
                    echo '<div class="d-flex align-self-center"><p class="text-white mx-2 my-0">'.$_SESSION['username'].'</p></div>'.'<button class="btn btn-outline-success"><a href="/forum/partials/handleLogout.php" class="text-decoration-none text-success">Logout</a></button>';
                }
                else{
                    echo '
                        <button class="btn btn-outline-success " data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                        <button class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#signupModal">Sign Up</button>
                    ';
                }
               

            echo'</div>
    </div>
  </div>
</nav>
';
    include 'partials/_loginModal.php';
    include 'partials/_signupModal.php';

?>