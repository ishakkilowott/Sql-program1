<?php

session_start();

// Check if the form is submitted
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

    // Get username and password from the form
    $enteredUsername = $_POST['username'];
    $enteredPassword = $_POST['password'];
    $_SESSION['username'] = $enteredUsername;


    // Query the database to check if the username exists
    $sql = "SELECT * FROM users WHERE Username = '$enteredUsername'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Username exists, fetch the user data
        $row = $result->fetch_assoc();
        $storedPasswordHash = $row['Password'];

        // Verify the entered password against the stored hashed password
        if (password_verify($enteredPassword, $storedPasswordHash)) {
            // Password is correct, redirect to UserPanel.php
            header("Location: UserPanel.php");
            exit();
        } else {
            // Password is incorrect, show an error message
            echo "Incorrect password. Please try again.";
        }
    } else {
        // Username doesn't exist, show an error message
        echo "Username not found. Please register or try again.";
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

    <title>Sign In</title>

    <link rel="stylesheet" type="text/css" href="style.css">

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

<div class="container mt-5">
    <center>       <h2  class="btn-primary">Sign in</h2>  </center>
    <form method="POST" action=""> <!-- Removed the form action attribute to submit to the same page -->
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
        </div>
        <button type="submit" class="btn btn-primary">Sign In</button>
    </form>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>
</html>
