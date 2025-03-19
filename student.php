<?php
session_start();

if (!isset($_SESSION['s_id'])) {
    header("Location: login.php");
    exit;
}

require 'dbConnect.php';

$student_id = $_SESSION['s_id'];

$select = "SELECT * FROM student WHERE student_id='$student_id'";
$query = mysqli_query($con, $select);
$user = mysqli_fetch_assoc($query);

if (!$user) {
    die("Student not found.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $new_name = $_POST['name'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        $update_query = "UPDATE student SET name='$new_name', password='$new_password' WHERE student_id='$student_id'";
        if (mysqli_query($con, $update_query)) {
            $success = "Password change successfully!";
            // $query = mysqli_query($con, $select);
            // $user = mysqli_fetch_assoc($query);
        } else {
            $error = "Failed to update profile.";
        }
    }
}

$student_class = $user['class'];

$class_query =  "select class_id,class_name,subject,section,name from class join teacher on class.teacher_id = teacher.teacher_id 
                where class_name = '$student_class';";
$class_result = mysqli_query($con, $class_query);

if (!$class_result) {
    die("Error fetching class details: " . mysqli_error($con));
}


if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Student</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css"> -->
    <link rel="icon" href="images/footer.png">
    <link rel="stylesheet" href="css/techel.css">
</head>
<body>
    <div class="sidebar">
        <h2>Student</h2>
        <ul>
            <li><a href="student.php">Home</a></li> 
            <li>
                <a href="?logout=true">Log Out <i class="fa-solid fa-right-from-bracket"></i></a>
            </li>
        </ul>
    </div>
    
    <div class="main-content">
        <div class="top-nav">
            <div class="left-menu">
                <h2>Learning Hub</h2>
            </div>
            <div class="right-menu">
                <span class="pname">Welcome, <?php echo htmlspecialchars($user['name']); ?></span>
                <img src="./images/profile.webp" alt="Edit Profile" onclick="toggleEditForm()" style="cursor: pointer; width: 40px; height: 40px; border-radius: 50%; margin-left: 10px;">   
            </div>
        </div>

        <div class="class-container">
            <?php
            if (mysqli_num_rows($class_result) > 0) {
                while ($class = mysqli_fetch_assoc($class_result)) {
                    echo '
                    <a href="classroom.php?class_id=' . $class['class_id'] . '&student_id=' . $user['student_id'] . '" class="card">
                        <div class="name">
                            <h3>' . htmlspecialchars($class['name']) . '</h3>
                        </div>
                        <div class="class-name">
                            <h3>' . htmlspecialchars($class['subject']) . '</h3>
                            <p>Section ' . htmlspecialchars($class['section']) . '</p>
                        </div>
                    </a>';
                }
            }
            ?>
        </div>

    </div>
    <div id="editForm" class="edit-box">
        <h2>Edit Profile</h2>
        <form action="" method="POST">
            <input type="hidden" name="teacher_id" value="<?php echo $user['student_id']; ?>">

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" readonly required>

            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password" placeholder="Enter new password">

            <label for="confirm_password">Confirm New Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm new password">
            
            <?php if (isset($success)): ?>
                <p style="color: green;"><?php echo $success; ?></p>
            <?php endif; ?>

            <?php if (isset($error)): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>

            <button type="submit" name="update" class="update-button">Change Password</button>
        </form>
    </div>
<script src="js/edit.js"></script>
</body>
</html>