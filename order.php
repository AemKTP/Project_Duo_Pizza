<?php
    include "dbconn.php";

    $uid=intval($_GET['uid']);
    $total_price=intval($_POST['totalprice']);
    $cart_id=intval($_POST['cartid']);

    date_default_timezone_set('Asia/Bangkok');
    $current_time = date('Y-m-d H:i:s');
    $status='2';

    $stmtupdates=$conn->prepare("update cart set status =  ? where uid  =   ?");
    $stmtupdates->bind_param("si", $status, $uid);
    $stmtupdates->execute();
    
    $stmtinsertprice=$conn->prepare("insert into 'order' (uid, cart_id, total_price, odate, status) values (?, ?, ?, ?, ?)");
    $stmtinsertprice->bind_param("iiiss", $uid, $cart_id, $total_price, $current_time, $status);
    $stmtinsertprice->execute();
   
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <title>order</title>
</head>
<nav>
<?php
    include "nav.php"
?>
</nav>
<style>
        html,
        body {
            overflow-x: hidden;
            background: red;
            background: linear-gradient(50deg, rgba(255, 0, 0, 1)0%, rgba(255, 144, 0, 1)110%);
            transition: background-color .5s ease;
        }

        .centercard {
            display: flex;
            height: 90vh;
            justify-content: center;
            align-items: center;

        }

        .checkbox {
            display: flex;
            align-items: center;
        }

        input[type="checkbox"] {
            margin-left: -0.5em;
        }

        .table-wrapper {
            overflow-y: scroll;
        }

        .card {
            height: 730px;
            border-radius: 20px;

        }
</style>
<body>
    
</body>
</html>