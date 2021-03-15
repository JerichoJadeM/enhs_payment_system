<?php
    $db_server = "sql6.freemysqlhosting.net";
    $db_user = "sql6398227";
    $db_pass = "e68kqdz6FX";
    $db_name = "sql6398227";
    
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

    $fetch_user = "SELECT fname, mname, lname, user_type, grade, section FROM users WHERE username='$user';";
            $result = $conn->query($fetch_user);
            $row = $result->fetch_assoc();
            
            $fname = $row['fname'];
            $mname = $row['mname'];
            $lname = $row['lname'];
            $usertype = $row['user_type'];
            $tGrade = $row['grade'];
            $tSection = $row['section'];

    $result = $conn->query("SELECT LRN_number, Lname, Mname, Fname, GradeLevel, Section, GuardianName, GuardianNum, amount FROM students
            INNER JOIN payment on students.LRN_number = payment.LRN  WHERE GradeLevel='$tGrade' AND Section='$tSection' GROUP BY Lname") or die($conn->error);
            $count = 1;


require('../../admin/libraries/fpdf182/fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('../../admin/libraries/fpdf182/tutorial/logo.png',30,8,20);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(30,5,'Estancia National High School',0,1,'C');
    $this->SetFont('Arial','',12);
    $this->Cell(190,5,'Brgy. Cano-An, Estancia, Iloilo',0,1,'C');
    $this->SetFont('Arial','',12);
    $this->Cell(190,5,'Contact #: 0997-865-8119',0,1,'C');
    // Line break
    $this->Ln(10);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Times','B',12);
$pdf->cell(135,6, "As of: ", 0,0, 'R');
$pdf->SetFont('Times','',12);
$pdf->cell(50,6, date(DATE_RFC822), 0,1, 'L');
$pdf->SetFont('Times','B',12);
$pdf->cell(40,6, "Student Master List ", 0,1, 'C');
$pdf->Ln(2);

$pdf->SetFont('Times','B',12);
$pdf->cell(10,10, "No.", 1,0, 'C');
$pdf->cell(40,10, "Student LRN", 1,0, 'C');
$pdf->cell(55,10, "Student Name", 1,0, 'C');
$pdf->cell(32,10, "Grade & Section", 1,0, 'C');
$pdf->cell(30,10, "Status", 1,0, 'C');
$pdf->cell(20,10, "Amount", 1,1, 'C');

$pdf->SetFont('Times','',12);

    while($row = $result->fetch_assoc()){

        $payment = $row['amount'];

        if($payment == 700){
          $payStat = "Full Paid";
        }
        elseif($payment>=350){
          $payStat = "Partial Paid";
        }
        elseif(($payment<=150)&&($payment>=1)){
          $payStat = "Promi";
        }
        else{
          $payStat = "Not yet paid";
        }

        $pdf->cell(10,10, $count, 1,0, 'C');
        $pdf->cell(40,10, $row['LRN_number'], 1,0, 'C');
        $pdf->cell(55,10, $row['Lname'] . " " . $row['Fname'] . " " . $row['Mname'] . ".", 1,0, 'L');
        $pdf->cell(32,10, $row['GradeLevel'] . "-" . $row['Section'], 1,0, 'C');
        $pdf->cell(30,10, $payStat, 1,0, 'C');
        $pdf->cell(20,10, "P" . $row['amount'] . ".00", 1,1, 'C');

        $count++;
    }  
            
                
$pdf->Output();

?>
