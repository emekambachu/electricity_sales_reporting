<?php

function addAllEv(){
    $query = "SELECT SUM(ev) FROM `sales`";
    global $db;

    $result = $db->query($query);

    if (!$result) {
        trigger_error('Invalid query: ' . $db->error);
    }

    while($rows = mysqli_fetch_row($result)){
        $sum = $rows[0];
    }

    if($sum == NULL){
        return '0';
    }else{
        return $sum;
    }
}

function addAllAmount(){
    $query = "SELECT SUM(amount) FROM `sales`";
    global $db;

    $result = $db->query($query);

    if (!$result) {
        trigger_error('Invalid query: ' . $db->error);
    }

    while($rows = mysqli_fetch_row($result)){
        $sum = $rows[0];
    }

    if($sum == NULL){
        return '0';
    }else{
        return $sum;
    }

}

?>