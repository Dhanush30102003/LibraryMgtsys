<?php
session_start();
if(isset($_SESSION['user_id'])){
    if($_SESSION['role'] == "admin"){
        if($_SERVER['REQUEST_METHOD']== "POST"){
            $title = $_POST['title'];
            $author = $_POST['author'];     
            $isbn = $_POST['isbn'];
            $image = $_FILES['image']['name'];
            $quantity = $_POST['quantity'];
            include "../db.php";
            $sql="INSERT INTO books (title, author, isbn, image, quantity) VALUES ('$title', '$author', '$isbn', '$image', '$quantity')";
            $result=mysqli_query($conn, $sql);

            if(!$result){
                echo "Error:{conn->error}";
            }
            else{
                $image_location=$_FILES['image']['tmp_name'];
                $upload_location="../image/";
                move_uploaded_file($image_location,  $upload_location.$image);
                echo "Book added successfully";
            }
        }
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
        .admin{
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 60px;
        }

        .adminbox{
            width: 400px;
        }

        .admin input{
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
        }

        .adminbox label {
            display: block;
            font-size: 18px;
            margin-bottom: 6px;
            font-weight: bold;
            color: #4b1c3d;
        }

        /* NEW STYLED BUTTON */
        .admin button {
            width: 100%;
            padding: 14px;
            background: linear-gradient(45deg, #7d3b3b, #a84a4a);
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s ease;
            letter-spacing: 0.5px;
            margin-top: 10px;
        }

        .admin button:hover {
            background: linear-gradient(45deg, #a84a4a, #7d3b3b);
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.2);
        }

        /* Back Button Styling */
        .back {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 20px;
            background: #4b1c3d;
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
    <div class="admin">
        <div class="adminbox">

            <form action="add_book.php" method="POST" enctype="multipart/form-data">

                <label>Title:</label>
                <input type="text" name="title" placeholder="Enter the Title">

                <label>Author:</label>
                <input type="text" name="author" placeholder="Enter the Author name">

                <label>ISBN:</label>
                <input type="text" name="isbn" placeholder="Enter the ISBN">

                <label>Image:</label>
                <input type="file" name="image">

                <label>Quantity:</label>
                <input type="text" name="quantity" placeholder="Enter the QUANTITY">

                <button type="submit">Add Book</button>
            </form>

        </div>

       <a class="back" href="dashboard.php">Back to Admin Dashboard</a>

    </div>
</body>
</html>
