<!DOCTYPE html>
<html>
<head>
    <title>Страница маршрута</title>

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PageUnauthorizedMap/css/headerUnauthPages.css">
    <link rel="stylesheet" href="/PageEditPoints/css/headerPages.css">
    <link rel="stylesheet" href="/PageEditPoints/css/footerPages.css">
    <link rel="stylesheet" href="/PageRoutePersonal/css/styles.css">
    <link rel="shortcut icon" type="image/x-icon" href="../favicon.png"/>
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
            <div class="infoblock__category">
                <img src="/PageMap/img/icons/route.svg" alt="category">
                <span class="infoblock__category__name">Маршрут</span>
            </div>
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
                <div class="infoblock__city-block">
                    <div class="infoblock__city__title">Город</div>
                    <div class="infoblock__city">{{$_SESSION['CurrentRoute']->city}}</div>
                </div>
                <div class="infoblock__user">
                    <span class="infoblock__user__add">Автор</span>
                    <img src="{{$_SESSION['CurrentRoute']->avatar}}" class="infoblock__user__photo" alt="">
                    <span class="infoblock__user__name"><a href="{{route('profile',$_SESSION['CurrentRoute']->creatorid)}}" class="user-profile__link">{{$_SESSION['CurrentRoute']->nickname}}</a></span>
                </div>

                @if(isset($_SESSION['User']))
                    @if($_SESSION['User']->id == $_SESSION['CurrentRoute']->creatorid or $_SESSION['User']->rankid >=3)
                    <div class="infoblock__button-edit"><a href="{{route('UpdateRoute',$_SESSION['CurrentRoute']->id)}}"><img src="/PagePointPersonal/img/pencil.svg" alt="">Редактировать</a></div>
                    @endif
                @endif
            </div>
            <div id="map" class="information__map"></div>
        </div>
        <div class="data-block block">
            <div class="data-block__title title">Данные о маршруте</div>
            <div class="data">
                <div class="complexity">
                    <div class="complexity__title">Сложность</div>
                    <img src="/PageRoutePersonal/img/icons/{{$_SESSION['CurrentRoute']->icon}}.svg" alt="middle"><p class="complexity__name">{{$_SESSION['CurrentRoute']->difficult}}</p>
                </div>
                <div class="length">
                    <div class="length__title">Протяженность</div>
                    <img src="/PageRoutePersonal/img/icons/road.svg" alt="road"><p class="length__distance">{{$_SESSION['CurrentRoute']->distance}}</p>
                </div>
                <div class="time">
                    <div class="time__title">Время прохождения</div>
                    <img src="/PageRoutePersonal/img/icons/time.svg" alt="time"><p class="time__duration">{{$_SESSION['CurrentRoute']->time}}</p>
                </div>
            </div>
        </div>
        <div class="description-block block">
            <div class="description__title title">Описание</div>
            <div class="description">{{$_SESSION['CurrentRoute']->description}}</div>
        </div>
{{--        Редактирование коммента--}}
        <div class="modal">
            <div class="edit-popup">
                <div class="edit-popup__close"><img src="/PagePointPersonal/img/close.svg" alt="close"></div>
                <div class="edit-popup__title title">Редактирование отзыва</div>
                <form method="" action="">
                    <p class="feedback__mark block__subtitle">Ваша оценка</p>
                    <div class="feedback__rating">
                        <div class="rating__items">
                            <input id="rating__items__5" type="radio" class="rating__item" value="5" name="rating">
                            <label for="rating__items__5" class="rating__label"></label>
                            <input id="rating__items__4" type="radio" class="rating__item" value="4" name="rating">
                            <label for="rating__items__4" class="rating__label"></label>
                            <input id="rating__items__3" type="radio" class="rating__item" value="3" name="rating">
                            <label for="rating__items__3" class="rating__label"></label>
                            <input id="rating__items__2" type="radio" class="rating__item" value="2" name="rating">
                            <label for="rating__items__2" class="rating__label"></label>
                            <input id="rating__items__1" type="radio" class="rating__item" value="1" name="rating">
                            <label for="rating__items__1" class="rating__label"></label>
                        </div>
                    </div>
                    <div class="feedback__comment__subtitle block__subtitle">Комментарий</div>
                    @csrf
                    <textarea class="comment__text-edit" contenteditable="true"></textarea>
                    <div class="edit-buttons">
                        <input type="submit" class="edit__save" value ="Сохранить">
                    </div>
                </form>
            </div>
        </div>
{{--        --}}
        @if($_SESSION['CurrentRoute']->canAddComment == true)

        <div class="feedback block">
            <div class="feedback__title title">Написать отзыв</div>
            <form class="feedback__form" method="Post" action ="{{route('AddRcomment')}}">
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
            <textarea class="feedback__comment" maxlength="400" placeholder="Поделитесь своим опытом" name="text"></textarea>
            <input type="submit" id="feedback__button" class="feedback__button__add" name="feedback__btn">
            <label for="feedback__button"><img src="/PagePointPersonal/img/05.svg" class="feedback__button__image">Добавить отзыв</label>
       @csrf
        </div>
        </form>
        </div>
        @endif
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
                                <div class="comment__user__name"><a href="{{route('profile',$rcomment->creatorid)}}" class="user-profile__link">{{$rcomment->nickname}}</a><span class="user__rang">{{$rcomment->rname}} <span class="user__rang-points">{{$rcomment->urate}}</span></span></div>

                            </div>
                        </div>
                        <div class="comment__rating">
                            <img class="star-rating__star"  src="{{$rcomment->rating[1]}}">
                            <div class="comment__user__date" id="time">{{$rcomment->created_at}}</div>
                        </div>
                    </div>
                    <div class="comment__text" contenteditable="false">{{$rcomment->text}}</div>
                    <div class="comment__bottom">
                        @if(isset($_SESSION['User']))
                        @if($_SESSION['User']->id == $rcomment->creatorid)
                        <div class="comment__bottom__buttons">
                            <button class="comment-edit"><img src="/PagePointPersonal/img/edit.svg" alt="edit"></button>
                            <a href="#" class="comment-delete"><img src="/PagePointPersonal/img/trash.svg" alt="trash"></a>
                        </div>
                            @endif
                        @endif
                    </div>
                <? }?>
        </div>
        </div>
    </div>
    </div>
    </div>
    <!--------------FOOTER-------------------->
    @include('Components.footer')
    <!--------------/FOOTER-------------------->
