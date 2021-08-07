<?php

if (isset($_POST['client'])) {
    include("connection.php");
    $client = $_POST['client'];
    $product = $_POST['prodName'];
    $quantity = $_POST['quantity'];
    $cost = $_POST['cost'];
    $status = "Pending";
    $orderId = random_int(1000, 100000);


    $sql = "INSERT INTO orders (CLIENT, PRODUCT, ORDER_NO, COST, STATUS) VALUES ('$client', '$product', '$orderId', '$cost', '$status')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $sql1 = "SELECT QUANTITY FROM product WHERE FOOD_PRODUCT='$product'";
        $res1 = mysqli_query($conn, $sql1);
        if (mysqli_num_rows($res1) > 0) {
            while($row = mysqli_fetch_assoc($res1)){
               $quant = $row['QUANTITY'] - $quantity;  
            }

            $sql2 = "UPDATE product SET QUANTITY='$quant' WHERE FOOD_PRODUCT='$product'";
            $res2 = mysqli_query($conn, $sql2);
            if ($res2) {
                header("Location: http://localhost/login/pages/products.php");
            }
            else {
                
            }
        }  
        echo $quant;    
    }
    else {
        echo "Not Added";
    }
}

?>