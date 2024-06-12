<?php
//php start
session_start();
//Create Connection
$conn = mysqli_connect("sql302.infinityfree.com", "if0_36713719", "O0L1QO1yuEsd", "if0_36713719_db_beyond_books");

//Check Connection
if (!$conn) {
    die("Connection failed: ". mysqli_connect_error());
}

// Login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $studentnum = $_POST["studentnum"];
    $pass = $_POST["password"];
    session_regenerate_id();
    // Check if the student number exists
    $query = "SELECT studentnum, lastname, email, pass FROM `registered-user` WHERE studentnum =?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $studentnum);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $num_rows = mysqli_stmt_num_rows($stmt);

    if ($num_rows > 0) {
        mysqli_stmt_bind_result($stmt, $db_studentnum, $lastname, $email, $db_pass);
        mysqli_stmt_fetch($stmt);

        // Verify the password
        if ($pass == $db_pass) {
            $_SESSION["loggedin"] = true;
            $_SESSION["studentnum"] = $db_studentnum;
            $_SESSION["lastname"] = $lastname;
            $_SESSION["email"] = $email;

            header("Location: /BeyondBooks/home.php?");
            exit;
        } else {
            //redirects to the index page together with ?"error in the url"
            header("Location: index.php?error_message=$error_message&invalid_password=true");
            exit;
        }
    } else {
        //redirects to the index page together with ?"error in the url"
        header("Location: index.php?error_message=$error_message&student_number_not_found=true");
        exit;
    }
}

mysqli_close($conn);

//php end
?>