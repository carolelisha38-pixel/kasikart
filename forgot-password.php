<?php
include("includes/db.php");

$message = "";

if (isset($_POST['reset'])) {

    $email = strtolower(trim($_POST['email']));
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if (mysqli_num_rows($check) == 0) {
        $message = "No account found with that email address.";
    } else {
        mysqli_query($conn, "UPDATE users SET password='$new_password' WHERE email='$email'");
        $message = "Password updated successfully. You can now log in.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password | KasiKart</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="form-container">

    <form method="POST">

        <h2>Forgot Password</h2>

        <?php if ($message != "") { ?>
            <p class="message"><?php echo $message; ?></p>
        <?php } ?>

        <input type="email" name="email" placeholder="Enter your registered email" required>

        <div class="password-wrapper">
            <input type="password" id="newPassword" name="new_password" placeholder="Enter new password" required>

            <span onclick="togglePassword('newPassword')">👁</span>
        </div>

        <button type="submit" name="reset">Reset Password</button>

        <p class="form-link">
            Remember your password?
            <a href="login.php">Login here</a>
        </p>

    </form>

</div>

<script>
function togglePassword(id){
    let field = document.getElementById(id);

    if(field.type === "password"){
        field.type = "text";
    } else {
        field.type = "password";
    }
}
</script>

</body>
</html>