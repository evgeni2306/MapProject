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
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
    <link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico"/>
    <link rel="stylesheet" href="/Script/leaflet/dist/leaflet.css"/>
    <script src="/Script/leaflet/dist/leaflet.js"></script>
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

    <div class="container">
        <div class="infoblock block">
            <div class="infoblock__info">
                <div class="infoblock__category">
                    <img src="/PagePointPersonal/img/{{$_SESSION['CurrentPoint']->type[0]}}" alt="category">
                    <span class="infoblock__category__name">{{$_SESSION['CurrentPoint']->type[1]}}</span>
                </div>
                <h1 class="point__title">{{$_SESSION['CurrentPoint']->name}}</h1>
                <div class="infoblock__rating">
                    <div class="infoblock__rating__title">Отзывы</div>
                    <img src="{{$_SESSION['CurrentPoint']->rating[0]}}" alt="rating">
                    <span class="infoblock__rating__feedback">({{$_SESSION['CurrentPoint']->rating[1]}})</span>
                </div>
                <div class="infoblock__address__title">Адрес</div>
                <div class="infoblock__address"><img src="/PagePointPersonal/img/04.svg">{{$_SESSION['CurrentPoint']->address}}</div>
                <div class="infoblock__user">
                    <span class="infoblock__user__add">Автор</span>
                    <img src="{{$_SESSION['CurrentPoint']->avatar}}" class="infoblock__user__photo" alt="">
                    <span class="infoblock__user__name">{{$_SESSION['CurrentPoint']->uname.' '.$_SESSION['CurrentPoint']->usurname}}</span>
                </div>
                @if(isset($_SESSION['User']))
                <div class="infoblock__button-edit"><a href="/editpoint={{$_SESSION['CurrentPoint']->id}}"><img src="/PagePointPersonal/img/pencil.svg" alt="">Редактировать</a></div>
                @endif
            </div>
            <div class="infoblock__slider">
                <div class="swiper">
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
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
            </div>
        </div>
        <div class="description-block block">
            <div class="description__title title">Описание</div>
            <div class="description">{{$_SESSION['CurrentPoint']->description}}</div>
        </div>
        <div class="location block">
            <div class="location__title title">Местоположение</div>
            <div id="map" class="location__map" style="width: 50%; height: 360px;"></div>
        </div>
        @if(isset($_SESSION['User']))
        <div class="feedback block">
            <div class="feedback__title title">Написать отзыв</div>
            <form class="feedback__form" method="Post" action ="{{route('AddPcomment')}}">
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
        </div>@endif
        <div class="comments-block block">
            <div class="comments__title title">Отзывы<span class="count__comments">{{$_SESSION['CurrentPoint']->rating[1]}}</span></div>
            <?foreach($_SESSION['Pcomments'] as $pcomment) {?>
            {{--  коммент--}}
          <div class="comments">
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
                        <img class="star-rating__star" src="/PageMap/img/stars/stars03.svg">
                    </div>
                </div>
                <div class="comment__text">{{$pcomment->text}}</div>
            </div>
              {{--  коммент--}}
              <? } ?>
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

	var socket = new Markers({iconUrl: '/PageMap/img/icons/socket.png'}),
		house = new Markers({iconUrl: '/PageMap/img/icons/house.png'});
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
