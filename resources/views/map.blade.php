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
    <script>
        let menuArrows = document.querySelectorAll('.menu__arrow');
        if (menuArrows.length > 0) {
            for (let i = 0; i < menuArrows.length; i++) {
                const menuArrow = menuArrows[i];
                document.querySelector('.user-name').addEventListener("click", function (e) {
                    menuArrow.parentElement.classList.toggle('active__arrow');
                });
            }
        }
        var isMobile = {
            Android: function () {
                return navigator.userAgent.match(/Android/i);
            },
            BlackBerry: function () {
                return navigator.userAgent.match(/BlackBerry/i);
            },
            iOS: function () {
                return navigator.userAgent.match(/iPhone|iPad|iPod/i);
            },
            Opera: function () {
                return navigator.userAgent.match(/Opera Mini/i);
            },
            Windows: function () {
                return navigator.userAgent.match(/IEMobile/i);
            },
            any: function () {
                return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
            }
        };
        if (isMobile.any()) {
            document.body.classList.add('_mobile');
        } else {
            document.body.classList.add('_pc');
        }
        const iconMenu = document.querySelector('.menu__icon');
        if (iconMenu) {
            const userMenu = document.querySelector('.user-menu');
            const headerMenu = document.querySelector('.menu');
            iconMenu.addEventListener("click", function (e) {
                document.body.classList.toggle('_lock');
                iconMenu.classList.toggle('active__user-menu');
                userMenu.classList.toggle('active__user-menu');
                headerMenu.classList.toggle('hide');
            });
        }
        /*---------------------------------------------------------*/
        var zpoints = L.layerGroup(); //зарядки
        var dpoints = L.layerGroup(); //достопримечательности
        var Markers = L.Icon.extend({
            options: {
                iconSize: [39, 45],
                iconAnchor: [16, 37]
            }
        });
        var socket = new Markers({iconUrl: '/PageMap/img/icons/01.png'}),
            house = new Markers({iconUrl: '/PageMap/img/icons/02.png'});
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

        var maplayer = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            maxZoom: 18,
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
                'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1
        })

        var mymap = L.map('mapid', {layers: [maplayer, zpoints, dpoints]}).fitWorld();

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

                    .setContent('<form action="{{route('Addroute')}}" method="POST">\n' +
                        '        <input type="hidden" id ="routecord" name="cord"  value="' + arr + '">\n' +

                        '@csrf' +
                        '    <input type="submit">\n' +
                        '</form>' +
                        '<button id = "mybutton" style="background:red" onclick="deleterpoint();">123<button/>')
                    .openOn(mymap);
            }
        }

        var baseLayers = {};
        var overlays = {
            "<img src='/PageMap/img/icons/03.svg'>Розетки": zpoints,
            "<img src='/PageMap/img/icons/04.svg'>Достопримечательности": dpoints
        };
        L.control.layers(baseLayers, overlays).addTo(mymap);

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

        mymap.on('click', onMapClick);

        // Удаление точки маршрута во врем ядобавления маршрута
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
    </script>
</div>
<script src="/PageMap/js/script.js"></script>
</body>
</html>
