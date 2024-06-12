<?php
#Create Connection
$conn = mysqli_connect("sql302.infinityfree.com", "if0_36713719", "O0L1QO1yuEsd", "if0_36713719_db_beyond_books");

//Check Connection
if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

//Get the file details from the GET request
$date = $_GET['date'];
$studentnum = $_GET['studentnum'];
$lastname = $_GET['lastname'];
$email = $_GET['email'];
$filename = $_GET['filename'];
$folderlocation = $_GET['folderlocation'];

//Delete the file from the folder
$file_path = '../'. $folderlocation. '/'. $filename;
if (file_exists($file_path)) {
    unlink($file_path);
}

//Insert into decline table
$stmt = $conn->prepare("INSERT INTO `declined` (`date`, `studentnum`, `lastname`, `email`, `filename`, `folderlocation`) VALUES (?,?,?,?,?,?)");
$stmt->bind_param("ssssss", $date, $studentnum, $lastname, $email, $filename, $folderlocation);
$stmt->execute();

//Delete the data from the 'uploads' table
$stmt = $conn->prepare("DELETE FROM `uploads` WHERE `date` =? AND `studentnum` =? AND `lastname` =? AND `email` =? AND `filename` =? AND `folderlocation` =?");
$stmt->bind_param("ssssss", $date, $studentnum, $lastname, $email, $filename, $folderlocation);
$stmt->execute();

//Close the connection
$conn->close();

//Redirect back to the admin dashboard
header('Location: admin-dshbrd.php');
exit;
?>