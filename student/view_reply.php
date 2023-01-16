


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <br>
    <center><h3>Notices for you</h3></center><br>
    <?php
    session_start();
    $connection = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($connection,"notice_board_db");
    $email=$_SESSION['email'];
    $query="select * from student where email= '$email' ";
    $query_run=mysqli_query($connection,$query);

    $year="";
    $department="";
    while($row=mysqli_fetch_assoc($query_run)){
        $department=$row['department'];
        $year=$row['year'];
        
    }
    $query = "select * from reply where reply_by ='$email' or reply_to='$email' or reply_to= 'Everyone' ";
    $query_run = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($query_run)){
      $_SESSION['reply_to']=$email;
      $_SESSION['nid']=$row['notice_id'];
      ?>
      <form action="" method="POST">  
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Subject:-<?php echo $row['message'];?></h5>
         Notice By:- <?php echo $row['reply_by'];?> <p style="text-align: right;"> <?php echo $row['date'];?> <p>
          <hr>
          <p class="card-text"><h6>Message:-</h6></p><p><?php echo $row['message'];?></p>
        </div>
        
      <?php
     }
    ?>
    </form>
  </body>
</html>