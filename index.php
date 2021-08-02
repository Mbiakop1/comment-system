<?php
 include_once "./includes/header.php";
include_once "./includes/navbar.php";
?>

<?php
if(isset($_SESSION['status'])){
    ?>
<div class="alert"> <?= $_SESSION['status'] ?> </div>
<?php
unset($_SESSION['status']);
}

?>


<div class="py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card p-3">
                    <div class="card-body">
                        <h5 class="card-title">Blog title</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                            additional content. This content is a little bit longer. Lorem ipsum dolor sit amet
                            consectetur
                            adipisicing elit. Dolorum tempore blanditiis quod eius iure odit eligendi, provident
                            recusandae
                            voluptatum aspernatur voluptas expedita eveniet suscipit rem fugit impedit, amet unde eaque?
                        </p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                    <hr>

                    <div class="main_comment m-2">
                        <div id="error_status"></div>
                        <textarea class="form-control comment_textbox" id="" rows="2"></textarea>
                        <button id="add" type="button" class="btn btn-primary add_comment_btn m-1">Comment</button>
                    </div>
                    <hr>
                    <div class="comment_container">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include_once "./includes/footer.php" ?>