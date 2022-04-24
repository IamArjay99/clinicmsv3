<div class="content-wrapper">

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">Medicine Report</h4>
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
        const MEDICINE_DATA = getTableData(`medicines`, ``,`is_deleted = '0'`);
        const CHECK_UP_DATA = getTableData(`check_up_medicines`,``,`is_deleted = 0`);
        let MONTH = "", MEDICINE = "", MEDICINEQTY = 0;
        // ----- DATATABLES -----
        function initDataTables() {
            

        }
        // ----- END DATATABLES -----


        // ----- TABLE CONTENT -----
        function tableContent(year = '') {

            let html = `
            <div class="w-100 py-5 text-center">
                <img src="${base_url}assets/images/modal/select.svg"
                    width="200" height="200" alt="Select year and month">
                <h4 class="mt-3">Please select year and month</h4>
            </div>`;

            if (year) {
                let col1 = 0, col2 = 0, col3 = 0, col4 = 0, col5 = 0, totalRespondent = 0;
                let tableHeadRow = "";
                
                MEDICINE_DATA.map((value,index)=>{
                    tableHeadRow +=` <th class="bg-primary text-white">${value.name}<br><smal>${value.brand}</small></th>`;
                });

                let tbodyHTML       = '';
                let monthArr        = ["January","February","March","April","May","June","July","August","September","October","November","December"];
                let footerArr       = [];

                monthArr.map((value,index)=>{
                    let totalConsume    = 0;
                    let totalFooter     = 0;
                    let indexValue      = parseFloat(index) + 1;
                    let colData         = ``;
                    MEDICINE_DATA.map(item=>{
                        let sumData     = 0;
                        let footerTotal = 0;
                        CHECK_UP_DATA.filter(x => x.medicine_id == item.medicine_id && moment(x.created_at).format("YYYY") == year  && moment(x.created_at).format("MMMM") == value).map( x =>{
                            sumData += parseFloat(x.quantity);
                        });
                        
                        if(sumData > MEDICINEQTY){
                            MONTH = value, MEDICINE = item.name;
                        }

                        totalConsume += parseFloat(sumData);
                        colData += `<td class="text-center">${sumData}</td>`;

                    });


                    tbodyHTML += `
                                    <tr>
                                        <td>${value}</td>
                                        ${colData}
                                        <td>${totalConsume}</td>
                                    </tr>
                                 `;
                
                });
                MEDICINE_DATA.map(i => {
                    // ----- FOOTER -----
                    let MEDICINE_ID = i.medicine_id;
                    let TOTAL_CONSUME = CHECK_UP_DATA.filter(x => x.medicine_id == MEDICINE_ID && moment(x.created_at).format("YYYY") == year).map(x => parseFloat(x.quantity)).reduce((a,b) => a+b, 0);
                    footerArr.push(TOTAL_CONSUME);
                    // ----- END FOOTER -----
                })
                let totalFooter = 0;
                footerArr.map(x=>{
                    totalFooter += parseFloat(x);
                });
                html = `
                <div class="table-responsive">
                    <button class="btn btn-primary mb-2" id="btnPrint" year="${year}"><i class="fas fa-print"></i> Print</button>
                    <table class="table table-bordered table-hover">
                        <thead class="text-center">
                            <tr>
                                <th style="width:150px;" rowspan="2">Month</th>
                                <th style="width:150px" colspan="${MEDICINE_DATA.length}">Monthly Medicine Report</th>
                                <th style="width:100px;" rowspan="2">Total Consume</th>
                            </tr>
                            <tr>
                                ${tableHeadRow}
                            </tr>
                        </thead>
                        <tbody>
                            ${tbodyHTML}
                            <tr>
                                <td>Total</td>
                               ${footerArr.map(x=>{return `<td class="text-center">${x}</td>`}).join("")}
                                <td class="text-center">${totalFooter}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>`;


                setTimeout(() => {
                    medicineOfTheMonth();
                }, 500);
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

            if (year) {
                !document.getElementsByClassName("jumping-dots-loader").length && $("#tableContent").html(preloader);

                setTimeout(() => {
                    let html = tableContent(year);
                    $("#tableContent").html(html);
                    initDataTables();
                }, 100);
            }
        })
        // ----- END SELECT FILTER -----


        // ----- BUTTON PRINT -----
        $(document).on("click", "#btnPrint", function() {
            let year  = $(this).attr("year");
            window.open(`medicine_report/print?year=${year}`, '_blank');
        })
        // ----- END BUTTON PRINT -----

        function medicineOfTheMonth(){
            alert(`It is good to stock or purchase medicine during ${MONTH} due to reason that there is more patient badly needed medicine so that you must stock ${MEDICINE} . 

Thank You ! this is only a few reminder.
`);
        }

    })

</script>
    