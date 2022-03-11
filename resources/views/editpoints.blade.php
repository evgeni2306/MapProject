<!DOCTYPE html>
<html>
<head>
    <title>Редактирование точки</title>

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PageEditPoints/css/headerPages.css">
    <link rel="stylesheet" href="/PageEditPoints/css/footerPages.css">
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
    <!--------------HEADER-------------------->
    @include('Components.headerPages')
    <!--------------/HEADER-------------------->
    <div class="container">
        <form method="" action ="">
            <h1 class="edit-point__title">Редактирование метки</h1>
            <div class="content__container">
                <div class="edit-point__forms">
                    <h4 class="sub-title">Название<span class="required-form">*</span></h4>
                    <input type="text" placeholder="Введите название" name="name">
                    <h4 class="sub-title">Категория<span class="required-form">*</span></h4>
                    <select required name="type">
                        <option value="" disabled selected style="display:none;">Выберите категорию</option>
                        <option value="Зарядка"><img src="/PageMap/img/add-object/01.svg" alt="socket">Розетка</option>
                        <option value="Достопримечательность"><img src="/PageMap/img/add-object/02.svg" alt="socket">Достопримечательность</option>
                    </select>
                    <h4 class="sub-title">Адрес<span class="required-form">*</span></h4>
                    <input type="text" placeholder="Введите адрес" name="address">
                    <h4 class="sub-title">Статус работы<span class="required-form">*</span></h4>
                    <select required name="status">
                        <option value="Статус неизвестен">Статус неизвестен</option>                    
                        <option value="Работает">Работает</option>
                        <option value="Не работает">Не работает</option>
                    </select>
                    <h4 class="sub-title">Краткое описание<span class="required-form">*</span></h4>
                    <input type="text" class="short-description" placeholder="Информация будет отображена на карте" name="short-description">
                    <h4 class="sub-title">Полное описание</h4>
                    <textarea class="edit-point__description" placeholder="Дополнительная информация об объекте, например, часы работы, сайт и др. Эта информация будет показываться на личной странице объекта." name="description"></textarea>
                    <h4 class="sub-title">Фотографии</h4>
                    <div class="add-photo">
                        <input type="file" id="files" name="files[]" accept="image/*,image/jpeg">
                        <label for="files"><img src="/PageSettings/img/02.svg">Добавить фото</label>
                        <output id="list"></output>
                    </div>
                    <div class="edit-point__warning">Вы можете добавить до 3 фото в формате JPG, JPEG, PNG</div>
                    <div class="edit-buttons">
                        <input type="reset" class="edit-point__cancel" value ="Отмена">
                        <input type="submit" class="edit-point__add" value ="Сохранить">
                    </div>                
                </div>
                <div class="edit-point__photos"></div>
            </div>
        </form>
    </div>
    <!--------------FOOTER-------------------->
    @include('Components.footer')
    <!--------------/FOOTER-------------------->
</div>
<script src="Script/menu.js"></script> 
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

</script>
</body>
</html>
