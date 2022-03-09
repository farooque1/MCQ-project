<?php
include('connection.php');
 session_start(); 
if(!isset($_SESSION['name'])){
  header('location:login.php');
}

if(isset($_POST['submit']))
 {
 $id_user=$_SESSION['user_id']; 
 $q_id=$_GET['q_id'];
 $notes = $_POST['notes'];
 $status = 0;
 $s_id=$_GET['subject_id'];

$q="INSERT INTO `notes`(`user_id`,`subject_id`,`q_id`, `notes`, `status`) VALUES ('$id_user','$s_id','$q_id','$notes','$status')";
 $result = mysqli_query($con,$q);

 if($result){
        echo "<script> alert('Notes Save')</script>";
            }
          else{
        echo "<script> alert('Please Enter notes')</script>";
              }
           }

if(isset($_POST['status']))
 {

 $id_user=$_SESSION['user_id']; 
 $q_id=$_GET['q_id'];
 $notes = $_POST['notes'];
 $status = 1;
 $s_id=$_GET['subject_id'];

$qry=mysqli_query($con,"SELECT * FROM notes WHERE status=0");
$rowCheck=mysqli_num_rows($qry);
    if ($rowCheck>0) { // if data exist update the data
        $qry=mysqli_query($con,"UPDATE `notes` SET status='$status' WHERE q_id='$q_id'");  
    }
    else{ // insert the data if data is not exist
        $qry=mysqli_query($con,"INSERT INTO `notes`(`user_id`,`subject_id`,`q_id`, `notes`, `status`) VALUES ('$id_user','$s_id','$q_id','$notes','$status')");
    }
 if($qry){
        header('location:index.php');
        }
       else{
        echo "<script> alert('Please Enter notes')</script>";
        }
        }
include('top.php');
?>

<?php 
$quotesArr = [
          "Two things are infinite: the universe and human stupidity; and I'm not sure about the universe.",
          "There are only two ways to live your life. One is as though nothing is a miracle. The other is as though everything is a miracle.",
          "I am enough of an artist to draw freely upon my imagination. Imagination is more important than knowledge. Knowledge is limited. Imagination encircles the world.",
          "If you can't explain it to a six year old, you don't understand it yourself.",
          "If you want your children to be intelligent, read them fairy tales. If you want them to be more intelligent, read them more fairy tales.",
          "Logic will get you from A to Z; imagination will get you everywhere.",
          "Life is like riding a bicycle. To keep your balance, you must keep moving.",
          "Anyone who has never made a mistake has never tried anything new.",
          "I speak to everyone in the same way, whether he is the garbage man or the president of the university.",
          "When you are courting a nice girl an hour seems like a second. When you sit on a red-hot cinder a second seems like an hour. That's relativity.",
          "Never memorize something that you can look up.",
          "A clever person solves a problem. A wise person avoids it.",
          "Science without religion is lame, religion without science is blind.",
          "Reality is merely an illusion, albeit a very persistent one.",
          "If we knew what it was we were doing, it would not be called research, would it?",
                ];
  srand ((double) microtime() * 1000000);
  $random_number = rand(0,count($quotesArr)-1);

include('connection.php');
$id=$_GET['q_id'];
$s_id=$_GET['subject_id'];

$query = "SELECT s.subject_id,s.subject_name,q.subject_id,q.name,q.q_id from subject s join subject_question q ON
    s.subject_id=q.subject_id WHERE q_id= $id AND q.subject_id=$s_id";

$data = mysqli_query($con,$query);

while ($rows = mysqli_fetch_array($data)) {
?>


<div class="container mt-3">
      <div class="wrap-login1000 mt-5">
        <a href="index.php" style="float:right;margin-top:20px;"><i class="fa fa-times" style="font-size:24px"></i></a>
        <div class="row text-center justify-content-md-center mt-5">
        <div id="quote-wrapper mt-3">

          <form method="post" class="mt-3">
          <h2 value="<?php echo $rows['subject_name']; ?>"><?php echo $rows['subject_name']; ?></h2><br>
          <h3 value="<?php echo $rows['name']; ?>"> <?php echo $rows['name']; ?></h3>
          
          <div class="text-center justify-content" style="font-size:16px;margin-top:20px;">
            <?php 
           echo ($quotesArr[$random_number]);
           ?>
          </div>
          
          <div class="mt-5" style="font-size:25px;margin-top:20px;">
            Notes
            <div >
              <textarea class="form-control" placeholder="Write Your Notes Here" name="notes" rows="5" 
              style="border:solid 2px black;"></textarea>
              <div>
                <button  class="btn-info mt-4" type="submit" name="submit" style="font-size:25px;"> Save </button>
                
                <div id="quote-btn-wrapper">
            <button  class="mark-complete-btn btn-success"  type="status" name="status" style="font-size:25px;margin-top:10px; ">
              Save and Completed
            </button>
          </div>
              </div>
            </div>
          </div>
          
          </form>


        </div>
     </div>
  </div>
  </div>

<?php } ?>

<?php include('footer.php');?>