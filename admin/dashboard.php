<?php
session_start();
include "../db.php";

if(isset($_SESSION['user_id'])){
    if($_SESSION['role'] != 'admin'){
        header("Location: ../dashboard.php");
        exit();
    }
} else {
    header("Location: ../login.php");
    exit();
}

// Fetch admin name
$admin_id = $_SESSION['user_id'];

$stmt = mysqli_prepare($conn, "SELECT name FROM users WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $admin_id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $admin_name);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: #f4f6fa;
            color: #333;
        }

        .header {
            background: linear-gradient(45deg, #7d3b3b, #a84a4a);
            padding: 20px;
            color: white;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 1px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        .dashboard-container {
            width: 90%;
            max-width: 900px;
            margin: 50px auto;
            text-align: center;
        }

        nav ul {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
            gap: 25px;
        }

        nav ul li {
            margin: 0;
        }

        nav a {
            text-decoration: none;
            background: #ffffff;
            padding: 16px 26px;
            border-radius: 12px;
            font-size: 18px;
            font-weight: bold;
            color: #7d3b3b;
            border: 2px solid #e6b3b3;
            transition: 0.3s ease;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        }

        nav a:hover {
            background: #7d3b3b;
            color: white;
            transform: translateY(-4px);
            box-shadow: 0 6px 18px rgba(0,0,0,0.2);
        }

        .logout-btn {
            display: inline-block;
            margin-top: 40px;
            padding: 12px 20px;
            background: #b33030;
            color: white;
            font-weight: bold;
            border-radius: 10px;
            text-decoration: none;
            transition: 0.3s ease;
            box-shadow: 0 5px 12px rgba(0,0,0,0.15);
        }

        .logout-btn:hover {
            background: #d94343;
            transform: translateY(-3px);
        }
    </style>
</head>
<body>

<div class="header">
    Welcome, <?php echo htmlspecialchars($admin_name); ?>! 👋
</div>

<div class="dashboard-container">
    <nav>
        <ul>
            <li><a href="view_transactions.php">📄 View Transactions</a></li>
            <li><a href="manage_users.php">👥 Manage Users</a></li>
            <li><a href="add_book.php">➕ Add Book</a></li>
        </ul>
    </nav>

    <a class="logout-btn" href="../logout.php">🚪 Logout</a>
</div>

</body>
</html>
