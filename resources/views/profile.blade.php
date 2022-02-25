<!DOCTYPE html>
<html>
<head>
    <title>Профиль</title>

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PageEditPoints/css/headerPages.css">
    <link rel="stylesheet" href="/PageEditPoints/css/footerPages.css">
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
    <!--------------HEADER-------------------->
    @include('Components.headerPages')
    <!--------------/HEADER-------------------->
    <div class="content__wrapper">
      <h1 class="profile__title">Профиль пользователя</h1>
      <div class="container">
        <div class="content__container">
          <div class="user">
            <img class="user__avatar" src="{{$_SESSION['User']->avatar}}" alt="avatar">
            <div class="user__name">{{$_SESSION['User']->name.' '.$_SESSION['User']->surname}}</div>
            <div class="user__grade"><img src="/PageProfile/img/cool-watermelon.svg" alt="">Мастер колеса</div>
          </div>
          <div class="user__info">
            <div class="user__rating">
              <div class="rating__title title">Рейтинг</div>
              <div class="rating__points">Набрано очков: <span>25</span></div>
              <div class="rating__level">Уровень: <span>Мастер колеса</span></div>
              <div class="rating__nextlevel">Следующий уровень</div>
              <div class="rating__nextlevel__progress"></div>
              <div class="rating__nextlevel__hint">Делитесь интересными местами, маршрутами, оценивайте и комментируйте существующие, чтобы зарабатывать очки опыта!</div>
            </div>
            <div class="achievements">
              <div class="achievements__title title">Активность</div>
              <div class="achievements__cards">
                <div class="point__count card">
                  <div class="card__count">
                    <img src="/PageProfile/img/point.svg" alt="point">
                    <div class="point__title title">{{$_SESSION['UserInfo']['points']}}</div>
                  </div>
                  <div class="point__subtitle">меток</div>
              </div>
              <div class="route__count card">
                <div class="card__count">
                  <img src="/PageProfile/img/route.svg" alt="route">
                  <div class="route__title title">{{$_SESSION['UserInfo']['routes']}}</div>
                </div>
                  <div class="route__subtitle">маршрутов</div>
              </div>
              <div class="feedback__count card">
                <div class="card__count">
                  <img src="/PageProfile/img/star.svg" alt="star">
                  <div class="feedback__title title">{{$_SESSION['UserInfo']['comments']}}</div>
                </div>
                  <div class="feedback__subtitle">отзывов</div>
              </div>
              </div>
          </div>
          <div class="transport-model">
            <div class="transport-model__title title">Модель транспорта</div>
            <div class="transport-model__type">KingSong 16S SPORTS 840WH</div>
          </div>
          </div>

        </div>
      </div>
    </div>
    <!--------------FOOTER-------------------->
    @include('Components.footer')
    <!--------------/FOOTER-------------------->
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
