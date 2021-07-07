<?php
session_start();
include("../../includes/config.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if(isset($_GET['confirm'])){
    
    //Generate Password
    function password_generate($chars) {
        $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
        return substr(str_shuffle($data), 0, $chars);
    }

    $temp_pass = password_generate(10);
      
    //Update the user status to approved
    $id = $_GET['confirm'];
    $conn->query("UPDATE users SET status='APPROVED', password='$temp_pass' WHERE userid='$id' ") or die($conn->error);

    // Send Credentials
    $fetch_user = "SELECT *  FROM users WHERE userid='$id';";
            $result = $conn->query($fetch_user);
            $row = $result->fetch_assoc();
            
            $fname = $row['fname'];
            $mname = $row['mname'];
            $lname = $row['lname'];
            $username = $row['username'];
            $userEmail = $row['email'];

            $full_name = $fname . " " . $mname . ". " . $lname;

    $name = $full_name;
    $email = $userEmail;
    $subject = "ENHS New User Approved!";
    $body = "Good day! " . $name . 
    "You can now access the school's payment system." . "\n"
    . "username: ". $username . "\n"
    . "password: " . $temp_pass . "\n"
    . " . Please change your password immediately once you succesfully login. Thank you.";

    require '../libraries/PHPMailer/PHPMailer.php'; 
    require '../libraries/PHPMailer/SMTP.php'; 
    require '../libraries/PHPMailer/Exception.php';

    $mail = new PHPMailer();

    try {
																				
        $mail->setFrom('no-reply@howcode.org', 'ENHS Payment System');
        $mail->addAddress($email, $name);
        $mail->Subject = $subject;
        $mail->Body = $body;
        
        /* SMTP parameters. */
        
        /* Tells PHPMailer to use SMTP. */
        $mail->isSMTP();
        
        /* SMTP server address. */
        $mail->Host = 'smtp.gmail.com';

        /* Use SMTP authentication. */
        $mail->SMTPAuth = TRUE;
        
        /* Set the encryption system. */
        $mail->SMTPSecure = 'ssl';
        
        /* SMTP authentication username. */
        $mail->Username = 'stevenskie9090@gmail.com';
        
        /* SMTP authentication password. */
        $mail->Password = 'mcsoingviamkbnel';
        
        /* Set the SMTP port. */
        $mail->Port = 465;
        
        /* Finally send the mail. */
        $mail->send();
    }
    catch (Exception $e)
    {
        echo $e->errorMessage();
    }
    catch (\Exception $e)
    {
        echo $e->getMessage();
    }

    $_SESSION['message'] = "Confirmation completed, account credential emailed to the new user";
    $_SESSION['msg_type'] = "success";

    header("location: ../index.php");
}
