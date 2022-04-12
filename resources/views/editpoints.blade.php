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
        <h1 class="edit-point__title">Редактирование метки</h1>
        <div class="content__container">
            <div class="edit-point__forms">
                <form method="post" action ="{{route('UpdatePoint',$_SESSION['CurrentEditPoint']->id)}}" enctype="multipart/form-data">
                    <h4 class="sub-title">Название<span class="required-form">*</span></h4>
                    <input type="text" placeholder="Введите название" name="name" value ="{{$_SESSION['CurrentEditPoint']->name}}">
                    <h4 class="sub-title">Категория<span class="required-form">*</span></h4>
                    <select id = 'category' required name="type">
                        <option  value="{{$_SESSION['CurrentEditPoint']->type}}" disabled   style="display:none;">Выберите категорию</option>
                        <option  value="socket,zpoints"><img src="/PageMap/img/add-object/01.svg" alt="socket">Розетка</option>
                        <option  value="house,dpoints"><img src="/PageMap/img/add-object/02.svg" alt="socket">Достопримечательность</option>
                    </select>
                    <h4 class="sub-title">Адрес<span class="required-form">*</span></h4>
                    <input type="text" placeholder="Введите адрес" name="address" value ="{{$_SESSION['CurrentEditPoint']->address}}">
                    <h4 class="sub-title">Статус работы<span class="required-form">*</span></h4>
                    <select  id="status"  required name="status">
                        <option value="{{$_SESSION['CurrentEditPoint']->status}}" disabled style="display:none;"></option>
                        <option value="Под вопросом">Под вопросом</option>
                        <option value="Работает">Работает</option>
                        <option value="Не работает">Не работает</option>
                    </select>
                    <h4 class="sub-title">Краткое описание<span class="required-form">*</span></h4>
                    <input type="text" class="short-description" placeholder="Информация будет отображена на карте" value="{{$_SESSION['CurrentEditPoint']->shortdescription}}" name="shortdescription">
                    <h4 class="sub-title">Полное описание</h4>
                    <textarea class="edit-point__description"  placeholder="Дополнительная информация об объекте, например, часы работы, сайт и др. Эта информация будет показываться на личной странице объекта." name="description">{{$_SESSION['CurrentEditPoint']->description}}</textarea>
                    <h4 class="sub-title">Фотографии</h4>
                    <div class="add-photo">
                        <input type="file" id="files" name="photo" accept="image/*,image/jpeg" onchange="previewFile()">
                        <label for="files"><img src="">Добавить фото</label>
                        <output id="list"></output>
                    </div>
                    @csrf
                    <div class="edit-point__warning">Вы можете загрузить фото в формате JPG, JPEG, PNG</div>
                    <div class="edit-buttons">
                        <input type="reset" class="edit-point__cancel"  value ="Отмена">
                        <input type="submit" class="edit-point__add" value ="Сохранить">
                    </div>
                </form>
            </div>
        <div class="edit-point__photos">
            <img  id="photo" style = 'width:100%' src ="{{$_SESSION['CurrentEditPoint']->photo}}">
            <button id = "crossbutton" style="display: none"><img src="/PageEditPoints/img/crossbutton.svg"  alt=""></button>
        </div>
        </div>

    </div>
    <!--------------FOOTER-------------------->
    @include('Components.footer')
    <!--------------/FOOTER-------------------->
</div>
<script src="Script/menu.js"></script>
<script>

    // //-------Подстановка по умолчанию  значения полей с выбором------

    const select1 = document.getElementById('category').getElementsByTagName('option');//Категория
    for (let i = 1; i < select1.length; i++) {
        if ( select1[i].value === select1[0].value  ) select1[i].setAttribute('selected','selected')
    }

    const select2 = document.getElementById('status').getElementsByTagName('option');//Статус
    for (let i = 1; i < select2.length; i++) {
        if ( select2[i].value === select2[0].value  ) select2[i].setAttribute('selected','selected')
    }
    // //---------------------------------------------------------------------------



    //-----------------Механизм предпросмотра фотке в рамке при загрузке новой---------------
    // сохранение старого пути к фотке
const oldway = document.getElementById('photo').src

    //Превью - замена имеющейся фотки на загруженную
    function previewFile() {
        document.getElementById("crossbutton").style.display = "";
        const preview = document.getElementById('photo');
        const file = document.querySelector('input[type=file]').files[0];
        const reader = new FileReader();
        reader.addEventListener("load", function () {
            // convert image file to base64 string
            preview.src = reader.result;
        }, false);
        if (file) {
            reader.readAsDataURL(file);
        }
    }
//отмена загруженной фотки, загруженная удаляется, возвращается старая
    document.getElementById("crossbutton").onclick = function(){
        const preview = document.getElementById('photo');
        document.getElementById('files').value = null;//сброс файла в форме
        preview.src = oldway;//сброс картинки
        document.getElementById("crossbutton").style.display = "none";
    }
    document.getElementById('files').addEventListener('change', handleFileSelect, false);
    //-------------------------------------------------------------------------------------

</script>
</body>
</html>
