


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
    $query = "select * from notice where to_whom = 'To All' OR to_whom = 'To Year $year' and which_department='$department' ";
    $query_run = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($query_run)){
      $_SESSION['reply_to']=$row['notice_created_by'];
      $_SESSION['nid']=$row['nid'];
      ?>
      <form action="" method="POST">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Subject:-<?php echo $row['title'];?></h5>
         Notice By:- <?php echo $row['notice_created_by'];?> <p style="text-align: right;"> <?php echo $row['post_date'];?> <p>
          <hr>
          <p class="card-text"><h6>Message:-</h6></p><p><?php echo $row['message'];?></p>
        </div>
        <div class="form-group">
            <textarea name="message" rows="4" cols="80" class="form-control" placeholder="Type your message..."></textarea>
          </div>
          <div class="form-group">
         <label>Reply To:</label>
             <select id="to_which" name="to_which"  class="form-control">
                 <option value="Everyone">Everyone</option>
                 <option value="<?php echo $row['notice_created_by'];?>"><?php echo $row['notice_created_by'];?></option>
                

             </select>
        </div> 
      </div>
      <p style="text-align: right;">
      <button type="submit" class="btn btn-primary" id="send_reply" name="send_reply" style="text-align: right;">Submit Your Reply</button></p>
      <br>
      <?php
     }
    ?>
    </form>
  </body>
</html>