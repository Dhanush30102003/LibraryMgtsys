<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'] ?? 'user';

// Redirect admin to admin dashboard
if ($role === 'admin') {
    header("Location: admin/dashboard.php");
    exit();
}

// Fetch user details
$stmt = mysqli_prepare($conn, "SELECT name, email FROM users WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $name, $email);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>User Dashboard</title>

  <style>
    :root{
      --accent:#4b1c3d;
      --muted:#6b6f76;
      --card:#fff;
      --bg:#f4f7fb;
      --radius:12px;
    }
    *{box-sizing:border-box}
    body{margin:0;font-family:Inter,Arial,sans-serif;background:linear-gradient(180deg,var(--bg),#eef4fa);color:#222}

    header{
      background:linear-gradient(90deg,var(--accent),#7b2b58);
      color:#fff;
      padding:18px;
      display:flex;
      justify-content:space-between;
      align-items:center;
    }
    .brand{display:flex;gap:12px;align-items:center}
    .logo{
      width:44px;height:44px;
      border-radius:8px;
      background:rgba(255,255,255,0.12);
      display:flex;
      align-items:center;
      justify-content:center;
      font-weight:700;
    }

    main{max-width:1100px;margin:28px auto;padding:18px}

    .grid{
      display:grid;
      grid-template-columns:300px 1fr;
      gap:20px;
      align-items:start;
    }

    .profile{
      background:var(--card);
      padding:20px;
      border-radius:var(--radius);
      box-shadow:0 10px 30px rgba(20,20,30,0.06);
      text-align:center;
    }

    .avatar{
      width:96px;height:96px;
      border-radius:14px;
      background:linear-gradient(180deg,#fdecea,#fff);
      display:flex;
      align-items:center;
      justify-content:center;
      font-weight:700;
      color:var(--accent);
      font-size:28px;
      margin-bottom:10px;
    }

    .info{
      text-align:left;
      margin-top:15px;
      font-size:15px;
      color:#444;
      line-height:1.6;
    }

    .card{
      background:#fff;
      padding:22px;
      border-radius:var(--radius);
      box-shadow:0 10px 30px rgba(20,20,30,0.06);
    }

    .quick-links{display:flex;gap:12px;margin-top:12px;flex-wrap:wrap}
    .link{
      padding:10px 14px;
      border-radius:8px;
      border:1px solid #e9eef3;
      text-decoration:none;
      color:#333;
      background:#fff;
      font-weight:600;
      transition:0.2s ease;
    }
    .link:hover{
      background:#4b1c3d;
      color:#fff;
      transform:translateY(-3px);
    }

  </style>
</head>
<body>

<header>
  <div class="brand">
    <div class="logo">U</div>
    <div>
      <h1 style="margin:0;font-size:20px;">User Dashboard</h1>
      <small style="opacity:0.8;">Welcome back!</small>
    </div>
  </div>

  <nav style="display:flex;gap:10px;">
    <a style="color:#fff;text-decoration:none;padding:8px 10px;border-radius:8px;border:1px solid rgba(255,255,255,0.1);" href="index.php">Home</a>
    <a style="color:#fff;text-decoration:none;padding:8px 10px;border-radius:8px;border:1px solid rgba(255,255,255,0.1);" href="borrowed.php">My Borrowed</a>
    <a style="color:#fff;text-decoration:none;padding:8px 10px;border-radius:8px;border:1px solid rgba(255,255,255,0.1);" href="logout.php">Logout</a>
  </nav>
</header>

<main>
  <div class="grid">

      <!-- LEFT PROFILE CARD -->
      <aside class="profile">
          <div class="avatar">
              <?php echo strtoupper(substr($name,0,2)); ?>
          </div>

          <h3 style="margin:5px 0;">Hello, <?php echo htmlspecialchars($name); ?> 👋</h3>

          <div class="info">
              <strong>User ID:</strong> <?php echo htmlspecialchars($user_id); ?><br>
              <strong>Email:</strong> <?php echo htmlspecialchars($email); ?><br>
              <strong>Role:</strong> User
          </div>
      </aside>

      <!-- RIGHT SIDE CONTENT -->
      <section>
          <div class="card">
              <h2 style="margin:0 0 10px;">Welcome to Your Dashboard</h2>
              <p style="color:var(--muted);font-size:15px;">
                  Here you can view your borrowed books, browse the library, and manage your profile.
              </p>

              <div class="quick-links">
                  <a class="link" href="index.php">Browse Books</a>
                  <a class="link" href="borrowed.php">My Borrowed Books</a>
                
              </div>
          </div>

      </section>

  </div>
</main>

</body>
</html>
