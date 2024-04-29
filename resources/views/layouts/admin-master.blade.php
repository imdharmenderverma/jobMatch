<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.header')
    @yield('page-css')
</head>
@php
    $id = 'cms_db';
    if (request()->is('admin/skill') || request()->is('admin/statement-skill') || request()->is('admin/inbox')|| request()->is('admin/recruiter-users') || request()->is('admin/app-users') || request()->is('admin/industries') || request()->is('admin/privacy-policy') || request()->is('admin/faq') || request()->is('admin/terms-of-use')) {
        $id = 'cms_um';
    }
@endphp
<body id="{{ $id }}">
    <div class="wrapper">
        @include('layouts.inner-header')
        @include('layouts.admin.sidebar')
        @yield('content')
        @include('layouts.footer')
        @yield('page-js')
    </div>
</body>

</html>
