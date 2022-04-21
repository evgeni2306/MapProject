<!DOCTYPE html>
<html>
<head>
    <title>Загрузка маршрута</title>

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PageEditPoints/css/headerPages.css">
    <link rel="stylesheet" href="/PageEditPoints/css/footerPages.css">
    <link rel="stylesheet" href="/PageEditPoints/css/styles.css">
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
        <h1 class="edit-point__title">Загрузка маршрута</h1>
        <div class="content__container">
            <div class="edit-point__forms">
                <form method="post" action ="{{route('loadroute')}}" id="edit-form" enctype="multipart/form-data">
                    <h4 class="sub-title">Название<span class="required-form">*</span></h4>
                    <input type="text" placeholder="Введите название" name="name" required>
                    <h4 class="sub-title">Краткое описание<span class="required-form">*</span></h4>
                    <input type="text" class="short-description" placeholder="Информация будет отображена на карте" name="shortdescription" required>
                    <h4 class="sub-title">Сложность<span class="required-form">*</span></h4>
                    <select required name="difficult">
                        <option value="" disabled selected style="display:none;">Выберите сложность</option>
                        <option value="Легко">Для новичков</option>
                        <option value="Средне">Средняя</option>
                        <option value="Сложно">Для продвинутых</option>
                    </select>
                    <h4 class="sub-title">Протяженность</h4>
                    <input type="text" placeholder="Введите протяженность" name="distance">
                    <h4 class="sub-title">Примерное время</h4>
                    <input type="text" placeholder="Введите время" name="time">
                    <h4 class="sub-title">Описание</h4>
                    <textarea class="edit-point__description" placeholder="Поделитесь информацией о маршруте. Например, укажите ключевые точки, наличие розеток или достопримечательностей на пути." name="description"></textarea>
                    <h4 class="sub-title">Файл маршрута<span class="required-form">*</span></h4>
                    <div class="add-photo">
                        <select required name="type">
                            <option value="" disabled selected style="display:none;">Выберите тип файла</option>
                            <option value="GPX">GPX</option>
                            <option value="CSV">CSV</option>
                        </select>
                        <input type="file" id="files" name="file">
                        <label for="files"><img src="/PageLoadRoute/img/download.svg">Загрузить файл</label>
                        <output id="list"></output>
                        @csrf
                    </div>
                    <div class="edit-buttons">
                        <input type="reset" class="edit-point__cancel" value ="Отмена">
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
