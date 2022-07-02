<!DOCTYPE html>
<html>
<head>
    <title>Загрузка маршрута</title>

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PageEditPoints/css/headerPages.css">
    <link rel="stylesheet" href="/PageEditPoints/css/footerPages.css">
    <link rel="stylesheet" href="/PageEditPoints/css/styles.css">
    <link rel="stylesheet" href="/PageLoadRoute/css/styles.css">
    <link rel="shortcut icon" type="image/x-icon" href="../favicon.png"/>
</head>
<body>
<div class="wrapper">
    <!--------------HEADER-------------------->
    @include('Components.headerPages')
    <!--------------/HEADER-------------------->
    <div class="container">
        <h1 class="edit-point__title">Загрузка маршрута</h1>
        <div class="content__container">
            <div class="edit-point__forms">
                <form method="" action ="" id="edit-form" enctype="multipart/form-data">
                    <h4 class="sub-title">Название<span class="required-form">*</span></h4>
                    <input type="text" placeholder="Введите название" name="name" required>
                    <h4 class="sub-title">Краткое описание<span class="required-form">*</span></h4>
                    <input type="text" class="short-description" placeholder="Информация будет отображена на карте" name="shortdescription" required>
                    <h4 class="sub-title">Сложность<span class="required-form">*</span></h4>
                    <select required name="complexity">
                        <option value="" disabled selected style="display:none;">Выберите сложность</option>
                        <option value="">Для новичков</option>
                        <option value="">Средняя</option>
                        <option value="">Для продвинутых</option>
                    </select>
                    <h4 class="sub-title">Протяженность, км</h4>
                    <input type="text" placeholder="Введите протяженность" name="length">
                    <h4 class="sub-title">Примерное время, ч</h4>
                    <input type="text" placeholder="Введите время" name="time">
                    <h4 class="sub-title">Описание</h4>
                    <textarea class="edit-point__description" placeholder="Поделитесь информацией о маршруте. Например, укажите ключевые точки, наличие розеток или достопримечательностей на пути." name="description"></textarea>
                    <h4 class="sub-title">Файл маршрута<span class="required-form">*</span></h4>
                    <div class="add-photo">
                      <select required name="complexity">
                        <option value="" disabled selected style="display:none;">Выберите тип файла</option>
                        <option value="">GPX</option>
                        <option value="">CSV</option>
                      </select>
                        <input type="file" id="files" name="route">
                        <label for="files"><img src="/PageLoadRoute/img/download.svg">Загрузить файл</label>
                        <output id="list"></output>
                    </div>
                    <div class="edit-buttons">
                        <a href="{{route('map')}}" class="edit-point__cancel">Отмена</a>
                        <input type="submit" class="edit-point__add" value ="Сохранить">
                    </div>
                </form>
            </div>
        </div>

    </div>
    <!--------------FOOTER-------------------->
    @include('Components.footer')
    <!--------------/FOOTER-------------------->
</div>
<script src="Script/menu.js"></script>
<script>
  
</script>
</body>
</html>
