let BASE_URL   = $('body').attr("base_url");
let PATIENT_ID = $('body').attr("sessionid") ?? 0, LAST_ID = 0;
let IS_WEBSITE = $('body').attr("website") == "true";


// ----- RENDER MESSAGE -----
function renderMessage(data = [], msg = false, index = 0, isWebsite = false) {
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

    if (isWebsite) {
        if (is_admin == 0) {
            html += `
            <div class="sender" ${isLast}>
                <div class="message" title="${moment(created_at).format("MMMM DD, YYYY")}">
                    <div>${message}</div>
                    <small>${moment(created_at).format("hh:mm A")}</small>
                </div>
                <img src="${BASE_URL}assets/uploads/profile/default.jpg" class="rounded-circle profile" height="50" width="50" alt="profile">
            </div>`;
        } else {
            html += `
            <div class="receiver" ${isLast}>
                <img src="${BASE_URL}assets/images/modules/clinic-logo.png" class="rounded-circle profile" height="50" width="50" alt="profile">
                <div class="message" title="${moment(created_at).format("MMMM DD, YYYY")}">
                    <div>${message}</div>
                    <small>${moment(created_at).format("hh:mm A")}</small>
                </div>
            </div>`;
        }
    } else {
        if (is_admin == 1) {
            html += `
            <div class="sender" ${isLast}>
                <div class="message" title="${moment(created_at).format("MMMM DD, YYYY")}">
                    <div>${message}</div>
                    <small>${moment(created_at).format("hh:mm A")}</small>
                </div>
                <img src="${BASE_URL}assets/images/modules/clinic-logo.png" class="rounded-circle profile" height="50" width="50" alt="profile">
            </div>`;
        } else {
            html += `
            <div class="receiver" ${isLast}>
                <img src="${BASE_URL}assets/uploads/profile/default.jpg" class="rounded-circle profile" height="50" width="50" alt="profile">
                <div class="message" title="${moment(created_at).format("MMMM DD, YYYY")}">
                    <div>${message}</div>
                    <small>${moment(created_at).format("hh:mm A")}</small>
                </div>
            </div>`;
        }
    }


    return html;
}
// ----- END RENDER MESSAGE -----


// ----- LOAD CONVERSATION -----
function loadConverstation(isWebsite = false) {
    let html = '';
    let data = getTableData(
        `messages 
        WHERE patient_id=${PATIENT_ID}
        ORDER BY created_at`);
    data.map((m, i) => {
        html += renderMessage(data, m, i, isWebsite);
    })
    return html;
}
// ----- END LOAD CONVERSATION -----


// ----- REFRESH CONVERSATION -----
function refreshConversation(isWebsite = false, isAsync = false) {
    let html = '';
    if (PATIENT_ID && PATIENT_ID != 0) {
        let data = isAsync ? 
            getTableData(
                `messages
                WHERE patient_id=${PATIENT_ID}
                    AND message_id > ${LAST_ID}
                ORDER BY message_id DESC`
            ) : 
            getTableData2(
                `messages
                WHERE patient_id=${PATIENT_ID}
                    AND message_id > ${LAST_ID}
                ORDER BY message_id DESC`
            );
        data.map((m, i) => {
            html += renderMessage(data, m, i, isWebsite);
        })
    }
    $("#messageContent").append(html);
    location.href = "#last";
}
// ----- END REFRESH CONVERSATION -----


// ----- SEND MESSAGE -----
function sendMessage(isWebsite = false) {
    IS_WEBSITE = isWebsite;
    let message = $(`[name="message"]`).val()?.trim();
    let isAdmin = isWebsite ? 0 : 1;

    $.ajax({
        method: "POST",
        url: BASE_URL+"admin/messages/sendMessage",
        data: { isAdmin, patientID: PATIENT_ID, message },
        dataType: "json",
        async: true,
        success: function(data) {
            $("#last").removeAttr("id");
            refreshConversation(isWebsite);
            $(`[name="message"]`).attr("added", "true").val("");
        }
    })
}
// ----- END SEND MESSAGE -----


// ----- GET DATABASE TABLE DATA -----
function getTableData2(
	tableName = null,
	columnName = "",
	searchFilter = "",
	orderBy = "",
	groupBy = "",
	others = ""
) {
	let path = `${base_url}system_operations/getTableData`;
	let data = {
		tableName,
		columnName,
		searchFilter,
		orderBy,
		groupBy,
		others,
	};
	let result = [];
	if (tableName) {
		$.ajax({
			method: "POST",
			url: path,
			data,
			async: true,
			dataType: "json",
			success: function (data) {
				if (data) {
					data.map((item) => {
						result.push(item);
					});
				}
			},
			error: function (err) {
				showNotification(
					"danger",
					"System error: Please contact the system administrator for assistance!"
				);
			},
		});
	}
	return result;
};
// ----- END GET DATABASE TABLE DATA -----


$(document).ready(function() {
    

    // ----- SEND MESSAGE -----
    $(document).on("keyup", `[name="message"]`, function(e) {
        let key = e.which;
        let isWebsite = $(this).attr("website") == "true";
        if (key == 13) { // ENTER
            sendMessage(isWebsite)
        }
    })

    $(document).on("click", "#btnSend", function() {
        let isWebsite = $(this).attr("website") == "true";
        sendMessage(isWebsite);
    })
    // ----- END SEND MESSAGE -----


    // ----- MESSAGE ICON WEBSITE -----
    $(document).on("click", ".message-icon, .hide-message", function() {
        $("#messageDisplay").toggle(500, function() {
            if(document.getElementById("messageDisplay").style.display == "block") {
                $("#messageContent").html(`<div class="text-center">Please wait...</div>`);

                setTimeout(() => {
                    let html = loadConverstation(true);
                    $("#messageContent").html(html);
                    $(`[name="message"]`).focus();
                    location.href = "#last";
                }, 100);
            }
        });
        
    })
    // ----- END MESSAGE ICON WEBSITE -----


    $(document).on("mouseover", "#messageDisplay", function() {
        $(this).attr("focus", "true");
    })

    $(document).on("mouseout", "#messageDisplay", function() {
        $(this).attr("focus", "false");
    })

    let messageInterval = setInterval(() => {
        checkInterval();
        if (!$(`[name="message"]`).is(':focus') && $("#messageDisplay").attr("focus") == "false" || $(`[name="message"]`).attr('added') == 'true') {
            refreshConversation(IS_WEBSITE, true);
            $(`[name="message"]`).removeAttr("added");
        }
    }, 1000);

    function checkInterval() {
        if (!$("#messageDisplay").text().trim().length && !$("#patientConversation").text().trim().length) {
            clearInterval(messageInterval);
        }
    }

    if ($("#messageDisplay").text().trim().length || $("#patientConversation").text().trim().length) {
        checkInterval()
    }

    if (IS_WEBSITE && $("#messageDisplay").text().trim().length) {
        setInterval(() => {
            let getUnreadMessages = getTableData(
                `messages
                WHERE is_read = 0 
                    AND is_admin = 1 
                    AND patient_id = ${PATIENT_ID} 
                    AND is_deleted = 0`,
                `COUNT(*) AS count`
            );
            getUnreadMessages.map(i => {
                let { count = 0 } = i;
                $("#messageCount").text(count);
            })
        }, 1000);
    }
    

})