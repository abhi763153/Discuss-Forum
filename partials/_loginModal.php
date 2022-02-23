<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login to iDiscuss</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-3 py-3">
                <!-- Login form start -->

                <form action="/forum/partials/handleLogin.php" method="post">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="loginEmail" id="loginEmail" aria-describedby="emailHelp" required>
                        
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" name="loginPassword" id="loginPassword" required>
                    </div>
                    <div class="d-flex flex-row-reverse my-2">
                        <button type="submit" class="btn btn-primary px-4 mx-3">Login</button>
                    </div>
                    
                </form>
                <!-- Login form end -->

            </div>
       
        </div>
    </div>
</div>