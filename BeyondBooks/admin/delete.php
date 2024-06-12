<?php
#Create Connection
$conn = mysqli_connect("sql302.infinityfree.com", "if0_36713719", "O0L1QO1yuEsd", "if0_36713719_db_beyond_books");

//Check Connection
if (!$conn) {
    die("Connection failed: ". mysqli_connect_error());
}

//get studentnum from URL parameter
$studentnum = $_GET['studentnum'];

//delete user from database
$sql = "DELETE FROM `registered-user` WHERE studentnum = '$studentnum'";
$result = $conn->query($sql);

if (!$result) {
    die("Invalid query: ". $conn->error);
}

//redirect back to admin dashboard
header("Location: admin-dshbrd.php");
exit;
?>