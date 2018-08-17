<?php
require_once('init.php');

if($session->isSignedIn()){
	redirect("Dashboard");
}

if(isset($_POST['submit'])){
	$uname = trim($_POST['uname']);
	$pword = trim($_POST['pword']);
	
	$userFound = User::verifyUser($uname, $pword);
	
	if($userFound){
		$session->login($userFound);
		redirect("Dashboard");
	}else{
        header("location:Login?err=" . urlencode("Username or Password is incorrect"));
        exit();
	}
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

        <title>web-based Electricity Sales Reporting Application</title>

        <meta content="Admin Dashboard" name="description" />
        <meta content="" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App Icons -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

    </head>


    <body>

        <!-- Begin page -->
        <div class="accountbg"></div>
        <div class="wrapper-page">

            <div class="card">
                <div class="card-body">

                    <h3 class="text-center mt-0 m-b-15">
                        <a href="Login" class="logo logo-admin"><img src="assets/images/logo-dark.png" height="30" alt="logo"></a>
                    </h3>

                    <h4 class="text-muted text-center font-18"><b>Login</b></h4>

            <?php 
			  //display error messages
			     if(isset($_GET['err'])) {
			  ?>
              
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
               <?php echo $_GET['err'];?>
              </div>
              
              <?php } ?>
            
            
             <?php 
			  //display error messages
			     if(isset($_GET['success'])) {
			  ?>
              
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                <?php echo $_GET['success']; ?>
              </div>
              
              <?php } ?>
              
              
               <?php 
			  //display error messages
			     if(isset($_GET['notice'])) {
			  ?>
              
               <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                <?php echo $_GET['notice']; ?>
              </div>
              
              <?php } ?>

                    <div class="p-3">
                        <form class="form-horizontal m-t-20" method="post" action="">

                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control" type="text" name="uname" required="" placeholder="Username">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control" type="password" name="pword" required="" placeholder="Password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">Remember me</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group text-center row m-t-20">
                                <div class="col-12">
                                    <button class="btn btn-info btn-block waves-effect waves-light" name="submit" type="submit">Log In</button>
                                </div>
                            </div>

                            
                        </form>
                    </div>

                </div>
            </div>
        </div>



        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/modernizr.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>

    </body>
</html>