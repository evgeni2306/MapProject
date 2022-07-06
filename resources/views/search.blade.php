<!DOCTYPE html>
<html>
<head>
    <title>Поиск</title>

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PageEditPoints/css/headerPages.css">
    <link rel="stylesheet" href="/PageEditPoints/css/footerPages.css">
    <link rel="stylesheet" href="/PageSearch/css/styles.css">
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
    @include('Components.headerPages')
    <!--------------/HEADER-------------------->
    <div class="container">
    <form method="POST" action ="{{route('search')}}">
      <h1 class="search__title">Поиск по маршрутам</h1>
      <div class="content__container">
        <h2 class="search-parameters">Параметры поиска</h2>
        <div class="forms__container">
          <div class="forms__city">
            <h4 class="sub-title">Город</h4>
              <select name="city">
                  <option value="" disabled selected style="display:none;">Выберите город</option>
                  <?foreach ($city as $cit){?>
                  <option value="{{$cit->city}}">{{$cit->city}}</option>
{{--                  <option value="">Первоуральск</option>--}}
{{--                  <option value="">Москва</option>--}}
                  <? }?>
              </select>
          </div>
          <div class="forms__complexity">
            <h4 class="sub-title">Сложность</h4>
          <select name="difficult">
              <option value="" disabled selected style="display:none;">Выберите сложность</option>
              <option value="Легко">Для новичков</option>
              <option value="Средне">Средняя</option>
              <option value="Сложно">Для продвинутых</option>
          </select>
          </div>
          <div class="forms__status">
            <h4 class="sub-title">Статус работы</h4>
              <select name="status">
                <option value="" disabled selected style="display:none;">Выберите статус</option>
                  <option value="Под вопросом">Под вопросом</option>
                  <option value="Работает">Работает</option>
                  <option value="Не работает">Не работает</option>
              </select>
          </div>
          <div class="forms__length">
            <h4 class="sub-title">Протяженность, км</h4>
            <div class="forms__length-wrapper">
              <div class="length__from">
                <span class="length__from-text">От</span>
                <input type="number"  step = "any" min="0"  name="distancefrom">
              </div>
              <div class="length__to">
                <span class="length__to-text">До</span>
                <input type="number"  step = "any" min="0"  name="distanceto">
              </div>
            </div>
          </div>
          <div class="forms__time">
            <h4 class="sub-title">Время прохождения, ч</h4>
            <div class="forms__time-wrapper">
              <div class="time__from">
                <span class="time__from-text">От</span>
                <input type="number" step = "any" min="0"  name="timefrom">
              </div>
              <div class="time__to">
                <span class="time__to-text">До</span>
                <input type="number" step = "any"  min="0"  name="timeto">
              </div>
            </div>
          </div>

        </div>
        <input type="submit" class="search-button" value ="Найти">

          @if(isset($results))
        <h2 class="search-results__title">Результаты поиска</h2>
        <div class="search-results">

        <?foreach($results as $res) { ?>
        <div class="route__container">
            <div class="route__title"><a href="/route={{$res->id}}" class="route__link">{{$res->name}}</a></div>
            <div class="short-description">{{$res->shortdescription}}</div>
            <div class="star-rating star-rating_set">
              <div class="star-rating__body">
                <img class="star-rating__star" src="{{$res->rating[0]}}">
                <span class="star-rating__feedback">({{$res->rating[1]}})</span>
              </div>
            </div>
            <div class="route-status status-broken">{{$res->status}}</div>
            <div class="route__characteristics">
              <img class="route__characteristic complexity" src="/PageRoutePersonal/img/icons/{{$res->icon}}.svg" alt="middle">
              <div class="length">
                <img class="route__characteristic" src="/PageRoutePersonal/img/icons/road.svg" alt="road">
                <p class="length__distance">{{$res->distance}}Км</p>
              </div>
              <div class="time">
                <img class="route__characteristic" src="/PageRoutePersonal/img/icons/time.svg" alt="time">
                <p class="time__duration">{{$res->time}}</p>
              </div>
            </div>
        </div>
            <? }?>

            @endif
        </div>

      </div>
        @csrf
    </form>
    </div>
    <!--------------FOOTER-------------------->
    @include('Components.footer')
    <!--------------/FOOTER-------------------->
</div>
<script src="Script/menu.js"></script>
</body>
</html>
