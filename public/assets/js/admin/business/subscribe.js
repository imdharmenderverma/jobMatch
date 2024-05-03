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

// Delete Ajax logic
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
                        toastr.success(response.message);
                        // window.location.href = Subscribe;
                        table.draw();
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

// $("body").on("click", ".delete-subscription", function () {
//     var id = $(this).data("id");
//     var formData = new FormData();
//     formData.append('user_id', id);
//     swal({
//         text: "Are you sure you want to delete record?",
//         icon: "warning",
//         buttons: true,
//         dangerMode: true,
//         closeOnClickOutside: false,
//     }).then((willDelete) => {
//         if (willDelete) {
//             $.ajax({
//                 url: subscribeDelete + "/" + id,
//                 type: "DELETE",
//                 data: formData,
//                 cache: false,
//                 contentType: false,
//                 processData: false,
//                 success: function (data) {
//                     if (data.success) {
//                         toastr.success(data.message);
//                         table.draw();
//                     } else {
//                         toastr.error(data.message);
//                     }
//                 },
//                 error: function (data) {
//                     toastr.error(data.responseJSON.message);
//                 },
//             });
//         }
//     });
// });
