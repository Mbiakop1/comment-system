<?php
session_start();
include_once "./includes/config.php";




// add  replies
if(isset($_POST['add_subreplies'])){
    $cmt_id = $_POST['comment_id'];
    $reply_msg = $_POST['reply_msg'];
    $user_id = $_SESSION['user_id'];
    $date = date('Y-m-d H:i:s');

    $sql = "INSERT INTO replies VALUES ('', '$user_id', '$cmt_id', '$reply_msg', '$date')";
     // use exec() because no results are returned
     $con->exec($sql);
    echo "Reply created  successfully";

}

//  load replies
if(isset($_POST['view_comment_data'])){
    $cmt_id = $_POST['cmt_id'];
    $sql ="SELECT * FROM replies WHERE comment_id='$cmt_id'";
    $reply_query= $con -> prepare($sql);
    $reply_query-> execute();
    $reply_results=$reply_query->fetchAll();

    $result_array = [];

      if($reply_query->rowCount() > 0){
         foreach($reply_results as $result){
            $user_id = $result['user_id'];
             $sql_user_reply="SELECT * FROM users WHERE id='$user_id' LIMIT 1";
                $query_user_reply= $con -> prepare($sql_user_reply);
                $query_user_reply-> execute();
                $user_result=$query_user_reply->fetch(PDO::FETCH_ASSOC);

                array_push($result_array, ['cmt'=>$result, 'user'=>$user_result]);
         }
         header('Content-type: application/json');
           echo json_encode($result_array);
      } else {
          echo "No replies yet";
      }
}



// add  replies
if(isset($_POST['add_reply'])){
    $cmt_id = $_POST['comment_id'];
    $reply = $_POST['reply_msg'];
    $user_id = $_SESSION['user_id'];
    $date = date('Y-m-d H:i:s');

    $sql = "INSERT INTO replies VALUES ('', '$user_id', '$cmt_id', '$reply', '$date')";
     // use exec() because no results are returned
     $con->exec($sql);
    echo "Reply created  successfully";

}



//  load comments
if(isset($_POST['comment_load_data'])){
    $sql ="SELECT * FROM comments";
    $query= $con -> prepare($sql);
    $query-> execute();
    $results=$query->fetchAll();

    $array_result = [];

      if($query->rowCount() > 0){
         foreach($results as $result){
            $user_id = $result['user_id'];
             $sql_user="SELECT * FROM users WHERE id='$user_id' LIMIT 1";
                $query_user= $con -> prepare($sql_user);
                $query_user-> execute();
                $results_user=$query_user->fetch(PDO::FETCH_ASSOC);

                array_push($array_result, ['cmt'=>$result, 'user'=>$results_user]);
         }
         header('Content-type: application/json');
           echo json_encode($array_result);
      } else {
          echo "Leave a comment";
      }
}


 

//  Add comments

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