<!DOCTYPE html>
<html>
<head>
    <title>Профиль</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PageProfile/css/styles.css">
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
                        <img  class="avatar" src="{{$_SESSION['User']->avatar}}" alt="user">
                        <a href="#" class="user-menu__link" tabindex="1">{{$_SESSION['User']->name.' '.$_SESSION['User']->surname}}</a><span class="menu__arrow"></span>
                        <ul class="sub-menu__list">
                            <li><a href="{{route('myprofile')}}" class="sub-menu__link"><img src="/PageMap/img/user/01.svg" alt="">Мой профиль</a></li>
                            <li><a href="{{route('edit')}}" class="sub-menu__link"><img src="/PageMap/img/user/02.svg" alt="">Настройки</a></li>
                            <li><a href="{{route('logout')}}" class="sub-menu__link"><img src="/PageMap/img/user/03.svg" alt="">Выйти</a></li>
                        </ul>
                    </li>
               </ul>
            </nav>
        </div>
    </header>
    <div class="content__wrapper">
      <h1 class="profile__title">Мой профиль</h1>
      <div class="container">
        <div class="content__container">
          <div class="user">
            <img class="user__avatar" src="{{$_SESSION['User']->avatar}}" alt="avatar">
            <div class="user__info">
              <div class="user__name">{{$_SESSION['User']->name.' '.$_SESSION['User']->surname}}</div>
              <div class="user__email"></div>
            </div>
          </div>
          <div class="achievements">
            <div class="feedback__count card">
              <img src="/PageProfile/img/02.png" alt="star">
              <div class="card__info">
                <div class="feedback__title title">{{$_SESSION['UserInfo']['comments']}}</div>
                <div class="feedback__subtitle">Отзывов</div>
              </div>
            </div>
            <div class="feedback__count__mobile card__mobile">
              <div class="card__info">
                <img src="/PageProfile/img/01.svg" alt="star">
                <div class="feedback__title title">{{$_SESSION['UserInfo']['comments']}}</div>
              </div>
                <div class="feedback__subtitle">Отзывов</div>
            </div>
            <div class="route__count card">
              <img src="/PageProfile/img/03.png" alt="route">
              <div class="card__info">
                <div class="route__title title">{{$_SESSION['UserInfo']['routes']}}</div>
                <div class="route__subtitle">Маршрутов</div>
              </div>
            </div>
            <div class="route__count__mobile card__mobile">
              <div class="card__info">
                <img src="/PageProfile/img/02.svg" alt="route">
                <div class="route__title title">{{$_SESSION['UserInfo']['routes']}}</div>
              </div>
                <div class="route__subtitle">Маршрутов</div>
            </div>
            <div class="point__count card">
              <img src="/PageProfile/img/04.png" alt="point">
              <div class="card__info">
                <div class="point__title title">{{$_SESSION['UserInfo']['points']}}</div>
                <div class="point__subtitle">Меток</div>
              </div>
            </div>
            <div class="point__count__mobile card__mobile">
              <div class="card__info">
                <img src="/PageProfile/img/03.svg" alt="point">
                <div class="point__title title">{{$_SESSION['UserInfo']['points']}}</div>
              </div>
                <div class="point__subtitle">Меток</div>
            </div>
          </div>
        </div>
          <div class="transport-model">
            <div class="transport-model__title">Модель транспорта</div>
            <img class="transport__image" src="/PageProfile/img/01.png" alt="transport">
            <div class="transport-model__subtitle">{{$_SESSION['User']->transport}}</div>
          </div>
      </div>
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
