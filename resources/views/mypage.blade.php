<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/css/styles.css">
  <title>Форма регистрации</title>
</head>
<body>
  <div class="main-image _ibg">
    <img src="img/main.png" alt="main">
  </div>
  <div class="wrapper">
    <div class="logo">LOGO</div>
    <div class="text-container _container">
      <h1 class="text-container__title">Создать аккаунт</h1>
      <div class="text-container__subtitle">Уже есть аккаунт? <a href="#" class="text-container__subtitle entrance">Войти<a></div>
    </div>
    <div class="form-fields _container">
      <div class="form-field form-field__email">
        <input type="email" placeholder="E-mail">
      </div>
      <div class="form-field__fullname">
        <div class="form-field form-field__name">
        <input type="text" placeholder="Имя">
      </div>
      <div class="form-field form-field__lastname">
        <input type="text" placeholder="Фамилия">
      </div>
    </div>      
      <div class="form-field form-field__password">
        <input type="password" placeholder="Пароль">
      </div>
    </div>
    <div class="form-buttons _container">
      <div class="form-button form-button__createacc">Создать аккаунт</div>
      <div class="divider">или</div>
      <a href="#" class="form-button form-button__google"><img src="img/01.svg" alt=""> Войти с помощью Google</a>
      <a href="#" class="form-button form-button__vk"><img src="img/02.svg" alt="vk"> Войти с помощью ВКонтакте</a>
    </div>
  </div>
  <script src="/js/script.js"></script>
</body>
</html>