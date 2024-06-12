<?php
#Create Connection
$conn = mysqli_connect("sql302.infinityfree.com", "if0_36713719", "O0L1QO1yuEsd", "if0_36713719_db_beyond_books");

//Check Connection
if (!$conn) {
    die("Connection failed: ". mysqli_connect_error());
}

//get the data from the form
$studentnum = $_POST['studentnum'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$pass = $_POST['pass'];

//update the row in the database table
$sql = "UPDATE `registered-user` SET lastname = '$lastname', email = '$email', pass = '$pass' WHERE studentnum = '$studentnum'";
$result = $conn->query($sql);

if (!$result) {
    die("Invalid query: ". $conn->error);
}

//close the connection
$conn->close();

//redirect to the admin dashboard
header("Location: admin-dshbrd.php");
exit;
?>