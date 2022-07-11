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
    var groutes = L.layerGroup(); //легкие маршруты
    var yroutes = L.layerGroup(); //средние маршруты
    var rroutes = L.layerGroup(); //сложные маршруты

    var Markers = L.Icon.extend({
        options: {
            iconSize:     [39, 45],
            iconAnchor:   [16,37]
        }
    });

    var socket = new Markers({iconUrl: '/PageMap/img/icons/socket.png'}),
        house = new Markers({iconUrl: '/PageMap/img/icons/house.png'})
    greenroute = new Markers({iconUrl: '/PageMap/img/route/greenroute.svg'});
    yellowroute = new Markers({iconUrl: '/PageMap/img/route/yellowroute.svg'});
    redroute = new Markers({iconUrl: '/PageMap/img/route/redroute.svg'});
    geolocation = new Markers({iconUrl: '/PageMap/img/icons/locationIcon.svg'});

    //---------------Вывод точек на карту--------------------
    <?foreach ($points as $point ) {?>
    L.marker([{{$point->lat}}, {{$point->lng}}], {icon: {{$point->icon}}}).bindPopup(
        '<div class="marker__container">' +
        '<div class="marker__title"><a href="/point={{$point->id}}" class="marker__link">{{$point->name}}</a></div>' +
        '<div class="short-description">{{$point->shortdescription}}</div>' +
        '<div class="star-rating star-rating_set">' +
        '<div class="star-rating__body">' +
        '<img class="star-rating__star" src="{{$point->rating[0]}}">'+
        '<span class="star-rating__feedback">({{$point->rating[1]}})</span>'+
        '</div>'+
        '</div>'+
        '<div class="marker__address">{{$point->address}}</div>' +
        '<div class="marker-status status-unknown">Статус : {{$point->status}}</div>' +
        '<div class="marker__photo__container">'+
        '<img class="marker__photo" src="{{$point->photo}}" alt="object">'+
        '</div>'+
        '</div>').addTo({{$point->type}});
    <? }?>
    // ----------------------------------------
    //---------механизм создания карты----------
    var maplayer = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        maxZoom: 18,
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1
    })
    var mymap = L.map('mapid',{layers: [maplayer,zpoints, dpoints, groutes, yroutes, rroutes ]}).setView([56.82, 60.6], 13);
    // var mymap = L.map('mapid', {layers: [maplayer, zpoints, dpoints, groutes, yroutes, rroutes ]}).fitWorld();
    //-----------------------------------------

    // ------- Определение местоположения на карте---------
    mymap.locate({setView: true, maxZoom: 16});
    function onLocationFound(e) {
        L.marker(e.latlng,{icon: geolocation}).addTo(mymap)
            .bindPopup("You are within " + radius + " meters from this point").openPopup();
    }
    mymap.on('locationfound', onLocationFound);
    // ----------------------------------

    //-------------------Вывод маршрутов------------------
    <?    foreach ($routes as $route){?>
    L.marker([{{$route->lat}}, {{$route->lng}}], {icon: {{$route->icon[0]}}}).bindPopup(
        '<div class="marker__container">' +
        '<div class="marker__title"><a href="/route={{$route->id}}" class="marker__link">{{$route->name}}</a></div>' +
        '<div class="short-description">{{$route->shortdescription}}</div>' +
        '<div class="star-rating star-rating_set">' +
        '<div class="star-rating__body">' +
        '<img class="star-rating__star" src="{{$route->rating[0]}}">'+
        '<span class="star-rating__feedback">({{$route->rating[1]}})</span>'+
        '</div>'+
        '</div>'+
        '<div class="marker-status status-broken">{{$route->status}}</div>' +
        '<div class="marker__characteristics">'+
        '<img class="marker__characteristic complexity" src="/PageRoutePersonal/img/icons/{{$route->icon[1]}}.svg" alt="middle">'+
        '<div class="length">'+
        '<img class="marker__characteristic" src="/PageRoutePersonal/img/icons/road.svg" alt="road">'+
        '<p class="length__distance">{{$route->distance}} Км</p>'+
        '</div>'+
        '<div class="time">'+
        '<img class="marker__characteristic" src="/PageRoutePersonal/img/icons/time.svg" alt="time">'+
        '<p class="time__duration">{{$route->time}} Ч</p>'+
        '</div>'+
        '</div>'+
        '<button type="button" class="show-route" onclick="DrawRoute()" >Показать маршрут</button>' +
        '</div>').addTo({{$route->type}});
    <?}?>
    //-------------------------------------------------------

    //Рисование маршрута на 15 сек при нажатии соответствующей кнопки на попапе
    function DrawRoute(){
        var link = document.querySelector(".marker__link").href.substring(24);
        var request = new XMLHttpRequest();
        request.open("GET","http://mapproject/DrawRoute="+link,true);
        request.onreadystatechange  = function (){
            if(this.readyState ==4)
            {
                if (this.status == 200){
                    if(this.responseText !=null){
                        $arr = JSON.parse(this.responseText)
                        var route = L.polyline({weight: 55, color: 'red'}).addTo(mymap);

                        for (let i = 0; i < $arr.length; i++){
                            route.addLatLng([$arr[i]['lat'],$arr[i]['lng']]);
                        }
                        setTimeout(function() {
                            route.remove()
                        }, 15000);

                    }
                    else alert("Данные не получены");
                }
                else alert ("Ошибка"+ this.statusText)
            }}
        request.send(null)
    }

    var baseLayers = {

    };

    var overlays = {
        "<img src='/PageMap/img/icons/03.svg'>Розетки": zpoints,
        "<img src='/PageMap/img/icons/04.svg'>Достопримечательности": dpoints,
        "<img src='/PageMap/img/route/filtergreenroute.svg'>Легкие маршруты": groutes,
        "<img src='/PageMap/img/route/filteryellowroute.svg'>Средние маршруты": yroutes,
        "<img src='/PageMap/img/route/filterredroute.svg'>Сложные маршруты": rroutes,
    };
    L.control.layers(baseLayers, overlays).addTo(mymap);
</script>
<script src="Script/menuUnauth.js"></script>
</body>
</html>
