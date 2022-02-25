<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> | Clinic Management System</title>
    <!-- base:css -->
    <link rel="stylesheet" href="<?= base_url('assets/vendors/mdi/css/materialdesignicons.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendors/css/vendor.bundle.base.css') ?>">
    <!-- endinject -->

    <!-- plugin css for this page -->
    <link rel="stylesheet" href="<?= base_url('assets/vendors/jqvmap/jqvmap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendors/flag-icon-css/css/flag-icon.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendors/font-awesome/css/font-awesome.min.css') ?>"/>
    <link rel="stylesheet" href="<?= base_url('assets/vendors/jquery-toast-plugin/jquery.toast.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/daterangepicker.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendors/fullcalendar/fullcalendar.min.css') ?>">
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="<?= base_url('assets/css/vertical-layout-light/style.css') ?>">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.png') ?>" />

    <!-- Font Awesome -->
    <link href="<?= base_url('assets/css/fontawesome.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/brands.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/solid.css') ?>" rel="stylesheet">

    <!-- jQuery -->
    <link rel="stylesheet" href="<?= base_url('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') ?>">
    <script src="<?= base_url('assets/js/jquery-3.2.1.min.js') ?>"></script>
    <!-- End jQuery -->

    <!-- Sweet Alert -->
    <link rel="stylesheet" href="<?=base_url('assets/css/sweetalert2.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/css/sweetalert2.min.css')?>">

    <script src="<?=base_url('assets/js/sweetalert2.all.min.js')?>"></script>
    <script src="<?=base_url('assets/js/sweetalert2.min.js')?>"></script>
    <!-- End Sweet Alert -->

    <link rel="stylesheet" href="<?= base_url('assets/css/custom-general.css') ?>">

    <style>
        body {
            font-size: 15px;
        }
        .border-bottom {
            border-bottom: 1px solid #000000 !important;
        }
        @page {
            size: landscape;
        }
        .table tr th, .table tr td {
            padding: 0;
            margin: 0;
        }
    </style>
</head>
<body>
    
    <div class="container-fluid p-3 pb-5" id="pageContent">

        <div class="d-flex justify-content-start align-items-center border-bottom pb-3">
            <div>
                <img src="<?= base_url('assets/images/modules/bsu-logo.png') ?>"
                    height="100" width="100">
            </div>
            <div class="ml-4">
                <div>Republic of the Philippines</div>
                <div><b>CENTRAL BICOL STATE UNIVERSITY OF AGRICULTURE</b></div>
                <div>Impig, Sipocot, Camarines Sur - 4408</div>
                <div><i>Website: <a href="www.cbsua.edu.ph" target="_blank">www.cbsua.edu.ph</a></i></div>
            </div>
        </div>

        <div class="mt-3">
            <h4 class="text-center my-2 font-weight-bold">CUSTOMER SATISFACTORY SURVEY MONTHLY ACCOMPLISHMENT REPORT</h4>
            <h4 class="text-center my-2 font-weight-light"><?= '<sup>S/Y</sup> '.$year ?></h4>
        </div>

        <div class="mt-4">
            <table class="table table-bordered">
                <tr class="text-center">
                    <th rowspan="2" style="width: 100px; white-space: nowrap">Month</th>
                    <th colspan="5">Ratings 1 to 5</th>
                    <th rowspan="2" style="width: 100px; white-space: nowrap">Other & Suggestions</th>
                    <th rowspan="2" style="width: 100px; white-space: nowrap">Number of Respondent</th>
                </tr>
                <tr class="text-center">
                    <th style="width: 50px !important">
                        <div>1</div>
                        <small>Not Satisfied</small>
                    </th>
                    <th style="width: 50px !important">
                        <div>2</div>
                        <small>Fairly Satisfied</small>
                    </th>
                    <th style="width: 50px !important">
                        <div>3</div>
                        <small>Moderately Satisfied</small>
                    </th>
                    <th style="width: 50px !important">
                        <div>4</div>
                        <small>Highly Satisfied</small>
                    </th>
                    <th style="width: 50px !important">
                        <div>5</div>
                        <small>Absolutely Satisfied</small>
                    </th>
                </tr>

                <?php 
                    $col1 = $col2 = $col3 = $col4 = $col5 = $totalRespondent = 0;
                    foreach($data as $dt) { 
                        $average = $dt['average'];

                        $col1 += ($average == 1 ? 1 : 0);
                        $col2 += ($average == 2 ? 1 : 0);
                        $col3 += ($average == 3 ? 1 : 0);
                        $col4 += ($average == 4 ? 1 : 0);
                        $col5 += ($average == 5 ? 1 : 0);

                        $totalRespondent++;
                    }
                    $html = '
                    <tr class="text-center">
                        <td>'.strtoupper($monthName).'</td>
                        <td>'.$col1.'</td>
                        <td>'.$col2.'</td>
                        <td>'.$col3.'</td>
                        <td>'.$col4.'</td>
                        <td>'.$col5.'</td>
                        <td></td>
                        <td>'.$totalRespondent.'</td>
                    </tr>';

                    echo $html;
                ?>
            </table>

        </div>

    </div>

    <!-- base:js -->
    <script src="<?= base_url('assets/vendors/js/vendor.bundle.base.js') ?>"></script>
    <!-- endinject -->

    <!-- Plugin js for this page-->
    <script src="<?= base_url('assets/vendors/jquery.flot/jquery.flot.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/jquery.flot/jquery.flot.pie.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/jquery.flot/jquery.flot.resize.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/jqvmap/jquery.vmap.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/jqvmap/maps/jquery.vmap.world.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/jqvmap/maps/jquery.vmap.usa.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/peity/jquery.peity.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery.flot.dashes.js') ?>"></script>
    <!-- End plugin js for this page-->

    <!-- inject:js -->
    <script src="<?= base_url('assets/js/off-canvas.js') ?>"></script>
    <script src="<?= base_url('assets/js/hoverable-collapse.js') ?>"></script>
    <script src="<?= base_url('assets/js/template.js') ?>"></script>
    <script src="<?= base_url('assets/js/settings.js') ?>"></script>
    <script src="<?= base_url('assets/js/todolist.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/jquery-toast-plugin/jquery.toast.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/toastDemo.js') ?>"></script>
    <script src="<?= base_url('assets/js/desktop-notification.js') ?>"></script>
    <script src="<?= base_url('assets/js/moment.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/daterangepicker.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/fullcalendar/fullcalendar.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery.redirect.js') ?>"></script>
    <!-- endinject -->

    <!-- DataTables -->
    <script src="<?= base_url('assets/vendors/datatables.net/jquery.dataTables.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') ?>"></script>
    <!-- End DataTables -->

    <!-- Font Awesome -->
    <script defer src="<?= base_url('assets/js/brands.js') ?>"></script>
    <script defer src="<?= base_url('assets/js/solid.js') ?>"></script>
    <script defer src="<?= base_url('assets/js/fontawesome.js') ?>"></script>

    <script src="<?= base_url('assets/js/system-operations.js') ?>"></script>
    <script src="<?= base_url('assets/js/custom-general.js') ?>"></script>

    <script>

        window.print();

    </script>

</body>
</html>