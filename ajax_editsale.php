<?php
require_once('init.php');

if(isset($_POST['id'])){

    $power = Power::currTev();

    $id = $_POST['id'];

    $sale = Sale::findById($id);

    $oldEv = $sale->ev; //Old Energy Vended
    $newEv = trim($_POST['ev']); // New Energy Vended

    if($newEv < $power->tev_eb) {

        if($sale){

            if($newEv > $oldEv){
                $remain = $newEv - $oldEv; // new energy vended minus old energy vended
                $exAmt = $remain * $power->price;
                $newEb = $power->tev_eb - $remain; //New Energy Balance
                $newAmount = $exAmt + $sale->amount; // New Amount

            }elseif($newEv < $oldEv){
                $remain = $oldEv - $newEv; // new energy vended minus old energy vended
                $exAmt = $remain * $power->price;
                $newEb = $power->tev_eb + $remain; //New Energy balance
                $newAmount = $sale->amount - $exAmt; // New Amount
            }else{
                echo "
                    <div class='alert alert-warning alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-exclamation-circle'></i> Alert!</h4>
                        No changes were made
                    </div>
                ";
                exit();
            }

            $sale->ev = $db->escapeString($newEv);
            $sale->amount = $db->escapeString($newAmount);
            $sale->eb = $db->escapeString($newEb);

            if($sale->update()){
                $power->tev_eb = $db->escapeString($newEb);

                if($power->update()){
                    echo "<div align='center' style='background-color:green; width:100%; padding-top:5px; padding-bottom:5px; margin-bottom:3px; color:#fff; '>Successfully Updated</div>";
                }else{
                    echo "
                        <div class='alert alert-warning alert-dismissible'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <h4><i class='icon fa fa-exclamation-circle'></i> Alert!</h4>
                            Unable to update new energy balance
                        </div>
                    ";
                }

            }else{
                echo "
                    <div class='alert alert-warning alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-exclamation-circle'></i> Alert!</h4>
                        Unable to update current sale
                    </div>
                ";
            }

        } else {
            echo "
                    <div class='alert alert-warning alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-exclamation-circle'></i> Alert!</h4>
                        Unable to update sales
                    </div>
                ";
        }

    }else{
        echo "
            <div class='alert alert-warning alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-exclamation-circle'></i> Alert!</h4>
                Not enough energy to vend, balance is $power->tev_eb
            </div>
        ";
    }
}

?>