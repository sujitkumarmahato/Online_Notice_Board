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

    while($row=mysqli_fetch_assoc($query_run)){
    
        $year=$row['year'];
    }
    $query = "select * from notice order by nid DESC";
    $query_run = mysqli_query($connection,$query);
    $x=1;
    while($row = mysqli_fetch_assoc($query_run)){
      ?>
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><?php echo $x;?><?php echo ". ";?>Subject:-<?php echo $row['title'];?></h5>
         Send By:- <?php echo $row['notice_created_by'];?> <p style="text-align: right;"> <?php echo $row['post_date'];?> <p>
          <hr>
          <p class="card-text"><h6>Message:-</h6></p><p><?php echo $row['message'];?></p>
        </div>
       <p></p><br>
      <?php
      $x++;
     }
    ?>
  </body>
</html>