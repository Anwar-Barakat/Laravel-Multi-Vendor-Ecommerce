$(document).on("click", ".updateCategoryStatus", function () {
    var status = $(this).attr("status");
    var category_id = $(this).attr("category_id");
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: "post",
        url: "/admin/update-category-status",
        data: {
            status: status,
            category_id: category_id,
        },
        success: function (response) {
            if (response["status"] == 0) {
                $("#category-" + response["category_id"]).attr(
                    "status",
                    `${response["status"]}`
                );
                $("#category-" + response["category_id"]).text("Inactive");
                $("#category-" + response["category_id"]).attr(
                    "style",
                    "color : #ee335e  !important"
                );
                $("#category-" + response["category_id"]).prepend(
                    '<i class="fas fa-power-off text-danger"></i> '
                );
                $("#status-" + response["category_id"])
                    .toggleClass("green")
                    .addClass("red");
                $("#status-text" + response["category_id"])
                    .toggleClass("text-success")
                    .addClass("text-danger")
                    .html("Inactive");
            } else {
                $("#category-" + response["category_id"]).attr(
                    "status",
                    `${response["status"]}`
                );
                $("#category-" + response["category_id"]).text("Active");
                $("#category-" + response["category_id"]).attr(
                    "style",
                    "color : #22c03c   !important"
                );
                $("#category-" + response["category_id"]).prepend(
                    '<i class="fas fa-power-off text-success"></i> '
                );
                $("#status-" + response["category_id"])
                    .toggleClass("red")
                    .addClass("green");
                $("#status-text" + response["category_id"])
                    .toggleClass("text-danger")
                    .addClass("text-success")
                    .html("Active");
            }
        },
    });
});
