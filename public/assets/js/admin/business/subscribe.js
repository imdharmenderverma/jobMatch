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
                    resetValidation("#plan_type");
                    resetValidation("#plan_price");
                    resetValidation("#plan_description");

                    window.location.href = Subscribe;
                    // console.log("form sumbited subscription");
                } else {
                    var errors = response.errors;
                    handleValidation("#plan_name", errors.plan_name);
                    handleValidation("#plan_type", errors.plan_type);
                    handleValidation("#plan_price", errors.plan_price);
                    handleValidation(
                        "#plan_description",
                        errors.plan_description
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
});

//Edit ajax logic
$(document).on("click", ".edit-subscription", function () {
    var subscription_id = $(this).attr("data-id");
    // alert(subscription_id);
});

// Delete Ajax logic old
// function deleteSubscription(subscriptionId) {
//     swal({
//         text: "Are you sure you want to delete?",
//         icon: "warning",
//         buttons: true,
//         dangerMode: true,
//         closeOnClickOutside: false,
//     }).then((willDelete) => {
//         if (willDelete) {
//             $.ajax({
//                 url: subscribeDelete,
//                 type: "post",
//                 data: {
//                     subscriptionId: subscriptionId,
//                 },
//                 dataType: "json",
//                 success: function (response) {
//                     if (response.success) {
//                         toastr.success(response.message);
//                         // window.location.href = Subscribe;
//                         table.draw();
//                     } else {
//                         toastr.error(response.message);
//                     }
//                 },
//                 error: function (response) {
//                     toastr.error(response.responseJSON.message);
//                 },
//             });
//         }
//     });
// }


// Check if there is any toastr message stored in session storage
$(document).ready(function() {
    var toastrMessage = sessionStorage.getItem('toastrMessage');
    if (toastrMessage) {
        toastr.success(toastrMessage);
        // Clear the stored toastr message
        sessionStorage.removeItem('toastrMessage');
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
                        sessionStorage.setItem('toastrMessage', message);
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

