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
		house = new Markers({iconUrl: '/PageMap/img/icons/house.png'});

       var maplayer = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            maxZoom: 18,
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
                'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1
        })
        var mymap = L.map('mapid',{layers: [maplayer,zpoints, dpoints, routes]}).setView([56.82, 60.6], 13);
        // var mymap = L.map('mapid', {layers: [maplayer, zpoints, dpoints]}).fitWorld(); //Не убирать
        // ------- Определение местоположения на карте---------//может не работать
        mymap.locate({setView: true, maxZoom: 16});
        function onLocationFound(e) {
            L.marker(e.latlng).addTo(mymap)
                .bindPopup("You are within " + radius + " meters from this point").openPopup();
        }
        mymap.on('locationfound', onLocationFound);
        // ----------------------------------
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
        '<div class="marker__photo__container">'+
            '<img class="marker__photo" src="/PageMap/img/marker/01.png" alt="object">'+
        '</div>'+
    '</div>').addTo(dpoints);
        /*--------------------------------------*/
        var popup = L.popup();

        document.getElementById('menu__link__add-object').addEventListener("click", function (e) {
            addObject = true;
            viewOnly = false;
            addRoute = false;
            arr = new Array();
            route.remove();
            route = L.polyline({weight:55 ,color:'red'} ).addTo(mymap);
            onMapClick(e.target);
            popup._close()
        });

        document.getElementById('menu__link__view').addEventListener("click", function (e) {
            addObject = false;
            viewOnly = true;
            addRoute = false;
            arr = new Array();
            route.remove();
            route = L.polyline({weight:55 ,color:'red'} ).addTo(mymap);
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
        var route = L.polyline({weight:55 ,color:'red'} ).addTo(mymap);

        function onMapClick(e) {
            if (addObject == true) {

                address = getaddress(e)
                if(address == undefined){
                    address = ' '
                }
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
                        '<input type="text" placeholder="Введите адрес" required name="address" value="'+address+'">' +
                        '</div>' +
                        '<div class="form-field form-category">' +

                        '<select  required name="type">' +
                        '<option value="" disabled selected style="display:none;">Выберите категорию</option>' +
                        '<option value="socket,zpoints"><img src="/PageMap/img/add-object/01.svg" alt="socket">Розетка</option>' +
                        '<option value="house,dpoints"><img src="/PageMap/img/add-object/02.svg" alt="socket">Достопримечательность</option>' +
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
            if(addRoute == true){
                var arrr = new Array();
                arrr.push(e.latlng.lat.toString().substr(0,9));
                arrr.push(e.latlng.lng.toString().substr(0,9));
                arr.push(arrr)

                route.addLatLng(e.latlng);popup
                    .setLatLng(e.latlng)

                    .setContent('<form action="#" method="POST">\n' +
                        '        <input type="hidden" id ="routecord" name="cord"  value="' + arr + '">\n' +

                        '@csrf' +
                        '    <input type="submit" class="button__end-route" value="Закончить маршрут">\n' +
                        '</form>'+
                        '<button id = "mybutton" class="button__delete-point" onclick="deleterpoint();">Удалить точку<button/>')
                    .openOn(mymap).addTo(routes);
            }
        }

        var baseLayers = {

        };

        var overlays = {
            "<img src='/PageMap/img/icons/03.svg'>Розетки": zpoints,
            "<img src='/PageMap/img/icons/04.svg'>Достопримечательности": dpoints,
            "<img src='/PageMap/img/icons/route.svg'>Маршруты": routes
        };
        L.control.layers(baseLayers, overlays).addTo(mymap);

        //Получение адреса точки
        function getaddress( e) {
             url = 'https://nominatim.openstreetmap.org/reverse.php?lat='+e.latlng.lat+'&lon='+e.latlng.lng+'&format=jsonv2';
            var req = null;
            req = new XMLHttpRequest();
            req.open("GET", url, false);
            req.send(null);
            var data = JSON.parse(req.responseText)
            if(data["address"]["house_number"] == undefined){
                return data["address"]["road"]
            }else if(data["address"]["road"] == undefined){
                return " "
            }else if (data["address"]["house_number"] == undefined && data["address"]["road"] == undefined){
                return " "
            }else
                return  data["address"]["road"]+ ','+ data["address"]["house_number"]
        }

        mymap.on('click', onMapClick);
        // Отмена добавленной точки маршрута
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
</body>
</html>
