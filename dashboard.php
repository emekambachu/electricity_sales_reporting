<?php
require_once("init.php");

if(!$session->isSignedIn()){
    redirect("Login");
}else{

    $user = User::findById($session->userId); //user session
    $power = Power::currTev();
    $sales = Sale::findAll();
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

        <title>Dashboard</title>

        <meta content="Admin Dashboard" name="description" />
        <meta content="Themesdesign" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App Icons -->
        <link rel="shortcut icon" href="assets/images/faviicon.png">

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="assets/plugins/morris/morris.css">

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

        <script>

        </script>

    </head>


    <body>

        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <!-- Navigation Bar-->
        <header id="topnav">
            <?php include('layouts/header.php'); ?>
        </header>
        <!-- End Navigation Bar-->


        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0"></ol>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Dashboard</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->


                 <div class="row">

                    <div class="col-md-6 col-xl-3">
                        <div class="mini-stat clearfix bg-white">
                            <span class="mini-stat-icon"><i class="ti-shopping-cart"></i></span>
                            <div class="mini-stat-info text-right text-light">
                                <span id="display_tev" class="counter text-white">
                                </span> Total Energy Vendible

                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <div class="mini-stat clearfix bg-success">
                            <span class="mini-stat-icon"><i class="ti-user"></i></span>
                            <div class="mini-stat-info text-right text-light">
                                <span id="display_unit" class="counter text-white">
                                </span> Unit Price (KWH)
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <div class="mini-stat clearfix bg-orange">
                            <span class="mini-stat-icon"><i class="ti-shopping-cart-full"></i></span>
                            <div class="mini-stat-info text-right text-light">
                                <span id="display_ev" class="counter text-white"></span> Energy Vended
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <div class="mini-stat clearfix bg-info">
                            <span class="mini-stat-icon"><i class="ti-stats-up"></i></span>
                            <div class="mini-stat-info text-right text-light">
                                <span id="display_amount" class="counter text-white"></span> Total Amount
                            </div>
                        </div>
                    </div>

                     <div class="col-md-6 col-xl-3">
                         <div class="mini-stat clearfix bg-info">
                             <span class="mini-stat-icon"><i class="ti-stats-up"></i></span>
                             <div class="mini-stat-info text-right text-light">
                                 <span id="display_bal" class="counter text-white"></span> Energy Balance
                             </div>
                         </div>
                     </div>

                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card m-b-30">
                            <div class="card-body">

                                <h4 class="mt-0 header-title">Total Energy Vendable (TEV)</h4>
                                <p class="text-muted m-b-30 font-14">
                                Edit TEV and Unit Price per KWH
                                    </p>
                                <div id="status_tev"></div>

                                <form id="form_tev" action="" method="post">

                                    <div class="form-group">
                                        <label>Set Total Energy Vendible</label>
                                        <div>
                                            <input data-parsley-type="digits" type="number" name="tev"
                                                   class="form-control" value="<?php echo $power->tev; ?>" required
                                                   placeholder="Enter only digits"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Set Price</label>
                                        <div>
                                            <input data-parsley-type="digits" type="number" name="price" min="0" step=".01"
                                            class="form-control" value="<?php echo $power->price; ?>" required
                                                   placeholder="Enter only digits"
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div>
                                            <button type="submit" class="submit btn btn-primary waves-effect waves-light">
                                                Update
                                            </button>

                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div> <!-- end col -->

                    <div class="col-lg-6">
                        <div class="card m-b-30">
                            <div class="card-body">

                                <h4 class="mt-0 header-title">Energy Vended</h4>

                                <div id="status_ev"></div>

                                <form id="form_ev" action="" method="post">

                                    <div class="form-group">
                                        <label>Amount of Energy to sell</label>
                                        <div>
                                            <input data-parsley-type="digits" type="number" name="ev"
                                                   class="form-control" required
                                                   placeholder="Enter Amount"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div>
                                            <button type="submit" class="submit btn btn-primary waves-effect waves-light">
                                                Sell
                                            </button>

                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

                <div class="row">

                    <div class="col-xl-12">
                        <div class="card card-sec m-b-30">
                            <div class="card-body">
                                <h4 class="mt-0 m-b-15 header-title">Recent Sales Report</h4>

                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr class="titles">
                                                <th>S/N</th>
                                                <th>Energy Vended</th>
                                                <th>Price</th>
                                                <th>Amount</th>
                                                <th>Energy Balance</th>
                                                <th>Date and Time</th>
                                            </tr>
                                        </thead>
                                        <tbody id="display_sales">
<!--                                            <tr>-->
<!--                                                <td class="c-table__cell"></td>-->
<!--                                                <td class="c-table__cell">Dribble</td>-->
<!--                                                <td class="c-table__cell"><span class="badge badge-warning">Due</span></td>-->
<!--                                                <td class="c-table__cell">INV-001001</td>-->
<!--                                                <td class="c-table__cell">2011/04/25</td>-->
<!--                                                <td class="c-table__cell">$320,800</td>-->
<!--                                            </tr>-->
                                        </tbody>
                                    </table>
                                </div>            
                            </div>
                        </div>
                    </div>

                </div>
                <!-- end row -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->


        <!-- Footer -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        © 2018
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer -->


        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>

        <script>
            //Update TEV
            $(document).ready(function(e){
                $("#form_tev").on('submit', function(e){
                    e.preventDefault();
                    $.ajax({
                        type: 'POST',
                        url: 'ajax_update_tev.php',
                        data: new FormData(this),
                        dataType: "html",
                        contentType: false,
                        cache: false,
                        processData:false,
                        beforeSend: function(){
                            $('.submit').attr("disabled","disabled");
                            $('#form_tev').css("opacity",".5");
                        },

                        //success after submission
                        success: function(status){
                            $('#status_tev').html(status)

                            //quick transparency after submission
                            $('#form_tev').css("opacity","");

                            //clear all fields after submission
                            $(".submit").removeAttr("disabled");
                        }
                    });
                });
            });
        </script>

        <script>
            //Sell Energy
            $(document).ready(function(e){
                $("#form_ev").on('submit', function(e){
                    e.preventDefault();
                    $.ajax({
                        type: 'POST',
                        url: 'ajax_sell_energy.php',
                        data: new FormData(this),
                        dataType: "html",
                        contentType: false,
                        cache: false,
                        processData:false,
                        beforeSend: function(){
                            $('.submit').attr("disabled","disabled");
                            $('#form_ev').css("opacity",".5");
                        },

                        //success after submission
                        success: function(status){
                            $('#status_ev').html(status)

                            //quick transparency after submission
                            $('#form_ev').css("opacity","");

                            //clear all fields after submittion
                            $(".submit").removeAttr("disabled");
                        }
                    });
                });
            });
        </script>

        <script>
            // load all ajax functions
            function loadFunctions() {
                setInterval(function(){

                    ajax_display_tev();
                    ajax_display_bal();
                    ajax_display_unit();
                    ajax_display_ev();
                    ajax_display_amount();
                    ajax_display_sales_db();

                }, 1000);

            }

            //load functions on page load
            window.onload = loadFunctions;


            // Ajax Display TEV
            function ajax_display_tev(){
                var req = new XMLHttpRequest();
                req.onreadystatechange = function(){

                    if(req.readyState == 4 && req.status == 200){
                        document.getElementById('display_tev').innerHTML = req.responseText;
                    }
                };

                req.open('GET', 'ajax_display_tev.php', true);
                req.send();
            }

            // Ajax Display Bal
            function ajax_display_bal(){
                var req = new XMLHttpRequest();
                req.onreadystatechange = function(){

                    if(req.readyState == 4 && req.status == 200){
                        document.getElementById('display_bal').innerHTML = req.responseText;
                    }
                };

                req.open('GET', 'ajax_display_bal.php', true);
                req.send();
            }

            // Ajax Display EV
            function ajax_display_ev(){
                var req = new XMLHttpRequest();
                req.onreadystatechange = function(){

                    if(req.readyState == 4 && req.status == 200){
                        document.getElementById('display_ev').innerHTML = req.responseText;
                    }
                };

                req.open('GET', 'ajax_display_ev.php', true);
                req.send();
            }

            // Ajax Display Unit
            function ajax_display_unit(){
                var req = new XMLHttpRequest();
                req.onreadystatechange = function(){

                    if(req.readyState == 4 && req.status == 200){
                        document.getElementById('display_unit').innerHTML = req.responseText;
                    }
                };

                req.open('GET', 'ajax_display_unit.php', true);
                req.send();
            }

            // Ajax Display Amount
            function ajax_display_amount(){
                var req = new XMLHttpRequest();
                req.onreadystatechange = function(){

                    if(req.readyState == 4 && req.status == 200){
                        document.getElementById('display_amount').innerHTML = req.responseText;
                    }
                };

                req.open('GET', 'ajax_display_amount.php', true);
                req.send();
            }

            // Ajax Display Sales
            function ajax_display_sales_db(){
                var req = new XMLHttpRequest();
                req.onreadystatechange = function(){

                    if(req.readyState == 4 && req.status == 200){
                        document.getElementById('display_sales').innerHTML = req.responseText;
                    }
                };

                req.open('GET', 'ajax_display_sales_db.php', true);
                req.send();
            }


        </script>

        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/modernizr.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

        <!--Morris Chart-->
        <script src="assets/plugins/morris/morris.min.js"></script>
        <script src="assets/plugins/raphael/raphael-min.js"></script>

        <script src="assets/pages/dashborad.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>

    </body>
</html>