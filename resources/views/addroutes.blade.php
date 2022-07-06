<!DOCTYPE html>
<html>
<head>
    <title>Добавление маршрута</title>

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PageEditPoints/css/headerPages.css">
    <link rel="stylesheet" href="/PageEditPoints/css/footerPages.css">
    <link rel="stylesheet" href="/PageEditPoints/css/styles.css">
    <link rel="shortcut icon" type="image/x-icon" href="../favicon.png"/>
</head>
<body>
<div class="wrapper">
    <!--------------HEADER-------------------->
    @include('Components.headerPages')
    <!--------------/HEADER-------------------->
    <div class="container">
        <h1 class="edit-point__title">Добавление маршрута</h1>
        <div class="content__container">
            <div class="edit-point__forms">
                <form method="post" action ="{{route('Addroute')}}" id="edit-form" enctype="multipart/form-data">
                    <h4 class="sub-title">Название<span class="required-form">*</span></h4>
                    <input type="text" placeholder="Введите название" name="name" required>
                    <h4 class="sub-title">Краткое описание</h4>
                    <input type="text" class="short-description" placeholder="Информация будет отображена на карте" name="shortdescription" >
                    <h4 class="sub-title">Сложность<span class="required-form">*</span></h4>
                    <select required name="difficult">
                        <option value="" disabled selected style="display:none;">Выберите сложность</option>
                        <option value="Легко,groutes,greenroute">Для новичков</option>
                        <option value="Средне,yroutes,yellowroute">Средняя</option>
                        <option value="Сложно,rroutes,redroute">Для продвинутых</option>
                    </select>
                    <h4 class="sub-title">Протяженность, км</h4>
                    <input type="text" placeholder="Введите протяженность" name="distance">
                    <h4 class="sub-title">Примерное время, ч</h4>
                    <input type="text" placeholder="Введите время" name="time">
                    <h4 class="sub-title">Описание</h4>
                    <textarea class="edit-point__description" placeholder="Поделитесь информацией о маршруте. Например, укажите ключевые точки, наличие розеток или достопримечательностей на пути." name="description"></textarea>
                    <input type="hidden"   name="cord"  value="{{$_POST['cord']}}">
                    @csrf
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
