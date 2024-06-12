<?php
#Create Connection
$conn = mysqli_connect("sql302.infinityfree.com", "if0_36713719", "O0L1QO1yuEsd", "if0_36713719_db_beyond_books");

//Check Connection
if (!$conn) {
    die("Connection failed: ". mysqli_connect_error());
}

// Check if studentnum parameter is present in the URL
if (isset($_GET['studentnum'])) {
    $studentnum = $_GET['studentnum'];

    //read the row from the database table
    $sql = "SELECT * FROM `registered-user` WHERE studentnum = '$studentnum'";
    $result = $conn->query($sql);

    if (!$result) {
        die("Invalid query: ". $conn->error);
    }

    //fetch the data from the table
    $row = $result->fetch_assoc();
} else {
    echo "Error: No student number provided";
    exit;
}
?>

<!-- HTML code here -->
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
  <title>BeyondBooks │ Admin</title>
</head>
<body style="padding-top: 50px;">
  <!--Navbar-->
  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="admin-dshbrd.php">BeyondBooks <img src="../media/image/dig-book.png"></a>
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
              <a class="nav-link mx-lg-2 active" aria-current="page" href="admin-dshbrd.php">Registered User</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="#">Uploaded Files</a>
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
        <button onclick="location.href = 'index.html';" class="btn btn-secondary" id="logoutbtn">Yes</button>
      </div>
    </div>
  </div>
</div>
  <!--Logout Confirmation End-->

<!--User Edit Field-->
<div class="container my-5">
  <h2 class="text-center">Edit User No. <?php echo $studentnum;?></h2>
  <form action="update.php" method="post">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <input type="hidden" name="studentnum" value="<?php echo $studentnum;?>">
        <div class="mb-3">
          <label for="lastname" class="form-label">Last Name</label>
          <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $row['lastname'];?>">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email'];?>">
        </div>
        <div class="mb-3">
          <label for="pass" class="form-label">Password (Hashed)</label>
          <input type="text" class="form-control" id="pass" name="pass" value="<?php echo $row['pass'];?>">
        </div>
        <button class="submit" type="submit" class="btn btn-primary btn-block">Update</button>
      </div>
    </div>
  </form>
</div>
<!--User Edit Field End-->

<!--Style-->
<style>
.container {
    max-width: 50%;
    margin: 0 auto;
    background: #e4e4e4;
    border: 1px solid #ccc;
    padding: 10px;
    border-radius: 5px;
}

@media only screen and (max-width: 768px){
    .container {
    max-width: 360px;
}

}

.submit{
    margin-bottom: 15px;
    font-weight: 500;
    padding: 5px;
    color: #712F31;
    background: #e0e0e0;
    border-radius: 5px;
    border: solid 2px #7e7e7e;
    box-shadow: 3px 3px 3px 1px rgba(0, 0, 0, 0.2);
    transition: 0.2s;
}

.submit:hover{
    background: #712F31;
    color: #e4e1e1;
}
</style>

<!-- Script Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

    <script type="text/javascript">
      document.getElementById("logoutbtn").onclick = function () {
      location.href = "../admin.php";
      };
      </script>

</body>

</html>