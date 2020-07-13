<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Parking Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <?php include_once('includes/sidebar.php');?>
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
     
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
           <?php include_once('includes/header.php');?>
            <!-- header area end -->
            <!-- page title area start -->
             <?php include_once('includes/pagetitle.php');?>
            <!-- page title area end -->
            <div class="main-content-inner">
                <!-- sales report area start -->
                <div class="col-10 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Total Car Parked</h4>
                            
                                <?php
                                $q = mysqli_query($con, "select loc_id, count(*) as count from reg_tag where loc_id = 'B1A1' group by loc_id;");
                                $s = mysqli_query($con, "select loc_id, count(*) as count from mthly_tag where loc_id = 'B1A1' group by loc_id;");
                                $r = mysqli_fetch_array($q);
                                $t = mysqli_fetch_array($s);
                                $u = $r['count'] + $t['count'];?>
                                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4" style="background-color:#4CAF50;" name="submit">B1A1 = <?php echo "\t\t\t\t" + $u; ?></button>

                                <?php
                                $a = mysqli_query($con, "select loc_id, count(*) as count from reg_tag where loc_id = 'B1H6' group by loc_id;");
                                $b = mysqli_query($con, "select loc_id, count(*) as count from mthly_tag where loc_id = 'B1H6' group by loc_id;");
                                $c = mysqli_fetch_array($a);
                                $d = mysqli_fetch_array($b);
                                $e = $c['count'] + $d['count'];?>
                                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4" name="submit">B1H6 = <?php echo $e; ?></button>  


                                <?php
                                $f = mysqli_query($con, "select loc_id, count(*) as count from reg_tag where loc_id = 'P1F7' group by loc_id;");
                                $g = mysqli_query($con, "select loc_id, count(*) as count from mthly_tag where loc_id = 'P1F7' group by loc_id;");
                                $h = mysqli_fetch_array($f);
                                $i = mysqli_fetch_array($g);
                                $j = $h['count'] + $i['count'];?>
                                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4" style="background-color:red;" name="submit">P1F7 = <?php echo $j; ?></button>
                        </div>
                    </div>
                </div>
                <!-- sales report area end -->           
                <!-- <div class="row">
                                <div class="col-lg-4 col-md-6" style="background-color: blue;">
                                    <div class="panel panel-primary" id="panel">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-xs-6 text-left">
                                                    <div class="desc">B1A1 </div>
                                                </div>
                                                <div class="col-xs-3">
                                                    <div class="desc">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
            </div>

        </div>
        <!-- main content area end -->
        <!-- footer area start-->
       <?php include_once('includes/footer.php');?>
        <!-- footer area end-->
    </div>
    <!-- page container area end -->
    <!-- offset area start -->
 
    <!-- offset area end -->
    <!-- jquery latest version -->
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>

    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="assets/js/line-chart.js"></script>
    <!-- all bar chart activation -->
    <script src="assets/js/bar-chart.js"></script>
    <!-- all pie chart -->
    <script src="assets/js/pie-chart.js"></script>
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>

</html>
