<?php

    $servername = "202.28.34.197";
    $username = "web66_65011212228";
    $password = "65011212228@csmsu";
    $dbname = "web66_65011212228";

    $conn = new mysqli($servername, $username, $password, $dbname);
    // echo "dwad";
    $stmt = $conn->prepare("Select * From user");
    $stmt->execute();
    $result = $stmt->get_result();

    // while($row = $result->fetch_assoc()){
    //     echo $row['name'];
    // }

?>
