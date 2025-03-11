<?php
session_start();
require 'dbConnect.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $pw = $_POST['pw'];

    $name = mysqli_real_escape_string($con, $name);
    $pw = mysqli_real_escape_string($con, $pw);

    if ($name == 'admin' && $pw == '123123') {
        header("Location: admin.php");
        exit;
    }

    $query = "select name, password from student where name='$name' AND password='$pw'";
    $ret = mysqli_query($con, $query);

    if (mysqli_num_rows($ret) == 1) {
        $rows = mysqli_fetch_assoc($ret);
        $_SESSION['name'] = $rows['name'];
        $_SESSION['password'] = $rows['password'];
        header("Location: checkstu.php");
        exit;
    }

    $query1 = "select name, password from teacher where name='$name' AND password='$pw'";
    $ret1 = mysqli_query($con, $query1);

    if (mysqli_num_rows($ret1) == 1) {
        $rows1 = mysqli_fetch_assoc($ret1);
        $_SESSION['name'] = $rows1['name'];
        $_SESSION['password'] = $rows1['password'];
        header("Location: check.php");
        exit;
    }

    $error = "Username or Password is incorrect!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/login.css">
    <link rel="icon" href="images/footer.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- nav-start  -->
    <header>
        <div class="text-logo">
            <div class="hamburger" id="hamburger">
                <i class="fa-solid fa-bars"></i>
            </div>
            <h2>Learning<span>Hub</span></h2>
        </div>
        <div class="contact">
            <span><i class="fa-solid fa-phone-volume"></i> Call us: </span>(+95) 9-8762778
            <span><i class="fa-solid fa-envelope"></i> E-mail: </span><a href="mailto:learninghub@gmail.com">learninghub@gmail.com</a>
        </div>
        <div class="log-in">
            <p>You are not logged in.(<a href="login.php">Log in</a>)</p>
        </div>
    </header>
    <!-- nav-end  -->

    <!-- aside-bar-start  -->
    <aside class="sidebar" id="sidebar">
        <ul>
            <li><a href="index.html">Home</a></li>
        </ul>
    </aside>
    <!-- aside-bar-end  -->
    <section class="body-img">
        <div class="background-container"></div>
    <div class="login-main">
        <div class="login-box">
            <h2>Learning Hub<br>Login</h2>
            <form actiion="" method="post">
                <input type="text" placeholder="Username" name="name" required>
                <input type="password" placeholder="Password" name="pw" required>
                <!-- <a href="#" class="forgot-password">Forgotten your username or password?</a> -->
                <?php if (isset($error)): ?>
                    <div class="error-message"><?php echo $error; ?></div>
                <?php endif; ?>
                <button type="submit" name="submit" class="login-button">Log in</button>
            </form>
        </div>
    </div>
</section>
    <!-- footer-start  -->
    <section class="footer-start">
        <div class="footer-box">
            <div class="footer-logo">
                <img src="images/footer.png" alt="">
            </div>
            <p>Simplifying education, inspiring excellence.<br>
            Let’s create a better tomorrow, one step at a time.</p>
        </div>
        <div class="footer-box">
            <h1>Info</h1>
            <p id="university-website">University Website</p>
            <p id="contact-us">Contact Us</p>
        </div>
        </div>
        <div class="footer-box">
            <h1>Contact Us</h1>
            <p>Myeik-Tanintharyi Highway Road, Myeik Township,<br>
            Tanintharyi Region, Myanmar, Postal Code: 14051</p>
            <div class="icon">
                <span><i class="fa-solid fa-phone-volume"></i> Call us: </span>(+95) 9-8762778
            </div>
            <div class="icon">
                <span><i class="fa-solid fa-envelope"></i> E-mail: </span><a href="mailto:learninghub@gmail.com">learninghub@gmail.com</a>
            </div>
        </div>
    </section>
    <section>
        <footer>
            <p>Copyright &copy; 2025 - Developed by Group (IV).  All rights reserved.</p>
        </footer>
    </section>
    <!-- footer-end  -->

</body>
<script src="./js/aside.js"></script>
<script src="./js/window.js"></script>
</html>
