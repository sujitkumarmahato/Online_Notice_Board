<?php
    $connection = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($connection,"notice_board_db");
    session_start();
    if(isset($_POST['register'])){
    
      $password= $_POST['password'];
      $cpassword= $_POST['cpassword'];
     
      
      if($password===$cpassword){
      $pass=password_hash($password, PASSWORD_DEFAULT);
      $cpass=password_hash($cpassword, PASSWORD_DEFAULT);
      $query =" update student set password='$pass', cpassword='$cpass' where email='$_SESSION[email]' ";
      $query_run = mysqli_query($connection,$query);
      if($query_run){
        if(isset($_SESSION['msg'])){
            $_SESSION['msg']="Password updated successfully";
            header('location: student_login.php');
        }else{
            $_SESSION['msg']="You are Logged out." ;
            header('location: student_login.php');
        }
       }
     }
    else{
        echo "<script>alert('Missmatching Password and Confirm Password');
        window.location.href = 'forget_form.php';
        </script>";
    }
  }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Forget Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header class="header">
        <!-- This is for logo -->
        <div class="left">
            <img src="../img/1.png" alt="">
            <!-- <div>E Learning System</div> -->
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
    <br><br>
    <Section>
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-0">
                                <h2 class="text-center mb-5">Set New Password</h2>

                                <form action="forget_form.php" method="post">


                                    <div class="form-outline mb-4">
                                        <input type="password" name="password" id="password"
                                            placeholder="Enter Your New Password" class="form-control form-control-lg" required />
                                        <!-- <label class="form-label" for="form3Example4cg">Password</label> -->
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="password" name="cpassword" id="cpassword"
                                            placeholder="Enter Confirm Password" class="form-control form-control-lg" required />
                                        <!-- <label class="form-label" for="form3Example4cdg">Repeat your password</label> -->
                                    </div>


                                    <div class="d-flex justify-content-center">
                                        <button type="submit"
                                            class="btn btn-success btn-block btn-lg gradient-custom-4 text-body" id="register" name="register" >Update Password</button>
                                    </div>

                                    <p class="text-center text-muted mt-1 mb-0">Have already an account? <a href="student_login.php"
                                            class="fw-bold text-body"><u>Login here</u></a></p>
                                    <br>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Section>
    <br><br>
</body>

</html>