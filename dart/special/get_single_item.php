
    <?php 

include "config.php";

if(isset($_POST['item'])){
    $code = mysqli_real_escape_string($con,$_POST['item']);

    $query = "SELECT DISTINCT  products.name as pro_name  FROM items INNER JOIN products ON items.name=products.id WHERE items.barcode like'%".$code."%'";
    $result = mysqli_query($con,$query);
    
    while($row = mysqli_fetch_array($result) ){
        $response["userdata"] = $row['pro_name'];
    }

    echo json_encode($response);
}

exit;