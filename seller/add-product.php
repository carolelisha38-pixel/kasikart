<?php
session_start();
include("../includes/db.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "seller") {
    header("Location: ../login.php");
    exit();
}

$message = "";

if (isset($_POST['add_product'])) {

    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];

    $new_image_name = time() . "_" . $image_name;

    $upload_path = "../uploads/" . $new_image_name;

    if (move_uploaded_file($image_tmp, $upload_path)) {


    $sql = "INSERT INTO products (user_id, name, category, price, description, image)
            VALUES ('$user_id', '$name', '$category', '$price', '$description', '$new_image_name')";

            if (mysqli_query($conn, $sql)) {
                $message = "Product added successfully!";
            
            } else {
                $message = "Product could not be added.";
            }

        } else {
            $message = "Image upload failed.";

        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Add Product | KasiKart </title>
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

<div class="form-container">

<form method="POST" enctype="multipart/form-data">

<h2>Add Product</h2>

<?php if ($message != "")  { ?>
    <p class="message"><?php echo $message; ?> </p>
    <?php } ?>

<input type="text" name="name" placeholder="Product Name" required>

<select name="category" required>
    <option value="">Select Category</option>
    <option value="Clothing">Clothing</option>
    <option value="Accessories">Accessories</option>
    <option value="Home Decor">Home Decor</option>
    <option value="Pre-Loved Items">Pre-Loved Items</option>
    <option value="Other">Other</option>
</select>

<input type="number" name="price" placeholder="Price" required>

<textarea name="description" placeholder="Product Description"></textarea>
<input type="file" name="image" accept="image/*" required>

<button type="submit" name="add_product">Add Product</button>

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