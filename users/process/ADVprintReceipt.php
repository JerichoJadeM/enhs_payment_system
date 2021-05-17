<?php
    $db_server = "sql6.freemysqlhosting.net";
    $db_user = "sql6413038";
    $db_pass = "XSfWgaEnYH";
    $db_name = "sql6413038";

    // $db_server = "localhost";
    // $db_user = "root";
    // $db_pass = "";
    // $db_name = "thesis";

    $conn = new mysqli($db_server, $db_user, $db_pass, $db_name);

    if($conn->connect_error){
        die("Error Connection" . $conn->connect_error);
    }

    session_start();
    $user = $_SESSION['alogin'];

    $fetch_user = "SELECT fname, mname, lname, user_type FROM users WHERE username='$user';";
            $result = $conn->query($fetch_user);
            $row = $result->fetch_assoc();
            
            $fname = $row['fname'];
            $mname = $row['mname'];
            $lname = $row['lname'];
            $usertype = $row['user_type'];

   //payment process
   if(isset($_POST['submit'])){
    $LRN = $_POST['lrn'];
    $fullname = $_POST['fname'] . " " . $_POST['mname'] . "." . " " . $_POST['lname'];
    $gradesection = $_POST['grade'] . " - " . $_POST['section'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $payment_type = $_POST['payment_type'];
    $amountToPay = $_POST['amount'];
    $user = $_POST['user'];
    $usertype = $_POST['usertype'];
    
    $sendOption = $_POST['example'];

    $amountUpdate = $conn->query("SELECT amount FROM payment WHERE LRN = $LRN") or die($conn->error);
    $amountresult = $amountUpdate->fetch_assoc();
    $currentPaid = $amountresult['amount'];

      if($currentPaid == 700){
        $_SESSION['message'] = "Student is already fully paid!";
        $_SESSION['msg_type'] = "info";
      
            header("location: ../adv/index.php");
      }else{

        $amount = $amountToPay+$currentPaid;
        $RemainingBal = 700 - $amount;

    $sql = $conn->query("UPDATE payment SET fullname='$fullname', gradesection='$gradesection', address='$address', phone='$phone', payment_type='$payment_type', amount='$amount', cashier='$user', datepaid=CURRENT_DATE() WHERE LRN = '$LRN'") or die($conn->error);

    $activity = "Received miscellaneous fee of " . $fullname;
    $act = $conn->query("INSERT INTO activities (user_type, name, activity, activity_date)
    VALUES
    ('$usertype', '$user', '$activity', CURRENT_DATE())") or die($conn->error);

        if($sendOption == 1){
          //this condition will do both sending of SMS notification and printing of payment

          //##########################################################################
          // ITEXMO SEND SMS API - PHP - CURL-LESS METHOD
          //##########################################################################
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
            $textMsg = "Php " . $amount . ".00 total Misc fee paid by " . $fullname . ". Remaining Balance is Php " . $RemainingBal . ".00";

            $msgResult = itexmo($phone,$textMsg,"TR-JANVI394312_SW89W", "5hb3jg}vj7");
            if ($msgResult == ""){
              echo "iTexMo: No response from server!!!
              Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.	
              Please CONTACT US for help. ";	
              }else if ($msgResult == 0){
                $sql = $conn->query("SELECT * FROM payment WHERE LRN = $LRN LIMIT 1") or die($conn->error);
          $row = $sql->fetch_assoc();
        
          require('../../admin/libraries/fpdf182/fpdf.php');

          class PDF extends FPDF
          {
            // Page header
            function Header()
            {
                // Logo
                $this->Image('../../admin/libraries/fpdf182/tutorial/logo.png',20,8,30,0,'', '../adv/index.php');
                // Arial bold 15
                $this->SetFont('Arial','B',15);
                // Move to the right
                $this->Cell(80);
                // Title
                $this->Cell(110,6,'Estancia National High School',0,1,'R');
                $this->SetFont('Arial','',12);
                $this->Cell(190,6,'Brgy. Tacbuyan, Estancia, Iloilo',0,1,'R');
                $this->SetFont('Arial','',12);
                $this->Cell(190,6,'Contact #: 0997-865-8119',0,1,'R');
                // Line break
                $this->Ln(10);
            }
            // Page footer
            function Footer(){   
            }
          }

          // Instanciation of inherited class
          $result = $conn->query("SELECT LRN_number, Lname, Mname, Fname, GradeLevel, Section, GuardianName, GuardianNum, paymentID, amount FROM students
                      INNER JOIN payment on students.LRN_number = payment.LRN WHERE LRN_number=$LRN GROUP BY Lname LIMIT 1") or die($conn->error);
                      $count = 1;
                      $row = $result->fetch_assoc();

          $pdf = new PDF();
          $pdf->AddPage();

          $pdf->SetFont('Times','I',15);
          $pdf->cell(190,10, "** Official Receipt **", 0,1, 'C');

          $pdf->SetFont('Times','B',12);
          $pdf->cell(10,6, "Receipt No.: ", 0,0, 'L');
          $pdf->SetFont('Times','',12);
          $pdf->cell(23,6,' 00' . $row['paymentID'], 0,1, 'R');

          $pdf->SetFont('Times','B',12);
          $pdf->cell(10,6, "Date Issued: ", 0,0, 'L');
          $pdf->SetFont('Times','',12);
          $pdf->cell(69,6, date(DATE_RFC822), 0,1, 'R');

          $pdf->Ln(5);

          $pdf->SetFont('Times','B',12);
          $pdf->cell(20,6, "Student LRN No: ", 0,0, 'L');
          $pdf->SetFont('Times','',12);
          $pdf->cell(45,6, $LRN, 0,1, 'R');

          $pdf->SetFont('Times','B',12);
          $pdf->cell(20,6, "Student Name: ", 0,0, 'L');
          $pdf->SetFont('Times','B',12);
          $pdf->cell(45,6, $fullname, 0,0, 'R');
          $pdf->SetFont('Times','B',12);
          $pdf->cell(100,6, "Grade & Section: ", 0,0, 'R');
          $pdf->SetFont('Times','',12);
          $pdf->cell(17,6,$gradesection , 0,1, 'L');

          $pdf->SetFont('Times','B',12);
          $pdf->cell(20,6, "Billing Address: ", 0,0, 'L');
          $pdf->SetFont('Times','I',10);
          $pdf->cell(93,6, "(House #, Street, Village, Town/City, Province, Country)", 0,1, 'R');
          $pdf->SetFont('Times','',12);
          $pdf->cell(70,4, $address, 0,1, 'R');

          $pdf->Ln(4);

          $pdf->SetFont('Times','B',12);
          $pdf->Cell(40);
          $pdf->cell(50,10, "Payment Status", 1,0, 'C');
          $pdf->cell(50,10, "Paid Amount", 1,1, 'C');

          $pdf->SetFont('Times','',12);

                  $payment = $row['amount'];

                  if($payment == 700){
                    $payStat = "Full Paid";
                  }
                  elseif($payment>=350){
                    $payStat = "Partially Paid";
                  }
                  elseif(($payment<=150)&&($payment>=1)){
                    $payStat = "Promi";
                  }
                  else{
                    $payStat = "Not yet paid";
                  }

                  if(isset($_POST['submit']))
                  {
                    $todayAmount = $_POST['amount'];

                  $pdf->Cell(40);
                  $pdf->cell(50,10, $payStat, 1,0, 'C');
                  $pdf->cell(50,10, "Php " . $todayAmount . ".00", 1,1, 'C');
                  }
                      
            $pdf->Ln(5);
            $pdf->SetFont('Times','B',12);
            $pdf->cell(145,6, "Issued By: ", 0,0, 'R');
            $pdf->SetFont('Times','',12);
            $pdf->cell(20,6, $user, 0,1, 'L');
            $pdf->SetFont('Times','',12);
            $pdf->cell(173,6, $usertype, 0,1, 'R');

            $pdf->Ln(10);
            $pdf->SetFont('Times','B',12);
            $pdf->cell(10,3, "________________________________________________________________________________________", 0,1, 'L');

            $pdf->Ln(10);
              // Logo
              $pdf->Image('../../admin/libraries/fpdf182/tutorial/logo.png',20,151,30);
              // Arial bold 15
              $pdf->SetFont('Arial','B',15);
              // Move to the right
              $pdf->Cell(80);
              // Title
              $pdf->Cell(110,6,'Estancia National High School',0,1,'R');
              $pdf->SetFont('Arial','',12);
              $pdf->Cell(190,6,'Brgy. Tacbuyan, Estancia, Iloilo',0,1,'R');
              $pdf->SetFont('Arial','',12);
              $pdf->Cell(190,6,'Contact #: 0997-865-8119',0,1,'R');
              // Line break
              $pdf->Ln(10);


            $pdf->SetFont('Times','I',15);
          $pdf->cell(190,10, "** Student Copy **", 0,1, 'C');

          $pdf->SetFont('Times','B',12);
          $pdf->cell(10,6, "Receipt No.: ", 0,0, 'L');
          $pdf->SetFont('Times','',12);
          $pdf->cell(23,6, ' 00' . $row['paymentID'], 0,1, 'R');

          $pdf->SetFont('Times','B',12);
          $pdf->cell(10,6, "Date Issued: ", 0,0, 'L');
          $pdf->SetFont('Times','',12);
          $pdf->cell(69,6, date(DATE_RFC822), 0,1, 'R');

          $pdf->Ln(5);

          $pdf->SetFont('Times','B',12);
          $pdf->cell(20,6, "Student LRN No: ", 0,0, 'L');
          $pdf->SetFont('Times','',12);
          $pdf->cell(45,6, $LRN, 0,1, 'R');

          $pdf->SetFont('Times','B',12);
          $pdf->cell(20,6, "Student Name: ", 0,0, 'L');
          $pdf->SetFont('Times','B',12);
          $pdf->cell(45,6, $fullname, 0,0, 'R');
          $pdf->SetFont('Times','B',12);
          $pdf->cell(100,6, "Grade & Section: ", 0,0, 'R');
          $pdf->SetFont('Times','',12);
          $pdf->cell(17,6, $gradesection, 0,1, 'L');

          $pdf->SetFont('Times','B',12);
          $pdf->cell(20,6, "Billing Address: ", 0,0, 'L');
          $pdf->SetFont('Times','I',10);
          $pdf->cell(93,6, "(House #, Street, Village, Town/City, Province, Country)", 0,1, 'R');
          $pdf->SetFont('Times','',12);
          $pdf->cell(70,4, $address, 0,1, 'R');

          $pdf->Ln(5);

          $result = $conn->query("SELECT LRN_number, Lname, Mname, Fname, GradeLevel, Section, GuardianName, GuardianNum, amount FROM students
                      INNER JOIN payment on students.LRN_number = payment.LRN WHERE LRN_number=$LRN GROUP BY Lname LIMIT 1") or die($conn->error);
                      $count = 1;

          $pdf->SetFont('Times','B',12);
          $pdf->Cell(40);
          $pdf->cell(50,10, "Payment Status", 1,0, 'C');
          $pdf->cell(50,10, "Paid Amount", 1,1, 'C');

          $pdf->SetFont('Times','',12);

              while($row = $result->fetch_assoc()){

                  $payment = $row['amount'];

                  if($payment == 700){
                    $payStat = "Full Paid";
                  }
                  elseif($payment>=350){
                    $payStat = "Partially Paid";
                  }
                  elseif(($payment<=150)&&($payment>=1)){
                    $payStat = "Promi";
                  }
                  else{
                    $payStat = "Not yet paid";
                  }

                  if(isset($_POST['submit']))
                  {
                    $todayAmount = $_POST['amount'];

                  $pdf->Cell(40);
                  $pdf->cell(50,10, $payStat, 1,0, 'C');
                  $pdf->cell(50,10, "P" . $todayAmount . ".00", 1,1, 'C');

                  }
                  $count++;
              }  
            
            $pdf->Ln(5);
            $pdf->SetFont('Times','B',12);
            $pdf->cell(145,6, "Issued By: ", 0,0, 'R');
            $pdf->SetFont('Times','',12);
            $pdf->cell(20,6, $user, 0,1, 'L');
            $pdf->SetFont('Times','',12);
            $pdf->cell(173,6, $usertype, 0,1, 'R');

              
          $pdf->Output();
              }
              else{	
              echo "Error Num ". $msgResult . " was encountered!";
              }
        }
        elseif($sendOption ==2){
          //will only send SMS
          //##########################################################################
          // ITEXMO SEND SMS API - PHP - CURL-LESS METHOD
          //##########################################################################
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
            $textMsg = "Php " . $amount . ".00 total Misc fee paid by " . $fullname . ". Remaining Balance is Php " . $RemainingBal . ".00";

            $msgResult = itexmo($phone,$textMsg,"TR-JANVI394312_SW89W", "5hb3jg}vj7");
            if ($msgResult == ""){
            echo "iTexMo: No response from server!!!
            Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.	
            Please CONTACT US for help. ";	
            }else if ($msgResult == 0){
              $_SESSION['message'] = "New Payment Successfully saved! Text Message Sent!";
              $_SESSION['msg_type'] = "success";
            }
            else{	
            echo "Error Num ". $msgResult . " was encountered!";
            }
   
            header("location: ../adv/index.php");
        }
        elseif($sendOption ==3){
            $_SESSION['message'] = "New Payment Successfully saved!";
            $_SESSION['msg_type'] = "success";
      
            header("location: ../adv/index.php");
        }
        else{
            $_SESSION['message'] = "Error transaction";
            $_SESSION['msg_type'] = "danger";
   
            header("location: ../adv/index.php");
        }
      }   
}
?>
