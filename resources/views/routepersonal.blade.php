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
        <div class="infoblock block">
            <div class="infoblock__category">
                <img src="/PageMap/img/icons/route.svg" alt="category">
                <span class="infoblock__category__name">Маршрут</span>
            </div>
            <h1 class="route__title">Маршрут от метро Орехово до метро Семеновская</h1>
            <div class="infoblock__info">
                <div class="infoblock__rating">
                    <div class="infoblock__rating__title">Отзывы</div>
                    <img src="/PagePointPersonal/img/stars.svg" alt="rating">
                    <span class="infoblock__rating__feedback">(35)</span>
                </div>
                <div class="infoblock__status-block">
                    <div class="infoblock__status__title">Статус работы</div>
                    <div class="infoblock__status">Работает</div>
                </div>
                <div class="infoblock__city-block">
                    <div class="infoblock__city__title">Город</div>
                    <div class="infoblock__city">Екатеринбург</div>
                </div>
                <div class="infoblock__user">
                    <span class="infoblock__user__add">Автор</span>
                    <img src="/PagePointPersonal/img/06.svg" class="infoblock__user__photo" alt="">
                    <span class="infoblock__user__name"><a href="{{route('profile')}}" class="user-profile__link">Алексей Петров</a></span>
                </div>
                <div class="infoblock__button-edit"><a href="{{route('editpoints')}}"><img src="/PagePointPersonal/img/pencil.svg" alt="">Редактировать</a></div>
            </div>
            <div id="map" class="information__map"></div>
        </div>
        <div class="data-block block">
            <div class="data-block__title title">Данные о маршруте</div>
            <div class="data">
                <div class="complexity">
                    <div class="complexity__title">Сложность</div>
                    <img src="/PageRoutePersonal/img/icons/middle.svg" alt="middle"><p class="complexity__name">Средняя</p>
                </div>
                <div class="length">
                    <div class="length__title">Протяженность</div>
                    <img src="/PageRoutePersonal/img/icons/road.svg" alt="road"><p class="length__distance">24.6 км</p>
                </div>
                <div class="time">
                    <div class="time__title">Время прохождения</div>
                    <img src="/PageRoutePersonal/img/icons/time.svg" alt="time"><p class="time__duration">1 час</p>
                </div>
            </div>
        </div>
        <div class="description-block block">
            <div class="description__title title">Описание</div>
            <div class="description">Крупнейший художественный музей Урала, имеет два здания — главное расположено на берегу реки Исети в Екатеринбурге, в Историческом сквере города, второе на Вайнера, 11, где в 2021 году открылся культурно-выставочный центр «Эрмитаж-Урал».</div>
        </div>
        <div class="modal">
            <div class="edit-popup">
                <div class="edit-popup__close"><img src="/PagePointPersonal/img/close.svg" alt="close"></div>
                <div class="edit-popup__title title">Редактирование отзыва</div>
                <form method="" action="">
                    <p class="feedback__mark block__subtitle">Ваша оценка</p>
                    <div class="feedback__rating">
                        <div class="rating__items">
                            <input id="rating__items__5_edit" type="radio" class="rating__item" value="5" name="rating">
                            <label for="rating__items__5_edit" class="rating__label"></label>
                            <input id="rating__items__4_edit" type="radio" class="rating__item" value="4" name="rating">
                            <label for="rating__items__4_edit" class="rating__label"></label>
                            <input id="rating__items__3_edit" type="radio" class="rating__item" value="3" name="rating">
                            <label for="rating__items__3_edit" class="rating__label"></label>
                            <input id="rating__items__2_edit" type="radio" class="rating__item" value="2" name="rating">
                            <label for="rating__items__2_edit" class="rating__label"></label>
                            <input id="rating__items__1_edit" type="radio" class="rating__item" value="1" name="rating">
                            <label for="rating__items__1_edit" class="rating__label"></label>
                        </div>
                    </div>
                    <div class="feedback__comment__subtitle block__subtitle">Комментарий</div>
                    <input type="text" hidden class="comment__id__edit" name="id" value="">
                    <textarea class="comment__text-edit" contenteditable="true" name="text"></textarea>
                    <div class="edit-buttons">
                        <input type="submit" class="edit__save" value ="Сохранить">
                    </div>
                </form>
            </div>
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
                            <div class="comment__user__name"><a href="{{route('profile')}}" class="user-profile__link">Александр Иванов</a><span class="user__rang">Профи <span class="user__rang-points">1200</span></span></div>
                        </div>
                    </div>
                    <div class="comment__rating">
                        <img class="star-rating__star" src="/PageMap/img/stars/stars03.svg">
                        <input type="text" hidden class="comment__id" value="">
                        <input type="text" hidden class="comment__rating1" value="">
                        <div class="comment__rating__date" id="time">22 августа 2021</div>
                    </div>
                </div>
                <div class="comment__text" contenteditable="false">Крупнейший художественный музей Урала, имеет два здания — главное расположено на берегу реки Исети в Екатеринбурге, в Историческом сквере города, второе на Вайнера, 11, где в 2021 году открылся культурно-выставочный центр «Эрмитаж-Урал» на берегу реки Исети</div>
                <div class="comment__bottom">
                    <span class="comment__bottom__useful">Было полезно?</span>
                    <button class="comment__like-icon" type="button"><img src="/PagePointPersonal/img/like.svg" alt="like"></button>
                    <div class="comment__like-count">0</div>
                    <div class="comment__bottom__buttons">
                        <button class="comment-edit"><img src="/PagePointPersonal/img/edit.svg" alt="edit"></button>
                        <a href="#" class="comment-delete"><img src="/PagePointPersonal/img/trash.svg" alt="trash"></a>
                    </div>
                    
                </div>
            </div>
            <div class="comments__comment">
                <div class="comment__top">
                    <div class="comment__user">
                        <img class="comment__user-avatar" src="/PagePointPersonal/img/06.svg" alt="user">
                        <div class="comment__user__content">
                            <div class="comment__user__name"><a href="{{route('profile')}}" class="user-profile__link">Александр Иванов</a><span class="user__rang">Профи <span class="user__rang-points">1200</span></span></div>
                        </div>
                    </div>
                    <div class="comment__rating">
                        <img class="star-rating__star" src="/PageMap/img/stars/stars03.svg">
                        <input type="text" hidden class="comment__id" value="">
                        <input type="text" hidden class="comment__rating1" value="">
                        <div class="comment__rating__date" id="time">22 августа 2021</div>
                    </div>
                </div>
                <div class="comment__text" contenteditable="false">Крупнейший художественный музей Урала, имеет два здания — главное расположено на берегу реки Исети в Екатеринбурге, в Историческом сквере города, второе на Вайнера, 11, где в 2021 году открылся культурно-выставочный центр «Эрмитаж-Урал» на берегу реки Исети</div>
                <div class="comment__bottom">
                    <span class="comment__bottom__useful">Было полезно?</span>
                    <button class="comment__like-icon" type="button"><img src="/PagePointPersonal/img/like.svg" alt="like"></button>
                    <div class="comment__like-count">0</div>
                    <div class="comment__bottom__buttons">
                        <button class="comment-edit"><img src="/PagePointPersonal/img/edit.svg" alt="edit"></button>
                        <a href="#" class="comment-delete"><img src="/PagePointPersonal/img/trash.svg" alt="trash"></a>
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
<script src="Script/menu.js" async></script>   
<script>
/*-------------MAP------------------------------*/
    var zpoints = L.layerGroup(); //зарядки
    var dpoints = L.layerGroup(); //достопримечательности
    var routes = L.layerGroup(); //маршруты

    var Markers = L.Icon.extend({
        options: {
            iconSize:     [39, 45],
            iconAnchor:   [16,37]
        }
	});

	var socket = new Markers({iconUrl: '/PageMap/img/icons/socket.png'}),
		house = new Markers({iconUrl: '/PageMap/img/icons/house.png'}),
        routeMarker = new Markers({iconUrl: '/PageMap/img/route/routeinactive.svg'});

    var maplayer = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            maxZoom: 18,
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
                'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1
        })

    var map = L.map('map',{layers: [maplayer,zpoints, dpoints, routes]}).setView([56.82, 60.6], 13);

	var tiles = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		maxZoom: 18,
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
			'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox/streets-v11',
		tileSize: 512,
		zoomOffset: -1
	}).addTo(map);

    L.marker([56.82, 60.6], {icon: socket}).bindPopup('<div class="marker__container">' +
            '<div class="marker__title"><a href="{{route('pointpersonal')}}" class="marker__link">Розетка</a></div>' +
            '<div class="short-description">Розетка во дворе</div>' +
            '<div class="star-rating star-rating_set">' +
                '<div class="star-rating__body">' + 
                    '<img class="star-rating__star" src="/PageMap/img/stars/stars03.svg">'+
                    '<span class="star-rating__feedback">(35)</span>'+
                '</div>'+
            '</div>'+
            '<div class="marker__address">Адрес</div>' +
            '<div class="marker-status status-unknown">Статус неизвестен</div>' +
            '<div class="marker__photo__container">'+
                '<img class="marker__photo" src="/PageMap/img/marker/02.png" alt="object">'+
            '</div>'+
        '</div>').addTo(zpoints);
        L.marker([56.826, 60.65], {icon: house}).bindPopup('<div class="marker__container">' +
            '<div class="marker__title"><a href="{{route('pointpersonal')}}" class="marker__link">Музей изобразительных искусств</a></div>' +
            '<div class="short-description">Музей</div>' +
            '<div class="star-rating star-rating_set">' +
                '<div class="star-rating__body">' +
                    '<img class="star-rating__star" src="/PageMap/img/stars/stars04.svg">'+
                    '<span class="star-rating__feedback">(35)</span>'+
                '</div>'+
            '</div>'+
            '<div class="marker__address">Адрес</div>' +
            '<div class="marker-status status-working">Работает</div>' +
            '<div class="marker__photo__container">'+
                '<img class="marker__photo" src="/PageMap/img/marker/01.png" alt="object">'+
            '</div>'+
        '</div>').addTo(dpoints);
        L.marker([56.818, 60.68], {icon: routeMarker}).bindPopup('<div class="marker__container">' +
            '<div class="marker__title"><a href="{{route('routepersonal')}}" class="marker__link">Маршрут от метро Орехово до метро Семеновская</a></div>' +
            '<div class="short-description">Маршрут</div>' +
            '<div class="star-rating star-rating_set">' +
                '<div class="star-rating__body">' +
                    '<img class="star-rating__star" src="/PageMap/img/stars/stars04.svg">'+
                    '<span class="star-rating__feedback">(35)</span>'+
                '</div>'+
            '</div>'+
            '<div class="marker-status status-broken">Не работает</div>' +
            '<div class="marker__characteristics">'+
                '<img class="marker__characteristic complexity" src="/PageRoutePersonal/img/icons/middle.svg" alt="middle">'+
                '<div class="length">'+
                    '<img class="marker__characteristic" src="/PageRoutePersonal/img/icons/road.svg" alt="road">'+
                    '<p class="length__distance">Не указано</p>'+
                '</div>'+
                '<div class="time">'+
                    '<img class="marker__characteristic" src="/PageRoutePersonal/img/icons/time.svg" alt="time">'+
                    '<p class="time__duration">Не указано</p>'+
                '</div>'+
            '</div>'+
        '</div>').addTo(routes);
        
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

