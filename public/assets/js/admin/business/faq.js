// $(document).on('click', '.user_data', function () {
//     var userId = $(this).attr("data-id");
//     $.ajax({
//         url: userFaq,
//         type: "get",
//         data: {
//             user_id: userId,
//         },
//         success: function (response) {
//             if (response) {
//                 $('#name').val(response.userData.name);
//                 $('#email').val(response.userData.email);
//                 $('#date').val(response.userData.date);
//                 $('#answer').val(response.userData.message);
//             }
//         },
//     });
// });

$(document).ready(function () {
    var table = $('.industry-table').DataTable({
        searching: false,
        processing: true,
        "dom": 'rtip',
        serverSide: true,
        pageLength: 10,
        ajax: {
            url: faq,
            data: function (d) {
                d.search = $('.search-industry').val()
            }
        },
        drawCallback: function () {
            var pagination = $(this)
                .closest(".dataTables_wrapper")
                .find(".dataTables_paginate");
            pagination.toggle(
                this.api().page.info().recordsTotal >
                this.api().page.info().length
            );
            var paginationNumber = $(this)
                .closest(".dataTables_wrapper")
                .find(".dataTables_info");
            paginationNumber.toggle(
                this.api().page.info().recordsTotal >
                this.api().page.info().length
            );
        },
        language: { // Customize the language options
            emptyTable: "No data available",
            // Add other language customizations here if needed
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'question', name: 'question' },
            { data: 'answer', name: 'answer' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });

    $(".search-industry").keyup(function () {
        table.draw();
    });

    $(".add-btn-modal").on('click', function () {
        $("#id").val('');
        $("#question").val('');
        $("#answer").val('');
        $(".save-btn").val('Save');
        $("#question-error").html("");
        $("#answer-error").html("");
        $("#add-faq-modal").modal('show');
    });


    $(document).ready(function () {

        $('#pills-home-tab').on('click', function () {
            $('#faq_type').val('1');
            $("#question").val("");
            $("#answer").val("");
            $("#question-error").html("");
            $("#answer-error").html("");
        });

        $('#pills-profile-tab').on('click', function () {
            $('#faq_type').val('2');
            $("#question").val("");
            $("#question-error").html("");
            $("#answer").val("");
            $("#answer-error").html("");
        });

        $('#data-form').on('submit', function (e) {
            e.preventDefault();
            var temp = 0;
            var question = $("#question").val();
            var answer = $("#answer").val();

            if (question.trim() == "") {
                $("#question-error").html("Please enter question.");
                temp++;
            } else {
                $("#question-error").html("");
            }

            if (answer.trim() == "") {
                $("#answer-error").html("Please enter answer.");
                temp++;
            } else {
                $("#answer-error").html("");
            }

            if (temp != 0) {
                return false;
            }
            else {
                myButton.className = myButton.className + ' loading';
                let formData = new FormData(this);
                var url = storeFaq;
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        $('.save-btn').attr("disabled", false);
                        if (data.success) {
                            toastr.success(data.message, "", { timeOut: 3000 });
                            setTimeout(() => {
                                table.draw();
                                myButton.className = myButton.className.replace(new RegExp('(?:^|\\s)loading(?!\\S)'), '');
                                $("#add-faq-modal").modal('hide');
                                $("#question").val("");
                                $("#answer").val("");
                                location.reload();
                            }, 5000);
                        } else {
                            myButton.className = myButton.className.replace(new RegExp('(?:^|\\s)loading(?!\\S)'), '');

                            toastr.error(data.message);
                        }
                    },
                    error: function (data) {
                        toastr.error(data.responseJSON.message);
                        $('.save-btn').attr("disabled", false);
                    }
                });
            }
        });
    });

    $("body").on("click", ".delete-faq-btn", function () {
        var id = $(this).attr("data-id");
        var formData = new FormData();
        formData.append('user_id', id);
        swal({
            text: "Are you sure you want to delete this FAQ?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            closeOnClickOutside: false,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: storeFaq + "/" + id,
                    type: "DELETE",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        if (data.success) {
                            toastr.success(data.message);
                            table.draw();
                        } else {
                            toastr.error(data.message);
                        }
                        location.reload();
                    },
                    error: function (data) {
                        toastr.error(data.responseJSON.message);
                    },
                });

            }
        });
    });

});
