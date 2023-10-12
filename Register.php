<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to your MySQL database
    $servername = "localhost"; // Change this to your database server name
    $username = "root"; // Change this to your database username
    $password = ""; // Change this to your database password
    $database = "registration_database"; // Change this to your database name

    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $Name = $_POST['Name'];
    $Username = $_POST['Username'];
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];
    $Mobile = $_POST['Mobile'];

    $hashed_password = password_hash($Password, PASSWORD_DEFAULT);
    

    // Check if the username already exists
    $checkUsernameQuery = "SELECT * FROM users WHERE Username = '$Username'";
    $resultUsername = $conn->query($checkUsernameQuery);

    
    // Check if the mobile number already exists
    $checkMobileQuery = "SELECT * FROM users WHERE Mobile = '$Mobile'";
    $resultMobile = $conn->query($checkMobileQuery);

    if ($resultUsername->num_rows > 0) {
        echo '<p style="color: white;">Error: Username already exists. Please choose a different username.</p>';
    
    } elseif ($resultMobile->num_rows > 0) {
        echo '<p style="color: white;">Error: Mobile number already exists. Please use a different mobile number.</p>';
    } else {
        // Insert data into the database
        $sql = "INSERT INTO users (Name, Username, Email, Password, Mobile, email_varified) VALUES ('$Name', '$Username', '$Email', '$hashed_password','$Mobile','Yes')";

        if ($conn->query($sql) === TRUE) {
            
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Close the database connection
    $conn->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Registration</title>
 
    <link rel="stylesheet" type="text/css" href="style.css">

    <script>
        // Function to validate Name (only letters)
        function validateName() {
            const nameInput = document.getElementById('Name');
            const nameValue = nameInput.value.trim();
            const nameRegex = /^[A-Za-z]+$/;
            const nameError = document.getElementById('nameError');

            if (!nameRegex.test(nameValue)) {
                nameError.textContent = 'Name must contain only letters.';
                nameInput.classList.add('is-invalid');
                nameInput.classList.remove('is-valid');
                return false;
            } else {
                nameError.textContent = '';
                nameInput.classList.remove('is-invalid');
                nameInput.classList.add('is-valid');
                return true;
            }
        }

        // Function to validate Mobile (10 digits)
        function validateMobile() {
            const mobileInput = document.getElementById('Mobile');
            const mobileValue = mobileInput.value.trim();
            const mobileRegex = /^\d{10}$/;
            const mobileError = document.getElementById('mobileError');

            if (!mobileRegex.test(mobileValue)) {
                mobileError.textContent = 'Mobile number must be a 10-digit number.';
                mobileInput.classList.add('is-invalid');
                mobileInput.classList.remove('is-valid');
                return false;
            } else {
                mobileError.textContent = '';
                mobileInput.classList.remove('is-invalid');
                mobileInput.classList.add('is-valid');
                return true;
            }
        }

        // Function to validate Email (basic format)
        function validateEmail() {
            const emailInput = document.getElementById('Email');
            const emailValue = emailInput.value.trim();
            const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            const emailError = document.getElementById('emailError');

            if (!emailRegex.test(emailValue)) {
                emailError.textContent = 'Enter a valid email address.';
                emailInput.classList.add('is-invalid');
                emailInput.classList.remove('is-valid');
                return false;
            } else {
                emailError.textContent = '';
                emailInput.classList.remove('is-invalid');
                emailInput.classList.add('is-valid');
                return true;
            }
        }

        // Function to validate Password (at least 8 characters)
        function validatePassword() {
            const passwordInput = document.getElementById('Password');
            const passwordValue = passwordInput.value.trim();
            const passwordError = document.getElementById('passwordError');

            if (passwordValue.length < 8) {
                passwordError.textContent = 'Password must be at least 8 characters long.';
                passwordInput.classList.add('is-invalid');
                passwordInput.classList.remove('is-valid');
                return false;
            } else {
                passwordError.textContent = '';
                passwordInput.classList.remove('is-invalid');
                passwordInput.classList.add('is-valid');
                return true;
            }
        }

        // Function to validate the entire form
        function validateForm() {
            return (
                validateName() &&
                validateMobile() &&
                validateEmail() &&
                validatePassword()
                // Add more validation functions as needed
            );
        }

        
    </script>

<style> 

.error-message {
    color: red;
}
 </style>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php" style="color: white; margin-left:10px;">First website</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
           
            <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                    <a class="nav-link" href="index.php" style="color: white; margin-right: 2 5px;">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about-us.php" style="color: white; margin-left: 25px;">About Us</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="login.php" style="color: white; margin-left: 25px;">Sign In</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register.php" style="color: white; margin-left: 25px;">Sign Up</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact-us.php" style="color: white; margin-left: 25px; margin-right:20px;">Contact Us</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5" class="cont">
<center>       <h2  class="btn-primary">Registration</h2>  </center>
    <form action="register.php" method="post" onsubmit="return validateForm()">
        <div class="mb-3">
            <label for="Name" class="form-label">Name</label>
            <input type="text" class="form-control" id="Name" name="Name" placeholder="Enter your name" required
                   oninput="validateName()">
            <div id="nameError" class="error-message"></div>
        </div>
        <div class="mb-3">
            <label for="Username" class="form-label">Username</label>
            <input type="text" class="form-control" id="Username" name="Username" placeholder="Choose a username" required>
        </div>
        <div class="mb-3">
            <label for="Email" class="form-label">Email</label>
            <input type="email" class="form-control" id="Email" name="Email" placeholder="Enter your email" required
                   oninput="validateEmail()">
            <div id="emailError" class="error-message"></div>
        </div>
        <div class="mb-3">
            <label for="Password" class="form-label">Password</label>
            <input type="password" class="form-control" id="Password" name="Password" placeholder="Enter your password" required
                   oninput="validatePassword()">
            <div id="passwordError" class="error-message"></div>
        </div>
        <div class="mb-3">
            <label for="Mobile" class="form-label">Mobile</label>
            <input type="tel" class="form-control" id="Mobile" name="Mobile" placeholder="Enter your mobile number" required
                   oninput="validateMobile()">
            <div id="mobileError" class="error-message"></div>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>
</html>
