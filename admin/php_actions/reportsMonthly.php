<?php
    // $db_server = "sql6.freemysqlhosting.net";
    // $db_user = "sql6398227";
    // $db_pass = "e68kqdz6FX";
    // $db_name = "sql6398227";
    
    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "thesis";

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
$reportNameYPos = 140;
$logoFile = "../libraries/fpdf182/tutorial/logo.png";
$logoXPos = 50;
$logoYPos = 50;
$logoWidth = 100;
$columnLabels = array( "Week 1", "Week 2", "Week 3", "Week 4" );
$rowLabels = array( "Promi", "Partial", "Full Paid");
$chartXPos = 20;
$chartYPos = 250;
$chartWidth = 160;
$chartHeight = 80;
$chartXLabel = "Category";
$chartYLabel = "# of Students";
$chartYStep = 2;

$chartColours = array(
                  array( 255, 100, 100 ),
                  array( 100, 255, 100 ),
                  array( 100, 100, 255 ),
                  array( 255, 255, 100 ),
                );

//Query for quarterly data array
  $promi_qrtr1 = $conn->query("SELECT COUNT(LRN) as Q1, payment_type FROM payment WHERE YEAR(datepaid) = YEAR(CURDATE()) AND MONTH(datepaid) = MONTH(CURDATE()) AND payment_type='Promi'") or die($conn->error());
  $qrow_pq1 = $promi_qrtr1->fetch_assoc();
  $promi_data1 = $qrow_pq1['Q1'];

  $promi_qrtr2 = $conn->query("SELECT COUNT(LRN) as Q2, payment_type FROM payment WHERE YEAR(datepaid) = YEAR(CURDATE()) AND MONTH(datepaid) = MONTH(CURDATE()) AND payment_type='Promi'") or die($conn->error());
  $qrow_pq2 = $promi_qrtr2->fetch_assoc();
  $promi_data2 = $qrow_pq2['Q2'];

  $promi_qrtr3 = $conn->query("SELECT COUNT(LRN) as Q3, payment_type FROM payment WHERE YEAR(datepaid) = YEAR(CURDATE()) AND MONTH(datepaid) = MONTH(CURDATE()) AND payment_type='Promi'") or die($conn->error());
  $qrow_pq3 = $promi_qrtr3->fetch_assoc();
  $promi_data3 = $qrow_pq3['Q3'];

  $promi_qrtr4 = $conn->query("SELECT COUNT(LRN) as Q4, payment_type FROM payment WHERE YEAR(datepaid) = YEAR(CURDATE()) AND MONTH(datepaid) = MONTH(CURDATE()) AND payment_type='Promi'") or die($conn->error());
  $qrow_pq4 = $promi_qrtr4->fetch_assoc();
  $promi_data4 = $qrow_pq4['Q4'];

  $partial_qrtr1 = $conn->query("SELECT COUNT(LRN) as Q1, payment_type FROM payment WHERE YEAR(datepaid) = YEAR(CURDATE()) AND MONTH(datepaid) = MONTH(CURDATE()) AND payment_type='Partial Payment'") or die($conn->error());
  $qrow_paq1 = $partial_qrtr1->fetch_assoc();
  $partial_data1 = $qrow_paq1['Q1'];

  $partial_qrtr2 = $conn->query("SELECT COUNT(LRN) as Q2, payment_type FROM payment WHERE YEAR(datepaid) = YEAR(CURDATE()) AND MONTH(datepaid) = MONTH(CURDATE()) AND payment_type='Partial Payment'") or die($conn->error());
  $qrow_paq2 = $partial_qrtr2->fetch_assoc();
  $partial_data2 = $qrow_paq2['Q2'];

  $partial_qrtr3 = $conn->query("SELECT COUNT(LRN) as Q3, payment_type FROM payment WHERE YEAR(datepaid) = YEAR(CURDATE()) AND MONTH(datepaid) = MONTH(CURDATE()) AND payment_type='Partial Payment'") or die($conn->error());
  $qrow_paq3 = $partial_qrtr3->fetch_assoc();
  $partial_data3 = $qrow_paq3['Q3'];

  $partial_qrtr4 = $conn->query("SELECT COUNT(LRN) as Q4, payment_type FROM payment WHERE YEAR(datepaid) = YEAR(CURDATE()) AND MONTH(datepaid) = MONTH(CURDATE()) AND payment_type='Partial Payment'") or die($conn->error());
  $qrow_paq4 = $partial_qrtr4->fetch_assoc();
  $partial_data4 = $qrow_paq4['Q4'];

  $f_qrtr1 = $conn->query("SELECT COUNT(LRN) as Q1, payment_type FROM payment WHERE YEAR(datepaid) = YEAR(CURDATE()) AND MONTH(datepaid) = MONTH(CURDATE()) AND payment_type='Full Payment'") or die($conn->error());
  $qrow_fq1 = $f_qrtr1->fetch_assoc();
  $f_data1 = $qrow_fq1['Q1'];

  $f_qrtr2 = $conn->query("SELECT COUNT(LRN) as Q2, payment_type FROM payment WHERE YEAR(datepaid) = YEAR(CURDATE()) AND MONTH(datepaid) = MONTH(CURDATE()) AND payment_type='Full Payment'") or die($conn->error());
  $qrow_fq2 = $f_qrtr2->fetch_assoc();
  $f_data2 = $qrow_fq2['Q2'];

  $f_qrtr3 = $conn->query("SELECT COUNT(LRN) as Q3, payment_type FROM payment WHERE YEAR(datepaid) = YEAR(CURDATE()) AND MONTH(datepaid) = MONTH(CURDATE()) AND payment_type='Full Payment'") or die($conn->error());
  $qrow_fq3 = $f_qrtr3->fetch_assoc();
  $f_data3 = $qrow_fq3['Q3'];

  $f_qrtr4 = $conn->query("SELECT COUNT(LRN) as Q4, payment_type FROM payment WHERE YEAR(datepaid) = YEAR(CURDATE()) AND MONTH(datepaid) = MONTH(CURDATE()) AND payment_type='Full Payment'") or die($conn->error());
  $qrow_fq4 = $f_qrtr4->fetch_assoc();
  $f_data4 = $qrow_fq4['Q4'];

  // Solving algo for unpaid
  $tstudent = $conn->query("SELECT COUNT(LRN) as totalstud  FROM payment") or die($conn->error());
  $qrow_stud = $tstudent->fetch_assoc();
  $stud_data = $qrow_stud['totalstud'];

  $unpaid1 = ($promi_data1 + $partial_data1 + $f_data1)/3 *100;
  $unpaid2 = ($promi_data2 + $partial_data2 + $f_data2)/3 *100;
  $unpaid3 = ($promi_data3 + $partial_data3 + $f_data3)/3 *100;
  $unpaid4 = ($promi_data4 + $partial_data4 + $f_data4)/3 *100;

