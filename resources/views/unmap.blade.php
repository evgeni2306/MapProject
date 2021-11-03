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
              <a href="{{route('login')}}" class="to-authorization"><img src="/PageUnauthorizedMap/img/04.svg" alt="">Войти</a>
            </div>
            <div class="authorization-popup">
              <p class="authorization-popup-text">Зарегистрируйтесь или войдите в аккаунт, чтобы создать маршрут.</p>
            </div>
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

    </script>
</div>
<script src="/PageMap/js/script.js"></script>
</body>
</html>
