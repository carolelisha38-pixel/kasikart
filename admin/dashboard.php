<?php

session_start();

include("../includes/db.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "admin") {
    header("Location: ../login.php");
    exit();
}

$total_users = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM users"))['total'];
$total_buyers = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM users WHERE role='buyer'"))['total'];
$total_sellers = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM users WHERE role='seller'"))['total'];
$total_admins = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM users WHERE role='admin'"))['total'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | KasiKart</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

<header class="shop-header">
    <button class="menu-btn" onclick="openSidebar()">
        <i class="fa-solid fa-bars"></i>
    </button>

    <div class="logo">
        <h1>KasiKart</h1>
    </div>
</header>

<div id="sidebar" class="sidebar">
    <button class="close-btn" onclick="closeSidebar()">×</button>

    <a href="../index.php">Home</a>
    <a href="../about.php">About</a>
    <a href="../contact.php">Contact</a>
</div>  
    

<div class="dashboard">

<h1> Admin Dashboard </h1>
<p> Welcome, <?php echo $_SESSION['fullname']; ?> </p> <br><br>

<div class="dashboard-cards">

<div class="dashboard-card">
    <h3> Total Users </h3>
    <p> <?php echo $total_users; ?> </p>
</div> <br>

<div class="dashboard-card">
    <h3> Buyers </h3> 
    <p> <?php echo $total_buyers; ?> </p>
</div> <br>

<div class="dashboard-card">
    <h3> Sellers </h3> 
    <p> <?php echo $total_sellers; ?> </p>
</div> <br>

<div class="dashboard-card">
    <h3> Admins </h3> 
    <p> <?php echo $total_admins; ?> </p>
</div> <br>


<div class="dashboard-links">
    <a href="manage-users.php"> Manage Users </a>
    <a href="manage-products.php"> Manage Products </a>
    <a href="manage-orders.php"> Manage Orders </a>
    <a href="../logout.php"> Logout </a>
    
</div>

</div>

<p style="margin-top: 40px; color:#888; font-size: 14px;"> KasiKart &copy; 2026 </p>
<script>
    function openSidebar(){
        document.getElementById("sidebar").classList.add("active");
    }

    function closeSidebar(){
        document.getElementById("sidebar").classList.remove("active");
    }
</script>
</body>
</html>