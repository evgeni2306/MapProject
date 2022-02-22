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
    <form action="" method="">
        <div class="form-fields _container">
            <div class="form-field form-field__email">
                <input type="email" maxlength="35" placeholder="E-mail" name = 'email'>
            </div>
            <div class="form-field form-field__password">
                <input type="password" id="password-input" maxlength="35" placeholder="Пароль" name="Password">
                <a href="#" class="password-control" onclick="return show_hide_password(this);"></a>
            </div>
        </div>
        <div class="error-block hide"><img src="PageRegistration/img/information.svg" alt=""></div>
        <input type="submit" class="form-button form-button__createacc" value="Войти">
    </form>

    <div class="form-buttons _container">

        <div class="divider">или</div>
        <a href="#" class="form-button form-button__google"><img src="PageRegistration/img/01.svg" alt="google">Войти с помощью Google</a>
        <a href="#" class="form-button form-button__vk"><img src="PageRegistration/img/02.svg" alt="vk">Войти с помощью ВКонтакте</a>
    </div>
</div>
<script>
    function show_hide_password(target){
        var input = document.getElementById('password-input');
        if (input.getAttribute('type') == 'password') {
            target.classList.add('view');
            input.setAttribute('type', 'text');
        } else {
            target.classList.remove('view');
            input.setAttribute('type', 'password');
        }
        return false;
    }
</script>
</body>
</html>
