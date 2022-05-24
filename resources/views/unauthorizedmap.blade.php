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
        var mymap = L.map('mapid',{layers: [maplayer,zpoints, dpoints, routes]}).setView([56.82, 60.6], 13);
       //тестовые метки
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
                    '<p class="length__distance">24.6 км</p>'+
                '</div>'+
                '<div class="time">'+
                    '<img class="marker__characteristic" src="/PageRoutePersonal/img/icons/time.svg" alt="time">'+
                    '<p class="time__duration">1 час</p>'+
                '</div>'+
            '</div>'+
        '</div>').addTo(routes);
    var baseLayers = {

        };

        var overlays = {
            "<img src='/PageMap/img/icons/03.svg'>Розетки": zpoints,
            "<img src='/PageMap/img/icons/04.svg'>Достопримечательности": dpoints,
            "<img src='/PageMap/img/icons/route.svg'>Маршруты": routes
        };
        L.control.layers(baseLayers, overlays).addTo(mymap);   
</script>
<script src="Script/menuUnauth.js"></script>  
</body>
</html>
