<?php

    session_start();
    if(!isset($_SESSION['userdata']))
    {
        header("location:../");
    }

    $userdata=$_SESSION['userdata'];
   $groupsdata=$_SESSION['groupsdata'];

   if($_SESSION['userdata']['status']==0)
   {
        $status='<b style="color:red">Not voted</b>';
   }
   else
   {
       $status='<b style="color:green">voted</b>';
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Online voting system - Dashboard</title>
    <link rel="stylesheet" href="../css/stylesheet.css">
</head>
<body>

    <style>
        #backbtn
        {
            float: left;
            padding: 5px;
            font-size: 15px;
            background-color: #101213;
            color: white;
            border-radius: 5px;
        }

        #logoutbtn
        {
            float: right;
            
            padding: 5px;
            font-size: 15px;
            background-color: #09131a;
            color: white;
            border-radius: 5px;
        }
        h1{
            font-family: cursive;
        }
        #Profile
        {
            background-color: white;
            width: 30%;
            padding: 20px;
            float: left;
        }
        #Group
        {
            background-color:white;
            width: 60%;
            padding: 20px;
            float: right;
        }
        #votebtn
        {
            
            padding: 5px;
            font-size: 15px;
            background-color: #09131a;
            color: white;
            border-radius: 5px;
        }
        #mainpanel
        {
            padding: 10px;
        }
        #headersection
        {
            padding: 10px;
        }
        #voted
        {
            padding: 5px;
            font-size: 15px;
            background-color:green;
            color: white;
            border-radius: 5px;
        }
    </style>

    <div id="mainSection">
        <center>
    <div id="headersection">
    <a href="../"><button id="backbtn"></a>Back</button>
    <a href="../routes/logout.php"><button id="logoutbtn"></a>Logout</button>
    <h1>Online voting system </h1>
    </div>
    </center>
    <hr>
    <div id="mainpanel">
    <div id="Profile">
       <center> <img src="../uploads/<?php echo $userdata['photo'] ?>" height="100" width="100"></center><br><br>
        <b>Name:</b><?php echo $userdata['name']?><br><br>
        <b>Mobile:</b><?php echo $userdata['mobile']?><br><br>
        <b>Address:</b><?php echo $userdata['address']?><br><br>
        <b>Status:</b><?php echo $status?><br><br>
    </div>


    <div id="Group">
        

        <?php
            if(($_SESSION['groupsdata']))
            {
                for($i=0; $i<count($groupsdata); $i++)
                {
                    ?>
                        <div>
                            <img style="float:right" src="../uploads/<?php echo $groupsdata[$i]['photo']?>" height="100" width="100">
                            <b>Groupname: </b><?php echo $groupsdata[$i]['name']?><br><br>
                            <b>votes: </b><?php echo $groupsdata[$i]['votes']?><br><br>
                            <form action="../api/vote.php" method="POST">
                                <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes']?>">
                                <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id']?>">
                                <?php
                                    if($_SESSION['userdata']['status']==0)
                                    {
                                            ?>

                                                <input type="submit" name="votebtn" value="Vote" id="votebtn">
                                            <?php
                                    }
                                    else
                                    {
                                        ?>

                                                <button disabled type="button" name="votebtn" value="Vote" id="voted">Voted</button>
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