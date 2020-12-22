<?php require_once('include/connect.php');
?>
<div class="table-responsive-sm table-responsivew-md mt-3 col-12 col-sm-12" align="center">
            <p class="text-white">All Products</p> <!-- CREATE PRODUCT BTN & MODAL -->
            <button class="btn btn-success" data-toggle="modal" data-target="#createModal">Add New Coffee</button>
            <div class="modal fade" id="createModal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">New Coffee ☕😋</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body" align="center">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                            <div class="form-group"><!--NAME -->
                                <p class="text-black">Name:</p>
                                <input type="text" class="col-10 col-sm-6 "class="form-control" name="pName" value="" required>
                            </div>
                            <div class="form-group"><!--CAT -->
                                <p class="text-black">Category:</p>
                                <input type="number" step="100" value="100" min="100" max="400" class="col-10 col-sm-6 "class="form-control" name="Category" required>
                            </div>
                            <div class="form-group"><!--PRICE -->
                                <p class="text-black">Price:</p>
                                <input type="number" step="0.1" class="col-10 col-sm-6 "class="form-control" name="Price" required>
                            </div>
                            <div class="form-group"><!--CODE -->
                                <p class="text-black">Code:</p>
                                <input type="text" class="col-10 col-sm-6 "class="form-control" name="Code" value="" required>
                            </div>
                            <div class="form-group"><!--DETAIL -->
                                <p class="text-black">Details:</p>
                                <input type="text" class="col-10 col-sm-6 "class="form-control" name="Details" value="">
                            </div>
                            <div class="form-group"><!--SIZE -->
                                <p class="text-black">Size:</p>
                                <input type="number" step="0.1" class="col-10 col-sm-6 "class="form-control" name="Size" value="" required>
                            </div>
                            <div class="form-group"><!--IMAGE1 URL -->
                                <p class="text-black">Image URL (.png recomended):</p>
                                <input type="text" class="col-10 col-sm-6 "class="form-control" name="Image1" value="" required>
                            </div>
                            <button type="submit" name="newProduct" class="btn btn-success">Add New Coffee</button>
                        </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div> <!-- END MODAL CREATE -->
            <?php
                if (isset($_POST['newProduct'])) {
                    $name = mysqli_real_escape_string($connection, $_POST['pName']);
                    $category = mysqli_real_escape_string($connection, $_POST['Category']);
                    $price = mysqli_real_escape_string($connection, $_POST['Price']);
                    $code = mysqli_real_escape_string($connection, $_POST['Code']);
                    $details = mysqli_real_escape_string($connection, $_POST['Details']);
                    $size = mysqli_real_escape_string($connection, $_POST['Size']);
                    $image = mysqli_real_escape_string($connection, $_POST['Image1']);
                    //TWO
                    $SQL_2 = "INSERT INTO `producto`(`Prod_Nombre`, `Prod_Categoria`, `Prod_Precio`, `Prod_Codigo`, `Prod_Carac`, `Prod_Size`, `Prod_Imagen1`) 
                    VALUES ('$name', $category, $price, '$code', '$details', '$size', '$image')";
                    // INSERT
                    $createResult = mysqli_query($connection, $SQL_2);
                    if($createResult == true){
                        echo 'GOOD';// MSG
                    }else{
                        echo 'SAD :(' ;
                    }
                    
                }
            ?>
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
                                <td class="px-5"><button class="btn btn-danger" data-toggle="modal" data-target="<?php echo '#delModal'.$i; ?>">Delete</button></td>
                                <td class=" px-5"><button class="btn btn-primary" data-toggle="modal" data-target="<?php echo '#prodModal'.$i; ?>">Update</button></td>
                            </tr>
                            <?php
                            // DELETE MODAL ?>
                            <div class="modal fade" id="<?php echo 'delModal'.$i; ?>" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Delete Coffee</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <div align="center">
                                                <h5>Are you sure you want to Delete all data from <strong><?php echo $dataProd[$i]['Prod_Nombre']; ?></strong>  Coffee?</h5>
                                                <img src="<?php echo $dataProd[$i]['Prod_Imagen1']; ?>" width="120px" height="120px" alt="coffeePicture">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                                <button type="submit" name="<?php echo 'prod'.$i; ?>" class="btn btn-danger">Yes, Delete!</button>                   
                                            </form>
                                            <button type="button" class="btn btn-success" data-dismiss="modal">NO</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            // DELETE COFFEE
                            if (isset($_POST['prod'.$i])) {
                                $prodID = $dataProd[$i]['Prod_ID'];
                                if ($idUser != null && $prodID != null) {
                                    $SQL_Delete = "DELETE FROM producto WHERE Prod_ID = $prodID ";
                                    $result = mysqli_query($connection, $SQL_Delete) or die(mysqli_error($connection));
                                    //MSG
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
                                                    <input type="text" class="col-10 col-sm-6 "class="form-control" name="Category" value="<?php echo $dataProd[$i]['Prod_Categoria']; ?>" required>
                                                </div>
                                                <div class="form-group"><!--PRICE -->
                                                    <p class="text-black">Price:</p>
                                                    <input type="text" class="col-10 col-sm-6 "class="form-control" name="Price" value="<?php echo $dataProd[$i]['Prod_Precio']; ?>" required>
                                                </div>
                                                <div class="form-group"><!--CODE -->
                                                    <p class="text-black">Code:</p>
                                                    <input type="text" class="col-10 col-sm-6 "class="form-control" name="Code" value="<?php echo $dataProd[$i]['Prod_Codigo']; ?>" required>
                                                </div>
                                                <div class="form-group"><!--SIZE -->
                                                    <p class="text-black">Size:</p>
                                                    <input type="text" class="col-10 col-sm-6 "class="form-control" name="Size" value="<?php echo $dataProd[$i]['Prod_Size']; ?>" required>
                                                </div>
                                                <div class="form-group"><!--IMAGE -->
                                                    <p class="text-black">Image URL (.png format recommended):</p>
                                                    <input type="text" class="col-10 col-sm-6 "class="form-control" name="Image" value="<?php echo $dataProd[$i]['Prod_Imagen1']; ?>" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary" name="<?php echo 'updateProd'.$i; ?>" >Update</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            // UPDATE CODE
                            if(isset($_POST['updateProd'.$i])){
                                $prodID = $dataProd[$i]['Prod_ID']; //GET ID
                                    // Sanitize our Data before UPDATE DB 
                                $name = mysqli_real_escape_string($connection, $_POST['Name']);
                                $category = mysqli_real_escape_string($connection, $_POST['Category']);
                                $price = mysqli_real_escape_string($connection, $_POST['Price']);
                                $code = mysqli_real_escape_string($connection, $_POST['Code']);
                                $size = mysqli_real_escape_string($connection, $_POST['Size']);
                                $image = mysqli_real_escape_string($connection, $_POST['Image']);

                                $SQL_Update = "UPDATE producto SET Prod_Nombre = '$name', Prod_Categoria = '$category', Prod_Precio = '$price',
                                Prod_Codigo = '$code', Prod_Size = '$size', Prod_Imagen1 = '$image' WHERE Prod_ID = '$prodID'";
                                $uResult = mysqli_query($connection, $SQL_Update);
                                //MSG
                            }
                        } // END FOR
                    }
                ?>
            </table>
        </div>
        <br><br>
