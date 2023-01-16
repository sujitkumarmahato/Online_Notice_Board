<?php
 session_start();
 $connection = mysqli_connect("localhost","root","");
 $db = mysqli_select_db($connection,"notice_board_db");
if(isset($_POST['update_profile'])){
  $query = "update teacher set name='$_POST[name]', department='$_POST[department]', email='$_POST[email]' where email= '$_SESSION[email]' ";
  $query_run = mysqli_query($connection,$query);
  if($query_run){
    echo "<script type='text/javascript'>
    alert('Profile Updated successfully...');
    window.location.href = 'teacher_dashboard.php'
    </script>";
  }
  else{
    echo "<script type='text/javascript'>
    alert('Can't update try again...');
    window.location.href = 'teacher_dashboard.php'
    </script>";
  } 
}

if(isset($_POST['send_notice'])){
  $email= $_SESSION['email'];
  $department=$_POST['department'];
  $year=$_POST['to_whom'];
  $subject=$_POST['subject'];
  $message=$_POST['message'];
 
  date_default_timezone_set("Asia/Kolkata");
  $date = date('Y-m-d h:i:s a', time());
  $query = "insert into notice values(null, '$_SESSION[email]', '$date', '$year', '$department', '$subject', '$message' )";
  $query_run = mysqli_query($connection,$query);
  if($query_run){
    echo "<script>alert('Notice Created Successfully...');
    window.location.href = 'teacher_dashboard.php';
    </script>";
  }
  else{
    echo "<script>alert('Please try again');
    window.location.href = 'teacher_dashboard.php';
    </script>";
  }
}

if(isset($_POST['send_reply'])){
  $email=$_SESSION['email'];
  $department=$_POST['department'];
  $year=$_POST['year'];
  $val=$_POST['send_reply'];
  date_default_timezone_set("Asia/Kolkata");
  $date = date('Y-m-d h:i:s a', time());
  $query = "insert into notice values(null, '$email', '$date', '$department', $year, '$_POST[title]','$_POST[message]')";
  $query_run = mysqli_query($connection,$query);
  if($query_run){
    echo "<script>alert('Notice Created Successfully...');
    window.location.href = 'teacher_dashboard.php';
    </script>";
  }
  else{
    echo "<script>alert('Please try again');
    window.location.href = 'teacher_dashboard.php';
    </script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
   
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

        $("#create_notice_button").click(function(){
          $("#main_content").load('create_notice.php');
        });

        $("#view_own_button").click(function(){
          $("#main_content").load('view_own_notice.php');
        });

        $("#view_notice_button").click(function(){
          $("#main_content").load('view_all_notice.php');
        });

        $("#view_reply_button").click(function(){
          $("#main_content").load('view_all_reply.php');
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
          <button type="button" class="btn btn-secondary btn-block" id="create_notice_button">Create a Notice</button>
          <button type="button" class="btn btn-primary btn-block" id="view_own_button">View Own Notices</button>
          <button type="button" class="btn btn-warning btn-block" id="view_notice_button">View All Notices</button>
          <button type="button" class="btn btn-secondary btn-block" id="view_reply_button">View All Replies</button>
          <button type="button" class="btn btn-primary btn-block" id="view_students_button">View Students</button>
          <button type="button" class="btn btn-warning btn-block" id="edit_profile_button">Edit Profile</button>
          <a href="logout.php" type="button" class="btn btn-success btn-block">Logout</a><br>
        </div>
        <div class="col-md-8" id="main_content">
        <br><br><br>
          <h2>Welcome to Teachers Dashboard</h2>
          <p>
          This is the Teacher Dashboard page. Here Teacher can sent Notice to the students and manage his profile. He can view reply send by student, and also teacher can reply to the students and teacher can logout by using Logout function</p>
          
        </div>
      </div> 
    </section>
</body>
</html>
