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
  <link rel="stylesheet" type="text/css" href="about.css">
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
              <a class="nav-link mx-lg-2 active" aria-current="page" href="about.php">About</a>
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

  <!--Script Bootstrap-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

    <script type="text/javascript">
      document.getElementById("logoutbtn").onclick = function () {
      location.href = "index.php";
      };
      </script>

<!-- About Us Page -->

<div class="container">
  <div class="row">
    <div class="col-md-6" style="margin-bottom: 20px;">
      <img src="media/image/values-image-2.jpg" alt="Hero Image" class="img-fluid float-left">
    </div>
    <div class="col-md-6" style="margin-bottom: 20px;">
      <h1 class="text-right" style="font-weight:700;">About BeyondBooks <span><img src="media/image/dig-book-black.png" alt="beyondbooks logo" style="height:60px; width: 60px;"></span></h1>
      <p style="font-size: 18px; font-weight: 400;">"Open a world of knowledge beyond the books." <i>-BeyondBooks</i></p>
      <br>
      <p class="lead text-right">A learning platform where students can share and learn knowledge beyond the boundaries of traditional classrooms.</p>
    </div>
  </div>
  <div class="row">
  <hr>
    <div class="col-md-6 float-right" style="margin-bottom: 20px;">
     <p>BeyondBooks is an innovative online platform designed to facilitate collaborative learning and knowledge sharing among students. Our mission is to provide a dynamic and interactive environment where students can come together to learn, share, and grow. With BeyondBooks, students can access a vast repository of educational resources, connect with peers, and engage in meaningful discussions that foster intellectual growth and development.</p>
    </div>
    <div class="col-md-6" style="margin-bottom: 20px;">
      <img src="media/image/values-image.jpg" alt="Values Image" class="img-fluid float-right" id="img2">
    </div>
  </div>

  <!--Footer-->
  <footer class="footer" style="margin-top: 100px;">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="footer-logo">
          <img src="media/image/dig-book.png" alt="BeyondBooks Logo" style="width: 60px; height: 60px; padding: 5px">
          <span>BeyondBooks</span>
        </div>
        <div class="footer-email">
          Message us here: <a href="mailto:beyond.books.learn@gmail.com">beyond.books.learn@gmail.com</a>
        </div>
      </div>
    </div>
  </div>
</footer>
  <!-- Team Section -->
  <div class="row" style="margin-top: 100px;">
  <hr>
    <div class="col-md-12">
      <h2 class="text-center" style="font-weight:700;">The People Behind BeyondBooks</h2>
      <ul class="list-unstyled text-center">
        <li>
          <i class="fas fa-user"></i>
          <strong>Jomer Lunar - </strong>
          <a href="mailto: jomerlunar999@gmail.com"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#712F31" class="bi bi-envelope-at-fill" viewBox="0 0 16 16">
  <path d="M2 2A2 2 0 0 0 .05 3.555L8 8.414l7.95-4.859A2 2 0 0 0 14 2zm-2 9.8V4.698l5.803 3.546zm6.761-2.97-6.57 4.026A2 2 0 0 0 2 14h6.256A4.5 4.5 0 0 1 8 12.5a4.49 4.49 0 0 1 1.606-3.446l-.367-.225L8 9.586zM16 9.671V4.697l-5.803 3.546.338.208A4.5 4.5 0 0 1 12.5 8c1.414 0 2.675.652 3.5 1.671"/>
  <path d="M15.834 12.244c0 1.168-.577 2.025-1.587 2.025-.503 0-1.002-.228-1.12-.648h-.043c-.118.416-.543.643-1.015.643-.77 0-1.259-.542-1.259-1.434v-.529c0-.844.481-1.4 1.26-1.4.585 0 .87.333.953.63h.03v-.568h.905v2.19c0 .272.18.42.411.42.315 0 .639-.415.639-1.39v-.118c0-1.277-.95-2.326-2.484-2.326h-.04c-1.582 0-2.64 1.067-2.64 2.724v.157c0 1.867 1.237 2.654 2.57 2.654h.045c.507 0 .935-.07 1.18-.18v.731c-.219.1-.643.175-1.237.175h-.044C10.438 16 9 14.82 9 12.646v-.214C9 10.36 10.421 9 12.485 9h.035c2.12 0 3.314 1.43 3.314 3.034zm-4.04.21v.227c0 .586.227.8.581.8.31 0 .564-.17.564-.743v-.367c0-.516-.275-.708-.572-.708-.346 0-.573.245-.573.791"/>
