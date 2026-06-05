<?php
session_start();
include("../includes/db.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "admin") {
    header("Location: ../login.php");
    exit();
}

// Delete Product

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    mysqli_query($conn, "DELETE FROM products WHERE id = $id");

    header("Location: manage-products.php");
    exit();
}

// Get products and seller information

$result = mysqli_query($conn, "
SELECT products.*, users.fullname
FROM products
JOIN users ON products.user_id = users.id
ORDER BY products.created_at DESC");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Products | KasiKart</title>
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
    
</div>

<body>
<div class="dashboard">

<h1> Manage Products </h1>

<table class="user-table">

<tr>
    <th> ID </th>
    <th> Image </th>
    <th> Name </th>
    <th> Price </th>
    <th> Seller </th>
    <th> Action </th>
</tr>

<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?php echo $row['id']; ?></td>

    <td>
                <?php if ($row['image'] != "") { ?>
                    <img src="../uploads/<?php echo $row['image']; ?>" width="80">
                <?php } ?>
            </td>

            <td><?php echo $row['name']; ?></td>

            <td>R<?php echo $row['price']; ?></td>

            <td><?php echo $row['fullname']; ?></td>

            <td>
                <a href="manage-products.php?delete=<?php echo $row['id']; ?>"
                   onclick="return confirm('Delete this product?');">
                    Delete
                </a>
            </td>
        </tr>

        <?php } ?>

</table>

<br><br>

<div class="dashboard-links">
    <a href="dashboard.php" class="btn">Back to Dashboard</a>
    <a href="../logout.php" class="btn">Logout</a>
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