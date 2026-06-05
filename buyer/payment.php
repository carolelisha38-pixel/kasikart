<?php
session_start();
include("../includes/db.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "buyer") {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$result = mysqli_query($conn, "
    SELECT products.price
    FROM cart
    JOIN products ON cart.product_id = products.id
    WHERE cart.user_id = $user_id
");

$total = 0;

while ($row = mysqli_fetch_assoc($result)) {
    $total += $row['price'];
}

$delivery_fee = 60;
$grand_total = $total + $delivery_fee;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment</title>
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
        <a href="buyer/cart.php" title="Cart" class="cart-icon"> 
            <i class="fa-solid fa-cart-shopping"></i>

            <?php if ($cart_count > 0) { ?>
        <span class="cart-count"><?php echo $cart_count; ?></span>
    <?php } ?>
        </a>
</nav>
</header>

<div id="sidebar" class="sidebar">
    <button class="close-btn" onclick="closeSidebar()">×</button>

    <a href="index.php">Home</a>
    <a href="about.php">About</a>
    <a href="contact.php">Contact</a>
</div>
<br><br>

    <h1>Payment Page</h1> <br><br.

    <p>Total Amount: <strong>R<?php echo number_format($grand_total, 2); ?></strong></p> <br><br>

    <form action="process-payment.php" method="POST">

    <select name="payment_method" required>
        <option value="">Choose Payment Method</option>
        <option value="card">Bank Card</option>
        <option value="paypal">PayPal</option>
        <option value="payshap">PayShap</option>
    </select>

    <input type="text" name="card_number" placeholder="Card Number - 16 digits"
           maxlength="16" pattern="\d{16}" required>

    <input type="text" name="expiry" placeholder="MM/YY"
           maxlength="5" pattern="(0[1-9]|1[0-2])\/\d{2}" required>

    <input type="text" name="cvv" placeholder="CVV - 3 digits"
           maxlength="3" pattern="\d{3}" required> <br><br>

    <button type="submit">Pay Now</button>

</form>

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