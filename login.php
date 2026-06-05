<?php

session_start();
include("includes/db.php");

$message="";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {

        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['fullname'] = $user['fullname'];

            if ($user['role'] == "buyer") {
                header("Location: buyer/dashboard.php");
            } elseif ($user['role'] == "seller") {
                header("Location: seller/dashboard.php");
            } elseif ($user['role'] == "admin") {
                header("Location: admin/dashboard.php");
            }

        } else {
            $message = "Incorrect password.";
        }
    } else {
        $message = "No account found with that email.";
    }

            }

    ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> Login | KasiKart </title> <br><br>
    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="form-container">

    <form method="POST">
        
    <h2> Login to KasiKart </h2> <br>


    <?php if ($message != "") { ?>
    <p class="message"><?php echo $message; ?></p>
<?php } ?>

<input type="email" name="email" placeholder="Email Address" required>

<div class="password-box">
    <input type="password" name="password" id="password" placeholder="Password" required>
    <span onclick="togglePassword('password')">
        <i class="fa-regular fa-eye"></i>
    </span>
</div>

 <br><br> <button type="submit" name="login"> Login </button> <br><br>

 <p class="form-link">
 <a href="forgot-password.php"> Forgot Password? </a>
</p>

 <br> <p class="form-link">
    Don't have an account?
    <a href="register.php"> Register here </a>
 </p>

    </div>

    <script>
function togglePassword(id){
    const input = document.getElementById(id);

    if(input.type === "password"){
        input.type = "text";
    } else {
        input.type = "password";
    }
}
</script>

    </body>
    </html>