</svg></a>
        </li>
        <li>
          <i class="fas fa-user"></i>
          <strong>Guess Jean De Leon - </strong>
          <a href="mailto: guessdeleon22@gmail.com"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#712F31" class="bi bi-envelope-at-fill" viewBox="0 0 16 16">
  <path d="M2 2A2 2 0 0 0 .05 3.555L8 8.414l7.95-4.859A2 2 0 0 0 14 2zm-2 9.8V4.698l5.803 3.546zm6.761-2.97-6.57 4.026A2 2 0 0 0 2 14h6.256A4.5 4.5 0 0 1 8 12.5a4.49 4.49 0 0 1 1.606-3.446l-.367-.225L8 9.586zM16 9.671V4.697l-5.803 3.546.338.208A4.5 4.5 0 0 1 12.5 8c1.414 0 2.675.652 3.5 1.671"/>
  <path d="M15.834 12.244c0 1.168-.577 2.025-1.587 2.025-.503 0-1.002-.228-1.12-.648h-.043c-.118.416-.543.643-1.015.643-.77 0-1.259-.542-1.259-1.434v-.529c0-.844.481-1.4 1.26-1.4.585 0 .87.333.953.63h.03v-.568h.905v2.19c0 .272.18.42.411.42.315 0 .639-.415.639-1.39v-.118c0-1.277-.95-2.326-2.484-2.326h-.04c-1.582 0-2.64 1.067-2.64 2.724v.157c0 1.867 1.237 2.654 2.57 2.654h.045c.507 0 .935-.07 1.18-.18v.731c-.219.1-.643.175-1.237.175h-.044C10.438 16 9 14.82 9 12.646v-.214C9 10.36 10.421 9 12.485 9h.035c2.12 0 3.314 1.43 3.314 3.034zm-4.04.21v.227c0 .586.227.8.581.8.31 0 .564-.17.564-.743v-.367c0-.516-.275-.708-.572-.708-.346 0-.573.245-.573.791"/>
</svg></a>
        </li>
        <li>
          <i class="fas fa-user"></i>
          <strong>Rosiel Goza - </strong>
          <a href="mailto: chechegoza0802@gmail.com"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#712F31" class="bi bi-envelope-at-fill" viewBox="0 0 16 16">
  <path d="M2 2A2 2 0 0 0 .05 3.555L8 8.414l7.95-4.859A2 2 0 0 0 14 2zm-2 9.8V4.698l5.803 3.546zm6.761-2.97-6.57 4.026A2 2 0 0 0 2 14h6.256A4.5 4.5 0 0 1 8 12.5a4.49 4.49 0 0 1 1.606-3.446l-.367-.225L8 9.586zM16 9.671V4.697l-5.803 3.546.338.208A4.5 4.5 0 0 1 12.5 8c1.414 0 2.675.652 3.5 1.671"/>
  <path d="M15.834 12.244c0 1.168-.577 2.025-1.587 2.025-.503 0-1.002-.228-1.12-.648h-.043c-.118.416-.543.643-1.015.643-.77 0-1.259-.542-1.259-1.434v-.529c0-.844.481-1.4 1.26-1.4.585 0 .87.333.953.63h.03v-.568h.905v2.19c0 .272.18.42.411.42.315 0 .639-.415.639-1.39v-.118c0-1.277-.95-2.326-2.484-2.326h-.04c-1.582 0-2.64 1.067-2.64 2.724v.157c0 1.867 1.237 2.654 2.57 2.654h.045c.507 0 .935-.07 1.18-.18v.731c-.219.1-.643.175-1.237.175h-.044C10.438 16 9 14.82 9 12.646v-.214C9 10.36 10.421 9 12.485 9h.035c2.12 0 3.314 1.43 3.314 3.034zm-4.04.21v.227c0 .586.227.8.581.8.31 0 .564-.17.564-.743v-.367c0-.516-.275-.708-.572-.708-.346 0-.573.245-.573.791"/>
