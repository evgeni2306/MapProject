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
          <input type="number" placeholder="Введите протяженность" name="length">
          </div>
          <div class="forms__time">
            <h4 class="sub-title">Время прохождения, ч</h4>
          <input type="number" placeholder="Введите время" name="time">
          </div>
          
        </div>
        <input type="submit" class="search-button" value ="Найти">
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
