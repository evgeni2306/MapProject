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
    <form method="" action ="">
      <h1 class="settings__title">Настройки</h1>
      <div class="content__container">
        <div class="avatar__container">
          <div class="avatar__photo">
            <img id="photo" class="avatar-big" src="/PageSettings/img/02.png" alt="user">
            <button id="crossbutton"><img src="/PageEditPoints/img/crossbutton.svg" alt=""></button>
          </div>
          <div class="change-photo">
            <input type="file" id="files" name="photo" accept="image/*,image/jpeg" onchange="previewFile()">
            <label for="files"><img src="/PageSettings/img/02.svg">Изменить фото</label>
            <output id="list"></output>
          </div>
          <div class="change-photo__warning">Вы можете добавить фотографию весом не более 4Мб в формате JPG, JPEG, PNG.</div>
          <div class="error-block hide">
            <img src="PageRegistration/img/information.svg" alt="error">
            <p class="error-block__text">Выбранный вами файл слишком большой для загрузки</p>
          </div>
        </div>
        <div class="forms__container">
          <h4 class="sub-title">Имя</h4>
          <input type="text" placeholder="Введите имя" name="name">
          <h4 class="sub-title">Фамилия</h4>
          <input type="text" placeholder="Введите фамилию" name="surname">
          <h4 class="sub-title">Никнейм</h4>
          <input type="text" placeholder="Введите никнейм" name="nickname">
          <p class="nickname-warning">Впишите никнейм, если хотите использовать его вместо имени и фамилии. Эта информация будет отображена в профиле.</p>
          <div class="error-block hide">
            <img src="PageRegistration/img/information.svg" alt="">
            <p class="error-block__text">Этот никнейм уже занят</p>
          </div>
          <h4 class="sub-title">Модель транспорта</h4>
          <input type="text" placeholder="Введите модель своего транспорта" name="transport">
          <h4 class="sub-title">Вид карты</h4>
          <select required name="complexity">
            <option value="" disabled selected style="display:none;">Выберите вид карты</option>
            <option value="">Стандартный</option>
            <option value="">Топографический</option>
          </select>
          <div class="buttons">
            <input type="reset" class="settings__cancel" value ="Отмена">
            <input type="submit" class="settings__save" value ="Сохранить">
          </div>
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
  // сохранение старого пути к фотке
const oldway = document.getElementById('photo').src

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
