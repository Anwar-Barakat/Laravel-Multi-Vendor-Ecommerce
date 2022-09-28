$(document).on("click", ".updateAdminStatus", function () {
    var status = $(this).attr("status");
    var admin_id = $(this).attr("admin_id");
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: "post",
        url: "/admin/update-admin-status",
        data: {
            status: status,
            admin_id: admin_id,
        },
        success: function (response) {
            if (response["status"] == 0) {
                $("#admin-" + response["admin_id"]).attr(
                    "status",
                    `${response["status"]}`
                );
                $("#admin-" + response["admin_id"]).text("Inactive");
                $("#admin-" + response["admin_id"]).attr(
                    "style",
                    "color : #ee335e  !important"
                );
                $("#admin-" + response["admin_id"]).prepend(
                    '<i class="fas fa-power-off text-danger"></i> '
                );
            } else {
                $("#admin-" + response["admin_id"]).attr(
                    "status",
                    `${response["status"]}`
                );
                $("#admin-" + response["admin_id"]).text("Active");
                $("#admin-" + response["admin_id"]).attr(
                    "style",
                    "color : #22c03c   !important"
                );
                $("#admin-" + response["admin_id"]).prepend(
                    '<i class="fas fa-power-off text-success"></i> '
                );
            }
        },
    });
});
