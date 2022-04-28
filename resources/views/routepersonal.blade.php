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
      <h1 class="point__title">{{$_SESSION['CurrentRoute']->name}}</h1>
      <div class="infoblock">
        <div class="infoblock__rating">
            <img src="{{$_SESSION['CurrentRoute']->rating[0]}}" alt="rating">
            <span class="infoblock__rating__feedback">{{$_SESSION['CurrentRoute']->rating[1]}}</span>
        </div>
        <div class="infoblock__category">
            <img src="/PageMap/img/icons/route.svg" alt="category">
            <span class="infoblock__category__name">Маршрут</span>
        </div>
        <div class="infoblock__user">
            <span class="infoblock__user__add">добавил(-а)</span>
            <img src="/PagePointPersonal/img/06.svg" class="infoblock__user__photo" alt="">
            <span class="infoblock__user__name">{{$_SESSION['CurrentRoute']->uname.' '.$_SESSION['CurrentRoute']->usurname}}</span>
        </div>
      </div>
    <div id="map" class="information__map" style="width: 100%; height: 600px;"></div>
    <div class="information">
      <div class="information__description block">
        <div class="information__description__title block__title">Описание</div>
        <div class="information__description__text">{{$_SESSION['CurrentRoute']->description}}</div>
      </div>
      <div class="information__parameters block">
        <div class="information__parameters__parameter">
          <div class="information__parameters__title">Протяженность</div>
          <div class="information__parameters__value"><img src="/PageRoutePersonal/img/icons/road.svg" alt="">{{$_SESSION['CurrentRoute']->distance}}</div>
        </div>
        <div class="information__parameters__parameter">
          <div class="information__parameters__title">Время прохождения</div>
          <div class="information__parameters__value"><img src="/PageRoutePersonal/img/icons/time.svg" alt="">{{$_SESSION['CurrentRoute']->time}}</div>
        </div>
        <div class="information__parameters__parameter">
          <div class="information__parameters__title">Сложность</div>
          <div class="information__parameters__value"><img src="/PageRoutePersonal/img/icons/middle.svg" alt="">{{$_SESSION['CurrentRoute']->difficult}}</div>
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

      <div class="comments">
          <div class="comments__title">Отзывов: <span class="count__comments">{{$_SESSION['CurrentRoute']->rating[1]}}</span></div>
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
              <div class="comment__text">{{$rcomment->description}}</div>
              <div class="comment__bottom">
                  <span class="comment__bottom__useful">Было полезно?</span>
                  <button class="comment__like-icon" type="button"><img src="/PagePointPersonal/img/like.svg" alt="like"></button>
                  <div class="comment__like-count">0</div>
                  <!--<button class="comment__dislike-icon" type="button"><img src="/PagePointPersonal/img/dislike.svg" alt="dislike"></button>
                  <div class="comment__dislike-count">0</div>-->
              </div>
          </div>
          <? }?>
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

//---------------стиль карты для авторизованного/неавторизованного
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
</script>
</body>
</html>
