<!DOCTYPE html>
<html>
<head>
    <title>Редактирование маршрута</title>

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
        <h1 class="edit-point__title">Редактирование маршрута</h1>
        <div class="content__container">
            <div class="edit-point__forms">
                <form method="post" action ="{{route('UpdateRoute',$_SESSION['CurrentEditRoute']->id)}}" id="edit-form" enctype="multipart/form-data">
                    <h4 class="sub-title">Название<span class="required-form">*</span></h4>
                    <input type="text" placeholder="Введите название" name="name" required value = "{{$_SESSION['CurrentEditRoute']->name}}">
                    <h4 class="sub-title">Краткое описание<span class="required-form"></span></h4>
                    <input type="text" class="short-description" placeholder="Информация будет отображена на карте" name="shortdescription"  value = {{$_SESSION['CurrentEditRoute']->shortdescription}}>
                    <h4 class="sub-title">Сложность<span class="required-form">*</span></h4>
                    <select required name="difficult" id = "difficult">
                        <option value="{{$_SESSION['CurrentEditRoute']->difficult}}" disabled selected style="display:none;">Выберите сложность</option>
                        <option value="Легко,groutes,greenroute">Для новичков</option>
                        <option value="Средне,yroutes,yellowroute">Средняя</option>
                        <option value="Сложно,rroutes,redroute">Для продвинутых</option>
                    </select>
                    <h4 class="sub-title">Протяженность</h4>
                    <input type="text" placeholder="Введите протяженность" name="distance" value ="{{$_SESSION['CurrentEditRoute']->distance}}" >
                    <h4 class="sub-title">Примерное время</h4>
                    <input type="text" placeholder="Введите время" name="time" value = "{{$_SESSION['CurrentEditRoute']->time}}">
                    <h4 class="sub-title">Описание</h4>
                    <textarea class="edit-point__description" placeholder="Поделитесь информацией о маршруте. Например, укажите ключевые точки, наличие розеток или достопримечательностей на пути." name="description" value ="{{$_SESSION['CurrentEditRoute']->description}}"></textarea>
                    @csrf
                    <div class="edit-buttons">
                        <a href="" class="edit-point__cancel">Назад</a>
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
