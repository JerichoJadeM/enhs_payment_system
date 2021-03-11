<?php
    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "thesis";

    $conn = new mysqli($db_server, $db_user, $db_pass, $db_name);

    if($conn->connect_error){
        die("Error Connection" . $conn->connect_error);
    }

    echo "<script>console.log('Connection Successful!')</script>"; 

?>