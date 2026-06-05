<?php
session_start();
include("../includes/db.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "buyer") {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$result = mysqli_query($conn, "SELECT * FROM users WHERE id = $user_id");
$user = mysqli_fetch_assoc($result);

$orders = mysqli_query($conn, "
    SELECT * FROM orders 
    WHERE user_id = $user_id 
    ORDER BY created_at DESC
");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Profile | KasiKart</title>
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

    <h1>My Profile</h1>

    <div class="dashboard-card">
        <h3><?php echo $user['fullname']; ?></h3>
        <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
        <p><strong>Account Type:</strong> <?php echo ucfirst($user['role']); ?></p>
        <p><strong>Joined:</strong> <?php echo $user['created_at']; ?></p>
    </div> <br><br>

<h2 style="margin-top:40px;"> My Order History</h2>

<?php if(mysqli_num_rows($orders) == 0){ ?>

    <p>You have not placed any orders yet.</p>

<?php } else { ?>

<table class="user-table">
    <tr>
        <th>Order ID</th>
        <th>Total</th>
        <th>Date</th>
    </tr>

    <?php while($order = mysqli_fetch_assoc($orders)){ ?>
    <tr>
        <td><?php echo $order['id']; ?></td>
        <td>R<?php echo number_format($order['total'], 2); ?></td>
        <td><?php echo $order['created_at']; ?></td>
    </tr>
    <?php } ?>

</table>

<?php } ?>

<div class="dashboard-links">
    <a href="edit-profile.php">Edit Profile</a>
    <a href="dashboard.php">Back to Dashboard</a>
    <a href="../logout.php">Logout</a>
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