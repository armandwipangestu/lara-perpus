<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env("APP_NAME") }} - {{ $title }}</title>

    {{-- Assets --}}
    <link rel="stylesheet" href="assets/template/mazer/dist/assets/compiled/css/app.css">
    <link rel="stylesheet" href="assets/template/mazer/dist/assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="assets/template/mazer/dist/assets/compiled/css/iconly.css">
    <link rel="stylesheet" href="assets/template/mazer/dist/assets/compiled/css/auth.css">

    {{-- Sweetalert --}}
    <link rel="stylesheet" href="assets/template/mazer/dist/assets/extensions/sweetalert2/sweetalert2.min.css">

    {{-- Simple Datatable --}}
    <link rel="stylesheet" href="assets/template/mazer/dist/assets/extensions/simple-datatables/style.css">
    <link rel="stylesheet" href="assets/template/mazer/dist/assets/compiled/css/table-datatable.css">

    {{-- Fontawesome --}}
    <link rel="stylesheet" href="assets/template/mazer/dist/assets/extensions/@fortawesome/fontawesome-free/css/all.min.css">

    {{-- Dripicons --}}
    <link rel="stylesheet" href="assets/template/mazer/dist/assets/extensions/@icon/dripicons/dripicons.css">
    <link rel="stylesheet" href="assets/template/mazer/dist//assets/compiled/css/ui-icons-dripicons.css">

    {{-- Flatpickr --}}
    <link rel="stylesheet" href="assets/template/mazer/dist/assets/extensions/flatpickr/flatpickr.min.css">

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <div id="app">
        @yield('container')
    </div>

    {{-- JS --}}
    <script src="assets/template/mazer/dist/assets/static/js/components/dark.js"></script>
    <script src="assets/template/mazer/dist/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/template/mazer/dist/assets/compiled/js/app.js"></script>

    {{-- Custom JS --}}
    <script src="assets/js/script.js"></script>

</body>
</html>