<?php
if (isset($_POST['otp']) && isset($_POST['login'])) {
    $otpInputValue = $_POST['otp'];
    // Verify the OTP here
    if ($otpInputValue === $storedOtp) {
        // Login successful, set session variable
        $_SESSION['adminLoggedIn'] = true;
        echo 'login_success';
        exit;
    } else {
        echo 'invalid_otp';
        exit;
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
  <link rel="icon" type="image/x-icon" href="../media/icon/beyondbooks-logo.ico">
  <!--CSS Bootstrap-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!--CSS-->
  <link rel="stylesheet" type="text/css" href="../navbar.css">
  <link rel="stylesheet" type="text/css" href="admin.css">
  <title>BeyondBooks │ Admin (Registered Users)</title>
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
              <a class="nav-link mx-lg-2" href="admin-uploads.php">Uploaded Files</a>
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

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="delete-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        Are you sure you want to delete this user?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button type="button" class="btn btn-danger" id="delete-btn">Yes</button>
      </div>
    </div>
  </div>
</div>
<!-- Delete Confirmation Modal End -->

  <!--Table-->
<div class="container my-5">
    <h2>Registered Users</h2>
    <table class="table">
    <thead>
        <tr>
            <th>Student No.</th>
            <th>Last name</th>
            <th>Email</th>
            <th>Password (Hashed)</th>
            <th>Action</th>
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
        $sql = "SELECT * FROM `registered-user` ";
        $result = $conn->query($sql);

        if (!$result) {
            die("Invalid query: ". $conn->error);
        }

        //fetch data from table
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
            <td>$row[studentnum]</td>
            <td>$row[lastname]</td>
            <td>$row[email]</td>
            <td>$row[pass]</td>
            <td><a class='btn btn-primary btn-sm' href='admin-edit.php?studentnum=$row[studentnum]'>Edit</a>
             <a class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#delete-modal' data-studentnum='$row[studentnum]'>Delete</a></td>
          </tr>";
        }

       ?>
    </tbody>
</table>
</div>

<!-- JavaScript OTP -->
<script>
    // JavaScript code for generating and verifying the OTP
    const sendOtpButton = document.getElementById('send-otp');
    const otpInput = document.getElementById('otp');
    let otpGenerated; // Declare otpGenerated here

    sendOtpButton.addEventListener('click', () => {
        // Generate OTP and send to user's email address
        otpGenerated = generateOtp();
        console.log(`OTP sent to beyond.books.learn@gmail.com: ${otpGenerated}`);
        otpInput.value = '';

        // Create a Web3Forms API request
        const formData = new FormData();
        formData.append('access_key', 'abf6fd31-77e4-4a95-8cdf-70958d7b27db');
        formData.append('email', 'beyond.books.learn@gmail.com');
        formData.append('message', `Your OTP is: ${otpGenerated}`);

        fetch('https://api.web3forms.com/submit', {
            method: 'POST',
            body: formData
        })
       .then(response => response.json())
       .then(data => console.log(`OTP sent to beyond.books.learn@gmail.com: ${otpGenerated}`))
       .catch(error => console.error('Error sending OTP:', error));
    });

    function generateOtp() {
        return Math.floor(100000 + Math.random() * 900000); // Generate a new OTP
    }

    document.addEventListener('submit', (e) => {
    e.preventDefault();
    const otpInputValue = otpInput.value.trim();
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'admin-dshbrd.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(`otp=${otpInputValue}&login=true`);

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = xhr.responseText;
            if (response === 'login_success') {
                // Login successful, redirect to admin dashboard
                window.location.href = 'admin/admin-dshbrd.php';
            } else {
                alert('Invalid OTP');
            }
        }
    };
});
</script>

  <!--Script Bootstrap-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <!--Connects to delete.php-->  
  <script>
  const deleteBtns = document.querySelectorAll("[data-bs-toggle='modal'][data-bs-target='#delete-modal']");
  deleteBtns.forEach(function(btn) {
    btn.addEventListener("click", function() {
      const studentnum = btn.getAttribute("data-studentnum");
      document.getElementById("delete-btn").addEventListener("click", function() {
        location.href = "delete.php?studentnum=" + studentnum;
      });
    });
  });

</script>
    <script type="text/javascript">
      document.getElementById("logoutbtn").onclick = function () {
      location.href = "../admin.php";
      };
</script>

</body>

</html>