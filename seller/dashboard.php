<?php
session_start();
include("../includes/db.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "seller") {
    header("Location: ../login.php");
    exit();

}
// DELETE PRODUCT
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $user_id = $_SESSION['user_id'];

    // Ensure seller can only delete their own product
    mysqli_query($conn, "DELETE FROM products WHERE id = $id AND user_id = $user_id");

    header("Location: dashboard.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$result = mysqli_query($conn, "SELECT * FROM products WHERE user_id = $user_id ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Seller Dashboard | KasiKart</title>
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

    <h1>Seller Dashboard</h1>

    <p>Welcome, <?php echo $_SESSION['fullname']; ?></p>

    <div class="dashboard-links">
        <a href="add-product.php">Add Product</a>
        <a href="../products.php">View Marketplace</a>
        <a href="sales.php"> My Sales </a>
        <a href="../logout.php">Logout</a>
    </div>

    <h2 style="margin-top: 40px;">My Products</h2> <br><br>

    <div class="product-container">

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>

            <div class="product-card">

            <?php if ($row['image'] != "") { ?>
                <img src="../uploads/<?php echo $row['image']; ?>" alt="Product Image">
            <?php } ?>

                <h3><?php echo $row['name']; ?></h3>

                <p>R<?php echo number_format($row['price'], 2); ?></p>

                <p><strong>Status:</strong> <?php echo ucfirst($row['status']); ?></p>

                <?php if ($row['status'] == "sold") { ?>
                <p class="sold-label">Sold</p>
                <?php } ?>

                <p><?php echo $row['description']; ?></p>

                

                <div class="card-actions">
                <a href="edit-product.php?id=<?php echo $row['id']; ?>">
                <button>Edit</button>
                </a>

                <a href="dashboard.php?delete=<?php echo $row['id']; ?>"
                onclick="return confirm('Are you sure you want to delete this product?');">
                <button class="delete-btn">Delete</button>
                </a>
                </div>
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