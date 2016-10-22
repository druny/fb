<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Подтверждение</title>
</head>
<body>

    <p>Пользователь {{ $user->login }} пытается поменять почту, {{ $user->email }} аккаунта сайта {{ url('/') }}, на данную</p>
    <p>Если все верно, тогда прошу пройти по данной ссылке <a href="{{ route('new_email.confirm', $token) }}">Подтверждение</a> </p>
    <p>В обратном случае просто игнорируйте данное сообщение</p>
</body>
</html>