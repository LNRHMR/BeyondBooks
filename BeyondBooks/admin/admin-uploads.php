<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Jomer Lunar">
  <meta name="description" content="E-Book Quality Assurance">
  <link rel="icon" type="image/x-icon" href="../media/icon/beyondbooks-logo.ico">
  <!--CSS Bootstrap-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!--CSS-->
  <link rel="stylesheet" type="text/css" href="../navbar.css">
  <link rel="stylesheet" type="text/css" href="admin.css">
  <title>BeyondBooks │ Admin (User Uploads)</title>

</head>

<body style="padding-top: 50px;">
  <!--Navbar-->
  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="../home.html">BeyondBooks <img src="../media/image/dig-book.png"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
        aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel">MENU</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="admin-dshbrd.php">Registered User</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2 active" aria-current="page" href="#">Uploaded Files</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="admin-deleteupl.php">Active Files</a>
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
        <button onclick="location.href = '../logout.php';" class="btn btn-secondary" id="logoutbtn">Yes</button>
      </div>
    </div>
  </div>
</div>
  <!--Logout Confirmation End-->

<!--Table-->
<div class="container my-5">
  <h2>Pending Uploads</h2>
  <table class="table">
    <thead>
      <tr>
        <th>Date</th>
        <th>Student No.</th>
        <th>Last name</th>
        <th>Email</th>
        <th>File Name</th>
        <th>Folder Location</th>
        <th>Preview</th>
        <th>Approve</th>
        <th>Decline</th>
      </tr>
    </thead>
    <tbody>
      <?php
      #Create Connection
      $conn = mysqli_connect("sql302.infinityfree.com", "if0_36713719", "O0L1QO1yuEsd", "if0_36713719_db_beyond_books");

      //Check Connection
      if (!$conn) {
        die("Connection failed: ". mysqli_connect_error());
      }

      //read all row from database table
      $sql = "SELECT * FROM `uploads` ";
      $result = $conn->query($sql);

      if (!$result) {
        die("Invalid query: ". $conn->error);
      }

      //fetch data from table
      while ($row = $result->fetch_assoc()) {
        $filename = $row['filename'];
        $folderlocation = $row['folderlocation'];
        $fileurl = '../'. $folderlocation. '/'. $filename;

        echo "<tr>
          <td>$row[date]</td>
          <td>$row[studentnum]</td>
          <td>$row[lastname]</td>
          <td>$row[email]</td>
          <td>$row[filename]</td>
          <td>$row[folderlocation]</td>
          <td><a href='file-prev.php?url=$fileurl' target='iframe'>View</a></td>
          <td><button class='btn btn-success' onclick='approveFile(\"$row[date]\", \"$row[studentnum]\", \"$row[lastname]\", \"$row[email]\", \"$row[filename]\", \"$row[folderlocation]\")'>Approve</button></td>
          <td><button class='btn btn-danger' onclick='declineFile(\"$row[date]\", \"$row[studentnum]\", \"$row[lastname]\", \"$row[email]\", \"$row[filename]\", \"$row[folderlocation]\")'>Decline</button></td>
        </tr>";
      }

      $conn->close();
      ?>
    </tbody>
  </table>
</div>

<!--Script to connect the decline button to the decline.php file-->
<script type="text/javascript">
function declineFile(date, studentnum, lastname, email, filename, folderlocation) {
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'decline.php?date=' + date + '&studentnum=' + studentnum + '&lastname=' + lastname + '&email=' + email + '&filename=' + filename + '&folderlocation=' + folderlocation, true);
  xhr.send();
  
  // Set a timeout to wait for the page to reload
  setTimeout(function() {
    location.href = '/BeyondBooks/admin/admin-uploads.php?' + new Date().getTime();
  }, 200); // reload speed 100=0.1s
}
</script>


    <!--Connects the approve button to the approve.php-->
<script type="text/javascript">
function approveFile(date, studentnum, lastname, email, filename, folderlocation) {
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'approved.php?date=' + date + '&studentnum=' + studentnum + '&lastname=' + lastname + '&email=' + email + '&filename=' + filename + '&folderlocation=' + folderlocation, true);
  xhr.send();
  // Set a timeout to wait for the page to reload
  setTimeout(function() {
    location.href = '/BeyondBooks/admin/admin-uploads.php?' + new Date().getTime();
  }, 200); // reload speed 100=0.1s
}

</script>

 <!--Script Bootstrap-->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

</script>
    <script type="text/javascript">
      document.getElementById("logoutbtn").onclick = function () {
      location.href = "../admin.php";
      };
</script>

</body>

</html>