</div>
@if(isset($_SESSION['User']))
    <!--------------MENU-------------------->
    <script src="Script/menu.js"></script>
    <!--------------MENU-------------------->
@endif
@if(!isset($_SESSION['User']))
    <!--------------MENU-------------------->
    <script src="Script/menuUnauth.js"></script>
    <!--------------MENU-------------------->
@endif
<script>
    var map = L.map('map').setView([{{$_SESSION['CurrentRoute']->rpoints[0]->lat}}, {{$_SESSION['CurrentRoute']->rpoints[0]->lng}}], 13);

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
        var Markers = L.Icon.extend({
            options: {
                iconSize: [39, 45],
                iconAnchor: [16, 37]
            }
        });

        var socket = new Markers({iconUrl: '/PageMap/img/icons/socket.png'});
        var house = new Markers({iconUrl: '/PageMap/img/icons/house.png'});
        var insocket = new Markers({iconUrl: '/PageMap/img/icons/socketinactive.svg'});
        var inhouse = new Markers({iconUrl: '/PageMap/img/icons/houseinactive.svg'});
        //-------------Вывод маршрутa на карту-----------------
        <?    foreach ($_SESSION['CurrentRoute']->rpoints as $rpoint){?>

        rout.addLatLng([{{$rpoint->lat}},{{$rpoint->lng}}]);
        <?}?>
        //-------------------------------------------------------

        //---------------Вывод точек на карту--------------------
        <?foreach ($_SESSION['CurrentRoute']->pointsnear as $point ) {?>

    L.marker([{{$point->lat}}, {{$point->lng}}], {icon: {{$point->icon}}}).bindPopup(
            '<div class="marker__container">' +
            '<div class="marker__title"><a href="/point={{$point->id}}" class="marker__link">{{$point->name}}</a></div>' +
            '<div class="short-description">{{$point->shortdescription}}</div>' +
            '<div class="star-rating star-rating_set">' +
            '<div class="star-rating__body">' +
            '<img class="star-rating__star" src="{{$point->rating}}">'+
            '<span class="star-rating__feedback">()</span>'+
            '</div>'+
            '</div>'+
            '<div class="marker__address">{{$point->address}}</div>' +
            '<div class="marker-status status-unknown">Статус : {{$point->status}}</div>' +
            '<div class="marker__photo__container">'+
            '<img class="marker__photo" src="{{$point->photo}}" alt="object">'+
            '</div>'+
            '</div>').addTo(map);

    <? }?>
    //-------------------------------------------------------
        /*------------------EDIT-COMMENT---------------------*/
        let modal = document.querySelector('.modal');
        let editPopup = document.querySelector('.edit-popup');
        let popupCloseButton = document.querySelector('.edit-popup__close');
        let editButton = document.querySelector('.comment-edit');
        let commentText = document.querySelector('.comment__text');
        let commentTextEdit = document.querySelector('.comment__text-edit');
        editButton.addEventListener('click', function () {
            modal.classList.toggle('is-open');
            editPopup.classList.toggle('is-open');
            //передача текста коммента в инпут
            commentTextEdit.value = commentText.textContent;
        });
        popupCloseButton.addEventListener('click', function () {
            modal.classList.toggle('is-open');
            editPopup.classList.toggle('is-open');
        });
</script>
</body>
</html>
