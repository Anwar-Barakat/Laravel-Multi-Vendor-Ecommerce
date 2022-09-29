$(document).ready(() => {
    $(".updateSectionStatus").click(function () {
        var status = $(this).attr("status");
        var section_id = $(this).attr("section_id");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-section-status",
            data: {
                status: status,
                section_id: section_id,
            },
            success: function (response) {
                if (response["status"] == 0) {
                    $("#section-" + response["section_id"]).attr(
                        "status",
                        `${response["status"]}`
                    );
                    $("#section-" + response["section_id"]).html(
                        '<i class="fas fa-power-off text-danger"></i> '
                    );
                    $("#status-" + response["section_id"])
                        .toggleClass("green")
                        .addClass("red");
                    $("#status-text" + response["section_id"])
                        .toggleClass("text-success")
                        .addClass("text-danger")
                        .html("Inactive");
                } else {
                    $("#section-" + response["section_id"]).attr(
                        "status",
                        `${response["status"]}`
                    );
                    $("#section-" + response["section_id"]).html(
                        '<i class="fas fa-power-off text-success"></i> '
                    );
                    $("#status-" + response["section_id"])
                        .toggleClass("red")
                        .addClass("green");
                    $("#status-text" + response["section_id"])
                        .toggleClass("text-danger")
                        .addClass("text-success")
                        .html("Active");
                }
            },
        });
    });
});
