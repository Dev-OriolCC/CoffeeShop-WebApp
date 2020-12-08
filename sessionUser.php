<?php
//$name ='';

    if (isset($_SESSION['id'])) {
        $idUser = $_SESSION['id'];
        $userName = $_SESSION['userName'];
    }else{
        //$name = '';
        $idUser = '';
    }
    if (isset($_SESSION['name'])) {
        $name = $_SESSION['name'];
    } else{
        $name = '';
    }
    if (isset($_SESSION['lastName'])) {
        $lastName = $_SESSION['lastName'];
    } else{
        $lastName = '';
    }
    if (isset($_SESSION['finalName'])) {
        $finalName = $_SESSION['finalName'];
    } else{
        $finalName = '';
    }
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
    } else{
        $email = '';
    }
    if (isset($_SESSION['address'])) {
        $address = $_SESSION['address'];
    } else{
        $address = '';
    }
    if (isset($_SESSION['gender'])) {
        $gender = $_SESSION['gender'];
    } else{
        $gender = '';
    }
    if (isset($_SESSION['phone'])) {
        $phone = $_SESSION['phone'];
    } else{
        $phone = '';
    }
    if (isset($_SESSION['referencia'])) {
        $referencia = $_SESSION['referencia'];
    } else{
        $referencia = '';
    }


?>