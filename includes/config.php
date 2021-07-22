<?php
    $db_server = "sql6.freemysqlhosting.net";
    $db_user = "sql6413038";
    $db_pass = "XSfWgaEnYH";
    $db_name = "sql6413038";

    // COPY FOR LOCAL DATABASE
    // $db_server = "localhost";
    // $db_user = "root";
    // $db_pass = "";
    // $db_name = "thesis"; 

    $conn = new mysqli($db_server, $db_user, $db_pass, $db_name);

    if($conn->connect_error){
        die("Error Connection" . $conn->connect_error);
        //header ('location: error.php');
    }

    echo "<script>console.log('Connection Successful!')</script>"; 

?>