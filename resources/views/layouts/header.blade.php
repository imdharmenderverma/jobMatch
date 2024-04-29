<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    @if (Auth::guard('recruiter')->check())
    <title>Job Matched</title>
    @else
    <title>Job Matched Admin</title>
    @endif

    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/img/favicon.png') }}" type="image/x-icon" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        var fontCss = `{{ asset('assets/css/fonts.min.css') }}`;
    </script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: [fontCss]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/atlantis.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">
    @if (Auth::guard('web')->check())
    <link rel="stylesheet" href="{{ asset('assets/css/custom_admin.css') }}">
    @else
    <link rel="stylesheet" href="{{ asset('assets/css/custom_front.css') }}">
    @endif
    <link rel="stylesheet" href="{{ asset('assets/css/parsley.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .eye-btn {
            position: absolute;
            top: 18px;
            right: 16px;
        }
    </style>
    <style>
        .inbox-btn {
            text-align: center;
            line-height: 38px;
        }
    </style>
</head>