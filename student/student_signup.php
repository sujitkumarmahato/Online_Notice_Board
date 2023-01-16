<?php
    $connection = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($connection,"notice_board_db");
    session_start();
    if(isset($_POST['register'])){
      $deparment= $_POST['department'];
      $email=$_POST['email'];
      $year= $_POST['year'];
      $name= $_POST['name'];
      $_SESSION['year']=$_POST['year'];
      if($deparment=="None"){
        echo "<script>alert('Select Your Department');
        window.location.href = 'student_signup.php';
        </script>";
      }
      if($year=='0'){
        echo "<script>alert('Select Your Year');
        window.location.href = 'student_signup.php';
        </script>";
      }
      $password= $_POST['password'];
      $cpassword= $_POST['cpassword'];

      $email_query="select * from student where email= '$_POST[email]'";
      $query_email=mysqli_query($connection, $email_query);
      $email_count=mysqli_num_rows($query_email);
      if($email_count>0)
      {
        echo "<script>alert('Email already exits Please try to Login');
        window.location.href = 'student_login.php';
        </script>";
      }
      else{
      $token=bin2hex(random_bytes(15));
      
      if($password===$cpassword){
      $pass=password_hash($password, PASSWORD_DEFAULT);
      $cpass=password_hash($cpassword, PASSWORD_DEFAULT);
      $query = "insert into student values(null,'$_POST[name]','$_POST[department]', $_POST[year],$_POST[roll],'$_POST[email]','$pass', '$cpass', '$token', 'inactive')";
      $query_run = mysqli_query($connection,$query);
      if($query_run){
            $subject = "Email Activation Link";
            $body = "Hi, $name, Click here to activate your account http://localhost/Project/Online%20Notice%20Board/student/activate.php?token=$token";
            $headers = "From: sujit.kumarmahato.cse21@heritageit.edu.in";

            if (mail($email, $subject, $body, $headers)) {
                $_SESSION['msg']="Check your email to activate your account $email" ;
                header('location:student_login.php');
            } else {
                echo "Email sending failed...";
            }

         }
      else{
            echo "<script>alert('Registration failed...try again');
            window.location.href = 'student_signup.php';
            </script>";
        }
    }
    else{
        echo "<script>alert('Missmatching Password and Confirm Password');
        window.location.href = 'student_login.php';
        </script>";
    }
  }

  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Sign up</title>
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
                                <h2 class="text-center mb-5">Create Your Account</h2>

                                <form action="student_signup.php" method="post">

                                    <div class="form-outline mb-4">
                                        <input type="text" name="name" id="name" placeholder="Enter Your Name"
                                            class="form-control form-control-lg" required/>
                                        <!-- <label class="form-label" for="form3Example1cg">Your Name</label> -->
                                    </div>

                                    <div class="form-outline mb-4">
                                        <select id="dept" name="department" class="form-control form-control-lg">
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

                                    <div class="form-outline mb-4">
                                        <select id="year" name="year"  class="form-control form-control-lg">
                                            <option value="0">Select Year</option>
                                            <option value="1"> 1</option>
                                            <option value="2"> 2</option>
                                            <option value="3"> 3</option>
                                            <option value="4"> 4</option>
                                        </select>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="number" name="roll" id="roll" placeholder="Enter Your Roll No"
                                            class="form-control form-control-lg" required/>
                                        <!-- <label class="form-label" for="form3Example3cg">Your Email</label> -->
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="email" name="email" id="email" placeholder="Enter Your Email Id"
                                            class="form-control form-control-lg" required/>
                                        <!-- <label class="form-label" for="form3Example3cg">Your Email</label> -->
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="password" name="password" id="password"
                                            placeholder="Enter Your Password" class="form-control form-control-lg" required />
                                        <!-- <label class="form-label" for="form3Example4cg">Password</label> -->
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="password" name="cpassword" id="cpassword"
                                            placeholder="Enter Confirm Password" class="form-control form-control-lg" required />
                                        <!-- <label class="form-label" for="form3Example4cdg">Repeat your password</label> -->
                                    </div>


                                    <div class="d-flex justify-content-center">
                                        <button type="submit"
                                            class="btn btn-success btn-block btn-lg gradient-custom-4 text-body" id="register" name="register" >Register</button>
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