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
                <form method="post" action ="{{route('loadroute')}}" id="edit-form" enctype="multipart/form-data">
                    <h4 class="sub-title">Название<span class="required-form">*</span></h4>
                    <input type="text" placeholder="Введите название" name="name" required value="{{old('name')}}">
                    <h4 class="sub-title">Краткое описание<span class="required-form">*</span></h4>
                    <input type="text" class="short-description"value="{{old('shortdescription')}}" placeholder="Информация будет отображена на карте" name="shortdescription" value="{{old('shortdescription')}}" required>
                    <h4 class="sub-title">Сложность<span class="required-form">*</span></h4>
                    <select required id="difficult" name="difficult">
                        <option  disabled value="{{old('difficult')}}" selected style="display:none;">Выберите сложность</option>
                        <option value="Легко,groutes,greenroute">Для новичков</option>
                        <option value="Средне,yroutes,yellowroute">Средняя</option>
                        <option value="Сложно,rroutes,redroute">Для продвинутых</option>
                    </select>
                    <h4 class="sub-title">Протяженность</h4>
                    <input type="text" value="{{old('distance')}}"placeholder="Введите протяженность" name="distance">
                    <h4 class="sub-title">Примерное время</h4>
                    <input type="text" placeholder="Введите время" name="time" value="{{old('time')}}">
                    <h4 class="sub-title">Описание</h4>
                    <textarea class="edit-point__description"value="{{old('description')}}" placeholder="Поделитесь информацией о маршруте. Например, укажите ключевые точки, наличие розеток или достопримечательностей на пути." name="description"></textarea>
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
    const select1 = document.getElementById('difficult').getElementsByTagName('option');//Категория
    for (let i = 1; i < select1.length; i++) {
        if ( select1[i].value === select1[0].value  ) select1[i].setAttribute('selected','selected')
    }
</script>
</body>
</html>
