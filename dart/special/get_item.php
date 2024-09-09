<?php 

include "config.php";

if(isset($_POST['item'])){
    $code = mysqli_real_escape_string($con,$_POST['code']);

    $query = "SELECT DISTINCT items.barcode, items.name as item_name, products.name as pro_name, items.price as item_price  FROM items INNER JOIN products ON items.name=products.id WHERE products.name like'%".$code."%'";
    $result = mysqli_query($con,$query);
    
    while($row = mysqli_fetch_array($result) ){
        $response[] = array("name"=>$row['pro_name'],"barcode"=>$row['barcode']);
    }

    echo json_encode($response);
}

exit;
