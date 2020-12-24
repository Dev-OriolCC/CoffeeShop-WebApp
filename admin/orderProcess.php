<?php
    require_once('include/connect.php');
?>
<div class="table-responsive-sm table-responsivew-md mt-3 col-12 col-sm-12" align="center">
    <p class="text-white"><strong>Order's in Preparing State</strong></p>
    <table class="bg-secondary text-white" id="coffeeTab">
    <thead>
        <tr class="table-dark text-dark">
            <th class="px-5">Order ID</th>
            <th class="px-5">Client</th>
            <th class="px-5">Total</th>
            <th class="px-5">View</th>
            <th class="px-5">Check</th>
            <th class="px-5">Delete</th>
        </tr>
    </thead>
<?php
    $SQL_OrderP = "SELECT orden.Orden_ID, orden.Orden_Total, orden.Orden_Estado, cliente.C_ID, cliente.C_UserName FROM orden 
    INNER JOIN cliente ON orden.Orden_Cliente = cliente.C_ID
    WHERE Orden_Estado = 'Preparing' ";
    $pResult = CoffeeData($SQL_OrderP, $connection);
    
    if ($pResult ==  true) {
        $pNum = count($pResult);
        for ($oP=0; $oP < $pNum ; $oP++) { 
?>
    <tr class="bg-info">
        <td class="px-5"><?php echo $pResult[$oP]['Orden_ID']; ?></td>
        <td class="px-5"><?php echo $pResult[$oP]['C_UserName']; ?></td>
        <td class="px-5">$<?php echo $pResult[$oP]['Orden_Total']; ?>.00</td>
        <td class="px-5"><?php echo $pResult[$oP]['Orden_Estado']; ?></td>
        <td class="px-5">_</td>
        <td class="px-5">_</td>
    </tr>
<?php
        }
    }else{
        echo 'NO';
    }
?>
    </table>
</div>