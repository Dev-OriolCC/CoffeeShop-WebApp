<?php
    $connection = new mysqli('localhost', 'root', '', 'coffeeshop');
    mysqli_set_charset($connection, 'utf8');

    if (mysqli_connect_errno()) {
        echo "ERROR CONNECTION : ".mysqli_connect_error();
    }


?>