<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PageRegistration/css/styles.css">
    <title>Страница входа</title>
</head>
<body>
<div class="main-image _ibg">
    <img src="PageRegistration/img/main.png" alt="main">
</div>
<div class="wrapper">
    <div class="logo"><img src="/PageRegistration/img/logo.svg" alt="logo"></div>
    <div class="text-container _container">
        <h1 class="text-container__title">Войти в аккаунт</h1>
        <div class="text-container__subtitle">Еще нет аккаунта? <a href="{{route('registration')}}" class="text-container__subtitle entrance">Зарегистрироваться</a></div>
    </div>
    <form action="{{'login'}}" method="post">
        <div class="form-fields _container">
                <div class="form-field form-field__email">
                    <input type="text"  maxlength="35" placeholder="E-mail" name = 'login'>
            </div>
            <div class="form-field form-field__password">
                <input type="password"  maxlength="35" placeholder="Пароль" name="password">
            </div>
        </div>
        @csrf
        @error('login')
        <div class="error" role="alert">{{$message}}</div>
        @enderror
        <input type="submit" class="form-button form-button__createacc" value="Войти">
    </form>

    <div class="form-buttons _container">

        <div class="divider">или</div>
        <a href="{{route('google')}}" class="form-button form-button__google"><img src="PageRegistration/img/01.svg" alt="google">Войти с помощью Google</a>
        <a href="{{route('vkontakte')}}" class="form-button form-button__vk"><img src="PageRegistration/img/02.svg" alt="vk">Войти с помощью ВКонтакте</a>
    </div>
</div>
<!--<script src="/registration/js/script.js"></script>-->
</body>
</html>
