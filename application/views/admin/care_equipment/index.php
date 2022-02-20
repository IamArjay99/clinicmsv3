<div class="content-wrapper">

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">Care Equipment</h4>
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
        let unitList = getTableData(`units WHERE is_deleted = 0`);
        // ----- END GLOBAL VARIABLES -----


        // ----- DATATABLES -----
        function initDataTables() {
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
                    sorting:        [],
                    scrollCollapse: true,
                    columnDefs: [
                        { targets: 0, width: '50px'  },
                        { targets: 1, width: '250px' },
                        { targets: 2, width: '150px' },
                        { targets: 3, width: '100px' },
                    ],
                });
        }
        // ----- END DATATABLES -----


        // ----- UNIT OPTIONS DISPLAY -----
        function getUnitOptionDisplay(unitID = 0) {
            let html = `<option value="" selected>Select unit</option>`;
            unitList.map(unit => {
                let {
                    unit_id,
                    name
                } = unit;

                html += `
                <option value="${unit_id}"
                    ${unit_id == unitID ? "selected" : ""}>${name}</option>`;
            })
            return html;
        }
        // ----- END UNIT OPTIONS DISPLAY -----


        // ----- TABLE CONTENT -----
        function tableContent() {

            let tbodyHTML = '';
            let data = getTableData(
                `care_equipments AS m
                    LEFT JOIN units AS u USING(unit_id)
                WHERE m.is_deleted = 0`,
                `m.*, u.name AS unit_name`);
            data.map((item, index) => {
                let {
                    care_equipment_id = "",
                    brand             = "",
                    name              = "",
                    unit_name         = "",
                } = item;

                tbodyHTML += `
                <tr>
                    <td class="text-center">${index+1}</td>
                    <td>${name || "-"}</td>
                    <td>${unit_name || "-"}</td>
                    <td>
                        <div class="text-center">
                            <button class="btn btn-outline-info btnEdit"
                                careEquipmentID="${care_equipment_id}"><i class="fas fa-pencil-alt"></i></button>
                            <button class="btn btn-outline-danger btnDelete"
                                careEquipmentID="${care_equipment_id}"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </td>
                </tr>`;
            });

            let html = `
            <table class="table table-hover table-bordered" id="tableCareEquipment">
                <thead>
                    <tr class="text-center">
                        <th>No.</th>
                        <th>Name</th>
                        <th>Unit</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tableCareEquipmentTbody">
                    ${tbodyHTML}
                </tbody>
            </table>`;

            return html;
        }
        // ----- END TABLE CONTENT -----


        // ----- REFRESH TABLE CONTENT -----
        function refreshTableContent() {
            !document.getElementsByClassName("jumping-dots-loader").length && $("#tableContent").html(preloader);
            
            setTimeout(() => {
                let content = tableContent();
                $("#tableContent").html(content);
                initDataTables();
            }, 100);
        }
        // ----- END REFRESH TABLE CONTENT -----


        // ----- PAGE CONTENT -----
        function pageContent() {
            !document.getElementsByClassName("jumping-dots-loader").length && $("#pageContent").html(preloader);

            let html = `
            <div class="row">
                <div class="col-12" id="filterContent">
                    <div class="row mb-4">
                        <div class="col-md-4 col-sm-12"></div>
                        <div class="col-md-8 col-sm-12 text-right">
                            <button class="btn btn-primary"
                                id="btnAdd"><i class="fas fa-plus"></i> Add Care Equipment</button>
                        </div>
                    </div>
                </div>
                <div class="col-12" id="tableContent">${tableContent()}</div>
            </div>`;

            setTimeout(() => {
                $("#pageContent").html(html);
                initDataTables();
            }, 100);
        }
        pageContent();
        // ----- END PAGE CONTENT -----


        // ----- FORM CONTENT -----
        function formContent(data = false, isUpdate = false) {
            let {
                care_equipment_id = "",
                brand             = "",
                name              = "",
                unit_id           = "",
                reorder           = "",
                capacity          = "",
            } = data && data[0];

            let buttonSaveUpdate = !isUpdate ? `
            <button class="btn btn-primary" 
                id="btnSave"
                careEquipmentID="${care_equipment_id}">Save</button>` : `
            <button class="btn btn-primary" 
                id="btnUpdate"
                careEquipmentID="${care_equipment_id}">Update</button>`;

            let html = `
            <div class="row p-3">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Name <code>*</code></label>
                        <input type="text" 
                            class="form-control validate"
                            name="name"
                            minlength="1"
                            maxlength="100"
                            value="${name}"
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Unit <code>*</code></label>
                        <select class="form-control validate"
                            name="unit_id"
                            required>
                            ${getUnitOptionDisplay(unit_id)}    
                        </select>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Re-order <code>*</code></label>
                        <input type="number" 
                            class="form-control validate"
                            name="reorder"
                            minlength="1"
                            maxlength="100"
                            value="${reorder}">
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Maximum Capacity <code>*</code></label>
                        <input type="number" 
                            class="form-control validate"
                            name="capacity"
                            minlength="1"
                            maxlength="100"
                            value="${capacity}">
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                ${buttonSaveUpdate}
                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>`;

            return html;
        }
        // ----- END FORM CONTENT -----


        // ----- BUTTON ADD -----
        $(document).on("click", "#btnAdd", function() {
            let html = formContent();
            $("#modal .modal-dialog").removeClass("modal-md").addClass("modal-md");
            $("#modal_content").html(html);
            $("#modal .page-title").text("ADD CARE EQUIPMENT");
            $("#modal").modal('show');
            generateInputsID("#modal");
        });
        // ----- END BUTTON ADD -----


        // ----- BUTTON EDIT -----
        $(document).on("click", ".btnEdit", function() {
            let careEquipmentID = $(this).attr("careEquipmentID");
            let data = getTableData(`care_equipments WHERE care_equipment_id = ${careEquipmentID}`);

            $("#modal .modal-dialog").removeClass("modal-md").addClass("modal-md");
            $("#modal_content").html(preloader);
            $("#modal .page-title").text("EDIT CARE EQUIPMENT");
            $("#modal").modal('show');

            setTimeout(() => {
                let html = formContent(data, true);
                $("#modal_content").html(html);
                generateInputsID("#modal");
            }, 100);
        });
        // ----- END BUTTON EDIT -----


        // ----- BUTTON SAVE -----
        $(document).on("click", `#btnSave`, function() {
            let careEquipmentID = $(this).attr("careEquipmentID");
            
            let validate = validateForm("modal");
            if (validate) {
                $("#modal").modal("hide");

                let data = getFormData("modal");
                    data["tableName"] = "care_equipments";
                    data["feedback"]  = $(`[name="name"]`).val();
                    data["method"]    = "add";
    
                sweetAlertConfirmation("add", "Care Equipment", "modal", null, data, true, refreshTableContent);
            }
        })
        // ----- END BUTTON SAVE -----


        // ----- BUTTON SAVE -----
        $(document).on("click", `#btnUpdate`, function() {
            let careEquipmentID = $(this).attr("careEquipmentID");
            
            let validate = validateForm("modal");
            if (validate) {
                $("#modal").modal("hide");

                let data = getFormData("modal");
                    data["tableName"]   = "care_equipments";
                    data["feedback"]    = $(`[name="name"]`).val();
                    data["method"]      = "update";
                    data["whereFilter"] = `care_equipment_id=${careEquipmentID}`;
    
                sweetAlertConfirmation("update", "Care Equipment", "modal", null, data, true, refreshTableContent);
            }
        })
        // ----- END BUTTON SAVE -----
        

        // ----- BUTTON DELETE -----
        $(document).on("click", `.btnDelete`, function() {
            let careEquipmentID = $(this).attr("careEquipmentID");

            let data = {
                tableName: 'care_equipments',
                tableData: {
                    is_deleted: 1
                },
                whereFilter: `care_equipment_id=${careEquipmentID}`,
                feedback:    $(`[name="name"]`).val(),
                method:      "update"
            }
            sweetAlertConfirmation("delete", "Care Equipment", "modal", null, data, true, refreshTableContent);
        })
        // ----- END BUTTON DELETE -----

    })

</script>
    