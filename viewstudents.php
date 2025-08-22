<?php

require "../config/database.php";

session_start();


if (!isset($_SESSION["admin"])) {
    echo "<script> location.replace('index.php') </script>";
}


if (!isset($_GET["email"])) {
    echo "<script> location.replace('mentors.php') </script>";
}

$email = $_GET["email"];

$querys = "SELECT * FROM mentor_2024_student WHERE mentor = '$email'";
$results = mysqli_query($link, $querys);

if (mysqli_num_rows($results) == 0) {
    echo "<script> location.replace('mentors.php') </script>";
}

$rows = mysqli_fetch_array($results);


?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STUDENT MENTORING SYSTEM - Admin</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.css" />

    <style>
        .accordion {
            --bs-accordion-btn-icon: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='white'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
            --bs-accordion-btn-active-icon: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='white'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
        }

        .tagify__input {
            padding: 0.375rem 0.75rem !important;
            margin: 0.100rem !important;
        }

        .form-control {
            box-shadow: none !important;
        }

        .form-select {
            box-shadow: none !important;
        }
    </style>

</head>

<body>

    <div class="d-flex flex-column bg-white min-vh-100">

      
    <nav class="navbar navbar-expand-lg bg-danger border-danger-emphasis border-bottom">
            <div class="container-fluid  mx-5">
                <a class="navbar-brand text-white fw-bold " href="#">
                    <i class="fa-solid fa-users-rectangle"></i> STUDENT MENTORING SYSTEM </a>
                <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa-solid fa-bars text-white"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-1">

                        <li class="nav-item">
                            <a class="nav-link text-white fw-bold " href="dashboard.php">
                                <i class="fa-solid fa-bar-chart"></i>
                                Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white fw-bold" href="mentors.php">
                                <i class="fa-solid fa-user-tie"></i>
                                Mentors</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white fw-bold" aria-current="page" href="students.php">
                                <i class="fa-solid fa-user-group"></i>
                                Students</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white fw-bold" href="sessions.php">
                                <i class="fa-regular fa-calendar-check"></i>
                                Sessions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white fw-bold" href="logout.php">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>






        <!-- dhsuyfbwqqizyonx -->

        <div class="container flex-fill d-flex flex-column my-2">


            <div class="d-flex mt-5 mb-4 justify-content-between align-items-center">
                <h3 class="text-danger-emphasis link-offset-1 text-decoration-underline flex-grow-1 flex-md-grow-0 text-capitalize">
                    <?=$rows["mentorname"]?>'s Students
                </h3>
                <a class="text-danger-emphasis h3 text-decoration-none" href="mentors.php">
                    <i class="fa-solid fa-circle-arrow-left fa-lg text-danger-emphasis"></i>
                </a>
            </div>
 
            
            <div class="row justify-content-center mb-3 mt-2">

 

                <div class="col-md-12"> 

                <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="usertable">
                            <thead class="text-white">
                                <tr class="align-middle text-center text-nowrap table-danger">
                                    <th class="dt-head-center">Username</th>
                                    <th class="dt-head-center">Name</th>
                                    <th class="dt-head-center">Email</th>
                                    <th class="dt-head-center">Phone</th>
                                    <th class="dt-head-center">Section</th>
                                    <th class="dt-head-center">IA1</th>
                                    <th class="dt-head-center">IA2</th>
                                    <th class="dt-head-center">IA3</th> 
                                    <th class="dt-head-center">Parent's Phone</th>  
                                    <th class="dt-head-center">Image</th>  
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "select * from mentor_2024_student where mentor = '$email'";
                                $result = mysqli_query($link, $query);
                                while ($row = mysqli_fetch_array($result)) {
                                ?>
                                    <tr class="align-middle text-center">
                                        <td><?= $row["username"] ?></td>
                                        <td><?= $row["name"] ?></td>
                                        <td><?= $row["email"] ?></td>
                                        <td><?= $row["phone"] ?></td> 
                                        <td><?= $row["sec"] ?></td> 
                                        <td><?= $row["ia1"] == ""?"N/A":$row["ia1"] ?></td> 
                                        <td><?= $row["ia2"] == ""?"N/A":$row["ia2"] ?></td> 
                                        <td><?= $row["ia3"] == ""?"N/A":$row["ia3"] ?></td> 
                                        <td><?= $row["parentphone"] == ""?"N/A":$row["parentphone"] ?></td> 
                                        <td>
                                            <a href="../<?= $row["image"] ?>" target="_blank" class="btn btn-success shadow-none btn-sm">View</a>
                                        </td> 
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>


                </div>

 


            </div>


        </div>


    </div>

    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>


    <script>
        $(function() {

            $('#times').prop('disabled', true);

            $("#usertable").DataTable({
                lengthMenu: [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, 'All'],
                ],
            });

            $("#usertable2").DataTable({
                lengthMenu: [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, 'All'],
                ],
            });

            $('.toast').toast('show');



            $("input,textarea,select").on("keydown change", function() {
                $(this).removeClass("is-invalid")
            })

            $("#reset").on("click", function() {
                $("input,textarea,select").removeClass("is-invalid")
                $("#previewImg").attr("src", "");
                $("#previewImg").hide();
                $(".previewrow").hide();
            })

        })
    </script>
</body>

</html>