<div class="content-wrapper"
    id="content-wrapper"
    patientID="<?= $patient->patient_id ?>"
    monitoringFormID="<?= $monitoring_form_id ?>">

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0"><?= $title ?></h4>
                        <button class="btn btn-secondary" onclick="window.location.replace('<?= base_url('admin/monitoring_form') ?>')">Back</button>
                    </div>
                </div>
                <div class="card-body" id="pageContent">  
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text"
                                    class="form-control"
                                    value="<?= $patient->fullname ?>"
                                    disabled>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label>Occupation Type</label>
                                <input type="text"
                                    class="form-control"
                                    value="<?= $patient->patient_type_name ?>"
                                    disabled>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12" id="tableContent">
                            <div class="jumping-dots-loader my-5">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
    

<script>

    $(document).ready(function() {

        // ----- DATATABLES -----
        function initDataTables() {
            if ($.fn.DataTable.isDataTable("#tableMonitoringForm")) {
                $("#tableMonitoringForm").DataTable().destroy();
            }
            
            var table = $("#tableMonitoringForm")
                .css({ "min-width": "100%" })
                .removeAttr("width")
                .DataTable({
                    proccessing:    false,
                    serverSide:     false,
                    scrollX:        true,
                    sorting:        false,
                    searching:      false,
                    paging:         false,
                    ordering:       false,
                    info:           false,
                    scrollCollapse: true,
                    columnDefs: [
                        { targets: 0,  width: '100px' },
                        { targets: 1,  width: '100px' },
                        { targets: 2,  width: '50px'  },
                        { targets: 3,  width: '50px'  },
                        { targets: 4,  width: '50px'  },
                        { targets: 5,  width: '50px'  },
                        { targets: 6,  width: '50px'  },
                        { targets: 7,  width: '150px' },
                        { targets: 8,  width: '150px' },
                        { targets: 9,  width: '150px' },
                        { targets: 10, width: '150px' },
                        { targets: 11, width: '150px' },
                    ],
                });
        }
        // ----- END DATATABLES -----


        // ----- TABLE ROW -----
        function getTableRow(data = false) {
            let {
                monitoring_form_item_id,
                monitoring_form_id,
                patient_id,
                date,
                time,
                temperature,
                pulse_rate,
                respiratory_rate,
                blood_pressure,
                random_blood_sugar,
                referral,
                patient_case,
                activity,
                medicine_taken,
                status,
                is_deleted,
            } = data;

            let html = `
            <tr>
                <td>
                    <div class="form-group mb-0">
                        <input type="date" 
                            class="form-control validate"
                            name="date"
                            value="${moment(date || new Date).format("YYYY-MM-DD")}"
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </td>
                <td>
                    <div class="form-group mb-0">
                        <input type="time" 
                            class="form-control validate"
                            name="time"
                            value="${time || ""}"
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </td>
                <td>
                    <div class="form-group mb-0">
                        <input type="text"
                            class="form-control validate"
                            name="temperature"
                            value="${temperature || ""}"
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </td>
                <td>
                    <div class="form-group mb-0">
                        <input type="text"
                            class="form-control validate"
                            name="pulse_rate"
                            value="${pulse_rate || ""}"
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </td>
                <td>
                    <div class="form-group mb-0">
                        <input type="text"
                            class="form-control validate"
                            name="respiratory_rate"
                            value="${respiratory_rate || ""}"
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </td>
                <td>
                    <div class="form-group mb-0">
                        <input type="text"
                            class="form-control validate"
                            name="blood_pressure"
                            value="${blood_pressure || ""}"
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </td>
                <td>
                    <div class="form-group mb-0">
                        <input type="text"
                            class="form-control validate"
                            name="random_blood_sugar"
                            value="${random_blood_sugar || ""}"
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </td>
                <td>
                    <div class="form-group mb-0">
                        <input type="text" 
                            class="form-control validate"
                            name="medicine_taken"
                            minlength="1"
                            maxlength="500"
                            value="${medicine_taken || ""}"
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </td>
                <td>
                    <div class="form-group mb-0">
                        <input type="text" 
                            class="form-control validate"
                            name="activity"
                            minlength="1"
                            maxlength="500"
                            value="${activity || ""}"
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </td>
                <td>
                    <div class="form-group mb-0">
                        <input type="text" 
                            class="form-control validate"
                            name="referral"
                            minlength="1"
                            maxlength="500"
                            value="${referral || ""}">
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </td>
                <td>
                    <div class="form-group mb-0">
                        <select class="form-control validate"
                            name="status"
                            required>
                            <option value="" selected>Select status</option>    
                            <option value="0" ${status == "0" ? "selected" : ""}>Serious/Bad</option>     
                            <option value="1" ${status == "1" ? "selected" : ""}>Fair</option>    
                            <option value="2" ${status == "2" ? "selected" : ""}>Good</option>    
                        </select>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </td>
                <td style="vertical-align: top">
                    <div class="text-center">
                        <button class="btn btn-outline-danger btn-sm btnDelete">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </td>
            </tr>`;
            return html;
        }
        // ----- END TABLE ROW -----


        // ----- GENERATE INPUT ID -----
        function generateInputsID() {
            $('#tableTbody').find(`select, input, textarea`).each(function(i) {
                $parent = $(this).closest(".form-group");
                let name = $(this).attr("name");
                $(this).attr("id", `${name}${i}`);
                $parent.find(`.invalid-feedback`).attr("id", `invalid-${name}${i}`);
            })
        }
        // ----- END GENERATE INPUT ID -----


        // ----- TABLE CONTENT -----
        function tableContent() {
            let monitoring_form_id = $(`#content-wrapper`).attr('monitoringFormID');
            let patient_id = $(`#content-wrapper`).attr('patientID');

            let tbodyHTML = '';
            let tableData = getTableData(`monitoring_form_items WHERE monitoring_form_id = ${monitoring_form_id}`);
            tableData.map(i => {
                tbodyHTML += getTableRow(i);
            })

            let html = `
            <table class="table table-bordered table-hover" style="white-space: nowrap;" id="tableMonitoringForm">
                <thead class="text-center">
                    <tr>
                        <th rowspan="2">Date</th>
                        <th rowspan="2">Time</th>
                        <th colspan="5">Chief Complaint</th>
                        <th rowspan="2">
                            <div>Treat/Management<br>Nurse Notes</div>
                        </th>
                        <th rowspan="2">Other</th>
                        <th rowspan="2">Referral</th>
                        <th rowspan="2">Status</th>
                        <th rowspan="2">Action</th>
                    </tr>
                    <tr>
                        <th>Temperature</th>
                        <th>Pulse Rate</th>
                        <th>Respiratory Rate</th>
                        <th>Blood Pressure</th>
                        <th>Random Blood Sugar</th>
                    </tr>
                </thead>
                <tbody id="tableTbody">
                    ${tbodyHTML}
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="12">
                            <button class="btn btn-outline-primary btn-sm"
                                id="btnAddRow">
                                <i class="fas fa-plus"></i> Add Row    
                            </button>
                        </td>
                    </tr>
                </tfoot>
            </table>
            
            <div class="text-right mt-4">
                <a href="${base_url}admin/referral_form?patient_id=${patient_id}"
                    target="_black"
                    class="btn btn-outline-primary">Referral Form</a>
                <button class="btn btn-success"
                    id="btnSave"> Save
                </button>
            </div>`;

            setTimeout(() => {
                $("#tableContent").html(html);
                generateInputsID();
                initDataTables();
            }, 100);
        }
        tableContent();
        // ----- END TABLE CONTENT -----


        // ----- INSERT ROW NUMBER -----
        function insertRowNumber() {
            $("#tableTbody tr").each(function(i) {
                $('td', this).first().text(i+1);
            })
        }
        // ----- END INSERT ROW NUMBER -----


        // ----- BUTTON ADD ROW -----
        $(document).on("click", "#btnAddRow", function() {
            let row = getTableRow();
            $("#tableTbody").append(row);
            generateInputsID();
        })
        // ----- END BUTTON ADD ROW -----


        // ----- BUTTON DELETE ROW -----
        $(document).on('click', '.btnDelete', function() {
            let onlyOne = $(`#tableTbody tr`).length == 1;
            if (onlyOne) {
                showNotification('danger', 'You must have atleast one row');
            } else {
                $parent = $(this).closest('tr');
                $parent.fadeOut(500, function() {
                    $parent.remove();
                    insertRowNumber();
                })
            }

        })
        // ----- END BUTTON DELETE ROW -----


        // ----- BUTTON SAVE -----
        function getMonitoringItems() {
            let data = [];
            let monitoring_form_id = $(`#content-wrapper`).attr('monitoringFormID');
            let patient_id         = $(`#content-wrapper`).attr('patientID');
            $('#tableTbody tr').each(function() {
                let temp = {
                    monitoring_form_id,
                    patient_id,
                    date: $(`[name="date"`, this).val(),
                    time: $(`[name="time"`, this).val(),
                    temperature: $(`[name="temperature"`, this).val(),
                    pulse_rate: $(`[name="pulse_rate"`, this).val(),
                    respiratory_rate: $(`[name="respiratory_rate"`, this).val(),
                    blood_pressure: $(`[name="blood_pressure"`, this).val(),
                    random_blood_sugar: $(`[name="random_blood_sugar"`, this).val(),
                    medicine_taken: $(`[name="medicine_taken"`, this).val(),
                    activity: $(`[name="activity"`, this).val(),
                    referral: $(`[name="referral"`, this).val(),
                    status: $(`[name="status"`, this).val(),
                    patient_case: $(`[name="patient_case"`, this).val(),
                }
                data.push(temp);
            })
            return data;
        }

        $(document).on('click', '#btnSave', function() {
            if (validateForm("tableTbody")) {
                Swal.fire({
                    title: "SAVE MONITORING", 
                    text: "Are you sure you want to submit this monitoring?",
                    imageUrl: `<?= base_url() ?>assets/images/modal/add.svg`,
                    imageWidth: 200,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                    showCancelButton: true,
                    confirmButtonColor: '#2e6a78',
                    cancelButtonColor: '#1a1a1a',
                    cancelButtonText: 'No',
                    confirmButtonText: 'Yes',
                }).then(function(res) {
                    if (res.isConfirmed) {
                        let isGood = false;
                        $(`[name="status"]`).each(function() {
                            $(this).val() == 2 && (isGood = true);
                        })

                        let data = {
                            monitoring_form_id: $(`#content-wrapper`).attr('monitoringFormID'),
                            items: getMonitoringItems(),
                            isGood,
                        };

                        $.ajax({
                            method: "POST",
                            url: `${base_url}admin/monitoring_form/updateMonitoring`,
                            dataType: 'json',
                            async: true,
                            data,
                            success: function(data) {
                                let result = data.split("|");
                                if (result[0] == "true") {
                                    Swal.fire({
                                        icon:  'success',
                                        title: "Successfully saved",
                                        showConfirmButton: false,
                                        timer: 2000
                                    }).then(function() {
                                        // displayThankYou();
                                        window.open(`${base_url}admin/monitoring_form`, '_self');
                                    });
                                } 
                            }
                        })
                    }
                })
            }
        })
        // ----- END BUTTON SAVE -----

    })

</script>