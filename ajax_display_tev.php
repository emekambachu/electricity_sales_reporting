<?php
    require("init.php");

    if(!$session->isSignedIn()){
        redirect("Login");
    }else{

        $user = User::findById($session->userId); //user session
        $power = Power::currTev();
    }
?>

<?php echo $power->tev . ' KWH'; ?>