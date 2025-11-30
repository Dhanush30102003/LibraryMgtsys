<?php
session_start();
if(isset($_SESSION['user_id'])){
    if($_SESSION['role'] == "admin"){
        include "../db.php";
        $sql = "SELECT * FROM books";
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


    </style>  
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>ISBN</th>
                <th>Image</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            <?php
           
            while( $row=mysqli_fetch_assoc($result)){
               
            ?>
            <tr>
                <td><?php echo "{$row['title']}"?></td>
                <td><?php echo "{$row['author']}"?></td>
                <td><?php echo "{$row['isbn']}"?></td>
                <td><img src="../image/<?php echo "{$row['image']}"?>"></td>
                <td><?php echo "{$row['quantity']}"?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    
</body>
</html>