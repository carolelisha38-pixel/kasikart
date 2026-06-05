<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact | KasiKart</title>
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

<section class="page-hero">

<h2> Contact Us </h2> <br>
<p> Need help? Send us a message and our support team will assist you. </p> <br><br>

</section>

<section class="contact-section">

<div class="contact-container">

<div class="contact-info">
    <h2> Get in Touch </h2> <br>

    <p> Have questions about buying, selling or using KasiKart? Contact us using this form. </p>

    <p><strong> Email: </strong> support@kasikart.co.za </p>
    <p><strong> Phone: </strong> +27 11 550 0000 </p>
    <p><strong> Location: </strong> Johannesburg, South Africa </p> <br><br>

</div>

<form class="contact-form" method="POST">
    <h2> Send Message </h2> <br>

    <input type="text" name="name" placeholder="Your Name" required>
    <input type="email" name="email" placeholder="Your Email" required>
    <input type="text" name="subject" placeholder="Subject" required> <br><br>

    <textarea name="message" placeholder="Your Message" required> </textarea> <br>
    <br><br> <button type="submit"> Send Message </button> <br><br>

</form>
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