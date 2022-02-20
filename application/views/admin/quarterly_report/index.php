<div class="content-wrapper">

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">Quarterly Report</h4>
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
        let year = [], month = ["January", "February","March","April","May","June","July","August","September","October","November","December"];
        for (let index = 2022; index >= 2015; index--) {
            year.push(index);
        }

        function yearOption(){
            let html = `<option value="" selected="" disabled="">Select year</option>`;
            year.map((value, index)=>{
                html += `<option value="${value}">${value}</option>`;
            });
            return html;
        }



        $(document).on("change",".sorting-records", function(){
            let selectYear      = $(`[name=year_record]`).val();
            let selectQuarter   = $(`[name=quarter_record]`).val();
            
            if(selectYear && selectQuarter) {
                !document.getElementsByClassName("jumping-dots-loader").length && $("#tableContent").html(preloader);

                setTimeout(() => {
                    let tbody   = getTbodyData(selectYear,selectQuarter);
                    let content = tableContent();
                    $("#tableContent").html(content);
                    initDataTables();
                    $("#tableQuarterlyReportTbody").html(tbody);
                }, 500);
            }

        });

        // ----- DATATABLES -----
        function initDataTables() {
            if ($.fn.DataTable.isDataTable("#tableQuarterlyReport")) {
                $("#tableQuarterlyReport").DataTable().destroy();
            }
            
            var table = $("#tableQuarterlyReport")
                .css({ "min-width": "100%" })
                .removeAttr("width")
                .DataTable({
                    proccessing:    false,
                    serverSide:     false,
                    scrollX:        true,
                    sorting:        [],
                    scrollCollapse: true,
                    paging:false,
                    
                    columnDefs: [
                        { targets: 0, width: '50px'  },
                        { targets: 1, width: '150px' },
                        { targets: 2, width: '150px' },
                        { targets: 3, width: '150px' },
                        { targets: 4, width: '150px' },
                    ],
                });
        }
        // ----- END DATATABLES -----


        // ----- TABLE CONTENT -----
        function tableContent() {

            let tbodyHTML = '';
            
            let html = `
            <table class="table table-hover table-bordered" id="tableQuarterlyReport">
                <thead>
                    <tr class="text-center">
                        <th>No.</th>
                        <th>Patient Type</th>
                        <th>Dispencing of Medicine</th>
                        <th>Medical and Dental</th>
                        <th>Others</th>
                        <th>No. of Clients Served</th>
                    </tr>
                </thead>
                <tbody id="tableQuarterlyReportTbody">
                    ${tbodyHTML}
                </tbody>
            </table>`;

            return html;
        }
        // ----- END TABLE CONTENT -----

        function getTbodyData(yearValue = false , quarterValue = false){
            let tbodyHTML = "";
            if(yearValue && quarterValue){
                let patientTypeData = getTableData(`patient_type`,``,`is_deleted = 0`);
                
                let startIndex = 0;
                switch (quarterValue) {
                    case "5":
                            startIndex = 3
                        break;
                    case "8":
                            startIndex = 6
                        break;
                    case "11":
                            startIndex = 9
                        break;
                    default:
                        startIndex = 0
                        break;
                }
                let forloopLenght = parseInt(quarterValue) + 1;
                for (startIndex; startIndex < forloopLenght; startIndex++) {
                        tbodyHTML += `
                                        <tr class="text-center">
                                            <td colspan="6">${month[startIndex]}</td>
                                        </tr>`;

                        patientTypeData.map((value,index)=>{
                            let totalMedical    = getTableData(`check_ups AS mainTbl LEFT JOIN patients USING(patient_id)`, `IF(month(mainTbl.created_at) = '${parseInt(startIndex)+1}' AND year(mainTbl.created_at) = '${yearValue}', COUNT(check_up_id), 0) AS dataValue`,`patients.patient_type_id = '${value.patient_type_id}' AND mainTbl.service_id = '1' `);
                            let totalMedicine   = getTableData(`check_ups AS mainTbl LEFT JOIN patients USING(patient_id)`, `IF(month(mainTbl.created_at) = '${parseInt(startIndex)+1}' AND year(mainTbl.created_at) = '${yearValue}', COUNT(check_up_id), 0) AS dataValue`,`patients.patient_type_id = '${value.patient_type_id}' AND mainTbl.service_id = '3' `);
                            let totalOther      = getTableData(`check_ups AS mainTbl LEFT JOIN patients USING(patient_id)`, `IF(month(mainTbl.created_at) = '${parseInt(startIndex)+1}' AND year(mainTbl.created_at) = '${yearValue}', COUNT(check_up_id), 0) AS dataValue`,`patients.patient_type_id = '${value.patient_type_id}' AND mainTbl.service_id != '1' || mainTbl.service_id != '3' `);
                            let totalService    = parseInt(totalMedical[0]["dataValue"] || 0) + parseInt(totalMedicine[0]["dataValue"] || 0) + parseInt(totalOther[0]["dataValue"] || 0);
                            // `month(mainTbl.created_at) = '${startIndex}' AND year(mainTbl.created_at) = '${yearValue}'
                           
                            tbodyHTML += `
                                            <tr class="text-right">
                                                <td>${parseInt(index) + 1}</td>
                                                <td>${value["name"]}</td>
                                                <td>${parseInt(totalMedicine[0]["dataValue"] || 0)}</td>
                                                <td>${parseInt(totalMedical[0]["dataValue"] || 0) }</td>
                                                <td>${parseInt(totalOther[0]["dataValue"] || 0)}</td>
                                                <td>${totalService}</td>
                                            </tr>
                                    `;
                        });
                }

            }

            return tbodyHTML;
        }


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
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label>Year</label>
                                <select class="form-control sorting-records" name="year_record">
                                    ${yearOption()}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label>Quarter</label>
                                <select class="form-control sorting-records" name="quarter_record">
                                    <option value="" selected="" disabled="">Select Quarter of the year</option>
                                    <option value="2">First Quarter</option>
                                    <option value="5">Second Quarter</option>
                                    <option value="8">Third Quarter</option>
                                    <option value="11">Fourth Quarter</option>
                                </select>
                            </div>
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
                category_id = "",
                name        = "",
            } = data && data[0];

            let buttonSaveUpdate = !isUpdate ? `
            <button class="btn btn-primary" 
                id="btnSave"
                categoryID="${category_id}">Save</button>` : `
            <button class="btn btn-primary" 
                id="btnUpdate"
                categoryID="${category_id}">Update</button>`;

            let html = `
            <div class="row p-3">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Name <code>*</code></label>
                        <input type="text" 
                            class="form-control validate"
                            name="name"
                            minlength="1"
                            maxlength="50"
                            value="${name}"
                            required>
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


    })

</script>
    