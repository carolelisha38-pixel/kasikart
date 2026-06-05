<?php
session_start();
include("../includes/db.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "buyer") {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_GET['remove'])) {
    $cart_id = $_GET['remove'];

    mysqli_query($conn, "DELETE FROM cart WHERE id=$cart_id AND user_id=$user_id");

    header("Location: cart.php");
    exit();
}

if (isset($_GET['clear'])) {

    mysqli_query($conn, "DELETE FROM cart WHERE user_id = $user_id");

    header("Location: cart.php");
    exit();
}

$result = mysqli_query($conn, "
    SELECT cart.id AS cart_id, products.*
    FROM cart
    JOIN products ON cart.product_id = products.id
    WHERE cart.user_id = $user_id
");

$total = 0;

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
    <title>My Cart | KasiKart</title>
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
        <a href="cart.php" title="Cart" class="cart-icon">
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

    <h1>My Cart</h1>

    <?php if (mysqli_num_rows($result) == 0) { ?>

        <p>Your cart is currently empty.</p>

        <div class="dashboard-links">
            <a href="../products.php">Continue Shopping</a>
        </div>

    <?php } else { ?>

        <div class="product-container">

            <?php while ($row = mysqli_fetch_assoc($result)) { 
                $total += $row['price'];
            ?>

                <div class="product-card">

                    <?php if ($row['image'] != "") { ?>
                        <img src="../uploads/<?php echo $row['image']; ?>" alt="Product Image">
                    <?php } ?>

                    <h3><?php echo $row['name']; ?></h3>

                    <p><strong>R<?php echo number_format($row['price'], 2); ?></strong></p>

                    <p><?php echo $row['description']; ?></p>

                    <a href="cart.php?remove=<?php echo $row['cart_id']; ?>"
                       onclick="return confirm('Remove this product from cart?');">
                        <button class="delete-btn">Remove</button>
                    </a>

                </div>

            <?php } ?>

        </div>

        <div class="dashboard-card" style="margin-top:30px;">
            <h3>Cart Total</h3>
            <p>R<?php echo number_format($total, 2); ?></p>
        </div>

        <div class="dashboard-links cart-actions">
    <a href="../products.php">Continue Shopping</a>

    <a href="checkout.php">Checkout</a>

    <a href="cart.php?clear=1"
       onclick="return confirm('Are you sure you want to clear your cart?');">
       Clear Cart
    </a>
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