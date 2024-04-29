$(document).ready(function () {
    var table = $('.industry-table').DataTable({
        searching: false,
        processing: true,
        "dom": 'rtip',
        serverSide: true,
        pageLength: 10,
        ajax: {
            url: industries,
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

        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'parent_title', name: 'parent_title' },
            { data: 'title', name: 'title' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });

    $(".search-industry").keyup(function () {
        table.draw();
    });

    $(".add-btn-modal").on('click', function () {
        $("#id").val('');
        $("#title").val('');
        $("#parent_id").val(null).trigger("change");
        // $(".modalHeader").html('Add Industry');
        $(".save-btn").val('Save');
        $("#add-industry-modal").modal('show');
    });

    $("#skill-form").on("submit", function (e) {
        e.preventDefault();
        $('.save-btn').attr("disabled", true);
        var temp = 0;
        var title = $("#title").val();
        var id = $("#id").val();

        if (title.trim() == "") {
            $("#title-error").html("Please Enter Title.");
            temp++;
        } else {
            $("#title-error").html("");
        }

        if (temp != 0) {
            $('.save-btn').attr("disabled", false);
            return false;
        }
        else {
            myButton.className = myButton.className + ' loading';

        }

        var formData = new FormData(this);
        if (id == '') {
            var url = storeIndustry;
        } else {
            var url = industries + "/" + id;
            formData.append('_method', 'PUT');
        }
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $('.save-btn').attr("disabled", false);
                if (data.success) {
                    toastr.success(data.message, "", { timeOut: 3000 });
                    setTimeout(() => {

                        $("#add-industry-modal").modal('hide');
                        location.reload();

                    }, 5000);
                } else {
                    toastr.error(data.message);
                }
            },
            error: function (data) {
                toastr.error(data.responseJSON.message);
                $('.save-btn').attr("disabled", false);
            }
        });
    });

    $('#parent_id').select2({
        placeholder: "Select Parent Industry",
        allowClear: true
    });

    $("body").on("click", ".edit-industry", function () {
        $("#id").val($(this).data('id'));
        $("#title").val($(this).data('title'));
        $('#parent_id').select2('val', [$(this).data('parent')]);
        $('#edit-close').html('Edit Industry');
        $(".save-btn").val('Update');
        $("#title-error").html("");
        $("#add-industry-modal").modal('show');
    })

    $("body").on("click", ".delete-industry", function () {
        var id = $(this).data("id");
        var formData = new FormData();
        formData.append('user_id', id);
        swal({
            text: "Are you sure you want to delete record?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            closeOnClickOutside: false,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: storeIndustry + "/" + id,
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
                    },
                    error: function (data) {
                        toastr.error(data.responseJSON.message);
                    },
                });
            }
        });
    });
})