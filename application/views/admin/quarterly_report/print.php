<?php 

    $quarter = 1;
    if ($quarter == 1) {
        $quarter = "$quarter<sup>ST</sup>";
    }

?>

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
            font-size: 1.15rem;
        }
        .border-bottom {
            border-bottom: 1px solid #000000 !important;
        }
    </style>
</head>
<body>
    
    <div class="container-fluid p-3 pb-5" id="pageContent">

        <div class="d-flex justify-content-center align-items-center border-bottom pb-3">
            <div class="text-center">
                <img src="<?= base_url('assets/images/modules/bsu-logo.png') ?>"
                    height="100" width="100">
                    <small>
                        <div>ISO 9001:2015</div>
                        <div>CERTIFIED</div>
                    </small>
            </div>
            <div class="ml-4 text-center">
                <div>Republic of the Philippines</div>
                <div><b>CENTRAL BICOL STATE UNIVERSITY OF AGRICULTURE</b></div>
                <div>Impig, Sipocot, Camarines Sur - 4408</div>
                <div><i>Website: <a href="www.cbsua.edu.ph" target="_blank">www.cbsua.edu.ph</a></i></div>
            </div>
        </div>

        <div class="mt-3">
            <h4 class="text-center my-2 font-weight-bold">HEALTH AND MEDICAL UNIT ACCOMPLISHMENT REPORT</h4>
            <h4 class="text-center my-2 font-weight-light"><?= $quarter." QUARTER, $year" ?></h4>
        </div>

        <div class="mt-4">
            <table class="table table-bordered">
                <tr class="text-center">
                    <th>No.</th>
                    <th>Occupation Type</th>
                    <th>Dispensing of Medicine</th>
                    <th>Medical and Dental Services</th>
                    <th>Others</th>
                    <th>No. of clients served</th>
                </tr>

                <?php 
                    $html = '';
                    foreach($data as $dt) { 
                        $monthName = $dt['monthName'];
                        $items     = $dt['items'];

                        $html .= '
                        <tr>
                            <td class="text-center" colspan="6">'.$monthName.'</td>
                        </tr>';

                        foreach ($items as $i => $x) {
                            $occupationName = $x['occupationName'];
                            $services       = $x['services'];
                            $total          = $x['total'];

                            $countHTML = '';
                            foreach ($services as $y) $countHTML .= '<td>'.$y['total'].'</td>';

                            $html .= '
                            <tr class="text-center">
                                <td>'.($i+1).'</td>
                                <td>'.$occupationName.'</td>
                                '.$countHTML.'
                                <td>0</td>
                                <td>'.$total.'</td>
                            </tr>';
                        }
                    }
                    echo $html;
                ?>
            </table>

        </div>


        <div class="w-100 mt-5 d-flex justify-content-end">
            <div class="text-left"><strong>Prepared By:</strong></div>
            <div class="d-flex justify-content-end align-items-end mt-5">
            <div class="w-100 text-center" style="border-top: 2px solid black">
                    <?=$fullname?>
                    <div>Nurse</div>
            </div>         
            </div>
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