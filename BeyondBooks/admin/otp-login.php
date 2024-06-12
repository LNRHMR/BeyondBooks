<?php
session_start();

// Verify OTP and grant access if valid
if (isset($_POST['otp'])) {
    $otpInputValue = $_POST['otp'];
    $storedOtp = $_SESSION['otpGenerated'];
    if ($otpInputValue === $storedOtp) {
        // Verify the OTP and grant access if valid
        $_SESSION['adminLoggedIn'] = true;
        // Redirect to admin dashboard
        header('Location: admin/admin-dshbrd.php');
        exit;
    } else {
        echo 'Invalid OTP';
    }
}

function generateOtp() {
    return rand(100000, 999999); // Generate a new OTP
}