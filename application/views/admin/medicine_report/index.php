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
        const MEDICINE_DATA = getTableData(`medicines`, ``,`is_deleted = '0'`);
        const CHECK_UP_DATA = getTableData(`check_up_medicines`,``,`is_deleted = 0`);

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
                    tableHeadRow +=` <th>${value.name}<br><smal>${value.brand}</small></th>`;
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
            let month = $(this).attr("month");
            let monthName = $(this).attr("monthName");
            window.open(`survey_report/print?year=${year}&month=${month}&monthName=${monthName}`, '_blank');
        })
        // ----- END BUTTON PRINT -----



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
    