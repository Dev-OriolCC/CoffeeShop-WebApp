<div class="table-responsive-sm table-responsivew-md mt-3 col-12 col-sm-12" align="center">
            <p class="text-white">All Products</p>
            <table class="bg-secondary text-white">
                <?php 
                    $SQL_Prod = "SELECT * FROM producto";
                    $dataProd = CoffeeData($SQL_Prod, $connection);
                    if ($dataProd == true) {
                        $numProd = count($dataProd);
                        for ($i=0; $i <$numProd; $i++) { 
                            ?>
                            <tr >
                                <td class="px-3"><img src="<?php echo $dataProd[$i]['Prod_Imagen1']; ?>" style="width: 60px; height:60px;"></td>
                                <td class="px-5"><?php echo $dataProd[$i]['Prod_Nombre']; ?></td>
                                <td class="px-5"><?php echo $dataProd[$i]['Prod_Codigo']; ?></td>
                                <form action="?<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                    <td class="px-5"><button type="submit" name="<?php echo 'prod'.$i; ?>" class="btn btn-danger">Delete</button></td>                   
                                </form>
                                <td class=" px-5"><button class="btn btn-primary" data-toggle="modal" data-target="<?php echo '#prodModal'.$i; ?>">Update</button></td>

                            </tr>
                            <?php
                            // DELETE COFFEE
                            if (isset($_POST['prod'.$i])) {
                                $prodID = $dataProd[$i]['Prod_ID'];
                                if ($idUser != null && $prodID != null) {
                                    $SQL_Delete = "DELETE FROM producto WHERE Prod_ID = $prodID ";
                                    $result = mysqli_query($connection, $SQL_Delete) or die(mysqli_error($connection));
                                }
                            } // END DELETE BTN
                            // UPDATE COFFEE
                            ?>
                            <div class="modal fade" id="<?php echo 'prodModal'.$i; ?>" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title"><?php echo $dataProd[$i]['Prod_Nombre']; ?> Coffee</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <div align="center">
                                                <h5>Information</h5>
                                            </div>
                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                                <div class="form-group"><!--NAME -->
                                                    <p class="text-black">Name:</p>
                                                    <input type="text" class="col-10 col-sm-6 "class="form-control" name="Name" value="<?php echo $dataProd[$i]['Prod_Nombre']; ?>" required>
                                                </div>
                                                <div class="form-group"><!--CATEGORY -->
                                                    <p class="text-black">Category:</p>
                                                    <input type="text" class="col-10 col-sm-6 "class="form-control" name="Name" value="<?php echo $dataProd[$i]['Prod_Categoria']; ?>" required>
                                                </div>
                                                <div class="form-group"><!--PRICE -->
                                                    <p class="text-black">Price:</p>
                                                    <input type="text" class="col-10 col-sm-6 "class="form-control" name="Name" value="<?php echo $dataProd[$i]['Prod_Precio']; ?>" required>
                                                </div>
                                                <div class="form-group"><!--CODE -->
                                                    <p class="text-black">Code:</p>
                                                    <input type="text" class="col-10 col-sm-6 "class="form-control" name="Name" value="<?php echo $dataProd[$i]['Prod_Codigo']; ?>" required>
                                                </div>
                                                <div class="form-group"><!--SIZE -->
                                                    <p class="text-black">Size:</p>
                                                    <input type="text" class="col-10 col-sm-6 "class="form-control" name="Name" value="<?php echo $dataProd[$i]['Prod_Size']; ?>" required>
                                                </div>
                                                <div class="form-group"><!--IMAGE -->
                                                    <p class="text-black">Image:</p>
                                                    <input type="text" class="col-10 col-sm-6 "class="form-control" name="Name" value="<?php echo $dataProd[$i]['Prod_Imagen1']; ?>" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary" name="updateProd">Update</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        } // END FOR
                    }
                ?>
            </table>
        </div>