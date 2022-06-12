<!DOCTYPE html>
<html>
<head>
    <title>Редактирование точки</title>

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
        <h1 class="edit-point__title">Редактирование метки</h1>
        <div class="content__container">
            <div class="edit-point__forms">
                <form method="" action ="" id="edit-form" enctype="multipart/form-data">
                    <h4 class="sub-title">Название<span class="required-form">*</span></h4>
                    <input type="text" placeholder="Введите название" name="name" required>
                    <h4 class="sub-title">Категория<span class="required-form">*</span></h4>
                    <select required name="type">
                        <option value="" disabled selected style="display:none;">Выберите категорию</option>
                        <option value="socket,zpoints"><img src="/PageMap/img/add-object/01.svg" alt="socket">Розетка</option>
                        <option value="house,dpoints"><img src="/PageMap/img/add-object/02.svg" alt="socket">Достопримечательность</option>
                    </select>
                    <h4 class="sub-title">Адрес<span class="required-form">*</span></h4>
                    <input type="text" placeholder="Введите адрес" name="address" required>
                    <h4 class="sub-title">Статус работы<span class="required-form">*</span></h4>
                    <select required name="status">
                        <option value="Статус неизвестен">Статус неизвестен</option>
                        <option value="Работает">Работает</option>
                        <option value="Не работает">Не работает</option>
                    </select>
                    <h4 class="sub-title">Краткое описание<span class="required-form">*</span></h4>
                    <input type="text" class="short-description" placeholder="Информация будет отображена на карте" name="shortdescription" required>
                    <h4 class="sub-title">Полное описание</h4>
                    <textarea class="edit-point__description" placeholder="Дополнительная информация об объекте, например, часы работы, сайт и др. Эта информация будет показываться на личной странице объекта." name="description"></textarea>
                    <h4 class="sub-title">Фотографии</h4>
                    <div class="add-photo">
                        <input type="file" id="files" name="photo" accept="image/*,image/jpeg" onchange="previewFile()">
                        <label for="files"><img src="/PageSettings/img/02.svg">Добавить фото</label>
                        <output id="list"></output>
                    </div>
                    <div class="edit-point__warning">Вы можете загрузить фото в формате JPG, JPEG, PNG</div>
                    <!--<div class="edit-point__photos__mobile">
                        <img  class="photo" style = 'width:100%' src ="/PageEditPoints/img/back.png">
                        <button class = "crossbutton"><img src="/PageEditPoints/img/crossbutton.svg" alt=""></button>
                    </div>-->
                    <div class="edit-buttons">
                        <a href="{{route('pointpersonal')}}" class="edit-point__cancel">Назад</a>
                        <input type="submit" class="edit-point__add" value ="Сохранить">
                    </div>
                </form>
            </div>
            <div class="edit-point__photos">
                <img  id="photo" style = 'width:100%' src ="/PageEditPoints/img/back.png">
                <button id = "crossbutton"><img src="/PageEditPoints/img/crossbutton.svg" alt=""></button>
            </div>
        </div>

    </div>
    <!--------------FOOTER-------------------->
    @include('Components.footer')
    <!--------------/FOOTER-------------------->
</div>
<script src="Script/menu.js" async></script>
<script>
    // сохранение старого пути к фотке
    const oldway = document.getElementById('photo').src;

    //Превью - замена имеющейся фотки на загруженную
    function previewFile() {
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
    }
    document.getElementById('files').addEventListener('change', handleFileSelect, false);
    /*-------------------------------*/
</script>
</body>
</html>
