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

    $fetch_user = "SELECT fname, mname, lname, user_type FROM users WHERE username='$user';";
            $result = $conn->query($fetch_user);
            $row = $result->fetch_assoc();
            
            $fname = $row['fname'];
            $mname = $row['mname'];
            $lname = $row['lname'];
            $usertype = $row['user_type'];

    $result = $conn->query("SELECT LRN_number, Lname, Mname, Fname, GradeLevel, Section, GuardianName, GuardianNum, amount FROM students
            INNER JOIN payment on students.LRN_number = payment.LRN GROUP BY Lname") or die($conn->error);
            $count = 1;


require_once('../libraries/fpdf182/fpdf.php');

// Begin configuration

$textColour = array( 0, 0, 0 );
$headerColour = array( 100, 100, 100 );
$tableHeaderTopTextColour = array( 255, 255, 255 );
$tableHeaderTopFillColour = array( 125, 152, 179 );
$tableHeaderTopProductTextColour = array( 0, 0, 0 );
$tableHeaderTopProductFillColour = array( 143, 173, 204 );
$tableHeaderLeftTextColour = array( 99, 42, 57 );
$tableHeaderLeftFillColour = array( 184, 207, 229 );
$tableBorderColour = array( 50, 50, 50 );
$tableRowFillColour = array( 213, 170, 170 );
$reportName = "ESTANCIA NATIONAL HIGHSCHOOL";
$reportNameYPos = 160;
$logoFile = "../libraries/fpdf182/tutorial/logo.png";
$logoXPos = 50;
$logoYPos = 50;
$logoWidth = 100;
$columnLabels = array( "Q1", "Q2", "Q3", "Q4" );
$rowLabels = array( "Promi", "Partial", "Full Paid", "Not Paid" );
$chartXPos = 20;
$chartYPos = 250;
$chartWidth = 160;
$chartHeight = 80;
$chartXLabel = "Category";
$chartYLabel = "# of Students";
$chartYStep = 5;

$chartColours = array(
                  array( 255, 100, 100 ),
                  array( 100, 255, 100 ),
                  array( 100, 100, 255 ),
                  array( 255, 255, 100 ),
                );

//Query for quarterly data array
  $promi_qrtr1 = $conn->query("SELECT COUNT(LRN) as Q1, payment_type FROM payment WHERE QUARTER(datepaid) = 1 AND payment_type='Promi'") or die($conn->error());
  $qrow_pq1 = $promi_qrtr1->fetch_assoc();
  $promi_data1 = $qrow_pq1['Q1'];

  $promi_qrtr2 = $conn->query("SELECT COUNT(LRN) as Q2, payment_type FROM payment WHERE QUARTER(datepaid) = 2 AND payment_type='Promi'") or die($conn->error());
  $qrow_pq2 = $promi_qrtr2->fetch_assoc();
  $promi_data2 = $qrow_pq2['Q2'];

  $promi_qrtr3 = $conn->query("SELECT COUNT(LRN) as Q3, payment_type FROM payment WHERE QUARTER(datepaid) = 3 AND payment_type='Promi'") or die($conn->error());
  $qrow_pq3 = $promi_qrtr3->fetch_assoc();
  $promi_data3 = $qrow_pq3['Q3'];

  $promi_qrtr4 = $conn->query("SELECT COUNT(LRN) as Q4, payment_type FROM payment WHERE QUARTER(datepaid) = 4 AND payment_type='Promi'") or die($conn->error());
  $qrow_pq4 = $promi_qrtr4->fetch_assoc();
  $promi_data4 = $qrow_pq4['Q4'];

  $partial_qrtr1 = $conn->query("SELECT COUNT(LRN) as Q1, payment_type FROM payment WHERE QUARTER(datepaid) = 1 AND payment_type='Partial Payment'") or die($conn->error());
  $qrow_paq1 = $partial_qrtr1->fetch_assoc();
  $partial_data1 = $qrow_paq1['Q1'];

  $partial_qrtr2 = $conn->query("SELECT COUNT(LRN) as Q2, payment_type FROM payment WHERE QUARTER(datepaid) = 2 AND payment_type='Partial Payment'") or die($conn->error());
  $qrow_paq2 = $partial_qrtr2->fetch_assoc();
  $partial_data2 = $qrow_paq2['Q2'];

  $partial_qrtr3 = $conn->query("SELECT COUNT(LRN) as Q3, payment_type FROM payment WHERE QUARTER(datepaid) = 3 AND payment_type='Partial Payment'") or die($conn->error());
  $qrow_paq3 = $partial_qrtr3->fetch_assoc();
  $partial_data3 = $qrow_paq3['Q3'];

  $partial_qrtr4 = $conn->query("SELECT COUNT(LRN) as Q4, payment_type FROM payment WHERE QUARTER(datepaid) = 4 AND payment_type='Partial Payment'") or die($conn->error());
  $qrow_paq4 = $partial_qrtr4->fetch_assoc();
  $partial_data4 = $qrow_paq4['Q4'];

  $f_qrtr1 = $conn->query("SELECT COUNT(LRN) as Q1, payment_type FROM payment WHERE QUARTER(datepaid) = 1 AND payment_type='Full Payment'") or die($conn->error());
  $qrow_fq1 = $f_qrtr1->fetch_assoc();
  $f_data1 = $qrow_fq1['Q1'];

  $f_qrtr2 = $conn->query("SELECT COUNT(LRN) as Q2, payment_type FROM payment WHERE QUARTER(datepaid) = 2 AND payment_type='Full Payment'") or die($conn->error());
  $qrow_fq2 = $f_qrtr2->fetch_assoc();
  $f_data2 = $qrow_fq2['Q2'];

  $f_qrtr3 = $conn->query("SELECT COUNT(LRN) as Q3, payment_type FROM payment WHERE QUARTER(datepaid) = 3 AND payment_type='Full Payment'") or die($conn->error());
  $qrow_fq3 = $f_qrtr3->fetch_assoc();
  $f_data3 = $qrow_fq3['Q3'];

  $f_qrtr4 = $conn->query("SELECT COUNT(LRN) as Q4, payment_type FROM payment WHERE QUARTER(datepaid) = 4 AND payment_type='Full Payment'") or die($conn->error());
  $qrow_fq4 = $f_qrtr4->fetch_assoc();
  $f_data4 = $qrow_fq4['Q4'];

  // Solving algo for unpaid
  $tstudent = $conn->query("SELECT COUNT(LRN) as totalstud  FROM payment") or die($conn->error());
  $qrow_stud = $tstudent->fetch_assoc();
  $stud_data = $qrow_stud['totalstud'];

  $unpaid_qrtr1 = $conn->query("SELECT COUNT(LRN) as paid, amount  FROM payment WHERE amount > 1") or die($conn->error());
  $qrow_unpaid1 = $unpaid_qrtr1->fetch_assoc();
  $unpaid_data1 = $qrow_unpaid1['paid'];

$data = array(
          array( $promi_data1, $promi_data2, $promi_data3, $promi_data4 ),
          array( $partial_data1, $partial_data2, $partial_data3, $partial_data4 ),
          array( $f_data1, $f_data2, $f_data3, $f_data4 ),
          array( $unpaid_data1, 1, 1, 1 ),
        );

        //AYUSIN ANG SA UNPAID PER QUARTER AT YUNG YEAR NG REPORT

// End configuration


/**
  Create the title page
**/

$pdf = new FPDF( 'P', 'mm', 'A4' );
$pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );
$pdf->AddPage();

