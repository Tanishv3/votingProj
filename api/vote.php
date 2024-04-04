<?php
session_start();
include("connect.php");

// Check if 'gvotes' and 'gid' are set in the POST request
if(isset($_POST['gvotes'], $_POST['gid'], $_SESSION['userdata']['id'])) {
    $votes = $_POST['gvotes'];
    $totalvotes = $votes + 1;

    $gid = $_POST['gid'];
    $uid = $_SESSION['userdata']['id'];

    // Update votes for the specified group
    $update_votes = mysqli_query($connect, "UPDATE users SET votes = '$totalvotes' WHERE id = '$gid'");

    // Update user status
    $update_user_status = mysqli_query($connect, "UPDATE users SET status = 1 WHERE id = '$uid'");

    if($update_votes && $update_user_status) {
        $groups = mysqli_query($connect, "SELECT * FROM users WHERE role = 2");
        $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);

        // Update session data
        $_SESSION['userdata']['status'] = 1;
        $_SESSION['groupsdata'] = $groupsdata; 

        // Redirect with success message
        echo "<script>
            alert('Voting successful');
            window.location = '../routes/dashboard.php';
            </script>";
    } else {
        // Redirect with error message
        echo "<script>
            alert('Some error occurred');
            window.location = '../routes/dashboard.php';
            </script>";
    }
} else {
    // Redirect with error message if 'gvotes' or 'gid' is not set
    echo "<script>
        alert('Invalid request');
        window.location = '../routes/dashboard.php';
        </script>";
}
?>
