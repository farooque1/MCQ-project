<?php
include('connection.php');

session_start();

if(isset($_POST['submit']))
 {
 $name=$_POST['name'];		
 $password = $_POST['password'];

$sql=mysqli_query($con,"select * from user_details where name='$name' and password='$password'");
 
  if(mysqli_num_rows($sql)>0){
  	
      $row=mysqli_fetch_assoc($sql);
        $_SESSION['name'] = $name;
        $_SESSION['user_id']=$row['user_id'];
        header('location:index.php');
		die(); 	
 	  }
  else{
        echo "<script> alert('Please Enter valid name and password')</script>";
      }
    mysqli_close($con);
 	}

include('top.php');

?>


<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="post">
					<span class="login100-form-title p-b-26">
						Login
					</span>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="name">
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye" onclick="myFunction()"></i>
						</span>
						<input id="password-login" class="input100" type="password" name="password">
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" type="submit" name="submit">
								Login
							</button>
						</div>
					</div>

					<div class="text-center p-t-115">
						<span class="txt1">
							Don’t have an account?
						</span>

						<a class="txt2" href="register.php">
							Sign Up
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>

	<?php include('footer.php');?>