<?php require_once('include/connect.php');
?>
<div class="table-responsive-sm table-responsivew-md mt-3 col-12 col-sm-12" align="center">
    <p class="text-white">All User's</p>
    <table class="bg-secondary text-white">
        <thead>
            <tr class="table-dark text-dark">
                <th class="px-5">User ID</th>
                <th class="px-5">Username</th>
                <th class="px-5">Date Created</th>
                <th class="px-5">🗑</th>
            </tr>
        </thead>
        <?php
        $SQL_User = "SELECT * FROM cliente";
        $dataUser = CoffeeData($SQL_User, $connection);
        if ($dataUser ==  true) {
            $numUser = count($dataUser);
            for ($x = 0; $x < $numUser; $x++) {
        ?>
                <tr>
                    <td class="px-5"><?php echo $dataUser[$x]['C_ID']; ?></td>
                    <td class="px-5"><?php echo $dataUser[$x]['C_UserName']; ?></td>
                    <td class="px-5"><?php echo $dataUser[$x]['C_FechaCreacion']; ?></td>
                    <td class="px-5"><button class="btn btn-danger" data-toggle="modal" data-target="<?php echo '#delModal' . $i; ?>">Delete</button></td>
                </tr>
                <!-- DELETE MODAL -->
                <div class="modal fade" id="<?php echo 'delModal' . $i; ?>" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Delete Coffee</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div align="center">
                                    <h5>Are you sure you want to Delete all data from <strong><?php echo $dataProd[$i]['Prod_Nombre']; ?></strong> Coffee?</h5>
                                    <img src="<?php echo $dataProd[$i]['Prod_Imagen1']; ?>" width="120px" height="120px" alt="coffeePicture">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                    <button type="submit" name="<?php echo 'prod' . $i; ?>" class="btn btn-danger">Yes, Delete!</button>
                                </form>
                                <button type="button" class="btn btn-success" data-dismiss="modal">NO</button>
                            </div>
                        </div>
                    </div>
                </div>
        <?php



            } // END OF FOR LOOP
        }

        ?>
    </table>
</div>