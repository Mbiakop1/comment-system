<?php
session_start();
include_once "./includes/config.php";

// add  replies
if(isset($_POST['add_subreplies'])){
    $cmt_id = $_POST['cmt_id'];
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
          echo json_encode($result_array);
      }
}



// add  replies
if(isset($_POST['add_reply'])){
    $cmt_id = $_POST['comment_id'];
    $reply = $_POST['reply_msg'];
    $user_id = $_SESSION['user_id'];
    $date = date('Y-m-d H:i:s');
    $cmt_email = $_POST['cmt_email'];
    $cmt_body = $_POST['cmt_body'];
    
    $sql = "INSERT INTO replies VALUES ('', '$user_id', '$cmt_id', '$reply', '$date')";

     // use exec() because no results are returned
     $con->exec($sql);

     if($user_id == 1){
         require_once("assests/PHPMailer/PHPMailer.php");
        require_once("assests/PHPMailer/SMTP.php");
         
         
                $name = "Mbiakop clinton";
               
                $subject = "comment replied";
                $message = "Dear user this message is to notify you that your comment" . "<br>" . $cmt_body . "<br>" . " has been replied by $name" ;
                
                
                
                $mail = new PHPMailer\PHPMailer\PHPMailer();
                $mail->IsSMTP(); // enable SMTP
        
                $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
                $mail->SMTPAuth = true; // authentication enabled
                $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
                $mail->Host = "smtp.gmail.com";
                $mail->Port = 465; // or 587
                $mail->IsHTML(true);
                $mail->Username = "mbutiji1@gmail.com";  
                $mail->Password = "developer-8081";  
                $mail->SetFrom($cmt_email, $name);
                $mail->Subject = $subject;
                $mail->Body = $message;
                $mail->AddAddress($cmt_email); 
                
                if(!$mail->Send()) {
                    echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
         
        }
        
        
     } 


    echo "Reply created  successfully " . $cmt_body;

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