// Logo
$pdf->Image( $logoFile, $logoXPos, $logoYPos, $logoWidth );

// Report Name
$pdf->SetFont( 'Arial', 'B', 30 );
$pdf->Ln( $reportNameYPos );
$pdf->Cell( 0, 15, $reportName, 0, 1, 'C' );
$pdf->Cell(0,15,'Student Miscellaneous Report',0,1,'C');


/**
  Create the page header, main heading, and intro text
**/

// Start of Report Header
$pdf->AddPage();
$pdf->SetTextColor( $headerColour[0], $headerColour[1], $headerColour[2] );
$pdf->SetFont( 'Arial', '', 17 );
//$pdf->Cell( 0, 15, $reportName, 0, 0, 'C' );
$pdf->Image('../libraries/fpdf182/tutorial/logo.png',30,8,20);
    // Arial bold 15
$pdf->SetFont('Arial','B',15);
    // Move to the right
$pdf->Cell(80);
    // Title
$pdf->Cell(30,5,'Estancia National High School',0,1,'C');
$pdf->SetFont('Arial','',12);
$pdf->Cell(190,5,'Brgy. Tacbuyan, Estancia, Iloilo',0,1,'C');
$pdf->SetFont('Arial','',12);
$pdf->Cell(190,5,'Contact #: 0997-865-8119',0,1,'C');
    // Line break
