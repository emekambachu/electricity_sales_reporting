<?php
//load the database configuration file
require_once("init.php");
$power = Power::currTev();
$sales = Sale::findAll();

if(isset($_POST['submit'])){

    //validate whether uploaded file is a csv file
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$csvMimes)){
        if(is_uploaded_file($_FILES['file']['tmp_name'])){

            //open uploaded csv file with read only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');

            //skip first line
            fgetcsv($csvFile);

            //parse data from csv file line by line
            echo $eb = $power->tev_eb;
            $price = $power->price;
            $date = formatDateTime(date("Y-m-d H:i:s"));

            while(($line = fgetcsv($csvFile)) !== FALSE){
                $ev= $line[0];
                $ev_left = $eb - $ev;
                if($ev_left >= 0)
                {
                    $amount = $price*$ev;
                    $eb= $eb-$ev;
                    //insert member data into database
                    $db->query("INSERT INTO sales (ev, price, amount, eb, date_sold) VALUES ('".$ev."','".$price."','".$amount."','".$eb."','".$date."')");

                $power->tev_eb = $eb;
                $power->update();

                } else {
                    header("location:Sales-report?success=" . urlencode("Cannot Upload"));
                }

            }

            //close opened csv file
            fclose($csvFile);

            $qstring = '?status=succ';
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
}

//redirect to the listing page
header("location:Sales-report?success=" . urlencode("Success CSV Uploaded"));