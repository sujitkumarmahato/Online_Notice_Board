<?php
session_start();
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection,"notice_board_db");
$email=$_SESSION['email'];
$query="select * from teacher where email= '$email' ";
$query_run=mysqli_query($connection,$query);
$name="";
$department="";
while($row=mysqli_fetch_assoc($query_run)){
    $name=$row['name'];
    $department=$row['department'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
<br>
      <center><h3>Update Your Profile</h3></center>
      <br>
    <form action="" method="POST">
        <div class="form-group">
            <label>Name:</label>
            <input type="text" class="form-control" name="name" value="<?php echo $name;?>">
        </div>
        <div class="form-group">
            <label>Department:</label>
            <select id="dept" name="department" class="form-control">
                <option value="<?php echo $department;?>"><?php echo $department;?></option>
                <option value="Computer Sceience And Engineering">Computer Sceience And Engineering </option>
                <option value="Information Technology">Information Technology</option>
                <option value="Mechanical Engineering">Mechanical Engineering</option>
                <option value="Biotechnology">Biotechnology</option>
                <option value="Electronics & Communication Engineering">Electronics & Communication Engineering</option>
                <option value="Electrical Engineering">Electrical Engineering</option>
                <option value="Applied Electronics & Instrumentation Engineering">Applied Electronics & Instrumentation Engineering</option>
                <option value="Chemical Engineering">Chemical Engineering</option>
                <option value="Civil Engineering">Civil Engineering</option>
            </select>
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="email" class="form-control" name="email" value="<?php echo $email;?>" >
        </div> 
        <button type="submit" name="update_profile" class="btn btn-primary">Update</button>
</form>
</body>
</html>