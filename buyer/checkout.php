<?php
session_start();
include("../includes/db.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "buyer") {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$result = mysqli_query($conn, "
    SELECT cart.id AS cart_id, products.*
    FROM cart
    JOIN products ON cart.product_id = products.id
    WHERE cart.user_id = $user_id
");

$total = 0;
$items = [];

while ($row = mysqli_fetch_assoc($result)) {
    $items[] = $row;
    $total += $row['price'];
}

$delivery_fee = 60;
$grand_total = $total + $delivery_fee;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout | KasiKart</title>
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
        <a href="cart.php" title="Cart">
            <i class="fa-solid fa-cart-shopping"></i>
        </a>
    </nav>
</header>

<div id="sidebar" class="sidebar">
    <button class="close-btn" onclick="closeSidebar()">×</button>

    <a href="../index.php">Home</a>
    <a href="../about.php">About</a>
    <a href="../contact.php">Contact</a>
    <a href="../login.php">Admin Login</a>
</div>

<div class="dashboard">

    <h1>Checkout</h1>

    <?php if (count($items) == 0) { ?>

        <p>Your cart is empty.</p>

        <div class="dashboard-links">
            <a href="../products.php">Continue Shopping</a>
        </div>

    <?php } else { ?>

        <div class="checkout-layout">

            <div class="checkout-box">
                <h2>Order Items</h2>

                <?php foreach ($items as $item) { ?>
                    <div class="summary-item">
                        <span><?php echo $item['name']; ?></span>
                        <strong>R<?php echo number_format($item['price'], 2); ?></strong>
                    </div>
                <?php } ?>

                <div class="dashboard-links">
                    <a href="payment.php">Proceed to Payment</a>
                    <a href="cart.php">Back to Cart</a>
                </div>
            </div>

            <div class="checkout-box">
                <h2>Order Summary</h2>

                <div class="summary-item">
                    <span>Subtotal</span>
                    <strong>R<?php echo number_format($total, 2); ?></strong>
                </div>

                <div class="summary-item">
                    <span>Delivery Fee</span>
                    <strong>R<?php echo number_format($delivery_fee, 2); ?></strong>
                </div>

                <hr>

                <div class="summary-item total-row">
                    <span>Total</span>
                    <strong>R<?php echo number_format($grand_total, 2); ?></strong>
                </div>
            </div>

        </div>

    <?php } ?>

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