<?php
session_start();
include('includes/dbconnection.php');
error_reporting(0);
if (strlen($_SESSION['ptmsaid']==0)) {
  header('location:logout.php');
  } else{


  
  ?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>View Ticket - Parking Management System</title>
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
    
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
     <?php include_once('includes/sidebar.php');?>
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
                <div class="row">
               
                    <div class="col-lg-8 col-ml-12">
                        <div class="row">
                            <!-- basic form start -->
                            <div class="col-12 mt-5">
                                <div class="card">
                                    <div class="card-body" id="exampl">
                                        <?php
 $vid=$_GET['viewid'];
$ret=mysqli_query($con,"select * from mthly_tag where rfid_uid='$vid'");
$cnt=1;

while ($row=mysqli_fetch_array($ret)) {

?>
                                        <h4 class="header-title" style="color: blue">View Detail of Ticket ID: <?php  echo $row['rfid_uid'];?></h4>
                                        <h5 class="header-title" style="color: blue">Visiting Date: <?php  echo $row['time'];?></h5>
                                        <h5 class="header-title" style="color: blue">Parking Location: <?php  
                                         $lid=$row['loc_id'];
$rets=mysqli_query($con,"select * from location where loc_id='$lid'");
$cnt=1;
while ($rows=mysqli_fetch_array($rets)) {
                                        echo $rows['loc_name'];}?></h5>
                                        <?php 
    function time_to_decimal($time) {
    $timeArr = explode(':', $time);
    $decTime = ($timeArr[0]) + ($timeArr[1]/60);
 
    return number_format((float)$decTime, 2, '.', '');
}

    date_default_timezone_set("Asia/Kuala_Lumpur");
    $now = new DateTime();
    $time = new DateTime($row['time']);
    $timediff = $time->diff($now);
    $pay=time_to_decimal($timediff->format('%h'));
    $day=$timediff->format('%d');
?>


                                        <table border="1" class="table table-striped table-bordered first" >
                                            <tr>
                                                <th>Duration Park</th>
                                                <th>Price per hour</th>
                                                <th>Total</th>
                                            </tr>
                                <tr>
                                     <td style="padding-left: 10px"><?php  if($day != '0'){
                                        echo $timediff->format('%d day %h hour %i minute');
                                     } 
                                     else {
                                        echo $timediff->format('%h hour %i minute');}?></td>
                                     <td style="padding-left: 10px"><?php  echo 'RM1/hour';?></td>
                                     <td style="padding-left: 10px">RM<?php if($day != '0'){
                                        $pays = $pay+($day*24);
                                        echo $pays;}
                                        else{
                                            echo number_format((float)$pay, 2, '.', '');}?></td>
                                </tr>
                                </table>
                                    </div>
                                    <?php } ?>
                                    <a href="delete2.php?viewid=<?php echo $vid;?>" class="btn btn-primary mt-4 pr-4 pl-4">Pay</a>
                                </div>
                            </div>
                            <!-- basic form end -->
                         
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        <?php include_once('includes/footer.php');?>
        <!-- footer area end-->
    </div>
    <!-- page container area end -->
    <!-- offset area start -->
    
    <!-- jquery latest version -->
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>

    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>

     <script>
function CallPrint(strid) {
var prtContent = document.getElementById("exampl");
var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
WinPrint.document.write(prtContent.innerHTML);
WinPrint.document.close();
WinPrint.focus();
WinPrint.print();
WinPrint.close();
}

</script>

</body>

</html>
<?php }  ?>