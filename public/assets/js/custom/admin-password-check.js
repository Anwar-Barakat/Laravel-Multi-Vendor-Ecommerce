$(function () {
    $("#old_password").keyup(function () {
        var old_password = $(this).val();
        $.ajax({
            type: "post",
            url: "/admin/check-password",
            data: { old_password: old_password },
            dataType: "json",
            success: function (response) {
                console.log(response);
                if (response == false) {
                    $("#old_password")
                        .addClass("is-invalid")
                        .removeClass("is-valid");
                    $("#password_checked")
                        .removeClass("text-success")
                        .addClass("text-danger mb-1")
                        .html("Password Not Valid !!");
                    console.log("false");
                } else if (response == true) {
                    $("#old_password")
                        .addClass("is-valid")
                        .removeClass("is-invalid");
                    $("#password_checked")
                        .removeClass("text-danger")
                        .addClass("text-success mb-1")
                        .html("Password Valid");
                }
            },
        });
    });
});
