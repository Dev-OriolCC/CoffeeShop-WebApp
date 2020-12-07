<?php
    if (isset($_SESSION['id'])) {
        $idUser = $_SESSION['id'];
        $userName = $_SESSION['userName'];
    }else{
        $idUser = '';
    }


?>