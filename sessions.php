<?php

require "../config/database.php";

session_start();


if (!isset($_SESSION["admin"])) {
    echo "<script> location.replace('index.php') </script>";
}


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
                            <a class="nav-link text-white  text-decoration-underline link-offset-2 fw-bold" href="sessions.php">
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


            <div class="d-flex mt-5 mb-5 justify-content-start align-items-center">
                <h3 class="text-primary-emphasis link-offset-1 text-decoration-underline flex-grow-1 flex-md-grow-0">
                Sessions
                </h3>
            </div>


            <div class="row justify-content-center mb-3 mt-2">



                <div class="col-md-12">

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="usertable">
                            <thead class="text-white">
                                <tr class="align-middle text-center text-nowrap table-danger"> 
                                    <th class="dt-head-center">Date</th> 
                                    <th class="dt-head-center">Time</th> 
                                    <th class="dt-head-center">Mentor</th> 
                                    <th class="dt-head-center">Topic</th> 
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "select * from mentor_2024_session";
                                $result = mysqli_query($link, $query);
                                while ($row = mysqli_fetch_array($result)) {
                                ?>
                                    <tr class="align-middle text-center"> 
                                        <td><?= $row["date"] ?></td>
                                        <td><?= $row["time"] ?></td> 
                                        <td><?= $row["mentorname"] ?></td> 
                                        <td><?= $row["topic"] ?></td> 
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


            $("#user").on("change", function() {
                debugger;
                value = $("#user option:selected").text();
                $("#username").val(value);
            })


            $(".updatevehicleform").on("submit", function(e) {

                debugger;

                var name = $(this).find("input[name='name']").val();
                var vehicleno = $(this).find("input[name='vehicleno']").val();
                var licenseno = $(this).find("input[name='licenseno']").val();
                var type = $(this).find("select[name='type']").val();

                var testemail = new RegExp("[a-z0-9]+@[a-z]+\.[a-z]{2,3}");
                var testphone = new RegExp("^[6-9][0-9]{9}$");
                var testaadhar = new RegExp("^[2-9]{1}[0-9]{3}[0-9]{4}[0-9]{4}$");
                var testvehicleno = new RegExp('^[A-Z]{2}\\d{2}[A-Z]{1,2}\\d{4}$');
                var testlicenseno = new RegExp('^[0-9]{11}$');


                if (name != "") {
                    $(this).find("input[name='name']").removeClass("is-invalid");
                } else {
                    $(this).find("input[name='name']").addClass("is-invalid");
                    e.preventDefault();
                }

                if (type != "") {
                    $(this).find("select[name='type']").removeClass("is-invalid");
                } else {
                    $(this).find("select[name='type']").addClass("is-invalid");
                    e.preventDefault();
                }


                if (vehicleno != "") {
                    if (!testvehicleno.test(vehicleno)) {
                        $(this).find(".alertvehicleno").text("* Enter Valid Vehicle No");
                        $(this).find("input[name='vehicleno']").addClass("is-invalid");
                        e.preventDefault();
                    } else {
                        $(this).find("input[name='vehicleno']").removeClass("is-invalid");
                    }
                } else {
                    $(this).find(".alertvehicleno").text("* Enter Vehicle No");
                    $(this).find("input[name='vehicleno']").addClass("is-invalid");
                    e.preventDefault();
                }


                if (licenseno != "") {
                    if (!testlicenseno.test(licenseno)) {
                        $(this).find(".alertlicenseno").text("* Enter Valid Driver License No");
                        $(this).find("input[name='licenseno']").addClass("is-invalid");
                        e.preventDefault();
                    } else {
                        $(this).find("input[name='licenseno']").removeClass("is-invalid");
                    }
                } else {
                    $(this).find(".alertlicenseno").text("* Enter Driver License No");
                    $(this).find("input[name='licenseno']").addClass("is-invalid");
                    e.preventDefault();
                }


            })



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