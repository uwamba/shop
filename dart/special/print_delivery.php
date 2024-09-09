<?php
include 'includes/session.php'; 

if(!empty($_GET['delivery_id']) && $_GET['delivery_id']) {
	echo $_GET['delivery_id'];
	
}
   $conn = $pdo->open();
   try{
                       
    $stmt = $conn->prepare("SELECT * FROM delivery_note WHERE id=:id");
    $stmt->execute(["id"=>$_GET['delivery_id']]);
    $row = $stmt->fetch();
    }
    
    catch(PDOException $e){
    echo $e->getMessage();
    }
    
    $deliveryDate = date("d/M/Y, H:i:s", strtotime($row['date']));
    
    $output = '';
    $output .= '<head>
   <style>
     @page { margin: 50px 50px; }
     #header { position: fixed; left: 0px; top: -50px; right: 0px; height: 50px; width:100%; background-color: white; text-align: center; }
     #footer { position: fixed; left: 0px; bottom: -50px; right: 0px; height: 50px; width:100%; background-color: white; }
     #footer .page:after { content: counter(page, upper-roman); }
   </style>
   </head>
  
   <div id="header">
    <table width="100%"  border="0" cellpadding="5" cellspacing="0">
	
	<tr>
	<td colspan="2">
	<table width="100%"  cellpadding="5">
	<tr>
	<td width="65%">
	<img src="../images/read_logo.png" width="300" height="80" alt="Second slide" ><br />
	<b>Reading Technology ltd</b><br />
	Location: Kigali-Nyarugenge-M-Peace Plaza<br />
	Tell: 0782860021<br />
	Email: readingtechnologyltd@gmail.com<br />
	website: www.readinstore.com<br />
	VAT/Tin:103159754<br />
	</td>
	</tr>
   </div>
   <div id="footer">
     <b>Done At Kigali on '.date("Y-m-d").'</b><br />
   </div>';
    $output .= '
    <tr>
	<td colspan="2" align="right" style="font-size:18px"><b>No: '.$row['id'].' </b></td>
	</tr>
	<br /><br />
	<tr>
	<td colspan="2" align="center" style="font-size:18px"><b><u>Delivery Note <u></b></td>
	</tr>
	<br />

	<tr>
	<td colspan="2" align="left" style="font-size:18px"><b>Client: '.$row['name'].' </b></td>
	</tr>
	
	</table>
	<br />
	<table width="100%" border="1" cellpadding="5" cellspacing="0">
	<tr>
	<th align="left">Dn No.</th>
	<th align="left">Item Code</th>
	<th align="left">Item Name</th>
	<th align="left">Quantity</th>
	</tr>';
   $count = 0;   
    try{
                       
    $stmt2 = $conn->prepare("SELECT * FROM delivery_note_items WHERE delivery_id=:id");
    $stmt2->execute(['id'=>$_GET['delivery_id']]);
    foreach($stmt2 as $row2){
      $count =$count+1;  
      $output .= '
    	<tr>
        <td>'.$count.'</td>
        <td>'.$row2['item_code'].'</td>
        <td>'.$row2['name'].'</td>
        <td>1</td>
        </tr>';
                        
    }
    }
    
    catch(PDOException $e){
    echo $e->getMessage();
    }
$output .= '
	<tr>
	<td align="right" colspan="3"><b>Total Items</b></td>
	<td align="left"><b>'.$count.'</b></td>
	</tr>';
$output .= '
	</table>
	</td>
	</tr>
	</table>
	<br /><br /><br /><br />';
		$stmt_user_item = $conn->prepare("SELECT * FROM users WHERE id=:id ");
		$stmt_user_item->execute(['id'=>$row['requester']]);
        $user_id = $stmt_user_item->fetch();
        $fname=$user_id['firstname'];
        $sname=$user_id['lastname'];
$output .= '<table width="100%"  border="0" cellpadding="5" cellspacing="0">
	
	<tr>
	<td colspan="2">
	<table width="100%"  cellpadding="5">
	<tr>
	<td width="65%">
	<b>Requested by: '.$fname.' '.$sname.'  </b><br /><br />
	<b><u>Received and checked by:</u></b><br /> 

	</td>
	</tr>
	</table>';	

// create pdf of delivery	
$DeliveryFileName = 'DeliveryNote-'.$row['id'].'.pdf';
require_once './dompdf/src/Autoloader.php';
Dompdf\Autoloader::register();
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$dompdf->loadHtml(html_entity_decode($output));
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream($DeliveryFileName, array("Attachment" => false));
?>   
   