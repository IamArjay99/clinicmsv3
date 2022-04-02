<style>

    .profile {
        border: 1px solid #9e9e9e;
    }

    .patient {
        transition: 500ms;
    }

    #patientConversation {
        height: 40vh;
    }

    .message-content {
        height: 40vh;
        border: 1px solid #e3e7ed;
        overflow-y: auto;
        margin-bottom:20px;
        position: relative;
        padding: 10px;
        /* display: flex;
        flex-direction: column;
        justify-content: end; */
    }

    .message-content .sender {
        display: flex;
        justify-content: end;
        align-items: center;
    }

    .message-content .receiver {
        display: flex;
        justify-content: start;
        align-items: center;
    }

    .message-content small {
        float: right;
    }

    .message-content .sender .message {
        margin: 5px 0;
        background: lightblue;
        font-size: 1rem;
        padding: 5px 7px;
        margin-right: 8px;
        border-radius: 5px 5px 0 5px;
        max-width: 80%;
        width: auto;
    }

    .message-content .receiver .message {
        margin: 5px 0;
        background: #8bc34a61;
        font-size: 1rem;
        padding: 5px 7px;
        margin-left: 8px;
        border-radius: 5px 5px 5px 0;
        max-width: 80%;
        width: auto;
    }

    .message-content .sender img, .message-content .receiver img {
        align-self: end;
    }

    .patient.active {
        background: #58d8a3 !important;
    }

    .patient.unread {
        background: blanchedalmond;
    }

</style>

<div class="content-wrapper">

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">Messages</h4>
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


<script src="<?= base_url('assets/js/messages.js') ?>"></script>


<script>

    $(document).ready(function() {

        // ----- GLOBAL VARIABLE -----
        let LAST_ID = 0; PATIENT_ID = 0;

        let patientList = getTableData(
            `patients AS p 
                LEFT JOIN patient_type AS pt USING(patient_type_id)
            WHERE p.is_deleted = 0`,
            `patient_id, CONCAT(firstname, ' ', lastname) AS fullname, pt.name AS occupationType`
        );
        // ----- END GLOBAL VARIABLE -----


        // ----- DATATABLES -----
        function initDataTables() {
            if ($.fn.DataTable.isDataTable("#tablePatient")) {
                $("#tablePatient").DataTable().destroy();
            }
            
            var table = $("#tablePatient")
                .css({ "min-width": "100%" })
                .removeAttr("width")
                .DataTable({
                    proccessing:    false,
                    serverSide:     false,
                    scrollX: true,
                    scrollY: 400,
                    sorting: [],
                    scrollCollapse: true,
                    paging: false,
                    sorting: false,
                    columnDefs: [
                        { targets: 0, width: '100%'  },
                    ],
                });

            $(`[type="search"]`).closest('.row').find(`.col-md-6`).first().remove()
        }
        // ----- END DATATABLES -----


        // ----- PATIENT LIST -----
        function getPatientList() {
            let html = '';
            patientList.map(p => {
                let { patient_id, fullname, occupationType } = p;

                html += `
                <tr patientID="${patient_id}" fullname="${fullname}" class="patient" style="cursor: pointer;">
                    <td>
                        <div class="d-flex justify-content-start align-items-center py-1">
                            <img src="<?= base_url('assets/uploads/profile/default.jpg') ?>" class="profile" height="50" width="50" alt="profile">
                            <div class="ml-2">
                                <h5 class="mb-0">${fullname}</h5>
                                <small>${occupationType}</small>
                            </div>
                        </div>
                    </td>
                </tr>`;
            })
            return html;
        }
        // ----- END PATIENT LIST -----


        // ----- PATIENT CONVERSATION -----
        function getPatientConversation(patientID = 0, fullname = '') {
            let html = '';

            html += `
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">${fullname}</h4>
                </div>
                <div class="card-body my-1 py-0 px-1">
                    <div class="message-content mb-1" id="messageContent">
                        ${loadConverstation()}
                    </div>

                    <div class="form-group mb-0">
                        <div class="input-group">
                            <textarea class="form-control"
                                placeholder="Type a message..."
                                rows="3"
                                name="message"
                                style="resize: none; font-size: 1rem;"></textarea>
                            <div class="input-group-append">
                                <button class="btn btn-primary"
                                    id="btnSend"><i class="fas fa-paper-plane"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;
            return html;
        }
        // ----- END PATIENT CONVERSATION -----


        // ----- PAGE CONTENT -----
        function pageContent() {
            !document.getElementsByClassName("jumping-dots-loader").length && $("#pageContent").html(preloader);

            let html = `
            <div class="row" id="messageDisplay">
                <div class="col-md-3 col-sm-12">
                    <table class="table table-bordered table-hover" id="tablePatient">
                        <thead>
                            <tr>
                                <th>Patients</th>
                            </tr>
                        </thead>
                        <tbody id="tableTbody">
                            ${getPatientList()}
                        </tbody>
                    </table>
                </div>
                <div class="col-md-9 col-sm-12" id="patientConversation">
                    <div class="w-100 d-flex justfify-content-center align-items-center flex-column py-5">
                        <img src="<?= base_url('assets/images/modal/select.svg') ?>" height="200" width="200" alt="Select">
                        <h3 class="mt-3">Please select patient</h3>
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


        // ----- CLICK PATIENT -----
        $(document).on("click", ".patient", function() {
            $("tr.patient").removeClass("active");
            $(this).addClass("active");

            let patientID = $(this).attr("patientID");
            let fullname  = $(this).attr("fullname");

            PATIENT_ID = patientID;

            $("#patientConversation").html(preloader);
            setTimeout(() => {
                let html = getPatientConversation(patientID, fullname);
                $("#patientConversation").html(html);
                location.href = "#last";
            }, 100);

        })
        // ----- END CLICK PATIENT -----

    })

</script>
    