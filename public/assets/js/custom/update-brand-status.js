$(document).ready(() => {
    $(".updateBrandStatus").click(function () {
        var status = $(this).attr("status");
        var brand_id = $(this).attr("brand_id");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-brand-status",
            data: {
                status: status,
                brand_id: brand_id,
            },
            success: function (response) {
                if (response["status"] == 0) {
                    $("#brand-" + response["brand_id"]).attr(
                        "status",
                        `${response["status"]}`
                    );
                    $("#brand-" + response["brand_id"]).html(
                        '<i class="fas fa-power-off text-danger"></i> '
                    );
                    $("#status-" + response["brand_id"])
                        .toggleClass("green")
                        .addClass("red");
                    $("#status-text" + response["brand_id"])
                        .toggleClass("text-success")
                        .addClass("text-danger")
                        .html("Inactive");
                } else {
                    $("#brand-" + response["brand_id"]).attr(
                        "status",
                        `${response["status"]}`
                    );
                    $("#brand-" + response["brand_id"]).html(
                        '<i class="fas fa-power-off text-success"></i> '
                    );
                    $("#status-" + response["brand_id"])
                        .toggleClass("red")
                        .addClass("green");
                    $("#status-text" + response["brand_id"])
                        .toggleClass("text-danger")
                        .addClass("text-success")
                        .html("Active");
                }
            },
        });
    });
});
