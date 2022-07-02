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
</head>
<body>
<div class="wrapper">
    <!--------------HEADER-------------------->
    @include('Components.headerPages')
    <!--------------/HEADER-------------------->
    <div class="container">
    <form method="" action ="">
      <h1 class="search__title">Поиск по маршрутам</h1>
      <div class="content__container">
        <h2 class="search-parameters">Параметры поиска</h2>
        <div class="forms__container">
          <div class="forms__city">
            <h4 class="sub-title">Город</h4>
          <input type="text" placeholder="Введите город" name="city">
          </div>
          <div class="forms__complexity">
            <h4 class="sub-title">Сложность</h4>
          <select name="complexity">
            <option value="" disabled selected style="display:none;">Выберите сложность</option>
            <option value="">Для новичков</option>
            <option value="">Средняя</option>
            <option value="">Для продвинутых</option>
          </select>
          </div>
          <div class="forms__status">
            <h4 class="sub-title">Статус работы</h4>
              <select name="status">
                <option value="" disabled selected style="display:none;">Выберите статус</option>
                <option value="">Работает</option>
                <option value="">Не работает</option>
                <option value="">Статус неизвестен</option>
              </select>
          </div>
          <div class="forms__length">
            <h4 class="sub-title">Протяженность, км</h4>
            <div class="forms__length-wrapper">
              <div class="length__from">
                <span class="length__from-text">От</span>
                <input type="number" name="length__from">
              </div>
              <div class="length__to">
                <span class="length__to-text">До</span>
                <input type="number" name="length__to">
              </div>
            </div> 
          </div>
          <div class="forms__time">
            <h4 class="sub-title">Время прохождения, ч</h4>
            <div class="forms__time-wrapper">
              <div class="time__from">
                <span class="time__from-text">От</span>
                <input type="number" name="time__from">
              </div>
              <div class="time__to">
                <span class="time__to-text">До</span>
                <input type="number" name="time__to">
              </div>
            </div>
          </div>
          
        </div>
        <input type="submit" class="search-button" value ="Найти">

        <h2 class="search-results__title">Результаты поиска</h2>
        <div class="search-results">
          <div class="marker__container">
            <div class="marker__title"><a href="{{route('routepersonal')}}" class="marker__link">Маршрут от метро Орехово до метро Семеновская</a></div>
            <div class="short-description">Маршрут</div>
            <div class="star-rating star-rating_set">
              <div class="star-rating__body">
                <img class="star-rating__star" src="/PageMap/img/stars/stars04.svg">
                <span class="star-rating__feedback">(35)</span>
              </div>
            </div>
            <div class="marker-status status-broken">Не работает</div>
            <div class="marker__characteristics">
              <img class="marker__characteristic complexity" src="/PageRoutePersonal/img/icons/middle.svg" alt="middle">
              <div class="length">
                <img class="marker__characteristic" src="/PageRoutePersonal/img/icons/road.svg" alt="road">
                <p class="length__distance">Не указано</p>
              </div>
              <div class="time">
                <img class="marker__characteristic" src="/PageRoutePersonal/img/icons/time.svg" alt="time">
                <p class="time__duration">Не указано</p>
              </div>
            </div>
        </div>

        <div class="marker__container">
            <div class="marker__title"><a href="{{route('routepersonal')}}" class="marker__link">Маршрут от метро Орехово до метро Семеновская</a></div>
            <div class="short-description">Маршрут</div>
            <div class="star-rating star-rating_set">
              <div class="star-rating__body">
                <img class="star-rating__star" src="/PageMap/img/stars/stars04.svg">
                <span class="star-rating__feedback">(35)</span>
              </div>
            </div>
            <div class="marker-status status-broken">Не работает</div>
            <div class="marker__characteristics">
              <img class="marker__characteristic complexity" src="/PageRoutePersonal/img/icons/middle.svg" alt="middle">
              <div class="length">
                <img class="marker__characteristic" src="/PageRoutePersonal/img/icons/road.svg" alt="road">
                <p class="length__distance">Не указано</p>
              </div>
              <div class="time">
                <img class="marker__characteristic" src="/PageRoutePersonal/img/icons/time.svg" alt="time">
                <p class="time__duration">Не указано</p>
              </div>
            </div>
        </div>

        <div class="marker__container">
            <div class="marker__title"><a href="{{route('routepersonal')}}" class="marker__link">Маршрут от метро Орехово до метро Семеновская</a></div>
            <div class="short-description">Маршрут</div>
            <div class="star-rating star-rating_set">
              <div class="star-rating__body">
                <img class="star-rating__star" src="/PageMap/img/stars/stars04.svg">
                <span class="star-rating__feedback">(35)</span>
              </div>
            </div>
            <div class="marker-status status-broken">Не работает</div>
            <div class="marker__characteristics">
              <img class="marker__characteristic complexity" src="/PageRoutePersonal/img/icons/middle.svg" alt="middle">
              <div class="length">
                <img class="marker__characteristic" src="/PageRoutePersonal/img/icons/road.svg" alt="road">
                <p class="length__distance">Не указано</p>
              </div>
              <div class="time">
                <img class="marker__characteristic" src="/PageRoutePersonal/img/icons/time.svg" alt="time">
                <p class="time__duration">Не указано</p>
              </div>
            </div>
        </div>

        <div class="marker__container">
            <div class="marker__title"><a href="{{route('routepersonal')}}" class="marker__link">Маршрут от метро Орехово до метро Семеновская</a></div>
            <div class="short-description">Маршрут</div>
            <div class="star-rating star-rating_set">
              <div class="star-rating__body">
                <img class="star-rating__star" src="/PageMap/img/stars/stars04.svg">
                <span class="star-rating__feedback">(35)</span>
              </div>
            </div>
            <div class="marker-status status-broken">Не работает</div>
            <div class="marker__characteristics">
              <img class="marker__characteristic complexity" src="/PageRoutePersonal/img/icons/middle.svg" alt="middle">
              <div class="length">
                <img class="marker__characteristic" src="/PageRoutePersonal/img/icons/road.svg" alt="road">
                <p class="length__distance">Не указано</p>
              </div>
              <div class="time">
                <img class="marker__characteristic" src="/PageRoutePersonal/img/icons/time.svg" alt="time">
                <p class="time__duration">Не указано</p>
              </div>
            </div>
        </div>

        <div class="marker__container">
            <div class="marker__title"><a href="{{route('routepersonal')}}" class="marker__link">Маршрут от метро Орехово до метро Семеновская</a></div>
            <div class="short-description">Маршрут</div>
            <div class="star-rating star-rating_set">
              <div class="star-rating__body">
                <img class="star-rating__star" src="/PageMap/img/stars/stars04.svg">
                <span class="star-rating__feedback">(35)</span>
              </div>
            </div>
            <div class="marker-status status-broken">Не работает</div>
            <div class="marker__characteristics">
              <img class="marker__characteristic complexity" src="/PageRoutePersonal/img/icons/middle.svg" alt="middle">
              <div class="length">
                <img class="marker__characteristic" src="/PageRoutePersonal/img/icons/road.svg" alt="road">
                <p class="length__distance">Не указано</p>
              </div>
              <div class="time">
                <img class="marker__characteristic" src="/PageRoutePersonal/img/icons/time.svg" alt="time">
                <p class="time__duration">Не указано</p>
              </div>
            </div>
        </div>
        </div>
      </div>            
    </form>
    </div>
    <!--------------FOOTER-------------------->
    @include('Components.footer')
    <!--------------/FOOTER-------------------->
</div>
<script src="Script/menu.js"></script>     
</body>
</html>
