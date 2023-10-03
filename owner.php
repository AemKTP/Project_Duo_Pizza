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
    <link rel="stylesheet" href="main.css">


    <nav>
        <?php
        include 'nav.php';
        ?>
    </nav>
    <style>
        .center {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 300px;

        }

        .bgcolor {
            background: red;
            background: linear-gradient(50deg, rgba(255, 0, 0, 1) 0%, rgba(255, 144, 0, 1) 110%);
            transition: background-color 0.5s ease;
        }
    </style>
</head>

<body class="bgcolor">

    <?php
    $stmt = $conn->prepare("SELECT * FROM `order` ");
    $stmt->execute();
    $result = $stmt->get_result();
    ?>
    <div class="container" style="margin-top: 5%;">
        <div class="row">
            <div class="col-3">
                <select class="form-select form-select-lg mb-3" name="type" style="margin-block: 2%;" onchange="this.form.submit()">
                    <option value="">fanefl</option>
                </select>

                <?php while ($row = $result->fetch_assoc()) {
                ?>
                    <div class="card" style="margin-block: 2%; display: flex;">
                        <div class="row">
                            <div class="col" style="display: flex;">

                                <div>
                                    <h5>Order : <?= $row['oid'] ?></h5>
                                </div>

                                <div>
                                    adwakajflk
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>


</body>

</html>