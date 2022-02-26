<link rel="stylesheet" href="<?= base_url('assets/css/custom-general.css') ?>">

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
        background: #58d8a3;
    }

</style>

<main>

    <div class="slider-area hero-bg-color hero-height2">
        <div class="slider-active">
            <div class="single-slider">
                <div class="slider-cap-wrapper">
                    <div class="hero-caption hero-caption2">
                        <h2 data-animation="fadeInUp" data-delay=".2s">Messages</h2>

                        <div class="hero-shape2">
                            <img src="<?=base_url()?>assets/website/assets/img/hero/tooth2.png" alt="">
                        </div>
                    </div>
                    <div class="hero-img hero-img2 position-relative">
                        <center><img src="<?=base_url()?>assets/website/assets/img/hero/h1_hero1.png" alt="" data-animation="pulse" data-transition-duration="5s"></center>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-header">
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

</main>


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


        // ----- RENDER MESSAGE -----
        function renderMessage(data = [], msg = false, index = 0) {
            let html = '';

            let {
                message_id,
                is_admin,
                patient_id,
                message,
                created_at
            } = msg;

            let isLast = '';
            if (index == data.length-1) {
                LAST_ID = message_id;
                isLast = "id='last'";
            }

            if (is_admin == 1) {
                html += `
                <div class="sender" ${isLast}>
                    <div class="message" title="${moment(created_at).format("MMMM DD, YYYY")}">
                        <div>${message}</div>
                        <small>${moment(created_at).format("hh:mm A")}</small>
                    </div>
                    <img src="<?= base_url('assets/images/modules/clinic-logo.png') ?>" class="rounded-circle profile" height="50" width="50" alt="profile">
                </div>`;
            } else {
                html += `
                <div class="receiver" ${isLast}>
                    <img src="<?= base_url('assets/uploads/profile/default.jpg') ?>" class="rounded-circle profile" height="50" width="50" alt="profile">
                    <div class="message" title="${moment(created_at).format("MMMM DD, YYYY")}">
                        <div>${message}</div>
                        <small>${moment(created_at).format("hh:mm A")}</small>
                    </div>
                </div>`;
            }

            return html;
        }
        // ----- END RENDER MESSAGE -----


        // ----- REFRESH CONVERSATION -----
        function refreshConversation() {
            let html = '';
            if (PATIENT_ID) {
                let data = getTableData(
                    `messages
                    WHERE patient_id=${PATIENT_ID}
                        AND message_id > ${LAST_ID}
                    ORDER BY created_at`
                );
                data.map((m, i) => {
                    html += renderMessage(data, m, i);
                })
            }
            $("#messageContent").append(html);
            location.href = "#last";
        }
        // ----- END REFRESH CONVERSATION -----


        // ----- LOAD CONVERSATION -----
        function loadConverstation() {
            let html = '';
            if (PATIENT_ID) {
                let data = getTableData(
                    `messages 
                    WHERE patient_id=${PATIENT_ID}
                    ORDER BY created_at`);
                data.map((m, i) => {
                    html += renderMessage(data, m, i);
                })
            }
            return html;
        }
        // ----- END LOAD CONVERSATION -----


        // ----- PATIENT CONVERSATION -----
        function getPatientConversation(patientID = 0, fullname = '') {
            let html = '';

            html += `
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">${fullname}</h4>
                </div>
                <div class="card-body">
                    <div class="message-content" id="messageContent">
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
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Patients</th>
                            </tr>
                        </thead>
                        <tbody>
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
            }, 100);
        }
        pageContent();
        // ----- END PAGE CONTENT -----


        // ----- SEND MESSAGE -----
        function sendMessage() {
            let message = $(`[name="message"]`).val()?.trim();
            $.ajax({
                method: "POST",
                url: "messages/sendMessage",
                data: { isAdmin: 1, patientID: PATIENT_ID, message },
                dataType: "json",
                async: true,
                success: function(data) {
                    $("#last").removeAttr("id");
                    refreshConversation();
                    $(`[name="message"]`).val("").focus();
                }
            })
        }

        $(document).on("keyup", `[name="message"]`, function(e) {
            let key = e.which;
            if (key == 13) { // ENTER
                sendMessage()
            }
        })

        $(document).on("click", "#btnSend", function() {
            sendMessage();
        })
        // ----- END SEND MESSAGE -----


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