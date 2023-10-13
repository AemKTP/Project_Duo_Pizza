<?php
    include "dbcon.php";

    $calallpstmt=$conn->prepare("select price from cart where uid=?");
    $calallpstmt->bind_param("i",$uid);
    $callallstmt->execute();
    $resultcals=$calallpstmt->get_result();
    $totalprice=0;
    while($row = $resultcals -> fetch_array(MYSQLI_ASSOC)){
                $totalprice=+$row['price'];
    }
    $stmtcallsp=$conn->prepare("update 'order' set total_price = ? where uid = ?");
    $stmtcallsp->bind_param("ii",$totalprice,$uid);
    $callallstmt->execute();
    $resultcals=$calallpstmt->get_result();
    
?>