$data = array(
          array( $promi_data1, $promi_data2, $promi_data3, $promi_data4 ),
          array( $partial_data1, $partial_data2, $partial_data3, $partial_data4 ),
          array( $f_data1, $f_data2, $f_data3, $f_data4 ),
          //array( $unpaid1, $unpaid2, $unpaid3, $unpaid4),
        );

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
$pdf->SetFont( 'Arial', 'B', 25 );
$pdf->Ln( $reportNameYPos );
$pdf->Cell( 0, 10, $reportName, 0, 1, 'C' );
$pdf->Cell(0,10,'Student Miscellaneous Payment',0,1,'C');

$pdf->SetFont( 'Arial', 'B', 50 );
$pdf->Cell(0,55,'Monthly Report',0,1,'C');


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
$pdf->cell(10,6, $allStudents, 0,1, 'L'); // <--- Dynamic Data Here

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

///////////////////////////////////////////////
/// Create new page for User activities

$columnLabels1 = array( "Week 1", "Week 2", "Week 3", "Week 4" );
$rowLabels1 = array( "System Admin", "Accountant", "Advisers", "Inquiries");
$chartXPos1 = 20;
$chartYPos1 = 250;
$chartWidth1 = 160;
$chartHeight1 = 80;
$chartXLabel1 = "Users";
$chartYLabel1 = "# of Activities";
$chartYStep1 = 5;

