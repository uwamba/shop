<?php 

include "config.php";

if(isset($_POST['search'])){
    $search = mysqli_real_escape_string($con,$_POST['search']);

    $query = "SELECT DISTINCT items.barcode, items.name as item_name, products.name as pro_name, items.price as item_price  FROM items INNER JOIN products ON items.name=products.id WHERE products.name like'%".$search."%'";
    $result = mysqli_query($con,$query);
    
    while($row = mysqli_fetch_array($result) ){
        $response[] = array("value"=>$row['pro_name'],"label"=>$row['barcode']);
    }

    echo json_encode($response);
}

exit;
