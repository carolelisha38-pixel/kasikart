<?php
session_start();
include("../includes/db.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "seller") {
    header("Location: ../login.php");
    exit();
}

$seller_id = $_SESSION['user_id'];

$sales = mysqli_query($conn, "
    SELECT 
        products.name,
        products.price,
        order_items.quantity,
        orders.created_at
    FROM order_items
    JOIN products ON order_items.product_id = products.id
    JOIN orders ON order_items.order_id = orders.id
    WHERE products.user_id = $seller_id
    ORDER BY orders.created_at DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Sales | KasiKart</title>
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

<div id="sidebar" class="sidebar">
    <button class="close-btn" onclick="closeSidebar()">×</button>

    <a href="../index.php">Home</a>
    <a href="../about.php">About</a>
    <a href="../contact.php">Contact</a>
</div>


<div class="dashboard">

    <h1>My Sold Products</h1>

    <?php if (mysqli_num_rows($sales) == 0) { ?>

        <p>No products have been bought yet.</p>

    <?php } else { ?>

        <table class="user-table">
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Date Sold</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($sales)) { ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td>R<?php echo number_format($row['price'], 2); ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                </tr>
            <?php } ?>
        </table>

    <?php } ?>

    <div class="dashboard-links">
        <a href="dashboard.php">Back to Dashboard</a>
    </div>

</div>

</body>
</html>