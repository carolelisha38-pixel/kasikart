<?php
session_start();
include("../includes/db.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "seller") {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Get product ID from URL
if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$id = $_GET['id'];

// Fetch product - ensuring it belongs to the seller
$result = mysqli_query($conn, "SELECT * FROM products WHERE id = $id AND user_id = $user_id");

if (mysqli_num_rows($result) == 0) {
    header("Location: dashboard.php");
    exit();
}

$product = mysqli_fetch_assoc($result);

// Update product
if (isset($_POST['update_product'])) {

    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    mysqli_query($conn, "
        UPDATE products 
        SET name='$name', price='$price', description='$description' 
        WHERE id = $id AND user_id = $user_id
    ");

    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
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
    <a href="../login.php">Admin Login</a>
</div>
<body>

<div class="form-container">

<form method="POST">

<h2>Edit Product</h2>

<input type="text" name="name" value="<?php echo $product['name']; ?>" required>

<input type="number" name="price" value="<?php echo $product['price']; ?>" required>

<textarea name="description"><?php echo $product['description']; ?></textarea>

<button type="submit" name="update_product">Update Product</button>

</form>

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