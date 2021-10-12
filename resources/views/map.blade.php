<!DOCTYPE html>
<html>
<head>
    <title>Карта</title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/mapPage/css/styles.css">
    <link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
</head>
<body>
    <div class="wrapper">
        <header class="header">
            <div class="header__container">
                <a href="" class="header__logo">LOGO</a>
                <form action="" method="get">
                    <input class="search" name="search" placeholder="Поиск" type="search">
                    <button class="search-btn" type="submit"><img src="/mapPage/img/header/01.svg" alt="search"></button>
                </form>
                <nav class="header__menu menu">
                <ul class="menu__list">
                    <li class="menu__item">
                    <a href="" class="menu__link"><img src="/mapPage/img/header/02.svg" alt="view">Просмотр</a>
                    </li>
                    <li class="menu__item">
                    <a href="" class="menu__link"><img src="/mapPage/img/header/03.svg" alt="object">Добавить объект</a>
                    </li>
                    <li class="menu__item">
                    <a href="" class="menu__link"><img src="/mapPage/img/header/04.svg" alt="route">Добавить маршрут</a>
                    </li>                    
                </ul>
                </nav>
            </div>
        </header>
        <div class="add-object__container hidden">
            <div class="text-container">
                <div class="add-object__title">Добавление объекта</div>
                <div class="add-object__subtitle">Укажите местоположение объекта, передвигая метку на карте.</div>
            </div>
            <div class="form-fields">
                <div class="form-field form-geolocation">
                    <form action="">
                        <input type="text"><img class="input-icon" src="/mapPage/img/add-object/04.svg" alt="">
                    </form>
                </div>
                <div class="form-field form-object-name">
                    <form action="">
                        <input type="text" placeholder="Добавьте название" required>
                    </form>
                </div>
                <div class="form-field form-category">
                    <form action="">
                        <select name="form-category" required>
                            <option value="" disabled selected style='display:none;'>Выберите категорию</option>
                            <option value="Socket"><img src="/mapPage/img/add-object/01.svg" alt="socket">Розетка</option>
                            <option value="Attraction"><img src="/mapPage/img/add-object/02.svg" alt="socket">Достопримечательность</option>
                            <option value="Home"><img src="/mapPage/img/add-object/03.svg" alt="socket">Дом</option>
                        </select>
                    </form>
                </div>
                <div class="form-description">
                    <form action="">
                        <input type="text" name="form-description" placeholder="Добавьте описание">
                    </form>
                </div>
                <div class="form-field form-photos">
                    <form enctype="multipart/form-data" method="post">
                        <p>Добавьте фотографии весом не более 50 МБ</p>
                        <input class="add-file" type="file" name="photo" multiple accept="image/*,image/jpeg">
                        <div class="form-buttons">
                            <button type="button" class="form-photos__cancel">Отмена</button>
                            <button type="submit" class="form-photos__add">Добавить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="map" id="mapid"></div>
        
    </div>
    <script src="/mapPage/js/script.js"></script>
    </body>
</html>
