<?php

require "../config/database.php";

// session_start();


// if (isset($_SESSION["admin"])) 
// {
//     echo "<script> location.replace('dashboard.php') </script>";
// }

session_start();
session_unset();
session_destroy();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> STUDENT MENTORING SYSTEM - Admin Login</title>

    <!-- css imports -->

    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.css" />

    <!-- css imports -->

</head>

<body>

    <div class="min-vh-100 d-flex flex-column bg-cover">

        <?php
        if (isset($_SESSION["fail"])) {
        ?>

            <div class="position-fixed top-0 toastae start-50 translate-middle-x p-3" style="z-index: 11">
                <div id="liveToast" class="toast bg-danger bg-opacity-75 hide" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body ms-auto text-white">
                            Login Failed !
                        </div>
                        <button type="button" class="btn-close shadow-none btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            </div>

        <?php
        }
        unset($_SESSION["fail"]);
        ?>


        <div class="container py-5 my-auto">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-md-12">
                    <div class="card rounded text-black border border-danger-subtle shadow-sm">

                        <div class="row g-0">

                            <!-- left column -->

                            <div class="col-md-6 d-flex align-items-center">
                                <div class="card-body p-md-5 py-4 mx-md-4 mx-2">

                                    <div class="text-center">
                                        <!-- <img src="../images/user.png" width="80" alt="logo"> -->
                                        <!-- <i class="fa-solid fa-user-group fa-3x text-danger "></i> -->
                                        <h4 class=" mb-5 text-decoration-underline link-offset-2 text-danger ">
                                        <i class="fa-solid fa-user-secret"></i> Admin Login</h4>
                                    </div>

                                    <form method="post" action="auth.php" id="userloginform">


                                    <div class="input-group mb-4 position-relative">
                                            <span class="input-group-text border-danger" id="basic-username"><i class="fa-solid fa-user"></i></span>
                                            <input type="text" name="username" id="username" class="form-control shadow-none border-danger" placeholder="Username" aria-label="Username" aria-describedby="basic-username">
                                            <div class="invalid-tooltip rounded-3">
                                                * Enter Username
                                            </div>
                                        </div>

                                        <div class="input-group mb-4 position-relative">
                                            <span class="input-group-text border-danger" id="basic-password"><i class="fa-solid fa-key"></i></span>
                                            <input type="password" name="password" id="password" class="form-control shadow-none border-danger" placeholder="Password" aria-label="Password" aria-describedby="basic-password">
                                            <span class="toggle-password" onclick="togglePassword()">
                                                <i class="fas fa-eye"></i>
                                            </span>
                                            <div class="invalid-tooltip rounded-3 ">
                                                * Enter Password
                                            </div>
                                        </div>

                                        <div class="text-center pt-1 pb-1">
                                            <button class="btn btn-outline-danger  w-100 shadow-none" type="submit">Log
                                                in</button>
                                        </div>
 

                                        <div class="text-center gap-2 pt-4">
                                            <a href="../index.php" class="text-decoration-none btn btn-sm rounded-2 btn-danger ">
                                            <i class="fa-solid fa-arrow-circle-left"></i> Back 
                                            </a>
                                            <!-- |
                                            <div class="d-inline">
                                                Don't have an account?
                                                <a href="register.php" class="text-decoration-none text-white shadow-none rounded-2 btn btn-sm btn-danger ">
                                                    Register
                                                </a>
                                            </div> -->
                                        </div>

                                    </form>


                                </div>
                            </div>




                            <div class="col-md-6 d-none d-md-flex rounded-end">
                                <img src="../images/auth.jpg" class="img-fluid" style="object-fit: cover;" alt="logo">
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- javascript imports -->

    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.js"></script>

    <!-- javascript imports -->
</body>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.querySelector('.toggle-password i');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }
</script>

<script>
    $(function() {

        $('.toast').toast('show');


        $("#userloginform").on("submit", function(e) {
            debugger;

            var username = $("#username").val()
            var password = $("#password").val()
            var testemail = new RegExp("[a-z0-9]+@[a-z]+\.[a-z]{2,3}");
            var testphone = new RegExp("^[6-9][0-9]{9}$");
            var testaadhar = new RegExp("^[2-9]{1}[0-9]{3}[0-9]{4}[0-9]{4}$");
 


            if (username != "") {
                $("#username").removeClass("is-invalid");
            } else {
                $("#username").addClass("is-invalid");
                e.preventDefault();
            }

            if (password != "") {
                $("#password").removeClass("is-invalid");
            } else {
                $("#password").addClass("is-invalid");
                e.preventDefault();
            }

        })

        $("input,textarea,select").on("keydown change", function() {
            $(this).removeClass("is-invalid")
        })

    })
</script>

</html>