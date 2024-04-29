<script src="{{ asset('assets/js/core/jquery.3.2.1.min.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCwr1n4QpMo-f6fjd8THMLRyqrFk7iZcA8&callback=initAutocomplete&libraries=places&v=weekly" defer></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

<script src="{{ asset('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>

<script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

<script src="{{ asset('assets/js/plugin/chart.js/chart.min.js') }}"></script>

<script src="{{ asset('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

<script src="{{ asset('assets/js/plugin/chart-circle/circles.min.js') }}"></script>

<script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>

<script src="{{ asset('assets/js/plugin/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugin/jqvmap/maps/jquery.vmap.world.js') }}"></script>

<script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

<script src="{{ asset('assets/js/atlantis.min.js') }}"></script>

<!-- <script src={{ asset('assets/js/bootstrap-password-toggler.js') }}></script> -->

<script src="{{ asset('assets/js/setting-demo.js') }}"></script>
<script src="{{ asset('assets/js/demo.js') }}"></script>
<script src="{{ asset('assets/js/toastr.js') }}"></script>
<script src="{{ asset('assets/js/parsley.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/admin/recruiter/job.js') }}"></script>
<script src="{{ asset('assets/js/admin/ckeditor/ckeditor.js') }}"></script>

@if (session()->has('success'))
<script>
    toastr.success("{{ session('success') }}");
</script>
@endif
@if (session()->has('error'))
<script>
    toastr.error("{{ session('error') }}");
</script>
@endif

<script>
    var storeJob = `{{ route('recruiter.jobs.store') }}`;
    var jobs = `{{ route('recruiter.jobs.index') }}`;
    var appUsers = `{{ route('recruiter.app-users.index') }}`;
    var updateJob = `{{ route('recruiter.update-job') }}`;
    var updateStatus = `{{ route('admin.update-status') }}`;
    var exportURL = "{{ route('recruiter.job-export') }}";
    var getSkill = "{{ route('recruiter.get-skill') }}";
    var saveJobFulfill = "{{ route('recruiter.save-job-fulfill') }}";
    var applyJobStatus = "{{ route('recruiter.job-apply-user-status') }}";
    var showResume = `{{ route('view-resume') }}`;
    var showCoverLetter = `{{ route('view-cover-letter') }}`;
    var showPortfolio = `{{ route('view-portfolio') }}`;
    var showVideo = `{{ route('view-video') }}`;
    var userInbox = "{{route('admin.user-data')}}";



    
   

