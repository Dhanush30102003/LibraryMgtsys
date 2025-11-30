<?php
session_start();
include "../db.php";
if(isset($_SESSION['user_id'])){
    if($_SESSION['role'] == "admin"){
        if(isset($_GET['user_id'])){
            $user_id=$_GET['user_id'];
            
            $sql = "DELETE from users WHERE id='$user_id'";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
             echo "Error: {$result->error}"; 
            }
        else{
            header("Location: manage_users.php");
        }  
    
        }
        else{
            header("Location: manage_users.php");
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