<?php
session_start(); // Resume the existing session

// Check if the user is logged in (session variable exists)
if (!isset($_SESSION['username'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit();
}

// You can access the username using $_SESSION['username'] on this page
$loggedInUsername = $_SESSION['username'];

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

// Initialize user details
$userDetails = [];

// Fetch all details based on user's selection
if (isset($_POST['detail'])) {
    $selectedDetail = $_POST['detail'];
    $sql = "SELECT $selectedDetail FROM users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $userDetails[] = $row[$selectedDetail];
        }
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!-- Custom CSS -->
    <style>

body {
    background-image: url('Images/back.jpg');
    background-size: cover;
    background-repeat: no-repeat;
}
        /* Add your custom CSS styles here */
        .user-details-box {
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 10px;
            margin: 20px auto; /* Center the box */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px; /* Limit the width of the box */
            color:white;
        }

        .user-details-box h3 {
            margin-top: 0; /* Remove default margin */
        }

        .user-details-box ul {
            list-style-type: none; /* Remove bullet points */
            padding-left: 0; /* Remove default padding */
        }

        .user-details-box ul li {
            margin-bottom: 10px; /* Add spacing between items */
        }

        /* Center align the submit button */
        .text-center {
            text-align: center;
        }

        h2{
            margin-top:5%;
            color:white;
        }
    </style>

    <title>User Panel</title>
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
                    <a class="nav-link" href="about-us.php" style="color: white; margin-left: 25px;">About us</a>
                </li>
                
                
                <li class="nav-item">
                    <a class="nav-link" href="contact-us.php" style="color: white; margin-left: 25px; margin-right:20px;">Contact us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php" style="color: white; margin-left: 25px;">Logout</a>
                </li>
                
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h2 class="text-center">Welcome, <?php echo $loggedInUsername; ?>!</h2>
    <div class="user-details-box">
        <h3 class="text-center">Select Detail:</h3>
        <form method="post" action="">
            <label for="detail">Select Detail:</label>
            <select name="detail" id="detail">
                <option value="Name">Name</option>
                <option value="Username">Username</option>
                <option value="Email">Email</option>
                <option value="Mobile">Mobile</option>
            </select>
            <br><br>
            <div class="text-center">
                <input type="submit" name="fetch" value="Fetch Detail" class="btn btn-primary">
            </div>
        </form>

        <?php
        // Display the selected user details
        if (!empty($userDetails)) {
            echo "<h3 class='text-center'>Selected Detail:</h3>";
            echo "<ul>";
            foreach ($userDetails as $detail) {
                echo "<li>$detail</li>";
            }
            echo "</ul>";
        }
        ?>
    </div>

    <!-- Add your additional content below -->
    <div class="additional-content">
        <!-- Your additional content goes here -->
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>
</html>
