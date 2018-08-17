<?php
require("init.php");

if(!$session->isSignedIn()){
    redirect("Login");
}else{

    $user = User::findById($session->userId); //user session
    $sales = Sale::allSales5(); // Get top 5 sales
    $power = Power::currTev();
}
?>

    <?php
        if (!empty($sales)):
        $i = 1;
        foreach($sales as $sale):
    ?>
    <tr>
        <td class="c-table__cell"><?php echo $i++; ?></td>
        <td class="c-table__cell"><?php echo $sale->ev; ?></td>
        <td class="c-table__cell"><?php echo $sale->price; ?></td>
        <td class="c-table__cell"><?php echo $sale->eb; ?></td>
        <td class="c-table__cell"><?php echo $sale->amount; ?></td>
        <td class="c-table__cell"><?php echo $sale->date_sold; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php else: ?>
        No Records available
    <?php endif; ?>
