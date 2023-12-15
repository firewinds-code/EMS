$(document).ready(function () {

    var start = moment().subtract(29, "days");
    var end = moment();

    function cb(start, end) {
        $("#DateFrom_To").html(
            start.format("YYYY-MM-DD") + " - " + end.format("YYYY-MM-DD")
        );
    }

    $("#DateFrom_To").daterangepicker(
        {
            startDate: start,
            endDate: end,
            ranges: {
                Today: [moment(), moment()],
                Yesterday: [
                    moment().subtract(1, "days"),
                    moment().subtract(1, "days"),
                ],
                "Last 7 Days": [moment().subtract(6, "days"), moment()],
                "Last 30 Days": [moment().subtract(29, "days"), moment()],
                "This Month": [
                    moment().startOf("month"),
                    moment().endOf("month"),
                ],
                "Last Month": [
                    moment().subtract(1, "month").startOf("month"),
                    moment().subtract(1, "month").endOf("month"),
                ],
            },
            locale: {
                // format: "DD-MM-YYYY" // Set the desired format for the display
                format: "YYYY-MM-DD", // Set the desired format for the display
            },
        },
        cb
    );

    cb(start, end);



    $("#confirmLogout").click(function () {
        document.forms["logOutForm"].submit(); // Submit the logout form
    });

    // For Active Route (Show)
    var isActiveSubMenu = $(".menu-sub-accordion .menu-link.active").length > 0;
    if (isActiveSubMenu) {
        $(".menu-item.menu-accordion").addClass("show");
    }

    /* For Validation  Change Password*/
    $("#changePassForm").on("submit", function (event) {
        event.preventDefault();
        let isValid = true;

        var password = $("#passwordInput").val();
        var confirmPassword = $("#passwordInput2").val();
        var passwordFeedback = $("#passwordFeedback");
        var confirmPasswordFeedback = $("#confirmPasswordFeedback");
        var passwordField = $("#passwordInput");
        var confirmPasswordField = $("#passwordInput2");
        var passwordPattern =
            /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

        if (!passwordPattern.test(password)) {
            isValid = false;
            event.preventDefault();
            passwordFeedback.show();
            passwordField.addClass("is-invalid");
        } else {
            passwordFeedback.hide();
            passwordField.removeClass("is-invalid");
        }

        if (password !== confirmPassword) {
            isValid = false;
            event.preventDefault();
            confirmPasswordFeedback.show();
            confirmPasswordField.addClass("is-invalid");
        } else {
            confirmPasswordFeedback.hide();
            confirmPasswordField.removeClass("is-invalid");
        }
        if (isValid) {
            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: $("#changePassForm").serialize(),
                success: function (response) {
                    $("#closeModalBtn").trigger("click");
                    toastr.success(`${response.message}`);
                    $("#changePassForm")[0].reset();
                },
                error: function (error) {
                    $("#closeModalBtn").trigger("click");
                    toastr.error(`${error.responseJSON.message}`);
                    $("#changePassForm")[0].reset();
                    console.error("Form submission error:", error);
                },
            });
        }
    });

    // For Security Modal
    $("#changeSecForm").submit(function (event) {
        event.preventDefault();
        var valid = true;
        var qns = $("#Qns").val();
        if (!qns) {
            $("#QnsFeedback").text("Question is Required.").show();
            $("#Qns").addClass("is-invalid");
            valid = false;
        } else {
            $("#QnsFeedback").hide();
            $("#Qns").removeClass("is-invalid");
        }

        // Check and show validation messages for Answer
        var ans = $("#ans").val();
        if (!ans) {
            $("#ansFeedback").text("Answer is Required.").show();
            $("#ans").addClass("is-invalid");
            valid = false;
        } else {
            $("#ansFeedback").hide();
            $("#ans").removeClass("is-invalid");
        }

        if (valid) {
            var formData = $("#changeSecForm").serialize();
            formData += "&type=update";
            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: formData,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                success: function (response) {
                    $("#closeModalBtn2").trigger("click");
                    toastr.success(response.message, "Success", {
                        toastClass: "toast-success",
                    });
                },
                error: function (error) {
                    $("#closeModalBtn2").trigger("click");
                    toastr.error(error.responseJSON.message, "Error", {
                        toastClass: "toast-error",
                    });
                    console.error("Form submission error:", error);
                },
            });
        }
    });
    //For Show Security Data
    $("#SecurityButton").click(function () {
        $.ajax({
            type: "POST",
            url: "changeSec",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                $("#Qns").val(response.secData.secques);
                $("#ans").val(response.secData.secans);
            },
            error: function (error) {
                $("#closeModalBtn").trigger("click");
                toastr.error(`${error.responseJSON.message}`);
            },
        });
    });

    //  For Login Modal


});
