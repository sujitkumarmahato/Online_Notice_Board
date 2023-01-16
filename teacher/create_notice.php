<?php
session_start();
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection,"notice_board_db");
$email=$_SESSION['email'];

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Create Notice</title>
  </head>
  <body>
    <br>
      <center><h3>Create a Notice</h3></center>
      <br>
      <div>
        <form action="teacher_dashboard.php" method="post">

        <div class="form-group">
        <label>Select Department to send notice:</label>
          <select id="dept" name="department" class="form-control">
            <option value="None">Select Your Department</option>
            <option value="Computer Sceience And Engineering">Computer Sceience And
                Engineering
            </option>
            <option value="Information Technology">Information Technology</option>
            <option value="Mechanical Engineering">Mechanical Engineering</option>
            <option value="Biotechnology">Biotechnology</option>
             <option value="Electronics & Communication Engineering">Electronics &
                Communication
                Engineering
            </option>
            <option value="Electrical Engineering">Electrical Engineering</option>
            <option value="Applied Electronics & Instrumentation Engineering">Applied
               Electronics &
                Instrumentation Engineering</option>
             <option value="Chemical Engineering">Chemical Engineering</option>
            <option value="Civil Engineering">Civil Engineering</option>
           </select>
        </div>
          <div class="form-group">
              <label>To Whom:</label>
              <select class="form-control" name="to_whom">
                <option>To All</option>
                <option>To Year 1</option>
                <option>To Year 2</option>
                <option>To Year 3</option>
                <option>To Year 4</option>
              </select>
          </div>
          <div class="form-group">
            <label>Subject:</label>
            <input type="text" class="form-control" name="subject" placeholder="Enter Subject">
          </div>
          <div class="form-group">
            <label>Message:</label>
            <textarea name="message" rows="8" cols="80" class="form-control" placeholder="Type your message..."></textarea>
          </div>
          <button type="submit" class="btn btn-primary"name="send_notice">Send Notice</button>
        </form>
      </div>
  </body>
</html>
