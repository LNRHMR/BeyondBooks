<?php
//php start
//Create Connection
$conn = mysqli_connect("sql302.infinityfree.com", "if0_36713719", "O0L1QO1yuEsd", "if0_36713719_db_beyond_books");

//Check Connection
if (!$conn) {
    die("Connection failed: ". mysqli_connect_error());
}

// Registration
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentnum = $_POST["studentnum"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    $confpass = $_POST["confpass"];

    // Check if the passwords match
    if ($pass == $confpass) {
        // Check if the student number already exists
        $query = "SELECT * FROM `registered-user` WHERE studentnum =?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $studentnum);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $num_rows = mysqli_stmt_num_rows($stmt);

        if ($num_rows > 0) {
            $error_message = "student_number_not_found";
            header("Location: index.php?error_message=$error_message&student_number_not_found=true");
            exit;

        } else {
            $query = "INSERT INTO `registered-user` (studentnum, lastname, email, pass) VALUES (?,?,?,?)";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "ssss", $studentnum, $lastname, $email, $pass);
            mysqli_stmt_execute($stmt);

            header("Location: BeyondBooks/reg-success.php");
            exit;
        }
    } else {
        $error_message = "Passwords do not match";
        header("Location: index.php?error_message=$error_message&passwords_do_not_match=true");
        exit;
    }
}

mysqli_close($conn);

//php end
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Jomer Lunar">
    <meta name="description" content="E-Book Quality Assurance">
    <link rel="icon" type="image/x-icon" href="media/icon/beyondbooks-logo.ico">
    <!--CSS Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="navbar.css">
    <link rel="stylesheet" type="text/css" href="index.css">
    <title>BeyondBooks │ User Login</title>
</head>

<body>
    <!--Navbar-->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">BeyondBooks <img src="media/image/dig-book.png"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">MENU</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2 active" aria-current="page" href="#">User Login</a>
                        </li>
                        <li>
                          <a class="nav-link mx-lg-2"href="aboutpg.php">About</a>
                         </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!--End Navbar-->

<!--Login Form-->
<form action="login.php" method="post">
    <div class="wrapper">
        <div class="container main">
            <div class="row">
                <div class="col-md-6 side-image">
                    <!--Image Here-->
                    <img src="media/image/dig-book.png" alt="BeyondBooks-Logo">
                    <div class="text">
                        <p>Open a World of Knowledge Beyond the Books - <i>Beyondbooks</i></p>
                    </div>
                </div>
                <div class="col-md-6 right">
                    <div class="input-box">
                        <header>Welcome to <span>BeyondBooks</span></header>
                        <!--checks if the $error_message here is == to the error message that occurs-->
                        <!--then displays The actual error message-->
                        <?php if (isset($_GET['student_number_not_found']) && $_GET['student_number_not_found'] == 'true') 
                            if (isset($_GET['error_message'])) {
                            echo "<p style='color: red; margin-left: 10px; font-size:12px;'>Student number not found</p>";
                        }?>
                        <div class="input-field">
                            <input type="text" class="input" id="student-num" name="studentnum" required>
                            <label for="stident-num">Student no.</label>
                        </div>
                        <!--checks if the $error_message here is == to the error message that occurs-->
                        <!--then displays The actual error message-->
                        <?php
                            if (isset($_GET['invalid_password']) && $_GET['invalid_password'] == 'true') {
                                echo "<p style='color: red; margin-left: 10px; font-size:12px;'>Invalid password</p>";
                        }?>
                        <div class="input-field">
                            <input type="password" class="input" id="password" required name="password">
                            <label for="password">Password</label>
                        </div>
                        <div class="input-field">
                            <input type="submit" class="submit" value="Log In" id="user-submit" name="login">
                        </div>
                        <div class="signin">
                            <span>Don't have an account? <button data-bs-toggle="modal" data-bs-target="#signup-modal">Sign up here</button></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!--End Login Form-->

    <!--Modal-->
    <div class="modal fade" id="signup-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                    <div class="modal-body">
                        <div class="wrapper" id="signin-popup">
                            <div class="container main2">
                                <div class="row">
                                    <div class="col right">
                                        <button class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                                        <div class="input-box">
                                            <header>Create account</header>
                                            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                                            <!--Form Content-->
                                            <div class="input-field">
                                                <input type="text" class="input" id="student-num" name="studentnum" required>
                                                <label for="stident-num">Student no.</label>
                                            </div>
                                            <div class="input-field">
                                                <input type="text" class="input" id="name" required name="lastname">
                                                <label for="name">Last Name</label>
                                            </div>
                                            <div class="input-field">
                                                <input type="text" class="input" id="email" name="email" required autocomplete="off">
                                                <label for="email">Email</label>
                                            </div>
                                            <!--checks if the $error_message here is == to the error message that occurs-->
                                            <!--then displays The actual error message-->
                                            <?php
                                                if (isset($_GET['passwords_do_not_match']) && $_GET['passwords_do_not_match'] == 'true') {
                                                echo "<p style='color: red; margin-left: 10px; font-size:12px;'>Passwords didn't match</p>";
                                            }?>
                                            <div class="input-field">
                                                <input type="password" class="input" id="password" name="pass" required>
                                                <label for="password">Password</label>
                                            </div>
                                            <div class="input-field">
                                            <input type="password" class="input" id="conf-password" name="confpass" required>
                                            <label for="conf-password">Confirm Password</label>
                                        </div>
                                        <!-- submit button -->
                                        <div class="input-field">
                                            <input type="submit" class="submit" value="Sign Up" id="user-signup" name="register">
                                        </div>
                                        <!--Form Content End-->        
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <!--End Modal-->

    <!--Prevents back button to work-->
<script type="text/javascript">
<script type="text/javascript">
  function disableBack() { window.history.forward(); }
  setTimeout("disableBack()", 0);
  window.onunload = function () { null };
</script>
</script>

    <!--Script Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>
</html>