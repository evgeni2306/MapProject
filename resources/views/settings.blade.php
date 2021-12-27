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
            <a href="" class="header__logo"><img src="/PageRegistration/img/logo.svg" alt="logo"></a>
            <nav class="header__menu menu">
                <ul class="menu__list">
                    <li class="menu__item">
                        <a href="{{route('map')}}"><button type="button" class="menu__link" id="menu__link__view"><img
                                src="/PageMap/img/header/02.svg" alt="view">Карта
                        </button></a> 
                    </li>
                </ul>
            </nav>
            <div class="menu__icon">
                <span></span>
            </div>
            <nav class="user-menu"> 
                <ul class="user-menu__list">
                    <li class="user-name">
                        <img  class="avatar" src="/PageMap/img/user/user.png" alt="user">
                        <a href="#" class="user-menu__link" tabindex="1">Александр Иванов</a><span class="menu__arrow"></span>
                        <ul class="sub-menu__list">
                            <li><a href="{{route('profile')}}" class="sub-menu__link"><img src="/PageMap/img/user/01.svg" alt="">Мой профиль</a></li>
                            <li><a href="{{route('settings')}}" class="sub-menu__link"><img src="/PageMap/img/user/02.svg" alt="">Настройки</a></li>
                            <li><a href="{{route('unauthorizedmap')}}" class="sub-menu__link"><img src="/PageMap/img/user/03.svg" alt="">Выйти</a></li>
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
          <div class="change-photo">
            <input type="file" id="files" name="files[]">
            <label for="files"><img src="/PageSettings/img/02.svg">Изменить фото</label>
            <output id="list"></output>
          </div>
          <!--<div class="change-photo__mobile">
            <input type="file" id="files__mobile" name="files[]">
            <label for="files__mobile"><img src="/PageSettings/img/02.svg"></label>
            <output id="list"></output>
          </div>-->
        </div>
        <div class="forms__container">
          <h4 class="sub-title">Имя</h4>
          <input type="text" placeholder="Введите имя" name="name">
          <h4 class="sub-title">Фамилия</h4>
          <input type="text" placeholder="Введите фамилию" name="surname">
          <h4 class="sub-title">E-mail</h4>
          <input type="text" placeholder="Введите e-mail" name="email">
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
      <div class="footer__logo"><img src="/PageRegistration/img/logo.svg" alt="logo"></div>
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

/*--------------------------------*/
let menuArrows = document.querySelectorAll('.menu__arrow');
        if (menuArrows.length > 0) {
            for (let i = 0; i < menuArrows.length; i++) {
                const menuArrow = menuArrows[i];
                document.querySelector('.user-name').addEventListener("click", function(e) {
                    menuArrow.parentElement.classList.toggle('active__arrow');
                });
            }
        }

        var isMobile = {
            Android: function() {
                return navigator.userAgent.match(/Android/i);
            },
            BlackBerry: function() {
                return navigator.userAgent.match(/BlackBerry/i);
            },
            iOS: function() {
                return navigator.userAgent.match(/iPhone|iPad|iPod/i);
            },
            Opera: function() {
                return navigator.userAgent.match(/Opera Mini/i);
            },
            Windows: function() {
                return navigator.userAgent.match(/IEMobile/i);
            },
            any: function() {
                return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
            }
        };       

        if (isMobile.any()) {
            document.body.classList.add('_mobile');
        } else {
            document.body.classList.add('_pc');
        }

        const iconMenu = document.querySelector('.menu__icon');
        if (iconMenu) {
            const userMenu = document.querySelector('.user-menu');
            const headerMenu = document.querySelector('.menu');
            iconMenu.addEventListener("click", function(e) {
                document.body.classList.toggle('_lock');
                iconMenu.classList.toggle('active__user-menu');
                userMenu.classList.toggle('active__user-menu');
                headerMenu.classList.toggle('hide');
            });
        }
</script>
</body>
</html>
