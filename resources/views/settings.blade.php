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
</head>
<body>
<!--------------HEADER-------------------->
@include('Components.headerPages')
<!--------------/HEADER-------------------->
    <div class="container">
        <form method="Post" action ="{{'edit'}}">
            <h1 class="settings__title">Настройки</h1>
            <div class="content__container">
                <div class="avatar__container">
                    <img  class="avatar-big" src="{{$_SESSION['User']->avatar}}" alt="user">
                    <div class="change-photo">
                        <input disabled  type="file" id="files" name="files[]">
                        <label  for="files"><img src="/PageSettings/img/02.svg">Изменить фото</label>
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
                    <input type="text" placeholder="Введите имя" name="name" value="{{$_SESSION['User']->name}}">
                    <h4 class="sub-title">Фамилия</h4>
                    <input type="text" placeholder="Введите фамилию" name="surname" value ="{{$_SESSION['User']->surname}}">
{{--                    <h4 class="sub-title">E-mail</h4>--}}
{{--                    <input type="text" placeholder="Введите e-mail" name="email">--}}
                    <h4 class="sub-title">Модель транспорта</h4>
                    <input type="text" placeholder="Введите модель своего транспорта"  value="{{$_SESSION['User']->transport}}"name="transport">
                    <h4 class="sub-title">Вид карты</h4>
                    <select required id="mapstyle" name="mapstyle">
                        <option value="{{$_SESSION['User']->mapstyle}}" disabled selected style="display:none;">Выберите вид карты</option>
                        <option value="https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw">Стандартный</option>
                        <option value="https://tile-{s}.opentopomap.ru/{z}/{x}/{y}.png">Топографический</option>
                    </select>
                    @csrf
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
    //-------Подстановка по умолчанию  значения полей с выбором------
    const select1 = document.getElementById('mapstyle').getElementsByTagName('option');//Категория
    for (let i = 1; i < select1.length; i++) {
        if ( select1[i].value === select1[0].value  ) select1[i].setAttribute('selected','selected')
    }
    //-------------------------------------------------------------------
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

</script>
</body>
</html>
