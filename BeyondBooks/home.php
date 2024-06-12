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
// Create a new connection to the database
$conn = mysqli_connect("sql302.infinityfree.com", "if0_36713719", "O0L1QO1yuEsd", "if0_36713719_db_beyond_books");

// Check connection
if (!$conn) {
    die("Connection failed: ". mysqli_connect_error());
}

// Retrieve the user's data
$query = "SELECT studentnum, lastname, email FROM `registered-user` WHERE studentnum =?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "s", $studentnum);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
mysqli_stmt_bind_result($stmt, $db_studentnum, $db_lastname, $db_email);
mysqli_stmt_fetch($stmt);
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
  <link rel="stylesheet" type="text/css" href="home.css">
  <title>BeyondBooks</title>
</head>

<body style>
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
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="file-upl.php">Share your works</a>
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

<!--Dashboard - Grid-->
<div class="container">
  <div class="row mt-5" style="margin-bottom: 20px;">
    <div class="col-md-6">
      <h3>Welcome, Student Number: <?php echo $studentnum;?></h3>
    </div>
    <div class="col-md-6">
      <div class="input-group">
        <input type="search" id="search-input" class="form-control search-input" placeholder="Search files...">
        <button id="search-btn" class="btn btn-primary search-btn">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
          </svg>
        </button>
      </div>
    </div>
  </div>
    <div id="card-container" class="row gy-5">
      <?php
      // Prepare a SQL query to retrieve rows from approved table where studentnum matches the logged-in user's studentnum
      $stmt = $conn->prepare("SELECT * FROM approved ORDER BY date DESC");
      $stmt->execute();
      $result = $stmt->get_result();

      while($row = $result->fetch_assoc()) {
        $studentnum = $row['studentnum'];
        $lastname = $row['lastname'];
        $date = $row['date'];
        $fileName = $row['filename'];
        $newFileName = preg_replace('/\d{2}-\d{5}_\d{10}_/', '', $fileName);
        $folderlocation = $row['folderlocation'];
        $fileurl = '../'. $folderlocation. '/'. $fileName; 

        $thumbnail = '';
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        switch ($fileExtension) {
          case 'pdf':
            $thumbnail = 'thumbnail/pdf.png';
            break;
          case 'doc':
          case 'docx':
            $thumbnail = 'thumbnail/documents.png';
            break;
          case 'xls':
          case 'xlsx':
            $thumbnail = 'thumbnail/spreadsheets.png';
            break;
          case 'jpg':
          case 'jpeg':
          case 'png':
            $thumbnail = 'thumbnail/images.png';
            break;
          default:
            $thumbnail = 'thumbnail/default.png';
        }

        echo '<div class="col-md-6 gy-5">';
        echo '<div class="card">';
        echo '<div class="card-body" id="card-container">';
        echo "<h5 class='card-title'>{$studentnum} - {$lastname}</h5>";
        echo "<p class='card-text' style='font-size:12px;'>{$date}</p>";
        echo "<p class='card-text'><img src='{$thumbnail}' width='100' height='100'></p>";
        echo "<p class='card-text'>File name: <span style='font-weight:700;'>{$newFileName}</span></p>";
        echo '<a href="user-file-preview.php?url='. urlencode($fileurl = str_replace('../', '', $fileurl)).'" target="iframe" class="btn btn-primary">View File</a>';
        if (isset($_SESSION['studentnum']) && $_SESSION['studentnum'] == $row['studentnum']) {
          echo '<button class=\'btn btn-danger float-end\' onclick=\'confirmDelete("'.$row['date'].'", "'.$row['studentnum'].'", "'.$row['lastname'].'", "'.$row['email'].'", "'.$row['filename'].'", "'.$row['folderlocation'].'")\'>
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
          </svg></button>';
        }
        echo '</div>';
      echo '</div>';
      echo '</div>';
    }
 ?>
  </div>
</div>


<script>
  const searchInput = document.getElementById('search-input');
  const searchBtn = document.getElementById('search-btn');
  const cardContainer = document.getElementById('card-container');

  // Add event listener to search button
  searchBtn.addEventListener('click', searchCards);

  // Add event listener to search input field
  searchInput.addEventListener('keydown', (e) => {
    if (e.key === 'Enter') {
      searchCards();
    }
  });

  function searchCards() {
    const searchTerm = searchInput.value.toLowerCase();
    const cards = cardContainer.children;

    for (let i = 0; i < cards.length; i++) {
      const card = cards[i];
      const studentNum = card.querySelector('.card-title').textContent.toLowerCase();
      const lastName = card.querySelector('.card-text:nth-child(2)').textContent.toLowerCase();
      const fileName = card.querySelector('.card-text:nth-child(4)').textContent.toLowerCase();

      if (studentNum.includes(searchTerm) || lastName.includes(searchTerm) || fileName.includes(searchTerm)) {
        card.style.display = 'block';
      } else {
        card.style.display = 'none';
        
      }
    }
  }
</script>

  <!--Connect to file-delete.php-->
<script type="text/javascript">
function confirmDelete(date, studentnum, lastname, email, filename, folderlocation) {
  if (confirm("Are you sure you want to delete this file?")) {
    deleteFile(date, studentnum, lastname, email, filename, folderlocation);
  }
}

function deleteFile(date, studentnum, lastname, email, filename, folderlocation) {
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'file-delete.php?date=' + date + '&studentnum=' + studentnum + '&lastname=' + lastname + '&email=' + email + '&filename=' + filename + '&folderlocation=' + folderlocation, true);
  xhr.send();
  
  // Set a timeout to wait for the page to reload
  setTimeout(function() {
    location.href = '/BeyondBooks/home.php?' + new Date().getTime();
  }, 200); // reload speed 100=0.1s
}
</script>


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

  <!--Script Bootstrap-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

    <script type="text/javascript">
      document.getElementById("logoutbtn").onclick = function () {
      location.href = "index.php";
      };
      </script>
</body>

</html>