$chartColours1 = array(
                  array( 255, 0, 127 ),
                  array( 255, 0, 255 ),
                  array( 127, 0, 255 ),
                  array( 0, 0, 255 ),
                );

  $SA_q1 = $conn->query("SELECT COUNT(id) as SA1 FROM activities WHERE user_type='System Administrator' AND YEAR(activity_date) = YEAR(CURDATE()) AND MONTH(activity_date) = MONTH(CURDATE())") or die($conn->error());
  $SArow_q1 = $SA_q1->fetch_assoc();
  $dataSA1 = $SArow_q1['SA1'];

  $SA_q2 = $conn->query("SELECT COUNT(id) as SA2 FROM activities WHERE user_type='System Administrator' AND YEAR(activity_date) = YEAR(CURDATE()) AND MONTH(activity_date) = MONTH(CURDATE())") or die($conn->error());
  $SArow_q2 = $SA_q2->fetch_assoc();
  $dataSA2 = $SArow_q2['SA2'];

  $SA_q3 = $conn->query("SELECT COUNT(id) as SA3 FROM activities WHERE user_type='System Administrator' AND YEAR(activity_date) = YEAR(CURDATE()) AND MONTH(activity_date) = MONTH(CURDATE())") or die($conn->error());
  $SArow_q3 = $SA_q3->fetch_assoc();
  $dataSA3 = $SArow_q3['SA3'];

  $SA_q4 = $conn->query("SELECT COUNT(id) as SA4 FROM activities WHERE user_type='System Administrator' AND YEAR(activity_date) = YEAR(CURDATE()) AND MONTH(activity_date) = MONTH(CURDATE())") or die($conn->error());
  $SArow_q4 = $SA_q4->fetch_assoc();
  $dataSA4 = $SArow_q4['SA4'];

  $Acc_q1 = $conn->query("SELECT COUNT(id) as acc1 FROM activities WHERE user_type='Accountant' AND YEAR(activity_date) = YEAR(CURDATE()) AND MONTH(activity_date) = MONTH(CURDATE())") or die($conn->error());
  $accRow_q1 = $Acc_q1->fetch_assoc();
  $dataAcc1 = $accRow_q1['acc1'];

  $Acc_q2 = $conn->query("SELECT COUNT(id) as acc2 FROM activities WHERE user_type='Accountant' AND YEAR(activity_date) = YEAR(CURDATE()) AND MONTH(activity_date) = MONTH(CURDATE())") or die($conn->error());
  $accRow_q2 = $Acc_q2->fetch_assoc();
  $dataAcc2 = $accRow_q2['acc2'];

  $Acc_q3 = $conn->query("SELECT COUNT(id) as acc3 FROM activities WHERE user_type='Accountant' AND YEAR(activity_date) = YEAR(CURDATE()) AND MONTH(activity_date) = MONTH(CURDATE())") or die($conn->error());
  $accRow_q3 = $Acc_q3->fetch_assoc();
  $dataAcc3 = $accRow_q3['acc3'];

  $Acc_q4 = $conn->query("SELECT COUNT(id) as acc4 FROM activities WHERE user_type='Accountant' AND YEAR(activity_date) = YEAR(CURDATE()) AND MONTH(activity_date) = MONTH(CURDATE())") or die($conn->error());
  $accRow_q4 = $Acc_q4->fetch_assoc();
  $dataAcc4 = $accRow_q4['acc4'];

  $adv_q1 = $conn->query("SELECT COUNT(id) as adv1 FROM activities WHERE user_type='Adviser' AND YEAR(activity_date) = YEAR(CURDATE()) AND MONTH(activity_date) = MONTH(CURDATE())") or die($conn->error());
  $advRow_q1 = $adv_q1->fetch_assoc();
  $dataAdv1 = $advRow_q1['adv1'];

  $adv_q2 = $conn->query("SELECT COUNT(id) as adv2 FROM activities WHERE user_type='Adviser' AND YEAR(activity_date) = YEAR(CURDATE()) AND MONTH(activity_date) = MONTH(CURDATE())") or die($conn->error());
  $advRow_q2 = $adv_q2->fetch_assoc();
  $dataAdv2 = $advRow_q2['adv2'];

  $adv_q3 = $conn->query("SELECT COUNT(id) as adv3 FROM activities WHERE user_type='Adviser' AND YEAR(activity_date) = YEAR(CURDATE()) AND MONTH(activity_date) = MONTH(CURDATE())") or die($conn->error());
  $advRow_q3 = $adv_q3->fetch_assoc();
  $dataAdv3 = $advRow_q3['adv3'];

  $adv_q4 = $conn->query("SELECT COUNT(id) as adv4 FROM activities WHERE user_type='Adviser' AND YEAR(activity_date) = YEAR(CURDATE()) AND MONTH(activity_date) = MONTH(CURDATE())") or die($conn->error());
  $advRow_q4 = $adv_q4->fetch_assoc();
  $dataAdv4 = $advRow_q4['adv4'];

  $inq1 = $conn->query("SELECT COUNT(id) as inquire1 FROM messages WHERE QUARTER(dateRecieved)=2") or die($conn->error());
  $inqRow_q1 = $inq1->fetch_assoc();
  $dataInq1 = $inqRow_q1['inquire1'];

  $inq2 = $conn->query("SELECT COUNT(id) as inquire2 FROM messages WHERE QUARTER(dateRecieved)=2") or die($conn->error());
  $inqRow_q2 = $inq2->fetch_assoc();
  $dataInq2 = $inqRow_q2['inquire2'];

  $inq3 = $conn->query("SELECT COUNT(id) as inquire3 FROM messages WHERE QUARTER(dateRecieved)=2") or die($conn->error());
  $inqRow_q3 = $inq3->fetch_assoc();
  $dataInq3 = $inqRow_q3['inquire3'];

  $inq4 = $conn->query("SELECT COUNT(id) as inquire4 FROM messages WHERE QUARTER(dateRecieved)=2") or die($conn->error());
  $inqRow_q4 = $inq4->fetch_assoc();
  $dataInq4 = $inqRow_q4['inquire4'];

