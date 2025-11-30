<?php
session_start();
include "../db.php";
if(isset($_SESSION['user_id'])){
    if($_SESSION['role'] == "admin"){
        if(isset($_GET['transaction_id'])){
            $transaction_id=$_GET['transaction_id'];
            
            $sql = "DELETE from transactions WHERE id='$transaction_id'";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
             echo "Error: {$result->error}"; 
            }
        else{
            header("Location: view_transactions.php");
        }  
    
        }}
        
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