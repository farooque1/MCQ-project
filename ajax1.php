<?php 

require_once('connection.php');
 session_start(); 
if(!isset($_SESSION['name'])){
  header('location:login.php');
}

if(isset($_GET['subject_id']) && is_numeric($_GET['subject_id']))
{
    $sID = intval($_GET['subject_id']);
    $userID=$_SESSION['user_id'];
    $qoury = "SELECT DISTINCT n.subject_id,n.q_id,n.user_id
          ,n.status,s.subject_id,s.subject_name,q.q_id,q.name
          from user_details u join notes n ON u.user_id=n.user_id 
          join subject s on s.subject_id=n.subject_id
          join subject_question q on q.q_id=n.q_id
          WHERE  n.subject_id=$sID AND n.user_id=$userID";

    $res = $con->query($qoury);

    $fetchAllData = $res->fetch_ALL(MYSQLI_ASSOC);

    $create ="";

    foreach($fetchAllData as $item)
    {
      $create .= "<tr>";

        $create .= "<td > ".$item['name']."</td>";

        if($item['status']==0){
        $create .=" <td>".$item['name']."</td> ";
          }
          $create .="<td></td>";

          if($item['status']==1){
        $create .=" <td>".$item['name']."</td> ";
          }
      $create .= "</tr>";  
    }
    echo $create;
    $res->close();
    $con->close();      
}

?>