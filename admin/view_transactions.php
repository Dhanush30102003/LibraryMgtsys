<?php
session_start();
include "../db.php";
if(isset($_SESSION['user_id'])){
    if($_SESSION['role'] == "admin"){
        include "../db.php";
        $sql = "SELECT * FROM transactions";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
         echo "Error: {$result->error}"; 
        }
        else{

        }  
    }
    else{
        header("Location: ../dashboard.php");
        exit();
    }
}
else{
    header("Location: ../login.php");
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library</title>
    <style>
        table {
    width: 100%;
    border-collapse: collapse;
    margin: 30px auto;
    background: #ffffff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

thead tr {
    background: linear-gradient(45deg, #7d3b3b, #a84a4a);
    color: #fff;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-size: 14px;
}

th {
    padding: 14px;
    font-weight: bold;
    text-align: left;
}

tbody tr {
    transition: 0.3s ease;
}

tbody tr:hover {
    background-color: #ffe9e9;
    transform: scale(1.01);
}

td {
    padding: 12px 14px;
    border-bottom: 1px solid #f0caca;
    background-color: #fff;
    font-size: 15px;
    color: #333;
}

td img {
    width: 60px;
    height: 80px;
    object-fit: cover;
    border-radius: 8px;
    border: 2px solid #e6b3b3;
}
a.update, a.delete {
  display: inline-block;
  padding: 6px 10px;
  text-decoration: none;
  color: #ffffff;
  font-weight: 600;
  border-radius: 6px;
  transition: transform .12s ease, opacity .12s ease;
}

/* choose clearer colors (6-digit hex) */
a.update { background: #1ba20cff; }   /* blue */
a.update:hover { transform: translateY(-2px); opacity: 0.95; }

a.delete { background: #b10000; }   /* red */
a.delete:hover { transform: translateY(-2px); opacity: 0.95; }

  /* Back Button Styling */
        .back {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 20px;
            background: #862727ff;
            color: #fff;
            font-weight: bold;
            border-radius: 8px;
            text-decoration: none;
            transition: 0.3s ease;
        }

        .back:hover {
            background: #6d2c56;
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.2);
        }
    </style>  
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>Book ID</th>
                <th>Issue Date</th>
                <th>Return Date</th>
                <th>Status</th>
                 <th>Action</th>
                <th>action</th>

            </tr>
        </thead>
        <tbody>
            <?php
           
            while( $row=mysqli_fetch_assoc($result)){
               
            ?>
            <tr>
                <td><?php echo "{$row['user_id']}"?></td>
                <td><?php echo "{$row['book_id']}"?></td>
                <td><?php echo "{$row['issue_date']}"?></td>
                <td><?php echo "{$row['return_date']}"?></td>
                <td><?php echo "{$row['status']}"?></td>
                <td><a href="update_transactions.php?transaction_id=<?php echo $row['id'];?>" class="update">Update</a></td>
                <td><a href="delete_transactions.php?transaction_id=<?php echo $row['id'];?>" class="delete">Delete</a></td>
               
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <div>
          <a class="back" href="dashboard.php">Back to Admin Dashboard</a>
            </div>
</body>
</html>