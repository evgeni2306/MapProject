<!DOCTYPE html>
<html>
<head>
    <title>Карта</title>

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PageUnauthorizedMap/css/headerUnauthMap.css">
    <link rel="stylesheet" href="/PageUnauthorizedMap/css/styles.css">
    <link rel="shortcut icon" type="image/x-icon" href="../favicon.png"/>
    <link rel="stylesheet" href="/Script/leaflet/dist/leaflet.css"/>
    <script src="/Script/leaflet/dist/leaflet.js"></script>
</head>
<body>
<div class="wrapper">
    <!--------------HEADER-------------------->
@include('Components.headerUnauthMap')
<!--------------/HEADER-------------------->
    <div class="map" id="mapid"></div>
</div>
<script>
    /*----------------------------------------------*/
    var zpoints = L.layerGroup(); //зарядки
    var dpoints = L.layerGroup(); //достопримечательности

    var Markers = L.Icon.extend({
        options: {
            iconSize:     [39, 45],
            iconAnchor:   [16,37]
        }
    });

    var socket = new Markers({iconUrl: '/PageMap/img/icons/socket.png'}),
        house = new Markers({iconUrl: '/PageMap/img/icons/house.png'});
    //--------Вывод точек на карту--------
    <?foreach ($_SESSION['Points'] as $point ) {?>
    L.marker([{{$point->lat}}, {{$point->lng}}], {icon: {{$point->icon}}}).bindPopup('<div class="marker__container">' +
        '<div class="marker__title"><a href="/point={{$point->id}}" class="marker__link">{{$point->name}}</a></div>' +
        '<div class="star-rating star-rating_set">' +
        '<div class="star-rating__body">' +
        '<img class="star-rating__star" src={{$point->rating}}>'+
        '<span class="star-rating__feedback"></span>'+
        '</div>'+
        '</div>'+
        '<div class="marker__photo__container">'+
        '<img class="marker__photo" src="{{$point->photo}}" alt="object">'+
        '</div>'+
        '</div>').addTo({{$point->type}});
    <? }?>
//--------------------------------------------
    var maplayer = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        maxZoom: 18,
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1
    })
    var mymap = L.map('mapid',{layers: [maplayer,zpoints, dpoints]}).setView([56.82, 60.6], 13);

    var baseLayers = {

    };

    var overlays = {
        "<img src='/PageMap/img/icons/03.svg'>Розетки": zpoints,
        "<img src='/PageMap/img/icons/04.svg'>Достопримечательности": dpoints
    };
    L.control.layers(baseLayers, overlays).addTo(mymap);
</script>
<script src="Script/menuUnauth.js"></script>
</body>
</html>
