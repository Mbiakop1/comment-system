<!-- Modal -->
<div class="modal fade" id="login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Login Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="login.php" method="POST">

                <div class="modal-body">
                    <div class="form-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="enter email">
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="enter password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn btn-primary">login</button>
                </div>
            </form>
        </div>
    </div>
</div>



<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">comment system</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <?php
                      if(isset($_SESSION['user_name'])){
                       ?>
                    <a class="nav-link" href="logout.php">Logout</a>
                    <?php
                      } else {
                          ?>
                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#login">Login</a>
                    <?php
                      }
                    ?>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <?php 
                                if(isset($_SESSION['user_name'])){
                                    echo $_SESSION['user_name'];
                                }
                            ?>

                    </a>
                </li>
        </div>
    </div>
</nav>