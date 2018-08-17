<?php
require("init.php");

if(isset($_POST['tev'])){

    $power = Power::currTev();

    if($power){

        $power->tev = $db->escapeString($_POST['tev']);
        $power->tev_eb = $db->escapeString($_POST['tev']);
        $power->price = $_POST['price'];

        $power->update();

        echo "
                <div class='alert alert-success alert-dismissible'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon fa fa-check'></i> Alert!</h4>
                    Updated
                </div>
            ";
    }else{
        echo "
                <div class='alert alert-danger alert-dismissible'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon fa fa-check'></i> Alert!</h4>
                    Unable to update
                </div>
            ";
    }
}

?>