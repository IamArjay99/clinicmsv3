<div class="content-wrapper">

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Check-up Form</h4>
                        <div><?= date("F d, Y") ?></div>
                    </div>
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

        // ----- GLOBAL VARIABLES -----
        let startDate = moment().format("YYYY-MM-DD 00:00:00");
        let endDate   = moment().format("YYYY-MM-DD 23:59:59");
        let appointmentPatientList = getTableData(
            `clinic_appointments AS ca 
                LEFT JOIN patients AS p USING(patient_id)
                LEFT JOIN courses AS c ON p.course_id = c.course_id
                LEFT JOIN years AS y ON p.year_id = y.year_id
            WHERE date_appointment BETWEEN '${startDate}' AND '${endDate}' 
                AND ca.is_deleted = 0
                AND p.is_deleted = 0
            GROUP BY ca.patient_id`,
            `p.*, clinic_appointment_id, service_id, c.name AS course_name, y.name AS year_name,
            (SELECT medical_history_id FROM medical_history WHERE patient_id = ca.patient_id) AS medical_history_id`);
        let patientList = getTableData(
            `patients AS p
                LEFT JOIN courses AS c ON p.course_id = c.course_id
                LEFT JOIN years AS y ON p.year_id = y.year_id
            WHERE p.is_deleted = 0`, 
            `p.*, c.name AS course_name, y.name AS year_name`);
        let serviceList = getTableData(`services WHERE is_deleted = 0`);
        let medicineList = getTableData(
            `medicines AS m
                LEFT JOIN units AS u USING(unit_id)
                LEFT JOIN measurements AS m2 USING(measurement_id)
            WHERE m.is_deleted = 0`,
            `m.*, u.name AS unit_name, m2.name AS measurement_name,
            (SELECT SUM(remaining) FROM stock_in_medicine WHERE medicine_id = m.medicine_id) AS remaining`);
        let careEquipmentList = getTableData(
            `care_equipments AS ce
                LEFT JOIN units AS u USING(unit_id) 
            WHERE ce.is_deleted = 0`,
            `ce.*, u.name AS unit_name,
            (SELECT SUM(remaining) FROM stock_in_care_equipment WHERE care_equipment_id = ce.care_equipment_id) AS remaining`);
        // ----- END GLOBAL VARIABLES -----


        // ----- DATATABLES -----
        function initDataTables() {
            if ($.fn.DataTable.isDataTable("#tableMedicine")) {
                $("#tableMedicine").DataTable().destroy();
            }
            
            var table = $("#tableMedicine")
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
                        { targets: 0, width: '50px'  },
                        { targets: 1, width: '150px' },
                        { targets: 2, width: '100px' },
                        { targets: 3, width: '100px' },
                        { targets: 4, width: '100px' },
                        { targets: 5, width: '100px' },
                        { targets: 6, width: '100px' },
                    ],
                });

            if ($.fn.DataTable.isDataTable("#tableCareEquipment")) {
                $("#tableCareEquipment").DataTable().destroy();
            }
            
            var table = $("#tableCareEquipment")
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
                        { targets: 0, width: '50px'  },
                        { targets: 1, width: '150px' },
                        { targets: 2, width: '100px' },
                        { targets: 3, width: '100px' },
                        { targets: 4, width: '100px' },
                    ],
                });

            if ($.fn.DataTable.isDataTable("#tableSurgery")) {
                $("#tableSurgery").DataTable().destroy();
            }
            
            var table = $("#tableSurgery")
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
                        { targets: 0, width: '50px'  },
                        { targets: 1, width: '100px' },
                        { targets: 2, width: '150px' },
                        { targets: 3, width: '100px' },
                    ],
                });

            if ($.fn.DataTable.isDataTable("#tableHospitalization")) {
                $("#tableHospitalization").DataTable().destroy();
            }
            
            var table = $("#tableHospitalization")
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
                        { targets: 0, width: '50px'  },
                        { targets: 1, width: '100px' },
                        { targets: 2, width: '150px' },
                        { targets: 3, width: '100px' },
                    ],
                });

            if ($.fn.DataTable.isDataTable("#tablePrescribeDrug")) {
                $("#tablePrescribeDrug").DataTable().destroy();
            }
            
            var table = $("#tablePrescribeDrug")
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
                        { targets: 0, width: '50px'  },
                        { targets: 1, width: '100px' },
                        { targets: 2, width: '100px' },
                        { targets: 3, width: '100px' },
                    ],
                });

            if ($.fn.DataTable.isDataTable("#tableAllergyMedication")) {
                $("#tableAllergyMedication").DataTable().destroy();
            }
            
            var table = $("#tableAllergyMedication")
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
                        { targets: 0, width: '50px'  },
                        { targets: 1, width: '100px' },
                        { targets: 2, width: '100px' }, 
                    ],
                });
        }
        // ----- END DATATABLES -----


        // ----- DATERANGEPICKER -----
        function dateTimeRangePicker(element = null) {
            $(element).daterangepicker({
                timePicker: true,
                startDate: moment().startOf('hour'),
                locale: {
                    format: 'MMMM DD, YYYY hh:mm A'
                }
            });
        }
        // ----- END DATERANGEPICKER -----


        // ----- PATIENT OPTION DISPLAY -----
        function getPatientOptionDisplay(serviceID = 0, patientID = 0) {
            let html = `<option value="" selected disabled>Select patient name</option>`;

            if (serviceID == 1) { // MEDICAL
                appointmentPatientList.map(patient => {
                    let {
                        clinic_appointment_id = "",
                        patient_id            = "",
                        patient_code          = "",
                        patient_type_id       = "",
                        course_id             = "",
                        email                 = "",
                        password              = "",
                        firstname             = "",
                        middlename            = "",
                        lastname              = "",
                        suffix                = "",
                        age                   = "",
                        gender                = "",
                        year_name             = "",
                        section               = "",
                        course_name           = "",
                        service_id            = "",
                        medical_history_id    = "",
                    } = patient;
    
                    let fullname = `${firstname} ${middlename} ${lastname} ${suffix}`;
    
                    if (serviceID == service_id) {
                        html += `
                        <option value="${patient_id}"
                            clinic_appointment_id = "${clinic_appointment_id}"
                            course_id   = "${course_id}"
                            age         = "${age}"
                            gender      = "${gender}"
                            year_name   = "${year_name || ""}"
                            section     = "${section}"
                            course_name = "${course_name || ""}"
                            medical_history_id = "${medical_history_id || ""}"
                            type        = "medicine"
                            ${patientID == patient_id ? "selected" : ""}>${fullname}</option>`;
                    }
                });
            } else if (serviceID == 3) { // DISPENSING MEDICINE
                patientList.map(patient => {
                    let {
                        patient_id            = "",
                        patient_code          = "",
                        patient_type_id       = "",
                        course_id             = "",
                        email                 = "",
                        password              = "",
                        firstname             = "",
                        middlename            = "",
                        lastname              = "",
                        suffix                = "",
                        age                   = "",
                        gender                = "",
                        year_name             = "",
                        section               = "",
                        course_name           = "",
                    } = patient;
    
                    let fullname = `${firstname} ${middlename} ${lastname} ${suffix}`;
    
                    html += `
                    <option value="${patient_id}"
                        course_id   = "${course_id}"
                        age         = "${age}"
                        gender      = "${gender}"
                        year_name   = "${year_name || ""}"
                        section     = "${section}"
                        course_name = "${course_name || ""}"
                        type        = "dispensing medicine"
                        ${patientID == patient_id ? "selected" : ""}>${fullname}</option>`;
                });
            }


            return html;
        }
        // ----- END PATIENT OPTION DISPLAY -----


        // ----- SERVICE OPTION DISPLAY -----
        function getServiceOptionDisplay(serviceID = 0) {
            let html = `<option selected disabled>Select service</option>`;
            serviceList.map(service => {
                let {
                    service_id = "",
                    name       = "",
                } = service;

                if (service_id != 2 || name.toLowerCase().trim() != "dental") {
                    html += `
                    <option value="${service_id}"
                        ${serviceID == service_id ? "selected" : ""}>${name}</option>`;
                }

            });

            return html;
        }
        // ----- END SERVICE OPTION DISPLAY -----


        // ----- TREATMENT ROW -----
        function getTreatmentRow() {
            let toothArray = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32];
            let toothNumberOptionDisplay = '';
            toothArray.map(no => {
                toothNumberOptionDisplay += `<option value="${no}">${no}</option>`;
            })

            let html = `
            <tr>
                <td>
                    <button class="btn btn-danger btn-sm btnDeleteRow">
                        <i class="mdi mdi-delete"></i>
                    </button>
                </td>
                <td>
                    <div class="form-group mb-0">
                        <select class="form-control validate"
                            name="tooth_number"
                            required>
                            <option value="" selected disabled>Select tooth no.</option>    
                            ${toothNumberOptionDisplay}   
                        </select>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </td>
                <td>
                    <div class="form-group mb-0">
                        <input type="text"
                            class="form-control validate"
                            name="tooth_status"
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </td>
            </tr>`;
            return html;
        }
        // ----- END TREATMENT ROW -----


        // ----- TREATMENT DISPLAY -----
        function getTreatmentDisplay() {
            let html = `
            <div class="row">
                <div class="col-12 mb-3"><hr></div>
                <div class="col-12 pb-4">
                    <h4>Treatment</h4>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-5 col-sm-12 p-3">
                            <img class="img-fluid border"
                                src="${base_url}assets/images/modules/dental-chart.jpg"
                                style="width: 100%;
                                    min-height: 30vh;
                                    height: auto;
                                    max-height: 100%;"
                                alt="dental chart">
                        </div>
                        <div class="col-md-7 col-sm-12">
                            <button class="btn btn-primary mb-3"
                                id="btnAddTreatment">Add</button>
                            <div class="table-responsive" style="height: 70vh; overflow-y: auto;">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th width="80"></th>
                                            <th>Tooth No.</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableTbodyTreatment">
                                        ${getTreatmentRow()}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;
            return html;
        }
        // ----- END TREATMENT DISPLAY -----


        // ----- MEDICINE CONTENT -----
        function getMedicineOptionDisplay(medicineID = 0) {
            let html = `<option value="" selected>Select medicine</option>`;
            medicineList.map(medicine => {
                let {
                    medicine_id,
                    name,
                    brand,
                    unit_name,
                    measurement_name,
                    remaining,
                } = medicine;

                html += `
                <option value="${medicine_id}"
                    brand="${brand}"
                    unit_name="${unit_name}"
                    measurement_name="${measurement_name}"
                    remaining="${remaining || 0}"
                    ${medicineID == medicine_id ? "selected" : ""}>${name}</option>`;
            })
            return html;
        }

        function getMedicineRow() {
            let html = `
            <tr>
                <td class="text-center">
                    <button class="btn btn-danger btnDelete"
                        title="Delete">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
                <td>
                    <div class="form-group mb-0">
                        <select class="form-control validate"
                            name="medicine_id"
                            required>
                            ${getMedicineOptionDisplay()}    
                        </select>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </td>
                <td class="brand">-</td>
                <td class="unit">-</td>
                <td class="measurement">-</td>
                <td class="remaining">-</td>
                <td>
                    <div class="form-group mb-0">
                        <input type="number"
                            class="form-control validate"
                            name="quantity"
                            min="1"
                            max="999999"
                            value=""
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </td>
            </tr>`;
            return html;
        }

        function medicineContent() {
            let html = `
            <div class="row">
                <div class="col-12" id="tableMedicineParent">
                    <table class="table table-hover table-bordered" id="tableMedicine">
                        <thead>
                            <tr class="text-center">
                                <th>&nbsp;</th>
                                <th>Name <code>*</code></th>
                                <th>Brand</th>
                                <th>Unit</th>
                                <th>Measurement</th>
                                <th>Remaining</th>
                                <th>Quantity <code>*</code></th>
                            </tr>
                        </thead>
                        <tbody id="tableMedicineTbody">
                            ${getMedicineRow()}
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6" class="">
                                    <button class="btn btn-outline-primary btnAdd"
                                        table="medicine">
                                        <i class="fas fa-plus"></i> Add Row
                                    </button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>`;

            return html;
        }
        // ----- END MEDICINE CONTENT -----


        // ----- CARE EQUIPMENT CONTENT -----
        function getCareEquipmentOptionDisplay(careEquipmentID = 0) {
            let html = `<option value="" selected>Select care equipment</option>`;
            careEquipmentList.map(care_equipment => {
                let {
                    care_equipment_id,
                    name,
                    unit_name,
                    remaining,
                } = care_equipment;

                html += `
                <option value="${care_equipment_id}"
                    unit_name="${unit_name}"
                    remaining="${remaining || 0}"
                    ${careEquipmentID == care_equipment_id ? "selected" : ""}>${name}</option>`;
            })
            return html;
        }

        function getCareEquipmentRow(data = false) {
            let {
                purchase_request_care_equipment_id,
                care_equipment_id,
                care_equipment_name,
                unit_name,
                quantity,
            } = data;

            let nameHTML = data ? `
            <input type="hidden" name="care_equipment_id" value="${care_equipment_id}"><div>${care_equipment_name}</div>` :
            `<div class="form-group mb-0">
                <select class="form-control validate"
                    name="care_equipment_id"
                    required>
                    ${getCareEquipmentOptionDisplay(care_equipment_id)}    
                </select>
                <div class="d-block invalid-feedback"></div>
            </div>`;

            let html = `
            <tr purchase_request_care_equipment_id="${purchase_request_care_equipment_id}">
                <td class="text-center">
                    <button class="btn btn-danger btnDelete"
                        title="Delete">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
                <td>
                    ${nameHTML}
                </td>
                <td class="unit">-</td>
                <td class="text-center remaining">-</td>
                <td>
                    <div class="form-group mb-0">
                        <input type="number"
                            class="form-control validate"
                            name="quantity"
                            min="1"
                            max="${quantity || "999999"}"
                            value="${quantity || ""}"
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </td>
            </tr>`;
            return html;
        }

        function careEquipmentContent(data = [], hasReference = false) {
            let tbodyHTML = '';
            if (data && data.length) {
                data.map(item => {
                    tbodyHTML += getCareEquipmentRow(item);
                })
            } else {
                tbodyHTML = !hasReference ? getCareEquipmentRow() : '';
            }

            let html = `
            <div class="row">
                <div class="col-12" id="tableCareEquipmentParent">
                    <table class="table table-hover table-bordered" id="tableCareEquipment">
                        <thead>
                            <tr class="text-center">
                                <th>&nbsp;</th>
                                <th>Name <code>*</code></th>
                                <th>Unit</th>
                                <th>Remaining</th>
                                <th>Quantity <code>*</code></th>
                            </tr>
                        </thead>
                        <tbody id="tableCareEquipmentTbody">
                            ${tbodyHTML}
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="">
                                    <button class="btn btn-outline-primary btnAdd"
                                        table="care_equipment">
                                        <i class="fas fa-plus"></i> Add Row
                                    </button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>`;

            return html;
        }
        // ----- END CARE EQUIPMENT CONTENT -----


        // ----- MEDICAL HISTORY CONTENT -----
        function medicalHistoryContent() {
            let html = `
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Medical History</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Marital Status</label>
                                <div class="d-flex align-items-center">
                                    <div class="ml-3">
                                        <input type="radio"
                                            name="marital_status"
                                            value="Single"> Single
                                    </div>
                                    <div class="ml-3">
                                        <input type="radio"
                                            name="marital_status"
                                            value="Married"> Married
                                    </div>
                                    <div class="ml-3">
                                        <input type="radio"
                                            name="marital_status"
                                            value="Partnership"> Partnership
                                    </div>
                                    <div class="ml-3">
                                        <input type="radio"
                                            name="marital_status"
                                            value="Separated"> Separated
                                    </div>
                                    <div class="ml-3">
                                        <input type="radio"
                                            name="marital_status"
                                            value="Divorced"> Divorced
                                    </div>
                                    <div class="ml-3">
                                        <input type="radio"
                                            name="marital_status"
                                            value="Widowed"> Widowed
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Previous or referring doctors</label>
                                <input type="text"
                                    class="form-control validate"
                                    name="referring_doctors"
                                    minlength="0"
                                    maxlength="200">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Date of last physical exam</label>
                                <input type="date"
                                    class="form-control validate"
                                    name="last_physical_exam"
                                    minlength="0"
                                    maxlength="200">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Are you already vaccinated?</label>
                                <div class="d-flex align-items-center">
                                    <div class="ml-2">
                                        <input type="radio"
                                            name="is_vaccinated"
                                            value="Yes"> Yes
                                    </div>
                                    <div class="ml-2">
                                        <input type="radio"
                                            name="is_vaccinated"
                                            value="No"> No
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Covid19 patient?</label>
                                <div class="d-flex align-items-center">
                                    <div class="ml-2">
                                        <input type="radio"
                                            name="covid_patient"
                                            value="Yes"> Yes
                                    </div>
                                    <div class="ml-2">
                                        <input type="radio"
                                            name="covid_patient"
                                            value="No"> No
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-3">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="mb-0">PERSONAL HEALTH HISTORY</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Childhood illness</label>
                                                <div class="d-flex align-items-center">
                                                    <div class="ml-2">
                                                        <input type="checkbox"
                                                            name="childhood_illness"
                                                            value="Measles"> Measles
                                                    </div>
                                                    <div class="ml-2">
                                                        <input type="checkbox"
                                                            name="childhood_illness"
                                                            value="Mumps"> Mumps
                                                    </div>
                                                    <div class="ml-2">
                                                        <input type="checkbox"
                                                            name="childhood_illness"
                                                            value="Rubella"> Rubella
                                                    </div>
                                                    <div class="ml-2">
                                                        <input type="checkbox"
                                                            name="childhood_illness"
                                                            value="Chickenpox"> Chickenpox
                                                    </div>
                                                    <div class="ml-2">
                                                        <input type="checkbox"
                                                            name="childhood_illness"
                                                            value="Rheumatic Fever"> Rheumatic Fever
                                                    </div>
                                                    <div class="ml-2">
                                                        <input type="checkbox"
                                                            name="childhood_illness"
                                                            value="Polio"> Polio
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Immunization and dates</label>
                                                <div class="d-flex align-items-center">
                                                    <div class="ml-2">
                                                        <input type="checkbox"
                                                            name="immunization"
                                                            value="Tetanus"> Tetanus
                                                    </div>
                                                    <div class="ml-2">
                                                        <input type="checkbox"
                                                            name="immunization"
                                                            value="Pheumonia"> Pheumonia
                                                    </div>
                                                    <div class="ml-2">
                                                        <input type="checkbox"
                                                            name="immunization"
                                                            value="Hepatatis"> Hepatatis
                                                    </div>
                                                    <div class="ml-2">
                                                        <input type="checkbox"
                                                            name="immunization"
                                                            value="Chickenpox"> Chickenpox
                                                    </div>
                                                    <div class="ml-2">
                                                        <input type="checkbox"
                                                            name="immunization"
                                                            value="Influenza"> Influenza
                                                    </div>
                                                    <div class="ml-2">
                                                        <input type="checkbox"
                                                            name="immunization"
                                                            value="MMR,Measles,Mumps,Rubella"> MMR,Measles,Mumps,Rubella
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>List any medical problems that other doctors have diagnosed</label>
                                                <textarea class="form-control validate"
                                                    name="medical_problems"
                                                    rows="3"
                                                    style="resize: none;"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12 pb-3"><hr></div>
                                        <div class="col-12">
                                            <h4>Surgeries</h4>
                                            <table class="table table-bordered table-hover" id="tableSurgery">
                                                <thead>
                                                    <tr>
                                                        <th>&nbsp;</th>
                                                        <th>Year</th>
                                                        <th>Reason</th>
                                                        <th>Hospital</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tableSurgeryTbody">
                                                    <tr>
                                                        <td class="text-center">
                                                            <button class="btn btn-danger btnDelete"
                                                                title="Delete">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </td>
                                                        <td>
                                                            <div class="form-group mb-0">
                                                                <input type="text"
                                                                    class="form-control validate"
                                                                    name="year">
                                                                <div class="d-block invalid-feedback"></div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group mb-0">
                                                                <textarea class="form-control validate"
                                                                    name="reason"
                                                                    rows="3"
                                                                    style="resize: none;"></textarea>
                                                                <div class="d-block invalid-feedback"></div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group mb-0">
                                                                <input type="text"
                                                                    class="form-control validate"
                                                                    name="hospital">
                                                                <div class="d-block invalid-feedback"></div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="4">
                                                            <button class="btn btn-outline-primary btnAdd"
                                                                table="surgery">
                                                                <i class="fas fa-plus"></i> Add Row
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div class="col-12 py-3"><hr></div>
                                        <div class="col-12">
                                            <h4>Other Hospitalizations</h4>
                                            <table class="table table-bordered table-hover" id="tableHospitalization">
                                                <thead>
                                                    <tr>
                                                        <th>&nbsp;</th>
                                                        <th>Year</th>
                                                        <th>Reason</th>
                                                        <th>Hospital</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tableHospitalizationTbody">
                                                    <tr>
                                                        <td class="text-center">
                                                            <button class="btn btn-danger btnDelete"
                                                                title="Delete">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </td>
                                                        <td>
                                                            <div class="form-group mb-0">
                                                                <input type="text"
                                                                    class="form-control validate"
                                                                    name="year">
                                                                <div class="d-block invalid-feedback"></div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group mb-0">
                                                                <textarea class="form-control validate"
                                                                    name="reason"
                                                                    rows="3"
                                                                    style="resize: none;"></textarea>
                                                                <div class="d-block invalid-feedback"></div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group mb-0">
                                                                <input type="text"
                                                                    class="form-control validate"
                                                                    name="hospital">
                                                                <div class="d-block invalid-feedback"></div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="4">
                                                            <button class="btn btn-outline-primary btnAdd"
                                                                table="hospitalization">
                                                                <i class="fas fa-plus"></i> Add Row
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <div class="form-group">
                                                <label>Have you ever had a blood transmission?</label>
                                                <div class="d-flex align-items-center">
                                                    <div class="ml-2">
                                                        <input type="radio"
                                                            name="blood_transmission"
                                                            value="Yes"> Yes
                                                    </div>
                                                    <div class="ml-2">
                                                        <input type="radio"
                                                            name="blood_transmission"
                                                            value="No"> No
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 py-3"><hr></div>
                                        <div class="col-12">
                                            <h4>List your prescribed drugs and over-the-counter drugs, such as vitamins and inhalers</h4>
                                            <table class="table table-bordered table-hover" id="tablePrescribeDrug">
                                                <thead>
                                                    <tr>
                                                        <th>&nbsp;</th>
                                                        <th>Name the drug</th>
                                                        <th>Strength</th>
                                                        <th>Frequency Taken</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tablePrescribeDrugTbody">
                                                    <tr>
                                                        <td class="text-center">
                                                            <button class="btn btn-danger btnDelete"
                                                                title="Delete">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </td>
                                                        <td>
                                                            <div class="form-group mb-0">
                                                                <input type="text"
                                                                    class="form-control validate"
                                                                    name="name">
                                                                <div class="d-block invalid-feedback"></div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group mb-0">
                                                                <input type="text"
                                                                    class="form-control validate"
                                                                    name="strength">
                                                                <div class="d-block invalid-feedback"></div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group mb-0">
                                                                <input type="text"
                                                                    class="form-control validate"
                                                                    name="frequently_taken">
                                                                <div class="d-block invalid-feedback"></div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="4">
                                                            <button class="btn btn-outline-primary btnAdd"
                                                                table="prescribe_drugs">
                                                                <i class="fas fa-plus"></i> Add Row
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div class="col-12 py-3"><hr></div>
                                        <div class="col-12">
                                            <h4>Allergies to medications</h4>
                                            <table class="table table-bordered table-hover" id="tableAllergyMedication">
                                                <thead>
                                                    <tr>
                                                        <th>&nbsp;</th>
                                                        <th>Name the drug</th>
                                                        <th>Reaction you had</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tableAllergyMedicationTbody">
                                                    <tr>
                                                        <td class="text-center">
                                                            <button class="btn btn-danger btnDelete"
                                                                title="Delete">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </td>
                                                        <td>
                                                            <div class="form-group mb-0">
                                                                <input type="text"
                                                                    class="form-control validate"
                                                                    name="name">
                                                                <div class="d-block invalid-feedback"></div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group mb-0">
                                                                <textarea class="form-control validate"
                                                                    name="reaction"
                                                                    rows="3"
                                                                    style="resize: none;"></textarea>
                                                                <div class="d-block invalid-feedback"></div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="3">
                                                            <button class="btn btn-outline-primary btnAdd"
                                                                table="allergy_medication">
                                                                <i class="fas fa-plus"></i> Add Row
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;
            return html;
        }
        // ----- END MEDICAL HISTORY CONTENT -----


       // ----- PAGE CONTENT -----
       function pageContent() {
            !document.getElementsByClassName("jumping-dots-loader").length && $("#pageContent").html(preloader);

            let html = `
            <div class="row" id="checkupForm">
                <div class="col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <label>Service <code>*</code></label>
                                <select class="form-control validate"
                                    name="service_id"
                                    required>
                                    ${getServiceOptionDisplay()}
                                </select>
                                <div class="d-block invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <label>Patient Name <code>*</code></label>
                                <select class="form-control validate"
                                    name="patient_id"
                                    required>
                                    ${getPatientOptionDisplay()}
                                </select>
                                <div class="d-block invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <label>Gender</label>
                                <input type="text"
                                    class="form-control"
                                    name="gender"
                                    value=""
                                    disabled>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <label>Age</label>
                                <input type="text"
                                    class="form-control"
                                    name="age"
                                    value=""
                                    disabled>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Course</label>
                                <input type="text"
                                    class="form-control"
                                    name="course"
                                    value=""
                                    disabled>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <label>Year</label>
                                <input type="text"
                                    class="form-control"
                                    name="year"
                                    value=""
                                    disabled>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <label>Section</label>
                                <input type="text"
                                    class="form-control"
                                    name="section"
                                    value=""
                                    disabled>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="mb-0">Chief Complain</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2 col-sm-12">
                                            <div class="form-group">
                                                <label>Temperature</label>
                                                <input type="text"
                                                    class="form-control validate"
                                                    name="temperature"
                                                    value="">
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-sm-12">
                                            <div class="form-group">
                                                <label>Pulse rate</label>
                                                <input type="text"
                                                    class="form-control validate"
                                                    name="pulse_rate"
                                                    value="">
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-sm-12">
                                            <div class="form-group">
                                                <label>Respiratory Rate</label>
                                                <input type="text"
                                                    class="form-control validate"
                                                    name="respiratory_rate"
                                                    value="">
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-sm-12">
                                            <div class="form-group">
                                                <label>Blood Pressure</label>
                                                <input type="text"
                                                    class="form-control validate"
                                                    name="blood_pressure"
                                                    value="">
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-sm-12">
                                            <div class="form-group">
                                                <label>Random Blood Sugar</label>
                                                <input type="text"
                                                    class="form-control validate"
                                                    name="random_blood_sugar"
                                                    value="">
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-sm-12">
                                            <div class="form-group">
                                                <label>Others</label>
                                                <input type="text"
                                                    class="form-control validate"
                                                    name="others"
                                                    value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-12" id="treatmentDisplay"></div>

                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-0">Medicine</h4>
                        </div>
                        <div class="card-body">
                            ${medicineContent()}
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-0">Care Equipment</h4>
                        </div>
                        <div class="card-body">
                            ${careEquipmentContent()}
                        </div>
                    </div>
                </div>

                <div class="col-12 my-4">
                    <div class="form-group">
                        <label>Recommendation <code>*</code></label>
                        <textarea class="form-control validate"
                            name="recommendation"
                            rows="5"
                            style="resize: none"
                            required></textarea>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>

                <div class="col-12" id="medicalHistoryContent"></div>
                <div class="col-12 mt-3" id="clinicalCaseRecordContent">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-0">CLINICAL CASE RECORD</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="tableClinicalCaseRecord">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Health Complaint</th>
                                        <th>Treatment</th>
                                        <th>Follow-up Schedule/Referral</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-group mb-0">
                                                <input type="hidden"
                                                    class="form-control validate"
                                                    name="date"
                                                    value="${moment().format("YYYY-MM-DD")}">
                                                ${moment().format("MMMM DD, YYYY")}
                                                <div class="d-block invalid-feedback"></div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group mb-0">
                                                <input type="text"
                                                    class="form-control validate"
                                                    name="health_complaint">
                                                <div class="d-block invalid-feedback"></div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group mb-0">
                                                <input type="text"
                                                    class="form-control validate"
                                                    name="treatment">
                                                <div class="d-block invalid-feedback"></div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group mb-0">
                                                <input type="date"
                                                    class="form-control validate"
                                                    name="schedule">
                                                <div class="d-block invalid-feedback"></div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary" id="btnSave">Save</button>
            </div>`;

            setTimeout(() => {
                $("#pageContent").html(html);
                initDataTables();
                generateInputsID();
                $(`[name="temperature"]`).inputmask({
                    mask:        "99.99",
                    placeholder: "00.00"
                })
            }, 100);
        }
        pageContent();
        // ----- END PAGE CONTENT -----


        // ----- GENERATE INPUT ID -----
        function generateInputsID() {
            $(`select, input, textarea`).each(function(i) {
                $parent = $(this).closest(".form-group");
                let name = $(this).attr("name");
                $(this).attr("id", `${name}${i}`);
                $parent.find(`.invalid-feedback`).attr("id", `invalid-${name}${i}`);
            })
        }
        // ----- END GENERATE INPUT ID -----


        // ----- UNIQUE MEDICINE OPTION -----
        function uniqueMedicineOption() {
            let itemIDArr = [], itemElementArr = [];
            $(`[name="medicine_id"]`).each(function() {
                let id = $(this).attr("id");
                itemIDArr.push($(this).val());
                itemElementArr.push(id);
            });

            itemElementArr.map((element, index) => {
                let html = `<option value="" selected>Select medicine</option>`;

                medicineList
                 .filter(item => !itemIDArr.includes(item.medicine_id) || item.medicine_id == itemIDArr[index])
                 .map(item => {
                    let {
                        medicine_id,
                        name,
                        brand,
                        unit_name,
                        measurement_name,
                        remaining,
                    } = item;

                    html += `
                    <option value="${medicine_id}"
                        brand="${brand}"
                        unit_name="${unit_name}"
                        measurement_name="${measurement_name}"
                        remaining="${remaining || 0}"
                        ${itemIDArr[index] == medicine_id ? "selected" : ""}>${name}</option>`;
                 })

                $(`#${element}`).html(html);
            })
        }
        // ----- END UNIQUE MEDICINE OPTION -----


        // ----- UNIQUE CARE EQUIPMENT OPTION -----
        function uniqueCareEquipmentOption() {
            let itemIDArr = [], itemElementArr = [];
            $(`[name="care_equipment_id"]`).each(function() {
                let id = $(this).attr("id");
                itemIDArr.push($(this).val());
                itemElementArr.push(id);
            });

            itemElementArr.map((element, index) => {
                let html = `<option value="" selected>Select care equipment</option>`;

                careEquipmentList
                 .filter(item => !itemIDArr.includes(item.care_equipment_id) || item.care_equipment_id == itemIDArr[index])
                 .map(item => {
                    let {
                        care_equipment_id,
                        name,
                        unit_name,
                        remaining,
                    } = item;

                    html += `
                    <option value="${care_equipment_id}"
                        unit_name="${unit_name}"
                        remaining="${remaining || 0}"
                        ${itemIDArr[index] == care_equipment_id ? "selected" : ""}>${name}</option>`;
                 })

                $(`#${element}`).html(html);
            })
        }
        // ----- END UNIQUE CARE EQUIPMENT OPTION -----


        // ----- VALIDATE ITEMS -----
        function validateItems() {
            let element = [];
            let flag = true;
            $(`#tableMedicineTbody [name="quantity"], #tableCareEquipmentTbody [name="quantity"]`).each(function() {
                $parent = $(this).closest("tr");
                let name      = $parent.find(`select option:selected`).text().trim();
                let remaining = +$parent.find(`select option:selected`).attr("remaining");
                let quantity  = $(this).val();
                if (quantity > remaining) {
                    showNotification("warning", `${name} - Insufficient supply.`);
                    element.push(`#${this.id}`);
                    flag = false;
                }
            })

            if (!flag && element.length) {
                $(`${element[0]}`).focus();
            }

            return flag;
        }
        // ----- END VALIDATE ITEMS -----


        // ----- GET SURGERY ROW -----
        function getSurgeryRow() {
            let html = `
            <tr>
                <td class="text-center">
                    <button class="btn btn-danger btnDelete"
                        title="Delete">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
                <td>
                    <div class="form-group mb-0">
                        <input type="text"
                            class="form-control validate"
                            name="year">
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </td>
                <td>
                    <div class="form-group mb-0">
                        <textarea class="form-control validate"
                            name="reason"
                            rows="3"
                            style="resize: none;"></textarea>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </td>
                <td>
                    <div class="form-group mb-0">
                        <input type="text"
                            class="form-control validate"
                            name="hospital">
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </td>
            </tr>`;
            return html;
        }
        // ----- END GET SURGERY ROW -----


        // ----- GET HOSPITALIZATION ROW -----
        function getHospitalizationRow() {
            let html = `
            <tr>
                <td class="text-center">
                    <button class="btn btn-danger btnDelete"
                        title="Delete">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
                <td>
                    <div class="form-group mb-0">
                        <input type="text"
                            class="form-control validate"
                            name="year">
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </td>
                <td>
                    <div class="form-group mb-0">
                        <textarea class="form-control validate"
                            name="reason"
                            rows="3"
                            style="resize: none;"></textarea>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </td>
                <td>
                    <div class="form-group mb-0">
                        <input type="text"
                            class="form-control validate"
                            name="hospital">
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </td>
            </tr>`;
            return html;
        }
        // ----- END GET HOSPITALIZATION ROW -----


        // ----- GET PRESCRIBE DRUG ROW -----
        function getPrescribeDrugRow() {
            let html = `
            <tr>
                <td class="text-center">
                    <button class="btn btn-danger btnDelete"
                        title="Delete">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
                <td>
                    <div class="form-group mb-0">
                        <input type="text"
                            class="form-control validate"
                            name="name">
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </td>
                <td>
                    <div class="form-group mb-0">
                        <input type="text"
                            class="form-control validate"
                            name="strength">
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </td>
                <td>
                    <div class="form-group mb-0">
                        <input type="text"
                            class="form-control validate"
                            name="frequently_taken">
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </td>
            </tr>`;
            return html;
        }
        // ----- END GET PRESCRIBE DRUG ROW -----


        // ----- GET ALLERGY MEDICATION ROW -----
        function getAllergyMedicationRow() {
            let html = `
            <tr>
                <td class="text-center">
                    <button class="btn btn-danger btnDelete"
                        title="Delete">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
                <td>
                    <div class="form-group mb-0">
                        <input type="text"
                            class="form-control validate"
                            name="name">
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </td>
                <td>
                    <div class="form-group mb-0">
                        <textarea class="form-control validate"
                            name="reaction"
                            rows="3"
                            style="resize: none;"></textarea>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </td>
            </tr>`;
            return html;
        }
        // ----- END GET ALLERGY MEDICATION ROW -----


        // ----- SELECT PATIENT NAME -----
        $(document).on("change", `[name="patient_id"]`, function() {
            let gender  = $(`option:selected`, this).attr("gender") || "-";
            let age     = $(`option:selected`, this).attr("age") || "-";
            let course  = $(`option:selected`, this).attr("course_name") || "-";
            let year    = $(`option:selected`, this).attr("year_name") || "-";
            let section = $(`option:selected`, this).attr("section") || "-";
            let medicalHistoryID = $(`option:selected`, this).attr("medical_history_id") || false;

            $(`[name="gender"]`).val(gender);
            $(`[name="age"]`).val(age);
            $(`[name="course"]`).val(course);
            $(`[name="year"]`).val(year);
            $(`[name="section"]`).val(section);

            if (!medicalHistoryID) {
                let serviceID = $(`[name="service_id"]`).val();

                if (serviceID == 1) {
                    $(`#medicalHistoryContent`).html(medicalHistoryContent());
                    generateInputsID();
                    initDataTables();
                } else {
                    $(`#medicalHistoryContent`).empty();
                }
            } else {
                $(`#medicalHistoryContent`).empty();
            }
        })
        // ----- END SELECT PATIENT NAME -----


        // ----- SELECT SERVICE -----
        $(document).on("change", `[name="service_id"]`, function() {
            let serviceID = $(this).val();

            $(`[name="patient_id"]`).html(getPatientOptionDisplay(serviceID));
            generateInputsID();

            $(`[name="patient_id"]`).trigger("change");
        })
        // ----- END SELECT SERVICE -----


        // ----- SELECT MEDICINE -----
        $(document).on('change', `[name="medicine_id"]`, function() {
            $parent = $(this).closest("tr");
            let elementID = $(this).attr("id");

            let brand       = $(`option:selected`, this).attr("brand") || "-"; 
            let unit        = $(`option:selected`, this).attr("unit_name") || "-"; 
            let measurement = $(`option:selected`, this).attr("measurement_name") || "-";
            let remaining   = $(`option:selected`, this).attr("remaining") || "0";
            
            $parent.find(`.brand`).text(brand);
            $parent.find(`.unit`).text(unit);
            $parent.find(`.measurement`).text(measurement);
            $parent.find(`.remaining`).text(remaining);

            uniqueMedicineOption();
        })
        // ----- END SELECT MEDICINE -----


        // ----- SELECT CARE EQUIPMENT -----
        $(document).on('change', `[name="care_equipment_id"]`, function() {
            $parent = $(this).closest("tr");
            let elementID = $(this).attr("id");

            let unit      = $(`option:selected`, this).attr("unit_name") || "-";
            let remaining = $(`option:selected`, this).attr("remaining") || "0";

            $parent.find(`.unit`).text(unit);
            $parent.find(`.remaining`).text(remaining);

            uniqueCareEquipmentOption();
        })
        // ----- END SELECT CARE EQUIPMENT -----


        // ----- BUTTON ADD -----
        $(document).on("click", ".btnAdd", function() {
            let table        = $(this).attr("table");
            let tableElement = '', row = '';

            if (table == "medicine") {
                row = getMedicineRow();
                tableElement = '#tableMedicineTbody';
            } else if (table == "care_equipment") {
                row = getCareEquipmentRow();
                tableElement = '#tableCareEquipmentTbody';
            } else if (table == "surgery") {
                row = getSurgeryRow();
                tableElement = '#tableSurgeryTbody';
            } else if (table == "hospitalization") {
                row = getHospitalizationRow();
                tableElement = '#tableHospitalizationTbody';
            } else if (table == "prescribe_drugs") {
                row = getPrescribeDrugRow();
                tableElement = '#tablePrescribeDrugTbody';
            } else if (table == "allergy_medication") {
                row = getAllergyMedicationRow();
                tableElement = '#tableAllergyMedicationTbody';
            }

            $(tableElement).append(row);

            generateInputsID();
            uniqueMedicineOption();
            uniqueCareEquipmentOption();
        });
        // ----- END BUTTON ADD -----


        // ----- BUTTON DELETE -----
        $(document).on("click", ".btnDelete", function() {
            $(this).closest('tr').remove();
            generateInputsID();
            uniqueMedicineOption();
            uniqueCareEquipmentOption();
        });
        // ----- END BUTTON DELETE -----


        // ----- BUTTON SAVE -----
        $(document).on("click", "#btnSave", function() {
            let validate               = validateForm("checkupForm");
            let validateMedicine       = validateForm("tableMedicine");
            let validateCareEquipment  = validateForm("tableCareEquipment");
            let validateMedicalHistory = validateForm("medicalHistoryContent");

            const getMedicineInputData = () => {
                let data = [];
                if ($("#tableMedicineTbody tr").length) {
                    $("#tableMedicineTbody tr").each(function() {
                        let medicine_id = $(`[name="medicine_id"]`, this).val();
                        let quantity    = $(`[name="quantity"]`, this).val();
                        data.push({
                            patient_id: $(`[name="patient_id"]`).val(),
                            medicine_id, 
                            quantity
                        });
                    })   
                }
                return data;
            }

            const getCareEquipmentInputData = () => {
                let data = [];
                if ($("#tableCareEquipmentTbody tr").length) {
                    $("#tableCareEquipmentTbody tr").each(function() {
                        let care_equipment_id = $(`[name="care_equipment_id"]`, this).val();
                        let quantity    = $(`[name="quantity"]`, this).val();
                        data.push({
                            patient_id: $(`[name="patient_id"]`).val(),
                            care_equipment_id, 
                            quantity
                        });
                    })   
                }
                return data;
            }

            const getMedicalHistoryInputData = () => {
                if ($("#medicalHistoryContent").text().trim().length) {
                    let childhood_illness = immunization = [];
                    $(`[name="childhood_illness"]:checked`).each(function() {
                        childhood_illness.push($(this).val());
                    });
                    childhood_illness = childhood_illness.join("|");
                    $(`[name="immunization"]:checked`).each(function() {
                        immunization.push($(this).val());
                    });
                    immunization = immunization.join("|");

                    const getSurgeryInputData = () => {
                        let data = [];
                        if ($(`#tableSurgeryTbody tr`).length) {
                            $(`#tableSurgeryTbody tr`).each(function() {
                                data.push({
                                    year:     $(`[name="year"]`, this).val(),
                                    reason:   $(`[name="reason"]`, this).val(),
                                    hospital: $(`[name="hospital"]`, this).val(),
                                })
                            })
                        }
                        return data;
                    }

                    const getHospitalizationInputData = () => {
                        let data = [];
                        if ($(`#tableHospitalizationTbody tr`).length) {
                            $(`#tableHospitalizationTbody tr`).each(function() {
                                data.push({
                                    year:     $(`[name="year"]`, this).val(),
                                    reason:   $(`[name="reason"]`, this).val(),
                                    hospital: $(`[name="hospital"]`, this).val(),
                                })
                            })
                        }
                        return data;
                    }

                    const getPrescribeDrugInputData = () => {
                        let data = [];
                        if ($(`#tablePrescribeDrugTbody tr`).length) {
                            $(`#tablePrescribeDrugTbody tr`).each(function() {
                                data.push({
                                    name:             $(`[name="name"]`, this).val(),
                                    strength:         $(`[name="strength"]`, this).val(),
                                    frequently_taken: $(`[name="frequently_taken"]`, this).val(),
                                })
                            })
                        }
                        return data;
                    }

                    const getAllergyMedicationInputData = () => {
                        let data = [];
                        if ($(`#tableAllergyMedicationTbody tr`).length) {
                            $(`#tableAllergyMedicationTbody tr`).each(function() {
                                data.push({
                                    name:     $(`[name="name"]`, this).val(),
                                    reaction: $(`[name="reaction"]`, this).val(),
                                })
                            })
                        }
                        return data;
                    }

                    let data = {
                        marital_status: $(`[name="marital_status"]`).val(),
                        referring_doctors: $(`[name="referring_doctors"]`).val(),
                        last_physical_exam: $(`[name="last_physical_exam"]`).val(),
                        is_vaccinated: $(`[name="is_vaccinated"]`).val(),
                        covid_patient: $(`[name="covid_patient"]`).val(),
                        childhood_illness,
                        immunization,
                        medical_problems: $(`[name="medical_problems"]`).val(),
                        surgery: getSurgeryInputData(),
                        hospitalization: getHospitalizationInputData(),
                        blood_transmission: $(`[name="blood_transmission"]`).val(),
                        prescribe_drug: getPrescribeDrugInputData(),
                        allergy_medication: getAllergyMedicationInputData()
                    }

                    return data;
                }
            }

            const getClinicalCaseInputData = () => {
                let health_complaint = $(`#clinicalCaseRecordContent [name="health_complaint"]`).val();
                let treatment        = $(`#clinicalCaseRecordContent [name="treatment"]`).val();
                let schedule         = $(`#clinicalCaseRecordContent [name="schedule"]`).val();
                if (health_complaint && treatment && schedule) {
                    return { health_complaint, treatment, schedule };
                }
            }

            if (validate && validateMedicine && validateCareEquipment) {
                if (validateItems()) {
                    let data = {
                        service_id:            $(`[name="service_id"]`).val(),
                        clinic_appointment_id: $(`[name="patient_id"] option:selected`).attr("clinic_appointment_id") ?? 0,
                        patient_id:            $(`[name="patient_id"]`).val(),
                        temperature:           $(`[name="temperature"]`).val() ?? 0,
                        pulse_rate:            $(`[name="pulse_rate"]`).val(),
                        respiratory_rate:      $(`[name="respiratory_rate"]`).val(),
                        blood_pressure:        $(`[name="blood_pressure"]`).val(),
                        random_blood_sugar:    $(`[name="random_blood_sugar"]`).val(),
                        others:                $(`[name="others"]`).val(),
                        medicine:              getMedicineInputData(),
                        care_equipment:        getCareEquipmentInputData(),
                        recommendation:        $(`[name="recommendation"]`).val().trim(),
                        medical_history:       getMedicalHistoryInputData(),
                        clinical_case_record:  getClinicalCaseInputData()
                    };
    
                    sweetAlertConfirmation("add", "Check-up Form", "", "", data);
                }

            }
        })
        // ----- END BUTTON SAVE -----


        // ----- SWEET ALERT -----
        function sweetAlertConfirmation(
                condition   = "add",            // add|update|cancel
                moduleName  = "Another Data",   // Title
                modalID     = null,             // Modal ID 
                containerID = null,             // ContainerID - if not modal
                data        = null,             // data - object or formData
                isObject    = true,             // if the data is object or not
                callback    = false             // Function to be called after execution
            ) {

            let lowerCase 	= moduleName.toLowerCase();
            let upperCase	= moduleName.toUpperCase();
            let capitalCase = moduleName;
            let title 		      =  "";
            let text 		      =  ""
            let success_title     =  "";
            let swalImg           =  "";
            switch(condition) {
                case "add":
                    title 		  +=  "ADD " + upperCase;
                    text 		  +=  "Are you sure that you want to add a new "+ lowerCase +"?"
                    success_title +=  "Add new "+capitalCase + " successfully saved!";
                    swalImg       +=  `${base_url}assets/images/modal/add.svg`;
                    break;
                case "update":
                    title 		  +=  "UPDATE " + upperCase;
                    text 		  +=  "Are you sure that you want to update the "+ lowerCase +"?"
                    success_title +=  "Update "+ capitalCase + " successfully saved!";
                    swalImg       +=  `${base_url}assets/images/modal/update.svg`;
                    break;
                case "delete":
                    title 		  +=  "DELETE " + upperCase;
                    text 		  +=  "Are you sure that you want to update the "+ lowerCase +"?"
                    success_title +=  "Delete "+ capitalCase + " successfully saved!";
                    swalImg       +=  `${base_url}assets/images/modal/delete.svg`;
                    break;
                default:
                    title         +=  "DISCARD CHANGES";
                    text          +=  "Are you sure that you want to cancel this process?"
                    success_title +=  "Process successfully discarded!";
                    swalImg       +=  `${base_url}assets/images/modal/cancel.svg`;
                }
                Swal.fire({
                    title, 
                    text,
                    imageUrl: swalImg,
                    imageWidth: 200,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                    showCancelButton: true,
                    confirmButtonColor: '#2e6a78',
                    cancelButtonColor: '#1a1a1a',
                    cancelButtonText: 'No',
                    confirmButtonText: 'Yes',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $("#loader").show();
                        let swalTitle = success_title.toUpperCase();

                        if (condition != "cancel") {
                            if (condition.toLowerCase() == "add") {
                                $.ajax({
                                    method: "POST",
                                    url: `checkup_form/insertCheckupForm`,
                                    dataType: 'json',
                                    async: true,
                                    data,
                                    success: function(data) {
                                        $("#loader").hide();
                                        
                                        let result = data.split("|");
                                        if (result[0] == "true") {
                                            Swal.fire({
                                                icon:  'success',
                                                title: "Successfully saved",
                                                showConfirmButton: false,
                                                timer: 2000
                                            }).then(function() {
                                                pageContent();
                                            });
                                        } 
                                    }
                                })
                            }
                        } else {
                            Swal.fire({
                                icon:  'success',
                                title: swalTitle,
                                showConfirmButton: false,
                                timer: 2000
                            }).then(function() {
                                $("#loader").hide();
                            });
                        }
                    } else {
                        // if (condition != "delete") $("#"+modalID).modal("show");
                    }
                });
            }
        // ----- END SWEET ALERT -----

    })

</script>
    