$data1 = array(
          array( $dataSA1, $dataSA2, $dataSA3, $dataSA4 ),
          array( $dataAcc1, $dataAcc2, $dataAcc3, $dataAcc4 ),
          array( $dataAdv1, $dataAdv2, $dataAdv3, $dataAdv4 ),
          array( $dataInq1, $dataInq2, $dataInq3, $dataInq4),
          );

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

// QUERY FOR TOTALS OF STUDENTS

    $card = $conn->query("SELECT count(id) as total_activities FROM activities WHERE YEAR(CURDATE())") or die($conn->error());
    $card_result = $card->fetch_assoc();
    $allAct = $card_result['total_activities'];

    $acc = $conn->query("SELECT count(id) as inquire FROM messages WHERE YEAR(CURDATE())") or die($conn->error());
    $row = $acc->fetch_assoc();
    $allMessages = $row['inquire'];

//Another line for number of students
$pdf->SetFont('Times','B',12);
$pdf->cell(50,6, "Total Number of Activities: ", 0,0, 'L');
$pdf->SetFont('Times','',12);
$pdf->cell(10,6, number_format($allAct), 0,0, 'L'); // <--- Dynamic Data Here
$pdf->Ln(6);
$pdf->SetFont('Times','B',12);
$pdf->cell(50,6, "Total Number of Inquiries: ", 0,0, 'L');
$pdf->SetFont('Times','',12);
$pdf->cell(10,6, number_format($allMessages), 0,0, 'L'); // <--- Dynamic Data Here
$pdf->Ln(6);

$pdf->SetFont( 'Arial', '', 20 );
$pdf->Write( 19, "Summary of User Activities" );
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
$pdf->Cell( 46, 12, "Users", 1, 0, 'L', true );

// Remaining header cells
$pdf->SetTextColor( $tableHeaderTopTextColour[0], $tableHeaderTopTextColour[1], $tableHeaderTopTextColour[2] );
$pdf->SetFillColor( $tableHeaderTopFillColour[0], $tableHeaderTopFillColour[1], $tableHeaderTopFillColour[2] );

