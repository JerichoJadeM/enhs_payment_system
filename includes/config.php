<?php
    $db_server = "sql6.freemysqlhosting.net";
    $db_user = "sql6398227";
    $db_pass = "e68kqdz6FX";
    $db_name = "sql6398227";

    //COPY FOR LOCAL DATABASE
    /**$db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "thesis"; */

    $conn = new mysqli($db_server, $db_user, $db_pass, $db_name);

    if($conn->connect_error){
        die("Error Connection" . $conn->connect_error);
    }

    echo "<script>console.log('Connection Successful!')</script>"; 

?>