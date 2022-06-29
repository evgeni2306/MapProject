<!DOCTYPE html>
<html>
<head>
    <title>Карта</title>

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PageMap/css/headerMap.css">
    <link rel="stylesheet" href="/PageMap/css/styles.css">
    <link rel="shortcut icon" type="image/x-icon" href="../favicon.png"/>
    <link rel="stylesheet" href="/Script/leaflet/dist/leaflet.css"/>
    <script src="/Script/leaflet/dist/leaflet.js"></script>
</head>
<body>
<div class="wrapper">
    <!--------------HEADER-------------------->
@include('Components.headerMap')
<!--------------/HEADER-------------------->
    <div class="map" id="mapid"></div>
    <script src="Script/menu.js" async></script>
    <script>

        //--------Настройка иконок и слоев для вывода на карту----------
        var zpoints = L.layerGroup(); //зарядки
        var dpoints = L.layerGroup(); //достопримечательности
        var groutes = L.layerGroup(); //легкие маршруты
        var yroutes = L.layerGroup(); //средние маршруты
        var rroutes = L.layerGroup(); //сложные маршруты
        var inobject = L.layerGroup();//Не работающие объекты

        var Markers = L.Icon.extend({
            options: {
                iconSize: [39, 45],
                iconAnchor: [16, 37]
            }
        });
        var socket = new Markers({iconUrl: '/PageMap/img/icons/socket.png'});
            house = new Markers({iconUrl: '/PageMap/img/icons/house.png'});
            insocket = new Markers({iconUrl: '/PageMap/img/icons/socketinactive.svg'});
            inhouse = new Markers({iconUrl: '/PageMap/img/icons/houseinactive.svg'});
            grayroute = new Markers({iconUrl: '/PageMap/img/route/grayroute.svg'});
            greenroute = new Markers({iconUrl: '/PageMap/img/route/greenroute.svg'});
            yellowroute = new Markers({iconUrl: '/PageMap/img/route/yellowroute.svg'});
            redroute = new Markers({iconUrl: '/PageMap/img/route/redroute.svg'});
            geolocation = new Markers({iconUrl: '/PageMap/img/icons/locationIcon.svg'});
        //-----------------------------------------------------------------

        //---------------Вывод точек на карту--------------------
        <?foreach ($points as $point ) {?>
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
            '</div>').addTo({{$point->type}});
        <? }?>
        // ----------------------------------------

        //---------механизм создания карты----------
        var maplayer = L.tileLayer('{{$_SESSION['User']->mapstyle}}', {
            maxZoom: 18,
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
                'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1
        })
        var mymap = L.map('mapid',{layers: [maplayer,zpoints, dpoints, groutes, yroutes, rroutes,inobject ]}).setView([56.82, 60.6], 13);
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
            '<img class="star-rating__star" src="{{$route->rating}}">'+
            '<span class="star-rating__feedback">()</span>'+
            '</div>'+
            '</div>'+
            '<button style="background-color:red" onclick="DrawRoute()" >Отобразить</button>'+
            '<div class="marker-status status-broken">{{$route->status}}</div>' +
            '<div class="marker__characteristics">'+
            '<img class="marker__characteristic complexity" src="/PageRoutePersonal/img/icons/{{$route->icon[1]}}.svg" alt="middle">'+
            '<div class="length">'+
            '<img class="marker__characteristic" src="/PageRoutePersonal/img/icons/road.svg" alt="road">'+
            '<p class="length__distance">{{$route->distance}}</p>'+
            '</div>'+
            '<div class="time">'+
            '<img class="marker__characteristic" src="/PageRoutePersonal/img/icons/time.svg" alt="time">'+
            '<p class="time__duration">{{$route->time}}</p>'+
            '</div>'+
            '</div>'+
            '</div>').addTo({{$route->type}});
        <?}?>


        //-------------------------------------------------------

        //---------кнопки и смена режимов----------------------
        var popup = L.popup();
        var menuLinks = document.querySelectorAll('.menu__link');
        var lastClicked = menuLinks[0];
        var viewOnly = false;
        var addObject = false;
        var addRoute = false;
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
            addRoute = false;
            arr = new Array();
            route.remove();
            route = L.polyline({weight: 55, color: 'red'}).addTo(mymap);
            onMapClick(e.target);
            popup._close()
        });
        document.getElementById('menu__link__view').addEventListener("click", function (e) {
            addObject = false;
            viewOnly = true;
            addRoute = false;
            arr = new Array();
            route.remove();
            route = L.polyline({weight: 55, color: 'red'}).addTo(mymap);
            onMapClick(e.target);
            popup._close()
        });
        document.getElementById('menu__link__add-route').addEventListener("click", function (e) {
            addObject = false;
            viewOnly = false;
            addRoute = true;
            popup._close()
        });
        //-------------------------------------------------------

        //----------добавление меток и маршрутов------------------
        let arr = new Array();
        var route = L.polyline({weight: 55, color: 'red'}).addTo(mymap);

        function onMapClick(e) {
            if (addObject == true) {
                address = getaddress(e)
                if (address == undefined) {
                    address = ' '
                }
                popup
                    .setLatLng(e.latlng)
                    .setContent(
                        '<div class="text-container">' +
                        '<div class="add-object__title">Добавление точки</div>' +
                        '<div class="add-object__subtitle">Укажите местоположение точки, кликая по карте.</div>' +
                        '</div>' +
                        '<form method="Post" action ="{{route('AddPoint')}}">' +
                        '<div class="form-fields">' +
                        '<div class="form-field form-name">' +
                        '<input type="text" placeholder="Введите название" required name="name">' +
                        '</div>' +
                        '<div class="form-field form-object-address">' +
                        '<input type="text" placeholder="Введите адрес" required name="address" value="' + address + '">' +
                        '</div>' +
                        '<div class="form-field form-category">' +
                        '<select  required name="type">' +
                        '<option value="" disabled selected style="display:none;">Выберите категорию</option>' +
                        '<option value="socket,zpoints"><img src="/PageMap/img/add-object/01.svg" alt="socket">Розетка</option>' +
                        '<option value="house,dpoints"><img src="/PageMap/img/add-object/02.svg" alt="socket">Достопримечательность</option>' +
                        '</select>' +
                        '        <input type="hidden" name="lat"  value="' + e.latlng.lat.toString().substr(0, 9) + '">\n' +
                        '        <input type="hidden" name="lng"  value="' + e.latlng.lng.toString().substr(0, 9) + '">\n' +
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
            if (addRoute == true) {

                var arrr = new Array();
                arrr.push(e.latlng.lat.toString().substr(0, 9));
                arrr.push(e.latlng.lng.toString().substr(0, 9));
                arr.push(arrr)

                route.addLatLng(e.latlng);
                popup
                    .setLatLng(e.latlng)

                    .setContent( '<form action="{{route('Addrouteredir')}}" method="POST">\n' +
                        '        <input type="hidden"  id ="routecord" name="cord"  value="' + arr + '">\n' +

                        '@csrf' +
                        '    <input type="submit" class="button__end-route" value="Закончить маршрут">\n' +
                        '</form>'+
                        '<button id = "mybutton" class="button__delete-point" onclick="deleterpoint();">Удалить точку<button/>')
                    .openOn(mymap).addTo(routes);
            }
        }

        var baseLayers = {};
        var overlays = {
            "<img src='/PageMap/img/icons/03.svg'>Розетки": zpoints,
            "<img src='/PageMap/img/icons/04.svg'>Достопримечательности": dpoints,
            "<img src='/PageMap/img/route/filtergreenroute.svg'>Легкие маршруты": groutes,
            "<img src='/PageMap/img/route/filteryellowroute.svg'>Средние маршруты": yroutes,
            "<img src='/PageMap/img/route/filterredroute.svg'>Сложные маршруты": rroutes,
            @if($_SESSION['User']->rankid>=2)
            "<img src='/PageMap/img/icons/inobject.svg'>Не работающие объекты":inobject
            @endif
        };
        L.control.layers(baseLayers, overlays).addTo(mymap);
        //------------------------------------------------------------------


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


        ///---------получение адреса при добавлении точки---------
        function getaddress(e) {
            url = 'https://nominatim.openstreetmap.org/reverse.php?lat=' + e.latlng.lat + '&lon=' + e.latlng.lng + '&format=jsonv2';
            var req = null;
            req = new XMLHttpRequest();
            req.open("GET", url, false);
            req.send(null);
            var data = JSON.parse(req.responseText)
            if (data["address"]["house_number"] == undefined) {
                return data["address"]["road"]
            } else if (data["address"]["road"] == undefined) {
                return " "
            } else if (data["address"]["house_number"] == undefined && data["address"]["road"] == undefined) {
                return " "
            } else
                return data["address"]["road"] + ',' + data["address"]["house_number"]
        }
        ///---------------------------------------------------------
        mymap.on('click', onMapClick);

        //------ Удаление точки маршрута во время добавления маршрута---------
        function deleterpoint() {
            startstr = document.getElementById('routecord').value.split(',');
            startstr.pop();
            startstr.pop();
            finishstr = "";
            for (let i = 0; i < startstr.length; i++) {
                finishstr = finishstr + startstr[i] + ',';
            }
            document.getElementById('routecord').value = finishstr.slice(0, -1);
            arr = document.getElementById('routecord').value.split(',');
            route.deleteLat();
        }
        //----------------------------------------------------------------------
    </script>
</div>
</body>
</html>