for ( $i=0; $i<count($columnLabels1); $i++ ) {
  $pdf->Cell( 36, 12, $columnLabels1[$i], 1, 0, 'C', true );
}

$pdf->Ln( 12 );

// Create the table data rows

$fill1 = false;
$row1= 0;

foreach ( $data1 as $dataRow1 ) {

  // Create the left header cell
  $pdf->SetFont( 'Arial', 'B', 15 );
  $pdf->SetTextColor( $tableHeaderLeftTextColour[0], $tableHeaderLeftTextColour[1], $tableHeaderLeftTextColour[2] );
  $pdf->SetFillColor( $tableHeaderLeftFillColour[0], $tableHeaderLeftFillColour[1], $tableHeaderLeftFillColour[2] );
  $pdf->Cell( 46, 12, " " . $rowLabels1[$row1], 1, 0, 'L', $fill );

  // Create the data cells
  $pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );
  $pdf->SetFillColor( $tableRowFillColour[0], $tableRowFillColour[1], $tableRowFillColour[2] );
  $pdf->SetFont( 'Arial', '', 15 );

  for ( $i=0; $i<count($columnLabels1); $i++ ) {
    $pdf->Cell( 36, 12, (number_format( $dataRow1[$i] ) ), 1, 0, 'C', $fill );
  }

  $row1++;
  $fill1 = !$fill1;
  $pdf->Ln( 12 );
}


/***
  Create the chart
***/

// Compute the X scale
$xScale1 = count($rowLabels1) / ( $chartWidth1 - 40 );

// Compute the Y scale

$maxTotal1 = 0;

foreach ( $data1 as $dataRow1 ) {
  $totalSales1 = 0;
  foreach ( $dataRow1 as $dataCell1 ) $totalSales1 += $dataCell1;
  $maxTotal1 = ( $totalSales1 > $maxTotal1 ) ? $totalSales1 : $maxTotal1;
}

$yScale1 = $maxTotal1 / $chartHeight1;

// Compute the bar width
$barWidth1 = ( 1 / $xScale1 ) / 1.5;

// Add the axes:

$pdf->SetFont( 'Arial', '', 10 );

// X axis
$pdf->Line( $chartXPos1 + 30, $chartYPos1, $chartXPos1 + $chartWidth1, $chartYPos1 );

for ( $i=0; $i < count( $rowLabels1 ); $i++ ) {
  $pdf->SetXY( $chartXPos1 + 40 +  $i / $xScale1, $chartYPos1 );
  $pdf->Cell( $barWidth1, 10, $rowLabels1[$i], 0, 0, 'C' );
}

// Y axis
$pdf->Line( $chartXPos1 + 30, $chartYPos1, $chartXPos1 + 30, $chartYPos1 - $chartHeight1 - 8 );

for ( $i=0; $i <= $maxTotal1; $i += $chartYStep1 ) {
  $pdf->SetXY( $chartXPos1 + 7, $chartYPos1 - 5 - $i / $yScale1 );
  $pdf->Cell( 20, 10, number_format( $i ), 0, 0, 'R' );
  $pdf->Line( $chartXPos1 + 28, $chartYPos1 - $i / $yScale1, $chartXPos1 + 30, $chartYPos1 - $i / $yScale1 );
}

// Add the axis labels
$pdf->SetFont( 'Arial', 'B', 12 );
$pdf->SetXY( $chartWidth1 / 2 + 20, $chartYPos1 + 8 );
$pdf->Cell( 30, 10, $chartXLabel1, 0, 0, 'C' );
$pdf->SetXY( $chartXPos1 + 7, $chartYPos1 - $chartHeight1 - 12 );
$pdf->Cell( 20, 10, $chartYLabel1, 0, 0, 'R' );

// Create the bars
$xPos1 = $chartXPos1 + 40;
$bar1 = 0;

