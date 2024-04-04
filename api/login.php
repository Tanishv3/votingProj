<?php
session_start();
    include("connect.php");
    
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $role = isset($_POST['role']) ? $_POST['role'] : '';

    $check = mysqli_query($connect,"select * from users where mobile='$mobile' and password ='$password' and role='$role'");  

    if(mysqli_num_rows($check)>0){
        $userdata= mysqli_fetch_array($check);
        $groups = mysqli_query($connect,"select * from users where role =2");
        $groupsdata = mysqli_fetch_all($groups,MYSQLI_ASSOC);

        $_SESSION['userdata']=$userdata;
        $_SESSION['groupsdata']=$groupsdata;     
        
        echo  "
       <script>
       window.location = '../routes/dashboard.php';
       </script>";

    }
    else{
        echo  "
       <script>
       alert ('User Not Found');
       window.location = '../';
       </script>";
    }
?>