$pdf->Ln(15);
//This is the end of report header

$pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );

//Reporting Date
$pdf->SetFont('Times','B',12);
$pdf->cell(135,6, "Reporting Date: ", 0,0, 'R');
$pdf->SetFont('Times','',12);
$pdf->cell(50,6, date(DATE_RFC822), 0,1, 'L');
$pdf->Ln(5);

// QUERY FOR TOTALS OF STUDENTS

    $card = $conn->query("SELECT count(LRN_number) as total_students FROM students") or die($conn->error());
    $card_result = $card->fetch_assoc();
    $allStudents = $card_result['total_students'];

    $acc = $conn->query("SELECT count(LRN) as paid FROM payment WHERE amount>1") or die($conn->error());
    $row = $acc->fetch_assoc();
    $TotalPaid = $row['paid'];

    $acc = $conn->query("SELECT count(LRN) as notpaid FROM payment WHERE amount=0") or die($conn->error());
    $row = $acc->fetch_assoc();
    $NotPaid = $row['notpaid'];

//Another line for number of students
$pdf->SetFont('Times','B',12);
$pdf->cell(59,6, "Total Number of Paid Students: ", 0,0, 'L');
$pdf->SetFont('Times','',12);
$pdf->cell(10,6, number_format($TotalPaid), 0,0, 'L'); // <--- Dynamic Data Here
$pdf->Ln(6);
$pdf->SetFont('Times','B',12);
$pdf->cell(47,6, "Total Number of Unpaid: ", 0,0, 'L');
$pdf->SetFont('Times','',12);
$pdf->cell(10,6, number_format($NotPaid), 0,0, 'L'); // <--- Dynamic Data Here
$pdf->Ln(6);
$pdf->SetFont('Times','B',12);
$pdf->cell(45,6, "Total Number Enrolled: ", 0,0, 'L');
$pdf->SetFont('Times','',12);
$pdf->cell(10,6, number_format($allStudents), 0,1, 'L'); // <--- Dynamic Data Here

$pdf->SetFont( 'Arial', '', 20 );
$pdf->Write( 19, "Student Miscellaneous Summary" );
$pdf->Ln(5);

/**
  Create the table for payments
**/

$pdf->SetDrawColor( $tableBorderColour[0], $tableBorderColour[1], $tableBorderColour[2] );
$pdf->Ln( 15 );

// Create the table header row
$pdf->SetFont( 'Arial', 'B', 15 );

// "PRODUCT" cell
$pdf->SetTextColor( $tableHeaderTopProductTextColour[0], $tableHeaderTopProductTextColour[1], $tableHeaderTopProductTextColour[2] );
$pdf->SetFillColor( $tableHeaderTopProductFillColour[0], $tableHeaderTopProductFillColour[1], $tableHeaderTopProductFillColour[2] );
$pdf->Cell( 46, 12, " STUDENTS", 1, 0, 'L', true );

// Remaining header cells
$pdf->SetTextColor( $tableHeaderTopTextColour[0], $tableHeaderTopTextColour[1], $tableHeaderTopTextColour[2] );
$pdf->SetFillColor( $tableHeaderTopFillColour[0], $tableHeaderTopFillColour[1], $tableHeaderTopFillColour[2] );

for ( $i=0; $i<count($columnLabels); $i++ ) {
  $pdf->Cell( 36, 12, $columnLabels[$i], 1, 0, 'C', true );
}

