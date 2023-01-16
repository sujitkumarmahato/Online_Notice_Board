<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <br>
    <center><h3>List of Students</h3></center><br>
    <?php
    session_start();
    $connection = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($connection,"notice_board_db");
    $email=$_SESSION['email'];
    ?>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">S. No</th>
      <th scope="col">Name</th>
      <th scope="col">Department</th>
      <th scope="col">Year</th>
      <th scope="col">Roll No</th>
    </tr>
  </thead>
  
  <?php
   $i=1;
    $query="select * from student";
    $query_run=mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($query_run)){
      $name=$row['name'];
      //$department=$row['department'];
      //$year=$row['year'];
      //$roll=$row['roll'];

      ?>

      <tbody>
      <tr>
      <th ><?php echo $i++; ?></th>
      <td><?php echo $name;?></td>
      <td><?php echo $row['department'];?></td>
      <td><?php echo $row['year'];?></td>
      <td><?php echo $row['roll'];?></td>
     </tr>

      <?php
     }
    ?>
    </tbody>
    </table>
  </body>
</html>