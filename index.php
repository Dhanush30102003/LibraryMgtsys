<?php
include "db.php";
session_start();

// Fetch books
$sql = "SELECT * FROM books";
$result = mysqli_query($conn, $sql);
if (!$result) {
    echo "Error: " . htmlspecialchars(mysqli_error($conn));
    $result = false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Library</title>
  <style>
    :root{
      --accent:#4b1c3d; --muted:#6b6b6b; --card:#fff; --bg:#f5f7fa;
      --radius:12px; --maxw:1200px;
    }
    *{box-sizing:border-box}
    body{margin:0;font-family:Inter,Arial,Helvetica,sans-serif;background:linear-gradient(180deg,var(--bg),#eef3f8);color:#222}
    header{background:linear-gradient(90deg,var(--accent),#7b2b58);color:#fff;padding:16px;display:flex;justify-content:space-between;align-items:center}
    .brand{display:flex;gap:12px;align-items:center}
    .logo{width:44px;height:44px;border-radius:8px;background:rgba(255,255,255,0.12);display:flex;align-items:center;justify-content:center;font-weight:700}
    nav{display:flex;gap:10px;align-items:center}
    .btn{padding:8px 12px;border-radius:8px;background:rgba(255,255,255,0.12);color:#fff;text-decoration:none;border:1px solid rgba(255,255,255,0.08)}
    main{max-width:var(--maxw);margin:28px auto;padding:0 18px 60px}
    .grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:20px}
    .card{background:var(--card);border-radius:var(--radius);box-shadow:0 8px 24px rgba(23,23,23,0.06);overflow:hidden;display:flex;flex-direction:column}
    .media{width:100%;aspect-ratio:7/9;background:#f1f3f6;display:flex;align-items:center;justify-content:center}
    .card img{max-width:100%;max-height:100%;object-fit:cover}
    .body{padding:14px 16px;display:flex;flex-direction:column;gap:8px;flex:1}
    .title{font-size:16px;font-weight:600;margin:0}
    .meta{font-size:13px;color:var(--muted);margin:0}
    .row{display:flex;justify-content:space-between;align-items:center}
    .link{padding:8px 10px;border-radius:8px;background:#fff;border:1px solid #e6e8eb;text-decoration:none}
    .borrow{margin-left:auto;background:linear-gradient(90deg,#ff7a18,#ff4d6d);color:#fff;padding:8px 12px;border-radius:8px;text-decoration:none;font-weight:600}
    .empty{padding:40px;text-align:center;color:var(--muted)}
    footer{max-width:var(--maxw);margin:36px auto 0;padding:18px;text-align:center;color:#fff;background:linear-gradient(90deg,var(--accent),#7b2b58);border-radius:12px}
    @media(max-width:640px){header h1{font-size:16px}}
  </style>
</head>
<body>
  <header>
    <div class="brand">
      <div class="logo">Lib</div>
      <div>
        <h1 style="margin:0;font-size:18px">Library Home Page</h1>
      </div>
    </div>

    <nav>
      <?php if(!isset($_SESSION['user_id'])): ?>
        <a class="btn" href="login.php">Login</a>
        <a class="btn" href="register.php">Register</a>
      <?php else: ?>
        <a class="btn" href="dashboard.php">Profile</a>
        <a class="btn" href="logout.php">Logout</a>
      <?php endif; ?>
    </nav>
  </header>

  <main>
    <?php if ($result && mysqli_num_rows($result) > 0): ?>
      <div class="grid">
        <?php while($row = mysqli_fetch_assoc($result)): ?>
          <article class="card" aria-labelledby="book-<?php echo (int)$row['id']; ?>">
            <div class="media">
              <img src="image/<?php echo htmlspecialchars($row['image']); ?>" alt="Cover of <?php echo htmlspecialchars($row['title']); ?>">
            </div>
            <div class="body">
              <h2 id="book-<?php echo (int)$row['id']; ?>" class="title"><?php echo "Book Title: " . htmlspecialchars($row['title']); ?></h2>
              <p class="meta"><?php echo "Author: " . htmlspecialchars($row['author']); ?></p>
              <div class="row">
                <p class="meta"><?php echo "ISBN: " . htmlspecialchars($row['isbn']); ?></p>
                <p class="meta"><?php echo "Qty: " . htmlspecialchars($row['quantity']); ?></p>
              </div>
             
            </div>
          </article>
        <?php endwhile; ?>
      </div>
    <?php else: ?>
      <div style="max-width:600px;margin:32px auto;">
        <div class="empty">No books available right now. Check back later.</div>
      </div>
    <?php endif; ?>
  </main>

  <footer>copyright &copy; <?php echo date('Y'); ?> dhanush</footer>
</body>
</html>
