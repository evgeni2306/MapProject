<!DOCTYPE html>
<html>
<head>
    <title>Страница метки</title>

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PageEditPoints/css/headerPages.css">
    <link rel="stylesheet" href="/PageEditPoints/css/footerPages.css">
    <link rel="stylesheet" href="/PagePointPersonal/css/styles.css">
    <link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico"/>
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="/Script/leaflet/dist/leaflet.css"/>
    <script src="/Script/leaflet/dist/leaflet.js"></script>
</head>
<body>
<div class="wrapper">
    <!--------------HEADER-------------------->
    @include('Components.headerPages')
    <!--------------/HEADER-------------------->

    <div class="container">
        <div class="infoblock block">
            <div class="infoblock__info">
                <div class="infoblock__category">
                    <img src="/PagePointPersonal/img/building.svg" alt="category">
                    <span class="infoblock__category__name">Достопримечательность</span>
                </div>
                <h1 class="point__title">Художественный музей</h1>
                <div class="infoblock__rating">
                    <div class="infoblock__rating__title">Отзывы</div>
                    <img src="/PagePointPersonal/img/stars.svg" alt="rating">
                    <span class="infoblock__rating__feedback">(35)</span>
                </div>
                <div class="infoblock__address__title">Адрес</div>
                <div class="infoblock__address"><img src="/PagePointPersonal/img/04.svg">ул. Авиационная, 123</div>
                <div class="infoblock__user">
                    <span class="infoblock__user__add">Автор</span>
                    <img src="/PagePointPersonal/img/06.svg" class="infoblock__user__photo" alt="">
                    <span class="infoblock__user__name">Алексей Петров</span>
                </div>
                <div class="infoblock__button-edit"><a href="{{route('editpoints')}}"><img src="/PagePointPersonal/img/pencil.svg" alt="">Редактировать</a></div>
            </div>
            <div class="infoblock__slider">
                <div class="swiper">
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
                <div class="image-slider swiper-container">
                    <div class="image-slider__wrapper swiper-wrapper">
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
            </div>
        </div>
        <div class="description-block block">
            <div class="description__title title">Описание</div>
            <div class="description">Крупнейший художественный музей Урала, имеет два здания — главное расположено на берегу реки Исети в Екатеринбурге, в Историческом сквере города, второе на Вайнера, 11, где в 2021 году открылся культурно-выставочный центр «Эрмитаж-Урал».</div>
        </div>
        <div class="location block">
            <div class="location__title title">Местоположение</div>
            <div id="map" class="location__map" style="width: 50%; height: 360px;"></div>
        </div>
        <div class="feedback block">
            <div class="feedback__title title">Написать отзыв</div>
            <form class="feedback__form" method="" action ="">
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
        <div class="feedback__button__container">
            <textarea class="feedback__comment" maxlength="400" placeholder="Поделитесь своим опытом" name="comment"></textarea>
            <input type="submit" id="feedback__button" class="feedback__button__add" name="feedback__btn">
            <label for="feedback__button"><img src="/PagePointPersonal/img/05.svg" class="feedback__button__image">Добавить отзыв</label>
        </div>
        </form>
        </div>
        <div class="comments-block block">
            <div class="comments__title title">Отзывы<span class="count__comments">2</span></div>
            <div class="comments">
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
                <div class="comment__text">Крупнейший художественный музей Урала, имеет два здания — главное расположено на берегу реки Исети в Екатеринбурге, в Историческом сквере города, второе на Вайнера, 11, где в 2021 году открылся культурно-выставочный центр «Эрмитаж-Урал» на берегу реки Исети</div>
                <div class="comment__bottom">
                    <span class="comment__bottom__useful">Было полезно?</span>
                    <button class="comment__like-icon" type="button"><img src="/PagePointPersonal/img/like.svg" alt="like"></button>
                    <div class="comment__like-count">0</div>
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
                <div class="comment__text">Крупнейший художественный музей Урала, имеет два здания — главное расположено на берегу реки Исети в Екатеринбурге, в Историческом сквере города, второе на Вайнера, 11, где в 2021 году открылся культурно-выставочный центр «Эрмитаж-Урал» на берегу реки Исети</div>
                <div class="comment__bottom">
                    <span class="comment__bottom__useful">Было полезно?</span>
                    <button class="comment__like-icon" type="button"><img src="/PagePointPersonal/img/like.svg" alt="like"></button>
                    <div class="comment__like-count">0</div>
                </div>
            </div>
        </div>
        </div>
    </div>
    </div>
    </div>
    <!--------------FOOTER-------------------->
    @include('Components.footer')
    <!--------------/FOOTER-------------------->
</div>
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<script src="Script/menu.js"></script>
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
