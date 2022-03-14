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
      <h1 class="profile__title">Мой профиль</h1>
        <div class="content__container">
          <div class="user">
            <img class="user__avatar" src="/PageProfile/img/avatar.png" alt="avatar">
            <div class="user__name">Александр Иванов</div>
            <div class="user__grade"><img src="/PageProfile/img/cool-watermelon.svg" alt="">Мастер колеса</div>
          </div>
          <div class="user__info">
            <div class="user__rating">
              <div class="rating__title title">Рейтинг</div>
              <div class="rating__points">Набрано очков: <span class="points">63</span></div>
              <div class="rating__level">Уровень: <span>Мастер колеса</span></div>
              <div class="rating__nextlevel">
                <div class="nextlevel">Следующий уровень</div>
                <div class="points-received">
                  <span class="points">63</span>/<span class="target">100</span>
                </div>
              </div>
              <div class="rating__nextlevel__progress">                
                <div class="progress-bar">
                  <div class="percent-count"></div>
                </div>
              </div>
              <div class="rating__nextlevel__hint">Делитесь интересными местами, маршрутами, оценивайте и комментируйте существующие, чтобы зарабатывать очки опыта!</div>
            </div>
            <div class="achievements">
              <div class="achievements__title title">Активность</div>
              <div class="achievements__cards">
                <div class="point__count card">
                  <div class="card__count">
                    <img src="/PageProfile/img/point.svg" alt="point">
                    <div class="point__title title">5</div>
                  </div>
                <div class="point__subtitle">меток</div>
            </div>
            <div class="route__count card">
              <div class="card__count">
                <img src="/PageProfile/img/route.svg" alt="route">
                <div class="route__title title">1</div>
              </div>
              <div class="route__subtitle">маршрутов</div>
              </div>
              <div class="feedback__count card">
                <div class="card__count">
                  <img src="/PageProfile/img/star.svg" alt="star">
                  <div class="feedback__title title">16</div>
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
    <!--------------FOOTER-------------------->
    @include('Components.footer')
    <!--------------/FOOTER-------------------->
</div>
<script src="Script/menu.js"></script>    
<script>
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
let points = document.querySelector('.points').textContent;
const progress = document.querySelector('.progress-bar');
let percent = document.querySelector('.percent-count');
setTimeout(() => {
  progress.style.opacity = 1;
  progress.style.width = points + '%';
  percent.textContent = points + '%';
})
</script>
</body>
</html>
