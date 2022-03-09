<?php
 session_start(); 

if(!isset($_SESSION['name'])){
  header('location:login.php');
}

require "vendor/autoload.php";
$mpdf = new \Mpdf\Mpdf();
// PORTRAIT BY DEFAULT, WE CAN ALSO SET LANDSCAPE
// $mpdf = new \Mpdf\Mpdf(["orientation" => "L"]);

// (B) OPTIONAL META DATA + PASSWORD PROTECTION
$mpdf->SetTitle("Document Title");
$mpdf->SetAuthor("Jon Doe");
$mpdf->SetCreator("Code Boxx");
$mpdf->SetSubject("Demo");
$mpdf->SetKeywords("Demo", "Testing");

include('connection.php');

 $userid=$_SESSION['user_id'];

 $q_id=$_GET['q_id'];

$sql="SELECT q_id,notes,status,user_id from notes WHERE q_id=$q_id AND user_id=$userid  ";

$data = mysqli_query($con,$sql);

while ($rows = mysqli_fetch_array($data)) 

{
  $notes= $rows['notes'];
}


$html = '<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css">
        <link rel="license" href="https://www.opensource.org/licenses/mit-license/">
        <script src="script.js"></script>
    </head>
        <div class="table-responsive">
            <h1>Hello '.$notes.' !</h1>';

$mpdf->WriteHTML($html);

// (E) OUTPUT
// (E1) DIRECTLY SHOW IN BROWSER
$mpdf->Output('invoice.pdf','I');

// (E2) FORCE DOWNLOAD
// $mpdf->Output("demo.pdf", "D");

// (E3) SAVE TO FILE ON SERVER
// $mpdf->Output("demo.pdf");

?>