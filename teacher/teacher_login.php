<?php
     session_start();
    $connection = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($connection,"notice_board_db");
  
    if(isset($_POST['login'])){
        $password=$_POST['password'];
      $query = "select * from teacher where email='$_POST[email]' and status='active' ";
      $query_run = mysqli_query($connection,$query);
      if(mysqli_num_rows($query_run)){
        while($row=mysqli_fetch_assoc($query_run)){
            $_SESSION['name']=$row['name'];
            $_SESSION['email']=$_POST['email'];
            if(password_verify($password, $row['password'])){
            echo "<script> 
            window.location.href='teacher_dashboard.php';
            </script>";
            }
            else{
                echo "<script>alert('Please Enter correct Password');
                 window.location.href = 'teacher_login.php';
                   </script>";
            }
        }
      }
      else{
        echo "<script>alert('Please Enter correct email and password');
        window.location.href = 'teacher_login.php';
        </script>";
      }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Login page</title>
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
        <!-- This is for buttons -->

    </header>
    <br><br>
    <Section>
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-0">
                                <h2 class="text-center mb-5">Login Your Account</h2>
                                <div>
                                    <p class="bg-success text-white px-4"> <?php 
                                    if(isset($_SESSION['msg'])){
                                        echo $_SESSION['msg'] ;
                                    }
                                    else{
                                        echo $_SESSION['msg']="You are logged Out. Please login again" ;
                                    }
                                    ?> </p>
                                </div>
                                <form action="teacher_login.php" method="POST">

                                    <div class="form-outline mb-4">
                                        <input type="email" name="email" id="email" placeholder="Enter Your Email Id"
                                            class="form-control form-control-lg" required/>
                                        <!-- <label class="form-label" for="form3Example3cg">Your Email</label> -->
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="password" name="password" id="password"
                                            placeholder="Enter Your Password" class="form-control form-control-lg" required/>
                                        <!-- <label class="form-label" for="form3Example4cg">Password</label> -->
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <button type="submit"
                                            class="btn btn-success btn-block btn-lg gradient-custom-4 text-body" name="login" id="login">Sign
                                            In</button>
                                    </div>

                                    <p class="text-center text-muted mt-1 mb-2">If You have no account <a href="teacher_signup.php"
                                            class="fw-bold text-body">Register here </a> | <a href="forget.php">Forget Password</a></p>
                                        <br>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Section>
</body>

</html>