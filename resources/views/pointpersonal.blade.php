<!DOCTYPE html>
<html>
<head>
    <title>Страница метки</title>

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PageUnauthorizedMap/css/headerUnauthPages.css">
    <link rel="stylesheet" href="/PageEditPoints/css/headerPages.css">
    <link rel="stylesheet" href="/PageEditPoints/css/footerPages.css">
    <link rel="stylesheet" href="/PagePointPersonal/css/styles.css">
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
    @if(isset($_SESSION['User']))
    <!--------------HEADER-------------------->
        @include('Components.headerPages')
<!--------------/HEADER-------------------->
    @endif

    @if(!isset($_SESSION['User']))
        <!--------------HEADER-------------------->
        @include('Components.headerUnauthPages')
        <!--------------/HEADER-------------------->
        @endif
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
    <div class="container">
        <div class="infoblock__category__mobile">
            <img src="/PagePointPersonal/img/{{$_SESSION['CurrentPoint']->type[0]}}" alt="category">
            <span class="infoblock__category__name">{{$_SESSION['CurrentPoint']->type[1]}}</span>
        </div>
        <h1 class="point__title">{{$_SESSION['CurrentPoint']->name}}</h1>
        <div class="infoblock">
            <div class="infoblock__rating">
                <img src="{{$_SESSION['CurrentPoint']->rating[0]}}" alt="rating">
                <span class="infoblock__rating__feedback">{{$_SESSION['CurrentPoint']->rating[1]}}</span>
            </div>
            <div class="infoblock__category">
                <img src="/PagePointPersonal/img/{{$_SESSION['CurrentPoint']->type[0]}}" alt="category">
                <span class="infoblock__category__name">{{$_SESSION['CurrentPoint']->type[1]}}</span>
            </div>
            <div class="infoblock__user">
                <span class="infoblock__user__add">добавил(-а)</span>
                <img src="{{$_SESSION['CurrentPoint']->avatar}}" class="infoblock__user__photo" alt="">
                <span class="infoblock__user__name">{{$_SESSION['CurrentPoint']->uname.' '.$_SESSION['CurrentPoint']->usurname}}</span>
            </div>
      </div>
      <div class="swiper">
        <div class="image-slider swiper-container">
            <div class="image-slider__wrapper swiper-wrapper">
                <div class="image-slider__slide swiper-slide">
                    <div class="image-slider__image">
                        <img src="{{$_SESSION['CurrentPoint']->photo}}" alt="">
                    </div>
                </div>
                <div class="image-slider__slide swiper-slide">
                    <div class="image-slider__image">
                        <img src="/PagePointPersonal/img/slider.png" alt="">
                    </div>
                </div>
                <div class="image-slider__slide swiper-slide">
                    <div class="image-slider__image">
                        <img src="/PagePointPersonal/img/slider.png" alt="">
                    </div>
                </div>
            </div>
        </div>

        <div class="swiper-pagination"></div>

        <div class="swiper-scrollbar"></div>
      </div>
        <div class="information block">
            <div class="information__content">
                <div class="information__title block__title">Информация</div>
                <div class="information__description">{{$_SESSION['CurrentPoint']->description}}</div>
                <div class="information__address__title">Адрес</div>
                <div class="information__address"><img src="/PagePointPersonal/img/04.svg">{{$_SESSION['CurrentPoint']->address}}</div>
            </div>
            <div id="map" class="information__map" style="width: 520px; height: 360px;"></div>
        </div>
        @if(isset($_SESSION['User']))
    <div class="feedback block">
        <form method="Post" action ="{{route('AddPcomment')}}">
            <div class="feedback__title block__title">Написать отзыв</div>
            <p class="feedback__mark block__subtitle">Ваша оценка</p>
            <div class="feedback__rating">
                <div class="rating__items">
                    <input id="rating__item__5" type="radio" class="rating__item" value="5" name="rating">
                    <label for="rating__item__5" class="rating__label"></label>
                    <input id="rating__item__4" type="radio" class="rating__item" value="4" name="rating">
                    <label for="rating__item__4" class="rating__label"></label>
                    <input id="rating__item__3" type="radio" class="rating__item" value="3" name="rating">
                    <label for="rating__item__3" class="rating__label"></label>
                    <input id="rating__item__2" type="radio" class="rating__item" value="2" name="rating">
                    <label for="rating__item__2" class="rating__label"></label>
                    <input id="rating__item__1" type="radio" class="rating__item" value="1" name="rating">
                    <label for="rating__item__1" class="rating__label"></label>
                </div>
            </div>
            <div class="feedback__comment__subtitle block__subtitle">Комментарий</div>
            @csrf
            <div class="feedback__button__container">
                <textarea class="feedback__comment" maxlength="400" placeholder="Поделитесь своим опытом" name="text"></textarea>
                <input type="submit" id="feedback__button" class="feedback__button__add" name="feedback__btn">
                <label for="feedback__button"><img src="/PagePointPersonal/img/05.svg" class="feedback__button__image">Добавить отзыв</label>
            </div>
        </form>
    </div>
        @endif

      <div class="comments">
          <div class="comments__title">Отзывов:  <span class="count__comments">{{$_SESSION['CurrentPoint']->rating[1]}}</span></div>
          <?foreach($_SESSION['Pcomments'] as $pcomment) {?>
          <div class="comments__comment">
              <div class="comment__top">
                  <div class="comment__user">
                      <img class="comment__user-avatar" src="{{$pcomment->avatar}}" alt="user">
                      <div class="comment__user__content">
                          <div class="comment__user__name">{{$pcomment->name.' '.$pcomment->surname}}</div>
                          <div class="comment__user__date" id="time">{{$pcomment->created_at}}</div>
                      </div>
                  </div>
                  <div class="comment__rating">
                      <img class="star-rating__star" src="{{$pcomment->rating}}">
                  </div>
              </div>
              <div class="comment__text">{{$pcomment->text}}</div>

          </div>
          <? } ?>

      </div>

    </div>
    </div>
<!--------------FOOTER-------------------->
@include('Components.footer')
<!--------------/FOOTER-------------------->
</div>
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<script>
    /*-------------MAP------------------------------*/
    var map = L.map('map').setView([{{$_SESSION['CurrentPoint']->lat}}, {{$_SESSION['CurrentPoint']->lng}}], 15);

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

    var socket = new Markers({iconUrl: '/PageMap/img/icons/01.png'}),
        house = new Markers({iconUrl: '/PageMap/img/icons/02.png'});
    L.marker([{{$_SESSION['CurrentPoint']->lat}}, {{$_SESSION['CurrentPoint']->lng}}],{icon: {{$_SESSION['CurrentPoint']->icon}}} ).addTo(map);
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
