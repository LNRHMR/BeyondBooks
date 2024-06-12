<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"]!== true) {
    header("location: index.php");
    exit;
}
// Get the logged-in user's data from the session
$studentnum = $_SESSION["studentnum"];
$lastname = $_SESSION["lastname"];
$email = $_SESSION["email"];
session_regenerate_id();
// You can now use these variables to access the logged-in user's data

if (isset($_POST['submit'])) {
    $file = $_FILES['file'];
    
    // setting file attributes
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    //separate the fileName and the file extension
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    // (automatic file type quality management)
    $allowed = array('doc', 'docx', 'pdf', 'xls', 'xlsx', 'jpg', 'jpeg', 'png', 'gif');

    if (!in_array( $fileActualExt, $allowed)) {
      $timetag = time();
      header('Location: file-upl.php?invalid_file_type='. $timetag);
      exit;
  }  else {
        if ($fileError === 0) {
            if ($fileSize < 1104857600) { //maximum file size = 100mb 
                //sorting them to the assigned folders and setting unique name for a file by using "time() + file name"
                $uniqueFileName = $studentnum. '_'. time(). '_'. $fileName;
  
                if ($fileActualExt == 'doc' || $fileActualExt == 'docx') {
                    $fileDestination = 'uploads/documents/'. $uniqueFileName;
                    $folderLocation = 'uploads/documents';
                } elseif ($fileActualExt == 'jpg' || $fileActualExt == 'jpeg' || $fileActualExt == 'png' || $fileActualExt == 'gif') {
                    $fileDestination = 'uploads/images/'. $uniqueFileName;
                    $folderLocation = 'uploads/images';
                } elseif ($fileActualExt == 'xls' || $fileActualExt == 'xlsx') {
                    $fileDestination = 'uploads/spreadsheets/'. $uniqueFileName;
                    $folderLocation = 'uploads/spreadsheets';
                } elseif ($fileActualExt == 'pdf') {
                    $fileDestination = 'uploads/pdf/'. $uniqueFileName;
                    $folderLocation = 'uploads/pdf';
                }
                move_uploaded_file( $fileTmpName, $fileDestination);
  
                // Insert data into user-uploads table
                $conn = mysqli_connect("sql302.infinityfree.com", "if0_36713719", "O0L1QO1yuEsd", "if0_36713719_db_beyond_books");
                if (!$conn) {
                    die("Connection failed: ". mysqli_connect_error());
                }
  
                $sql = "INSERT INTO `uploads` (`studentnum`, `lastname`, `email`, `filename`, `folderlocation`) VALUES (?,?,?,?,?)";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "sssss", $studentnum, $lastname, $email, $uniqueFileName, $folderLocation);
                mysqli_stmt_execute($stmt);
  
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                $timetag = time();
                header('Location: file-upl.php?file_submitted_successfully='. $timetag);
            } else {
              $timetag = time();
              header('Location: file-upl.php?file_too_large='. $timetag);
            }
        } else {
          $timetag = time();
          header('Location: file-upl.php?error_uploading_file='. $timetag);
        }
    }
}
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
    <link rel="stylesheet" type="text/css" href="file-upload.css">
    <title>BeyondBooks │ File Upload</title>
</head>
<body>
    
 <!--Navbar-->
 <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="home.php">BeyondBooks <img src="media/image/dig-book.png"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
        aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div style="max-width:70%;" class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel">MENU</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
              <a class="nav-link mx-lg-2 active" aria-current="page"  href="file-upl.php">Share your works</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2"  href="your-uploads.php">Your Uploads</a>
            </li>
            <li>
              <a class="nav-link mx-lg-2" href="about.php">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="#" data-bs-toggle="modal" data-bs-target="#logout-modal" id="btn-logout">Log Out</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <!--End Navbar-->

 <!--Logout Confirmation-->
<div class="modal fade" id="logout-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        Are you sure you want to logout?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button onclick="location.href = 'logout.php';" class="btn btn-secondary" id="logoutbtn">Yes</button>
      </div>
    </div>
  </div>
</div>
  <!--Logout Confirmation End-->

  <!--File Upload-->
  <div class="container">
  <div class="row justify-content-center">
  <div class="col-md-7">

<!--Displays Alert Message-->

  <?php
if (isset($_GET['file_submitted_successfully']) && is_numeric($_GET['file_submitted_successfully']) && $_GET['file_submitted_successfully'] > 0) {
  echo "<div class='alert alert-secondary text-center' role='alert' style='font-weight:700; color:#DD6B14'>File submitted successfully!</div>";
}

