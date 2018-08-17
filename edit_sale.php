<?php

include("init.php");

if(!$session->isSignedIn()){
    redirect("Login");
}

if(empty($_GET['id'])){
    redirect("Sales-report");
}

$user = User::findById($session->userId);
$sale = Sale::findById($_GET['id']);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Edit Sale - <?php echo $sale->ev; ?></title>

    <meta content="Admin Dashboard" name="description" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App Icons -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- DataTables -->
    <link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

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
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item active">Edit Sale - <?php echo $sale->ev; ?></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Sale Info</h4>
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
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">

                        <h4 class="mt-0 header-title">Edit Energy Vended</h4>

                        <span id="update_status"></span>

                        <form id="update" action="" method="post">
                            <input type="hidden" id="id" name="id" value="<?php echo $sale->id; ?>">
                            <div class="form-group">
                                <label>Edit Energy Vended</label>
                                <div>
                                    <input data-parsley-type="number" type="text" name="ev"
                                           class="form-control" value="<?php echo $sale->ev; ?>" required />
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
        </div> <!-- end row -->

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
    //insert information
    $(document).ready(function(e){
        $("#update").on('submit', function(e){
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'ajax_editsale.php',
                data: new FormData(this),
                dataType: "html",
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function(){
                    $('.submit').attr("disabled","disabled");
                    $('#update').css("opacity",".5");
                },

                //success after submittion
                success: function(status){
                    $('#update_status').html(status);

                    //quick transparency after submission
                    $('#update').css("opacity","");

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

    // Ajax Display Amount
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

<!-- Required datatable js -->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Buttons examples -->
<script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables/jszip.min.js"></script>
<script src="assets/plugins/datatables/pdfmake.min.js"></script>
<script src="assets/plugins/datatables/vfs_fonts.js"></script>
<script src="assets/plugins/datatables/buttons.html5.min.js"></script>
<script src="assets/plugins/datatables/buttons.print.min.js"></script>
<script src="assets/plugins/datatables/buttons.colVis.min.js"></script>
<!-- Responsive examples -->
<script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="assets/plugins/datatables/responsive.bootstrap4.min.js"></script>

<!-- Datatable init js -->
<script src="assets/pages/datatables.init.js"></script>

<!-- App js -->
<script src="assets/js/app.js"></script>

</body>
</html>


