$(document).ready(function () {
    var i = $(".main-row").length + 1;
    $(document).on("click", ".addQes", function () {
        $(".question-div").append(
            '<div class="col-md-8 row' +
            i +
            ' main-row new-main-row" data-id="' +
            i +
            '"> <input type="text" class="form-control questionBox job-question" id="question-1-' +
            i +
            '" name="question_1[]" placeholder="Question:"><span class="text-danger" id="question-1-' +
            i +
            '-error"></span></div> <div class="col-md-4 addQesWrapper row' +
            i +
            ' new-main-row"> <div class="removeQes" data-id="' +
            i +
            '">-</div> </div>'
        );
        i++;
    });

    $(".onlyNumber").on("keypress keyup blur", function (event) {
        $(this).val($(this).val().replace(/[^\d].+/, ""));
        if ((event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });

    $(document).on("click", ".removeQes", function () {
        var button_id = $(this).data("id");
        $(".row" + button_id + "").remove();
    });

    let sortBy = 1;
    var table = $(".job-table").DataTable({
        searching: false,
        processing: true,
        dom: "rtip",
        serverSide: true,
        pageLength: 10,
        ajax: {
            url: jobs,
            data: function (d) {
                d.search = $(".search-job").val();
                d.location = $("#job_location").val();
                d.sort_by = sortBy;
            },
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
        language: {
            emptyTable: "No data available",
        },

        columns: [

            // { data: "role_name", name: "role_name" },
            { data: "company_name", name: "company_name" },
            { data: "location", name: "location" },
            { data: "type_of_work_name", name: "type_of_work_name" },
            { data: "applicant", name: "applicant" },
            { data: "match", name: "match" },
            { data: "created_at", name: "created_at" },
            {
                data: "status",
                name: "status",
                orderable: false,
                searchable: false,
            },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
            { data: "view", name: "view", orderable: false, searchable: false },
        ],
    });


    $(".search-job").keyup(function () {
        table.draw();
    });

    $("body").on("change", ".cus-op-left", function () {
        table.draw();
    });


    $(document).on("click", "#pills-tab", function () {
        $(this)
            .find("li")
            .each(function () {
                var liElement = $(this).find("a");
                if (liElement.hasClass("show")) {
                    sortBy = liElement.data("id");
                }
            });
        table.draw();
    });

    // start date
    $('#start_date').datepicker({
        startDate: new Date(),
        format: 'yyyy-mm-dd',
        autoclose: true

    });

    $('#end_date').datepicker({
        startDate: new Date(),
        format: 'yyyy-mm-dd',
        autoclose: true

    });
    $('#start_date').on("change", function () {
        var startVal = $('#start_date').val();
        $('#end_date').data('datepicker').setStartDate(startVal);
    });
    $('#end_date').on("change", function () {
        var endVal = $('#end_date').val();
        $('#start_date').data('datepicker').setEndDate(endVal);
    });

    //end date

    $(".add-btn-modal").on("click", function () {
        hideError();
        blankFields();
        $(".modal-header-title").html("Role Name:");
        $(".modal-header-compnytitle").html("Company Name:");
        $(".postJobBtn").val("Post Job");
        $("#addNewJob").modal("show");
    });

    $("#job-form").on("submit", function (e) {

        e.preventDefault();
        hideError();

        $(".save-btn").attr("disabled", true);
        var temp = 0;
        var job_id = $("#id").val();
        var role_name = $("#role_name").val();
        var company_name = $("#company_name").val();
        var location = $("#location").val();
        var location = $("#location").val();
        var address_state = $(".address_state").val();
        var start_date = $("#start_date").val();
        var type_of_work = $("#type_of_work").val();
        var experience = $("#experience").val();

        var industry = $("#industry").val();
        var end_date = $("#end_date").val();
        var description = $("#description").val();
        var requirement = $("#requirement").val();
        var salary_range = $("#salary_range").val();
        var skill_id = $("#skill_id").val();
        var latitude = $("#latitude").val();
        var longitude = $("#longitude").val();


        if (role_name.trim() == "") {
            $("#role-name-error").html("Please enter role name");
            temp++;
        }

        if (company_name.trim() == "") {
            $("#company-name-error").html("Please enter company name");
            temp++;
        }

        if (experience == "") {
            $("#experience-error").html("Please enter experience");
            temp++;
        }
        if (experience != "") {
            if (experience < 0 || experience > 99) {
                $("#experience-error").html("Please enter experience between 0 to 99");
                temp++;
            }
        }

        if (location.trim() == "") {
            $("#location-error").html("Please enter location");
            temp++;
        }

        if (start_date == "") {
            $("#start-date-error").html("Please select start sate");
            temp++;
        }

        if (description.trim() == "") {
            $("#description-error").html("Please enter job description");
            temp++;
        }


        if (requirement.trim() == "") {
            $("#requirement-error").html("Please enter requirements");
            temp++;
        }

        if (end_date == "") {
            $("#end-date-error").html("Please select  closing date");
            temp++;
        }


        if (type_of_work == "") {
            $("#type-of-work-error").html("Please select type of work");
            temp++;
        }

        if (industry == null) {
            $("#industry-error").html("Please select industry");
            temp++;
        }
        var checkNumeric = /^[0-9]$/;
        if (salary_range == "") {
            $("#salary-range-error").html("Please enter salary range");
            temp++;
        }

        if (skill_id == "") {
            $("#skill-id-error").html("Please select skills");
            temp++;
        }

        if (temp != 0) {
            $(".save-btn").attr("disabled", false);
            return false;
        }
        else {
            myButton.className = myButton.className + ' loading';
        }
        var formData = new FormData(this);
        if (job_id == "") {
            var url = storeJob;
        } else {
            var url = jobs + "/" + job_id;
            formData.append("_method", "PUT");
        }

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $(".save-btn").attr("disabled", false);
                if (data.success) {
                    toastr.success(data.message, "", { timeOut: 3000 });
                    myButton.className = myButton.className.replace(new RegExp('(?:^|\\s)loading(?!\\S)'), '');
                    setTimeout(() => {
                        $("#addNewJob").modal("hide");
                        $("#jobDetails").modal("hide");
                        window.location.href = window.location.href;
                    }, 3000);
                } else {
                    toastr.error(data.message);
                }
            },
            error: function (data) {
                myButton.className = myButton.className.replace(new RegExp('(?:^|\\s)loading(?!\\S)'), '');
                toastr.error(data.responseJSON.message, "", { timeOut: 3000 });
                $(".save-btn").attr("disabled", false);
            },
        });
    });

    $("body").on("click", ".edit-job", function () {
        hideError();
        blankFields();
        var id = $(this).data("id");
        $.get(jobs + "/" + id + "/edit", function (data) {
            var finalData = data.data;
            $(".modal-header-title").html("Edit Job");
            $("#addNewJob").modal("show");
            $(".postJobBtn").val("Edit Job");
            $("#id").val(finalData.id);
            $("#title").val(finalData.title);
            $("#role_name").val(finalData.role_name);
            $("#company_name").val(finalData.company_name);
            $("#location").val(finalData.location);
            $("#start_date").val(finalData.start_date);
            $("#type_of_work").val(finalData.type_of_work);
            $("#experience").val(finalData.experience);

            $("#industry")
                .val(finalData.industry)
                .select2({
                    placeholder: "Select Industry",
                    dropdownParent: $("#addNewJob"),
                    allowClear: true,
                });
            $("#end_date").val(finalData.end_date);
            $("#description").val(finalData.description);
            $("#requirement").val(finalData.requirement);
            $("#salary_range").val(finalData.salary_range);
            $("#latitude").val(finalData.latitude);
            $("#longitude").val(finalData.longitude);
            $("#skill_id").append(finalData.skills);
            $("#job-img, #image-error").addClass("d-none");
            $(".image-show").attr("src", finalData.image_url);
            if (finalData.job_question.length > 0) {
                var html = "";
                var i = 1;
                $(".question-div > div").remove();
                finalData.job_question.forEach((data) => {
                    var action =
                        i == 1
                            ? '<div class="addQes">+</div>'
                            : '<div class="removeQes" data-id="' +
                            i +
                            '">-</div>';
                    var newMain = i == 1 ? "" : "new-main-row";
                    html +=
                        '<div class="col-md-8 row' +
                        i +
                        " main-row " +
                        newMain +
                        ' " data-id="' +
                        i +
                        '"> <input type="text" class="form-control questionBox job-question" value="' +
                        data.question_1 +
                        '" id="question-1-' +
                        i +
                        '" name="question_1[]" placeholder="Question:"><span class="text-danger" id="question-1-' +
                        i +
                        '-error"></span> </div> <div class="col-md-4 addQesWrapper row' +
                        i +
                        " " +
                        newMain +
                        '"> ' +
                        action +
                        " </div>";
                    i++;
                });
                $(".question-div").append(html);
            }
        });
    });

    $("body").on("click", ".delete-job", function () {
        var id = $(this).data("id");
        swal({
            title: `Are you sure you want to delete this job?`,
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $("#jobDetails").modal("hide");
                $.ajax({
                    type: "DELETE",
                    url: storeJob + "/" + id,
                    success: function (data) {
                        toastr.success(data.message);
                        table.draw();
                    },
                    error: function (data) {
                        toastr.error(data.responseJSON.message);
                    },
                });
            }
        });
    });

    $("#applicantDetails")
        .on("show.bs.modal", function (e) {
            $("body").css("overflow", "hidden");
            $(this).css("overflow-y", "auto");
        })
        .on("hide.bs.modal", function (e) {
            hideUserData();
            $("#jobDetails").modal("show").css("overflow-y", "auto");
            $("body").css("overflow", "scroll");
        });

    $("#jobDetails").on("hide.bs.modal", function (e) {
        hideViewData();
    });

    $("body").on("change", ".job-status", function () {
        var id = $(this).data("id");
        var status = $(this).data("val");
        var formData = new FormData();
        formData.append("id", id);
        formData.append("status", status == 1 ? 0 : 1);
        $.ajax({
            type: "POST",
            url: updateJob,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.success) {
                    toastr.success(data.message, "", { timeOut: 3000 });
                    setTimeout(() => {
                        window.location.href = window.location.href;
                    }, 3000);

                } else {
                    toastr.error(data.message);
                }
            },
            error: function (data) {
                toastr.error(data.responseJSON.message);
            },
        });
    });

    $("#job-fulfill").on("submit", function (e) {
        myButton2.className = myButton2.className + ' loading';
        e.preventDefault();
        var status = $("input[name='fulfill_status']:checked").val();
        var job_id = $("#job_full_id").val();
        if (status && job_id != "") {
            var formData = new FormData();
            formData.append("job_id", job_id);
            formData.append("status", status);
            formData.append("step", 1);
            $.ajax({
                type: "POST",
                url: saveJobFulfill,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data.success) {
                        $(".completePopup > div").remove();
                        $("#job-completed-1").modal("hide");
                        if (status == 1) {
                            myButton2.className = myButton2.className.replace(new RegExp('(?:^|\\s)loading(?!\\S)'), '');
                            var html = "";
                            data.data.forEach((d) => {
                                html +=
                                    '<div class="termsCheckWrapper"> <div class="col-auto"> <label class="colorinput d-flex justify-content-start align-items-center"> <input name="app_user_id[]" type="checkbox" value="' +
                                    d.id +
                                    '" class="colorinput-input app_user_id"> <span class="colorinput-color bg-primary"></span> <span class="ml-3 text-white font-opensans"><img src="' +
                                    d.profile_photo_path +
                                    '" class="popupCompleteImg">' +
                                    d.name +
                                    "</a></span> </label> </div> </div>";
                            });
                            $(".completePopup").append(html);
                            $("#job-completed-2").modal("show");
                        } else {
                            myButton2.className = myButton2.className.replace(new RegExp('(?:^|\\s)loading(?!\\S)'), '');
                            toastr.success(data.message);
                            window.location.href = window.location.href;
                        }
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

    $("#job-award").on("submit", function (e) {
        e.preventDefault();
        myButton3.className = myButton3.className + ' loading';
        var job_id = $("#job_full_id").val();
        if (job_id != "") {
            var formData = new FormData(this);
            formData.append("job_id", job_id);
            formData.append("status", 1);
            formData.append("step", 2);
            $.ajax({
                type: "POST",
                url: saveJobFulfill,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data.success) {
                        toastr.success(data.message);
                        myButton3.className = myButton3.className.replace(new RegExp('(?:^|\\s)loading(?!\\S)'), '');

                        window.location.href = window.location.href;
                    } else {
                        myButton3.className = myButton3.className.replace(new RegExp('(?:^|\\s)loading(?!\\S)'), '');
                        toastr.error(data.message);
                    }
                },
                error: function (data) {
                    toastr.error(data.responseJSON.message);
                },
            });
        }
    });

    $("body").on("change", ".job-completed", function () {
        var id = $(this).data("id");
        $("#job_full_id").val(id);
        $("#job-completed-1").modal("show");
    });

    $("body").on("click", ".viewJobs", function () {
        var id = $(this).data("id");
        hideViewData();
        $.get(jobs + "/" + id + "/edit", function (data) {
            var finalData = data.data;
            var roleName = "";
            if (finalData.role_name != null) {
                var roleName = finalData.role_name.toUpperCase();
            }
            $("#job_title_view").html(roleName);
            $("#job_work_view").html(finalData.type_of_work_text);
            $("#location_view").html(finalData.location);
            let statusCheck =
                finalData.status == 1 || finalData.status == 2 ? "checked" : "";
            $("#status_view").html(
                '<label class="switch"><input class="job-status" ' +
                statusCheck +
                ' type="checkbox" data-id="' +
                finalData.id +
                '" data-val="' +
                finalData.status +
                '"><span class="slider round"></span></label>'
            );
            $(".edit-job-view")
                .attr("data-id", finalData.id)
                .attr("data-title", finalData.title);
            $(".delete-job-view").attr("data-id", finalData.id);
            $("#start_date_format").html(
                "Start Date: " + finalData.start_date_format
            );
            $("#post_date_format").html(
                "Posted: " + finalData.post_date_format
            );
            $("#end_date_format").html(
                "Closing Date: " + finalData.end_date_format
            );
            $("#description-view").html(finalData.description);
            $("#requirement-view").html("<li>" + finalData.requirement + "</li>");
            var questions = "";
            finalData.job_question.forEach((data) => {
                questions +=
                    "<li>" +
                    data.question_1 +
                    "</li>";
            });
            $("#question-view").append(questions);
            $(".availableApplicants").html(
                finalData.apply_user_count + " Applicants"
            );
            var apply_users = "";
            finalData.apply_user.forEach((data) => {
                apply_users +=
                    '<div class="col-md-6"> <div class="row"> <div class="col-md-3"> <img src="' +
                    data.profile_photo_path +
                    '" class="userImg user-candid-img"> </div> <div class="col-md-7"> <div class="applicantTitle">' +
                    data.first_name +
                    " " +
                    data.last_name +
                    '</div> <div class="applicantViewDetails" data-app="1" data-jid="' +
                    finalData.id +
                    '" data-id="' +
                    data.id +
                    '">View Profile</div> <div class="applicantViewResume" data-id="' +
                    data.id +
                    '">View Resume</div> </div> <div class="col-md-2"> <img src="' +
                    data.percentage +
                    '" class="percentage"> </div> </div> </div>';
            });
            if (apply_users == "") {
                apply_users += '<div class="col-md-6">No Applicants</div>';
            }
            $(".availableCandidates").append(apply_users);
            var match_users = "";
            finalData.match_user.forEach((data) => {
                match_users +=
                    '<div class="col-md-6"> <div class="row"> <div class="col-md-3"> <img src="' +
                    data.profile_photo_path +
                    '" class="userImg user-candid-img"> </div> <div class="col-md-7"> <div class="applicantTitle">' +
                    data.first_name +
                    " " +
                    data.last_name +
                    '</div> <div class="applicantViewDetails" data-app="0" data-id="' +
                    data.id +
                    '" data-jid="' +
                    finalData.id +
                    '">View Profile</div> <div class="applicantViewResume viewResumeData" data-job="' +
                    finalData.id +
                    '" data-app="' +
                    data.id +
                    '">View Resume</div> </div> <div class="col-md-2"> <img src="' +
                    data.percentage +
                    '" class="percentage"> </div> </div> </div>';
            });
            if (match_users == "") {
                match_users +=
                    '<div class="col-md-6">No Suitable Candidates</div>';
            }
            $(".suitableCandidates").append(match_users);
            $("#jobDetails").modal("show");
        });
    });

    $("body").on("click", ".applicantViewDetails", function () {
        hideUserData();
        var id = $(this).data("id");
        var jobId = $(this).data("jid");
        var app = $(this).data("app");

        $.get(
            appUsers + "/" + id + "," + jobId + "," + app + "/edit",
            function (data) {
                var finalData = data.data;
                var user = finalData.app_user;
                var job = finalData.job;
                $(".userDetailImg").attr("src", user.profile_photo_path);
                $(".user-name").html(user.first_name + " " + user.last_name);
                $(".user-location").html(user.location_range);
                $(".user-email").html(user.email);
                if (app == 1) {
                    $(".action-button").html(
                        '<span class="viewResumeBtn accept-job" data-app="' +
                        user.id +
                        '" data-job="' +
                        job.id +
                        '" data-value="1">Accept</span><span class="viewResumeBtn accept-job" data-app="' +
                        user.id +
                        '" data-job="' +
                        job.id +
                        '" data-value="2">Reject</span>'
                    );
                }
                $(".view-user-details").html(
                    '<div class="viewDetailsHeader"> <span class="viewResumeBtn viewResumeData" data-app="' +
                    user.id +
                    '" data-job="' +
                    job.id +
                    '">View Resume</span> <span class="viewResumeBtn viewCoverLetterData" data-app="' +
                    user.id +
                    '" data-job="' +
                    job.id +
                    '">View Cover Letter</span> </div> <div class="viewDetailsHeader"> <span class="viewResumeBtn disabledBtn viewResume viewVideoData" data-app="' +
                    user.id +
                    '" -datajob="' +
                    job.id +
                    '">View Video</span> <span class="viewResumeBtn viewPortfoliData" data-app="' +
                    user.id +
                    '" data-job="' +
                    job.id +
                    '">View Portfolio</span> </div>'
                );
                $(".user-job-work").html(user.work_type);
                $(".user-job-salary").html(
                    user.min_income_expected + " - " + user.max_income_expected
                );
                $(".user-dob").html(user.dob);
                $(".user-application-date").html(job.post_date_format);
                $(".user-summary").html(user.executive_summary);

                var userSkills = "";
                user.user_skill.forEach((data) => {
                    if (data.skill && data.skill.title) {
                        userSkills += '<div class="indSkills">' + data.skill.title + "</div>";
                    }
                });
                if (userSkills == "") {
                    userSkills += '<div class="indSkills">No Skills</div>';
                }
                $(".applicantSkills").html(userSkills);

                var userExperience = "";
                user.user_experience.forEach((data) => {
                    var date =
                        data.end_date != null
                            ? data.title +
                            " - " +
                            new Date(data.end_date).getFullYear()
                            : data.title;
                    userExperience +=
                        "<li>" +
                        date +
                        "</li><li>" +
                        data.company +
                        "</li><br>";
                });
                if (userExperience == "") {
                    userExperience += "No Experience";
                }
                $(".user-experience").html(userExperience);

                var userEducation = "";
                var userCertificate = "";
                user.user_education.forEach((data) => {
                    var date =
                        data.end_date != null
                            ? data.school +
                            " - " +
                            new Date(data.end_date).getFullYear()
                            : data.school;
                    userEducation +=
                        "<li>" + date + "</li><li>" + data.degree + "</li><br>";

                    data.user_certificate.forEach((d) => {
                        userCertificate +=
                            "<li>" +
                            d.name +
                            "</li><li>" +
                            d.detail +
                            "</li><br>";
                    });
                });
                if (userEducation == "") {
                    userEducation += "No Education";
                }
                if (userCertificate == "") {
                    userCertificate += "No Certificate";
                }
                $(".user-education").html(userEducation);
                $(".user-certificate").html(userCertificate);
                $("#applicantDetails").modal("show");
            }
        );
    });

    $("body").on("click", ".addNotesBtn", function () {
        $("#applicantDetails").modal("hide");
        $("#jobDetails").modal("hide");
        $("#jobNotes").modal("show");
    });

    function hideUserData() {
        $(".userDetailImg").removeAttr("src");
        $(".user-name").html("-");
        $(".user-location").html("-");
        $(".user-email").html("");
        $(".action-button").html("").removeClass("text-black");
        $(".user-job-work").html("-");
        $(".user-job-salary").html("-");
        $(".user-dob").html("-");
        $(".user-application-date").html("-");
        $(".user-summary").html("-");
        $(".applicantSkills").html("-");
        $(".user-experience").html("-");
        $(".user-education").html("-");
        $(".user-certificate").html("-");
    }

    function hideViewData() {
        $(".edit-job-view").removeAttr("data-id").removeAttr("data-title");
        $(".delete-job-view").removeAttr("data-id");
        $("#job_title_view").html("");
        $("#job_work_view").html("");
        $("#location_view").html("");
        $("#status_view").html("");
        $("#start_date_format").html("");
        $("#post_date_format").html("");
        $("#end_date_format").html("");
        $("#description-view").html("");
        $("#requirement-view").html("");
        $("#question-view > li").remove();
        $(".availableCandidates > div").remove();
        $(".suitableCandidates > div").remove();
    }

    $(".download-csv").on("click", function () {
        let search = $(".search-job").val();
        let href = exportURL;
        var finalLink = href;
        if (search != "") {
            finalLink = finalLink + "?s=" + search + "";
        }
        window.location.href = finalLink;
    });

    function hideError() {
        $("#title-error").html("");
        $("#image-error").html("");
        $("#role-name-error").html("");
        $("#company-name-error").html("");
        $("#experience-error").html("");
        $("#location-error").html("");
        $("#start-date-error").html("");
        $("#type-of-work-error").html("");
        $("#industry-error").html("");
        $("#end-date-error").html("");
        $("#description-error").html("");
        $("#requirement-error").html("");
        $("#salary-range-error").html("");
        $("#skill-id-error").html("");
        $(".image-show").attr("src", "");
    }

    function blankFields() {
        $("#id").val("");
        $("#title").val("");
        $("#image").val("");
        $("#role_name").val("");
        $("#company_name").val("");
        $("#experience").val("");
        $("#location").val("");
        $("#start_date").val("");
        $("#type_of_work").val(null).trigger("change");
        $("#industry").val(null).trigger("change");
        $("#industry")
            .val(null)
            .select2({
                placeholder: "Industry",
                dropdownParent: $("#addNewJob"),
                allowClear: true,
            });
        $("#skill_id").val(null).select2({
            placeholder: "",
            allowClear: true,
        });
        var $skillMulti = $("#skill_id").select2();
        $("#add_skill").on("click", function () {
            $skillMulti.select2("open");

        });


        $("#end_date").val("");
        $("#description").val("");
        $("#requirement").val("");
        $("#latitude").val("");
        $("#longitude").val("");
        $("#salary_range").val("");
        $(".question-div > .new-main-row").remove();
        $("input[name='question_1[]'], input[name='question_2[]']").each(
            function () {
                $(this).removeAttr("value");
            }
        );
    }


    $("#industry")
        .select2({
            placeholder: "Industry",
            dropdownParent: $("#addNewJob"),
            allowClear: true,
        })
        .on("select2:unselecting", function (e) {
            $(this).data("state", "unselected");
        })
        .on("select2:open", function (e) {
            if ($(this).data("state") === "unselected") {
                $(this).removeData("state");
                var self = $(this);
                setTimeout(function () {
                    self.select2("close");
                }, 1);
            }
        });

    $("body").on("click", ".accept-job", function () {
        var status = $(this).data("value");
        var appUserId = $(this).data("app");
        var jobId = $(this).data("job");
        if (status && appUserId && jobId != "") {
            $(this).css("pointer-events", "none");
            $.ajax({
                method: "POST",
                url: applyJobStatus,
                data: {
                    _method: "POST",
                    status: status,
                    app_user_id: appUserId,
                    job_id: jobId,
                },
            }).done(function (data) {
                $(this).css("pointer-events", "auto");
                if (data.success) {
                    toastr.success(data.message);
                    $(".action-button")
                        .html(
                            data.data == 1
                                ? "Your job application has been accepted."
                                : "Your job application has been rejected."
                        )
                        .addClass("text-black");
                } else {
                    toastr.error(data.message);
                }
            });
        } else {
            toastr.error("Something went wrong");
        }
    });

    $("body").on("change", "#industry", function () {
        var id = $(this).val();
        if (id != "") {
            $.ajax({
                method: "POST",
                url: getSkill,
                data: {
                    _method: "POST",
                    id: id,
                },
            }).done(function (response) {
                $("#skill_id").find("option").remove().end();
                if (response.success) {
                    $.each(response.data, function (key, value) {
                        let selected = "";
                        $("#skill_id").append(
                            $("<option " + selected + "></option>")
                                .attr("value", value.id)
                                .text(value.title)
                        );
                    });
                }
            });
        } else {
            $("#skill_id").val(null).select2({
                placeholder: "Select Skills",
                allowClear: true,
            });
        }
    });

    $("#skill_id").select2({
        placeholder: "Select Skills",
        allowClear: true,
    });

    $("#title").keypress(function (e) {
        var charCode = e.which ? e.which : event.keyCode;
        if (!String.fromCharCode(charCode).match(/^[a-zA-Z ]+$/)) return false;
    });
    $("#role_name").keypress(function (e) {
        var charCode = e.which ? e.which : event.keyCode;
        if (!String.fromCharCode(charCode).match(/^[a-zA-Z ]+$/)) return false;
    });
    $("#company_name").keypress(function (e) {
        var charCode = e.which ? e.which : event.keyCode;
        if (!String.fromCharCode(charCode).match(/^[a-zA-Z ]+$/)) return false;
    });
    $("#description").keypress(function (e) {
        var charCode = e.which ? e.which : event.keyCode;
        if (!String.fromCharCode(charCode).match(/^[a-zA-Z ]+$/)) return false;
    });

    // view resume

    $("body").on("click", ".viewResumeData", function () {
        var appUserId = $(this).data("app");
        var jobId = $(this).data("job");

        var formData = new FormData();
        formData.append("user_id", appUserId);
        formData.append("job_id", jobId);
        $.ajax({
            url: showResume,
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "HTML",
            success: function (data) {
                $(".show-resume").html(data);
                $("#jobDetailsResume").modal("show");
                $("#applicantDetails").modal("hide");
                $("#jobDetails").modal("hide");
            },
        });
    });

    //view cover letter

    $("body").on("click", ".viewCoverLetterData", function () {
        var appUserId = $(this).data("app");
        var jobId = $(this).data("job");

        var formData = new FormData();
        formData.append("user_id", appUserId);
        formData.append("job_id", jobId);
        $.ajax({
            url: showCoverLetter,
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "HTML",
            success: function (data) {
                $(".show-cover-letter").html(data);
                $("#jobDetailsCoverLetter").modal("show");
                $("#applicantDetails").modal("hide");
                $("#jobDetails").modal("hide");
            },
        });
    });

    //view portfolio

    $("body").on("click", ".viewPortfoliData", function () {
        var appUserId = $(this).data("app");

        var formData = new FormData();
        formData.append("user_id", appUserId);
        $.ajax({
            url: showPortfolio,
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "HTML",
            success: function (data) {
                $(".show-portfolio").html(data);
                $("#jobDetailsPortfolio").modal("show");
                $("#applicantDetails").modal("hide");
                $("#jobDetails").modal("hide");
            },
        });
    });

    //view video

    $("body").on("click", ".viewVideoData", function () {
        var appUserId = $(this).data("app");

        var formData = new FormData();
        formData.append("user_id", appUserId);
        $.ajax({
            url: showVideo,
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "HTML",
            success: function (data) {
                $(".show-video").html(data);
                $("#jobDetailsVideo").modal("show");
                $("#applicantDetails").modal("hide");
                $("#jobDetails").modal("hide");
            },
        });
    });
});


//just some js to simulate fake loading time


