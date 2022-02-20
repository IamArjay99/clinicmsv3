<div class="content-wrapper">

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">Survey Report</h4>
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
            if ($.fn.DataTable.isDataTable("#tableSurveyReport")) {
                $("#tableSurveyReport").DataTable().destroy();
            }
            
            var table = $("#tableSurveyReport")
                .css({ "min-width": "100%" })
                .removeAttr("width")
                .DataTable({
                    proccessing:    false,
                    serverSide:     false,
                    scrollX:        true,
                    sorting:        [],
                    scrollCollapse: true,
                    columnDefs: [	
                        { targets: 0, width: "150px" },	
                        { targets: 1, width: "100px" },	
                        { targets: 2, width: "100px" },	
                        { targets: 3, width: "100px" },	
                        { targets: 4, width: "100px" },	
                        { targets: 5, width: "100px" },	
                        { targets: 6, width: "150px" },	
                        { targets: 7, width: "150px" },	
                    ],
                });
        }
        // ----- END DATATABLES -----


        // ----- TABLE CONTENT -----
        function tableContent(year = '', month = '', monthName = '') {

            let html = `
            <div class="w-100 py-5 text-center">
                <img src="${base_url}assets/images/modal/select.svg"
                    width="200" height="200" alt="Select year and month">
                <h4 class="mt-3">Please select year and month</h4>
            </div>`;

            if (year && month) {
                let col1 = 0, col2 = 0, col3 = 0, col4 = 0, col5 = 0, totalRespondent = 0;

                let tbodyHTML = '';
                let data = getTableData(
                    `surveys WHERE status = 1
                        AND YEAR(created_at) = '${year}' AND MONTH(created_at) = '${month}'`,
                    `ROUND((q1+q2+q3+q4+q5+q6+q7+q8+q9+q10)/10, 0) AS average`);
                data.map((item, index) => {
                    let { average = "" } = item;
                    col1 += (average == 1 ? 1 : 0);
                    col2 += (average == 2 ? 1 : 0);
                    col3 += (average == 3 ? 1 : 0);
                    col4 += (average == 4 ? 1 : 0);
                    col5 += (average == 5 ? 1 : 0);

                    totalRespondent++;
                });
    
                html = `
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="tableSurveyReport">
                        <thead class="text-center">
                            <tr>
                                <th rowspan="2">Month</th>
                                <th colspan="5">Ratings 1 to 5</th>
                                <th rowspan="2">Other & Suggestions</th>
                                <th rowspan="2">Number of Respondent</th>
                            </tr>
                            <tr>
                                <th style="display: none;"></th>
                                <th>
                                    <div>1</div>
                                    <div>Not Satisfied</div>
                                </th>
                                <th>
                                    <div>2</div>
                                    <div>Fairly Satisfied</div>
                                </th>
                                <th>
                                    <div>3</div>
                                    <div>Moderately Satisfied</div>
                                </th>
                                <th>
                                    <div>4</div>
                                    <div>Highly Satisfied</div>
                                </th>
                                <th>
                                    <div>5</div>
                                    <div>Absolutely Satisfied</div>
                                </th>
                                <th style="display: none;"></th>
                                <th style="display: none;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td>${monthName.toUpperCase()}</td>
                                <td>${col1}</td>
                                <td>${col2}</td>
                                <td>${col3}</td>
                                <td>${col4}</td>
                                <td>${col5}</td>
                                <td></td>
                                <td>${totalRespondent}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>`;
            }

            return html;
        }
        // ----- END TABLE CONTENT -----


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
                                <select class="form-control validate filter"
                                    name="year">
                                    <option value='' selected>Select year</option>    
                                    <option value='2022'>2022</option>    
                                    <option value='2021'>2021</option>    
                                    <option value='2020'>2020</option>    
                                    <option value='2019'>2019</option>    
                                    <option value='2018'>2018</option>    
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label>Month</label>
                                <select class="form-control validate filter"
                                    name="month">
                                    <option value='' selected>Select month</option>    
                                    <option value='01'>January</option>   
                                    <option value='02'>February</option>   
                                    <option value='03'>March</option>   
                                    <option value='04'>April</option>   
                                    <option value='05'>May</option>   
                                    <option value='06'>June</option>   
                                    <option value='07'>July</option>   
                                    <option value='08'>August</option>   
                                    <option value='09'>September</option>   
                                    <option value='10'>October</option>   
                                    <option value='11'>November</option>   
                                    <option value='12'>December</option>   
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


        // ----- SELECT FILTER -----
        $(document).on('change', '.filter', function() {
            let year      = $(`[name="year"]`).val();
            let month     = $(`[name="month"]`).val();
            let monthName = $(`[name="month"] option:selected`).text().trim();

            if (year && month) {
                !document.getElementsByClassName("jumping-dots-loader").length && $("#tableContent").html(preloader);

                setTimeout(() => {
                    let html = tableContent(year, month, monthName);
                    $("#tableContent").html(html);
                    initDataTables();
                }, 100);
            }
        })
        // ----- END SELECT FILTER -----

    })

</script>
    