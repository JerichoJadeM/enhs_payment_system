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

            $user = $fname . " " . $mname . ". " . $lname;
    if(isset($_POST['print'])){
        $LRN = $_POST['LRN'];

        $sql = $conn->query("SELECT LRN_number, Lname, Mname, Fname, GradeLevel, Section, GuardianName, GuardianNum, students.Address, paymentID, fullname, amount FROM students
        INNER JOIN payment on students.LRN_number = payment.LRN WHERE LRN_number=$LRN LIMIT 1") or die($conn->error);
       
        $row = $sql->fetch_assoc();

        $fullname = $row['fullname'];
        $gradesection = $row['GradeLevel'] . " - " . $row['Section'];
        $address = $row['Address'];
        $phone = $row['GuardianNum'];
       
        require('../../admin/libraries/fpdf182/fpdf.php');

          class PDF extends FPDF
          {
            // Page header
            function Header()
            {
                // Logo
                $this->Image('../libraries/fpdf182/tutorial/logo.png',20,8,30,0,'', 'payment.php');
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
                  $pdf->Cell(40);
                  $pdf->cell(50,10, $payStat, 1,0, 'C');
                  $pdf->cell(50,10, "P" . $row['amount'] . ".00", 1,1, 'C');

                      
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
              $pdf->Image('../libraries/fpdf182/tutorial/logo.png',20,151,30);
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
                  $pdf->Cell(40);
                  $pdf->cell(50,10, $payStat, 1,0, 'C');
                  $pdf->cell(50,10, "P" . $row['amount'] . ".00", 1,1, 'C');

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
?>