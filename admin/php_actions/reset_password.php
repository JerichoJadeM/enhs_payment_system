<?php
session_start();
include("../../includes/config.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['reset_password'])) {

    $requesterEmail = $_POST['email'];

    $resultCount = $conn->query("SELECT count(userid) as total FROM users WHERE email = '$requesterEmail'") or die($conn->error);
    $rowCount = $resultCount->fetch_assoc();

    if ($rowCount['total'] <= 0) {
        $_SESSION['message'] = "The email address your provided does not match with our records.";
        $_SESSION['msg_type'] = "danger";

        header("location: ../index.php");
    } else {
        //Generate Password
        function password_generate($chars)
        {
            $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
            return substr(str_shuffle($data), 0, $chars);
        }

        $temp_pass = password_generate(10);

        //Update the user status to approved
        $conn->query("UPDATE users SET status='APPROVED', password='$temp_pass' WHERE email='$requesterEmail' ") or die($conn->error);

        // Send Credentials
        $fetch_user = "SELECT *  FROM users WHERE email='$requesterEmail';";
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
        $subject = "Password Reset";
        $body = "Good day! " . $name .
            " .Here is your new password." . "\n"
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
        } catch (Exception $e) {
            echo $e->errorMessage();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        $_SESSION['message'] = "Password reset completed please check your email.";
        $_SESSION['msg_type'] = "success";

        header("location: ../index.php");
    }
}
