<?php
session_start();
// include ('login.php')
?>

<!DOCTYPE html>
<html>

<head>
     <title>Event Management System</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-CuOF+2SnTUfTwSZjCXf01h7uYhfOBuxIhGKPbfEJ3+FqH/s6cIFN9bGr1HmAg4fQ" crossorigin="anonymous">
     <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
     <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
</head>

<body>
     <h1 align="center">Event Management System</h1>
     <nav class="navbar navbar-expand-lg navbar-light bg-light ">
          <div class="container-fluid">
               <a class="navbar-brand" href="#">Hello, <?php echo $_SESSION['name']; ?> !</a>
               <a class="navbar-brand active" aria-current="page" href="home.php">Home</a>

               <?php if ($_SESSION['usertype'] == 'ADMIN') { ?>
                    <div class="nav-item dropdown">
                         <a class="navbar-brand dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              Admin Management
                         </a>
                         <ul class="dropdown-menu" aria-labelledby="adminDropdown">
                              <li><a class="dropdown-item" href="user_manage.php">User Activity Status</a></li>
                              <li><a class="dropdown-item" href="event.php">Event Activity Status</a></li>
                              <li><a class="dropdown-item" href="attendee_registration.php">Attendee Registration</a></li>
                         </ul>
                    </div>
               <?php } ?>
               <a class="navbar-brand" href="attendee_registration.php">Attendee Registration</a>
               <a class="navbar-brand" href="logout.php">Logout</a>
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
               </button>
          </div>
     </nav>
     <div class="container">