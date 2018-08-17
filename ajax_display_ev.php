<?php
require("init.php");

if(!$session->isSignedIn()){
    redirect("Login");
}else{

    $user = User::findById($session->userId); //user session
}
?>

<?php echo addAllEv() . ' KWH'; ?>