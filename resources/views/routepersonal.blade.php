<!DOCTYPE html>
<html>
<head>
    <title>Страница маршрута</title>

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PageEditPoints/css/headerPages.css">
    <link rel="stylesheet" href="/PageRoutePersonal/css/styles.css">
    <link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
          integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
          crossorigin=""/>
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
            integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
            crossorigin=""></script>
</head>
<body>
<div class="wrapper">
    <!--------------HEADER-------------------->
    @include('Components.headerPages')
    <!--------------/HEADER-------------------->
    <div class="container">
    <div class="infoblock__category__mobile">
        <img src="/PageMap/img/icons/route.svg" alt="category">
        <span class="infoblock__category__name">Маршрут</span>
    </div>
      <h1 class="point__title">Маршрут от цирка до Динамо</h1>
      <div class="infoblock">
        <div class="infoblock__rating">
            <img src="/PagePointPersonal/img/stars.svg" alt="rating">
            <span class="infoblock__rating__feedback">(35)</span>
        </div>
        <div class="infoblock__category">
            <img src="/PageMap/img/icons/route.svg" alt="category">
            <span class="infoblock__category__name">Маршрут</span>
        </div>
        <div class="infoblock__user">
            <span class="infoblock__user__add">добавил(-а)</span>
            <img src="/PagePointPersonal/img/06.svg" class="infoblock__user__photo" alt="">
            <span class="infoblock__user__name">Алексей Петров</span>
        </div>
      </div>
    <div id="map" class="information__map" style="width: 100%; height: 600px;"></div>
    <div class="information">
      <div class="information__description block">
        <div class="information__description__title block__title">Описание</div>
        <div class="information__description__text">Красивые маршрут поездка из одной части города в другую, В основном маршрут проходит по набережной, и парку, но есть места где приходится пересекать дорогу. Утром этим маршрутом езжу на работу, по времени приблизительно столько же сколько и на машине, через пробки, если срезать маршрут по проспекту Андропова, далее по Велозаводской, через Таганскую площадь и сразу на набережную Яузы, получится быстрее всего 55 мин, но часть маршрута будет проходить по проезжей части.</div>
      </div>
      <div class="information__parameters block">
        <div class="information__parameters__parameter">
          <div class="information__parameters__title">Протяженность</div>
          <div class="information__parameters__value"><img src="/PageRoutePersonal/img/icons/road.svg" alt="">24.6 км</div>
        </div>
        <div class="information__parameters__parameter">
          <div class="information__parameters__title">Время прохождения</div>
          <div class="information__parameters__value"><img src="/PageRoutePersonal/img/icons/time.svg" alt="">Примерно 1 час</div>
        </div>
        <div class="information__parameters__parameter">
          <div class="information__parameters__title">Сложность</div>
          <div class="information__parameters__value"><img src="/PageRoutePersonal/img/icons/middle.svg" alt="">Средняя</div>
        </div>
      </div>
    </div>
    <div class="feedback block">
        <form method="" action ="">
        <div class="feedback__title block__title">Написать отзыв</div>
        <p class="feedback__mark block__subtitle">Ваша оценка</p>
        <div class="feedback__rating">
            <div class="rating__items">
                <input id="rating__item__5" type="radio" class="rating__item" value="5" name="rating__item">
                <label for="rating__item__5" class="rating__label"></label>
                <input id="rating__item__4" type="radio" class="rating__item" value="4" name="rating__item">
                <label for="rating__item__4" class="rating__label"></label>
                <input id="rating__item__3" type="radio" class="rating__item" value="3" name="rating__item">
                <label for="rating__item__3" class="rating__label"></label>
                <input id="rating__item__2" type="radio" class="rating__item" value="2" name="rating__item">
                <label for="rating__item__2" class="rating__label"></label>
                <input id="rating__item__1" type="radio" class="rating__item" value="1" name="rating__item">
                <label for="rating__item__1" class="rating__label"></label>
            </div>
        </div>
        <div class="feedback__comment__subtitle block__subtitle">Комментарий</div>
        <div class="feedback__button__container">
            <textarea class="feedback__comment" maxlength="400" placeholder="Поделитесь своим опытом" name="comment"></textarea>
            <input type="submit" id="feedback__button" class="feedback__button__add" name="feedback__btn">
            <label for="feedback__button"><img src="/PagePointPersonal/img/05.svg" class="feedback__button__image">Добавить отзыв</label>
        </div>
        </form>
    </div>
      <!--<div class="comments-rating__wrapper">
        <div class="circle__rating__mobile">
        <div class="circle__rating__left">
            <img src="/PagePointPersonal/img/circlemobile.svg" alt="">
            <div class="circle__rating__title__mobile">35 отзывов</div>       
        </div>
        <div class="circle__rating__info">

        </div>
      </div>-->
      <div class="comments">
          <div class="comments__title">Отзывов: <span class="count__comments">2</span></div>
          <div class="comments__comment">
              <div class="comment__top">
                <div class="comment__user">
                    <img class="comment__user-avatar" src="/PagePointPersonal/img/06.svg" alt="user">
                    <div class="comment__user__content">
                        <div class="comment__user__name">Александр Иванов</div>
                        <div class="comment__user__date" id="time">22 августа 2021</div>
                    </div>
                </div>
                <div class="comment__rating">
                    <img class="star-rating__star" src="/PageMap/img/stars/stars03.svg">
                </div>
              </div>
              <div class="comment__text">Крупнейший художественный музей Урала, имеет два здания — главное расположено на берегу реки Исети в Екатеринбурге, в Историческом сквере города, второе на Вайнера, 11, где в 2021 году открылся культурно-выставочный центр «Эрмитаж-Урал» на берегу реки Исети</div>
              <div class="comment__bottom">
                  <span class="comment__bottom__useful">Было полезно?</span>
                  <button class="comment__like-icon" type="button"><img src="/PagePointPersonal/img/like.svg" alt="like"></button>
                  <div class="comment__like-count">0</div>
                  <!--<button class="comment__dislike-icon" type="button"><img src="/PagePointPersonal/img/dislike.svg" alt="dislike"></button>
                  <div class="comment__dislike-count">0</div>-->
              </div>
          </div>
          <div class="comments__comment">
              <div class="comment__top">
                <div class="comment__user">
                    <img class="comment__user-avatar" src="/PagePointPersonal/img/06.svg" alt="user">
                    <div class="comment__user__content">
                        <div class="comment__user__name">Александр Иванов</div>
                        <div class="comment__user__date" id="time">22 августа 2021</div>
                    </div>
                </div>
                <div class="comment__rating">
                    <img class="star-rating__star" src="/PageMap/img/stars/stars03.svg">
                </div>
              </div>
              <div class="comment__text">Крупнейший художественный музей Урала, имеет два здания — главное расположено на берегу реки Исети в Екатеринбурге, в Историческом сквере города, второе на Вайнера, 11, где в 2021 году открылся культурно-выставочный центр «Эрмитаж-Урал» на берегу реки Исети</div>
              <div class="comment__bottom">
                  <span class="comment__bottom__useful">Было полезно?</span>
                  <button class="comment__like-icon" type="button"><img src="/PagePointPersonal/img/like.svg" alt="like"></button>
                  <div class="comment__like-count">0</div>
                  <!--<button class="comment__dislike-icon" type="button"><img src="/PagePointPersonal/img/dislike.svg" alt="dislike"></button>
                  <div class="comment__dislike-count">0</div>-->
              </div>
          </div>
      </div>
      <!--<div class="circle__rating">
        <div class="circle__rating__top">
            <img src="/PagePointPersonal/img/circle.svg" alt="">
            <div class="circle__rating__info">
                <div class="circle__rating__title">35 отзывов</div>
                <div class="circle__rating__subtitle">32 из 35 пользователей рекомендуют это место для посещения</div>
            </div>       
        </div>
        <div class="circle__rating__bottom"></div>
      </div>-->
    </div>          
    </div>
    <!--------------FOOTER-------------------->
    @include('Components.footer')
    <!--------------/FOOTER-------------------->
