<?php
    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "score";

    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

    if($conn->connect_error){
        die("Error Connection" . $conn->connect_error);
    }


    $result = mysqli_query($conn, "SELECT ranking.school_id, ranking.total_score, schools.school_name FROM ranking 
    INNER JOIN schools ON ranking.rank_id = schools.s_id
    ORDER BY total_score DESC") or die(mysqli_error($conn));
        $rank = 0;
        $prev = 0;
        $tieRank = 0;
        $finalRank = 0;
        
       
?> 
<html>
<body>

    <table>
    <th>School Name</th><th>Score</th><th>Rank</th>

    <?php
    while($row = mysqli_fetch_assoc($result)){

        $total_score = $row['total_score'];
        $ressSchool = $row['school_name'];
        $rank++;

        if($prev == $total_score){
            $tieRank = ($rank + .5) - 1;
            $rank = $tieRank - .5;
            $finalRank = $tieRank;
        }
        else{
            $finalRank = $rank;
        }
        $prev = $total_score;
        
    ?>

    <tr>
        <td>
            <div><?php echo $ressSchool;?></div>
        </td>
        <td><?php echo $total_score; ?></td>
        <td><?php echo $finalRank; ?></td>
    </tr>

<?php } ?>
    </table>

</body>
</html>