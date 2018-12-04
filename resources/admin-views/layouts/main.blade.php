<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $pageTitle or Admin::title() }}</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ admin_asset('/AdminLTE/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ admin_asset('/AdminLTE/dist/css/skins/skin-blue.min.css') }}">
    <link rel="stylesheet" href="{{ admin_asset('/google-fonts/fonts.css') }}">
    <link rel="stylesheet" href="{{ admin_asset('/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ admin_asset('/nprogress/nprogress.css') }}">
    <link rel="stylesheet" href="{{ admin_asset('/nestable/nestable.css') }}">
    <link rel="stylesheet" href="{{ admin_asset('/bootstrap-fileinput/css/fileinput.min.css') }}">
    <link rel="stylesheet" href="{{ admin_asset('/AdminLTE/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ admin_asset('/toastr/build/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ admin_asset('/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ admin_asset('/bootstrap-validator/css/bootstrapValidator.min.css') }}">
    <link rel="stylesheet" href="{{ admin_asset('/sweetalert/dist/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ admin_asset('/bootstrap-duallistbox/dist/bootstrap-duallistbox.min.css') }}">
    <link rel="stylesheet" href="{{ admin_asset('/iconpicker/css/fontawesome-iconpicker.min.css') }}">
    <link rel="stylesheet" href="{{ admin_asset('/bootstrap-switch/css/bootstrap-switch.min.css') }}">
    {!! Admin::css() !!}
    <link rel="stylesheet" href="{{ admin_asset('/AdminLTE/dist/css/AdminLTE.min.css') }}">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    @yield('css')
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    @include('admin::partials.header')

    @include('admin::partials.main-sidebar')

    <div class="content-wrapper" id="pjax-container">
        <section class="content-header">
            <h1>
                {{ $header or config('admin.header')}}
                <small>{{ $description or config('admin.description')}}</small>
            </h1>
        </section>

        <section class="content container-fluid">
            @include('admin::partials.exception')
            @include('admin::partials.form-errors')
            @include('admin::partials.error')
            @include('admin::partials.success')
            @include('admin::partials.toastr')

            @yield('content')
        </section>
    </div>

    @include('admin::partials.main-footer')

</div>

<script>
    function LA() {}
    LA.token = "{{ csrf_token() }}";
</script>


<script src="{{ admin_asset('/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<script src="{{ admin_asset('/AdminLTE/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ admin_asset('/AdminLTE/dist/js/app.min.js') }}"></script>
<script src="{{ admin_asset('/nprogress/nprogress.js') }}"></script>
<script src="{{ admin_asset('/jquery-pjax/jquery.pjax.js') }}"></script>
<script src="{{ admin_asset('/moment/min/moment-with-locales.min.js') }}"></script>
<script src="{{ admin_asset('/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ admin_asset('/AdminLTE/plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ admin_asset('/nestable/jquery.nestable.js') }}"></script>
<script src="{{ admin_asset('/bootstrap-fileinput/js/plugins/canvas-to-blob.min.js?v4.3.7') }}"></script>
<script src="{{ admin_asset('/bootstrap-fileinput/js/fileinput.min.js?v4.3.7') }}"></script>
<script src="{{ admin_asset('/toastr/build/toastr.min.js') }}"></script>
<script src="{{ admin_asset('/bootstrap-validator/js/bootstrapValidator.min.js') }}"></script>
<script src="{{ admin_asset('/sweetalert/dist/sweetalert.min.js') }}"></script>
<script src="{{ admin_asset('/bootstrap-duallistbox/dist/jquery.bootstrap-duallistbox.min.js') }}"></script>
<script src="{{ admin_asset('/iconpicker/js/fontawesome-iconpicker.min.js') }}"></script>
<script src="{{ admin_asset('/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
{!! Admin::js() !!}

<script src="{{ admin_asset('/laravel-admin/laravel-admin.js') }}"></script>

@yield('script')
</body>
</html>