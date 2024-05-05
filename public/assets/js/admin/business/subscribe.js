$(document).ready(function () {
    $("#subscription-form").submit(function (event) {
        event.preventDefault();

        $.ajax({
            url: storeSubscribe,
            type: "POST",
            dataType: "json",
            data: $("#subscription-form").serializeArray(),
            success: function (response) {
                if (response.status == true) {
                    resetValidation("#plan_name");
                    resetValidation("#plan_description");

                    toastr.success(response.message, "", { timeOut: 2000 }); // Toastr success notification
                    setTimeout(() => {
                        window.location.href = Subscribe;
                    }, 3000);

                    // window.location.href = Subscribe;
                } else {
                    var errors = response.errors;
                    handleValidation("#plan_name", errors.plan_name);
                    handleValidation(
                        "#plan_description",
                        errors.plan_description
                    );
                    toastr.error("Error occurred while submitting the form"); // Toastr error notification
                }
            },
            error: function (xhr, status, error) {
                toastr.error("Error occurred while submitting the form"); // Add Toastr error notification
            },
        });
    });

    //Edit ajax logic
    $(document).on("click", ".edit-subscription", function () {
        var subscription_id = $(this).attr("data-id");

        // Show the modal
        $("#Update-subscription-modal").modal("show");

        // Send AJAX request to get subscription data
        $.ajax({
            url: "/admin/subscription-edit/" + subscription_id,
            type: "GET",
            dataType: "json",
            success: function (response) {
                // Populate form fields with retrieved data
                $("#subs_id").val(response.id);
                $("#get_plan_name").val(response.plan_name);
                $("#get_monthly_price").val(response.montly_price);
                $("#get_yearly_price").val(response.yearly_price);
                $("#get_plan_description").val(response.description);
            },
            error: function (xhr, status, error) {
                console.error(error);
                // Handle error, show error message, etc.
            },
        });
    });

    // Update subscription data on form submit
    $("#updateSubscription-form").submit(function (event) {
        event.preventDefault();
        // Send AJAX request to update subscription data
        $.ajax({
            url: "/admin/subscription-update",
            type: "PUT",
            dataTpe: "json",
            data: $("#updateSubscription-form").serializeArray(),
            success: function (response) {
                console.log(response);
                if (response.status == true) {
                    resetValidation("#get_plan_name");
                    resetValidation("#get_plan_description");

                    toastr.success(response.message, "", { timeOut: 2000 }); // Toastr success notification
                    setTimeout(() => {
                        window.location.href = Subscribe;
                    }, 3000);

                    // window.location.href = Subscribe;
                } else {
                    var errors = response.errors;
                    handleValidation("#get_plan_name", errors.get_plan_name);
                    handleValidation(
                        "#get_plan_description",
                        errors.get_plan_description
                    );
                }
            },
        });
    });

    function resetValidation(elementId) {
        $(elementId)
            .removeClass("is-invalid")
            .siblings("p")
            .removeClass("invalid-feedback")
            .html("");
    }

    function handleValidation(elementId, error) {
        $(elementId)
            .toggleClass("is-invalid", !!error)
            .siblings("p")
            .toggleClass("invalid-feedback", !!error)
            .html(error);
    }


    // for changing the status
    $("body").on("change", ".subscription-status", function () {
        var id = $(this).data("id");
        var status = $(this).prop("checked") ? 0 : 1;
        var formData = new FormData();
        formData.append("id", id);
        formData.append("status", status);

        // Send an AJAX request to update the status in the database
        $.ajax({
            type: "POST",
            url: updateStatus,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.status) {
                    var message =
                        status == 0
                            ? "Plan blocked successfully"
                            : "Plan unblocked successfully";
                    toastr.success(message);
                } else {
                    toastr.error(message);
                }
            },
            error: function (data) {
                toastr.error(data.responseJSON.message);
            },
        });
    });
});

// Delete Ajax logic old
// Check if there is any toastr message stored in session storage
$(document).ready(function () {
    var toastrMessage = sessionStorage.getItem("toastrMessage");
    if (toastrMessage) {
        toastr.success(toastrMessage);
        // Clear the stored toastr message
        sessionStorage.removeItem("toastrMessage");
    }
});
function deleteSubscription(subscriptionId) {
    swal({
        text: "Are you sure you want to delete?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        closeOnClickOutside: false,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: subscribeDelete,
                type: "post",
                data: {
                    subscriptionId: subscriptionId,
                },
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        var message = response.message;
                        toastr.success(message);
                        // Store the toastr message in session storage
                        sessionStorage.setItem("toastrMessage", message);
                        // Refresh the page
                        location.reload();
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function (response) {
                    toastr.error(response.responseJSON.message);
                },
            });
        }
    });
}
