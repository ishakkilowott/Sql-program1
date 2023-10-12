<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
          crossorigin="anonymous">

    <title>Home</title>

    <style>

body {
    background-image: url('Images/back.jpg');
    background-size: cover;
    background-repeat: no-repeat;
}

        
        .content {
           color:white;
            padding: 20px;
            margin-top:10%;
        }

        .sql-image {
            max-width: 100%;
            margin-top:10%;
            border-radius: 10px;
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
                    <a class="nav-link" href="about-us.php" style="color: white; margin-left: 25px;">About us</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="login.php" style="color: white; margin-left: 25px;">Sign in</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register.php" style="color: white; margin-left: 25px;">Sign up</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact-us.php" style="color: white; margin-left: 25px; margin-right:20px;">Contact us</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<div class="container mt-3">
    <div class="row">
        <div class="col-md-6">
            <div class="content">
                <h2>About SQL</h2>
                <p>
                    SQL (Structured Query Language) is a domain-specific language used in programming and managing
                    relational databases. It allows users to interact with and manipulate databases. SQL is used to
                    create, retrieve, update, and delete data in a database.
                </p>
                <p>
                    SQL is essential for data-driven applications and is widely used in web development, data analysis,
                    and many other fields. It provides powerful and flexible tools for working with structured data.
                </p>
            </div>
        </div>
        <div class="col-md-6">
            <img src="Images/sql.jpg" alt="SQL Image" class="sql-image">
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>
</html>
