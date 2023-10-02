<?php
include 'dbconn.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <style>
        a {
            text-decoration: none;
            color: black;
            transition: color 0.3s;
        }
    </style>
</head>

<body>
    <nav style="background-color: aqua;">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="container" style="margin-block: 1%;">
                        <ul class="d-flex align-items-center list-unstyled ml-auto">
                            <li style="margin-right: 20px;">
                                <a href="owner.php" style="text-decoration: none;">
                                    <img src="pizza.png" alt="logo" width="100px">
                                    <li>
                                        <h1>Pizza Shop</h1>
                                    </li>
                                </a>
                            </li>
                            <li style="margin-left: 20%;">
                                <input type="search" name="search" style="border-radius: 50px;">
                            </li>
                            <li style="margin-left: auto;">
                                <a href="" style="display: flex; align-items: center;">
                                    <img src="shoppingcart.png" alt="shoppingcart" style="margin-top: 10%;" width="70px" height="70px">
                                    <span style="font-size:60px;cursor:pointer" onclick="openNav()">&#9776;</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    
</body>

</html>