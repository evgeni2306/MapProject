<!DOCTYPE html>
<html>
<head>
    <title>Карта</title>

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PageUnauthorizedMap/css/styles.css">
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
                        <button type="button" disabled class="menu__link active-menu" id="menu__link__view"><img
                                src="/PageMap/img/header/02.svg" alt="view">Просмотр
                        </button>
                    </li>
                    <li class="menu__item">
                        <button type="button" disabled class="menu__link" id="menu__link__add-object"><img
                                src="/PageUnauthorizedMap/img/02.svg" alt="object">Добавить объект
                        </button>
                    </li>
                    <li class="menu__item">
                        <button type="button" disabled class="menu__link" id="menu__link__add-route"><img
                                src="/PageUnauthorizedMap/img/03.svg" alt="route">Добавить маршрут
                        </button>
                    </li>
                </ul>
            </nav>
            <div class="authorization-btn">
              <a href="" class="to-authorization"><img src="/PageUnauthorizedMap/img/04.svg" alt="">Войти</a>
            </div>
        </div>
    </header>

    <div class="map" id="mapid"></div>
    <script>

        var mymap = L.map('mapid').setView([56.82, 60.6], 13);

        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            maxZoom: 18,
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
                'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1
        }).addTo(mymap);

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


        /*document.getElementById('menu__link__add-object').addEventListener("click", function (e) {
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
                        '<form method="" action ="">' +
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
                        '<option value="Зарядка"><img src="/PageMap/img/add-object/01.svg" alt="socket">Розетка</option>' +
                        '<option value="Достопримечательность"><img src="/PageMap/img/add-object/02.svg" alt="socket">Достопримечательность</option>' +
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

        mymap.on('click', onMapClick);*/

    </script>
</div>
<script src="/PageMap/js/script.js"></script>
</body>
</html>
