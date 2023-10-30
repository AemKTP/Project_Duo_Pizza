<?php
include "dbconn.php";

$uid = $_POST['uid'];



// $pid = isset($_GET['pid']) ? $_GET['pid'] : null;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    <title>Cart</title>

    <nav>

        <?php
        error_reporting(E_ALL);
        // ini_set('display_errors', 1);
        // echo intval($_GET['uid']);



        // print_r($_POST);
        include "nav.php";

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
</head>

<body>
    <div class="row centercard">
        <div class="col">
            <div class="container">
                <div class="card" style="overflow-y: scroll;">
                    <div class="row" style="margin-left: 2%; margin-right: 2%;">
                        <div class="container" style="margin-block: 2%;">
                            <h1 style="display: flex; justify-content: center; text-decoration: underline;">ข้อมูล</h1>
                        </div>

                        <div class="row" style="display: flex; justify-content: center; align-items: center; ">

                            <?php $row = $result->fetch_assoc(); ?>


                            <div class="row" style="display: flex; justify-content: center; align-items: center; ">
                                <?php
                                $newuid = intval($_GET['uid']) or intval($_POST['uid']);
                                $stmt = $conn->prepare("Select * from user where uid = ?");
                                $stmt->bind_param('i', $newuid);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                while ($userrow = $result->fetch_assoc()) { ?>

                                    <img src="<?= $userrow['picture'] ?>" alt="picture_Customer" style="border-radius: 50%; width: 300px; height: 300px; object-fit: cover; margin-bottom: 2%;">
                                    <div class="row">
                                        <div class="col" style="display: flex; justify-content: center; align-items: center;">
                                            <h2>Name : <?= $userrow['name'] ?></h2>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col" style="display: flex; justify-content: center; align-items: center;">
                                            <h2>Phone : <?= $userrow['phone'] ?></h2>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col" style="display: flex; justify-content: center; align-items: center;">
                                            <h2>Email : <?= $userrow['email'] ?></h2>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col" style="display: flex; justify-content: center; align-items: center;">
                                            <h2>Address : <?= $userrow['Address'] ?></h2>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        เปลี่ยนข้อมูล
                                    </button>

                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel"><b>New Address</b></h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="update_detail_user.php?uid=<?= $uid?>" method="post" class="update-datail">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="name" >
                                                                <h6><b>NewName:</b></h6>
                                                            </label>
                                                            <input type="text" id="newname" name="newname" placeholder="<?= $userrow['name'] ?>" style="width: 450px; height: 50px;" >
                                                            <label for="newphone">
                                                                <h6><b>Newphone:</b></h6>
                                                            </label>
                                                            <input type="tel" name="newphone" id="newphone" placeholder="<?= $userrow['phone'] ?>" pattern="[0-9]{10}" style="border-radius: 50px; width: 450px;" >
                                                            <label for="newemail">
                                                                <h6><b>NewEmail:</b></h6>
                                                            </label>
                                                            <input type="email" id="newemail" name="newemail" placeholder="<?= $userrow['email'] ?>" style="border-radius: 20px; width: 450px;" >
                                                            <label for="newAddress">
                                                                <h6><b>NewAddress:</b></h6>
                                                            </label>
                                                            <input type="text" id="newaddress" name="newaddress" placeholder="<?= $userrow['Address'] ?>" style="width: 450px; height: 150px;" >
                                                            <label for="newphoto">
                                                                <h6><b>NewPicture:</b></h6>
                                                            </label>
                                                            <input type="text" id="newpicture" name="newpicture" placeholder="<?= $userrow['picture'] ?>" style="width: 450px; height: 150px;" >
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="uid" value="<?= $uid ?>">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary" onclick="changeAddress()">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                                }
                                ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.js"></script> 
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.css">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const updatedetails = document.querySelectorAll('.update-datail');

            updatedetails.forEach((form) => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'You are update your information!',
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: 'blue',
                        cancelButtonColor: 'red',
                        confirmButtonText: 'update it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); 
                        }
                    });
                });
            });
        });
    </script>
</html>