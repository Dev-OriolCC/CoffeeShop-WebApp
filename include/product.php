<?php
    // Connect to DB
    require_once('connect.php');

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
function DeleteMSG(){
?>
    <h3 class="text-dark">Coffee Deleted Successfully!</h3><br>
    <img src="img/coffeeSad.png" alt="cartPNG" width="180px" height="180px">
    <p class="text-dark">Coffee has been deleted 😐</p>
<?php        
    }

function OperationSuccess(){
?>  
    <h3 class="text-success">Operation Successfully</h3>
    <img src="https://lh3.googleusercontent.com/proxy/bbp1ov0NZBY1CWaLVoz7a3eugtrYFmw2VhCaLU0FSYZDTvwW-EJHTrnjOAK4TuSM7m5ZFZ7iZ8BsU5Qg2IZiyZRHYbFS5HcNoW_AqsVyEo5PhsU8aDdtNqAHWnSg3A" height="180px" width="180px">
    <br><a href="" class="btn btn-success">OKEY</a>
<?php
    }
function OperationFailed(){
?>
    <h3 class="text-danger">Operation Failed</h3>
    <img src="https://nika.shop/wp-content/uploads/2020/01/fail-png-7.png" height="180px" width="180px">
    <br><a href="" class="btn btn-success">OKEY</a>
<?php
}

function ValidateMSG($result){
    if ($result == true) {
        OperationSuccess();
    }else{
        OperationFailed();
    }
}
?>