function initAutocomplete() {
    var location = document.getElementById('location');
    var locationautocomplete = new google.maps.places.Autocomplete(location);
    locationautocomplete.addListener('place_changed', function() {
        var locationplace = locationautocomplete.getPlace();
        var htmldiv = $("#divAddLocation").html(locationplace.adr_address);
        var to_location_short = locationplace.name;
        var to_location_full = locationplace.formatted_address;
        $("#place").val(to_location_full);
        var loclatitude = locationplace.geometry.location.lat();
        var loclongitude = locationplace.geometry.location.lng();
            var state = '';
        locationplace.address_components.forEach(function(component) {
            if (component.types.includes('administrative_area_level_1')) {
                state = component.long_name;
            }
        });
        $("#state").val(state);
        
        if (loclatitude != "" && loclongitude != "") {
            document.getElementById('latitude').value = loclatitude;
            document.getElementById('longitude').value = loclongitude;
        } else {
            document.getElementById('latitude').value = '';
            document.getElementById('longitude').value = '';
        }
    });
}


    $(document).ready(function() {
        $("body").on('click', "#eye-btn",function() {
            if ($("#password").prop("type") === "password") {
                $("#password").prop("type", "text");
                $('.eye-show').hide();
                $('.slash-eye-show').show();
                
            } else{
                $("#password").prop("type", "password");
                $('.eye-show').show();
                $('.slash-eye-show').hide();
            }
        });

        $("body").on('click', "#eye-btn-2",function() {
            if ($("#password_confirmation").prop("type") === "password") {
                $("#password_confirmation").prop("type", "text");
                $('.eye-show-2').hide();
                $('.slash-eye-show-2').show();
                
            } else{
                $("#password_confirmation").prop("type", "password");
                $('.eye-show-2').show();
                $('.slash-eye-show-2').hide();
            }
        });
        
        
    });

    

    

    $(document).ready(function() {

        $(".create-acc-select").click(function() {
            $('body').addClass('select-2-indus')
        });

        $('form').parsley();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
{{-- 
    $(".nav-item a img.baseMenuImg").hover(function() {
        $(this).hide();
        $(this).next().show();
    })
   
    $(".nav-item a img.liveMenuImg").mouseleave(function() {
        $(this).hide();
        $(this).prev().show();
    }) --}}

    $(".pricingwrapper").click(function() {
        $(".pricingwrapper").removeClass("active");
        $(this).addClass("active");
    })

    $('.input-group-text#basic-addon2').each(function() {
        var parentHeight = $(this).parent().height();
        $(this).height(parentHeight);
    });

    var activeurl = window.location.pathname;
    var liveurl = activeurl.slice(activeurl.lastIndexOf('/') + 1);
    $('a[href="' + liveurl + '"]').parent('li').addClass('active');

    $('.fa-eye').click(function() {
        $(this).hide();
        $('.fa-eye-slash').show();
        $('.passworddots').hide();
        $('.passwordreal').show();
    });
    $('.fa-eye-slash').on('click', function() {
        $(this).hide();
        $('.fa-eye').show();
        $('.passworddots').show();
        $('.passwordreal').hide();
    })

    $("#cancelsubscription").click(function() {
        $(".cancelsub").show();
    })

    $('#dashmodal2').click(function() {
        $('.dashmodal1').hide();
        $('.dashboardmodal2').show();
    })
    $('#dashmodal1back').click(function() {
        $('.dashmodal1').show();
        $('.dashboardmodal2').hide();
    })

    $(".agent_qualities .input-group.mb-3").on('click', function(event) {
        event.stopPropagation();
        event.stopImmediatePropagation();
        var currentVal = $(this).find('span.selectedQltInner').text();

        if ($(this).hasClass('selectedQlt')) {
            $('span.selectedQltInner').each(function() {
                var spanText = $(this).text();
                if (currentVal != 3) {
                    if (spanText == 2) {
                        $(this).html("1");
                    }
                    if (spanText == 3) {
                        $(this).html("2");
                    }
                }
            })
        }
        $(this).toggleClass('selectedQlt');

        var counterQlt = $('.selectedQlt').length;
        if (counterQlt >= 4) {
            $(this).toggleClass('selectedQlt');
            $('#myModal1').modal('show');
        } else {
            if (counterQlt > 0) {
                $(this).find('span').html('<span class="selectedQltInner">' + counterQlt + '</span>');
            }
        }
    });

    Circles.create({
        id: 'circles-1',
        radius: 45,
        value: 60,
        maxValue: 100,
        width: 7,
        text: 5,
        colors: ['#f1f1f1', '#FF9E27'],
        duration: 400,
        wrpClass: 'circles-wrp',
        textClass: 'circles-text',
        styleWrapper: true,
        styleText: true
    })

    Circles.create({
        id: 'circles-2',
        radius: 45,
        value: 70,
        maxValue: 100,
        width: 7,
        text: 36,
        colors: ['#f1f1f1', '#2BB930'],
        duration: 400,
        wrpClass: 'circles-wrp',
        textClass: 'circles-text',
        styleWrapper: true,
        styleText: true
    })

    Circles.create({
        id: 'circles-3',
        radius: 45,
        value: 40,
        maxValue: 100,
        width: 7,
        text: 12,
        colors: ['#f1f1f1', '#F25961'],
        duration: 400,
        wrpClass: 'circles-wrp',
        textClass: 'circles-text',
        styleWrapper: true,
        styleText: true
    })

    // var totalIncomeChart = document.getElementById('totalIncomeChart').getContext('2d');

    // var mytotalIncomeChart = new Chart(totalIncomeChart, {
    //     type: 'bar',
    //     data: {
    //         labels: ["S", "M", "T", "W", "T", "F", "S", "S", "M", "T"],
    //         datasets: [{
    //             label: "Total Income",
    //             backgroundColor: '#ff9e27',
    //             borderColor: 'rgb(23, 125, 255)',
    //             data: [6, 4, 9, 5, 4, 6, 4, 3, 8, 10],
    //         }],
    //     },
    //     options: {
    //         responsive: true,
    //         maintainAspectRatio: false,
    //         legend: {
    //             display: false,
    //         },
    //         scales: {
    //             yAxes: [{
    //                 ticks: {
    //                     display: false
    //                 },
    //                 gridLines: {
    //                     drawBorder: false,
    //                     display: false
    //                 }
    //             }],
    //             xAxes: [{
    //                 gridLines: {
    //                     drawBorder: false,
    //                     display: false
    //                 }
    //             }]
    //         },
    //     }
    // });

    $('#lineChart').sparkline([105, 103, 123, 100, 95, 105, 115], {
        type: 'line',
        height: '70',
        width: '100%',
        lineWidth: '2',
        lineColor: '#ffa534',
        fillColor: 'rgba(255, 165, 52, .14)'
    });
</script>