if (isset($_GET['file_too_large=']) && is_numeric($_GET['file_too_large=']) && $_GET['file_too_large='] > 0) {
  echo "<div class='alert alert-danger text-center' role='alert' style='font-weight:700; color:#FF0000'>File too large!</div>";
}

if (isset($_GET['error_uploading_file=']) && is_numeric($_GET['error_uploading_file=']) && $_GET['error_uploading_file='] > 0) {
  echo "<div class='alert alert-danger text-center' role='alert' style='font-weight:700; color:#FF0000'>File too large!</div>";
}

if (isset($_GET['invalid_file_type']) && is_numeric($_GET['invalid_file_type']) && $_GET['invalid_file_type'] > 0) {
  echo "<div class='alert alert-danger text-center' role='alert' style='font-weight:700; color:#FF0000'>Invalid file type!</div>";
}
?>
<!--Dropbox Area-->
  </div>
    <div class="col-md-7">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Share Your Files Here!</h5>
          <form form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
            <div class="dropzone">
              <h5><svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="black" class="bi bi-upload" viewBox="0 0 16 16">
              <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
              <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708z"/>
              </svg></h5>
              <input type="file" name="file" id="file" class="form-control-file" hidden>
              <label for="file" class="label">Choose a file </label>
              or drag it here to upload.
              <p id="file-name"></p> <!--displays the file name -->
              <p>max file size is 100mb.</p>
              <p>('doc', 'docx', 'pdf', 'xls', 'xlsx', 'jpg', 'jpeg', 'png', 'gif')</p>
            </div>
            <input type="submit" name="submit" value="Upload" class="btn btn-primary float-end" id="upl">
            <a href="#" data-bs-toggle="modal" data-bs-target="#status-table">
            Open upload status table
          </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Status Table Modal -->
<div class="modal fade" id="status-table" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel" style="color:#712F31; font-weight:700;">Uploads Status</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

          <!--Status Table-->
          <?php
          // Create Connection
          $conn = mysqli_connect("sql302.infinityfree.com", "if0_36713719", "O0L1QO1yuEsd", "if0_36713719_db_beyond_books");

          // Check Connection
          if ($conn->connect_error) {
              die("Connection failed: ". $conn->connect_error);
          }

// Prepare a SQL query to retrieve rows from uploads table where studentnum matches the logged-in user's studentnum
$stmt = $conn->prepare("SELECT * FROM uploads WHERE studentnum =?");
$stmt->bind_param("s", $_SESSION["studentnum"]);
$stmt->execute();
$result_uploads = $stmt->get_result();

// Prepare a SQL query to retrieve rows from approved table where studentnum matches the logged-in user's studentnum
$stmt = $conn->prepare("SELECT * FROM approved WHERE studentnum =?");
$stmt->bind_param("s", $_SESSION["studentnum"]);
$stmt->execute();
$result_approved = $stmt->get_result();

// Prepare a SQL query to retrieve rows from declined table where studentnum matches the logged-in user's studentnum
$stmt = $conn->prepare("SELECT * FROM declined WHERE studentnum =?");
$stmt->bind_param("s", $_SESSION["studentnum"]);
$stmt->execute();
$result_declined = $stmt->get_result();

// Create a table to display the results
echo "<table class='table'>";
echo "<tr><th>File Name</th><th>Status</th></tr>"; // adjust column names as needed

// Display results from uploads table
while($row = $result_uploads->fetch_assoc()) {
    echo "<tr>";
    echo "<td>". $row['filename']. "</td>";
    echo "<td style='color: orange;'>Pending</td>";
    echo "</tr>";
}

// Display results from approved table
while($row = $result_approved->fetch_assoc()) {
    echo "<tr>";
    echo "<td>". $row['filename']. "</td>";
    echo "<td style='color: green;'>Approved</td>";
    echo "</tr>";
}

// Display results from declined table
while($row = $result_declined->fetch_assoc()) {
    echo "<tr>";
    echo "<td>". $row['filename']. "</td>";
    echo "<td style='color: red;'>Declined</td>";
    echo "</tr>";
}

echo "</table>";

          $conn->close();
         ?>
      </div>
    </div>
  </div>
</div>


    <!--Drag and Drop Upload Script-->
    <script src="file-upload.js"></script>

    <!--Script Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>
</html>