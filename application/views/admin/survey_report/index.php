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
                    <div class="w-100 d-flex justify-content-between align-items-center">
                    <button class="btn btn-primary mb-2" id="btnPrint" year="${year}" month="${month}" monthName="${monthName}"><i class="fas fa-print"></i> Print</button>
                    <button class="btn btn-primary mb-2" id="btnView"><i class="fas fa-eye"></i> View</button>
                    </div>
                    <table class="table table-bordered table-hover">
                        <thead class="text-center">
                            <tr>
                                <th style="width:150px" colspan="8" class="text-center">Rating 1 to 5</th>
                            </tr>
                            <tr>
                                <th style="width:150px; ">Month</th>
                                <th style="width:150px ">1</th>
                                <th style="width:150px ">2</th>
                                <th style="width:150px ">3</th>
                                <th style="width:150px ">4</th>
                                <th style="width:150px ">5</th>
                                <th style="width:150px ">Other & Suggestion</th>
                                <th style="width:100px; ">Number of Respondent</th>
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


        // ----- BUTTON PRINT -----
        $(document).on("click", "#btnPrint", function() {
            let year  = $(this).attr("year");
            let month = $(this).attr("month");
            let monthName = $(this).attr("monthName");
            window.open(`survey_report/print?year=${year}&month=${month}&monthName=${monthName}`, '_blank');
        })
        // ----- END BUTTON PRINT -----
        

         // ----- BUTTON FEEDBACK -----
        $(document).on("click", "#feedbackBtn", function(){
            let grade = parseFloat($(this).attr("grade"));
            getFeedbackNotification(parseFloat(grade));
        });

          // ----- END BUTTON FEEDBACK -----

        $(document).on("click","#btnView",function(){
            let year         = $("#btnPrint").attr("year");
            let month        = $("#btnPrint").attr("month");
            let montName     = $("#btnPrint").attr("monthName");
            let SURVEY_DATA  = getTableData(`surveys LEFT JOIN patients USING(patient_id) LEFT JOIN patient_type ON patients.patient_type_id = patient_type.patient_type_id`,
                                            `surveys.*,patient_type.patient_type_id AS patient_type_id`,
                                            `surveys.status = 1 AND YEAR(surveys.created_at) = '${year}' AND MONTH(surveys.created_at) = '${month}'`);
            $("#modal .modal-dialog").removeClass("modal-md").addClass("modal-lg");
            $("#modal .page-title").text("VIEW DETAILS");
            $(".modal-header").addClass("text-center");
            $("#modal").modal("show");
            $("#modal_content").html(preloader);
            let tableBody   = "";
            let teachingRespondent = 0, studentRespondent = 0, nonTeachingRespondent = 0, stakeholderRespondent = 0; 
            let teachingSum = 0, studentSum = 0, nonTeachingSum = 0, stakeholderSum = 0; 

            let teachingData    = SURVEY_DATA.filter(obj => obj.patient_type_id == "1" || obj.patient_type_id == "5").map((obj, inde)=>{ teachingRespondent++});
            let studentData     = SURVEY_DATA.filter(obj => obj.patient_type_id == "2").map((obj, inde)=>{ studentRespondent++});
            let nonTeachingData = SURVEY_DATA.filter(obj => obj.patient_type_id == "3").map((obj, inde)=>{ nonTeachingRespondent++});
            let stakeholderData = SURVEY_DATA.filter(obj => obj.patient_type_id == "4").map((obj, inde)=>{ stakeholderRespondent++});
            let totalRespondent = teachingRespondent + studentRespondent + nonTeachingRespondent + stakeholderRespondent;
            let totalMean       = 0;
            tableBody +=    `
                             <tr>
                                <td class="text-left" colspan="2">No. of Respondent</td>
                                <td class="text-center">${studentRespondent}</td>
                                <td class="text-center">${teachingRespondent}</td>
                                <td class="text-center">${nonTeachingRespondent}</td>
                                <td class="text-center">${stakeholderRespondent}</td>
                                <td class="text-center">${totalRespondent}</td>
                             </tr>                
                                `;

            
            for (let index = 1; index <= 10; index++) {
                let teachingValue = 0, studentValue = 0, nonTeachingValue = 0, stakeholderValue = 0; 
                let rowDivider    = 0;
                SURVEY_DATA.map((obj)=>{ 
                    let colValue  = obj[`q${index}`] ? parseFloat(obj[`q${index}`]) : 0;  
                    switch (obj.patient_type_id) {
                        case "2":
                            studentValue     += parseFloat(colValue || 0); 
                            studentSum       += parseFloat(colValue || 0);
                            break;
                        case "3":
                            nonTeachingValue += parseFloat(colValue || 0); 
                            nonTeachingSum   += parseFloat(colValue || 0);
                            break;
                        case "4":
                            stakeholderValue += parseFloat(colValue || 0); 
                            stakeholderSum   += parseFloat(colValue || 0);
                            break;
                        default:
                            teachingValue    += parseFloat(colValue || 0); 
                            teachingSum      += parseFloat(colValue || 0);
                            break;
                    }     
                });
                
                let teachingColValue       = teachingValue / teachingRespondent || 0;
                let studentColValue        = studentValue / studentRespondent || 0;
                let nonTeachingColValue    = nonTeachingValue / nonTeachingRespondent || 0;
                let stakeholderColValue    = stakeholderValue / stakeholderRespondent || 0;
                let meanResult             = teachingColValue + studentColValue + nonTeachingColValue + stakeholderColValue;

                teachingColValue != "0" && rowDivider++; 
                studentColValue != "0" && rowDivider++; 
                nonTeachingColValue != "0" && rowDivider++; 
                stakeholderColValue != "0" && rowDivider++; 
                totalMean += meanResult/rowDivider;
                tableBody +=    `
                             <tr>
                                ${index == 1 ? ` <td rowspan="10" class="text-center">Item <br> Questionaire</td>` : ''}
                                <td class="text-center">${index}</td>
                                <td class="text-center">${studentColValue.toFixed(2)}</td>
                                <td class="text-center">${teachingColValue.toFixed(2)}</td>
                                <td class="text-center">${nonTeachingColValue.toFixed(2)}</td>
                                <td class="text-center">${stakeholderColValue.toFixed(2)}</td>
                                <td class="text-center">${(meanResult/rowDivider).toFixed(2)}</td>
                             </tr>                
                                `;
            }
            
            let teachingMean    = ((teachingSum/teachingRespondent) / 10) || 0; 
            let studentMean     = ((studentSum/studentRespondent)/ 10) || 0; 
            let nonTeachingMean = ((nonTeachingSum/nonTeachingRespondent) / 10) || 0;
            let stakeholderMean = ((stakeholderSum/stakeholderRespondent) / 10) || 0;
            let grandTotalMean  = totalMean / 10;
            tableBody += `  
                            <tr style="background-color:yellow;" class="text-black font-weight-bold">
                                <td class="text-left" colspan="2">Mean(Rater)</td>
                                <td class="text-center">${studentMean.toFixed(2)}</td>
                                <td class="text-center">${teachingMean.toFixed(2)}</td>
                                <td class="text-center">${nonTeachingMean.toFixed(2)}</td>
                                <td class="text-center">${stakeholderMean.toFixed(2)}</td>
                                <td class="text-center">${grandTotalMean.toFixed(2)}</td>
                                
                            </tr>
                         `;

            tableBody += `  
                            <tr>
                                <td class="text-left" colspan="2">No. of Respondent mean 3 and above</td>
                                <td class="text-center">${studentRespondent}</td>
                                <td class="text-center">${teachingRespondent}</td>
                                <td class="text-center">${nonTeachingRespondent}</td>
                                <td class="text-center">${stakeholderRespondent}</td>
                                <td class="text-center">${totalRespondent}</td>
                            </tr>
                         `;
            
            let teachingPercentage    =  ((teachingMean / 5) * 100)     || 0; 
            let studentPercentage     =  ((studentMean / 5) * 100)      || 0; 
            let nonTeachingPercentage =  ((nonTeachingMean / 5) * 100)  || 0;
            let stakeholderPercentage =  ((stakeholderMean / 5) * 100)  || 0;
            let grandTotalPercentage  =  ((grandTotalMean / 5) * 100)   || 0;
        
                         
            tableBody += `  
                            <tr>
                                <td class="text-left" colspan="2">No. of Respondent mean 3 and above</td>
                                <td class="text-center">${studentPercentage.toFixed(2)}%</td>
                                <td class="text-center">${teachingPercentage.toFixed(2)}%</td>
                                <td class="text-center">${nonTeachingPercentage.toFixed(2)}%</td>
                                <td class="text-center">${stakeholderPercentage.toFixed(2)}%</td>
                                <td class="text-center">${grandTotalPercentage.toFixed(2)}%</td>
                            </tr>
                         `;

            let html = `
                <div class="w-100 my-3">
                    <div class="text-center w-100 font-weight-bold"><h4>CUSTOMER SATISFACTION SURVEY REPORT</h4></div>
                    <div class="text-left w-100">Month and Year: <strong>${montName} of ${year}</strong></div>
                    <div class="text-left w-100">Campus :<strong>CBSUA-Sipocot / SCHOOL CLINIC</strong></div>
                </div>


                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="text-center">
                            <tr>
                                <th style="width:150px;" colspan="2">Type of Respondent</th>
                                <th style="width:150px ">Student</th>
                                <th style="width:150px ">Teaching Staff</th>
                                <th style="width:150px ">Non-Teaching</th>
                                <th style="width:150px ">External Stake Holder</th>
                                <th style="width:150px ">Mean(Item)</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${tableBody}

                            <tr>
                                <td colspan="7" class="text-center bg-primary text-white">Average Rating Legend</td>
                            </tr>
                            <tr>
                                <td colspan="7">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="w-25 border text-center"  style="${parseFloat(grandTotalMean) >= 4.20 && parseFloat(grandTotalMean) <= 5 &&     "background-color:yellow;text-color:black;" }"> 5 | <span>(4.20-5.00)-Excellent (E)</span> </div>
                                        <div class="w-25 border text-center"  style="${parseFloat(grandTotalMean) >= 3.40 && parseFloat(grandTotalMean) <= 4.19 &&  "background-color:yellow;text-color:black;" }"> 4 | <span>(3.40-4.19)-Very Satisfactory (VS)</span> </div>
                                        <div class="w-25 border text-center"  style="${parseFloat(grandTotalMean) >= 2.60 && parseFloat(grandTotalMean) <= 3.99 &&  "background-color:yellow;text-color:black;" }"> 3 | <span>(2.60-3.99)-Satisfactory (S)</span> </div>
                                        <div class="w-25 border text-center"  style="${parseFloat(grandTotalMean) >= 1.80 && parseFloat(grandTotalMean) <= 2.59 &&  "background-color:yellow;text-color:black;" }"> 2 | <span>(1.80-2.59-Fair (F)</span> </div>
                                        <div class="w-25 border text-center"  style="${parseFloat(grandTotalMean) >= 1.00 && parseFloat(grandTotalMean) <= 1.79 &&  "background-color:yellow;text-color:black;" }"> 1 | <span>(1.00-1.79)-Needs Improvement-(N)</span> </div>
                                    </div>
                                </td>
                            </tr>
                            <tr style="cursor:pointer;" id="feedbackBtn" grade="${parseFloat(grandTotalMean)}">
                                <td colspan="7" class="text-center bg-primary text-white font-weight-bold">Feedback</td>
                            </tr>
                            <tr>
                                <td colspan="7" class="text-center font-weight-bold">
                                    ${getFeedback(parseFloat(grandTotalMean))}
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            `;



            setTimeout(() => {
                $("#modal_content").html(html);
                getFeedbackNotification(parseFloat(grandTotalMean));
                
            }, 1500);

        });


        function getFeedbackNotification(value = 0 ){
            let grade     = parseFloat(value);
            let notifType = `warning`;
            let msg       = `No ratings yet!`;
            if(grade >= 4.20 && grade <= 5 ){
                msg = `We greatly Appreciate your service !`;
                notifType = `success`;
            }else if(grade >= 3.40 && grade <= 4.19 ){
                msg = `Keep  it up! Youre Doing a great job`;
                notifType = `success`;
            }else if(grade >= 2.60 && grade <= 3.99){
                msg = `Thank you for your hardwork. I know you are trying your best to improve your services`;
                notifType = `warning`;
            }else if(grade >= 1.80 && grade <= 2.59){
                msg = `You've got this! you can find more ways to improve your service next time. `;
                notifType = `danger2`;
            }else if(grade >= 1.00 && grade <= 1.79){
                msg = `You have a very low performance try to reflect on the services you've provided `;
                notifType = `danger2`;
            }

            showNotification(notifType, msg);
        }

        function getFeedback(value = 0 ){
            let msg = `No ratings yet!`;
            let grade = parseFloat(value);
            if(grade >= 4.20 && grade <= 5 ){
                return msg = `We greatly Appreciate your service !`;
            }else if(grade >= 3.40 && grade <= 4.19 ){
                return msg = `Keep  it up! Youre Doing a great job`;
            }else if(grade >= 2.60 && grade <= 3.99 ){
                return msg = `Thank you for your hardwork. I know you are trying your best to improve your services`;
            }else if(grade >= 1.80 && grade <= 2.59 ){
                return msg = `You've got this! you can find more ways to improve your service next time. `;
            }else if(grade >= 1.00 && grade <= 1.79 ){
                return msg = `You have a very low performance try to reflect on the services you've provided `;
            }

        }

        function surverRecommendation(question = false, rate = false,){
            let message    = "";
            // question = Questionaire Number (1-10);
            // rate     = 1|2|3|4|5
            if(question && rate){
                let percentage = (parseFloat(rate)/5) * 100;
                
                switch (question) {
                    case 1:
                            switch (rate) {
                                case 1:
                                        message = `<strong>Sorry!</strong> , You've got <strong>(${percentage}%)</strong>  you need to Smile, 
                                                    <br>if you're offering face-to-face customer service. <br> If you're on the phone, 
                                                        <br>sound engaged, friendly and eager to help in order to have a smooth conversation to your customer.`;

                                    break;
                                case 2:
                                        message = `You've got <strong>(${percentage}%)</strong> Smile, 
                                                    <br>if you're offering face-to-face customer service. 
                                                    <br>If you're on the phone, sound engaged, friendly and eager to help.`;
                                    break;
                                case 3:
                                        message = `Please make sure that your customers feel as valued as the first time they walked into your clinic`;
                                    break;
                                case 4:
                                        message = `You've got <strong>(${percentage}%)</strong> Continue to wear your <br>smile together with your appropriate dress. 
                                                    <br>Thank you for giving your best!`;
                                    break;
                                default:
                                    // 5
                                        message = `<strong>Congratulation!</strong> You've got <strong>(${percentage}%)</strong> thank you for always wearing your 
                                                        <br><strong>SMILE</strong> because smile can lessen their illness they feel. Continue being a happy one.`;
                                    break;
                            }
                        break;
                    case 2:
                            switch (rate) {
                                case 1:
                                        message = `<strong>Sorry!</strong> But You've got <strong>(${percentage}%)</strong> of ratings. 
                                                    <br>Take note that this is your home in 5 days of the week so please Help keep it clean.`;

                                    break;
                                case 2:
                                        message = `<strong>Sorry!</strong> but You've got <strong>(${percentage}%)</strong> of ratings. 
                                                    <br>Take note that this is your home in 5 days of the week so please Help keep it clean.`;
                                    break;
                                case 3:
                                        message = `You've got <strong>(${percentage}%)</strong> of ratings. 
                                                    <br>Take note that this is your home in 5 days of the week so please Help keep it clean.`;
                                    break;
                                case 4:
                                        message = `You've got <strong>(${percentage}%)</strong> of ratings. 
                                                    <br>Keep your workplace clean because a clean office can boost productivity. `;
                                    break;
                                default:
                                    // 5
                                        message = `<strong>Congratulation!</strong>! You've got <strong>(${percentage}%)</strong> Continue to Maintain the cleanliness of the clinic. 
                                                    <br>a clean place is a safe place '`;
                                    break;
                            }
                        break;
                    case 3:
                            switch (rate) {
                                case 1:
                                        message = `<strong>Sorry!</strong> You've got <strong>(${percentage}%)</strong> please make sure to follow your time schedule. 
                                                    <br>Hopefully next time you will have a high ratings.`;

                                    break;
                                case 2:
                                        message = `<strong>Sorry!</strong> You've got <strong>(${percentage}%)</strong> please make sure to follow your time schedule. 
                                                    <br>Hopefully next time you will have a high ratings.`;
                                    break;
                                case 3:
                                        message = `You've got <strong>(${percentage}%)</strong> please have time to your client <br> during your working hours. Thank you. `;
                                    break;
                                case 4:
                                        message = `You've got <strong>(${percentage}%)</strong> of ratings. 
                                                    <br>Thank you for  accommodating  with your client.`;
                                    break;
                                default:
                                    // 5
                                        message = `Thank you for always on time and spending time to your client even on your busy hours. 
                                                    <br>You've got <strong>(${percentage}%)</strong> of ratings. `;
                                    break;
                            }
                        break;
                    case 4:
                            switch (rate) {
                                case 1:
                                        message = `Sad to say but You've got <strong>(${percentage}%)</strong> , <br>find some ways to improve your sevices.`;

                                    break;
                                case 2:
                                        message = `Sad to say but You've got <strong>(${percentage}%)</strong> , <br>find some ways to improve your sevices.`;
                                    break;
                                case 3:
                                        message = `Hello You've got <strong>(${percentage}%)</strong> <br> please do some strategies to improve your services. Thank you!`;
                                    break;
                                case 4:
                                        message = `<strong>Good job!</strong> please continue to make way to <br> delivered an accurate services to your client.`;
                                    break;
                                default:
                                    // 5
                                        message = `CONGRATULATIONS for doing your best to deliver accurate service to your client <br> You've got a <strong>(${percentage}%)</strong> of ratings.`;
                                    break;
                            }
                        break;
                    case 5:
                            switch (rate) {
                                case 1:
                                        message = `<strong>Sorry!</strong> You've got <strong>(${percentage}%)</strong> <br> therefore you need to improved quick services. 'I know you can do.'`;
                                    break;
                                case 2:
                                        message = `Hello You've got <strong>(${percentage}%)</strong>, <br>Please , Improved the fast service to the clients.`;
                                    break;
                                case 3:
                                        message = `You got <strong>(${percentage}%)</strong>, <br>a little bit of hard work and improvement in service, to fully  `;
                                    break;
                                case 4:
                                        message = `You got <strong>(${percentage}%)</strong> <br>to finally complete, always serve best service to clients to feel that there are at the safe zone.`;
                                    break;
                                default:
                                    // 5
                                        message = `<strong>Congratulation!</strong> you reach/got<strong>(${percentage}%)</strong>, <br>continue the excellent and fast performance to maintain the good rating and feedback of clients.`;
                                    break;
                            }
                        break;
                    case 6:
                            switch (rate) {
                                case 1:
                                        message = `Sad to say You've got <strong>(${percentage}%)</strong>, 
                                                    <br>to improved handling some problem always be confident and think for many solution as can.`;
                                    break;
                                case 2:
                                        message = `You've got <strong>(${percentage}%)</strong>, 
                                                        <br>Please remain this 'the customer may not always be right, but they are always the customer.' 
                                                        <br>Always be responsible in every single of files.`;
                                    break;
                                case 3:
                                        message = `You got <strong>(${percentage}%)</strong>, a little bit, handled request, complaints and solution to problem with flexibility. 
                                                        <br>'Be thankful for customers who complain. You still have the opportunity to make them happy.'`;
                                    break;
                                case 4:
                                        message = `You got <strong>(${percentage}%)</strong> to finally complete, <br>A complaining customer can be you best opportunity to show how good you are and create a customer evangelist.`;
                                    break;
                                default:
                                    // 5
                                        message = `<strong>Congratulation!</strong> you reach/got<strong>(${percentage}%)</strong>, <br>continue the excellent, because customer complaints are the schoolbooks from which we learn.`;
                                    break;
                            }
                        break;
                    case 7:
                            switch (rate) {
                                case 1:
                                        message = `<strong>Sorry!</strong> You got <strong>(${percentage}%)</strong> , <br>always be aware in keeping files because trust is built with consistency.`;
                                    break;
                                case 2:
                                        message = `You've got <strong>(${percentage}%)</strong>, remind this quote be careful who you trust. 
                                                    <br>If someone will discuss others with you they will certainly discuss you with other`;
                                    break;
                                case 3:
                                        message = `You got <strong>(${percentage}%)</strong>, <br>a little bit of improvement in this matter will help to reach a good results.`;
                                    break;
                                case 4:
                                        message = `You got <strong>(${percentage}%)</strong> to finally complete, <br>you most it is start with self-trust is the first secret of success.`;
                                    break;
                                default:
                                    // 5
                                        message = `<strong>Congratulation!</strong> you reach/got <strong>(${percentage}%)</strong>, <br>continue the excellent, because confidentiality is the essence of being trusted.`;
                                    break;
                            }
                        break;
                    case 8:
                            switch (rate) {
                                case 1:
                                        message = `<strong>Sorry!</strong> You got <strong>(${percentage}%)</strong> , <br>must improve the courtesy to each patient/clients enter and gave`;
                                    break;
                                case 2:
                                        message = `You've got <strong>(${percentage}%)</strong>, <br>Please improved the performance in demonstrated courtesy and show competence , <br>patient because it is a avenue that reflect in one self.`;
                                    break;
                                case 3:
                                        message = `You've got a <strong>(${percentage}%)</strong>,from your clients , <br>a little bit of efficient because our most intimate friend <br>is not he to whom we show the worst, but the best of our nature.`;
                                    break;
                                case 4:
                                        message = `You've got <strong>(${percentage}%)</strong>, <br>to effectively perform that help you to improved, <br>like what said of 'George Washington' Be courteous to all, but intimate with few and let those <br>few well tried before you give them confidence.`;
                                    break;
                                default:
                                    // 5
                                        message = `<strong>Congratulation!</strong> you reach/got<strong>(${percentage}%)</strong>,<br> continue the excellent because we believed your personal brand is a promise to your clients/patient, <br>a promise of quality, consistency, competency and reliability.`;
                                    break;
                            }
                        break;
                    case 9:
                            switch (rate) {
                                case 1:
                                        message = `<strong>Sorry!</strong> You got <strong>(${percentage}%)</strong> , <br>please do some strategy like asking your patient in a gentle voice, 
                                                    <br>and action to feel them comfortable with you.`;
                                    break;
                                case 2:
                                        message = `You've got <strong>(${percentage}%)</strong>, <br>please do some strategy like asking your patient in a gentle voice, <br>and action to feel them comfortable.`;
                                    break;
                                case 3:
                                        message = `Hello, You've got a <strong>(${percentage}%)</strong>,<br>remember that always take goodcare to your client`;
                                    break;
                                case 4:
                                        message = `Hello, have a nice day a head You've got <strong>(${percentage}%)</strong> , <br>thank you for being a heart of healthcare to your patient .`;
                                    break;
                                default:
                                    // 5
                                        message = `Great Job! You've got a <strong>(${percentage}%)</strong> <br>thank you for taking care of your patient. <br>
                                        They may forget your name, but they will never forget how you made them feel.`;
                                    break;
                            }
                        break;
                
                    default:
                        // 10
                        switch (rate) {
                                case 1:
                                        message = `<strong>Sorry!</strong>, You've got <strong>(${percentage}%)</strong>  <br>you need to control your emotion if you are angry because it will affect to your client please be patient and  sound engaged, 
                                        <br>friendly and eager to help in order to have a smooth conversation to your customer.`;
                                    break;
                                case 2:
                                        message = `Please speak clearly, if you speak at all; carve every word before you let it fall.`;
                                    break;
                                case 3:
                                        message = `You've got a <strong>(${percentage}%)</strong> from your client , <br>sometimes when we are angry we speak brutal to our customer but you need to control and  be patience and speak appropriately `;
                                    break;
                                case 4:
                                        message = `Hello, have a nice day a head You've got <strong>(${percentage}%)</strong> <br>thank you for showing a good manner to your client. `;
                                    break;
                                default:
                                    // 5
                                        message = `Great Job! You've got a <strong>(${percentage}%)</strong> .<br>Thank you for being kind and respectful to your customer hoping that you will continue this kind of practices.`;
                                    break;
                            }
                        break;
                }
            }

            return message;
        }

        function questionaireList(number = false){
            let html = ``;
               if(number){
                    switch (number) {
                        case 1:
                            html = `1.	Served with a smile and dress appropriately `;
                            break;
                        case 2:
                            html = `2.	Observed clean, organized office with appropriate facilities and visible and clear information materials.`;
                            
                            break;
                        case 3:
                            html = `3.	Rendered on time service`;
                            
                            break;
                        case 4:
                            html = `4.	Delivered accurate service`;
                            
                            break;
                        case 5:
                            html = `5. Provide quick service.`;
                            
                            break;
                        case 6:
                            html = `6. Handled request, complaints and solution to problem with flexibility.`;
                            
                            break;
                        case 7:
                            html = `7. Observed trust and confidentiality.`;
                            
                            break;
                        case 8:
                            html = `8. Demanonstrated courtesy and competence.`;
                            
                            break;
                        case 9:
                            html = `9. Made the client feel important`;
                            
                            break;
                        default:
                            html = `10. Spoke clearly, used appropriate language. `;

                            break;
                    }
               }
            return html;

        }

    })

</script>
    