<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != "admin"){
    header("Location: login.php");
    exit();
}

include "../db.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $role = "user"; // force user role

    $sql = "INSERT INTO users(name, email, password, role) VALUES('$name', '$email', '$password', '$role')";
    $result = mysqli_query($conn, $sql);

    if(!$result){
        echo "<p style='color:red; text-align:center;'>Error: {$conn->error}</p>";
    } else {
        echo "<p style='color:green; text-align:center;'>User registered successfully!</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include "../heading.php"; ?>

<style>
    body {
        font-family: Arial, sans-serif;
        background: #f4f6fa;
        margin: 0;
        padding: 0;
    }

    .register {
        width: 400px;
        background: #ffffff;
        margin: 80px auto;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.12);
        text-align: center;
        transition: 0.3s ease;
        position: relative;
    }

    .register:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 28px rgba(0,0,0,0.12);
    }

    .register h2 {
        margin-bottom: 20px;
        font-size: 22px;
        color: #333;
        font-weight: bold;
        letter-spacing: 1px;
    }

    .register input {
        width: 92%;
        padding: 12px;
        margin: 12px 0;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 15px;
        outline: none;
        transition: 0.2s ease;
    }

    .register input:focus {
        border-color: #7d3b3b;
        box-shadow: 0 0 5px rgba(125, 59, 59, 0.4);
    }

    .register button {
        width: 100%;
        padding: 12px;
        background: linear-gradient(45deg, #7d3b3b, #a84a4a);
        color: white;
        font-size: 16px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        margin-top: 10px;
        transition: 0.3s ease;
        font-weight: bold;
    }

    .register button:hover {
        background: linear-gradient(45deg, #a84a4a, #7d3b3b);
        transform: scale(1.03);
    }

    /* Back Button Styling */
    .back-btn {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 16px;
        background: #7d3b3b;
        color: #fff;
        text-decoration: none;
        border-radius: 8px;
        font-size: 15px;
        transition: 0.3s ease;
        font-weight: bold;
    }

    .back-btn:hover {
        background: #a84a4a;
        transform: translateY(-3px);
        box-shadow: 0 5px 12px rgba(0,0,0,0.15);
    }
</style>

<body>
    <div class="register">
        <h2>Add New User</h2>

        <form action="register.php" method="post">
            <input type="text" name="name" placeholder="Enter User Name" required><br>
            <input type="email" name="email" placeholder="Enter User Email" required><br>
            <input type="password" name="password" placeholder="Enter User Password" required><br>
            <input type="text" name="role" value="user" hidden>

            <button type="submit">Create User</button>
        </form>

        <!-- Styled Back Button -->
        <a href="dashboard.php" class="back-btn">← Back to Admin Dashboard
        </a>
    </div>
</body>
</html>
