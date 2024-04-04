<?php
    $connect = mysqli_connect("localhost", "root", "", "projvoting");
    
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $cpassword = isset($_POST['cpassword']) ? $_POST['cpassword'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    
    // Handle file upload if 'photo' is set in $_FILES array
    $photo = '';
    if (isset($_FILES['photo']['tmp_name']) && !empty($_FILES['photo']['tmp_name'])) {
        $photo = $_FILES['photo']['tmp_name'];
    }
    
    $role = isset($_POST['role']) ? $_POST['role'] : '';
   
    if($password == $cpassword)
    {
        // Move uploaded file to destination directory
        $image = $_FILES['photo']['name'];
        move_uploaded_file($_FILES['photo']['tmp_name'], "../uploads/$image");
        
        // Prepare SQL query
        $query = "INSERT INTO users (name, mobile, password, address, photo, role, status, votes) VALUES ('$name', '$mobile', '$password', '$address', '$image', '$role', 0, 0)";
        
        // Execute query
        $insert = mysqli_query($connect, $query);
        
        if($insert){
            echo  "
            <script>
            alert ('Successful!');
            window.location = '../'
            </script>";
        } else {
            echo  "
            <script>
            alert ('Failed!');
            window.location = '../routes/register.html'
            </script>";
        }
    } else {
       echo  "
       <script>
       alert ('Password and confirm password do not match!');
       window.location = '../routes/register.html'
       </script>";
    }
?>
