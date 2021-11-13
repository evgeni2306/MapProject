<!DOCTYPE html>
<html>
<head>
    <title>Настройки</title>

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PageSettings/css/styles.css">
    <link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
          integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
          crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
            integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
            crossorigin=""></script>
</head>
<body>
<div class="wrapper">
    <header class="header">
        <div class="header__container">
            <a href="" class="header__logo">LOGO</a>
            <nav class="header__menu menu">
                <ul class="menu__list">
                    <li class="menu__item">
                        <a href="{{route('map')}}"><button type="button" class="menu__link" id="menu__link__view"><img
                                src="/PageMap/img/header/02.svg" alt="view">Просмотр
                        </button></a> 
                    </li>
                    <li class="menu__item">
                        <a href="{{route('map')}}"><button type="button" class="menu__link" id="menu__link__add-object"><img
                                src="/PageMap/img/header/03.svg" alt="object">Добавить объект
                        </button></a>
                    </li>
                    <li class="menu__item">
                        <a href="{{route('map')}}"><button type="button" class="menu__link" id="menu__link__add-route"><img
                                src="/PageMap/img/header/04.svg" alt="route">Добавить маршрут
                        </button></a>
                    </li>
                </ul>
            </nav>
            <nav class="user-menu"> 
                <ul class="user-menu__list">
                    <li class="user-name">
                        <img  class="avatar" src="/PageMap/img/user/user.png" alt="user">
                        <a href="#" class="user-menu__link" tabindex="1">Александр Иванов<img src="/PageMap/img/user/arrow.svg" alt=""></a>
                        <ul class="sub-menu__list">
                            <li><a href="#" class="sub-menu__link"><img src="/PageMap/img/user/01.svg" alt="">Мой профиль</a></li>
                            <li><a href="#" class="sub-menu__link"><img src="/PageMap/img/user/02.svg" alt="">Настройки</a></li>
                            <li><a href="#" class="sub-menu__link"><img src="/PageMap/img/user/03.svg" alt="">Выйти</a></li>
                        </ul> 
                    </li>
               </ul>
            </nav>
        </div>
    </header>
    <div class="container">
    <form method="" action ="">
      <h1 class="settings__title">Настройки</h1>
      <div class="content__container">
        <div class="avatar__container">
          <img  class="avatar-big" src="/PageSettings/img/02.png" alt="user">
          <input type="file" id="files" name="files[]">
          <label for="files"><img src="/PageSettings/img/01.svg">Изменить фото</label>
          <output id="list"></output>
        </div>
        <div class="forms__container">
          <h4 class="sub-title">Имя</h4>
          <input type="text" placeholder="Введите имя" name="name">
          <h4 class="sub-title">Фамилия</h4>
          <input type="text" placeholder="Введите фамилию" name="surname">
          <h4 class="sub-title">E-mail</h4>
          <input type="email" placeholder="Введите e-mail" name="email">
          <h4 class="sub-title">Модель транспорта</h4>
          <input type="text" placeholder="Введите модель своего транспорта" name="transport">
          <div class="buttons">
            <input type="reset" class="settings__cancel" value ="Отмена">
            <input type="submit" class="settings__save" value ="Сохранить">
          </div>
          
        </div>
      </div>            
    </form>
    </div>
    <footer class="footer">
      <div class="footer__logo">LOGO</div>
      <div class="footer__rights">@Название 2021. Все права защищены</div>
      <div class="footer__contacts">Контакты</div>
    </footer>
</div>    
<script>
  function handleFileSelect(evt) {
    let files = evt.target.files;

    for (let i = 0, f; f = files[i]; i++) {
      if (!f.type.match('image.*')) {
        continue;
      }

      let reader = new FileReader();
      reader.onload = (function(theFile) {
        return function(e) {
          let span = document.createElement('span');
          span.innerHTML = ['<img class="thumb" src="', e.target.result,
                            '" title="', theFile.name, '"/>'].join('');
          document.getElementById('list').insertBefore(span, null);
        };
      })(f);

      reader.readAsDataURL(f);
    }
  }

document.getElementById('files').addEventListener('change', handleFileSelect, false);
/*-------------------------------*/
        var menuLinks = document.querySelectorAll('.menu__link');
        var lastClicked = menuLinks[0];
        var viewOnly = false;
        var addObject = false;


        for (var i = 0; i < menuLinks.length; i++) {
            menuLinks[i].addEventListener('click', function () {
                lastClicked.classList.remove('active-menu');
                this.classList.add('active-menu');

                lastClicked = this;
            });
        }        
</script>
</body>
</html>
