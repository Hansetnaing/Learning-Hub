<?php
session_start();

if (!isset($_SESSION['t_id'])) {
    header("Location: login.php");
    exit;
}

require 'dbConnect.php';

$user_id = $_SESSION['t_id'];
$select = "SELECT * FROM teacher where teacher_id = '$user_id'";
$stmt = mysqli_query($con, $select);
$user = mysqli_fetch_assoc($stmt);

if (!$user) {
    die("User not found.");
}

$select_classes = "SELECT * FROM class where teacher_id = '$user_id'";
$stmt_classes = mysqli_query($con,$select_classes);
$classes = mysqli_fetch_all($stmt_classes, MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_class'])) {
    $class_name = $_POST['cname'];
    $subject = $_POST['subject'];
    $year = $_POST['year'];
    $section = $_POST['section'];

    $insert_class = "INSERT INTO class (class_name, subject, year, section, teacher_id) VALUES ('$class_name', '$subject', '$year', '$section', '$user_id')";
    mysqli_query($con, $insert_class);

    header("Location: teacher.php");
    exit;
}

if (isset($_POST['update'])) {
    $teacher_id = $_POST['teacher_id'];
    $tname = $_POST['name'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if (!empty($new_password)) {
        if ($new_password === $confirm_password) {
            $sql = "update teacher set name='$tname', password='$new_password' where teacher_id='$teacher_id'";
        } else {
            $_SESSION['error'] = "Passwords do not match!";
            $_SESSION['modal_open'] = true;
            header("Location: teacher.php");
            exit();
        }
    } else {
        $sql = "update teacher set name='$tname' where teacher_id='$teacher_id'";
    }
    if (mysqli_query($con, $sql)) {
        $success = "Password change successfully!";        
    } else {
        $error = "Failed to update profile.";
    }
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
    <title>Home | Teacher</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css"> -->
    <link rel="stylesheet" href="css/techel.css">
    <link rel="icon" href="images/footer.png">
</head>
<body>
    <div class="sidebar">
        <h2>Teacher</h2>
        <ul>
            <li><a href="teacher.php?teacher_id=<?php echo $_SESSION['t_id']; ?>">Home</a></li> 
            <?php if (!empty($classes)): ?>
                <?php foreach ($classes as $class): ?>
                    <li>
                        <a href="class_details.php?class_id=<?php echo $class['class_id']; ?>">
                            <?php echo htmlspecialchars($class['class_name']); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
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
        <div class="create-container">
            <span class="createclass" id="createGroupBtn" onclick="openModal('modal1')">Create Class <i class="fa-solid fa-plus"></i></span>
        </div>
        <div class="card-container">
            <?php if (!empty($classes)): ?>
                <?php foreach ($classes as $class): ?>
                    <a href="class_details.php?class_id=<?php echo $class['class_id']; ?>">
                        <div class="card">
                            <h3><?php echo htmlspecialchars($class['class_name']); ?></h3>
                            <p>Subject: <?php echo htmlspecialchars($class['subject']); ?></p>
                            <p>Year: <?php echo htmlspecialchars($class['year']); ?></p>
                            <p>Section: <?php echo htmlspecialchars($class['section']); ?></p>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
    </div>

    <div id="editForm" class="edit-box">
        <h2>Edit Profile</h2>
        <form action="" method="POST">
            <input type="hidden" name="teacher_id" value="<?php echo $user['teacher_id']; ?>">

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" readonly required>

            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password" placeholder="Enter new password">

            <label for="confirm_password">Confirm New Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm new password">
            
            <?php if (isset($success)): ?>
                <p style="color: green;"><?php echo $success; ?></p>
            <?php endif; ?>

            <button type="submit" name="update" class="update-button">Change Password</button>
        </form>
    </div>

    <div id="createGroupModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <h2>Create Group</h2>
            <form action="" method="post">
                <input type="text" name="cname" placeholder="Enter Class Name" style="width: 100%; padding: 10px; margin-top: 10px;">
                <input type="text" name="year" placeholder="Enter Year" style="width: 100%; padding: 10px; margin-top: 10px;">
                <input type="text" name="subject" placeholder="Enter Subject" style="width: 100%; padding: 10px; margin-top: 10px;">
                <input type="text" name="section" placeholder="Section" style="width: 100%; padding: 10px; margin-top: 10px;">
                <button type="submit" name="create_class" style="margin-top: 10px; padding: 10px; width: 30%; background-color: #28a745; color: white; border: none; cursor: pointer; border-radius: 5px;">Create</button>
                <button type="reset" name="reset_class" style="margin-top: 10px; padding: 10px; width: 30%; background-color: #28a745; color: white; border: none; cursor: pointer; border-radius: 5px;">Cancel</button>
            </form>
        </div>
    </div>

    <script src="js/class.js"></script>
    <script src="js/edit.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
</body>
</html>