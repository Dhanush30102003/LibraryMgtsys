<?php
    session_start();
     include "db.php";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    if($result->num_rows>0){
        $row=mysqli_fetch_assoc($result);
        if($row['password'] == $password){
          $_SESSION['user_id'] = $row['id'];
          $_SESSION['role'] = $row['role'];
          if($row['role'] == 'admin'){
            header("Location: admin/dashboard.php");
            exit();
             }
          else{
            header("Location: dashboard.php");
            exit();
          } }
        else{
            header("Location: login.php");
            exit();
        }}
    else{
       echo "error!: " . mysqli_error($conn);


    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include "heading.php"; ?>
<body >
    <div class="register">
    <form action="login.php" method="post">
   
    <input type="email" name="email"  placeholder="Enter Your Email"><br>
    <input type="password" name="password"  placeholder="Enter Your Password"><br>
   
    <button type="submit">sign up</button>
    </form>
    </div>
</body>
</html>
