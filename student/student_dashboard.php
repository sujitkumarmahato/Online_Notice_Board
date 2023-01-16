<?php
 session_start();
 $connection = mysqli_connect("localhost","root","");
 $db = mysqli_select_db($connection,"notice_board_db");
if(isset($_POST['update_profile'])){
  $query = "update student set department='$_POST[department]',year=$_POST[year],name='$_POST[name]',roll=$_POST[roll],email='$_POST[email]' where email='$_SESSION[email]'";
  $query_run = mysqli_query($connection,$query);
  if($query_run){
    echo "<script type='text/javascript'>
    alert('Profile Updated successfully...');
    window.location.href = 'student_dashboard.php'
    </script>";
  }
  else{
    echo "<script type='text/javascript'>
    alert('Can't update try again...');
    window.location.href = 'student_dashboard.php'
    </script>";
  }
}

if(isset($_POST['send_reply'])){
  $email=$_SESSION['email'];
  $nid=$_SESSION['nid'];
  $email_to=$_SESSION['reply_to'];
  $reply_to=$_POST['to_which'];
  $val=$_POST['send_reply'];
  date_default_timezone_set("Asia/Kolkata");
  $date = date('Y-m-d h:i:s a', time());
  $query = "insert into reply values(null, '$email', '$reply_to', '$date', '$_POST[message]', $nid)";
  $query_run = mysqli_query($connection,$query);
  if($query_run){
    echo "<script>alert('Reply Send Successfully...');
    window.location.href = 'student_dashboard.php';
    </script>";
  }
  else{
    echo "<script>alert('Please try again');
    window.location.href = 'student_dashboard.php';
    </script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
   
<!-- Bootstrap files -->
<script src="bootstrap-4.4.1/js/bootstrap.min.js" charset="utf-8"></script>
    <link rel="stylesheet" type="text/css" href="bootstrap-4.4.1/css/bootstrap.min.css">
    <!-- CSS File -->
    <link rel="stylesheet" href="css/style.css">
    <script src="jQuery/juqery_latest.js" charset="utf-8"></script>

    <script type="text/javascript">
      $(document).ready(function(){
        $("#edit_profile_button").click(function(){
          $("#main_content").load('edit_profile.php');
        });

        $("#view_notice_button").click(function(){
          $("#main_content").load('view_notice.php');
        });

        $("#view_reply_button").click(function(){
          $("#main_content").load('view_reply.php');s
        });

        $("#view_students_button").click(function(){
          $("#main_content").load('view_students.php');s
        });

      });
    </script>

</head>
<body>
    <header class="header" style="background-color:rgb(80, 134, 250)">
        <!-- This is for logo -->
        <div class="left">
         <img src="../img/1.png" alt="">
        </div>
        <!-- This is for navbar -->
        <div class="mid">
         <ul class="navbar">
             <li><a href="../index.html">Home</a></li>
             <li><a href="../about.html">About us</a></li>
             <li><a href="../contact_us.html">Contact us</a></li>
         </ul>
        </div>
    </header>  
    
    <section id="container">
      <div class="row">
      
        <div class="col-md-2" id="left_sidebar">
        <br><br><br>
          <center><img src="../img/icon.png" class="img-rounded" width="150px" height="150px"><br>
          <b><?php echo $_SESSION['name'];?></b></center><hr>
          <button type="button" class="btn btn-primary btn-block" id="edit_profile_button">Edit Profile</button>
          <button type="button" class="btn btn-warning btn-block" id="view_notice_button">View All Notices</button>
          <button type="button" class="btn btn-secondary btn-block" id="view_reply_button">View All Replies</button>
          <button type="button" class="btn btn-primary btn-block" id="view_students_button">View Students</button>
          <a href="logout.php" type="button" class="btn btn-success btn-block">Logout</a><br>
        </div>
        <div class="col-md-8" id="main_content">
        <br><br><br>
          <h2>Welcome to Students Dashboard</h2>
          <p>
          This is the Student Dashboard page. Here Student can manage his profile. He can view notice send by teacher, and also students can reply to the Teacher and student can logout by using Logout function</p>
          
        </div>
      </div>
    </section>
</body>
</html>