/*------------------EDIT-COMMENT---------------------*/
    let modal = document.querySelector('.modal');
    let editPopup = document.querySelector('.edit-popup');
    let popupCloseButton = document.querySelector('.edit-popup__close');
    let editButton = document.querySelector('.comment-edit');
    let commentText = document.querySelector('.comment__text');
    let commentTextEdit = document.querySelector('.comment__text-edit');

    let commentId = document.querySelector('.comment__id');
    let commentIdEdit = document.querySelector('.comment__id__edit');
    let commentRating = document.querySelector('.comment__rating1');

    let rate5 = document.getElementById('rating__items__5_edit');
    let rate4 = document.getElementById('rating__items__4_edit');
    let rate3 = document.getElementById('rating__items__3_edit');
    let rate2 = document.getElementById('rating__items__2_edit');
    let rate1 = document.getElementById('rating__items__1_edit');


    editButton.addEventListener('click', function () {
        modal.classList.toggle('is-open');
        document.body.classList.toggle('_lock');
        editPopup.classList.toggle('is-open');

        //передача текста коммента в инпут
        commentTextEdit.value = commentText.textContent;

        commentIdEdit.value = commentId.value;

        switch(commentRating.value.toString()) {
            case '5':
                rate5.checked = true;
                break
            case '4':
                rate4.checked = true;
                break
            case '3':
                rate3.checked = true;
                break
            case '2':
                rate2.checked = true;
                break
            case '1':
                rate1.checked = true;
                break
            default:
                break
        }
    });
    popupCloseButton.addEventListener('click', function () {
        modal.classList.toggle('is-open');
        editPopup.classList.toggle('is-open');
    });     
</script>
</body>
</html>
