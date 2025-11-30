<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = (int) $_SESSION['user_id'];

// Fetch transactions for this user
$stmt = mysqli_prepare($conn, "
    SELECT t.id, t.book_id, t.issue_date, t.status, b.title, b.author, b.isbn
    FROM transactions t
    JOIN books b ON t.book_id = b.id
    WHERE t.user_id = ?
    ORDER BY t.issue_date DESC
");
if (!$stmt) {
    echo "DB error: " . htmlspecialchars(mysqli_error($conn));
    exit();
}
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $tid, $book_id, $issue_date, $status, $title, $author, $isbn);

$rows = [];
while (mysqli_stmt_fetch($stmt)) {
    $rows[] = [
        'tid' => $tid,
        'book_id' => $book_id,
        'issue_date' => $issue_date,
        'status' => $status,
        'title' => $title,
        'author' => $author,
        'isbn' => $isbn,
    ];
}
mysqli_stmt_close($stmt);
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>My Borrowed Books</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <style>
        body { font-family: Arial, sans-serif; margin:20px; background:#f4f7fb; color:#222; }
        .container { max-width:1000px; margin:0 auto; }
        h1 { color:#333; }
        table { width:100%; border-collapse:collapse; background:#fff; box-shadow:0 6px 18px rgba(20,20,30,0.06); border-radius:8px; overflow:hidden; }
        th, td { padding:12px 14px; text-align:left; border-bottom:1px solid #eef2f6; }
        th { background:#fafcff; font-weight:700; color:#333; }
        tr:last-child td { border-bottom: none; }
        .status { padding:6px 10px; border-radius:8px; font-weight:700; display:inline-block; }
        .status.borrowed { background:#fff3e6; color:#9a5b00; }
        .status.returned { background:#e7f9ee; color:#0d7a3b; }
        .back { display:inline-block; margin-top:12px; text-decoration:none; padding:8px 12px; border-radius:8px; background:#4b1c3d; color:#fff; }
        .empty { padding:24px; background:#fff; border-radius:8px; box-shadow:0 6px 18px rgba(20,20,30,0.06); text-align:center; }
    </style>
</head>
<body>
<div class="container">
    <h1>My Borrowed Books</h1>

    <?php if (count($rows) === 0): ?>
        <div class="empty">
            You have no borrowed books right now.
        </div>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Book</th>
                    <th>Author</th>
                    <th>ISBN</th>
                    <th>Issue Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $i => $r): ?>
                    <tr>
                        <td><?php echo $i + 1; ?></td>
                        <td><?php echo htmlspecialchars($r['title']); ?></td>
                        <td><?php echo htmlspecialchars($r['author']); ?></td>
                        <td><?php echo htmlspecialchars($r['isbn']); ?></td>
                        <td><?php echo htmlspecialchars($r['issue_date']); ?></td>
                        <td>
                            <?php
                                $cls = ($r['status'] === 'returned') ? 'returned' : 'borrowed';
                                echo '<span class="status ' . $cls . '">' . htmlspecialchars(ucfirst($r['status'])) . '</span>';
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <a class="back" href="index.php">Back to Home</a>
</div>
</body>
</html>
