<!DOCTYPE html>
<html>
<head>
    <title>Страница метки</title>

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <nav class="user-menu"> 
                <ul class="user-menu__list">
                    <li class="user-name">
                        <img  class="avatar" src="/PageMap/img/user/user.png" alt="user">
                        <a href="#" class="user-menu__link" tabindex="1">Александр Иванов</a><span class="menu__arrow"></span>
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
      <h1 class="point__title">Музей изобразительных искусств</h1>
      <div class="infoblock">
        <div class="infoblock__rating">
            <img src="/PagePointPersonal/img/stars.svg" alt="rating">
            <span class="infoblock__rating__count">4.8</span>
            <span class="infoblock__rating__feedback">(35)</span>
        </div>
        <div class="infoblock__category">
            <img src="/PagePointPersonal/img/building.svg" alt="category">
            <span class="infoblock__category__name">Достопримечательность</span>
        </div>
        <div class="infoblock__user">
            <span class="infoblock__user__add">добавил(-а)</span>
            <img src="/PagePointPersonal/img/06.svg" class="infoblock__user__photo" alt="">
            <span class="infoblock__user__name">Алексей Петров</span>
        </div>
      </div>
      <div class="swiper">
        <div class="image-slider swiper-container">
            <div class="image-slider__wrapper swiper-wrapper">
                <div class="image-slider__slide swiper-slide">
                    <div class="image-slider__image">
                        <img src="/PagePointPersonal/img/slider.png" alt="">
                    </div>
                </div>
                <div class="image-slider__slide swiper-slide">
                    <div class="image-slider__image">
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

        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>

        <div class="swiper-scrollbar"></div>
      </div>
      <div class="information block">
        <div class="information__title block__title">Информация</div>
        <div class="information__description">Крупнейший художественный музей Урала, имеет два здания — главное расположено на берегу реки Исети в Екатеринбурге, в Историческом сквере города, второе на Вайнера, 11, где в 2021 году открылся культурно-выставочный центр «Эрмитаж-Урал».</div>
        <div class="information__address__title">Адрес</div>
        <div class="information__address"><img src="/PagePointPersonal/img/04.svg">ул. Авиационная, 123</div>
      </div>
      <div class="feedback block">
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
            <textarea class="feedback__comment" placeholder="Поделитесь своим опытом" name="comment"></textarea>
            <input type="submit" id="feedback__button" class="feedback__button__add" name="feedback__btn">
            <label for="feedback__button"><img src="/PagePointPersonal/img/05.svg" class="feedback__button__image">Добавить отзыв</label>
        </div>
      </div>
    </div>
    <footer class="footer">
      <div class="footer__logo"><img src="/PageRegistration/img/logo.svg" alt="logo"></div>
      <div class="footer__rights">@Название 2021. Все права защищены</div>
      <div class="footer__contacts">Контакты</div>
    </footer>
</div>  
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>  
<script>
/*---------------SWIPER-------------------------*/
    new Swiper('.image-slider', {
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
        },
    });
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
