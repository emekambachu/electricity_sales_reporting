<?php

include("init.php");

$power = Power::currTev();

$ev = trim($_POST['ev']); //Energy Vended

$eb = $power->tev_eb - $ev; //Energy Balance

$amount = $power->price * $ev; //Amount

if( $ev < $power->tev_eb){ //If energy vended is greater than Temporary energy Balance
    $sale = new Sale();

    if($sale){
        $sale->ev = trim($ev);
        $sale->amount = $amount;
        $sale->price = $power->price;
        $sale->eb = $eb;
        $sale->date_sold = formatDateTime(date("Y-m-d H:i:s"));

        if($sale->create()){

            $power->tev_eb = $eb;
            $power->update(); //Update temporary TEV

            echo "							
                <div class='alert alert-success alert-dismissible'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon fa fa-check'></i> Alert!</h4>
                    You Successfully Sold $sale->ev KWA for ₦$sale->amount
                </div>
                <br>
                <ul>
                    <li>
                        <strong>Energy Balance:</strong> $sale->eb
                    </li>
                    <li>
                        <strong>Amount:</strong> ₦$sale->amount
                    </li>
                    <li>
                        <strong>Date of Sale:</strong> $sale->date_sold
                    </li>
                </ul>
            ";

        }else{

            echo join("<br>", $sale->errors);

        }

    }else{

        echo "
				<div class='alert alert-warning alert-dismissible'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
					<h4><i class='icon fa fa-ban'></i> Alert!</h4>
					Unable to Sell energy
				</div>
			";
    }
}else{
    echo "
				<div class='alert alert-warning alert-dismissible'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
					<h4><i class='icon fa fa-ban'></i> Alert!</h4>
					Can't sell more than your energy balance
				</div>
			";
}
?>