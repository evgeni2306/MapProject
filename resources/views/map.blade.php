<!DOCTYPE html>
<html>
<head>
    <title>Карта</title>

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PageMap/css/headerMap.css">
    <link rel="stylesheet" href="/PageMap/css/styles.css">
    <link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico"/>
    <link rel="stylesheet" href="/Script/leaflet/dist/leaflet.css"/>
    <script src="/Script/leaflet/dist/leaflet.js"></script>
</head>
<body>
<div class="wrapper">
    <!--------------HEADER-------------------->
@include('Components.headerMap')
<!--------------/HEADER-------------------->
    <div class="map" id="mapid"></div>
    <script src="Script/menu.js"></script>
    <script>

        //--------Настройка иконок и слоев для вывода на карту----------
        var zpoints = L.layerGroup(); //зарядки
        var dpoints = L.layerGroup(); //достопримечательности
        var routes = L.layerGroup(); //маршруты

        var Markers = L.Icon.extend({
            options: {
                iconSize: [39, 45],
                iconAnchor: [16, 37]
            }
        });
        var socket = new Markers({iconUrl: '/PageMap/img/icons/socket.png'}),
            house = new Markers({iconUrl: '/PageMap/img/icons/house.png'});
        //-----------------------------------------------------------------

        //---------------Вывод точек на карту--------------------
        <?foreach ($_SESSION['Points'] as $point ) {?>
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
        var maplayer = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            maxZoom: 18,
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
                'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1
        })
        var mymap = L.map('mapid',{layers: [maplayer,zpoints, dpoints, routes]}).setView([56.82, 60.6], 13);
        // var mymap = L.map('mapid', {layers: [maplayer, zpoints, dpoints]}).fitWorld();
        //-----------------------------------------


        // ------- Определение местоположения на карте---------
        mymap.locate({setView: true, maxZoom: 16});
        function onLocationFound(e) {
            L.marker(e.latlng).addTo(mymap)
                .bindPopup("You are within " + radius + " meters from this point").openPopup();
        }
        mymap.on('locationfound', onLocationFound);
        // ----------------------------------

        //-------------Вывод маршрутов на карту-----------------
        <?    foreach ($_SESSION['Routes'] as $route){?>
        var rout = L.polyline({weight: 55, color: 'red'}).addTo(mymap);
        <?       foreach($route->rpoints as $rpoint){?>
        <?foreach($rpoint as $r){?>

        rout.addLatLng([{{$r->lat}},{{$r->lng}}]);
        <?}}}?>
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
        document.getElementById('menu__link__add-object__mobile').addEventListener("click", function (e) {
            addObject = true;
            viewOnly = false;
            onMapClick(e.target);
            popup._close()
        });
        document.getElementById('menu__link__view__mobile').addEventListener("click", function (e) {
            addObject = false;
            viewOnly = true;
            onMapClick(e.target);
            popup._close()
        });
        document.getElementById('menu__link__add-route__mobile').addEventListener("click", function (e) {
            addObject = false;
            viewOnly = true;
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
                        '<div class="add-object__title">Добавление объекта</div>' +
                        '<div class="add-object__subtitle">Укажите местоположение объекта, передвигая метку на карте.</div>' +
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

                    .setContent( '<form action="{{route('Addroute')}}" method="POST">\n' +
                        '        <input type="hidden" id ="routecord" name="cord"  value="' + arr + '">\n' +

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
            "<img src='/PageMap/img/icons/route.svg'>Маршруты": routes
        };
        L.control.layers(baseLayers, overlays).addTo(mymap);
        //------------------------------------------------------------------

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

        //------ Удаление точки маршрута во врем ядобавления маршрута---------
        function deleterpoint() {
            startstr = document.getElementById('routecord').value.split(',');
            startstr.pop();
            startstr.pop();
            finishstr = "";
            for (let i = 0; i < startstr.length; i++) {
                finishstr = finishstr + startstr[i] + ',';
            }
            document.getElementById('routecord').value = finishstr.slice(0, -1);
            route.deleteLat();
        }
        //----------------------------------------------------------------------
    </script>
</div>
</body>
</html>
