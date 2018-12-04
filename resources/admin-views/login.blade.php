<!doctype html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{ config('admin.name') }}</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ admin_asset('/AdminLTE/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ admin_asset('/login/login.css') }}" rel="stylesheet">
</head>

<body class="text-center">
<form class="form-signin" method="post" action="{{ route('admin::login') }}">
    <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">{{ config('admin.name') }}</h1>
    <label for="inputUserName" class="sr-only">用户名</label>
    <input type="text" id="inputUserName" name="username" class="form-control" placeholder="用户名" required autofocus>
    <label for="inputPassword" class="sr-only">密码</label>
    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="密码" required>

    @if($errors->hasBag('default'))
        <?php $error = $errors->getBag('default');?>
        <div class="alert alert-danger" role="alert">
            {{ $error->messages()[0][0] }}
        </div>
    @endif

    {{ csrf_field() }}
    <button class="btn btn-lg btn-primary btn-block" type="submit">登录</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
</form>
</body>
</html>
