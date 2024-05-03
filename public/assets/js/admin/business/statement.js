$(document).ready(function () {
    $.fn.dataTable.ext.errMode = 'none';
    var table = $('.statement-table').DataTable({
        searching: false,
        processing: true,
        "dom": 'rtip',
        serverSide: true,
        pageLength: 10,
        ajax: {
            url: statements,
            data: function (d) {
                d.search = $('.search-statement').val()
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

            { data: 'statement_skill_id', name: 'statement_skill_id' },
            { data: 'soft_skill_type', name: 'soft_skill_type' },
            { data: 'title', name: 'title' },
            { data: 'page_number', name: 'page_number' },
            { data: 'action', name: 'action', orderable: false, searchable: false },


        ]
    });
    $(".search-statement").keyup(function () {
        table.draw();
    });
    $(".add-btn-modal").on('click', function () {
        $("#id").val('');
        $("#title").val('');
        $("#title-error").html("");
        $("#category-error").html("");
        $("#page_number").val(null).trigger("change");
        $("#statement_skill_id").val(null).trigger("change");
        // $(".modalHeader").html('Add Statement');
        $(".save-btn").val('Save');
        $("#add-statement-modal").modal('show');
    });

    $("#statement-form").on("submit", function (e) {
        e.preventDefault();
        $('.save-btn').attr("disabled", true);
        var temp = 0;
        var title = $("#title").val();
        var statement_skill_id = $("#statement_skill_id").val();
        var page_number = $("#page_number").val();
        var statement_id = $("#id").val();

        if (title.trim() == "") {
            $("#title-error").html("Please Enter Title.");
            temp++;
        } else {
            $("#title-error").html("");
        }
        if (page_number.trim() == "") {
            $("#category-error").html("Please Enter Page Number.");
            temp++;
        } else {
            $("#category-error").html("");
        }

        if (statement_skill_id.trim() == "") {
            $("#statement-error").html("Please Enter Statement Skill.");
            temp++;
        } else {
            $("#statement-error").html("");
        }

        if (temp != 0) {
            $('.save-btn').attr("disabled", false);
            return false;
        }
        else {
            myButton.className = myButton.className + ' loading';
        }

        var formData = new FormData(this);
        if (statement_id == '') {
            var url = storeStatement;
        } else {
            var url = statements + "/" + statement_id;
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
                        $("#add-statement-modal").modal('hide');
                        myButton.className = myButton.className.replace(new RegExp('(?:^|\\s)loading(?!\\S)'), '');
                        table.draw();
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
    
    $("body").on("click", ".edit-statement", function () {
        var id = $(this).data('id');
        var title = $(this).data('title');
        var skill = $(this).data('skill');
        $("#id").val(id);
        $('#page_number').select2('val', [$(this).data('page')]);
        $('#statement_skill_id').select2('val', [$(this).data('statement')]);
        $("#title").val(title);
        $("input[type=radio][name=soft_skill_type][value=" + skill + "]").attr("checked", true);
        $("#title-error").html("");
        $("#category-error").html("");
        $("#statement-error").html("");
        $("#edit-close").html('Edit Statement');
        $(".save-btn").val('Update');
        $("#add-statement-modal").modal('show');
    })

    $("body").on("click", ".delete-statement", function () {
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
                    url: storeStatement + "/" + id,
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
    $('#page_number').select2({
        placeholder: "Select Page Number",
        allowClear: true
    });

    $('#statement_skill_id').select2({
        placeholder: "Select Statement Skill",
        allowClear: true
    });
});