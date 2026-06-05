<?php
session_start();
include("../includes/db.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "buyer") {
    header("Location: ../login.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM products ORDER BY created_at DESC");

$cart_count = 0;

if (isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role'] == "buyer") {
    $buyer_id = $_SESSION['user_id'];
    $cart_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM cart WHERE user_id = $buyer_id");
    $cart_data = mysqli_fetch_assoc($cart_result);
    $cart_count = $cart_data['total'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Buyer Dashboard | KasiKart</title>
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

    <nav class="shop-icons">
        <a href="../buyer/cart.php" title="Cart" class="cart-icon">
            <i class="fa-solid fa-cart-shopping"></i>

            <?php if ($cart_count > 0) { ?>
        <span class="cart-count"><?php echo $cart_count; ?></span>
    <?php } ?>

        </a>
    </nav>
</header>

<div id="sidebar" class="sidebar">
    <button class="close-btn" onclick="closeSidebar()">×</button>

    <a href="../index.php">Home</a>
    <a href="../about.php">About</a>
    <a href="../contact.php">Contact</a>
</div>


    

<div class="dashboard">

    <h1>Buyer Dashboard</h1>

    <p>Welcome, <?php echo $_SESSION['fullname']; ?></p>

    <div class="dashboard-links">
        <a href="../products.php">Browse Products</a>
        <a href="profile.php">My Profile</a>
        <a href="../logout.php">Logout</a>
    </div>

    <h2 style="margin-top: 40px;">Available Products</h2>

    <div class="product-container">

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>

            <div class="product-card">

            <?php if ($row['image'] != "") { ?>
            <img src="../uploads/<?php echo $row['image']; ?>" alt="Product Image">
        <?php } ?>

                <h3><?php echo $row['name']; ?></h3>

                <p>R<?php echo $row['price']; ?></p>

                <p><?php echo $row['description']; ?></p>

                <a href="../product-details.php?id=<?php echo $row['id']; ?>">
                <button>View Product</button>
            </a>

            </div>

        <?php } ?>

    </div>

</div>
<p style="margin-top: 40px; color: #888; font-size: 14px;">
    KasiKart © 2026
</p>
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