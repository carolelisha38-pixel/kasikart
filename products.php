<?php
session_start();
include("includes/db.php");

$search = "";
$category = "";

$query = "SELECT * FROM products WHERE status='available'"; 

if (isset($_GET['search']) && $_GET['search'] != "") {
    $search = $_GET['search'];
    $query .= " AND (name LIKE '%$search%' OR description LIKE '%$search%')";
}

if (isset($_GET['category']) && $_GET['category'] != "") {
    $category = $_GET['category'];
    $query .= " AND category = '$category'";
}

$query .= " ORDER BY created_at DESC";

$result = mysqli_query($conn, $query);

$cart_count = 0;

if (isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role'] == "buyer") {
    $buyer_id = $_SESSION['user_id'];
    $cart_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM cart WHERE user_id = $buyer_id");
    $cart_data = mysqli_fetch_assoc($cart_result);
    $cart_count = $cart_data['total'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Products | KasiKart</title>
    <link rel="stylesheet" href="style.css">
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

<section class="category-tabs">
    <a href="products.php" class="<?php if($category == '') echo 'active'; ?>">All</a>
    <a href="products.php?category=Clothing" class="<?php if($category == 'Clothing') echo 'active'; ?>">Clothing</a>
    <a href="products.php?category=Accessories" class="<?php if($category == 'Accessories') echo 'active'; ?>">Accessories</a>
    <a href="products.php?category=Home Decor" class="<?php if($category == 'Home Decor') echo 'active'; ?>">Home Decor</a>
    <a href="products.php?category=Pre-Loved Items" class="<?php if($category == 'Pre-Loved Items') echo 'active'; ?>">Pre-Loved Items</a>
    <a href="products.php?category=Other" class="<?php if($category == 'Other') echo 'active'; ?>">Other</a>
</section>

<h1 style="text-align:center; margin-top:30px;">Products</h1>
<?php if ($search != "") { ?>
<P> Search results for: <strong> <?php echo $search; ?></strong></p>
<?php } ?>
<div class="product-container">

<?php while ($row = mysqli_fetch_assoc($result)) { ?>

    <div class="product-card">

    <?php if ($row['image'] != "") { ?>
    <img src="uploads/<?php echo $row['image']; ?>" alt="Product Image">
<?php } ?>

        <h3><?php echo $row['name']; ?></h3>

        <p>R<?php echo $row['price']; ?></p>

        <p><?php echo $row['description']; ?></p>

        <a href="product-details.php?id=<?php echo $row['id']; ?>">
    <button>View Product</button>
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