$pdf->Ln( 12 );

// Create the table data rows

$fill = false;
$row = 0;

foreach ( $data as $dataRow ) {

  // Create the left header cell
  $pdf->SetFont( 'Arial', 'B', 15 );
  $pdf->SetTextColor( $tableHeaderLeftTextColour[0], $tableHeaderLeftTextColour[1], $tableHeaderLeftTextColour[2] );
  $pdf->SetFillColor( $tableHeaderLeftFillColour[0], $tableHeaderLeftFillColour[1], $tableHeaderLeftFillColour[2] );
  $pdf->Cell( 46, 12, " " . $rowLabels[$row], 1, 0, 'L', $fill );

  // Create the data cells
  $pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );
  $pdf->SetFillColor( $tableRowFillColour[0], $tableRowFillColour[1], $tableRowFillColour[2] );
  $pdf->SetFont( 'Arial', '', 15 );

  for ( $i=0; $i<count($columnLabels); $i++ ) {
    $pdf->Cell( 36, 12, (number_format( $dataRow[$i] ) ), 1, 0, 'C', $fill );
  }

  $row++;
  $fill = !$fill;
  $pdf->Ln( 12 );
}


/***
  Create the chart
***/

// Compute the X scale
$xScale = count($rowLabels) / ( $chartWidth - 40 );

// Compute the Y scale

$maxTotal = 0;

foreach ( $data as $dataRow ) {
  $totalSales = 0;
  foreach ( $dataRow as $dataCell ) $totalSales += $dataCell;
  $maxTotal = ( $totalSales > $maxTotal ) ? $totalSales : $maxTotal;
}

$yScale = $maxTotal / $chartHeight;

// Compute the bar width
$barWidth = ( 1 / $xScale ) / 1.5;

// Add the axes:

$pdf->SetFont( 'Arial', '', 10 );

// X axis
$pdf->Line( $chartXPos + 30, $chartYPos, $chartXPos + $chartWidth, $chartYPos );

for ( $i=0; $i < count( $rowLabels ); $i++ ) {
  $pdf->SetXY( $chartXPos + 40 +  $i / $xScale, $chartYPos );
  $pdf->Cell( $barWidth, 10, $rowLabels[$i], 0, 0, 'C' );
}

// Y axis
$pdf->Line( $chartXPos + 30, $chartYPos, $chartXPos + 30, $chartYPos - $chartHeight - 8 );

for ( $i=0; $i <= $maxTotal; $i += $chartYStep ) {
  $pdf->SetXY( $chartXPos + 7, $chartYPos - 5 - $i / $yScale );
  $pdf->Cell( 20, 10, number_format( $i ), 0, 0, 'R' );
  $pdf->Line( $chartXPos + 28, $chartYPos - $i / $yScale, $chartXPos + 30, $chartYPos - $i / $yScale );
}

// Add the axis labels
$pdf->SetFont( 'Arial', 'B', 12 );
$pdf->SetXY( $chartWidth / 2 + 20, $chartYPos + 8 );
$pdf->Cell( 30, 10, $chartXLabel, 0, 0, 'C' );
$pdf->SetXY( $chartXPos + 7, $chartYPos - $chartHeight - 12 );
$pdf->Cell( 20, 10, $chartYLabel, 0, 0, 'R' );

// Create the bars
$xPos = $chartXPos + 40;
$bar = 0;

foreach ( $data as $dataRow ) {

  // Total up the sales figures for this product
  $totalSales = 0;
  foreach ( $dataRow as $dataCell ) $totalSales += $dataCell;

  // Create the bar
  $colourIndex = $bar % count( $chartColours );
  $pdf->SetFillColor( $chartColours[$colourIndex][0], $chartColours[$colourIndex][1], $chartColours[$colourIndex][2] );
  $pdf->Rect( $xPos, $chartYPos - ( $totalSales / $yScale ), $barWidth, $totalSales / $yScale, 'DF' );
  $xPos += ( 1 / $xScale );
  $bar++;
}

/***
  Serve the PDF
***/

$pdf->Output( "report.pdf", "I" );

?>