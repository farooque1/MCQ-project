<?php
include('connection.php');
 session_start(); 

if(!isset($_SESSION['name'])){
  header('location:login.php');
}

if(isset($_POST['submit']))
 {
 $s_id =$_GET['subject_id'];	
 $name=$_POST['name'];		
 $userid=$_SESSION['user_id'];
 $questionid="SELECT max(q_id)+1 as questionid FROM `subject_question`";

$qid=mysqli_query($con,$questionid);
$id_q = $qid->fetch_assoc();
$q_id=$id_q;
 $notes = '';
 $status = 0;

$q="INSERT INTO `subject_question`(`subject_id`,`name`) VALUES ('$s_id','$name')";
 $result = mysqli_query($con,$q);
$q2="INSERT INTO `notes`(`user_id`, `subject_id`, `q_id`, `notes`, `status`) 
VALUES ('$userid','$s_id',".$q_id['questionid']." ,'$notes','$status')";
$result = mysqli_query($con,$q2);

 if($result){
        echo "<script> alert('SubTopic added sucessful!')
		    window.location.href='index.php'; 	
			 </script>";
 	  }
  else{
        echo "<script> alert('Please Enter valid name')</script>";
    }
    mysqli_close($con);
 	}

include('top.php');
?>

<div class="container mt-5">
	<div>
	<table class="table table-bordered">
  		<thead>
    		<tr>
      		<th scope="col">Topic Name</th>
      		<th scope="col">Action</th>
     		</tr>
  		</thead>
  <tbody>
    <tr>
    	<?php
    	 	$s_id =$_GET['subject_id'];	    			
           $res=mysqli_query($con,"select * from subject_question where subject_id='$s_id' ");
          while($row=mysqli_fetch_assoc($res)){?>

      		<td> <?php echo $row['name']; ?></td>
      		<td><a href="delete.php?subject_id=<?php echo $row['subject_id']; ?>" Onclick='return checkdelete()'><i class="fa fa-trash" style="font-size:24px"></i></a></td>
    		</tr>
		
		<?php } ?>
  </tbody>
  </table>
	</div>
		     <form method="post">
          		<div class="mb-3">
            		<label for="recipient-name" class="col-form-label">Add SubTopic</label>
            		<input type="text" class="form-control" name="name">
          		</div>
      			<button type="submit" class="btn btn-primary" name="submit">Add SubTopic</button>
      		</form>
</div>
	
<?php include('footer.php');?>