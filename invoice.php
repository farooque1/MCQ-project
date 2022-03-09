<?php
 session_start(); 
if(!isset($_SESSION['name'])){
  header('location:login.php');
}

require "vendor/autoload.php";
$mpdf = new \Mpdf\Mpdf();

$mpdf->SetTitle("Document Title");
$mpdf->SetAuthor("Jon Doe");
$mpdf->SetCreator("Code Boxx");
$mpdf->SetSubject("Demo");
$mpdf->SetKeywords("Demo", "Testing");

include('connection.php');

 $names=$_SESSION['name'];

 $user_id=$_SESSION['user_id'];

$html = '<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css">
        <link rel="license" href="https://www.opensource.org/licenses/mit-license/">
        <script src="script.js"></script>
    </head>
        <div class="table-responsive">
            <h1>Hello '.$names.' !</h1>
        <table class="inventory">
            <thead >
                <tr class="pdf_border">
                    <th class="header pdf_border">Subject Name</th>
                    <th class="header pdf_border">Topics Name</th> 
                    <th class="header pdf_border">Save Notes</th>
                </tr>
            </thead>
            
            <tbody>
            </body>
</html>'; ?>
    <?php
      $query = "SELECT DISTINCT n.subject_id,n.notes,n.q_id,n.user_id
          ,n.status,s.subject_id,s.subject_name,q.q_id,q.name
          from user_details u join notes n ON u.user_id=n.user_id 
          join subject s on s.subject_id=n.subject_id
          join subject_question q on q.q_id=n.q_id where n.user_id=$user_id";
      $result     = mysqli_query($con,$query);
      while($row  = mysqli_fetch_array($result))
      {                    
        $html .= '<tr style="border:1px solid;">
        <td class="pdf_border">'.$row['subject_name'].'</td>   
        <td class="pdf_border">'.$row['name'].'</td>
        <td class="pdf_border">'.$row['notes'].'</td> 
        </tr>';
        } 
 
      $html .= '</tbody></table>';

$mpdf->WriteHTML($html);

// (E) OUTPUT
// (E1) DIRECTLY SHOW IN BROWSER
$mpdf->Output('invoice.pdf','I');

// (E2) FORCE DOWNLOAD
// $mpdf->Output("demo.pdf", "D");

// (E3) SAVE TO FILE ON SERVER
// $mpdf->Output("demo.pdf");

?>