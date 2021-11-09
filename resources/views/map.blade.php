<!DOCTYPE html>
<html>
<head>
    <title>Карта</title>

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PageMap/css/styles.css">
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
    <header class="header">
        <div class="header__container">
            <a href="" class="header__logo">LOGO</a>
            <!--<form action="" method="get">
                <input class="search" name="search" placeholder="Поиск" type="search">
                <button class="search-btn" type="submit"><img src="/PageMap/img/header/01.svg" alt="search"></button>
            </form>-->
            <nav class="header__menu menu">
                <ul class="menu__list">
                    <li class="menu__item">
                        <button type="button" class="menu__link active-menu" id="menu__link__view"><img
                                src="/PageMap/img/header/02.svg" alt="view">Просмотр
                        </button>
                    </li>
                    <li class="menu__item">
                        <button type="button" class="menu__link" id="menu__link__add-object"><img
                                src="/PageMap/img/header/03.svg" alt="object">Добавить объект
                        </button>
                    </li>
                    <li class="menu__item">
                        <button type="button" class="menu__link" id="menu__link__add-route"><img
                                src="/PageMap/img/header/04.svg" alt="route">Добавить маршрут
                        </button>
                    </li>
                </ul>
            </nav>
            <nav class="user-menu">
                <ul class="user-menu__list">
                    <li class="user-name">
                        <img  class="avatar" src="/PageMap/img/user/{{$_SESSION['User']->avatar}}" alt="user">
                        <a href="#" class="user-menu__link" tabindex="1">{{$_SESSION['User']->name.' '.$_SESSION['User']->surname}}<img src="/PageMap/img/user/arrow.svg" alt=""></a>
                        <ul class="sub-menu__list">
                            <li><a href="#" class="sub-menu__link"><img src="/PageMap/img/user/01.svg" alt="">Мой профиль</a></li>
                            <li><a href="#" class="sub-menu__link"><img src="/PageMap/img/user/02.svg" alt="">Настройки</a></li>
                            <li><a href="{{route('logout')}}" class="sub-menu__link"><img src="/PageMap/img/user/03.svg" alt="">Выйти</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="map" id="mapid"></div>
    <script>

        var mymap = L.map('mapid').setView([56.82, 60.6], 13);
        var Markers = L.Icon.extend({
            options: {
                iconSize:     [39, 45],
                iconAnchor:   [16,37]
            }
        });

        var socket = new Markers({iconUrl: '/PageMap/img/icons/01.png'}),
            house = new Markers({iconUrl: '/PageMap/img/icons/02.png'});
        <?foreach ($_SESSION['Points'] as $point ) {?>
        L.marker([{{$point->lat}}, {{$point->lng}}],{icon: {{$point->type}}}).addTo(mymap)
            .bindPopup('<p> {{$point->name}}<p>' +
                '       <p> {{$point->address}}<p>' );
        <? }?>

        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            maxZoom: 18,
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
                'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1
        }).addTo(mymap);

        /*-------------star-rating---------------*/
        const ratings = document.querySelectorAll('.star-rating');
        if (ratings.length > 0) {
            initRatings();
        }

        function initRatings() {
            let ratingActive, ratingValue;
            for (let i = 0; i < ratings.length; i++) {
                const rating = ratings[i];
                initRating(rating);
            }

            function initRating(rating) {
                initRatingVars(rating);
                setRatingActiveWidth();

                if (rating.classList.contains('star-rating_set')) {
                    setRating(rating);
                }
            }

            function initRatingVars(rating) {
                ratingActive = rating.querySelector('.star-rating__active');
                ratingValue = rating.querySelector('.star-rating__value');
            }

            function setRatingActiveWidth(i = ratingValue.innerHTML) {
                const ratingActiveWidth = i / 0.05;
                ratingActive.style.width = `${ratingActiveWidth}%`;
            }

            function setRating(rating) {
                const ratingItems = rating.querySelectorAll('.star-rating__item');
                for (let i = 0; i < ratingItems.length; i++) {
                    const ratingItem = ratingItems[i];
                    ratingItem.addEventListener("mouseenter", function(e) {
                        initRatingVars(rating);
                        setRatingActiveWidth(ratingItem.value);
                    });
                    ratingItem.addEventListener("mouseleave", function(e) {
                        setRatingActiveWidth();
                    });
                    ratingItem.addEventListener("click", function(e) {
                        initRatingVars(rating);

                        if (rating.dataset.ajax) {
                            setRatingValue(ratingItem.value, rating);
                        } else {
                            ratingValue.innerHTML = i + 1;
                            setRatingActiveWidth();
                        }
                    });
                }
            }
        }
        /*--------------------------------------*/
        var popup = L.popup();

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


        document.getElementById('menu__link__add-object').addEventListener("click", function (e) {
            addObject = true;
            viewOnly = false;
            onMapClick(e.target);
            popup._close()
        });

        document.getElementById('menu__link__view').addEventListener("click", function (e) {
            addObject = false;
            viewOnly = true;
            onMapClick(e.target);
            popup._close()
        });

        document.getElementById('menu__link__add-route').addEventListener("click", function (e) {
            addObject = false;
            viewOnly = true;
            popup._close()
        });


        function onMapClick(e) {
            if (addObject == true) {
                popup
                    .setLatLng(e.latlng)
                    .setContent(
                        '<div class="text-container">' +
                        '<div class="add-object__title">Добавление объекта</div>' +
                        '<div class="add-object__subtitle">Укажите местоположение объекта, передвигая метку на карте.</div>' +

                        '</div>' +
                        '<form method="POST" action ="{{route('AddPoint')}}">' +
                        '<div class="form-fields">' +
                        '<div class="form-field form-name">' +
                        '<input type="text" placeholder="Введите название" required name="name">' +
                        '</div>' +
                        '<div class="form-field form-object-address">' +
                        '<input type="text" placeholder="Введите адрес" required name="address">' +
                        '</div>' +
                        '<div class="form-field form-category">' +

                        '<select  required name="type">' +
                        '<option value="" disabled selected style="display:none;">Выберите категорию</option>' +
                        '<option value="socket"><img src="/PageMap/img/add-object/01.svg" alt="socket">Розетка</option>' +
                        '<option value="house"><img src="/PageMap/img/add-object/02.svg" alt="socket">Достопримечательность</option>' +
                        '</select>' +
                        '        <input type="hidden" name="lat"  value="' + e.latlng.lat.toString().substr(0,9) + '">\n' +
                        '        <input type="hidden" name="lng"  value="' + e.latlng.lng.toString().substr(0,9) + '">\n' +

                        '</div>' +
                        '@csrf' +
                        '<div class="form-field form-button">' +

                        '<input type="submit" class="form-photos__add" value ="Добавить"></input>' +
                        '</form>' +

                        '</div>' +
                        '</div>' +
                        '</div>')
                    .openOn(mymap);
            }
        }




	// L.marker([56.82, 60.6], {icon: socket}).addTo(mymap);
	// L.marker([56.826, 60.65], {icon: house}).addTo(mymap);

   /* document.querySelector('.form-photos__add').addEventListener("submit", function (e) {
        L.marker([56.82, 60.6], {icon: socket}).addTo(mymap);
        L.marker([56.826, 60.65], {icon: house}).addTo(mymap);
    });*/

        mymap.on('click', onMapClick);

    </script>
</div>
<script src="/PageMap/js/script.js"></script>
</body>
</html>
