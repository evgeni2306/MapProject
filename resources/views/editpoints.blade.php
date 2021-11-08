<!DOCTYPE html>
<html>
<head>
    <title>Редактирование точки</title>

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PageEditPoints/css/styles.css">
    <link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
          integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
          crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
            integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
            crossorigin=""></script>
</head>
<body>
<div class="wrapper">
    <header class="header">
        <div class="header__container">
            <a href="" class="header__logo">LOGO</a>
            <nav class="header__menu menu">
                <ul class="menu__list">
                    <li class="menu__item">
                        <a href="{{route('map')}}"><button type="button" class="menu__link" id="menu__link__view"><img
                                src="/PageMap/img/header/02.svg" alt="view">Просмотр
                        </button></a> 
                    </li>
                    <li class="menu__item">
                        <a href="{{route('map')}}"><button type="button" class="menu__link" id="menu__link__add-object"><img
                                src="/PageMap/img/header/03.svg" alt="object">Добавить объект
                        </button></a>
                    </li>
                    <li class="menu__item">
                        <a href="{{route('map')}}"><button type="button" class="menu__link" id="menu__link__add-route"><img
                                src="/PageMap/img/header/04.svg" alt="route">Добавить маршрут
                        </button></a>
                    </li>
                </ul>
            </nav>
            <nav class="user-menu"> 
                <ul class="user-menu__list">
                    <li class="user-name">
                        <img  class="avatar" src="/PageMap/img/user/user.png" alt="user">
                        <a href="#" class="user-menu__link" tabindex="1">Александр Иванов<img src="/PageMap/img/user/arrow.svg" alt=""></a>
                        <ul class="sub-menu__list">
                            <li><a href="#" class="sub-menu__link"><img src="/PageMap/img/user/01.svg" alt="">Мой профиль</a></li>
                            <li><a href="#" class="sub-menu__link"><img src="/PageMap/img/user/02.svg" alt="">Настройки</a></li>
                            <li><a href="#" class="sub-menu__link"><img src="/PageMap/img/user/03.svg" alt="">Выйти</a></li>
                        </ul> 
                    </li>
               </ul>
            </nav>
        </div>
    </header>
    <div class="container">
      <div class="edit-point__forms">
        <h1 class="edit-point__title">Редактирование точки</h1>
        <form method="" action ="">
          <h4 class="sub-title">Адрес</h4>
          <input type="text" placeholder="Введите адрес" name="address">
          <h4 class="sub-title">Название</h4>
          <input type="text" placeholder="Введите название" name="name">
          <h4 class="sub-title">Категория</h4>
          <select  required name="type">
            <option value="" disabled selected style="display:none;">Выберите категорию</option>
            <option value="Зарядка"><img src="/PageMap/img/add-object/01.svg" alt="socket">Розетка</option>
            <option value="Достопримечательность"><img src="/PageMap/img/add-object/02.svg" alt="socket">Достопримечательность</option>
          </select>
          <h4 class="sub-title">Описание</h4>
          <textarea class="edit-point__description" placeholder="Добавьте описание объекта" name="description"></textarea>
          
          <input type="submit" class="edit-point__add" value ="Сохранить">
        </form>
      </div>
      <div class="edit-point__photos">
        <h4 class="sub-title">Фотографии</h4>
        <form method="" action ="">
            <div class="upload-container">
                <img class="upload-image" src="/PageEditPoints/img/01.png">
                <input type="file" id="files" name="files[]">
                <label for="files">Добавить фото</label>
                <output id="list"></output>
            </div> 
            <div class="upload-container">
                <img class="upload-image" src="/PageEditPoints/img/01.png">
                <input type="file" id="files" name="files[]">
                <label for="files">Добавить фото</label>
                <output id="list"></output>
            </div> 
            <div class="upload-container">
                <img class="upload-image" src="/PageEditPoints/img/01.png">
                <input type="file" id="files" name="files[]">
                <label for="files">Добавить фото</label>
                <output id="list"></output>
            </div>          
        </form>
        <div class="edit-point__warning">Вы можете добавить до 3 фото в формате JPG, JPEG, PNG.</div>
      </div>
    </div>
    <footer class="footer">
      <div class="footer__logo">LOGO</div>
      <div class="footer__rights">@Название 2021. Все права защищены</div>
      <div class="footer__contacts">Контакты</div>
    </footer>
</div>    
<script>
  function handleFileSelect(evt) {
    let files = evt.target.files;

    for (let i = 0, f; f = files[i]; i++) {
      if (!f.type.match('image.*')) {
        continue;
      }

      let reader = new FileReader();
      reader.onload = (function(theFile) {
        return function(e) {
          let span = document.createElement('span');
          span.innerHTML = ['<img class="thumb" src="', e.target.result,
                            '" title="', theFile.name, '"/>'].join('');
          document.getElementById('list').insertBefore(span, null);
        };
      })(f);

      reader.readAsDataURL(f);
    }
  }

document.getElementById('files').addEventListener('change', handleFileSelect, false);
/*-------------------------------*/
        var menuLinks = document.querySelectorAll('.menu__link');
        var lastClicked = menuLinks[0];
        var viewOnly = false;
        var addObject = false;


        for (var i = 0; i < menuLinks.length; i++) {
            menuLinks[i].addEventListener('click', function () {
                lastClicked.classList.remove('active-menu');
                this.classList.add('active-menu');

                lastClicked = this;
            });
        }
/*----------------------------*/
        /*function previewFile() {
            var preview = document.querySelector('img');
            var file    = document.querySelector('input[type=file]').files[0];
            var reader  = new FileReader();

            reader.onloadend = function () {
                preview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "";
            }
        }*/
        /*-------------star-rating---------------*/
        const ratings = document.querySelectorAll('.star-rating');
        if (ratings.length > 0) {
            initRatings();
        }

        function initRatings() {
            let ratingActive, ratingValue;
            for (let i = 0; i < ratings.length; i++) {
                const rating = ratings[i];
                initRating(rating);
            }

            function initRating(rating) {
                initRatingVars(rating);
                setRatingActiveWidth();

                if (rating.classList.contains('star-rating_set')) {
                    setRating(rating);
                }
            }

            function initRatingVars(rating) {
                ratingActive = rating.querySelector('.star-rating__active');
                ratingValue = rating.querySelector('.star-rating__value');
            }

            function setRatingActiveWidth(i = ratingValue.innerHTML) {
                const ratingActiveWidth = i / 0.05;
                ratingActive.style.width = `${ratingActiveWidth}%`;
            }

            function setRating(rating) {
                const ratingItems = rating.querySelectorAll('.star-rating__item');
                for (let i = 0; i < ratingItems.length; i++) {
                    const ratingItem = ratingItems[i];
                    ratingItem.addEventListener("mouseenter", function(e) {
                        initRatingVars(rating);
                        setRatingActiveWidth(ratingItem.value);
                    });
                    ratingItem.addEventListener("mouseleave", function(e) {
                        setRatingActiveWidth();
                    });
                    ratingItem.addEventListener("click", function(e) {
                        initRatingVars(rating);

                        if (rating.dataset.ajax) {
                            setRatingValue(ratingItem.value, rating);
                        } else {
                            ratingValue.innerHTML = i + 1;
                            setRatingActiveWidth();
                        }
                    });
                }
            }
        }
        /*--------------------------------------*/
        
</script>
</body>
</html>
