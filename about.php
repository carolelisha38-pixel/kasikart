<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About | KasiKart</title>
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
</header>

<div id="sidebar" class="sidebar">
    <button class="close-btn" onclick="closeSidebar()">×</button>

    <a href="index.php">Home</a>
    <a href="about.php">About</a>
    <a href="contact.php">Contact</a>
</div>

<div id="sidebar" class="sidebar">
    <button class="close-btn" onclick="closeSidebar()">×</button>

    <a href="../index.php">Home</a>
    <a href="../about.php">About</a>
    <a href="../contact.php">Contact</a>
    <a href="../login.php">Admin Login</a>
</div>

<section class="page-hero">
<br><br> <h2>About KasiKart</h2> <br><br>
    <p>Connecting local buyers and sellers through secure digital commerce.</p> <br><br>
</section>


    
</section>

<section class="about-section">
    <div class="about-content">

    <h2> Who Are We? </h2>

    <p> KasiKart is a South African consumer-to-consumer e-consumer platform designed to support informal traders, small businesses, side-hustlers and everyday buyers. </p> 
    <p> The platform allows users to register as a buyer or seller, browse products, list items for sale and connect within a trusted online marketplace. </p> <br><br>
    
    <h2> Our Purpose </h2>

    <p> KasiKart aims to help move informal trade into the digital economy by making online buying and selling more accessible, affordable and community-focused. </p> <br><br>

    <h2> Why KasiKart Matters </h2>

    <p> Many small sellers rely on social media or word-of-mouth to reach customers. KasiLart creates a more organized as well as secure space where sellers can showcase their products and buyers can find local products more easily. </p> <br><br>
    
</div>

</section>

<footer> 
    <p> &copy; 2026 KasiKart. All Rights Reserved. </p>
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

