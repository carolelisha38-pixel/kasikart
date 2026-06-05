<?php

include("includes/db.php");

$message = "";

if (isset($_POST['register'])) {

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $check_email = mysqli_query($conn,
    "SELECT * FROM users WHERE email='$email'");

if(mysqli_num_rows($check_email) > 0){

    $message = "This email address is already registered.";

} else {

    $sql = "INSERT INTO users(fullname, email, password, role)
            VALUES('$fullname', '$email', '$password', '$role')";

    if(mysqli_query($conn, $sql)){

        $message = "Registration successful! You can now log in.";

    } else {

        $message = "Registration failed. Please try again.";

    }
}
}

?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> Register | KasiKart </title> <br><br>
    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="form-container">

    <form method="POST">

    <h2> Create Your KasiKart Account </h2> <br>

    <?php if ($message != "") { ?>
        <p class="message"><?php echo $message; ?></p>
        <?php } ?>

        <input type="text" name="fullname" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email Address" required>
        <div class="password-box">
    <input type="password" name="password" id="password" placeholder="Password" required>
    <span onclick="togglePassword('password')">
        <i class="fa-regular fa-eye"></i>
    </span>
    </div>

        <select name="role" required>
            <option value="">Select Account Type</option> 
            <option value="buyer">Buyer</option> 
            <option value="seller">Seller</option> 
        </select>

       <br><br> <button type="submit" name="register"> Register </button> <br><br>

        <p class="form-link">
            Already have an account?
            <a href="login.php"> Login here </a>
        </p>

    </form>




    
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