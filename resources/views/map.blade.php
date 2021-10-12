
<!DOCTYPE html>
<html>
<head>

    <title>Quick Start - Leaflet</title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>



</head>
<body>



<div id="mapid" style="width: 600px; height: 400px;"></div>
<script>


    var mymap = L.map('mapid',{zoom:15, minZoom:11, maxZoom:18, maxBounds:[[56.95097, 60.30052],
            [56.72561, 60.98717]]}).setView([{{$_SESSION['MainX']}}, {{$_SESSION['MainY']}}], 18);


    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        maxZoom: 18,
        attribution: '',
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1
    }).addTo(mymap);

    <?foreach ($_SESSION['Points'] as $point ) {?>
    L.marker([{{$point->lat}}, {{$point->lng}}]).addTo(mymap)
        .bindPopup( "{{$point->description}}").openPopup();

    <? }?>


    mymap.setView([{{$_SESSION['MainX']}}, {{$_SESSION['MainY']}}], 18);
    // L.circle([51.508, -0.11], 500, {
    //     color: 'red',
    //     fillColor: '#f03',
    //     fillOpacity: 0.5
    // }).addTo(mymap).bindPopup("I am a circle.");
    //
    // L.polygon([
    //     [51.509, -0.08],
    //     [51.503, -0.06],
    //     [51.51, -0.047]
    // ]).addTo(mymap).bindPopup("I am a polygon.");


    var popup = L.popup();

    function onMapClick(e) {
        popup
            .setLatLng(e.latlng)
            .setContent('<form action="{{route('map')}}" method="POST">\n' +
                '\n' +
                '        <input type="hidden" name="lat"  value="' + e.latlng.lat.toString().substr(0,9) + '">\n' +
                '        <input type="hidden" name="lng"  value="' + e.latlng.lng.toString().substr(0,9) + '">\n' +
                '        <input type="text" name="description" size="15" maxlength="30" value="">\n' +

                '@csrf' +
                '    <input type="submit">\n' +
                '</form>')
            .openOn(mymap);
    }

    mymap.on('click', onMapClick);


</script>





</body>
</html>
