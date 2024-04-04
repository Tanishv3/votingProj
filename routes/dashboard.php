<?php
session_start();
if (!isset($_SESSION['userdata'])) {
    header("Location: ../");
    exit; // Exit the script to ensure further code is not executed
}
$userdata = $_SESSION['userdata'];
$groupsdata = $_SESSION['groupsdata'];

    if($userdata['status']==0){
        $status =' <b style="color:red"> Not Voted</b>';
    }
    else{
        $status =' <b style="color:Green">Voted</b>';
    }
?>

<html>
    <head>
        <title>Online voting System</title>
        <link rel="stylesheet" href="../css/dashboard.css">
    </head>
    <body>
        <style>
            #backbtn{
                padding: 5px;
                border-radius: 5px;
                background-color: #3498db;
                color: white;
                border-radius: 5px;
                float:left;
                margin: 10px;
            }

            #loginbtn{
                padding: 5px;
                border-radius: 5px;
                background-color: #3498db;
                color: white;
                border-radius: 5px;
                float: right;
                margin: 10px;
            }
            #profile{
                background-color: aquamarine;
                width: 30%;
                padding: 20px;
                float: left;
            }
            #Groups{
                background-color: aquamarine;
                width: 60%;
                padding: 10px;
                float: right;
            }
            #mainpannel{
                padding: 10px;
            }
            #votebtn{
                padding: 5px;
                font-size: 15px;
                background-color: #3498db;
                color: white;
                border-radius: 5px;
            }
            
            #Voted{
                padding: 5px;
                font-size: 15px;
                background-color: green;
                color: white;
                border-radius: 5px;
            }
         </style> 

<div id="mainsection">
    <center>
        <div id="headersection">
        <a href="../login.html"><button id="backbtn">  Back</button></a>
        <a href="../index.html"> <button id="logoutbtn">LogOut</button></a>
            <h1>Online Voting System</h1>
        </div>
        </center>
        <hr>
            <div id="mainpannel">
            <div id="Profile">
           <center> <img src="../uploads/<?php echo $userdata['photo'] ?>" height="100" width="100"><br><br></center>
            <b>Name:</b> <?php echo $userdata['name'] ?>  <br><br>
            <b>mobile:</b><?php echo $userdata['mobile'] ?><br><br>
            <b>address:</b><?php echo $userdata['address'] ?><br><br>
            <b>status:</b><?php echo $status?><br><br>
        </div>
        <div id="Groups">
            <?php 
                if($_SESSION['groupsdata']){
                    for($i=0;$i<count($groupsdata);$i++){
                        ?>
                        <div>
                            <img style="float: right;" src="../uploads/<?php echo $groupsdata[$i]['photo']  ?>" height="100" width="100"><br><br>
                            <b>Group Name:</b> <?php echo $groupsdata[$i]['name']?><br><br>
                            <b>Votes:</b><?php echo $groupsdata[$i]['votes']?><br><br>
                            <form action="../api/vote.php" method="POST">
                            <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes'] ?>">
                            <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id'] ?>">
                            <?php 
                             if($_SESSION['userdata']['status']==0){
                                ?>
                                <input type="submit" name="votebtn" value="Vote" id="votebtn">
                                <?php
                             }
                             else{
                                ?>
                                <button disabled type="button" name="votebtn" value="Vote" id="Voted"></button>
                                <?php
                             }
                            ?>
                            
                            
                        </form>
                        </div>
                        <hr>
                        <?php
                    }
                }
                else{

                }
            ?>

        </div>
            </div>
            </div>
    </body>
</html>