foreach ( $data1 as $dataRow1 ) {

  // Total up the sales figures for this product
  $totalSales1 = 0;
  foreach ( $dataRow1 as $dataCell1 ) $totalSales1 += $dataCell1;

  // Create the bar
  $colourIndex1 = $bar1 % count( $chartColours1 );
  $pdf->SetFillColor( $chartColours1[$colourIndex1][0], $chartColours1[$colourIndex1][1], $chartColours1[$colourIndex1][2] );
  $pdf->Rect( $xPos1, $chartYPos1 - ( $totalSales1 / $yScale1 ), $barWidth1, $totalSales1 / $yScale1, 'DF' );
  $xPos1 += ( 1 / $xScale1 );
  $bar1++;
}

///////////////////////////////////////////////////
//List of Users //////////////////////////////////
/////////////////////////////////////////////////
      $usersReport = $conn->query("SELECT * FROM users WHERE user_type = 'Accountant' ||  user_type = 'Adviser'
      ORDER BY lname") or die($conn->error);
      $count = 1;

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
$pdf->Ln(10);
//This is the end of report header

$pdf->SetFont( 'Arial', '', 20 );
$pdf->Write(15, "List of Staffs and Faculties",0,1, 'C' );
$pdf->Ln(20);

$pdf->SetFont('Times','B',12);
$pdf->cell(10,10, "No.", 1,0, 'C');
$pdf->cell(45,10, "Name", 1,0, 'C');
$pdf->cell(30,10, "Position", 1,0, 'C');
$pdf->cell(32,10, "Grade & Section", 1,0, 'C');
$pdf->cell(28,10, "Phone #", 1,0, 'C');
$pdf->cell(50,10, "Email Address", 1,1, 'C');

$pdf->SetFont('Times','',12);
    while($useRow = $usersReport->fetch_assoc()){
        $gradeSection = $useRow['grade'] . " - " . $useRow['section'];
        $userFullName = $useRow['lname'] . " " . $useRow['fname'] . ", " . $useRow['mname'] . ".";
        $user_type = $useRow['user_type'];
        
        if($user_type == 'Accountant'){
          $gradeSection = "N/A";
        }

        $pdf->cell(10,10, $count, 1,0, 'C');
        $pdf->cell(45,10, $userFullName, 1,0, 'L');
        $pdf->cell(30,10, $useRow['user_type'], 1,0, 'C');
        $pdf->cell(32,10, $gradeSection, 1,0, 'C');
        $pdf->cell(28,10, $useRow['phone'], 1,0, 'C');
        $pdf->cell(50,10, $useRow['email'], 1,1, 'L');

        $count++;
    }  


    ///////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////USER LOGS////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////
    $userLogs = $conn->query("SELECT * FROM activities WHERE YEAR(activity_date) = YEAR(CURDATE()) AND MONTH(activity_date) = MONTH(CURDATE()) ORDER BY activity_date DESC") or die($conn->error);
    $logCount = 1;
    
    $pdf->SetFont( 'Arial', '', 20 );
    $pdf->Write(20, "LOGS",0,1, 'C' );
    $pdf->Ln(20);
    
    $pdf->SetFont('Times','B',12);
    $pdf->cell(10,10, "No.", 1,0, 'C');
    $pdf->cell(25,10, "Date", 1,0, 'C');
    $pdf->cell(45,10, "Name", 1,0, 'C');
    $pdf->cell(95,10, "Activity", 1,0, 'C');
    $pdf->cell(20,10, "User Type", 1,1, 'C');
    
    $pdf->SetFont('Times','',12);
        while($logRow = $userLogs->fetch_assoc()){

            $userLogName = $logRow['name'];
            $usertype_log = $logRow['user_type'];

            if($usertype_log === 'System Administrator'){
              $usertype_log = 'Admin';
            }
            
            $pdf->cell(10,10, $logCount, 1,0, 'C');
            $pdf->cell(25,10, $logRow['activity_date'], 1,0, 'L');
            $pdf->cell(45,10, $userLogName, 1,0, 'L');
            $pdf->cell(95,10, $logRow['activity'], 1,0, 'L');
            $pdf->cell(20,10, $usertype_log, 1,1, 'C');
    
            $logCount++;
        } 

/***
  Serve the PDF
***/

$pdf->Output( "report.pdf", "I" );

?>