<?php
session_start();
include("includes/db.php");

$products = mysqli_query($conn, "
    SELECT * FROM products 
    WHERE status='available'
    ORDER BY created_at DESC 
    LIMIT 4
");

$cart_count = 0;

if (isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role'] == "buyer") {
    $buyer_id = $_SESSION['user_id'];
    $cart_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM cart WHERE user_id = $buyer_id");
    $cart_data = mysqli_fetch_assoc($cart_result);
    $cart_count = $cart_data['total'];
}

$category = "";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KasiKart | Home</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="market-home">

<header class="shop-header">
    <button class="menu-btn" onclick="openSidebar()">
        <i class="fa-solid fa-bars"></i>
    </button>

    <div class="logo">
        <h1>KasiKart</h1>
    </div>

    <nav class="shop-icons">
        <a href="login.php" title="Account">
            <i class="fa-regular fa-user"></i>
        </a>

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

<section class="shop-search">
    <form action="products.php" method="GET">
        <div class="search-wrapper">
            <i class="fa-solid fa-magnifying-glass"></i>

            <input type="text" name="search" placeholder="Search products...">

            <button type="submit">Search</button>
        </div>
    </form>
</section>

<section class="category-tabs">
    <a href="products.php" class="<?php if($category == '') echo 'active'; ?>">All</a>
    <a href="products.php?category=Clothing" class="<?php if($category == 'Clothing') echo 'active'; ?>">Clothing</a>
    <a href="products.php?category=Accessories" class="<?php if($category == 'Accessories') echo 'active'; ?>">Accessories</a>
    <a href="products.php?category=Home Decor" class="<?php if($category == 'Home Decor') echo 'active'; ?>">Home Decor</a>
    <a href="products.php?category=Pre-Loved Items" class="<?php if($category == 'Pre-Loved Items') echo 'active'; ?>">Pre-Loved Items</a>
    <a href="products.php?category=Other" class="<?php if($category == 'Other') echo 'active'; ?>">Other</a>
</section> <br><br><br>

<section class="promo-strip">
<a href="buyer/dashboard.php" class="promo-card">
        <i class="fa-solid fa-bag-shopping"></i>
        <div>
            <h3>Local Buying</h3>
            <p>Browse and manage your buyer account</p>
        </div>
    </a>

    <a href="seller/dashboard.php" class="promo-card">
        <i class="fa-solid fa-store"></i>
        <div>
            <h3>Start Selling</h3>
            <p>Add products and manage your listings</p>
        </div>
    </a>

</section>

<section class="products home-products">
<h2> Latest Listings </h2>
<div class="product-container">
<?php while ($row = mysqli_fetch_assoc($products)) { ?>

    <div class="product-card">

        <?php if ($row['image'] != "") { ?>
            <img src="uploads/<?php echo $row['image']; ?>" alt="Product Image">
        <?php } ?>

        <h3><?php echo $row['name']; ?></h3>

        <p><strong>R<?php echo number_format($row['price'], 2); ?></strong></p>

        <p><?php echo $row['description']; ?></p>

        <a href="product-details.php?id=<?php echo $row['id']; ?>">
            <button>View Product</button>
        </a>

    </div>

<?php } ?>

</div>
</section>

    
<footer>
    <p>&copy; 2026 KasiKart. All Rights Reserved.</p>
</footer>

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
