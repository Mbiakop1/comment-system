<?php
session_start();
include_once "./includes/config.php";


if(isset($_POST['comment_load_data'])){
    $sql ="SELECT * FROM comments";
    $query= $con -> prepare($sql);
    $query-> execute();
    $results=$query->fetch(PDO::FETCH_ASSOC);

      if($query->rowCount() > 0){
         foreach($results as $result){

            $user_id = $result['user_id'];
         }
      } else {
          echo "Leave a comment";
      }
}


 


if(isset($_POST['add_comment'])){
    $msg = $_POST['msg'];
    $user_id = $_SESSION['user_id'];
    $date = date('Y-m-d H:i:s');

    $sql = "INSERT INTO comments VALUES ('', '$user_id', '$msg', '1', '$date')";
     // use exec() because no results are returned
     $con->exec($sql);
    echo "New record created successfully";
}

?>