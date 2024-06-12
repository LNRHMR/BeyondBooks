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
    <link rel="stylesheet" type="text/css" href="admin.css">
    <title>BeyondBooks │ Admin Login</title>
</head>

<body>
    <!--Navbar-->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">BeyondBooks <img src="media/image/dig-book.png"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">MENU</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2 active" aria-current="page"  href="#">Admin Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!--End Navbar-->

<!--Login Form-->
<div class="wrapper">
    <div class="container main">
        <div class="row">
            <div class="col-md-6 side-image">
                <!--Image Here-->
                <img src="media/image/dig-book-black.png" alt="BeyondBooks-Logo">
                <div class="text">
                    <p>Constantly evolving, expertly curated, for your best learning experience.</p>
                </div>
            </div>
            <div class="col-md-6 right">
                <div class="input-box">
                    <header>Admin Log In <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-person-lock" viewBox="0 0 16 16">
                        <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m0 5.996V14H3s-1 0-1-1 1-4 6-4q.845.002 1.544.107a4.5 4.5 0 0 0-.803.918A11 11 0 0 0 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664zM9 13a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1"/>
                      </svg></header>
                    <form action="https://api.web3forms.com/submit" method="POST">
                        <input class="input" type="hidden" name="access_key" value="abf6fd31-77e4-4a95-8cdf-70958d7b27db">
                        <div class="input-field">
                        <input class="input" type="email" name="email" value="beyond.books.learn@gmail.com" id="email" style="font-weight:700;" readonly>
                        </div>
                        <div class="input-field">
                        <input class="input" type="text" name="otp" id="otp" required>
                        <label for="otp">Enter OTP</label>
                        </div>                        
                        <div class="otp">
                        <a type="button" id="send-otp">Click this to send OTP to the email.</a>
                        </div>
                        <div class="input-field">
                        <button class="submit" id="submit-otp">Submit OTP</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- HTML code for the login form -->
<form id="login-form">
    <input type="text" id="otp" placeholder="Enter OTP">
    <button id="send-otp">Send OTP</button>
    <button id="submit-otp">Submit OTP</button>
</form>

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

    document.getElementById("send-otp").addEventListener("click", function() {
    alert("OTP sent successfully!");
  });

    document.addEventListener('submit', (e) => {
        e.preventDefault();
        const otpInputValue = otpInput.value.trim();
        if (otpInputValue === otpGenerated.toString()) {
            // Verify the OTP and grant access if valid
            console.log(`OTP submitted: ${otpInputValue}`);
            // Set a login session
            sessionStorage.setItem('adminLoggedIn', true);
            // Redirect to admin dashboard
            window.location.href = 'admin/admin-dshbrd.php';
        } else {
            alert('Invalid OTP');
        }
    });
</script>

    <!--End Login Form-->


    <!--Script Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>
</html>