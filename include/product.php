<?php
    // Connect to DB
    require_once('connect.php');
    
    //$SQL_Prod = 'SELECT * FROM producto';
    //$SQL_Prod = 'SELECT * FROM producto WHERE Prod_Categoria = 300';

    // Abstract Method to fetch correct Data from DB 
     function CoffeeData($SQL, $connection){
        $ResultProd = mysqli_query($connection, $SQL);
        $dataProduct = array();
        if (mysqli_num_rows($ResultProd) >0) {
            while ($row = mysqli_fetch_assoc($ResultProd)) {
                $dataProduct [] = $row;
            }
            return $dataProduct;
        }
    }
    //print_r($dataProduct);
?>
<?php
function DeleteMSG(){
?>
    <h3 class="text-white">Coffee added Successfully!</h3><br>
    <img src="img/coffeeSad.png" alt="cartPNG" width="180px" height="180px">
    <p class="text-white">Coffee has been deleted 😐</p>
<?php        
    }
?>