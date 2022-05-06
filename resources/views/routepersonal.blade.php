<!DOCTYPE html>
<html>
<head>
    <title>Страница маршрута</title>

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PageEditPoints/css/headerPages.css">
    <link rel="stylesheet" href="/PageEditPoints/css/footerPages.css">
    <link rel="stylesheet" href="/PageRoutePersonal/css/styles.css">
    <link rel="shortcut icon" type="image/x-icon" href="../favicon.png"/>
    <link rel="stylesheet" href="/Script/leaflet/dist/leaflet.css"/>
    <script src="/Script/leaflet/dist/leaflet.js"></script>
</head>
<body>
<div class="wrapper">
    <!--------------HEADER-------------------->
@include('Components.headerPages')
<!--------------/HEADER-------------------->
    <div class="container">
        {{--Блок с инфой--}}
        <div class="infoblock block">
            <h1 class="route__title">{{$_SESSION['CurrentRoute']->name}}</h1>
            <div class="infoblock__info">
                <div class="infoblock__rating">
                    <div class="infoblock__rating__title">Отзывы</div>
                    <img src="{{$_SESSION['CurrentRoute']->rating[0]}}" alt="rating">
                    <span class="infoblock__rating__feedback">({{$_SESSION['CurrentRoute']->rating[1]}})</span>
                </div>
                <div class="infoblock__status-block">
                    <div class="infoblock__status__title">Статус работы</div>
                    <div class="infoblock__status">{{$_SESSION['CurrentRoute']->status}}</div>
                </div>
                <div class="infoblock__user">
                    <span class="infoblock__user__add">Автор</span>
                    <img src="{{$_SESSION['CurrentRoute']->avatar}}" class="infoblock__user__photo" alt="">
                    <span
                        class="infoblock__user__name">{{$_SESSION['CurrentRoute']->uname.' '.$_SESSION['CurrentRoute']->usurname}}</span>
                </div>
                <div class="infoblock__button-edit"><a href=""><img src="/PagePointPersonal/img/pencil.svg" alt="">Редактировать</a>
                </div>
            </div>
            <div id="map" class="information__map" style="width: 100%; height: 600px;"></div>
        </div>
        <div class="data-block block">
            <div class="data-block__title title">Данные о маршруте</div>
            <div class="data">
                <div class="complexity">
                    <div class="complexity__title">Сложность</div>
                    <img src="/PageRoutePersonal/img/icons/middle.svg" alt="middle">
                    <p class="complexity__name">{{$_SESSION['CurrentRoute']->difficult}}</p>
                </div>
                <div class="length">
                    <div class="length__title">Протяженность</div>
                    <img src="/PageRoutePersonal/img/icons/road.svg" alt="road">
                    <p class="length__distance">{{$_SESSION['CurrentRoute']->distance}}</p>
                </div>
                <div class="time">
                    <div class="time__title">Время прохождения</div>
                    <img src="/PageRoutePersonal/img/icons/time.svg" alt="time">
                    <p class="time__duration">{{$_SESSION['CurrentRoute']->time}}</p>
                </div>
            </div>
        </div>
        <div class="description-block block">
            <div class="description__title title">Описание</div>
            <div class="description">{{$_SESSION['CurrentRoute']->description}}</div>
        </div>
        {{--Блок с инфой--}}

        {{--Блок для отзывов--}}
        <div class="feedback block">
            <div class="feedback__title title">Написать отзыв</div>
            <form class="feedback__form" method="Post" action="{{route('AddRcomment')}}">
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
                    <textarea class="feedback__comment" maxlength="400" placeholder="Поделитесь своим опытом"
                              name="text"></textarea>
                    <input type="submit" id="feedback__button" class="feedback__button__add" name="feedback__btn">
                    <label for="feedback__button"><img src="/PagePointPersonal/img/05.svg"
                                                       class="feedback__button__image">Добавить отзыв</label>
                    @csrf
                </div>
            </form>
        </div>
        <div class="comments-block block">
            <div class="comments__title title">Отзывы<span class="count__comments">{{$_SESSION['CurrentRoute']->rating[1]}}</span></div>
            <div class="comments">
                {{--Коммент--}}
                <?foreach($_SESSION['Rcomments'] as $rcomment) {?>
                <div class="comments__comment">
                    <div class="comment__top">
                        <div class="comment__user">
                            <img class="comment__user-avatar" src="{{$rcomment->avatar}}" alt="user">
                            <div class="comment__user__content">
                                <div class="comment__user__name">{{$rcomment->name.' '.$rcomment->surname}}</div>
                                <div class="comment__user__date" id="time">{{$rcomment->created_at}}</div>
                            </div>
                        </div>
                        <div class="comment__rating">
                            <img class="star-rating__star" src="{{$rcomment->rating}}">
                        </div>
                    </div>
                    <div class="comment__text">{{$rcomment->text}}
                    </div>
{{--                    <div class="comment__bottom">--}}
{{--                        <span class="comment__bottom__useful">Было полезно?</span>--}}
{{--                        <button class="comment__like-icon" type="button"><img src="/PagePointPersonal/img/like.svg" alt="like"></button>--}}
{{--                        <div class="comment__like-count">0</div>--}}
{{--                    </div>--}}
                </div>
                <? }?>
                {{--Коммент--}}
            </div>
        </div>
        {{--Блок для отзывов--}}

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

    @if(isset($_SESSION['User']))
    var tiles = L.tileLayer('{{$_SESSION['User']->mapstyle}}', {
        @endif
            @if(!isset($_SESSION['User']))
        var tiles = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            @endif
            //-----------------
            maxZoom: 18,
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
                'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1
        }).addTo(map);

        var rout = L.polyline({weight: 55, color: 'red'}).addTo(map);
//-------------Вывод маршрутов на карту-----------------
        <?    foreach ($_SESSION['CurrentRoute']->rpoints as $rpoint){?>

        rout.addLatLng([{{$rpoint->lat}},{{$rpoint->lng}}]);
        <?}?>
        //-------------------------------------------------------

    var Markers = L.Icon.extend({
        options: {
            iconSize: [39, 45],
            iconAnchor: [16, 37]
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
</script>
</body>
</html>
