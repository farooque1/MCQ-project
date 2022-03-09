<?php 
require_once('connection.php');

session_start(); 
if(!isset($_SESSION['name'])){
  header('location:login.php');
}

if(isset($_GET['subject_id']) && is_numeric($_GET['subject_id']))
{
$userID = intval($_GET['subject_id']);
$id=$_SESSION['user_id'];

$qry="SELECT DISTINCT n.subject_id,n.q_id,n.user_id ,n.status,s.subject_id,s.subject_name,q.q_id,q.name from user_details u join notes n ON u.user_id=n.user_id join subject s on s.subject_id=n.subject_id join subject_question q on q.q_id=n.q_id WHERE n.subject_id=$userID AND n.user_id=$id";
    
$rs = $con->query($qry);
$fetchAllData = $rs->fetch_ALL(MYSQLI_ASSOC);

$create ='';
foreach($fetchAllData as $Data)
	{
      {
      $create .= '<tr>';

        if($Data['status']==0){
        $create .=' <td style="border-top:none;"> <img src="./danger.png" alt="completed icon" width="24"> </li> </td> ';
        $create .=' <td style="border-top:none;">'.$Data['name'].'</td> ';
        $create .=' <td style="border-top:none;"> <a href="notes.php?q_id='.$Data['q_id'].' & subject_id='.$userID.'"> Revise </a> ';
          }

          if($Data['status']==1){
            $create .=' <td style="border-top:none;"> <img src="./checked.png" alt="completed icon" width="24"> </li> </td> ';
            $create .=' <td style="border-top:none;">'.$Data['name'].'</td> ';
            $create .=' <td style="border-top:none;"> <a href="status.php?q_id='.$Data['q_id'].'" Onclick="return checkdelete()"> Reset</a> ';

          }
      $create .= '</tr>';  
    }

  }
$create .= '<a href="add_question.php?subject_id='.$userID.'">
<i class="fa fa-plus" style="font-size:24px"></i></a>';            

	echo $create;
	$rs->close();
	$con->close();		
}

?>

<script type="text/javascript">  
  function checkdelete(){
  return confirm('Notes of this topic will be deleted. Do you wish to download notes before Reset ?');   
                       }
</script>