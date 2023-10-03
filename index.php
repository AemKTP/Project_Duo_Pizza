<?php
include "dbconn.php";
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <title>pizza</title>
</head>
<nav>
    <?php
    include "nav_index.php";
    ?>
</nav>
<style>
    html,
    body {
        overflow-x: hidden;
    }
    .card{
    height: auto;
    border-radius: 20px;}
    .btn{
    border-radius: 12px;
    color: #fff;
    cursor: pointer;
    font-weight: 700;
    width:  100px;
    height: 44px;
    line-height: 1em;
    max-width: 100%;
    outline: none;
    padding: 10px;
    text-align: center;
    align-items: center;
    }
    
</style>


<!-- <article> -->
<header>

    <body style="height: 100%; min-height: 100vh;">
        <div class="row">
            <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active" aria-current="true" aria-label="First slide"></li>
                    <li data-bs-target="#carouselId" data-bs-slide-to="1" aria-label="Second slide"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <img src="https://cdn.1112.com/1112/public/images/banners/Sep23/sqaure_1440-th.jpg" class="w-100 d-block" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img src="https://cdn.1112.com/1112/public/images/banners/Sep23/BOGO_Coke_swensens_1440_TH.jpg" class="w-100 d-block" alt="Second slide">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div>
</header>
<!-- </article> -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
</script>

<body>
    <h1 style="margin-top:34px; text-align: center;">เมนูพิซซ่า</h1>
    <div class="container">
        <div class="row">
            <?php
            $stmt = $conn->prepare("SELECT pid,pizza.name as name_pizza , pizza.image as image_pizza, pizza.price as pizza_price from pizza , size ,crust where pizza.sid=size.sid  and pizza.cid=crust.cid ");
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) { ?>
                <div class="col-3" style="margin-bottom:3%;">
                    <div class="card" >
                        <div class="row" >
                            <h1 style="margin-top:20px;text-align:center;"><b><?= $row['name_pizza'] ?></b></h1>
                            <img src="<?= $row['image_pizza'] ?>" alt="pizza-pic" style="width:100%;">
                            <h4 style="margin-top:20px;text-align:center;" ><b>*ราคาเริ่มต้น <?= $row['pizza_price']?></b></h4>
                            <button type="button" class="btn btn-success" style="margin-left:12rem; margin-bottom:5px;" onclick="redirectToShowPage(<?= $row['pid'] ?>)"><h2>+เลือก</h2></button>
                            <h5></h5>
                        </div>
                    </div>
                </div>
            <?php
            } ?>
        </div>
    </div>
    
    <script>
        function redirectToShowPage(pid) {
            window.location.href = 'show.php?pid=' + pid;
        }
    </script>
</body>

</html>