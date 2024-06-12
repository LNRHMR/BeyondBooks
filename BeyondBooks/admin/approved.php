<?php
// Create Connection
$conn = mysqli_connect("sql302.infinityfree.com", "if0_36713719", "O0L1QO1yuEsd", "if0_36713719_db_beyond_books");

// Check Connection
if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

$date = $_GET['date'];
$studentnum = $_GET['studentnum'];
$lastname = $_GET['lastname'];
$email = $_GET['email'];
$filename = $_GET['filename'];
$folderlocation = $_GET['folderlocation'];

// Prepare and execute SQL queries

//insert into approved table
$stmt = $conn->prepare("INSERT INTO `approved` (`date`, `studentnum`, `lastname`, `email`, `filename`, `folderlocation`) VALUES (?,?,?,?,?,?)");
$stmt->bind_param("ssssss", $date, $studentnum, $lastname, $email, $filename, $folderlocation);
$stmt->execute();
//delete from uploads
$stmt = $conn->prepare("DELETE FROM `uploads` WHERE `date` =? AND `studentnum` =? AND `lastname` =? AND `email` =? AND `filename` =? AND `folderlocation` =?");
$stmt->bind_param("ssssss", $date, $studentnum, $lastname, $email, $filename, $folderlocation);
$stmt->execute();

$conn->close();
?>