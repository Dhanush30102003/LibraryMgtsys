<?php
session_start();
include "../db.php";
if(isset($_SESSION['user_id'])){
    if($_SESSION['role'] == "admin"){
        if(isset($_GET['transaction_id'])){
            $transaction_id=$_GET['transaction_id'];
        
        if(isset($_POST['submit'])){
            $returndate = $_POST['returndate'];
            $status = $_POST['status'];
            $sql = "UPDATE transactions SET return_date='$returndate',status='$status' WHERE id='$transaction_id'";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
         echo "Error: {$result->error}"; 
        }
        else{
            header("Location: view_transactions.php");
        }  
    }}else{
        header("Location: view_transactions.php");
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
    <title>Library Admin Panel</title>
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    background: #f5f5f5;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.container {
    background: #ffffff;
    width: 380px;
    padding: 25px 30px;
    border-radius: 12px;
    box-shadow: 0px 4px 20px rgba(0,0,0,0.15);
    text-align: center;
    animation: fadeIn 0.4s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

h2 {
    margin-bottom: 20px;
    font-size: 22px;
    color: #333;
}

label {
    font-size: 15px;
    color: #444;
    display: block;
    margin-bottom: 8px;
    text-align: left;
}

input[type="date"] {
    width: 100%;
    padding: 12px;
    margin-top: 5px;
    border: 2px solid #ddd;
    border-radius: 8px;
    font-size: 15px;
    transition: 0.3s;
}

input[type="date"]:focus {
    border-color: #5a67d8;
    outline: none;
    box-shadow: 0px 0px 6px rgba(90,103,216,0.4);
}

input[type="submit"] {
    margin-top: 18px;
    width: 100%;
    background: #4a4aff;
    color: white;
    padding: 12px;
    font-size: 16px;
    font-weight: bold;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.3s;
}

input[type="submit"]:hover {
    background: #3333ff;
    transform: translateY(-2px);
}
.back-btn {
    display: block;              /* forces button to take full line */
    width: fit-content;          /* keeps button width natural */
    margin: 20px auto 0;         /* adds space + centers button */
    padding: 12px 20px;
    background: linear-gradient(45deg, #7d3b3b, #a84a4a);
    color: #fff;
    font-weight: bold;
    border-radius: 10px;
    text-decoration: none;
    font-size: 16px;
    transition: 0.3s ease-in-out;
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
}

.back-btn:hover {
    background: linear-gradient(45deg, #a84a4a, #7d3b3b);
    transform: translateY(-3px);
    box-shadow: 0 6px 15px rgba(0,0,0,0.2);
}




</style>
<body>
   <form action="update_transactions.php?transaction_id=<?php echo $transaction_id; ?>" method = "POST">

    <input type="text" name="returndate" required placeholder="Enter Date(YYYY-MM-DD)">
    <select name="status" id="">
        <option value="borrowed">borrowed</option>
        <option value="returned">returned</option>
    </select>
    <input type="submit" name="submit" value="Update Date">
  
    <div>
<a href="view_transactions.php" class="back-btn">← Back</a>
            
</body>
</html>