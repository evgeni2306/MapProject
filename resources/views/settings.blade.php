<!DOCTYPE html>
<html>
<head>
    <title>Настройки</title>
    
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PageEditPoints/css/headerPages.css">
    <link rel="stylesheet" href="/PageEditPoints/css/footerPages.css">
    <link rel="stylesheet" href="/PageSettings/css/styles.css">
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
      <h1 class="settings__title">Настройки</h1>
      <div class="content__container">
        <div class="avatar__container">
          <img  class="avatar-big" src="/PageSettings/img/02.png" alt="user">
          <div class="change-photo">
            <input type="file" id="files" name="files[]">
            <label for="files"><img src="/PageSettings/img/02.svg">Изменить фото</label>
            <output id="list"></output>
          </div>
          <!--<div class="change-photo__mobile">
            <input type="file" id="files__mobile" name="files[]">
            <label for="files__mobile"><img src="/PageSettings/img/02.svg"></label>
            <output id="list"></output>
          </div>-->
        </div>
        <div class="forms__container">
          <h4 class="sub-title">Имя</h4>
          <input type="text" placeholder="Введите имя" name="name">
          <h4 class="sub-title">Фамилия</h4>
          <input type="text" placeholder="Введите фамилию" name="surname">
          <h4 class="sub-title">E-mail</h4>
          <input type="text" placeholder="Введите e-mail" name="email">
          <h4 class="sub-title">Модель транспорта</h4>
          <input type="text" placeholder="Введите модель своего транспорта" name="transport">
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
</script>
</body>
</html>
