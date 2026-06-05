<?php
session_start();
include("../includes/db.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "admin") {
    header("Location: ../login.php");
    exit();
}

$orders = mysqli_query($conn, "
    SELECT orders.*, users.fullname, users.email
    FROM orders
    JOIN users ON orders.user_id = users.id
    ORDER BY orders.created_at DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Orders | KasiKart</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

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

<body>

<div class="dashboard">

    <h1>Manage Orders</h1>

    <table class="user-table">
        <tr>
            <th>Order ID</th>
            <th>Buyer</th>
            <th>Email</th>
            <th>Total</th>
            <th>Date</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($orders)) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['fullname']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td>R<?php echo number_format($row['total'], 2); ?></td>
                <td><?php echo $row['created_at']; ?></td>
            </tr>
        <?php } ?>

    </table>

    <div class="dashboard-links">
        <a href="dashboard.php">Back to Dashboard</a>
        <a href="../logout.php">Logout</a>
    </div>

</div>

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