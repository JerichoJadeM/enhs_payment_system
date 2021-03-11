<?php
session_start();
include ('../../includes/config.php');
//sending messages
if(isset($_POST['send'])){

    $fullname = $_POST['name'];
    $position = $_POST['position'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $mes = $_POST['inquiry'];
    $subject = $_POST['subject'];

    $sql = $conn->query("INSERT INTO messages
    (name, position, phone, email, subject, message, dateRecieved)
    VALUES
    ('$fullname', '$position', $phone, '$email', '$subject', '$mes', CURRENT_DATE())") or
     die($conn->error);

     /*
     function itexmo($number,$message,$apicode,$passwd){
        $url = 'https://www.itexmo.com/php_api/api.php';
        $itexmo = array('1' => $number, '2' => $message, '3' => $apicode, 'passwd' => $passwd);
        $param = array(
          'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($itexmo),
          ),
        );
        $context  = stream_context_create($param);
        return file_get_contents($url, false, $context);
      }
      //##########################################################################
        $textMsg = $fullname . " we have received your message, please wait for our reply to your email address within 24hrs thank you. ";

        $msgResult = itexmo($phone,$textMsg,"TR-JERIC658119_ATIQY", "ji@qat8z!9");
        if ($msgResult == ""){
        echo "iTexMo: No response from server!!!
        Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.	
        Please CONTACT US for help. ";	
        }else if ($msgResult == 0){
          */

          $_SESSION['message'] = "Your message has been sent, Please wait for our reply to your email within 24 hrs.";
          $_SESSION['msg_type'] = "success";

          header("location: ../../index.php");

          /*
        }
        else{	
        echo "Error Num ". $msgResult . " was encountered!";
        }
        */
} 
?>