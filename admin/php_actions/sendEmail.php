<?php 
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['reply'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $body = $_POST['editor'];

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
     
    $_SESSION['message'] = "Your message was successfully sent to " . $name . " (" . $email . ")";
    $_SESSION['msg_type'] = "success";

    header('location: ../inquiries.php');
}
?>