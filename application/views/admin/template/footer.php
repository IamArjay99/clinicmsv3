                <!-- ----- FOOTER ----- -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <h4 class="font-weight-bold text-muted text-center text-sm-left d-block d-sm-inline-block" style="font-family: cursive;">Copyright © <?= date('Y') ?> <a href="javascript: void(0)" class="text-muted">Clinic Management System</a>. All rights reserved.</h4>
                    </div>
                </footer>
                <!-- ----- END FOOTER ----- -->
            </div>
            <!-- ----- END MAIN CONTENT ----- -->


            <!-- ----- MODAL ----- -->
            <div id="modal" class="modal custom-modal fade" data-backdrop="static" data-keyboard="false" role="dialog">
                <div class="modal-dialog modal-md mt-5" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-light">
                            <h4 class="page-title font-weight-bold text-white"></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span class="text-light" aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div id="modal_content"></div>
                    </div>
                </div>
            </div>
            <!-- ----- END MODAL ----- -->
        

        </div>
        <!-- ----- END CONTENT ----- -->


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
    <script src="<?= base_url('assets/vendors/chart.js/Chart.min.js') ?>"></script>
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
    <script src="<?= base_url('assets/vendors/inputmask/jquery.inputmask.bundle.js') ?>"></script>
    <script src="<?= base_url('assets/js/inputmask.js') ?>"></script>
    <!-- endinject -->

    <!-- DataTables -->
    <script src="<?= base_url('assets/vendors/datatables.net/jquery.dataTables.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') ?>"></script>
    <!-- End DataTables -->

    <!-- Font Awesome -->
    <script defer src="<?= base_url('assets/js/brands.js') ?>"></script>
    <script defer src="<?= base_url('assets/js/solid.js') ?>"></script>
    <script defer src="<?= base_url('assets/js/fontawesome.js') ?>"></script>
    <!-- End Font Awesome -->

    <script src="<?= base_url('assets/js/system-operations.js') ?>"></script>
    <script src="<?= base_url('assets/js/custom-general.js') ?>"></script>

    <script>

        $(document).ready(function() {

            let notificationAlert = getTableData(
                `check_ups AS cu
                    LEFT JOIN patients AS p USING(patient_id)
                    LEFT JOIN monitoring_forms AS mf ON cu.check_up_id = mf.check_up_id
                WHERE DATE(cu.created_at) = DATE(NOW())
                    AND (CONVERT(cu.temperature, DECIMAL) > 37.2
                        OR CONVERT(respiratory_rate, DECIMAL) < 12 OR CONVERT(respiratory_rate, DECIMAL) > 20
                        OR CONVERT(pulse_rate, DECIMAL) < 60 OR CONVERT(pulse_rate, DECIMAL) > 100
                        OR CONVERT(random_blood_sugar, DECIMAL) > 140)`,
                `cu.check_up_id,
                cu.patient_id,
                temperature,
                CONCAT(firstname, ' ', middlename, ' ', lastname, ' ', suffix) AS fullname,
                mf.status`
            );
            if (notificationAlert && notificationAlert.length) {
                let html = '';
                notificationAlert.map(notif => {
                    if (!notif.status) { // NOT YET CREATED
                        html += `
                        <div class="px-3 py-0 mb-0">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <div>
                                    <strong>Warning!</strong> ${notif.fullname} is <b>NOT</b> in good condition.
                                    <a href="#" patientID="${notif.patient_id}"
                                        patientName="${notif.fullname}"
                                        checkUpID="${notif.check_up_id}"
                                        class="btnMonitorNow text-warning font-weight-bold" style="text-decoration: underline">Monitor now.</a>
                                </div>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>`;
                    }
                })
                $("#notificationContent").html(html);
            }


            // ----- BUTTON MONITOR NOW -----
            $(document).on("click", ".btnMonitorNow", function() {
                let checkUpID   = $(this).attr("checkUpID");
                let patientID   = $(this).attr("patientID");
                let patientName = $(this).attr("patientName");

                Swal.fire({
                    title: "MONITOR NOW", 
                    html: `Do you want to monitor patient <b>${patientName}</b>?`,
                    showCancelButton: true,
                    confirmButtonColor: '#2e6a78',
                    cancelButtonColor: '#1a1a1a',
                    cancelButtonText: 'No',
                    confirmButtonText: 'Yes',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: "POST",
                            url: `<?= base_url('admin/monitoring_form/monitorPatient') ?>`,
                            data: { checkUpID, patientID },
                            success: function(data) {
                                if (data == "true") {
                                    Swal.fire({
                                        icon: 'success',
                                        title: "Patient monitoring form successfully added",
                                        showConfirmButton: false,
                                        timer: 2000
                                    }).then(function() {
                                        window.open(`<?= base_url('admin/monitoring_form') ?>`, '_self');
                                    })
                                } else {
                                    alert("There's an error saving this monitoring. Please try again later.")
                                }
                            }
                        })
                    }
                });
            })
            // ----- END BUTTON MONITOR NOW -----




            // ----- NEW MESSAGES INTERVAL -----
            let LAST_ID = 0; PATIENT_ID = 0;
            let patientList = getTableData(
                `patients AS p 
                    LEFT JOIN patient_type AS pt USING(patient_type_id)
                WHERE p.is_deleted = 0`,
                `patient_id, CONCAT(firstname, ' ', lastname) AS fullname, pt.name AS occupationType`
            );

            setInterval(() => {
                if (patientList && patientList.length) {
                    let getUnreadMessages = getTableData(
                        `patients AS p
                        ORDER BY last_message`,
                        `p.patient_id,
                        (SELECT COUNT(*) FROM messages WHERE is_read = 0 AND is_admin = 0 AND patient_id = p.patient_id AND is_deleted = 0) AS count,
                        (SELECT created_at FROM messages WHERE patient_id = p.patient_id ORDER BY created_at DESC LIMIT 1) AS last_message`
                    );
                    let total = 0;
                    getUnreadMessages.map(i => {
                        let { patient_id, count = 0 } = i;
                        total += parseFloat(count) > 0 ? 1 : 0;

                        $(`.patient[patientID="${patient_id}"]`).prependTo("#tableTbody");
                        
                        if (count > 0) {
                            $(`.patient[patientID="${patient_id}"]`).addClass("unread");
                        } else {
                            $(`.patient[patientID="${patient_id}"]`).removeClass("unread");
                        }
                    })

                    if (total > 0) {
                        $("#unreadMessagesCount").html(`<span class="badge badge-danger">${total}</span>`);
                    } else {
                        $("#unreadMessagesCount").empty();
                    }
                }
            }, 2000);
            // ----- END NEW MESSAGES INTERVAL -----

        })

    </script>

</body>
</html>