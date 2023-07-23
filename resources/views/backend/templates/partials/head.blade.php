<head>
    <meta charset="utf-8" />
    <title>E-Commerce | Margi Udeng</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/main/images/web/favicon.ico')}}">

    <!-- Bootstrap Css -->
    <link href="{{asset('assets/main/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('assets/main/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('assets/main/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

    <!-- dataTable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

    <!-- Sweetalert2 -->
    <link rel="stylesheet" href="{{asset('assets/main/libs/sweetalert2/sweetalert2.min.css')}}">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('css')
</head>
