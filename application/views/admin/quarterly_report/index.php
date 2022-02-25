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
            let year    = $(`[name=year_record]`).val();
            let quarter = $(`[name=quarter_record]`).val();
            
            if(year && quarter) {
                refreshTableContent();
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
                    paging:         false,
                    sorting:        false,
                    searching:      false,
                    ordering:       false,
                    info:           false,
                    columnDefs: [
                        { targets: 0, width: '50px'  },
                        { targets: 1, width: '150px' },
                        { targets: 2, width: '150px' },
                        { targets: 3, width: '150px' },
                        { targets: 4, width: '150px' },
                        { targets: 5, width: '150px' },
                    ],
                });
        }
        // ----- END DATATABLES -----


        // ----- QUARTERLY REPORT -----
        function getQuarterlyReport(year = '', quarter = 1) {
            let result = [];
            $.ajax({
                method: "POST",
                url: "quarterly_report/getQuarterlyReport",
                data: { year, quarter },
                async: false,
                dataType: "json",
                success: function(data) {
                    result = data;
                }
            })
            return result;
        }
        // ----- END QUARTERLY REPORT -----


        // ----- QUARTERLY REPORT DISPLAY -----
        function getQuarterlyReportDisplay(year = '' , quarter = 0) {
            let html = "";

            if (year && quarter) {
                let quarterlyReport = getQuarterlyReport(year, quarter);
                quarterlyReport.map((item) => {
                    let { monthName = '', items = [] } = item;

                    html += `
                    <tr>
                        <td class="text-center" colspan="6">${monthName}</td>
                    </tr>`;

                    items.map((x, i) => {
                        let { occupationName = '', services = [], total = 0 } = x;

                        let countHTML = '';
                        services.map(y => {
                            countHTML += `<td>${y.total}</td>`;
                        })

                        html += `
                        <tr class="text-center">
                            <td>${i+1}</td>
                            <td>${occupationName}</td>
                            ${countHTML}
                            <td>0</td>
                            <td>${total}</td>
                        </tr>`;
                    })
                })
            }

            return html;
        }
        // ----- END QUARTERLY REPORT DISPLAY -----


        // ----- TABLE CONTENT -----
        function tableContent(year = '', quarter = 0) {
            let tbodyHTML = getQuarterlyReportDisplay(year, quarter);

            let buttonPrint = tbodyHTML ? `<button class="btn btn-primary mb-2" id="btnPrint" year="${year}" quarter="${quarter}"><i class="fas fa-print"></i> Print</button>` : '';
            
            let html = `
            ${buttonPrint}
            <table class="table table-hover table-bordered" id="tableQuarterlyReport">
                <thead>
                    <tr class="text-center">
                        <th>No.</th>
                        <th>Occupation Type</th>
                        <th>Dispensing of Medicine</th>
                        <th>Medical and Dental Services</th>
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


        // ----- REFRESH TABLE CONTENT -----
        function refreshTableContent() {
            !document.getElementsByClassName("jumping-dots-loader").length && $("#tableContent").html(preloader);
            
            let year    = $(`[name=year_record]`).val();
            let quarter = $(`[name=quarter_record]`).val();
            
            setTimeout(() => {
                let content = tableContent(year, quarter);
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
                                    <option value="1">First Quarter</option>
                                    <option value="2">Second Quarter</option>
                                    <option value="3">Third Quarter</option>
                                    <option value="4">Fourth Quarter</option>
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


        // ----- BUTTON PRINT -----
        $(document).on("click", "#btnPrint", function() {
            let year    = $(this).attr("year");
            let quarter = $(this).attr("quarter");
            window.open(`quarterly_report/print?year=${year}&quarter=${quarter}`, '_blank');
        })
        // ----- END BUTTON PRINT -----


    })

</script>
    