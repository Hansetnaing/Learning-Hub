<?php
require 'dbConnect.php';

if(isset($_POST['create'])){

    $name = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $dept = $_POST['department'];

    $insert = "insert into teacher (name,password,email,dept_name) values ('$name','$password','$email','$dept');";
    $qry = mysqli_query($con,$insert);
    if($qry){
        $success = 'Create Successful!';
    }
    else{
        $error = 'Something Wrong!';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Add Teacher</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="icon" href="images/footer.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <header id="header">
            <div class="header-content">
                <button id="toggle-sidebar">☰</button>
                <h1>Admin</h1>
            </div>
            <div class="log-out">
                <a href="login.php"><i class="fa-solid fa-right-from-bracket"></i></a>
            </div>
        </header>

        <aside id="sidebar">
            <nav>
                <ul>
                    <li><a href="admin.php">Home</a></li>
                    <li><a href="addtchel.php">Add Teacher</a></li>
                    <li><a href="tList.php">Teacher List</a></li>
                    <li><a href="addstu.php">Add Student</a></li>
                    <li><a href="stuList.php">Student List</a></li>
                </ul>
            </nav>
        </aside>

        <main id="content">
            <div class="form-container">
                <h2>Create Teacher Account</h2>
                <form action="" method="POST">

                    <div id="message">
                        <?php if (isset($success)): ?>
                            <p style="color: green"><?php echo $success ?></p>
                        <?php elseif (isset($error)): ?>
                            <p style="color: red"><?php echo $error ?></p>
                        <?php endif; ?>
                    </div>


                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="department">Department:</label>
                        <select id="department" name="department" required>
                            <option value="">Select Department</option>
                            <option value="Myanmar">Myanmar</option>
                            <option value="English">English</option>
                            <option value="Physics">Physics</option>
                            <option value="Mathematics">Mathematics</option>
                            <option value="Software">Software</option>
                            <option value="Hardware">Hardware</option>
                            <option value="Information Science">Information Science</option>
                            <option value="Application">Application</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" name="create" class="create-button">Create Account</button>
                    </div>
                </form>
            </div>
        </main>

    </div>

    <script src="js/admin.js"></script>
</body>
</html>