<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ITL Company</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/my.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="/assets/images/favicon.ico"/>
    <script src="assets/js/jquery3.5.1.js"></script>

    <link rel="stylesheet" href="assets/dtpicker/themes/default.css">
    <!-- Default Theme (Date Picker) -->
    <link rel="stylesheet" href="assets/dtpicker/themes/default.date.css">
    <!-- Default Theme (Time Picker If Needed)-->
    <link rel="stylesheet" href="assets/dtpicker/themes/default.time.css">

</head>
<body>


<?php echo  $this->renderSection('content') ?>


<!-- plugins:js -->
<script src="assets/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="assets/vendors/chart.js/Chart.min.js"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="assets/js/off-canvas.js"></script>
<script src="assets/js/hoverable-collapse.js"></script>
<script src="assets/js/misc.js"></script>


<script src="assets/dtpicker/picker.js"></script>

<script src="assets/dtpicker/picker.date.js"></script>
<!-- Time Picker -->
<script src="assets/dtpicker/picker.time.js"></script>
<!-- Language -->
<script src="assets/dtpicker/translations/ru_RU.js"></script>
<!-- Required For Legacy Browsers (IE 8-) -->
<script src="assets/dtpicker/legacy.js"></script>


<script>
    $('[name="deadlineDate"]').pickadate({
            format: 'dd.mm.yyyy',
        }
    );
    $('[name="deadlineTime"]').pickatime({
            format: 'hh:i',
        }
    );
</script>



<!-- endinject -->
<!-- Custom js for this page -->
<!--<script src="/assets/js/dashboard.js"></script>-->
<!--<script src="/assets/js/todolist.js"></script>-->
<!-- End custom js for this page -->
</body>
</html>