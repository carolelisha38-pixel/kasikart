<?php
session_start();
include("../includes/db.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "buyer") {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$message = "";

$result = mysqli_query($conn, "SELECT * FROM users WHERE id = $user_id");
$user = mysqli_fetch_assoc($result);

if (isset($_POST['update_profile'])) {

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];

    $update = mysqli_query($conn, "UPDATE users 
                                   SET fullname='$fullname', email='$email' 
                                   WHERE id=$user_id");

    if ($update) {
        $_SESSION['fullname'] = $fullname;
        $message = "Profile updated successfully.";

        $result = mysqli_query($conn, "SELECT * FROM users WHERE id = $user_id");
        $user = mysqli_fetch_assoc($result);
    } else {
        $message = "Profile could not be updated.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile | KasiKart</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

<header>
    <div class="logo">
        <h1>KasiKart</h1>
    </div>
</header>

<div class="form-container">

    <form method="POST">

        <h2>Edit Profile</h2>

        <?php if ($message != "") { ?>
            <p class="message"><?php echo $message; ?></p>
        <?php } ?>

        <input type="text" name="fullname" value="<?php echo $user['fullname']; ?>" required>

        <input type="email" name="email" value="<?php echo $user['email']; ?>" required>

        <button type="submit" name="update_profile">Update Profile</button> <br>

         <div class="form-link">
           <br> <a href="profile.php">Back to Profile</a>
        </div>

    </form>

</div>

</body>
</html>