<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PageRegistration/css/styles.css">
    <title>Страница регистрации</title>
</head>
<body>
<div class="main-image _ibg">
    <img src="PageRegistration/img/main.png" alt="main">
</div>
<div class="wrapper">
    <div class="logo"><img src="/PageRegistration/img/logo.svg" alt="logo"></div>
    <div class="text-container _container">
        <h1 class="text-container__title">Создать аккаунт</h1>
        <div class="text-container__subtitle">Уже есть аккаунт? <a href="{{route('login')}}" class="text-container__subtitle entrance">Войти</a>
        </div>
    </div>
    <form action="" method="">
        <div class="form-fields _container">
            <div class="form-field form-field__email">
                <input type="text" maxlength="35" placeholder="E-mail" name='email'>
            </div>
            <div class="form-field__fullname">
                <div class="form-field form-field__name">
                    <input type="text"  maxlength="35" placeholder="Имя" name='name'>
                </div>
                <div class="form-field form-field__lastname">
                    <input type="text"  maxlength="35" placeholder="Фамилия" name='surname'>
                </div>
            </div>
            <div class="form-field form-field__password">
                <input type="password" id="password-input" maxlength="50" placeholder="Пароль" name="password">
                <a href="#" class="password-control-reg" onclick="return show_hide_password(this);"></a>
            </div>
        </div>
        @csrf
        <input type="submit" class="form-button form-button__createacc" value="Создать аккаунт">
    </form>
    <div class="form-buttons _container">

        <div class="divider">или</div>
        <a href="#" class="form-button form-button__google"><img src="PageRegistration/img/01.svg" alt="google">Войти с
            помощью Google</a>
        <a href="#" class="form-button form-button__vk"><img src="PageRegistration/img/02.svg" alt="vk">Войти с помощью
            ВКонтакте</a>
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
</script>>
</body>
</html>
