<?php
$date = $_GET['date'];
$studentnum = $_GET['studentnum'];
$lastname = $_GET['lastname'];
$email = $_GET['email'];
$filename = $_GET['filename'];
$folderlocation = $_GET['folderlocation'];

$conn = mysqli_connect("sql302.infinityfree.com", "if0_36713719", "O0L1QO1yuEsd", "if0_36713719_db_beyond_books");

if (!$conn) {
  die("Connection failed: ". mysqli_connect_error());
}

$sql = "DELETE FROM `approved` WHERE `date` = '$date' AND `studentnum` = '$studentnum' AND `lastname` = '$lastname' AND `email` = '$email' AND `filename` = '$filename' AND `folderlocation` = '$folderlocation'";
$result = $conn->query($sql);

if (!$result) {
  die("Invalid query: ". $conn->error);
}

// Delete the physical file
$file_path = $folderlocation. '/'. $filename;
if (file_exists($file_path)) {
  unlink($file_path);
}

$conn->close();
?>