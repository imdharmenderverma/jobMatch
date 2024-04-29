$(document).ready(function() {
    $("#form-reset").parsley();
    $("#form-reset").on("submit", function(event) {
        event.preventDefault();
        $("#submit").attr("disabled", true);
        if ($("#form-reset").parsley().isValid()) {
            $.ajax({
                url: resetURL,
                method: "POST",
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $("#submit").val("Submitting...");
                },
                success: function(data) {
                    if (data.success) {
                        $("#form-reset")[0].reset();
                        $("#form-reset").parsley().reset();
                        $("#submit").val("Submit");
                        toastr.success(data.message,"",{timeOut: 10000});
                        $("#submit").attr("disabled", false);
                        setTimeout(() => {
                            window.location.href = loginURL;
                        }, 10000);
                    } else {
                        toastr.error(data.message);
                        $("#submit").attr("disabled", false);
                    }
                },
                error: function(response) {
                    $("#submit").attr("disabled", false);
                    toastr.error(response.responseJSON.message,"",{timeOut: 10000});
                },
            });
        } else {
            $("#submit").attr("disabled", false);
            return false;
        }
    });
});