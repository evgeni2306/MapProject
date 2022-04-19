<!DOCTYPE html>
<html>
<head>
    <title>Карта</title>

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PageUnauthorizedMap/css/headerUnauthMap.css">
    <link rel="stylesheet" href="/PageUnauthorizedMap/css/styles.css">
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

       var maplayer = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            maxZoom: 18,
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
                'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1
        })
        var mymap = L.map('mapid',{layers: [maplayer,zpoints, dpoints]}).setView([56.82, 60.6], 13);
       //тестовые метки
        L.marker([56.82, 60.6], {icon: socket}).bindPopup('<div class="marker__container">' +
        '<div class="marker__title">Розетка</div>' +
        '<div class="star-rating star-rating_set">' +
            '<div class="star-rating__body">' +
                '<img class="star-rating__star" src="/PageMap/img/marker/03.svg">'+
            '</div>'+
            '<div class="star-rating__value">4.3</div>'+
        '</div>'+
        '<div class="marker__photo__container">'+
            '<img class="marker__photo" src="/PageMap/img/marker/02.png" alt="object">'+
        '</div>'+
    '</div>').addTo(zpoints);
        L.marker([56.826, 60.65], {icon: house}).bindPopup('<div class="marker__container">' +
        '<div class="marker__title">Музей изобразительных искусств</div>' +
        '<div class="star-rating star-rating_set">' +
            '<div class="star-rating__body">' +
                '<img class="star-rating__star" src="/PageMap/img/marker/03.svg">'+
            '</div>'+
            '<div class="star-rating__value">4.3</div>'+
        '</div>'+
        '<div class="marker__photo__container">'+
            '<img class="marker__photo" src="/PageMap/img/marker/01.png" alt="object">'+
        '</div>'+
    '</div>').addTo(dpoints);
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
