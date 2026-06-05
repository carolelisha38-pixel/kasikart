<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Successful</title>
    <link rel="stylesheet" href="../style.css">
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

<div class="dashboard">

    <h1> Order Successful!</h1>

    <p>Your payment was processed successfully.</p>

    <div class="dashboard-links">
        <a href="../products.php">Continue Shopping</a>
        <a href="profile.php">View My Orders</a>
    </div>

</div>

</body>
</html>