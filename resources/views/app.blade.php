<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
        <link rel="stylesheet" href="{{ mix('build/css/app.css') }}">
        <link rel="stylesheet" href="{{ mix('build/css/argon.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/all.min.css') }}">
    </head>
    <body>
        @inertia

        @routes
        <script src="{{ mix('build/js/manifest.js') }}"></script>
        <script src="{{ mix('build/js/vendor.js') }}"></script>
        <script src="{{ mix('build/js/app.js') }}"></script>
    </body>
</html>