</svg></a>
        </li>
        <li>
          <i class="fas fa-user"></i>
          <strong>Kenneth Litada - </strong>
          <a href="mailto: kennethlitada@gmail.com"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#712F31" class="bi bi-envelope-at-fill" viewBox="0 0 16 16">
  <path d="M2 2A2 2 0 0 0 .05 3.555L8 8.414l7.95-4.859A2 2 0 0 0 14 2zm-2 9.8V4.698l5.803 3.546zm6.761-2.97-6.57 4.026A2 2 0 0 0 2 14h6.256A4.5 4.5 0 0 1 8 12.5a4.49 4.49 0 0 1 1.606-3.446l-.367-.225L8 9.586zM16 9.671V4.697l-5.803 3.546.338.208A4.5 4.5 0 0 1 12.5 8c1.414 0 2.675.652 3.5 1.671"/>
  <path d="M15.834 12.244c0 1.168-.577 2.025-1.587 2.025-.503 0-1.002-.228-1.12-.648h-.043c-.118.416-.543.643-1.015.643-.77 0-1.259-.542-1.259-1.434v-.529c0-.844.481-1.4 1.26-1.4.585 0 .87.333.953.63h.03v-.568h.905v2.19c0 .272.18.42.411.42.315 0 .639-.415.639-1.39v-.118c0-1.277-.95-2.326-2.484-2.326h-.04c-1.582 0-2.64 1.067-2.64 2.724v.157c0 1.867 1.237 2.654 2.57 2.654h.045c.507 0 .935-.07 1.18-.18v.731c-.219.1-.643.175-1.237.175h-.044C10.438 16 9 14.82 9 12.646v-.214C9 10.36 10.421 9 12.485 9h.035c2.12 0 3.314 1.43 3.314 3.034zm-4.04.21v.227c0 .586.227.8.581.8.31 0 .564-.17.564-.743v-.367c0-.516-.275-.708-.572-.708-.346 0-.573.245-.573.791"/>
</svg></a>
        </li>
        <li>
          <i class="fas fa-user"></i>
          <strong>Kiana Eslita - </strong>
          <a href="mailto: arabelakiana@gmail.com"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#712F31" class="bi bi-envelope-at-fill" viewBox="0 0 16 16">
  <path d="M2 2A2 2 0 0 0 .05 3.555L8 8.414l7.95-4.859A2 2 0 0 0 14 2zm-2 9.8V4.698l5.803 3.546zm6.761-2.97-6.57 4.026A2 2 0 0 0 2 14h6.256A4.5 4.5 0 0 1 8 12.5a4.49 4.49 0 0 1 1.606-3.446l-.367-.225L8 9.586zM16 9.671V4.697l-5.803 3.546.338.208A4.5 4.5 0 0 1 12.5 8c1.414 0 2.675.652 3.5 1.671"/>
  <path d="M15.834 12.244c0 1.168-.577 2.025-1.587 2.025-.503 0-1.002-.228-1.12-.648h-.043c-.118.416-.543.643-1.015.643-.77 0-1.259-.542-1.259-1.434v-.529c0-.844.481-1.4 1.26-1.4.585 0 .87.333.953.63h.03v-.568h.905v2.19c0 .272.18.42.411.42.315 0 .639-.415.639-1.39v-.118c0-1.277-.95-2.326-2.484-2.326h-.04c-1.582 0-2.64 1.067-2.64 2.724v.157c0 1.867 1.237 2.654 2.57 2.654h.045c.507 0 .935-.07 1.18-.18v.731c-.219.1-.643.175-1.237.175h-.044C10.438 16 9 14.82 9 12.646v-.214C9 10.36 10.421 9 12.485 9h.035c2.12 0 3.314 1.43 3.314 3.034zm-4.04.21v.227c0 .586.227.8.581.8.31 0 .564-.17.564-.743v-.367c0-.516-.275-.708-.572-.708-.346 0-.573.245-.573.791"/>
</svg></a>
        </li>
      </ul>
    </div>
  </div>
  <!-- Values Section -->
  <div class="row" style="margin-top: 100px;">
  <hr>
    <div class="col-md-12">
      <h2 class="text-center">Our Values</h2>
      <ul class="list-unstyled text-center">
        <li>
          <i class="fas fa-check"></i>
          <strong>Collaboration:</strong> We believe that learning is a collaborative process, and we strive to create an environment where students can work together to achieve their goals.
        </li>
        <br>
        <li>
          <i class="fas fa-check"></i>
          <strong>Innovation:</strong> We are committed to exploring new and innovative ways to facilitate learning and knowledge sharing, and we are always looking for ways to improve our platform.
        </li>
        <br>
        <li>
          <i class="fas fa-check"></i>
          <strong>Empowerment:</strong> We believe that every student has the potential to succeed, and we strive to provide the resources and support they need to achieve their goals.
        </li>
        <br>
      </ul>
    </div>
  </div>
</div>


</body>

</html>