
<?php
include('connection.php');

$id=$_GET['subject_id'];
$q =" DELETE FROM `subject` WHERE subject_id='$id'";
$data=mysqli_query($con,$q);
if($data)
{
echo "<scrpit>alert('Record delete')</scrpit>";
}
?>
<META HTTP-EQUIV="Refresh" CONTENT="0;  URL=http://localhost/cs/index.php">

