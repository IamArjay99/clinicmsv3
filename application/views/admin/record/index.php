<div class="content-wrapper">

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-header bg-dark text-white">    
                    <h4 class="mb-0">Records</h4>
                </div>      
                <div class="card-body" id="pageContent">
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


<script>

    $(document).ready(function() {

        // ----- DATATABLES -----
        function initDataTables() {
            if ($.fn.DataTable.isDataTable("#tableMedicalRecord")) {
                $("#tableMedicalRecord").DataTable().destroy();
            }
            var table = $("#tableMedicalRecord")
                .css({ "min-width": "100%" })
                .removeAttr("width")
                .DataTable({
                    proccessing:    false,
                    serverSide:     false,
                    scrollX:        true,
                    sorting:        [],
                    scrollCollapse: true,
                    columnDefs: [
                        { targets: 0, width: "50px"  },	
                        { targets: 1, width: "150px" },	
                        { targets: 2, width: "150px" },	
                        { targets: 3, width: "100px" },	
                    ],
                });

            if ($.fn.DataTable.isDataTable("#tableDispensingMedicineRecord")) {
                $("#tableDispensingMedicineRecord").DataTable().destroy();
            }
            var table = $("#tableDispensingMedicineRecord")
                .css({ "min-width": "100%" })
                .removeAttr("width")
                .DataTable({
                    proccessing:    false,
                    serverSide:     false,
                    scrollX:        true,
                    sorting:        [],
                    scrollCollapse: true,
                    columnDefs: [
                        { targets: 0, width: "50px"  },	
                        { targets: 1, width: "100px" },	
                        { targets: 2, width: "150px" },	
                        { targets: 3, width: "100px" },	
                        { targets: 4, width: "100px" },	
                        { targets: 5, width: "100px" },	
                        { targets: 6, width: "100px" },	
                        { targets: 7, width: "100px" },
                    ],
                });

            if ($.fn.DataTable.isDataTable("#tablePatientRecord")) {
                $("#tablePatientRecord").DataTable().destroy();
            }
            var table = $("#tablePatientRecord")
                .css({ "min-width": "100%" })
                .removeAttr("width")
                .DataTable({
                    proccessing:    false,
                    serverSide:     false,
                    scrollX:        true,
                    sorting:        [],
                    scrollCollapse: true,
                    columnDefs: [
                        { targets: 0, width: "50px"  },	
                        { targets: 1, width: "100px" },	
                        { targets: 2, width: "150px" },	
                        { targets: 3, width: "100px" },	
                        { targets: 4, width: "100px" },	
                        { targets: 5, width: "100px" },	
                        { targets: 6, width: "100px" },	
                    ],
                });

            if ($.fn.DataTable.isDataTable("#tableAppointmentRecord")) {
                $("#tableAppointmentRecord").DataTable().destroy();
            }
            var table = $("#tableAppointmentRecord")
                .css({ "min-width": "100%" })
                .removeAttr("width")
                .DataTable({
                    proccessing:    false,
                    serverSide:     false,
                    scrollX:        true,
                    sorting:        [],
                    scrollCollapse: true,
                    columnDefs: [
                        { targets: 0, width: "50px"  },	
                        { targets: 1, width: "150px" },	
                        { targets: 2, width: "100px" },	
                        { targets: 3, width: "100px" },	
                        { targets: 4, width: "100px" },	
                        { targets: 5, width: "100px" },	
                        { targets: 6, width: "100px" },	
                    ],
                });

            if ($.fn.DataTable.isDataTable("#tableMedicineRecord")) {
                $("#tableMedicineRecord").DataTable().destroy();
            }
            var table = $("#tableMedicineRecord")
                .css({ "min-width": "100%" })
                .removeAttr("width")
                .DataTable({
                    proccessing:    false,
                    serverSide:     false,
                    scrollX:        true,
                    sorting:        [],
                    scrollCollapse: true,
                    columnDefs: [
                        { targets: 0, width: "50px"  },	
                        { targets: 1, width: "150px" },	
                        { targets: 2, width: "100px" },	
                        { targets: 3, width: "100px" },	
                        { targets: 4, width: "100px" },	
                        { targets: 5, width: "100px" },	
                    ],
                });

            if ($.fn.DataTable.isDataTable("#tableCareEquipmentRecord")) {
                $("#tableCareEquipmentRecord").DataTable().destroy();
            }
            var table = $("#tableCareEquipmentRecord")
                .css({ "min-width": "100%" })
                .removeAttr("width")
                .DataTable({
                    proccessing:    false,
                    serverSide:     false,
                    scrollX:        true,
                    sorting:        [],
                    scrollCollapse: true,
                    columnDefs: [
                        { targets: 0, width: "50px"  },	
                        { targets: 1, width: "150px" },	
                        { targets: 2, width: "100px" },	
                        { targets: 3, width: "100px" },	
                    ],
                });

        }
        // ----- END DATATABLES -----


        // ----- PAGE CONTENT -----
        function pageContent() {
            !document.getElementsByClassName("jumping-dots-loader").length && $("#pageContent").html(preloader);

            let html = `
            <div class="row">
                <div class="col-12" id="filterContent">
                    <div class="row mb-4">
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label>Record</label>
                                <select class="form-control" 
                                    name="filter_record">
                                    <option value='' selected disabled>Select record</option>
                                    <option value='1'>Medical Record</option>
                                    <option value='2'>Dispensing Medicine Record</option>
                                    <option value='3'>Patient Record</option>
                                    <option value='4'>Appointment Record</option>
                                    <option value='5'>Medicine Record</option>
                                    <option value='6'>Care Equipment Record</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12" id="tableContent">
                    <div class="w-100 py-5 text-center">
                        <img src="${base_url}assets/images/modal/select.svg"
                            width="200" height="200" alt="Select record">
                        <h4 class="mt-3">Please select record</h4>
                    </div>
                </div>
            </div>`;

            setTimeout(() => {
                $("#pageContent").html(html);
                initDataTables();
            }, 100);
        }
        pageContent();
        // ----- END PAGE CONTENT -----


        // ----- MEDICAL RECORD CONTENT -----
        function getMedicalRecordContent()
        {
            let data = getTableData(
                `check_ups AS cu
                    LEFT JOIN patients AS p ON cu.patient_id = p.patient_id
                WHERE cu.is_deleted = 0
                    AND cu.service_id = 1`,
                `cu.*, CONCAT(firstname, ' ', middlename, ' ', lastname, ' ', suffix) AS fullname`
            );

            let tbodyHTML = '';
            if (data && data.length) {
                data.map((item, index) => {
                    tbodyHTML += `
                    <tr>
                        <td class="text-center">${index + 1}</td>
                        <td>${item.created_at ? moment(item.created_at).format("MMMM DD, YYYY") : "-"}</td>
                        <td>${item.fullname}</td>
                        <td class="text-center">
                            <a href="${base_url}admin/record/view_service?id=${item.check_up_id}&type=medical"
                                target="_blank"
                                class="btn btn-outline-info">
                                <i class="fas fa-eye"></i> View    
                            </a>
                        </td>
                    </tr>`;
                })
            }

            let html = `
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Medical Record</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover" id="tableMedicalRecord">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Date</th>
                                <th>Patient Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${tbodyHTML}
                        </tbody>
                    </table>
                </div>
            </div>`;
            return html;
        }
        // ----- END MEDICAL RECORD CONTENT -----


        // ----- DISPENSING MEDICINE RECORD CONTENT -----
        function getDispensingMedicineRecordContent()
        {
            let data = getTableData(
                `check_ups AS cu
                    LEFT JOIN patients AS p ON cu.patient_id = p.patient_id
                WHERE cu.is_deleted = 0
                    AND cu.service_id = 3`,
                `cu.*, CONCAT(firstname, ' ', middlename, ' ', lastname, ' ', suffix) AS fullname`
            );

            let tbodyHTML = '';
            if (data && data.length) {
                data.map((item, index) => {
                    tbodyHTML += `
                    <tr>
                        <td class="text-center">${index + 1}</td>
                        <td>${item.created_at ? moment(item.created_at).format("MMMM DD, YYYY") : "-"}</td>
                        <td>${item.fullname}</td>
                        <td class="text-center">
                            <a href="${base_url}admin/record/view_service?id=${item.check_up_id}&type=dispensing_medicine"
                                target="_blank"
                                class="btn btn-outline-info">
                                <i class="fas fa-eye"></i> View    
                            </a>
                        </td>
                    </tr>`;
                })
            }

            let html = `
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Dispensing Medicine Record</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover" id="tableMedicalRecord">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Date</th>
                                <th>Patient Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${tbodyHTML}
                        </tbody>
                    </table>
                </div>
            </div>`;
            return html;
        }
        // ----- END DISPENSING MEDICINE RECORD CONTENT -----


        // ----- DISPENSING MEDICINE RECORD CONTENT -----
        function getDispensingMedicineRecordContent2()
        {
            let data = getTableData(
                `check_ups AS cu
                    LEFT JOIN check_up_medicines AS cum USING(check_up_id)
                    LEFT JOIN medicines AS m ON cum.medicine_id = m.medicine_id
                    LEFT JOIN units AS u ON m.unit_id = u.unit_id
                    LEFT JOIN measurements AS m2 ON m.measurement_id = m2.measurement_id
                    LEFT JOIN category AS c ON m.category_id = c.category_id
                    LEFT JOIN patients AS p ON cum.patient_id = p.patient_id
                WHERE cu.is_deleted = 0
                    AND cu.service_id = 3`,
                `cu.*, cum.quantity, m.name AS medicine_name, u.name AS unit_name, m2.name AS measurement_name, c.name AS category_name, CONCAT(firstname, ' ', middlename, ' ', lastname, ' ', suffix) AS fullname`
            );

            let tbodyHTML = '';
            if (data && data.length) {
                data.map((item, index) => {
                    tbodyHTML += `
                    <tr>
                        <td class="text-center">${index + 1}</td>
                        <td>${item.created_at ? moment(item.created_at).format("MMMM DD, YYYY") : "-"}</td>
                        <td>${item.fullname}</td>
                        <td>${item.medicine_name}</td>
                        <td>${item.category_name || "-"}</td>
                        <td>${item.unit_name || "-"}</td>
                        <td>${item.measurement_name || "-"}</td>
                        <td>${item.quantity}</td>
                    </tr>`;
                })
            }

            let html = `
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Dispensing Medicine Record</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover" id="tableDispensingMedicineRecord">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Date</th>
                                <th>Patient Name</th>
                                <th>Medicine</th>
                                <th>Category</th>
                                <th>Unit</th>
                                <th>Measurement</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${tbodyHTML}
                        </tbody>
                    </table>
                </div>
            </div>`;
            return html;
        }
        // ----- END DISPENSING MEDICINE RECORD CONTENT -----


        // ----- PATIENT RECORD CONTENT -----
        function getPatientRecordContent()
        {
            let data = getTableData(
                `patients AS p
                    LEFT JOIN courses AS c USING(course_id)
                    LEFT JOIN years AS y USING(year_id)
                    LEFT JOIN patient_type AS pt USING(patient_type_id)
                WHERE p.is_deleted = 0`,
                `p.*, c.name AS course_name, y.name AS year_name, CONCAT(firstname, ' ', middlename, ' ', lastname, ' ', suffix) AS fullname, pt.name AS patient_type`
            );

            let tbodyHTML = '';
            if (data && data.length) {
                data.map((item, index) => {
                    tbodyHTML += `
                    <tr>
                        <td class="text-center">${index + 1}</td>
                        <td>${item.patient_code}</td>
                        <td>${item.fullname}</td>
                        <td>${item.patient_type}</td>
                        <td>${item.course_name || "-"}</td>
                        <td>${item.year_name || ""} - ${item.section || ""}</td>
                        <td class="text-center">
                            <a href="${base_url}admin/record/view_patient?id=${item.patient_id}"
                                target="_blank"
                                class="btn btn-outline-info">
                                <i class="fas fa-eye"></i> View    
                            </a>
                        </td>
                    </tr>`;
                })
            }

            let html = `
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Patient Record</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover" id="tablePatientRecord">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Patient ID</th>
                                <th>Patient Name</th>
                                <th>Patient Type</th>
                                <th>Course</th>
                                <th>Year & Section</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${tbodyHTML}
                        </tbody>
                    </table>
                </div>
            </div>`;
            return html;
        }
        // ----- END PATIENT RECORD CONTENT -----


        // ----- APPOINTMENT RECORD CONTENT -----
        function getAppointmentRecordContent()
        {
            let data = getTableData(
                `clinic_appointments AS ca
                    LEFT JOIN patients AS p USING(patient_id)
                    LEFT JOIN patient_type AS pt ON p.patient_type_id = pt.patient_type_id
                    LEFT JOIN services AS s USING(service_id)
                WHERE ca.is_deleted = 0
                ORDER BY ca.date_appointment DESC`,
                `ca.*, CONCAT(firstname, ' ', middlename, ' ', lastname, ' ', suffix) AS fullname, s.name AS service_name, pt.name AS patient_type`
            );

            let tbodyHTML = '';
            if (data && data.length) {
                data.map((item, index) => {
                    let status = item.is_done == 0 ? `
                    <span class="badge badge-warning">Pending</span>` : item.is_done == 1 ? `
                    <span class="badge badge-success">Completed</span>` : 
                    `<span class="badge badge-danger">Cancelled</span>`;

                    tbodyHTML += `
                    <tr>
                        <td class="text-center">${index + 1}</td>
                        <td>${item.fullname}</td>
                        <td>${item.patient_type}</td>
                        <td>${item.date_appointment ? moment(item.date_appointment).format("MMMM DD, YYYY") : "-"}</td>
                        <td>${item.service_name || "-"}</td>
                        <td>${item.purpose || "-"}</td>
                        <td class="text-center">${status}</td>
                    </tr>`;
                })
            }

            let html = `
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Appointment Record</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover" id="tableAppointmentRecord">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Patient Name</th>
                                <th>Patient Type</th>
                                <th>Date Appointment</th>
                                <th>Appointment Type</th>
                                <th>Purpose</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${tbodyHTML}
                        </tbody>
                    </table>
                </div>
            </div>`;
            return html;
        }
        // ----- END APPOINTMENT RECORD CONTENT -----


        // ----- MEDICINE RECORD CONTENT -----
        function getMedicineRecordContent()
        {
            let data = getTableData(
                `medicines AS m 
                    LEFT JOIN category AS c USING(category_id)
                    LEFT JOIN units AS u USING(unit_id)
                    LEFT JOIN measurements AS m2 USING(measurement_id)
                WHERE m.is_deleted = 0`,
                `m.*, c.name AS category_name, u.name AS unit_name, m2.name AS measurement_name`);

            let tbodyHTML = '';
            if (data && data.length) {
                data.map((item, index) => {

                    tbodyHTML += `
                    <tr>
                        <td class="text-center">${index + 1}</td>
                        <td>${item.name}</td>
                        <td>${item.category_name}</td>
                        <td>${item.unit_name}</td>
                        <td>${item.measurement_name}</td>
                        <td class="text-center">
                            <a href="${base_url}admin/record/view_inventory?id=${item.medicine_id}&type=medicine"
                                target="_blank"
                                class="btn btn-outline-info">
                                <i class="fas fa-eye"></i> View    
                            </a>
                        </td>
                    </tr>`;
                })
            }

            let html = `
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Medicine Record</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover" id="tableMedicineRecord">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Medicine</th>
                                <th>Category</th>
                                <th>Unit</th>
                                <th>Measurement</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${tbodyHTML}
                        </tbody>
                    </table>
                </div>
            </div>`;
            return html;
        }
        // ----- END MEDICINE RECORD CONTENT -----


        // ----- CARE EQUIPMENT RECORD CONTENT -----
        function getCareEquipmentRecordContent()
        {
            let data = getTableData(
                `care_equipments AS ce
                    LEFT JOIN units AS u USING(unit_id)
                WHERE ce.is_deleted = 0`,
                `ce.*, u.name AS unit_name`);

            let tbodyHTML = '';
            if (data && data.length) {
                data.map((item, index) => {

                    tbodyHTML += `
                    <tr>
                        <td class="text-center">${index + 1}</td>
                        <td>${item.name}</td>
                        <td>${item.unit_name}</td>
                        <td class="text-center">
                            <a href="${base_url}admin/record/view_inventory?id=${item.care_equipment_id}&type=care_equipment"
                                target="_blank"
                                class="btn btn-outline-info">
                                <i class="fas fa-eye"></i> View    
                            </a>
                        </td>
                    </tr>`;
                })
            }

            let html = `
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Care Equipment Record</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover" id="tableCareEquipmentRecord">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Equipment Name</th>
                                <th>Unit</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${tbodyHTML}
                        </tbody>
                    </table>
                </div>
            </div>`;
            return html;
        }
        // ----- END CARE EQUIPMENT RECORD CONTENT -----


        // ----- SELECT RECORD -----
        $(document).on('change', `[name="filter_record"]`, function() {
            $("#tableContent").html(preloader);

            let record = $(this).val();
            let html = `
            <div class="w-100 py-5 text-center">
                <img src="${base_url}assets/images/modal/nodata.svg"
                    width="200" height="200" alt="No data found">
                <h4 class="mt-3">No data found</h4>
            </div>`;

            if (record == 1) // MEDICAL
            {
                html = getMedicalRecordContent();
            }
            else if (record == 2) // DISPENSING MEDICINE
            {
                html = getDispensingMedicineRecordContent();
            }
            else if (record == 3) // PATIENT
            {
                html = getPatientRecordContent();
            }
            else if (record == 4) // APPOINTMENT
            {
                html = getAppointmentRecordContent();
            }
            else if (record == 5) // MEDICINE
            {
                html = getMedicineRecordContent();
            }
            else if (record == 6) // CARE EQUIPMENT
            {
                html = getCareEquipmentRecordContent();
            }

            setTimeout(() => {
                $("#tableContent").html(html);
                initDataTables();
            }, 100);
        })
        // ----- END SELECT RECORD -----

    });

</script>
    