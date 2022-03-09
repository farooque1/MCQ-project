<?php
include('connection.php');

//already register user

// $check_email = mysqli_query($con, "SELECT * FROM `user_details` WHERE name='$name' ");
// if(mysqli_num_rows($check_email) > 0){
//     echo" <script> alert('Name Already Exit plase try Somthing Else')</script>";
// }
// else{
$qpur_supid="SELECT max(user_id)+1 as userid FROM `user_details`";

$res_qpur_supid=mysqli_query($con,$qpur_supid);
$idtest = $res_qpur_supid->fetch_assoc();

$subjectid=array();
$subject=mysqli_query($con,"SELECT `subject_id`,`q_id` FROM `subject_question`");
 while($row=mysqli_fetch_assoc($subject)){
 	array_push($subjectid,$row);
}

//print_r($questionid);

//print_r($subjectid);

//echo $row['subject_id'];

if(isset($_POST['submit']))
 {
 $name=$_POST['name'];		
 $password = $_POST['password'];

 $userid=$idtest;

 $subjectid;
 $notes = '';
 $status = 0;

foreach($subjectid as $Data) 
{

$q2="INSERT INTO `notes`(`user_id`, `subject_id`, `q_id`, `notes`, `status`) 
VALUES (".$userid['userid']." ,".$Data['subject_id'].",".$Data['q_id'].",'$notes','$status')";
  
  $result = mysqli_query($con,$q2);
//print_r ($q2);
}

$q="INSERT INTO `user_details`(`name`, `password`) VALUES ('$name','$password')";
$result = mysqli_query($con,$q);

 if($result){
        echo "<script> alert('Sign Up sucessful! Login to Continue')
			window.location.href='login.php';	     	
			 </script>";
 	  }
  else{
        echo "<script> alert('Please Enter valid name and password')</script>";
    }
    mysqli_close($con);
 	}

include('top.php');

?>

<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="POST">
					<span class="login100-form-title p-b-26">
						Sign Up
					</span>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="name" placeholder="UserName">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye" onclick="myFunction()"></i>
						</span>
						<input class="input100" type="password" name="password" id="password-login">
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" type="submit" name="submit">
								Sign Up
							</button>
						</div>
					</div>

					<div class="text-center p-t-115">
						<span class="txt1">
							Already have an account?
						</span>

						<a class="txt2" href="login.php">
							Login
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>


	<?php include('footer.php'); ?>