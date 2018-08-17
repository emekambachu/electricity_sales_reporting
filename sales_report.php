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
    <title>Sales Report</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Themesdesign" name="author" />
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
                            <li class="breadcrumb-item active">Sales Report</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Sales Report</h4>
                </div>
            </div>
        </div>
        <!-- end page title end breadcrumb -->

        <div class="row">
            <div class="col-12">

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

                <form action="upload_csv.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <div>
                            <label><i class="fa fa-upload"></i>Upload CSV File</label>
                            <input class="form-control" name="file" type="file" required>
                        </div>
                    </div>


                    <div class="form-group">
                        <div>
                            <button type="submit" name="submit" class="btn btn-primary waves-effect waves-light">
                                Upload
                            </button>

                        </div>
                    </div>
                </form>

                <div class="card m-b-30">
                    <div class="card-body">

                        <h4 class="mt-0 header-title">All Sales Report</h4>
                        <span id="status"></span>

                        <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Energy Vended</th>
                                <th>Price</th>
                                <th>Amount</th>
                                <th>Energy Balance</th>
                                <th>Date and Time</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>

                            <tbody>

                    <?php
                    if (!empty($sales)):
                        $i = 1;
                        foreach($sales as $sale):
                            ?>
                            <tr id="row_<?php echo $sale->id; ?>">
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $sale->ev.' KWH'; ?></td>
                                <td><?php echo '₦'.$sale->price; ?></td>
                                <td><?php echo '₦'.$sale->amount; ?></td>
                                <td><?php echo $sale->eb; ?> KWH</td>
                                <td><?php echo $sale->date_sold; ?></td>
                                <td>
                                    <a href="edit_sale.php?id=<?php echo $sale->id; ?>">
                                        <button class="btn btn-warning">Edit</button>
                                    </a>
                                </td>
                                <td>
                                    <button type="button" class="del_btn btn btn-danger" id="<?php echo $sale->id; ?>" title="Delete">Delete
                                    </button>
                                </td>
                            </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                        No Records available
                    <?php endif; ?>

                            </tbody>
                        </table>

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

<script type="text/javascript">
    //delete data
    $(document).ready(function(){
        $(document).on('click', '.del_btn', function(){
            var id = $(this).attr("id");
            if(confirm("Are you sure you want to delete this?")){
                $.ajax({
                    url: "ajax_delsale.php",
                    method: "POST",
                    data:{id:id},
                    success:function(status)
                    {
                        $('#status').html(status);
                        $('#row_'+id).hide();
                        fetch_data();
                    }
                });
            }
        });
    });
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