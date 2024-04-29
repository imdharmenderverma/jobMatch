$(document).ready(function () {
    let sortBy = 1;
    var table = $(".user-table").DataTable({
        searching: false,
        processing: true,
        dom: "rtip",
        order: [],
        serverSide: true,
        pageLength: 10,
        ajax: {
            url: users,
            data: function (d) {
                d.search = $(".search-user").val();
                d.industry = $(".industry-type").val();
                d.location = $(".cus-op-left").val();
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
        columns: [
            { data: "name", name: "name" },
            { data: "location", name: "location" },
            { data: "job_match_count", name: "job_match_count" },
            { data: "industry_name", name: "industry_name" },
            { data: "gender", name: "gender" },
            { data: "age", name: "age" },
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
        ],
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

    $(".search-user").keyup(function () {
        table.draw();
    });

    $("body").on("change", ".industry-type", function () {
        table.draw();
    });

    $("body").on("change", ".cus-op-left", function () {
        table.draw();
    });


    $("body").on("click", ".action-btn-icon", function () {
        let id = $(this).data("id");
        document.getElementById("myDropdown" + id).classList.toggle("show");
    });

    window.onclick = function (event) {
        if (!event.target.matches(".dropbtn")) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains("show")) {
                    openDropdown.classList.remove("show");
                }
            }
        }
    };

    $("body").on("click", ".viewUserResumeData", function () {
        var appUserId = $(this).data("app");
        var formData = new FormData();
        formData.append("user_id", appUserId);
        formData.append("job_id", "");
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
                $("#resumeClose").val(appUserId);
                $("#userViewResume").modal("show");
                $("#applicantViewDetails").modal("hide");

            },
        });
    });

    $("body").on("click", "#resumeClose", function () {
        var appUserId = $(this).val();
        var formData = new FormData();
        formData.append("user_id", appUserId);
        formData.append("job_id", "");
        $.ajax({
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "HTML",
            success: function (data) {
                $(".show-resume").html(data);
                $("#applicantViewDetails").modal("show");
            },
        });
    });

    $("body").on("click", ".viewUserCoverLetterData", function () {
        var appUserId = $(this).data("app");
        var formData = new FormData();
        formData.append("user_id", appUserId);
        formData.append("job_id", "");
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
                $("#coverLetterClose").val(appUserId);
                $("#userDetailsCoverLetter").modal("show");
                $("#applicantViewDetails").modal("hide");
            },
        });
    });

    $("body").on("click", "#coverLetterClose", function () {
        var appUserId = $(this).val();
        var formData = new FormData();
        formData.append("user_id", appUserId);
        formData.append("job_id", "");
        $.ajax({
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "HTML",
            success: function (data) {
                $(".show-resume").html(data);
                $("#applicantViewDetails").modal("show");
            },
        });
    });

    //view portfolio

    $("body").on("click", ".viewUserPortfoliData", function () {
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
                $("#portfolioClose").val(appUserId);
                $("#userDetailsPortfolio").modal("show");
                $("#applicantViewDetails").modal("hide");
            },
        });
    });


    $("body").on("click", "#portfolioClose", function () {
        var appUserId = $(this).val();
        var formData = new FormData();
        formData.append("user_id", appUserId);
        formData.append("job_id", "");
        $.ajax({
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "HTML",
            success: function (data) {
                $(".show-resume").html(data);
                $("#applicantViewDetails").modal("show");
            },
        });
    });
    //view video

    $("body").on("click", ".viewUserVideoData", function () {
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
                $("#videoClose").val(appUserId);
                $("#userDetailsVideo").modal("show");
                $("#applicantViewDetails").modal("hide");
            },
        });
    });

    $("body").on("click", "#videoClose", function () {
        var appUserId = $(this).val();
        var formData = new FormData();
        formData.append("user_id", appUserId);
        formData.append("job_id", "");
        $.ajax({
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "HTML",
            success: function (data) {
                $(".show-resume").html(data);
                $("#applicantViewDetails").modal("show");
            },
        });
    });

    $("body").on("click", ".applicantUserViewDetails", function () {
        hideUserData();
        var id = $(this).data("id");

        $.get(viewUserProfile + "?user_id=" + id, function (data) {
            var user = data.data;
            $(".userDetailImg").attr("src", user.profile_photo_path);
            $(".user-name").html(user.first_name + " " + user.last_name);
            $(".user-email").html(user.email);
            $(".user-location").html(user.location);
            $(".view-user-details").html(
                '<div class="viewDetailsHeader"> <span class="viewResumeBtn viewUserResumeData" data-app="' +
                user.id +
                '" data-job="">View Resume</span> <span class="viewResumeBtn viewUserCoverLetterData" data-app="' +
                user.id +
                '" data-job="">View Cover Letter</span> </div> <div class="viewDetailsHeader"> <span class="viewResumeBtn disabledBtn viewResume viewUserVideoData" data-app="' +
                user.id +
                '" -datajob="">View Video</span> <span class="viewResumeBtn viewUserPortfoliData" data-app="' +
                user.id +
                '" data-job="">View Portfolio</span> </div>'
            );
            $(".user-job-work").html(user.work_type);
            $(".user-job-salary").html(
                user.min_income_expected ??
                "" + " - " + user.max_income_expected ??
                ""
            );
            $(".user-dob").html(user.dob);
            $(".user-summary").html(user.executive_summary ?? "");

            var userSkills = "";
            user.user_skill.forEach((data) => {
                if (data.skill != null) {
                    userSkills +=
                        "<li>" + data.skill.title + "</li>";
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
                userExperience += "<li>" + date + "</li><li>" + data.company + "</li>";
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
                    "<li>" + date + "</li><li>" + data.degree + "</li>";

                data.user_certificate.forEach((d) => {
                    userCertificate +=
                        "<li>" + d.name + "</li><li>" + d.detail + "</li>";
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
            $("#profailID").val(id);
            $("#applicantViewDetails").modal("show");
        });
    });

    function hideUserData() {
        $(".userDetailImg").removeAttr("src");
        $(".user-name").html("-");
        $(".user-email").html("");
        $(".user-location").html("");
        $(".action-button").html("").removeClass("text-black");
        // $(".user-job-work").html("-");
        $(".user-job-salary").html("-");
        $(".user-dob").html("-");
        $(".user-application-date").html("-");
        $(".user-summary").html("-");
        $(".applicantSkills").html("-");
        $(".user-experience").html("-");
        $(".user-education").html("-");
        $(".user-certificate").html("-");
    }

    $("body").on("click", ".delete-user", function () {
        var id = $(this).data("id");
        var formData = new FormData();
        formData.append("user_id", id);
        swal({
            text: "Are you sure you want to delete record?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            closeOnClickOutside: false,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: storeUser + "/" + id,
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

    $("body").on("change", ".user-status", function () {
        var id = $(this).data("id");
        var status = $(this).data("val");
        var formData = new FormData();
        formData.append("id", id);
        formData.append("status", status == 1 ? 0 : 1);
        $.ajax({
            type: "POST",
            url: updateStatus,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.success) {
                    toastr.success(data.message);
                    window.location.href = window.location.href;
                } else {
                    toastr.error(data.message);
                }
            },
            error: function (data) {
                toastr.error(data.responseJSON.message);
            },
        });
    });
});
