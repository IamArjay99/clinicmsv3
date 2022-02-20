<div class="content-wrapper">

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">Add Stock In</h4>
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
        let medicineList = getTableData(
            `medicines AS m
                LEFT JOIN units AS u USING(unit_id)
                LEFT JOIN measurements AS m2 USING(measurement_id)
            WHERE m.is_deleted = 0`,
            `m.*, u.name AS unit_name, m2.name AS measurement_name`);
        let careEquipmentList = getTableData(
            `care_equipments AS ce
                LEFT JOIN units AS u USING(unit_id) 
            WHERE ce.is_deleted = 0`,
            `ce.*, u.name AS unit_name`);
        let officeSupplyList = getTableData(
            `office_supply AS os
                LEFT JOIN units AS u USING(unit_id)
            WHERE os.is_deleted = 0`,
            `os.*, u.name AS unit_name`);
        let purchaseRequestList = getTableData(`purchase_request WHERE is_deleted = 0 AND status = 1`) // APPROVED PR
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
                        { targets: 7, width: '100px' },
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
                        { targets: 5, width: '100px' },
                    ],
                });

            if ($.fn.DataTable.isDataTable("#tableOfficeSupply")) {
                $("#tableOfficeSupply").DataTable().destroy();
            }
            
            var table = $("#tableOfficeSupply")
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
                    ],
                });
        }
        // ----- END DATATABLES -----


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
                } = medicine;

                html += `
                <option value="${medicine_id}"
                    brand="${brand}"
                    unit_name="${unit_name}"
                    measurement_name="${measurement_name}"
                    ${medicineID == medicine_id ? "selected" : ""}>${name}</option>`;
            })
            return html;
        }

        function getMedicineRow(data = false) {
            let {
                purchase_request_medicine_id,
                medicine_id,
                medicine_name,
                medicine_brand,
                unit_name,
                measurement_name,
                quantity
            } = data;

            let nameHTML = data ? `
            <input type="hidden" name="medicine_id" value="${medicine_id}"><div>${medicine_name}</div>` :
            `<div class="form-group mb-0">
                <select class="form-control validate"
                    name="medicine_id"
                    required>
                    ${getMedicineOptionDisplay(medicine_id)}    
                </select>
                <div class="d-block invalid-feedback"></div>
            </div>`;

            let html = `
            <tr purchase_request_medicine_id="${purchase_request_medicine_id}">
                <td class="text-center">
                    <button class="btn btn-danger btnDelete"
                        title="Delete">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
                <td>
                    ${nameHTML}
                </td>
                <td class="brand">${medicine_brand || "-"}</td>
                <td class="unit">${unit_name || "-"}</td>
                <td class="measurement">${measurement_name || "-"}</td>
                <td>
                    <div class="form-group mb-0">
                        <input type="number"
                            class="form-control validate"
                            name="quantity"
                            min="1"
                            max="999999"
                            value="${quantity || ""}"
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </td>
                <td>
                    <div class="form-group mb-0">
                        <input type="text"
                            class="form-control validate"
                            name="batch"
                            minlength="1"
                            maxlength="100"
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </td>
                <td>
                    <div class="form-group mb-0">
                        <input type="date"
                            class="form-control validate"
                            name="expiration"
                            min="${moment().format("YYYY-MM-DD")}"
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </td>
            </tr>`;
            return html;
        }

        function medicineContent(data = [], hasReference = false) {
            let tbodyHTML = '';
            if (data && data.length) {
                data.map((item) => {
                    tbodyHTML += getMedicineRow(item);
                })
            } else {
                tbodyHTML = !hasReference ? getMedicineRow() : '';
            }

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
                                <th>Quantity <code>*</code></th>
                                <th>Batch No. <code>*</code></th>
                                <th>Expiration Date <code>*</code></th>
                            </tr>
                        </thead>
                        <tbody id="tableMedicineTbody">
                            ${tbodyHTML}
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="8" class="">
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
                } = care_equipment;

                html += `
                <option value="${care_equipment_id}"
                    unit_name="${unit_name}"
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
                <td>
                    <div class="form-group mb-0">
                        <input type="text"
                            class="form-control validate"
                            name="batch"
                            minlength="1"
                            maxlength="100"
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </td>
                <td>
                    <div class="form-group mb-0">
                        <input type="date"
                            class="form-control validate"
                            name="expiration"
                            min="${moment().format("YYYY-MM-DD")}"
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
                                <th>Quantity <code>*</code></th>
                                <th>Batch No. <code>*</code></th>
                                <th>Expiration Date <code>*</code></th>
                            </tr>
                        </thead>
                        <tbody id="tableCareEquipmentTbody">
                            ${tbodyHTML}
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6" class="">
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


        // ----- OFFICE SUPPLY CONTENT -----
        function getOfficeSupplyOptionDisplay(officeSupplyID = 0) {
            let html = `<option value="" selected>Select office supply</option>`;
            officeSupplyList.map(office_supply => {
                let {
                    office_supply_id,
                    name,
                    unit_name,
                } = office_supply;

                html += `
                <option value="${office_supply_id}"
                    unit_name="${unit_name}"
                    ${officeSupplyID == office_supply_id ? "selected" : ""}>${name}</option>`;
            })
            return html;
        }

        function getOfficeSupplyRow(data = false) {
            let {
                purchase_request_office_supply_id,
                office_supply_id,
                office_supply_name,
                unit_name,
                quantity
            } = data;

            let nameHTML = data ? `
            <input type="hidden" name="office_supply_id" value="${office_supply_id}"><div>${office_supply_name}</div>` :
            `<div class="form-group mb-0">
                <select class="form-control validate"
                    name="office_supply_id"
                    required>
                    ${getOfficeSupplyOptionDisplay(office_supply_id)}    
                </select>
                <div class="d-block invalid-feedback"></div>
            </div>`;

            let html = `
            <tr>
                <td class="text-center">
                    <button class="btn btn-danger btnDelete"
                        title="Delete">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
                <td>
                    ${nameHTML}
                </td>
                <td class="unit">${unit_name || "-"}</td>
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
                <td>
                    <div class="form-group mb-0">
                        <input type="text"
                            class="form-control validate"
                            name="batch"
                            minlength="1"
                            maxlength="100"
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </td>
                <td>
                    <div class="form-group mb-0">
                        <input type="date"
                            class="form-control validate"
                            name="expiration"
                            min="${moment().format("YYYY-MM-DD")}"
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </td>
            </tr>`;
            return html;
        }

        function officeSupplyContent(data = [], hasReference = false) {
            let tbodyHTML = '';
            if (data && data.length) {
                data.map(item => {
                    tbodyHTML += getOfficeSupplyRow(item);
                })
            } else {
                tbodyHTML = !hasReference ? getOfficeSupplyRow() : '';
            }

            let html = `
            <div class="row">
                <div class="col-12" id="tableOfficeSupplyParent">
                    <table class="table table-hover table-bordered" id="tableOfficeSupply">
                        <thead>
                            <tr class="text-center">
                                <th>&nbsp;</th>
                                <th>Name <code>*</code></th>
                                <th>Unit</th>
                                <th>Quantity <code>*</code></th>
                                <th>Batch No. <code>*</code></th>
                                <th>Expiration Date <code>*</code></th>
                            </tr>
                        </thead>
                        <tbody id="tableOfficeSupplyTbody">
                            ${tbodyHTML}
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6" class="">
                                    <button class="btn btn-outline-primary btnAdd"
                                        table="office_supply">
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
        // ----- END OFFICE SUPPLY CONTENT -----


        // ----- PURCHASE REQUEST OPTION DISPLAY -----
        function getPurchaseRequestOptionDisplay() {
            let html = `<option value='0' selected>Internal</option>`;
            purchaseRequestList.map(item => {
                let {
                    purchase_request_id,
                    code,
                } = item;
                html += `<option value="${purchase_request_id}">${code}</option>`;
            })
            return html;
        }
        // ----- END PURCHASE REQUEST OPTION DISPLAY -----


        // ----- PAGE CONTENT -----
        function pageContent() {
            !document.getElementsByClassName("jumping-dots-loader").length && $("#pageContent").html(preloader);

            let html = `
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Reference <code>*</code></label>
                        <select class="form-control validate"
                            name="purchase_request_id"
                            required>  
                            ${getPurchaseRequestOptionDisplay()}  
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label>Reason</label>
                        <textarea class="form-control validate"
                            name="reason"
                            minlength="0"
                            maxlength="300"
                            rows="3"
                            style="resize: none;"></textarea>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-12" id="addStockInContent">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">MEDICINE</h5>
                        </div>
                        <div class="card-body" id="medicineContent">${medicineContent()}</div>
                    </div>
                    <div class="card my-4">
                        <div class="card-header">
                            <h5 class="mb-0">CARE EQUIPMENT</h5>
                        </div>
                        <div class="card-body" id="careEquipmentContent">${careEquipmentContent()}</div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">OFFICE SUPPLY</h5>
                        </div>
                        <div class="card-body" id="officeSupplyContent">${officeSupplyContent()}</div>
                    </div>
                </div>
            </div>
            <div class="card-footer border-top text-right">
                <button class="btn btn-primary" id="btnSave">Save</button>
                <button class="btn btn-danger" id="btnCancel">Cancel</button>
            </div>`;

            setTimeout(() => {
                $("#pageContent").html(html);
                initDataTables();
                generateInputsID();
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
                    } = item;

                    html += `
                    <option value="${medicine_id}"
                        brand="${brand}"
                        unit_name="${unit_name}"
                        measurement_name="${measurement_name}"
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
                    } = item;

                    html += `
                    <option value="${care_equipment_id}"
                        unit_name="${unit_name}"
                        ${itemIDArr[index] == care_equipment_id ? "selected" : ""}>${name}</option>`;
                 })

                $(`#${element}`).html(html);
            })
        }
        // ----- END UNIQUE CARE EQUIPMENT OPTION -----


        // ----- UNIQUE OFFICE SUPPLY OPTION -----
        function uniqueOfficeSupplyOption() {
            let itemIDArr = [], itemElementArr = [];
            $(`[name="office_supply_id"]`).each(function() {
                let id = $(this).attr("id");
                itemIDArr.push($(this).val());
                itemElementArr.push(id);
            });

            itemElementArr.map((element, index) => {
                let html = `<option value="" selected>Select office supply</option>`;

                officeSupplyList
                 .filter(item => !itemIDArr.includes(item.office_supply_id) || item.office_supply_id == itemIDArr[index])
                 .map(item => {
                    let {
                        office_supply_id,
                        name,
                        unit_name,
                    } = item;

                    html += `
                    <option value="${office_supply_id}"
                        unit_name="${unit_name}"
                        ${itemIDArr[index] == office_supply_id ? "selected" : ""}>${name}</option>`;
                 })

                $(`#${element}`).html(html);
            })
        }
        // ----- END UNIQUE OFFICE SUPPLY OPTION -----


        // ----- GET STOCK IN DATA -----
        function getStockInData() {
            let medicine = [];
            $(`#tableMedicineTbody tr`).each(function() {
                let temp = {
                    medicine_id: $(`[name="medicine_id"]`, this).val(),
                    quantity:    $(`[name="quantity"]`, this).val(),
                    batch:       $(`[name="batch"]`, this).val(),
                    expiration:  $(`[name="expiration"]`, this).val(),
                }
                medicine.push(temp);
            })

            let careEquipment = [];
            $(`#tableCareEquipmentTbody tr`).each(function() {
                let temp = {
                    care_equipment_id: $(`[name="care_equipment_id"]`, this).val(),
                    quantity:          $(`[name="quantity"]`, this).val(),
                    batch:             $(`[name="batch"]`, this).val(),
                    expiration:        $(`[name="expiration"]`, this).val(),
                }
                careEquipment.push(temp);
            })

            let officeSupply = [];
            $(`#tableOfficeSupplyTbody tr`).each(function() {
                let temp = {
                    office_supply_id: $(`[name="office_supply_id"]`, this).val(),
                    quantity:         $(`[name="quantity"]`, this).val(),
                    batch:            $(`[name="batch"]`, this).val(),
                    expiration:       $(`[name="expiration"]`, this).val(),
                }
                officeSupply.push(temp);
            })

            let data = {
                purchase_request_id: $(`[name="purchase_request_id"]`).val(),
                reason:              $(`[name="reason"]`).val()?.trim(),
                medicine,
                careEquipment,
                officeSupply
            };

            return data;
        }
        // ----- END GET STOCK IN DATA -----


        // ----- GET PURCHASE REQUEST DATA -----
        function getPurchaseRequest(purchaseRequestID = 0) {
            let result = null;
            $.ajax({
                method: "POST",
                url: `${base_url}admin/purchase_request/getPurchaseRequest`,
                data: { purchaseRequestID },
                async: false,
                dataType: 'json',
                success: function(data) {
                    result = data;
                }
            })
            return result;
        }
        // ----- END GET PURCHASE REQUEST DATA -----


        // ----- SELECT REFERENCE -----
        $(document).on("change", `[name="purchase_request_id"]`, function() {
            let purchaseRequestID = $(this).val();
            $(`#medicineContent, #careEquipmentContent, #officeSupplyContent`).html(preloader);
            let medicineContentHTML      = medicineContent();
            let careEquipmentContentHTML = careEquipmentContent();
            let officeSupplyContentHTML  = officeSupplyContent();

            let flag = false;

            if (purchaseRequestID != '0') {
                let data = getPurchaseRequest(purchaseRequestID);
                medicineContentHTML      = medicineContent(data.medicine, true);
                careEquipmentContentHTML = careEquipmentContent(data.care_equipment, true);
                officeSupplyContentHTML  = officeSupplyContent(data.office_supply, true);

                flag = true;
            } 

            setTimeout(function() {
                
                $(`#medicineContent`).html(medicineContentHTML);
                $(`#careEquipmentContent`).html(careEquipmentContentHTML);
                $(`#officeSupplyContent`).html(officeSupplyContentHTML);
                initDataTables();

                $(`table select`).trigger("change");

                if (flag) {
                    $(`table select`).attr("disabled", true).trigger("change");
                    $(`.btnAdd`).remove();
                }
            }, 100)
        })
        // ----- END SELECT REFERENCE -----


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
            } else {
                row = getOfficeSupplyRow();
                tableElement = '#tableOfficeSupplyTbody';
            }

            $(tableElement).append(row);

            generateInputsID();
            uniqueMedicineOption();
            uniqueCareEquipmentOption();
            uniqueOfficeSupplyOption();
        });
        // ----- END BUTTON ADD -----


        // ----- BUTTON DELETE -----
        $(document).on("click", ".btnDelete", function() {
            $(this).closest('tr').remove();
            generateInputsID();
            uniqueMedicineOption();
            uniqueCareEquipmentOption();
            uniqueOfficeSupplyOption();
        });
        // ----- END BUTTON DELETE -----


        // ----- SELECT MEDICINE -----
        $(document).on('change', `[name="medicine_id"]`, function() {
            $parent = $(this).closest("tr");
            let elementID = $(this).attr("id");

            let brand       = $(`option:selected`, this).attr("brand") || "-"; 
            let unit        = $(`option:selected`, this).attr("unit_name") || "-"; 
            let measurement = $(`option:selected`, this).attr("measurement_name") || "-";
            
            $parent.find(`.brand`).text(brand);
            $parent.find(`.unit`).text(unit);
            $parent.find(`.measurement`).text(measurement);

            uniqueMedicineOption();
        })
        // ----- END SELECT MEDICINE -----


        // ----- SELECT CARE EQUIPMENT -----
        $(document).on('change', `[name="care_equipment_id"]`, function() {
            $parent = $(this).closest("tr");
            let elementID = $(this).attr("id");

            let unit = $(`option:selected`, this).attr("unit_name") || "-";
            $parent.find(`.unit`).text(unit);

            uniqueCareEquipmentOption();
        })
        // ----- END SELECT CARE EQUIPMENT -----


        // ----- SELECT CARE EQUIPMENT -----
        $(document).on('change', `[name="office_supply_id"]`, function() {
            $parent = $(this).closest("tr");
            let elementID = $(this).attr("id");

            let unit = $(`option:selected`, this).attr("unit_name") || "-";
            $parent.find(`.unit`).text(unit);

            uniqueOfficeSupplyOption();
        })
        // ----- END SELECT CARE EQUIPMENT -----


        // ----- BUTTON SAVE -----
        $(document).on("click", "#btnSave", function() {
            let hasData  = document.querySelectorAll(`[name="medicine_id"]`).length + document.querySelectorAll(`[name="care_equipment_id"]`).length + document.querySelectorAll(`[name="office_supply_id"]`).length != 0;
            if (!hasData) {
                showNotification("warning", "You must have atleast one item to stock in")
            } else {
                let validate = validateForm("addStockInContent");
                if (validate) {
                    let data = getStockInData();
                    
                    Swal.fire({
                        title: "SAVE STOCK IN", 
                        text: "Are you sure you want to save this stock in?",
                        imageUrl: `${base_url}assets/images/modal/add.svg`,
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
                            $.ajax({
                                method: "POST",
                                url: `${base_url}admin/stock_in/saveStockIn`,
                                data,
                                dataType: "json",
                                async: false,
                                success: function(data) {
                                    setTimeout(() => {
                                        $("#loader").hide();

                                        let result = data?.split("|") || false;
                                        if (result && result[0]) {
                                            Swal.fire({
                                                title: "Stock In saved successfully!",
                                                icon: "success",
                                                showConfirmButton: false,
                                                timer: 2000
                                            }).then(function() {
                                                window.location.replace(`${base_url}admin/stock_in`);
                                            })
                                        }

                                    }, 100);
                                }
                            })
                        } 
                    });
                }
            }
        })
        // ----- END BUTTON SAVE -----


        // ----- BUTTON CANCEL -----
        $(document).on("click", "#btnCancel", function() {
            Swal.fire({
                title: "CANCEL STOCK IN", 
                text: "Are you sure you want to cancel this stock in?",
                imageUrl: `${base_url}assets/images/modal/delete.svg`,
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
                    window.location.replace(`${base_url}admin/stock_in`);
                } 
            });
        })
        // ----- END BUTTON CANCEL -----

    })

</script>
    