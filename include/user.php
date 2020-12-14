<?php
    require_once('connect.php');

    

    function UserInfo($ID, $connection){
        $SQL_UserInfo = "SELECT * FROM cliente WHERE C_ID = ".$ID;
        $ResultUser = mysqli_query($connection, $SQL_UserInfo);

        if (mysqli_num_rows($ResultUser) >0) {
            while ($row = mysqli_fetch_assoc($ResultUser)) {
                $dataUser [] = $row;
            }
            return $dataUser;
        }
    }

?>