</div>  
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>  
<script>
/*-------------MAP------------------------------*/
    var map = L.map('map').setView([56.826, 60.65], 13);

	var tiles = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		maxZoom: 18,
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
			'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox/streets-v11',
		tileSize: 512,
		zoomOffset: -1
	}).addTo(map);

    var Markers = L.Icon.extend({
		options: {
			iconSize: [39, 45],
			iconAnchor: [16,37]
		}
	});

	var socket = new Markers({iconUrl: '/PageMap/img/icons/socket.png'}),
		house = new Markers({iconUrl: '/PageMap/img/icons/house.png'});
/*---------------SWIPER-------------------------*/
    new Swiper('.image-slider', {
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
        },

        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            dynamicBullets: true,
        },
    });
/*---------------LIKES-------------------------*/
    const likeButtons = Array.from(document.querySelectorAll(".comment__like-icon"));
    const likeCounts = Array.from(document.querySelectorAll(".comment__like-count"));

    likeButtons.forEach((button, index) => {
        button.addEventListener("click", () => {
            button.classList.toggle("like-active");
            likeCounts[index].classList.toggle("like-active__count");
            const current = Number(likeCounts[index].innerHTML);
            const inc = button.classList.contains("like-active") ? 1 : -1;
            likeCounts[index].innerHTML = current + inc;
        });
    });

    /*const dislikeButtons = Array.from(document.querySelectorAll(".comment__dislike-icon"));
    const dislikeCounts = Array.from(document.querySelectorAll(".comment__dislike-count"));

    dislikeButtons.forEach((button, index) => {
        button.addEventListener("click", () => {
            button.classList.toggle("dislike-active");
            dislikeCounts[index].classList.toggle("like-active__count");
            const current = Number(dislikeCounts[index].innerHTML);
            const inc = button.classList.contains("dislike-active") ? 1 : -1;
            dislikeCounts[index].innerHTML = current + inc;
        });
    });*/
/*---------------------------------------------*/
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
