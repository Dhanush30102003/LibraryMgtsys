<?php
session_start();
if(isset($_SESSION['user_id'])){
    if($_SESSION['role'] == "admin"){
        include "../db.php";
        $sql = "SELECT id,name,email,role FROM users where role = 'user'";
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
    /* Back Button Styling */
    .back-btn {
        display: inline-block;
        margin-top: 2px;
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
</head>
<body>
         <a href="dashboard.php" class="back-btn">← Back to DashBoard</a>

<br><br>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>E-mail</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
           
            while( $row=mysqli_fetch_assoc($result)){
               
            ?>
            <tr>
                <td><?php echo "{$row['id']}"?></td>
                <td><?php echo "{$row['name']}"?></td>
                <td><?php echo "{$row['email']}"?></td>
                <td><?php echo "{$row['role']}"?></td>
                <td><a href="deleteuser.php?user_id=<?php echo $row['id'];?>">Delete User</a></td>
                
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="register.php" 
   style="padding:10px 15px; background:#7d3b3b; color:white; border-radius:8px; text-decoration:none;">
   ➕ Add User
</a>
    </div>
    
</body>
</html>