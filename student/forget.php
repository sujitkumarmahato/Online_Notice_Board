<?php
    session_start();
    $connection = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($connection,"notice_board_db");
  
    if(isset($_POST['forget'])){
      $password=$_POST['password'];
      $query = "select * from student where email='$_POST[email]' and status='active' ";
      $query_run = mysqli_query($connection,$query);
      $_SESSION['email']= $_POST['email'];
      $name=$_POST['name'];
      $token=$_POST['token'];
      $email=$_POST['email'];
      if(mysqli_num_rows($query_run)){
            $subject = "Forget password Link";
            $body = "Hi, $name, Click here to set a new password http://localhost/Project/Online%20Notice%20Board/student/forget_form.php?token=$token";
            $headers = "From: sujit.kumarmahato.cse21@heritageit.edu.in";

            if (mail($email, $subject, $body, $headers)) {
                $_SESSION['msg']="Check your email to update your password $email" ;
                header('location:student_login.php');
            } else {
                echo "Email sending failed...";
            }
      }
      else{
        echo "<script>alert('Please Enter correct email and Check account activating link');
        window.location.href = 'student_login.php';
        </script>";
      }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <style>

    </style>
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
                                <h2 class="text-center mb-5">Forget Your Password</h2>
                                <div>
                                    <p class=" text-center mb-5 bg-success text-white px-4"> <?php 
                                    if(isset($_SESSION['msg'])){
                                        echo $_SESSION['msg'] ;
                                    }
                                    else{
                                        echo $_SESSION['msg']="You are logged Out. Please login again" ;
                                    }
                                    ?> </p>
                                </div>
                                <form action="forget.php" method="POST">

                                    <div class="form-outline mb-5">
                                        <input type="email" name="email" id="email" placeholder="Enter Your Email Id"
                                            class="form-control form-control-lg" required />
                                        <!-- <label class="form-label" for="form3Example3cg">Your Email</label> -->
                                    </div>

                

                                    <div class="d-flex justify-content-center">
                                        <button type="submit"
                                            class="btn btn-success btn-block btn-lg gradient-custom-4 text-body" name="forget" id="forget">Send Email</button>
                                    </div>

                                    <p class="text-center text-muted mt-1 mb-0">If You have no account <a href="student_signup.php"
                                            class="fw-bold text-body"><u>Register here</u></a></p>
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