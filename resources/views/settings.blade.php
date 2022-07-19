<!DOCTYPE html>
<html>
<head>
    <title>Настройки</title>

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PageEditPoints/css/headerPages.css">
    <link rel="stylesheet" href="/PageEditPoints/css/footerPages.css">
    <link rel="stylesheet" href="/PageSettings/css/styles.css">
    <link rel="shortcut icon" type="image/x-icon" href="../favicon.png"/>

</head>
<body>
<div class="wrapper">
    <!--------------HEADER-------------------->
@include('Components.headerPages')
<!--------------/HEADER-------------------->
    <div class="container">
        <form method="Post" action ="{{'edit'}}" enctype="multipart/form-data">
            <h1 class="settings__title">Настройки</h1>
            <div class="content__container">
                <div class="avatar__container">
                    <div class="avatar__photo">
                        <img id="photo" class="avatar-big" src="{{$user->avatar}}" alt="user">
                        <button id="crossbutton" style="display: none" ><img src="/PageEditPoints/img/crossbutton.svg" alt=""></button>
                    </div>
                    <div class="change-photo">
                        <input type="file" id="files" name="photo" accept="image/*,image/jpeg" onchange="previewFile()">
                        <label  for="files"><img src="/PageSettings/img/02.svg">Изменить фото</label>
                        <output id="list"></output>
                    </div>
                    <div class="change-photo__warning">Вы можете загрузить фото в формате JPG, JPEG, PNG и размером не более 4МБ</div>
                    @if(isset($fileSizeError))
                    <div class="error-block  ">
                        <img src="PageRegistration/img/information.svg" alt="">
                        <p class="error-block__text">{{$fileSizeError}}</p>
                    </div>
                    @endif

                </div>
                <div class="forms__container">
                    <h4 class="sub-title">Имя</h4>
                    <input type="text" placeholder="Введите имя" name="name" value="{{$user->name}}">
                    <h4 class="sub-title">Фамилия</h4>
                    <input type="text" placeholder="Введите фамилию" name="surname" value ="{{$user->surname}}">
                    <h4 class="sub-title">Никнейм</h4>

                    <input type="text" placeholder="Введите никнейм" name="nickname" value ="{{$user->nickname}}">

                    <p class="nickname-warning"> Впишите никнейм, если хотите использовать его вместо имени и фамилии. Эта информация будет отображена в профиле.</p>
                    @if(isset($nicknameError))
                    <div class="error-block ">
                        <img src="PageRegistration/img/information.svg" alt="">
                        <p class="error-block__text">{{$nicknameError}}</p>
                    </div>
                    @endif
                    <h4 class="sub-title">Модель транспорта</h4>
                    <input type="text" placeholder="Введите модель своего транспорта" name="transport" value = "{{$user->transport}}">
                    <h4 class="sub-title">Вид карты</h4>
                    <select required id="mapstyle" name="mapstyle">
                        <option value="{{$user->mapstyle}}" disabled selected style="display:none;">Выберите вид карты</option>
                        <option value="https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw">Стандартный</option>
                        <option value="https://tile-{s}.opentopomap.ru/{z}/{x}/{y}.png">Топографический</option>
                    </select>
                    @csrf
                    <div class="buttons">
                        <input type="button" onclick="backButton()" class="settings__cancel" value ="Назад">
                        <input type="submit" class="settings__save" value ="Сохранить">
                    </div>
<!--                    --><?// dd(URL::previous()) ?>
                </div>
            </div>
        </form>
    </div>
    <!--------------FOOTER-------------------->
@include('Components.footer')
<!--------------/FOOTER-------------------->

</div>
<script src="Script/menu.js"></script>
<script>
    function backButton(){
        window.location.replace("{{URL::previous()}}");
    }
    //-------Подстановка по умолчанию  значения полей с выбором------
    const select1 = document.getElementById('mapstyle').getElementsByTagName('option');
    for (let i = 1; i < select1.length; i++) {
        if ( select1[i].value === select1[0].value  ) select1[i].setAttribute('selected','selected')
    }
    //-------------------------------------------------------------------

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
    }
    document.getElementById('files').addEventListener('change', handleFileSelect, false);
    /*-------------------------------*/


</script>
</body>
</html>
