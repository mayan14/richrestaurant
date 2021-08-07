<?php
    session_start();
    $number = $_SESSION['EMPLOYEE_NUMBER'];
    $name = $_SESSION['EMPLOYEE_NAME'];
    $zone = $_SESSION['ZONE'];
    $prodType = $_SESSION['PRODUCT_TYPE'];
    //echo '<h2>Number is ' .htmlspecialchars($number) . '</h2>';
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/login/css/home.css">
    <title>Document</title>
    <style>
        table, th, td{
            border: 1px solid orange;
            color: white;
            text-align: center;
            padding: 20px;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <div class="navbar">
            <div class="right">
                <p class="title">Restaurant</p>
            </div>
            <div class="left">
                <button class="btnOrders"><a href="http://localhost/login/pages/orders.php" class="linkOrders">All Orders</a></button>
                <?php  echo '<p class="name">' .htmlspecialchars($name) . '</p>';  ?>
                <?php  echo '<p class="zone">' .htmlspecialchars($zone) . '</p>';  ?>
            </div>
        </div>

    <div class="productsTable">
        <div class="tableDiv">
            <?php echo '<h2 class="typeTitle">' .htmlspecialchars($prodType) . '</h2>' ?>
            <table class="prodsTable">
                <tr>
                    <th class="headerImage">Product Image</th>
                    <th class="headerName">Product Name</th>
                    <th class="headerPrice">Product Price</th>
                    <th class="headerQuantity">Quantity</th>
                </tr>
                <?php 
                include_once("connection.php");
                $sql = "SELECT * FROM product WHERE PRODUCT_TYPE='$prodType'";
                $result = mysqli_query($conn, $sql);
                $prodArray = array();
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) { 
                        echo '
                            <tr>
                            <td class="dataImage"><img src="http://localhost/'. $row["PRODUCT_IMAGE"] .'" alt="" class="imgData"></td>
                            <td class="dataName">'. $row["FOOD_PRODUCT"] .'</td>
                            <td class="dataPrice">'. $row["PRODUCT_PRICE"] .'</td>
                            <td class="dataQuantity">'. $row["QUANTITY"] .'</td>
                            </tr>
                            ';
                    }
                }
                ?>
            </table>
        </div>
    </div>

    <div class="makeOrder">
        <div class="formMakeOrderDiv">
            <form action="makeOrder.php" method="post" class="formMakeOrder">
                <h2 class="makeTitle">Make Order</h2>
                <div class="divMakeOrder">
                    <label for="name" class="labelOrder">Client Name</label><br/>
                    <input type="text" name="client" id="" class="nameOrder">
                </div>
                <div class="divMakeOrder">
                    <label for="name" class="labelOrder">Product Name</label><br/>
                    <input type="text" name="prodName" id="" class="nameOrder">
                </div>
                <div class="divMakeOrder">
                    <label for="name" class="labelOrder">Quantity</label><br/>
                    <input type="number" name="quantity" id="" class="nameOrder">
                </div>
                <div class="divMakeOrder">
                    <label for="name" class="labelOrder">Cost</label><br/>
                    <input type="number" name="cost" id="" class="nameOrder">
                </div>
                <input type="submit" value="Make Order" class="btnOrder">
            </form>
        </div>
    </div>
</body>
</html>