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
                            <a class="nav-link text-white fw-bold text-decoration-underline link-offset-2 fw-bold" aria-current="page" href="students.php">
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

        
        <?php
        if (isset($_SESSION["fail"])) {
        ?>
            <div class="position-fixed top-0 toastae start-50 translate-middle-x p-3" style="z-index: 11">
                <div id="liveToast" class="toast bg-danger bg-opacity-75 hide" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body ms-auto text-white">
                            Student saving failed !
                        </div>
                        <button type="button" class="btn-close shadow-none btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            </div>

        <?php
        }
        unset($_SESSION["fail"]);
        ?>



        <?php
        if (isset($_SESSION["save"])) {
        ?>
            <div class="position-fixed top-0 toastae start-50 translate-middle-x p-3" style="z-index: 11">
                <div id="liveToast" class="toast bg-success bg-opacity-75 hide" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body ms-auto text-white">
                            Student saved successfully !
                        </div>
                        <button type="button" class="btn-close shadow-none btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            </div>

        <?php
        }
        unset($_SESSION["save"]);
        ?>


        <!-- dhsuyfbwqqizyonx -->

        <div class="container flex-fill d-flex flex-column my-2">


            <div class="d-flex mt-5 mb-5 justify-content-start align-items-center">
                <h3 class="text-primary-emphasis link-offset-1 text-decoration-underline flex-grow-1 flex-md-grow-0">
                    Students
                </h3>
            </div>


            <div class="row justify-content-center mb-3 mt-2">


                <div class="col-md-12">

                    <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                        <li class="nav-item shadow-none" role="presentation">
                            <button class="nav-link active shadow-nonee" id="new-tab" data-bs-toggle="tab" data-bs-target="#new-tab-pane" type="button" role="tab" aria-controls="new-tab-pane" aria-selected="true">New Student</button>
                        </li>
                        <li class="nav-item shadow-none" role="presentation">
                            <button class="nav-link shadow-none" id="view-tab" data-bs-toggle="tab" data-bs-target="#view-tab-pane" type="button" role="tab" aria-controls="view-tab-pane" aria-selected="false">View Student</button>
                        </li>
                    </ul>


                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade show active" id="new-tab-pane" role="tabpanel" aria-labelledby="new-tab" tabindex="0">

                            <form method="post" action="savestudent.php" id="savestudentform" enctype="multipart/form-data">

                                <div class="row justify-content-center gx-5 gy-4 my-4">
 

                                <div class="col-md-12 position-relative">
                                        <label for="mentor" class="form-label">Mentor :</label>
                                        <select name="mentor" id="mentor" class="form-select shadow-none border border-danger">
                                            <option value="">Select Mentor</option>
                                            <?php
                                            $mentors = $link->query("SELECT * FROM mentor_2024_mentor");
                                            while ($mentor = $mentors->fetch_assoc()) {
                                            ?>
                                                <option phone="<?= $mentor["phone"] ?>" value="<?= $mentor["email"] ?>"><?= $mentor["name"] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <div class="invalid-tooltip rounded-3">
                                            * Select Mentor
                                        </div>
                                    </div>

                                    <input type="hidden" name="mentorname" id="mentorname" value="">
                                    <input type="hidden" name="mentorphone" id="mentorphone" value="">
 

                                    <div class="col-md-6 position-relative">
                                        <label for="name" class="form-label">Name :</label>
                                        <input type="text" name="name" id="name" placeholder="Name" class="form-control shadow-none border border-danger">
                                        <div class="invalid-tooltip rounded-3">
                                            * Enter Name
                                        </div>
                                    </div>


                                    <div class="col-md-6 position-relative">
                                        <label for="usn" class="form-label">USN :</label>
                                        <input type="text" name="usn" id="usn" placeholder="USN" class="form-control shadow-none border border-danger">
                                        <div class="invalid-tooltip rounded-3">
                                            * Enter USN
                                        </div>
                                    </div>


                                    <div class="col-md-6 position-relative">
                                        <label for="username" class="form-label">Username :</label>
                                        <input type="text" name="username" id="username" placeholder="Username" class="form-control shadow-none border border-danger">
                                        <div class="invalid-tooltip rounded-3">
                                            * Enter Username
                                        </div>
                                    </div>


                                    <div class="col-md-6 position-relative">
                                        <label for="email" class="form-label">Email :</label>
                                        <input type="text" name="email" id="email" placeholder="Email" class="form-control shadow-none border border-danger">
                                        <div class="invalid-tooltip rounded-3 alertemail">
                                            * Enter Valid Email
                                        </div>
                                    </div>


                                    <div class="col-md-6 position-relative">
                                        <label for="password" class="form-label">Password :</label>
                                        <input type="text" name="password" id="password" placeholder="Password" class="form-control shadow-none border border-danger">
                                        <div class="invalid-tooltip rounded-3">
                                            * Enter Password
                                        </div>
                                    </div>


                                    <div class="col-md-6 position-relative">
                                        <label for="phone" class="form-label">Phone :</label>
                                        <input type="text" name="phone" id="phone" placeholder="Phone" class="form-control shadow-none border border-danger">
                                        <div class="invalid-tooltip rounded-3 alertphone">
                                            * Enter Valid Phone
                                        </div>
                                    </div>


                                    <div class="col-md-6 position-relative">
                                        <label for="image" class="form-label">Image :</label>
                                        <input type="file" name="image" id="image" placeholder="Image" class="form-control shadow-none border border-danger">
                                        <div class="invalid-tooltip rounded-3">
                                            * Select Image
                                        </div>
                                    </div>


                                    <div class="col-md-6 position-relative">
                                        <label for="section" class="form-label">Section :</label>
                                        <select name="section" id="section" class="form-select shadow-none border border-danger">
                                            <option value="">Select Section</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                        </select>
                                        <div class="invalid-tooltip rounded-3">
                                            * Select Section
                                        </div>
                                    </div>


                                    <div class="col-md-6 position-relative">
                                        <label for="ia1" class="form-label">Subject :</label>
                                        <input type="text" name="subjectx" id="subjectx" placeholder="Enter Subject name" class="form-control shadow-none border border-danger" min="0">
                                        <div class="invalid-tooltip rounded-3">
                                            * Enter Subject
                                        </div>
                                    </div>

                                    <div class="col-md-6 position-relative">
                                        <label for="ia1" class="form-label">IA 1 :</label>
                                        <input type="number" name="ia1" id="ia1" placeholder="IA 1" class="form-control shadow-none border border-danger" min="0">
                                        <div class="invalid-tooltip rounded-3">
                                            * Enter IA 1
                                        </div>
                                    </div>


                                    <div class="col-md-6 position-relative">
                                        <label for="ia2" class="form-label">IA 2 :</label>
                                        <input type="number" name="ia2" id="ia2" placeholder="IA 2" class="form-control shadow-none border border-danger" min="0">
                                        <div class="invalid-tooltip rounded-3">
                                            * Enter IA 2
                                        </div>
                                    </div>


                                    <div class="col-md-6 position-relative">
                                        <label for="ia3" class="form-label">IA 3 :</label>
                                        <input type="number" name="ia3" id="ia3" placeholder="IA 3" class="form-control shadow-none border border-danger" min="0">
                                        <div class="invalid-tooltip rounded-3">
                                            * Enter IA 3
                                        </div>
                                    </div>



                                    <div class="col-md-6 position-relative">
                                        <label for="parentphone" class="form-label">Parent's Phone :</label>
                                        <input type="text" name="parentphone" id="parentphone" placeholder="Parent's Phone" class="form-control shadow-none border border-danger">
                                        <div class="invalid-tooltip rounded-3 alertparentphone">
                                            * Enter Valid Parent's Phone
                                        </div>
                                    </div>

                                    <div class="col-md-6 mt-4-5">
                                        <button type="submit" name="savestudent" class="btn btn-outline-primary w-100 shadow-none fw-bold">Save Student</button>
                                    </div>

                                    <div class="col-md-12 mt-4-5">
                                        <button type="reset" name="reset" id="reset" class="btn btn-outline-danger w-100 shadow-none fw-bold">Reset</button>
                                    </div>
                                    


                                </div>

                            </form>

                        </div>


                        <div class="tab-pane fade" id="view-tab-pane" role="tabpanel" aria-labelledby="view-tab" tabindex="0">

                            <div class="table-responsive mb-3 mt-5">
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
                                            <th class="dt-head-center">Mentor</th>
                                            <th class="dt-head-center">Image</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = "select * from mentor_2024_student";
                                        $result = mysqli_query($link, $query);
                                        while ($row = mysqli_fetch_array($result)) {
                                        ?>
                                            <tr class="align-middle text-center">
                                                <td><?= $row["username"] ?></td>
                                                <td><?= $row["name"] ?></td>
                                                <td><?= $row["email"] ?></td>
                                                <td><?= $row["phone"] ?></td>
                                                <td><?= $row["sec"] ?></td>
                                                <td><?= $row["ia1"] == "" ? "N/A" : $row["ia1"] ?></td>
                                                <td><?= $row["ia2"] == "" ? "N/A" : $row["ia2"] ?></td>
                                                <td><?= $row["ia3"] == "" ? "N/A" : $row["ia3"] ?></td>
                                                <td><?= $row["parentphone"] == "" ? "N/A" : $row["parentphone"] ?></td>
                                                <td><?= $row["mentorname"] == "" ? "N/A" : $row["mentorname"] ?></td>
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


            $("#mentor").on("change", function() {
                debugger;
                value = $("#mentor option:selected").text();
                $("#mentorname").val(value);
                value = $("#mentor option:selected").attr("phone");
                $("#mentorphone").val(value);
            })
           
            $("#savestudentform").on("submit", function(e) {
                debugger;

                let phonestat = false;

                var email = $("#email").val()
                var password = $("#password").val()
                var name = $("#name").val()
                var phone = $("#phone").val()
                var usn = $("#usn").val()
                var section = $("#section").val()
                var username = $("#username").val()
                var ia1 = $("#ia1").val()
                var ia2 = $("#ia2").val()
                var ia3 = $("#ia3").val()
                var parentphone = $("#parentphone").val()
                var image = $("#image").val()
                var mentor = $("#mentor").val()
                var testemail = new RegExp("[a-z0-9]+@[a-z]+\.[a-z]{2,3}");
                var testphone = new RegExp("^[6-9][0-9]{9}$");
                var testaadhar = new RegExp("^[2-9]{1}[0-9]{3}[0-9]{4}[0-9]{4}$");
                var testusn = new RegExp("(?=(.*[a-zA-Z])(?=.*[0-9]))");

                if (email != "") {
                    if (!testemail.test(email)) {
                        $(".alertemail").text("* Enter Valid Email");
                        $("#email").addClass("is-invalid");
                        e.preventDefault();
                    } else {
                        $("#email").removeClass("is-invalid");
                    }
                } else {
                    $(".alertemail").text("* Enter Email");
                    $("#email").addClass("is-invalid");
                    e.preventDefault();
                }

                if (phone != "") {
                    if (!testphone.test(phone)) {
                        $(".alertphone").text("* Enter Valid Phone");
                        $("#phone").addClass("is-invalid");
                        e.preventDefault();

                    } else {
                        $("#phone").removeClass("is-invalid");
                    }
                } else {
                    $(".alertphone").text("* Enter Phone");
                    $("#phone").addClass("is-invalid");
                    e.preventDefault();
                }


                if (password != "") {
                    $("#password").removeClass("is-invalid");
                } else {
                    $("#password").addClass("is-invalid");
                    e.preventDefault();
                }


                if (image != "") {
                    $("#image").removeClass("is-invalid");
                } else {
                    $("#image").addClass("is-invalid");
                    e.preventDefault();
                }

                if (name != "") {
                    $("#name").removeClass("is-invalid");
                } else {
                    $("#name").addClass("is-invalid");
                    e.preventDefault();
                }


                if (usn != "") {
                    if (!testusn.test(usn)) {
                        $(".alertusn").text("* Enter Valid USN");
                        $("#usn").addClass("is-invalid");
                        e.preventDefault();
                    } else {
                        $("#usn").removeClass("is-invalid");
                    }
                } else {
                    $(".alertusn").text("* Enter USN");
                    $("#usn").addClass("is-invalid");
                    e.preventDefault();
                }


                if (section != "") {
                    $("#section").removeClass("is-invalid");
                } else {
                    $("#section").addClass("is-invalid");
                    e.preventDefault();
                }

                if (username != "") {
                    $("#username").removeClass("is-invalid");
                } else {
                    $("#username").addClass("is-invalid");
                    e.preventDefault();
                }

                if (ia1 != "") {
                    $("#ia1").removeClass("is-invalid");
                } else {
                    $("#ia1").addClass("is-invalid");
                    e.preventDefault();
                }

                if (ia2 != "") {
                    $("#ia2").removeClass("is-invalid");
                } else {
                    $("#ia2").addClass("is-invalid");
                    e.preventDefault();
                }

                if (ia3 != "") {
                    $("#ia3").removeClass("is-invalid");
                } else {
                    $("#ia3").addClass("is-invalid");
                    e.preventDefault();
                }

                if (mentor != "") {
                    $("#mentor").removeClass("is-invalid");
                } else {
                    $("#mentor").addClass("is-invalid");
                    e.preventDefault();
                }

                if (parentphone != "") {
                    if (!testphone.test(parentphone)) {
                        $(".alertparentphone").text("* Enter Valid Parent's Phone");
                        $("#parentphone").addClass("is-invalid");
                        e.preventDefault();

                    } else {
                        $("#parentphone").removeClass("is-invalid");
                    }
                } else {
                    $(".alertparentphone").text("* Enter Parent's Phone");
                    $("#parentphone").addClass("is-invalid");
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